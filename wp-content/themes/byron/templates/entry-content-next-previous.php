<?php
/**
 * Entry Content / Nex - Previous Post
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! is_single() || ! byron_get_mod( 'byron_blog_single_next_previous', false ) )
    return;

$next_post = get_next_post();
$prev_post = get_previous_post();
if (!$next_post && !$prev_post) return;
?>

<div class="post-next-previous">
    <?php if ($prev_post) : ?>
    <div class="link-wrap previous clearfix">
        <div class="thumb"><?php echo get_the_post_thumbnail( $prev_post->ID, 'byron-post-widget'); ?></div>
        <div class="text">
            <h3 class="title">
                <a href="<?php echo esc_url( get_the_permalink( $prev_post->ID ) ); ?>">
                    <?php echo esc_html( get_the_title($prev_post->ID)); ?>
                </a>
            </h3>

            <a class="link" href="<?php echo esc_url( get_the_permalink( $prev_post->ID ) ); ?>"><?php esc_html_e( 'Prev Post', 'byron'); ?></a>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($next_post) : ?>
    <div class="link-wrap next clearfix">
        <div class="thumb"><?php echo get_the_post_thumbnail( $next_post->ID, 'byron-post-widget'); ?></div>
        <div class="text">
            <h3 class="title">
                <a href="<?php echo esc_url( get_the_permalink( $next_post->ID ) ); ?>">
                    <?php echo esc_html( get_the_title($next_post->ID)); ?>
                </a>
            </h3>

            <a class="link" href="<?php echo esc_url( get_the_permalink( $next_post->ID ) ); ?>"><?php esc_html_e( 'Next Post', 'byron'); ?></a>
        </div>
    </div>
    <?php endif; ?>
</div>



