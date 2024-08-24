<?php
/*
Widget Name: Project_Widget
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-masterlayer/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Project_Widget_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-project-widget';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'Project Widget', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-wordpress';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

    protected function register_controls() {
        // Content
        $this->start_controls_section( 'section_content_project_info',
            [
                'label' => __( 'Project Information', 'masterlayer' ),
            ]
        );

        $this->add_control(
            'project_info',
            [
                'label'        => __( 'Enable', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );  

        $this->add_control(
            'info_title',
            [
                'label'   => __( 'Widget Title', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Project #1', 'masterlayer' ),
                'label_block' => true,
                'condition' => [ 'project_info' => 'yes' ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'info1',
            [
                'label'   => __( 'Text 1', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Info Text 1', 'masterlayer' ),
            ]
        );

        $repeater->add_control(
            'info2',
            [
                'label'   => __( 'Text 2', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Info Text 2', 'masterlayer' ),
            ]
        );

        $this->add_control(
            'info',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'info1'  => __( 'Client', 'masterlayer' ),
                        'info2'  => __( 'European Co', 'masterlayer' ),
                    ],
                    [
                        'info1'  => __( 'Date', 'masterlayer' ),
                        'info2'  => __( 'June 2020', 'masterlayer' ),
                    ],
                    [
                        'info1'  => __( 'Category', 'masterlayer' ),
                        'info2'  => __( 'Construction', 'masterlayer' ),
                    ],
                ],
                'title_field' => '{{{ info1 }}}',
                'condition' => [ 'project_info' => 'yes' ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section( 'section_content_project_related',
            [
                'label' => __( 'Related Project', 'masterlayer' ),
            ]
        );

        $this->add_control(
            'project_related',
            [
                'label'        => __( 'Enable', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'project_related_title',
            [
                'label'   => __( 'Widget Title', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Related Projects', 'masterlayer' ),
                'label_block' => true,
                'condition' => [ 'project_related' => 'yes' ]
            ]
        ); 

        $this->add_control(
            'post_to_show',
            [
                'label'     => __( 'Post to Show', 'masterlayer'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 2,
                'min'     => 1,
                'max'     => 5,
                'step'    => 1,
                'condition'             => [ 'project_related'   => 'yes',  ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section( 'section_content_socials',
            [
                'label' => __( 'Socials', 'masterlayer' ),
            ]
        );

        $this->add_control(
            'project_socials',
            [
                'label'        => __( 'Enable', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );  

        $this->add_control(
            'social_title',
            [
                'label'   => __( 'Widget Title', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Follow Us', 'masterlayer' ),
                'label_block' => true,
                'condition' => [ 'project_socials' => 'yes' ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'social_icon',
            [
                'label' => __( 'Icon', 'masterlayer' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'social',
                'default' => [
                    'value' => 'fab fa-wordpress',
                    'library' => 'fa-brands',
                ],
                'recommended' => [
                    'fa-brands' => [
                        'android',
                        'apple',
                        'behance',
                        'bitbucket',
                        'codepen',
                        'delicious',
                        'deviantart',
                        'digg',
                        'dribbble',
                        'masterlayer',
                        'facebook',
                        'flickr',
                        'foursquare',
                        'free-code-camp',
                        'github',
                        'gitlab',
                        'globe',
                        'houzz',
                        'instagram',
                        'jsfiddle',
                        'linkedin',
                        'medium',
                        'meetup',
                        'mix',
                        'mixcloud',
                        'odnoklassniki',
                        'pinterest',
                        'product-hunt',
                        'reddit',
                        'shopping-cart',
                        'skype',
                        'slideshare',
                        'snapchat',
                        'soundcloud',
                        'spotify',
                        'stack-overflow',
                        'steam',
                        'telegram',
                        'thumb-tack',
                        'tripadvisor',
                        'tumblr',
                        'twitch',
                        'twitter',
                        'viber',
                        'vimeo',
                        'vk',
                        'weibo',
                        'weixin',
                        'whatsapp',
                        'wordpress',
                        'xing',
                        'yelp',
                        'youtube',
                        '500px',
                    ],
                    'fa-solid' => [
                        'envelope',
                        'link',
                        'rss',
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => __( 'Link', 'masterlayer' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'is_external' => 'true',
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', 'masterlayer' ),
            ]
        );

        $this->add_control(
            'social_icon_list',
            [
                'label' => __( 'Social Icons', 'masterlayer' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'social_icon' => [
                            'value' => 'fab fa-facebook',
                            'library' => 'fa-brands',
                        ],
                    ],
                    [
                        'social_icon' => [
                            'value' => 'fab fa-twitter',
                            'library' => 'fa-brands',
                        ],
                    ],
                    [
                        'social_icon' => [
                            'value' => 'fab fa-youtube',
                            'library' => 'fa-brands',
                        ],
                    ],
                ],
                'title_field' => '<# var migrated = "undefined" !== typeof __fa4_migrated, social = ( "undefined" === typeof social ) ? false : social; #>{{{ elementor.helpers.getSocialNetworkNameFromIcon( social_icon, social, true, migrated, true ) }}}',
                'condition' => [ 'project_socials' => 'yes' ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $infos = $this->get_settings_for_display( 'info' );
        $socials = $this->get_settings_for_display( 'social_icon_list' );

        $widget_html = '';

        // Project Info
        if ( $settings['project_info'] == 'yes' ) {
            $widget_html .= '<div class="project-widget widget-info">';
            if ( $settings['info_title'] ) 
                $widget_html .= sprintf( '<h3 class="widget-title">%1$s</h3>', $settings['info_title'] );
            $widget_html .= '<div class="widget-content">';  

            foreach ( $infos as $index => $item ) {
                $widget_html .= sprintf( 
                    '<div class="info-wrap">
                        <span class="text1">%1$s</span>
                        <span class="text2">%2$s</span>
                    </div>',
                    $item['info1'],
                    $item['info2']
                );
            }  

            $widget_html .= '</div></div>';
        }

        // Related Projects
        if ( $settings['project_related'] == 'yes' ) {
            global $post;
            
            $slug = get_the_terms( get_the_ID(), 'project_category' );
            $args = array(
                'post_type' => 'project',
                'posts_per_page' => $settings['post_to_show']
            );

            if ( ! empty( $slug[0] ) ) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'project_category',
                        'field'    => 'slug',
                        'terms'    => $slug[0]->slug
                    ),
                );
            }

            $query = new \WP_Query( $args );
            if ( $query->have_posts() ) {
                $widget_html .= '<div class="project-widget widget-project-related">';
                if ( $settings['project_related_title'] ) 
                    $widget_html .= sprintf( '<h3 class="widget-title">%1$s</h3>', $settings['project_related_title'] );
                $widget_html .= '<div class="widget-content">'; 

                while ( $query->have_posts() ) : $query->the_post();
                    $cat = '';
                    $title = get_the_title();
                    $thumb = get_the_post_thumbnail( get_the_ID(), 'thumbnail' );
                    $link = get_the_permalink();
                    $terms = get_the_terms( get_the_ID(), 'project_category' );
                    if ( $terms )
                        $cat = '<div class="project-cat"><a href="' . esc_url( get_term_link($terms[0]->term_id) ) . 
                        '">' . $terms[0]->name . '</a></div>';

                    $widget_html .= sprintf( 
                        '<div class="project-related">
                            <div class="thumb">%1$s</div>
                            <div class="text-wrap">
                                <h3 class="project-title"><a href="%4$s">%2$s</a></h3>
                                %3$s
                            </div>
                        </div>',
                        $thumb,
                        esc_html( $title ),
                        $cat,
                        esc_url( get_the_permalink() )
                    );
                endwhile;

                $widget_html .= '</div></div>';
            }
        }

        // Socials
        if ( $settings['project_socials'] == 'yes' )
            $widget_html .= '<div class="project-widget widget-socials">';
            if ( $settings['info_title'] ) 
                $widget_html .= sprintf( '<h3 class="widget-title">%1$s</h3>', $settings['social_title'] );
            $widget_html .= '<div class="widget-content">'; 

            foreach ( $socials as $index => $item ) {
                $widget_html .= sprintf( 
                    '<a href="%1$s"><i class="%2$s"></i></a>', 
                    esc_url( $item['link']['url'] ),
                    $item['social_icon']['value']
                );
            }

            $widget_html .= '</div></div>';

        ?>
        <div class="master-project-widget">
            <?php echo $widget_html; ?>
        </div>

        <?php
    }

    protected function content_template() {}
}

