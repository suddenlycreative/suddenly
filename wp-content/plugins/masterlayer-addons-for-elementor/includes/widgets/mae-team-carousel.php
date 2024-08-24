<?php
/*
Widget Name: Team Carousel
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

class MAE_Team_Carousel_Widget extends Widget_Base {

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
        return 'mae-team-carousel';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'Team Carousel', 'masterlayer' );
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
            'name',
            [
                'label'   => __( 'Member Name', 'masterlayer' ),
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
                'label'   => __( 'Member Role', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Manager', 'masterlayer' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'url',
            [
                'label'      => __( 'Bio URL', 'masterlayer'),
                'type'       => Controls_Manager::URL,
                'dynamic'    => [
                    'active'        => true,
                    'categories'    => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY
                    ],
                ],
                'placeholder'       => 'https://www.your-link.com',
                'default'           => [
                    'url' => '#',
                ]
            ]
        );

        $repeater->add_control(
            'avatar',
            [
                'label'   => __( 'Avatar', 'masterlayer' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src(), ]
            ],
        );

        $repeater->add_control(
            'desc',
            [
                'label'      => __( 'Description', 'masterlayer' ),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => __( 'We believe architecture and design are critically important to addressing the most pressing challenges of our time.', 'masterlayer' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'teams',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'name'  => __( 'Member #1', 'masterlayer' ),
                    ],
                    [
                        'name'  => __( 'Member #2', 'masterlayer' ),
                    ],
                    [
                        'name'  => __( 'Member #3', 'masterlayer' ),
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
                'selectors' => [
                    '{{WRAPPER}} .master-team .content-wrap' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sep',
            [
                'label'     => __( 'Separator', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'sep-before',
                'options'   => [
                    ''            => __( 'None', 'masterlayer'),
                    'sep-before'      => __( 'Before Description', 'masterlayer'),
                    'sep-after'       => __( 'After Description', 'masterlayer'),
                ]
            ]
        );

        // $this->add_control(
        //     'url_heading',
        //     [
        //         'label' => __( 'URL', 'masterlayer' ),
        //         'type' => Controls_Manager::HEADING,
        //         'separator' => 'after'
        //     ]
        // );

        // $this->add_control(
        //     'url_type',
        //     [
        //         'label'     => __( 'URL Type', 'masterlayer'),
        //         'type'      => Controls_Manager::SELECT,
        //         'default'   => 'none',
        //         'options'   => [
        //             'none'      => __( 'None', 'masterlayer'),
        //             'link'      => __( 'Link', 'masterlayer'),
        //             'button'    => __( 'Button', 'masterlayer'),
        //             'name'    => __( 'Member Name', 'masterlayer'),
        //         ],
        //     ]
        // );

        $this->add_control(
            'url_text',
            [
                'label'     => __( 'URL Text', 'masterlayer'),
                'type'      => Controls_Manager::TEXT,
                'dynamic'   => [
                    'active'   => true,
                ],
                'default'   => __( 'Learn More', 'masterlayer'),
                'condition' => [ 'url_type!' => [ 'none', 'name' ] ]
            ]
        );

        $this->add_control(
            'link_icon_position',
            [
                'label'     => __( 'Has Icon ?', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'right',
                'options'   => [
                    'none'      => __( 'None', 'masterlayer'),
                    'left'      => __( 'Icon Left', 'masterlayer'),
                    'right'     => __( 'Icon Right', 'masterlayer')
                ],
                'condition' => [ 'url_type' => 'link' ]
            ]
        );

        $this->add_control(
            'link_icon',
            [
                'label' => __( 'Link Icon', 'masterlayer' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fa fa-arrow-right',
                    'library' => 'solid',
                ],
                'label_block'      => false,
                'skin'             => 'inline',
                'condition' => [ 
                    'link_icon_position!' => 'none', 
                    'url_type' => 'link',
                ]
            ]
        );

        // Button
        $this->add_control(
            'button_style',
            [
                'label'     => __( 'Button Style', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'btn-accent',
                'options'   => [
                    'btn-accent'      => __( 'Accent', 'masterlayer'),
                    'btn-white'       => __( 'White', 'masterlayer'),
                    'btn-outline'     => __( 'Outline', 'masterlayer')
                ],
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->add_control(
            'button_icon_position',
            [
                'label'     => __( 'Has Icon ?', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'right',
                'options'   => [
                    'none'      => __( 'None', 'masterlayer'),
                    'left'      => __( 'Icon Left', 'masterlayer'),
                    'right'     => __( 'Icon Right', 'masterlayer')
                ],
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label' => __( 'Button Icon', 'masterlayer' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fa fa-arrow-right',
                    'library' => 'solid',
                ],
                'label_block'      => false,
                'skin'             => 'inline',
                'condition' => [ 
                    'button_icon_position!' => 'none', 
                    'url_type' => 'button',
                ]
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
                    '{{WRAPPER}} .master-team .team-name' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'role_color',
            [
                'label' => __( 'Role Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-team .team-role' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => __( 'Description Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-team .desc' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'sep_color',
            [
                'label' => __( 'Separator Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sep' => 'background-color: {{VALUE}};',
                ],
                'condition' => [ 'sep!' => '' ]
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
                'selector' => '{{WRAPPER}} .master-team .content-wrap',
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
                'selector' => '{{WRAPPER}} .master-team',
                'fields_options' => [
                    'border' => [ 'default' => 'solid', ],
                    'width' => [ 
                        'default' => [
                            'top' => 1,
                            'left' => 1,
                            'bottom' => 1,
                            'right' => 1,
                        ] 
                    ]
                ],
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
                    '{{WRAPPER}} .master-team' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .master-team',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'team_box_hover',
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
                    '{{WRAPPER}} .master-team:hover .team-name' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'role_color_hover',
            [
                'label' => __( 'Role Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-team:hover .team-role' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'desc_color_hover',
            [
                'label' => __( 'Description Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-team:hover .desc' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'sep_color_hover',
            [
                'label' => __( 'Separator Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-team:hover .sep' => 'background-color: {{VALUE}};',
                ],
                'condition' => [ 'sep!' => '' ]
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
                'selector' => '{{WRAPPER}} .master-team .content-wrap',
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
                'selector' => '{{WRAPPER}} .master-team:hover',
                'fields_options' => [
                    'border' => [ 'default' => 'solid', ],
                    'width' => [ 
                        'default' => [
                            'top' => 1,
                            'left' => 1,
                            'bottom' => 1,
                            'right' => 1,
                        ] 
                    ]
                ],
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
                    '{{WRAPPER}} .master-team:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .master-team:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // URL
        $this->start_controls_section( 'style_url_section',
            [
                'label' => __( 'URL', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [ 'url_type!' => 'none' ]
            ]
        );

        $this->add_control(
            'name_color_self_hover',
            [
                'label' => __( 'Member Name Hover Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-team .team-name:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'name',
                ]
            ]
        );

        // URL - Link      
        $this->add_responsive_control(
            'link_icon_font_size',
            [
                'label'      => __( 'Icon Font Size', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                    '%' => [
                        'min' => 50,
                        'max' => 150,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .master-link .icon ' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                50,
                'condition' => [ 
                    'link_icon_position!' => 'none', 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->add_control(
            'link_icon_margin',
            [
                'label' => __('Icon Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .master-link .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'link_icon_position!' => 'none', 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->start_controls_tabs( 'link_hover_tabs' );

        // Link normal
        $this->start_controls_tab(
            'link_normal',
            [
                'label' => __( 'Normal', 'masterlayer' ),
                'condition' => [ 'url_type' => 'link' ]
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label' => __( 'Text Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-link' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->add_control(
            'link_icon_color',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-link .icon' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'link_icon_position!' => 'none', 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->end_controls_tab();

        // Box hover
        $this->start_controls_tab(
            'link_box_hover',
            [
                'label' => __( 'Box Hover', 'masterlayer' ),
                'condition' => [ 'url_type' => 'link' ]
            ]
        );

        $this->add_control(
            'link_color_box_hover',
            [
                'label' => __( 'Text Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-team:hover .master-link' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->add_control(
            'link_icon_color_box_hover',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-team:hover .master-link .icon' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'link_icon_position!' => 'none', 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->end_controls_tab();

        // Link hover
        $this->start_controls_tab(
            'link_hover',
            [
                'label' => __( 'URL Hover', 'masterlayer' ),
                'condition' => [ 'url_type' => 'link' ]
            ]
        );

        $this->add_control(
            'link_color_hover',
            [
                'label' => __( 'Text Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-link:hover' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [ 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->add_control(
            'link_icon_color_hover',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-link:hover .icon' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [ 
                    'link_icon_position!' => 'none', 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        // URL - Button     

        $this->add_responsive_control(
            'button_icon_font_size',
            [
                'label'      => __( 'Icon Font Size', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                    '%' => [
                        'min' => 50,
                        'max' => 150,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .master-button .icon ' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                50,
                'condition' => [ 
                    'button_icon_position!' => 'none', 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_icon_margin',
            [
                'label' => __('Icon Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .master-button .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'button_icon_position!' => 'none', 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->start_controls_tabs( 'button_hover_tabs' );

        // Button normal
        $this->start_controls_tab(
            'button_normal',
            [
                'label' => __( 'Normal', 'masterlayer' ),
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Text Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-button' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_icon_color',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-button .icon' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'button_icon_position!' => 'none', 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-button' => 'background-color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_rounded',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => __( 'Border Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-button' => 'border-color: {{VALUE}};'
                ],
                'condition' => [ 
                    'url_type' => 'button',
                    'button_style' => [ 'btn-outline' ]
                ]
            ]
        );

        $this->add_control(
            'button_border_width',
            [
                'label' => __('Border Width', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => 1,
                    'right' => 1,
                    'bottom' => 1,
                    'left' => 1,
                    'unit' => 'px',
                    'isLinked' => true
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                    'button_style' => [ 'btn-outline' ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .master-button',
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->end_controls_tab();

        // Box hover
        $this->start_controls_tab(
            'button_box_hover',
            [
                'label' => __( 'Box Hover', 'masterlayer' ),
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->add_control(
            'button_color_box_hover',
            [
                'label' => __( 'Text Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-team:hover .master-button' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_icon_color_box_hover',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-team:hover .master-button .icon' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'button_icon_position!' => 'none', 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_bg_color_box_hover',
            [
                'label' => __( 'Background Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-team:hover .master-button' => 'background-color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_rounded_box_hover',
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
                    '{{WRAPPER}} .master-team:hover .master-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_border_color_box_hover',
            [
                'label' => __( 'Border Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-team:hover .master-button' => 'border-color: {{VALUE}};'
                ],
                'condition' => [ 
                    'url_type' => 'button',
                    'button_style' => [ 'btn-outline' ]
                ]
            ]
        );

        $this->add_control(
            'button_border_width_box_hover',
            [
                'label' => __('Border Width', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => 1,
                    'right' => 1,
                    'bottom' => 1,
                    'left' => 1,
                    'unit' => 'px',
                    'isLinked' => true
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-team:hover .master-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                    'button_style' => [ 'btn-outline' ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow_box_hover',
                'selector' => '{{WRAPPER}} .master-team:hover .master-button',
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->end_controls_tab();

        // Button hover
        $this->start_controls_tab(
            'button_hover',
            [
                'label' => __( 'URL Hover', 'masterlayer' ),
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->add_control(
            'button_color_hover',
            [
                'label' => __( 'Text Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-button:hover' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_icon_color_hover',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-button:hover .icon' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [ 
                    'button_icon_position!' => 'none', 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label' => __( 'Background Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-team .master-button:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_rounded_hover',
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
                    '{{WRAPPER}} .master-team .master-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label' => __( 'Border Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-team .master-button:hover' => 'border-color: {{VALUE}};'
                ],
                'condition' => [ 
                    'url_type' => 'button',
                    'button_style' => [ 'btn-outline' ]
                ]
            ]
        );

        $this->add_control(
            'button_border_width_hover',
            [
                'label' => __('Border Width', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => 1,
                    'right' => 1,
                    'bottom' => 1,
                    'left' => 1,
                    'unit' => 'px',
                    'isLinked' => true
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-team .master-button:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                    'button_style' => [ 'btn-outline' ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow_hover',
                'selector' => '{{WRAPPER}} .master-team .master-button:hover',
                'condition' => [ 'url_type' => 'button' ]
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
                    '{{WRAPPER}} .master-team .content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .master-team .sep' => 'width: calc(100% + {{RIGHT}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'name_margin',
            [
                'label' => __('Name Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-team .headline-2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'role_margin',
            [
                'label' => __('Role Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-team .headline-2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'sep_margin',
            [
                'label' => __('Separator Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-team .sep' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'desc_margin',
            [
                'label' => __('Description Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-team .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                'label' => __('Heading', 'masterlayer'),
                'selector' => '{{WRAPPER}} .team-name'
            ],
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'role_typography',
                'label' => __('Heading', 'masterlayer'),
                'selector' => '{{WRAPPER}} .team-role'
            ],
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'label' => __('Description', 'masterlayer'),
                'selector' => '{{WRAPPER}} .desc'
            ],
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'link_typography',
                'label' => __('Link', 'masterlayer'),
                'selector' => '{{WRAPPER}} .master-link',
                'condition' => [ 'url_type' => 'link' ]
            ],
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __('Button', 'masterlayer'),
                'selector' => '{{WRAPPER}} .master-button',
                'condition' => [ 'url_type' => 'button' ]
            ],
        );

        $this->end_controls_section();
    }

    protected function render() {
        $config = array();
        $cls = $css = $data = "";
        $settings = $this->get_settings_for_display();
        $teams = $this->get_settings_for_display( 'teams' );

        $cls .=  'mlr-' . rand();

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

        <div class="master-carousel-box <?php echo esc_attr( $cls ); ?>" <?php echo $data; ?>>
            <?php
            foreach ( $teams as $index => $item ) { 
                $html = $name = $role = $desc = $avatar = $icon = $url = "";
                
                // Name
                if ($item['name'])
                    $name = sprintf('<h3 class="team-name"><a href="%2$s">%1$s</a></h3>', 
                        esc_html( $item['name'] ),
                        esc_url( $item['url']['url'] ) );

                // Role
                if ($item['role'])
                    $role = sprintf('<span class="team-role">%1$s</span>', 
                        esc_html( $item['role'] ) );

                // Description
                if ($item['desc'])
                    $desc = sprintf('<div class="desc">%1$s</div>', 
                        $item['desc'] );

                // Separator
                if ($settings['sep'] == 'sep-before')
                    $desc = '<div class="sep"></div>' . $desc;
                if ($settings['sep'] == 'sep-after')
                    $desc .= '<div class="sep"></div>';

                // Avatar URL
                if ($item['avatar'])
                    $avatar = sprintf('<div class="avatar"><a href="%2$s"><img alt="Avatar" src="%1$s" /></a></div>', 
                        $item['avatar']['url'],
                        esc_url($item['url']['url'])
                    );
            
                // HTML render
                $team_cls = ' item-carousel ' . $settings['sep'];

                ?>
                <div class="master-team <?php echo esc_attr($team_cls); ?>">
                    <?php echo $avatar; ?>
                    <div class="content-wrap">
                        <div class="team-info">
                            <?php
                            echo $name;
                            echo $role;
                            ?>
                        </div>

                        <?php echo $desc; ?>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php
    }

    protected function content_template() {}
}

