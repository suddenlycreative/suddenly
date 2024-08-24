<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;
use TPCore\Elementor\Controls\Group_Control_TPGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Sale_Info extends Widget_Base {

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
		return 'sale-info';
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
		return __( 'Sale Info', 'tpcore' );
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
                'label' => esc_html__('Design Layout', 'tp-core'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tp-core'),
                    'layout-2' => esc_html__('Layout 2', 'tp-core'),
                    'layout-3' => esc_html__('Layout 3', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // icon section
        $this->start_controls_section(
            'tp_icon_sec',
            [
                'label' => esc_html__('Icon', 'tp-core'),
                'condition' => [
                    'tp_design_style' => ['layout-2', 'layout-3']
                ]
            ]
        );
        
        $this->add_control(
            'tp_section_icon_type',
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

        $this->add_control(
            'tp_section_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_section_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tp_section_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_section_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'tp_section_selected_icon',
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
                        'tp_section_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $this->add_control(
            'tp_section_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tp-core'),
                'condition' => [
                    'tp_section_icon_type' => 'svg',
                ]
            ]
        );

        $this->end_controls_section();

        // section title/content
        $this->tp_section_title_render_controls('about', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // feature list
        $this->start_controls_section(
         'sale_info_features_list_sec',
             [
               'label' => esc_html__( 'Features List', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2', 'layout-3']
               ]
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );
        
        $repeater->add_control(
         'sale_info_features_title',
           [
             'label'   => esc_html__( 'Sale Info List Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'See the action in live', 'tpcore' ),
             'label_block' => true,
           ]
        );
        
        $repeater->add_control(
         'sale_info_features_des',
           [
             'label'   => esc_html__( 'Sale Info List Description', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXTAREA,
             'default'     => esc_html__( 'ERP provides a complete leave management system for your HR. Upcoming holidays and remaining leave balances.', 'tpcore' ),
             'label_block' => true,
             'condition' => [
                'repeater_condition' => 'style_3'
             ]
           ]
        );

        $repeater->add_control(
            'tp_sale_rep_switcher',
            [
                'label' => esc_html__( 'Show', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => '0',
                'condition' => [
                    'repeater_condition' => 'style_3'
                ]
            ]
        );
        
        // repeater style
        $repeater->add_control(
			'tp_rep_style_switcher',
			[
				'label' => esc_html__( 'Active Style', 'tpcore' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'tpcore   ' ),
				'label_off' => esc_html__( 'No', 'tpcore   ' ),
				'return_value' => 'yes',
				'default' => '0',
                'separator' => 'before',
                'condition' => [
                    'repeater_condition' => 'style_1'
                ]
			]
		);

        $repeater->add_control(
            'tp_text_color_normal',
            [
                'label' => esc_html__('Text Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} em' => 'color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} i' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'tp_rep_style_switcher' => 'yes',
                    'repeater_condition' => 'style_1'
                ]
            ]
        );

        $repeater->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}::after',
                'condition' => [
                    'tp_rep_style_switcher' => 'yes',
                    'repeater_condition' => 'style_1'
                ]
			]
		);

        $this->add_control(
        'sale_info_features_list',
            [
                'label'       => esc_html__( 'Sale Info List', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                [
                    'sale_info_features_title'   => esc_html__( 'See the action in live', 'tpcore' ),
                ],
                [
                    'sale_info_features_title'   => esc_html__( 'Intuitive dashboard', 'tpcore' ),
                ],
                ],
                'title_field' => '{{{ sale_info_features_title }}}',
            ]
        );
        
        $this->end_controls_section();

        // _tp_image
		$this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Thumbnail', 'tp-core'),
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
        $this->add_control(
            'tp_image_2',
            [
                'label' => esc_html__( 'Choose Image 2', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2', 'layout-3']
                ]
            ]
        );
        $this->add_control(
            'tp_image_3',
            [
                'label' => esc_html__( 'Choose Image 3', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-2', 'layout-3']
                ]
            ]
        );
        $this->add_control(
            'tp_image_4',
            [
                'label' => esc_html__( 'Choose Image 4', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-2', 'layout-3']
                ]
            ]
        );
        $this->add_control(
            'tp_image_5',
            [
                'label' => esc_html__( 'Choose Image 5', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-2', 'layout-3']
                ]
            ]
        );
        $this->add_control(
            'tp_image_6',
            [
                'label' => esc_html__( 'Choose Image 6', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-2', 'layout-3']
                ]
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

        // shape section
        $this->start_controls_section(
            'tp_about_shape',
                [
                'label' => esc_html__( 'Shape', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => ['layout-1']
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
                ]
            ]
        );
        $this->end_controls_section();

	}

    

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section'); 
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

<?php if ( $settings['tp_design_style']  == 'layout-2' ) : 

    // thumbnail
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_2']['url']) ) {
        $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
        $tp_image_alt_2 = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_3']['url']) ) {
        $tp_image_3 = !empty($settings['tp_image_3']['id']) ? wp_get_attachment_image_url( $settings['tp_image_3']['id'], $settings['tp_image_size_size']) : $settings['tp_image_3']['url'];
        $tp_image_alt_3 = get_post_meta($settings["tp_image_3"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_4']['url']) ) {
        $tp_image_4 = !empty($settings['tp_image_4']['id']) ? wp_get_attachment_image_url( $settings['tp_image_4']['id'], $settings['tp_image_size_size']) : $settings['tp_image_4']['url'];
        $tp_image_alt_4 = get_post_meta($settings["tp_image_4"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_5']['url']) ) {
        $tp_image_5 = !empty($settings['tp_image_5']['id']) ? wp_get_attachment_image_url( $settings['tp_image_5']['id'], $settings['tp_image_size_size']) : $settings['tp_image_5']['url'];
        $tp_image_alt_5 = get_post_meta($settings["tp_image_5"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_6']['url']) ) {
        $tp_image_6 = !empty($settings['tp_image_6']['id']) ? wp_get_attachment_image_url( $settings['tp_image_6']['id'], $settings['tp_image_size_size']) : $settings['tp_image_6']['url'];
        $tp_image_alt_6 = get_post_meta($settings["tp_image_6"]["id"], "_wp_attachment_image_alt", true);
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title-5 text-black pb-15');
?>

<div class="tp-plan-area tp-plan-space">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-7 col-lg-7 wow tpfadeLeft" data-wow-duration=".9s" data-wow-delay=".3s">
                <div class="tp-plan-img-box p-relative">
                    <?php if(!empty($tp_image)) : ?>
                    <div class="tp-plan-img-1">
                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($tp_image_2)) : ?>
                    <div class="tp-plan-img-2 d-none d-sm-block">
                        <img src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_alt_2); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($tp_image_3)) : ?>
                    <div class="tp-plan-img-3 d-none d-sm-block">
                        <img src="<?php echo esc_url($tp_image_3); ?>" alt="<?php echo esc_attr($tp_image_alt_3); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($tp_image_4)) : ?>
                    <div class="tp-plan-img-4">
                        <img src="<?php echo esc_url($tp_image_4); ?>" alt="<?php echo esc_attr($tp_image_alt_4); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($tp_image_5)) : ?>
                    <div class="tp-plan-img-5">
                        <img src="<?php echo esc_url($tp_image_5); ?>" alt="<?php echo esc_attr($tp_image_alt_5); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($tp_image_6)) : ?>
                    <div class="tp-plan-img-6 d-none d-sm-block">
                        <img src="<?php echo esc_url($tp_image_6); ?>" alt="<?php echo esc_attr($tp_image_alt_6); ?>">
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-xl-5 col-lg-5 wow tpfadeRight" data-wow-duration=".9s" data-wow-delay=".5s">
                <div class="tp-plan-section-box">
                    <?php if($settings['tp_section_icon_type'] == 'icon') : ?>
                    <?php if (!empty($settings['tp_section_icon']) || !empty($settings['tp_section_selected_icon']['value'])) : ?>
                    <div class="tp-plan-section-icon pb-30">
                        <?php tp_render_icon($settings, 'tp_section_icon', 'tp_section_selected_icon'); ?>
                    </div>
                    <?php endif; ?>
                    <?php elseif( $settings['tp_section_icon_type'] == 'image' ) : ?>
                    <?php if (!empty($settings['tp_section_image']['url'])): ?>
                    <div class="tp-plan-section-icon pb-30">
                        <img src="<?php echo $settings['tp_section_image']['url']; ?>"
                            alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_section_image']['url']), '_wp_attachment_image_alt', true); ?>">
                    </div>
                    <?php endif; ?>
                    <?php else : ?>
                    <?php if (!empty($settings['tp_section_icon_svg'])): ?>
                    <div class="tp-plan-section-icon pb-30">
                        <?php echo $settings['tp_section_icon_svg']; ?>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if ( !empty($settings['tp_about_sub_title']) ) : ?>
                    <span class="tp-section-subtitle-5 text-black"><?php echo tp_kses( $settings['tp_about_sub_title'] ); ?></span>
                    <?php endif; ?>
                    <?php
                    if ( !empty($settings['tp_about_title' ]) ) :
                        printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['tp_about_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        tp_kses( $settings['tp_about_title' ] )
                        );
                    endif;
                    ?>
                    <?php if ( !empty($settings['tp_about_description']) ) : ?>
                    <p class="mb-0 pb-30"><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
                    <?php endif; ?>
                    <div class="tp-plan-feature">
                        <ul>
                            <?php foreach ($settings['sale_info_features_list'] as $key => $item) : ?>
                            <li><i class="far fa-check"></i><?php echo tp_kses( $item['sale_info_features_title'] ); ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php elseif ( $settings['tp_design_style']  == 'layout-3' ) : 
    // thumbnail
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_2']['url']) ) {
        $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
        $tp_image_alt_2 = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_3']['url']) ) {
        $tp_image_3 = !empty($settings['tp_image_3']['id']) ? wp_get_attachment_image_url( $settings['tp_image_3']['id'], $settings['tp_image_size_size']) : $settings['tp_image_3']['url'];
        $tp_image_alt_3 = get_post_meta($settings["tp_image_3"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_4']['url']) ) {
        $tp_image_4 = !empty($settings['tp_image_4']['id']) ? wp_get_attachment_image_url( $settings['tp_image_4']['id'], $settings['tp_image_size_size']) : $settings['tp_image_4']['url'];
        $tp_image_alt_4 = get_post_meta($settings["tp_image_4"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_5']['url']) ) {
        $tp_image_5 = !empty($settings['tp_image_5']['id']) ? wp_get_attachment_image_url( $settings['tp_image_5']['id'], $settings['tp_image_size_size']) : $settings['tp_image_5']['url'];
        $tp_image_alt_5 = get_post_meta($settings["tp_image_5"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_6']['url']) ) {
        $tp_image_6 = !empty($settings['tp_image_6']['id']) ? wp_get_attachment_image_url( $settings['tp_image_6']['id'], $settings['tp_image_size_size']) : $settings['tp_image_6']['url'];
        $tp_image_alt_6 = get_post_meta($settings["tp_image_6"]["id"], "_wp_attachment_image_alt", true);
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title-5 text-black pb-25');
?>

<div class="tp-plan-area tp-plan-2-space fix">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-5 col-lg-5 wow tpfadeLeft" data-wow-duration=".9s" data-wow-delay=".3s">
                <div class="tp-plan-section-box">

                    <?php if($settings['tp_section_icon_type'] == 'icon') : ?>
                    <?php if (!empty($settings['tp_section_icon']) || !empty($settings['tp_section_selected_icon']['value'])) : ?>
                    <div class="tp-plan-section-icon pb-30">
                        <?php tp_render_icon($settings, 'tp_section_icon', 'tp_section_selected_icon'); ?>
                    </div>
                    <?php endif; ?>
                    <?php elseif( $settings['tp_section_icon_type'] == 'image' ) : ?>
                    <?php if (!empty($settings['tp_section_image']['url'])): ?>
                    <div class="tp-plan-section-icon pb-30">
                        <img src="<?php echo $settings['tp_section_image']['url']; ?>"
                            alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_section_image']['url']), '_wp_attachment_image_alt', true); ?>">
                    </div>
                    <?php endif; ?>
                    <?php else : ?>
                    <?php if (!empty($settings['tp_section_icon_svg'])): ?>
                    <div class="tp-plan-section-icon pb-30">
                        <?php echo $settings['tp_section_icon_svg']; ?>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>

                    <?php if ( !empty($settings['tp_about_sub_title']) ) : ?>
                    <span class="tp-section-subtitle-5 text-black"><?php echo tp_kses( $settings['tp_about_sub_title'] ); ?></span>
                    <?php endif; ?>
                    <?php
                    if ( !empty($settings['tp_about_title' ]) ) :
                        printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['tp_about_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        tp_kses( $settings['tp_about_title' ] )
                        );
                    endif;
                    ?>
                    <?php if ( !empty($settings['tp_about_description']) ) : ?>
                    <p><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="tp-custom-accordio-2">
                    <div class="accordion" id="accordionExample">
                        <?php foreach ($settings['sale_info_features_list'] as $key => $item) : 
                            $key = $key+1;
                            $active_btn = $item['tp_sale_rep_switcher'] ? 'collapsed' : NULL;
                            $active_des = $item['tp_sale_rep_switcher'] ? 'show' : NULL;
                        ?>
                        <div class="accordion-items">
                            <?php if(!empty($item['sale_info_features_title'])) : ?>
                            <h2 class="accordion-header" id="heading-<?php echo esc_attr($key); ?>">
                                <button class="accordion-buttons <?php echo esc_attr($active_btn); ?> " type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-<?php echo esc_attr($key); ?>" aria-expanded="true" aria-controls="collapse-<?php echo esc_attr($key); ?>">
                                    <?php echo tp_kses($item['sale_info_features_title']); ?>
                                </button>
                            </h2>
                            <?php endif; ?>
                            <?php if(!empty($item['sale_info_features_des'])) : ?>
                            <div id="collapse-<?php echo esc_attr($key); ?>" class="accordion-collapse collapse <?php echo esc_attr($active_des); ?>" aria-labelledby="heading-<?php echo esc_attr($key); ?>"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <?php echo tp_kses($item['sale_info_features_des']); ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7  wow tpfadeRight" data-wow-duration=".9s" data-wow-delay=".5s">
                <div class="tp-plan-2-img-box p-relative">
                    <?php if(!empty($tp_image)) : ?>
                    <div class="tp-plan-2-img-1">
                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($tp_image_2)) : ?>
                    <div class="tp-plan-2-img-2 d-none d-sm-block">
                        <img src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_alt_2); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($tp_image_3)) : ?>
                    <div class="tp-plan-2-img-3">
                        <img src="<?php echo esc_url($tp_image_3); ?>" alt="<?php echo esc_attr($tp_image_alt_3); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($tp_image_4)) : ?>
                    <div class="tp-plan-2-img-4">
                        <img src="<?php echo esc_url($tp_image_4); ?>" alt="<?php echo esc_attr($tp_image_alt_4); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($tp_image_5)) : ?>
                    <div class="tp-plan-2-img-5 d-none d-sm-block">
                        <img src="<?php echo esc_url($tp_image_5); ?>" alt="<?php echo esc_attr($tp_image_alt_5); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($tp_image_6)) : ?>
                    <div class="tp-plan-2-img-6 d-none d-sm-block">
                        <img src="<?php echo esc_url($tp_image_6); ?>" alt="<?php echo esc_attr($tp_image_alt_6); ?>">
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php else:

    // thumbnail
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_2']['url']) ) {
        $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
        $tp_image_alt_2 = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
    }

    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title-3 pb-15');
?>

<div class="tp-sales-area tp-sales-space">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6 order-1 order-md-1 wow tpfadeLeft" data-wow-duration=".9s"
                data-wow-delay=".5s">
                <div class="tp-sales-section-box pb-20">
                    <?php if ( !empty($settings['tp_about_sub_title']) ) : ?>
                    <h4 class="tp-integration-subtitle"><?php echo tp_kses( $settings['tp_about_sub_title'] ); ?></h4>
                    <?php endif; ?>
                    <?php
                    if ( !empty($settings['tp_about_title' ]) ) :
                        printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['tp_about_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        tp_kses( $settings['tp_about_title' ] )
                        );
                    endif;
                    ?>
                    <?php if ( !empty($settings['tp_about_description']) ) : ?>
                    <p class="tp-title-anim"><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="tp-sales-feature">
                    <ul>
                        <?php foreach ($settings['sale_info_features_list'] as $key => $item) : $key = $key+1; ?>
                        <?php if ( !empty($item['sale_info_features_title']) ) : ?>
                        <li
                            class="sale-color-<?php echo esc_attr($key); ?> elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                            <span><i class="far fa-check"></i>
                                <em><?php echo tp_kses( $item['sale_info_features_title'] ); ?></em></span></li>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 order-0 order-md-2 wow tpfadeRight" data-wow-duration=".9s"
                data-wow-delay=".7s">
                <div class="tp-sales-img-wrapper p-relative text-end">
                    <?php if(!empty($tp_image)) : ?>
                    <div class="tp-sales-main-thumb">
                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($tp_image_2)) : ?>
                    <div class="tp-sales-sub-img-1">
                        <img src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_alt_2); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($tp_shape_image)) : ?>
                    <div class="tp-sales-sub-img-2 d-none d-sm-block">
                        <img src="<?php echo esc_url($tp_shape_image); ?>"
                            alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endif; 
	}
}

$widgets_manager->register( new TP_Sale_Info() );