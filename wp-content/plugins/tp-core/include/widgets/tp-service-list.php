<?php 
Class TP_Services_List_Widget extends WP_Widget{

	public function __construct(){
		parent::__construct('tp-services-list', 'TP Services List', array(
			'description'	=> 'TP Services List'
		));
	}


	public function widget($args, $instance){

		extract($args);
	 	echo $before_widget; 
	 	if($instance['title']):
     	echo $before_title;
		echo apply_filters( 'widget_title', $instance['title'] );
		echo $after_title;
		endif; ?>

		<div class="tp-service-widget-item mb-40">
			<div class="tp-service-widget-tab">
				<ul>
				<?php 
					$out_id = get_the_ID();
					$q = new WP_Query( array(
						'post_type'     => 'tp-services',
						'posts_per_page'=> ($instance['count']) ? $instance['count'] : '3',
						'order'			=> ($instance['posts_order']) ? $instance['posts_order'] : 'DESC'
					));
					if( $q->have_posts() ):
					$i = 0;
					while( $q->have_posts() ):
					$q->the_post();
					$icon_id = function_exists('get_field') ? get_field( 'service_title_icon', $q->ID ) : '';
					$active_class = ($i == 0) ? 'active' : '';
					$in_id = get_the_ID(); 
					$active = $out_id == $in_id ? 'active' : ' ';
				?>
				<li>
					<a class="<?php echo esc_attr($active); ?>" href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
						<i class="fa-regular fa-arrow-right-long"></i>
					</a>
				</li>
				<?php endwhile; wp_reset_query(); endif; ?>
				</ul>
			</div>
		</div>

<?php echo $after_widget; 
	}

	public function form($instance){
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$count = ! empty( $instance['count'] ) ? $instance['count'] : esc_html__( '3', 'tpcore' );
		$posts_order = ! empty( $instance['posts_order'] ) ? $instance['posts_order'] : esc_html__( 'DESC', 'tpcore' );
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
	register_widget('TP_Services_List_Widget');
});