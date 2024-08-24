<?php

// tp metabox 
add_filter( 'tp_meta_boxes', 'themepure_metabox' );

function themepure_metabox( $meta_boxes ) {
	
	$prefix     = 'technix';
	
	$meta_boxes[] = array(
		'metabox_id'       => $prefix . '_page_meta_box',
		'title'    => esc_html__( 'TP Page Info', 'technix' ),
		'post_type'=> 'page',
		'context'  => 'normal',
		'priority' => 'core',
		'fields'   => array( 
			array(
				'label'    => esc_html__( 'Show Breadcrumb?', 'technix' ),
				'id'      => "{$prefix}_check_bredcrumb",
				'type'    => 'switch',
				'default' => 'on',
				'conditional' => array()
			),		
			array(
				'label'    => esc_html__( 'Show Breadcrumb Image?', 'technix' ),
				'id'      => "{$prefix}_check_bredcrumb_img",
				'type'    => 'switch',
				'default' => 'on',
				'conditional' => array()
			), 
            array(
				
				'label'    => esc_html__( 'Breadcrumb Background', 'technix' ),
				'id'      => "{$prefix}_breadcrumb_bg",
				'type'    => 'image',
				'default' => '',
				'conditional' => array(
					"{$prefix}_check_bredcrumb_img", "==", "on"
				)
			),

            array(
				'label'    => esc_html__( 'Enable Secondary Logo', 'technix' ),
				'id'      => "{$prefix}_en_secondary_logo",
				'type'    => 'switch',
				'default' => 'off',
				'conditional' => array()
			), 


            array(
				
				'label'    => esc_html__( 'Footer BG', 'technix' ),
				'id'      => "{$prefix}_footer_bg_image",
				'type'    => 'image',
				'default' => '',
				'conditional' => array()
			),

            array(
				'label' => 'Footer BG Color',
				'id'   	=> "{$prefix}_footer_bg_color",
				'type' 	=> 'colorpicker',
				'default' 	  => '#08111f',
				'conditional' => array()
			),

            // multiple buttons group field like multiple radio buttons
			array(
				'label'   => esc_html__( 'Header', 'technix' ),
				'id'      => "{$prefix}_header_tabs",
				'desc'    => '',
				'type'    => 'tabs',
				'choices' => array(
					'default' => esc_html__( 'Default', 'technix' ),
					'custom' => esc_html__( 'Custom', 'technix' ),
					'elementor' => esc_html__( 'Elementor', 'technix' ),
				),
				'default' => 'default',
				'conditional' => array()
			), 

            // select field dropdown
			array(
				
				'label'           => esc_html__('Select Header Style', 'technix'),
				'id'              => "{$prefix}_header_style",
				'type'            => 'select',
				'options'         => array(
					'header_1' => esc_html__( 'Header 1', 'technix' ),
					'header_2' => esc_html__( 'Header 2', 'technix' ),
					'header_3' => esc_html__( 'Header 3', 'technix' ),
				),
				'placeholder'     => esc_html__( 'Select a header', 'technix' ),
				'conditional' => array(
					"{$prefix}_header_tabs", "==", "custom"
				),
				'default' => 'header_1',
			),

            // select field dropdown
			array(
				
				'label'           => esc_html__('Select Header Template', 'technix'),
				'id'              => "{$prefix}_header_templates",
				'type'            => 'select_posts',
				'placeholder'     => esc_html__( 'Select a template', 'technix' ),
                'post_type'       => 'tp-header',
				'conditional' => array(
					"{$prefix}_header_tabs", "==", "elementor"
				),
				'default' => '',
			),


            // multiple buttons group field like multiple radio buttons
			array(
				'label'   => esc_html__( 'Footer', 'technix' ),
				'id'      => "{$prefix}_footer_tabs",
				'desc'    => '',
				'type'    => 'tabs',
				'choices' => array(
					'default' => esc_html__( 'Default', 'technix' ),
					'custom' => esc_html__( 'Custom', 'technix' ),
					'elementor' => esc_html__( 'Elementor', 'technix' ),
				),
				'default' => 'default',
				'conditional' => array()
			), 

            // select field dropdown
			array(
				
				'label'           => esc_html__('Select Footer Style', 'technix'),
				'id'              => "{$prefix}_footer_style",
				'type'            => 'select',
				'options'         => array(
					'footer_1' => esc_html__( 'Footer 1', 'technix' ),
					'footer_2' => esc_html__( 'Footer 2', 'technix' ),
					'footer_3' => esc_html__( 'Footer 3', 'technix' ),
				),
				'placeholder'     => esc_html__( 'Select a footer', 'technix' ),
				'conditional' => array(
					"{$prefix}_footer_tabs", "==", "custom"
				),
				'default' => 'footer_1',
			),

            // select field dropdown
			array(
				
				'label'           => esc_html__('Select Footer Template', 'technix'),
				'id'              => "{$prefix}_footer_template",
				'type'            => 'select_posts',
				'placeholder'     => esc_html__( 'Select a template', 'technix' ),
                'post_type'       => 'tp-footer',
				'conditional' => array(
					"{$prefix}_footer_tabs", "==", "elementor"
				),
				'default' => '',
			),
		),
	);

    $meta_boxes[] = array(
		'metabox_id'       => $prefix . '_post_gallery_meta',
		'title'    => esc_html__( 'TP Gallery Post', 'technix' ),
		'post_type'=> 'post',
		'context'  => 'normal',
		'priority' => 'core',
		'fields'   => array( 
            array(
				'label'    => esc_html__( 'Gallery', '' ),
				'id'      => "{$prefix}_post_gallery",
				'type'    => 'gallery',
				'default' => '',
				'conditional' => array(),
			),
		),
		'post_format' => 'gallery'
	);    

	$meta_boxes[] = array(
		'metabox_id'       => $prefix . '_post_video_meta',
		'title'    => esc_html__( 'TP Video Post', 'technix' ),
		'post_type'=> 'post',
		'context'  => 'normal',
		'priority' => 'core',
		'fields'   => array( 
			array(
				'label'    => esc_html__( 'Video', 'technix' ),
				'id'      => "{$prefix}_post_video",
				'type'    => 'text',
				'default' => '',
				'conditional' => array(),
				'placeholder'     => esc_html__( 'Place your video url.', 'technix' ),
			),
		),
		'post_format' => 'video'
	);	

	$meta_boxes[] = array(
		'metabox_id'       => $prefix . '_post_audio_meta',
		'title'    => esc_html__( 'TP Audio Post', 'technix' ),
		'post_type'=> 'post',
		'context'  => 'normal',
		'priority' => 'core',
		'fields'   => array( 
			array(
				'label'    => esc_html__( 'Audio', 'technix' ),
				'id'      => "{$prefix}_post_audio",
				'type'    => 'text',
				'default' => '',
				'conditional' => array(),
				'placeholder'     => esc_html__( 'Place your audio url..', 'technix' ),
			),
		),
		'post_format' => 'audio'
	);
	return $meta_boxes;
}