<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Platform_Area extends Widget_Base {

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
		return 'tp-platform-area';
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
		return __( 'Platform Area', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // Platform Info Repeater
        $this->start_controls_section(
            'tp_platform_area',
            [
                'label' => esc_html__('Platform List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'tpcore' ),
                    'style_2' => __( 'Style 2', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_platform_area_number', [
                'label' => esc_html__('Number', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('17', 'tpcore'),
            ]
        );
        $repeater->add_control(
            'tp_platform_area_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Food', 'tpcore'),
                'label_block' => true,
            ]
        );         
        $repeater->add_control(
            'tp_platform_area_des',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => 'use after content like syamble or other icon',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Blocks infected website tracking programs and annoying.', 'tpcore'),
                'label_block' => true,
            ]
        ); 

        $repeater->add_control(
            'tp_platform_active_switch',
            [
              'label'        => esc_html__( 'Platform Active', 'tpcore' ),
              'type'         => \Elementor\Controls_Manager::SWITCHER,
              'label_on'     => esc_html__( 'Show', 'tpcore' ),
              'label_off'    => esc_html__( 'Hide', 'tpcore' ),
              'return_value' => 'yes',
              'default'      => '0',
            ]
        );

        $this->add_control(
            'tp_platform_area_list',
            [
                'label' => esc_html__('Fact - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_platform_area_number' => esc_html__('01.', 'tpcore'),
                        'tp_platform_area_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_platform_area_number' => esc_html__('02.', 'tpcore'),
                        'tp_platform_area_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_platform_area_number' => esc_html__('03.', 'tpcore'),
                        'tp_platform_area_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_platform_area_title }}}',
            ]
        );
        $this->end_controls_section();

        
        // thumbnail image
        $this->start_controls_section(
        'tp_thumbnail_section',
            [
                'label' => esc_html__( 'Thumbnail', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_thumbnail_image',
            [
                'label' => esc_html__( 'Choose Thumbnail Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_thumbnail_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
            
        $this->end_controls_section();
        
        // platform shape
        $this->start_controls_section(
        'tp_platform_shape',
            [
                'label' => esc_html__( 'Platform Area Shape', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );

        $this->add_control(
        'tp_platform_shape_switch',
        [
            'label'        => esc_html__( 'Shape On/Off', 'tpcore' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'tpcore' ),
            'label_off'    => esc_html__( 'Hide', 'tpcore' ),
            'return_value' => 'yes',
            'default'      => '0',
        ]
        );

        $this->add_control(
            'tp_shape_image_1',
            [
                'label' => esc_html__( 'Choose Shape Image 1', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_platform_shape_switch' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'condition' => [
                    'tp_platform_shape_switch' => 'yes'
                ]
            ]
        );
        
        $this->end_controls_section();

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('platform_area_section', 'Section - Style', '.tp-el-section');
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
    // thumbnail image
    if ( !empty($settings['tp_thumbnail_image']['url']) ) {
        $tp_thumbnail_image = !empty($settings['tp_thumbnail_image']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image']['url'];
        $tp_thumbnail_image_alt = get_post_meta($settings["tp_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
    }
    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
	$this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>

<div class="tp-platform-area tp-platform-inner pt-120 p-relative z-index">
    <div class="container">
        <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
        <div class="row align-items-end mb-60">
            <div class="col-xl-7 col-lg-6 wow tpfadeLeft" data-wow-duration=".9s" data-wow-delay=".3s">
                <div class="tp-platform-section-box">
                    <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                    <h5 class="inner-section-subtitle pb-10"><?php echo tp_kses($settings['tp_section_sub_title']); ?></h5>
                    <?php endif; ?>
                    <?php
                    if ( !empty($settings['tp_section_title' ]) ) :
                        printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['tp_section_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        tp_kses( $settings['tp_section_title' ] )
                        );
                    endif;
                    ?>
                </div>
            </div>
            <div class="col-xl-5 col-lg-6  wow tpfadeRight" data-wow-duration=".9s" data-wow-delay=".5s">
                <?php if ( !empty($settings['tp_section_description']) ) : ?>
                <div class="tp-platform-text">
                    <p><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="row align-items-center">
            <div class="col-xl-2 col-lg-2 d-none d-xl-block">
                <?php if(!empty($tp_thumbnail_image)) : ?>
                <div class="tp-platform-img-box">
                    <img src="<?php echo esc_url($tp_thumbnail_image); ?>" alt="<?php echo esc_attr($tp_thumbnail_image_alt); ?>">
                </div>
                <?php endif; ?>
            </div>
            <div class="col-xl-10 col-lg-12">
                <div class="row-custom-wrapper">
                    <div class="row-custom">

                        <?php foreach ($settings['tp_platform_area_list'] as $key => $item) : $key = $key+1; $active = $item['tp_platform_active_switch'] ? 'active' : NULL; ?>
                        <div class="col-custom <?php echo esc_attr($active); ?>">
                            <div class="tp-panel-item">
                                <div class="tp-panel-content">
                                    <?php if(!empty($item['tp_platform_area_number'])) : ?>
                                    <span><?php echo tp_kses($item['tp_platform_area_number']); ?></span>
                                    <?php endif; ?>
                                    <?php if(!empty($item['tp_platform_area_title'])) : ?>
                                    <h4 class="tp-panel-title child-<?php echo esc_attr($key);?>"><?php echo tp_kses($item['tp_platform_area_title']); ?></h4>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="tp-panel-item-2">
                                <div class="tp-panel-content-2">
                                    <?php if(!empty($item['tp_platform_area_number'])) : ?>
                                    <span><?php echo tp_kses($item['tp_platform_area_number']); ?></span>
                                    <?php endif; ?>
                                    <?php if(!empty($item['tp_platform_area_title'])) : ?>
                                    <h4 class="tp-panel-title-2"><?php echo tp_kses($item['tp_platform_area_title']); ?></h4>
                                    <?php endif; ?>
                                    <?php if(!empty($item['tp_platform_area_des'])) : ?>
                                    <p><?php echo tp_kses($item['tp_platform_area_des']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php else: 
    // thumbnail image
    if ( !empty($settings['tp_thumbnail_image']['url']) ) {
        $tp_thumbnail_image = !empty($settings['tp_thumbnail_image']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image']['url'];
        $tp_thumbnail_image_alt = get_post_meta($settings["tp_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
    }
    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
	$this->add_render_attribute('title_args', 'class', 'tp-section-title-4');
?>	

<div class="tp-platform-area border-tb blue-bg pt-115 pb-105 p-relative z-index">
    <?php if(!empty($tp_shape_image)) : ?>
    <div class="tp-platform-bg-shape">
        <img src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
    </div>
    <?php endif; ?>
    <div class="container">
        <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
        <div class="row align-items-end mb-40">
            <div class="col-xl-7 col-lg-6">
                <div class="tp-platform-section-box">
                    <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                    <h5 class="tp-section-subtitle-4 pb-10"><?php echo tp_kses($settings['tp_section_sub_title']); ?></h5>
                    <?php endif; ?>
                    <?php
                    if ( !empty($settings['tp_section_title' ]) ) :
                        printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['tp_section_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        tp_kses( $settings['tp_section_title' ] )
                        );
                    endif;
                    ?>
                </div>
            </div>
            <div class="col-xl-5 col-lg-6  wow tpfadeRight" data-wow-duration=".9s" data-wow-delay=".5s">
                <?php if ( !empty($settings['tp_section_description']) ) : ?>
                <div class="tp-platform-text">
                    <p class="tp-el-content"><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="row align-items-center">
            <div class="col-xl-2 col-lg-2 d-none d-xl-block">
                <?php if(!empty($tp_thumbnail_image)) : ?>
                <div class="tp-platform-img-box">
                    <img src="<?php echo esc_url($tp_thumbnail_image); ?>" alt="<?php echo esc_attr($tp_thumbnail_image_alt); ?>">
                </div>
                <?php endif; ?>
            </div>
            <div class="col-xl-10 col-lg-12">
                <div class="row-custom-wrapper">
                    <div class="row-custom">
                        <?php foreach ($settings['tp_platform_area_list'] as $key => $item) : $key = $key+1; $active = $item['tp_platform_active_switch'] ? 'active' : NULL; ?>
                        <div class="col-custom <?php echo esc_attr($active); ?>">
                            <div class="tp-panel-item">
                                <div class="tp-panel-content">
                                    <?php if(!empty($item['tp_platform_area_number'])) : ?>
                                    <span><?php echo tp_kses($item['tp_platform_area_number']); ?></span>
                                    <?php endif; ?>
                                    <?php if(!empty($item['tp_platform_area_title'])) : ?>
                                    <h4 class="tp-panel-title child-<?php echo esc_attr($key);?>"><?php echo tp_kses($item['tp_platform_area_title']); ?></h4>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="tp-panel-item-2">
                                <div class="tp-panel-content-2">
                                    <?php if(!empty($item['tp_platform_area_number'])) : ?>
                                    <span><?php echo tp_kses($item['tp_platform_area_number']); ?></span>
                                    <?php endif; ?>
                                    <?php if(!empty($item['tp_platform_area_title'])) : ?>
                                    <h4 class="tp-panel-title-2"><?php echo tp_kses($item['tp_platform_area_title']); ?></h4>
                                    <?php endif; ?>
                                    <?php if(!empty($item['tp_platform_area_des'])) : ?>
                                    <p><?php echo tp_kses($item['tp_platform_area_des']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endif; 
	}
}

$widgets_manager->register( new TP_Platform_Area() );