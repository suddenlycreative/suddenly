<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Features extends Widget_Base {

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
		return 'features';
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
		return __( 'Features', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        
        // title/content
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.' );

        // Features group
        $this->start_controls_section(
            'tp_features',
            [
                'label' => esc_html__('Features List', 'tpcore'),
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_features_main_image',
            [
                'label' => esc_html__('Upload Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]

            ]
        );

        $repeater->add_control(
            'tp_features_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
            ]
        );

        $repeater->add_control(
            'tp_features_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_features_icon_type' => 'image',
                ]

            ]
        );

        $repeater->add_control(
            'tp_features_icon_svg',
            [
                    'show_label' => false,
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                    'condition' => [
                        'tp_features_icon_type' => 'svg'
                    ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_features_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_features_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_features_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_features_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_features_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_features_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );
        

        $repeater->add_control(
            'tp_features_link_switcher',
            [
                'label' => esc_html__( 'Add Services link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'tp_features_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_features_link_switcher' => 'yes',
                    'repeater_condition' => 'style_2'
                ],
            ]
        );
        $repeater->add_control(
            'tp_features_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_features_link_switcher' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'tp_features_link',
            [
                'label' => esc_html__( 'Service Link link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'tpcore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'tp_features_link_type' => '1',
                    'tp_features_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_features_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_features_link_type' => '2',
                    'tp_features_link_switcher' => 'yes',
                ]
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
                    'repeater_condition' => ['style_1']
                ]
			]
		);

        $repeater->add_control(
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
                    'repeater_condition' => ['style_1']
                ],
            ]
        );
        
        $repeater->add_control(
            'tp_anima_dura', [
                'label' => esc_html__('Animation Duration', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('0.3s', 'tpcore'),
                'condition' => [
                    'tp_creative_anima_switcher' => 'yes',
                    'repeater_condition' => ['style_1']
                ],
            ]
        );
        
        $repeater->add_control(
            'tp_anima_delay', [
                'label' => esc_html__('Animation Delay', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('0.6s', 'tpcore'),
                'condition' => [
                    'tp_creative_anima_switcher' => 'yes',
                    'repeater_condition' => ['style_1']
                ],
            ]
        );

        $this->add_control(
            'tp_features_list',
            [
                'label' => esc_html__('Services - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_features_title' => esc_html__('Discover', 'tpcore'),
                    ],
                    [
                        'tp_features_title' => esc_html__('Define', 'tpcore')
                    ],
                    [
                        'tp_features_title' => esc_html__('Develop', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_features_title }}}',
            ]
        );
        $this->end_controls_section();
        
        // shape section
        $this->start_controls_section(
            'tp_about_shape',
            [
                'label' => esc_html__( 'Shape', 'tpcore' ),
                'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );

        $this->add_control(
            'tp_about_shape_switch',
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
                    'tp_about_shape_switch' => 'yes'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'condition' => [
                    'tp_about_shape_switch' => 'yes'
                ],
                'default' => 'full'
            ]
        );
        $this->end_controls_section();

        // section column
        $this->tp_columns('col');


	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('features_section', 'Section - Style', '.tp-el-section'); 
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

<?php if ( $settings['tp_design_style']  == 'layout-2' ) : ?>

<?php else: 

    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }

    $shapeClass = $settings['tp_about_shape_switch'] ? NULL : 'feature-breadcrumb' ;
    
    $this->add_render_attribute('title_args', 'class', 'tp-section-title'); 
?>

<section class="tp-feature-area tp-el-section <?php echo esc_attr($shapeClass); ?>">
    <?php if(!empty($tp_shape_image)) : ?>
    <div class="tp-feature-shape">
        <img src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
    </div>
    <?php endif; ?>
    <div class="container container-large">
        <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="tp-feature-title-wrapper">
                    <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                    <span class="tp-section-title__pre"><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?></span>
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
            <div class="col-lg-6">
                <?php if ( !empty($settings['tp_section_description']) ) : ?>
                <div class="tp-feature-wrapper p-relative">
                    <p><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">

            <?php foreach ($settings['tp_features_list'] as $key => $item) :
                // Link
                if ('2' == $item['tp_features_link_type']) {
                    $link = get_permalink($item['tp_features_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($item['tp_features_link']['url']) ? $item['tp_features_link']['url'] : '';
                    $target = !empty($item['tp_features_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($item['tp_features_link']['nofollow']) ? 'nofollow' : '';
                }

                // thumbnail image
                if ( !empty($item['tp_features_main_image']['url']) ) {
                    $tp_features_main_image = !empty($item['tp_features_main_image']['id']) ? wp_get_attachment_image_url( $item['tp_features_main_image']['id'], 'full' ) : $item['tp_features_main_image']['url'];
                    $tp_features_main_image_alt = get_post_meta($item["tp_features_main_image"]["id"], "_wp_attachment_image_alt", true);
                }

            ?>
            <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                <?php if(!empty($item['tp_creative_anima_switcher'])) : ?>
                <div class="tp-feature-item-box p-relative wow <?php echo esc_attr($item['tp_anima_type']); ?>" data-wow-duration="<?php echo esc_attr($item['tp_anima_dura']); ?>" data-wow-delay="<?php echo esc_attr($item['tp_anima_delay']); ?>">
                <?php else : ?>
                <div class="tp-feature-item-box p-relative">
                <?php endif; ?>
                    <div class="tp-feature-item p-relative mb-30">
                        <div class="tp-feature-item-shape">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/feature/shape-2.png" alt="">
                        </div>
                        <div class="tp-feature-item-wrapper">
                            <div class="tp-feature-item-thumb">

                                <?php if($item['tp_features_icon_type'] == 'icon') : ?>
                                <?php if (!empty($item['tp_features_icon']) || !empty($item['tp_features_selected_icon']['value'])) : ?>
                                <div class="shape">
                                    <?php tp_render_icon($item, 'tp_features_icon', 'tp_features_selected_icon'); ?>
                                </div>
                                <?php endif; ?>
                                <?php elseif( $item['tp_features_icon_type'] == 'image' ) : ?>
                                <?php if (!empty($item['tp_features_image']['url'])): ?>
                                <div class="shape">
                                    <img src="<?php echo $item['tp_features_image']['url']; ?>"
                                        alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                </div>
                                <?php endif; ?>
                                <?php else : ?>
                                <?php if (!empty($item['tp_features_icon_svg'])): ?>
                                <div class="shape">
                                    <?php echo $item['tp_features_icon_svg']; ?>
                                </div>
                                <?php endif; ?>
                                <?php endif; ?>

                                <?php if(!empty($tp_features_main_image)) : ?>
                                    <img class="thumb" src="<?php echo esc_url($tp_features_main_image); ?>" alt="<?php echo esc_attr($tp_features_main_image_alt); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="tp-feature-item-content">

                                <?php if (!empty($item['tp_features_title' ])): ?>
                                <h3 class="feature-title">
                                    <?php if (!empty($link)) : ?>
                                    <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_features_title' ]); ?></a>
                                    <?php else : ?>
                                    <?php echo tp_kses($item['tp_features_title' ]); ?>
                                    <?php endif; ?>
                                <span><svg width="130" height="8" viewBox="0 0 130 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.406277 7.82144C0.682129 4.52972 9.33282 8.38041 11.5176 7.67652C13.1396 7.1486 12.301 7.03474 13.7133 6.19628C14.8829 4.61253 16.6484 3.89829 18.9986 4.06391C19.6717 4.48831 20.3227 4.93342 20.9737 5.38888C22.3089 6.09277 23.4233 6.51717 24.946 6.13417C26.3142 5.79258 26.9763 4.79885 28.1238 4.18812C32.6036 1.80732 33.1553 2.90456 36.5538 4.58147C38.1538 5.36817 39.7758 6.48612 41.7067 6.08242C42.446 5.92715 42.5012 5.67871 42.9867 5.54415C44.4983 4.10531 46.4624 3.52564 48.8789 3.80512C49.7395 4.28129 50.5891 4.75745 51.4388 5.25431C53.8883 6.22733 57.6068 6.23769 57.7723 3.08053C57.3971 3.22545 57.033 3.37037 56.6689 3.51529C58.7874 5.75117 61.9432 6.59998 65.0217 5.5752C68.4974 4.41585 67.4602 3.02877 70.9911 4.35374C72.569 4.94377 74.2572 5.14045 75.9454 4.96447C77.8322 4.7678 79.377 3.27721 80.9879 3.07018C83.5478 2.73894 85.9643 4.89201 89.0428 4.15707C90.1793 3.88793 91.8896 2.27313 92.7944 2.21102C93.6771 2.14891 95.0674 3.68091 96.0053 4.14672C98.7086 5.51309 102.085 5.75117 104.976 4.7471C107.701 3.80512 106.598 3.60845 108.992 4.30199C110.305 4.67464 111.243 5.34747 112.722 5.45099C115.867 5.65801 118.559 4.26058 120.148 1.77626C119.695 1.77626 119.243 1.77626 118.78 1.77626C121.251 5.49239 126.393 6.10312 129.758 3.05983C130.498 2.39734 129.372 1.34151 128.633 2.00399C126.106 4.29164 122.09 3.95004 120.148 1.03097C119.839 0.554807 119.1 0.544455 118.78 1.03097C116.496 4.62288 111.144 4.84026 108.385 1.7038C108.099 1.38291 107.569 1.46572 107.271 1.7038C103.166 4.99553 97.0425 4.46761 93.7212 0.368483C93.4564 0.0372403 92.8495 -0.190489 92.4965 0.223564C89.8042 3.37037 85.3685 3.86723 82.0803 1.10343C81.7824 0.854995 81.33 0.823941 81.021 1.10343C77.6005 4.26058 72.591 4.52972 68.8505 1.63134C68.5195 1.37256 68.034 1.38291 67.7912 1.75556C65.5072 5.40958 60.4867 5.74082 57.5626 2.65613C57.1654 2.24207 56.4813 2.59402 56.4592 3.09088C56.2386 7.04509 48.272 1.72451 46.3962 1.92118C42.7881 2.30418 42.5012 5.74082 37.7345 3.82583C35.3952 2.88386 33.6188 0.989563 30.8382 1.39326C28.4548 1.74521 27.4397 3.86723 25.3322 4.63323C21.6248 5.9789 20.3669 2.13856 17.178 2.33524C11.9369 2.66648 14.9492 7.41774 6.80603 5.75117C4.46681 5.27501 -0.233697 3.93969 0.00905172 7.82144C0.0200858 8.05952 0.384209 8.05952 0.406277 7.82144Z" fill="currentColor"/>
                                    </svg>
                                </span>
                                </h3>
                                <?php endif; ?>
                                <?php if (!empty($item['tp_features_description' ])): ?>
                                <p><?php echo tp_kses($item['tp_features_description']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php if(!empty($link)) : ?>
                    <div class="tp-feature-item-btn">
                        <a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>"><i class="fa-regular fa-arrow-right"></i></a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<?php endif;
	}
}

$widgets_manager->register( new TP_Features() );