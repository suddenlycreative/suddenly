<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Advanced_Tab extends Widget_Base {

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
		return 'advanced-tab';
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
		return __( 'Advanced Tab', 'tpcore' );
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

	protected function register_controls() {

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
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // offer
        $this->start_controls_section(
            '_section_offer',
            [
                'label' => __('Offer', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'offer_badge',
            [
                'label' => __('Is Offer', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'tpcore'),
                'label_off' => __('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => '0',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'offer_title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Offer Title', 'tpcore'),
                'default' => __('35%', 'tpcore'),
                'placeholder' => __('Type Tab Offer Title', 'tpcore'),
                'label_block' => true,
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'condition' => [
                    'offer_badge' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
            '_section_price_tabs',
            [
                'label' => __('Advanced Tabs', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Title', 'tpcore'),
                'default' => __('Tab Title', 'tpcore'),
                'placeholder' => __('Type Tab Title', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'template',
            [
                'label' => __('Section Template', 'tpcore'),
                'placeholder' => __('Select a section template for as tab content', 'tpcore'),
  
                'type' => Controls_Manager::SELECT2,
                'options' => get_elementor_templates()
            ]
        );

        $this->add_control(
            'tabs',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{title}}',
                'default' => [
                    [
                        'title' => 'Tab 1',
                    ],
                    [
                        'title' => 'Tab 2',
                    ]
                ]
            ]
        );

        $this->end_controls_section();

        
        // tab shape
        $this->start_controls_section(
            'tp_tab_shape',
                [
                  'label' => esc_html__( 'Section Shape', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
           );
   
           $this->add_control(
            'tp_tab_shape_switch',
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
                       'tp_tab_shape_switch' => 'yes'
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
                       'tp_tab_shape_switch' => 'yes'
                   ]
               ]
           );
   
           $this->add_group_control(
               Group_Control_Image_Size::get_type(),
               [
                   'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                   'exclude' => ['custom'],
                   'condition' => [
                       'tp_tab_shape_switch' => 'yes'
                   ]
               ]
           );
           
           $this->end_controls_section();

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('advanced_tab_section', 'Section Style', '.ele-section');
        $this->tp_basic_style_controls('advanced_tab_sub_title', 'Subtitle Style', '.ele-subtitle');
        $this->tp_basic_style_controls('advanced_tab_title', 'Heading Style', '.ele-heading');
        $this->tp_basic_style_controls('advanced_tab_des', 'Content Style', '.ele-description');
        $this->tp_basic_style_controls('advanced_tab_link', 'Tab Link Style', '.ele-link');
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
    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_2']['url']) ) {
        $tp_shape_image_2 = !empty($settings['tp_shape_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_2']['url'];
        $tp_shape_image_alt_2 = get_post_meta($settings["tp_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    $this->add_render_attribute('title_args', 'class', 'price-banner-title tp-char-animation');
?>

<!-- breadcrumb-area-start -->
<div class="breadcrumb__area breadcrumb-ptb-5 p-relative blue-bg-2">
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
        <div class="row align-items-end">
            <div class="col-xl-9 col-lg-7 col-md-7">
                <div class="price-banner z-index-3">
                    <div class="price-banner-title-box">
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
                        <p><?php echo tp_kses($settings['tp_section_description']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-5 col-md-5">
                <div class="tp-price__btn-box tp-price__btn-inner">

                    <?php if(!empty($settings['offer_badge']) && !empty($settings['offer_title'])) : ?>
                    <div class="tp-price__btn-line d-none d-md-block">
                        <svg width="56" height="58" viewBox="0 0 56 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.164835 56.549C40.9814 63.3663 32.9699 -14.7417 50.2037 30.0803C67.4374 74.9024 -21.1494 2.27453 55.6761 0.848635" stroke="white" stroke-dasharray="3 3"/>
                        </svg>
                    </div>
                    <div class="tp-price__btn-offer-tag d-none d-md-block">
                        <span><?php echo tp_kses($settings['offer_title']); ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <nav>
                        <div class="nav nav-tab tp-price__btn-bg" id="nav-tab" role="tablist">

                            <?php foreach ($settings['tabs'] as $key => $tab):
                                $active = ($key == 0) ? 'active' : '';
                            ?>
                            <button class="nav-link adv-tab-<?php echo esc_attr($key+1); ?> <?php echo esc_attr($active); ?>"
                                id="adv-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="pill"
                                data-bs-target="#v-pills-home-<?php echo esc_attr($key); ?>" type="button" role="tab"
                                aria-controls="v-pills-home-<?php echo esc_attr($key); ?>"
                                aria-selected="true"><?php echo tp_kses($tab['title']); ?><?php if(!empty($tab['offer_title'])) : ?><span class="offer"><?php echo tp_kses($tab['offer_title']); ?></span><?php endif; ?>
                            </button>
                            <?php endforeach; ?>

                            <span class="test"></span>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area-end --> 

<!-- tp-price-area-start -->
<div class="tp-price-area mb-120">
    <div class="container">
        <div class="price-tab-content">
            <div class="tab-content" id="nav-tabContent">
                <?php foreach ($settings['tabs'] as $key => $tab):
                    $active = ($key == 0) ? 'show active' : '';
                ?>
                <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="v-pills-home-<?php echo esc_attr($key); ?>"
                    role="tabpanel" aria-labelledby="adv-tab-<?php echo esc_attr($key); ?>">
                    <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($tab['template'], true); ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!-- tp-price-area-end -->

<?php else: 
    $this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>

<div class="tp-price__area tp-price__pl-pr p-relative pt-110 pb-80">
    <div class="container">
        <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
        <div class="row justify-content-center">
            <div class="col-xl-7 wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".3s">
                <div class="tp-price__section-box text-center mb-35">
                    <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                    <h4 class="tp-section-subtitle"><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?></h4>
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
        <div class="row wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".5s">
            <div class="col-12">
            <div class="tp-price__btn-box p-relative mb-50 d-flex justify-content-center">
                <?php if(!empty($settings['offer_badge']) && !empty($settings['offer_title'])) : ?>
                <div class="tp-price-offer-badge-wrap d-none d-sm-block">
                    <div class="price-shape-line">
                        <svg width="80" height="42" viewBox="0 0 80 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M78.5938 8.78059C59.0829 45.2801 2.05127 -8.72021 27.0652 32.28C52.079 73.2801 48.5771 -41.2195 0.550438 18.7821" stroke="#FF3C82" stroke-dasharray="3 3"/>
                        </svg>
                    </div>
                    <div class="price-offer-badge">
                        <span><?php echo tp_kses($settings['offer_title']); ?></span>
                    </div>
                </div>
                <?php endif; ?>
                <nav>

                    <div class="nav nav-tab tp-price__btn-bg" id="nav-tab" role="tablist">

                        <?php foreach ($settings['tabs'] as $key => $tab):
                            $active = ($key == 0) ? 'active' : '';
                        ?>
                        <button class="nav-link adv-tab-<?php echo esc_attr($key+1); ?> <?php echo esc_attr($active); ?>"
                            id="adv-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="pill"
                            data-bs-target="#v-pills-home-<?php echo esc_attr($key); ?>" type="button" role="tab"
                            aria-controls="v-pills-home-<?php echo esc_attr($key); ?>"
                            aria-selected="true"><?php echo tp_kses($tab['title']); ?><?php if(!empty($tab['offer_title'])) : ?><span class="offer"><?php echo tp_kses($tab['offer_title']); ?></span><?php endif; ?>
                        </button>
                        <?php endforeach; ?>
                        
                        <span class="test"></span>
                        
                    </div>

                </nav>
            </div>
            </div>
        </div>
        <div class="price-tab-content">
            <div class="tab-content" id="nav-tabContent">

                <?php foreach ($settings['tabs'] as $key => $tab):
                    $active = ($key == 0) ? 'show active' : '';
                ?>
                <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="v-pills-home-<?php echo esc_attr($key); ?>"
                    role="tabpanel" aria-labelledby="adv-tab-<?php echo esc_attr($key); ?>">
                    <div class="pricing-tab-main">
                        <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($tab['template'], true); ?>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>


<section class="tp-pricing-area pt-130 pb-100 p-relative z-index-1 gray-bg d-none">
    <div class="container container-large">
        <div class="row">
            <div class="col-lg-12">
                <div class="tp-pricing-wrapper text-center">
                    <?php if ( !empty($settings['tp_sub_title']) ) : ?>
                    <span class="tp-section__title-pre-3 has-before p-relative"><i class="fa-solid fa-plus"></i>
                    <?php echo tp_kses( $settings['tp_sub_title'] ); ?></span>
                    <?php endif; ?>
                    <?php
						if ( !empty($settings['tp_title' ]) ) :
							printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['tp_title_tag'] ),
                            $this->get_render_attribute_string( 'title_args' ),
                            tp_kses( $settings['tp_title' ] )
                            );
						endif;
					?>
                    <?php if ( !empty($settings['tp_description']) ) : ?>
                    <p><?php echo tp_kses( $settings['tp_description'] ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-5">
                <div class="tp-pricing-tab-nav tp-tab mb-50 mx-auto">
                    <nav>
                        <div class="nav nav-tabs justify-content-center" id="nav-tab" role=tablist>
                            <div class="nav justify-content-center p-relative z-index-1">

                                <?php foreach ($settings['tabs'] as $key => $tab):
                                    $active = ($key == 0) ? 'active' : '';
                                ?>
                                <button class="nav-link tp-adprice-<?php echo esc_attr($key+1); ?> <?php echo esc_attr($active); ?>"
                                    id="adv-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-home-<?php echo esc_attr($key); ?>" type="button" role="tab"
                                    aria-controls="v-pills-home-<?php echo esc_attr($key); ?>"
                                    aria-selected="true"><?php echo tp_kses($tab['title']); ?><?php if(!empty($tab['offer_title'])) : ?><span class="offer"><?php echo tp_kses($tab['offer_title']); ?></span><?php endif; ?>
                                </button>
                                <?php endforeach; ?>
                                <i class="tp-price-tab-bg-slide"></i>

                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="tab-content wow fadeInUp" id="nav-tabContent" data-wow-delay=".3s" data-wow-duration="1s">

                    <?php foreach ($settings['tabs'] as $key => $tab):
                        $active = ($key == 0) ? 'show active' : '';
                    ?>
                    <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="v-pills-home-<?php echo esc_attr($key); ?>"
                        role="tabpanel" aria-labelledby="adv-tab-<?php echo esc_attr($key); ?>">
                        <div class="pricing-tab-main">
                            <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($tab['template'], true); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</section>

<?php endif;

	}

}
$widgets_manager->register( new TP_Advanced_Tab() );