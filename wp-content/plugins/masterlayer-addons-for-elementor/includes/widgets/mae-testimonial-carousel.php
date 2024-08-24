<?php
/*
Widget Name: Testimonial Carousel
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-masterlayer/
*/

namespace MasterlayerAddons\Widgets;

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
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Testimonial_Carousel_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'flickity', 'waitforimages' ];
    }

    public function get_style_depends() {
        return [ 'flickity' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-testimonial-carousel';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'Testimonial Carousel', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-carousel';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    } 

    protected function register_controls() {

        // Content Section
        $this->start_controls_section( 'content_section',
            [
                'label' => __( 'Content', 'masterlayer' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'avatar',
            [
                'label'   => __( 'Avatar', 'masterlayer' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src(), ]
            ],
        );

        $repeater->add_control(
            'name',
            [
                'label'   => __( 'Name', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'New Member', 'masterlayer' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'role',
            [
                'label'   => __( 'Role', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Manager', 'masterlayer' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'comment',
            [
                'label'      => __( 'Comment', 'masterlayer' ),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => __( 'We believe architecture and design are critically important to addressing the most pressing challenges of our time.', 'masterlayer' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'rating',
            [
                'label'   => __( 'Stars Rating', 'masterlayer' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => 'http://localhost/byron/wp-content/uploads/2020/08/star-rating.png', ]
            ],
        );

        $repeater->add_responsive_control(
            'rating_width',
            [
                'label'      => __( 'Stars Rating (Max Width)', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 50,
                        'max' => 300,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .rating ' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                50
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'name'  => __( 'Client #1', 'masterlayer' ),
                    ],
                    [
                        'name'  => __( 'Client #2', 'masterlayer' ),
                    ],
                    [
                        'name'  => __( 'Client #3', 'masterlayer' ),
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();

        // Settings TAB
        $this->start_controls_section( 'setting_general_section',
            [
                'label' => __( 'General', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'masterlayer' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'masterlayer' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'masterlayer' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'masterlayer' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'prefix_class' => 'align-',
            ]
        );

        $this->add_control(
            'avatar_position',
            [
                'label'     => __( 'Avatar Position', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'absolute',
                'options'   => [
                    'default'       => __( 'Default', 'masterlayer'),
                    'absolute'      => __( 'Absolute', 'masterlayer'),
                ],
                'prefix_class' => 'avatar-'
            ]
        );

        $this->add_control(
            'quotes_icon',
            [
                'label' => __( 'Quotes Icon', 'masterlayer' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fa fa-quote-left',
                    'library' => 'solid',
                ],
                'label_block'      => false,
                'skin'             => 'inline'
            ]
        );

        $this->add_responsive_control(
            'quotes_icon_size',
            [
                'label'      => __( 'Quotes Size', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .master-testimonial .quotes' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .master-testimonial .quotes svg' => 'width: {{SIZE}}{{UNIT}}; font-size: 0;',
                ],
                50
            ]
        );

        $this->end_controls_section();

        // Carousel settings
        $this->start_controls_section( 'setting_carousel_section',
            [
                'label' => __( 'Carousel', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $this->add_control(
            'column',
            [
                'label'     => __( 'Columns', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '3',
                'options'   => [
                    '2'      => __( '2', 'masterlayer'),
                    '3'      => __( '3', 'masterlayer'),
                    '4'      => __( '4', 'masterlayer'),
                    '5'      => __( '5', 'masterlayer'),
                ],
            ]
        );

        $this->add_control(
            'gap',
            [
                'label'     => __( 'Gap', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '30px',
                'options'   => [
                    '0px'      => __( '0px', 'masterlayer'),
                    '10px'     => __( '10px', 'masterlayer'),
                    '20px'     => __( '20px', 'masterlayer'),
                    '30px'     => __( '30px', 'masterlayer'),
                    '40px'     => __( '40px', 'masterlayer'),
                ],
            ]
        );

        $this->add_control(
            'fullRight',
            [
                'label'        => __( 'Full Right', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => 'false',
            ]
        );

        $this->add_control(
            'fullRightOpacity',
            [
                'label'     => __( 'Right Box Opacity', 'masterlayer'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 0.7,
                'min'     => 0,
                'max'     => 1,
                'step'    => 0.1,
                'condition'             => [
                    'fullRight'   => 'true',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-carousel-box .item-carousel' => 'opacity: {{VALUE}};',
                    '{{WRAPPER}} .master-carousel-box .item-carousel.is-selected' => 'opacity: 1;',
                    '{{WRAPPER}} .master-carousel-box:hover .item-carousel' => 'opacity: {{VALUE}};',
                    '{{WRAPPER}} .master-carousel-box:hover .item-carousel.is-selected' => 'opacity: 1;',
                ],
            ]
        );

        $this->add_control(
            'autoPlay',
            [
                'label'        => __( 'Auto Play', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => 'true',
            ]
        );

        $this->add_control(
            'prevNextButtons',
            [
                'label'        => __( 'Show Arrows?', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => 'false',
            ]
        );

        $this->add_control(
            'arrowPosition',
            [
                'label'     => __( 'Arrows Position', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'middle',
                'options'   => [
                    'top'      => __( 'Top', 'masterlayer'),
                    'middle'     => __( 'Middle', 'masterlayer'),
                ],
                'condition' => [
                     'prevNextButtons' => 'true'
                ]
            ]
        );

        $this->add_control(
            'arrowMiddleOffset',
            [
                'label'     => __( 'Arrows Offset', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '60px',
                'options'   => [
                    '0px'      => __( '0px', 'masterlayer'),
                    '10px'      => __( '10px', 'masterlayer'),
                    '20px'      => __( '20px', 'masterlayer'),
                    '30px'      => __( '30px', 'masterlayer'),
                    '40px'      => __( '40px', 'masterlayer'),
                    '50px'      => __( '50px', 'masterlayer'),
                    '60px'      => __( '60px', 'masterlayer'),
                    '70px'      => __( '70px', 'masterlayer'),
                    '80px'      => __( '80px', 'masterlayer'),
                    '90px'      => __( '90px', 'masterlayer'),
                    '100px'      => __( '100px', 'masterlayer'),

                ],
                'condition' => [
                    'prevNextButtons' => 'true', 'arrowPosition' => 'middle'
                ]
            ]
        );

        $this->add_control(
            'arrowTopOffset',
            [
                'label'     => __( 'Arrows Offset', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '60px',
                'options'   => [
                    '0px'      => __( '0px', 'masterlayer'),
                    '10px'      => __( '10px', 'masterlayer'),
                    '20px'      => __( '20px', 'masterlayer'),
                    '30px'      => __( '30px', 'masterlayer'),
                    '40px'      => __( '40px', 'masterlayer'),
                    '50px'      => __( '50px', 'masterlayer'),
                    '60px'      => __( '60px', 'masterlayer'),
                    '70px'      => __( '70px', 'masterlayer'),
                    '80px'      => __( '80px', 'masterlayer'),
                    '90px'      => __( '90px', 'masterlayer'),
                    '100px'      => __( '100px', 'masterlayer'),

                ],
                'condition' => [
                    'prevNextButtons' => 'true', 'arrowPosition' => 'top'
                ]
            ]
        );

        $this->add_control(
            'pageDots',
            [
                'label'        => __( 'Show Bullets?', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => 'false',
            ]
        );

        $this->add_control(
            'dotOffset',
            [
                'label'     => __( 'Bullets Offset', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '60px',
                'options'   => [
                    '0px'      => __( '0px', 'masterlayer'),
                    '10px'      => __( '10px', 'masterlayer'),
                    '20px'      => __( '20px', 'masterlayer'),
                    '30px'      => __( '30px', 'masterlayer'),
                    '40px'      => __( '40px', 'masterlayer'),
                    '50px'      => __( '50px', 'masterlayer'),
                    '60px'      => __( '60px', 'masterlayer'),
                    '70px'      => __( '70px', 'masterlayer'),
                    '80px'      => __( '80px', 'masterlayer'),
                    '90px'      => __( '90px', 'masterlayer'),
                    '100px'      => __( '100px', 'masterlayer'),

                ],
                'condition' => [
                     'pageDots' => 'true'
                ]
            ]
        );

        $this->end_controls_section();

        // STYLE TAB
        // General
        $this->start_controls_section( 'style_general_section',
            [
                'label' => __( 'General', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'hoverEffect',
            [
                'label'     => __( 'Hover Effect', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'none',
                'options'   => [
                    'none'         => __( 'None', 'masterlayer'),
                    'style-1'      => __( 'Style 1', 'masterlayer'),
                    'style-2'      => __( 'Style 2', 'masterlayer'),
                    'style-3'      => __( 'Style 3', 'masterlayer'),
                ],
                'prefix_class' => 'hover-effect-'
            ]
        );
        
        $this->add_responsive_control(
            'translateY',
            [
                'label'      => __( 'Hover: Translate Y (px)', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => -30,
                        'max' => 30,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .master-testimonial:hover' => 'transform: translateY( {{SIZE}}{{UNIT}} );',
                ],
                50
            ]
        );

        $this->start_controls_tabs( 'box' );

        $this->start_controls_tab(
            'box_normal',
            [
                'label' => __( 'Normal', 'masterlayer' ),
            ]
        );

        $this->add_control(
            'color_heading',
            [
                'label' => __( 'Color', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => __( 'Name Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-testimonial .name' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'role_color',
            [
                'label' => __( 'Role Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-testimonial .role' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'quotes_color',
            [
                'label' => __( 'Quotes Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-testimonial .quotes' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .master-testimonial .quotes svg' => 'fill: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => __( 'Description Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-testimonial .comment' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'bg_heading',
            [
                'label' => __( 'Background', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'box_bg',
                'label' => __( 'Background', 'masterlayer' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .master-testimonial .content-wrap',
            ]
        );

        $this->add_control(
            'border_heading',
            [
                'label' => __( 'Border', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __( 'Border', 'masterlayer' ),
                'selector' => '{{WRAPPER}} .master-testimonial',
            ]
        );

        $this->add_control(
            'rounded_heading',
            [
                'label' => __( 'Rounded', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'shadow_heading',
            [
                'label' => __( 'Box Shadow', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .master-testimonial',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'testimonial_box_hover',
            [
                'label' => __( 'Hover', 'masterlayer' ),
            ]
        );

        $this->add_control(
            'color_heading_hover',
            [
                'label' => __( 'Color', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'name_color_hover',
            [
                'label' => __( 'Name Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-testimonial:hover .name' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'role_color_hover',
            [
                'label' => __( 'Role Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-testimonial:hover .role' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'quote_color_hover',
            [
                'label' => __( 'Quotes Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-testimonial:hover .quotes' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .master-testimonial:hover .quotes svg' => 'fill: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'desc_color_hover',
            [
                'label' => __( 'Description Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-testimonial:hover .comment' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'bg_heading_hover',
            [
                'label' => __( 'Background', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'box_bg_hover',
                'label' => __( 'Background', 'masterlayer' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .master-testimonial .content-wrap',
            ]
        );

        $this->add_control(
            'border_heading_hover',
            [
                'label' => __( 'Border', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border_hover',
                'label' => __( 'Border', 'masterlayer' ),
                'selector' => '{{WRAPPER}} .master-testimonial:hover',
            ]
        );

        $this->add_control(
            'rounded_heading_hover',
            [
                'label' => __( 'Rounded', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'border_radius_hover',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .master-testimonial:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'shadow_heading_hover',
            [
                'label' => __( 'Box Shadow', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_hover',
                'selector' => '{{WRAPPER}} .master-testimonial:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Spacing
        $this->start_controls_section( 'setting_spacing_section',
            [
                'label' => __( 'Spacing', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'padding',
            [
                'label' => __('Content Padding', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-testimonial .content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .master-testimonial .sep' => 'width: calc(100% + {{RIGHT}}{{UNIT}});',
                ],
            ]
        );

        $this->add_responsive_control(
            'name_bottom_margin',
            [
                'label'      => __( 'Name', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .master-testimonial .name' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
                50
            ]
        );

        $this->add_responsive_control(
            'role_bottom_margin',
            [
                'label'      => __( 'Role', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .master-testimonial .role' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
                50
            ]
        );

        $this->add_responsive_control(
            'quotes_bottom_margin',
            [
                'label'      => __( 'Quotes', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .master-testimonial .quotes' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
                50,
                'condition' => [ 
                    'quotes_icon!' => '',
                ]
            ]
        );

        $this->add_responsive_control(
            'comment_bottom_margin',
            [
                'label'      => __( 'Comment', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .master-testimonial .comment' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
                50
            ]
        );

        $this->end_controls_section();

        // Typography
        $this->start_controls_section( 'setting_typography_section',
            [
                'label' => __( 'Typography', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'label' => __('Name', 'masterlayer'),
                'selector' => '{{WRAPPER}} .name'
            ],
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'role_typography',
                'label' => __('Role', 'masterlayer'),
                'selector' => '{{WRAPPER}} .role'
            ],
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'comment_typography',
                'label' => __('Comment', 'masterlayer'),
                'selector' => '{{WRAPPER}} .comment'
            ],
        );

        $this->end_controls_section();
    }

    protected function render() {
        $config = array();
        $cls = $css = $data = "";
        $settings = $this->get_settings_for_display();
        $testimonials = $this->get_settings_for_display( 'testimonials' );

        // Data config for carousel
        $config['column'] = $settings['column'];
        $config['gap'] = $settings['gap'];
        $config['arrowPosition'] = $settings['arrowPosition'];
        $config['arrowMiddleOffset'] = $settings['arrowMiddleOffset'];
        $config['arrowTopOffset'] = $settings['arrowTopOffset'];
        $config['dotOffset'] = $settings['dotOffset'];
        $config['fullRight'] = $settings['fullRight'] == 'true' ? true : false;
        $config['autoPlay'] = $settings['autoPlay'] == 'true' ? true : false;
        $config['prevNextButtons'] = $settings['prevNextButtons'] == 'true' ? true : false;
        $config['pageDots'] = $settings['pageDots'] == 'true' ? true : false;

        $data = 'data-config=\'' . json_encode( $config ) . '\'';
        ?>

        <div class="master-carousel-box" <?php echo $data; ?>>
            <?php
            foreach ( $testimonials as $index => $item ) { 
                $html = $name = $role = $comment = $avatar = $rating = $quotes = "";
                
                // Name
                if ($item['name'])
                    $name = sprintf('<h3 class="name">%1$s</h3>', 
                        esc_html( $item['name'] ) );

                // Role
                if ($item['role'])
                    $role = sprintf('<div class="role">%1$s</div>', 
                        esc_html( $item['role'] ) );

                // Comment
                if ($item['comment'])
                    $comment = sprintf('<div class="comment">%1$s</div>', 
                        $item['comment'] );

                // Avatar 
                if ($item['avatar'])
                    $avatar = sprintf('<div class="avatar"><img alt="Avatar" src="%1$s" /></div>', $item['avatar']['url']);

                // Quotes
                $quotes = sprintf('<div class="quotes">%1$s</div>', $this->render_icon( $settings['quotes_icon'] ) );

                // Rating
                if ( $item['rating']['url'] )
                    $rating = sprintf('<div class="rating"><img alt="Rating" src="%1$s" /></div>', $item['rating']['url']);

                $cls1 = 'mlr-' . rand() . ' item-carousel ';
                $cls1 .= 'elementor-repeater-item-' . $item['_id']
                ?>
                <div class="master-testimonial <?php echo esc_attr( $cls1 ); ?>">
                    <?php echo $avatar; ?>
                    <div class="content-wrap">
                        <div class="info-wrap">
                            <?php
                            echo $name;
                            echo $role;
                            ?>
                        </div>

                        <?php 
                        echo $quotes;
                        echo $comment; 
                        echo $rating;
                        ?>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php
    }

    protected function render_icon( $icon ) {
        $icon_string = '';
        ob_start(); 

        Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] );

        $icon_string = ob_get_clean();
        return $icon_string;
    }

    protected function content_template() {}
}

