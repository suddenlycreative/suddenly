<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Button extends Widget_Base {
    use \TPCore\Widgets\TPCoreElementFunctions;

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tp-button';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Button', 'tpcore' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'tp-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'tpcore' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'tpcore' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */

    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    } 
	protected function register_controls_section() {

        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // tp_btn_button_group
        $this->start_controls_section(
            'tp_btn_button_group',
            [
                'label' => esc_html__('Button', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_btn_button_show',
            [
                'label' => esc_html__( 'Show Button', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tp_btn_link',
            [
                'label' => esc_html__('Button link', 'tpcore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'tp_btn_link_type' => '1',
                    'tp_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                    'tp_btn_button_show' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'tp_align',
            [
                'label' => esc_html__('Alignment', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'tpcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'tpcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'tpcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        
        // creative animation
        $this->add_control(
			'tp_creative_anima_switcher',
			[
				'label' => esc_html__( 'Active Animation', 'tpcore' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'tpcore   ' ),
				'label_off' => esc_html__( 'No', 'tpcore   ' ),
				'return_value' => 'yes',
				'default' => '0',
                'separator' => 'before',
			]
		);

        $this->add_control(
            'tp_anima_type',
            [
                'label' => __( 'Animation Type', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fadeInUp' => __( 'fadeInUp', 'tpcore' ),
                    'fadeInDown' => __( 'fadeInDown', 'tpcore' ),
                    'fadeInLeft' => __( 'fadeInLeft', 'tpcore' ),
                    'fadeInRight' => __( 'fadeInRight', 'tpcore' ),
                ],
                'default' => 'fadeInUp',
                'frontend_available' => true,
                'style_transfer' => true,
                'condition' => [
                    'tp_creative_anima_switcher' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'tp_anima_dura', [
                'label' => esc_html__('Animation Duration', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('0.3s', 'tpcore'),
                'condition' => [
                    'tp_creative_anima_switcher' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'tp_anima_delay', [
                'label' => esc_html__('Animation Delay', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('0.6s', 'tpcore'),
                'condition' => [
                    'tp_creative_anima_switcher' => 'yes',
                ],
            ]
        );
        
        $this->end_controls_section();

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_link_controls_style('main_button', 'Button Style', '.tp-el-btn');
    }

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
    $settings = $this->get_settings_for_display();

    ?>

<?php if ( $settings['tp_design_style']  == 'layout-2' ): 
    $tp_anima_type = $settings['tp_anima_type']; 
    $tp_anima_dura = $settings['tp_anima_dura']; 
    $tp_anima_delay = $settings['tp_anima_delay']; 
    // Link
    if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', "tp-btn-yellow-border wow blue-bg  wow tp-el-btn " . $tp_anima_type);
        $this->add_render_attribute('tp-button-arg', 'data-wow-duration', $tp_anima_dura);
        $this->add_render_attribute('tp-button-arg', 'data-wow-delay', $tp_anima_delay);
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', "tp-btn-yellow-border wow blue-bg  wow tp-el-btn " . $tp_anima_type);
            $this->add_render_attribute('tp-button-arg', 'data-wow-duration', $tp_anima_dura);
            $this->add_render_attribute('tp-button-arg', 'data-wow-delay', $tp_anima_delay);
        }
    }
?>

<a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?> ><?php echo tp_kses($settings['tp_btn_text']); ?> <i class="far fa-angle-right"></i></a>


<?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
    $tp_anima_type = $settings['tp_anima_type']; 
    $tp_anima_dura = $settings['tp_anima_dura']; 
    $tp_anima_delay = $settings['tp_anima_delay']; 
    // Link
    if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', "tp-btn tp-btn-hover alt-color-black  wow tp-el-btn " . $tp_anima_type);
        $this->add_render_attribute('tp-button-arg', 'data-wow-duration', $tp_anima_dura);
        $this->add_render_attribute('tp-button-arg', 'data-wow-delay', $tp_anima_delay);
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', "tp-btn tp-btn-hover alt-color-black  wow tp-el-btn " . $tp_anima_type);
            $this->add_render_attribute('tp-button-arg', 'data-wow-duration', $tp_anima_dura);
            $this->add_render_attribute('tp-button-arg', 'data-wow-delay', $tp_anima_delay);
        }
    }
?>

<a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
    <span><?php echo tp_kses($settings['tp_btn_text']); ?></span>
    <b></b>
</a>

<?php else: 
    $tp_anima_type = $settings['tp_anima_type']; 
    $tp_anima_dura = $settings['tp_anima_dura']; 
    $tp_anima_delay = $settings['tp_anima_delay']; 
    // Link
    if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', "tp-btn-blue-lg tp-btn-hover mb-10 alt-color-black wow tp-el-btn " . $tp_anima_type);
        $this->add_render_attribute('tp-button-arg', 'data-wow-duration', $tp_anima_dura);
        $this->add_render_attribute('tp-button-arg', 'data-wow-delay', $tp_anima_delay);
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', "tp-btn-blue-lg tp-btn-hover mb-10 alt-color-black wow tp-el-btn " . $tp_anima_type);
            $this->add_render_attribute('tp-button-arg', 'data-wow-duration', $tp_anima_dura);
            $this->add_render_attribute('tp-button-arg', 'data-wow-delay', $tp_anima_delay);
        }
    }
?>	

<a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?> >
    <span><?php echo tp_kses($settings['tp_btn_text']); ?></span>
    <b></b>
</a>

<?php endif;
	}
}

$widgets_manager->register( new TP_Button() );