<?php
$row_index = get_row_index();
$section_id = 'section-' . $row_index;
$section_selector = '#' . $section_id;

$form = get_sub_field("form_id");
$reset = get_sub_field('reset');
?>

<section class="section-ultimatemember">
    <div class="container">
        <?php if($reset) : ?>
            [ultimatemember_password]
        <?php else: ?>
            <?php echo do_shortcode('[ultimatemember form_id="' . $form . '"]') ?>
        <?php endif; ?>
    </div>
</section>
