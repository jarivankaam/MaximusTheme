<?php
$row_index         = get_row_index();
$section_id        = 'section-' . $row_index;
$images            = get_sub_field('images');
$total_images      = is_array($images) ? count($images) : 0;
$section_title     = get_sub_field('title');
// Zorg voor fallback naar 'preview' wanneer veld leeg of niet gezet:
$display_mode      = get_sub_field('gallery_display_mode') ?: 'preview';
$read_more_label   = get_sub_field('read_more_label') ?: __( 'Read More', 'framework' );
$show_less_label   = __( 'Show Less', 'framework' );
?>

<section id="<?= esc_attr( $section_id ) ?>"
         class="section-gallery mode-<?= esc_attr( $display_mode ) ?>">
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
                        <div class="col-12 col-sm-6 col-md-4 gallery-item">
                            <div class="image-wrapper overflow-hidden border-radius-10">
                                <img src="<?= esc_url( $image['url'] ) ?>"
                                     alt="<?= esc_attr( $image['alt'] ) ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php if ( $display_mode === 'preview' && $total_images > 3 ) : ?>
                <button class="read-more-btn">
                    <?= esc_html( $read_more_label ) ?>
                </button>
            <?php endif; ?>

        <?php else: ?>
            <p><?= __( 'No images available.', 'framework' ) ?></p>
        <?php endif; ?>

    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        document.querySelectorAll('.section-gallery.mode-preview').forEach(function(section){
            const gallery   = section.querySelector('.gallery-images');
            const items     = gallery.querySelectorAll('.gallery-item');
            const btn       = section.querySelector('.read-more-btn');
            const previewN  = 3;
            let isExpanded  = false;
            let previewMaxH = 0;

            function calcPreviewHeight(){
                let h = 0;
                const gap = 0; // Bootstrap gebruikt padding, dus we negeren gap hier
                items.forEach((item,i) => {
                    const ih = item.getBoundingClientRect().height;
                    if (i < previewN) {
                        h += ih + gap;
                    } else if (i === previewN) {
                        h += ih * 0.3; // 30% van de 4e
                    }
                });
                return h;
            }

            function collapse(){
                previewMaxH = calcPreviewHeight();
                gallery.style.maxHeight = previewMaxH + 'px';
                section.classList.add('collapsed');
                btn.textContent = '<?= esc_js( $read_more_label ); ?>';
            }

            function expand(){
                gallery.style.maxHeight = gallery.scrollHeight + 'px';
                section.classList.remove('collapsed');
                btn.textContent = '<?= esc_js( $show_less_label ); ?>';
            }

            if ( items.length > previewN ){
                // initialiseren
                window.addEventListener('load', collapse);
                window.addEventListener('resize', collapse);

                btn.addEventListener('click', function(){
                    isExpanded ? collapse() : expand();
                    isExpanded = !isExpanded;
                });
            }
        });
    });
</script>
