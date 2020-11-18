var currentPosition = 0;
var bannerCount = null;
var intervalTime = 5000;
var animationDuration = 1000;
var bannerSlideInterval;
var animate = false;

function bannerSlide(hideIndex, showIndex){
	animate = true;
	$('#banner-left > .bannerleft:eq('+ hideIndex +')').animate({
		'left' : '-482px'
	}, animationDuration);
	$('#banner-right > .banner-right-bg:eq('+ hideIndex +')').animate({
		'right' : '-482px'
	}, animationDuration);
	$('#banner-left > .bannerleft:eq('+ showIndex +')').animate({
		'left' : '0px'
	}, animationDuration);
	$('#banner-right > .banner-right-bg:eq('+ showIndex +')').animate({
		'right' : '0px'
	}, animationDuration, function(){
		animate = false;
		$('#nav-slider .button a').removeClass('active');
		$('#nav-slider .button a:eq(' + showIndex + ')').addClass('active');
	});
}


function bannerInit(){
	$('#nav-slider .button a:eq(0)').addClass('active');
	$('#banner-left > .bannerleft').css({
		'left' : '-482px'
	});
	$('#banner-left > .bannerleft:eq(0)').css({
		'left' : '0px'
	});
	
	$('#banner-right > .banner-right-bg').css({
		'right' : '-482px'
	});
	$('#banner-right > .banner-right-bg:eq(0)').css({
		'right' : '0px'
	});
	
	$('#nav-slider a').click(function(){
		if(animate){
			return false;
		}
		clearInterval(bannerSlideInterval);
		var hideIndex = currentPosition;
		
		var rel = $(this).attr('rel');
		
		if(rel == 'next'){
			currentPosition++;
			if(currentPosition >= bannerCount){
				currentPosition = 0;
			}
		}else if(rel == 'prev'){
			currentPosition--;
			if(currentPosition < 0){
				currentPosition = bannerCount-1;
			}
		}else{
			currentPosition = parseInt(rel) - 1;
		}
		var showIndex = currentPosition;
		bannerSlide(hideIndex, showIndex);
		bannerSlide();
		startInterval();
		
		return false;
	});
}

function startInterval(){
	bannerSlideInterval = setInterval(function(){
		var hideIndex = currentPosition;
		currentPosition++;
		if(currentPosition >= bannerCount){
			currentPosition = 0;
		}
		var showIndex = currentPosition;
		bannerSlide(hideIndex, showIndex);
	}, intervalTime);
}

$(document).ready(function(){
	/* BANNER */
	bannerInit();
	/* Cari jumlah banner image */
	bannerCount = $('#banner-left .bannerleft').length;
	/* Start interval */
	startInterval();
	
	/* USAHA SLIDESHOW */
	$("#slider").easySlider({
		auto: true, 
		continuous: true
	});
	
	/* BERITA TERBARU */
	$(window).load(function() {
		$('.latestnews-slides').blueberry();
	});
	
	
});
