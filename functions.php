<?php
require_once('functions/get_content_blocks.php');
require_once('functions/get_button.php');
require_once('functions/get_acf_options.php');
require_once('functions/get_birthdays.php');

// Register navigation menus.
function register_my_menus() {
    register_nav_menus(
        array(
            'primary-left' => 'Primary Menu left',
            'primary-right' => 'Primary Menu Right',
            'footer' => 'Footer Menu'
        )
    );
}
add_action( 'init', 'register_my_menus' );

// Define plugin directory path.
define( 'MY_PLUGIN_DIR_PATH', untrailingslashit(get_template_directory_uri()) );

// Change the save point for ACF JSON.
function my_acf_json_save_point( $path ) {
    return get_stylesheet_directory() . '/acf-json';
}
add_filter('acf/settings/save_json', 'my_acf_json_save_point');

// Enqueue custom JavaScript properly.


// Add viewport meta tag and Font Awesome kit in the header.
function mytheme_add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">';
    echo '<script src="https://kit.fontawesome.com/79f79ff0fc.js" crossorigin="anonymous"></script>';
    echo '<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>';
    echo `<script>window.$ujq=window.$ujq||[];window.uj=window.uj||new Proxy({},{get:(_,p)=>(...a)=>window.$ujq.push([p,...a])});document.head.appendChild(Object.assign(document.createElement('script'),{src:'https://cdn.userjot.com/sdk/v2/uj.js',type:'module',async:!0}));</script>`;
    echo `<script>window.uj.init('cmjsx3v7l056w15ldonq8h2o7', {widget: true,position: 'right',theme: 'auto'});</script>`;
}
add_action( 'wp_head', 'mytheme_add_viewport_meta_tag' );

function enqueue_custom_scripts() {
    wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/index.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_scripts' );

wp_enqueue_style('livenow-style', get_stylesheet_uri(), array(), filemtime(get_stylesheet_directory() . '/style.css'));
?>
