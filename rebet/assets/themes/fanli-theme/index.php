<?php get_header(); ?>

		<?php
			/*
			This snippet will be used all through the theme
			 */
			$type_sample = new WP_Query();
			$type_sample ->query(array('post_type' => 'type_sample','showposts' => '-1', 'meta_key' => 'key_name', 'meta_value' => 'value', 'order' => 'ASC', 'orderby' => 'menu_order'));  
			if($type_sample->have_posts()) : while($type_sample->have_posts()): $type_sample->the_post(); 
			$post_id = get_the_ID();
			$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'sample-size');
		?>
			<!-- thumb -->
			<img src="<?php echo $thumbnail[0]; ?>" width="936" height="240" alt="<?php $thumb_id = get_attachment_id_from_src($thumbnail[0]); $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true); if($alt) echo $alt;  ?>" />
			<!-- custom meta -->
			<?php echo get_post_meta($post_id, 'x_sample_key_1', true);?>
			<!-- content directly -->
			<?php the_content(); ?>
			<!-- content echo -->
			<?php $content = get_the_content(); $content = apply_filters('the_content', $content); echo wpautop($content); ?>
			
		<?php endwhile; else: ?>
			<img src="<?php bloginfo("template_url"); ?>/images/1.jpg" alt="" width="936" height="240" />
		<?php endif;?>
		<?php rewind_posts(); ?>


<?php get_footer(); ?>

