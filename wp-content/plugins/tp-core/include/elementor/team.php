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
class TP_Team extends Widget_Base {

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
        return 'tp-team';
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
        return __( 'Team', 'tpcore' );
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

          // tp_section_title
          $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-2']);


        // member list
        $this->start_controls_section(
            '_section_teams',
            [
                'label' => __( 'Members', 'tpcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

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

        $repeater->start_controls_tabs(
            '_tab_style_member_box_itemr'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __( 'Information', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'tpcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                      

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Title', 'tpcore' ),
                'default' => __( 'TP Member Name', 'tpcore' ),
                'placeholder' => __( 'Type title here', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Job Title', 'tpcore' ),
                'default' => __( 'TP Officer', 'tpcore' ),
                'placeholder' => __( 'Type designation here', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );  

        $repeater->add_control(
            'item_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __( 'Type link here', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __( 'Links', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __( 'Show Social Links?', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'tpcore' ),
                'label_off' => __( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'web_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Website Address', 'tpcore' ),
                'placeholder' => __( 'Add your profile link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'email_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Email', 'tpcore' ),
                'placeholder' => __( 'Add your email link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );           

        $repeater->add_control(
            'phone_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Phone', 'tpcore' ),
                'placeholder' => __( 'Add your phone link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'facebook_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Facebook', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your facebook link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                

        $repeater->add_control(
            'twitter_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Twitter', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your twitter link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instagram_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Instagram', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your instagram link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );       

        $repeater->add_control(
            'linkedin_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'LinkedIn', 'tpcore' ),
                'placeholder' => __( 'Add your linkedin link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'youtube_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Youtube', 'tpcore' ),
                'placeholder' => __( 'Add your youtube link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'googleplus_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Google Plus', 'tpcore' ),
                'placeholder' => __( 'Add your Google Plus link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'flickr_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Flickr', 'tpcore' ),
                'placeholder' => __( 'Add your flickr link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'vimeo_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Vimeo', 'tpcore' ),
                'placeholder' => __( 'Add your vimeo link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'behance_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Behance', 'tpcore' ),
                'placeholder' => __( 'Add your hehance link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'dribble_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Dribbble', 'tpcore' ),
                'placeholder' => __( 'Add your dribbble link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'pinterest_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Pinterest', 'tpcore' ),
                'placeholder' => __( 'Add your pinterest link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'gitub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Github', 'tpcore' ),
                'placeholder' => __( 'Add your github link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        ); 

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        // REPEATER
        $this->add_control(
            'teams',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __( 'Title HTML Tag', 'tpcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => __( 'H1', 'tpcore' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => __( 'H2', 'tpcore' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => __( 'H3', 'tpcore' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => __( 'H4', 'tpcore' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => __( 'H5', 'tpcore' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => __( 'H6', 'tpcore' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'tpcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'tpcore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'tpcore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'tpcore' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .single-carousel-item' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        // colum controls
        $this->tp_columns('col');

    }

    protected function style_tab_content(){
        $this->tp_section_style_controls('team_section', 'Section - Style', '.tp-el-section');
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

<!-- style 2 -->
<?php if ( $settings['tp_design_style'] === 'layout-2' ) :
      $this->add_render_attribute('title_args', 'class', 'tp-section-title');   
    ?>
    <section class="tp-team-area p-relative pb-100">
         <div class="tp-team-shape">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/testimonial/home-3/shape-3.png" alt="">
         </div>
         <div class="container">
            <div class="row align-items-center">
               <div class="col-lg-6">
                  <div class="tp-team-title-wrapper">
                  <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                     <span class="tp-section-title__pre">
                     <?php echo tp_kses( $settings['tp_section_sub_title'] ); ?>
                        <svg width="123" height="8" viewBox="0 0 123 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path
                              d="M0.384401 7.82144C0.645399 4.52972 8.83029 8.38041 10.8974 7.67652C12.4321 7.1486 11.6386 7.03474 12.9749 6.19628C14.0816 4.61253 15.7519 3.89829 17.9756 4.06391C18.6125 4.48831 19.2284 4.93342 19.8444 5.38888C21.1076 6.09277 22.1621 6.51717 23.6028 6.13417C24.8973 5.79258 25.5237 4.79885 26.6095 4.18812C30.8481 1.80732 31.3701 2.90456 34.5855 4.58147C36.0993 5.36817 37.634 6.48612 39.461 6.08242C40.1604 5.92715 40.2127 5.67871 40.672 5.54415C42.1023 4.10531 43.9606 3.52564 46.2469 3.80512C47.0612 4.28129 47.8651 4.75745 48.669 5.25431C50.9866 6.22733 54.5049 6.23769 54.6615 3.08053C54.3065 3.22545 53.962 3.37037 53.6175 3.51529C55.622 5.75117 58.6078 6.59998 61.5205 5.5752C64.8091 4.41585 63.8277 3.02877 67.1685 4.35374C68.6614 4.94377 70.2587 5.14045 71.856 4.96447C73.6412 4.7678 75.1028 3.27721 76.6271 3.07018C79.0491 2.73894 81.3354 4.89201 84.2482 4.15707C85.3235 3.88793 86.9417 2.27313 87.7978 2.21102C88.6329 2.14891 89.9484 3.68091 90.8358 4.14672C93.3936 5.51309 96.5882 5.75117 99.3234 4.7471C101.902 3.80512 100.858 3.60845 103.124 4.30199C104.366 4.67464 105.253 5.34747 106.652 5.45099C109.628 5.65801 112.175 4.26058 113.678 1.77626C113.25 1.77626 112.822 1.77626 112.384 1.77626C114.722 5.49239 119.587 6.10312 122.771 3.05983C123.471 2.39734 122.406 1.34151 121.707 2.00399C119.316 4.29164 115.516 3.95004 113.678 1.03097C113.386 0.554807 112.687 0.544455 112.384 1.03097C110.223 4.62288 105.159 4.84026 102.549 1.7038C102.278 1.38291 101.777 1.46572 101.495 1.7038C97.6113 4.99553 91.8171 4.46761 88.6747 0.368483C88.4242 0.0372403 87.85 -0.190489 87.5159 0.223564C84.9685 3.37037 80.7717 3.86723 77.6606 1.10343C77.3787 0.854995 76.9507 0.823941 76.6584 1.10343C73.422 4.26058 68.6823 4.52972 65.1432 1.63134C64.83 1.37256 64.3706 1.38291 64.1409 1.75556C61.9799 5.40958 57.2297 5.74082 54.4631 2.65613C54.0873 2.24207 53.44 2.59402 53.4191 3.09088C53.2103 7.04509 45.6727 1.72451 43.8979 1.92118C40.4841 2.30418 40.2127 5.74082 35.7026 3.82583C33.4894 2.88386 31.8085 0.989563 29.1777 1.39326C26.9226 1.74521 25.9622 3.86723 23.9682 4.63323C20.4603 5.9789 19.2702 2.13856 16.2531 2.33524C11.2941 2.66648 14.1442 7.41774 6.43955 5.75117C4.22629 5.27501 -0.221114 3.93969 0.00856432 7.82144C0.0190042 8.05952 0.363521 8.05952 0.384401 7.82144Z"
                              fill="currentColor"></path>
                        </svg>
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
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="tp-team-nav d-flex justify-content-start justify-content-lg-end align-items-end mb-30">
                     <button type="button" class="team-button-prev-1 tp-btn-hover-clear alt-color" tabindex="0"
                        aria-label="Previous slide"><i class="fa-regular fa-arrow-left"></i>
                        <b></b>
                     </button>
                     <button type="button" class="team-button-next-1 tp-btn-hover-clear alt-color" tabindex="0"
                        aria-label="Next slide"><i class="fa-regular fa-arrow-right"></i>
                        <b></b>
                     </button>
                  </div>
               </div>
            </div>
         </div>
         <div class="container-fluid">
            <div class="row">
               <div class="team-active swiper-container">
                  <div class="swiper-wrapper">
                  <?php foreach ( $settings['teams'] as $key => $item ) :
                    $title = tp_kses( $item['title' ] );
                    $item_url = esc_url($item['item_url']);
                    $key = $key+1;
                    if ( !empty($item['image']['url']) ) {
                        $tp_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                        $tp_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                    }     
                    $this->add_render_attribute( 'title_team', 'class', 'team-title' );       
                    ?>
                     <div class="swiper-slide">
                        <div class="tp-team-wrapper p-relative">
                           <div class="tp-team-wrapper-thumb">

                                <?php if(!empty($tp_team_image_url)) : ?>
                                    <a href="<?php echo $item_url;?>"> <img src="<?php echo esc_url($tp_team_image_url); ?>" alt="<?php echo esc_attr($tp_team_image_alt); ?>"></a>
                                <?php endif; ?>
                                <?php if( !empty($item['show_social'] ) ) : ?>
                            <div class="tp-team-social-info">
                                    <?php if( !empty($item['web_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['web_title'] ); ?>"><i class="fas fa-globe"></i></a>
                                    <?php endif; ?>
                                    <?php if( !empty($item['phone_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['phone_title'] ); ?>"><i class="fas fa-phone"></i></a>
                                    <?php endif; ?>
                                    <?php if( !empty($item['facebook_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i class="fab fa-facebook-f"></i></a>
                                    <?php endif; ?>
                                    <?php if( !empty($item['twitter_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i class="fab fa-twitter"></i></a>
                                    <?php endif; ?>
                                    <?php if( !empty($item['linkedin_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><i class="fab fa-linkedin"></i></a>
                                    <?php endif; ?>
                                    <?php if( !empty($item['instagram_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i class="fab fa-instagram"></i></a>
                                    <?php endif; ?>
                                    <?php if( !empty($item['youtube_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i class="fab fa-youtube"></i></a>
                                    <?php endif; ?>
                                    <?php if( !empty($item['googleplus_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i class="fab fa-google-plus-g"></i></a>
                                    <?php endif; ?>
                                    <?php if( !empty($item['flickr_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i class="fab fa-flickr"></i></a>
                                    <?php endif; ?>
                                    <?php if( !empty($item['vimeo_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i class="fab fa-vimeo-v"></i></a>
                                    <?php endif; ?>
                                    <?php if( !empty($item['behance_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['behance_title'] ); ?>"><i class="fab fa-behance"></i></a>
                                    <?php endif; ?>
                                    <?php if( !empty($item['dribble_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i class="fab fa-dribbble"></i></a>
                                    <?php endif; ?>
                                    <?php if( !empty($item['pinterest_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i class="fab fa-pinterest-p"></i></a>
                                    <?php endif; ?>
                                    <?php if( !empty($item['gitub_title'] ) ) : ?>
                                        <a href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i class="fab fa-github"></i></a>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                           </div>
                           <div class="tp-team-wrapper-content d-flex align-items-center justify-content-between">
                              <div class="tp-team-wrapper-content-text">
                                 <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                        tag_escape( $settings['title_tag'] ),
                                        $this->get_render_attribute_string( 'title_team' ),
                                        $title,
                                        $item_url
                                    ); ?>
                                 <?php if( !empty($item['designation']) ) : ?>
                                    <p><?php echo tp_kses( $item['designation'] ); ?></p>
                                    <?php endif; ?>
                              </div>
                              <div class="tp-team-wrapper-icon">
                                 <span class="tp-team-social">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                       xmlns="http://www.w3.org/2000/svg">
                                       <path
                                          d="M6.17963 0.813046L6.19966 6.20109L0.813128 6.17955L0.819197 7.81233L6.20573 7.83388L6.22576 13.2219L7.85808 13.2285L7.83805 7.84041L13.2246 7.86195L13.2185 6.22917L7.83198 6.20762L7.81195 0.819575L6.17963 0.813046Z"
                                          fill="currentColor" />
                                    </svg>
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php endforeach; ?>
                  </div>
               </div>
            </div>
         </div>
      </section>

        

<!-- style default -->
<?php else : ?>
    <section class="tp-team-breadcrumb-area pt-120 pb-90">
            <div class="container">
               <div class="row">
               <?php foreach ( $settings['teams'] as $key => $item ) :
                $title = tp_kses( $item['title' ] );
                $item_url = esc_url($item['item_url']);
                $key = $key+1;
                if ( !empty($item['image']['url']) ) {
                    $tp_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                    $tp_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                }     
                $this->add_render_attribute( 'title_team', 'class', 'team-title' );       
                ?>
                  <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?> mb-50 tp-team-border-right tp-border-after-<?php echo esc_attr($key); ?>">
                     <div class="tp-team-wrapper p-relative mb-30">
                        <div class="tp-team-wrapper-thumb ">

                        <?php if(!empty($tp_team_image_url)) : ?>
                           <a href="<?php echo $item_url;?>"> <img src="<?php echo esc_url($tp_team_image_url); ?>" alt="<?php echo esc_attr($tp_team_image_alt); ?>"></a>
                           <?php endif; ?>
                           <?php if( !empty($item['show_social'] ) ) : ?>
                            <div class="tp-team-social-info">
                            <?php if( !empty($item['web_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['web_title'] ); ?>"><i class="fas fa-globe"></i></a>
                              <?php endif; ?>
                            <?php if( !empty($item['phone_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['phone_title'] ); ?>"><i class="fas fa-phone"></i></a>
                              <?php endif; ?>
                            <?php if( !empty($item['facebook_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i class="fab fa-facebook-f"></i></a>
                              <?php endif; ?>
                            <?php if( !empty($item['twitter_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i class="fab fa-twitter"></i></a>
                              <?php endif; ?>
                            <?php if( !empty($item['linkedin_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><i class="fab fa-linkedin"></i></a>
                              <?php endif; ?>
                            <?php if( !empty($item['instagram_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i class="fab fa-instagram"></i></a>
                              <?php endif; ?>
                            <?php if( !empty($item['youtube_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i class="fab fa-youtube"></i></a>
                              <?php endif; ?>
                            <?php if( !empty($item['googleplus_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i class="fab fa-google-plus-g"></i></a>
                              <?php endif; ?>
                            <?php if( !empty($item['flickr_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i class="fab fa-flickr"></i></a>
                              <?php endif; ?>
                            <?php if( !empty($item['vimeo_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i class="fab fa-vimeo-v"></i></a>
                              <?php endif; ?>
                            <?php if( !empty($item['behance_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['behance_title'] ); ?>"><i class="fab fa-behance"></i></a>
                              <?php endif; ?>
                            <?php if( !empty($item['dribble_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i class="fab fa-dribbble"></i></a>
                              <?php endif; ?>
                            <?php if( !empty($item['pinterest_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i class="fab fa-pinterest-p"></i></a>
                              <?php endif; ?>
                            <?php if( !empty($item['gitub_title'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i class="fab fa-github"></i></a>
                              <?php endif; ?>
                           </div>
                           <?php endif; ?>
                        </div>
                        <div class="tp-team-wrapper-content d-flex justify-content-between">
                           <div class="tp-team-wrapper-content-text">
                            <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title_team' ),
                                $title,
                                $item_url
                            ); ?>

                              <?php if( !empty($item['designation']) ) : ?>
                                <p><?php echo tp_kses( $item['designation'] ); ?></p>
                                <?php endif; ?>
                           </div>
                           <div class="tp-team-wrapper-icon">
                              <span class="tp-team-social">
                                 <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.17963 0.813046L6.19966 6.20109L0.813128 6.17955L0.819197 7.81233L6.20573 7.83388L6.22576 13.2219L7.85808 13.2285L7.83805 7.84041L13.2246 7.86195L13.2185 6.22917L7.83198 6.20762L7.81195 0.819575L6.17963 0.813046Z" fill="currentColor"/>
                                 </svg>
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </section>

<?php endif;
    }
}

$widgets_manager->register( new TP_Team() );