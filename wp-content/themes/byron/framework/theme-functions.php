<?php
/**
 * Framework functions
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get Settings options of elementor
function byron_elementor( $settings ) {

	if ( ! class_exists( '\Elementor\Plugin' ) ) { return false; }

	// Get the current post id
	$post_id = get_the_ID();

	// Get the page settings manager
	$page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

	// Get the settings model for current post
	$page_settings_model = $page_settings_manager->get_model( $post_id );

	return  $page_settings_model->get_settings( $settings );

}

// Return class for reploader site
function byron_preloader_class() {
	// Get page preloader option from theme mod
	$class = byron_get_mod( 'preloader', 'animsition' );
	return esc_attr( $class );
}

// Get layout position for pages
function byron_layout_position() {
	// Default layout position
	$layout = 'sidebar-right';

	// Get layout position for site
	$layout = byron_get_mod( 'site_layout_position', 'sidebar-right' );

	// Get layout position for page blog
	if ( is_page() )
		$layout = byron_get_mod( 'custom_page_layout_position', 'no-sidebar' );

	// Get layout position for single post
	if ( is_singular( 'post' ) )
		$layout = byron_get_mod( 'single_post_layout_position', 'sidebar-right' );

	// Get layout position for shop pages
	if ( class_exists( 'woocommerce' ) ) {
		if ( is_shop() || is_product_category() )
			$layout = byron_get_mod( 'shop_layout_position', 'no-sidebar' );  
		if ( is_singular( 'product' ) )
			$layout = byron_get_mod( 'shop_single_layout_position', 'no-sidebar' );
		if ( is_cart() || is_checkout() ) {
			$layout = 'no-sidebar';
		}
	}

	return $layout;
}

// Theme pagination
function byron_pagination( $query = '', $echo = true ) {
	
	$prev_arrow = '<i class="elegant-arrow_carrot-left"></i>';
	$next_arrow = '<i class="elegant-arrow_carrot-right"></i>';

	if ( ! $query ) {
		global $wp_query;
		$query = $wp_query;
	}

	$total  = $query->max_num_pages;
	$big    = 999999999;

	// Display pagination
	if ( $total > 1 ) {

		// Get current page
		if ( $current_page = get_query_var( 'paged' ) ) {
			$current_page = $current_page;
		} elseif ( $current_page = get_query_var( 'page' ) ) {
			$current_page = $current_page;
		} else {
			$current_page = 1;
		}

		// Get permalink structure
		if ( get_option( 'permalink_structure' ) ) {
			if ( is_page() ) {
				$format = 'page/%#%/';
			} else {
				$format = '/%#%/';
			}
		} else {
			$format = '&paged=%#%';
		}

		$args = array(
			'base'      => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
			'format'    => $format,
			'current'   => max( 1, $current_page ),
			'total'     => $total,
			'mid_size'  => 3,
			'type'      => 'list',
			'prev_text' => $prev_arrow,
			'next_text' => $next_arrow
		);

		// Output
		if ( $echo ) {
			echo '<div class="byron-pagination clearfix">'. paginate_links( $args ) .'</div>';
		} else {
			return '<div class="byron-pagination clearfix">'. paginate_links( $args ) .'</div>';
		}

	}
}

// Render blog entry blocks
function byron_blog_entry_layout_blocks() {

	// Get layout blocks
	$blocks = byron_get_mod( 'blog_entry_composer' );

	// If blocks are 100% empty return defaults
	$blocks = $blocks ? $blocks : 'title,meta,excerpt_content,readmore';

	// Convert blocks to array so we can loop through them
	if ( ! is_array( $blocks ) ) {
		$blocks = explode( ',', $blocks );
	}

	// Set block keys equal to vals
	$blocks = array_combine( $blocks, $blocks );

	// Return blocks
	return $blocks;
}

// Render blog meta items
function byron_entry_meta() {
	// Get meta items from theme mod
	$meta_item = byron_get_mod( 'blog_entry_meta_items', array( 'author', 'date' ) );

	// If blocks are 100% empty return defaults
	$meta_item = $meta_item ? $meta_item : 'author,comments';

	// Turn into array if string
	if ( $meta_item && ! is_array( $meta_item ) ) {
		$meta_item = explode( ',', $meta_item );
	}

	// Set keys equal to values
	$meta_item = array_combine( $meta_item, $meta_item );

	// Loop through items
	foreach ( $meta_item as $item ) :
		if ( 'author' == $item ) {
			$avarta = get_avatar( get_the_author_meta('email'), '120' );

			printf( '<span class="post-by-author item"><span class="gravatar">%s</span> <span class="text-wrap"><span class="text">%s</span> <a class="name" href="%s" title="%s">%s</a></span></span>',
				$avarta,
				esc_html__( 'Written by', 'byron' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( esc_html__( 'View all posts by %s', 'byron' ), get_the_author() ) ),
				get_the_author()
			);
		}
		elseif ( 'date' == $item ) {
			printf( '<span class="post-date item"><span class="entry-date">%1$s</span></span>',
				get_the_date()
			);
		}
	endforeach;
}

// Return background CSS
function byron_bg_css( $style ) {
	$css = '';
	if ( $style = byron_get_mod( $style ) ) {
		if ( 'fixed' == $style ) {
			$css .= ' background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;';
		} elseif ( 'fixed-top' == $style ) {
			$css .= ' background-position: center top; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;';
		} elseif ( 'fixed-bottom' == $style ) {
			$css .= ' background-position: center bottom; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;';
		} elseif ( 'cover' == $style ) {
			$css .= ' background-repeat: no-repeat; background-position: center top; background-size: cover;';
		} elseif ( 'center-top' == $style ) {
			$css .= ' background-repeat: no-repeat; background-position: center top;';
		} elseif ( 'repeat' == $style ) {
			$css .= ' background-repeat: repeat;';
		} elseif ( 'repeat-x' == $style ) {
			$css .= ' background-repeat: repeat-x;';
		} elseif ( 'repeat-y' == $style ) {
			$css .= ' background-repeat: repeat-y;';
		}
	}

	return esc_attr( $css );
}

// Return background css for elements
function byron_element_bg_css( $bg ) {
	$css = '';
	$style = $bg .'_style';

	if ( $bg_img = byron_get_mod( $bg ) )
		$css .= 'background-image: url('. esc_url( $bg_img ). ');';

	$css .= byron_bg_css( $style );

	return esc_attr( $css );
}

// Return background css for featured title area
function byron_featured_title_bg() {
	$css = '';
	
	if ( is_page() ) {
		$page_bg_url = '';
		$page_bg = byron_elementor('featured_title_bg');
		if ( strpos( $page_bg['url'], 'placeholder.png' ) ) {
			$page_bg_url = '';
		} else {
			$page_bg_url = $page_bg['url'];
		}
		$bg_img = byron_get_mod( 'featured_title_background_img' );
		if ( !$page_bg_url && $bg_img ) {
			$css .= 'background-image: url('. esc_url( $bg_img ) .');';
		} else {
			$css .= 'background-image: url('. esc_url( $page_bg_url ) .');';
		}
		
	} elseif ( is_single() && ( $bg_img = byron_get_mod( 'blog_single_featured_title_background_img' ) ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	} elseif ( $bg_img = byron_get_mod( 'featured_title_background_img' ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	}

	if ( byron_is_woocommerce_shop() && $bg_img = byron_get_mod( 'shop_featured_title_background_img' ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	}

	if ( is_singular( 'product' ) && $bg_img = byron_get_mod( 'shop_single_featured_title_background_img' ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	}

	if ( is_tax() || is_singular( 'project' ) ) {
		if ( $bg_img = byron_get_mod( 'project_single_featured_title_background_img' ) )
			$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	}

	$css .= byron_bg_css('featured_title_background_img_style');

	return esc_attr( $css );
}

// Return background for main content area
function byron_main_content_bg() {
	$css = '';

	if ( $bg_img = byron_get_mod( 'main_content_background_img' ) ) {
		$css = 'background-image: url('. esc_url( $bg_img ). ');';
	}

	$css .= byron_bg_css('main_content_background_img_style');

	return esc_attr( $css );
}

add_action( 'after_setup_theme', 'byron_main_content_bg' );

// Return background for footer area
function byron_footer_bg() {
	$css = '';

	if ( !is_page() ) {
		if ( $bg_img = byron_get_mod( 'footer_bg_img' ) ) {
			$css .= 'background-image: url('. esc_url( $bg_img ) .');';
		}
	}

	$css .= byron_bg_css('footer_bg_img_style');

	return esc_attr( $css );
}

// Returns array of social
function byron_header_social_options() {
	return apply_filters ( 'byron_header_social_options', array(
		'facebook' => array(
			'label' => esc_html__( 'Facebook', 'byron' ),
			'icon_class' => 'fab fa-facebook-f',
		),
		'twitter' => array(
			'label' => esc_html__( 'Twitter', 'byron' ),
			'icon_class' => 'fab fa-twitter',
		),
		'instagram'  => array(
			'label' => esc_html__( 'Instagram', 'byron' ),
			'icon_class' => 'fab fa-instagram',
		),
		'youtube' => array(
			'label' => esc_html__( 'Youtube', 'byron' ),
			'icon_class' => 'fab fa-youtube',
		),
		'dribbble'  => array(
			'label' => esc_html__( 'Dribbble', 'byron' ),
			'icon_class' => 'fab fa-dribbble',
		),
		'vimeo' => array(
			'label' => esc_html__( 'Vimeo', 'byron' ),
			'icon_class' => 'fab fa-vimeo',
		),
		'tumblr'  => array(
			'label' => esc_html__( 'Tumblr', 'byron' ),
			'icon_class' => 'fab fa-tumblr',
		),
		'pinterest'  => array(
			'label' => esc_html__( 'Pinterest', 'byron' ),
			'icon_class' => 'fab fa-pinterest',
		),
		'linkedin'  => array(
			'label' => esc_html__( 'LinkedIn', 'byron' ),
			'icon_class' => 'fab fa-linkedin-in',
		),
	) );
}

// Check if it is WooCommerce Pages
function byron_is_woocommerce_page() {
    if ( function_exists ( "is_woocommerce" ) && is_woocommerce() )
		return true;

    $woocommerce_keys = array (
    	"woocommerce_shop_page_id" ,
        "woocommerce_terms_page_id" ,
        "woocommerce_cart_page_id" ,
        "woocommerce_checkout_page_id" ,
        "woocommerce_pay_page_id" ,
        "woocommerce_thanks_page_id" ,
        "woocommerce_myaccount_page_id" ,
        "woocommerce_edit_address_page_id" ,
        "woocommerce_view_order_page_id" ,
        "woocommerce_change_password_page_id" ,
        "woocommerce_logout_page_id" ,
        "woocommerce_lost_password_page_id" );

    foreach ( $woocommerce_keys as $wc_page_id ) {
		if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
			return true ;
		}
    }
    
    return false;
}

// Checks if is WooCommerce Shop page
function byron_is_woocommerce_shop() {
	if ( ! class_exists( 'woocommerce' ) ) {
		return false;
	} elseif ( is_shop() ) {
		return true;
	}
}

// Checks if is WooCommerce archive product page
function byron_is_woocommerce_archive_product() {
	if ( ! class_exists( 'woocommerce' ) ) {
		return false;
	} elseif ( is_product_category() || is_product_tag() ) {
		return true;
	}
}

// Returns correct ID for any object
function byron_parse_obj_id( $id = '', $type = 'page' ) {
	if ( $id && function_exists( 'icl_object_id' ) ) {
		$id = icl_object_id( $id, $type );
	}
	return $id;
}

// Hexdec color string to rgb(a) string
function byron_hex2rgba( $color, $opacity = false ) {
 	$default = 'rgb(0,0,0)';

	if ( empty( $color ) ) return $default; 
    if ( $color[0] == '#' ) $color = substr( $color, 1 );

    if ( strlen( $color ) == 6 ) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    $rgb =  array_map( 'hexdec', $hex );

    if ( $opacity ) {
    	if ( abs($opacity ) > 1 ) $opacity = 1.0;
    	$output = 'rgba('. implode( ",", $rgb ) .','. $opacity .')';
    } else {
    	$output = 'rgb('. implode( ",", $rgb ) .')';
    }

    return $output;
}

// SVG Core Icons
function byron_svg( $icon ) {
	$svg = array(
		'cart' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;">
						<path d="M9,20c0.6,0,1,0.4,1,1s-0.4,1-1,1s-1-0.4-1-1S8.4,20,9,20z M19,21c0,0.6,0.4,1,1,1s1-0.4,1-1s-0.4-1-1-1S19,20.4,19,21z M1,1h4l2.7,13.4c0.2,1,1,1.6,2,1.6h9.7c1,0,1.8-0.7,2-1.6L23,6H6"/>
					</svg>',
		'search' => '<svg viewBox="0 0 24 24" style="fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;">
						<path d="M11,3c4.4,0,8,3.6,8,8s-3.6,8-8,8s-8-3.6-8-8S6.6,3,11,3z M21,21l-4.4-4.4"/>
					</svg>',
		'menu' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
						<path d="m453.332031 512h-394.664062c-32.363281 0-58.667969-26.304688-58.667969-58.667969v-394.664062c0-32.363281 26.304688-58.667969 58.667969-58.667969h394.664062c32.363281 0 58.667969 26.304688 58.667969 58.667969v394.664062c0 32.363281-26.304688 58.667969-58.667969 58.667969zm-394.664062-480c-14.699219 0-26.667969 11.96875-26.667969 26.667969v394.664062c0 14.699219 11.96875 26.667969 26.667969 26.667969h394.664062c14.699219 0 26.667969-11.96875 26.667969-26.667969v-394.664062c0-14.699219-11.96875-26.667969-26.667969-26.667969zm0 0"/>
						<path d="m346.667969 181.332031h-181.335938c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h181.335938c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/>
						<path d="m346.667969 272h-181.335938c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h181.335938c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/>
						<path d="m346.667969 362.667969h-181.335938c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h181.335938c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/>
					</svg>',
		'arrow_left' => '',
		'arrow_right' => '',
	);

	if ( array_key_exists( $icon, $svg) ) {
		return $svg[$icon];
	} else {
		return null;
	}
}
