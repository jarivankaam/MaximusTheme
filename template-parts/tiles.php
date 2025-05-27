<?php
$row_index = get_row_index();
$section_id = 'section-' . $row_index;
$section_selector = '#' . $section_id;

$tiles = get_sub_field('tiles');
$section_title = get_sub_field('section_title');
$section_sub_content = get_sub_field('section_sub_content');
$partners = get_sub_field('partners');
$current = get_sub_field("current");
$db = get_field("current_db", "options");

$tileCount = count($tiles);
$col_count = $tileCount > 0 ? 12 / $tileCount : 12; // Prevent division by zero
$extra_col = $partners ? 1 : 0;
?>

<section id="<?= esc_attr($section_id) ?>" class="section-tiles <?= $partners ? 'partners' : '' ?>">
    <div class="container">
        <?php if ($section_title): ?>
            <div class="section-heading">
                <h2><?= esc_html($section_title) ?></h2>
                <?php if ($section_sub_content): ?>
                    <p class="m-bot-20"><?= $section_sub_content ?> Momenteel leidt Dagelijks Bestuur <?= $db ?> onze studentenvereniging.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <?php foreach ($tiles as $tile): ?>
                <div class="col-12 col-sm-12 col-md-12 col-lg- <?php if($partners && !$tile['icon']) : ?> <?= $col_count ?> <?php else: ?><?= round($col_count + $extra_col) ?><?php endif ?>">
                    <?php if (!empty($tile['title']) || !empty($tile['icon'])): ?>
                        <?php 
                        $use_link = $partners || !empty($tile['button']);
                        $tile_url = !empty($tile['button']) ? $tile['button'] : '#';
                        $wrapper_tag = $use_link ? 'a' : 'div';

                            if($current) {
                                $name = $tile['name'];
                                $email = $tile['email'];
                                $school = $tile['school'];
                            }
                        ?>

                        <<?= $wrapper_tag ?> <?= $use_link ? 'href="' . esc_url($tile_url) . '"' : '' ?> class="tile-wrapper flex justify-content-center">
                            <div class="content-wrapper border-radius-10 flex flex-column align-items-center justify-content-center">
                                <div class="image-wrapper  <?php if($partners && !$tile['icon']) : ?> text-based <?php endif ?>">
                                    <?php if($partners && !$tile['icon']) : ?>
                                    <h2><?= $tile['title'] ?></h2>
                                    <?php else : ?>
                                        <img src="<?= esc_url($tile['icon']) ?>" alt="icon">
                                    <?php endif ?>
                                </div>
                                <div class="maxtext flex flex-column align-items-center justify-content-center">
                                    <p class="bold"><?= esc_html($tile['title']) ?></p>
                                    <?php if($current) : ?>
                                        <p><?= $name ?></p>
                                        <p><?= $email ?></p>
                                        <p><?= $school ?></p>
                                    <?php else :?>
                                        <?php if (!empty($tile['content'])): ?>
                                            <p><?= esc_html($tile['content']) ?></p>
                                        <?php endif; ?>
                                    <?php endif ?>
                                </div>
                            </div>
                        </<?= $wrapper_tag ?>>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
