<!Doctype html> 
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset');?>">
	<meta name="viewport" content="width=device-width">
	<title><?php bloginfo('name');?></title>
	<?php wp_head();?>
</head>


<body <?php body_class(); ?>>
<div class="container">
<!-- site-header -->
<header class="site-header">


	<!--hd-search-->
	<div class="hd-search">
	
			<?php 
		get_search_form();
		
		?>
		
	</div><!--/hd-search-->
	<div class="clearfix">
		<a href="<?php echo home_url();?>"><img src="<?php echo get_template_directory_uri(); ?>/images/Leaf.png"></a>
	<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name');?></a></h1>
	</div>
	<h5><?php bloginfo('description'); ?>
	<?php if (is_page('Portfolio')){?>
		- Thank you for viewing our work
	
	<?php } ?></h5>
	
	
	
	<nav class="site-nav">
		<?php
		
		$args = array(
			"theme_location" => "primary"
		
		);
		?>
			
		<?php wp_nav_menu( $args ); ?>
	</nav>
</header><!-- /site-header -->