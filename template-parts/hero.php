<?php
$row_index = get_row_index();
$section_id = 'section-' . $row_index;
$section_selector = '#' . $section_id;

$title = get_sub_field('hero_title');


$subtext = get_sub_field('hero_content');


$buttons = get_sub_field('buttons');
$hero_image = get_sub_field('image');
$useImage = get_sub_field('use_image');
$hero_color = get_sub_field('hero_color');

if(!empty($buttons)) {
    $buttonCount = count($buttons);
};

?>

<?php if(!$useImage): ?>
<style>
    .color-wrapper {
        background: <?= $hero_color ?>;
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
    }
</style>
<?php endif; ?>

<section id="<?= $section_id; ?>" class="section-hero <?php if(!is_front_page()): ?> m-bot-50 <?php endif ?>">
    <?php if($useImage): ?>
        <div class="image-wrapper">
            <img src="<?= $hero_image ?>" alt="hero image">
        </div>
    <?php else: ?>
        <div class="color-wrapper"></div>
    <?php endif ?>
    <div class="container">
        <div class="row">
            <?php if($title) : ?>
                <div class="col-12 <?php if($hero_image): ?>col-sm-12 col-md-12 col-lg-6 <?php endif ?>">
                    <div class="content-wrapper maxtext <?php if(is_front_page()): ?> frontpage <?php endif ?>">
                        <h1><?= $title ?></h1>
                        <div class="subtext">
                            <p><?= $subtext ?></p>
                        </div>
                        <?php if (have_rows('buttons')) : ?>
                            <div class="cta-wrapper flex <?php if ($buttonCount > 1) : ?> full-width-buttons <?php endif ?>">
                                <?php while (have_rows('buttons')) : the_row(); ?>
                                    <?php $button = get_sub_field('button');
                                    $button_type = get_sub_field('button_type'); ?>
                                    <?= getButton($button, '', $button_type); ?>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif ?>
         </div>
    </div>
</section>