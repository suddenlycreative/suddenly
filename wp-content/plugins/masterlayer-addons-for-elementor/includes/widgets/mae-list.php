<?php
/*
Widget Name: List
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_List_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-list';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'List', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-number-field';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {

		$this->start_controls_section(
			'section__content',
			[
				'label' => __( 'Content', 'masterlayer' ),
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label' => __( 'Icon Type', 'masterlayer' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'font',
				'options' => [
					'font' 	 => __( 'Font Icon', 'masterlayer' ),
					'image'  => __( 'Image Icon', 'masterlayer' ),
				]
			]
		);

		$this->add_control(
			'icon_font',
			[
				'label' => __( 'Icon', 'masterlayer' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'fa-regular',
				],
				'condition' => [
					'icon_type' => 'font',
				]
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label' => __( 'Width', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 24,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-list .icon-wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type' => 'image',
				]
			]
		);

		$this->add_control(
	       'image',
	        [
	           'label' => esc_html__( 'Image', 'masterlayer' ),
	           'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			  	'condition' => [
					'icon_type' => 'image',
				]
		    ]
	    );

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'masterlayer' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Construction Technology', 'masterlayer' ),
				'label_block' => true,
				'label_block' => true,
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
			]
		);

		$this->end_controls_section();

		// Style
		$this->start_controls_section(
			'section__style',
			[
				'label' => __( 'Wrap', 'masterlayer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label' => __( 'Border Radius', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-list' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding Box', 'masterlayer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .master-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);


		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bg_color',
				'label' => __( 'Background', 'masterlayer' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .master-list',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .master-list',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'accs_box_shadow',
				'selector' => '{{WRAPPER}} .master-list',
				'separator' => 'before',
			]
		);


		// Number
		$this->end_controls_section();

		$this->start_controls_section(
			'section__style_icon',
			[
				'label' => __( 'Icon', 'masterlayer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-wrap' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Font Size', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 18,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrap i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_top_spacing',
			[
				'label' => __( 'Icon: Top Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrap' => 'padding-top: calc({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_responsive_control(
			'icon_left_spacing',
			[
				'label' => __( 'Icon: Left Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrap' => 'padding-left: calc({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section__style_content',
			[
				'label' => __( 'Content', 'masterlayer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Title
		$this->add_responsive_control(
			'content_spacing',
			[
				'label' => __( 'Content Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 36,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .content-wrap' => 'padding-left: calc({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-list .content-wrap' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .master-list .content-wrap',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<div class="master-list <?php echo 'align-'. $settings['align']; ?>">
			<div class="inner">
		        <div class="icon-wrap">
			        <?php 
			        if ( $settings['icon_font'] ) { ?>
			        	<i class="<?php echo esc_attr( $settings['icon_font']['value'] ); ?>"></i>
			        <?php } ?>
				    <?php 
				    if ($settings['image']) {
				    	echo '<img alt="Icon" src="' . esc_url($settings['image']['url']) . '" />'; 
				    }
				    ?>
		        </div> 

		        <div class="content-wrap">
		            <?php echo $settings['title']; ?>
		        </div>
		    </div>
	    </div>

	    <?php
	}

    protected function content_template() {}
}

