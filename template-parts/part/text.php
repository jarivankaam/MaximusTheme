<?php
$row_index = get_row_index();
$section_id = 'section-' . $row_index;
$section_selector = '#' . $section_id;

$content = get_sub_field('content');



?>
<section id="<?= $section_id ?>" class="section-text">
        <?php if($content): ?>
            <div class="content-wrapper flex flex-wrap">
                <?= $content ?>
            </div>
        <?php endif; ?>
</section>
