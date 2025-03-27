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
<section id="breadcrumbs" class="section-breadcrumbs blog m-top-30 m-bot-30 pb-0 mobile-hide">
    <div class="container">
        <?php yoast_breadcrumb('<div class="breadcrumbs">', '</div>'); ?>
    </div>
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
                if (have_rows('flexibele_content')) :
                    while (have_rows('flexibele_content')) : the_row();
                        get_template_part('/template-parts/pages/single/parts/' . get_row_layout());
                    endwhile;
                endif;
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