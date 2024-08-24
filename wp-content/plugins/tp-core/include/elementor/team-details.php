<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use Elementor\Core\Utils\ImportExport\Url;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Team_Details extends Widget_Base {

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
        return 'tp-team-details';
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
        return __( 'Team Details', 'tpcore' );
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

    protected function register_controls_section(){

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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        // member info
        $this->start_controls_section(
            'tp_info_sec',
            [
                'label' => esc_html__('Member Info', 'tp-core'),
            ]
        );

        $this->add_control(
            'tp_team_shape_switch',
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

        $this->add_control(
            'tp_team_name',
            [
                'label' => esc_html__('Name', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Imdet Cimsit', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_team_ratting_count',
            [
                'label' => esc_html__('Ratting Counter', 'tpcore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_team_rating',
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
                'default' => '5'
            ]
        );

        $this->add_control(
            'tp_team_bio',
            [
                'label' => esc_html__('Bio', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__("There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised wo look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reas characteristic words etc.", 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_team_age',
            [
                'label' => esc_html__('Age', 'tpcore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'label_block' => true,
            ]
        );


        $this->add_control(
            'tp_team_country',
            [
                'label' => esc_html__('Contry', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Bangladesh', 'tpcore'),
                'label_block' => true,
            ]
        );

        // icon image svg

        $this->add_control(
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Country Image Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ]
            ]
        );
        $this->add_control(
            'tp_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_type' => 'svg'
                ]
            ]
        );

        $this->add_control(
            'tp_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type' => 'image'
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tp_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
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
                        'tp_box_icon_type' => 'icon'
                    ]
                ]
            );
        }
        

        $this->add_control(
            'tp_team_designation',
            [
                'label' => esc_html__('Designation', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('WordPress Developer', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_team_location',
            [
                'label' => esc_html__('Office Location', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Themepure', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // social info
        $this->start_controls_section(
            'tp_social_sec',
            [
                'label' => esc_html__('Social Section', 'tp-core'),
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'social_name',
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
            'social_link', [
                'label' => esc_html__('Profile Link', 'tpcore'),
                'placeholder' => esc_html__('Add your profile link', 'tpcore'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'autocomplete' => false,
                'show_external' => false,
                'condition' => [
                    'social_name!' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'social_profiles',
            [
                'label' => esc_html__('Social - List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ social_name }}}',
                'default' => [
                    [
                        'social_name' => 'facebook-f',
                        'social_link' => ['url' => 'https://facebook.com/'],
                    ],
                    [
                        'social_name' => 'twitter',
                        'social_link' => ['url' => 'https://twitter.com/'],
                    ],
                    [
                        'social_name' => 'instagram',
                        'social_link' => ['url' => 'https://instagram.com/'],
                    ],
                    [
                        'social_name' => 'linkedin-in',
                        'social_link' => ['url' => 'https://linkedin.com/'],
                    ]
                ],
            ]
        );

        $this->end_controls_section();



        // skill
        $this->start_controls_section(
            'tp_skill_sec',
            [
                'label' => esc_html__('Skill', 'tp-core'),
            ]
        );

        $this->add_control(
            'tp_skill_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'World best education site - (Computer engeenering)',
                'label_block' => true,
            ]
        ); 

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tp_skill_text', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Easy & Emergency Solutions Anytime', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_skill_list',
            [
                'label' => esc_html__('Skills - skill', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_skill_text' => esc_html__('Research beyond the business plan', 'tpcore'),
                    ],
                    [
                        'tp_skill_text' => esc_html__('Marketing options and rates', 'tpcore')
                    ],
                    [
                        'tp_skill_text' => esc_html__('The ability to turnaround consulting', 'tpcore')
                    
                    ],
                    [
                        'tp_skill_text' => esc_html__('model sentence structures', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_skill_text }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function style_tab_content(){
        $this->tp_section_style_controls('comint_section', 'Section - Style', '.tp-el-section');
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
    // thumbnail image
    if ( !empty($settings['tp_thumbnail_image']['url']) ) {
        $tp_thumbnail_image = !empty($settings['tp_thumbnail_image']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image']['url'];
        $tp_thumbnail_image_alt = get_post_meta($settings["tp_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
    }
?>

<section class="tp-team-details-area p-relative pt-120 pb-90">
            <?php if(!empty($settings['tp_team_shape_switch'])) : ?>
            <div class="tp-team-details-shape">
               <img class="shape-1" src="<?php echo get_template_directory_uri() ?>/assets/img/team/details/shape-1.png" alt="">
               <img class="shape-2" src="<?php echo get_template_directory_uri() ?>/assets/img/team/details/shape-2.png" alt="">
            </div>
            <?php endif; ?>
            <div class="container">
               <div class="row">
                  <div class="col-lg-4">
                     <div class="tp-team-details-thumb p-relative text-center fadeLeft">
                     <?php if(!empty($tp_thumbnail_image)) : ?>
                            <img src="<?php echo esc_url($tp_thumbnail_image); ?>" alt="<?php echo esc_attr($tp_thumbnail_image_alt); ?>">
                        <?php endif; ?>
                           <div class="social text-center">
                              <?php
                            foreach ($settings['social_profiles'] as $key => $profile) :
                                $key = $key+1;
                                $icon = $profile['social_name'];
                                $url = esc_url($profile['social_link']['url']);
                                
                                printf('<a target="_blank" rel="noopener"  href="%s" class=" elementor-repeater-item-%s"><i class="fab fa-%s" aria-hidden="true"></i></a>',
                                    $url,
                                    esc_attr($profile['_id']),
                                    esc_attr($icon)
                                );
                                endforeach; ?>
                           </div>
                     </div>
                  </div>
                  <div class="col-lg-8">
                     <div class="tp-team-details-wrapper fadeRight">
                        <div class="row">
                           <div class="col-lg-6">
                              <div class="tp-team-detials-designation-wrapper">
                                 <div class="tp-team-details-designation-content">
                                    <?php if(!empty($settings['tp_team_name'])) : ?>
                                        <h4 class="tp-team-details-designation-title"><?php echo tp_kses($settings['tp_team_name']); ?></h4>
                                    <?php endif; ?>
                                    <?php if(!empty($settings['tp_team_designation']) or !empty($settings['tp_team_location'])) : ?>
                                    <p class="tp-team-details-designation"><?php echo tp_kses($settings['tp_team_designation']); ?> / <?php echo tp_kses($settings['tp_team_location'] ); ?></p>
                                    <?php endif; ?>
                                    <div class="tp-team-details-meta d-flex">
                                       <div class="tp-team-details-meta-thumb">
                                          
                                          <?php if($settings['tp_box_icon_type'] == 'icon') : ?>
                                            <?php if (!empty($settings['tp_box_icon']) || !empty($settings['tp_box_selected_icon']['value'])) : ?>
                                            <?php tp_render_icon($settings, 'tp_box_icon', 'tp_box_selected_icon'); ?>
                                            <?php endif; ?>
                                            <?php elseif( $settings['tp_box_icon_type'] == 'image' ) : ?>
                                            <?php if (!empty($settings['tp_box_icon_image']['url'])): ?>
                                            <img src="<?php echo $settings['tp_box_icon_image']['url']; ?>"
                                                alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                            <?php endif; ?>
                                            <?php else : ?>
                                            <?php if (!empty($settings['tp_box_icon_svg'])): ?>
                                            <?php echo $settings['tp_box_icon_svg']; ?>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                       </div>
                                       <?php if(!empty($settings['tp_team_country']) or !empty($settings['tp_team_age'])) : ?>
                                            <p><?php echo tp_kses($settings['tp_team_country']); ?> /<?php echo esc_html__("Age :",'tpcore') ?> <?php echo tp_kses($settings['tp_team_age'] ); ?> <?php echo esc_html__("years",'tpcore') ?> </p>
                                        <?php endif; ?>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <?php if(!empty($settings['tp_team_name'])) : ?>
                           <div class="col-lg-6">
                              <div class="tp-team-details-rating d-flex">
                              <?php
                                    $tp_rating = $settings['tp_team_rating'];
                                    for($i=1; $i<=$tp_rating; $i++) :
                                    ?>
                                    <span>
                                       <i class="fa-solid fa-star-sharp"></i>
                                    </span>
                                    <?php endfor; ?>
                                    <?php if(!empty($settings['tp_team_ratting_count'])) : ?>
                                 <p>(<?php echo tp_kses($settings['tp_team_ratting_count']); ?>)</p>
                                 <?php endif; ?>
                              </div>
                           </div>
                           <?php endif; ?>
                        </div>
                        <?php if(!empty($settings['tp_team_bio'])) : ?>
                        <div class="tp-team-details-info">
                           <p><?php echo tp_kses($settings['tp_team_bio']); ?></p>
                        </div>
                        <?php endif; ?>


                        <div class="tp-team-details-list">
                            <?php if(!empty($settings['tp_skill_title'])) : ?>
                                <p class="list-title"><?php echo tp_kses($settings['tp_skill_title']); ?></p>
                            <?php endif; ?>
                           <ul>
                           <?php foreach($settings['tp_skill_list'] as $key => $item) : ?>
                              <li>
                                <span><svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M15.794 2.17595C14.426 3.42395 13.094 4.87595 11.798 6.53195C10.67 7.95995 9.656 9.42395 8.756 10.924C7.94 12.268 7.346 13.42 6.974 14.38C6.962 14.416 6.938 14.446 6.902 14.47C6.866 14.506 6.824 14.524 6.776 14.524C6.764 14.536 6.752 14.542 6.74 14.542C6.656 14.542 6.596 14.518 6.56 14.47L0.134 7.93595C0.122 7.92395 0.278 7.76795 0.602 7.46795C0.926 7.15595 1.244 6.87395 1.556 6.62195C1.904 6.33395 2.09 6.20195 2.114 6.22595L5.642 8.99795C6.674 7.78595 7.832 6.58595 9.116 5.39795C11.048 3.62195 13.04 2.10995 15.092 0.861953C15.128 0.861953 15.266 1.02995 15.506 1.36595L15.866 1.88795C15.878 1.93595 15.878 1.98995 15.866 2.04995C15.854 2.09795 15.83 2.13995 15.794 2.17595Z" fill="currentColor"></path>
                              </svg></span><?php echo tp_kses($item['tp_skill_text']); ?>
                            </li>
                            <?php endforeach; ?>
                           </ul>
                          
                         
                        </div>
                        
                     </div>
                  </div>
               </div>
            </div>
         </section>


<?php endif; 
    }
}

$widgets_manager->register( new TP_Team_Details() );
