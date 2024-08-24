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
class TP_Rank extends Widget_Base {

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
        return 'rank';
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
        return __( 'Rank', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // tp_section_title
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        

        // tp_btn_button_group
        $this->start_controls_section(
            'tp_btn_button_group',
            [
                'label' => esc_html__('Button', 'tp-core'),
                 'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2']
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
                    'tp_btn_button_show' => 'yes'
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


        // Rank group
        $this->start_controls_section(
            'tp_ranks',
            [
                'label' => esc_html__('Rank List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tp_ranks_active_switcher',
            [
                'label' => esc_html__( 'Active Rank', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => '0',
            ]
        );

        $repeater->add_control(
            'tp_ranks_cup_switcher',
            [
                'label' => esc_html__( 'Add Rank Cup', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => '0',
            ]
        );

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
            'tp_rank_icon_type',
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
            'tp_rank_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_rank_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_rank_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_rank_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_rank_selected_icon',
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
                        'tp_rank_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_rank_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tp-core'),
                'condition' => [
                    'tp_rank_icon_type' => 'svg',
                    'repeater_condition' => ['style_6', 'style_10']
                ]
            ]
        );


        $repeater->add_control(
            'tp_rank_num', [
                'label' => esc_html__('Number', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('1', 'tpcore'),
            ]
        );


        $repeater->add_control(
            'tp_rank_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Rank Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_rank_subtitle',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Sub title here',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_rank_class', [
                'label' => esc_html__('Add Class (If Need)', 'tpcore'),
                'description' => 'NOTE: This section is for make uniqe the item. You can add custom class with this field.',
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'tp_rank_list',
            [
                'label' => esc_html__('Rank - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_rank_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_rank_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_rank_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_rank_title }}}',
            ]
        );

        $this->end_controls_section();

        // shape 
        $this->start_controls_section(
        'tp_rank_shape',
            [
                'label' => esc_html__( 'Shape', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
        'tp_rank_shape_switch',
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
                    'tp_rank_shape_switch' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'condition' => [
                    'tp_rank_shape_switch' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();


    }

    // style_tab_content
    protected function style_tab_content(){

        $this->tp_section_style_controls('ranks_section', 'Section Style', '.ele-section');
        
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
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-btn-hover alt-color-black');
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-btn-hover alt-color-black');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>

<div class="tp-rank__area pb-200">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5 order-1 order-lg-1">
                <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
                <div class="tp-rank__section-box pb-25 wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".3s">
                    <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                    <h4 class="tp-section-subtitle"><?php echo tp_kses($settings['tp_section_sub_title']); ?></h4>
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
                <?php if (!empty($settings['tp_btn_text'])) : ?>
                <div class="tp-rank__btn wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".5s">
                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                        <span><?php echo $settings['tp_btn_text']; ?></span>
                        <b></b>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-xl-7 col-lg-7 order-0 order-lg-2">
                <div class="tp-rank__wrapper p-relative">

                    <?php if(!empty($settings['tp_rank_shape_switch'])) : ?>
                    <div class="tp-rank__circle-shape-1 d-none d-sm-block wow tpfadeUp" data-wow-duration=".9s"
                        data-wow-delay=".3s">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rank/sky-circle.png" alt="">
                    </div>
                    <div class="tp-rank__circle-shape-2 d-none d-sm-block wow tpfadeLeft" data-wow-duration=".9s"
                        data-wow-delay=".5s">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rank/yellow-circle.png" alt="">
                    </div>
                    <div class="tp-rank__circle-shape-3 d-none d-sm-block wow tpfadeRight" data-wow-duration=".9s"
                        data-wow-delay=".4s">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rank/black-circle.png" alt="">
                    </div>
                    <div class="tp-rank__circle-shape-4 d-none d-sm-block wow tpfadeIn" data-wow-duration=".9s"
                        data-wow-delay=".7s">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rank/black-sm-circle.png" alt="">
                    </div>
                    <div class="tp-rank__circle-shape-5 d-none d-sm-block wow tpfadeUp" data-wow-duration=".9s"
                        data-wow-delay=".9s">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rank/black-sm-circle.png" alt="">
                    </div>
                    <div class="tp-rank__circle-shape-6 d-none d-sm-block wow tpfadeUp" data-wow-duration=".9s"
                        data-wow-delay=".2s">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rank/black-sm-circle.png" alt="">
                    </div>
                    <div class="tp-rank__circle-shape-7 d-none d-sm-block wow tpfadeIn" data-wow-duration=".9s"
                        data-wow-delay="1s">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rank/black-sm-circle.png" alt="">
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($tp_shape_image)) : ?>
                    <div class="tp-rank__bg-shape">
                        <img class="wow tpfadeRight" data-wow-duration=".9s" data-wow-delay="1.2s" src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
                    </div>
                    <?php endif; ?>
                    <div class="tp-rank__rank-card wow tpfadeRight" data-wow-duration=".9s" data-wow-delay=".7s">

                        <?php foreach ($settings['tp_rank_list'] as $key => $item) :

                        $active = $item['tp_ranks_active_switcher'] ? 'active' : NULL;
                        
                        ?>
                        <div class="tp-rank__item p-relative <?php echo esc_attr($active); echo ' '; echo esc_attr($item['tp_rank_class']); ?>">

                            <?php if(!empty($item['tp_ranks_cup_switcher'])) : ?>
                            <div class="tp-rank__cup">
                                <span><img src="<?php echo get_template_directory_uri(); ?>/assets/img/rank/rank-cup.png" alt="rank-cup"></span>
                            </div>
                            <?php endif; ?>

                            <?php if(!empty($item['tp_rank_num'])) : ?>
                            <div class="tp-rank__number d-flex align-items-center justify-content-center">
                                <i>#</i>
                                <span><?php echo tp_kses($item['tp_rank_num']); ?></span>
                            </div>
                            <?php endif; ?>

                            <?php if($item['tp_rank_icon_type'] == 'icon') : ?>
                            <?php if (!empty($item['tp_rank_icon']) || !empty($item['tp_rank_selected_icon']['value'])) : ?>
                            <div class="tp-rank__company">
                                <span><?php tp_render_icon($item, 'tp_rank_icon', 'tp_rank_selected_icon'); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php elseif( $item['tp_rank_icon_type'] == 'image' ) : ?>
                            <?php if (!empty($item['tp_rank_image']['url'])): ?>
                            <div class="tp-rank__company">
                                <span><img src="<?php echo $item['tp_rank_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_rank_image']['url']), '_wp_attachment_image_alt', true); ?>"></span>
                            </div>
                            <?php endif; ?>
                            <?php else : ?>
                            <?php if (!empty($item['tp_rank_icon_svg'])): ?>
                            <div class="tp-rank__company">
                                <span><?php echo $item['tp_rank_icon_svg']; ?></span>
                            </div>
                            <?php endif; ?>
                            <?php endif; ?>

                            <div class="tp-rank__company-info">
                                <?php if(!empty($item['tp_rank_title'])) : ?>
                                <span><?php echo tp_kses($item['tp_rank_title']); ?></span>
                                <?php endif; ?>
                                <?php if(!empty($item['tp_rank_subtitle'])) : ?>
                                <span><?php echo tp_kses($item['tp_rank_subtitle']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endif; 
    }
}

$widgets_manager->register( new TP_Rank() ); 