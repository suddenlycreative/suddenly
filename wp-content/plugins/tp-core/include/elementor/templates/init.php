<?php
namespace TP_ELEMENTOR\Templates;

defined('ABSPATH') || die();

class TP_Templates
{
    private static $instance = null;

    public static function url(){
        if (defined('TP_ADDONS_FILE_')) {
            $file = trailingslashit(plugin_dir_url( TP_ADDONS_FILE_ )). 'include/elementor/templates/';
        } else {
            $file = trailingslashit(plugin_dir_url( __FILE__ ));
        }
        return $file;
    }

    public static function dir(){
        if (defined('TP_ADDONS_FILE_')) {
            $file = trailingslashit(plugin_dir_path( TP_ADDONS_FILE_ )). 'include/elementor/templates/';
        } else {
            $file = trailingslashit(plugin_dir_path( __FILE__ ));
        }
        return $file;
    }

    public static function version(){
        if( defined('TP_ADDONS_VERSION_') ){
            return TP_ADDONS_VERSION_;
        } else {
            return apply_filters('tpaddons_pro_version', '1.0.0');
        }
        
    }

    public function init()
    {
        // add_action( 'wp_enqueue_scripts', function() {       
        //     wp_enqueue_style( "tpcore-el-template-front", self::url() . 'css/template-frontend.min.css' , ['elementor-frontend'], self::version() );  
        //     } 
        // );
        
        add_action( 'elementor/editor/after_enqueue_scripts', function() {     
            wp_enqueue_style( "tpAdd-template-editor", self::url() . 'css/template-library.min.css' , ['elementor-editor'], self::version() );  
            wp_enqueue_script("tpAdd-template-editor", self::url() . 'js/template-library.min.js', ['elementor-editor'], self::version(), true); 
            $pro = get_option('__validate_author_dtaddons__', false);
            
            $localize_data = [
                'hasPro'                          => !$pro ? false : true,
                'templateLogo'                    => TP_EXT_LOGO_ICON_URL,
                'i18n' => [
                    'templatesEmptyTitle'       => esc_html__( 'No Templates Found', 'tpcore' ),
                    'templatesEmptyMessage'     => esc_html__( 'Try different category or sync for new templates.', 'tpcore' ),
                    'templatesNoResultsTitle'   => esc_html__( 'No Results Found', 'tpcore' ),
                    'templatesNoResultsMessage' => esc_html__( 'Please make sure your search is spelled correctly or try a different words.', 'tpcore' ),
                ],
                'tab_style' => json_encode(self::get_tabs()),
                'default_tab' => 'section'
            ];
            wp_localize_script(
                'tpAdd-template-editor',
                'tpcoreEditor',
                $localize_data
            );

            } 
        );

        add_action( 'elementor/preview/enqueue_styles', function(){
            $data = '.elementor-add-new-section .tp_templates_add_button {
                background-color: #6045bc;
                margin-left: 5px;
                font-size: 18px;
                vertical-align: bottom;
            }
            ';
            wp_add_inline_style( 'tpcore-el-template-front', $data );
        } );
    }

    public static function get_tabs(){
        return apply_filters('tp_editor/templates_tabs', [
            'section' => [ 'title' => 'Harry Sections'],
            'page' => [ 'title' => 'Harry Pages'],
        ]);
    }
    public static function instance(){
        if( is_null(self::$instance) ){
            self::$instance = new self();
        }
        return self::$instance;
    }
}

