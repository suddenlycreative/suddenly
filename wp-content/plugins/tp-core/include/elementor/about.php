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
class TP_About extends Widget_Base {

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
		return 'about';
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
		return __( 'About', 'tp-core' );
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
                    'layout-4' => esc_html__('Layout 4', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('about', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-1', 'layout-2','layout-3','layout-4']);

   
        $this->start_controls_section(
         'about_features_list_sec',
             [
               'label' => esc_html__( 'Features List', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2', 'layout-3','layout-4']
               ]
             ]
        );
        
        
 
        // repeater for about features list with text , testarea and icon
        $repeater = new Repeater();

        $repeater->add_control(
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ]
            ]
        );
        $repeater->add_control(
            'tp_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_type' => 'svg'
                ]
            ]
        );

        $repeater->add_control(
            'tp_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type' => 'image'
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
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
                        'tp_box_icon_type' => 'icon'
                    ]
                ]
            );
        }
        
        $repeater->add_control(
            'tp_about_features_list_title',
            [
                'label' => esc_html__('Title', 'tp-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Title', 'tp-core'),
                'title' => esc_html__('Enter title', 'tp-core'),
                'label_block' => true
                
            ]
        );
        $repeater->add_control(
            'tp_about_features_list_number_percentage',
            [
                'label' => esc_html__('Number percentage', 'tp-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => esc_html__('Number percentage', 'tp-core'),
                'title' => esc_html__('Enter title', 'tp-core'),
                'label_block' => true
                
            ]
        );
        $repeater->add_control(
            'tp_about_features_list_description',
            [
                'label' => esc_html__('Description', 'tp-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Description', 'tp-core'),
                'title' => esc_html__('Enter description', 'tp-core'),
                'label_block' => true
            ]
        );

        $this->add_control(
            'tp_about_features_list',
            [
                'label' => esc_html__('Features List', 'tp-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_about_features_list_title' => esc_html__('Custom shortcodes', 'tp-core'),
                        'tp_about_features_list_description' => esc_html__('No matter how much you know
                        about a part icular medical', 'tp-core'),
                    ],
                    [
                        'tp_about_features_list_title' => esc_html__('IT Consultant & Tech', 'tp-core'),
                        'tp_about_features_list_description' => esc_html__('No matter how much you know
                        about a part icular medical', 'tp-core'),
                    ]
                ],
                'title_field' => '{{{ tp_about_features_list_title }}}',
            ]
        );

        $this->end_controls_section();
        

        // tp_btn_button_group
        $this->start_controls_section(
            'tp_btn_button_group',
            [
                'label' => esc_html__('Button', 'tp-core'),

            ]
        );

        $this->add_control(
            'tp_button_style',
            [
                'label' => esc_html__('Select Button Style', 'tp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'tp-btn-blue-lg' => esc_html__('Style 1', 'tp-core'),
                    'tp-btn-inner' => esc_html__('Style 2', 'tp-core'),
                ],
                'default' => 'tp-btn-blue-lg',
                'condition' => [
                    'tp_design_style' => ['layout-4']
                ]
            ]
        );

        $this->add_control(
            'tp_btn_button_show',
            [
                'label' => esc_html__( 'Show Button', 'tp-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tp-core' ),
                'label_off' => esc_html__( 'Hide', 'tp-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_btn_text',
            [
                'label' => esc_html__('Button Text', 'tp-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tp-core'),
                'title' => esc_html__('Enter button text', 'tp-core'),
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'tp-core'),
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
                'label' => esc_html__('Button link', 'tp-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tp-core'),
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
                'label' => esc_html__('Select Button Page', 'tp-core'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                    'tp_btn_button_show' => 'yes'
                ]
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
                    'tp_design_style' => ['layout-1','layout-3','layout-4']
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
                    'tp_design_style' => ['layout-1','layout-3','layout-4']
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
                    'tp_design_style' => ['layout-1','layout-4']
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
                    'tp_design_style' => ['layout-4']
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

        $this->add_control(
            'tp_about_customar_counter',
            [
                'label' => esc_html__( 'Customar Counter', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
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
                    'tp_design_style' => ['layout-1', 'layout-2']
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
            'default'      => '1',
            ]
        );

        $this->end_controls_section();

         // Extra About Section
         $this->start_controls_section(
            'tp_extra_about',
            [
                'label' => esc_html__('About Extra Info', 'tp-core'),
                'condition' => [
                    'tp_design_style' => ['layout-2']
                ]
            ]
        );
       
        $this->add_control(
            'tp_extra_about_name',
            [
                'label' => esc_html__('Extra About Name', 'tp-core'),
                'type' => Controls_Manager::TEXT,
                'title' => esc_html__('Enter Extra About Name', 'tp-core'),
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => ['layout-2']
                ]
            ]
        );

        $this->add_control(
            'tp_extra_about_date',
            [
                'label' => esc_html__('Extra About Date', 'tp-core'),
                'type' => Controls_Manager::TEXTAREA,
                'title' => esc_html__('Enter Extra About Date', 'tp-core'),
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => ['layout-2']
                ]
            ]
        );

        $this->end_controls_section();

        // tp_video
        $this->start_controls_section(
            'tp_video',
            [
                'label' => esc_html__('Video', 'tpcore'),
                'condition' => [
                    'tp_design_style' => ['layout-3','layout-4']
                ]
            ]
        );

        $this->add_control(
            'tp_video_url',
            [
                'label' => esc_html__('Video URL', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'https://www.youtube.com/watch?v=_RpLvsA1SNM',
                'label_block' => true,
                'description' => __("We recommended to put video url form video website such as 'youtube', 'vimeo'.", 'tpcore')
            ]
        );

		$this->add_control(
            'tp_thumbnail_image',
            [
                'label' => esc_html__( 'Choose Video thumbnail', 'tp-core' ),
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

	}

    

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section'); 
        $this->tp_basic_style_controls('section_sub_title', 'Section - Sub Title', '.tp-el-sub-title');
        $this->tp_link_controls_style('about_btn', 'About - Button', '.tp-el-btn');
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

<?php if ( $settings['tp_design_style']  == 'layout-4' ): 
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
    if ( !empty($settings['tp_thumbnail_image']['url']) ) {
        $tp_thumbnail_image = !empty($settings['tp_thumbnail_image']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image']['url'];
        $tp_thumbnail_image_alt = get_post_meta($settings["tp_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
    }

    // Link
    if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>

<section class="tp-about-3-area p-relative pt-185 pb-170">
         <div class="shape-bg">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/home-3/shape-4.png" alt="">
         </div>
         <div class="container">
            <div class="row">
               <div class="col-lg-6">
                  <div class="tp-about-3-img p-relative fadeLeft">
                  <?php if(!empty($tp_image)) : ?>
                            <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                <?php endif; ?>
                <?php if(!empty($tp_image_2)) : ?>
                            <img class="shape-1" src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_alt_2); ?>">
                <?php endif; ?>
                     <div class="shape-2 p-relative">
                     <?php if(!empty($tp_thumbnail_image)) : ?>
                        <img src="<?php echo esc_url($tp_thumbnail_image); ?>" alt="<?php echo esc_attr($tp_thumbnail_image_alt); ?>">
                        <?php endif; ?>
                        <div class="tp-video-play">
                           <a class="popup-video"
                              href="<?php echo esc_url($settings['tp_video_url']); ?>"><i
                                 class="fa-sharp fa-solid fa-play"></i></a>
                        </div>
                     </div>
                     <?php if(!empty($tp_image_3)) : ?>
                            <img class="shape-3" src="<?php echo esc_url($tp_image_3); ?>" alt="<?php echo esc_attr($tp_image_alt_3); ?>">
                    <?php endif; ?>
                    <?php if(!empty($tp_image_4)) : ?>
                            <img class="shape-4" src="<?php echo esc_url($tp_image_4); ?>" alt="<?php echo esc_attr($tp_image_alt_4); ?>">
                    <?php endif; ?>
                    <?php if(!empty($tp_image_5)) : ?>
                            <img class="shape-5" src="<?php echo esc_url($tp_image_5); ?>" alt="<?php echo esc_attr($tp_image_alt_5); ?>">
                    <?php endif; ?>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="tp-about-3-wrapper">
                     <div class="tp-about-3-title-wrapper">
                     <?php if ( !empty($settings['tp_about_sub_title']) ) : ?>
                        <span class="tp-section-title__pre">
                        <?php echo tp_kses( $settings['tp_about_sub_title'] ); ?>
                            <svg width="123" height="8" viewBox="0 0 123 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.384401 7.82144C0.645399 4.52972 8.83029 8.38041 10.8974 7.67652C12.4321 7.1486 11.6386 7.03474 12.9749 6.19628C14.0816 4.61253 15.7519 3.89829 17.9756 4.06391C18.6125 4.48831 19.2284 4.93342 19.8444 5.38888C21.1076 6.09277 22.1621 6.51717 23.6028 6.13417C24.8973 5.79258 25.5237 4.79885 26.6095 4.18812C30.8481 1.80732 31.3701 2.90456 34.5855 4.58147C36.0993 5.36817 37.634 6.48612 39.461 6.08242C40.1604 5.92715 40.2127 5.67871 40.672 5.54415C42.1023 4.10531 43.9606 3.52564 46.2469 3.80512C47.0612 4.28129 47.8651 4.75745 48.669 5.25431C50.9866 6.22733 54.5049 6.23769 54.6615 3.08053C54.3065 3.22545 53.962 3.37037 53.6175 3.51529C55.622 5.75117 58.6078 6.59998 61.5205 5.5752C64.8091 4.41585 63.8277 3.02877 67.1685 4.35374C68.6614 4.94377 70.2587 5.14045 71.856 4.96447C73.6412 4.7678 75.1028 3.27721 76.6271 3.07018C79.0491 2.73894 81.3354 4.89201 84.2482 4.15707C85.3235 3.88793 86.9417 2.27313 87.7978 2.21102C88.6329 2.14891 89.9484 3.68091 90.8358 4.14672C93.3936 5.51309 96.5882 5.75117 99.3234 4.7471C101.902 3.80512 100.858 3.60845 103.124 4.30199C104.366 4.67464 105.253 5.34747 106.652 5.45099C109.628 5.65801 112.175 4.26058 113.678 1.77626C113.25 1.77626 112.822 1.77626 112.384 1.77626C114.722 5.49239 119.587 6.10312 122.771 3.05983C123.471 2.39734 122.406 1.34151 121.707 2.00399C119.316 4.29164 115.516 3.95004 113.678 1.03097C113.386 0.554807 112.687 0.544455 112.384 1.03097C110.223 4.62288 105.159 4.84026 102.549 1.7038C102.278 1.38291 101.777 1.46572 101.495 1.7038C97.6113 4.99553 91.8171 4.46761 88.6747 0.368483C88.4242 0.0372403 87.85 -0.190489 87.5159 0.223564C84.9685 3.37037 80.7717 3.86723 77.6606 1.10343C77.3787 0.854995 76.9507 0.823941 76.6584 1.10343C73.422 4.26058 68.6823 4.52972 65.1432 1.63134C64.83 1.37256 64.3706 1.38291 64.1409 1.75556C61.9799 5.40958 57.2297 5.74082 54.4631 2.65613C54.0873 2.24207 53.44 2.59402 53.4191 3.09088C53.2103 7.04509 45.6727 1.72451 43.8979 1.92118C40.4841 2.30418 40.2127 5.74082 35.7026 3.82583C33.4894 2.88386 31.8085 0.989563 29.1777 1.39326C26.9226 1.74521 25.9622 3.86723 23.9682 4.63323C20.4603 5.9789 19.2702 2.13856 16.2531 2.33524C11.2941 2.66648 14.1442 7.41774 6.43955 5.75117C4.22629 5.27501 -0.221114 3.93969 0.00856432 7.82144C0.0190042 8.05952 0.363521 8.05952 0.384401 7.82144Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <?php endif; ?>
                        <?php if ( !empty($settings['tp_about_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['tp_about_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                tp_kses( $settings['tp_about_title' ] )
                                );
                            endif; ?>
                     </div>
                        <?php if ( !empty($settings['tp_about_description']) ) : ?>
                            <p class="text"><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
                        <?php endif; ?>
                     <div class="tp-about-progressbar-inner d-flex flex-wrap pt-20">
                     <?php  if ( !empty($settings['tp_about_features_list']) ) :
                            foreach ( $settings['tp_about_features_list'] as $item ) :
                                $title = $item['tp_about_features_list_title'];
                                $number_percentage = $item['tp_about_features_list_number_percentage'];
                                ?>
                        <div class="tp-about-3-progressbar d-flex align-items-center">
                           <div class="circular tl-progress">
                              <input type="text" class="knob" value="0" data-rel="<?php echo esc_attr($number_percentage); ?>" data-linecap="round"
                                 data-width="96" data-height="96" data-bgcolor="#ECEEF3" data-fgcolor="#05DAC3"
                                 data-thickness=".07" data-readonly="true" disabled />
                           </div>
                           <div class="tp-about-3-progressbar-title">
                              <p><?php echo tp_kses($title); ?></p>
                           </div>
                        </div>
                        <?php endforeach; endif; ?>
                     </div>
                   
                        
                     <div class="tp-about-3-btn-inner d-flex flex-wrap">

                        <?php if ( !empty($settings['tp_btn_text']) ) : ?>
                                <div class="tp-about-btn">
                                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                                        <?php echo tp_kses($settings['tp_btn_text']); ?><i class="fa-regular fa-arrow-right-long"></i>
                                       
                                    </a>
                                </div>
                        <?php endif; ?>

                        <?php if ( !empty($settings['tp_extra_about_name']) ) : ?>
                        <div class="tp-about-3-year">
                           <p>
                           <?php echo tp_kses($settings['tp_extra_about_name']); ?>
                              <br>
                              <span>
                              <?php echo tp_kses($settings['tp_extra_about_date']); ?>
                              </span>
                           </p>
                        </div>
                        <?php endif; ?>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

<?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
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
    if ( !empty($settings['tp_thumbnail_image']['url']) ) {
        $tp_thumbnail_image = !empty($settings['tp_thumbnail_image']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image']['url'];
        $tp_thumbnail_image_alt = get_post_meta($settings["tp_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
    }

    // Link
    if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>
 <section class="tp-support-breadcrumb fix pt-120 pb-210">
         <div class="container">
            <div class="row">
               <div class="col-lg-6">
                  <div class="tp-fun-fact-title-wrapper support-breadcrumb">
                  <?php if ( !empty($settings['tp_about_sub_title']) ) : ?>
                        <span class="tp-section-title__pre">
                        <?php echo tp_kses( $settings['tp_about_sub_title'] ); ?>
                           <svg width="123" height="8" viewBox="0 0 123 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M0.384401 7.82144C0.645399 4.52972 8.83029 8.38041 10.8974 7.67652C12.4321 7.1486 11.6386 7.03474 12.9749 6.19628C14.0816 4.61253 15.7519 3.89829 17.9756 4.06391C18.6125 4.48831 19.2284 4.93342 19.8444 5.38888C21.1076 6.09277 22.1621 6.51717 23.6028 6.13417C24.8973 5.79258 25.5237 4.79885 26.6095 4.18812C30.8481 1.80732 31.3701 2.90456 34.5855 4.58147C36.0993 5.36817 37.634 6.48612 39.461 6.08242C40.1604 5.92715 40.2127 5.67871 40.672 5.54415C42.1023 4.10531 43.9606 3.52564 46.2469 3.80512C47.0612 4.28129 47.8651 4.75745 48.669 5.25431C50.9866 6.22733 54.5049 6.23769 54.6615 3.08053C54.3065 3.22545 53.962 3.37037 53.6175 3.51529C55.622 5.75117 58.6078 6.59998 61.5205 5.5752C64.8091 4.41585 63.8277 3.02877 67.1685 4.35374C68.6614 4.94377 70.2587 5.14045 71.856 4.96447C73.6412 4.7678 75.1028 3.27721 76.6271 3.07018C79.0491 2.73894 81.3354 4.89201 84.2482 4.15707C85.3235 3.88793 86.9417 2.27313 87.7978 2.21102C88.6329 2.14891 89.9484 3.68091 90.8358 4.14672C93.3936 5.51309 96.5882 5.75117 99.3234 4.7471C101.902 3.80512 100.858 3.60845 103.124 4.30199C104.366 4.67464 105.253 5.34747 106.652 5.45099C109.628 5.65801 112.175 4.26058 113.678 1.77626C113.25 1.77626 112.822 1.77626 112.384 1.77626C114.722 5.49239 119.587 6.10312 122.771 3.05983C123.471 2.39734 122.406 1.34151 121.707 2.00399C119.316 4.29164 115.516 3.95004 113.678 1.03097C113.386 0.554807 112.687 0.544455 112.384 1.03097C110.223 4.62288 105.159 4.84026 102.549 1.7038C102.278 1.38291 101.777 1.46572 101.495 1.7038C97.6113 4.99553 91.8171 4.46761 88.6747 0.368483C88.4242 0.0372403 87.85 -0.190489 87.5159 0.223564C84.9685 3.37037 80.7717 3.86723 77.6606 1.10343C77.3787 0.854995 76.9507 0.823941 76.6584 1.10343C73.422 4.26058 68.6823 4.52972 65.1432 1.63134C64.83 1.37256 64.3706 1.38291 64.1409 1.75556C61.9799 5.40958 57.2297 5.74082 54.4631 2.65613C54.0873 2.24207 53.44 2.59402 53.4191 3.09088C53.2103 7.04509 45.6727 1.72451 43.8979 1.92118C40.4841 2.30418 40.2127 5.74082 35.7026 3.82583C33.4894 2.88386 31.8085 0.989563 29.1777 1.39326C26.9226 1.74521 25.9622 3.86723 23.9682 4.63323C20.4603 5.9789 19.2702 2.13856 16.2531 2.33524C11.2941 2.66648 14.1442 7.41774 6.43955 5.75117C4.22629 5.27501 -0.221114 3.93969 0.00856432 7.82144C0.0190042 8.05952 0.363521 8.05952 0.384401 7.82144Z" fill="currentColor"></path>
                           </svg>
                        </span>
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
                     <ul class="mb-65">
                     <?php
                        if ( !empty($settings['tp_about_features_list']) ) :
                            foreach ( $settings['tp_about_features_list'] as $item ) :
                                $title = $item['tp_about_features_list_title'];
                                $number_percentage = $item['tp_about_features_list_number_percentage'];
                            
                                ?>
                        <li><span><svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M15.794 2.17595C14.426 3.42395 13.094 4.87595 11.798 6.53195C10.67 7.95995 9.656 9.42395 8.756 10.924C7.94 12.268 7.346 13.42 6.974 14.38C6.962 14.416 6.938 14.446 6.902 14.47C6.866 14.506 6.824 14.524 6.776 14.524C6.764 14.536 6.752 14.542 6.74 14.542C6.656 14.542 6.596 14.518 6.56 14.47L0.134 7.93595C0.122 7.92395 0.278 7.76795 0.602 7.46795C0.926 7.15595 1.244 6.87395 1.556 6.62195C1.904 6.33395 2.09 6.20195 2.114 6.22595L5.642 8.99795C6.674 7.78595 7.832 6.58595 9.116 5.39795C11.048 3.62195 13.04 2.10995 15.092 0.861953C15.128 0.861953 15.266 1.02995 15.506 1.36595L15.866 1.88795C15.878 1.93595 15.878 1.98995 15.866 2.04995C15.854 2.09795 15.83 2.13995 15.794 2.17595Z" fill="currentColor"></path>
                           </svg></span><?php echo tp_kses($title); ?>
                        </li>
                        <?php endforeach; endif; ?>

                     </ul>
                     <?php if ( !empty($settings['tp_btn_text']) ) : ?>
                        <div class="tp-support-breadcrumb-btn mb-30">
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                                <?php echo tp_kses($settings['tp_btn_text']); ?>
                                
                            </a>
                        </div>
                        <?php endif; ?>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="tp-about-3-img p-relative fadeRight">
                        <?php if(!empty($tp_image)) : ?>
                                    <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        <?php endif; ?>
                        <?php if(!empty($tp_image_2)) : ?>
                                    <img class="shape-1" src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_alt_2); ?>">
                        <?php endif; ?>
                        <?php if(!empty($settings['tp_video_url'])) : ?>
                        <div class="shape-2 p-relative">
                            <?php if(!empty($tp_thumbnail_image)) : ?>
                                <img src="<?php echo esc_url($tp_thumbnail_image); ?>" alt="<?php echo esc_attr($tp_thumbnail_image_alt); ?>">
                            <?php endif; ?>
                            <div class="tp-video-play">
                            <a class="popup-video" href="<?php echo esc_url($settings['tp_video_url']); ?>"><i class="fa-sharp fa-solid fa-play"></i></a>
                            </div>
                        </div>
                        <?php endif; ?>
                     <?php if(!empty($tp_image_3)) : ?>
                                    <img class="shape-3" src="<?php echo esc_url($tp_image_3); ?>" alt="<?php echo esc_attr($tp_image_alt_3); ?>">
                        <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
      </section>

<?php elseif ( $settings['tp_design_style']  == 'layout-2' ): 
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }

    // Link
    if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>
<section class="tp-about-breadcrumb p-relative pt-100 pb-90">
        <?php if ( !empty($settings['tp_about_shape_switch']) ) : ?>
         <div class="tp-about-3-shape d-none d-lg-block">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/business/shape-5.png" alt="">
         </div>
         <?php endif; ?>
         <div class="container">
            <div class="row">
               <div class="col-lg-6">
                  <?php if(!empty($tp_image)) : ?>
                            <div class="tp-about-breadcrumb-img p-relative text-center fadeLeft">
                                <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                            </div>
                        <?php endif; ?>
               </div>

               
               <div class="col-lg-6">
                  <div class="tp-about-3-wrapper">     
                  <?php if ( !empty($settings['tp_about_section_title_show']) ) : ?>
                     <div class="tp-about-3-title-wrapper">
                        <?php if ( !empty($settings['tp_about_sub_title']) ) : ?>
                            <span class="tp-section-title__pre">
                            <?php echo tp_kses( $settings['tp_about_sub_title'] ); ?>
                                <svg width="123" height="8" viewBox="0 0 123 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.384401 7.82144C0.645399 4.52972 8.83029 8.38041 10.8974 7.67652C12.4321 7.1486 11.6386 7.03474 12.9749 6.19628C14.0816 4.61253 15.7519 3.89829 17.9756 4.06391C18.6125 4.48831 19.2284 4.93342 19.8444 5.38888C21.1076 6.09277 22.1621 6.51717 23.6028 6.13417C24.8973 5.79258 25.5237 4.79885 26.6095 4.18812C30.8481 1.80732 31.3701 2.90456 34.5855 4.58147C36.0993 5.36817 37.634 6.48612 39.461 6.08242C40.1604 5.92715 40.2127 5.67871 40.672 5.54415C42.1023 4.10531 43.9606 3.52564 46.2469 3.80512C47.0612 4.28129 47.8651 4.75745 48.669 5.25431C50.9866 6.22733 54.5049 6.23769 54.6615 3.08053C54.3065 3.22545 53.962 3.37037 53.6175 3.51529C55.622 5.75117 58.6078 6.59998 61.5205 5.5752C64.8091 4.41585 63.8277 3.02877 67.1685 4.35374C68.6614 4.94377 70.2587 5.14045 71.856 4.96447C73.6412 4.7678 75.1028 3.27721 76.6271 3.07018C79.0491 2.73894 81.3354 4.89201 84.2482 4.15707C85.3235 3.88793 86.9417 2.27313 87.7978 2.21102C88.6329 2.14891 89.9484 3.68091 90.8358 4.14672C93.3936 5.51309 96.5882 5.75117 99.3234 4.7471C101.902 3.80512 100.858 3.60845 103.124 4.30199C104.366 4.67464 105.253 5.34747 106.652 5.45099C109.628 5.65801 112.175 4.26058 113.678 1.77626C113.25 1.77626 112.822 1.77626 112.384 1.77626C114.722 5.49239 119.587 6.10312 122.771 3.05983C123.471 2.39734 122.406 1.34151 121.707 2.00399C119.316 4.29164 115.516 3.95004 113.678 1.03097C113.386 0.554807 112.687 0.544455 112.384 1.03097C110.223 4.62288 105.159 4.84026 102.549 1.7038C102.278 1.38291 101.777 1.46572 101.495 1.7038C97.6113 4.99553 91.8171 4.46761 88.6747 0.368483C88.4242 0.0372403 87.85 -0.190489 87.5159 0.223564C84.9685 3.37037 80.7717 3.86723 77.6606 1.10343C77.3787 0.854995 76.9507 0.823941 76.6584 1.10343C73.422 4.26058 68.6823 4.52972 65.1432 1.63134C64.83 1.37256 64.3706 1.38291 64.1409 1.75556C61.9799 5.40958 57.2297 5.74082 54.4631 2.65613C54.0873 2.24207 53.44 2.59402 53.4191 3.09088C53.2103 7.04509 45.6727 1.72451 43.8979 1.92118C40.4841 2.30418 40.2127 5.74082 35.7026 3.82583C33.4894 2.88386 31.8085 0.989563 29.1777 1.39326C26.9226 1.74521 25.9622 3.86723 23.9682 4.63323C20.4603 5.9789 19.2702 2.13856 16.2531 2.33524C11.2941 2.66648 14.1442 7.41774 6.43955 5.75117C4.22629 5.27501 -0.221114 3.93969 0.00856432 7.82144C0.0190042 8.05952 0.363521 8.05952 0.384401 7.82144Z" fill="currentColor"></path>
                                </svg>
                            </span>
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
                     </div>
                     <?php if ( !empty($settings['tp_about_description']) ) : ?>
                        <p class="text"><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
                        <?php endif; ?>
                    <?php endif; ?>

                     <div class="tp-about-progressbar-inner d-flex flex-wrap pt-20">
                     <?php
                        if ( !empty($settings['tp_about_features_list']) ) :
                            foreach ( $settings['tp_about_features_list'] as $item ) :
                                $title = $item['tp_about_features_list_title'];
                                $number_percentage = $item['tp_about_features_list_number_percentage'];
                            
                                ?>
                        <div class="tp-about-3-progressbar d-flex align-items-center">
                           <div class="circular tl-progress">
                              <input type="text" class="knob" value="0" data-rel="<?php echo esc_attr($number_percentage); ?>" data-linecap="round"
                                 data-width="96" data-height="96" data-bgcolor="#ECEEF3" data-fgcolor="#05DAC3" data-thickness=".07" data-readonly="true" disabled/>
                           </div>
                            <div class="tp-about-3-progressbar-title">
                              <p><?php echo tp_kses($title); ?></p>
                            </div>
                        </div>
                        <?php endforeach; endif; ?>

                     </div>
                     <div class="tp-about-3-btn-inner d-flex flex-wrap">
                       
                        <?php if ( !empty($settings['tp_btn_text']) ) : ?>
                                <div class="tp-about-btn">
                                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                                        <?php echo tp_kses($settings['tp_btn_text']); ?><i class="fa-regular fa-arrow-right-long"></i>
                                       
                                    </a>
                                </div>
                        <?php endif; ?>
                        <?php if ( !empty($settings['tp_extra_about_name']) ) : ?>
                        <div class="tp-about-3-year">
                           <p>
                           <?php echo tp_kses($settings['tp_extra_about_name']); ?>
                              <br>
                              <span>
                              <?php echo tp_kses($settings['tp_extra_about_date']); ?>
                              </span>
                           </p>
                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>




<?php else:

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

    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }

    // Link
    if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-el-btn');
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-el-btn');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>

<section class="tp-business-area p-relative pt-110 pb-115">
        <?php if ( !empty($settings['tp_about_shape_switch']) ) : ?>
            <div class="tp-business-shape">
               <img class="shape-1 d-none d-lg-block" src="<?php echo get_template_directory_uri();?>/assets/img/business/shape-1.png" alt="">
               <img class="shape-2" src="<?php echo get_template_directory_uri();?>/assets/img/business/shape-2.png" alt="">
               <img class="shape-3" src="<?php echo get_template_directory_uri();?>/assets/img/business/shape-3.png" alt="">
               <img class="shape-4" src="<?php echo get_template_directory_uri();?>/assets/img/business/shape-4.png" alt="">
            </div>
            <?php endif; ?>
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-lg-6">
                     <div class="tp-business-thumb-wrapper p-relative">
                        <?php if(!empty($tp_image)) : ?>
                            <div class="tp-business-thumb text-center">
                                <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                            </div>
                        <?php endif; ?>

                        <div class="circle-animation business-4">
                           <span class="tp-circle-1"></span>
                        </div>
                        <div class="circle-animation business-3">
                           <span class="tp-circle-2"></span>
                        </div>
                        <div class="circle-animation business-2">
                           <span class="tp-circle-3"></span>
                        </div>
                        <div class="tp-business-thumb-shape">
                            <?php if(!empty($tp_image_2)) : ?>
                                    <img class="shape-1" src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_alt_2); ?>">
                            <?php endif; ?>
                            <?php if(!empty($tp_image_3)) : ?>
                                    <img class="shape-2" src="<?php echo esc_url($tp_image_3); ?>" alt="<?php echo esc_attr($tp_image_alt_3); ?>">
                            <?php endif; ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                  <?php if ( !empty($settings['tp_about_section_title_show']) ) : ?>
                     <div class="tp-business-title-wrapper">
                         
                        
                        <?php if ( !empty($settings['tp_about_sub_title']) ) : ?>
                        <span class="tp-section-title__pre">
                        <?php echo tp_kses( $settings['tp_about_sub_title'] ); ?>
                           <svg width="123" height="8" viewBox="0 0 123 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M0.384401 7.82144C0.645399 4.52972 8.83029 8.38041 10.8974 7.67652C12.4321 7.1486 11.6386 7.03474 12.9749 6.19628C14.0816 4.61253 15.7519 3.89829 17.9756 4.06391C18.6125 4.48831 19.2284 4.93342 19.8444 5.38888C21.1076 6.09277 22.1621 6.51717 23.6028 6.13417C24.8973 5.79258 25.5237 4.79885 26.6095 4.18812C30.8481 1.80732 31.3701 2.90456 34.5855 4.58147C36.0993 5.36817 37.634 6.48612 39.461 6.08242C40.1604 5.92715 40.2127 5.67871 40.672 5.54415C42.1023 4.10531 43.9606 3.52564 46.2469 3.80512C47.0612 4.28129 47.8651 4.75745 48.669 5.25431C50.9866 6.22733 54.5049 6.23769 54.6615 3.08053C54.3065 3.22545 53.962 3.37037 53.6175 3.51529C55.622 5.75117 58.6078 6.59998 61.5205 5.5752C64.8091 4.41585 63.8277 3.02877 67.1685 4.35374C68.6614 4.94377 70.2587 5.14045 71.856 4.96447C73.6412 4.7678 75.1028 3.27721 76.6271 3.07018C79.0491 2.73894 81.3354 4.89201 84.2482 4.15707C85.3235 3.88793 86.9417 2.27313 87.7978 2.21102C88.6329 2.14891 89.9484 3.68091 90.8358 4.14672C93.3936 5.51309 96.5882 5.75117 99.3234 4.7471C101.902 3.80512 100.858 3.60845 103.124 4.30199C104.366 4.67464 105.253 5.34747 106.652 5.45099C109.628 5.65801 112.175 4.26058 113.678 1.77626C113.25 1.77626 112.822 1.77626 112.384 1.77626C114.722 5.49239 119.587 6.10312 122.771 3.05983C123.471 2.39734 122.406 1.34151 121.707 2.00399C119.316 4.29164 115.516 3.95004 113.678 1.03097C113.386 0.554807 112.687 0.544455 112.384 1.03097C110.223 4.62288 105.159 4.84026 102.549 1.7038C102.278 1.38291 101.777 1.46572 101.495 1.7038C97.6113 4.99553 91.8171 4.46761 88.6747 0.368483C88.4242 0.0372403 87.85 -0.190489 87.5159 0.223564C84.9685 3.37037 80.7717 3.86723 77.6606 1.10343C77.3787 0.854995 76.9507 0.823941 76.6584 1.10343C73.422 4.26058 68.6823 4.52972 65.1432 1.63134C64.83 1.37256 64.3706 1.38291 64.1409 1.75556C61.9799 5.40958 57.2297 5.74082 54.4631 2.65613C54.0873 2.24207 53.44 2.59402 53.4191 3.09088C53.2103 7.04509 45.6727 1.72451 43.8979 1.92118C40.4841 2.30418 40.2127 5.74082 35.7026 3.82583C33.4894 2.88386 31.8085 0.989563 29.1777 1.39326C26.9226 1.74521 25.9622 3.86723 23.9682 4.63323C20.4603 5.9789 19.2702 2.13856 16.2531 2.33524C11.2941 2.66648 14.1442 7.41774 6.43955 5.75117C4.22629 5.27501 -0.221114 3.93969 0.00856432 7.82144C0.0190042 8.05952 0.363521 8.05952 0.384401 7.82144Z" fill="currentColor"></path>
                           </svg>
                        </span>
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
                     <?php endif; ?>
                     <div class="row">
                        <!-- show repeter data  -->
                        <?php
                        if ( !empty($settings['tp_about_features_list']) ) :
                            foreach ( $settings['tp_about_features_list'] as $item ) :
                                $title = $item['tp_about_features_list_title'];
                                $description = $item['tp_about_features_list_description'];
                            
                                ?>

                        <div class="col-lg-6 col-md-6">
                           <div class="tp-business-box mb-30">
                              <div class="tp-business-box-title d-flex align-items-center">
                                 <span>
                                 <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                    <?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?>
                                    <?php endif; ?>
                                    <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                                    <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                    <img src="<?php echo $item['tp_box_icon_image']['url']; ?>"
                                        alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>
                                    <?php else : ?>
                                    <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                    <?php echo $item['tp_box_icon_svg']; ?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                   
                                 </span>
                                 <h4 class="tp-business-title"><?php echo tp_kses( $item['tp_about_features_list_title'] ); ?></h4>
                              </div>
                              <p><?php echo tp_kses( $item['tp_about_features_list_description'] ); ?></p>
                           </div>
                        </div>
                        <?php endforeach; endif; ?>
                        <div class="tp-business-btn-area d-flex align-items-center mt-20">
                        <?php if ( !empty($settings['tp_btn_text']) ) : ?>
                                <div class="tp-about__btn">
                                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                                        <span><?php echo tp_kses($settings['tp_btn_text']); ?></span>
                                        <b></b>
                                    </a>
                                </div>
                        <?php endif; ?>

                           <?php if(!empty($tp_image_4)) : ?>
                                    <img class="d-none d-xl-block" src="<?php echo esc_url($tp_image_4); ?>" alt="<?php echo esc_attr($tp_image_alt_4); ?>">
                            <?php endif; ?>
                           <i>
                              
                              <?php if ( !empty($settings['tp_about_customar_counter']) ) : ?>
                              <?php echo tp_kses( $settings['tp_about_customar_counter'] ); ?>
                                <?php endif; ?>
                              <span>
                                 <svg width="90" height="3" viewBox="0 0 90 3" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.162866 2.53384C29.9146 1.53203 59.4954 1.3728 89.2258 2.99826C90.2652 3.05797 90.2509 1.5652 89.2258 1.49222C59.6876 -0.57775 29.6369 -0.637461 0.162866 2.22202C-0.0507143 2.24192 -0.0578337 2.54047 0.162866 2.53384Z" fill="#05DAC3"/>
                                 </svg>
                              </span>
                           </i>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>




<?php endif; 
	}
}

$widgets_manager->register( new TP_About() );
