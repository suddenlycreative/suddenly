<?php
namespace MasterlayerAddons\Settings;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

class MAE_Settings
{

    public function __construct()
    {	
    	add_action('elementor/documents/register_controls', [$this, 'mae_register_settings'], 10);
    }

    public function mae_register_settings($element)
    {	 	
    	$post_id = $element->get_id();
    	$post_type = get_post_type($post_id);

    	if ( ($post_type !== 'project') && ($post_type !== 'post') && ($post_type !== 'pre_footer') )
    		$this->mae_page_settings($element);

    	if ( is_singular( 'project' ) ) 
    		$this->mae_project_settings($element);

        if ( is_singular( 'post' ) ) {
            $this->mae_post_settings($element);
            //$this->mae_update_post($element);
        }

        if ( is_singular( 'pre_footer' ) ) 
            $this->mae_prefooter_settings($element);  	
    }

    // public function mae_update_post($element) {
    //     $settings = $element->get_settings_for_display();
    //     if ( get_post_format() !== $settings['post_format'] )
    //         set_post_format( $element->get_id(), $settings['post_format'] );
    // }

    public function mae_page_settings($element) {
    	$element->start_controls_section(
            'mae_page_settings',
            [
                'label' => __('Page Settings', 'masterlayer'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        // Header
        $element->add_control(
            'header_heading',
            [
                'label'     => __( 'Header', 'masterlayer'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'header_style',
            [
                'label'     => __( 'Header Style', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    ''             => __( 'Default', 'masterlayer'),
                    'style-1'      => __( 'Basic', 'masterlayer'),
                    'style-3'      => __( 'Modern 1', 'masterlayer'),
                    'style-4'      => __( 'Modern 2', 'masterlayer'),
                    'style-5'      => __( 'Modern 3', 'masterlayer'),
                ],
                'description' => __( 'Update and refresh page to view change', 'masterlayer' )
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'header_bg',
                'label' => __( 'Background', 'masterlayer' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '#site_header',
            ]
        );

        // Featured Title
        $element->add_control(
            'featured_title_heading',
            [
                'label'     => __( 'Featured Title', 'masterlayer'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'hide_featured_title',
            [
                'label'        => __( 'Hide ', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'none',
                'default'      => 'block',
                'selectors'    => [ '#featured-title' => 'display: {{VALUE}};' ] 
            ]
        );

        $element->add_control(
            'featured_title_bg',
            [
                'label'   => __( 'Background', 'masterlayer' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src(), ],
                'condition' => [ 'hide_featured_title!' => 'none' ]
            ],
        );

        $element->add_control(
            'custom_featured_title',
            [
                'label'   => __( 'Custom Title', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [ 'hide_featured_title!' => 'none' ]
            ]
        );

        // Logo
        $element->add_control(
            'logo_heading',
            [
                'label'     => __( 'Logo', 'masterlayer'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'custom_logo',
            [
                'label'   => __( 'Custom Logo', 'masterlayer' ),
                'type'    => Controls_Manager::MEDIA,
            ],
        );

        $element->add_responsive_control(
            'logo_width',
            [
                'label'      => __( 'Logo Width', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 30,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 50,
                        'max' => 150,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 140,
                ],
                'selectors'  => [
                    '#site-logo #site-logo-inner' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                ],
                50
            ]
        );

        // Main Content
        $element->add_control(
            'main_content_heading',
            [
                'label'     => __( 'Main Content', 'masterlayer'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'content_padding',
            [
                'label' => __('Content Padding', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'allowed_dimensions' => [ 'top', 'bottom' ],
                'selectors' => [ 
                    '#page #main-content' => 'padding-top: {{TOP}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'main_content_bg',
                'label' => __( 'Background', 'masterlayer' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '#main-content',
            ]
        );

        // Footer
        $element->add_control(
            'footer_heading',
            [
                'label'     => __( 'Footer', 'masterlayer'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'hide_footer',
            [
                'label'        => __( 'Hide ', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'none',
                'default'      => 'block',
                'selectors'    => [ '#footer' => 'display: {{VALUE}};' ] 
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'footer_bg',
                'label' => __( 'Background', 'masterlayer' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '#footer',
                'condition' => [ 'hide_footer' => 'block' ]
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bottom_bg',
                'label' => __( 'Background', 'masterlayer' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '#bottom',
            ]
        );

        $element->end_controls_section();
    }

    public function mae_project_settings($element) {
    	$element->start_controls_section(
            'mae_project_settings',
            [
                'label' => __('Project Settings', 'masterlayer'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'project_title',
            [
                'label'   => __( 'Custom Title', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $element->add_control(
            'project_desc',
            [
                'label'      => __( 'Short Description', 'masterlayer' ),
                'type'       => Controls_Manager::WYSIWYG,
            ]
        );

        $element->end_controls_section();
    }

    public function mae_post_settings($element) {
        // $post_format = get_post_format();
        // $formats = get_theme_support( 'post-formats' );
        // $post_formats = array_flip($formats[0]);

        // foreach ($post_formats as $key => $value) {
        //     $str = strval($key);
        //     $post_formats[$key] = ucfirst($str);
        // }

        $element->start_controls_section(
            'mae_post_settings',
            [
                'label' => __('Post Settings', 'masterlayer'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        // $element->add_control(
        //     'post_format',
        //     [
        //         'label'     => __( 'Post format', 'masterlayer'),
        //         'type'      => Controls_Manager::SELECT,
        //         'options'   => $post_formats,
        //     ]
        // );

        $element->add_control(
            'video_url',
            [
                'label'     => __( 'Video URL or Embeded Code', 'masterlayer'),
                'type'      => Controls_Manager::TEXT,
                'default'   => '',
            ]
        );

        $element->add_control(
            'gallery_images',
            [
                'label' => __( 'Add Images', 'masterlayer' ),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

        $element->end_controls_section();
    }

    public function mae_prefooter_settings($element) {
        $element->start_controls_section(
            'mae_prefooter_settings',
            [
                'label' => __('Pre-footer Settings', 'masterlayer'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'pre_footer_heading',
            [
                'label'        => __( 'Show on page', 'masterlayer' ),
                'type'         => Controls_Manager::HEADING,
            ]
        );

        $element->add_control(
            'pre_footer_blog',
            [
                'label'        => __( 'Blog', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'yes',
                'default'      => ''
            ]
        );

        $element->add_control(
            'pre_footer_single_post',
            [
                'label'        => __( 'Blog Single', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'yes',
                'default'      => ''
            ]
        );

        $element->add_control(
            'pre_footer_shop',
            [
                'label'        => __( 'Shop', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'yes',
                'default'      => ''
            ]
        );

        $element->add_control(
            'pre_footer_product',
            [
                'label'        => __( 'Product', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'yes',
                'default'      => ''
            ]
        );

        $element->add_control(
            'pre_footer_project_single',
            [
                'label'        => __( 'Project Single', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'yes',
                'default'      => ''
            ]
        );

        $element->end_controls_section();
    }
}

new MAE_Settings();