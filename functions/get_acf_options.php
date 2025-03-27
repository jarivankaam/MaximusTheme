<?php

function generate_dynamic_scss() {
    $scss_file = get_template_directory() . '/assets/scss/base/_acf-colors.scss';

    $primary   = get_field('primary_color', 'option') ?: '#000000';
    $secondary = get_field('secondary_color', 'option') ?: '#FFFFFF';
    $background = get_field('background_color', 'option') ?: '#F5F5F5';
    $button1 = get_field('button_color_1', 'option') ?: '#F5F5F5';
    $button2 = get_field('button_color_2', 'option') ?: '#F5F5F5';

    $scss_content = "
    \$primary-color: {$primary};
    \$secondary-color: {$secondary};
    \$button1-color: {$button1};
    \$background-color: {$background};
    \$button2-color: {$button2};
    ";

    file_put_contents($scss_file, $scss_content);
}

add_action('acf/save_post', 'generate_dynamic_scss');
