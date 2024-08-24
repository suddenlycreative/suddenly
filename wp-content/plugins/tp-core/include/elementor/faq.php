<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_FAQ extends Widget_Base {

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
		return 'tp-faq';
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
		return __( 'FAQ', 'tpcore' );
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

		 // tp_section_title
		$this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-1']);


		$this->start_controls_section(
            '_accordion',
            [
                'label' => esc_html__( 'Accordion', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
            'tp_accordion_active_switch',
            [
                'label' => esc_html__( 'Show', 'tp-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tp-core' ),
                'label_off' => esc_html__( 'Hide', 'tp-core' ),
                'return_value' => 'yes',
                'default' => '0',
            ]
        );

        $repeater->add_control(
            'accordion_title', [
                'label' => esc_html__( 'Accordion Item', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'This is accordion item title' , 'tpcore' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'accordion_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Facilis fugiat hic ipsam iusto laudantium libero maiores minima molestiae mollitia repellat rerum sunt ullam voluptates? Perferendis, suscipit.',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'accordions',
            [
                'label' => esc_html__( 'Repeater Accordion', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #1', 'tpcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #2', 'tpcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #3', 'tpcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #4', 'tpcore' ),
                    ],
                ],
                'title_field' => '{{{ accordion_title }}}',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
            'accordion_image_area',
            [
                'label' => esc_html__( 'Accordion Image', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
			'accordion_image',
			[
				'label' => esc_html__('Fag Image', 'tpcore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]

			]
		);

		$this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'default' => 'full',
            ]
        );
		
		$this->end_controls_section();
	}

	protected function style_tab_content(){
		$this->tp_section_style_controls('faq_section', 'Section - Style', '.tp-el-section');
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
	$this->add_render_attribute('title_args', 'class', 'tp-section-title');  
	if ( !empty($settings['accordion_image']['url']) ) {
		$accordion_image = !empty($settings['accordion_image']['id']) ? wp_get_attachment_image_url( $settings['accordion_image']['id'], $settings['thumbnail_size_size']) : $settings['accordion_image']['url'];
		$accordion_image_alt = get_post_meta($settings["accordion_image"]["id"], "_wp_attachment_image_alt", true);
	} 
?>

<section class="tp-support-area tp-support-bg p-relative pb-110">
	<div class="container container-large">
		<div class="tp-support-shape">
		<?php if(!empty($accordion_image)) : ?>
				<img class="shape-1" src="<?php echo esc_url($accordion_image); ?>"
					alt="<?php echo esc_attr($accordion_image_alt); ?>">
			<?php endif; ?>
			<img class="shape-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/support/shape-bg.png" alt="">
		</div>
		<div class="row justify-content-center">
			<div class="col-xxl-8 col-xl-10">
				<div class="tp-support-title-wrapper text-center">
				<?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
					<span class="tp-section-title__pre">
					<?php echo tp_kses( $settings['tp_section_sub_title'] ); ?>
					<svg width="123" height="8" viewBox="0 0 123 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.384401 7.82144C0.645399 4.52972 8.83029 8.38041 10.8974 7.67652C12.4321 7.1486 11.6386 7.03474 12.9749 6.19628C14.0816 4.61253 15.7519 3.89829 17.9756 4.06391C18.6125 4.48831 19.2284 4.93342 19.8444 5.38888C21.1076 6.09277 22.1621 6.51717 23.6028 6.13417C24.8973 5.79258 25.5237 4.79885 26.6095 4.18812C30.8481 1.80732 31.3701 2.90456 34.5855 4.58147C36.0993 5.36817 37.634 6.48612 39.461 6.08242C40.1604 5.92715 40.2127 5.67871 40.672 5.54415C42.1023 4.10531 43.9606 3.52564 46.2469 3.80512C47.0612 4.28129 47.8651 4.75745 48.669 5.25431C50.9866 6.22733 54.5049 6.23769 54.6615 3.08053C54.3065 3.22545 53.962 3.37037 53.6175 3.51529C55.622 5.75117 58.6078 6.59998 61.5205 5.5752C64.8091 4.41585 63.8277 3.02877 67.1685 4.35374C68.6614 4.94377 70.2587 5.14045 71.856 4.96447C73.6412 4.7678 75.1028 3.27721 76.6271 3.07018C79.0491 2.73894 81.3354 4.89201 84.2482 4.15707C85.3235 3.88793 86.9417 2.27313 87.7978 2.21102C88.6329 2.14891 89.9484 3.68091 90.8358 4.14672C93.3936 5.51309 96.5882 5.75117 99.3234 4.7471C101.902 3.80512 100.858 3.60845 103.124 4.30199C104.366 4.67464 105.253 5.34747 106.652 5.45099C109.628 5.65801 112.175 4.26058 113.678 1.77626C113.25 1.77626 112.822 1.77626 112.384 1.77626C114.722 5.49239 119.587 6.10312 122.771 3.05983C123.471 2.39734 122.406 1.34151 121.707 2.00399C119.316 4.29164 115.516 3.95004 113.678 1.03097C113.386 0.554807 112.687 0.544455 112.384 1.03097C110.223 4.62288 105.159 4.84026 102.549 1.7038C102.278 1.38291 101.777 1.46572 101.495 1.7038C97.6113 4.99553 91.8171 4.46761 88.6747 0.368483C88.4242 0.0372403 87.85 -0.190489 87.5159 0.223564C84.9685 3.37037 80.7717 3.86723 77.6606 1.10343C77.3787 0.854995 76.9507 0.823941 76.6584 1.10343C73.422 4.26058 68.6823 4.52972 65.1432 1.63134C64.83 1.37256 64.3706 1.38291 64.1409 1.75556C61.9799 5.40958 57.2297 5.74082 54.4631 2.65613C54.0873 2.24207 53.44 2.59402 53.4191 3.09088C53.2103 7.04509 45.6727 1.72451 43.8979 1.92118C40.4841 2.30418 40.2127 5.74082 35.7026 3.82583C33.4894 2.88386 31.8085 0.989563 29.1777 1.39326C26.9226 1.74521 25.9622 3.86723 23.9682 4.63323C20.4603 5.9789 19.2702 2.13856 16.2531 2.33524C11.2941 2.66648 14.1442 7.41774 6.43955 5.75117C4.22629 5.27501 -0.221114 3.93969 0.00856432 7.82144C0.0190042 8.05952 0.363521 8.05952 0.384401 7.82144Z"
							fill="currentColor" />
					</svg>
					</span>
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

				<div class="tp-support-faq faq-style-1">
					<div class="tp-faq-tab-content tp-accordion">
						<div class="accordion" id="faqaccordion-<?php echo esc_attr($this->get_id()); ?>">

							<?php foreach ( $settings['accordions'] as $index => $item) :

								$collapsed = ($index == '0' ) ? '' : 'collapsed';
								$aria_expanded = ($index == '0' ) ? "true" : "false";
								$show = $item['tp_accordion_active_switch'] ? "show" : "";
								$active = $item['tp_accordion_active_switch'] ? "tp-faq-active" : "";
							?>
							<div class="accordion-item <?php echo esc_attr($active); ?>" >
							
								<h2 class="accordion-header tp-el-box-title" id="faqOne-<?php echo esc_attr($index); ?>">
									<button class="accordion-button <?php echo esc_attr($collapsed); ?>"
									type="button" data-bs-toggle="collapse"
									data-bs-target="#collapseOne-<?php echo esc_attr($index); ?>" aria-expanded="true"
									aria-controls="collapseOne-<?php echo esc_attr($index); ?>">
									<?php echo esc_html($item['accordion_title']); ?>
									</button>
								</h2>
								<div id="collapseOne-<?php echo esc_attr($index); ?>"
								class="accordion-collapse collapse <?php echo esc_attr($show); ?>"
								aria-labelledby="faqOne-<?php echo esc_attr($index); ?>"
								data-bs-parent="#faqaccordion-<?php echo esc_attr($this->get_id()); ?>">
								<div class="accordion-body">
									<p><?php echo tp_kses($item['accordion_description']); ?></p>
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

$widgets_manager->register( new TP_FAQ() );
