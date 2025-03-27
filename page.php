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


<?php get_header(); ?>

<main>

    <?php

    while ( have_posts() ) : the_post();

        if( have_rows('content_blocks') ) {
            while( have_rows('content_blocks') ) {
                the_row(); // This advances the row
                $layout = get_row_layout(); // Get the layout of the current row
                get_template_part('template-parts/' . $layout); // Correct path and usage
            }
        }


    endwhile;
    ?>

</main>

<?php get_footer(); ?>

</html>
