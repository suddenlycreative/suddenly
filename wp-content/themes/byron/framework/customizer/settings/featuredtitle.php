<?php
/**
 * Featured Title setting for Customizer
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Featured Title General
$this->sections['byron_featuredtitle_general'] = array(
	'title' => esc_html__( 'General', 'byron' ),
	'panel' => 'byron_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'byron' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'featured_title_style',
			'default' => 'simple',
			'control' => array(
				'label'  => esc_html__( 'Style', 'byron' ),
				'type' => 'select',
				'choices' => array(
					'simple' => esc_html__( 'Simple', 'byron' ),
					'centered' => esc_html__( 'Centered', 'byron' ),
				),
				'active_callback' => 'byron_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'byron' ),
				'description' => esc_html__( 'Example: 250px 0px 150px 0px', 'byron' ),
				'active_callback' => 'byron_cac_has_featured_title',
			),
			'inline_css' => array(
				'media_query' => '(min-width: 992px)',
				'target' => '#featured-title .inner-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'featured_title_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'byron' ),
				'active_callback' => 'byron_cac_has_featured_title',
			),
			'inline_css' => array(
				'target' => '#featured-title',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'byron' ),
				'active_callback' => 'byron_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_background_img_style',
			'default' => 'repeat',
			'control' => array(
				'label' => esc_html__( 'Background Image Style', 'byron' ),
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
				'active_callback' => 'byron_cac_has_featured_title',
			),
		),
	),
);

// Featured Title Headings
$this->sections['byron_featuredtitle_heading'] = array(
	'title' => esc_html__( 'Headings', 'byron' ),
	'panel' => 'byron_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_heading',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'byron' ),
				'type' => 'checkbox',
				'active_callback' => 'byron_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_heading_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Heading Bottom Margin', 'byron' ),
				'active_callback' => 'byron_cac_has_featured_title_center',
				'description' => esc_html__( 'Example: 30px.', 'byron' ),
			),
			'inline_css' => array(
				'target' => '#featured-title.centered .title-group',
				'alter' => 'margin-bottom',
			),
		),
		array(
			'id' => 'featured_title_heading_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Title Color', 'byron' ),
				'active_callback' => 'byron_cac_has_featured_title_heading',
			),
			'inline_css' => array(
				'target' => '#featured-title .main-title',
				'alter' => 'color',
			),
		),
	),
);

// Featured Title Breadcrumbs
$this->sections['byron_featuredtitle_breadcrumbs'] = array(
	'title' => esc_html__( 'Breadcrumbs', 'byron' ),
	'panel' => 'byron_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_breadcrumbs',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'byron' ),
				'type' => 'checkbox',
				'active_callback' => 'byron_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'byron' ),
				'active_callback' => 'byron_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => array(
					'#featured-title #breadcrumbs',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'byron' ),
				'active_callback' => 'byron_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_link_hover_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'byron' ),
				'active_callback' => 'byron_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs a:hover',
				'alter' => 'color',
			),
		),
	),
);