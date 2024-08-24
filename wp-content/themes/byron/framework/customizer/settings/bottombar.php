<?php
/**
 * Bottom Bar setting for Customizer
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bottom Bar General
$this->sections['byron_bottombar_general'] = array(
	'title' => esc_html__( 'General', 'byron' ),
	'panel' => 'byron_bottombar',
	'settings' => array(
		array(
			'id' => 'bottom_bar',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'byron' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'bottom_bar_style',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Style', 'byron' ),
				'type' => 'select',
				'active_callback' => 'byron_cac_has_bottombar',
				'choices' => array(
					''  	  => esc_html__( 'All Content', 'byron' ),	
					'style-1' => esc_html__( 'Only Copyright', 'byron' ),
					'style-2' => esc_html__( 'Logo + Copyright', 'byron' ),
				),
			),
		),
		array(
			'id' => 'bottom_copyright',
			'transport' => 'postMessage',
			'default' => '&copy; Byron - Creative Multipurpose WordPress Theme.',
			'control' => array(
				'label' => esc_html__( 'Copyright', 'byron' ),
				'type' => 'byron_textarea',
				'active_callback' => 'byron_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_padding',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'byron' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'byron' ),
				'active_callback'=> 'byron_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom .bottom-bar-inner-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'bottom_background',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'byron' ),
				'active_callback'=> 'byron_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom',
				'alter' => 'background',
			),
		),
		array(
			'id' => 'bottom_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'byron' ),
				'active_callback' => 'byron_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_background_img_style',
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
				'active_callback' => 'byron_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'byron' ),
				'active_callback'=> 'byron_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'line_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Line Color', 'byron' ),
				'active_callback'=> 'byron_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom:before',
				'alter' => 'background-color',
			),
		),
	),
);

// Bottom Logo
$this->sections['byron_bottom_logo'] = array(
	'title' => esc_html__( 'Logo', 'byron' ),
	'panel' => 'byron_bottombar',
	'settings' => array(
		array(
			'id' => 'bottom_custom_logo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Logo Image', 'byron' ),
				'type' => 'image',
			),
		),
		array(
			'id' => 'bottom_logo_width',
			'control' => array(
				'label' => esc_html__( 'Logo Width', 'byron' ),
				'type' => 'text',
			),
		),
	)
);
