<?php
/* Load theme scripts */

function theme_enqueue_styles()
{
    // load parent theme style
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    // load additional style(s)
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/CSS/theme.css', array(), filemtime(get_stylesheet_directory() . '/CSS/theme.css'));
    // load widget(s) style
    wp_enqueue_style('image-title-widget', get_stylesheet_directory_uri() . '/CSS/widgets/image-title-widget.css', array(), filemtime(get_stylesheet_directory() . '/CSS/widgets/image-title-widget.css'));
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

/* Load widgets */

// Image_Title_Widget
require_once(__DIR__ . "/widgets/ImageTitleWidget.php");

function register_widgets()
{
    register_widget('Image_Title_Widget');
}

add_action('widgets_init', 'register_widgets');
