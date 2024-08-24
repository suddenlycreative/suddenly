<?php
/**
 * Entry Content / Meta
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( is_single() && ! byron_get_mod( 'blog_single_meta', true ) )
	return;
?>

<div class="post-meta <?php echo esc_attr( byron_get_mod( 'blog_custom_meta', 'style-1' ) ); ?>">
	<div class="post-meta-content">
		<div class="post-meta-content-inner clearfix">
			<?php byron_entry_meta(); ?>
		</div>
	</div>
</div>



