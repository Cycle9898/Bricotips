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
    wp_enqueue_style('image-link-block-widget', get_stylesheet_directory_uri() . '/CSS/widgets/image-link-block-widget.css', array(), filemtime(get_stylesheet_directory() . '/CSS/widgets/image-link-block-widget.css'));
    // load shortcode(s) style
    wp_enqueue_style('banner-title-shortcode', get_stylesheet_directory_uri() . '/CSS/shortcodes/banner-title.css', array(), filemtime(get_stylesheet_directory() . '/CSS/shortcodes/banner-title.css'));
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

/* Load widgets */

// Image_Title_Widget
require_once(__DIR__ . "/widgets/ImageTitleWidget.php");
// Image_Link_Block_Widget
require_once(__DIR__ . "/widgets/ImageLinkBlockWidget.php");

function register_widgets()
{
    register_widget('Image_Title_Widget');
    register_widget('Image_Link_Block_Widget');
}

add_action('widgets_init', 'register_widgets');


/* Shortcodes */

// Image_banner shortcode
function banner_title_func($atts)
{
    // get attributes
    $atts = shortcode_atts(array(
        'src' => '',
        'title' => 'Titre'
    ), $atts, 'banner-title');

    // convert into text and return result
    ob_start();

    if ($atts['src'] != "") {
?>

        <div class="banner-title" style="background-image: url(<?= $atts['src'] ?>)">
            <h2 class="title"><?= $atts['title'] ?></h2>
        </div>

<?php
    }
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode('banner-title', 'banner_title_func');
