<?php

get_header(); ?>

	<!-- site-content -->
	<div class="site-content clearfix">
		
	
			
			<?php
			
			if (have_posts()) :
				while (have_posts()) : the_post();

				if (get_post_format() == false) {
					get_template_part('content', 'single');
				} else {
					get_template_part('content', get_post_format());
				}


				endwhile;

				else :?>
					<p class="display-error">Content Not Found</p><br />
					<a href="<?php echo home_url();?>">HomePage</a>

				<?php endif;
			
			?>
				<button id="author-control">About the Author</button>
				
				
			<div id="about-author-box" class="about-author hide clearfix">
				<div class="about-author-image">
					<?php echo get_avatar(get_the_author_meta('ID'), 158)?>
					<?php echo wpautop(get_the_author_meta('nickname')); ?>
				</div>
				<?php $otherAuthorPosts = new WP_Query(array( 
					'author' => get_the_author_meta('ID'),
					'posts_per_page' => 3,
					//'post__not_in' To prevent the current showing post reappear
					'post__not_in' => array(get_the_ID())


				));?>


				<div class="about-author-text">
					<h3>About the Author</h3>
					<?php echo wpautop(get_the_author_meta('description')) ?>

					<?php if ($otherAuthorPosts->have_posts()):?>
					<div class="other-posts-by">
						<h4>Other posts by <?php echo get_the_author_meta('nickname');?></h4>
						<ul>
							<?php while ($otherAuthorPosts->have_posts()){

								$otherAuthorPosts->the_post(); 

								if (get_the_title(get_the_ID())){?>
								<li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>

							<?php }} ?>

						</ul>
					</div>

					<?php endif; 
				//point it back to the begining of the posts 
					wp_reset_postdata();?>

					<?php if (count_user_posts(get_the_author_meta('ID')) > 3){?>
					<a class="btn-a" href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>">View All Posts By <?php echo get_the_author_meta('nickname');?> </a>
					<?php } ?>

				</div>
			</div>
			
			
			


	
		
	</div><!-- /site-content -->
	

<?php get_footer();

?>