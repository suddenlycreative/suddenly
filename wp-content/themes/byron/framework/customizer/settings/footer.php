<?php
/**
 * Footer setting for Customizer
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Footer General
$this->sections['byron_footer_general'] = array(
	'title' => esc_html__( 'General', 'byron' ),
	'panel' => 'byron_footer',
	'settings' => array(
		array(
			'id' => 'footer_columns',
			'default' => '4',
			'control' => array(
				'label' => esc_html__( 'Footer Column(s)', 'byron' ),
				'type' => 'select',
				'choices' => array(
					'5' => '5-3-4',
					'4' => '3-3-3-3',
					'3' => '4-4-4',
					'2' => '6-6',
					'1' => '12',
				),
			),
		),
		array(
			'id' => 'footer_column_gutter',
			'default' => '30',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Footer Column Gutter', 'byron' ),
				'type' => 'select',
				'choices' => array(
					'5'    => '5px',
					'10'   => '10px',
					'15'   => '15px',
					'20'   => '20px',
					'25'   => '25px',
					'30'   => '30px',
					'35'   => '35px',
					'40'   => '40px',
					'45'   => '45px',
					'50'   => '50px',
					'60'   => '60px',
					'70'   => '70px',
					'80'   => '80px',
				),
			),
		),
		array(
			'id' => 'footer_text_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'byron' ),
			),
			'inline_css' => array(
				'target' => '#footer-widgets .widget',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'footer_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'byron' ),
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'footer_bg_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'byron' ),
			),
		),
		array(
			'id' => 'footer_bg_img_style',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Background Image Style', 'byron' ),
				'type'  => 'image',
				'type'  => 'select',
				'choices' => array(
					''             => esc_html__( 'Default', 'byron' ),
					'cover'        => esc_html__( 'Cover', 'byron' ),
					'center-top'   => esc_html__( 'Center Top', 'byron' ),
					'fixed-top'    => esc_html__( 'Fixed Top', 'byron' ),
					'fixed'        => esc_html__( 'Fixed Center', 'byron' ),
					'fixed-bottom' => esc_html__( 'Fixed Bottom', 'byron' ),
					'repeat'       => esc_html__( 'Repeat', 'byron' ),
					'repeat-x'     => esc_html__( 'Repeat-x', 'byron' ),
					'repeat-y'     => esc_html__( 'Repeat-y', 'byron' ),
				),
			),
		),
		array(
			'id' => 'footer_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'byron' ),
				'description' => esc_html__( 'Example: 60px.', 'byron' ),
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'footer_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'byron' ),
				'description' => esc_html__( 'Example: 60px.', 'byron' ),
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'padding-bottom',
			),
		),
	),
);