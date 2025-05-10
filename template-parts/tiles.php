<?php
$row_index = get_row_index();
$section_id = 'section-' . $row_index;
$section_selector = '#' . $section_id;

$tiles = get_sub_field('tiles');
$section_title = get_sub_field('section_title');
$section_sub_content = get_sub_field('section_sub_content');
$partners = get_sub_field('partners');

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
                    <p class="m-top-20"><?= esc_html($section_sub_content) ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <?php foreach ($tiles as $tile): ?>
                <div class="col-12 col-sm-12 col-md-12 col-lg-<?= round($col_count + $extra_col) ?>">
                    <?php if (!empty($tile['title']) || !empty($tile['icon'])): ?>
                        <?php 
                        $use_link = $partners || !empty($tile['button']);
                        $tile_url = !empty($tile['button']) ? $tile['button'] : '#';
                        $wrapper_tag = $use_link ? 'a' : 'div';
                        ?>

                        <<?= $wrapper_tag ?> <?= $use_link ? 'href="' . esc_url($tile_url) . '"' : '' ?> class="tile-wrapper flex justify-content-center">
                            <div class="content-wrapper border-radius-10 flex flex-column align-items-center justify-content-center">
                                <?php if (!empty($tile['icon'])): ?>
                                    <div class="image-wrapper">
                                        <img src="<?= esc_url($tile['icon']) ?>" alt="icon">
                                    </div>
                                <?php endif; ?>

                                <div class="maxtext flex flex-column align-items-center justify-content-center">
                                    <p class="bold"><?= esc_html($tile['title']) ?></p>
                                    <?php if (!empty($tile['content'])): ?>
                                        <p><?= esc_html($tile['content']) ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </<?= $wrapper_tag ?>>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
