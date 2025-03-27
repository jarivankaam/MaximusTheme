<?php
function getButton($acfField, $classes, $buttonType)
{


    if (!$acfField) {
        return false;
    } else {
        $link_url = $acfField['url'];
        $link_title = $acfField['title'];
        $link_target = $acfField['target'] ? $acfField['target'] : '_self';

        if (!$buttonType) {
            $classes .= 'cta cta-secondary';
        } else {
            $classes .= 'cta';
        }





        return '<a class="' . $classes . '" href="' . esc_url($link_url) . '" target="' . esc_attr($link_target) . '">' . esc_html($link_title) . '</a>';
    }
}
