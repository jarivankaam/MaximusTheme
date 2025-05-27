<?php
$row_index = get_row_index();
$section_id = 'section-' . $row_index;
$images = get_sub_field('images');
$total_images = is_array($images) ? count($images) : 0;
$images_per_page = 50;

// Get current page (default to 1)
$paged = (get_query_var('paged')) ? intval(get_query_var('paged')) : 1;

// Calculate total pages and current image slice
$total_pages = ceil($total_images / $images_per_page);
$offset = ($paged - 1) * $images_per_page;
$current_images = array_slice($images, $offset, $images_per_page);

$section_title = get_sub_field('title');

// Calculate column width
$col_count = $images_per_page > 0 ? floor(12 / min(count($current_images), 3)) : 12; // max 4 per row
?>

<section id="<?= esc_attr($section_id) ?>" class="section-gallery">
    <div class="container">
        <?php if ($section_title): ?>
            <div class="section-heading">
                <h2><?= esc_html($section_title) ?></h2>
            </div>
        <?php endif; ?>
        <?php if ($total_images > 0) : ?>
            <div class="row g-3">
                <?php foreach ($current_images as $image) : ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-<?= $col_count ?>">
                        <div class="image-wrapper overflow-hidden border-radius-10">
                            <img src="<?= esc_url($image['url']) ?>" alt="<?= esc_attr($image['alt']) ?>">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ($total_pages > 1) : ?>
                <div class="pagination-page-wrapper flex m-top-20">
                    <?php
                    echo paginate_links(array(
                        'base' => get_pagenum_link(1) . '%_%',
                        'format' => 'page/%#%',
                        'current' => $paged,
                        'total' => $total_pages,
                        'prev_text' => __('«', 'framework'),
                        'next_text' => __('»', 'framework'),
                    ));
                    ?>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <p><?= __('No images available.', 'framework') ?></p>
        <?php endif; ?>
    </div>
</section>
