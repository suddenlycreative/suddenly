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
class TP_Social extends Widget_Base {

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
        return 'tp-social';
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
        return __( 'Social', 'tpcore' );
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

    protected static function get_profile_names()
    {
        return [
            '500px' => esc_html__('500px', 'tpcore'),
            'apple' => esc_html__('Apple', 'tpcore'),
            'behance' => esc_html__('Behance', 'tpcore'),
            'bitbucket' => esc_html__('BitBucket', 'tpcore'),
            'codepen' => esc_html__('CodePen', 'tpcore'),
            'delicious' => esc_html__('Delicious', 'tpcore'),
            'deviantart' => esc_html__('DeviantArt', 'tpcore'),
            'digg' => esc_html__('Digg', 'tpcore'),
            'dribbble' => esc_html__('Dribbble', 'tpcore'),
            'email' => esc_html__('Email', 'tpcore'),
            'facebook-f' => esc_html__('Facebook', 'tpcore'),
            'flickr' => esc_html__('Flicker', 'tpcore'),
            'foursquare' => esc_html__('FourSquare', 'tpcore'),
            'github' => esc_html__('Github', 'tpcore'),
            'houzz' => esc_html__('Houzz', 'tpcore'),
            'instagram' => esc_html__('Instagram', 'tpcore'),
            'jsfiddle' => esc_html__('JS Fiddle', 'tpcore'),
            'linkedin-in' => esc_html__('LinkedIn', 'tpcore'),
            'medium' => esc_html__('Medium', 'tpcore'),
            'pinterest' => esc_html__('Pinterest', 'tpcore'),
            'product-hunt' => esc_html__('Product Hunt', 'tpcore'),
            'reddit' => esc_html__('Reddit', 'tpcore'),
            'slideshare' => esc_html__('Slide Share', 'tpcore'),
            'snapchat' => esc_html__('Snapchat', 'tpcore'),
            'soundcloud' => esc_html__('SoundCloud', 'tpcore'),
            'spotify' => esc_html__('Spotify', 'tpcore'),
            'stack-overflow' => esc_html__('StackOverflow', 'tpcore'),
            'tripadvisor' => esc_html__('TripAdvisor', 'tpcore'),
            'tumblr' => esc_html__('Tumblr', 'tpcore'),
            'twitch' => esc_html__('Twitch', 'tpcore'),
            'twitter' => esc_html__('Twitter', 'tpcore'),
            'vimeo' => esc_html__('Vimeo', 'tpcore'),
            'vk' => esc_html__('VK', 'tpcore'),
            'website' => esc_html__('Website', 'tpcore'),
            'whatsapp' => esc_html__('WhatsApp', 'tpcore'),
            'wordpress' => esc_html__('WordPress', 'tpcore'),
            'xing' => esc_html__('Xing', 'tpcore'),
            'yelp' => esc_html__('Yelp', 'tpcore'),
            'youtube' => esc_html__('YouTube', 'tpcore'),
        ];
    }



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

        $this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__('Social Profiles', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_section_subtitle', [
                'label' => esc_html__('Section Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Sub Title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => 'layout-4'
                ]
            ]
        );

        $this->add_control(
            'tp_section_title', [
                'label' => esc_html__('Section Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Share it.', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => ['layout-2', 'layout-3', 'layout-4']
                ]
            ]
        );

        $this->add_control(
            'tp_section_des', [
                'label' => esc_html__('Section Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('While we are good with smoke signals, there are easier ways to get in touch.', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => 'layout-4'
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'tpcore' ),
                    'style_2' => __( 'Style 2', 'tpcore' ),
                    'style_3' => __( 'Style 3', 'tpcore' ),
                    'style_4' => __( 'Style 4', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Profile Name', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'select2options' => [
                    'allowClear' => false,
                ],
                'options' => self::get_profile_names()
            ]
        );

        $repeater->add_control(
            'link', [
                'label' => esc_html__('Profile Link', 'tpcore'),
                'placeholder' => esc_html__('Add your profile link', 'tpcore'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'autocomplete' => false,
                'show_external' => false,
                'condition' => [
                    'name!' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        // repeater style
        $repeater->add_control(
			'tp_rep_style_switcher',
			[
				'label' => esc_html__( 'Active Style', 'tpcore' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'tpcore   ' ),
				'label_off' => esc_html__( 'No', 'tpcore   ' ),
				'return_value' => 'yes',
				'default' => '0',
                'separator' => 'before',
                'condition' => [
                    'repeater_condition' => 'style_1'
                ]
			]
		);
        
        // Normal/hover tab start
        $repeater->start_controls_tabs(
            'tp_rep_style_tabs',
            [
                'condition' => [
                    'tp_rep_style_switcher' => 'yes',
                    'repeater_condition' => 'style_1'
                ]
            ]
        );

        // normal tab start
        $repeater->start_controls_tab(
            'tp_normal_style', 
            [
                'label' => esc_html__('Normal', 'tp-core')
            ]
        );

        $repeater->add_control(
            'tp_icon_color',
            [
                'label' => esc_html__('Icon Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'tp_rep_style_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_icon_bg_color',
            [
                'label' => esc_html__('Icon Background Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'tp_rep_style_switcher' => 'yes',
                ]
            ]
        );

        $repeater->end_controls_tab();
        // normal tab end

        // hover tab start
        $repeater->start_controls_tab(
            'tp_btn_hover', 
            [
                'label' => esc_html__('Hover', 'tp-core')
            ]
        );

        $repeater->add_control(
            'tp_icon_hover_color',
            [
                'label' => esc_html__('Icon Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'tp_rep_style_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_icon_hover_bg_color',
            [
                'label' => esc_html__('Icon Background Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'tp_rep_style_switcher' => 'yes',
                ]
            ]
        );
        $repeater->end_controls_tab();
        // hover tab end

        $repeater->end_controls_tabs();
        
        // normal/hover tab end

        $this->add_control(
            'profiles',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
                'default' => [
                    [
                        'link' => ['url' => 'https://facebook.com/'],
                        'name' => 'facebook-f'
                    ],
                    [
                        'link' => ['url' => 'https://twitter.com/'],
                        'name' => 'twitter'
                    ],
                    [
                        'link' => ['url' => 'https://instagram.com/'],
                        'name' => 'instagram'
                    ],
                    [
                        'link' => ['url' => 'https://linkedin.com/'],
                        'name' => 'linkedin-in'
                    ]
                ],
            ]
        );

        
        $this->add_responsive_control(
            'tp_align',
            [
                'label' => esc_html__('Alignment', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'tpcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'tpcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'tpcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        
        // thumbnail image
        $this->start_controls_section(
        'tp_thumbnail_section',
            [
                'label' => esc_html__( 'Thumbnail', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-4'
                ]
            ]
        );

        $this->add_control(
            'tp_thumbnail_image',
            [
                'label' => esc_html__( 'Choose Thumbnail Image', 'tp-core' ),
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

    protected function style_tab_content() {
        $this->tp_link_controls_style('slider_social_link', 'Slider Social - Link', '.tp-el-social-link');
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

<!-- style 2 -->
<?php if ( $settings['tp_design_style'] === 'layout-2' ): ?>

<div class="sv-details-social-box mb-30">
    <?php if(!empty($settings['tp_section_title'])) : ?>
    <h4 class="sv-details-title-sm"><?php echo tp_kses($settings['tp_section_title']); ?></h4>
    <?php endif; ?>
    <div class="sv-details-social-link">
        <?php
            foreach ($settings['profiles'] as $key => $profile) :
                $key = $key+1;
                $icon = $profile['name'];
                $url = esc_url($profile['link']['url']);
                
                printf('<a target="_blank" rel="noopener"  href="%s" class=" elementor-repeater-item-%s"><i class="fab fa-%s" aria-hidden="true"></i></a>',
                    $url,
                    esc_attr($profile['_id']),
                    esc_attr($icon)
                );
            endforeach; 
        ?>
    </div>
</div>

<!-- style 3 -->
<?php elseif ( $settings['tp_design_style'] === 'layout-3' ): ?>

<div class="pd-details-social-box p-relative">
    <?php if(!empty($settings['tp_section_title'])) : ?>
    <div class="pd-details-social-title">
        <span><?php echo tp_kses($settings['tp_section_title']); ?></span>
    </div>
    <?php endif; ?>
    <div class="pd-details-social">
        <?php
            foreach ($settings['profiles'] as $key => $profile) :
                $key = $key+1;
                $icon = $profile['name'];
                $url = esc_url($profile['link']['url']);
                
                printf('<a target="_blank" rel="noopener"  href="%s" class=" elementor-repeater-item-%s"><i class="fab fa-%s" aria-hidden="true"></i></a>',
                    $url,
                    esc_attr($profile['_id']),
                    esc_attr($icon)
                );
            endforeach; 
        ?>
    </div>
</div>

<!-- style 4 -->
<?php elseif ( $settings['tp_design_style'] === 'layout-4' ): 
    // thumbnail image
    if ( !empty($settings['tp_thumbnail_image']['url']) ) {
        $tp_thumbnail_image = !empty($settings['tp_thumbnail_image']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image']['url'];
        $tp_thumbnail_image_alt = get_post_meta($settings["tp_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
    }
?>
    
<div class="contact-form-left">
    <div class="contact-form-section-box pb-80">
        <?php if(!empty($settings['tp_section_subtitle'])) : ?>
        <h5 class="inner-section-subtitle"><?php echo tp_kses($settings['tp_section_subtitle']); ?></h5>
        <?php endif; ?>
        <?php if(!empty($settings['tp_section_title'])) : ?>
        <h4 class="tp-section-title pb-10"><?php echo tp_kses($settings['tp_section_title']); ?></h4>
        <?php endif; ?>
        <?php if(!empty($settings['tp_section_des'])) : ?>
        <p><?php echo tp_kses($settings['tp_section_des']); ?></p>
        <?php endif; ?>
    </div>
    <div class="contact-form-social-box p-relative">
        <div class="contact-form-social-item">
            <?php
                foreach ($settings['profiles'] as $key => $profile) :
                    $key = $key+1;
                    $icon = $profile['name'];
                    $url = esc_url($profile['link']['url']);
                    
                    printf('<a target="_blank" rel="noopener"  href="%s" class="social-'.$key.' elementor-repeater-item-%s"><i class="fab fa-%s" aria-hidden="true"></i></a>',
                        $url,
                        esc_attr($profile['_id']),
                        esc_attr($icon)
                    );
                endforeach; 
            ?>
        </div>
        <?php if(!empty($tp_thumbnail_image)) : ?>
        <div class="contact-form-section-img">
            <img src="<?php echo esc_url($tp_thumbnail_image); ?>" alt="<?php echo esc_attr($tp_thumbnail_image_alt); ?>">
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- style default -->
<?php else : ?>

<div class="career-details-social-box mb-20">
    <?php
        foreach ($settings['profiles'] as $key => $profile) :
            $key = $key+1;
            $icon = $profile['name'];
            $url = esc_url($profile['link']['url']);
            
            printf('<a target="_blank" rel="noopener"  href="%s" class="social-'.$key.' elementor-repeater-item-%s"><i class="fab fa-%s" aria-hidden="true"></i></a>',
                $url,
                esc_attr($profile['_id']),
                esc_attr($icon)
            );
        endforeach; 
    ?>
</div>

<?php endif;
    }
}

$widgets_manager->register( new TP_Social() );