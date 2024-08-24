<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Repeater;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Utils;
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
class TP_Hero_Banner extends Widget_Base {

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
		return 'hero-banner';
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
		return __( 'Hero Banner', 'tp-core' );
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
                'label' => esc_html__('Design Layout', 'tp-core'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tp-core')
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('banner', 'Banner Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // button
        $this->tp_button_render('banner', 'Button', ['layout-1', 'layout-3', 'layout-4', 'layout-5']);
        // button 2

        // social links
        $this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__('Social Profiles', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-3'
                ]
            ]
        );

        $repeater = new Repeater();
        
        $repeater->add_control(
            'tp_social_icon_type',
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
            'tp_social_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_social_icon_type' => 'image',
                ]

            ]
        );

        $repeater->add_control(
            'tp_social_icon_svg',
            [
                    'show_label' => false,
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                    'condition' => [
                        'tp_social_icon_type' => 'svg'
                    ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_social_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fas fa-facebook-f',
                    'condition' => [
                        'tp_social_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_social_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fab fa-facebook-f',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_social_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
			'tp_social_link',
			[
				'label' => esc_html__( 'Social Profile Link', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'textdomain' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
			]
		);

        $repeater->add_control(
            'tp_social_title',
            [
                'label' => esc_html__('Social Profile Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Profile Title', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'profiles',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tp_social_title }}}',
                'default' => [
                    [
                        'tp_social_link' => ['url' => 'https://facebook.com/'],
                        'tp_social_title' => 'facebook',
                        'tp_social_selected_icon' => ['value' => 'fab fa-facebook-f']
                    ],
                    [
                        'tp_social_link' => ['url' => 'https://linkedin.com/'],
                        'tp_social_title' => 'linkedin',
                        'tp_social_selected_icon' => ['value' => 'fab fa-linkedin-in']
                    ],
                    [
                        'tp_social_link' => ['url' => 'https://twitter.com/'],
                        'tp_social_title' => 'twitter',
                        'tp_social_selected_icon' => ['value' => 'fab fa-twitter']
                    ]
                ],
            ]
        );

        $this->end_controls_section();

        // banner shape
        $this->start_controls_section(
         'tp_banner_shape',
             [
               'label' => esc_html__( 'Hero Shape', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );

        $this->add_control(
         'tp_banner_shape_switch',
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
                    'tp_banner_shape_switch' => 'yes'
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
                    'tp_banner_shape_switch' => 'yes'
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
                    'tp_banner_shape_switch' => 'yes',
                    'tp_design_style' => ['layout-1', 'layout-5']
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
                    'tp_banner_shape_switch' => 'yes',
                    'tp_design_style' => 'layout-2'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'condition' => [
                    'tp_banner_shape_switch' => 'yes'
                ]
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

        $this->add_control(
            'tp_thumbnail_image_2',
            [
                'label' => esc_html__( 'Choose Thumbnail Image 2', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-4', 'layout-5']
                ]
            ]
        );

        $this->add_control(
            'tp_thumbnail_image_3',
            [
                'label' => esc_html__( 'Choose Thumbnail Image 3', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-5']
                ]
            ]
        );

        $this->add_control(
            'tp_thumbnail_image_4',
            [
                'label' => esc_html__( 'Choose Thumbnail Image 4', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
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

        // background
        $this->start_controls_section(
        'tp_background_section',
            [
                'label' => esc_html__( 'Background Image', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-3'
                ]
            ]
        );

        $this->add_control(
            'tp_bg_image',
            [
                'label' => esc_html__( 'Choose Background Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_bg_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
            
        $this->end_controls_section();

        // scroll down
        $this->start_controls_section(
            'section_scroll',
            [
                'label' => esc_html__('Scroll Down', 'tpcore'),
                'condition' => [
                    'tp_design_style' => 'layout-2'
                ]
            ]
        );

        $this->add_control(
            'tp_scroll_switch',
            [
              'label'        => esc_html__( 'Scroll Down On/Off', 'tpcore' ),
              'type'         => \Elementor\Controls_Manager::SWITCHER,
              'label_on'     => esc_html__( 'Show', 'tpcore' ),
              'label_off'    => esc_html__( 'Hide', 'tpcore' ),
              'return_value' => 'yes',
              'default'      => '0',
            ]
        );

        $this->add_control(
            'tp_scroll_title',
            [
                'label'       => esc_html__( 'Scroll Down Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Scroll Down', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Title Text', 'tpcore' ),
                'description' => 'Type Your Scroll Down Title In This Field',
                'label_block' => true,
                'condition'   => [
                    'tp_scroll_switch' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_scroll_id',
            [
                'label'       => esc_html__( 'Section ID', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '#', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Section ID', 'tpcore' ),
                'description' => 'Note: Please, insert "#" before your section ID text here',
                'condition'   => [
                    'tp_scroll_switch' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // client area
        $this->start_controls_section(
            'section_client',
            [
                'label' => esc_html__('Client Area', 'tpcore'),
                'condition' => [
                    'tp_design_style' => 'layout-2'
                ]
            ]
        );

        $this->add_control(
            'tp_client_switch',
            [
              'label'        => esc_html__( 'Client On/Off', 'tpcore' ),
              'type'         => \Elementor\Controls_Manager::SWITCHER,
              'label_on'     => esc_html__( 'Show', 'tpcore' ),
              'label_off'    => esc_html__( 'Hide', 'tpcore' ),
              'return_value' => 'yes',
              'default'      => '0',
            ]
        );

        $this->add_control(
            'tp_client_title',
            [
                'label'       => esc_html__( 'Client Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Over 5Ok+ Client all over the world', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Title Text', 'tpcore' ),
                'description' => 'Type Your Client Title In This Field',
                'label_block' => true,
                'condition'   => [
                    'tp_client_switch' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_client_image',
            [
                'label' => esc_html__( 'Choose Client Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_client_switch' => 'yes'
                ]
            ]
        );


        $this->end_controls_section();

        
        // hero slider
        $this->start_controls_section(
            'tpcore_hero_sider_area',
            [
                'label' => esc_html__('Hero Slider Area', 'tpcore'),
                'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );

        // repeter field with text 
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tpcore_hero_slider_title',
            [
                'label'       => esc_html__( 'Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Your Title', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Title Text', 'tpcore' ),
                'description' => 'Type Your Title In This Field',
                'label_block' => true,
            ]
        );


        $this->add_control(
            'tpcore_hero_slider_list',
            [
                'label' => esc_html__( 'Hero Slider List', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();

        // contact phone number

        $this->start_controls_section(
            'tpcore_hero_contact_phone_area',
            [
                'label' => esc_html__('Hero Slider Contact Phone', 'tpcore'),
                'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );

         // icon image svg for phone

         $this->add_control(
            'tp_box_icon_type_phone',
            [
                'label' => esc_html__('Select Email Image Type', 'tpcore'),
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
            'tpcore_hero_slider_phone',
            [
                'label'       => esc_html__( 'Email', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Your Phone', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Phone Text', 'tpcore' ),
                'description' => 'Type Your Phone In This Field',
                'label_block' => true,
            ]
        );

         // icon image svg

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
            'tpcore_hero_slider_email',
            [
                'label'       => esc_html__( 'Address', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Your Email', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Email Text', 'tpcore' ),
                'description' => 'Type Your Email In This Field',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

       
	}
    

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('banner_section', 'Section - Style', '.tp-el-section');
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
        $tp_shape_image_alt_4 = get_post_meta($settings["tp_shape_image_4"]["id"], "_wp_attachment_image_alt", true);
    }

    // client img
    if ( !empty($settings['tp_client_image']['url']) ) {
        $tp_client_image = !empty($settings['tp_client_image']['id']) ? wp_get_attachment_image_url( $settings['tp_client_image']['id']) : $settings['tp_client_image']['url'];
        $tp_client_image_alt = get_post_meta($settings["tp_client_image"]["id"], "_wp_attachment_image_alt", true);
    }

    // Link
    if ('2' == $settings['tp_banner_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_banner_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-green wow tpfadeUp');
    } else {
        if ( ! empty( $settings['tp_banner_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_banner_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-green wow tpfadeUp');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-hero-2__title tp-char-animation');

?>

<div class="tp-hero-2__area tp-hero-2__ptb tp-hero-2__plr z-index fix p-relative blue-bg tp-el-section">

    <?php if(!empty($settings['tp_scroll_switch'])) : ?>
    <div class="scroll-bg d-none d-sm-block">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero/scroll-down.png" alt="">
    </div>
    <div class="tp-hero-2__mouse-scroll smooth d-none d-sm-block">
        <a class="mouse-scroll-btn" href="<?php echo esc_attr($settings['tp_scroll_id']); ?>"></a>
        <?php if(!empty($settings['tp_scroll_title'])) : ?>
        <span><?php echo tp_kses($settings['tp_scroll_title']); ?></span>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php if(!empty($settings['tp_client_switch'])) : ?>
    <div class="tp-hero-2__shape-img-1 d-none d-sm-block">
        <svg width="238" height="159" viewBox="0 0 238 159" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path class="line-2"
                d="M234.344 52.0221C223.737 68.476 166.957 94.3438 103.492 41.3862C75.8453 16.8451 105.128 -10.4919 114.849 24.3323C124.571 59.1564 92.7914 100.54 68.4537 105.873C44.1161 111.206 27.3149 102.11 30.0997 91.4562C34.0369 76.394 74.0714 111.53 2.64231 134.089"
                stroke="white" stroke-width="2" />
            <path class="line-2" fill-rule="evenodd" clip-rule="evenodd"
                d="M2.0625 133.958C2.41561 133.237 3.42407 131.16 3.56794 130.842C3.9652 129.948 4.03834 129.444 4.05489 128.923C4.06249 128.505 4.01353 128.07 4.12522 127.291C4.19178 126.861 3.87842 126.464 3.44849 126.405C3.01856 126.345 2.62947 126.648 2.56291 127.077C2.47204 127.784 2.47586 128.238 2.48453 128.637C2.48792 129.095 2.47134 129.451 2.12998 130.203C1.96731 130.57 0.83986 132.515 0.507014 133.501C0.331505 134.015 0.368942 134.416 0.454587 134.597C0.576866 134.857 0.815639 135.113 1.20469 135.308C1.70511 135.556 2.55838 135.75 3.5093 135.988C4.40364 136.21 5.40968 136.481 6.2686 136.942C6.98849 137.334 7.59496 137.863 7.84287 138.677C7.96607 139.092 8.3949 139.33 8.81178 139.207C9.22866 139.084 9.47003 138.645 9.34683 138.23C8.99025 137 8.10724 136.153 7.01332 135.56C6.04391 135.035 4.91164 134.714 3.88939 134.463C3.27915 134.309 2.71001 134.182 2.27274 134.041C2.20216 134.019 2.13233 133.988 2.0625 133.958Z"
                fill="none" />
        </svg>
    </div>
    <?php endif; ?>
    <div class="container-fluid g-0">
        <div class="row g-0 align-items-end">
            <div class="col-xl-6 col-lg-6">
                <div class="tp-hero-2__title-box">
                    <?php if (!empty($settings['tp_banner_sub_title'])) : ?>
                    <h4 class="tp-section-subtitle-2 tp-text-white">
                        <?php echo tp_kses( $settings['tp_banner_sub_title'] ); ?></h4>
                    <?php endif; ?>
                    <?php
                        if ( !empty($settings['tp_banner_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['tp_banner_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                tp_kses( $settings['tp_banner_title' ] )
                                );
                        endif;
                    ?>
                    <?php if (!empty($settings['tp_banner_description'])) : ?>
                    <p class="tp-text-white"><?php echo tp_kses( $settings['tp_banner_description'] ); ?></p>
                    <?php endif; ?>
                </div>
                <?php if ( !empty($settings['tp_banner_btn_text']) ) : ?>
                <div class="tp-hero-2__btn">
                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?> data-wow-duration=".9s"
                        data-wow-delay=".5s"><?php echo tp_kses($settings['tp_banner_btn_text']); ?></a>
                </div>
                <?php endif; ?>
                <?php if(!empty($settings['tp_client_switch'])) : ?>
                <div class="tp-hero-2__user p-relative">
                    <?php if(!empty($settings['tp_client_title'])) : ?>
                    <h4 class="tp-char-animation-2"><?php echo tp_kses($settings['tp_client_title']); ?></h4>
                    <?php endif; ?>
                    <?php if(!empty($tp_client_image)) : ?>
                    <div class="tp-hero-2__user-img">
                        <img src="<?php echo esc_url($tp_client_image); ?>"
                            alt="<?php echo esc_attr($tp_client_image_alt); ?>">
                    </div>
                    <?php endif; ?>
                    <div class="tp-hero-2__shape-1">
                        <svg width="101" height="15" viewBox="0 0 101 15" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.336934 5.24122C16.3707 0.583948 58.7418 -4.19312 99.9564 13.9568" stroke="white"
                                stroke-width="1.5" />
                        </svg>
                    </div>
                </div>
                <?php endif?>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="tp-hero-2__right text-end p-relative">
                    <?php if(!empty($tp_thumbnail_image)) : ?>
                    <div class="tp-hero-2__main-img wow tpfadeRight" data-wow-duration=".9s" data-wow-delay=".5s">
                        <img src="<?php echo esc_url($tp_thumbnail_image); ?>"
                            alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($settings['tp_banner_shape_switch'])) : ?>
                    <?php if(!empty($tp_shape_image)) : ?>
                    <div class="tp-hero-2__sub-img-1 d-none d-sm-block" data-parallax='{"x": 100, "smoothness": 30}'>
                        <img src="<?php echo esc_url($tp_shape_image); ?>"
                            alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($tp_shape_image_2)) : ?>
                    <div class="tp-hero-2__sub-img-2 d-none d-sm-block" data-parallax='{"x": -100, "smoothness": 10}'>
                        <img src="<?php echo esc_url($tp_shape_image_2); ?>"
                            alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($tp_shape_image_3)) : ?>
                    <div class="tp-hero-2__sub-img-3 d-none d-sm-block" data-parallax='{"y": -80, "smoothness": 30}'>
                        <img src="<?php echo esc_url($tp_shape_image_3); ?>"
                            alt="<?php echo esc_attr($tp_shape_image_alt_3); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($tp_shape_image_4)) : ?>
                    <div class="tp-hero-2__sub-img-4">
                        <img src="<?php echo esc_url($tp_shape_image_4); ?>"
                            alt="<?php echo esc_attr($tp_shape_image_alt_4); ?>">
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 

    // thumbnail image
    if ( !empty($settings['tp_thumbnail_image']['url']) ) {
        $tp_thumbnail_image = !empty($settings['tp_thumbnail_image']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image']['url'];
        $tp_thumbnail_image_alt = get_post_meta($settings["tp_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
    }
    // background image
    if ( !empty($settings['tp_bg_image']['url']) ) {
        $tp_bg_image = !empty($settings['tp_bg_image']['id']) ? wp_get_attachment_image_url( $settings['tp_bg_image']['id'], $settings['tp_bg_size_size']) : $settings['tp_bg_image']['url'];
        $tp_bg_image_alt = get_post_meta($settings["tp_bg_image"]["id"], "_wp_attachment_image_alt", true);
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

    // Link
    if ('2' == $settings['tp_banner_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_banner_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-blue-lg tp-btn-hover alt-color-black');
    } else {
        if ( ! empty( $settings['tp_banner_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_banner_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-blue-lg tp-btn-hover alt-color-black');
        }
    }

    // Link 2
    if ('2' == $settings['tp_banner2_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg2', 'href', get_permalink($settings['tp_banner2_btn_page_link']));
        $this->add_render_attribute('tp-button-arg2', 'target', '_self');
        $this->add_render_attribute('tp-button-arg2', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg2', 'class', 'tp-btn-border tp-btn-hover alt-color-black');
    } else {
        if ( ! empty( $settings['tp_banner2_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg2', $settings['tp_banner2_btn_link'] );
            $this->add_render_attribute('tp-button-arg2', 'class', 'tp-btn-border tp-btn-hover alt-color-black');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-hero-title-3 hero-text-anim pb-5');
?>

<div class="tp-hero-area tp-hero-pt pt-170 pb-70 p-relative tp-el-section">
    <?php if(!empty($tp_shape_image)) : ?>
    <div class="tp-hero-left-shape">
        <img src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($tp_bg_image)) : ?>
    <div class="tp-hero-gradient-bg">
        <img src="<?php echo esc_url($tp_bg_image); ?>" alt="<?php echo esc_attr($tp_bg_image_alt); ?>">
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="row justify-content-center z-index-3">
            <div class="col-xl-11">
                <div class="tp-hero-title-box text-center">
                    <?php if (!empty($settings['tp_banner_sub_title'])) : ?>
                    <h5 class="tp-integration-subtitle"><?php echo tp_kses( $settings['tp_banner_sub_title'] ); ?></h5>
                    <?php endif; ?>
                    <?php
                        if ( !empty($settings['tp_banner_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['tp_banner_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                tp_kses( $settings['tp_banner_title' ] )
                                );
                        endif;
                    ?>
                    <?php if (!empty($settings['tp_banner_description'])) : ?>
                    <p class=" tp-char-animation-2"><?php echo tp_kses( $settings['tp_banner_description'] ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="tp-hero-btn-3 text-center wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".7s">
                    <?php if ( !empty($settings['tp_banner_btn_text']) ) : ?>
                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                        <span><?php echo tp_kses($settings['tp_banner_btn_text']); ?></span>
                        <b></b>
                    </a>
                    <?php endif; ?>
                    <?php if ( !empty($settings['tp_banner2_btn_text']) ) : ?>
                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg2' ); ?>>
                        <span><?php echo tp_kses($settings['tp_banner2_btn_text']); ?></span>
                        <b></b>
                    </a>
                    <?php endif; ?>
                </div>
                <div class="tp-hero-browser-wrapper d-flex align-items-center justify-content-center wow tpfadeUp"
                    data-wow-duration=".9s" data-wow-delay=".9s">

                    <?php foreach ($settings['profiles'] as $key => $item) : ?>
                    <div class="tp-hero-browser-item">

                        <?php if(!empty($item['tp_social_link']['url'])) : ?>
                        <a href="<?php echo esc_url($item['tp_social_link']['url']); ?>">
                            <?php if($item['tp_social_icon_type'] == 'icon') : ?>
                            <?php if (!empty($item['tp_social_icon']) || !empty($item['tp_social_selected_icon']['value'])) : ?>
                            <?php tp_render_icon($item, 'tp_social_icon', 'tp_social_selected_icon'); ?>
                            <?php endif; ?>
                            <?php elseif( $item['tp_social_icon_type'] == 'image' ) : ?>
                            <?php if (!empty($item['tp_social_image']['url'])): ?>
                            <img src="<?php echo $item['tp_social_image']['url']; ?>"
                                alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_social_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>
                            <?php else : ?>
                            <?php if (!empty($item['tp_social_icon_svg'])): ?>
                            <?php echo $item['tp_social_icon_svg']; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                        </a>
                        <?php else : ?>
                        <?php if($item['tp_social_icon_type'] == 'icon') : ?>
                        <?php if (!empty($item['tp_social_icon']) || !empty($item['tp_social_selected_icon']['value'])) : ?>
                        <?php tp_render_icon($item, 'tp_social_icon', 'tp_social_selected_icon'); ?>
                        <?php endif; ?>
                        <?php elseif( $item['tp_social_icon_type'] == 'image' ) : ?>
                        <?php if (!empty($item['tp_social_image']['url'])): ?>
                        <img src="<?php echo $item['tp_social_image']['url']; ?>"
                            alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_social_image']['url']), '_wp_attachment_image_alt', true); ?>">
                        <?php endif; ?>
                        <?php else : ?>
                        <?php if (!empty($item['tp_social_icon_svg'])): ?>
                        <?php echo $item['tp_social_icon_svg']; ?>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endif; ?>

                        <?php if(!empty($item['tp_social_title'])) : ?>
                        <p class="d-none d-sm-block"><?php echo tp_kses($item['tp_social_title']); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>

                </div>
                <div class="tp-hero-3-wrapper p-relative">
                    <?php if(!empty($settings['tp_banner_shape_switch'])) : ?>
                    <div class="tp-hero-3-border-wrap d-none d-md-block">
                        <span class="redius-shape-1"></span>
                        <span class="redius-shape-2"></span>
                        <span class="redius-shape-3"></span>
                    </div>
                    <?php endif; ?>
                    <?php if($tp_thumbnail_image) : ?>
                    <div class="tp-hero-3-main-thumb z-index-5">
                        <img src="<?php echo esc_url($tp_thumbnail_image); ?>"
                            alt="<?php echo esc_attr($tp_thumbnail_image_alt); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($tp_shape_image_2)) : ?>
                    <div class="tp-hero-3-shape-5 d-none d-lg-block wow frist-img animated">
                        <img src="<?php echo esc_url($tp_shape_image_2); ?>"
                            alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($settings['tp_banner_shape_switch'])) : ?>
                    <div class="tp-hero-3-shape-6 d-none d-lg-block">
                        <span>
                            <svg width="64" height="202" viewBox="0 0 64 202" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path class="line-2"
                                    d="M63.0029 7.94799C45.0715 -0.936415 14.5884 -8.38783 36.1059 32.8816C63.0029 84.4681 71.2089 85.3283 36.1059 75.8707C1.00293 66.4131 15.5915 92.2063 36.1059 118C56.6205 143.794 57.0764 169.587 28.3558 152.391C-0.364664 135.195 1.00293 144.653 28.3558 179.904C55.7087 215.155 22.4293 195.38 1.00293 196.24"
                                    stroke="#202124" stroke-width="2" />
                            </svg>
                        </span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php elseif ( $settings['tp_design_style']  == 'layout-4' ): 

    // thumbnail image
    if ( !empty($settings['tp_thumbnail_image']['url']) ) {
        $tp_thumbnail_image = !empty($settings['tp_thumbnail_image']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image']['url'];
        $tp_thumbnail_image_alt = get_post_meta($settings["tp_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_thumbnail_image_2']['url']) ) {
        $tp_thumbnail_image_2 = !empty($settings['tp_thumbnail_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image_2']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image_2']['url'];
        $tp_thumbnail_image_alt_2 = get_post_meta($settings["tp_thumbnail_image_2"]["id"], "_wp_attachment_image_alt", true);
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

    // Link
    if ('2' == $settings['tp_banner_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_banner_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-yellow-border wow tpfadeRight');
        $this->add_render_attribute('tp-button-arg', 'data-wow-duration', '.9s');
        $this->add_render_attribute('tp-button-arg', 'data-wow-delay', '.7s');
    } else {
        if ( ! empty( $settings['tp_banner_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_banner_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-yellow-border wow tpfadeRight');
            $this->add_render_attribute('tp-button-arg', 'data-wow-duration', '.9s');
            $this->add_render_attribute('tp-button-arg', 'data-wow-delay', '.7s');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-hero-title-4 pb-35 tp-char-animation');
?>

<div class="tp-hero-area tp-hero-overlay blue-bg pt-200 pb-115 p-relative tp-el-section">
    <?php if(!empty($tp_shape_image)) : ?>
    <div class="tp-hero-4-shape-img  wow tpfadeLeft" data-wow-duration=".9s" data-wow-delay=".5s">
        <img src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($tp_shape_image_2)) : ?>
    <div class="tp-hero-glob-img">
        <img src="<?php echo esc_url($tp_shape_image_2); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-7">
                <div class="tp-hero-4-section-box pt-10 z-index-3">

                    <?php if (!empty($settings['tp_banner_sub_title'])) : ?>
                    <h5 class="tp-section-subtitle-4 tp-char-animation">
                        <?php echo tp_kses( $settings['tp_banner_sub_title'] ); ?></h5>
                    <?php endif; ?>
                    <?php
                        if ( !empty($settings['tp_banner_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['tp_banner_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                tp_kses( $settings['tp_banner_title' ] )
                                );
                        endif;
                    ?>
                    <?php if (!empty($settings['tp_banner_description'])) : ?>
                    <p class="tp-text-white"><?php echo tp_kses( $settings['tp_banner_description'] ); ?></p>
                    <?php endif; ?>

                    <?php if ( !empty($settings['tp_banner_btn_text']) ) : ?>
                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><span><?php echo tp_kses($settings['tp_banner_btn_text']); ?><i
                                class="far fa-angle-right"></i></span></a>
                    <?php endif; ?>

                </div>
            </div>
            <div class="col-xl-5 col-lg-5">
                <div class="tp-hero-4-img-wrapper p-relative">
                    <?php if(!empty($tp_thumbnail_image)) : ?>
                    <div class="tp-hero-4-main-img text-center z-index-3">
                        <img src="<?php echo esc_url($tp_thumbnail_image); ?>"
                            alt="<?php echo esc_attr($tp_thumbnail_image_alt); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($tp_thumbnail_image_2)) : ?>
                    <div class="tp-hero-4-sub-img z-index-3">
                        <img src="<?php echo esc_url($tp_thumbnail_image_2); ?>"
                            alt="<?php echo esc_attr($tp_thumbnail_image_alt_2); ?>">
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php elseif ( $settings['tp_design_style']  == 'layout-5' ): 

    // thumbnail image
    if ( !empty($settings['tp_thumbnail_image']['url']) ) {
        $tp_thumbnail_image = !empty($settings['tp_thumbnail_image']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image']['url'];
        $tp_thumbnail_image_alt = get_post_meta($settings["tp_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_thumbnail_image_2']['url']) ) {
        $tp_thumbnail_image_2 = !empty($settings['tp_thumbnail_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image_2']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image_2']['url'];
        $tp_thumbnail_image_alt_2 = get_post_meta($settings["tp_thumbnail_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_thumbnail_image_3']['url']) ) {
        $tp_thumbnail_image_3 = !empty($settings['tp_thumbnail_image_3']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image_3']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image_3']['url'];
        $tp_thumbnail_image_alt_3 = get_post_meta($settings["tp_thumbnail_image_3"]["id"], "_wp_attachment_image_alt", true);
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

    // Link
    if ('2' == $settings['tp_banner_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_banner_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-blue-lg purple-bg circle-effect mr-15 mb-20');
    } else {
        if ( ! empty( $settings['tp_banner_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_banner_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-blue-lg purple-bg circle-effect mr-15 mb-20');
        }
    }



    // Link 2
    if ('2' == $settings['tp_banner2_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg2', 'href', get_permalink($settings['tp_banner2_btn_page_link']));
        $this->add_render_attribute('tp-button-arg2', 'target', '_self');
        $this->add_render_attribute('tp-button-arg2', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg2', 'class', 'tp-btn-grey mb-20');
    } else {
        if ( ! empty( $settings['tp_banner2_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg2', $settings['tp_banner2_btn_link'] );
            $this->add_render_attribute('tp-button-arg2', 'class', 'tp-btn-grey mb-20');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-hero-title-5 hero-text-anim-2');
?>


<div class="tp-hero-area tp-hero-five__ptb-5 p-relative grey-bg-2 fix">
    <?php if(!empty($tp_shape_image)) : ?>
    <div class="tp-hero-five__shape-2">
        <img src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($tp_shape_image_2)) : ?>
    <div class="tp-hero-five__shape-3">
        <img src="<?php echo esc_url($tp_shape_image_2); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($tp_shape_image_3)) : ?>
    <div class="tp-hero-five__shape-4">
        <img src="<?php echo esc_url($tp_shape_image_3); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_3); ?>">
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-7 col-lg-6 order-2">
                <div class="tp-hero-five-section-wrap">
                    <div class="tp-hero-five-section-box z-index">
                        <?php if (!empty($settings['tp_banner_sub_title'])) : ?>
                        <span class="tp-section-subtitle-5 text-black"><?php echo tp_kses( $settings['tp_banner_sub_title'] ); ?></span>
                        <?php endif; ?>
                        <?php
                            if ( !empty($settings['tp_banner_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_banner_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_banner_title' ] )
                                    );
                            endif;
                        ?>
                        <?php if (!empty($settings['tp_banner_description'])) : ?>
                        <p class="wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".5s"><?php echo tp_kses( $settings['tp_banner_description'] ); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="tp-hero-five-btn-box d-flex align-items-center wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".7s">
                        <?php if ( !empty($settings['tp_banner_btn_text']) ) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo tp_kses($settings['tp_banner_btn_text']); ?></a>
                        <?php endif; ?>
                        <?php if ( !empty($settings['tp_banner2_btn_text']) ) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg2' ); ?>><?php echo tp_kses($settings['tp_banner2_btn_text']); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tp-hero-five-2-thumb-main p-relative">
        <?php if(!empty($tp_thumbnail_image)) : ?>
        <div class="tp-hero-five-2-thumb">
            <img class="tp-hero-five-2-thumb-inner" src="<?php echo esc_url($tp_thumbnail_image); ?>" alt="<?php echo esc_attr($tp_thumbnail_image_alt); ?>">
        </div>
        <?php endif; ?>
        <?php if(!empty($tp_thumbnail_image_2)) : ?>
        <div class="tp-hero-five-2-sub-img-1 d-none d-md-block">
            <img src="<?php echo esc_url($tp_thumbnail_image_2); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
        </div>
        <?php endif; ?>
        <?php if(!empty($tp_shape_image_3)) : ?>
        <div class="tp-hero-five-2-sub-img-2 d-none d-md-block">
            <img src="<?php echo esc_url($tp_thumbnail_image_3); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_3); ?>">
        </div>
        <?php endif; ?>
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
    if ( !empty($settings['tp_shape_image_2']['url']) ) {
        $tp_shape_image_2 = !empty($settings['tp_shape_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_2']['url'];
        $tp_shape_image_alt_2 = get_post_meta($settings["tp_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_3']['url']) ) {
        $tp_shape_image_3 = !empty($settings['tp_shape_image_3']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_3']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_3']['url'];
        $tp_shape_image_alt_3 = get_post_meta($settings["tp_shape_image_3"]["id"], "_wp_attachment_image_alt", true);
    }
    
    $this->add_render_attribute('title_args', 'class', 'tp-hero-2-title');
    // Link
    if ('2' == $settings['tp_banner_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_banner_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
    } else {
        if ( ! empty( $settings['tp_banner_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_banner_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
        }
    }
?>
 <section class="tp-hero-2-area p-relative" data-background="<?php echo esc_url($tp_thumbnail_image); ?>">
            <div class="tp-hero-2-wrapper p-relative">
               <div class="container">
                  <div class="row align-items-center justify-content-center">
                     <div class="col-xl-12">
                        <div class="tp-hero-2-shape">
                            <?php if(!empty($tp_shape_image)) : ?>
                                <img  class="shape-1 d-none d-lg-block" src="<?php echo esc_url($tp_shape_image); ?>"
                                    alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
                            <?php endif; ?>
                            <?php if(!empty($tp_shape_image_2)) : ?>
                                <img  class="shape-2 d-none d-lg-block" src="<?php echo esc_url($tp_shape_image_2); ?>"
                                    alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
                            <?php endif; ?>
                            <?php if(!empty($tp_shape_image_3)) : ?>
                                <img  class="shape-3 d-none d-lg-block" src="<?php echo esc_url($tp_shape_image_3); ?>"
                                    alt="<?php echo esc_attr($tp_shape_image_alt_3); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="tp-hero-2-content text-center pt-200">
                           <div class="tp-hero-2-title-wrapper fadeUp">

                                <?php if ( !empty($settings['tp_banner_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_banner_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_banner_title' ] )
                                    );
                                endif; ?>
                           </div>

                           <div class="tp-hero-2-btn fadeUp">
                              <?php if ( !empty($settings['tp_banner_btn_text']) ) : ?>
                                <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo tp_kses($settings['tp_banner_btn_text']); ?></a>
                                <?php endif; ?>
                           </div>

                        </div>
                        <div class="tp-hero-2-side-text">
                           <div class="tp-hero-2-mail">
                              <a href="mailto:<?php echo esc_attr($settings['tpcore_hero_slider_phone']); ?>">
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
                                
                                <?php echo tp_kses($settings['tpcore_hero_slider_phone']); ?>
                            </a>
                           </div>
                           <div class="tp-hero-2-message">
                              <p>
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
                                
                                <?php echo tp_kses($settings['tpcore_hero_slider_email']); ?>
                             </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tp-hero-2-bottom p-relative d-none d-md-block">
               <div class="hero-active-2">
                  <div class="swiper-wrapper">
                    <?php 
                        // repeter field 
                        if ( !empty($settings['tpcore_hero_slider_list']) ) :
                            foreach ( $settings['tpcore_hero_slider_list'] as $item ) :
                                $tp_hero_bottom_title = !empty($item['tpcore_hero_slider_title']) ? $item['tpcore_hero_slider_title'] : ''; ?>
                            <div class="swiper-slide">
                                <h3 class="tp-hero-2-bottom-title"><?php echo tp_kses($tp_hero_bottom_title); ?></h3>
                            </div>
                            <?php endforeach;  endif; ?>
                  </div>
               </div>
               <div class="tp-hero-2-nav d-none d-xl-block">
                  <button type="button" class="hero-button-prev-1"><?php echo esc_html__("prev","tpcore") ?></button>
                  <button type="button" class="hero-button-next-1"><?php echo esc_html__("next","tpcore") ?></button>
               </div>
            </div>
         </section>

<?php endif; 
		
	}

}

$widgets_manager->register( new TP_Hero_Banner() );