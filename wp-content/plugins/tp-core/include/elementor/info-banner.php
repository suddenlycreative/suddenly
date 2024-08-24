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
class TP_Info_Banner extends Widget_Base {

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
		return 'info-banner';
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
		return __( 'Info Banner', 'tp-core' );
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
                    'layout-3' => esc_html__('Layout 3', 'tp-core'),
                    'layout-4' => esc_html__('Layout 4', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('info_banner', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // button
        $this->tp_button_render('info_banner', 'Button', ['layout-3', 'layout-4']);        

        // _tp_image
		$this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Thumbnail', 'tp-core'),
            ]
        );
        $this->add_control(
            'tp_image',
            [
                'label' => esc_html__( 'Choose Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'tp_image_2',
            [
                'label' => esc_html__( 'Choose Image 2', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();

        // shape section
        $this->start_controls_section(
            'tp_info_banner_shape',
            [
                'label' => esc_html__( 'Shape', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-3']
                ]
            ]
        );

        $this->add_control(
            'tp_info_banner_shape_switch',
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
                    'tp_info_banner_shape_switch' => 'yes'
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
                    'tp_info_banner_shape_switch' => 'yes',
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );

        $this->add_control(
            'tp_shape_image_3',
            [
                'label' => esc_html__( 'Choose Shape Image 3     ', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_info_banner_shape_switch' => 'yes',
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'condition' => [
                    'tp_info_banner_shape_switch' => 'yes',
                ]
            ]
        );
        $this->end_controls_section();

        // animation section
        $this->start_controls_section(
            'tp_section_animation',
                [
                'label' => esc_html__( 'Section Animation', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
        );
        // creative animation
        $this->add_control(
			'tp_creative_anima_switcher',
			[
				'label' => esc_html__( 'Active Animation', 'tpcore' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'tpcore   ' ),
				'label_off' => esc_html__( 'No', 'tpcore   ' ),
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

    

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('info_banner_section', 'Section - Style', '.tp-el-section'); 
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
    $bloginfo = get_bloginfo( 'name' );
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_2']['url']) ) {
        $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
        $tp_image_alt_2 = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    $this->add_render_attribute('title_args', 'class', 'tp-payment__title');
?>

<?php if(!empty($settings['tp_creative_anima_switcher'])) : ?>
<div class="tp-payment__item tp-payment__bg-color-3 p-relative tp-el-section z-index wow <?php echo esc_attr($settings['tp_anima_type']); ?>" data-wow-duration="<?php echo esc_attr($settings['tp_anima_dura']); ?>" data-wow-delay="<?php echo esc_attr($settings['tp_anima_delay']); ?>">
<?php else : ?>
<div class="tp-payment__item tp-payment__bg-color-3 p-relative z-index tp-el-section">
<?php endif; ?>
    <?php if(!empty($tp_image)) : ?>
    <div class="tp-payment__shape-9">
        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($tp_image_2)) : ?>
    <div class="tp-payment__shape-11">
        <img src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_alt_2); ?>">
    </div>
    <?php endif; ?>
    <div class="tp-payment__content">

        <?php if ( !empty($settings['tp_info_banner_sub_title']) ) : ?>
        <h4 class="tp-section-subtitle-2"><?php echo tp_kses( $settings['tp_info_banner_sub_title'] ); ?></h4>
        <?php endif; ?>
        <?php
        if ( !empty($settings['tp_info_banner_title' ]) ) :
            printf( '<%1$s %2$s>%3$s</%1$s>',
            tag_escape( $settings['tp_info_banner_title_tag'] ),
            $this->get_render_attribute_string( 'title_args' ),
            tp_kses( $settings['tp_info_banner_title' ] )
            );
        endif;
        ?>
        <?php if ( !empty($settings['tp_info_banner_description']) ) : ?>
        <p><?php echo tp_kses( $settings['tp_info_banner_description'] ); ?></p>
        <?php endif; ?>

    </div>
</div>

<?php elseif ( $settings['tp_design_style']  == 'layout-3' ):
    $bloginfo = get_bloginfo( 'name' );
    // thumbnail image
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_2']['url']) ) {
        $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
        $tp_image_alt_2 = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
    // Link
    if ('2' == $settings['tp_info_banner_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_info_banner_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-el-btn');
    } else {
        if ( ! empty( $settings['tp_info_banner_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_info_banner_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-el-btn');
        }
    }
    $this->add_render_attribute('title_args', 'class', 'tp-payment__title');
?>

<?php if(!empty($settings['tp_creative_anima_switcher'])) : ?>
<div class="tp-payment__item p-relative z-index wow tp-el-section <?php echo esc_attr($settings['tp_anima_type']); ?>" data-wow-duration="<?php echo esc_attr($settings['tp_anima_dura']); ?>" data-wow-delay="<?php echo esc_attr($settings['tp_anima_delay']); ?>">
<?php else : ?>
<div class="tp-payment__item p-relative z-index tp-el-section">
<?php endif; ?>
    <?php if(!empty($tp_shape_image)) : ?>
    <div class="tp-payment__shape-1">
        <img src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
    </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-6">
            <div class="tp-payment__content tp-payment__content-space">
                <?php if ( !empty($settings['tp_info_banner_sub_title']) ) : ?>
                <h4 class="tp-section-subtitle-2"><?php echo tp_kses( $settings['tp_info_banner_sub_title'] ); ?></h4>
                <?php endif; ?>
                <?php
                if ( !empty($settings['tp_info_banner_title' ]) ) :
                    printf( '<%1$s %2$s>%3$s</%1$s>',
                    tag_escape( $settings['tp_info_banner_title_tag'] ),
                    $this->get_render_attribute_string( 'title_args' ),
                    tp_kses( $settings['tp_info_banner_title' ] )
                    );
                endif;
                ?>
                <?php if ( !empty($settings['tp_info_banner_description']) ) : ?>
                <p><?php echo tp_kses( $settings['tp_info_banner_description'] ); ?></p>
                <?php endif; ?>
                <?php if ( !empty($settings['tp_info_banner_btn_text']) ) : ?>
                <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?> ><?php echo tp_kses($settings['tp_info_banner_btn_text']); ?><i class="far fa-arrow-right"></i></a>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <?php if(!empty($tp_image)) : ?>
            <div class="tp-payment__shape-2">
                <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
            </div>
            <?php endif; ?>
            <?php if(!empty($tp_image_2)) : ?>
            <div class="tp-payment__shape-3 d-none d-sm-block">
                <img src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_alt_2); ?>">
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php elseif ( $settings['tp_design_style']  == 'layout-4' ):
    // thumbnail image
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_2']['url']) ) {
        $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
        $tp_image_alt_2 = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    // Link
    if ('2' == $settings['tp_info_banner_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_info_banner_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-white-solid');
    } else {
        if ( ! empty( $settings['tp_info_banner_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_info_banner_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-white-solid');
        }
    }
    $this->add_render_attribute('title_args', 'class', 'tp-service-3-title-sm');
?>

<div class="wow tpfadeLeft" data-wow-duration=".9s" data-wow-delay=".5s">
    <?php if(!empty($settings['tp_creative_anima_switcher'])) : ?>
    <div class="wow <?php echo esc_attr($settings['tp_anima_type']); ?>" data-wow-duration="<?php echo esc_attr($settings['tp_anima_dura']); ?>" data-wow-delay="<?php echo esc_attr($settings['tp_anima_delay']); ?>">
    <?php else : ?>
    <div>
    <?php endif; ?>
        <div class="tp-service-3-item mb-30 p-relative z-index tp-el-section theme-bg-3" >
            <?php if(!empty($tp_image)) : ?>
            <div class="tp-service-3-icon">
                <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
            </div>
            <?php endif; ?>
            <div class="tp-service-3-content">
                <?php if ( !empty($settings['tp_info_banner_sub_title']) ) : ?>
                <span><?php echo tp_kses($settings['tp_info_banner_sub_title']); ?></span>
                <?php endif; ?>
                <?php
                if ( !empty($settings['tp_info_banner_title' ]) ) :
                    printf( '<%1$s %2$s>%3$s</%1$s>',
                    tag_escape( $settings['tp_info_banner_title_tag'] ),
                    $this->get_render_attribute_string( 'title_args' ),
                    tp_kses( $settings['tp_info_banner_title' ] )
                    );
                endif;
                ?>
                <?php if ( !empty($settings['tp_info_banner_description']) ) : ?>
                <p class="tp-text-white"><?php echo tp_kses( $settings['tp_info_banner_description'] ); ?></p>
                <?php endif; ?>
            </div>
            <?php if (!empty($settings['tp_info_banner_btn_text'])) : ?>
            <div class="tp-service-3-btn">
                <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo tp_kses($settings['tp_info_banner_btn_text']); ?></a>
            </div>
            <?php endif; ?>
            <?php if(!empty($tp_image_2)) : ?>
            <div class="tp-service-3-shape">
                <img src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_alt_2); ?>">
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php else:

    $bloginfo = get_bloginfo( 'name' );
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_2']['url']) ) {
        $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
        $tp_image_alt_2 = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
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
    if ( !empty($settings['tp_shape_image_3']['url']) ) {
        $tp_shape_image_3 = !empty($settings['tp_shape_image_3']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_3']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_3']['url'];
        $tp_shape_image_alt_3 = get_post_meta($settings["tp_shape_image_3"]["id"], "_wp_attachment_image_alt", true);
    }

    $this->add_render_attribute('title_args', 'class', 'tp-payment__title');
?>

<?php if(!empty($settings['tp_creative_anima_switcher'])) : ?>
<div class="tp-payment__item tp-payment__bg-color-2 p-relative tp-el-section z-index wow <?php echo esc_attr($settings['tp_anima_type']); ?>" data-wow-duration="<?php echo esc_attr($settings['tp_anima_dura']); ?>" data-wow-delay="<?php echo esc_attr($settings['tp_anima_delay']); ?>">
<?php else : ?>
<div class="tp-payment__item tp-payment__bg-color-2 p-relative tp-el-section z-index ">
<?php endif; ?>
    <?php if(!empty($tp_image)) : ?>
    <div class="tp-payment__shape-4">
        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($tp_image_2)) : ?>
    <div class="tp-payment__shape-5">
        <img src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_alt_2); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($tp_shape_image)) : ?>
    <div class="tp-payment__shape-6">
        <img src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($tp_shape_image_2)) : ?>
    <div class="tp-payment__shape-7">
        <img src="<?php echo esc_url($tp_shape_image_2); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($tp_shape_image_3)) : ?>
    <div class="tp-payment__shape-8">
        <img src="<?php echo esc_url($tp_shape_image_3); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_3); ?>">
    </div>
    <?php endif; ?>
    <div class="tp-payment__content">
        <?php if ( !empty($settings['tp_info_banner_sub_title']) ) : ?>
        <h4 class="tp-section-subtitle-2"><?php echo tp_kses( $settings['tp_info_banner_sub_title'] ); ?></h4>
        <?php endif; ?>
        <?php
        if ( !empty($settings['tp_info_banner_title' ]) ) :
            printf( '<%1$s %2$s>%3$s</%1$s>',
            tag_escape( $settings['tp_info_banner_title_tag'] ),
            $this->get_render_attribute_string( 'title_args' ),
            tp_kses( $settings['tp_info_banner_title' ] )
            );
        endif;
        ?>
        <?php if ( !empty($settings['tp_info_banner_description']) ) : ?>
        <p><?php echo tp_kses( $settings['tp_info_banner_description'] ); ?></p>
        <?php endif; ?>
    </div>
</div>



<?php endif; 
	}
}

$widgets_manager->register( new TP_Info_Banner() );
