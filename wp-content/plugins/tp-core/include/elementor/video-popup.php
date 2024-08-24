<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Video_Popup extends Widget_Base {

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
		return 'tp-video-popup';
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
		return __( 'Video Popup', 'tpcore' );
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

        // tp_video
        $this->start_controls_section(
            'tp_video',
            [
                'label' => esc_html__('Video', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_video_url',
            [
                'label' => esc_html__('Video URL', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'https://www.youtube.com/watch?v=_RpLvsA1SNM',
                'label_block' => true,
                'description' => __("We recommended to put video url form video website such as 'youtube', 'vimeo'.", 'tpcore')
            ]
        );

		$this->add_control(
            'tp_thumbnail_image',
            [
                'label' => esc_html__( 'Choose Member Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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
	}

    
    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('video_section', 'Section - Style', '.tp-el-section');
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
	if ( !empty($settings['tp_thumbnail_image']['url']) ) {
        $tp_thumbnail_image = !empty($settings['tp_thumbnail_image']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image']['url'];
        $tp_thumbnail_image_alt = get_post_meta($settings["tp_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
    }
?>
<?php if(!empty($settings['tp_video_url'])) : ?>
<div class="tp-video-area">
         <div class="container-fluid gx-0">
            <div class="row gx-0">
               <div class="col-xl-12">
                  <div class="tp-video-breadcrumb p-relative">
					 <?php if(!empty($tp_thumbnail_image)) : ?>
                            <img src="<?php echo esc_url($tp_thumbnail_image); ?>" alt="<?php echo esc_attr($tp_thumbnail_image_alt); ?>">
                        <?php endif; ?>
                     <div class="tp-video-play text-center">
                        <a class="popup-video" href="<?php echo esc_url($settings['tp_video_url']); ?>"><i class="fa-sharp fa-solid fa-play"></i></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
	  <?php endif; ?>

<?php endif;
	}
}

$widgets_manager->register( new TP_Video_Popup() );
