<?php
$row_index = get_row_index();
$section_id = 'section-' . $row_index;
$section_selector = '#' . $section_id;

$image = get_sub_field('image');
$image2 = get_sub_field('image2');
$content = get_sub_field('content');
$buttons = get_sub_field('buttons');
$reverse_layout = get_sub_field('layout');
$centered = get_sub_field('centered');
if(!empty($buttons)) {
    $buttonCount = count($buttons);
};

$use_image = get_sub_field('use_image');
$use_image2 = get_sub_field('use_image2');
$background = get_sub_field('background-color');
$color = get_sub_field('color');

// New WPForms fields
$use_form = get_sub_field('use_form');
$wpforms_form = get_sub_field('wpforms_form'); // expects a form ID
?>
<?php if($background && $color): ?>
    <style>
        #<?= $section_id ?> {
            background: <?= $color ?>;
            padding-top: 100px;
            padding-bottom: 100px;
        }
    </style>
<?php endif ?>

<section id="<?= $section_id ?>" class="section-text">
    <div class="container">
        <div class="row <?php if($reverse_layout) : ?> flex-row-reverse <?php if(wp_is_mobile()) : ?>flex-column-reverse <?php endif ?> <?php endif ?>">
            <?php
            // Output image or form in the left column (mutually exclusive)
            if($use_image && $image) : ?>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 <?php if($use_image2) : ?> second-image-col flex<?php endif ?>">
                    <div class="image-wrapper">
                        <img src="<?= $image ?>" alt="image">
                    </div>
                    <?php if($use_image2) : ?>
                        <div class="image-wrapper">
                        <img src="<?= $image2 ?>" alt="image">
                        </div>
                    <?php endif ?>
                </div>
            <?php elseif($use_form && $wpforms_form) : ?>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="form-wrapper">
                        <?php echo do_shortcode('[wpforms id="' . $wpforms_form . '" title="false"]'); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($content): ?>
                <div class="col-12 <?php if(!$centered) : ?>col-sm-12 col-md-12 col-lg-6<?php endif ?>">
                    <div class="content-wrapper <?php if(!$centered): ?>maxtext <?php else: ?> flex flex-wrap<?php endif;?>">
                        <?= $content ?>
                    </div>
                    <?php if (have_rows('buttons')) : ?>
                        <div class="cta-wrapper flex <?php if ($buttonCount > 1) : ?> full-width-buttons <?php endif ?>">
                            <?php while (have_rows('buttons')) : the_row(); ?>
                                <?php
                                $button = get_sub_field('button');
                                $button_type = get_sub_field('button_type');
                                ?>
                                <?= getButton($button, '', $button_type); ?>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
