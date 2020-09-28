jQuery('.gallery_img_slides').cycle({
    fx:  'fade',
    delay: 1000,
    speed:   800,
    timeout: 800,
}).cycle("pause");
	
// Pause & play on hover
jQuery('.wall_thumbnail').hover(function(){
    jQuery(this).find('.gallery_img_slides').addClass('active').cycle('resume');
}, function(){
    jQuery(this).find('.gallery_img_slides').removeClass('active').cycle('pause');
});