<?php
/**
 * Gets all theme mods and stores them in an easily accessable global var to limit DB requests
 *
 * @package byron
 * @version 3.6.8
 */

global $byron_theme_mods;
$byron_theme_mods = get_theme_mods();

// Returns theme mod from global var
function byron_get_mod( $id, $default = '' ) {

	// Return get_theme_mod on customize_preview
	if ( is_customize_preview() ) {
		return get_theme_mod( $id, $default );
	}
   
	// Get global object
	global $byron_theme_mods;

	// Return data from global object
	if ( ! empty( $byron_theme_mods ) ) {

		// Return value
		if ( isset( $byron_theme_mods[$id] ) ) {
			return $byron_theme_mods[$id];
		} 
		else {
			return $default;
		}
	}

	// Global object not found return using get_theme_mod
	else {
		return get_theme_mod( $id, $default );
	}
}

// Returns global mods
function byron_get_mods() {
	global $byron_theme_mods;
	return $byron_theme_mods;
}