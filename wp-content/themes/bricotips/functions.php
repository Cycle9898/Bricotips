<?php
// load theme scripts
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_enqueue_styles()
{
    // load parent theme style
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
