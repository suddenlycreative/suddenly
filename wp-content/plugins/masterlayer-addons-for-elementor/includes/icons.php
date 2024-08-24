<?php

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


add_filter( 'elementor/icons_manager/additional_tabs', 'mae_iconpicker_register' );

function mae_iconpicker_register( $icons = array() ) {

	$icons['byron'] = array(
		'name'          => 'byron',
		'label'         => esc_html__( 'Byron Icons', 'masterlayer' ),
		'labelIcon'     => 'byr-engineer1',
		'prefix'        => 'byr-',
		'displayPrefix' => '',
		'url'           => MAE_URL . 'assets/css/byron.css',
		'fetchJson'     => MAE_URL . 'assets/fonts/byron/byron.json',
		'ver'           => '1.0.0',
	);

	$icons['feather'] = array(
		'name'          => 'feather',
		'label'         => esc_html__( 'Feather Icons', 'masterlayer' ),
		'labelIcon'     => 'fe-feather',
		'prefix'        => 'fe-',
		'displayPrefix' => '',
		'url'           => MAE_URL . 'assets/css/feather-icons.css',
		'fetchJson'     => MAE_URL . 'assets/fonts/feather-icons/feather.json',
		'ver'           => '1.0.0',
	);

	return $icons;
}
