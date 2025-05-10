<?php
$row_index = get_row_index();
$section_id = 'section-' . $row_index;
$section_selector = '#' . $section_id;

$title = get_sub_field("title");

?>

<section id="<?= esc_attr($section_id) ?>" class="section-title">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title__title"><?= esc_html($title) ?></h2>
            </div>
        </div>
    </div>
</section>