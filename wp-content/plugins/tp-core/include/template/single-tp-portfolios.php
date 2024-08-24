<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  tpcore
 */
get_header();

?>

<!-- project-details-area start -->
<div class="project-details-area pt-140 pb-130">
      <div class="container">
      <div class="row">
            <div class="col-12">
                  <?php
                  
                  if( have_posts() ):
                  while( have_posts() ): the_post(); ?>

                  <?php the_content(); ?>
                  
                  <?php
                  endwhile; wp_reset_query();
                  endif;
                  ?>
            </div>
      </div>
      </div>
</div>
<!-- project-details-area end -->

<?php get_footer();  ?>
