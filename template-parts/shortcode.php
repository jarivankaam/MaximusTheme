<?php
$row_index = get_row_index();
$section_id = 'section-' . $row_index;
$section_selector = '#' . $section_id;

$shortcode = get_sub_field("shortcode");

?>

<section class="section-shortcode">
    <div class="container"> 
        <?= do_shortcode("[" . $shortcode . "]") ?>
    </div>
</section>