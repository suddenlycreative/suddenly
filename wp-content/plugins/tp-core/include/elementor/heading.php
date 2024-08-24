<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Heading extends Widget_Base {

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
		return 'tp-heading';
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
		return __( 'Heading', 'tpcore' );
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

        // title/content
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

		// heading animation
        $this->start_controls_section(
            'tp_animation_section',
            [
                'label' => esc_html__('Animation', 'tp-core')
            ]
        );

		// creative animation
        $this->add_control(
			'tp_creative_anima_switcher',
			[
				'label' => esc_html__( 'Active Animation', 'tpcore' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'tpcore' ),
				'label_off' => esc_html__( 'No', 'tpcore' ),
				'return_value' => 'yes',
				'default' => '0',
                'separator' => 'before',
			]
		);

        $this->add_control(
            'tp_anima_type',
            [
                'label' => __( 'Animation Type', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fadeInUp' => __( 'fadeInUp', 'tpcore' ),
                    'fadeInDown' => __( 'fadeInDown', 'tpcore' ),
                    'fadeInLeft' => __( 'fadeInLeft', 'tpcore' ),
                    'fadeInRight' => __( 'fadeInRight', 'tpcore' ),
                ],
                'default' => 'fadeInUp',
                'frontend_available' => true,
                'style_transfer' => true,
                'condition' => [
                    'tp_creative_anima_switcher' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'tp_anima_dura', [
                'label' => esc_html__('Animation Duration', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('0.3s', 'tpcore'),
                'condition' => [
                    'tp_creative_anima_switcher' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'tp_anima_delay', [
                'label' => esc_html__('Animation Delay', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('0.6s', 'tpcore'),
                'condition' => [
                    'tp_creative_anima_switcher' => 'yes',
                ],
            ]
        );
		
        $this->end_controls_section();


	}

    protected function style_tab_content(){
        $this->tp_section_style_controls('heading_section', 'Section - Style', '.tp-el-section');

        $this->tp_basic_style_controls('heading_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('heading_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('heading_desc', 'Section - Description', '.tp-el-content');
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
	$this->add_render_attribute('title_args', 'class', 'tp-section-title-3 tp-el-title');
?>

<?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
<?php if(!empty($settings['tp_creative_anima_switcher'])) : ?>
<div class="wow tp-el-section <?php echo esc_attr($settings['tp_anima_type']); ?>" data-wow-duration="<?php echo esc_attr($settings['tp_anima_dura']); ?>" data-wow-delay="<?php echo esc_attr($settings['tp_anima_delay']); ?>">
<?php else : ?>
<div class="tp-el-section">
<?php endif; ?>
	<div class="tp-integration-section-box">

		<?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
		<h5 class="tp-integration-subtitle tp-el-subtitle"><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?></h5>
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
		<p class="tp-el-content"><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
		<?php endif; ?>

	</div>
</div>
<?php endif; ?>

<?php elseif ( $settings['tp_design_style']  == 'layout-3' ):
	$this->add_render_attribute('title_args', 'class', 'tp-section-title-4 tp-el-title');
?>

<?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
<?php if(!empty($settings['tp_creative_anima_switcher'])) : ?>
<div class="wow tp-el-section tp-title-anim blue-bg <?php echo esc_attr($settings['tp_anima_type']); ?>" data-wow-duration="<?php echo esc_attr($settings['tp_anima_dura']); ?>" data-wow-delay="<?php echo esc_attr($settings['tp_anima_delay']); ?>">
<?php else : ?>
<div class="tp-el-section blue-bg">
<?php endif; ?>
	<div class="row align-items-end ">
		<div class="col-xl-7 col-lg-6">
			<div class="tp-platform-section-box">
				<?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
				<h5 class="tp-section-subtitle-4 pb-10 tp-el-subtitle"><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?></h5>
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
			</div>
		</div>
		<div class="col-xl-5 col-lg-6  wow tpfadeRight" data-wow-duration=".9s" data-wow-delay=".5s">
			<?php if ( !empty($settings['tp_section_description']) ) : ?>
			<div class="tp-platform-text">
				<p class="tp-el-content"><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php endif; ?>

<?php elseif ( $settings['tp_design_style']  == 'layout-4' ):
	$this->add_render_attribute('title_args', 'class', 'tp-section-title-4 pb-25 tp-el-title');
?>

<?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
<?php if(!empty($settings['tp_creative_anima_switcher'])) : ?>
<div class="tp-price-sction-box blue-bg wow tp-el-section pb-20 tp-title-anim <?php echo esc_attr($settings['tp_anima_type']); ?>" data-wow-duration="<?php echo esc_attr($settings['tp_anima_dura']); ?>" data-wow-delay="<?php echo esc_attr($settings['tp_anima_delay']); ?>">
<?php else : ?>
<div class="tp-price-sction-box text-center pb-20 blue-bg tp-el-section">
<?php endif; ?>
	<?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
	<h5 class="tp-section-subtitle-4 both pb-10 tp-el-subtitle"><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?></h5>
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
	<p class="tp-el-content tp-text-white"><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
	<?php endif; ?>
</div>
<?php endif; ?>

<?php else:
	$this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title');
?>

<?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
<?php if(!empty($settings['tp_creative_anima_switcher'])) : ?>
<div class="wow tp-el-section tp-title-anim <?php echo esc_attr($settings['tp_anima_type']); ?>" data-wow-duration="<?php echo esc_attr($settings['tp_anima_dura']); ?>" data-wow-delay="<?php echo esc_attr($settings['tp_anima_delay']); ?>">
<?php else : ?>
<div class="tp-el-section">
<?php endif; ?>
	<?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
	<h4 class="tp-section-subtitle tp-el-subtitle"><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?></h4>
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
	<p class="tp-el-content"><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
	<?php endif; ?>
</div>
<?php endif; ?>

<?php endif;
	}
}

$widgets_manager->register( new TP_Heading() );
