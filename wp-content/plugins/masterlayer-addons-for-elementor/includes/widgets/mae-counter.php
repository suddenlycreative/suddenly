<?php
/*
Widget Name: Counter
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

class MAE_Counter_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'appear', 'countto' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-counter';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'Counter', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-counter';
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
			'style',
			[
				'label' 	=> __( 'Style', 'masterlayer' ),
				'type'  	=> Controls_Manager::SELECT,
				'default' 	=> 's1',
				'options' 	=> [
					's1'  => __( 'Number Top', 'masterlayer' ),
					's2'  => __( 'Number Bottom', 'masterlayer' ),
				]
			]
		);

		$this->add_control(
			'icon_inline',
			[
				'label' => __( 'Icon Inline', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'masterlayer' ),
				'label_off' => __( 'No', 'masterlayer' ),
				'return_value' => 'yes',
				'default' => 'no',
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
					'value' => 'far fa-chart-bar',
					'library' => 'fa-regular',
				],
			]
		);

 		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'masterlayer' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Projects Done', 'masterlayer' ),
			]
		);

		$this->add_control(
			'number',
			[
				'label' => 'Number',
				'type' => Controls_Manager::TEXT,
				'default' => __( '7200', 'masterlayer' ),
			]
		);

		$this->add_control(
			'suffix',
			[
				'label' => __( 'Number Suffix', 'masterlayer' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'duration',
			[
				'label' => __( 'Duration', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 1000,
						'max'  => 10000,
						'step' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2000,
				],
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
			]
		);

		$this->end_controls_section();

		// Style
		$this->start_controls_section(
			'section_style_general',
			[
				'label' => __( 'General', 'masterlayer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
			'wrap__heading',
			[
				'label' => __( 'Wrap', 'masterlayer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after'
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bg_color',
				'label' => __( 'Background', 'masterlayer' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .master-counter',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .master-counter',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'accs_box_shadow',
				'selector' => '{{WRAPPER}} .master-counter',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'text__heading',
			[
				'label' => __( 'Icon, Title, Number', 'masterlayer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after'
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-wrap' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'number_color',
			[
				'label' => __( 'Number Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .number-wrap span' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
            'box_hover',
            [
                'label' => __( 'Hover', 'masterlayer' ),
            ]
        );
        $this->add_control(
			'wrap__heading_hover',
			[
				'label' => __( 'Wrap', 'masterlayer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after'
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bg_color_hover',
				'label' => __( 'Background', 'masterlayer' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .master-counter:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border_hover',
				'selector' => '{{WRAPPER}} .master-counter:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'accs_box_shadow_hover',
				'selector' => '{{WRAPPER}} .master-counter:hover',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'text__heading_hover',
			[
				'label' => __( 'Icon, Number, Title', 'masterlayer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after'
			]
		);
		$this->add_control(
			'icon_color_hover',
			[
				'label' => __( 'Icon Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-counter:hover .icon-wrap' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'number_color_hover',
			[
				'label' => __( 'Number Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-counter:hover .number-wrap span' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label' => __( 'Title Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-counter:hover .title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section__style',
			[
				'label' => __( 'Wrap', 'masterlayer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Wrap
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
					'{{WRAPPER}} .master-counter' => 'border-radius: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .master-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section__style_icon',
			[
				'label' => __( 'Icon', 'masterlayer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Icon
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Font Size', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 46,
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
					'size' => 8,
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
			'section__style_number',
			[
				'label' => __( 'Number', 'masterlayer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Number
		$this->add_control(
			'heading__number',
			[
				'label' => __( 'Number', 'masterlayer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'number_left_spacing',
			[
				'label' => __( 'Number: Left Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .number-wrap' => 'padding-left: calc({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_responsive_control(
			'number_top_spacing',
			[
				'label' => __( 'Number: Top Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .number-wrap' => 'padding-top: calc({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .number-wrap span',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section__style_title',
			[
				'label' => __( 'Title', 'masterlayer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Title
		$this->add_responsive_control(
			'title_left_spacing',
			[
				'label' => __( 'Title: Left Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'padding-left: calc({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_responsive_control(
			'title_top_spacing',
			[
				'label' => __( 'Title: Top Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'padding-top: calc({{SIZE}}{{UNIT}});',
				],
				'condition' => [
					'style' => 's1',
				]
			]
		);
		$this->add_responsive_control(
			'title_bottom_spacing',
			[
				'label' => __( 'Title: Bottom Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'padding-bottom: calc({{SIZE}}{{UNIT}});',
				],
				'condition' => [
					'style' => 's2',
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .title',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'master-counter' );
		if ( $settings['align'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'align-'. $settings['align'] );
		}
		if ( 'yes' === $settings['icon_inline'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'icon-inline-'. $settings['icon_inline'] );
		}

		?>
		<?php if ( $settings['style'] === 's1' ) {  ?>
			<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
				<div class="inner">
			        <div class="icon-wrap">
				        <?php if ( $settings['icon_font']['value'] ) { ?><i class="<?php echo esc_attr( $settings['icon_font']['value'] ); ?>"></i><?php } ?>
			        </div>

			        <div class="number-wrap">
				        <span class="number" data-to="<?php echo $settings['number']; ?>" data-time= "<?php echo $settings['duration']['size']; ?>"></span><span><?php echo $settings['suffix']; ?></span>
			        </div>
			    </div>
			    <h4 class="title"><?php echo $settings['title']; ?></h4>
		    </div>
		<?php } else { ?>
			<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
				<h4 class="title"><?php echo $settings['title']; ?></h4>
				<div class="inner">
			        <div class="icon-wrap">
				        <?php if ( $settings['icon_font']['value'] ) { ?><i class="<?php echo esc_attr( $settings['icon_font']['value'] ); ?>"></i><?php } ?>
			        </div>

			        <div class="number-wrap">
				        <span class="number" data-to="<?php echo $settings['number']; ?>" data-time= "<?php echo $settings['duration']['size']; ?>"></span><span><?php echo $settings['suffix']; ?></span>
			        </div>
			    </div>
		    </div>
	    <?php } ?>
	    <?php
	}

    protected function content_template() {}
}

