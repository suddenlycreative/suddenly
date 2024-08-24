<?php

/* Headers */

function byron_cac_has_header_socials() {
	return get_theme_mod( 'header_socials', true );
}

function byron_cac_has_header_info() {
	return get_theme_mod( 'header_info', true );
}

function byron_cac_has_header_button() {
	return get_theme_mod( 'header_button', true );
}

function byron_cac_header_search_icon() {
	return get_theme_mod( 'header_search_icon', true );
}

function byron_cac_header_cart_icon() {
	if ( class_exists( 'woocommerce' ) && get_theme_mod( 'header_cart_icon', true ) ) {
		return true;	
	} else {
		return false;
	}
}

function byron_cac_has_header_fixed() {
	return get_theme_mod( 'header_fixed', true );
}

/* WooCommerce */
function byron_cac_has_woo() {
	if ( class_exists( 'woocommerce' ) ) { return true;	}
	else { return false; }
}

/* Scroll Top Button */
function byron_cac_has_scroll_top() {
	return get_theme_mod( 'scroll_top', true );
}

/* Layout */
function byron_cac_has_boxed_layout() {
	if ( 'boxed' == get_theme_mod( 'site_layout_style', 'full-width' ) ) {
		return true;
	} else {
		return false;
	}
}

/* Featured Title */
function byron_cac_has_featured_title() {
	return get_theme_mod( 'featured_title', true );
}

function byron_cac_has_featured_title_center() {
	if ( byron_cac_has_featured_title_heading()
		&& 'centered' == get_theme_mod( 'featured_title_style' ) ) {
		return true;
	} else {
		return false;
	}
}

function byron_cac_has_featured_title_breadcrumbs() {
	if ( byron_cac_has_featured_title() && get_theme_mod( 'featured_title_breadcrumbs' ) ) {
		return true;
	} else {
		return false;
	}
}

function byron_cac_has_featured_title_heading() {
	if ( byron_cac_has_featured_title() && get_theme_mod( 'featured_title_heading' ) ) {
		return true;
	} else {
		return false;
	}
}

/* Project Single */
function byron_cac_has_single_project() {
	if ( is_singular( 'project' ) ) {
		return true;
	} else {
		return false;
	}
}

function byron_cac_has_related_project() {
	if ( byron_get_mod( 'project_related', true ) && byron_cac_has_single_project() ) {
		return true;
	};
}

/* Footer */
function byron_cac_has_footer_widgets() {
	return get_theme_mod( 'footer_widgets', true );
}

/* Bottom Bar */
function byron_cac_has_bottombar() {
	return get_theme_mod( 'bottom_bar', true );
}
