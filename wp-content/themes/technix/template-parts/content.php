 <?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package technix
 */
$categories = get_the_terms( $post->ID, 'category' );
$technix_blog_cat = get_theme_mod( 'technix_blog_cat', false );

if ( is_single() ) : ?>

 <article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item format-image mb-50 transition-3' );?>>
     <?php if ( has_post_thumbnail() ): ?>
     <div class="postbox__thumb">
         <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
     </div>
     <?php endif;?>

     <div class="postbox__content postbox__blockquote">
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

     <?php
      $technix_singleblog_social = get_theme_mod( 'technix_singleblog_social', false );
        
     $social_shear_col= $technix_singleblog_social ? "col-lg-7" : "col-lg-12";
     ?>

     <div class="postbox__details-share-wrapper">
         <div class="row">
             <div class="<?php echo esc_attr($social_shear_col); ?>">
                 <div class="postbox__details-tag tagcloud">
                     <?php echo technix_get_tag(); ?>
                 </div>
             </div>
             <?php technix_blog_social_share() ?>
         </div>
     </div>
 </article>

 <?php else: ?>

 <article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item mb-60 format-standard' );?>>
     <?php if ( has_post_thumbnail() ): ?>
     <div class="postbox__thumb">
         <a href="<?php the_permalink();?>">
             <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
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
 <?php endif;?>