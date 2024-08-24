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
class TP_Portfolio_Details_Sidebar extends Widget_Base {

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
		return 'tp-portfolio-details-sidebar';
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
		return __( 'Portfolio Details Sidebar', 'tp-core' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        // title/content section
        $this->start_controls_section(
            'tp_portfolio_sec',
                [
                'label' => esc_html__( 'Portfolio Content Section', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();

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
            'tp_features_sub_title', [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Client', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_features_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Portfolio Features Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        
       
        $this->add_control(
            'tp_features_list',
            [
                'label' => esc_html__('Features - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_features_title' => esc_html__('Client name', 'tpcore'),
                    ],
                    [
                        'tp_features_title' => esc_html__('Catagories', 'tpcore')
                    ],
                    [
                        'tp_features_title' => esc_html__('Project Name', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_features_title }}}',
            ]
        );

        $this->end_controls_section();

        // title/content section
        $this->start_controls_section(
            'tp_portfolio_sec_2',
                [
                'label' => esc_html__( 'Portfolio Content Section', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
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

        $this->add_control(
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

        $this->add_control(
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
            $this->add_control(
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
            $this->add_control(
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
        


        $this->add_control(
            'tp_features_sub_title', [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Client', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_features_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Portfolio Features Title', 'tpcore'),
                'label_block' => true,
            ]
        );


        $this->end_controls_section();

       $this->tp_button_render('banner', 'Button');

       


       // title/content section
       $this->start_controls_section(
           'tp_portfolio_sec_social',
               [
               'label' => esc_html__( 'Portfolio Social Section', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
           ]
       );

    $this->add_control(
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

    $this->add_control(
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

    $this->add_control(
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
       

    $this->add_control(
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

    

    $this->end_controls_section();

    $this->start_controls_section(
        'content_section',
        [
            'label' => esc_html__( 'Left Section', 'tpcore' ),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
    );

    $this->add_control(
        'item_description',
        [
            'label' => esc_html__( 'Portfolio Details', 'tpcore' ),
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => esc_html__( 'Default description', 'tpcore' ),
            'placeholder' => esc_html__( 'Type your description here', 'tpcore' ),
        ]
    );

    $this->end_controls_section();

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('portfolio_section', 'Section - Style', '.tp-el-section'); 
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

<?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>


<?php else : 
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
    ?>
<div class="container">
<div class="row">
               <div class="col-lg-8">
               
               <?php echo tp_kses($settings['item_description']); ?>
               </div>
               <div class="col-lg-4">
               <div class="tp-portfolio-details-info-box">
    <?php foreach ($settings['tp_features_list'] as $key => $item) : ?>
        <div class="tp-portfolio-details-info-address">
        <?php if (!empty($item['tp_features_title'])): ?>
            <h4 class="tp-portfolio-details-info-title">
            <span>
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
                
            </span>
                <?php echo tp_kses($item['tp_features_title']); ?></h4>
                
                <?php endif; ?>
                <?php if (!empty($item['tp_features_sub_title'])): ?>
                    <p><?php echo tp_kses($item['tp_features_sub_title']); ?></p>
                <?php endif; ?>
        </div>
        <?php endforeach; ?>

        
        <div class="tp-portfolio-details-info-open d-flex">
        <div class="tp-portfolio-details-info-open-icon">
            <span>
                        <?php if($settings['tp_social_icon_type'] == 'icon') : ?>
                            <?php if (!empty($settings['tp_social_icon']) || !empty($settings['tp_social_selected_icon']['value'])) : ?>
                            <?php tp_render_icon($settings, 'tp_social_icon', 'tp_social_selected_icon'); ?>
                            <?php endif; ?>
                            <?php elseif( $settings['tp_social_icon_type'] == 'image' ) : ?>
                            <?php if (!empty($settings['tp_social_image']['url'])): ?>
                            <img src="<?php echo $settings['tp_social_image']['url']; ?>"
                                alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_social_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>
                            <?php else : ?>
                            <?php if (!empty($settings['tp_social_icon_svg'])): ?>
                            <?php echo $settings['tp_social_icon_svg']; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </span>
                    </div>
                <div class="tp-portfolio-details-info-open-content">
                    <?php if (!empty($settings['tp_features_title'])): ?>
                        <h4 class="tp-portfolio-details-info-title">
                            <?php echo tp_kses($settings['tp_features_title']); ?></h4>
                        </h4>
                    <?php endif; ?>
                    <?php if (!empty($settings['tp_features_sub_title'])): ?>
                            <p><?php echo tp_kses($settings['tp_features_sub_title']); ?></p>
                        <?php endif; ?>
                </div>
                </div>
                <div class="tp-portfolio-details-info-social">
                <?php if (!empty($settings['facebook_title'])): ?>
                    <a href=" <?php echo esc_url($settings['facebook_title']); ?>"><i class="fab fa-facebook-f"></i></a>
                <?php endif; ?>  
                <?php if (!empty($settings['twitter_title'])): ?>
                    <a href=" <?php echo esc_url($settings['twitter_title']); ?>"><i class="fab fa-twitter"></i></a>
                <?php endif; ?>  
                <?php if (!empty($settings['instagram_title'])): ?>
                    <a href=" <?php echo esc_url($settings['instagram_title']); ?>"><i class="fa-brands fa-instagram"></i></a>
                <?php endif; ?>  
                <?php if (!empty($settings['youtube_title'])): ?>
                    <a href=" <?php echo esc_url($settings['youtube_title']); ?>"><i class="fa-brands fa-youtube"></i></a>
                <?php endif; ?>  
                </div>
                    </div>
               </div>
        </div>
</div>


<?php endif; 
	}
}

$widgets_manager->register( new TP_Portfolio_Details_Sidebar() );
