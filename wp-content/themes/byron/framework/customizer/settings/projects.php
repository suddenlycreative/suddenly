<?php
/**
 * Projects setting for Customizer
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Project Related General
$this->sections['byron_projects_general'] = array(
	'title' => esc_html__( 'General', 'byron' ),
	'panel' => 'byron_projects',
	'settings' => array(
		array(
			'id' => 'project_single_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Single Project: Featured Title Background', 'byron' ),
				'active_callback' => 'byron_cac_has_related_project',
			),
		),
		array(
			'id' => 'project_single_featured_title', 
			'default' => esc_html__( 'Our Projects', 'byron' ),
			'control' => array(
				'label' => esc_html__( 'Single Project: Featured Title', 'byron' ),
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'byron_cac_has_related_project',
			),
		),
	),
);