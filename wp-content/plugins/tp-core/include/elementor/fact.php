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
class TP_Fact extends Widget_Base {

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
		return 'tp-fact';
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
		return __( 'Fact', 'tpcore' );
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
                    'layout-4' => esc_html__('Layout 4', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        // fact group
        $this->start_controls_section(
            'tp_fact',
            [
                'label' => esc_html__('Fact List', 'tpcore'),
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
                    'style_3' => __( 'Style 3', 'tpcore' ),
                    'style_4' => __( 'Style 4', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_fact_number', [
                'label' => esc_html__('Number', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('17', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_fact_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Food', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_fact_des',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Average time to resolve.', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_2'
                ]
            ]
        );    
        $repeater->add_control(
            'tp_fact_after',
            [
                'label' => esc_html__('After Content', 'tpcore'),
                'description' => 'use after content like syamble or other icon',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '+',
            ]
        );

        
        // creative animation
        $repeater->add_control(
			'tp_creative_anima_switcher',
			[
				'label' => esc_html__( 'Active Animation', 'tpcore' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'tpcore   ' ),
				'label_off' => esc_html__( 'No', 'tpcore   ' ),
				'return_value' => 'yes',
				'default' => '0',
                'separator' => 'before',
                'condition' => [
                    'repeater_condition' => ['style_2']
                ]
			]
		);

        $repeater->add_control(
            'tp_anima_type',
            [
                'label' => __( 'Animation Type', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fadeUp' => __( 'fadeUp', 'tpcore' ),
                    'fadeDown' => __( 'fadeDown', 'tpcore' ),
                    'fadeLeft' => __( 'fadeLeft', 'tpcore' ),
                    'fadeRight' => __( 'fadeRight', 'tpcore' ),
                ],
                'default' => 'fadeUp',
                'frontend_available' => true,
                'style_transfer' => true,
                'condition' => [
                    'tp_creative_anima_switcher' => 'yes',
                    'repeater_condition' => ['style_2']
                ],
            ]
        );

        $this->add_control(
            'tp_fact_list',
            [
                'label' => esc_html__('Fact - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_fact_number' => esc_html__('23', 'tpcore'),
                        'tp_fact_title' => esc_html__('Business', 'tpcore'),
                    ],
                    [
                        'tp_fact_number' => esc_html__('45', 'tpcore'),
                        'tp_fact_title' => esc_html__('Website', 'tpcore')
                    ],
                    [
                        'tp_fact_number' => esc_html__('129', 'tpcore'),
                        'tp_fact_title' => esc_html__('Marketing', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_fact_title }}}',
            ]
        );
        $this->end_controls_section();

        
        // _tp_image
		$this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Thumbnail', 'tp-core'),
                'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );
        $this->add_control(
            'tp_image',
            [
                'label' => esc_html__( 'Choose Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();


        // title/content
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', ['layout-1'] );

        // list
        $this->start_controls_section(
        'tp_list_sec',
            [
                'label' => esc_html__( 'Info List', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
        'tp_text_list_title',
            [
            'label'   => esc_html__( 'Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Default-value', 'tpcore' ),
            'label_block' => true,
            ]
        );
        
        $this->add_control(
            'tp_text_list_list',
            [
            'label'       => esc_html__( 'Features List', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'default'     => [
                [
                'tp_text_list_title'   => esc_html__( 'Neque sodales', 'tpcore' ),
                ],
                [
                'tp_text_list_title'   => esc_html__( 'Adipiscing elit', 'tpcore' ),
                ],
                [
                'tp_text_list_title'   => esc_html__( 'Mauris commodo', 'tpcore' ),
                ],
            ],
            'title_field' => '{{{ tp_text_list_title }}}',
            ]
        );
        $this->end_controls_section();

        // button
        $this->tp_button_render('fact', 'Button', ['layout-1']);

        // fact shape
        $this->start_controls_section(
        'tp_fact_shape',
            [
                'label' => esc_html__( 'Fact Shape', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );

        $this->add_control(
        'tp_fact_shape_switch',
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
                    'tp_fact_shape_switch' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_shape_image_2',
            [
                'label' => esc_html__( 'Choose Shape Image 2', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_fact_shape_switch' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_shape_image_3',
            [
                'label' => esc_html__( 'Choose Shape Image 3', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_fact_shape_switch' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'tp_shape_image_4',
            [
                'label' => esc_html__( 'Choose Shape Image 4', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_fact_shape_switch' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'condition' => [
                    'tp_fact_shape_switch' => 'yes'
                ]
            ]
        );
        
        $this->end_controls_section();

        
        // section column
        $this->tp_columns('col', ['layout-2', 'layout-3', 'layout-4']);
        
	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('fact_section', 'Section - Style', '.tp-el-section');
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

<?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>

<section class="tp-support-feature-area pb-100">
    <div class="container container-large">
        <div class="row">

            <?php foreach ($settings['tp_fact_list'] as $key => $item) : ?>
            <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                <?php if(!empty($item['tp_creative_anima_switcher'])) : ?>
                <div class="tp-support-feature-item fadeleft d-flex p-relative <?php echo esc_attr($item['tp_anima_type']); ?>" >
                <?php else : ?>
                <div class="tp-support-feature-item d-flex p-relative ">
                <?php endif; ?>
                    <?php if (!empty($item['tp_fact_number' ])): ?>
                    <div class="tp-support-feature-counter">
                        <div class="tp-support-feature-thumb">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/brand/shape-2.png" alt="">
                        </div>
                        <h3 class="support-feature-title"><span data-purecounter-duration="4" data-purecounter-end="<?php echo esc_attr($item['tp_fact_number' ]); ?>" class="purecounter"></span><?php echo tp_kses($item['tp_fact_after']); ?></h3>
                    </div>
                    <?php endif; ?>
                    <div class="tp-support-feature-content">
                        <?php if(!empty($item['tp_fact_title'])) : ?>
                        <h4 class="tp-support-feature-content-title"><?php echo tp_kses($item['tp_fact_title']); ?></h4>
                        <?php endif; ?>
                        <?php if(!empty($item['tp_fact_des'])) : ?>
                        <p><?php echo tp_kses($item['tp_fact_des']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php elseif ( $settings['tp_design_style']  == 'layout-3' ): ?>

<section class="tp-counter-area pb-85">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="tp-counter-box" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/fun-fact/counter-bg.png">
                    <div class="row">
                        <?php foreach ($settings['tp_fact_list'] as $key => $item) :
                        $arrCount = count($settings['tp_fact_list']) - 1 ;
                        $border = $key == $arrCount ? '' : 'tp-counter-border';
                        ?>
                            <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                                <div class="tp-counter-wrapper  text-center <?php echo esc_attr($border); ?>">
                                    <?php if (!empty($item['tp_fact_number' ])): ?>
                                    <h3 class="counter-title"> <span data-purecounter-duration="4" data-purecounter-end="<?php echo esc_attr($item['tp_fact_number' ]); ?>" class="purecounter">0</span><?php echo tp_kses($item['tp_fact_after']); ?></h3>
                                    <?php endif; ?>
                                    <?php if(!empty($item['tp_fact_title'])) : ?>
                                    <span class="counter-subtitle"><?php echo tp_kses($item['tp_fact_title']); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php elseif ( $settings['tp_design_style']  == 'layout-4' ): ?>

<section class="tp-counter-3-area p-relative ">
    <div class="tp-counter-3-bg">
        <img class="shape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/others/bg.png" alt="">
    </div>
    <div class="container">
        <div class="row">
            
            <?php foreach ($settings['tp_fact_list'] as $key => $item) :
            $arrCount = count($settings['tp_fact_list']) - 1 ;
            $border = $key == $arrCount ? '' : 'tp-counter-border';
            ?>
            <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                <div class="tp-counter-3-wrapper text-center <?php echo esc_attr($border); ?>">
                    <?php if (!empty($item['tp_fact_number' ])): ?>
                    <h3 class="counter-title"> <span data-purecounter-duration="4" data-purecounter-end="<?php echo esc_attr($item['tp_fact_number' ]); ?>" class="purecounter">0</span><?php echo tp_kses($item['tp_fact_after']); ?></h3>
                    <?php endif; ?>
                    <?php if(!empty($item['tp_fact_title'])) : ?>
                    <span class="counter-subtitle"><?php echo tp_kses($item['tp_fact_title']); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<?php else: 

    // thumbnail image
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }

    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_2']['url']) ) {
        $tp_shape_image_2 = !empty($settings['tp_shape_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_2']['url'];
        $tp_shape_image_alt_2 = get_post_meta($settings["tp_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_3']['url']) ) {
        $tp_shape_image_3 = !empty($settings['tp_shape_image_3']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_3']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_3']['url'];
        $tp_shape_image_alt_3 = get_post_meta($settings["tp_shape_image_3"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_4']['url']) ) {
        $tp_shape_image_4 = !empty($settings['tp_shape_image_4']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_4']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_4']['url'];
        $tp_shape_image_alt_4 = get_post_meta($settings["tp_shape_image_3"]["id"], "_wp_attachment_image_alt", true);
    }

    // Link
    if ('2' == $settings['tp_fact_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_fact_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
    } else {
        if ( ! empty( $settings['tp_fact_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_fact_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>	

<section class="tp-fun-fact-area pt-80 pb-65 p-relative bg-dark-blue fix">
    <div class="container container-1400">
        <?php if(!empty($settings['tp_fact_shape_switch'])) : ?>
        <div class="tp-fun-fact-shape">
            <?php if(!empty($tp_shape_image)) : ?>
            <img class="shape-1" src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
            <?php endif; ?>
            <?php if(!empty($tp_shape_image_2)) : ?>
            <img class="shape-2" src="<?php echo esc_url($tp_shape_image_2); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
            <?php endif; ?>
            <?php if(!empty($tp_shape_image_3)) : ?>
            <img class="shape-3" src="<?php echo esc_url($tp_shape_image_3); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_3); ?>">
            <?php endif; ?>
            <?php if(!empty($tp_shape_image_4)) : ?>
            <img class="shape-4" src="<?php echo esc_url($tp_shape_image_4); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_4); ?>">
            <?php endif; ?>
            <img class="shadow" src="<?php echo get_template_directory_uri(); ?>/assets/img/fun-fact/shadow.png" alt="shape-shadow">
        </div>
        <?php endif; ?>
        <div class="row">

            <div class="col-lg-2 col-md-4">
                <div class="tp-fun-fact-wrapper-box">
                    <?php foreach ($settings['tp_fact_list'] as $key => $item) : ?>
                    <div class="tp-fun-fact-wrapper">
                        <?php if (!empty($item['tp_fact_number' ])): ?>
                        <h3 class="counter-title"> <span data-purecounter-duration="4" data-purecounter-end="<?php echo esc_attr($item['tp_fact_number' ]); ?>" class="purecounter"></span><?php echo tp_kses($item['tp_fact_after']); ?></h3>
                        <?php endif; ?>
                        <?php if(!empty($item['tp_fact_title'])) : ?>
                        <p><?php echo tp_kses($item['tp_fact_title']); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-lg-4 col-md-8">
                <?php if(!empty($tp_image)) : ?>
                <div class="tp-fun-fact-thumb p-relative">
                    <img id="reload" src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="tp-fun-fact-content">
                    <div class="tp-fun-fact-title-wrapper">

                        <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
                        <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                        <span class="tp-section-title__pre">
                        <?php echo tp_kses( $settings['tp_section_sub_title'] ); ?>
                        </span>
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
                        <?php if ( !empty($settings['tp_section_description']) ) : ?>
                        <p><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                        <?php endif; ?>
                        <?php endif; ?>

                        <ul>
                            <?php foreach($settings['tp_text_list_list'] as $key => $item) : 
                            if(!empty($item['tp_text_list_title'])) : 
                            ?>
                            <li><span><svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.794 2.17595C14.426 3.42395 13.094 4.87595 11.798 6.53195C10.67 7.95995 9.656 9.42395 8.756 10.924C7.94 12.268 7.346 13.42 6.974 14.38C6.962 14.416 6.938 14.446 6.902 14.47C6.866 14.506 6.824 14.524 6.776 14.524C6.764 14.536 6.752 14.542 6.74 14.542C6.656 14.542 6.596 14.518 6.56 14.47L0.134 7.93595C0.122 7.92395 0.278 7.76795 0.602 7.46795C0.926 7.15595 1.244 6.87395 1.556 6.62195C1.904 6.33395 2.09 6.20195 2.114 6.22595L5.642 8.99795C6.674 7.78595 7.832 6.58595 9.116 5.39795C11.048 3.62195 13.04 2.10995 15.092 0.861953C15.128 0.861953 15.266 1.02995 15.506 1.36595L15.866 1.88795C15.878 1.93595 15.878 1.98995 15.866 2.04995C15.854 2.09795 15.83 2.13995 15.794 2.17595Z" fill="currentColor"/>
                            </svg></span><?php echo tp_kses($item['tp_text_list_title']); ?></li>
                            <?php endif; endforeach; ?>
                        </ul>

                        <?php if ( !empty($settings['tp_fact_btn_text']) ) : ?>
                        <div class="tp-fun-fact-btn">
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo tp_kses($settings['tp_fact_btn_text']); ?></a>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endif; 
	}
}

$widgets_manager->register( new TP_Fact() );