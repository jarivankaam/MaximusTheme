<?php
add_shortcode('lichting_directory', function () {
    if ( ! is_user_logged_in() ) {
        return '<p>You must be logged in to view this directory.</p>';
    }

    // --- Config (must match UM meta keys exactly) ---
    $meta_key_lichting = 'LichtingNew';
    $meta_key_commisie = 'Comissie';
    $meta_key_senaat   = 'senaat';

    $q = isset($_GET['q']) ? sanitize_text_field($_GET['q']) : '';

    /**
     * Normalize multiselect meta to array
     */
    $to_array = function ($raw): array {
        if (is_array($raw)) {
            $arr = $raw;
        } else {
            $maybe = maybe_unserialize($raw);
            if (is_array($maybe)) {
                $arr = $maybe;
            } else {
                $raw = trim((string)$raw);
                if ($raw === '') return [];
                $arr = preg_split('/\s*,\s*/', $raw);
            }
        }

        return array_values(array_filter(array_map(fn($v) => trim((string)$v), $arr)));
    };

    // Fetch users
    $users = get_users([
        'number' => 9999,
        'fields' => ['ID', 'display_name', 'user_login'],
    ]);

    // Search filter
    if ($q !== '') {
        $qq = mb_strtolower($q);
        $users = array_values(array_filter($users, function($u) use ($qq) {
            $dn = mb_strtolower((string)$u->display_name);
            $ul = mb_strtolower((string)$u->user_login);
            return str_contains($dn, $qq) || str_contains($ul, $qq);
        }));
    }

    // --- Lichting ---
    $grouped_lichting = [];
    foreach ($users as $u) {
        $lichting = trim((string)get_user_meta($u->ID, $meta_key_lichting, true));
        if ($lichting === '') continue;
        $grouped_lichting[$lichting][] = $u;
    }
    uksort($grouped_lichting, fn($a,$b) => strnatcasecmp($a,$b));

    // --- Commisie (multiselect) ---
    $grouped_commisie = [];
    foreach ($users as $u) {
        $commisies = $to_array(get_user_meta($u->ID, $meta_key_commisie, true));
        if (empty($commisies)) continue;

        foreach ($commisies as $c) {
            $grouped_commisie[$c][] = $u;
        }
    }
    uksort($grouped_commisie, fn($a,$b) => strnatcasecmp($a,$b));

    // --- Senaat (can be single or multiselect, handled automatically) ---
    $grouped_senaat = [];
    foreach ($users as $u) {
        $senaat_values = $to_array(get_user_meta($u->ID, $meta_key_senaat, true));
        if (empty($senaat_values)) continue;

        foreach ($senaat_values as $s) {
            $grouped_senaat[$s][] = $u;
        }
    }
    uksort($grouped_senaat, fn($a,$b) => strnatcasecmp($a,$b));

    ob_start();
    ?>
    <div class="member-directory">

        <form class="member-search" method="get">
            <input type="text" name="q" value="<?php echo esc_attr($q); ?>" placeholder="Zoek lid..." />
            <button type="submit">Zoeken</button>
            <?php if ($q !== ''): ?>
                <a class="clear" href="<?php echo esc_url(remove_query_arg('q')); ?>">Wissen</a>
            <?php endif; ?>
        </form>

        <!-- LICHTING -->
        <h2 class="grid-heading">Lichtingen</h2>
        <?php if (empty($grouped_lichting)): ?>
            <p>Geen leden met een lichting gevonden.</p>
        <?php else: ?>
            <div class="tile-grid">
                <?php foreach ($grouped_lichting as $lichting => $members): ?>
                    <div class="tile">
                        <div class="tile-title">
                            <?php echo esc_html($lichting); ?>
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
        <?php endif; ?>

        <!-- COMMISIE -->
        <h2 class="grid-heading">Commissies</h2>
        <?php if (empty($grouped_commisie)): ?>
            <p>Geen leden met een commissie gevonden.</p>
        <?php else: ?>
            <div class="tile-grid">
                <?php foreach ($grouped_commisie as $commisie => $members): ?>
                    <div class="tile">
                        <div class="tile-title">
                            <?php echo esc_html($commisie); ?>
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
        <?php endif; ?>

        <!-- SENAAT -->
        <h2 class="grid-heading">Dagelijks Bestuur</h2>
        <?php if (empty($grouped_senaat)): ?>
            <p>Geen leden met een senaat gevonden.</p>
        <?php else: ?>
            <div class="tile-grid">
                <?php foreach ($grouped_senaat as $senaat => $members): ?>
                    <div class="tile">
                        <div class="tile-title">
                            DB: <?php echo esc_html($senaat); ?>
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
        <?php endif; ?>

    </div>

    <style>
        .member-search{display:flex;gap:.5rem;align-items:center;margin:1rem 0}
        .member-search input{flex:1;max-width:420px;padding:.5rem}
        .clear{margin-left:.5rem}

        .grid-heading{margin:1.5rem 0 .75rem;font-size:1.3rem}
        .tile-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1rem}

        .tile{border:1px solid #ddd;border-radius:12px;padding:1rem;background:#fff}
        .tile-title{font-weight:700;margin-bottom:.5rem;display:flex;gap:.5rem;align-items:baseline}
        .members{margin:0;padding-left:1.1rem}
        .members li{margin:.25rem 0}
    </style>
    <?php
    return ob_get_clean();
});