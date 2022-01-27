<?php

/*-----------------------------------------------------------------------------------

    Here we have all the custom functions for the theme
    Please be extremely cautious editing this file,
    When things go wrong, they tend to go wrong in a big way.
    You have been warned!

-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*  Register WP3.0+ Menus
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'tz_register_menu' ) ) {
    function tz_register_menu() {
        register_nav_menu('primary-menu', __('Primary Menu'));
        register_nav_menu('secondary-menu', __('Secondary Menu'));
    }

    add_action('init', 'tz_register_menu');
}

/*-----------------------------------------------------------------------------------*/
/*  Load Translation Text Domain
/*-----------------------------------------------------------------------------------*/

load_theme_textdomain( 'framework' );


/*-----------------------------------------------------------------------------------*/
/*  Set Max Content Width (use in conjuction with ".entry-content img" css)
/*-----------------------------------------------------------------------------------*/

if( ! isset( $content_width ) ) $content_width = 560;


/*-----------------------------------------------------------------------------------*/
/*  Post Formats
/*-----------------------------------------------------------------------------------*/

$formats = array(
            'aside',
            'audio',
            'gallery',
            'image',
            'link',
            'quote',
            'video');

add_theme_support( 'post-formats', $formats );


/*-----------------------------------------------------------------------------------*/
/*  Register Sidebars
/*-----------------------------------------------------------------------------------*/

if( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'id' => 'sidebar-1',
        'name' => 'Main Sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Footer Left Column Sidebar',
        'id' => 'left-footer-column-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Footer Center Column Sidebar',
        'id' => 'center-footer-column-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Footer Right Column Sidebar',
        'id' => 'right-footer-column-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Footer Affiliations Sidebar',
        'id' => 'footer-affiliations-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => 'Home Image Callout Sidebar',
        'id' => 'home-callout-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<span class="widget-title">',
        'after_title' => '</span>',
    ));
}


/*-----------------------------------------------------------------------------------*/
/*  Configure WP2.9+ Thumbnails
/*-----------------------------------------------------------------------------------*/

if( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 50, 50, true ); // Normal post thumbnails
    add_image_size( 'thumbnail-large', 560, '', false); // for blog pages
    add_image_size( 'portfolio-thumb', 220, 140, true); // for the portfolio template
    add_image_size( 'portfolio-main', 940, '', false); // for the single portfolio page
}


/*-----------------------------------------------------------------------------------*/
/*  Custom Gravatar Support
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'tz_custom_gravatar' ) ) {
    function tz_custom_gravatar( $avatar_defaults ) {
        $tz_avatar = get_template_directory_uri() . '/images/gravatar.png';
        $avatar_defaults[$tz_avatar] = 'Custom Gravatar (/images/gravatar.png)';
        return $avatar_defaults;
    }

    add_filter( 'avatar_defaults', 'tz_custom_gravatar' );
}

/*-----------------------------------------------------------------------------------*/
/*  Change Default Excerpt Length
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'tz_excerpt_length' ) ) {
    function tz_excerpt_length($length) {
        return 35;
    }

    add_filter('excerpt_length', 'tz_excerpt_length');
}


/*-----------------------------------------------------------------------------------*/
/*  Configure Excerpt String
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'tz_excerpt_more' ) ) {
    function tz_excerpt_more($excerpt) {
        return str_replace('[...]', '...', $excerpt);
    }

    add_filter('wp_trim_excerpt', 'tz_excerpt_more');
}


/*-----------------------------------------------------------------------------------*/
/*  Register and load front end JS
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'tz_enqueue_scripts' ) ) {
    function tz_enqueue_scripts() {
        // Register our scripts
        // comment out the next two lines to load the local copy of jQuery
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
        wp_register_script('validation', 'https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', 'jquery');
        wp_register_script('superfish', get_template_directory_uri() . '/js/superfish.js', 'jquery', '1.0', TRUE);
        wp_register_script('tz_custom', get_template_directory_uri() . '/js/jquery.custom.js', array('jquery', 'slides', 'isotope', 'superfish'), '1.0', TRUE);
        wp_register_script('jPlayer', get_template_directory_uri() . '/js/jquery.jplayer.min.js', 'jquery', '2.1', TRUE);
        wp_register_script('slides', get_template_directory_uri() . '/js/slides.min.jquery.js', 'jquery', '1.1.9', TRUE);
        wp_register_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', 'jquery', '1.5.03', TRUE);
        wp_register_script('columnizer', get_template_directory_uri() . '/js/jquery.columnizer.min.js', 'jquery', '1.5', TRUE);

        // Enqueue our scripts
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('jquery-ui-accordion');
        wp_enqueue_script('superfish');
        wp_enqueue_script('tz_custom');

        // load jPlayer on appropriate pages
        if( is_home() || ('portfolio' == get_post_type()) || has_post_format('video') || has_post_format('audio') ) {
            wp_enqueue_script('jPlayer');
        }

        // load SlidesJS on appropriate pages
        if( is_home() || is_page_template( 'template-home.php' ) || ( 'portfolio' == get_post_type() ) || has_post_format('gallery') ) {
            wp_enqueue_script('slides');
        }

        // load Isotope on the portolio template page
        if( is_page_template( 'template-portfolio.php' ) ) {
            wp_enqueue_script('isotope');
        }

        // load columnnizer on the correct page
        if( get_post_type() == 'portfolio' ) {
            wp_enqueue_script('columnizer');
        }

        // load single scripts only on single pages
        if( is_singular() ) wp_enqueue_script( 'comment-reply' ); // loads the javascript required for threaded comments

        // load custom script which shows on the contact page.
        if (is_page_template('template-contact.php') ) wp_enqueue_script('validation');
    }

    add_action('wp_enqueue_scripts', 'tz_enqueue_scripts');
}

if( !function_exists( 'tz_contact_validate' ) ) {
    // load validation js for contact form template
    function tz_contact_validate() {
        if (is_page_template('template-contact.php')) { ?>
            <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery("#contactForm").validate();
                });
            </script>
        <?php }
    }

    add_action('wp_head', 'tz_contact_validate');
}


/*-----------------------------------------------------------------------------------*/
/*  Register and load admin javascript
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'tz_admin_js' ) ) {
    function tz_admin_js($hook) {
        if ($hook == 'post.php' || $hook == 'post-new.php') {
            wp_register_script('tz-admin', get_template_directory_uri() . '/js/jquery.custom.admin.js', 'jquery');
            wp_enqueue_script('tz-admin');
        }
    }

    add_action('admin_enqueue_scripts','tz_admin_js',10,1);
}


/*-----------------------------------------------------------------------------------*/
/*  Add Browser Detection Body Class
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'tz_browser_body_class' ) ) {
    function tz_browser_body_class($classes) {
        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

        if($is_lynx) $classes[] = 'lynx';
        elseif($is_gecko) $classes[] = 'gecko';
        elseif($is_opera) $classes[] = 'opera';
        elseif($is_NS4) $classes[] = 'ns4';
        elseif($is_safari) $classes[] = 'safari';
        elseif($is_chrome) $classes[] = 'chrome';
        elseif($is_IE){
            $classes[] = 'ie';
            if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version)) $classes[] = 'ie'.$browser_version[1];
        } else $classes[] = 'unknown';

        if($is_iphone) $classes[] = 'iphone';
        return $classes;
    }

    add_filter('body_class','tz_browser_body_class');
}


/*-----------------------------------------------------------------------------------*/
/*  Comment Styling
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'tz_comment' ) ) {
    function tz_comment($comment, $args, $depth) {

        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

            <div id="comment-<?php comment_ID(); ?>">
                <?php echo get_avatar($comment,$size='35'); ?>
                <div class="comment-author vcard">
                    <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
                </div>

                <div class="comment-meta commentmetadata">
                    <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'framework'), get_comment_date(),  get_comment_time()) ?></a>
                    <?php edit_comment_link(__('(Edit)', 'framework'),'  ','') ?> &middot; <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>

                <?php if ($comment->comment_approved == '0') : ?>
                    <em class="moderation"><?php _e('Your comment is awaiting moderation.', 'framework') ?></em>
                    <br />
                <?php endif; ?>

                <div class="comment-body">
                    <?php comment_text() ?>
                </div>

            </div>

    <?php
    }
}


/*-----------------------------------------------------------------------------------*/
/*  Seperated Pings Styling
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'tz_list_pings' ) ) {
    function tz_list_pings($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment; ?>
        <li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
        <?php
    }
}


/*-----------------------------------------------------------------------------------*/
/*  Custom Login Logo Support
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'tz_custom_login_logo' ) ) {
    function tz_custom_login_logo() {
        echo '<style type="text/css">
            h1 a {
                background-image:url(' . get_template_directory_uri() . '/images/logo_login.png) !important;
                background-size: 245px 144px !important;
                background-position: center top !important;
                background-repeat: no-repeat !important;
                width: 245px !important;
                height: 144px !important;
                margin: 0 auto 25px !important;
                padding: 0 !important;
                text-indent: -9999px !important;
                outline: 0 !important;
                overflow: hidden !important;
                display: block !important;
            }
        </style>';
    }

    add_action('login_head', 'tz_custom_login_logo');
}

if( !function_exists( 'tz_wp_login_url' ) ) {
    function tz_wp_login_url() { return home_url(); }

    add_filter('login_headerurl', 'tz_wp_login_url');
}

if( !function_exists( 'tz_wp_login_title' ) ) {
    function tz_wp_login_title() { return get_option('blogname'); }

    add_filter('login_headertitle', 'tz_wp_login_title');
}


/*-----------------------------------------------------------------------------------*/
/*  Load Widgets & Shortcodes
/*-----------------------------------------------------------------------------------*/

// Add the Latest Tweets Custom Widget
include("functions/widget-tweets.php");

// Add the Flickr Photos Custom Widget
include("functions/widget-flickr.php");

// Add the Custom Video Widget
include("functions/widget-video.php");

// Add Custom Blog Posts Widget
include('functions/widget-blogposts.php');

// Add Custom Recent Portfolios Widget
include('functions/widget-recentportfolios.php');

// Add the Theme Shortcodes
include("functions/theme-shortcodes.php");

// Add the post meta
include("functions/theme-postmeta.php");
include('functions/theme-portfoliometa.php');

// Add the post types
include("functions/theme-posttypes.php");

/*-----------------------------------------------------------------------------------*/
/*  Filters that allow shortcodes in Text Widgets
/*-----------------------------------------------------------------------------------*/

add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/*  Load Theme Options
/*-----------------------------------------------------------------------------------*/

define('TZ_FILEPATH', TEMPLATEPATH);
define('TZ_DIRECTORY', get_template_directory_uri());

require_once (TZ_FILEPATH . '/admin/admin-functions.php');
require_once (TZ_FILEPATH . '/admin/admin-interface.php');
require_once (TZ_FILEPATH . '/functions/theme-options.php');
require_once (TZ_FILEPATH . '/functions/theme-functions.php');
require_once (TZ_FILEPATH . '/tinymce/tinymce.loader.php');
/**
 * Disables auto-activation of Jetpack modules
 * See: http://jetpack.me/2013/10/07/do-not-automatically-activate-a-jetpack-module/
 */
add_filter('jetpack_get_default_modules', '__return_empty_array');

/**
 * Don't check Publicize by default
 */
if (defined('VIA_ENVIRONMENT') && VIA_ENVIRONMENT === 'dev') {
    add_filter('publicize_checkbox_default', '__return_false');
}