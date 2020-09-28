jQuery(document).ready(function(){ 
	"use strict";

	jQuery('#main_menu li').each(function()
	{	
	    var jQuerysublist = jQuery(this).find('ul:first');
	    
	    jQuery(this).hover(function()
	    {	
	    	jQuerysublist.addClass('visible');
	    },
	    function()
	    {	
	    	jQuerysublist.removeClass('visible');
	    });
	
	});

	
	jQuery('#menu_wrapper .nav ul li').each(function()
	{
	    var jQuerysublist = jQuery(this).find('ul:first');
	    
	    jQuery(this).hover(function()
	    {	
	    	jQuerysublist.addClass('visible');
	    },
	    function()
	    {	
	    	jQuerysublist.removeClass('visible');
	    });		
	    
	});
	
	var calScreenWidth = jQuery(window).width();
	if(calScreenWidth > 960)
	{
		jQuery('#page_content_wrapper').css('width', calScreenWidth-408+'px');
		jQuery('#map_contact').css('width', calScreenWidth-408+'px');
	}
	else
	{
		jQuery('#page_content_wrapper').addClass('noanimation');
	}
	
	jQuery(window).resize(function() {
		var calScreenWidth = jQuery(window).width();
		
		if(calScreenWidth > 960)
		{
		    jQuery('#page_content_wrapper').css('width', calScreenWidth-408+'px');
		    jQuery('#map_contact').css('width', calScreenWidth-408+'px');
		}
		else
		{
			jQuery('#page_content_wrapper').css('width', '100%');
		    jQuery('#map_contact').css('width', '');
		}
	});
	
	jQuery('#page_caption_wrapper').verticalAlign();
	jQuery('#page_caption_wrapper').addClass('visible');
	jQuery('#page_caption #social_share_wrapper').addClass('visible');
	
	jQuery('#horizontal_gallery_wrapper tbody tr td .gallery_image_wrapper').children('.horizontal_gallery_img').each(function(index, value)
	{
	   	var calScreenWidth = jQuery(window).width();
	   	
	   	jQuery(this).css('max-width', calScreenWidth+'px');
	    jQuery(this).addClass('visible');
	});
	
	var calScreenWidth = jQuery(window).width();
	
	jQuery('#horizontal_gallery_wrapper tbody tr td .gallery_image_wrapper').children('.horizontal_gallery_img').imagesLoaded(function(){
		if(calScreenWidth >= 480)
		{
			jQuery('#horizontal_gallery').verticalAlign();
		}
	});
	
	jQuery(window).resize(function() {
		jQuery('#horizontal_gallery_wrapper tbody tr td .gallery_image_wrapper').children('.horizontal_gallery_img').each(function(index, value)
		{
		   	var calScreenWidth = jQuery(window).width();
		   	
		   	jQuery(this).css('max-width', calScreenWidth+'px');
		    jQuery(this).addClass('visible');
		});
		
		var calScreenWidth = jQuery(window).width();
	
		if(calScreenWidth >= 480)
		{
			jQuery('#horizontal_gallery').verticalAlign();
		}
	});
	
	jQuery(window).resize(function() {
		jQuery('#page_caption_wrapper').verticalAlign();
	});
	
	jQuery('a.fancy-gallery, .flickr li a, .pp_gallery a').hover(
	   function(e) {
	       e.preventDefault();
	   },
	   function() { }
	);
	
	jQuery('.fancy_video, .lightbox_vimeo').magnificPopup({
	  	src: jQuery(this).attr('href'),
	  	type: 'inline',
	  	removalDelay: 300,
	  	mainClass: 'mfp-fade'
	});
	
	jQuery('a.fancy-gallery, .flickr li a, .pp_gallery a').magnificPopup({
	  	type: 'image',
	  	removalDelay: 300,
	  	mainClass: 'mfp-fade',
	  	gallery:{
	    	enabled:true
		}
	});
	
	jQuery('.img_frame').magnificPopup({
	  	type: 'image',
	  	removalDelay: 300,
	  	mainClass: 'mfp-fade'
	});
	
	jQuery('.post_img').click(
		function(event){
			jQuery(this).children('a').trigger('click');
		}
	);
	
	var isDisableRightClick = jQuery('#pp_enable_right_click').val();
	
	if(isDisableRightClick!='')
	{
		jQuery(this).bind("contextmenu", function(e) {
	    	e.preventDefault();
	    });
	}
	
	var isDisableDragging = jQuery('#pp_enable_dragging').val();
	
	if(isDisableDragging!='')
	{
		jQuery("img").mousedown(function(){
		    return false;
		});
	}
    
    var windowWidth = jQuery(window).width();
    var $window = jQuery(window);
    var jQueryblogcontainer = jQuery('#blog_grid_wrapper');
    var blogGridColumn = 2;
	
	function reBlogLayout() {
	
		var currentContainerWidth = jQueryblogcontainer.width();
	
		if(jQueryblogcontainer.hasClass('vertical'))
		{
			var blogGridColumn = 1;
		}
		else
		{
			var blogGridColumn = 2;
			if(jQuery(window).width() < 480)
			{
				blogGridColumn = 1;
			}
			else if(jQuery(window).width() >= 480 && jQuery(window).width() < 1400)
			{
				blogGridColumn = 2;
			}
			else if(jQuery(window).width() >= 1400 && jQuery(window).width() < 1900)
			{
				blogGridColumn = 3;
			}
			else if(jQuery(window).width() >= 1900 && jQuery(window).width() < 2000)
			{
				blogGridColumn = 4;
			}
			else
			{
				blogGridColumn = 5;
			}
		}

	    var masonryOpts = {
		  columnWidth: parseInt(currentContainerWidth/blogGridColumn)
		};

	    jQueryblogcontainer.isotope({
	      resizable: false, // disable resizing by default, we'll trigger it manually
	      itemSelector : '.post.type-post',
	      masonry: masonryOpts
	    }).isotope();
	}
	
	// initialize masonry
	jQuery('#blog_grid_wrapper').imagesLoaded(function(){
	    reBlogLayout();
	      
	    jQuery('#blog_grid_wrapper').children('.post.type-post').each(function(index, value){
		    jQuery(this).addClass('animated'+(index+1));
		    jQuery(this).addClass('visible');
	    });
	    
	    $window.smartresize( reBlogLayout );
	});
	
	// filter items when filter link is clicked
	jQuery('#portfolio_wall_filters li a').click(function(){
	  	var selector = jQuery(this).attr('data-filter');
	  	jQueryblogcontainer.isotope({ filter: selector });
	  	jQuery('#portfolio_wall_filters li a').removeClass('active');
	  	jQuery(this).addClass('active');
	  	return false;
	});
    
    //Add to top button when scrolling
    jQuery(window).scroll(function() {
	 	var calScreenWidth = jQuery(window).width();
		
		if(calScreenWidth > 768)
		{
			if(jQuery(this).scrollTop() > 200) {
				jQuery('#toTop').stop().css({opacity: 1.0, "visibility": "visible"}).animate({"visibility": "visible"}, {duration:500,easing:"easeOutExpo"});
			} else if(jQuery(this).scrollTop() == 0) {
				jQuery('#toTop').stop().css({opacity: 0, "visibility": "hidden"}).animate({"visibility": "hidden"}, {duration:500,easing:"easeOutExpo"});
			}
		}
	});
 
	jQuery('#toTop').click(function() {
		jQuery('body,html').animate({scrollTop:0},800);
	});
	
	jQuery('#menu_close_icon').click(function() {
		jQuery('body').toggleClass('js_nav');
	});
	
	var supersizedWidth = jQuery('#supersized').width();
	var wrapperLeft = jQuery('#wrapper').css('left').replace(/[^-\d\.]/g, '');
	var calScreenWidth = jQuery(window).width();
	var calScreenHeight = jQuery(window).height();
	
	jQuery('#option_btn').click(
    	function() {
    		if(jQuery('#option_wrapper').css('left') != '0px')
    		{
 				jQuery('#option_wrapper').animate({"left": "0px"}, { duration: 500 });
	 			jQuery(this).animate({"left": "250px"}, { duration: 500 });
	 		}
	 		else
	 		{
	 			jQuery('#option_wrapper').animate({"left": "-255px"}, { duration: 500 });
    			jQuery('#option_btn').animate({"left": "0px"}, { duration: 500 });
	 		}
    	}
    );
    
    jQuery('.slider_wrapper').flexslider({
	      animation: "fade",
	      animationLoop: true,
	      itemMargin: 0,
	      minItems: 1,
	      maxItems: 1,
	      slideshow: false,
	      controlNav: false,
	      smoothHeight: true,
	      move: 1
	});
	
	function launchFullscreen(element) {
	  if(element.requestFullscreen) {
	    element.requestFullscreen();
	  } else if(element.mozRequestFullScreen) {
	    element.mozRequestFullScreen();
	  } else if(element.webkitRequestFullscreen) {
	    element.webkitRequestFullscreen();
	  } else if(element.msRequestFullscreen) {
	    element.msRequestFullscreen();
	  }
	}
	
	function exitFullscreen() {
	  if(document.exitFullscreen) {
	    document.exitFullscreen();
	  } else if(document.mozCancelFullScreen) {
	    document.mozCancelFullScreen();
	  } else if(document.webkitExitFullscreen) {
	    document.webkitExitFullscreen();
	  }
	}
	
	jQuery('#page_maximize').click(function(){
		if(jQuery(this).hasClass('minimize'))
		{
			exitFullscreen();
		}
		else
		{
			launchFullscreen(document.documentElement);
		}
		
		jQuery(this).toggleClass('minimize');
	});
	
	if(calScreenWidth > 960)
	{
		jQuery('#full_video_bg').css('width', calScreenWidth+'px');
		jQuery('#full_video_bg').css('height', calScreenHeight+'px');
		jQuery('.grid_cover_wrapper').css('width', calScreenWidth+'px');
		jQuery('.grid_cover_wrapper').css('height', calScreenHeight+'px');
		jQuery('.grid_cover_wrapper').show();
		jQuery('.photo_wall_wrapper_cover').css('top', calScreenHeight-14+'px');
	}
	else if(calScreenWidth <= 960 && calScreenWidth > 480)
	{
		jQuery('#full_video_bg').css('width', calScreenWidth+'px');
		jQuery('#full_video_bg').css('height', calScreenHeight+'px');
		jQuery('.grid_cover_wrapper').css('width', calScreenWidth+'px');
		jQuery('.grid_cover_wrapper').css('height', calScreenHeight+'px');
		jQuery('.grid_cover_wrapper').show();
		jQuery('.photo_wall_wrapper_cover').css('top', calScreenHeight+'px');
	}
	else if(calScreenWidth <= 480)
	{
		jQuery('#full_video_bg').css('width', calScreenWidth+'px');
		jQuery('#full_video_bg').css('height', calScreenHeight+'px');
		jQuery('.grid_cover_wrapper').css('width', calScreenWidth+'px');
		jQuery('.grid_cover_wrapper').css('height', calScreenHeight+'px');
		jQuery('.grid_cover_wrapper').show();
		jQuery('.photo_wall_wrapper_cover').css('top', calScreenHeight+25+'px');
	}
	
	jQuery(window).resize(function() {
		var calScreenWidth = jQuery(window).width();
		var calScreenHeight = jQuery(window).height();
	
		if(calScreenWidth > 960)
		{
			jQuery('#full_video_bg').css('width', calScreenWidth+'px');
			jQuery('#full_video_bg').css('height', calScreenHeight+'px');
			jQuery('.grid_cover_wrapper').css('width', calScreenWidth+'px');
			jQuery('.grid_cover_wrapper').css('height', calScreenHeight+'px');
			jQuery('.grid_cover_wrapper').show();
			jQuery('.photo_wall_wrapper_cover').css('top', calScreenHeight-14+'px');
		}
		else if(calScreenWidth <= 960 && calScreenWidth > 480)
		{
			jQuery('#full_video_bg').css('width', calScreenWidth+'px');
			jQuery('#full_video_bg').css('height', calScreenHeight+'px');
			jQuery('.photo_wall_wrapper_cover').css('top', calScreenHeight+'px');
		}
		else if(calScreenWidth <= 480)
		{
			jQuery('#full_video_bg').css('width', calScreenWidth+'px');
			jQuery('#full_video_bg').css('height', calScreenHeight+'px');
			jQuery('.photo_wall_wrapper_cover').css('top', calScreenHeight+25+'px');
		}
	});
	
	if(jQuery('#pp_menu_display').val()=='true')
	{
		jQuery('#menu_close_icon').trigger('click');
	}
	
	if(jQuery.browser.msie && parseFloat(jQuery.browser.version)<10)
	{
		var calScreenWidth = jQuery(window).width();
		var calScreenHeight = jQuery(window).height();
	
		jQuery('#menu_close_icon').click(function(){
			if(jQuery('#wrapper').css('left') != '1px')
			{
				jQuery('.grid_cover_wrapper').hide();
				jQuery('#wrapper').css('left', '1px');
			}
			else
			{
				jQuery('.grid_cover_wrapper').show();
				jQuery('#wrapper').css('left', '0px');
			}
		});
		
		jQuery.fn.placeholder();
		
		if(jQuery('#pp_menu_display').val()=='true')
		{
			jQuery('#menu_close_icon').trigger('click');
		}
	}
	
	window.onbeforeunload = function(e){
		jQuery('body').addClass('loading');
	}
	
	jQuery('.view_gallery_full').click(function(){
		jQuery('.grid_cover_wrapper').fadeOut(function(){
			jQuery(this).attr("style", "display: none !important");
		});
	});
	
	jQuery('div[data-type="background"]').each(function(){
       var bgobj = jQuery(this);
    
       jQuery(window).scroll(function() {
           var yPos = -(jQuery(window).scrollTop() / bgobj.data('speed')); 
            
           var coords = '50% '+ yPos + 'px';
 
           bgobj.css({ backgroundPosition: coords });
       }); 
    });
	
	jQuery('.progress_bar').each(function(){
		jQuery(this).addClass('fadeIn');
		var progressContent = jQuery(this).children('.progress_bar_content');
	    var progressWidth = progressContent.data('score');
	     
	    progressContent.css({'width': progressWidth+'%'});
    });
    
    jQuery('body[data-style=fullscreen] #wrapper').touchwipe({
    	wipeLeft: function(){ 
        	api.nextSlide();
      	},
       	wipeRight: function(){ 
           	api.prevSlide();
       	}
    });
    
    jQuery('.tooltip').tooltipster();
    
    // Isotope
	// modified Isotope methods for gutters in masonry
	jQuery.Isotope.prototype._getMasonryGutterColumns = function() {
	    var gutter = this.options.masonry && this.options.masonry.gutterWidth || 0;
	    var containerWidth = this.element.width();
  
	this.masonry.columnWidth = this.options.masonry && this.options.masonry.columnWidth ||
              // or use the size of the first item
              this.$filteredAtoms.outerWidth(true) ||
              // if there's no items, use size of container
              containerWidth;

	this.masonry.columnWidth += gutter;

	this.masonry.cols = Math.floor( ( containerWidth + gutter ) / this.masonry.columnWidth );
	this.masonry.cols = Math.max( this.masonry.cols, 1 );
	};

	jQuery.Isotope.prototype._masonryReset = function() {
	    // layout-specific props
	    this.masonry = {};
	    // FIXME shouldn't have to call this again
	    this._getMasonryGutterColumns();
	    var i = this.masonry.cols;
	    this.masonry.colYs = [];
	    while (i--) {
	    	this.masonry.colYs.push( 0 );
	    }
	};

	jQuery.Isotope.prototype._masonryResizeChanged = function() {
	    var prevSegments = this.masonry.cols;
	    // update cols/rows
	    this._getMasonryGutterColumns();
	    // return if updated cols/rows is not equal to previous
	    return ( this.masonry.cols !== prevSegments );
	};
  
	// cache jQuery window
	var $window = jQuery(window);
  
	// cache container
	var $container = jQuery('#photo_wall_wrapper');
	
	// start up isotope with default settings
	$container.imagesLoaded( function(){
	    reLayout();
	    
	    jQuery(this).children('.wall_entry').each(function(index, value){
	    	if(jQuery(this).hasClass('masonry'))
			{
				var imgWidth = jQuery(this).find('.portfolio_img:first').width();
				var imgHeight = jQuery(this).find('.portfolio_img:first').height();
				jQuery(this).find('.mask_image_content:first').css('width', imgWidth-20+'px');
				jQuery(this).find('.mask_image_content:first').css('height', imgHeight-20+'px');
			}
	    
		    jQuery(this).children('.wall_thumbnail').addClass('animated'+(index+1));
		    jQuery(this).children('.wall_thumbnail').addClass('visible');
	    });
	    
	    $window.smartresize( reLayout );
	});
	
	jQuery(window).resize(function() {
		var $container = jQuery('#photo_wall_wrapper');
	
		$container.children('.wall_entry').each(function(index, value){
	    	if(jQuery(this).hasClass('masonry'))
			{
				var imgWidth = jQuery(this).find('.portfolio_img:first').width();
				var imgHeight = jQuery(this).find('.portfolio_img:first').height();
				jQuery(this).find('.mask_image_content:first').css('width', imgWidth-20+'px');
				jQuery(this).find('.mask_image_content:first').css('height', imgHeight-20+'px');
			}
	    });
	});
	
	function reLayout() {
	
		var currentContainerWidth = $container.width();
	
		var columnCount = 3;
		if(jQuery(window).width() < 480)
		{
			columnCount = 1;
		}
		else if(jQuery(window).width() >= 1400 && jQuery(window).width() < 1720)
		{
			columnCount = 4;
		}
		else if(jQuery(window).width() >= 1720 && jQuery(window).width() < 2200)
		{
			columnCount = 5;
		}
		else
		{
			columnCount = 6;
		}
		//alert(parseInt(currentContainerWidth/columnCount));
	    var masonryOpts = {
		  columnWidth: parseInt(currentContainerWidth/columnCount)
		};

	    $container.isotope({
	      resizable: false, // disable resizing by default, we'll trigger it manually
	      itemSelector : '.wall_entry',
	      masonry: masonryOpts
	    }).isotope( 'reLayout' );
	}
	
	jQuery('.portfolio_prev_next_link').each(function(){
		jQuery(this).tooltipster({
			content: jQuery('<img src="'+jQuery(this).attr('data-img')+'" />')
		});
	});
	
	jQuery('.post_prev_next_link').each(function(){
		jQuery(this).tooltipster({
			content: jQuery('<img src="'+jQuery(this).attr('data-img')+'" />')
		});
	});
});
