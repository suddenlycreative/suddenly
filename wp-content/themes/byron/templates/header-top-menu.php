<?php
/**
 * Header / Menu
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Menu
if ( has_nav_menu( 'topmenu' ) ) { ?>
	<div class="top-menu-wrap">
		<nav id="top-menu" class="header-top-menu">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'topmenu',
				'link_before' => '<span>',
				'link_after'=>'</span>',
				'fallback_cb' => false,
				'container' => false
			) );
			?>
		</nav>
	</div>
<?php }
