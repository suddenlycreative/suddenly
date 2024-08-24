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
class TP_Security_Slider extends Widget_Base {

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
		return 'tp-security-slider';
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
		return __( 'Project Slider', 'tpcore' );
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

        // Security group
        $this->start_controls_section(
            'tp_security',
            [
                'label' => esc_html__('Project List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tp_security_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_security_subtitle',
            [
                'label' => esc_html__('Subtitle', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        

        $repeater->add_control(
            'tp_security_link_switcher',
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
            'tp_security_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_security_link_switcher' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'tp_security_link',
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
                    'tp_security_link_type' => '1',
                    'tp_security_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_security_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_security_link_type' => '2',
                    'tp_security_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_security_image',
            [
                'label' => esc_html__( 'Choose Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        

        $this->add_control(
            'tp_security_list',
            [
                'label' => esc_html__('Services - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_security_title' => esc_html__('Discover', 'tpcore'),
                    ],
                    [
                        'tp_security_title' => esc_html__('Define', 'tpcore')
                    ],
                    [
                        'tp_security_title' => esc_html__('Develop', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_security_title }}}',

            ]
        );
        $this->end_controls_section();


	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('security_section', 'Section - Style', '.tp-el-section'); 
        $this->tp_section_style_controls('cta_section', 'CTA Section - Style', '.tp-el-section-cta'); 
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

<?php if ( $settings['tp_design_style']  == 'layout-2' ) :     
    $this->add_render_attribute('title_cta_args', 'class', 'tp-service__title-white');
?>


<?php else: 
	$this->add_render_attribute('title_args', 'class', 'tp-section-title-4');
    
?>

<section class="tp-feature-area-2">
            <div class="container-fluid gx-0">
               <div class="row gx-0">
                  <div class="col-lg-12">
                     <div class="tp-feature-active-2 splide wow fadeInUp" data-wow-duration="1s"
                     data-wow-delay=".3s">
                        <div class="splide__track pt-35">
                           <div class="splide__list">
                           <?php foreach ($settings['tp_security_list'] as $key => $item) :
                        
                                    if ('2' == $item['tp_security_link_type']) {
                                        $link = get_permalink($item['tp_security_page_link']);
                                        $target = '_self';
                                        $rel = 'nofollow';
                                    } else {
                                        $link = !empty($item['tp_security_link']['url']) ? $item['tp_security_link']['url'] : '';
                                        $target = !empty($item['tp_security_link']['is_external']) ? '_blank' : '';
                                        $rel = !empty($item['tp_security_link']['nofollow']) ? 'nofollow' : '';
                                    }
                                    if ( !empty($item['tp_security_image']['url']) ) {
                                        $tp_image = !empty($item['tp_security_image']['id']) ? wp_get_attachment_image_url( $item['tp_security_image']['id'], $item['tp_image_size_size']) : $item['tp_security_image']['url'];
                                        $tp_image_alt = get_post_meta($item["tp_security_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                              <div class="splide__slide">
                                 <div class="tp-feature-thumb-2 w-img p-relative">
                                    <a href="<?php echo esc_url($link); ?>">
                                    <?php if(!empty($tp_image)) : ?>
                                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                                    <?php endif; ?>
                                </a>
                                    <div class="tp-feature-2-info d-flex align-items-center p-relative">
                                       <div class="tp-feature-2-title-wrapper">
                                       <?php if (!empty($item['tp_security_subtitle' ])): ?>
                                            <span class="tp-feature-2-title-sub"><?php echo tp_kses($item['tp_security_subtitle' ]); ?></span>
                                            <?php endif; ?>
                                          
                                          <?php if (!empty($item['tp_security_title' ])): ?>
                                            <h4 class="tp-feature-2-title">
                                                <?php if(!empty($link)) : ?>
                                                <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_security_title' ]); ?></a>
                                                <?php else : ?>
                                                <?php echo tp_kses($item['tp_security_title' ]); ?>
                                                <?php endif; ?>
                                            </h4>
                                            <?php endif; ?>
                                       </div>
                                       <?php if(!empty($link)) : ?>
                                       <div class="tp-feature-2-btn">
                                          <a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>"><i class="fa-regular fa-arrow-up-right"></i></a>
                                       </div>
                                       <?php endif; ?>
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

$widgets_manager->register( new TP_Security_Slider() );