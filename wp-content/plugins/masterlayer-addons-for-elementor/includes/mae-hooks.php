<?php

// Add new image size
function mae_custom_image_sizes() {
	add_image_size( 'mae-std1', 570, 700, true );
	add_image_size( 'mae-std2', 570, 400, true );
	add_image_size( 'mae-std3', 430, 570, true );
	add_image_size( 'mae-std4', 370, 440, true );
	add_image_size( 'mae-std5', 370, 400, true );
	add_image_size( 'mae-std6', 370, 270, true );
	add_image_size( 'mae-std7', 370, 210, true );
}
add_action( 'after_setup_theme', 'mae_custom_image_sizes' );