<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package technix
 */

function get_header_style($style){
    if ( $style == 'header_2'  ) {
        get_template_part( 'template-parts/header/header-2' );
    }elseif ( $style == 'header_3'  ) {
        get_template_part( 'template-parts/header/header-3' );
    }elseif ( $style == 'header_4' ) {
        get_template_part( 'template-parts/header/header-4' );
    }else{
        get_template_part( 'template-parts/header/header-1');
    }
}

function technix_check_header() {
    $tp_header_tabs = function_exists('tpmeta_field')? tpmeta_field('technix_header_tabs') : false;
    $tp_header_style_meta = function_exists('tpmeta_field')? tpmeta_field('technix_header_style') : '';
    $elementor_header_template_meta = function_exists('tpmeta_field')? tpmeta_field('technix_header_templates') : false;

    $technix_header_option_switch = get_theme_mod('technix_header_elementor_switch', false);
    $header_default_style_kirki = get_theme_mod( 'header_layout_custom', 'header_1' );
    $elementor_header_templates_kirki = get_theme_mod( 'technix_header_templates' );
    
    if($tp_header_tabs == 'default'){
        if($technix_header_option_switch){
            if($elementor_header_templates_kirki){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            }
        }else{ 
            if($header_default_style_kirki){
                get_header_style($header_default_style_kirki);
            }else{
                get_template_part( 'template-parts/header/header-1' );
            }
        }
    }elseif($tp_header_tabs == 'custom'){
        if ($tp_header_style_meta) {
            get_header_style($tp_header_style_meta);
        }else{
            get_header_style($header_default_style_kirki);
        }  
    }elseif($tp_header_tabs == 'elementor'){
        if($elementor_header_template_meta){
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_template_meta);
        }else{
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
        }
    }else{
        if($technix_header_option_switch){

            if($elementor_header_templates_kirki){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            }else{
                get_template_part( 'template-parts/header/header-1' );
            }
        }else{
            get_header_style($header_default_style_kirki);

        }
        
    }

}
add_action( 'technix_header_style', 'technix_check_header', 10 );



/**
 * [technix_header_lang description]
 * @return [type] [description]
 */

function technix_header_lang_defualt() {
    $technix_header_lang = get_theme_mod( 'technix_header_lang', true );
    if ( $technix_header_lang ): ?>

<span class="tp-header-lang-selected-lang tp-lang-toggle"
    id="tp-header-lang-toggle"><?php print esc_html__( 'English', 'technix' );?></span>

<?php do_action( 'technix_language' );?>

<?php endif;?>
<?php
}

/**
 * [technix_language_list description]
 * @return [type] [description]
 */
function _technix_language( $mar ) {
    return $mar;
}
function technix_language_list() {

    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul class="tp-header-lang-list tp-lang-list">';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="tp-header-lang-list tp-lang-list tp-header-lan-list-area">';
        $mar .= '<li><a href="#">' . esc_html__( 'English', 'technix' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Bangla', 'technix' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'French', 'technix' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Hindi', 'technix' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    print _technix_language( $mar );
}
add_action( 'technix_language', 'technix_language_list' );


// header logo
function technix_header_logo() { ?>
<?php
        
        $technix_logo_on = function_exists('tpmeta_field')? tpmeta_field('technix_en_secondary_logo') : '';
        $technix_logo = get_template_directory_uri() . '/assets/img/logo/logo.png';
        $technix_logo_black = get_template_directory_uri() . '/assets/img/logo/footer-logo.png';

        $technix_site_logo = get_theme_mod( 'header_logo', $technix_logo );
        $technix_secondary_logo = get_theme_mod( 'header_secondary_logo', $technix_logo_black );
      ?>

<?php if ( $technix_logo_on == 'on' ) : ?>
<a class="secondary-logo" href="<?php print esc_url( home_url( '/' ) );?>">
    <img src="<?php print esc_url( $technix_secondary_logo );?>" alt="<?php print esc_attr__( 'logo', 'technix' );?>" />
</a>
<?php else : ?>
<a class="standard-logo" href="<?php print esc_url( home_url( '/' ) );?>">
    <img src="<?php print esc_url( $technix_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'technix' );?>" />
</a>
<?php endif; ?>
<?php
}

/**
 * [technix_header_social_profiles description]
 * @return [type] [description]
 */
function technix_header_social_profiles() {
    $technix_topbar_fb_url = get_theme_mod( 'header_facebook_link', __( '#', 'technix' ) );
    $technix_topbar_twitter_url = get_theme_mod( 'header_twitter_link', __( '#', 'technix' ) );
    $technix_topbar_instagram_url = get_theme_mod( 'header_instagram_link', __( '#', 'technix' ) );
    $technix_topbar_linkedin_url = get_theme_mod( 'header_linkedin_link', __( '#', 'technix' ) );
    $technix_topbar_youtube_url = get_theme_mod( 'header_youtube_link', __( '#', 'technix' ) );
    ?>

<?php if ( !empty( $technix_topbar_fb_url ) ): ?>
<a href="<?php print esc_url( $technix_topbar_fb_url );?>"><i class="fa-brands fa-facebook-f"></i></a>
<?php endif;?>

<?php if ( !empty( $technix_topbar_twitter_url ) ): ?>
<a href="<?php print esc_url( $technix_topbar_twitter_url );?>"><i class="fa-brands fa-twitter"></i></a>
<?php endif;?>

<?php if ( !empty( $technix_topbar_instagram_url ) ): ?>
<a href="<?php print esc_url( $technix_topbar_instagram_url );?>"><i class="fa-brands fa-instagram"></i></a>
<?php endif;?>

<?php if ( !empty( $technix_topbar_linkedin_url ) ): ?>
<a href="<?php print esc_url( $technix_topbar_linkedin_url );?>"><i class="fab fa-linkedin"></i></a>
<?php endif;?>

<?php if ( !empty( $technix_topbar_youtube_url ) ): ?>
<a href="<?php print esc_url( $technix_topbar_youtube_url );?>"><i class="fab fa-youtube"></i></a>
<?php endif;?>

<?php
}

/**
 * [technix_header_side_info_social_profiles description]
 * @return [type] [description]
 */
function technix_header_side_info_social_profiles() {
    $technix_topbar_fb_url = get_theme_mod( 'header_facebook_link', __( '#', 'technix' ) );
    $technix_topbar_twitter_url = get_theme_mod( 'header_twitter_link', __( '#', 'technix' ) );
    $technix_topbar_instagram_url = get_theme_mod( 'header_instagram_link', __( '#', 'technix' ) );
    $technix_topbar_linkedin_url = get_theme_mod( 'header_linkedin_link', __( '#', 'technix' ) );
    $technix_topbar_youtube_url = get_theme_mod( 'header_youtube_link', __( '#', 'technix' ) );
    ?>

<?php if ( !empty( $technix_topbar_fb_url ) ): ?>
<a class="icon facebook" href="<?php print esc_url( $technix_topbar_fb_url );?>"><i class="fab fa-facebook-f"></i></a>
<?php endif;?>

<?php if ( !empty( $technix_topbar_twitter_url ) ): ?>
<a class="icon twitter" href="<?php print esc_url( $technix_topbar_twitter_url );?>"><i class="fab fa-twitter"></i></a>
<?php endif;?>

<?php if ( !empty( $technix_topbar_instagram_url ) ): ?>
<a class="icon linkedin" href="<?php echo esc_url( $technix_topbar_instagram_url ) ?>"><i
        class="fa-brands fa-instagram"></i></a>
<?php endif;?>

<?php if ( !empty( $technix_topbar_linkedin_url ) ): ?>
<a class="icon linkedin" href="<?php echo esc_url( $technix_topbar_linkedin_url ) ?>"><i
        class="fab fa-linkedin"></i></a>
<?php endif;?>

<?php if ( !empty( $technix_topbar_youtube_url ) ): ?>
<a class="icon youtube" href="<?php print esc_url( $technix_topbar_youtube_url );?>"><i class="fab fa-youtube"></i></a>
<?php endif;?>

<?php
}

// technix_footer_social_profiles 
function technix_footer_social_profiles() {
    $technix_footer_fb_url = get_theme_mod( 'technix_footer_fb_url', __( '#', 'technix' ) );
    $technix_footer_twitter_url = get_theme_mod( 'technix_footer_twitter_url', __( '#', 'technix' ) );
    $technix_footer_instagram_url = get_theme_mod( 'technix_footer_instagram_url', __( '#', 'technix' ) );
    $technix_footer_linkedin_url = get_theme_mod( 'technix_footer_linkedin_url', __( '#', 'technix' ) );
    $technix_footer_youtube_url = get_theme_mod( 'technix_footer_youtube_url', __( '#', 'technix' ) );
    ?>


<?php if ( !empty( $technix_footer_fb_url ) ): ?>
<a href="<?php print esc_url( $technix_footer_fb_url );?>">
    <?php echo esc_html__('Fb.','technix'); ?>
</a>
<?php endif;?>

<?php if ( !empty( $technix_footer_twitter_url ) ): ?>
<a href="<?php print esc_url( $technix_footer_twitter_url );?>">
    <?php echo esc_html__('Tw.','technix'); ?>
</a>
<?php endif;?>

<?php if ( !empty( $technix_footer_instagram_url ) ): ?>
<a href="<?php print esc_url( $technix_footer_instagram_url );?>">
    <?php echo esc_html__('In.','technix'); ?>
</a>
<?php endif;?>

<?php if ( !empty( $technix_footer_linkedin_url ) ): ?>
<a href="<?php print esc_url( $technix_footer_linkedin_url );?>">
    <?php echo esc_html__('Ln.','technix'); ?>
</a>
<?php endif;?>

<?php if ( !empty( $technix_footer_youtube_url ) ): ?>
<a href="<?php print esc_url( $technix_footer_youtube_url );?>">
    <?php echo esc_html__('Yt.','technix'); ?>
</a>
<?php endif;?>

<?php
}

/**
 * [technix_header_menu description]
 * @return [type] [description]
 */
function technix_header_menu() {
    ?>
<?php
        wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => '',
            'container'      => '',
            'fallback_cb'    => 'technix_Navwalker_Class::fallback',
            'walker'         => new \TPCore\Widgets\technix_Navwalker_Class,
        ] );
    ?>
<?php
}


/**
 * [technix_footer_menu description]
 * @return [type] [description]
 */
function technix_footer_menu() {
    wp_nav_menu( [
        'theme_location' => 'footer-menu',
        'menu_class'     => 'm-0',
        'container'      => '',
        'fallback_cb'    => 'technix_Navwalker_Class::fallback',
        'walker'         =>  new \TPCore\Widgets\technix_Navwalker_Class,
    ] );
}


 /*
 * technix footer
 */
add_action( 'technix_footer_style', 'technix_check_footer', 10 );


function get_footer_style($style){
    if( $style == 'footer_2'  ) {
        get_template_part( 'template-parts/footer/footer-2' );
    }elseif ( $style == 'footer_3'  ) {
        get_template_part( 'template-parts/footer/footer-3' );
    }elseif ( $style == 'footer_4' ) {
        get_template_part( 'template-parts/footer/footer-4' );
    }else{
        get_template_part( 'template-parts/footer/footer-1');
    }
}

function technix_check_footer() {
    $tp_footer_tabs = function_exists('tpmeta_field')? tpmeta_field('technix_footer_tabs') : '';
    $technix_footer_style = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'technix_footer_style' ) : NULL;
    $footer_template = function_exists('tpmeta_field')? tpmeta_field('technix_footer_template') : false;

    $technix_footer_option_switch = get_theme_mod( 'technix_footer_elementor_switch', false );
    $elementor_footer_template = get_theme_mod( 'technix_footer_templates');
    $technix_default_footer_style = get_theme_mod( 'footer_layout', 'footer_1' );

    if($tp_footer_tabs == 'default'){
        if($technix_footer_option_switch){
            if($elementor_footer_template){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_template);
            }
        }else{ 
            if($technix_default_footer_style){
                get_footer_style($technix_default_footer_style);
            }else{
                get_template_part( 'template-parts/footer/footer-1' );
            }
        }
    }elseif($tp_footer_tabs == 'custom'){
        if ($technix_footer_style) {
            get_footer_style($technix_footer_style);
        }else{
            get_footer_style($technix_default_footer_style);
        }  
    }elseif($tp_footer_tabs == 'elementor'){
        if($footer_template){
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($footer_template);
        }else{
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_template);
        }

    }else{
        if($technix_footer_option_switch){

            if($elementor_footer_template){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_template);
            }else{
                get_template_part( 'template-parts/footer/footer-1' );
            }
        }else{
            get_footer_style($technix_default_footer_style);

        }
    }
}

// technix_copyright_text
function technix_copyright_text() {
   print get_theme_mod( 'footer_copyright', esc_html__( '© 2023 technix, All Rights Reserved. Design By Theme Pure', 'technix' ) );
}


/**
 *
 * pagination
 */
if ( !function_exists( 'technix_pagination' ) ) {

    function _technix_pagi_callback( $pagination ) {
        return $pagination;
    }

    //page navegation
    function technix_pagination( $prev, $next, $pages, $args ) {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if ( !$pages ) {
                $pages = 1;
            }

        }

        $pagination = [
            'base'      => add_query_arg( 'paged', '%#%' ),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ( $wp_rewrite->using_permalinks() ) {
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
        }

        if ( !empty( $wp_query->query_vars['s'] ) ) {
            $pagination['add_args'] = ['s' => get_query_var( 's' )];
        }

        $pagi = '';
        if ( paginate_links( $pagination ) != '' ) {
            $paginations = paginate_links( $pagination );
            $pagi .= '<ul>';
            foreach ( $paginations as $key => $pg ) {
                $pagi .= '<li>' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _technix_pagi_callback( $pagi );
    }
}

// theme color control
function technix_custom_color() {
    $theme_color_1 = get_theme_mod( 'theme_color_1', '#020626' );
    $theme_color_2 = get_theme_mod( 'theme_color_2', '#05DAC3' );

    wp_enqueue_style( 'technix-custom', TECHNIX_THEME_CSS_DIR . 'technix-custom.css', [] );
    
    if ( !empty($theme_color_1)) {
        $custom_css = '';
        $custom_css .= "html:root{
            --tp-theme-primary: " . $theme_color_1 . ";
            --tp-theme-secondary: " . $theme_color_2 . ";
        }";

        wp_add_inline_style( 'technix-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'technix_custom_color' );



// technix_kses_intermediate
function technix_kses_intermediate( $string = '' ) {
    return wp_kses( $string, technix_get_allowed_html_tags( 'intermediate' ) );
}

function technix_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function technix_kses($raw){

   $allowed_tags = array(
      'a'                         => array(
         'class'   => array(),
         'href'    => array(),
         'rel'  => array(),
         'title'   => array(),
         'target' => array(),
      ),
      'abbr'                      => array(
         'title' => array(),
      ),
      'b'                         => array(),
      'blockquote'                => array(
         'cite' => array(),
      ),
      'cite'                      => array(
         'title' => array(),
      ),
      'code'                      => array(),
      'del'                    => array(
         'datetime'   => array(),
         'title'      => array(),
      ),
      'dd'                     => array(),
      'div'                    => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'dl'                     => array(),
      'dt'                     => array(),
      'em'                     => array(),
      'h1'                     => array(),
      'h2'                     => array(),
      'h3'                     => array(),
      'h4'                     => array(),
      'h5'                     => array(),
      'h6'                     => array(),
      'i'                         => array(
         'class' => array(),
      ),
      'img'                    => array(
         'alt'  => array(),
         'class'   => array(),
         'height' => array(),
         'src'  => array(),
         'width'   => array(),
      ),
      'li'                     => array(
         'class' => array(),
      ),
      'ol'                     => array(
         'class' => array(),
      ),
      'p'                         => array(
         'class' => array(),
      ),
      'q'                         => array(
         'cite'    => array(),
         'title'   => array(),
      ),
      'span'                      => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'iframe'                 => array(
         'width'         => array(),
         'height'     => array(),
         'scrolling'     => array(),
         'frameborder'   => array(),
         'allow'         => array(),
         'src'        => array(),
      ),
      'strike'                 => array(),
      'br'                     => array(),
      'strong'                 => array(),
      'data-wow-duration'            => array(),
      'data-wow-delay'            => array(),
      'data-wallpaper-options'       => array(),
      'data-stellar-background-ratio'   => array(),
      'ul'                     => array(
         'class' => array(),
      ),
      'svg' => array(
           'class' => true,
           'aria-hidden' => true,
           'aria-labelledby' => true,
           'role' => true,
           'xmlns' => true,
           'width' => true,
           'height' => true,
           'viewbox' => true, // <= Must be lower case!
       ),
       'g'     => array( 'fill' => true ),
       'title' => array( 'title' => true ),
       'path'  => array( 'd' => true, 'fill' => true,  ),
      );

   if (function_exists('wp_kses')) { // WP is here
      $allowed = wp_kses($raw, $allowed_tags);
   } else {
      $allowed = $raw;
   }

   return $allowed;
}

// blog single social share
function technix_blog_social_share(){

    $technix_singleblog_social = get_theme_mod( 'technix_singleblog_social', false );
    $post_url = get_the_permalink();
    $end_class = has_tag() ? 'text-lg-end' : 'text-lg-start';

    if(!empty($technix_singleblog_social)) : ?>

<div class="col-lg-5">
    <div class="postbox__details-share <?php echo esc_attr($end_class); ?>">
        <span><?php echo esc_html__('Share:', 'technix');?></span>
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url);?>"
            target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url);?>" target="_blank"><i
                class="fa-brands fa-facebook"></i></a>
        <a href="https://twitter.com/share?url=<?php echo esc_url($post_url);?>" target="_blank"><i
                class="fa-brands fa-twitter"></i></a>
        <a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url($post_url);?>" target="_blank"><i
                class="fa-brands fa-pinterest-p"></i></a>
    </div>
</div>
<?php endif ; 

}

// / This code filters the Archive widget to include the post count inside the link /
add_filter( 'get_archives_link', 'technix_archive_count_span' );
function technix_archive_count_span( $links ) {
    $links = str_replace('</a>&nbsp;(', '<span > (', $links);
    $links = str_replace(')', ')</span></a> ', $links);
    return $links;
}


// / This code filters the Category widget to include the post count inside the link /
add_filter('wp_list_categories', 'technix_cat_count_span');
function technix_cat_count_span($links) {
  $links = str_replace('</a> (', '<span> (', $links);
  $links = str_replace(')', ')</span></a>', $links);
  return $links;
}