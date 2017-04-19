
<?php

get_header();

if (have_posts()):
	while (have_posts()): the_post();?>
	
	<article class="post page">
		
		
		<!--column-container-->
		<div class="column-container clearfix">
			<!--title-column-->
			<div class="title-column">
				<h2><?php the_title();?></h2>
			</div><!-- /title-column-->
			
			<!--title-column-->
			<div class="text-column">
				<?php the_content();?>
							
			<button id="portfolio-posts-btn">Load Portfolio Related Posts</button>
			<div id="portfolio-posts-container"></div>
			</div><!-- /title-column-->

			
		</div><!--/column-container-->
		
		
		
		
	</article>
	
	<?php endwhile;

	else: ?>
	
		<p class="display-error">Content Not Found</p><br />
		<a href="<?php echo home_url();?>">HomePage</a>
		
	<?php endif;

get_footer();
?>