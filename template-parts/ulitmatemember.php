<?php
$row_index = get_row_index();
$section_id = 'section-' . $row_index;
$section_selector = '#' . $section_id;

$form = get_sub_field("form_id");
?>

<section class="section-ultimatemember">
    <div class="container">
         <?php echo do_shortcode('[ultimatemember form_id="' . $form . '"]') ?>
    </div>
</section>
