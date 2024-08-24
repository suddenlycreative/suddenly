<?php
/**
 * Header
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$cls ='';

// Get header style
$cls = byron_get_mod( 'header_class' );
$header_style = byron_get_mod( 'header_site_style', 'style-3' );
if ( is_page() && byron_elementor( 'header_style' ) )
	$header_style = byron_elementor( 'header_style' );

// Custom style for main header area
$header_css = '';

get_template_part( 'templates/header-extra-nav' ); 

switch ($header_style) {
    case 'style-3': ?>
        <header id="site-header" class="<?php echo esc_attr( $cls ); ?>" style="<?php echo esc_attr( $header_css ); ?>">
            <div class="header-top">
                <div class="byron-container">
                    <div id="topbar">
                        <div class="topbar-left">
                            <?php get_template_part( 'templates/header-social'); ?>
                            <?php get_template_part( 'templates/header-top-menu'); ?>
                        </div>

                        <div class="topbar-right">
                            <?php get_template_part( 'templates/header-info'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="byron-container header-inner-wrap">
                <div class="site-header-inner">
                    <?php get_template_part( 'templates/header-logo'); ?>
                    <?php get_template_part( 'templates/header-button'); ?>
                </div> 

                <?php if ( has_nav_menu( 'primary' ) ) { ?>
                    <div class="wrap-inner">
                        <?php get_template_part( 'templates/header-menu'); ?>
                    </div>
                <?php } ?>
            </div>
        </header>
        <?php break;

    case 'style-4': ?>
        <header id="site-header" class="<?php echo esc_attr( $cls ); ?>" style="<?php echo esc_attr( $header_css ); ?>">
            <div class="byron-container header-inner-wrap">
                <div class="site-header-inner">
                    <?php get_template_part( 'templates/header-logo'); ?>
                    <?php get_template_part( 'templates/header-info'); ?>
                    <?php get_template_part( 'templates/header-button'); ?>
                </div> 

                <div class="wrap-inner">
                    <?php get_template_part( 'templates/header-menu'); ?>
                </div>
            </div>
        </header>
        <?php break;

    case 'style-5': ?>
        <header id="site-header" class="<?php echo esc_attr( $cls ); ?>" style="<?php echo esc_attr( $header_css ); ?>">
            <div class="header-top">
                <div class="byron-container">
                    <div id="topbar">
                        <div class="topbar-left">
                            <?php get_template_part( 'templates/header-social'); ?>
                            <?php get_template_part( 'templates/header-top-menu'); ?>
                        </div>

                        <div class="topbar-right">
                            <?php get_template_part( 'templates/header-info'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="byron-container">
                <div class="site-header-inner">
                    <?php get_template_part( 'templates/header-logo'); ?>

                    <div class="wrap-inner">
                        <?php get_template_part( 'templates/header-menu'); ?>
                    </div>
                </div> 
            </div>
        </header>
        <?php break;
    
    default: ?>
        <header id="site-header" class="<?php echo esc_attr( $cls ); ?>" style="<?php echo esc_attr( $header_css ); ?>">
            <div class="header-top">
                <div class="byron-container">
                    <div id="topbar">
                        <div class="topbar-left">
                            <?php get_template_part( 'templates/header-social'); ?>
                            <?php get_template_part( 'templates/header-top-menu'); ?>
                        </div>

                        <div class="topbar-right">
                            <?php get_template_part( 'templates/header-info'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="byron-container">
                <div class="site-header-inner">
                    <?php get_template_part( 'templates/header-logo'); ?>
                    <div class="wrap-inner">
                        <?php 
                        get_template_part( 'templates/header-menu');       
                        ?>
                    </div><!-- /.wrap-inner -->
                </div><!-- /.site-header-inner -->
            </div><!-- /.byron-container -->
        </header><!-- /#site-header -->
        <?php break;
}
    


