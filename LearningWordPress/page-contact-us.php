<?php

get_header(); ?>
	
	<!-- site-content -->
	<div class="site-content clearfix">
		
		
			<?php if (have_posts()) :
				while (have_posts()) : the_post();

				get_template_part('content', 'page');

				endwhile;

				else : ?>
					
					<p class="display-error">Content Not Found</p><br />
					<a href="<?php echo home_url();?>">HomePage</a>

				<?php endif;
				?>
	
				<h1>Block Posts of Opinion</h1>
				
				<?php 
				$ourCurrentPage = get_query_var('paged');
				
				$contactPosts = new WP_Query(array(
					'category_name' => 'Opinion',
					'posts_per_page' => 3,
					'paged' => $ourCurrentPage
					
				));
		
				if ($contactPosts-> have_posts()){
					while ($contactPosts->have_posts()):
					$contactPosts->the_post();
					?> <li><a href="<?php the_permalink();?>"><?php the_title();?></a></li> 
					<?php
					endwhile;
					
					echo paginate_links(array(
							'total' => $contactPosts->max_num_pages
					));
				}
		
		
		?>

		
	</div><!-- /site-content -->
	
	<?php get_footer();

?>