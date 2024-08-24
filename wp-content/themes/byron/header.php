<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="mobi-overlay"><span class="close"></span></div>
<div id="wrapper" style="<?php echo byron_element_bg_css( 'wrapper_background_img' ); ?>">
	<?php 
	if ( byron_get_mod( 'header_search_icon', false ) ) : ?>
	    <div class="search-style-fullscreen">
	    	<div class="search_form_wrap">
	    		<a class="search-close"></a>
	        	<?php get_search_form(); ?>
	        </div>
	    </div><!-- /.search-style-fullscreen -->
	<?php endif; ?>
	
    <div id="page" class="clearfix <?php echo byron_preloader_class(); ?>">
    	<div id="site-header-wrap">
			<?php get_template_part( 'templates/site-header' ); ?>
		</div><!-- /#site-header-wrap -->

		<?php get_template_part( 'templates/featured-title' ); ?>

        <!-- Main Content -->
        <div id="main-content" class="site-main clearfix" style="<?php echo byron_main_content_bg(); ?>">