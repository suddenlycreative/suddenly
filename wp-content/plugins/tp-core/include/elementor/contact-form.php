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
class TP_Contact_Form extends Widget_Base {

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
		return 'contact-form';
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
		return __( 'Contact Form', 'tpcore' );
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


    public function get_tp_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $tp_cfa         = array();
        $tp_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $tp_forms       = get_posts( $tp_cf_args );
        $tp_cfa         = ['0' => esc_html__( 'Select Form', 'tpcore' ) ];
        if( $tp_forms ){
            foreach ( $tp_forms as $tp_form ){
                $tp_cfa[$tp_form->ID] = $tp_form->post_title;
            }
        }else{
            $tp_cfa[ esc_html__( 'No contact form found', 'tpcore' ) ] = 0;
        }
        return $tp_cfa;
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

        // title/content
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');
        $this->tp_section_title_render_controls('form', 'form Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // contact info group
        $this->start_controls_section(
            '_TP_contact_info',
            [
                'label' => esc_html__('Contact  List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();

        
        $repeater->add_control(
            'tp_contact_icon_type',
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
            'tp_contact_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_contact_icon_type' => 'image'
                ]

            ]
        );


        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_contact_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_contact_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_contact_selected_icon',
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
                        'tp_contact_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_contact_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tp-core'),
                'condition' => [
                    'tp_contact_icon_type' => 'svg',
                ]
            ]
        );

        $repeater->add_control(
            'tp_contact_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Contact Title', 'tpcore'),
                'label_block' => true,
            ]
        ); 

        $repeater->add_control(
            'tp_contact_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Contact Title', 'tpcore'),
                'label_block' => true,
            ]
        ); 

        $this->add_control(
            'tp_list',
            [
                'label' => esc_html__('Contact - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_contact_title' => esc_html__('Office Location', 'tpcore'),
                    ],
                    [
                        'tp_contact_title' => esc_html__('Office Location', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_contact_title }}}',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'tpcore_contact',
            [
                'label' => esc_html__('Contact Form', 'tpcore'),
            ]
        );

        $this->add_control(
            'tpcore_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'tpcore' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_tp_contact_form(),
            ]
        );

        $this->end_controls_section();

        
        // contact shape
        $this->start_controls_section(
        'tp_contact_shape',
            [
                'label' => esc_html__( 'Contact Form Email Phone', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );
        $this->add_control(
            'tp_box_icon_type_email',
            [
                'label' => esc_html__('Select Address Image Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ]
            ]
        );
        $this->add_control(
            'tp_box_icon_svg_email',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_type_email' => 'svg'
                ]
            ]
        );

        $this->add_control(
            'tp_box_icon_image_email',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type_email' => 'image'
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tp_box_icon_email',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_type_email' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'tp_box_selected_icon_email',
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
                        'tp_box_icon_type_email' => 'icon'
                    ]
                ]
            );
        }

        $this->add_control(
            'tpcore_contact_email',
            [
                'label'       => esc_html__( 'Address', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Your Email', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Email Text', 'tpcore' ),
                'description' => 'Type Your Email In This Field',
                'label_block' => true,
            ]
        );
        // Phone
         // icon image svg for phone

         $this->add_control(
            'tp_box_icon_type_phone',
            [
                'label' => esc_html__('Select Phone Image Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ]
            ]
        );
        $this->add_control(
            'tp_box_icon_svg_phone',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_type_phone' => 'svg'
                ]
            ]
        );

        $this->add_control(
            'tp_box_icon_image_phone',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type_phone' => 'image'
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tp_box_icon_phone',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_type_phone' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'tp_box_selected_icon_phone',
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
                        'tp_box_icon_type_phone' => 'icon'
                    ]
                ]
            );
        }
        $this->add_control(
            'tp_contact_phone',
            [
                'label' => esc_html__('Phone', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('+880 123 456789,99875', 'tpcore'),
                'label_block' => true,
            ]
        ); 

       
        
        $this->end_controls_section();

	}

    protected function style_tab_content(){
        $this->tp_section_style_controls('comint_section', 'Section - Style', '.tp-el-section');
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
    $this->add_render_attribute('title_args', 'class', 'tp-section-title pb-10');
?>

    <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
    <div class="tp-contact-section-box pb-25">
        <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
        <h5 class="inner-section-subtitle"><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?></h5>
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
    </div>
    <?php endif; ?>
    <div class="postbox__comment-form">
        <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
            <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?>
        <?php else : ?>
            <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
        <?php endif; ?>
    </div>

<?php else :

    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_2']['url']) ) {
        $tp_shape_image_2 = !empty($settings['tp_shape_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_2']['url'];
        $tp_shape_image_alt_2 = get_post_meta($settings["tp_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
    }

    $this->add_render_attribute('title_args', 'class', 'tp-contact-title');
    $this->add_render_attribute('title_args_2', 'class', 'tp-contact-form-title');
?>


<section class="tp-contact-area pt-120 pb-90">
            <div class="container">
               <div class="row">
                  <div class="col-lg-6">
                     <div class="tp-contact-wrapper">
                        <div class="tp-contact-title-wrapper">
                           
                           <?php if ( !empty($settings['tp_section_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_section_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_section_title' ] )
                                    );
                                endif; ?>
                           <?php if ( !empty($settings['tp_section_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="tp-contact-content">
                           <div class="tp-contact-content-mail d-flex align-items-center">
                              <div class="tp-contact-content-mail-icon">
                                 <span>
                                 <?php if($settings['tp_box_icon_type_email'] == 'icon') : ?>
                                        <?php if (!empty($settings['tp_box_icon_email']) || !empty($settings['tp_box_selected_icon_email']['value'])) : ?>
                                        <?php tp_render_icon($settings, 'tp_box_icon_email', 'tp_box_selected_icon_email'); ?>
                                        <?php endif; ?>
                                        <?php elseif( $settings['tp_box_icon_type_email'] == 'image' ) : ?>
                                        <?php if (!empty($settings['tp_box_icon_image_email']['url'])): ?>
                                        <img src="<?php echo $settings['tp_box_icon_image_email']['url']; ?>"
                                            alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_box_icon_image_email']['url']), '_wp_attachment_image_alt', true); ?>">
                                        <?php endif; ?>
                                        <?php else : ?>
                                        <?php if (!empty($settings['tp_box_icon_svg_email'])): ?>
                                        <?php echo $settings['tp_box_icon_svg_email']; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    
                                 </span>
                              </div>
                              <h3 class="tp-contact-item-title"><a href="mailto:<?php echo esc_attr(($settings['tpcore_contact_email'])); ?>"><?php echo tp_kses($settings['tpcore_contact_email']); ?></a></h3>
                           </div>
                           <div class="tp-contact-content-phone d-flex align-items-center">
                              <div class="tp-contact-content-phone-icon">
                                 <span>
                                    
                                    <?php if($settings['tp_box_icon_type_phone'] == 'icon') : ?>
                                        <?php if (!empty($settings['tp_box_icon_phone']) || !empty($settings['tp_box_selected_icon_phone']['value'])) : ?>
                                        <?php tp_render_icon($settings, 'tp_box_icon_phone', 'tp_box_selected_icon_phone'); ?>
                                        <?php endif; ?>
                                        <?php elseif( $settings['tp_box_icon_type_phone'] == 'image' ) : ?>
                                        <?php if (!empty($settings['tp_box_icon_image_phone']['url'])): ?>
                                        <img src="<?php echo $settings['tp_box_icon_image_phone']['url']; ?>"
                                            alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_box_icon_image_phone']['url']), '_wp_attachment_image_alt', true); ?>">
                                        <?php endif; ?>
                                        <?php else : ?>
                                        <?php if (!empty($settings['tp_box_icon_svg_phone'])): ?>
                                        <?php echo $settings['tp_box_icon_svg_phone']; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                 </span>
                              </div>
                              

                              <h3 class="tp-contact-item-title"><a href="tel:<?php echo esc_attr(($settings['tp_contact_phone'])); ?>"><?php echo tp_kses($settings['tp_contact_phone']); ?></a></h3>
                           </div>
                           <div class="tp-contact-location-wrapper d-flex">
                           <?php foreach ($settings['tp_list'] as $item) : ?>
                                
                               
                              <div class="tp-contact-location">
                              <?php if(!empty($item['tp_contact_title'])) : ?>
                                 <h3 class="tp-contact-location-title">
                                 <?php echo tp_kses($item['tp_contact_title']); ?>
                                 <?php if($item['tp_contact_icon_type'] == 'icon') : ?>
                                        <?php if (!empty($item['tp_contact_icon']) || !empty($item['tp_contact_selected_icon']['value'])) : ?>
                                            <?php tp_render_icon($item, 'tp_contact_icon', 'tp_contact_selected_icon'); ?>
                                        <?php endif; ?>
                                    <?php elseif( $item['tp_contact_icon_type'] == 'image' ) : ?>
                                        <?php if (!empty($item['tp_contact_image']['url'])): ?>
                                            <img src="<?php echo $item['tp_contact_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_contact_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if (!empty($item['tp_contact_icon_svg'])): ?>
                                            <?php echo $item['tp_contact_icon_svg']; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                 </h3>
                                 <?php endif; ?>
                                 <?php if(!empty($item['tp_contact_description'])) : ?>
                                 <p ><?php echo tp_kses($item['tp_contact_description']); ?></p>
                                    <?php endif; ?>
                              </div>
                              <?php endforeach; ?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="tp-contact-form">

                            <?php if ( !empty($settings['tp_form_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['tp_form_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args_2' ),
                                tp_kses( $settings['tp_form_title' ] )
                                );
                            endif; ?>

                        <?php if ( !empty($settings['tp_form_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_form_description'] ); ?></p>
                            <?php endif; ?>
                        <div id="contact-form">
                        <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
                            <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?>
                        <?php else : ?>
                            <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
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

$widgets_manager->register( new TP_Contact_Form() );