<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  tpcore
 */
get_header();

$blog_column = is_active_sidebar( 'tp-services-sidebar' ) ? 8 : 12;
?>

<div class="tp-service-details-area pt-120 pb-120">
    <div class="container">
        <div class="row">
            <?php if ( is_active_sidebar( 'tp-services-sidebar' ) ): ?>
            <div class="col-lg-4">
                <div class="tp-service-widget">
                  <?php dynamic_sidebar( 'tp-services-sidebar' ); ?>
                </div>
            </div>
            <?php endif;?>
            <div class="col-lg-<?php echo esc_attr($blog_column); ?>">
                <div class="tp-service-details-wrapper">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer();  ?>