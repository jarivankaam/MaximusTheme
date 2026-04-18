<?php
$row_index         = get_row_index();
$section_id        = 'section-' . $row_index;
$section_title     = get_sub_field('title');
// Zorg voor fallback naar 'preview' wanneer veld leeg of niet gezet:
$display_mode      = get_sub_field('gallery_display_mode') ?: 'preview';
$read_more_label   = get_sub_field('read_more_label') ?: __( 'Meer', 'framework' );
$show_less_label   = __( 'Minder', 'framework' );
$type_of_page = get_sub_field('type_of_page');
$album = get_sub_field('album');

if(!$type_of_page) {
    $images = get_sub_field('images_preview');
} else {
    $images = get_sub_field('images');
}

$total_images      = is_array($images) ? count($images) : 0;
?>

<section id="<?= esc_attr( $section_id ) ?>"
         class="section-gallery <?php if($type_of_page): ?>mode-<?= esc_attr( $display_mode ) ?><?php endif; ?>">
    <div class="container">

        <?php if ( $section_title ) : ?>
            <div class="section-heading">
                <h2><?= esc_html( $section_title ) ?></h2>
            </div>
        <?php endif; ?>

        <?php if ( $total_images > 0 ) : ?>
            <div class="gallery-images">
                <div class="row g-3">
                    <?php foreach ( $images as $image ) : ?>
                        <div class="col-12 col-sm-6<?php if($type_of_page) : ?> col-md-4 col-lg-4 <?php else: ?> col-md-3 col-lg-3 <?php endif; ?> gallery-item">
                            <div class="image-wrapper overflow-hidden border-radius-10">
                                <img src="<?= esc_url( $image['url'] ) ?>"
                                     alt="<?= esc_attr( $image['alt'] ) ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php if(!$type_of_page && $album) : ?>
                <div class="cta-wrapper flex align-items-center justify-content-center">
                    <a href="<?= $album ?>" class="cta cta-secondary">Naar Album</a>
                 </div>
            <?php endif ?>

        <?php else: ?>
            <p><?= __( 'No images available.', 'framework' ) ?></p>
        <?php endif; ?>

    </div>
</section>
