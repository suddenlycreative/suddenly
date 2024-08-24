<?php
/**
 * Shop setting for Customizer
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Main Shop
$this->sections['byron_shop_general'] = array(
	'title' => esc_html__( 'Main Shop', 'byron' ),
	'panel' => 'byron_shop',
	'settings' => array(
		array(
			'id' => 'shop_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Shop Layout Position', 'byron' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'byron' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'byron' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'byron' ),
				),
				'desc' => esc_html__( 'Specify layout for main shop page.', 'byron' ),
				'active_callback' => 'byron_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_featured_title',
			'default' => esc_html__( 'Our Shop', 'byron' ),
			'control' => array(
				'label' => esc_html__( 'Shop: Featured Title', 'byron' ),
				'type' => 'byron_textarea',
				'active_callback' => 'byron_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Shop: Featured Title Background', 'byron' ),
				'active_callback' => 'byron_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_products_per_page',
			'default' => 6,
			'control' => array(
				'label' => esc_html__( 'Products Per Page', 'byron' ),
				'type' => 'number',
				'active_callback' => 'byron_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_columns',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Shop Columns', 'byron' ),
				'type' => 'select',
				'choices' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'active_callback' => 'byron_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_item_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Item Bottom Margin', 'byron' ),
				'description' => esc_html__( 'Example: 30px.', 'byron' ),
				'active_callback' => 'byron_cac_has_woo',
			),
			'inline_css' => array(
				'target' => '.products li',
				'alter' => 'margin-top',
			),
		),
	),
);

// Single Shop
$this->sections['byron_single_shop_general'] = array(
	'title' => esc_html__( 'Single Shop', 'byron' ),
	'panel' => 'byron_shop',
	'settings' => array(
		array(
			'id' => 'shop_single_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Shop Single Layout Position', 'byron' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'byron' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'byron' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'byron' ),
				),
				'desc' => esc_html__( 'Specify layout on the shop single page.', 'byron' ),
				'active_callback' => 'byron_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_single_featured_title',
			'default' => esc_html__( 'Our Shop', 'byron' ),
			'control' => array(
				'label' => esc_html__( 'Shop Single: Featured Title', 'byron' ),
				'type' => 'text',
				'active_callback' => 'byron_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_single_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Shop Single: Featured Title Background', 'byron' ),
				'active_callback' => 'byron_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_realted_columns',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Related Product Columns', 'byron' ),
				'type' => 'select',
				'choices' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'active_callback' => 'byron_cac_has_woo',
			),
		),
	),
);