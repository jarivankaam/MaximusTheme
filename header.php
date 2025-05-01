<?php
$logo = get_field('header_logo', 'options');
$buttons = get_field("buttons", "options");
$slogan = get_field("slogan", "options");
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    <script src="https://kit.fontawesome.com/79f79ff0fc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_uri() ); ?>" type="text/css" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header  class="site-header">
        <div class="red-bar"></div>
        <div class="relative">
        
            <div class="container">
                <div class="header-wrapper flex align-center justify-space-between">
                    <div class=" <?php if (wp_is_mobile()) : ?>col-middle <?php else : ?>col-left<?php endif; ?> flex align-center">
                        <div class="main-menu col-menu flex h-100 align-items-end">
                            <?php
                                wp_nav_menu( array(
                                'theme_location'  => 'primary-left', // Make sure 'primary' matches the identifier used in register_nav_menus
                                'container'       => 'nav',     // Wraps the menu in <nav> tags
                                'container_class' => 'primary-menu', // Class for the container
                                'menu_class'      => 'nav-items',     // Class for the <ul> element
                                'fallback_cb'     => false            // Do not fall back to wp_page_menu()
                                ) );
                                ?>
                                <span class="desktop-hide">
                                <?php
                                wp_nav_menu( array(
                                'theme_location'  => 'primary-right', // Make sure 'primary' matches the identifier used in register_nav_menus
                                'container'       => 'nav',     // Wraps the menu in <nav> tags
                                'container_class' => 'primary-menu', // Class for the container
                                'menu_class'      => 'nav-items',     // Class for the <ul> element
                                'fallback_cb'     => false            // Do not fall back to wp_page_menu()
                                ) );
                                ?>
                                </span>
                                <ul class="mobile-hide">
                                    <?php if($buttons) : ?>
                                        <li class="cta-wrapper ">
                                            <?php foreach($buttons as $button) : ?>
                                                <a href="<?= $button['url']['url'] ?>"><?= $button['url']['title'] ?></a>
                                            <?php endforeach ?>
                                        </li>
                                    <?php endif ?>
                                </ul>
                        </div>
                        <div class="col-logo">
                            <a href="<?php echo get_bloginfo('url'); ?>" rel="home">
                                <?php if($logo) : ?>
                                    <img src="<?= $logo ?>" alt="<?= get_bloginfo('name'); ?> - Logo">
                                <?php else : ?>
                                    <?php echo get_bloginfo('name'); ?>
                                <?php endif ?>
                            </a>
                            <?php if($slogan) : ?>
                                <p class="slogan mobile-hide"><?= $slogan ?></p>
                            <?php endif ;?>
                        </div>
                        <div class="main-menu col-menu flex h-100 align-items-end mobile-hide">
                            <?php
                                wp_nav_menu( array(
                                'theme_location'  => 'primary-right', // Make sure 'primary' matches the identifier used in register_nav_menus
                                'container'       => 'nav',     // Wraps the menu in <nav> tags
                                'container_class' => 'primary-menu', // Class for the container
                                'menu_class'      => 'nav-items',     // Class for the <ul> element
                                'fallback_cb'     => false            // Do not fall back to wp_page_menu()
                                ) );
                                ?>
                                <ul class="mobile-hide">
                                    <?php if($buttons) : ?>
                                        <li class="cta-wrapper ">
                                            <?php foreach($buttons as $button) : ?>
                                                <a href="<?= $button['url']['url'] ?>"><?= $button['url']['title'] ?></a>
                                            <?php endforeach ?>
                                        </li>
                                    <?php endif ?>
                                </ul>
                        </div>
                        <div class="desktop-hide">
                            <i class="fa-solid fa-bars wpr-mobile-toggle burger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="post-<?php the_ID(); ?>" <?php post_class('wrapper'); ?>>
        <?php if (!is_front_page()) : ?>
            <section id="breadcrumbs"
                     class="section-breadcrumbs p-top-30 m-bot-30 pb-0 header-crumbs <?php if (is_single()) : ?>absolute top<?php endif; ?>">
                <div class="container">
                    <?php yoast_breadcrumb('<div class="breadcrumbs">', '</div>'); ?>
                </div>
            </section>
        <?php endif; ?>
