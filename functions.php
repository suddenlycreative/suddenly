<?php

/**
 * technix functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package technix
 */

if ( !function_exists( 'technix_setup' ) ):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function technix_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on technix, use a find and replace
         * to change 'technix' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'technix', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( [
            'main-menu' => esc_html__( 'Main Menu', 'technix' ),
            'footer-menu' => esc_html__( 'Footer Menu', 'technix' ),
        ] );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ] );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'technix_custom_background_args', [
            'default-color' => 'ffffff',
            'default-image' => '',
        ] ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        //Enable custom header
        add_theme_support( 'custom-header' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', [
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ] );

        /**
         * Enable suporrt for Post Formats
         *
         * see: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', [
            'image',
            'audio',
            'video',
            'gallery',
            'quote',
        ] );

        // Add support for Block Styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for editor styles.
        add_theme_support( 'editor-styles' );

        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );

        remove_theme_support( 'widgets-block-editor' );

        add_image_size( 'technix-case-details', 1170, 600, [ 'center', 'center' ] );
    }
endif;
add_action( 'after_setup_theme', 'technix_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function technix_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'technix_content_width', 640 );
}
add_action( 'after_setup_theme', 'technix_content_width', 0 );



/**
 * Enqueue scripts and styles.
 */

define( 'TECHNIX_THEME_DIR', get_template_directory() );
define( 'TECHNIX_THEME_URI', get_template_directory_uri() );
define( 'TECHNIX_THEME_CSS_DIR', TECHNIX_THEME_URI . '/assets/css/' );
define( 'TECHNIX_THEME_JS_DIR', TECHNIX_THEME_URI . '/assets/js/' );
define( 'TECHNIX_THEME_INC', TECHNIX_THEME_DIR . '/inc/' );



// wp_body_open
if ( !function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/**
 * Implement the Custom Header feature.
 */
require TECHNIX_THEME_INC . 'custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require TECHNIX_THEME_INC . 'template-functions.php';

/**
 * Custom template helper function for this theme.
 */
require TECHNIX_THEME_INC . 'template-helper.php';

/**
 * initialize kirki customizer class.
 */
if ( class_exists( 'Kirki' ) ) {
    include_once TECHNIX_THEME_INC . 'kirki-customizer.php';
}
/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require TECHNIX_THEME_INC . 'jetpack.php';
}

/**
 * include technix functions file
 */
require_once TECHNIX_THEME_INC . 'class-navwalker.php';
require_once TECHNIX_THEME_INC . 'class-tgm-plugin-activation.php';
require_once TECHNIX_THEME_INC . 'add_plugin.php';
require_once TECHNIX_THEME_INC . '/common/technix-breadcrumb.php';
require_once TECHNIX_THEME_INC . '/common/technix-scripts.php';
require_once TECHNIX_THEME_INC . '/common/technix-widgets.php';
if ( function_exists('tpmeta_kick') ) {
    require_once TECHNIX_THEME_INC . 'tp-metabox.php';
}
/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function technix_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'technix_pingback_header' );

// change textarea position in comment form
// ----------------------------------------------------------------------------------------
function technix_move_comment_textarea_to_bottom( $fields ) {
    $comment_field       = $fields[ 'comment' ];
    unset( $fields[ 'comment' ] );
    $fields[ 'comment' ] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'technix_move_comment_textarea_to_bottom' );


// technix_comment 
if ( !function_exists( 'technix_comment' ) ) {
    function technix_comment( $comment, $args, $depth ) {
        $GLOBAL['comment'] = $comment;
        extract( $args, EXTR_SKIP );
        $args['reply_text'] = '<div class="postbox__comment-reply">
        <span><svg width="26" height="19" viewBox="0 0 26 19" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6.54688 10.2031L12.7969 16.4531C13.9688 17.625 16 16.8047 16 15.125V12.3516C20.6094 12.5469 20.7266 13.5625 20.0625 15.8672C19.5547 17.5469 21.4688 18.9141 22.9141 17.9375C24.9062 16.5703 26 14.8516 26 12.3516C26 6.76562 21 5.67188 16 5.47656V2.66406C16 0.984375 13.9688 0.164062 12.7969 1.33594L6.54688 7.58594C5.80469 8.28906 5.80469 9.5 6.54688 10.2031ZM7.875 8.875L14.125 2.625V7.3125C18.8125 7.3125 24.125 7.58594 24.125 12.3516C24.125 14.5391 22.9922 15.6328 21.8594 16.375C23.4609 11.0625 19.4766 10.4375 14.125 10.4375V15.125L7.875 8.875ZM1.54688 7.58594C0.804688 8.28906 0.804688 9.5 1.54688 10.2031L7.79688 16.4531C8.57812 17.2734 9.75 17.1562 10.4531 16.4531L2.875 8.875L10.4531 1.33594C9.75 0.632812 8.57812 0.515625 7.79688 1.33594L1.54688 7.58594Z" fill="#121416"></path>
           </svg></span>
     </div>';
        $replayClass = 'comment-depth-' . esc_attr( $depth );
        ?>


<li id="comment-<?php comment_ID();?>" class="comment-list">
    <div class="postbox__comment-box p-relative d-flex">
        <div class="postbox__comment-info">
            <div class="postbox__comment-avater">
                <?php print get_avatar( $comment, 102, null, null, [ 'class' => [] ] );?>
            </div>
        </div>
        <div class="postbox__comment-text">
            <div class="postbox__comment-name">
                <h5><?php print get_comment_author_link();?></h5>
                <span class="post-meta"><?php comment_time( get_option( 'date_format' ) );?></span>
            </div>
            <?php comment_text();?>
            <?php comment_reply_link( array_merge( $args, [ 'depth' => $depth, 'max_depth' => $args['max_depth'] ] ) );?>
        </div>
    </div>
    <?php
    }
}


/**
 * shortcode supports for removing extra p, spance etc
 *
 */
add_filter( 'the_content', 'technix_shortcode_extra_content_remove' );
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function technix_shortcode_extra_content_remove( $content ) {

    $array = [
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']',
    ];
    return strtr( $content, $array );

}

// technix_search_filter_form
if ( !function_exists( 'technix_search_filter_form' ) ) {
    function technix_search_filter_form( $form ) {

        $form = sprintf(
            '<div class="blog-sidebar__search p-relative"><div class="search-px"><form action="%s" method="get">
      	<input type="text" value="%s" required name="s" placeholder="%s">
      	<button type="submit"> <i class="fa-light fa-magnifying-glass"></i>  </button>
		</form></div></div>',
            esc_url( home_url( '/' ) ),
            esc_attr( get_search_query() ),
            esc_html__( 'Search', 'technix' )
        );

        return $form;
    }
    add_filter( 'get_search_form', 'technix_search_filter_form' );
}

add_action( 'admin_enqueue_scripts', 'technix_admin_custom_scripts' );


// technix_admin_custom_scripts
function technix_admin_custom_scripts() {
    wp_enqueue_media();
    wp_enqueue_style( 'customizer-style', get_template_directory_uri() . '/inc/css/customizer-style.css',array());
    wp_enqueue_script( 'technix-admin-custom', get_template_directory_uri() . '/inc/js/admin_custom.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'technix-admin-custom' );
}