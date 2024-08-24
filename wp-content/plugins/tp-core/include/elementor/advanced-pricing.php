<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Repeater;
use \Elementor\Control_Media;
use \Elementor\Utils;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Advanced_Pricing extends Widget_Base {

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
		return 'tp-advanced-pricing';
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
		return __( 'Advanced Pricing', 'tpcore' );
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


        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __('Design Style', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
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

        // title/content
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // Header
        $this->start_controls_section(
            '_section_header',
            [
                'label' => __('Header', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $this->add_control(
            'show_header',
            [
                'label' => __('Show', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'tpcore'),
                'label_off' => __('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );
        
        $this->add_control(
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
                'condition' => [
                    'show_header' => 'yes'
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
                    'show_header' => 'yes'
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
                    'show_header' => 'yes'
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
                        'show_header' => 'yes'
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
                        'show_header' => 'yes'
                    ]
                ]
            );
        }

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => __('Basic', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'dynamic' => [
                    'active' => true
                ],
                'condition' => [
                    'show_header' => 'yes'
                ]
            ]
        );


        $this->end_controls_section();

        // pricing top
        $this->start_controls_section(
            '_section_pricing_top',
            [
                'label' => __('Pricing Top Area', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_pricing_top_main_title',
            [
                'label' => __('Title', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Features & Services', 'tpcore'),
                'label_block' => true,
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'condition' => [
                    'tp_design_style' => 'layout-3'
                ]
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
                    'style_3' => __( 'Style 3', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_pricing_top_active',
            [
                'label' => __('Active Price', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'tpcore'),
                'label_off' => __('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => '0',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_pricing_top_title',
            [
                'label' => __('Pricing Title', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Exciting Pricing', 'tpcore'),
                'label_block' => true,
                'description' => tp_get_allowed_html_desc( 'basic' ),
            ]
        );

        $repeater->add_control(
            'tp_pricing_top_des',
            [
                'label' => __('Pricing Description', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Collect more submissions, access most of the features', 'tpcore'),
                'label_block' => true,
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2']
                ]
            ]
        );

        $repeater->add_control(
            'tp_price_top_currency',
            [
                'label' => __('Currency', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    '' => __('None', 'tpcore'),
                    'baht' => '&#3647; ' . _x('Baht', 'Currency Symbol', 'tpcore'),
                    'bdt' => '&#2547; ' . _x('BD Taka', 'Currency Symbol', 'tpcore'),
                    'dollar' => '&#36; ' . _x('Dollar', 'Currency Symbol', 'tpcore'),
                    'euro' => '&#128; ' . _x('Euro', 'Currency Symbol', 'tpcore'),
                    'franc' => '&#8355; ' . _x('Franc', 'Currency Symbol', 'tpcore'),
                    'guilder' => '&fnof; ' . _x('Guilder', 'Currency Symbol', 'tpcore'),
                    'krona' => 'kr ' . _x('Krona', 'Currency Symbol', 'tpcore'),
                    'lira' => '&#8356; ' . _x('Lira', 'Currency Symbol', 'tpcore'),
                    'peso' => '&#8369; ' . _x('Peso', 'Currency Symbol', 'tpcore'),
                    'pound' => '&#163; ' . _x('Pound Sterling', 'Currency Symbol', 'tpcore'),
                    'real' => 'R$ ' . _x('Real', 'Currency Symbol', 'tpcore'),
                    'ruble' => '&#8381; ' . _x('Ruble', 'Currency Symbol', 'tpcore'),
                    'indian_rupee' => '&#8377; ' . _x('Rupee (Indian)', 'Currency Symbol', 'tpcore'),
                    'shekel' => '&#8362; ' . _x('Shekel', 'Currency Symbol', 'tpcore'),
                    'won' => '&#8361; ' . _x('Won', 'Currency Symbol', 'tpcore'),
                    'yen' => '&#165; ' . _x('Yen/Yuan', 'Currency Symbol', 'tpcore'),
                    'custom' => __('Custom', 'tpcore'),
                ],
                'default' => 'dollar',
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2']
                ]
            ]
        );

        $repeater->add_control(
            'tp_price_top_custom_currency',
            [
                'label' => __('Custom Symbol', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'tp_price_top_currency' => 'custom',
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2']
                ]
            ]
        );

        $repeater->add_control(
            'tp_price_top_price',
            [
                'label' => __('Price', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => '19',
                'dynamic' => [
                    'active' => true
                ],
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2']
                ]
            ]
        );

        $repeater->add_control(
            'tp_pricing_top_dura',
            [
                'label' => __('Pricing Duration', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('/mo', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2']
                ]
            ]
        );

        $repeater->add_control(
            'tp_pricing_top_dura_des',
            [
                'label' => __('Duration Description', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Billed monthly', 'tpcore'),
                'label_block' => true,
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2']
                ]
            ]
        );

        // pricing button
        $repeater->add_control(
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

        $repeater->add_control(
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
        $repeater->add_control(
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

        $repeater->add_control(
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
        $repeater->add_control(
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

        $this->add_control(
            'pricing_top_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'tp_pricing_top_title' => __('Standard', 'tpcore'),
                    ],
                    [
                        'tp_pricing_top_title' => __('Another Great', 'tpcore'),
                    ],
                    [
                        'tp_pricing_top_title' => __('Obsolete', 'tpcore'),
                    ],
                ],
                'title_field' => '<# print((tp_pricing_top_title)); #>',
            ]
        );

        $this->end_controls_section();

        // features heading
        $this->start_controls_section(
            '_section_features_heading',
            [
                'label' => __('Features Heading', 'tpcore'),
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $repeater = new Repeater();


        $repeater->add_control(
            'tp_features_head_title',
            [
                'label' => __('Feature Heading Title', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Exciting Feature', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'label_block' => true
            ]
        );

        $repeater->add_control(
            'tp_features_head_tooltip',
            [
                'label' => __('Feature Tooltip Title', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Add gradient heading, button, pricing table testimonial etc.', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'label_block' => true
            ]
        );

        $this->add_control(
            'features_head_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [ 
                        'tp_features_head_title' => __('Team', 'tpcore'),
                    ],
                    [
                        'tp_features_head_title' => __('Installed Agent', 'tpcore'),
                    ],
                    [
                        'tp_features_head_title' => __('Real-Time Feedback', 'tpcore'),
                    ],
                    [
                        'tp_features_head_title' => __('Adding Time Manually', 'tpcore'),
                    ],
                    [
                        'tp_features_head_title' => __('Local Storages', 'tpcore'),
                    ],
                    [
                        'tp_features_head_title' => __('Life Time Access', 'tpcore'),
                    ],
                ],
                'title_field' => '<# print((tp_features_head_title)); #>',
            ]
        );

        $this->end_controls_section();

        // feature title
        $this->start_controls_section(
            '_section_features_title',
            [
                'label' => __('Features Title', 'tpcore'),
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tp_feature_active',
            [
                'label' => __('Active Features Area', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'tpcore'),
                'label_off' => __('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => '0',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_features_title1',
            [
                'label' => __('Feature Title 1', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Exciting Feature 1', 'tpcore'),
                'label_block' => true
            ]
        );
        $repeater->add_control(
            'tp_features_title2',
            [
                'label' => __('Feature Title 2', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Exciting Feature 2', 'tpcore'),
                'label_block' => true
            ]
        );
        $repeater->add_control(
            'tp_features_title3',
            [
                'label' => __('Feature Title 3', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Exciting Feature 3', 'tpcore'),
                'label_block' => true
            ]
        );
        $repeater->add_control(
            'tp_features_title4',
            [
                'label' => __('Feature Title 4', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Exciting Feature 4', 'tpcore'),
                'label_block' => true
            ]
        );
        $repeater->add_control(
            'tp_features_title5',
            [
                'label' => __('Feature Title 5', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Exciting Feature 5', 'tpcore'),
                'label_block' => true
            ]
        );
        $repeater->add_control(
            'tp_features_title6',
            [
                'label' => __('Feature Title 6', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Exciting Feature 6', 'tpcore'),
                'label_block' => true
            ]
        );

        $this->add_control(
            'features_title_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'tp_features_title1' => __('Feature 1', 'tpcore'),
                        'tp_features_title2' => __('Feature 2', 'tpcore'),
                        'tp_features_title3' => __('Feature 3', 'tpcore'),
                        'tp_features_title4' => __('Feature 4', 'tpcore'),
                        'tp_features_title5' => __('Feature 5', 'tpcore'),
                        'tp_features_title6' => __('Feature 6', 'tpcore'),
                    ],
                    [
                        'tp_features_title1' => __('Feature 1', 'tpcore'),
                        'tp_features_title2' => __('Feature 2', 'tpcore'),
                        'tp_features_title3' => __('Feature 3', 'tpcore'),
                        'tp_features_title4' => __('Feature 4', 'tpcore'),
                        'tp_features_title5' => __('Feature 5', 'tpcore'),
                        'tp_features_title6' => __('Feature 6', 'tpcore'),
                    ],
                    [
                        'tp_features_title1' => __('Feature 1', 'tpcore'),
                        'tp_features_title2' => __('Feature 2', 'tpcore'),
                        'tp_features_title3' => __('Feature 3', 'tpcore'),
                        'tp_features_title4' => __('Feature 4', 'tpcore'),
                        'tp_features_title5' => __('Feature 5', 'tpcore'),
                        'tp_features_title6' => __('Feature 6', 'tpcore'),
                    ],
                ],
                'title_field' => '<# print((tp_features_title1)); #>',
            ]
        );

        $this->end_controls_section();

        // facilities
        $this->start_controls_section(
            '_section_facilities',
            [
                'label' => __('Facilities', 'tpcore'),
                'condition' => [
                    'tp_design_style' => 'layout-3'
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tp_faci_main_title',
            [
                'label' => __('Main Title', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Facilities Title', 'tpcore'),
                'label_block' => true,
                'separator' => 'after'
            ]
        );

        // content 1
        $repeater->add_control(
			'con1_heading',
			[
				'label' => esc_html__( 'Content 1', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
        $repeater->add_control(
            'faci_con_condition1',
            [
                'label' => __( 'Field Type 1', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'text' => __( 'Text Field', 'tpcore' ),
                    'icon' => __( 'Icon Type', 'tpcore' ),
                ],
                'default' => 'text',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'faci_con_icon1',
            [
                'label' => __( 'Select Icon 1', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fa-check' => __( 'Checked', 'tpcore' ),
                    'fa-times' => __( 'Unchecked', 'tpcore' ),
                ],
                'default' => 'fa-check',
                'frontend_available' => true,
                'style_transfer' => true,
                'condition' => [
                    'faci_con_condition1' => 'icon'
                ],
            ]
        );

        $repeater->add_control(
            'tp_faci_content1',
            [
                'label' => __('Content 1', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Facilities 1', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'faci_con_condition1' => 'text'
                ]
            ]
        );

        // content 2
        $repeater->add_control(
			'con2_heading',
			[
				'label' => esc_html__( 'Content 2', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
			]
		);
        $repeater->add_control(
            'faci_con_condition2',
            [
                'label' => __( 'Field Type 2', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'text' => __( 'Text Field', 'tpcore' ),
                    'icon' => __( 'Icon Type', 'tpcore' ),
                ],
                'default' => 'text',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'faci_con_icon2',
            [
                'label' => __( 'Select Icon 2', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fa-check' => __( 'Checked', 'tpcore' ),
                    'fa-times' => __( 'Unchecked', 'tpcore' ),
                ],
                'default' => 'fa-check',
                'frontend_available' => true,
                'style_transfer' => true,
                'condition' => [
                    'faci_con_condition2' => 'icon'
                ],
            ]
        );

        $repeater->add_control(
            'tp_faci_content2',
            [
                'label' => __('Content 2', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Facilities 2', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'faci_con_condition2' => 'text'
                ]
            ]
        );

        // content 3
        $repeater->add_control(
			'con3_heading',
			[
				'label' => esc_html__( 'Content 3', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
			]
		);
        $repeater->add_control(
            'faci_con_condition3',
            [
                'label' => __( 'Field Type 3', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'text' => __( 'Text Field', 'tpcore' ),
                    'icon' => __( 'Icon Type', 'tpcore' ),
                ],
                'default' => 'text',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'faci_con_icon3',
            [
                'label' => __( 'Select Icon 3', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fa-check' => __( 'Checked', 'tpcore' ),
                    'fa-times' => __( 'Unchecked', 'tpcore' ),
                ],
                'default' => 'fa-check',
                'frontend_available' => true,
                'style_transfer' => true,
                'condition' => [
                    'faci_con_condition3' => 'icon'
                ],
            ]
        );

        $repeater->add_control(
            'tp_faci_content3',
            [
                'label' => __('Content 3', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Facilities 3', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'faci_con_condition3' => 'text'
                ]
            ]
        );

        $this->add_control(
            'facilities_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'tp_faci_main_title' => __('Version History', 'tpcore'),
                        'tp_faci_content1' => __('Content 1', 'tpcore'),
                        'tp_faci_content2' => __('Content 2', 'tpcore'),
                        'tp_faci_content3' => __('Content 3', 'tpcore'),
                    ],
                    [
                        'tp_faci_main_title' => __('Send invoices and quotes', 'tpcore'),
                        'tp_faci_content1' => __('Content 2.1', 'tpcore'),
                        'tp_faci_content2' => __('Content 2.2', 'tpcore'),
                        'tp_faci_content3' => __('Content 2.3', 'tpcore'),
                    ],
                    [
                        'tp_faci_main_title' => __('Cross platform', 'tpcore'),
                        'tp_faci_content1' => __('Content 3.1', 'tpcore'),
                        'tp_faci_content2' => __('Content 3.2', 'tpcore'),
                        'tp_faci_content3' => __('Content 3.3', 'tpcore'),
                    ],
                    [
                        'tp_faci_main_title' => __('Scan receipts and bills', 'tpcore'),
                        'tp_faci_content1' => __('Content 4.1', 'tpcore'),
                        'tp_faci_content2' => __('Content 4.2', 'tpcore'),
                        'tp_faci_content3' => __('Content 4.3', 'tpcore'),
                    ],
                ],
                'title_field' => '<# print((tp_faci_main_title)); #>',
            ]
        );

        $this->end_controls_section();

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('pricing_section', 'Section - Style', '.tp-el-section');
    }

    private static function get_currency_symbol($symbol_name)
    {
        $symbols = [
            'baht' => '&#3647;',
            'bdt' => '&#2547;',
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'guilder' => '&fnof;',
            'indian_rupee' => '&#8377;',
            'pound' => '&#163;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'rupee' => '&#8360;',
            'real' => 'R$',
            'krona' => 'kr',
            'won' => '&#8361;',
            'yen' => '&#165;',
        ];

        return isset($symbols[$symbol_name]) ? $symbols[$symbol_name] : '';
    }

    private static function get_currency_symbol_text($symbol_text)
    {
        $symbols =[
            'baht' => 'THB',
            'bdt' => 'BDT',
            'dollar' => 'USD',
            'euro' => 'EUR',
            'franc' => 'EUR',
            'guilder' => 'GLD',
            'indian_rupee' => 'INR',
            'pound' => 'GBP',
            'peso' => 'MXN',
            'lira' => 'TRY',
            'ruble' => 'RUB',
            'shekel' => 'ILS',
            'real' => 'BRL',
            'krona' => 'KR',
            'won' => 'KRW',
            'yen' => 'JPY',
        ];

        return isset($symbols[$symbol_text]) ? $symbols[$symbol_text] : '';
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
    $this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>


<div class="tp-price-area pt-10 pb-10">
    <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
    <div class="row g-0">
        <div class="col-12">
            <div class="tp-price-sction-box text-center mb-30">
                <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                <h5 class="tp-section-subtitle"><?php echo tp_kses($settings['tp_section_sub_title']); ?></h5>
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
                <p><?php echo tp_kses($settings['tp_section_description']); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="tp-price-table price-inner-white-bg z-index-3">
        <div class="tp-price-table-wrapper">
            <div class="row g-0 align-items-center">
                <div class="col-4">
                    <div class="tp-price-header">
                        <?php if($settings['tp_box_icon_type'] == 'icon') : ?>
                        <?php if (!empty($settings['tp_box_icon']) || !empty($settings['tp_box_selected_icon']['value'])) : ?>
                        <div class="tp-price-header-img">
                            <?php tp_render_icon($settings, 'tp_box_icon', 'tp_box_selected_icon'); ?>
                        </div>
                        <?php endif; ?>
                        <?php elseif( $settings['tp_box_icon_type'] == 'image' ) : ?>
                        <?php if (!empty($settings['tp_box_icon_image']['url'])): ?>
                        <div class="tp-price-header-img">
                            <img src="<?php echo $settings['tp_box_icon_image']['url']; ?>"
                                alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                        </div>
                        <?php endif; ?>
                        <?php else : ?>
                        <?php if (!empty($settings['tp_box_icon_svg'])): ?>
                        <div class="tp-price-header-img">
                            <?php echo $settings['tp_box_icon_svg']; ?>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(!empty($settings['title'])) : ?>
                        <div class="tp-price-header-content">
                            <p><?php echo tp_kses($settings['title']); ?></p>
                        </div>
                        <?php endif; ?> 
                    </div>
                </div>
                <div class="col-8">
                    <div class="tp-price-top-wrapper">
                        <?php foreach($settings['pricing_top_list'] as $key => $item ) : 
                            // Link
                            if ('2' == $item['tp_btn_link_type']) {
                                $link = get_permalink($item['tp_btn_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                                $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                            }

                            // currency
                            if ($item['tp_price_top_currency'] === 'custom') {
                                $top_currency = $item['tp_price_top_custom_currency'];
                            } else {
                                $top_currency = self::get_currency_symbol($item['tp_price_top_currency']);
                            }
                            $active_price = $item['tp_pricing_top_active'] ? 'active' : NULL;
                        ?>
                        <div class="tp-price-top-item text-center <?php echo esc_attr($active_price); ?>">
                            <div class="tp-price-top-tag-wrapper">
                                <?php if(!empty($item['tp_pricing_top_title'])) : ?>
                                <span><?php echo tp_kses($item['tp_pricing_top_title']); ?></span>
                                <?php endif; ?>
                                <?php if(!empty($item['tp_pricing_top_des'])) : ?>
                                <p><?php echo tp_kses($item['tp_pricing_top_des']); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="tp-price-top-title-wrapper">
                                <h4><?php echo esc_html($top_currency); ?><?php echo tp_kses($item['tp_price_top_price']); ?> <?php if(!empty($item['tp_pricing_top_dura'])) : ?><span><?php echo tp_kses($item['tp_pricing_top_dura']); ?></span><?php endif; ?></h4>
                                <?php if(!empty($item['tp_pricing_top_dura_des'])) : ?>
                                <p><?php echo tp_kses($item['tp_pricing_top_dura_des']); ?></p>
                                <?php endif; ?>
                                <?php if(!empty($item['tp_btn_text'])) : ?>
                                <a class="tp-btn-service" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" ><?php echo tp_kses($item['tp_btn_text']); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="tp-price-feature-wrapper">
                <div class="row g-0">
                    <div class="col-4">
                        <div class="tp-price-feature-box">
                            <?php foreach($settings['features_head_list'] as $key => $item) : ?>
                            <div class="tp-price-feature-item">
                                <div class="d-flex align-items-center">
                                    <?php if(!empty($item['tp_features_head_title'])) : ?>
                                    <span><?php echo tp_kses($item['tp_features_head_title']); ?></span>
                                    <?php endif; ?>
                                    <div class="tp-price-feature-tooltip-box p-relative">
                                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle opacity="0.5" cx="8" cy="8" r="7" stroke="#5F6168" stroke-width="1.5"></circle>
                                            <path d="M8 11.5V7.3" stroke="#5F6168" stroke-width="1.5" stroke-linecap="round"></path>
                                            <circle r="0.7" transform="matrix(1 0 0 -1 7.99883 5.19941)" fill="#5F6168"></circle>
                                        </svg>
                                        <?php if(!empty($item['tp_features_head_tooltip'])) : ?>
                                        <div class="tp-price-feature-tooltip">
                                            <p><?php echo tp_kses($item['tp_features_head_tooltip']); ?></p>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-8">
                        <?php foreach($settings['features_title_list'] as $key => $item) : $active = $item['tp_feature_active'] ? 'active' : NULL; ?>
                        <div class="tp-price-feature-info-item <?php echo esc_attr($active); ?>">
                            <?php if(!empty($item['tp_features_title1'])) : ?>
                            <div class="tp-price-feature-info text-center">
                                <span><?php echo tp_kses($item['tp_features_title1']); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if(!empty($item['tp_features_title2'])) : ?>
                            <div class="tp-price-feature-info text-center">
                                <span><?php echo tp_kses($item['tp_features_title2']); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if(!empty($item['tp_features_title3'])) : ?>
                            <div class="tp-price-feature-info text-center">
                                <span><?php echo tp_kses($item['tp_features_title3']); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if(!empty($item['tp_features_title4'])) : ?>
                            <div class="tp-price-feature-info text-center">
                                <span><?php echo tp_kses($item['tp_features_title4']); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if(!empty($item['tp_features_title5'])) : ?>
                            <div class="tp-price-feature-info text-center">
                                <span><?php echo tp_kses($item['tp_features_title5']); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if(!empty($item['tp_features_title6'])) : ?>
                            <div class="tp-price-feature-info text-center">
                                <span><?php echo tp_kses($item['tp_features_title6']); ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach ; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php elseif ( $settings['tp_design_style']  == 'layout-3' ) : 
    $this->add_render_attribute('title_args', 'class', 'tp-section-title tp-section-title-shape p-relative');
?>

<div class="plan-area pb-110">
    <div class="container">
        <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="plan-section-box text-center pb-20">
                    <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                    <h5 class="tp-section-subtitle"><?php echo tp_kses($settings['tp_section_sub_title']); ?></h5>
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
                    <p><?php echo tp_kses($settings['tp_section_description']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="pr-feature-box">
            <div class="pr-feature-main">
                <div class="pr-feature-wrapper">
                    <div class="row gx-0 align-items-center">
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <?php if(!empty($settings['tp_pricing_top_main_title'])) : ?>
                            <div class="pr-feature-head">
                                <div class="pr-feature-title-box">
                                    <h5 class="pr-feature-title"><?php echo tp_kses($settings['tp_pricing_top_main_title']); ?></h5>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8">
                            <div class="pr-feature-head">
                                <ul>
                                    <?php foreach($settings['pricing_top_list'] as $key => $item ) : 
                                        // Link
                                        if ('2' == $item['tp_btn_link_type']) {
                                            $link = get_permalink($item['tp_btn_page_link']);
                                            $target = '_self';
                                            $rel = 'nofollow';
                                        } else {
                                            $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                                            $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                                            $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                                        }
                                        $active_price = $item['tp_pricing_top_active'] ? 'active' : NULL;
                                    ?>
                                    <li>
                                        <div class="pr-feature-item <?php echo esc_attr($active_price); ?>">
                                            <?php if(!empty($item['tp_pricing_top_title'])) : ?>
                                            <h5><?php echo tp_kses($item['tp_pricing_top_title']); ?></h5>
                                            <?php endif; ?>
                                            <?php if(!empty($item['tp_btn_text'])) : ?>
                                            <a class="tp-btn-service black-bg text-white" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>"><?php echo tp_kses($item['tp_btn_text']); ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pr-feature-wrapper-2">
                    <?php foreach($settings['facilities_list'] as $key => $item) : ?>
                    <div class="row gx-0 align-items-center pr-feature-height">
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <?php if(!empty($item['tp_faci_main_title'])) : ?>
                            <div class="pr-feature-bottom">
                                <div class="pr-feature-title-box">
                                    <h5 class="pr-feature-title-sm"><?php echo tp_kses($item['tp_faci_main_title']); ?></h5>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8">
                            <div class="pr-feature-bottom">
                                <ul>
                                    <?php if(!empty($item['faci_con_condition1'])) : ?>
                                    <li>
                                        <span>
                                            <?php if($item['faci_con_condition1'] == 'text') : ?>
                                            <?php echo tp_kses($item['tp_faci_content1']); ?>
                                            <?php else : ?>
                                            <i class="far <?php echo esc_attr($item['faci_con_icon1']); ?>"></i>
                                            <?php endif; ?>
                                        </span>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(!empty($item['faci_con_condition2'])) : ?>
                                    <li>
                                        <span>
                                            <?php if($item['faci_con_condition2'] == 'text') : ?>
                                            <?php echo tp_kses($item['tp_faci_content2']); ?>
                                            <?php else : ?>
                                            <i class="far <?php echo esc_attr($item['faci_con_icon2']); ?>"></i>
                                            <?php endif; ?>
                                        </span>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(!empty($item['faci_con_condition3'])) : ?>
                                    <li>
                                        <span>
                                            <?php if($item['faci_con_condition3'] == 'text') : ?>
                                            <?php echo tp_kses($item['tp_faci_content3']); ?>
                                            <?php else : ?>
                                            <i class="far <?php echo esc_attr($item['faci_con_icon3']); ?>"></i>
                                            <?php endif; ?>
                                        </span>
                                    </li>
                                    <?php endif; ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- default style -->
<?php else:
    $this->add_render_attribute('title_args', 'class', 'tp-section-title-4 pb-25');
?>

<div class="tp-price-area pt-120 pb-145 blue-bg">
    <div class="container">
        <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
        <div class="row g-0">
            <div class="col-12">
                <div class="tp-price-sction-box text-center mb-30">
                    <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                    <h5 class="tp-section-subtitle-4 both pb-10"><?php echo tp_kses($settings['tp_section_sub_title']); ?></h5>
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
                    <p class="tp-text-white"><?php echo tp_kses($settings['tp_section_description']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="tp-price-table">
            <div class="tp-price-table-wrapper">
                <div class="row g-0 align-items-center">
                    <div class="col-4">
                        <div class="tp-price-header">
                            <?php if($settings['tp_box_icon_type'] == 'icon') : ?>
                            <?php if (!empty($settings['tp_box_icon']) || !empty($settings['tp_box_selected_icon']['value'])) : ?>
                            <div class="tp-price-header-img">
                                <?php tp_render_icon($settings, 'tp_box_icon', 'tp_box_selected_icon'); ?>
                            </div>
                            <?php endif; ?>
                            <?php elseif( $settings['tp_box_icon_type'] == 'image' ) : ?>
                            <?php if (!empty($settings['tp_box_icon_image']['url'])): ?>
                            <div class="tp-price-header-img">
                                <img src="<?php echo $settings['tp_box_icon_image']['url']; ?>"
                                    alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            </div>
                            <?php endif; ?>
                            <?php else : ?>
                            <?php if (!empty($settings['tp_box_icon_svg'])): ?>
                            <div class="tp-price-header-img">
                                <?php echo $settings['tp_box_icon_svg']; ?>
                            </div>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php if(!empty($settings['title'])) : ?>
                            <div class="tp-price-header-content">
                                <p><?php echo tp_kses($settings['title']); ?></p>
                            </div>
                            <?php endif; ?> 
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="tp-price-top-wrapper">
                            <?php foreach($settings['pricing_top_list'] as $key => $item ) : 
                                // Link
                                if ('2' == $item['tp_btn_link_type']) {
                                    $link = get_permalink($item['tp_btn_page_link']);
                                    $target = '_self';
                                    $rel = 'nofollow';
                                } else {
                                    $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                                    $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                                    $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                                }

                                // currency
                                if ($item['tp_price_top_currency'] === 'custom') {
                                    $top_currency = $item['tp_price_top_custom_currency'];
                                } else {
                                    $top_currency = self::get_currency_symbol($item['tp_price_top_currency']);
                                }
                                $active_price = $item['tp_pricing_top_active'] ? 'active' : NULL;
                            ?>
                            <div class="tp-price-top-item text-center <?php echo esc_attr($active_price); ?>">
                                <div class="tp-price-top-tag-wrapper">
                                    <?php if(!empty($item['tp_pricing_top_title'])) : ?>
                                    <span><?php echo tp_kses($item['tp_pricing_top_title']); ?></span>
                                    <?php endif; ?>
                                    <?php if(!empty($item['tp_pricing_top_des'])) : ?>
                                    <p><?php echo tp_kses($item['tp_pricing_top_des']); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="tp-price-top-title-wrapper">
                                    <h4><em><?php echo esc_html($top_currency); ?></em><?php echo tp_kses($item['tp_price_top_price']); ?> <?php if(!empty($item['tp_pricing_top_dura'])) : ?><span><?php echo tp_kses($item['tp_pricing_top_dura']); ?></span><?php endif; ?></h4>
                                    <?php if(!empty($item['tp_pricing_top_dura_des'])) : ?>
                                    <p><?php echo tp_kses($item['tp_pricing_top_dura_des']); ?></p>
                                    <?php endif; ?>
                                    <?php if(!empty($item['tp_btn_text'])) : ?>
                                    <a class="tp-btn-service" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" ><?php echo tp_kses($item['tp_btn_text']); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="tp-price-feature-wrapper">
                    <div class="row g-0">
                        <div class="col-4">
                            <div class="tp-price-feature-box">
                                <?php foreach($settings['features_head_list'] as $key => $item) : ?>
                                <div class="tp-price-feature-item">
                                    <div class="d-flex align-items-center">
                                        <?php if(!empty($item['tp_features_head_title'])) : ?>
                                        <span><?php echo tp_kses($item['tp_features_head_title']); ?></span>
                                        <?php endif; ?>
                                        <div class="tp-price-feature-tooltip-box p-relative">
                                            <svg width="14" height="14" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                                <circle opacity="0.5" cx="8" cy="8" r="7" stroke="white"
                                                stroke-width="1.5" />
                                                <path d="M8 11.5V7.3" stroke="white" stroke-width="1.5"
                                                stroke-linecap="round" />
                                                <circle r="0.7" transform="matrix(1 0 0 -1 7.99883 5.19966)"
                                                fill="white" />
                                            </svg>
                                            <?php if(!empty($item['tp_features_head_tooltip'])) : ?>
                                            <div class="tp-price-feature-tooltip">
                                                <p><?php echo tp_kses($item['tp_features_head_tooltip']); ?></p>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-8">
                            <?php foreach($settings['features_title_list'] as $key => $item) : $active = $item['tp_feature_active'] ? 'active' : NULL; ?>
                            <div class="tp-price-feature-info-item <?php echo esc_attr($active); ?>">
                                <?php if(!empty($item['tp_features_title1'])) : ?>
                                <div class="tp-price-feature-info text-center">
                                    <span><?php echo tp_kses($item['tp_features_title1']); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if(!empty($item['tp_features_title2'])) : ?>
                                <div class="tp-price-feature-info text-center">
                                    <span><?php echo tp_kses($item['tp_features_title2']); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if(!empty($item['tp_features_title3'])) : ?>
                                <div class="tp-price-feature-info text-center">
                                    <span><?php echo tp_kses($item['tp_features_title3']); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if(!empty($item['tp_features_title4'])) : ?>
                                <div class="tp-price-feature-info text-center">
                                    <span><?php echo tp_kses($item['tp_features_title4']); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if(!empty($item['tp_features_title5'])) : ?>
                                <div class="tp-price-feature-info text-center">
                                    <span><?php echo tp_kses($item['tp_features_title5']); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if(!empty($item['tp_features_title6'])) : ?>
                                <div class="tp-price-feature-info text-center">
                                    <span><?php echo tp_kses($item['tp_features_title6']); ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endforeach ; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endif;
    }
}

$widgets_manager->register( new TP_Advanced_Pricing() );