<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 15,
    'paged' => $paged,
);

$loop = new WP_Query($args);

$post_page = get_option('page_for_posts');
$content_post = get_post($post_page);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
?>
<section class="blog-overview-section">
    <div class="container">
            <div class="section-heading m-bot-20 text-align-center m-bot-50 relative flex flex-column align-items-center">
               <div class="title-wrapper">
                    <h2><?= get_the_title(get_option('page_for_posts')) ?></h2>
               </div>
                <?php if ($content) : ?>
                    <div class="inner-wrapper m-top-20 maxtext">
                        <?= $content ?>
                    </div>
                <?php endif; ?>
            </div>
       
        <?php
        if ($loop->have_posts()) :
            $first = true;
            while ($loop->have_posts()) : $loop->the_post();
                $image = get_field('image');
                $title = get_the_title();
                $link = get_the_permalink();
                if ($first) {
                    $first = false;
        ?>
                    <?php if ($link) : ?>
                        <a href="<?= $link ?>" class="part-blog-wrapper first full-all overflow-hidden border-radius-10">
                            <?php if ($image) : ?>
                                <div class="image-wrapper">
                                    <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                                </div>
                            <?php endif; ?>
                            <?php if ($title) : ?>
                                <div class="content-wrapper">
                                    <h3><?= $title ?></h3>
                                    <?php $summary = get_field('summary');
                                    if (strlen($summary) > 300) {
                                        $summary = substr($summary, 0, 297) . '...';
                                    } ?>
                                    <p><?= $summary; ?></p>
                                    <div class="link-wrapper">
                                        <span class="icon icon-after icon-arrow-long-right"><?= __('Lees artikel', 'framework') ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
            <?php
                }
            endwhile;
            wp_reset_postdata();
            $first = true;
            ?>

            <div class="row g-3">
                <?php
                while ($loop->have_posts()) : $loop->the_post();
                    $image = get_field('image');
                    $title = get_the_title();
                    $link = get_the_permalink();
                    if ($first) {
                        $first = false;
                    } else {

                ?>
                        <?php if ($link) : ?>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                                <a href="<?= get_the_permalink() ?>" class="part-blog-wrapper full-all overflow-hidden border-radius-10">
                                    <?php if ($image) : ?>
                                        <div class="image-wrapper">
                                            <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($title) : ?>
                                        <div class="content-wrapper">
                                            <h5><?= $title ?></h5>
                                            <div class="link-wrapper">
                                                <span class="icon icon-after icon-arrow-long-right"><?php _e('Lees artikel', 'framework') ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                <?php
                    }

                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php
        endif;
        ?>
        <div class="pagination-page-wrapper flex m-bot-20 m-top-20">
            <?php
            $total_pages = $loop->max_num_pages;
            if ($total_pages > 1) {
                $current_page = max(1, get_query_var('paged'));
                echo paginate_links(array(
                    'base' => get_pagenum_link(1) . '%_%',
                    'format' => '/page/%#%',
                    'current' => $current_page,
                    'total' => $total_pages,
                    'prev_text'    => __(''),
                    'next_text'    => __(''),
                ));
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>