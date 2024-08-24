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
class TP_Journey extends Widget_Base {

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
		return 'tp-journey';
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
		return __( 'Journey', 'tpcore' );
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
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // Journey group
        $this->start_controls_section(
            'tp_journey',
            [
                'label' => esc_html__('Journey List', 'tpcore'),
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
            'tp_journey_date', [
                'label' => esc_html__('Date', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('OCT 2022', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_journey_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Journey Title', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_journey_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('There are many variations of passages of Lorem Ipsum available, but the majority have suffered.', 'tpcore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'tp_journey_list',
            [
                'label' => esc_html__('Journery - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_journey_title' => esc_html__('Discover', 'tpcore'),
                    ],
                    [
                        'tp_journey_title' => esc_html__('Define', 'tpcore')
                    ],
                    [
                        'tp_journey_title' => esc_html__('Develop', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_journey_title }}}',
            ]
        );
        $this->end_controls_section();
	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('journey_section', 'Section - Style', '.tp-el-section'); 
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

<?php else : 
$this->add_render_attribute('title_args', 'class', 'ab-brand-title pb-0 mb-0');    
?>

<div class="journey-area p-relative fix">
    <div class="journey-grey-bg grey-bg"></div>
        <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="journey-section-box <?php echo esc_attr( $settings['tp_section_align'] ); ?>">
                        <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                        <h5 class="inner-section-subtitle pb-10"><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?></h5>
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
                        <p class="mt-20"><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="container-fluid g-0">
            <div class="row g-0">
                <div class="col-xl-12">
                <div class="journey-slider-wrapper">
                    <div class="swiper-container journey-slider-active">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['tp_journey_list'] as $key => $item) :
                            $key = $key+1;
                            $key = $key < 10 ? '0'.$key : $key;
                            ?>
                            <div class="swiper-slide">
                                <div class="journey-slider-item p-relative">
                                    <div class="journey-stroke-text">
                                        <h2><?php echo esc_html($key); ?></h2>
                                    </div>
                                    <?php if(!empty($item['tp_journey_date'])) : ?>
                                    <div class="journey-slider-meta">
                                        <span><?php echo tp_kses($item['tp_journey_date']); ?></span>
                                    </div> 
                                    <?php endif; ?>
                                    <div class="journey-slider-content">
                                        <?php if(!empty($item['tp_journey_title'])) : ?>
                                        <h4 class="journey-slider-title"><?php echo tp_kses($item['tp_journey_title']); ?></h4>
                                        <?php endif; ?>
                                        <?php if(!empty($item['tp_journey_description'])) : ?>
                                        <p><?php echo tp_kses($item['tp_journey_description']); ?></p>
                                        <?php endif; ?>
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

$widgets_manager->register( new TP_Journey() );