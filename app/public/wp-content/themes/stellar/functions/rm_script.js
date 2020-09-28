function removeSortRecord(thisParentLi, targetObj)
{
	jQuery('li#'+thisParentLi+'_sort').remove();
	var order = jQuery('#'+targetObj).sortable('toArray');
    jQuery('#'+targetObj+'_data').val(order);
}

jQuery(document).ready(function(){

    jQuery('#current_sidebar li a.sidebar_del').click(function(){
    	if(confirm('Are you sure you want to delete this sidebar? (this can not be undone)'))
    	{
    		sTarget = jQuery(this).attr('href');
    		sSidebar = jQuery(this).attr('rel');
    		objTarget = jQuery(this).parent('li');
    		
    		jQuery.ajax({
        		type: 'POST',
        		url: sTarget,
        		data: 'sidebar_id='+sSidebar,
        		success: function(msg){ 
        			objTarget.fadeOut();
        			setTimeout(function() {
                      location.reload();
                    }, 1000);
        		}
        	});
    	}
    	
    	return false;
    });
    
    jQuery('#current_ggfont li a.ggfont_del').click(function(){
	    if(confirm('Are you sure you want to delete this font? (this can not be undone)'))
	    {
	    	sTarget = jQuery(this).attr('href');
	    	sGGFont = jQuery(this).attr('rel');
	    	objTarget = jQuery(this).parent('li');
	    	
	    	jQuery.ajax({
  	    		type: 'POST',
  	    		url: sTarget,
  	    		data: 'ggfont='+sGGFont,
  	    		success: function(msg){ 
  	    			objTarget.fadeOut();
  	    			setTimeout(function() {
                      location.reload();
                    }, 1000);
  	    		}
	    	});
	    }
	    
	    return false;
	});
    
    jQuery('a.image_del').click(function(){
    	if(confirm('Are you sure you want to delete this image? (this can not be undone)'))
    	{
    		sTarget = jQuery(this).attr('href');
    		sFieldId = jQuery(this).attr('rel');
    		objTarget = jQuery('#'+sFieldId+'_wrapper');
    		
    		jQuery.ajax({
        		type: 'POST',
        		url: sTarget,
        		data: 'field_id='+sFieldId,
        		success: function(msg){ 
        			objTarget.fadeOut();
        			setTimeout(function() {
                      location.reload();
                    }, 1000); 
        		}
        	});
    	}
    	
    	return false;
    });
    
    jQuery('#current_sidebar li a.sidebar_del').click(function(){
    	if(confirm('Are you sure you want to delete this sidebar? (this can not be undone)'))
    	{
    		sTarget = jQuery(this).attr('href');
    		sSidebar = jQuery(this).attr('rel');
    		objTarget = jQuery(this).parent('li');
    		
    		jQuery.ajax({
        		type: 'POST',
        		url: sTarget,
        		data: 'sidebar_id='+sSidebar,
        		success: function(msg){ 
        			objTarget.fadeOut();
        			setTimeout(function() {
                      location.reload();
                    }, 1000);
        		}
        	});
    	}
    	
    	return false;
    });
    
    jQuery('#pp_advance_clear_cache').click(function(){
    	if(confirm('Are you sure you want to clear all cache'))
    	{
    		sTarget = jQuery(this).attr('href');
    		
    		jQuery.ajax({
        		type: 'POST',
        		url: sTarget,
        		data: 'method=clear_cache',
        		success: function(msg){ 
        			jQuery('#pp_advance_clear_cache').html('Successfully cleared. Click here to clear cache files again');
        		}
        	});
    	}
    	
    	return false;
    });
    
   jQuery('#pp_panel a').click(function(){
    	jQuery('#pp_panel a').removeClass('nav-tab-active');
    	jQuery(this).addClass('nav-tab-active');
    	
    	jQuery('.rm_section').css('display', 'none');
    	jQuery(jQuery(this).attr('href')).fadeIn();
    	jQuery('#current_tab').val(jQuery(this).attr('href'));
    	
    	return false;
    });
    
    jQuery('.color_picker').each(function()
	{	
	    var inputID = jQuery(this).attr('id');
	    
	    jQuery(this).ColorPicker({
	    	color: jQuery(this).val(),
	    	onShow: function (colpkr) {
	    		jQuery(colpkr).fadeIn(200);
	    		return false;
	    	},
	    	onHide: function (colpkr) {
	    		jQuery(colpkr).fadeOut(200);
	    		return false;
	    	},
	    	onChange: function (hsb, hex, rgb, el) {
	    		jQuery('#'+inputID).val('#' + hex);
	    		jQuery('#'+inputID+'_bg').css('backgroundColor', '#' + hex);
	    	}
	    });	
	    
	    jQuery(this).css('width', '200px');
	    jQuery(this).css('float', 'left');
	});
	
	jQuery('.iphone_checkboxes').iCheck({
		    checkboxClass: 'icheckbox_flat-green',
		    radioClass: 'iradio_flat-green'
		  });
    
    jQuery('.rm_section').css('display', 'none');
    
    if(self.document.location.hash != '')
	{
	    jQuery('html, body').animate({scrollTop:0}, 'fast');
	    jQuery('.nav-tab').removeClass('nav-tab-active');
	    jQuery('a'+self.document.location.hash+'_a').addClass('nav-tab-active');
	    jQuery('div'+self.document.location.hash).css('display', 'block');
	    jQuery('#current_tab').val(self.document.location.hash);
	}
	else
	{
	    jQuery('div#pp_panel_general').css('display', 'block');
	}
    
    jQuery( ".pp_sortable" ).sortable({
	    placeholder: "ui-state-highlight",
	    create: function(event, ui) { 
	    	myCheckRel = jQuery(this).attr('rel');
	    
	    	var order = jQuery(this).sortable('toArray');
        	jQuery('#'+myCheckRel).val(order);
	    },
	    update: function(event, ui) {
	    	myCheckRel = jQuery(this).attr('rel');
	    
	    	var order = jQuery(this).sortable('toArray');
        	jQuery('#'+myCheckRel).val(order);
	    }
	});
	jQuery( ".pp_sortable" ).disableSelection();
	
	jQuery(".pp_checkbox input").change(function(){
	    myCheckId = jQuery(this).val();
	    myCheckRel = jQuery(this).attr('rel');
	    myCheckTitle = jQuery(this).attr('alt');
	    
	    if (jQuery(this).is(':checked')) { 
	    	jQuery('#'+myCheckRel).append('<li id="'+myCheckId+'_sort" class="ui-state-default">'+myCheckTitle+'</li>');
	    } 
	    else
	    {
	    	jQuery('#'+myCheckId+'_sort').remove();
	    }

	    var order = jQuery('#'+myCheckRel).sortable('toArray');

        jQuery('#'+myCheckRel+'_data').val(order);
	});
	
	jQuery(".pp_sortable_button").click(function(){
	    var targetSelect = jQuery('#'+jQuery(this).attr('data-rel'));
	    
	    myCheckId = targetSelect.find("option:selected").val();
	    myCheckRel = targetSelect.find("option:selected").attr('data-rel');
	    myCheckTitle = targetSelect.find("option:selected").attr('title');

	    if (jQuery('#'+myCheckRel).children('li#'+myCheckId+'_sort').length == 0)
	    {
	    	jQuery('#'+myCheckRel).append('<li id="'+myCheckId+'_sort" class="ui-state-default"><div class="title">'+myCheckTitle+'</div><a data-rel="'+myCheckRel+'" href="javascript:removeSortRecord(\''+myCheckId+'\', \''+myCheckRel+'\');" class="remove">x</a><br style="clear:both"/></li>');
	    	//jQuery('#'+myCheckId+'_sort').remove();
	    	
	    	var order = jQuery('#'+myCheckRel).sortable('toArray');
        	jQuery('#'+myCheckRel+'_data').val(order);
        }
        else
        {
        	alert('You have already added "'+myCheckTitle+'"');
        }
	});
	
	jQuery(".pp_sortable li a.remove").click(function(){
	    jQuery(this).parent('li').remove();
	    var order = jQuery('#'+jQuery(this).attr('data-rel')).sortable('toArray');
        jQuery('#'+jQuery(this).attr('data-rel')+'_data').val(order);
	});
    
    jQuery(".pp_font").change(function(){
    	var valueElement = jQuery(this).data('value');
    	var sampleElement = jQuery(this).data('sample');
    	jQuery("#"+valueElement).attr('value', jQuery(this).children("option:selected").attr('data-family'));
    
    	var ppGGFont = 'https://fonts.googleapis.com/css?family='+jQuery(this).val();
    	jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+valueElement+'" href="'+ppGGFont+'" type="text/css" media="all">');
    	
    	if(jQuery(this).children("option:selected").attr('data-family') != '')
    	{
    		jQuery('#'+sampleElement).css('font-family', '"'+jQuery(this).children("option:selected").attr('data-family')+'"');
    	}
    });
    
    jQuery(".pp_font").each(function(){
    	jQuery(this).trigger('change');
    });
    
    var formfield = '';
    
    jQuery('.metabox_upload_btn').click(function() {
			jQuery('.fancybox-overlay').css('visibility', 'hidden');
			jQuery('.fancybox-wrap').css('visibility', 'hidden');
         	formfield = jQuery(this).attr('rel');
	        
	        var send_attachment_bkp = wp.media.editor.send.attachment;
		    wp.media.editor.send.attachment = function(props, attachment) {
	         	jQuery('#'+formfield).attr('value', attachment.url);
		
		        wp.media.editor.send.attachment = send_attachment_bkp;
		        jQuery('.fancybox-overlay').css('visibility', 'visible');
	         	jQuery('.fancybox-wrap').css('visibility', 'visible');
		    }
		
		    wp.media.editor.open();
         	return false;
        });	
        
        jQuery("input.upload_text").click(function() { jQuery(this).select(); } );
				
	jQuery(window).scroll(function(){
	    if(jQuery(this).scrollTop() >= 100){
	    	jQuery('.header_wrap').addClass('fixed');
	    }
	    else if(jQuery(this).scrollTop() < 100)
	    {
	        jQuery('.header_wrap').removeClass('fixed');
	    }
	});
	
	jQuery('#pp_export_current_button').click(function(){
    	jQuery('#pp_export_current').val(1);
    });
    
    jQuery('#pp_import_default_button').click(function(){
		jQuery('#pp_import_default').val(1);
	});
    
    jQuery('#import_demo li').click(function(){
	    jQuery('#import_demo li').removeClass('selected');
	    jQuery(this).addClass('selected');
	    
	    var selectedDemo = jQuery(this).data('demo');
	    jQuery('#pp_import_demo').val(selectedDemo);
	});
});