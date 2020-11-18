/* Accordion di dalam tentang kami */
$(document).ready(function(){
	
	//Set default open/close settings
	$('.acc_container').hide(); //Hide/close all containers
	$('.acc_trigger:first').addClass('active').next().show(); //Add "active" class to first trigger, then show/open the immediate next container

	//On Click
	$('.acc_trigger').click(function(){
		if( $(this).next().is(':hidden') ) { //If immediate next container is closed...
			$('.acc_trigger').removeClass('active').next().slideUp(); //Remove all .acc_trigger classes and slide up the immediate next container
			$(this).toggleClass('active').next().slideDown(); //Add .acc_trigger class to clicked trigger and slide down the immediate next container
		}
		return false; //Prevent the browser jump to the link anchor
	});
});

/* Side Menu Accordion */ 
$(document).ready(function() {
	
	$(document).on("click", "#side-menu > li.sub", function(){
		if($(this).next("ul.sub-side-menu").is(":visible") === false) {
			$(this).next("ul.sub-side-menu").slideDown(300);
		}else{
			$(this).next("ul.sub-side-menu").slideUp(300);
		}
		
		return false;
	});	
	
/*	$(document).on("click", "ul.sub-side-menu > li", function(){
		if($(this).next("ul.sub-side-menu").is(":visible") === false) {
			$(this).next("ul.sub-side-menu").slideDown(300);
		}else{
			$(this).next("ul.sub-side-menu").slideUp(300);
		}
		
		return false;
	});	*/
	
	$("#side-menu > ul:eq(0)").hide();
	
	$(".sub-side-menu.active").show();
});