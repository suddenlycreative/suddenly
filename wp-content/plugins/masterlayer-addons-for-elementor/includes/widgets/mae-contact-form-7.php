<?php
/*
Widget Name: Contact Form 7
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
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

class MAE_Contact_Form_7_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-contact-form-7';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'Contact Form 7', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-mail';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {
			
		$this->start_controls_section(
			'section__content',
			[
				'label' => __( 'Contact Form 7', 'masterlayer' ),
			]
		);

		$this->add_control(
			'cf7',
			[
				'label' => __( 'Select Contact Form', 'masterlayer' ),
                'description' => __( 'Contact form 7 plugin must be installed and there must be some contact forms made with the contact form 7','masterlayer' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => $this->get_cf7(),
			]
		);

		$this->add_control(
            'style',
            [
                'label'     => __( 'Style', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'style-1',
                'options'   => [
                    'style-1'         => __( 'Style 1', 'masterlayer'),
                    'style-2'         => __( 'Style 2', 'masterlayer'),
                ],
                'prefix_class' => 'cf7-'
            ]
        );

		$this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'masterlayer' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'masterlayer' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'masterlayer' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'masterlayer' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'prefix_class' => 'align-'
            ]
        );

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		static $i = 0;

        if ( ! empty( $settings['cf7'] ) ) {
    	   echo'<div class="elementor-shortcode byron-cf7-'. $i .'">';
                echo do_shortcode('[contact-form-7 id="'. $settings['cf7'] .'"]');    
           echo '</div>';  
    	}

 		if ( ! empty( $settings['cf7_redirect_page'] ) ) {  ?>
 			<script>
 			    var f = document.querySelector('.byron-cf7-<?php echo $i; ?>');
					f.addEventListener('wpcf7mailsent', function() {
					    <?php echo get_permalink( $settings['cf7_redirect_page'] ); ?>;
					}, false);
			</script>

		<?php  $i++;
 		}
    }

    protected function get_cf7() {
    	$catlist = [];
	 	$args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
	    
	    if ( $categories = get_posts( $args ) ) {
	    	foreach ( $categories as $category ) {
	    		(int)$catlist[$category->ID] = $category->post_title;
	    	}
	    } else{
	        (int)$catlist['0'] = __( 'No contact From 7 form found', 'masterlayer' );
	    }

	  	return $catlist;
	}

	protected function content_template() {}
}

