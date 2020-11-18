/* 
    Document   : javascript
    Created on : Feb 12, 2013, 11:32:54 AM
    Author     : mogimogi
	Company    : iGlobal
                 http://www.iglobal.co.id
    Description:
      Main script for gallery component
*/

var iglobalComGallery = (function(){
	var container = '#gallery-container';
	var galleryPath = $(container).attr('data-path');
	var url = $(container).attr('data-link');
	var thumbnailContainerSelector = '#thumbnail-container';
	var currentFolder = new Array;
	
	var pageWidth = 600;
	
	var windowSize = {
		width: 0,
		height: 0
	};
	
	var thumbnailMax = {
		width:100,
		height:100
	};
	
	var loader = {
		selector: '#gallery-container .loader',
		delay: 400,
		show: function(callback){
			$(loader.selector).show({
				effect: 'fade',
				duration: loader.delay,
				complete: callback
			});
		},
		hide: function(callback){
			$(loader.selector).hide({
				effect: 'fade',
				duration: loader.delay,
				complete: callback
			});
		}
	}
	
	function getCurrentPath(){
		var currentPath = galleryPath + '/';
		for(var i=0; i<currentFolder.length; i++){
			currentPath += currentFolder[i] + '/';
		}
		return currentPath;
	}
	
	function getList(path){
		loader.show(function(){
			$.ajax({
				url: url,
				type: 'get',
				data: {path: path},
				dataType: 'json',
				error: function(){

				},
				success: function(response){
					if(response.success){
						mappingGallery(response.data);
						if(currentFolder.length < 1){
							$(browser.up).hide(0);
						}else{
							$(browser.up).show(0);
						}
					}
					loader.hide(function(){});
				}
			});
		});
	}
	
	function mappingGallery(data){
		var counter = 0;
		var html = '';
		var dirCount = data.directories.length;
		var fileCount = data.files.length;
		var itemPerPage = 20;
		var currentPath = getCurrentPath();
		
		html += '<div class="rel" style="display:none;">';
		html += '<div class="page">';
		
		
		for(var i=0; i<dirCount; i++){
			if(counter%itemPerPage == 0 && i!=0){
				html += '</div>';
				html += '<div class="page">';
			}
			html += '<div class="thumbnail folder" name="'+ data.directories[i] +'">';
			html += '<h3 class="title">'+ data.directories[i] +'</h1>';
			html += '</div>';
			counter++;
		}
		
		
		for(var i=0; i<fileCount; i++){
			if(counter%itemPerPage == 0 && i!=0){
				html += '</div>';
				html += '<div class="page">';
			}
			html += '<div class="thumbnail file" name="'+ data.directories[i] +'" data-src="'+currentPath+'/'+data.files[i].name+'" data-index="'+i+'">';
				/* Image landscape */
				//html += '<img src="/'+SF_ENVIRONMENT+'.php/api/thumb?file='+ encodeURIComponent(currentPath+'/'+data.files[i].name) +'&width='+thumbnailMax.width+'&height='+thumbnailMax.height+'&type=3"  title="'+data.files[i].name+'" />';
				html += '<img src="/frontpage/thumb/?src=../assets/'+ currentPath+data.files[i].name +'&w='+thumbnailMax.width+'&h='+thumbnailMax.height+'"  title="'+data.files[i].name+'" />';
				
				/* Image Potrait */
				/*
				html += '<img src="assets/'+galleryPath+'/'+data.files[i].name+'" height="'+thumbnailMax.height+'" title="'+data.files[i].name+'" />';
				*/
			   html += '<h3 class="title">'+ data.files[i].name +'</h1>';
			html += '</div>';
			counter++;
		}
		html += '</div>';
		html += '</div>';
		$(thumbnailContainerSelector).html(html);
		
		var pageCount = $('#thumbnail-container .page').length;
		var relWidth = pageCount * pageWidth;
		
		generatePagination(pageCount);
		$('#thumbnail-container .rel').width(relWidth).show();
	}
	
	function generatePagination(pageCount){
		var html = '<div class="pagination">';
		for(var i=1; i<=pageCount; i++){
			html += '<a class="page-button" href="javascript:void(0)" data-page="' + i + '">' + i + '</a>';
		}
		html += '</div>';
		$(thumbnailContainerSelector).append(html);
		$(thumbnailContainerSelector).find('.page-button').eq(0).addClass('current');
	}
	
	function paginationButton(){
		$(thumbnailContainerSelector).on('click', '.pagination .page-button', function(){
			$(thumbnailContainerSelector).find('.page-button').removeClass('current');
			$(this).addClass('current');
			var page = $(this).attr('data-page');
			var left = - ((page-1) * pageWidth);
			
			$('.rel', thumbnailContainerSelector).animate({
				'left':left + 'px'
			}, 500, 'easeOutCirc');
		});
	}
	
	function prepareElement(){
		/* ADD Loader In Container */
		var thumbnailContainer = '<div id="thumbnail-container"></div>';
		var backButton = '<a id="thumbnail-back" href="javascript:void(0)" title="back" style="display:none;">Back</a>'
		var thumbnailPagination = '<div id="thumbnail-pagination"></div>';
		var insideLoader = '<div class="loader"><div class="bg"></div><div class="animation"></div></div>';
		$(container).html(backButton + thumbnailContainer + thumbnailPagination + insideLoader);
		
		/* Add Popup Element */
		var html = '';
		html += '<div id="gallery-popup">';
			html += '<div class="bg"></div>';
			html += '<div class="loader"></div>';
			html += '<div class="image-container">';
				html += '<div class="image"></div>'
				html += '<a href="javascript:void(0)" class="next navigation" title="next">next</a>';
				html += '<a href="javascript:void(0)" class="prev navigation" title="prev">prev</a>';
			html += '</div>';
		html += '<div>';
		
		$('body').append(html);
	}
	
	function getWindowSize(){
		windowSize.height = $(window).height();
		windowSize.width = $(window).width();
	}
	
	var popup = {
		thumbnail: '#thumbnail-container .file',
		imageContainer: '#gallery-popup .image-container',
		imagePlace: '#gallery-popup .image',
		navigation: '#gallery-popup .image-container .navigation',
		nav:'',
		thumbnailIndex:'',
		thumbnailLength:'',
		area: {
			delay: 200,
			selector: '#gallery-popup',
			show: function(callback){
				$(popup.area.selector).show({
					effect: 'fade',
					duration: popup.area.delay,
					complete: callback
				});
			},
			hide: function(callback){
				$(popup.area.selector).hide({
					effect: 'fade',
					duration: popup.area.delay,
					complete: callback
				});
			}
		},
		init: function(){
			var enableClick = true;
			var maxImageWidth = Math.round(80/100 * windowSize.width);
			var maxImageHeight = Math.round(80/100 * windowSize.height);
			
			popup.thumbnailLength = $(popup.thumbnail).length;
			
			$(document).on('click', popup.imageContainer, function(e){
				e.stopPropagation;
				return false;
			});
			
			$(document).on('click', popup.thumbnail, function(){
				//var imageSource = SF_ENVIRONMENT+'.php/api/thumb?file='+encodeURIComponent($(this).attr('data-src'))+'&width='+maxImageWidth+'&height='+maxImageHeight+'&type=3';
				var imageSource = 'frontpage/thumb/?src=../assets/'+$(this).attr('data-src')+'&w='+maxImageWidth+'&h='+maxImageHeight;
				popup.thumbnailIndex = $(this).index();
				
				if(enableClick){
					enableClick = false;
					var html = '<img src="'+imageSource+'" />';
					$(popup.imagePlace).html(html);
					popup.area.show(function(){
						enableClick = true;
						var popupImage = new Image;
						popupImage.src = imageSource;
						popupImage.onload = function(){
							var imgHeight = popupImage.height;
							var imgWidth = popupImage.width;
							
							/* Setup Position */
							var posX = Math.round((windowSize.width-imgWidth)/2);
							var posY = Math.round((windowSize.height-imgHeight)/2);
							
							$(popup.imageContainer).css({
								'top': windowSize.height/2 + 'px',
								'left': windowSize.width/2 + 'px',
								'display':'block',
								'width':0,
								'height':0
							}).animate({
								'top':posY+'px',
								'left':posX+'px',
								'width':imgWidth+'px',
								'height':imgHeight+'px'
							}, 500, 'easeOutCirc');
							
							$(popup.imagePlace).find('img').css({
								'width':0,
								'height':0
							}).animate({
								'width':imgWidth+'px',
								'height':imgHeight+'px'
							}, 500, 'easeOutCirc');
							
						};
					});
				}
				
			});
			
			$(document).on('click', popup.navigation, function(){
				if(!enableClick){
					return false;
				}
				enableClick = false;
				
				popup.nav = $(this).attr('title');
				if(popup.nav != 'prev' && popup.nav != 'next'){
					return false;
				}
				
				popup.thumbnailLength = $(popup.thumbnail).length;
				if(popup.nav=='prev'){
					popup.thumbnailIndex--;
					if(popup.thumbnailIndex < 0){
						popup.thumbnailIndex = popup.thumbnailLength-1;
					}
				}else{
					popup.thumbnailIndex++;
					if(popup.thumbnailIndex >= popup.thumbnailLength){
						popup.thumbnailIndex = 0;
					}
				}
				
				//var imageSource = SF_ENVIRONMENT+'.php/api/thumb?file='+encodeURIComponent($(popup.thumbnail).eq(popup.thumbnailIndex).attr('data-src'))+'&width='+maxImageWidth+'&height='+maxImageHeight+'&type=3';
				var imageSource = 'frontpage/thumb/?src=../assets/'+$(popup.thumbnail).eq(popup.thumbnailIndex).attr('data-src')+'&w='+maxImageWidth+'&h='+maxImageHeight;
				
				/* CALLBACK FUNCTION AFTER IMAGE HIDE */
				var callbackFunction = function(){
					var html = '<img src="'+imageSource+'" />';
					$(popup.imagePlace).html(html);
					var popupImage = new Image;
					popupImage.src = imageSource;
					popupImage.onload = function(){
						var imgHeight = popupImage.height;
						var imgWidth = popupImage.width;
							
						/* Setup Position */
						var posX = Math.round((windowSize.width-imgWidth)/2);
						var posY = Math.round((windowSize.height-imgHeight)/2);
						
						$(popup.imageContainer).animate({
							'top':posY+'px',
							'left':posX+'px',
							'width':imgWidth+'px',
							'height':imgHeight+'px'
						}, 1000, 'easeInOutCubic');
						$(popup.imagePlace).find('img').css({
							'width':0,
							'height':0
						}).animate({
							'width':imgWidth+'px',
							'height':imgHeight+'px'
						}, 1000, 'easeInOutCubic');
						
						enableClick = true;
					};
				};
				
				if(popup.nav=='prev'){
					$(popup.imageContainer).animate({
						'top':windowSize.height,
						'left':windowSize.width,
						'width':0,
						'height':0
					}, 1000, 'easeOutCirc', function(){
						$(this).css({
							'left':0
						});
					});
					$(popup.imagePlace).find('img').animate({
						'width':0,
						'height':0
					}, 1000, 'easeOutCirc', callbackFunction());
				}else{
					$(popup.imageContainer).animate({
						'top':windowSize.height,
						'left':0,
						'width':0,
						'height':0
					}, 1000, 'easeOutCirc', function(){
						$(this).css({
							'left':windowSize.width
						});
					});
					$(popup.imagePlace).find('img').animate({
						'width':0,
						'height':0
					}, 1000, 'easeOutCirc', callbackFunction());
				}
				
				
			});
			
			/* POPUP CLOSE */
			$(document).on('click', popup.area.selector, function(){
				if(enableClick){
					enableClick = false;
					popup.area.hide(function(){
						$(popup.imageContainer).hide(0);
						enableClick = true;
					});
				}
			});
		}
	};
	
	var browser = {
		folderElement: '#thumbnail-container .page .thumbnail.folder',
		up: '#thumbnail-back',
		init: function(){
			$(document).on('click', browser.folderElement, function(){
				currentFolder.push($(this).attr('name'));
				var currentPath = getCurrentPath();
				getList(currentPath);
			});
			$(document).on('click', browser.up, function(){
				currentFolder.pop();
				var currentPath = getCurrentPath();
				getList(currentPath);
			});
		}
	};
	
	return {
		init: function(){
			getWindowSize();
			prepareElement();
			paginationButton();
			getList(galleryPath);
			console.log(galleryPath);
			popup.init();
			browser.init();
			
			$('#refresh').click(function(){
				getList(galleryPath);
			});
		}
	}
})();

$(document).ready(function(){
	iglobalComGallery.init();
});