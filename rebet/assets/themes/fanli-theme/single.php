<?php get_header(); ?>
	
		<div id="main">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>				
				<h1><?php the_title(); ?></h1>
				<div class="content_area">
					<?php the_content(); ?>
				</div><!--  content_area  -->
			<?php endwhile; else: ?>
				<p>Sorry, no posts matched your criteria.</p>
			<?php  endif; ?>
			<?php rewind_posts(); ?>

			<?php comments_template( '', true ); ?>
		</div>
		
		<?php get_template_part( 'side-normal' ); ?> 

<?php get_footer(); ?>

