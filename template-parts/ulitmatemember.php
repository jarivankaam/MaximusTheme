<?php
$row_index = get_row_index();
$section_id = 'section-' . $row_index;
$section_selector = '#' . $section_id;

$form = get_sub_field("form_id");
?>

<section class="section-ultimatemember">
    <div class="container">
        [ultimatemember form_id="<?= $form ?>"]
    </div>
</section>
