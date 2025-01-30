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

/* #Hooks */

/* Filter hooks */

// add a prefix on tool posts main titles
function filter_tool_article_titles($title)
{
    if (is_single() && in_category('Outils') && in_the_loop()) {
        return 'Outil: ' . $title;
    }

    return $title;
}

add_filter('the_title', 'filter_tool_article_titles');

// add a prefix on archive main title
function filter_archive_title($title)
{
    if (is_category()) {
        return 'Liste des ' . strtolower(single_cat_title('', false));
    }

    return $title;
}

add_filter('get_the_archive_title', 'filter_archive_title');

// modify tool category link in archive page
function filter_archive_categories_link($categories)
{
    return str_replace('Outils', 'Tous les outils', $categories);
}

add_filter('the_category', 'filter_archive_categories_link');

// add a title for tool description in tool pages
function filter_tool_page_content($content)
{
    if (is_single() && in_category('Outils')) {
        return '<hr><h2>Description</h2>' . $content;
    }

    return $content;
}

add_filter('the_content', 'filter_tool_page_content');

// add a more visual link, as a button, below all tool posts
function filter_archive_excerpt($content)
{
    if (is_archive()) {
        return $content . "<div class='more-excerpt'><a href='" . get_the_permalink() . "'>En savoir plus sur l'outil</a></div>";
    }

    return $content;
}

add_filter('the_excerpt', 'filter_archive_excerpt');

/* Action hooks */

// add banner-title shortcode below the Loop end of archive page
function action_add_title_banner_end_loop()
{
    if (is_archive()) : ?>
        <div class="after-loop">
            <?= do_shortcode("[banner-title title='BricoTips' src='/wp-content/uploads/2025/01/banniere-image.webp']"); ?>
        </div>
    <?php

    endif;
}

add_action('loop_end', 'action_add_title_banner_end_loop');

// add an introduction text before the first post title on archive page
$displayIntro = true;

function action_add_intro_before_posts()
{
    global $displayIntro;

    if (is_archive() && $displayIntro) : ?>
        <p class="archive-intro">Vous trouverez dans cette page la liste de tous les outils que nous avons référencés pour le
            moment. La liste n'est pas exhaustive, mais s'enrichira au fur et à mesure.</p>
<?php
        $displayIntro = false;
    endif;
}

add_action('bricotips_archive_intro', 'action_add_intro_before_posts');
