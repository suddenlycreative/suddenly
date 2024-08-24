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
class TP_Blog_Post extends Widget_Base {

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
		return 'tp-blog-post';
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
		return __( 'Blog Post', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

		
        // title/content
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', ['layout-1', 'layout-2', 'layout-3'] );

        // Blog Query
		$this->tp_query_controls('blog', 'Blog');

		
        // blog shape
        $this->start_controls_section(
		'tp_blog_shape',
			[
				'label' => esc_html__( 'Blog Shape', 'tpcore' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
				'tp_design_style' => ['layout-2', 'layout-3']
				]
			]
		);

		$this->add_control(
		'tp_blog_shape_switch',
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
					'tp_blog_shape_switch' => 'yes'
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
					'tp_blog_shape_switch' => 'yes',
					'tp_design_style' => 'layout-3'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => ['custom'],
				'condition' => [
					'tp_blog_shape_switch' => 'yes'
				],
				'default' => 'full'
			]
		);
		
		$this->end_controls_section();

        // section column
        $this->tp_columns('col', ['layout-1', 'layout-2', 'layout-3']);
        
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
        $query_args = TP_Helper::get_query_args('post', 'category', $this->get_settings());

        // The Query
        $query = new \WP_Query($query_args);


        $filter_list = $settings['category'];

        ?>

<?php if ( $settings['tp_design_style']  == 'layout-2' ): 
    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
	$this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>

<section class="tp-blog-2-area p-relative pt-120">
	<?php if(!empty($tp_shape_image)) : ?>
	<div class="tp-blog-2-shape">
		<div class="shape-1">
			<img src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
		</div>
	</div>
	<?php endif; ?>
	<div class="container">
		<div class="row">
			<?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
			<div class="col-lg-12">
				<div class="row align-items-center">
					<div class="col-lg-6">
						<div class="tp-blog-2-title-wrapper">
							<?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
							<span class="tp-section-title__pre">
								<?php echo tp_kses( $settings['tp_section_sub_title'] ); ?>
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
					</div>
					<div class="col-lg-6">
						<?php if ( !empty($settings['tp_section_description']) ) : ?>
						<div class="tp-blog-text justify-content-start justify-content-lg-end d-flex">
							<p><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<?php if ($query->have_posts()) : 
				$i = 0;
				while ($query->have_posts()) : 
				$query->the_post();
				global $post;
				$categories = get_the_category($post->ID);
				$i++;
			?>
			<div class="col-lg-4 col-md-6">
				<div class="tp-blog-2-wrapper mb-30">
					<?php if(has_post_thumbnail()) : ?>
					<div class="tp-blog-2-thumb">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
						<div class="tp-blog-2-tag-name">
							<p><?php echo esc_html__('By:', 'tpcore'); ?> <?php the_author(); ?></p>
						</div>
					</div>
					<?php endif; ?>
					<div class="tp-blog-2-content">
						<div class="tp-blog-2-details">
							<div class="tp-blog-date">
								<span><i class="fa-light fa-calendar-days"></i> <?php the_time( get_option('date_format') ); ?> </span>
								<span>-</span>
								<span><i class="fa-sharp fa-solid fa-comments"></i> <?php comments_number();?></span>
							</div>
						</div>
						<h3 class="tp-blog-2-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a></h3>
						<?php if (!empty($settings['tp_post_content'])):
							$tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
						?>
						<p><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?></p>
						<?php endif; ?>
						<?php if(!empty($settings['tp_post_button'])) : ?>
						<div class="tp-blog-2-btn">
							<div class="read-more p-relative">
								<a href="<?php the_permalink(); ?>"><?php echo tp_kses($settings['tp_post_button']); ?> <span><i class="fa-regular fa-arrow-right"></i></span></a>
							</div>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php endwhile; wp_reset_query(); endif; ?>

		</div>
	</div>
</section>

<?php elseif ( $settings['tp_design_style']  == 'layout-3' ) : 
    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_2']['url']) ) {
        $tp_shape_image_2 = !empty($settings['tp_shape_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_2']['url'];
        $tp_shape_image_alt_2 = get_post_meta($settings["tp_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
	$this->add_render_attribute('title_args', 'class', 'tp-section-title');	
?>

<section class="tp-blog-3-area p-relative fix pt-100 pb-90 tp-el-section">
	<div class="tp-blog-3-shape">
		<?php if(!empty($tp_shape_image)) : ?>
		<img class="shape-1" src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
		<?php endif; ?>
		<?php if(!empty($tp_shape_image_2)) : ?>
		<img class="shape-2" src="<?php echo esc_url($tp_shape_image_2); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
		<?php endif; ?>
	</div>
	<div class="container">
		<div class="row">
			<?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
			<div class="col-xl-12">
				<div class="tp-blog-3-title-wrapper text-center">
					<?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
					<span class="tp-section-title__pre">
						<?php echo tp_kses( $settings['tp_section_sub_title'] ); ?>
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
					<?php if ( !empty($settings['tp_section_description']) ) : ?>
					<p><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
			
			<?php if ($query->have_posts()) : 
				$i = 0;
				while ($query->have_posts()) : 
				$query->the_post();
				global $post;
				$categories = get_the_category($post->ID);
				$i++;
				$post_author_id = get_post_field('post_author', get_the_ID());
				$avatar_image = get_avatar($post_author_id, 150);
			?>
			<div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
				<div class="tp-blog-3-wrapper mb-30 OneByOne">
					<?php if ( has_post_thumbnail() ): ?>
					<div class="tp-blog-3-thumb">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $post->ID );?></a>
						<div class="tp-blog-3-user active">
							<?php echo $avatar_image; ?>
							<p><?php echo esc_html__('By:', 'technix'); ?><?php the_author(); ?></p>
						</div>
					</div>
					<?php endif; ?>
					<div class="tp-blog-3-content">
						<div class="tp-blog-date">
							<span><i class="fa-light fa-calendar-days"></i> <?php the_time( get_option('date_format') ); ?> </span>
							<span>-</span>
							<span><i class="fa-sharp fa-solid fa-comments"></i> <?php comments_number();?></span>
						</div>
						<h3 class="tp-blog-3-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a></h3>
						<?php if (!empty($settings['tp_post_content'])):
							$tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
						?>
						<p><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?></p>
						<?php endif; ?>
					</div>
					<?php if(!empty($settings['tp_post_button'])) : ?>
					<div class="tp-blog-3-btn d-flex justify-content-between">
						<div class="read-more p-relative">
							<a href="<?php the_permalink(); ?>"><?php echo tp_kses($settings['tp_post_button']); ?> <span><svg width="21" height="19" viewBox="0 0 21 19" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M16.1658 4.7457L4.64685 14.7646C4.31796 15.0507 3.88211 15.0938 3.67396 14.8608C3.46581 14.6278 3.5638 14.2066 3.89268 13.9205L15.4116 3.90159C15.7405 3.61553 16.1764 3.57245 16.3845 3.80542C16.5927 4.0384 16.4947 4.45964 16.1658 4.7457Z" fill="currentColor"/>
								<path d="M16.7227 9.69055C16.5861 9.80933 16.4034 9.87621 16.2062 9.86208C15.8118 9.83504 15.5102 9.49748 15.5324 9.10795L15.7964 4.49597L11.1258 4.17577C10.7314 4.14873 10.4297 3.81104 10.452 3.42164C10.4744 3.03214 10.8121 2.7384 11.2065 2.76543L16.5904 3.13466C16.9848 3.16169 17.2864 3.49926 17.2641 3.88865L16.9599 9.20509C16.9494 9.40129 16.8593 9.57176 16.7227 9.69055Z" fill="currentColor"/>
								</svg></span></a>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<?php endwhile; wp_reset_query(); endif; ?>

		</div>
	</div>
</section>


<?php else : 
	$this->add_render_attribute('title_args', 'class', 'tp-section-title');	
?>

<section class="tp-blog-area pt-80 pb-60">
	<div class="container container-large">
		<div class="row">

			<?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
			<div class="col-lg-12">
				<div class="row align-items-center">
					<div class="col-lg-6">
						<div class="tp-blog-title-wrapper">

							<?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
							<span class="tp-section-title__pre">
								<?php echo tp_kses( $settings['tp_section_sub_title'] ); ?>
								<svg width="123" height="8" viewBox="0 0 123 8" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M0.384401 7.82144C0.645399 4.52972 8.83029 8.38041 10.8974 7.67652C12.4321 7.1486 11.6386 7.03474 12.9749 6.19628C14.0816 4.61253 15.7519 3.89829 17.9756 4.06391C18.6125 4.48831 19.2284 4.93342 19.8444 5.38888C21.1076 6.09277 22.1621 6.51717 23.6028 6.13417C24.8973 5.79258 25.5237 4.79885 26.6095 4.18812C30.8481 1.80732 31.3701 2.90456 34.5855 4.58147C36.0993 5.36817 37.634 6.48612 39.461 6.08242C40.1604 5.92715 40.2127 5.67871 40.672 5.54415C42.1023 4.10531 43.9606 3.52564 46.2469 3.80512C47.0612 4.28129 47.8651 4.75745 48.669 5.25431C50.9866 6.22733 54.5049 6.23769 54.6615 3.08053C54.3065 3.22545 53.962 3.37037 53.6175 3.51529C55.622 5.75117 58.6078 6.59998 61.5205 5.5752C64.8091 4.41585 63.8277 3.02877 67.1685 4.35374C68.6614 4.94377 70.2587 5.14045 71.856 4.96447C73.6412 4.7678 75.1028 3.27721 76.6271 3.07018C79.0491 2.73894 81.3354 4.89201 84.2482 4.15707C85.3235 3.88793 86.9417 2.27313 87.7978 2.21102C88.6329 2.14891 89.9484 3.68091 90.8358 4.14672C93.3936 5.51309 96.5882 5.75117 99.3234 4.7471C101.902 3.80512 100.858 3.60845 103.124 4.30199C104.366 4.67464 105.253 5.34747 106.652 5.45099C109.628 5.65801 112.175 4.26058 113.678 1.77626C113.25 1.77626 112.822 1.77626 112.384 1.77626C114.722 5.49239 119.587 6.10312 122.771 3.05983C123.471 2.39734 122.406 1.34151 121.707 2.00399C119.316 4.29164 115.516 3.95004 113.678 1.03097C113.386 0.554807 112.687 0.544455 112.384 1.03097C110.223 4.62288 105.159 4.84026 102.549 1.7038C102.278 1.38291 101.777 1.46572 101.495 1.7038C97.6113 4.99553 91.8171 4.46761 88.6747 0.368483C88.4242 0.0372403 87.85 -0.190489 87.5159 0.223564C84.9685 3.37037 80.7717 3.86723 77.6606 1.10343C77.3787 0.854995 76.9507 0.823941 76.6584 1.10343C73.422 4.26058 68.6823 4.52972 65.1432 1.63134C64.83 1.37256 64.3706 1.38291 64.1409 1.75556C61.9799 5.40958 57.2297 5.74082 54.4631 2.65613C54.0873 2.24207 53.44 2.59402 53.4191 3.09088C53.2103 7.04509 45.6727 1.72451 43.8979 1.92118C40.4841 2.30418 40.2127 5.74082 35.7026 3.82583C33.4894 2.88386 31.8085 0.989563 29.1777 1.39326C26.9226 1.74521 25.9622 3.86723 23.9682 4.63323C20.4603 5.9789 19.2702 2.13856 16.2531 2.33524C11.2941 2.66648 14.1442 7.41774 6.43955 5.75117C4.22629 5.27501 -0.221114 3.93969 0.00856432 7.82144C0.0190042 8.05952 0.363521 8.05952 0.384401 7.82144Z" fill="currentColor"/>
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
					</div>
					<div class="col-lg-6">
						<?php if ( !empty($settings['tp_section_description']) ) : ?>
						<div class="tp-blog-text justify-content-start justify-content-lg-end d-flex">
							<p><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<?php if ($query->have_posts()) : 
				$i = 0;
				while ($query->have_posts()) : 
				$query->the_post();
				global $post;
				$categories = get_the_category($post->ID);
				$i++;
			?>
			<div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
				<div class="tp-blog-wrapper mb-30">
					<?php if ( has_post_thumbnail() ): ?>
					<div class="tp-blog-thumb">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $post->ID );?></a>
						<?php if(!empty($categories[0]->name)) : ?>
						<div class="tp-blog-tag">
							<p><?php echo esc_html($categories[0]->name); ?></p>
						</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<div class="tp-blog-content">
						<div class="tp-blog-details ">
							<div class="tp-blog-date">
								<span><i class="fa-light fa-calendar-days"></i> <?php the_time( get_option('date_format') ); ?> </span>
								<span>-</span>
								<span><i class="fa-sharp fa-solid fa-comments"></i> <?php comments_number();?></span>
							</div>
						</div>
						<h3 class="tp-blog-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a></h3>
						<?php if (!empty($settings['tp_post_content'])):
							$tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
						?>
						<p><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?></p>
						<?php endif; ?>
						<?php if(!empty($settings['tp_post_button'])) : ?>
						<div class="tp-blog-btn d-flex justify-content-between">
							<div class="read-more p-relative">
								<a href="<?php the_permalink(); ?>"><?php echo tp_kses($settings['tp_post_button']); ?> <span><svg width="39" height="8" viewBox="0 0 39 8" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M38.141 4.13651C38.3362 3.94125 38.3362 3.62466 38.141 3.4294L34.959 0.247422C34.7637 0.05216 34.4471 0.05216 34.2519 0.247422C34.0566 0.442684 34.0566 0.759267 34.2519 0.954529L37.0803 3.78296L34.2519 6.61138C34.0566 6.80665 34.0566 7.12323 34.2519 7.31849C34.4471 7.51375 34.7637 7.51375 34.959 7.31849L38.141 4.13651ZM0.945313 4.28296L37.7874 4.28296L37.7874 3.28296L0.945312 3.28296L0.945313 4.28296Z" fill="currentColor"/>
								</svg></span>
								</a>
							</div>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php endwhile; wp_reset_query(); endif; ?>

		</div>
	</div>
</section>

<?php endif;
	}

}

$widgets_manager->register( new TP_Blog_Post() );