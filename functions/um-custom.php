<?php
add_shortcode('lichting_directory', function () {
    if ( ! is_user_logged_in() ) {
        return '<p>You must be logged in to view this directory.</p>';
    }

    // --- Config ---
    $meta_key_lichting = 'LichtingNew';   // IMPORTANT: must match your UM field meta key
    $q = isset($_GET['q']) ? sanitize_text_field($_GET['q']) : '';
    $q_like = '%' . $q . '%';

    // Fetch users who have a lichting set
    $user_query_args = [
        'number'   => 9999, // fine for small/medium sites; later you can paginate
        'orderby'  => 'meta_value',
        'order'    => 'ASC',
        'meta_key' => $meta_key_lichting,
        'meta_query' => [
            [
                'key'     => $meta_key_lichting,
                'compare' => 'EXISTS',
            ],
        ],
        'fields' => ['ID', 'display_name', 'user_login'],
    ];

    $users = get_users($user_query_args);

    // Filter by search query (display_name / user_login). You can extend to other meta fields later.
    if ($q !== '') {
        $users = array_values(array_filter($users, function($u) use ($q) {
            $dn = mb_strtolower($u->display_name);
            $ul = mb_strtolower($u->user_login);
            $qq = mb_strtolower($q);
            return str_contains($dn, $qq) || str_contains($ul, $qq);
        }));
    }

    // Group users by Lichting
    $grouped = [];
    foreach ($users as $u) {
        $lichting = get_user_meta($u->ID, $meta_key_lichting, true);
        $lichting = $lichting !== '' ? $lichting : 'Onbekend';
        $grouped[$lichting][] = $u;
    }

    // Sort groups naturally (e.g. 2023, 2024, 2025)
    uksort($grouped, function($a,$b){
        return strnatcasecmp((string)$a, (string)$b);
    });

    // Build output
    ob_start();
    ?>
    <div class="lichting-directory">
        <form class="lichting-search" method="get">
            <input type="text" name="q" value="<?php echo esc_attr($q); ?>" placeholder="Zoek lid..." />
            <button type="submit">Zoeken</button>
            <?php if ($q !== ''): ?>
                <a class="clear" href="<?php echo esc_url(remove_query_arg('q')); ?>">Wissen</a>
            <?php endif; ?>
        </form>

        <div class="lichting-grid">
            <?php foreach ($grouped as $lichting => $members): ?>
                <div class="lichting-tile">
                    <div class="lichting-title">
                        Lichting: <?php echo esc_html($lichting); ?>
                        <span class="count">(<?php echo count($members); ?>)</span>
                    </div>

                    <ul class="members">
                        <?php foreach ($members as $m): ?>
                            <li>
                                <a href="<?php echo esc_url( um_user_profile_url($m->ID) ); ?>">
                                    <?php echo esc_html($m->display_name); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <style>
        .lichting-search{display:flex;gap:.5rem;align-items:center;margin:1rem 0}
        .lichting-search input{flex:1;max-width:420px;padding:.5rem}
        .lichting-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1rem}
        .lichting-tile{border:1px solid #ddd;border-radius:12px;padding:1rem;background:#fff}
        .lichting-title{font-weight:700;margin-bottom:.5rem;display:flex;gap:.5rem;align-items:baseline}
        .members{margin:0;padding-left:1.1rem}
        .members li{margin:.25rem 0}
        .clear{margin-left:.5rem}
    </style>
    <?php
    return ob_get_clean();
});