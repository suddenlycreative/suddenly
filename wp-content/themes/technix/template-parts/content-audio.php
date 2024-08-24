<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package technix
 */

$technix_audio_url = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'technix_post_audio' ) : NULL;
$categories = get_the_terms( $post->ID, 'category' );
$technix_blog_cat = get_theme_mod( 'technix_blog_cat', false );
if ( is_single() ): 
?>

<article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item format-audio mb-50 transition-3' );?>>
    <?php if ( !empty($technix_audio_url) ): ?>
    <div class="postbox__thumb w-img">
        <?php echo wp_oembed_get( $technix_audio_url ); ?>
    </div>
    <?php endif;?>

    <div class="postbox__content">
        <!-- blog meta -->
        <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>
        <h3 class="postbox__title"><?php the_title();?></h3>

        <?php the_content();?>
        <?php
            wp_link_pages( [
                'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'technix' ),
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            ] );
        ?>
    </div>

    <div class="postbox-tags">
        <?php echo technix_get_tag(); ?>
    </div>
</article>


<?php else: ?>



<article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item mb-50 transition-3 format-audio' );?>>
    <?php if ( !empty($technix_audio_url) ): ?>
    <div class="postbox__thumb">
        <a href="<?php the_permalink();?>">
            <?php echo wp_oembed_get( $technix_audio_url ); ?>
        </a>
        <?php if ( !empty($technix_blog_cat) ): ?>
        <?php if ( !empty( $categories[0]->name ) ): ?>
        <div class="postbox__tag">
            <p><?php echo esc_html($categories[0]->name); ?></p>
        </div>
        <?php endif;?>
        <?php endif;?>
    </div>
    <?php endif; ?>

    <div class="postbox__content">
        <!-- blog meta -->
        <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>

        <h3 class="postbox__title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>


        <div class="postbox__text">
            <?php the_excerpt();?>
        </div>

        <!-- blog btn -->
        <?php get_template_part( 'template-parts/blog/blog-btn' ); ?>
    </div>
</article>

<?php
endif;?>