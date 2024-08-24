<?php
	/**
	 * TPCore Sidebar Posts Image
	 *
	 *
	 * @author 		Theme_Pure
	 * @category 	Widgets
	 * @package 	TPCore/Widgets
	 * @version 	1.0.0
	 * @extends 	WP_Widget
	*/

Class TP_Post_Sidebar_Widget extends WP_Widget{

	public function __construct(){
		parent::__construct('tp-latest-posts', 'TP Sidebar Posts Image', array(
			'description'	=> 'Latest Blog Post Widget by Theme_Pure'
		));
	}

	public function widget($args, $instance){
		extract($args);
		extract($instance);

	 echo $before_widget; 
		 if($instance['title']):
		 echo $before_title; ?>
<?php echo apply_filters( 'widget_title', $instance['title'] ); ?>
<?php echo $after_title; ?>
<?php endif; ?>

<div class="sidebar__widget-content">

	<?php 
			$q = new WP_Query( array(
				'post_type'     => 'post',
				'posts_per_page'=> ($instance['count']) ? $instance['count'] : '3',
				'order'			=> ($instance['posts_order']) ? $instance['posts_order'] : 'DESC',
				'orderby' => 'comment_count'
			));

			if( $q->have_posts() ):
			while( $q->have_posts() ):$q->the_post();
			?>


	<div class="sidebar__post">
		<div class="rc__post mb-30 d-flex align-items-center">
			<?php if ( has_post_thumbnail() ): ?>
			<div class="rc__post-thumb mr-20">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
			</div>
			<?php endif; ?>

			<div class="rc__post-content">
				<div class="rc__meta">
					<span><svg width="13" height="14" viewBox="0 0 13 14" fill="none"
							xmlns="http://www.w3.org/2000/svg">
							<path
								d="M1 13H3.25V10.75H1V13ZM3.75 13H6.25V10.75H3.75V13ZM1 10.25H3.25V7.75H1V10.25ZM3.75 10.25H6.25V7.75H3.75V10.25ZM1 7.25H3.25V5H1V7.25ZM6.75 13H9.25V10.75H6.75V13ZM3.75 7.25H6.25V5H3.75V7.25ZM9.75 13H12V10.75H9.75V13ZM6.75 10.25H9.25V7.75H6.75V10.25ZM4 3.5V1.25C4 1.18229 3.97396 1.125 3.92188 1.07812C3.875 1.02604 3.81771 0.999999 3.75 0.999999H3.25C3.18229 0.999999 3.1224 1.02604 3.07031 1.07812C3.02344 1.125 3 1.18229 3 1.25V3.5C3 3.56771 3.02344 3.6276 3.07031 3.67969C3.1224 3.72656 3.18229 3.75 3.25 3.75H3.75C3.81771 3.75 3.875 3.72656 3.92188 3.67969C3.97396 3.6276 4 3.56771 4 3.5ZM9.75 10.25H12V7.75H9.75V10.25ZM6.75 7.25H9.25V5H6.75V7.25ZM9.75 7.25H12V5H9.75V7.25ZM10 3.5V1.25C10 1.18229 9.97396 1.125 9.92188 1.07812C9.875 1.02604 9.81771 0.999999 9.75 0.999999H9.25C9.18229 0.999999 9.1224 1.02604 9.07031 1.07812C9.02344 1.125 9 1.18229 9 1.25V3.5C9 3.56771 9.02344 3.6276 9.07031 3.67969C9.1224 3.72656 9.18229 3.75 9.25 3.75H9.75C9.81771 3.75 9.875 3.72656 9.92188 3.67969C9.97396 3.6276 10 3.56771 10 3.5ZM13 3V13C13 13.2708 12.901 13.5052 12.7031 13.7031C12.5052 13.901 12.2708 14 12 14H1C0.729167 14 0.494792 13.901 0.296875 13.7031C0.0989583 13.5052 0 13.2708 0 13V3C0 2.72917 0.0989583 2.49479 0.296875 2.29687C0.494792 2.09896 0.729167 2 1 2H2V1.25C2 0.906249 2.1224 0.611978 2.36719 0.367187C2.61198 0.122395 2.90625 -9.53674e-07 3.25 -9.53674e-07H3.75C4.09375 -9.53674e-07 4.38802 0.122395 4.63281 0.367187C4.8776 0.611978 5 0.906249 5 1.25V2H8V1.25C8 0.906249 8.1224 0.611978 8.36719 0.367187C8.61198 0.122395 8.90625 -9.53674e-07 9.25 -9.53674e-07H9.75C10.0938 -9.53674e-07 10.388 0.122395 10.6328 0.367187C10.8776 0.611978 11 0.906249 11 1.25V2H12C12.2708 2 12.5052 2.09896 12.7031 2.29687C12.901 2.49479 13 2.72917 13 3Z"
								fill="#05DAC3" />
						</svg>
						<?php the_time( get_option('date_format') ); ?></span>
				</div>
				<h3 class="rc__post-title">
					<a href="<?php the_permalink(); ?>"><?php print wp_trim_words(get_the_title(), 7, ''); ?></a>
				</h3>
			</div>
		</div>
	</div>

	<?php endwhile;            
			 endif; ?>
</div>


<?php echo $after_widget; ?>

<?php
}



	public function form($instance){
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$count = ! empty( $instance['count'] ) ? $instance['count'] : esc_html__( '3', 'tpcore' );
		$posts_order = ! empty( $instance['posts_order'] ) ? $instance['posts_order'] : esc_html__( 'DESC', 'tpcore' );
		$choose_style = ! empty( $instance['choose_style'] ) ? $instance['choose_style'] : esc_html__( 'style_1', 'tpcore' );
	?>
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
	<input type="text" name="<?php echo $this->get_field_name('title'); ?>"
		id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
</p>

<p>
	<label for="<?php echo $this->get_field_id('count'); ?>">How many posts you want to show ?</label>
	<input type="number" name="<?php echo $this->get_field_name('count'); ?>"
		id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo esc_attr( $count ); ?>" class="widefat">
</p>

<p>
	<label for="<?php echo $this->get_field_id('posts_order'); ?>">Posts Order</label>
	<select name="<?php echo $this->get_field_name('posts_order'); ?>"
		id="<?php echo $this->get_field_id('posts_order'); ?>" class="widefat">
		<option value="" disabled="disabled">Select Post Order</option>
		<option value="ASC" <?php if($posts_order === 'ASC'){ echo 'selected="selected"'; } ?>>ASC</option>
		<option value="DESC" <?php if($posts_order === 'DESC'){ echo 'selected="selected"'; } ?>>DESC</option>
	</select>
</p>

<?php }


}

add_action('widgets_init', function(){
	register_widget('TP_Post_Sidebar_Widget');
});