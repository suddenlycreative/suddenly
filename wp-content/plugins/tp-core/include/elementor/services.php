<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
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
class TP_Services extends Widget_Base {

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
        return 'tp-services';
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
        return __( 'Services', 'tpcore' );
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
                    'layout-5' => esc_html__('Layout 5', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // title/content
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-5'] );

        // Service group
        $this->start_controls_section(
            'tp_services',
            [
                'label' => esc_html__('Services List', 'tpcore'),
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
                    'style_5' => __( 'Style 5', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_service_icon_type',
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
            'tp_service_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_service_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_service_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_service_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_service_selected_icon',
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
                        'tp_service_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_service_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tp-core'),
                'condition' => [
                    'tp_service_icon_type' => 'svg',
                ]
            ]
        );

        $repeater->add_control(
            'tp_service_number', [
                'label' => esc_html__('Number Field', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('a', 'tpcore'),
                'condition' => [
                    'repeater_condition' => 'style_2'
                ]
            ]
        );

        $repeater->add_control(
            'tp_service_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_service_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('There are many variations of passages of Lorem Ipsum available, but the majority have suffered.', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2', 'style_4', 'style_5']
                ]
            ]
        );

        $repeater->add_control(
            'tp_services_link_switcher',
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
            'tp_services_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_services_link_switcher' => 'yes',
                    'repeater_condition' => ['style_2', 'style_3', 'style_4', 'style_5']
                ],
            ]
        );
        $repeater->add_control(
            'tp_services_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_services_link_switcher' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'tp_services_link',
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
                    'tp_services_link_type' => '1',
                    'tp_services_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_services_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_services_link_type' => '2',
                    'tp_services_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'tp_service_list',
            [
                'label' => esc_html__('Services - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_service_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_service_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_service_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_service_title }}}',
            ]
        );

        
        $this->add_control(
            'tp_services_bottom_text',
            [
                'label' => esc_html__('Bottom Text', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('BRING THEM TOGETHER AND YOU OVERCOME THE ORDINARY.', 'tpcore'),
                'label_block' => true,
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'condition' => [
                    'tp_design_style' => ['layout-3', 'layout-4', 'layout-5']
                ],
            ]
        );

        $this->end_controls_section();
        
        // button
        $this->tp_button_render('services', 'Button', ['layout-1', 'layout-2']);
        
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

        // service shape
        $this->start_controls_section(
        'tp_service_shape',
            [
                'label' => esc_html__( 'Service Shape', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                'tp_design_style' => ['layout-1', 'layout-3']
                ]
            ]
        );

        $this->add_control(
        'tp_service_shape_switch',
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
                    'tp_service_shape_switch' => 'yes'
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
                    'tp_service_shape_switch' => 'yes',
                    'tp_design_style' => 'layout-3'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'condition' => [
                    'tp_service_shape_switch' => 'yes'
                ],
                'default' => 'full'
            ]
        );
        
        $this->end_controls_section();

        // section column
        $this->tp_columns('col', ['layout-3', 'layout-4', 'layout-5']);

    }

    // style_tab_content
    protected function style_tab_content(){

        $this->tp_section_style_controls('services_section', 'Section Style', '.ele-section');
        
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
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    
    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }

    // Link
    if ('2' == $settings['tp_services_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_services_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
    } else {
        if ( ! empty( $settings['tp_services_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_services_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>

<section class="tp-service-area pt-85 pb-50 bg-dark-blue">
    <div class="container-fluid">
        <div class="row">
            <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
            <div class="col-lg-12">
                <div class="tp-service-title-wrapper text-center">
                    <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                    <span class="tp-section-title__pre">
                        <?php echo tp_kses( $settings['tp_section_sub_title'] ); ?>
                        <svg width="123" height="8" viewBox="0 0 123 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.384401 7.82144C0.645399 4.52972 8.83029 8.38041 10.8974 7.67652C12.4321 7.1486 11.6386 7.03474 12.9749 6.19628C14.0816 4.61253 15.7519 3.89829 17.9756 4.06391C18.6125 4.48831 19.2284 4.93342 19.8444 5.38888C21.1076 6.09277 22.1621 6.51717 23.6028 6.13417C24.8973 5.79258 25.5237 4.79885 26.6095 4.18812C30.8481 1.80732 31.3701 2.90456 34.5855 4.58147C36.0993 5.36817 37.634 6.48612 39.461 6.08242C40.1604 5.92715 40.2127 5.67871 40.672 5.54415C42.1023 4.10531 43.9606 3.52564 46.2469 3.80512C47.0612 4.28129 47.8651 4.75745 48.669 5.25431C50.9866 6.22733 54.5049 6.23769 54.6615 3.08053C54.3065 3.22545 53.962 3.37037 53.6175 3.51529C55.622 5.75117 58.6078 6.59998 61.5205 5.5752C64.8091 4.41585 63.8277 3.02877 67.1685 4.35374C68.6614 4.94377 70.2587 5.14045 71.856 4.96447C73.6412 4.7678 75.1028 3.27721 76.6271 3.07018C79.0491 2.73894 81.3354 4.89201 84.2482 4.15707C85.3235 3.88793 86.9417 2.27313 87.7978 2.21102C88.6329 2.14891 89.9484 3.68091 90.8358 4.14672C93.3936 5.51309 96.5882 5.75117 99.3234 4.7471C101.902 3.80512 100.858 3.60845 103.124 4.30199C104.366 4.67464 105.253 5.34747 106.652 5.45099C109.628 5.65801 112.175 4.26058 113.678 1.77626C113.25 1.77626 112.822 1.77626 112.384 1.77626C114.722 5.49239 119.587 6.10312 122.771 3.05983C123.471 2.39734 122.406 1.34151 121.707 2.00399C119.316 4.29164 115.516 3.95004 113.678 1.03097C113.386 0.554807 112.687 0.544455 112.384 1.03097C110.223 4.62288 105.159 4.84026 102.549 1.7038C102.278 1.38291 101.777 1.46572 101.495 1.7038C97.6113 4.99553 91.8171 4.46761 88.6747 0.368483C88.4242 0.0372403 87.85 -0.190489 87.5159 0.223564C84.9685 3.37037 80.7717 3.86723 77.6606 1.10343C77.3787 0.854995 76.9507 0.823941 76.6584 1.10343C73.422 4.26058 68.6823 4.52972 65.1432 1.63134C64.83 1.37256 64.3706 1.38291 64.1409 1.75556C61.9799 5.40958 57.2297 5.74082 54.4631 2.65613C54.0873 2.24207 53.44 2.59402 53.4191 3.09088C53.2103 7.04509 45.6727 1.72451 43.8979 1.92118C40.4841 2.30418 40.2127 5.74082 35.7026 3.82583C33.4894 2.88386 31.8085 0.989563 29.1777 1.39326C26.9226 1.74521 25.9622 3.86723 23.9682 4.63323C20.4603 5.9789 19.2702 2.13856 16.2531 2.33524C11.2941 2.66648 14.1442 7.41774 6.43955 5.75117C4.22629 5.27501 -0.221114 3.93969 0.00856432 7.82144C0.0190042 8.05952 0.363521 8.05952 0.384401 7.82144Z" fill="currentColor"/>
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
                    <?php if ( !empty($settings['tp_section_description']) ) : ?>
                    <p class="tp-text-white mb-20"><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="tp-service-slider-wrapper">
                <div class="service-active splide">
                    <div class="splide__track">
                        <div class="splide__list">
                            
                            <?php foreach ($settings['tp_service_list'] as $key => $item) :
                                // Link
                                if ('2' == $item['tp_services_link_type']) {
                                    $link = get_permalink($item['tp_services_page_link']);
                                    $target = '_self';
                                    $rel = 'nofollow';
                                } else {
                                    $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                                    $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                                    $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                                }
                            ?>
                            <div class="splide__slide">
                                <div class="tp-service-wrapper p-relative mb-55">
                                    <?php if(!empty($item['tp_service_number'])) : ?>
                                    <div class="tp-service-designation">
                                        <p><?php echo tp_kses($item['tp_service_number']); ?></p>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($item['tp_service_title' ])): ?>
                                    <h3 class="service-title"><?php echo tp_kses($item['tp_service_title' ]); ?></h3>
                                    <?php endif; ?>

                                    <?php if($item['tp_service_icon_type'] == 'icon') : ?>
                                        <?php if (!empty($item['tp_service_icon']) || !empty($item['tp_service_selected_icon']['value'])) : ?>
                                        <div class="tp-service-icon">
                                            <?php tp_render_icon($item, 'tp_service_icon', 'tp_service_selected_icon'); ?>
                                        </div>
                                        <?php endif; ?>
                                    <?php elseif( $item['tp_service_icon_type'] == 'image' ) : ?>
                                        <?php if (!empty($item['tp_service_image']['url'])): ?>
                                        <div class="tp-service-icon">
                                            <img src="<?php echo $item['tp_service_image']['url']; ?>"
                                                alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_service_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        </div>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if (!empty($item['tp_service_icon_svg'])): ?>
                                        <div class="tp-service-icon">
                                            <?php echo $item['tp_service_icon_svg']; ?>
                                        </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($item['tp_service_description' ])): ?>
                                    <p class="hide-text"><?php echo tp_kses($item['tp_service_description']); ?></p>
                                    <?php endif; ?>

                                    <?php if(!empty($item['tp_services_btn_text'])) : ?>
                                    <div class="tp-service-btn">
                                        <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_services_btn_text']); ?> <i class="fa-solid fa-arrow-up-right"></i></a>
                                    </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ( !empty($settings['tp_services_btn_text']) ) : ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="tp-service-all-btn text-center fadeUp">
                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?> ><?php echo tp_kses($settings['tp_services_btn_text']); ?></a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php elseif ( $settings['tp_design_style']  == 'layout-3' ) : 
    
    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_2']['url']) ) {
        $tp_shape_image_2 = !empty($settings['tp_shape_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_2']['url'];
        $tp_shape_image_alt_2 = get_post_meta($settings["tp_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    $this->add_render_attribute('title_args', 'class', 'tp-section-title');

?>

<section class="tp-offer-area p-relative pt-120 pb-90" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/offering/bg.png">
    <div class="tp-offer-overlay"></div>
    <?php if(!empty($settings['tp_service_shape_switch'])) : ?>
    <div class="tp-offer-shape">
        <?php if(!empty($tp_shape_image)) : ?>
        <img class="shape-1 d-none d-xl-block" src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
        <?php endif; ?>
        <?php if(!empty( $tp_shape_image_2)) : ?>
        <img class="shape-2" src="<?php echo esc_url($tp_shape_image_2); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="container">
        <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="tp-feature-title-wrapper">
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
                </div>
            </div>
            <div class="col-lg-6">
                <?php if ( !empty($settings['tp_section_description']) ) : ?>
                <div class="tp-feature-wrapper offer p-relative">
                    <p><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">

            <?php foreach ($settings['tp_service_list'] as $key => $item) :
                // Link
                if ('2' == $item['tp_services_link_type']) {
                    $link = get_permalink($item['tp_services_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                    $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                }
            ?>
            <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                <div class="tp-offer-wrapper text-center mb-30">
                    <?php if (!empty($item['tp_service_title' ])): ?>
                    <h3 class="offer-title"><?php echo tp_kses($item['tp_service_title' ]); ?></h3>
                    <?php endif; ?>

                    <?php if($item['tp_service_icon_type'] == 'icon') : ?>
                        <?php if (!empty($item['tp_service_icon']) || !empty($item['tp_service_selected_icon']['value'])) : ?>
                        <div class="tp-offer-wrapper-thumb">
                            <?php tp_render_icon($item, 'tp_service_icon', 'tp_service_selected_icon'); ?>
                        </div>
                        <?php endif; ?>
                    <?php elseif( $item['tp_service_icon_type'] == 'image' ) : ?>
                        <?php if (!empty($item['tp_service_image']['url'])): ?>
                        <div class="tp-offer-wrapper-thumb">
                            <img src="<?php echo $item['tp_service_image']['url']; ?>"
                                alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_service_image']['url']), '_wp_attachment_image_alt', true); ?>">
                        </div>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php if (!empty($item['tp_service_icon_svg'])): ?>
                        <div class="tp-offer-wrapper-thumb">
                            <?php echo $item['tp_service_icon_svg']; ?>
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if(!empty($item['tp_services_btn_text'])) : ?>
                    <div class="tp-offer-wrapper-btn">
                        <a href="<?php echo esc_url($link); ?>" target='<?php echo esc_attr($target); ?>' rel="<?php echo esc_attr($rel); ?>" ><?php echo tp_kses($item['tp_services_btn_text']); ?> <i class="fa-solid fa-arrow-up-right"></i></a>
                    </div>
                    <?php endif; ?>
                    
                </div>
            </div>
            <?php endforeach; ?>

            <?php if(!empty($settings['tp_services_bottom_text'])) : ?>
            <div class="col-lg-12">
                <div class="tp-offer-all-btn text-center mt-30 fadeUp">
                    <p><?php echo tp_kses($settings['tp_services_bottom_text']); ?></p>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>

<?php elseif ( $settings['tp_design_style']  == 'layout-4' ) : 
    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_2']['url']) ) {
        $tp_shape_image_2 = !empty($settings['tp_shape_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_2']['url'];
        $tp_shape_image_alt_2 = get_post_meta($settings["tp_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    $this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>

<section class="tp-service-3-area p-relative pt-120 pb-60" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/services/home-3/service-bg.png">
    <div class="container">
        <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
        <div class="row align-items-center">
            <div class="col-xl-6">
                <div class="tp-service-3-title-wrapper">
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
                </div>
            </div>
            <div class="col-xl-6">
                <?php if ( !empty($settings['tp_section_description']) ) : ?>
                <div class="tp-service-3-title-wrapper justify-content-start justify-content-xl-end d-flex">
                    <p><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">

            <?php foreach ($settings['tp_service_list'] as $key => $item) :
                // Link
                if ('2' == $item['tp_services_link_type']) {
                    $link = get_permalink($item['tp_services_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                    $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                }
            ?>
            <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                <div class="tp-service-3-content OneByOne mb-30">

                    <?php if($item['tp_service_icon_type'] == 'icon') : ?>
                        <?php if (!empty($item['tp_service_icon']) || !empty($item['tp_service_selected_icon']['value'])) : ?>
                        <div class="tp-service-3-content-thumb">
                            <?php tp_render_icon($item, 'tp_service_icon', 'tp_service_selected_icon'); ?>
                        </div>
                        <?php endif; ?>
                    <?php elseif( $item['tp_service_icon_type'] == 'image' ) : ?>
                        <?php if (!empty($item['tp_service_image']['url'])): ?>
                        <div class="tp-service-3-content-thumb">
                            <img src="<?php echo $item['tp_service_image']['url']; ?>"
                                alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_service_image']['url']), '_wp_attachment_image_alt', true); ?>">
                        </div>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php if (!empty($item['tp_service_icon_svg'])): ?>
                        <div class="tp-service-3-content-thumb">
                            <?php echo $item['tp_service_icon_svg']; ?>
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php if (!empty($item['tp_service_title' ])): ?>
                    <h4 class="tp-service-3-title">
                        <?php if ($item['tp_services_link_switcher'] == 'yes') : ?>
                        <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_service_title' ]); ?></a>
                        <?php else : ?>
                        <?php echo tp_kses($item['tp_service_title' ]); ?>
                        <?php endif; ?>
                    </h4>
                    <?php endif; ?>

                    <?php if (!empty($item['tp_service_description' ])): ?>
                    <p><?php echo tp_kses($item['tp_service_description']); ?></p>
                    <?php endif; ?>

                    <?php if(!empty($item['tp_services_btn_text'])) : ?>
                    <div class="tp-service-btn">
                        <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_services_btn_text']); ?> <i class="fa-solid fa-arrow-up-right"></i></a>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
            <?php endforeach; ?>

        </div>
        <?php if(!empty($settings['tp_services_bottom_text'])) : ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="tp-service-3-trend text-center mt-50">
                    <p><?php echo tp_kses($settings['tp_services_bottom_text']); ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>


<?php elseif ( $settings['tp_design_style']  == 'layout-5' ) : 
    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_2']['url']) ) {
        $tp_shape_image_2 = !empty($settings['tp_shape_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_2']['url'];
        $tp_shape_image_alt_2 = get_post_meta($settings["tp_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    $this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>


<section class="tp-service-breadcrumb-area p-relative pt-120">
    <div class="container">
        <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="tp-service-breadcrumb-title-wrapper">
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
                </div>
            </div>
            <div class="col-lg-6">
                <?php if ( !empty($settings['tp_section_description']) ) : ?>
                <div class="tp-service-breadcrumb-title-wrapper justify-content-start justify-content-xl-end d-flex">
                    <p><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">

            <?php foreach ($settings['tp_service_list'] as $key => $item) :
                // Link
                if ('2' == $item['tp_services_link_type']) {
                    $link = get_permalink($item['tp_services_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                    $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                }
            ?>
            <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                <div class="tp-service-3-content breadcrumb-item mb-30">
                    
                    <?php if($item['tp_service_icon_type'] == 'icon') : ?>
                        <?php if (!empty($item['tp_service_icon']) || !empty($item['tp_service_selected_icon']['value'])) : ?>
                        <div class="tp-service-3-content-thumb">
                            <?php tp_render_icon($item, 'tp_service_icon', 'tp_service_selected_icon'); ?>
                        </div>
                        <?php endif; ?>
                    <?php elseif( $item['tp_service_icon_type'] == 'image' ) : ?>
                        <?php if (!empty($item['tp_service_image']['url'])): ?>
                        <div class="tp-service-3-content-thumb">
                            <img src="<?php echo $item['tp_service_image']['url']; ?>"
                                alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_service_image']['url']), '_wp_attachment_image_alt', true); ?>">
                        </div>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php if (!empty($item['tp_service_icon_svg'])): ?>
                        <div class="tp-service-3-content-thumb">
                            <?php echo $item['tp_service_icon_svg']; ?>
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if (!empty($item['tp_service_title' ])): ?>
                    <h4 class="tp-service-breadcrumb-title">
                        <?php if ($item['tp_services_link_switcher'] == 'yes') : ?>
                        <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_service_title' ]); ?></a>
                        <?php else : ?>
                        <?php echo tp_kses($item['tp_service_title' ]); ?>
                        <?php endif; ?>
                    </h4>
                    <?php endif; ?>

                    <?php if (!empty($item['tp_service_description' ])): ?>
                    <p><?php echo tp_kses($item['tp_service_description']); ?></p>
                    <?php endif; ?>

                    <?php if(!empty($item['tp_services_btn_text'])) : ?>
                    <div class="tp-service-btn">
                        <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_services_btn_text']); ?> <i class="fa-solid fa-arrow-up-right"></i></a>
                    </div>
                    <?php endif; ?>
                        
                </div>
            </div>
            <?php endforeach; ?>

        </div>

        <?php if(!empty($settings['tp_services_bottom_text'])) : ?>
        <div class="row justify-content-center">
            <div class="col-xl-8 text-center">
                <div class="tp-about-call fadeUp">
                    <?php echo tp_kses($settings['tp_services_bottom_text']); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

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

    // Link
    if ('2' == $settings['tp_services_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_services_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', '');
    } else {
        if ( ! empty( $settings['tp_services_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_services_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', '');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>

<section class="tp-about-area pb-45 box-plr p-relative">
    <?php if(!empty($tp_shape_image)) : ?>
    <div class="tp-about-shape d-none d-xl-block">
        <img class="shape-1" src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
    </div>
    <?php endif; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 col-lg-12">
                <?php if(!empty($tp_image)) : ?>
                <div class="tp-about-wrapper-thumb text-center text-xl-start fadeLeft">
                    <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                </div>
                <?php endif; ?>
            </div>
            <div class="col-xl-8 col-lg-10">
                <div class="tp-about-wrapper pl-50">
                    <div class="row">
                        <div class="col-lg-8">
                            <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
                            <div class="tp-about-title-wrapper p-relative">
                                <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                                <span class="tp-section-title__pre"><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?>
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
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-4">
                            <div class="tp-about-nav d-none d-md-block p-relative">
                                <button type="button" class="about-button-prev-1"><i class="fa-regular fa-arrow-left"></i>
                                </button>
                                <button type="button" class="about-button-next-1"><i class="fa-regular fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tp-about-item-wrapper">
                        
                        <div class="about-active swiper-container">
                            <div class="swiper-wrapper">

                                <?php foreach ($settings['tp_service_list'] as $key => $item) :
                                    // Link
                                    if ('2' == $item['tp_services_link_type']) {
                                        $link = get_permalink($item['tp_services_page_link']);
                                        $target = '_self';
                                        $rel = 'nofollow';
                                    } else {
                                        $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                                        $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                                        $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                                    }
                                ?>
                                <div class="swiper-slide">
                                    <div class="tp-about-item mb-30">

                                        <?php if($item['tp_service_icon_type'] == 'icon') : ?>
                                            <?php if (!empty($item['tp_service_icon']) || !empty($item['tp_service_selected_icon']['value'])) : ?>
                                            <div class="tp-about-item-thumb">
                                                <?php tp_render_icon($item, 'tp_service_icon', 'tp_service_selected_icon'); ?>
                                            </div>
                                            <?php endif; ?>
                                        <?php elseif( $item['tp_service_icon_type'] == 'image' ) : ?>
                                            <?php if (!empty($item['tp_service_image']['url'])): ?>
                                            <div class="tp-about-item-thumb">
                                                <img src="<?php echo $item['tp_service_image']['url']; ?>"
                                                    alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_service_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                            </div>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <?php if (!empty($item['tp_service_icon_svg'])): ?>
                                            <div class="tp-about-item-thumb">
                                                <?php echo $item['tp_service_icon_svg']; ?>
                                            </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <div class="tp-about-item-content">

                                            <?php if (!empty($item['tp_service_title' ])): ?>
                                            <h4 class="about-title">
                                                <?php if ($item['tp_services_link_switcher'] == 'yes') : ?>
                                                <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_service_title' ]); ?></a>
                                                <?php else : ?>
                                                <?php echo tp_kses($item['tp_service_title' ]); ?>
                                                <?php endif; ?>
                                            </h4>
                                            <?php endif; ?>
                                            <?php if (!empty($item['tp_service_description' ])): ?>
                                            <p><?php echo tp_kses($item['tp_service_description']); ?></p>
                                            <?php endif; ?>
                                            <?php if(!empty($link)) : ?>
                                            <div class="tp-about-item-btn">
                                                <a href="<?php echo esc_url($link); ?>"><i class="fa-regular fa-arrow-right"></i></a>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                        
                        <?php if ( !empty($settings['tp_services_btn_text']) ) : ?>
                        <div class="tp-about-call">
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?> >
                                <p><?php echo tp_kses($settings['tp_services_btn_text']); ?></p>
                            </a>
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

$widgets_manager->register( new TP_Services() ); 