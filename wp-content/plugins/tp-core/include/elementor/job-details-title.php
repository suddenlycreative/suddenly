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
class TP_Job_Details_Title extends Widget_Base {

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
		return 'tp-job-details-title';
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
		return __( 'Job Details Title', 'tp-core' );
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
            'tp_job_sec',
                [
                'label' => esc_html__( 'Job Content Section', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_job_cat_switch',
            [
            'label'        => esc_html__( 'Job Cetagory Show', 'tpcore' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'tpcore' ),
            'label_off'    => esc_html__( 'Hide', 'tpcore' ),
            'return_value' => 'yes',
            'default'      => '0',
            ]
        );

        $this->add_control(
            'tp_cat_post_type',
            [
                'label' => esc_html__('Select Post Type', 'tp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'jobs-cat' => esc_html__('Job Category', 'tp-core'),
                    'category' => esc_html__('Post Cetegory', 'tp-core'),
                ],
                'default' => 'jobs-cat',
                'condition' => [
                    'tp_job_cat_switch' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_cat_order',
            [
                'label' => esc_html__('Select Category Order', 'tp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => esc_html__('ASC', 'tp-core'),
                    'DESC' => esc_html__('DESC', 'tp-core'),
                ],
                'default' => 'ASC',
                'condition' => [
                    'tp_job_cat_switch' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_job_title_switch',
            [
            'label'        => esc_html__( 'Job Title Show', 'tpcore' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'tpcore' ),
            'label_off'    => esc_html__( 'Hide', 'tpcore' ),
            'return_value' => 'yes',
            'default'      => 'yes',
            ]
        );

        $this->add_control(
            'tp_job_location_switch',
            [
            'label'        => esc_html__( 'Job Location Show', 'tpcore' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'tpcore' ),
            'label_off'    => esc_html__( 'Hide', 'tpcore' ),
            'return_value' => 'yes',
            'default'      => '0',
            ]
        );

        $this->add_control(
            'tp_job_type_switch',
            [
            'label'        => esc_html__( 'Job Type Show', 'tpcore' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'tpcore' ),
            'label_off'    => esc_html__( 'Hide', 'tpcore' ),
            'return_value' => 'yes',
            'default'      => '0',
            ]
        );

        $this->end_controls_section();

	}

    

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('job_section', 'Section - Style', '.tp-el-section'); 
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
    $job_type = get_post_meta(get_the_ID(), 'tp-job-type');
    $Job_location = get_post_meta(get_the_ID(), 'tp-job-location');
    $args = array(
        'taxonomy' => $settings['tp_cat_post_type'],
        'orderby' => 'name',
        'order'   => $settings['tp_cat_order']
    );
    $cats = get_categories($args);

?>

<div class="career-details-title-box">
    <?php
    if(!empty($settings['tp_cat_post_type'])) :
        foreach($cats as $cat):
            echo  "<span>".$cat->name."</span> ";
        endforeach;
    endif; 
    ?>
    <h4 class="career-details-title"><?php the_title(); ?></h4>
</div>
<div class="career-details-location-box">
    <?php if(!empty($job_type[0]) && !empty($settings['tp_job_location_switch'])) : ?>
    <span>
        <svg width="15" height="17" viewBox="0 0 15 17" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M1 7.10747C1 3.73441 3.93813 1 7.5625 1C11.1869 1 14.125 3.73441 14.125 7.10747C14.125 10.4541 12.0305 14.3593 8.76256 15.7558C8.00076 16.0814 7.12424 16.0814 6.36244 15.7558C3.09452 14.3593 1 10.4541 1 7.10747Z"
                stroke="#5F6168" stroke-width="1.5" />
            <path
                d="M9.4375 7.56274C9.4375 8.59828 8.59803 9.43774 7.5625 9.43774C6.52697 9.43774 5.6875 8.59828 5.6875 7.56274C5.6875 6.52721 6.52697 5.68774 7.5625 5.68774C8.59803 5.68774 9.4375 6.52721 9.4375 7.56274Z"
                stroke="#5F6168" stroke-width="1.5" />
        </svg>
        <?php echo esc_html($job_type[0]); ?>
    </span>
    <?php endif; ?>
    <?php if(!empty($Job_location[0]) && !empty($settings['tp_job_type_switch'])) : ?>
    <span>
        <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M8.5 15.75C12.5041 15.75 15.75 12.5041 15.75 8.5C15.75 4.49594 12.5041 1.25 8.5 1.25C4.49594 1.25 1.25 4.49594 1.25 8.5C1.25 12.5041 4.49594 15.75 8.5 15.75Z"
                stroke="#5F6168" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M8.5 5.52838V9.42838L11.1 10.7284" stroke="#5F6168" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <?php echo esc_html($Job_location[0]); ?>
    </span>
    <?php endif; ?>
</div>

<?php endif; 
	}
}

$widgets_manager->register( new TP_Job_Details_Title() );
