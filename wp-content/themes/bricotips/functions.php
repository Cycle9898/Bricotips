<?php
// load theme scripts
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_enqueue_styles()
{
    // load parent theme style
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    // load additional style(s)
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/CSS/theme.css', array(), filemtime(get_stylesheet_directory() . '/CSS/theme.css'));
}
