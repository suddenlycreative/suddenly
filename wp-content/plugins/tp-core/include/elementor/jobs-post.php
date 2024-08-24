<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Jobs_Post extends Widget_Base {

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
		return 'tp-jobs-post';
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
		return __( 'Jobs Post', 'tpcore' );
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

        // Blog Query
		$this->tp_query_controls('jobs', 'Jobs');
        
	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('blog_section', 'Section - Style', '.tp-el-section');
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

        /**
         * Setup the post arguments.
        */
        $query_args = TP_Helper::get_query_args('jobs', 'category', $this->get_settings());

        // The Query
        $query = new \WP_Query($query_args);


        $filter_list = $settings['category'];

        ?>

<?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>


<?php else:
	$this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>

<div class="job-area pt-120 pb-120">
	<div class="container">
		<?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
		<div class="row">
			<div class="col-xl-12">
				<div class="job-section-box text-center mb-40">
					<?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
					<h4 class="inner-section-subtitle"><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?></h4>
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

		<?php if ($query->have_posts()) : 
			while ($query->have_posts()) : 
			$query->the_post();
			global $post;
			$job_type = get_post_meta(get_the_ID(), 'tp-job-type');
			$Job_location = get_post_meta(get_the_ID(), 'tp-job-location');
		?>
		<div class="job-post-box">
			<div class="row align-items-center">
				<div class="col-lg-5 col-md-4">
					<div class="job-post-info d-flex justify-content-start align-items-center">
						<div class="job-post-category">
							<span><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></span>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-5">
					<div class="job-post-wrapper d-flex align-items-center">
						<?php if(!empty($job_type[0])) : ?>
						<div class="job-post-time d-flex align-items-center">
							<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M9 16.75C13.2802 16.75 16.75 13.2802 16.75 9C16.75 4.71979 13.2802 1.25 9 1.25C4.71979 1.25 1.25 4.71979 1.25 9C1.25 13.2802 4.71979 16.75 9 16.75Z" stroke="#5F6168" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M9 5.7998V9.9998L11.8 11.3998" stroke="#5F6168" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
							<span><?php echo tp_kses($job_type[0]); ?></span>
						</div>
						<?php endif; ?>
						<?php if(!empty($Job_location[0])) : ?>
						<div class="job-post-location d-flex align-items-center">
							<svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1 7.51463C1 3.9167 4.13401 1 8 1C11.866 1 15 3.9167 15 7.51463C15 11.0844 12.7658 15.2499 9.28007 16.7396C8.46748 17.0868 7.53252 17.0868 6.71993 16.7396C3.23416 15.2499 1 11.0844 1 7.51463Z" stroke="#5F6168" stroke-width="1.5"/>
							<path d="M10 8C10 9.10457 9.10457 10 8 10C6.89543 10 6 9.10457 6 8C6 6.89543 6.89543 6 8 6C9.10457 6 10 6.89543 10 8Z" stroke="#5F6168" stroke-width="1.5"/>
							</svg>
							<span><?php echo tp_kses($Job_location[0]); ?></span>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="job-post-apply-btn text-start text-md-end">
						<a class="tp-btn-inner tp-btn-hover alt-color-orange" href="<?php the_permalink(); ?>"><span><?php echo esc_html__('Apply', 'technix');?></span> <b></b></a>
					</div>
				</div>
				<?php if (!empty($settings['tp_post_content']) && $post->post_content != ''):
					$tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
				?>
				<p><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?></p>
				<?php endif; ?>
			</div>
		</div>
		<?php endwhile; wp_reset_query(); endif; ?>

	</div>
</div>

<?php endif;
	}

}

$widgets_manager->register( new TP_Jobs_Post() );