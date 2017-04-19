<?php

get_header(); ?>
	
	<!-- site-content -->
	<div class="site-content ">
			
			<!-- Slideshow -->
			<div class="slideshow">
			<?php 
			the_post_thumbnail('banner-image');
			?>
				
			</div><!-- /Slideshow -->
			
		
			<?php if (have_posts()) :
				while (have_posts()) : the_post();

				get_template_part('content', 'page');
		
				?>
				

				<?php endwhile;

				else :?>
					<p class="display-error">Content Not Found</p><br />
					<a href="<?php echo home_url();?>">HomePage</a>

				<?php endif;
				?>
		

		
		
	</div><!-- /site-content -->
	
	<?php get_footer();

?>