<?php
/*
Widget Name: Link
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Headings_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-headings';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'Headings', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-heading';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'masterlayer' ),
			]
		);

		$this->add_control(
			'title__content',
			[
				'label' => __( 'Pre-Heading & Heading & Sub-Heading', 'masterlayer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

		$this->add_control(
			'pre',
			[
				'label' => '',
				'type' => Controls_Manager::TEXT,
				'default' => __( 'OUR SERVICES', 'masterlayer' ),
				'placeholder' => __( 'Enter your pre-heading', 'masterlayer' ),
				'label_block' => true,
				'show_label' => false,
			]
		);

		$this->add_control(
			'heading',
			[
				'label' => '',
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'What we focus', 'masterlayer' ),
				'placeholder' => __( 'Enter your heading', 'masterlayer' ),
				'show_label' => false,
				'label_block' => true,
			]
		);

		$this->add_control(
			'sub',
			[
				'label' => '',
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'We work on a wide range of building typologies and projects', 'masterlayer' ),
				'placeholder' => __( 'Enter your sub-heading', 'masterlayer' ),
				'label_block' => true,
				'show_label' => false,
			]
		);

		$this->add_control(
			'show_divider',
			[
				'label' => __( 'Show Divider', 'masterlayer' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'masterlayer' ),
				'label_off' => __( 'Hide', 'masterlayer' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'masterlayer' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'masterlayer' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'masterlayer' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'masterlayer' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'left',
				'prefix_class' => 'align-%s'
			]
		);

		$this->end_controls_section();

		// Style
		$this->start_controls_section(
			'section__style',
			[
				'label' => __( 'Headings', 'masterlayer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		// Pre-Heading
		$this->add_control(
			'title_pre_heading',
			[
				'label' => __( 'Pre-Heading', 'masterlayer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			'condition' => [ 'pre!' => '' ]
			]
		);
		$this->add_control(
			'pre-heading_color',
			[
				'label' => __( 'Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-heading .pre-heading' => 'color: {{VALUE}};',
				],
			'condition' => [ 'pre!' => '' ]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pre_heading_typography',
				'selector' => '{{WRAPPER}} .master-heading .pre-heading',
				'condition' => [ 'pre!' => '' ]
			]
		);
		$this->add_responsive_control(
			'pre_heading_bottom_space',
			[
				'label' => __( 'Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 14,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-heading .pre-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'pre!' => '' ]
			]
		);
		$this->add_responsive_control(
			'pre_heading_max_width',
			[
				'label' => __( 'Max Width', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 300,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-heading .pre-heading' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'pre!' => '' ]
			]
		);

		// Heading
		$this->add_control(
			'title__heading',
			[
				'label' => __( 'Heading', 'masterlayer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [ 'heading!' => '' ]
			]
		);
		$this->add_control(
			'heading_color',
			[
				'label' => __( 'Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-heading .main-heading' => 'color: {{VALUE}};',
				],
				'condition' => [ 'heading!' => '' ]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'selector' => '{{WRAPPER}} .master-heading h2',
				'condition' => [ 'heading!' => '' ]
			]
		);
		$this->add_responsive_control(
			'heading_bottom_space',
			[
				'label' => __( 'Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 22,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-heading .main-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'heading!' => '' ]
			]
		);
		$this->add_responsive_control(
			'heading_max_width',
			[
				'label' => __( 'Max Width', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 300,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-heading .main-heading' => 'max-width: {{SIZE}}{{UNIT}};',
				'condition' => [ 'heading!' => '' ]],
			]
		);


		// Sub-Heading
		$this->add_control(
			'title__sub_heading',
			[
				'label' => __( 'Sub-Heading', 'masterlayer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [ 'sub!' => '' ]
			]
		);
		$this->add_control(
			'sub_heading_color',
			[
				'label' => __( 'Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-heading .sub-heading' => 'color: {{VALUE}};',
				],
				'condition' => [ 'sub!' => '' ]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_heading_typography',
				'selector' => '{{WRAPPER}} .master-heading .sub-heading',
				'condition' => [ 'sub!' => '' ]
			]
		);
		$this->add_responsive_control(
			'sub_heading_bottom_space',
			[
				'label' => __( 'Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 43,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-heading .sub-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'sub!' => '' ]
			]
		);
		$this->add_responsive_control(
			'sub_heading_max_width',
			[
				'label' => __( 'Max Width', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 300,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-heading .sub-heading' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'sub!' => '' ]
			]
		);


		// Divider
		$this->add_control(
			'title__divider',
			[
				'label' => __( 'Divider', 'masterlayer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_divider' => 'yes',
				]
			]
		);

		$this->add_control(
			'divider_bg_color',
			[
				'label' => __( 'Background Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-heading .divider' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'show_divider' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'divider_width',
			[
				'label' => __( 'Width', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-heading .divider' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_divider' => 'yes',
				]
			]
		);
		$this->add_responsive_control(
			'divider_height',
			[
				'label' => __( 'Height', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-heading .divider' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_divider' => 'yes',
				]
			]
		);
		$this->add_responsive_control(
			'divider_radius',
			[
				'label' => __( 'Border Raidus', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-heading .divider' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_divider' => 'yes',
				]
			]
		);
		$this->add_responsive_control(
			'divider_bottom_space',
			[
				'label' => __( 'Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-heading .divider' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_divider' => 'yes',
				]
			]
		);


		$this->end_controls_section(); 
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="master-heading">
	        <?php if ( ! empty( $settings['pre'] ) ) { ?>
	            <div class="pre-heading"><?php echo $settings['pre']; ?></div>
	        <?php } ?>

	        <?php if ( ! empty( $settings['heading'] ) ) { ?>
	        <h2 class="main-heading"><?php echo $settings['heading']; ?></h2>
	        <?php } ?>

	        <?php if ( 'yes' === $settings['show_divider'] ) { ?>
	        <div class="divider"></div>
	        <?php } ?>

	        <?php if ( ! empty( $settings['sub'] ) ) { ?>
	            <div class="sub-heading"><?php echo $settings['sub']; ?></div>
	        <?php } ?>
	    </div>
	    <?php
	}

    protected function content_template() {}
}

