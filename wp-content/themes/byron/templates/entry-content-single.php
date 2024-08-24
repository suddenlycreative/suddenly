<?php
/**
 * Entry Content / Single
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
	
	<div class="inner-content">
		<?php		
		get_template_part( 'templates/entry-content-media' );
		get_template_part( 'templates/entry-content-title' );
		get_template_part( 'templates/entry-content-meta' );
		get_template_part( 'templates/entry-content-body' );
		get_template_part( 'templates/entry-content-tags' );
		?>
	</div>
	
	<?php
	get_template_part( 'templates/entry-content-next-previous' );
	get_template_part( 'templates/entry-content-author' );
	get_template_part( 'templates/entry-content-related' );
	?>
</article><!-- /.hentry -->