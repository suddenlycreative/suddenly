<?php
/**
 * General setting for Customizer
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Accent Colors
$this->sections['byron_accent_colors'] = array(
	'title' => esc_html__( 'Accent Colors', 'byron' ),
	'panel' => 'byron_general',
	'settings' => array(
		array(
			'id' => 'accent_color',
			'default' => '#F5AD0D',
			'control' => array(
				'label' => esc_html__( 'Accent Color', 'byron' ),
				'type' => 'color',
			),
		),
	)
);

// PreLoader
$this->sections['byron_preloader'] = array(
	'title' => esc_html__( 'PreLoader', 'byron' ),
	'panel' => 'byron_general',
	'settings' => array(
		array(
			'id' => 'preloader',
			'default' => 'animsition',
			'control' => array(
				'label' => esc_html__( 'Preloader Option', 'byron' ),
				'type' => 'select',
				'choices' => array(
					'animsition' => esc_html__( 'Enable','byron' ),
					'' => esc_html__( 'Disable','byron' )
				),
			),
		),
		array(
			'id' => 'preload_color_1',
			'default' => '#f5ad0d',
			'control' => array(
				'label' => esc_html__( 'Color', 'byron' ),
				'type' => 'color',
			),
			'inline_css' => array(
				'target' => '.animsition-loading',
				'alter' => 'background-color',
			),
		),
	)
);

// Header Site
$this->sections['byron_header_site'] = array(
	'title' => esc_html__( 'Header Site', 'byron' ),
	'panel' => 'byron_general',
	'settings' => array(
		array(
			'id' => 'header_site_style',
			'default' => 'style-3',
			'control' => array(
				'label' => esc_html__( 'Header Style', 'byron' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Basic', 'byron' ),
					'style-3' => esc_html__( 'Modern 1', 'byron' ),
					'style-4' => esc_html__( 'Modern 2', 'byron' ),
					'style-5' => esc_html__( 'Modern 3', 'byron' ),
				),
				'desc' => esc_html__( 'Header Style for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings elementor when edit.', 'byron' )
			),
		),
		array(
			'id' => 'header_fixed',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Header Fixed: Enable', 'byron' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Scroll to top
$this->sections['byron_scroll_top'] = array(
	'title' => esc_html__( 'Scroll Top Button', 'byron' ),
	'panel' => 'byron_general',
	'settings' => array(
		array(
			'id' => 'scroll_top',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'byron' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Forms
$this->sections['byron_general_forms'] = array(
	'title' => esc_html__( 'Forms', 'byron' ),
	'panel' => 'byron_general',
	'settings' => array(
		array(
			'id' => 'input_border_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Rounded', 'byron' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'input_background_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'byron' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'input_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'byron' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'input_border_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'byron' ),
				'description' => esc_html__( 'Enter a value in pixels. Example: 1px', 'byron' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'input_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'byron' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'color',
			),
		),
	),
);

// Responsive
$this->sections['byron_responsive'] = array(
	'title' => esc_html__( 'Responsive', 'byron' ),
	'panel' => 'byron_general',
	'settings' => array(
		// Mobile Logo
		array(
			'id' => 'heading_mobile_logo',
			'control' => array(
				'type' => 'byron-heading',
				'label' => esc_html__( 'Mobile Logo', 'byron' ),
			),
		),
		array(
			'id' => 'mobile_logo_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Mobile Logo: Width', 'byron' ),
				'description' => esc_html__( 'Example: 150px', 'byron' ),
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#site-logo',
				'alter' => 'max-width',
			),
		),
		array(
			'id' => 'mobile_logo_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Mobile Logo: Margin', 'byron' ),
				'description' => esc_html__( 'Example: 20px 0px 20px 0px', 'byron' ),
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#site-logo-inner',
				'alter' => 'margin',
			),
		),
		// Mobile Menu
		array(
			'id' => 'heading_mobile_menu',
			'control' => array(
				'type' => 'byron-heading',
				'label' => esc_html__( 'Mobile Menu', 'byron' ),
			),
		),
		array(
			'id' => 'mobile_menu_item_height',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Item Height', 'byron' ),
				'description' => esc_html__( 'Example: 40px', 'byron' ),
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav-mobi ul > li > a',
					'#main-nav-mobi .menu-item-has-children .arrow'
				),
				'alter' => 'line-height'
			),
		),
		array(
			'id' => 'mobile_menu_logo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Mobile Menu Logo', 'byron' ),
				'type' => 'image',
			),
		),
		array(
			'id' => 'mobile_menu_logo_width',
			'control' => array(
				'label' => esc_html__( 'Mobile Menu Logo: Width', 'byron' ),
				'type' => 'text',
			),
		),
		// Featured Title
		array(
			'id' => 'heading_featured_title',
			'control' => array(
				'type' => 'byron-heading',
				'label' => esc_html__( 'Mobile Featured Title', 'byron' ),
			),
		),
		array(
			'id' => 'mobile_featured_title_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'byron' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'byron' ),
				'active_callback' => 'byron_cac_has_featured_title',
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#featured-title .inner-wrap, #featured-title.centered .inner-wrap, #featured-title.creative .inner-wrap',
				'alter' => 'padding',
			),
		),
	)
);