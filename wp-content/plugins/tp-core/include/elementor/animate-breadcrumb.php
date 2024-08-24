<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Animate_Breadcrumb extends Widget_Base {

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
		return 'tp-animate-breadcrumb';
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
		return __( 'Animate Breadcrumb', 'tpcore' );
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

    protected function register_controls_section(){
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
         'tp_breadcrumb_sec',
             [
               'label' => esc_html__( 'Title & Description', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => ['layout-1', 'layout-2']
               ]
             ]
        );
        
        $this->add_control(
        'tp_breadcrumb_title',
         [
            'label'       => esc_html__( 'Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'default'     => esc_html__( 'About ', 'tpcore' ),
            'label_block' => true
         ]
        );
        
        $this->add_control(
        'tp_breadcrumb_title_2',
         [
            'label'       => esc_html__( 'Secondary Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'default'     => esc_html__( 'Softec ', 'tpcore' ),
            'label_block' => true
         ]
        );
        
        $this->end_controls_section();

        
        // thumbnail image
        $this->start_controls_section(
        'tp_thumbnail_section',
            [
                'label' => esc_html__( 'Thumbnail', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => ['layout-2', 'layout-3']
                ]
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
                    'tp_design_style' => 'layout-2'
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
                    'tp_design_style' => 'layout-2'
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
                    'tp_design_style' => 'layout-2'
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
        
        // breadcrumb shape
        $this->start_controls_section(
            'tp_banner_shape',
                [
                  'label' => esc_html__( 'Breadcrumb Shape', 'tpcore' ),
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

    }

    protected function style_tab_content(){
        $this->tp_section_style_controls('breadcrumb_section', 'Section - Style', '.tp-el-section');
        $this->tp_section_style_controls('breadcrumb_section_2', 'Section 2 - Style', '.tp-el-section-2');
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
    if ( !empty($settings['tp_thumbnail_image_2']['url']) ) {
        $tp_thumbnail_image_2 = !empty($settings['tp_thumbnail_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image_2']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image_2']['url'];
        $tp_thumbnail_image_alt_2 = get_post_meta($settings["tp_thumbnail_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_thumbnail_image_3']['url']) ) {
        $tp_thumbnail_image_3 = !empty($settings['tp_thumbnail_image_3']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image_3']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image_3']['url'];
        $tp_thumbnail_image_alt_3 = get_post_meta($settings["tp_thumbnail_image_3"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_thumbnail_image_4']['url']) ) {
        $tp_thumbnail_image_4 = !empty($settings['tp_thumbnail_image_4']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image_4']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image_4']['url'];
        $tp_thumbnail_image_alt_4 = get_post_meta($settings["tp_thumbnail_image_4"]["id"], "_wp_attachment_image_alt", true);
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
?>

<div class="breadcrumb__area breadcrumb-height-3 p-relative blue-bg-2 fix">
    <?php if(!empty($tp_shape_image)) : ?>
    <div class="breadcrumb__shape-1">
        <img src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($tp_shape_image_2)) : ?>
    <div class="breadcrumb__shape-2">
        <img src="<?php echo esc_url($tp_shape_image_2); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="breadcrumb__content-wrap">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="breadcrumb__content text-center z-index-3 mb-60">
                        <?php if(!empty($settings['tp_breadcrumb_title'])) : ?>
                        <h3 class="breadcrumb__title"><?php echo tp_kses($settings['tp_breadcrumb_title']); ?></h3>
                        <?php endif; ?>
                        <?php if(!empty($settings['tp_breadcrumb_title_2'])) : ?>
                        <div class="breadcrumb__text">
                            <p><?php echo tp_kses($settings['tp_breadcrumb_title_2']); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="carrer-banner-area carrer-banner-space">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-3 col-lg-3 col-md-6">
                <?php if(!empty($tp_thumbnail_image)) : ?>
                <div class="carrer-banner-img-item">
                    <img src="<?php echo esc_url($tp_thumbnail_image); ?>" alt="<?php echo esc_attr($tp_thumbnail_image_alt); ?>">
                </div>
                <?php endif; ?>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6">
                <?php if(!empty($tp_thumbnail_image_2)) : ?>
                <div class="carrer-banner-img-item parallax-main">
                    <img class="parallax-img" src="<?php echo esc_url($tp_thumbnail_image_2); ?>" alt="<?php echo esc_attr($tp_thumbnail_image_alt_2); ?>" data-parallax='{"y": 300, "smoothness": 10}'>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                <?php if(!empty($tp_thumbnail_image_3)) : ?>
                <div class="carrer-banner-img-item mb-20">
                    <img src="<?php echo esc_url($tp_thumbnail_image_3); ?>" alt="<?php echo esc_attr($tp_thumbnail_image_alt_3); ?>">
                </div>
                <?php endif; ?>
                <?php if(!empty($tp_thumbnail_image_4)) : ?>
                <div class="carrer-banner-img-item">
                    <img src="<?php echo esc_url($tp_thumbnail_image_4); ?>" alt="<?php echo esc_attr($tp_thumbnail_image_alt_4); ?>">
                </div>
                <?php endif; ?>
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

    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_2']['url']) ) {
        $tp_shape_image_2 = !empty($settings['tp_shape_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_2']['url'];
        $tp_shape_image_alt_2 = get_post_meta($settings["tp_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
?>

<div class="breadcrumb__area breadcrumb-ptb-3 p-relative blue-bg-2">
    <?php if(!empty($tp_shape_image)) : ?>
    <div class="breadcrumb__shape-1">
        <img src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($tp_shape_image_2)) : ?>
    <div class="breadcrumb__shape-2">
        <img src="<?php echo esc_url($tp_shape_image_2); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-7">
            <div class="breadcrumb__content z-index-1">
                <h3 class="breadcrumb__title tp-char-animation"><?php the_title(); ?></h3>
                <?php if(function_exists('bcn_display')) {
                    echo '<div class="breadcrumb__list wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".4s">';
                    bcn_display();
                    echo '</div>';
                } 
                ?>
            </div>
            </div>
            <div class="col-xl-7 col-lg-5 col-lg-4 text-center text-md-end">
                <?php if(!empty($tp_thumbnail_image)) : ?>
                <div class="breadcrumb__img p-relative text-start z-index">
                    <img class="z-index-3" src="<?php echo esc_url($tp_thumbnail_image); ?>" alt="<?php echo esc_attr($tp_thumbnail_image_alt); ?>">
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


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
?>	


<!-- tp-breadcrumb-area-start -->
<div class="about-banner-area p-relative">
    <?php if(!empty($tp_shape_image)) : ?>
    <div class="about-shape-1 z-index-3">
        <img src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($tp_shape_image_2)) : ?>
    <div class="about-shape-2 z-index-3">
        <img src="<?php echo esc_url($tp_shape_image_2); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
    </div>
    <?php endif; ?>
    <div class="about-banner p-relative z-index fix tp-el-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="about-banner-content z-index-5">
                        <h4 class="about-banner-title" data-parallax='{"y": 1000, "smoothness": 10}'>
                            <?php if(!empty($settings['tp_breadcrumb_title'])) : ?>
                            <span><?php echo tp_kses($settings['tp_breadcrumb_title']); ?></span> <br>
                            <?php endif; ?>
                            <?php if(!empty($settings['tp_breadcrumb_title_2'])) : ?>
                            <span><?php echo tp_kses($settings['tp_breadcrumb_title_2']); ?></span>
                            <?php endif; ?>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- tp-breadcrumb-area-end -->

<!-- tp-breadcrumb-header-area-start -->
<div class="about-img-area mb-100 z-index-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="about-img about-img-height p-relative grey-bg tp-el-section-2" >
                    <div class="about-img-content">
                        <h4 class="about-img-title" data-parallax='{"y": 1000, "smoothness": 10}'>
                            <?php if(!empty($settings['tp_breadcrumb_title'])) : ?>
                            <span><?php echo tp_kses($settings['tp_breadcrumb_title']); ?></span> <br>
                            <?php endif; ?>
                            <?php if(!empty($settings['tp_breadcrumb_title_2'])) : ?>
                            <span><?php echo tp_kses($settings['tp_breadcrumb_title_2']); ?></span>
                            <?php endif; ?>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- tp-breadcrumb-header-area-end -->

<?php endif;
	}
}

$widgets_manager->register( new TP_Animate_Breadcrumb() );