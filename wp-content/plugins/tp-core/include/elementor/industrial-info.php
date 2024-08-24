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
class TP_Industrial_Info extends Widget_Base {

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
        return 'tp-industrial-info';
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
        return __( 'Industrial Info', 'tpcore' );
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
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', ['layout-1', 'layout-2', 'layout-3'] );

        // Industrial Info group
        $this->start_controls_section(
            'tp_industrial_info',
            [
                'label' => esc_html__('Industrial Info List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'tp_industrial_info_top_text',
            [
                'label' => esc_html__('Info Title', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Best It And Technology Agency', 'tpcore'),
                'label_block' => true,
                'description' => tp_get_allowed_html_desc( 'basic' ),
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
            'tp_industrial_info_icon_type',
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
            'tp_industrial_info_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_industrial_info_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_industrial_info_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_industrial_info_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_industrial_info_selected_icon',
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
                        'tp_industrial_info_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_industrial_info_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tp-core'),
                'condition' => [
                    'tp_industrial_info_icon_type' => 'svg',
                ]
            ]
        );

        $repeater->add_control(
            'tp_industrial_info_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Industrial Info Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_industrial_info_list',
            [
                'label' => esc_html__('Industrial Info - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_industrial_info_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_industrial_info_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_industrial_info_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_industrial_info_title }}}',
            ]
        );
        
        $this->add_control(
            'tp_industrial_info_bottom_text',
            [
                'label' => esc_html__('Bottom Text', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('BRING THEM TOGETHER AND YOU', 'tpcore'),
                'label_block' => true,
                'description' => tp_get_allowed_html_desc( 'basic' ),
            ]
        );

        $this->end_controls_section();

        // Industrial Tab
        $this->start_controls_section(
            'tp_tab',
            [
                'label' => esc_html__('Tab Content', 'tpcore'),
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
            'tp_tab_button_title', [
                'label' => esc_html__('Button Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Button 1', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_tab_image',
            [
                'label' => esc_html__('Upload Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'tp_tab_vdo_link', [
                'label' => esc_html__('Video Link', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tpcore'),
                'description' => esc_html__('please, insert video url.', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_tab_description', [
                'label' => esc_html__('Description', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Customer Oriented Program', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_tab_progress_title', [
                'label' => esc_html__('Progress Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Digital Agency', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
			'tp_tab_progress_number',
			[
				'label' => esc_html__( 'Percentage Number', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 5,
				'max' => 100,
				'step' => 1,
				'default' => 60,
			]
		);

        $this->add_control(
            'tp_tab_list',
            [
                'label' => esc_html__('Tab Info - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_tab_button_title' => esc_html__('integrity', 'tpcore'),
                    ],
                    [
                        'tp_tab_button_title' => esc_html__('obejectives', 'tpcore')
                    ],
                    [
                        'tp_tab_button_title' => esc_html__('excellence', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_tab_button_title }}}',
            ]
        );

        $this->end_controls_section();

        // industrial_info shape
        $this->start_controls_section(
        'tp_industrial_info_shape',
            [
                'label' => esc_html__( 'Industrial Info Shape', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                'tp_design_style' => ['layout-1', 'layout-3']
                ]
            ]
        );

        $this->add_control(
        'tp_industrial_info_shape_switch',
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
                    'tp_industrial_info_shape_switch' => 'yes'
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
                    'tp_industrial_info_shape_switch' => 'yes',
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
                    'tp_industrial_info_shape_switch' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'condition' => [
                    'tp_industrial_info_shape_switch' => 'yes'
                ],
                'default' => 'full'
            ]
        );
        
        $this->end_controls_section();

    }

    // style_tab_content
    protected function style_tab_content(){

        $this->tp_section_style_controls('industrial_info_section', 'Section Style', '.ele-section');
        
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
    if ( !empty($settings['tp_shape_image_2']['url']) ) {
        $tp_shape_image_2 = !empty($settings['tp_shape_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_2']['url'];
        $tp_shape_image_alt_2 = get_post_meta($settings["tp_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_3']['url']) ) {
        $tp_shape_image_3 = !empty($settings['tp_shape_image_3']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_3']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_3']['url'];
        $tp_shape_image_alt_3 = get_post_meta($settings["tp_shape_image_3"]["id"], "_wp_attachment_image_alt", true);
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>

<section class="tp-industry-area p-relative pb-90 ele-section">
    <?php if(!empty($settings['tp_industrial_info_shape_switch'])) : ?>
    <div class="tp-industry-shape">
        <?php if(!empty($tp_shape_image)) : ?>
        <img class="shape-1" src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
        <?php endif; ?>
        <?php if(!empty($tp_shape_image_2)) : ?>
        <img class="shape-2" src="<?php echo esc_url($tp_shape_image_2); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
        <?php endif; ?>
        <?php if(!empty($tp_shape_image_3)) : ?>
        <img class="shape-3" src="<?php echo esc_url($tp_shape_image_3); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_3); ?>">
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
            <div class="col-lg-12">
                <div class="tp-industry-title-wrapper text-center">
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
                </div>
            </div>
            <?php endif; ?>

            <div class="col-xl-6 col-lg-12">
                <div class="tp-industry-wrapper mb-30 fadeLeft">
                    <div class="tp-industry-content">

                        <?php if(!empty($settings['tp_industrial_info_top_text'])) : ?>
                        <h3 class="tp-industry-content-title"><?php echo tp_kses($settings['tp_industrial_info_top_text']); ?></h3>
                        <?php endif; ?>

                        <div class="tp-industry-thumb-wrapper d-flex">

                            <?php foreach($settings['tp_industrial_info_list'] as $key => $item) : ?>
                            <div class="tp-industry-thumb text-center">
                                <?php if($item['tp_industrial_info_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($item['tp_industrial_info_icon']) || !empty($item['tp_industrial_info_selected_icon']['value'])) : ?>
                                    <?php tp_render_icon($item, 'tp_industrial_info_icon', 'tp_industrial_info_selected_icon'); ?>
                                    <?php endif; ?>
                                <?php elseif( $item['tp_industrial_info_icon_type'] == 'image' ) : ?>
                                    <?php if (!empty($item['tp_industrial_info_image']['url'])): ?>
                                    <img src="<?php echo $item['tp_industrial_info_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_industrial_info_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>
                                <?php else : ?>
                                    <?php if (!empty($item['tp_industrial_info_icon_svg'])): ?>
                                    <?php echo $item['tp_industrial_info_icon_svg']; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if (!empty($item['tp_industrial_info_title'])): ?>
                                <h4 class="tp-industry-title"><?php echo tp_kses($item['tp_industrial_info_title']); ?></h4>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>

                        </div>

                        <?php if(!empty($settings['tp_industrial_info_bottom_text'])) : ?>
                        <div class="tp-industry-btn">
                            <span class="icon">
                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_215_1160)">
                                <path d="M21.25 6.09391H15.4167V5.67725C15.4142 3.60714 13.7368 1.92969 11.6667 1.92725H3.75C1.67989 1.92969 0.00244141 3.60714 0 5.67725L0 10.6772C0.00244141 12.7474 1.67989 14.4248 3.75 14.4272H4.16667V17.7606C4.16667 17.929 4.26819 18.081 4.42383 18.1455C4.57947 18.21 4.75871 18.1742 4.87793 18.0552L8.50586 14.4272H9.58333V14.8439C9.58577 16.914 11.2632 18.5915 13.3333 18.5939H15.6608L20.1221 23.0552C20.2413 23.1742 20.4205 23.21 20.5762 23.1455C20.7318 23.081 20.8333 22.929 20.8333 22.7606V18.5939H21.25C23.3201 18.5915 24.9976 16.914 25 14.8439V9.84391C24.9976 7.7738 23.3201 6.09635 21.25 6.09391ZM8.33333 13.5939C8.22286 13.5939 8.11686 13.6379 8.03874 13.716L5 16.7547V14.0106C5 13.7805 4.81344 13.5939 4.58333 13.5939H3.75C2.13989 13.5921 0.835164 12.2874 0.833333 10.6772V5.67725C0.835164 4.06714 2.13989 2.76241 3.75 2.76058H11.6667C13.2768 2.76241 14.5815 4.06714 14.5833 5.67725V6.09391H13.3333C11.2632 6.09635 9.58577 7.7738 9.58333 9.84391V13.5939H8.33333ZM24.1667 14.8439C24.1648 16.454 22.8601 17.7587 21.25 17.7606H20.4167C20.1866 17.7606 20 17.9471 20 18.1772V21.7547L16.1279 17.8826C16.0498 17.8045 15.9438 17.7606 15.8333 17.7606H13.3333C11.7232 17.7587 10.4185 16.454 10.4167 14.8439V9.84391C10.4185 8.2338 11.7232 6.92908 13.3333 6.92725H21.25C22.8601 6.92908 24.1648 8.2338 24.1667 9.84391V14.8439Z" fill="black"/>
                                <path d="M22.082 9.42725H12.4987C12.2686 9.42725 12.082 9.61381 12.082 9.84391C12.082 10.074 12.2686 10.2606 12.4987 10.2606H22.082C22.3121 10.2606 22.4987 10.074 22.4987 9.84391C22.4987 9.61381 22.3121 9.42725 22.082 9.42725Z" fill="black"/>
                                <path d="M22.082 11.9268H12.4987C12.2686 11.9268 12.082 12.1133 12.082 12.3434C12.082 12.5735 12.2686 12.7601 12.4987 12.7601H22.082C22.3121 12.7601 22.4987 12.5735 22.4987 12.3434C22.4987 12.1133 22.3121 11.9268 22.082 11.9268Z" fill="black"/>
                                <path d="M22.082 14.4272H12.4987C12.2686 14.4272 12.082 14.6138 12.082 14.8439C12.082 15.074 12.2686 15.2606 12.4987 15.2606H22.082C22.3121 15.2606 22.4987 15.074 22.4987 14.8439C22.4987 14.6138 22.3121 14.4272 22.082 14.4272Z" fill="black"/>
                                <path d="M2.4987 6.09408H11.2487C11.4788 6.09408 11.6654 5.90751 11.6654 5.67741C11.6654 5.44731 11.4788 5.26074 11.2487 5.26074H2.4987C2.2686 5.26074 2.08203 5.44731 2.08203 5.67741C2.08203 5.90751 2.2686 6.09408 2.4987 6.09408Z" fill="black"/>
                                <path d="M8.7487 7.76025H2.4987C2.2686 7.76025 2.08203 7.94682 2.08203 8.17692C2.08203 8.40702 2.2686 8.59359 2.4987 8.59359H8.7487C8.9788 8.59359 9.16536 8.40702 9.16536 8.17692C9.16536 7.94682 8.9788 7.76025 8.7487 7.76025Z" fill="black"/>
                                <path d="M8.33203 10.2607H2.4987C2.2686 10.2607 2.08203 10.4473 2.08203 10.6774C2.08203 10.9075 2.2686 11.0941 2.4987 11.0941H8.33203C8.56214 11.0941 8.7487 10.9075 8.7487 10.6774C8.7487 10.4473 8.56214 10.2607 8.33203 10.2607Z" fill="black"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_215_1160">
                                <rect width="25" height="25" fill="currentColor"/>
                                </clipPath>
                                </defs>
                                </svg>
                            </span> <?php echo tp_kses($settings['tp_industrial_info_bottom_text']); ?>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-12">
                <div class="tp-industry-wrapper mb-30 fadeRight">
                    <div class="tp-industry-tab">

                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                            <?php foreach($settings['tp_tab_list'] as $key => $item) :
                            $active = $key == 0 ? 'active' : NULL;    
                            ?>
                            <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo esc_attr($active); ?>" id="pills-home-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="pill" data-bs-target="#pills-home-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="pills-home-<?php echo esc_attr($key); ?>" aria-selected="true"><?php echo tp_kses($item['tp_tab_button_title']); ?></button>
                            </li>
                            <?php endforeach; ?>

                        </ul>

                        <?php foreach($settings['tp_tab_list'] as $key => $item) :
                            $active = $key == 0 ? 'show active' : NULL;  
                            // image
                            if ( !empty($item['tp_tab_image']['url']) ) {
                                $tp_tab_image = !empty($item['tp_tab_image']['id']) ? wp_get_attachment_image_url( $item['tp_tab_image']['id'], 'full') : $item['tp_tab_image']['url'];
                                $tp_tab_image_alt = get_post_meta($item["tp_tab_image"]["id"], "_wp_attachment_image_alt", true);
                            }
                        ?>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="pills-home-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="pills-home-tab-<?php echo esc_attr($key); ?>">
                                <div class="tp-industry-tab-content">
                                    <div class="tp-industry-tab-content-inner d-flex mb-30">

                                        <?php if(!empty($tp_tab_image)) : ?>
                                        <div class="tp-industry-tab-thumb p-relative">
                                            <img src="<?php echo esc_url($tp_tab_image); ?>" alt="<?php echo esc_attr($tp_tab_image_alt); ?>">
                                            <?php if(!empty($item['tp_tab_vdo_link'])) : ?>
                                            <a class="popup-video" href="<?php echo esc_url($item['tp_tab_vdo_link']); ?>"><i class="fa-sharp fa-solid fa-play"></i></a>
                                            <?php endif; ?>
                                        </div>
                                        <?php endif; ?>

                                        <?php if(!empty($item['tp_tab_description'])) : ?>
                                            <?php echo tp_kses($item['tp_tab_description']); ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="tp-industry-progress-bar fix">
                                        <div class="tp-industry__progresss">
                                            <?php if(!empty($item['tp_tab_progress_title'])) : ?>
                                            <h4><?php echo tp_kses($item['tp_tab_progress_title']); ?></h4>
                                            <?php endif; ?>
                                            <?php if(!empty($item['tp_tab_progress_number'])) : ?>
                                            <div class="progress">
                                                <div class="progress-bar wow fadeInLeft" data-wow-duration="1s"
                                                data-wow-delay=".3s" role="progressbar" aria-label="Example with label" style="width: <?php echo esc_attr($item['tp_tab_progress_number']); ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                    <span><?php echo esc_attr($item['tp_tab_progress_number']); ?>%</span>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

    <?php endif; 
    }
}

$widgets_manager->register( new TP_Industrial_Info() ); 