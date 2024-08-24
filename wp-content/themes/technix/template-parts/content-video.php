<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package technix
 */

 $technix_video_url = function_exists('tpmeta_field')? tpmeta_field('technix_post_video') : '';
 $categories = get_the_terms( $post->ID, 'category' );
$technix_blog_cat = get_theme_mod( 'technix_blog_cat', false );

if ( is_single() ): 
?>

<article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item format-video mb-75' );?>>
    <?php if ( has_post_thumbnail() ): ?>
    <div class="postbox__thumb postbox-video p-relative">
        <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
        <?php if ( !empty($technix_video_url) ): ?>
        <div class="tp-video-play text-center">
            <a class="popup-video" href="<?php echo esc_url($technix_video_url); ?>"><i
                    class="fa-sharp fa-solid fa-play"></i></a>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

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

    <div class="postbox__tags">
        <?php echo technix_get_tag(); ?>
    </div>
</article>

<?php else: ?>

<article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item mb-50 format-video' );?>>
    <?php if ( has_post_thumbnail() ): ?>
    <div class="postbox__thumb postbox-video p-relative">
        <a href="<?php the_permalink();?>">
            <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
        </a>
        <?php if ( !empty($technix_video_url) ): ?>
        <div class="tp-video-play text-center">
            <a class="popup-video" href="<?php echo esc_url($technix_video_url); ?>"><i
                    class="fa-sharp fa-solid fa-play"></i></a>
            <?php if ( !empty($technix_blog_cat) ): ?>
            <?php if ( !empty( $categories[0]->name ) ): ?>
            <div class="postbox__tag">
                <p><?php echo esc_html($categories[0]->name); ?></p>
            </div>
            <?php endif;?>
            <?php endif;?>
        </div>
        <?php endif; ?>
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