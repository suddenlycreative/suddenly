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
class TP_Process extends Widget_Base {

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
		return 'tp-process';
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
		return __( 'Process', 'tpcore' );
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

        // title/content
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', 'layout-1' );

        // Process group
        $this->start_controls_section(
            'tp_process',
            [
                'label' => esc_html__('Process List', 'tpcore'),
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
            'tp_process_icon_type',
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
            'tp_process_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_process_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_process_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_process_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_process_selected_icon',
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
                        'tp_process_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_process_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tp-core'),
                'condition' => [
                    'tp_process_icon_type' => 'svg',
                ]
            ]
        );

        $repeater->add_control(
            'tp_process_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Process Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_process_des', [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('onec suscipit ante ipsum. Donec quam at tortor hendrerit', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_2'
                ]
            ]
        );

        $this->add_control(
            'tp_process_list',
            [
                'label' => esc_html__('Processs - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_process_title' => esc_html__('Discover', 'tpcore'),
                    ],
                    [
                        'tp_process_title' => esc_html__('Define', 'tpcore')
                    ],
                    [
                        'tp_process_title' => esc_html__('Develop', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_process_title }}}',
            ]
        );

        $this->add_control(
            'tp_bottom_text', [
                'label' => esc_html__('Bottom Text', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('BRING THEM TOGETHER AND YOU OVERCOME THE ORDINARY.', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );

        $this->end_controls_section();

        // process shape
        $this->start_controls_section(
        'tp_process_shape',
            [
                'label' => esc_html__( 'Process Shape', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );

        $this->add_control(
        'tp_process_shape_switch',
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
                    'tp_process_shape_switch' => 'yes'
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
                    'tp_process_shape_switch' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'condition' => [
                    'tp_process_shape_switch' => 'yes'
                ],
                'default' => 'full'
            ]
        );
        
        $this->end_controls_section();

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('process_section', 'Section - Style', '.tp-el-section'); 
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

<section class="tp-feature-3-area pt-100 tp-el-section">
    <div class="container-fluid gx-0">
        <div class="row gx-0">
            <div class="feature-3-active swiper-container">
                <div class="swiper-wrapper">

                    <?php foreach ($settings['tp_process_list'] as $key => $item) : ?>
                    <div class="swiper-slide">
                        <div class="tp-feature-3-content-inner d-flex align-items-center">

                            <?php if($item['tp_process_icon_type'] == 'icon') : ?>
                                <?php if (!empty($item['tp_process_icon']) || !empty($item['tp_process_selected_icon']['value'])) : ?>
                                <div class="tp-feature-3-content-thumb">
                                    <?php tp_render_icon($item, 'tp_process_icon', 'tp_process_selected_icon'); ?>
                                </div>
                                <?php endif; ?>
                            <?php elseif( $item['tp_process_icon_type'] == 'image' ) : ?>
                                <?php if (!empty($item['tp_process_image']['url'])): ?>
                                <div class="tp-feature-3-content-thumb">
                                    <img src="<?php echo $item['tp_process_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_process_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                </div>
                                <?php endif; ?>
                            <?php else : ?>
                                <?php if (!empty($item['tp_process_icon_svg'])): ?>
                                <div class="tp-feature-3-content-thumb">
                                    <?php echo $item['tp_process_icon_svg']; ?>
                                </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="tp-feature-3-content">
                                <?php if (!empty($item['tp_process_title'])): ?>
                                <h3 class="tp-feature-title"><?php echo tp_kses($item['tp_process_title']); ?></h3>
                                <?php endif; ?>
                                <?php if (!empty($item['tp_process_des'])): ?>
                                <p><?php echo tp_kses($item['tp_process_des']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</section>

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
    
    $this->add_render_attribute('title_args', 'class', 'tp-section-title'); 
?>

<section id="mousemove" class="tp-category-area p-relative fix pt-120 pb-120">
    <div class="tp-category-shape">
        <?php if(!empty($tp_shape_image)) : ?>
        <img class="shape-1 mousemove__image" src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
        <?php endif; ?>
        <?php if(!empty($tp_shape_image_2)) : ?>
        <img class="shape-2 mousemove__image" src="<?php echo esc_url($tp_shape_image_2); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
        <?php endif; ?>
        <span class="shape-3">
            <svg width="1093" height="128" viewBox="0 0 1093 128" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 50.9659C56.3481 18.4898 187.969 -31.1736 271.668 29.9813C376.292 106.425 498.092 148.394 553.787 115.918C609.482 83.4422 719.311 -19.4825 816.127 29.9813C912.943 79.4452 896.286 151.392 1092 110.422" stroke="currentColor"/>
            </svg>
        </span>
    </div>
    <div class="container">

        <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="tp-category-title-wrapper text-center">
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
        </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-xl-12">
                <div class="process-content d-flex">

                    <?php foreach ($settings['tp_process_list'] as $key => $item) : ?>
                    <div class="tp-category-content tp-category-content-<?php echo esc_attr($key+1); ?>">
                        <div class="tp-category-icon">
                        
                            <?php if($item['tp_process_icon_type'] == 'icon') : ?>
                                <?php if (!empty($item['tp_process_icon']) || !empty($item['tp_process_selected_icon']['value'])) : ?>
                                <?php tp_render_icon($item, 'tp_process_icon', 'tp_process_selected_icon'); ?>
                                <?php endif; ?>
                            <?php elseif( $item['tp_process_icon_type'] == 'image' ) : ?>
                                <?php if (!empty($item['tp_process_image']['url'])): ?>
                                <img src="<?php echo $item['tp_process_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_process_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                <?php endif; ?>
                            <?php else : ?>
                                <?php if (!empty($item['tp_process_icon_svg'])): ?>
                                <?php echo $item['tp_process_icon_svg']; ?>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (!empty($item['tp_process_title'])): ?>
                            <h4 class="tp-category-content-title"><?php echo tp_kses($item['tp_process_title' ]); ?></h4>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>

        <?php if(!empty($settings['tp_bottom_text'])) : ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="tp-offer-all-btn text-center mt-50">
                <p><?php echo tp_kses($settings['tp_bottom_text']); ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php endif;
	}
}

$widgets_manager->register( new TP_Process() );