var imagePopup = {
	duration: 500,
	resizeThrottle: 50,
	fade: 0.5,
	width: 0,
	height: 0,
	resizeTimeout: false,
	ready: false,
	marginTop: 20,
	marginLeft: 20,
	src: false,
	buildPlot: function(){
		var additional = '';
		additional += '<div id="imagepopup">';
		additional += '<div class="disabler"></div>';
		additional += '<div class="imageplot"></div>';
		additional += '<div class="loader"></div>';
		
		additional += '</div>';
		
		$('body').append(additional);
		imagePopup.popupInit();
	},
	popupInit: function() {
		var animate = false;
		$('.textarea').on('click', 'img', function(){
			imagePopup.getImage($(this));
			$('#imagepopup').show();
			animate = true;
			$('#imagepopup .disabler').fadeTo(imagePopup.duration, imagePopup.fade, function(){
				animate = false;
			});
		})
		
		$('#imagepopup .disabler').click(function(){
			if(!animate){
				$('#imagepopup').hide(imagePopup.duration, function(){
					$(this).fadeOut(imagePopup.duration, function(){});
				});
				
			}
		});
	},
	getImage: function(imageObject){
		var src = imageObject.attr('src');
		
		var image = new Image();
		image.src = src;
		image.onload = function(){
			imagePopup.width = this.width;
			imagePopup.height = this.height;
			imagePopup.src = this.src;
			imagePopup.ready = true;
			
			
			var windowWidth = $(window).width();
			var windowHeight = $(window).height();
			var html = '<img src="' + imagePopup.src + '" width="0" height="0" />';
			$('#imagepopup .imageplot').html(html);
			$('#imagepopup .imageplot').css({
				'top': windowHeight/2,
				'left':windowWidth/2,
				'height':0,
				'width':0
			});
			
			$(window).resize();
		};
	},
	windowResize: function(){
		var windowWidth = $(window).width();
		var windowHeight = $(window).height();
		
		var newWidth = 0;
		var newHeight = 0;
		
		var maxWidth = windowWidth - (imagePopup.marginLeft * 2);
		var maxHeight = windowHeight - (imagePopup.marginTop * 2);
		
		var width = imagePopup.width;
		var height = imagePopup.height;
		if(imagePopup.width > maxWidth){
			newWidth = maxWidth;
			newHeight = newWidth/width * height;
			
			width = newWidth;
			height = newHeight;
		}
		
		if(newHeight > maxHeight){
			newHeight = maxHeight;
			newWidth = newHeight/height * width;
			
			width = newWidth;
			height = newHeight;
		}
		
		var marginTop = (windowHeight - height) / 2;
		var marginLeft = (windowWidth - width) / 2;
		
		imagePopup.fitImage(width, height, marginTop, marginLeft);
		
	},
	fitImage: function(width, height, top, left){
		$('#imagepopup .imageplot').animate({
			'width': width,
			'height': height,
			'top': top,
			'left': left
		}, imagePopup.duration);
		$('#imagepopup .imageplot img').animate({
			'width': width,
			'height': height
		}, imagePopup.duration);
	},
	init: function(){
		/* SETUP POINTER CURSOR ON IMAGE */
		$('.textarea img').css({'cursor': 'pointer'});
		
		imagePopup.buildPlot();
		
		
		$(window).resize(function(){
			if(!imagePopup.ready){
				return;
			}
			if(imagePopup.resizeTimeout){
				clearTimeout(imagePopup.resizeTimeout);
			}
			
			imagePopup.resizeTimeout = setTimeout(imagePopup.windowResize, imagePopup.resizeThrottle);
			
		});
	}
};

$(document).ready(function(){
	imagePopup.init();
	
});
