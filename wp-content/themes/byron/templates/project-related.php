<?php
/**
 * Entry Content / Related Post
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! is_singular( 'project' ) )
    return;

global $post;

$terms = get_the_terms( $post->ID, 'project_category' );

// Dont have category
if ( ! $terms ) return;

$related_pre_title = byron_get_mod( 'related_pre_title', 'EXPLORE PROJECTS' );
$related_title = byron_get_mod( 'related_title', 'OUR RECENT PROJECTS' );
$project_related_query = byron_get_mod( 'project_related_query', 7 );
$project_related_column = byron_get_mod( 'project_related_column', 3 );
$project_related_item_spacing = byron_get_mod( 'project_related_item_spacing', 30 );

$args = array(
    'post_type' => 'project',
    'show_post' => intval( $project_related_query ),
    'post__not_in' => array( $post->ID ),
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'project_category',
            'field'    => 'slug',
            'terms'    => $terms[0]->slug
        ),
    ),
);

$query = new WP_Query( $args );

if ( ! $query->have_posts() ) return; 

$cls = '';

$cls .= ' column-' . intval( $project_related_column ) . ' column2-3 column3-2 column4-1';
$cls .= ' gap-' . intval( $project_related_item_spacing );

wp_enqueue_script( 'flickity' );
?>
<div class="related-projects">
    <?php
    if ( $related_pre_title ) echo '<div class="pre-title">' . esc_attr( $related_pre_title ) . '</div>';
    if ( $related_title ) echo '<h2 class="title">' . esc_attr( $related_title ) . '</h2>';

    ?>
    <div class="deeper-carousel-box project-carousel <?php echo esc_attr( $cls );?>" data-config='{"groupCells":false, "fullAside":false}'>
        <?php if ( $query->have_posts() ) : ?>
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="project-item">
                    <div class="project-image">
                        <?php echo get_the_post_thumbnail( get_the_ID(), 'deeper-std3' ); ?>  
                        <div class="text-wrap">
                            <h2 class="project-title">
                                <?php 
                                if ( byron_elementor( 'project_title' ) ) {
                                    echo byron_elementor( 'project_title' );
                                } else {
                                    the_title();
                                } ?>
                            </h2>
                        </div>
                    </div>

                    
                </div><!-- /.project-item -->
            <?php endwhile; ?>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</div><!-- /.related-projects -->
