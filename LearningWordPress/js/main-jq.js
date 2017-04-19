jQuery(document).ready(function($) {
   //Author Info Display Control
	$('#author-control').click(function(){
		$('#about-author-box').toggle('slow');
	});
	
//Jquery DropDown Menu form [https://gist.github.com/Narga/2886171]	
	if(!jQuery.browser.msie){jQuery("ul.topnav").css({opacity:"0.95"});}	// IE  - 2nd level Fix
	jQuery(".topnav > li > ul").css({display: "none"});						// Opera Fix

	jQuery("ul.menu li a").hover(function() { //When trigger is clicked...
		//Following events are applied to the subnav itself (moving subnav up and down)
		jQuery(this).parent().find("ul.sub-menu").slideDown('fast').show(400); //Drop down the subnav on hover
		jQuery(this).parent().hover(function() {
		}, function(){	
			jQuery(this).parent().find("ul.sub-menu").slideUp('slow'); //When the mouse hovers out of the subnav, move it back up
		});
		//Following events are applied to the trigger (Hover events for the trigger)
		}).hover(function() { 
			jQuery(this).addClass("subhover"); //On hover over, add class "subhover"
		}, function(){	//On Hover Out
			jQuery(this).removeClass("subhover"); //On hover out, remove class "subhover"
	});
		
	
});