<?php
$phone_nl = get_field('phone', 'options');
$phone_be = get_field('phone_be', 'options');
$email = get_field('email', 'options');
$relatedPosts = wpml_get_related_posts();

?>

<div class="aside-wrapper">
    <div class="sticky-wrapper">
        <div class="contact-detail-wrapper m-bot-50">
            <div class="content-wrapper m-bot-50">
                <h3><?php _e('Vragen of meer informatie', 'framework'); ?></h3>
            </div>
            <div class="cta-wrapper flex flex-wrap">
                <div class="inner-wrapper">
                    <div class="cta-wrapper">
                        <a href="<?= get_home_url() ?>/contact" class="cta"><?php _e('Neem contact op', 'framework') ?></a>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($relatedPosts) : ?>
            <div class="related-posts-wrapper mobile-hide">
                <h4><?php _e('Gerelateerde artikelen', 'framework') ?></h4>

                <?php foreach ($relatedPosts as $post) : setup_postdata($post) ?>
                    <?php $thumbImage = get_field('image');
                    $link = get_the_permalink();
                    $title = get_the_title();
                    ?>
                    <?php if ($link) : ?>
                        <a href="<?= $link ?>" class="related-post-wrapper overflow-hidden border-radius-10 flex full-all">
                            <?php if ($thumbImage) : ?>
                                <div class="image-wrapper">
                                    <img class="object-cover full-all" src="<?= $thumbImage['url'] ?>" />
                                </div>
                            <?php endif; ?>
                            <?php if ($title) : ?>
                                <div class="content-wrapper">
                                    <strong><?= $title ?></strong>
                                </div>
                            <?php endif; ?>

                        </a>
                    <?php endif; ?>
                <?php endforeach;
                wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>