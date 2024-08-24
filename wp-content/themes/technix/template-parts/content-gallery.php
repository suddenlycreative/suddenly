<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package technix
 */

$gallery_images = function_exists('tpmeta_gallery_field')? tpmeta_gallery_field('technix_post_gallery') : '';

if ( is_single() ): ?>


<article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item format-gallery mb-75' );?>>
   <?php if ( !empty( $gallery_images ) ): ?>
   <div class="postbox__thumb postbox__slider swiper-container p-relative">
      <div class="swiper-wrapper">
         <?php foreach ( $gallery_images as $key => $image ): ?>
         <div class="postbox-slider-item swiper-slide">
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
         </div>
         <?php endforeach;?>
      </div>
      <div class="postbox-nav">
         <button class="postbox-slider-button-next">
            <svg width="35" height="28" viewBox="0 0 35 28" fill="none" xmlns="http://www.w3.org/2000/svg">
               <g clip-path="url(#clip0_326_645)">
                  <path d="M0 13.9954H35" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" />
                  <path d="M21.4453 0C21.4453 7.73574 27.5079 13.9953 35.0001 13.9953" stroke="currentColor"
                     stroke-width="2" stroke-miterlimit="10" />
                  <path d="M35.0001 13.9954C27.5079 13.9954 21.4453 20.255 21.4453 27.9907" stroke="currentColor"
                     stroke-width="2" stroke-miterlimit="10" />
               </g>
               <defs>
                  <clipPath id="clip0_326_6451">
                     <rect width="35" height="28" fill="white" />
                  </clipPath>
               </defs>
            </svg>
         </button>
         <button class="postbox-slider-button-prev">
            <svg width="35" height="28" viewBox="0 0 35 28" fill="none" xmlns="http://www.w3.org/2000/svg">
               <g clip-path="url(#clip0_326_651)">
                  <path d="M35 13.9954H3.29442e-07" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" />
                  <path d="M13.5547 0C13.5547 7.73574 7.49212 13.9953 -0.000121431 13.9953" stroke="currentColor"
                     stroke-width="2" stroke-miterlimit="10" />
                  <path d="M-0.000121431 13.9954C7.49212 13.9954 13.5547 20.255 13.5547 27.9907" stroke="currentColor"
                     stroke-width="2" stroke-miterlimit="10" />
               </g>
               <defs>
                  <clipPath id="clip0_326_651">
                     <rect width="35" height="28" fill="white" transform="matrix(-1 0 0 1 35 0)" />
                  </clipPath>
               </defs>
            </svg>
         </button>
      </div>
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

<article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item mb-60 format-image' );?>>
   <?php if ( !empty( $gallery_images ) ): ?>
   <div class="postbox__thumb postbox__slider swiper-container p-relative">
      <div class="swiper-wrapper">
         <?php foreach ( $gallery_images as $key => $image ): ?>
         <div class="postbox-slider-item swiper-slide">
            <img src="<?php echo esc_url($image['url']); ?>" alt="aa <?php echo esc_attr($image['alt']); ?>">
         </div>
         <?php endforeach;?>
      </div>
      <div class="postbox-nav">
         <button class="postbox-slider-button-next">
            <svg width="35" height="28" viewBox="0 0 35 28" fill="none" xmlns="http://www.w3.org/2000/svg">
               <g clip-path="url(#clip0_326_645)">
                  <path d="M0 13.9954H35" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" />
                  <path d="M21.4453 0C21.4453 7.73574 27.5079 13.9953 35.0001 13.9953" stroke="currentColor"
                     stroke-width="2" stroke-miterlimit="10" />
                  <path d="M35.0001 13.9954C27.5079 13.9954 21.4453 20.255 21.4453 27.9907" stroke="currentColor"
                     stroke-width="2" stroke-miterlimit="10" />
               </g>
               <defs>
                  <clipPath id="clip0_326_6451">
                     <rect width="35" height="28" fill="white" />
                  </clipPath>
               </defs>
            </svg>
         </button>
         <button class="postbox-slider-button-prev">
            <svg width="35" height="28" viewBox="0 0 35 28" fill="none" xmlns="http://www.w3.org/2000/svg">
               <g clip-path="url(#clip0_326_651)">
                  <path d="M35 13.9954H3.29442e-07" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" />
                  <path d="M13.5547 0C13.5547 7.73574 7.49212 13.9953 -0.000121431 13.9953" stroke="currentColor"
                     stroke-width="2" stroke-miterlimit="10" />
                  <path d="M-0.000121431 13.9954C7.49212 13.9954 13.5547 20.255 13.5547 27.9907" stroke="currentColor"
                     stroke-width="2" stroke-miterlimit="10" />
               </g>
               <defs>
                  <clipPath id="clip0_326_651">
                     <rect width="35" height="28" fill="white" transform="matrix(-1 0 0 1 35 0)" />
                  </clipPath>
               </defs>
            </svg>
         </button>
      </div>
   </div>
   <?php endif;?>

   <div class="postbox__content">
      <!-- blog meta -->
      <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>

      <h3 class="postbox__itle"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>


      <div class="postbox__text">
         <?php the_excerpt();?>
      </div>

      <!-- blog btn -->
      <?php get_template_part( 'template-parts/blog/blog-btn' ); ?>
   </div>
</article>


<?php
endif;?>