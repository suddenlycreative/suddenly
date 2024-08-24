<?php get_header(); ?>
    <div class="byron-container">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
    </div><!-- /#content-wrap -->
<?php get_footer(); ?>