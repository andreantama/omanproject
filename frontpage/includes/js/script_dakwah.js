		
$("#side-menu > li.sub") .click(function(){

	if(false == $(this).next().is(":visible")) {
		$("#side-menu > ul").slideUp(300);
	}
	$(this).next().slideToggle(300);
	aler("test ok");
});

$("#side-menu > ul:eq(0)").hide();

/* Images Accordion Menu Dakwah */
$(document).ready(function() {
	$(".body-slide").zAccordion({
		timeout: 3000,
		slideWidth: 275,
		width: 736
	});
});