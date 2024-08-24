<?php

namespace MasterlayerAddons;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Masterlayer_Elementor_Addons' ) ) {
    /**
     * Main Class
     */
    final class Masterlayer_Elementor_Addons {
        private static $instance;
        /**
         * Insures that only one instance of Masterlayer_Elementor_Addons exists in memory at any one time.
         */
        public static function instance() {
            if ( ! isset( self::$instance ) && ! self::$instance instanceof Masterlayer_Elementor_Addons ) {
                self::$instance = new Masterlayer_Elementor_Addons();
                self::$instance->includes_and_hooks();
            }

            return self::$instance;
        }

        /**
         * Include required files and init hooks
         */
        private function includes_and_hooks() {
            // if ( is_admin() ) {
            //     require_once MAE_PATH . 'admin/admin.php';
            // }
            //require_once MAE_PATH . 'includes/helper.php';
            require_once MAE_PATH . 'includes/mae-functions.php';
            require_once MAE_PATH . 'includes/icons.php';
            require_once MAE_PATH . 'includes/cpt.php';
            require_once MAE_PATH . 'includes/settings.php';
            require_once MAE_PATH . 'includes/mae-hooks.php';

            add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
            add_action( 'elementor/init', array( $this, 'add_elementor_category' ) );
            add_action( 'elementor/widgets/register', array( $this, 'include_widgets' ) );
            add_action( 'elementor/frontend/after_register_scripts', array( $this, 'register_frontend_scripts' ), 20 );
            add_action( 'elementor/frontend/after_register_styles', array( $this, 'register_frontend_styles' ), 20 );
            add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'enqueue_frontend_styles' ), 20 );  
        }

        /**
         * Load plugin text domain
         */
        public function load_plugin_textdomain() {
            load_plugin_textdomain( 'masterlayer', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
        }

        /**
         * Add a custom category to Elementor panel
         */
        public function add_elementor_category() {
            \Elementor\Plugin::instance()->elements_manager->add_category( 
                'masterlayer-addons',
                array(
                    'title' => __( 'Masterlayer Addons', 'masterlayer' ),
                    'icon'  => 'fa fa-plug',
                ),
                1
            );
        }
        
        /**
         * Load frontend scripts
         */
        public function register_frontend_scripts() {
            wp_register_script( 'appear', MAE_URL . 'assets/js/appear.js', array( 'jquery' ), '1.0', true );
            wp_register_script( 'countto', MAE_URL . 'assets/js/countto.js', array( 'jquery' ), '1.0', true );
            wp_register_script( 'flickity', MAE_URL . 'assets/js/flickity.js', array( 'jquery' ), '1.0', true );
            wp_register_script( 'cubeportfolio', MAE_URL . 'assets/js/cubeportfolio.js', array( 'jquery' ), '1.0', true );
            wp_register_script( 'waitforimages', MAE_URL . 'assets/js/waitforimages.js', array( 'jquery' ), '1.0', true );
            wp_register_script( 'magnific', MAE_URL . 'assets/js/magnific.popup.js', array( 'jquery' ), '1.0', true );
            wp_enqueue_script( 'slick', MAE_URL . 'assets/js/slick.js', array( 'jquery' ), '1.0', true );
            wp_register_script( 'parallaxScroll', MAE_URL . 'assets/js/parallax-scroll.js', array( 'jquery' ), '1.0', true );
            wp_enqueue_script( 'alterClass', MAE_URL . 'assets/js/alterClass.js', array( 'jquery' ), '1.0', true );
            wp_enqueue_script( 'mae-core', MAE_URL . 'assets/js/core.js', array( 'jquery' ), '1.0', true );
            wp_enqueue_script( 'mae-init', MAE_URL . 'assets/js/init.js', array( 'jquery' ), '1.0', true );
            wp_enqueue_script( 'chart', MAE_URL . 'assets/js/chart.js', array( 'jquery' ), '1.0', false );
        }
        
        /**
         * Load frontend styles
         */
        public function register_frontend_styles() {
            wp_register_style( 'slick', MAE_URL . 'assets/css/slick.css', array(), '1.0' );
            wp_register_style( 'flickity', MAE_URL . 'assets/css/flickity.css', array(), '1.0' );
            wp_register_style( 'cubeportfolio', MAE_URL . 'assets/css/cubeportfolio.css', array(), '1.0' );
            wp_register_style( 'magnific', MAE_URL . 'assets/css/magnific.popup.css', array(), '1.0' );
            wp_register_style( 'mae-widgets', MAE_URL . 'assets/css/mae-widgets.css', array( 'byron-theme-style' ), '1.0' );

            wp_enqueue_style( 'byron-icon', MAE_URL . 'assets/css/byron.css', array(), '1.0' );
            wp_enqueue_style( 'feather-icon', MAE_URL . 'assets/css/feather-icons.css', array(), '1.0' );

        }
        
        /**
         * Load frontend styles
         */
        public function enqueue_frontend_styles() {
            wp_enqueue_style( 'slick' );
            wp_enqueue_style( 'mae-widgets' );
        }
        
        /**
         * Include required files
         */
        public function include_widgets() {
            $widgets_manager = \Elementor\Plugin::instance()->widgets_manager;

            // Single Widget
            require_once MAE_WIDGET_PATH . 'mae-headings.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Headings_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-link.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Link_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-button.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Button_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-list.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_List_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-progress-bar.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Progress_Bar_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-video-icon.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Video_Icon_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-fancy-image.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Fancy_Image_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-counter.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Counter_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-contact-form-7.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Contact_Form_7_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-subscribe-form.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Subscribe_Form_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-parallax-image.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Parallax_Image_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-chart.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Chart_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-tabs.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Tabs_Widget() );

            // Nested Widget
            require_once MAE_WIDGET_PATH . 'mae-icon-box.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Icon_Box_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-gallery-carousel.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Gallery_Carousel_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-service-carousel.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Service_Carousel_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-service-box.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Service_Box_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-team-carousel.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Team_Carousel_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-project-carousel.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Project_Carousel_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-project-grid.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Project_Grid_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-news-carousel.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_News_Carousel_Widget() );  

            require_once MAE_WIDGET_PATH . 'mae-partner-carousel.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Partner_Carousel_Widget() );  

            require_once MAE_WIDGET_PATH . 'mae-testimonial-carousel.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Testimonial_Carousel_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-demo-box.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Demo_Box_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-project-widget.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Project_Widget_Widget() );
        }
    }

    /**
     * Loader
     */
    function MAE() {
        return Masterlayer_Elementor_Addons::instance();
    }
    MAE();
}
