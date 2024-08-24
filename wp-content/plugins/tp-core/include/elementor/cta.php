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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_CTA extends Widget_Base {

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
		return 'tp-cta';
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
		return __( 'CTA', 'tpcore' );
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


	// controls file 
	protected function register_controls_section(){
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
                    'layout-4' => esc_html__('Layout 4', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // tp_section_title
        $this->start_controls_section(
            'tp_section_title',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Sub Title Here', 'tpcore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => ['layout-2', 'layout-3']
                ]
            ]
        );

        $this->add_control(
            'tp_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Title Here', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => ['layout-2', 'layout-3']
                ]
            ]
        );

        $this->add_control(
            'tp_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'tp-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'tp-core'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'tp-core'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'tp-core'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'tp-core'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'tp-core'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'tp-core'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
                'condition' => [
                    'tp_design_style' => ['layout-2', 'layout-3']
                ]
            ]
        );

        $this->add_control(
            'tp_des',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('TP Description Here.', 'tpcore'),
                'placeholder' => esc_html__('write description', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => ['layout-2', 'layout-3']
                ]
            ]
        );


        $this->add_responsive_control(
            'tp_align',
            [
                'label' => esc_html__('Alignment', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'tpcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'tpcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'tpcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'condition' => [
                    'tp_design_style' => ['layout-2', 'layout-3']
                ]
            ]
        );
        $this->end_controls_section();

        
        $this->tp_button_render('cta', 'Button', ['layout-2', 'layout-3','layout-4']);  

          // _tp_image
          $this->start_controls_section(
            '_tp_extra_section',
            [
                'label' => esc_html__('Extra Info', 'tpcore'),
                'condition' => [
                    'tp_design_style' => ['layout-3','layout-1','layout-2','layout-4']
                ]
            ]
        );

      

        $this->add_control(
			'email_address',
			[
				'label' => esc_html__( 'Email Address', 'tpcore' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'somthing@tp.com',
			]
		);

        //icon image svg

        $this->add_control(
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'svg',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-3','layout-1'],
                ]
            ]
        );
        $this->add_control(
            'tp_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_type' => 'svg',
                    'tp_design_style' => ['layout-3','layout-1'],
                ]
            ]
        );

        $this->add_control(
            'tp_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type' => 'image',
                    'tp_design_style' => ['layout-3','layout-1'],
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tp_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                        'tp_design_style' => ['layout-3','layout-1'],
                    ]
                ]
            );
        } else {
            $this->add_control(
                'tp_box_selected_icon',
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
                        'tp_box_icon_type' => 'icon',
                        'tp_design_style' => ['layout-3','layout-1'],
                    ]
                ]
            );
        }

        //icon image svg 2
        $this->add_control(
			'phone_number',
			[
				'label' => esc_html__( 'Phone Number', 'tpcore' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '0208 446 4695',
			]
		);
        $this->add_control(
            'tp_box_icon_type_2',
            [
                'label' => esc_html__('Select Icon Type 2', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'svg',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-1','layout-4'],
                ]
            ]
        );
        $this->add_control(
            'tp_box_icon_svg_2',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_type_2' => 'svg',
                    'tp_design_style' => ['layout-1','layout-4'],
                ]
            ]
        );

        $this->add_control(
            'tp_box_icon_image_2',
            [
                'label' => esc_html__('Upload Icon Image for 2', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type_2' => 'image',
                    'tp_design_style' => ['layout-1','layout-4'],
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tp_box_icon_2',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_type_2' => 'icon',
                        'tp_design_style' => ['layout-1','layout-4'],
                    ]
                ]
            );
        } else {
            $this->add_control(
                'tp_box_selected_icon_2',
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
                        'tp_box_icon_type_2' => 'icon',
                        'tp_design_style' => ['layout-1','layout-4'],
                    ]
                ]
            );

            $this->add_control(
                'cta_contact_us_at_text',
                [
                    'label' => esc_html__( 'Email Extra Text', 'tpcore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'Contact us at ',
                ]
            );

            $this->add_control(
                'cta_phone_extra_text',
                [
                    'label' => esc_html__( 'Phone Extra Text', 'tpcore' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => 'PERFECT SOLUTION From ',
                ]
            );

        }

        $this->end_controls_section();

        // _tp_image
        $this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Thumbnail', 'tpcore'),
                'condition' => [
                    'tp_design_style' => ['layout-3']
                ]
            ]
        );
        $this->add_control(
            'tp_image',
            [
                'label' => esc_html__( 'Choose Image', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'tp_image_2',
            [
                'label' => esc_html__( 'Choose Image 2', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => 'layout-3'
                ]
            ]
        );
        $this->add_control(
            'tp_image_3',
            [
                'label' => esc_html__( 'Choose Image 3', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => 'layout-3'
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

        
        // cta shape
        $this->start_controls_section(
            'tp_cta_shape',
                [
                  'label' => esc_html__( 'Section Shape', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                  'condition' => [
                    'tp_design_style' => 'layout-5'
                  ]
                ]
           );
   
           $this->add_control(
            'tp_cta_shape_switch',
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
                       'tp_cta_shape_switch' => 'yes'
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
                       'tp_cta_shape_switch' => 'yes'
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
                       'tp_cta_shape_switch' => 'yes',
                   ]
               ]
           );

           $this->add_group_control(
               Group_Control_Image_Size::get_type(),
               [
                   'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                   'exclude' => ['custom'],
                   'condition' => [
                       'tp_cta_shape_switch' => 'yes'
                   ]
               ]
           );
           
           $this->end_controls_section();

	}

	// style_tab_content
	protected function style_tab_content(){
        $this->tp_section_style_controls('cta_section', 'Section Style', '.ele-section'); 
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
    // thumbnail
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }      
    
    // Link
    if ('2' == $settings['tp_cta_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_cta_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-green');
    } else {
        if ( ! empty( $settings['tp_cta_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_cta_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-green');
        }
    }
    $this->add_render_attribute('title_args', 'class', 'tp-section-title-lg text-white');
?>

<div class="cta-area-2">
    
    <div class="tp-footer-bg" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/footer/footer-bg.jpg"></div>
    <div class="tp-footer-top-shape" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/footer/footer-top-bg.png"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="tp-footer-top-area">
                    <div class="row align-items-center">
                    <?php if(!empty($settings['email_address'])) : ?>
                        <div class="col-lg-6">
                            <div class="tp-footer-top-contact">
                                <a href="mailto:<?php echo esc_attr($settings['email_address']); ?>"><?php echo tp_kses($settings['cta_contact_us_at_text']); ?><span><?php echo tp_kses($settings['email_address']); ?></span></a>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="col-lg-6">
                        <div class="tp-footer-top-right d-flex justify-content-start justify-content-lg-end">
                            <div class="tp-footer-top-right-headphone">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer/headphone.png" alt="">
                            </div>
                            <?php if(!empty($settings['phone_number'])) : ?>
                            <div class="tp-footer-top-right-content">
                                <p><?php echo tp_kses($settings['cta_phone_extra_text']); ?></p>
                                <a href="tel:<?php echo esc_attr($settings['phone_number']); ?>"><?php echo tp_kses($settings['phone_number']); ?></a>
                            </div>
                            <?php endif; ?>


                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php elseif ( $settings['tp_design_style']  == 'layout-4' ):
    // thumbnail
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }      
    
    // Link
    if ('2' == $settings['tp_cta_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_cta_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-3');
    } else {
        if ( ! empty( $settings['tp_cta_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_cta_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-3');
        }
    }
    $this->add_render_attribute('title_args', 'class', 'tp-section-title-lg text-white');
?>

<section class="tp-cta-3-area pb-120" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/services/home-3/service-bg.png">
    <div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="tp-cta-3-wrapper p-relative">
                <div class="tp-cta-3-shape">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/cta/home-3/shape-1.png" alt="">
                </div>
                <div class="row">
                <div class="col-lg-5">
                    <div class="tp-cta-3-title-wrapper p-relative">
                        <h3 class="tp-cta-3-title"><?php echo tp_kses($settings['cta_phone_extra_text']); ?>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div
                        class="tp-cta-3-content-wrapper d-flex flex-wrap justify-content-start justify-content-lg-end">
                        <div class="tp-cta-3-phone d-flex align-items-center">
                            <div class="tp-cta-3-phone-icon">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img//icon/call.svg" alt="">
                            </div>
                            <?php if(!empty($settings['phone_number'])) : ?>
                            <div class="tp-cta-3-phone-content">
                            <span><?php echo esc_html__("Phone: ",'tpcore') ?><br> <a href="tel:<?php echo esc_attr($settings['phone_number']); ?>"><?php echo tp_kses($settings['phone_number']); ?></a></span>
                            </div>
                            <?php endif; ?>

                        </div>
                        <?php if ( !empty($settings['tp_cta_btn_text']) ) : ?>
                        <div class="tp-cta-3-btn">
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo tp_kses($settings['tp_cta_btn_text']); ?></a>
                        </div>
                        <?php endif; ?>
                        
                        
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>



<?php elseif ( $settings['tp_design_style']  == 'layout-3' ):
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
        $tp_image_alt_2 = get_post_meta($settings["tp_image_3"]["id"], "_wp_attachment_image_alt", true);
    } 
    
    // Link
    if ('2' == $settings['tp_cta_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_cta_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
    } else {
        if ( ! empty( $settings['tp_cta_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_cta_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
        }
    }
    $this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>

<section class="tp-cta-2-area p-relative pt-150 pb-120" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/cta/bg-shape.png">
    <div class="tp-cta-2-shape">
        <?php if(!empty($tp_image)) : ?>
        <img class="shape-1" src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
        <?php endif; ?>
        <?php if(!empty($tp_image_2)) : ?>
        <img class="shape-2" src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_2_alt); ?>">
        <?php endif; ?>
        <?php if(!empty($tp_image_3)) : ?>
        <img class="shape-3" src="<?php echo esc_url($tp_image_3); ?>" alt="<?php echo esc_attr($tp_image_3_alt); ?>">
        <?php endif; ?>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-6">
                <div class="tp-cta-2-content text-center">
                <div class="tp-cta-2-content-icon">
                        
                    <span>
                    <?php if($settings['tp_box_icon_type'] == 'icon') : ?>
                            <?php if (!empty($settings['tp_box_icon']) || !empty($settings['tp_box_selected_icon']['value'])) : ?>
                            <?php tp_render_icon($settings, 'tp_box_icon', 'tp_box_selected_icon'); ?>
                            <?php endif; ?>
                            <?php elseif( $settings['tp_box_icon_type'] == 'image' ) : ?>
                            <?php if (!empty($settings['tp_box_icon_image']['url'])): ?>
                            <img src="<?php echo $settings['tp_box_icon_image']['url']; ?>"
                                alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>
                            <?php else : ?>
                            <?php if (!empty($settings['tp_box_icon_svg'])): ?>
                            <?php echo $settings['tp_box_icon_svg']; ?>
                            <?php endif; ?>
                        <?php endif; ?>                     
                    </span>
                </div>
                
                <div class="tp-cta-2-content-inner">
                <?php if(!empty($settings['phone_number'])) : ?>
                    <h3 class="cta-title"><a href="tel:<?php echo esc_attr($settings['phone_number']); ?>"><?php echo tp_kses($settings['phone_number']); ?></a></h3>
                    <?php endif; ?>
                    <?php if(!empty($settings['email_address'])) : ?>
                    <a href="mailto:<?php echo esc_attr($settings['phone_number']); ?>"><?php echo tp_kses($settings['email_address']); ?></a>
                    <?php endif; ?>
                </div>
                
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="tp-cta-2-title-wrapper">
                <?php if(!empty($settings['tp_sub_title'])) : ?>
                <span class="tp-section-title__pre">
                <?php echo tp_kses($settings['tp_sub_title']); ?>
                    <svg width="123" height="8" viewBox="0 0 123 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.384401 7.82144C0.645399 4.52972 8.83029 8.38041 10.8974 7.67652C12.4321 7.1486 11.6386 7.03474 12.9749 6.19628C14.0816 4.61253 15.7519 3.89829 17.9756 4.06391C18.6125 4.48831 19.2284 4.93342 19.8444 5.38888C21.1076 6.09277 22.1621 6.51717 23.6028 6.13417C24.8973 5.79258 25.5237 4.79885 26.6095 4.18812C30.8481 1.80732 31.3701 2.90456 34.5855 4.58147C36.0993 5.36817 37.634 6.48612 39.461 6.08242C40.1604 5.92715 40.2127 5.67871 40.672 5.54415C42.1023 4.10531 43.9606 3.52564 46.2469 3.80512C47.0612 4.28129 47.8651 4.75745 48.669 5.25431C50.9866 6.22733 54.5049 6.23769 54.6615 3.08053C54.3065 3.22545 53.962 3.37037 53.6175 3.51529C55.622 5.75117 58.6078 6.59998 61.5205 5.5752C64.8091 4.41585 63.8277 3.02877 67.1685 4.35374C68.6614 4.94377 70.2587 5.14045 71.856 4.96447C73.6412 4.7678 75.1028 3.27721 76.6271 3.07018C79.0491 2.73894 81.3354 4.89201 84.2482 4.15707C85.3235 3.88793 86.9417 2.27313 87.7978 2.21102C88.6329 2.14891 89.9484 3.68091 90.8358 4.14672C93.3936 5.51309 96.5882 5.75117 99.3234 4.7471C101.902 3.80512 100.858 3.60845 103.124 4.30199C104.366 4.67464 105.253 5.34747 106.652 5.45099C109.628 5.65801 112.175 4.26058 113.678 1.77626C113.25 1.77626 112.822 1.77626 112.384 1.77626C114.722 5.49239 119.587 6.10312 122.771 3.05983C123.471 2.39734 122.406 1.34151 121.707 2.00399C119.316 4.29164 115.516 3.95004 113.678 1.03097C113.386 0.554807 112.687 0.544455 112.384 1.03097C110.223 4.62288 105.159 4.84026 102.549 1.7038C102.278 1.38291 101.777 1.46572 101.495 1.7038C97.6113 4.99553 91.8171 4.46761 88.6747 0.368483C88.4242 0.0372403 87.85 -0.190489 87.5159 0.223564C84.9685 3.37037 80.7717 3.86723 77.6606 1.10343C77.3787 0.854995 76.9507 0.823941 76.6584 1.10343C73.422 4.26058 68.6823 4.52972 65.1432 1.63134C64.83 1.37256 64.3706 1.38291 64.1409 1.75556C61.9799 5.40958 57.2297 5.74082 54.4631 2.65613C54.0873 2.24207 53.44 2.59402 53.4191 3.09088C53.2103 7.04509 45.6727 1.72451 43.8979 1.92118C40.4841 2.30418 40.2127 5.74082 35.7026 3.82583C33.4894 2.88386 31.8085 0.989563 29.1777 1.39326C26.9226 1.74521 25.9622 3.86723 23.9682 4.63323C20.4603 5.9789 19.2702 2.13856 16.2531 2.33524C11.2941 2.66648 14.1442 7.41774 6.43955 5.75117C4.22629 5.27501 -0.221114 3.93969 0.00856432 7.82144C0.0190042 8.05952 0.363521 8.05952 0.384401 7.82144Z" fill="currentColor"></path>
                    </svg>
                </span>
                <?php endif; ?>
                <?php if ( !empty($settings['tp_title']) ) :
                        printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['tp_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        tp_kses( $settings['tp_title'] )
                        );
                    endif;
                    ?>
                 <?php if ( !empty($settings['tp_cta_btn_text']) ) : ?>
                    <div class="tp-cta-2-btn">
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo tp_kses($settings['tp_cta_btn_text']); ?></a>
                    </div>
                <?php endif; ?>
                </div>
            </div>
            <div class="col-xl-2 "></div>
        </div>
    </div>
</section>
  
</div>

<?php elseif ( $settings['tp_design_style']  == 'layout-4' ):
    // thumbnail
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_2']['url']) ) {
        $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
        $tp_image_alt_2 = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
    } 
    
    // Link
    if ('2' == $settings['tp_cta_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_cta_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-inner white-bg text-black');
    } else {
        if ( ! empty( $settings['tp_cta_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_cta_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-inner white-bg text-black');
        }
    }
    $this->add_render_attribute('title_args', 'class', 'tp-section-title text-white');
?>

<div class="tp-cta-area p-relative">
    <div class="tp-cta-grey-bg grey-bg-2"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tp-cta-bg blue-bg ele-section" >
                    <div class="tp-cta-content tp-inner-font text-center">
                        <?php
                        if ( !empty($settings['tp_title']) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['tp_title_tag'] ),
                            $this->get_render_attribute_string( 'title_args' ),
                            tp_kses( $settings['tp_title'] )
                            );
                        endif;
                        ?>
                        <?php if(!empty($settings['tp_des'])) : ?>
                        <p><?php echo tp_kses($settings['tp_des']); ?></p>
                        <?php endif; ?>
                        <?php if ( !empty($settings['tp_cta_btn_text']) ) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?> ><?php echo tp_kses($settings['tp_cta_btn_text']); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php elseif ( $settings['tp_design_style']  == 'layout-5' ):
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
    $this->add_render_attribute('title_args', 'class', 'breadcrumb__title tp-char-animation text-black');
?>

<div class="breadcrumb__area breadcrumb-height-2 breadcrumb-overlay p-relative fix ele-section" >
    <?php if(!empty($tp_shape_image)) : ?>
    <div class="breadcrumb__shape-2 z-index-4">
        <img src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($tp_shape_image_2)) : ?>
    <div class="breadcrumb__shape-3 z-index-4">
        <img src="<?php echo esc_url($tp_shape_image_2); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($tp_shape_image_3)) : ?>
    <div class="breadcrumb__shape-4 z-index-4">
        <img src="<?php echo esc_url($tp_shape_image_3); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_3); ?>">
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="breadcrumb__content z-index-3 text-center">
                    <?php
                    if ( !empty($settings['tp_title']) ) :
                        printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['tp_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        tp_kses( $settings['tp_title'] )
                        );
                    endif;
                    ?>
                    <?php if(!empty($settings['tp_des'])) : ?>
                    <div class="breadcrumb__text wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".6s">
                        <p><?php echo tp_kses($settings['tp_des']); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php else:

    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }

    // Link
    if ('2' == $settings['tp_cta_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_cta_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-orange tp-btn-hover alt-color-white');
    } else {
        if ( ! empty( $settings['tp_cta_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_cta_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-orange tp-btn-hover alt-color-white');
        }
    }
    $this->add_render_attribute('title_args', 'class', 'tp-service__title-white');
?>
      <div class="tp-cta-4-area p-relative ele-section">
         <div class="tp-cta-4-shape">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/cta/home-3/shape-2.png" alt="">
         </div>
         <div class="container">
            <div class="row gx-0">
               <div class="col-xl-6">
                  <div class="tp-cta-4-wrapper-left">
                     <img class="shape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/cta/home-3/shape-3.png" alt="">
                     <div
                        class="tp-cta-4-mail d-flex flex-wrap justify-content-center justify-content-xl-start align-items-center">
                                <?php if($settings['tp_box_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($settings['tp_box_icon']) || !empty($settings['tp_box_selected_icon']['value'])) : ?>
                                    <?php tp_render_icon($settings, 'tp_box_icon', 'tp_box_selected_icon'); ?>
                                    <?php endif; ?>
                                    <?php elseif( $settings['tp_box_icon_type'] == 'image' ) : ?>
                                    <?php if (!empty($settings['tp_box_icon_image']['url'])): ?>
                                    <img src="<?php echo $settings['tp_box_icon_image']['url']; ?>"
                                        alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>
                                    <?php else : ?>
                                    <?php if (!empty($settings['tp_box_icon_svg'])): ?>
                                    <?php echo $settings['tp_box_icon_svg']; ?>
                                    <?php endif; ?>
                                <?php endif; ?>    

                                <?php if(!empty($settings['email_address'])) : ?>
                                    <a href="mailto:<?php echo esc_attr($settings['email_address']); ?>"><?php echo tp_kses($settings['cta_contact_us_at_text']); ?> <span><?php echo tp_kses($settings['email_address']); ?></span></a>
                                <?php endif; ?>
                        
                     </div>
                  </div>
               </div>
               <div class="col-xl-6">
                  <div class="tp-cta-4-wrapper-right">
                     <div class="tp-cta-4-headphone d-flex flex-wrap justify-content-center ">
                        <div class="tp-cta-4-headphone-thumb">
                        <?php if($settings['tp_box_icon_type_2'] == 'icon') : ?>
                                    <?php if (!empty($settings['tp_box_icon_2']) || !empty($settings['tp_box_selected_icon_2']['value'])) : ?>
                                    <?php tp_render_icon($settings, 'tp_box_icon_2', 'tp_box_selected_icon_2'); ?>
                                    <?php endif; ?>
                                    <?php elseif( $settings['tp_box_icon_type_2'] == 'image' ) : ?>
                                    <?php if (!empty($settings['tp_box_icon_image_2']['url'])): ?>
                                    <img src="<?php echo $settings['tp_box_icon_image_2']['url']; ?>"
                                        alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_box_icon_image_2']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>
                                    <?php else : ?>
                                    <?php if (!empty($settings['tp_box_icon_svg_2'])): ?>
                                    <?php echo $settings['tp_box_icon_svg_2']; ?>
                                    <?php endif; ?>
                                <?php endif; ?>    
                        </div>
                        <?php if(!empty($settings['phone_number'])) : ?>
                        <div class="tp-cta-4-content">
                           <p><?php echo tp_kses($settings['cta_phone_extra_text']); ?></p>
                           <a href="tel:<?php echo esc_attr($settings['phone_number']); ?>"><?php echo tp_kses($settings['phone_number']); ?></a>
                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

<?php endif; 
	}
}

$widgets_manager->register( new TP_CTA() );