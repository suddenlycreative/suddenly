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
class TP_Projects extends Widget_Base {

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
        return 'project';
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
        return __( 'Projects', 'tpcore' );
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

        // projects group
        $this->start_controls_section(
            'tp_projects',
            [
                'label' => esc_html__('Projects List', 'tpcore'),
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_projects_image',
            [
                'label' => esc_html__('Upload Project Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],

            ]
        );
        
        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_pro_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        
        
        $repeater->add_control(
            'tp_logo_image',
            [
                'label' => esc_html__('Upload Logo Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],

            ]
        );

        $repeater->add_control(
            'tp_projects_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('projects Title', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_projects_description',
            [
                'label' => esc_html__('Decription', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Excepteur sint occaecat cupidatat officia non proident',
                'label_block' => true,
            ]
        ); 

        // author
        $repeater->add_control(
			'author_heading',
			[
				'label' => esc_html__( 'Author Info', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $repeater->add_control(
            'tp_author_title', [
                'label' => esc_html__('Author Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Author Title', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_author_name', [
                'label' => esc_html__('Author Name', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Jhon Whick', 'tpcore'),
                'label_block' => true,
            ]
        );

        // project budget
        $repeater->add_control(
			'project_info_heading',
			[
				'label' => esc_html__( 'Project Info', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $repeater->add_control(
            'tp_info_title', [
                'label' => esc_html__('Project Info Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Budget', 'tpcore'),
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'tp_info_sub', [
                'label' => esc_html__('Project Info Subtitle', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('$200k', 'tpcore'),
                'label_block' => true,
            ]
        );

        // link
        $repeater->add_control(
            'tp_projects_link_switcher',
            [
                'label' => esc_html__( 'Add projects link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'tp_projects_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_projects_link_switcher' => 'yes',
                    'repeater_condition' => 'style_3'
                ],
            ]
        );
        $repeater->add_control(
            'tp_projects_link_type',
            [
                'label' => esc_html__( 'projects Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_projects_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tp_projects_link',
            [
                'label' => esc_html__( 'projects Link link', 'tpcore' ),
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
                    'tp_projects_link_type' => '1',
                    'tp_projects_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_projects_page_link',
            [
                'label' => esc_html__( 'Select projects Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_projects_link_type' => '2',
                    'tp_projects_link_switcher' => 'yes',
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
                ],
            ]
        );

        $this->add_control(
            'tp_projects_list',
            [
                'label' => esc_html__('Projects - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_projects_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_projects_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_projects_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_projects_title }}}',
            ]
        );

        $this->end_controls_section();

    }

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('services_section', 'Section Style', '.ele-section');
        $this->tp_basic_style_controls('newsletter_sub_title', 'Subtitle Style', '.ele-subtitle');
        $this->tp_basic_style_controls('newsletter_title', 'Heading Style', '.ele-heading');
        $this->tp_basic_style_controls('newsletter_des', 'Content Style', '.ele-description');
        $this->tp_basic_style_controls('repeater_title', 'Project Title Style', '.ele-repeater-title');
        $this->tp_basic_style_controls('repeater_brand', 'Projects Brand Style', '.ele-repeater-brand');
        $this->tp_section_style_controls('repeater_bg', 'Projects Brand Background Style', '.ele-brand-bg');
        
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
    $this->add_render_attribute('title_args', 'class', 'tp-section__title');
?>

<?php else: 

    $this->add_render_attribute('title_args', 'class', 'tp-section__title');
?>




<div class="tp-project__area pt-10 pb-10 fix">
    <div class="container-fluid gx-0">
        <div class="row gx-0">
            <div class="col-xl-12">
                <div class="tp-project__slider-section">
                    <div class=" swiper-container tp-project__slider-active">
                        <div class="swiper-wrapper">

                            <?php foreach ($settings['tp_projects_list'] as $key => $item) : 
                                // Link
                                if ('2' == $item['tp_projects_link_type']) {
                                    $link = get_permalink($item['tp_projects_page_link']);
                                    $target = '_self';
                                    $rel = 'nofollow';
                                } else {
                                    $link = !empty($item['tp_projects_link']['url']) ? $item['tp_projects_link']['url'] : '';
                                    $target = !empty($item['tp_projects_link']['is_external']) ? '_blank' : '';
                                    $rel = !empty($item['tp_projects_link']['nofollow']) ? 'nofollow' : '';
                                }

                                // project image
                                if ( !empty($item['tp_projects_image']['url']) ) {
                                    $tp_projects_image = !empty($item['tp_projects_image']['id']) ? wp_get_attachment_image_url( $item['tp_projects_image']['id'], $item['tp_pro_image_size_size']) : $item['tp_projects_image']['url'];
                                    $tp_projects_image_alt = get_post_meta($item["tp_projects_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                                // logo image
                                if ( !empty($item['tp_logo_image']['url']) ) {
                                    $tp_logo_image = !empty($item['tp_logo_image']['id']) ? wp_get_attachment_image_url( $item['tp_logo_image']['id']) : $item['tp_logo_image']['url'];
                                    $tp_logo_image_alt = get_post_meta($item["tp_logo_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                            <?php if(!empty($item['tp_creative_anima_switcher'])) : ?>
                            <div class="swiper-slide wow <?php echo esc_attr($item['tp_anima_type']); ?>" data-wow-duration="<?php echo esc_attr($item['tp_anima_dura']); ?>" data-wow-delay="<?php echo esc_attr($item['tp_anima_delay']); ?>">
                            <?php else : ?>
                            <div class="swiper-slide">
                            <?php endif; ?>
                                <div class="tp-project__slider-wrapper">
                                    <div class="tp-project__item d-flex align-items-center">
                                        <?php if(!empty($tp_projects_image)) : ?>
                                        <div class="tp-project__thumb">
                                            <img src="<?php echo esc_url($tp_projects_image); ?>" alt="<?php echo esc_attr($tp_projects_image_alt); ?>">
                                        </div>
                                        <?php endif; ?>
                                        <div class="tp-project__content">
                                            <?php if(!empty($tp_logo_image)) : ?>
                                            <div class="tp-project__brand-icon">
                                                <img src="<?php echo esc_url($tp_logo_image); ?>" alt="<?php echo esc_attr($tp_logo_image_alt); ?>">
                                            </div>
                                            <?php endif; ?>
                                            <div class="tp-project__title-box">
                                                <?php if(!empty($link)) : ?>
                                                <h4 class="tp-project__title-sm"><a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_projects_title']); ?></a></h4>
                                                <?php else : ?>
                                                <h4 class="tp-project__title-sm"><?php echo tp_kses($item['tp_projects_title']); ?></h4>
                                                <?php endif; ?>
                                                <?php if(!empty($item['tp_projects_description'])) : ?>
                                                <p><?php echo tp_kses($item['tp_projects_description']); ?></p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="tp-project__meta d-flex align-items-center">
                                                <div class="tp-project__author-info">
                                                    <?php if(!empty($item['tp_author_title'])) : ?>
                                                    <span><?php echo tp_kses($item['tp_author_title']); ?></span>
                                                    <?php endif; ?>
                                                    <?php if(!empty($item['tp_author_name'])) : ?>
                                                    <h4><?php echo tp_kses($item['tp_author_name']); ?></h4>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="tp-project__budget">
                                                    <?php if(!empty($item['tp_info_title'])) : ?>
                                                    <span><?php echo tp_kses($item['tp_info_title']); ?></span>
                                                    <?php endif; ?>
                                                    <?php if(!empty($item['tp_info_sub'])) : ?>
                                                    <h4><?php echo tp_kses($item['tp_info_sub']); ?></h4>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if(!empty($link)) : ?>
                                                <div class="tp-project__link">
                                                    <a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>">
                                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1.00098 7H13.001" stroke="currentColor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M7.00098 1L13.001 7L7.00098 13" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </a>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                    <div class="tp-scrollbar"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php endif; 
    }
}

$widgets_manager->register( new TP_Projects() );