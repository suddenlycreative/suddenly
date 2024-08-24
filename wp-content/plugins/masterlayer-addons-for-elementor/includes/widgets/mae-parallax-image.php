<?php
/*
Widget Name: Parallax Image
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
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
use Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Parallax_Image_Widget extends Widget_Base{

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'parallaxScroll', 'waitforimages' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-parallax-image';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'Parallax Image', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-image-box';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {

		$this->start_controls_section(
			'section_testimonials',
			[
				'label' => __( 'Parallax Images', 'masterlayer' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'pimage',
			[
				'label' => __( 'Image', 'masterlayer' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'width',
			[
				'label' => __( 'Width', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [ 
					'{{WRAPPER}} {{CURRENT_ITEM}}.master-parallax-item' => 'max-width: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$repeater->add_control(
			'parallax_heading',
			[
				'label' => __( 'Parallax', 'masterlayer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

		$repeater->add_control(
			'parallax_x',
			[
				'label' => __( 'Parallax X', 'masterlayer' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '',
			]
		);

		$repeater->add_control(
			'parallax_y',
			[
				'label' => __( 'Parallax Y', 'masterlayer' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '',
			]
		);

		$repeater->add_control(
			'smoothness',
			[
				'label' => __( 'Smoothness', 'masterlayer' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '30',
			]
		);

		$repeater->add_control(
			'position_heading',
			[
				'label' => __( 'Position', 'masterlayer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

		$repeater->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'masterlayer' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'masterlayer' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'masterlayer' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'left'
            ]
        );

		$repeater->add_responsive_control(
            'top_offset',
            [
                'label'      => __( 'Top Offset', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min' => -200,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-parallax-item' => 'top: {{SIZE}}{{UNIT}};',
                ],
                50
            ]
        );

        $repeater->add_responsive_control(
            'left_offset',
            [
                'label'      => __( 'Left Offset', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min' => -200,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-parallax-item' => 'left: {{SIZE}}{{UNIT}};',
                ],
                50,
                'condition' => [ 'align' => 'left', ]
            ]
        );

        $repeater->add_responsive_control(
            'right_offset',
            [
                'label'      => __( 'Right Offset', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-parallax-item' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
                ],
                50,
                'condition' => [ 'align' => 'right', ]
            ]
        );

        $repeater->add_control(
			'decor_heading',
			[
				'label' => __( 'Decoration', 'masterlayer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

		$repeater->add_control(
            'border_radius',
            [
                'label' => __('Image Rounded', 'masterlayer'),
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
                    '{{WRAPPER}} {{CURRENT_ITEM}}.master-parallax-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'pborder',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.master-parallax-item',
			]
		);

		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pbox_shadow',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.master-parallax-item',
			]
		);

		$this->add_control(
		    'pls',
		    [
		        'label'       => '',
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => false,
		        'default'     => [
		            [
		                'pimage'  => [
							'url' => Utils::get_placeholder_image_src(),
						],
		            ],
		            [
		                'pimage'  => [
							'url' => Utils::get_placeholder_image_src(),
						],
		            ]
		        ],
		        'fields'      => $repeater->get_controls(),
		        'title_field' => false,
		    ]
		);


		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="master-parallax-box">
			<div class="parallax-wrap">
				<?php if ( ! empty( $settings['pls'] ) ) : foreach ( $settings['pls'] as $pl ) : ?>
					<?php
					$cls = $css = $img = "";
					if ( $pl['pimage']['url'] ) $img = '<img src="'. $pl['pimage']['url'] .'" alt="">';
					
					$cls = 'elementor-repeater-item-' . $pl['_id'];
					printf(
						'<div class="master-parallax-item %2$s" style="" data-parallax=\'{"x" : %3$s, "y" : %4$s, "smoothness" : %5$s}\' data-top="%6$s">%1$s</div>',
						$img,
						$cls,
						intval( $pl['parallax_x'] ),
						intval( $pl['parallax_y'] ),
						intval( $pl['smoothness'] ),
						$pl['top_offset']['size'].$pl['top_offset']['unit']
					);
					?>
				<?php endforeach; endif; ?>
			</div>
		</div>
	    <?php
	}

	protected function content_template() {}
}

