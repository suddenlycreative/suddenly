<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Testimonial extends Widget_Base {

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
		return 'tp-testimonial';
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
		return __( 'Testimonial', 'tpcore' );
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
                    'layout-3' => esc_html__('Layout 3', 'tpcore')
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        
        // tp_section_title
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-1','layout-2']);


        // button
        $this->tp_button_render('testi', 'Button', ['layout-4']);

        
        // testi shape
        $this->start_controls_section(
            'tp_testi_shape',
                [
                  'label' => esc_html__( 'Testimonial Shape', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                  'condition' => [
                    'tp_design_style' => ['layout-2']
                  ]
                ]
           );
   
           $this->add_control(
            'tp_testi_shape_switch',
            [
              'label'        => esc_html__( 'Shape On/Off', 'tpcore' ),
              'type'         => \Elementor\Controls_Manager::SWITCHER,
              'label_on'     => esc_html__( 'Show', 'tpcore' ),
              'label_off'    => esc_html__( 'Hide', 'tpcore' ),
              'return_value' => 'yes',
              'default'      => '1',
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
                       'tp_testi_shape_switch' => 'yes'
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
                       'tp_testi_shape_switch' => 'yes'
                   ]
               ]
           );
           $this->add_group_control(
               Group_Control_Image_Size::get_type(),
               [
                   'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                   'exclude' => ['custom'],
                   'condition' => [
                       'tp_testi_shape_switch' => 'yes'
                   ]
               ]
           );
           
           $this->end_controls_section();

        
        // Review group
        $this->start_controls_section(
            'review_list',
            [
                'label' => esc_html__( 'Review List', 'tpcore' ),
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
                    'style_3' => __( 'Style 3', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        //icon image svg

        $repeater->add_control(
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'svg',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
                'condition' => [
                    'repeater_condition' => ['style_1','style_2'],
                ]
            ]
        );
        $repeater->add_control(
            'tp_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_type' => 'svg',
                    'repeater_condition' => ['style_1','style_2'],
                ]
            ]
        );

        $repeater->add_control(
            'tp_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type' => 'image',
                    'repeater_condition' => ['style_1','style_2'],
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                        'repeater_condition' => ['style_1','style_2'],
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_box_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                        'repeater_condition' => ['style_1','style_2'],
                    ]
                ]
            );
        }

        $repeater->add_control(
            'brand_logo',
            [
                'label' => esc_html__('Client Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'repeater_condition' => ['style_1']
                ]

            ]
        );
        $repeater->add_control(
            'review_content',
            [
                'label' => esc_html__( 'Review Content', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => 'Aklima The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections Bonorum et Malorum original.',
                'placeholder' => esc_html__( 'Type your review content here', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'reviewer_name', [
                'label' => esc_html__( 'Reviewer Name', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Rasalina William' , 'tpcore' ),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2']
                ]
            ]
        );

        $repeater->add_control(
            'reviewer_title', [
                'label' => esc_html__( 'Reviewer Title', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '- CEO at YES Germany' , 'tpcore' ),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2']
                ]
            ]
        );

        // rating
        $repeater->add_control(
            'tp_testi_rating',
            [
                'label' => esc_html__('Select Rating Count', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__('Single Star', 'tpcore'),
                    '2' => esc_html__('2 Star', 'tpcore'),
                    '3' => esc_html__('3 Star', 'tpcore'),
                    '4' => esc_html__('4 Star', 'tpcore'),
                    '5' => esc_html__('5 Star', 'tpcore'),
                ],
                'default' => '5',
                'condition' => [
                    'repeater_condition' => ['style_1','style_2', 'style_3', 'style_4']
                ]
            ]
        );


        $this->add_control(
            'reviews_list',
            [
                'label' => esc_html__( 'Review List', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'tpcore' ),
                        'reviewer_title' => esc_html__( 'CEO at YES Germany', 'tpcore' ),
                        'review_content' => esc_html__( 'Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'tpcore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William 2', 'tpcore' ),
                        'reviewer_title' => esc_html__( 'CEO at YES Germany', 'tpcore' ),
                        'review_content' => esc_html__( 'Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'tpcore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William 3', 'tpcore' ),
                        'reviewer_title' => esc_html__( 'CEO at YES Germany', 'tpcore' ),
                        'review_content' => esc_html__( 'Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'tpcore' ),
                    ],

                ],
                'title_field' => '{{{ reviewer_name }}}',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size',
                'default' => 'thumbnail',
                'exclude' => ['custom'],
                'separator' => 'none',
            ]
        );


        $this->end_controls_section();


 
        $this->start_controls_section(
            'tp_clints_image',
            [
                'label' => esc_html__( 'Clints Image', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT, 
                'condition' => [
                    'tp_design_style' => ['layout-3']
                  ]
    
            ]
        );
    
            $this->add_control(
                'brand_logo_01',
                [
                    'label' => esc_html__('Client Image', 'tpcore'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ]
    
                ]
            );
    
            $this->add_control(
                'brand_logo_02',
                [
                    'label' => esc_html__('Client Image 02', 'tpcore'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ]
    
                ]
            );
    
            $this->add_control(
                'brand_logo_03',
                [
                    'label' => esc_html__('Client Image 03', 'tpcore'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ]
    
                ]
            );
    
            $this->end_controls_section();


	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('testimonial_section', 'Section Style', '.ele-section');
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

<!--	testimonial style 3 -->
<?php if ( $settings['tp_design_style']  == 'layout-3' ):
    $this->add_render_attribute('title_args', 'class', 'feature-title');   

    if ( !empty($settings['brand_logo_01']['url']) ) {
        $brand_logo_01 = !empty($settings['brand_logo_01']['id']) ? wp_get_attachment_image_url( $settings['brand_logo_01']['id']) : $settings['brand_logo_01']['url'];
        $brand_logo_01_alt = get_post_meta($settings["brand_logo_01"]["id"], "_wp_attachment_image_alt", true);
    } 

    if ( !empty($settings['brand_logo_02']['url']) ) {
        $brand_logo_02 = !empty($settings['brand_logo_02']['id']) ? wp_get_attachment_image_url( $settings['brand_logo_02']['id']) : $settings['brand_logo_02']['url'];
        $brand_logo_02_alt = get_post_meta($settings["brand_logo_02"]["id"], "_wp_attachment_image_alt", true);
    } 
    if ( !empty($settings['brand_logo_03']['url']) ) {
        $brand_logo_03 = !empty($settings['brand_logo_03']['id']) ? wp_get_attachment_image_url( $settings['brand_logo_03']['id']) : $settings['brand_logo_03']['url'];
        $brand_logo_03_alt = get_post_meta($settings["brand_logo_03"]["id"], "_wp_attachment_image_alt", true);
    } 

?>
<section class="tp-testimonial-2-area p-relative pt-150 pb-120">
            <div class="tp-testimonial-2-shape">
               <img class="shape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/shape-blur.png" alt="">
               <?php if(!empty($brand_logo_01)) : ?>
                    <img class="shape-2" src="<?php echo esc_url($brand_logo_01); ?>"
                        alt="<?php echo esc_attr($brand_logo_01_alt); ?>">
                <?php endif; ?>

               <?php if(!empty($brand_logo_02)) : ?>
                    <img class="shape-3" src="<?php echo esc_url($brand_logo_02); ?>"
                        alt="<?php echo esc_attr($brand_logo_02_alt); ?>">
                <?php endif; ?>

               <?php if(!empty($brand_logo_03)) : ?>
                    <img class="shape-4" src="<?php echo esc_url($brand_logo_03); ?>"
                        alt="<?php echo esc_attr($brand_logo_03_alt); ?>">
                <?php endif; ?>
               <img class="shape-5" src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/shape-blur.png" alt="">
            </div>
            <div class="tp-testimonial-2-np">
               <span class="prev"></span>
               <span class="next"></span>
            </div>
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-lg-8">
                     <div class="circle-animation business">
                        <div class="circle-animation business-2">
                           <span class="tp-circle-8"></span>
                           <span class="tp-circle-6"></span>
                        <div class="circle-animation business-3">
                           <span class="tp-circle-7"></span>
                        </div>
                        <div class="circle-animation business-4">
                           <span class="tp-circle-5"></span>
                        </div>
                        </div>
                     </div>
                     <div class="testimonial-2-active swiper-container">
                        <div class="swiper-wrapper">
                        <?php foreach ($settings['reviews_list'] as $index => $item) :
                                
                                if ( !empty($item['brand_logo']['url']) ) {
                                    $tp_brand_logo = !empty($item['brand_logo']['id']) ? wp_get_attachment_image_url( $item['brand_logo']['id'], $settings['thumbnail_size_size']) : $item['brand_logo']['url'];
                                    $tp_brand_logo_alt = get_post_meta($item["brand_logo"]["id"], "_wp_attachment_image_alt", true);
                                }
                                ?>
                           <div class="swiper-slide">
                              <div class="testimonial-item">
                                 <div class="tp-testimonial-2-content">
                                 <div class="tp-testimonial-2-thumb text-center">
                                 <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                    <?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?>
                                    <?php endif; ?>
                                    <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                                    <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                    <img src="<?php echo $item['tp_box_icon_image']['url']; ?>"
                                        alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>
                                    <?php else : ?>
                                    <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                    <?php echo $item['tp_box_icon_svg']; ?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    </div>

                                    <div class="tp-testimonial-2-info">
                                       <?php if(!empty($item['reviewer_name']) ) : ?>
                                                <h4 class="tp-testimonial-2-info-title text-center"><?php echo tp_kses($item['reviewer_name']); ?></h4>
                                            <?php endif; ?>
                                        
                                        <?php if(!empty($item['reviewer_title'])) : ?>
                                            <p class="tp-testimonial-2-info-designation text-center"><?php echo tp_kses($item['reviewer_title']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="tp-testimonial-2-text text-center">
                                        <?php if ( !empty($item['review_content']) ) : ?>
                                        <p>"<?php echo tp_kses($item['review_content']); ?>"</p>
                                        <?php endif; ?>
                                     </div>
                                    
                                 </div>
                              </div>
                           </div>
                           <?php endforeach; ?>
                        </div>
                     </div>
                     <div class="tp-testimonial-2-nav d-none d-lg-block">
                        <button type="button" class="testimonial-button-prev-1"><span><svg width="53" height="16" viewBox="0 0 53 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M0.292893 7.6049C-0.0976295 7.99542 -0.0976296 8.62859 0.292892 9.01911L6.65685 15.3831C7.04738 15.7736 7.68054 15.7736 8.07107 15.3831C8.46159 14.9925 8.46159 14.3594 8.07107 13.9689L2.41422 8.312L8.07107 2.65515C8.46159 2.26463 8.46159 1.63146 8.07107 1.24094C7.68054 0.850413 7.04738 0.850413 6.65685 1.24094L0.292893 7.6049ZM53 7.31201L1 7.312L1 9.312L53 9.31201L53 7.31201Z" fill="currentColor"/>
                           </svg>
                           </span></button>
                        <button type="button" class="testimonial-button-next-1"><span><svg width="53" height="16" viewBox="0 0 53 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M52.7071 9.01912C53.0976 8.6286 53.0976 7.99543 52.7071 7.60491L46.3431 1.24095C45.9526 0.850422 45.3195 0.850422 44.9289 1.24095C44.5384 1.63147 44.5384 2.26464 44.9289 2.65516L50.5858 8.31201L44.9289 13.9689C44.5384 14.3594 44.5384 14.9926 44.9289 15.3831C45.3195 15.7736 45.9526 15.7736 46.3431 15.3831L52.7071 9.01912ZM-6.22047e-08 9.31201L52 9.31201L52 7.31201L6.22047e-08 7.31201L-6.22047e-08 9.31201Z" fill="currentColor"/>
                           </svg></span></button>
                     </div>
                  </div>
               </div>
            </div>
         </section>

<!--	testimonial style 2 -->
<?php elseif ( $settings['tp_design_style']  == 'layout-2' ):
    $this->add_render_attribute('title_args', 'class', 'feature-title');   
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    } 

    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_2']['url']) ) {
        $tp_shape_image_2 = !empty($settings['tp_shape_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_2']['url'];
        $tp_shape_image_alt_2 = get_post_meta($settings["tp_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
?>
<section class="tp-feature-3-area pt-100" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/feature/home-3/feature-bg.png">
    <div class="row gx-0">
    <div class="col-xl-12">
        <div class="tp-feature-3-text-style text-center fadeUp">
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
    </div>
</section>
<section class="tp-testimonial-3-area pb-120">
         <div class="tp-testimonial-3-large-box"></div>
         <div class="tp-testimonial-3-shape">
            <img class="shape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/home-3/shape-1.png" alt="">
            <img class="shape-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/home-3/shape-2.png" alt="">
         </div>
         <div class="container">
            <div class="row">
               <div class="col-xl-5 col-lg-4">
                  <div class="tp-testimonial-3-wrapper">
                     <div class="tp-testimonial-3-wrapper-thumb p-relative">
                        <div class="testimonial-navigation-active splide">
                           <div class="splide__track">
                              <div class="splide__list">
                              <?php foreach ($settings['reviews_list'] as $index => $item) :
                                
                                if ( !empty($item['brand_logo']['url']) ) {
                                    $tp_brand_logo = !empty($item['brand_logo']['id']) ? wp_get_attachment_image_url( $item['brand_logo']['id'], $settings['thumbnail_size_size']) : $item['brand_logo']['url'];
                                    $tp_brand_logo_alt = get_post_meta($item["brand_logo"]["id"], "_wp_attachment_image_alt", true);
                                }
                                ?>
                                 
                                    <div class="splide__slide">
                                        <?php if(!empty($tp_brand_logo)) : ?>
                                                <img class="slide" src="<?php echo esc_url($tp_brand_logo); ?>"
                                                    alt="<?php echo esc_attr($tp_brand_logo_alt); ?>">
                                        <?php endif; ?>
                                    </div>
                                 <?php endforeach; ?>
                              </div>
                           </div>
                        </div>
                        <?php if(!empty($tp_shape_image)) : ?>
                            <img class="shape-1" src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
                        <?php endif; ?>

                        <?php if(!empty($tp_shape_image_2)) : ?>
                            <img class="shape-2" src="<?php echo esc_url($tp_shape_image_2); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
               <div class="col-xl-7 col-lg-8">
                  <div class="tp-testimonial-3-content">
                     <div class="testimonial-3-active splide">
                        <div class="splide__track">
                           <div class="splide__list">
                           <?php foreach ($settings['reviews_list'] as $index => $item) :
                                ?>
                              <div class="splide__slide">

                                 <div class="tp-testimonial-3-slider-wrapper">
                                    <?php if ( !empty($item['review_content']) ) : ?>
                                    <p><?php echo tp_kses($item['review_content']); ?></p>
                                    <?php endif; ?>
                                 </div>
                                 <div class="tp-testimonial-3-descreiption text-start text-sm-end">
                                    <?php if(!empty($item['reviewer_name']) ) : ?>
                                            <h4 class="testimonial-title"><?php echo tp_kses($item['reviewer_name']); ?></h4>
                                        <?php endif; ?>
                                    
                                    <?php if(!empty($item['reviewer_title'])) : ?>
                                        <p><?php echo tp_kses($item['reviewer_title']); ?></p>
                                    <?php endif; ?>
                                </div>
                              </div>
                              <?php endforeach; ?>
                           </div>
                        </div>
                     </div>
                    
                  </div>
               </div>
            </div>
         </div>
      </section>

<!-- default style -->
<?php else:
    $this->add_render_attribute('title_args', 'class', 'tp-section-title');   
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }     
?>

<section class="tp-testimonial-area p-relative">
         <div class="container container-large">
            <div class="tp-testimonial-shape">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/shape-1.png" alt="">
            </div>
            <div class="tp-testimonial-bg">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/testimonial-bg.jpg" alt="">
            </div>
            <div class="row">
               <div class="col-lg-12">
               <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
                  <div class="tp-testimonial-title-wrapper text-center">
                    
                    
                    <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                     <span class="tp-section-title__pre">
                     <?php echo tp_kses( $settings['tp_section_sub_title'] ); ?>
                        <svg width="123" height="8" viewBox="0 0 123 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path
                              d="M0.384401 7.82144C0.645399 4.52972 8.83029 8.38041 10.8974 7.67652C12.4321 7.1486 11.6386 7.03474 12.9749 6.19628C14.0816 4.61253 15.7519 3.89829 17.9756 4.06391C18.6125 4.48831 19.2284 4.93342 19.8444 5.38888C21.1076 6.09277 22.1621 6.51717 23.6028 6.13417C24.8973 5.79258 25.5237 4.79885 26.6095 4.18812C30.8481 1.80732 31.3701 2.90456 34.5855 4.58147C36.0993 5.36817 37.634 6.48612 39.461 6.08242C40.1604 5.92715 40.2127 5.67871 40.672 5.54415C42.1023 4.10531 43.9606 3.52564 46.2469 3.80512C47.0612 4.28129 47.8651 4.75745 48.669 5.25431C50.9866 6.22733 54.5049 6.23769 54.6615 3.08053C54.3065 3.22545 53.962 3.37037 53.6175 3.51529C55.622 5.75117 58.6078 6.59998 61.5205 5.5752C64.8091 4.41585 63.8277 3.02877 67.1685 4.35374C68.6614 4.94377 70.2587 5.14045 71.856 4.96447C73.6412 4.7678 75.1028 3.27721 76.6271 3.07018C79.0491 2.73894 81.3354 4.89201 84.2482 4.15707C85.3235 3.88793 86.9417 2.27313 87.7978 2.21102C88.6329 2.14891 89.9484 3.68091 90.8358 4.14672C93.3936 5.51309 96.5882 5.75117 99.3234 4.7471C101.902 3.80512 100.858 3.60845 103.124 4.30199C104.366 4.67464 105.253 5.34747 106.652 5.45099C109.628 5.65801 112.175 4.26058 113.678 1.77626C113.25 1.77626 112.822 1.77626 112.384 1.77626C114.722 5.49239 119.587 6.10312 122.771 3.05983C123.471 2.39734 122.406 1.34151 121.707 2.00399C119.316 4.29164 115.516 3.95004 113.678 1.03097C113.386 0.554807 112.687 0.544455 112.384 1.03097C110.223 4.62288 105.159 4.84026 102.549 1.7038C102.278 1.38291 101.777 1.46572 101.495 1.7038C97.6113 4.99553 91.8171 4.46761 88.6747 0.368483C88.4242 0.0372403 87.85 -0.190489 87.5159 0.223564C84.9685 3.37037 80.7717 3.86723 77.6606 1.10343C77.3787 0.854995 76.9507 0.823941 76.6584 1.10343C73.422 4.26058 68.6823 4.52972 65.1432 1.63134C64.83 1.37256 64.3706 1.38291 64.1409 1.75556C61.9799 5.40958 57.2297 5.74082 54.4631 2.65613C54.0873 2.24207 53.44 2.59402 53.4191 3.09088C53.2103 7.04509 45.6727 1.72451 43.8979 1.92118C40.4841 2.30418 40.2127 5.74082 35.7026 3.82583C33.4894 2.88386 31.8085 0.989563 29.1777 1.39326C26.9226 1.74521 25.9622 3.86723 23.9682 4.63323C20.4603 5.9789 19.2702 2.13856 16.2531 2.33524C11.2941 2.66648 14.1442 7.41774 6.43955 5.75117C4.22629 5.27501 -0.221114 3.93969 0.00856432 7.82144C0.0190042 8.05952 0.363521 8.05952 0.384401 7.82144Z"
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
                  <?php endif; ?>
               </div>
               <div class="tp-testimonial-box-wrapper">
                  <div class="testimonial-active swiper-container">
                     <div class="swiper-wrapper">
                     <?php foreach ($settings['reviews_list'] as $index => $item) : 

                     if ( !empty($item['brand_logo']['url']) ) {
                        $tp_brand_logo = !empty($item['brand_logo']['id']) ? wp_get_attachment_image_url( $item['brand_logo']['id'], $settings['thumbnail_size_size']) : $item['brand_logo']['url'];
                        $tp_brand_logo_alt = get_post_meta($item["brand_logo"]["id"], "_wp_attachment_image_alt", true);
                    }
                    ?>
                        <div class="swiper-slide">
                           <div class="tp-testimonial-item text-center mb-30">
                              <div class="tp-testimonial-item-inner">
                                 <div class="tp-testimonial-quot">
                                    <span>
                                    <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                    <?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?>
                                    <?php endif; ?>
                                    <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                                    <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                    <img src="<?php echo $item['tp_box_icon_image']['url']; ?>"
                                        alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>
                                    <?php else : ?>
                                    <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                    <?php echo $item['tp_box_icon_svg']; ?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                     
                                    </span>
                                 </div>
                                <?php if ( !empty($item['review_content']) ) : ?>
                                    <p><?php echo tp_kses($item['review_content']); ?></p>
                                <?php endif; ?>
                                

                                 <div class="tp-testimonial-rating d-flex justify-content-center">
                                   
                                 <?php
                                    $tp_rating = $item['tp_testi_rating'];
                                    for($i=1; $i<=$tp_rating; $i++) :
                                    ?>
                                    <span>
                                       <i class="fa-solid fa-star-sharp"></i>
                                    </span>
                                    <?php endfor; ?>
                                        
                                 </div>
                                 
                              </div>
                              
                              <?php if(!empty($tp_brand_logo)) : ?>
                                <div class="tp-testimonial-user-thumb">
                                    <img src="<?php echo esc_url($tp_brand_logo); ?>"
                                        alt="<?php echo esc_attr($tp_brand_logo_alt); ?>">
                                </div>
                                <?php endif; ?>

                              <div class="tp-testimonial-designation">
                                 <?php if(!empty($item['reviewer_name']) ) : ?>
                                        <h4 class="testimonial-title"><?php echo tp_kses($item['reviewer_name']); ?></h4>
                                    <?php endif; ?>
                                    <?php if(!empty($item['reviewer_title'])) : ?>
                                 <p><?php echo tp_kses($item['reviewer_title']); ?></p>
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
      </section>
<?php endif; 
	}
}

$widgets_manager->register( new TP_Testimonial() );