<?php
// image
$heroImage = get_field('image');

$title = get_the_title();
$content = get_the_content();


// Settings
$showBlogAside = get_field('show_blog_sidebar', 'options');
?>

<section id="section-1" class="section-blog-hero flex align-items-endpb-0 overflow-hidden">
    <?php if ($heroImage) : ?>
        <div class="image-wrapper">
            <img class="full-all" src=" <?= $heroImage['url'] ?>" alt=" <?= $heroImage['alt'] ?>">
        </div>
    <?php endif; ?>
</section>
<section class="section-blog-overview m-bot-50 m-top-100">
    <div class="container">
        <div class="row g-6 <?php if (!$showBlogAside) : ?>justify-content-center<?php endif; ?>">
            <div class="col-12 col-sm-12 col-md-12 col-lg-7">
                <?php if ($title) : ?>
                    <div class="content-wrapper maxtext">
                        <h1><?= get_the_title(); ?></h1>
                    </div>
                <?php endif; ?>
                <?php
                if( have_rows('content_blocks_blogs') ) {
                    while( have_rows('content_blocks_blogs') ) {
                        the_row(); // This advances the row
                        $layout = get_row_layout(); // Get the layout of the current row
                        get_template_part('template-parts/part/' . $layout); // Correct path and usage
                    }
                }
                ?>
            </div>
            <?php if ($showBlogAside) : ?>
                <div class="col-12 col-sm-12 col-md-12 col-lg-5">
                    <?php include_once(get_stylesheet_directory() . '/template-parts/pages/single/sidebar.php') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>