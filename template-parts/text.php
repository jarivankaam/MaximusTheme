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

if (!empty($buttons)) {
    $buttonCount = count($buttons);
}

$use_image = get_sub_field('use_image');
$use_image2 = get_sub_field('use_image2');
$background = get_sub_field('background-color');
$color = get_sub_field('color');

// New WPForms fields
$use_form = get_sub_field('use_form');
$wpforms_form = get_sub_field('wpforms_form'); // expects a form ID

// New Video fields
$use_video = get_sub_field('use_video');
$video_url = get_sub_field('video_url');

// Function to convert YouTube watch URLs to embed URLs
if (!function_exists('convert_to_embed_url')) {
    function convert_to_embed_url($url) {
        if (strpos($url, 'youtube.com/watch') !== false || strpos($url, 'youtu.be/') !== false) {
            preg_match('/(youtu\.be\/|v=)([^&]+)/', $url, $matches);
            if (isset($matches[2])) {
                return 'https://www.youtube.com/embed/' . $matches[2];
            }
        }
        return $url;
    }
}

?>
<?php if ($background && $color): ?>
    <style>
        #<?= $section_id ?> {
            background: <?= $color ?>;
            padding-top: 100px;
            padding-bottom: 100px;
        }
    </style>
<?php endif; ?>

<section id="<?= $section_id ?>" class="section-text">
    <div class="container">
        <div class="row <?php if ($reverse_layout) : ?> flex-row-reverse <?php if (wp_is_mobile()) : ?>flex-column-reverse <?php endif ?> <?php endif ?>">
            
            <?php
            // Output video, image, or form in the left column (priority: video > image > form)
            if ($use_video && $video_url) :
                $embed_url = convert_to_embed_url($video_url);
            ?>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="video-wrapper" style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;">
                        <?php if (strpos($embed_url, 'youtube.com/embed') !== false): ?>
                            <iframe src="<?= esc_url($embed_url) ?>" frameborder="0" allowfullscreen
                                    style="position:absolute;top:0;left:0;width:100%;height:100%;">
                            </iframe>
                        <?php else: ?>
                            <video controls style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                <source src="<?= esc_url($embed_url) ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        <?php endif; ?>
                    </div>
                    <?php if (have_rows('buttons')) : ?>
                        <div class="cta-wrapper video flex <?php if ($buttonCount > 1) : ?> full-width-buttons <?php endif ?>">
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
            <?php elseif ($use_image && $image) : ?>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 <?php if ($use_image2) : ?> second-image-col flex<?php endif ?>">
                    <div class="image-wrapper">
                        <img src="<?= $image ?>" alt="image">
                    </div>
                    <?php if ($use_image2) : ?>
                        <div class="image-wrapper">
                            <img src="<?= $image2 ?>" alt="image">
                        </div>
                    <?php endif ?>
                </div>
            <?php elseif ($use_form && $wpforms_form) : ?>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="form-wrapper">
                        <?php echo do_shortcode('[wpforms id="' . $wpforms_form . '" title="false"]'); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($content): ?>
                <div class="col-12 <?php if (!$centered) : ?>col-sm-12 col-md-12 col-lg-6<?php endif ?>">
                    <div class="content-wrapper <?php if (!$centered): ?>maxtext <?php else: ?> flex flex-wrap<?php endif; ?>">
                        <?= $content ?>
                    </div>
                    <?php if (have_rows('buttons') && !$use_video) : ?>
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
