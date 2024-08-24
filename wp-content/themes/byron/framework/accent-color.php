<?php
/**
 * Accent color
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start class
if ( ! class_exists( 'Byron_Accent_Color' ) ) {
	class Byron_Accent_Color {
		// Main constructor
		function __construct() {
			add_filter( 'byron_custom_colors_css', array( 'Byron_Accent_Color', 'head_css' ), 999 );
		}

		// Generates arrays of elements to target
		public static function arrays( $return ) {
			// Color
			$texts = apply_filters( 'byron_accent_texts', array(
				'a','.link-dark:hover,.link-gray:hover','.accent-color','.link-email:hover','.sticky-post','#site-logo .site-logo-text:hover','.header-button a','#main-nav .sub-menu li a:hover','#mega-menu .menu .sub-menu .menu-item:hover a','#featured-title #breadcrumbs a:hover','.hentry .page-links a>span,.hentry .page-links>span','.hentry .post-title a:hover','.hentry .post-meta .item.post-by-author a:hover,.hentry .post-meta .item.post-comment a:hover,.hentry .post-meta .item.post-meta-categories a:hover','.hentry .post-tags a','.hentry .post-author .author-socials .socials a:hover','.related-news .post-item .post-categories a:hover','.related-news .post-item .text-wrap h3 a:hover','.related-news .related-post .slick-next:hover:before,.related-news .related-post .slick-prev:hover:before','#cancel-comment-reply-link:hover,.comment-edit-link:hover,.comment-reply-link:hover','.unapproved','.logged-in-as a','.widget.widget_archive ul li a:hover,.widget.widget_categories ul li a:hover,.widget.widget_meta ul li a:hover,.widget.widget_nav_menu ul li a:hover,.widget.widget_pages ul li a:hover,.widget.widget_recent_comments ul li a:hover,.widget.widget_recent_entries ul li a:hover,.widget.widget_rss ul li a:hover','.widget.widget_archive ul li>span,.widget.widget_categories ul li>span','#sidebar .widget.widget_calendar caption','#footer .widget.widget_archive ul li a:hover,#footer .widget.widget_calendar a:hover,#footer .widget.widget_categories ul li a:hover,#footer .widget.widget_meta ul li a:hover,#footer .widget.widget_nav_menu ul li a:hover,#footer .widget.widget_pages ul li a:hover,#footer .widget.widget_recent_comments ul li a:hover,#footer .widget.widget_recent_entries ul li a:hover,#footer .widget.widget_rss ul li a:hover','.widget.widget_latest_posts .categories a:hover','.widget.widget_latest_posts .current .post-title a,.widget.widget_latest_posts .post-title:hover a','.widget.widget_nav_menu .menu>li.current-menu-item,.widget.widget_nav_menu .menu>li.current-menu-item>a','.widget.widget_calendar a,.widget.widget_calendar tbody #today','#footer .widget.widget_calendar a,#footer .widget.widget_calendar tbody #today','.widget.widget_recent_posts h3 a:hover','.widget.widget_recent_posts .post-author','.widget.widget_recent_posts .post-author a','.widget.widget_tag_cloud .tagcloud a','#copyright a:hover','#bottom #bottom-logo .bottom-logo-text:hover','.no-results-content .search-form .search-submit:hover:before','.deeper-accordions .item .heading:hover h6','.deeper-accordions .item .heading .accordions-arrow:hover:after','.deeper-button.button-white','.deeper-button.button-outline.outline-accent','.deeper-demo-box .demo-text:hover a','.deeper-divider.has-icon .icon-wrap>span.accent','.deeper-icon.accent-color .icon-wrap','.deeper-link','.deeper-link.style-3 .icon','.deeper-news-box .meta-wrap .cat-item a:hover,.deeper-news-box .title a:hover','.deeper-news-box .post-link','.deeper-progress .perc.accent','.deeper-cubeportfolio.style-2 .project-item .project-title a:hover','.deeper-cubeportfolio.style-3 .project-item .project-title a:hover','.cube-filter .cbp-filter-item span:hover,.cube-filter .cbp-filter-item.cbp-filter-item-active span','.deeper-adv-tabs.price-tabs .tab-title .item-title .tag','.deeper-team-box.style-2 .team-name:hover','.deeper-video-icon:before','.woocommerce-page .woocommerce-MyAccount-content .woocommerce-info .button','.products li .product-info .added_to_cart,.products li .product-info .button','.products li .product-cat:hover','.products li h2:hover','.woo-single-post-class .woocommerce-grouped-product-list-item__label a:hover','.woo-single-post-class .summary .product_meta>span a:hover','.woocommerce-page .shop_table.cart .product-name a:hover','.product_list_widget .product-title:hover,.widget_recent_reviews .product_list_widget a:hover','.widget_product_categories ul li a:hover','.widget_price_filter .price_slider_amount .button','.widget.widget_product_search .woocommerce-product-search .search-submit:hover:before','.widget_shopping_cart_content ul li a:hover',

			) );

			// Background color
			$backgrounds = apply_filters( 'byron_accent_backgrounds', array(
				'.button,button,input[type=button],input[type=reset],input[type=submit]','.bg-accent','.link-email:hover:after','.post.sticky .post-title:after','#main-nav .sub-menu li a:before','#mega-menu .menu .sub-menu .menu-item:after','#main-nav-mobi::-webkit-scrollbar','#main-nav-mobi::-webkit-scrollbar-thumb','.post-media .slick-next:hover,.post-media .slick-prev:hover','.post-media .slick-dots li.slick-active:after','.post-media .post-cat-custom a','.hentry .post-link a','#comments .comment-respond .form-submit .submit:hover','.widget.widget_categories .cat-item span','.widget.widget_links ul li a:after','.widget.widget_mc4wp_form_widget .submit:after','.widget.widget_tag_cloud .tagcloud a:hover','#footer .widget.widget_tag_cloud .tagcloud a:hover','#bottom .bottom-socials a:hover','#scroll-top:before','#scroll-top:hover:before','.byron-pagination ul li .page-numbers.current,.byron-pagination ul li .page-numbers:hover,.woocommerce-pagination .page-numbers li .page-numbers.current,.woocommerce-pagination .page-numbers li .page-numbers:hover','.deeper-accordions.has-dark-bg .item.active .heading .accordions-arrow','.deeper-button','.deeper-button.button-dark:before','.deeper-carousel-box .flickity-page-dots .dot.is-selected','.flickity-button','.group-content-box.hover-effect-1 .vc_column_container .deeper-content-box .inner:after','.deeper-cf7.btn-accent .wpcf7 .wpcf7-submit','.deeper-subscribe.btn-accent .mc4wp-form .submit','.deeper-icon.bg-accent .icon-wrap','.deeper-link:hover .line','.deeper-news-box .post-link:after','.deeper-partner.hover-effect-4:hover .partner-logo','.deeper-progress .progress-animate.accent,.deeper-progress .progress-animate.accent:after','.project-item .project-image:after','.cube-filter .cbp-filter-item span:after','.project-carousel .project-item .project-image','.deeper-adv-tabs.price-tabs .tab-title .item-title.active .anchor-link','.deeper-team-box .avatar:after','.deeper-team-box.color-3 .avatar:after','.deeper-special-text .line','.deeper-video-icon.style-2','.woo-single-post-class .images .woocommerce-product-gallery__trigger:hover:after','.woocommerce-page .wc-proceed-to-checkout .button','.woocommerce-page .return-to-shop a','#payment #place_order','.widget_price_filter .price_slider_amount .button:hover','.widget_price_filter .ui-slider .ui-slider-range','.widget_shopping_cart_content .buttons a.checkout',
			) );

			// Border color
			$borders = apply_filters( 'byron_accent_borders', array(
				'select:focus',
				'textarea:focus',
				'input[type="text"]:focus',
				'input[type="password"]:focus',
				'input[type="datetime"]:focus',
				'input[type="datetime-local"]:focus',
				'input[type="date"]:focus',
				'input[type="month"]:focus',
				'input[type="time"]:focus',
				'input[type="week"]:focus',
				'input[type="number"]:focus',
				'input[type="email"]:focus',
				'input[type="url"]:focus',
				'input[type="search"]:focus',
				'input[type="tel"]:focus',
				'input[type="color"]:focus',
				'.underline-solid:after',
				'.underline-dotted:after',
				'.underline-dashed:after',
				'.border-accent',
				'.widget.widget_links ul li a:after',
				'#footer select:focus',
				'#footer input[type="search"]:focus',
				'.byron-pagination ul li .page-numbers:hover',			
				'.byron-pagination ul li .page-numbers.current',
				'.no-results-content .search-form .search-field:focus',

				// shortcodes
				'.flickity-page-dots .dot.is-selected',
				'.divider-icon-before.accent',
				'.divider-icon-after.accent',
				'.deeper-divider.has-icon .divider-double.accent',
				'.deeper-icon.accent-border .icon-wrap',

				// woocommerce
				'.woocommerce-pagination .page-numbers li .page-numbers:hover',
				'.woocommerce-pagination .page-numbers li .page-numbers.current',
				'.woo-single-post-class .summary .cart .quantity input',
			) );

			// Box Shadow color
			$boxshadows = apply_filters( 'byron_accent_shadow', array(
				'.deeper-button.outline-accent, .rev-btn.outline-btn, .rev-btn.btn-light:hover, .header-button.outline-accent a' => array( '0 0 0 2px', 1 ),
				'.deeper-video-icon.style-2' => array( '0 0 0 0', 0.7 ),

			) );

			// Stroke
			$stroke = apply_filters( 'byron_accent_stroke', array(
				'.group-content-box.hover-effect-1:hover .vc_column_container:first-child .deeper-content-box .inner .deeper-icon-box .svg-wrap path',
				'.group-content-box.hover-effect-1 .vc_column_container .deeper-content-box .inner .deeper-icon-box .svg-wrap path',
			) );

			// Return array
			if ( 'texts' == $return ) {
				return $texts;
			} elseif ( 'backgrounds' == $return ) {
				return $backgrounds;
			} elseif ( 'borders' == $return ) {
				return $borders;
			} elseif ( 'boxshadows' == $return ) {
				return $boxshadows;
			} elseif ( 'stroke' == $return ) {
				return $stroke;
			} 
		}

		// Generates the CSS output
		public static function head_css( $output ) {

			// Get custom accent
			$default_accent = '#f5ad0d';
			$custom_accent  = byron_get_mod( 'accent_color' ) ? byron_get_mod( 'accent_color' ) : $default_accent;

			if ( $custom_accent)
				$css = 'body[class^="elementor-kit-"], body[class*=" elementor-kit-"] { --e-global-color-accent: ' . $custom_accent . ';}';
				
			// Return CSS
			if ( ! empty( $css ) )
				$output .= '/*ACCENT COLOR*/'. $css;

			// Return output css
			return $output;
		}
	}
}

new Byron_Accent_Color();
