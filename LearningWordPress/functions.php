<?php

function learningwordpress_resources(){
	
	wp_enqueue_style('style', get_stylesheet_uri());
	wp_register_script('main-jq', plugins_url('main-jq',__FILE__), array('jquery'));
	wp_enqueue_script('main-jq');
	//include js/main.js
	wp_enqueue_script('main_js', get_template_directory_uri().'/js/main.js', NULL, 1.0, true);
	//include js/main_jq.js
	wp_enqueue_script('main_jq_js', get_template_directory_uri().'/js/main-jq.js', NULL, 1.0, true);
	wp_enqueue_style('googlefont', '//fonts.googleapis.com/css?family=Arvo', array(), CHILD_THEME_VERSION);
	
	wp_localize_script('main_js', 'PhilsData', array(
		'nonce' => wp_create_nonce('wp_rest'),
		'siteURL' => get_site_url()
	
	));
	
}

add_action('wp_enqueue_scripts', 'learningwordpress_resources');



//Get top ancestor
function get_top_ancestor_id(){
	
	global $post;
	
	if ($post->post_parent){
		//The get the nearest ancestor instead
		$ancestors = array_reverse(get_post_ancestors($post->ID));
		return $ancestors[0];
	}
	return $post->ID;
	
}


// Check if page has childrens or not
function has_children(){
	global $post;
	
	//build-in function "get_pages"
	$pages = get_pages('child_of='.$post->ID);
	
	return count($pages);
	
	
}


// Customize excerpt word count length
function custom_excerpt_length(){
	
	return 25;
} 

add_filter('excerpt_length','custom_excerpt_length');
	

//Theme Setup
function learningWordPress_setup(){
	
	//Navigation Menus
register_nav_menus(array(
	//"self-assigned name" => __("The name display in dashboard")
	
	"primary" => __("Primary Menu"),
	"footer" => __("Footer Menu"),

));

	
	// Add feature image support
	add_theme_support('post-thumbnails');
	add_image_size('small-thumbnail',180, 120, true);
	add_image_size('square-thumbnail', 88, 87, true);
	add_image_size('banner-image', 920, 210, array('left','top'));
	
	
	//Add post format support
	add_theme_support('post-formats', array('aside', 'gallery', 'link'));
}

add_action('after_setup_theme','learningWordPress_setup');
	
	
// Add Widget Areas
function ourWidgetsInit() {
	
	register_sidebar( array(
		'name' => 'Sidebar',
		'id' => 'sidebar1',
		'before_widget' => '<div class="widget-item">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	
	register_sidebar( array(
		'name' => 'Footer Area 1',
		'id' => 'footer1',
		'before_widget' => '<div class="widget-item">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	
	register_sidebar( array(
		'name' => 'Footer Area 2',
		'id' => 'footer2',
		'before_widget' => '<div class="widget-item">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	
	register_sidebar( array(
		'name' => 'Footer Area 3',
		'id' => 'footer3',
		'before_widget' => '<div class="widget-item">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	
	register_sidebar( array(
		'name' => 'Footer Area 4',
		'id' => 'footer4',
		'before_widget' => '<div class="widget-item">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	
}

add_action('widgets_init', 'ourWidgetsInit');

// Customize Appearance Options
function learningWordPress_customize_register( $wp_customize  ){
	$wp_customize->add_setting('lwp_link_color', array(
		'default' => '#006ec3',
		'transport' => 'refresh',
	));
	
	$wp_customize->add_setting('lwp_btn_color', array(
		'default' => '#006ec3',
		'transport' => 'refresh',
	));
	
		$wp_customize->add_setting('lwp_hover_color', array(
		'default' => '#006ec3',
		'transport' => 'refresh',
	));
	
	$wp_customize->add_section('lwp_standard_colors', array(
		'title' => __('Standard Colors', 'LearningWordPress'),
		'priority' => 20,
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lwp_link_color_control', array(
			'label' => __('Link Color', 'LearningWordPress'),
			'section' => 'lwp_standard_colors',
			'settings' => 'lwp_link_color'
	)) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lwp_btn_color_control', array(
			'label' => __('Button Color', 'LearningWordPress'),
			'section' => 'lwp_standard_colors',
			'settings' => 'lwp_btn_color'
	)) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lwp_hover_color_control', array(
			'label' => __('Hover Color', 'LearningWordPress'),
			'section' => 'lwp_standard_colors',
			'settings' => 'lwp_hover_color'
	)) );
}

add_action('customize_register', 'learningWordPress_customize_register');

//Output Customize CSS
function learningWordPress_customize_css(){?>
	<style type="text/css">
	a:link,
	a:visited {
	color: <?php echo get_theme_mod('lwp_link_color'); ?>;
	}

	.site-header nav ul li.current-menu-item a:link,
	.site-header nav ul li.current-menu-item a:visited,
	.site-header nav ul li.current-page-ancestor a:link,
		.site-header nav ul li.current-page-ancestor a:visited{
			background-color: <?php echo get_theme_mod('lwp_link_color'); ?>;
	}
	
	.btn-a,
	.btn-a:link,
	.btn-a:visited,
	div.hd-search #searchsubmit,
	.footer-widget-area .widget-item #searchsubmit{
		background-color: <?php echo get_theme_mod('lwp_btn_color'); ?>;	
	}
	
		a:hover{
			color: <?php echo get_theme_mod('lwp_hover_color');?>;
		}
		
</style>
	
<?php }

add_action('wp_head', 'learningWordPress_customize_css');


//Add Footer callout section to admin appearance customize screen

function lwp_footer_callout($wp_customize) {
	$wp_customize->add_section('lwp-footer-callout-section', array(
		'title' => 'Footer Callout'
	));
	
	$wp_customize->add_setting('lwp-footer-callout-display' , array(
		'default' => 'No'
	));
	
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'lwp-footer-callout-display-control', array(
		'label' => 'Display this section?',
		'section' => 'lwp-footer-callout-section',
		'settings' => 'lwp-footer-callout-display',
		'type' => 'select',
		'choices' => array('No' => 'No', 'Yes' => 'Yes'),
	)));
	
	
	$wp_customize->add_setting('lwp-footer-callout-headline' , array(
		'default' => 'Example Headline Text'
	));
	
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'lwp-footer-callout-headline-control', array(
		'label' => 'Headline',
		'section' => 'lwp-footer-callout-section',
		'settings' => 'lwp-footer-callout-headline',
	)));
	
	$wp_customize->add_setting('lwp-footer-callout-text' , array(
		'default' => 'Example Paragraph'
	));
	
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'lwp-footer-callout-text-control', array(
		'label' => 'Text',
		'section' => 'lwp-footer-callout-section',
		'settings' => 'lwp-footer-callout-text',
		'type' => 'textarea'
	)));
	
	$wp_customize->add_setting('lwp-footer-callout-link');
	
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'lwp-footer-callout-link-control', array(
		'label' => 'Link',
		'section' => 'lwp-footer-callout-section',
		'settings' => 'lwp-footer-callout-link',
		'type' => 'dropdown-pages'
	)));
	
	$wp_customize->add_setting('lwp-footer-callout-image');
	
	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'lwp-footer-callout-image-control', array(
		'label' => 'Image',
		'section' => 'lwp-footer-callout-section',
		'settings' => 'lwp-footer-callout-image',
		'width' => 750,
		'height' => 500
		
	)));
}

add_action('customize_register','lwp_footer_callout');