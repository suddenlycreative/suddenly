<?php
/**
 * Layout setting for Customizer
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Layout Style
$this->sections['byron_layout_style'] = array(
	'title' => esc_html__( 'Layout Site', 'byron' ),
	'panel' => 'byron_layout',
	'settings' => array(
		array(
			'id' => 'site_layout_style',
			'default' => 'full-width',
			'control' => array(
				'label' => esc_html__( 'Layout Style', 'byron' ),
				'type' => 'select',
				'choices' => array(
					'full-width' => esc_html__( 'Full Width','byron' ),
					'boxed' => esc_html__( 'Boxed','byron' )
				),
			),
		),
		array(
			'id' => 'site_layout_boxed_shadow',
			'control' => array(
				'label' => esc_html__( 'Box Shadow', 'byron' ),
				'type' => 'checkbox',
				'active_callback' => 'byron_cac_has_boxed_layout',
			),
		),
		array(
			'id' => 'site_layout_wrapper_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Wrapper Margin', 'byron' ),
				'desc' => esc_html__( 'Top Right Bottom Left. Default: 30px 0px 30px 0px.', 'byron' ),
				'active_callback' => 'byron_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #wrapper',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'wrapper_background_color',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Outer Background Color', 'byron' ),
				'type' => 'color',
				'active_callback' => 'byron_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #wrapper',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'wrapper_background_img',
			'control' => array(
				'label' => esc_html__( 'Outer Background Image', 'byron' ),
				'type' => 'image',
				'active_callback' => 'byron_cac_has_boxed_layout',
			),
		),
		array(
			'id' => 'wrapper_background_img_style',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Outer Background Image Style', 'byron' ),
				'type'  => 'image',
				'type'  => 'select',
				'choices' => array(
					''             => esc_html__( 'Default', 'byron' ),
					'cover'        => esc_html__( 'Cover', 'byron' ),
					'center-top'        => esc_html__( 'Center Top', 'byron' ),
					'fixed-top'    => esc_html__( 'Fixed Top', 'byron' ),
					'fixed'        => esc_html__( 'Fixed Center', 'byron' ),
					'fixed-bottom' => esc_html__( 'Fixed Bottom', 'byron' ),
					'repeat'       => esc_html__( 'Repeat', 'byron' ),
					'repeat-x'     => esc_html__( 'Repeat-x', 'byron' ),
					'repeat-y'     => esc_html__( 'Repeat-y', 'byron' ),
				),
				'active_callback' => 'byron_cac_has_boxed_layout',
			),
		),
	),
);

// Layout Position
$this->sections['byron_layout_position'] = array(
	'title' => esc_html__( 'Layout Position', 'byron' ),
	'panel' => 'byron_layout',
	'settings' => array(
		array(
			'id' => 'site_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Site Layout Position', 'byron' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'byron' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'byron' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'byron' ),
				),
				'desc' => esc_html__( 'Specify layout for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings elementor when edit.', 'byron' )
			),
		),
		array(
			'id' => 'custom_page_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Custom Page Layout Position', 'byron' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'byron' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'byron' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'byron' ),
				),
				'desc' => esc_html__( 'Specify layout for all custom pages.', 'byron' )
			),
		),
		array(
			'id' => 'single_post_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Single Post Layout Position', 'byron' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'byron' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'byron' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'byron' ),
				),
				'desc' => esc_html__( 'Specify layout for all single post pages.', 'byron' )
			),
		),
	),
);

// Layout Widths
$this->sections['byron_layout_widths'] = array(
	'title' => esc_html__( 'Layout Widths', 'byron' ),
	'panel' => 'byron_layout',
	'settings' => array(
		array(
			'id' => 'site_desktop_container_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Container', 'byron' ),
				'type' => 'text',
				'desc' => esc_html__( 'Default: 1170px', 'byron' ),
			),
			'inline_css' => array(
				'target' => array( 
					'.site-layout-full-width .byron-container',
					'.site-layout-boxed #page'
				),
				'alter' => 'width',
			),
		),
		array(
			'id' => 'left_container_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Content', 'byron' ),
				'type' => 'text',
				'desc' => esc_html__( 'Example: 66%', 'byron' ),
			),
			'inline_css' => array(
				'target' => '#site-content',
				'alter' => 'width',
			),
		),
		array(
			'id' => 'sidebar_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Sidebar', 'byron' ),
				'type' => 'text',
				'desc' => esc_html__( 'Example: 28%', 'byron' ),
			),
			'inline_css' => array(
				'target' => '#sidebar',
				'alter' => 'width',
			),
		),
	),
);