<?php

/*
	Begin Create Shortcode Generator Options
*/

add_action('admin_menu', 'pp_shortcode_generator');

function pp_shortcode_generator() {

  //add_submenu_page('functions.php', 'Shortcode Generator', 'Shortcode Generator', 'manage_options', 'pp_shortcode_generator', 'pp_shortcode_generator_options');
  
  global $page_postmetas;
	if ( function_exists('add_meta_box') && isset($page_postmetas) && count($page_postmetas) > 0 ) {  
		add_meta_box( 'shortcode_metabox', 'Shortcode Options', 'pp_shortcode_generator_options', 'page', 'normal', 'low' );
		add_meta_box( 'shortcode_metabox', 'Shortcode Options', 'pp_shortcode_generator_options', 'post', 'normal', 'high' );  
		add_meta_box( 'shortcode_metabox', 'Shortcode Options', 'pp_shortcode_generator_options', 'portfolios', 'side', 'high' );  
	}

}

function pp_shortcode_generator_options() {

  	$plugin_url = get_stylesheet_directory_uri().'/plugins/shortcode_generator';
  	
  	$args = array(
	    'numberposts' => -1,
	    'post_type' => array('galleries'),
	);
	
	$galleries_arr = get_posts($args);
	$galleries_select = array();
	$galleries_select[''] = '';
	
	foreach($galleries_arr as $gallery)
	{
		$galleries_select[$gallery->ID] = $gallery->post_title;
	}

	//Begin shortcode array
	$shortcodes = array(
		'dropcap' => array(
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
		),
		'quote' => array(
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
		),
		'tg_button' => array(
			'name' => 'Button',
			'attr' => array(
				'href' => 'text',
				'align' => 'select',
			),
			'desc' => array(
				'href' => 'Enter URL for button',
				'align' => 'Button Alignment',
			),
			'options' => array(
				'left' => 'left',
				'right' => 'right',
				'center' => 'center',
			),
			'content' => TRUE,
			'content_text' => 'Enter text on button',
		),
		'one_half' => array(
			'name' => 'One Half Column',
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
			'repeat' => 1,
		),
		'one_half_last' => array(
			'name' => 'One Half Last Column',
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
			'repeat' => 1,
		),
		'one_third' => array(
			'name' => 'One Third Column',
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
			'repeat' => 2,
		),
		'one_third_last' => array(
			'name' => 'One Third Last Column',
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
		),
		'two_third' => array(
			'name' => 'Two Third Column',
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
		),
		'two_third_last' => array(
			'name' => 'Two Third Last Column',
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
		),
		'one_fourth' => array(
			'name' => 'One Fourth Column',
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
			'repeat' => 3,
		),
		'one_fifth' => array(
			'name' => 'One Fifth Column',
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
			'repeat' => 4,
		),
		'googlefont_func' => array(
			'name' => 'Google Font',
			'attr' => array(
				'font' => 'text',
				'fontsize' => 'text',
			),
			'desc' => array(
				'font' => 'Enter Google Web Font Name you want to use',
				'fontsize' => 'Enter font size in pixels',
			),
			'content' => FALSE,
		),
		'tg_thumb_gallery' => array(
			'name' => 'Gallery Thumbnails',
			'attr' => array(
				'gallery_id' => 'select',
				'width' => 'text',
				'height' => 'text',
			),
			'options' => $galleries_select,
			'desc' => array(
				'gallery_id' => 'Select gallery you want to display its images',
				'width' => 'Gallery image width in pixels',
				'height' => 'Gallery image height in pixels',
			),
			'content' => FALSE,
		),
		'tg_gallery_slider' => array(
			'name' => 'Gallery Slider',
			'attr' => array(
				'gallery_id' => 'select',
			),
			'options' => $galleries_select,
			'desc' => array(
				'gallery_id' => 'Select gallery you want to display its images',
			),
			'content' => FALSE,
		),
		'tg_social_icons' => array(
			'name' => 'Social Icons',
			'attr' => array(),
			'content' => FALSE,
		),
		'tg_lightbox' => array(
			'name' => 'Media Lightbox',
			'attr' => array(
				'type' => 'select',
				'src' => 'text',
				'href' => 'text',
				'vimeo_id' => 'text',
				'youtube_id' => 'text',
			),
			'desc' => array(
				'type' => 'Select ligthbox content type',
				'src' => 'Enter lightbox preview iamge URL',
				'href' => 'If you selected "Image". Enter full image URL here',
				'vimeo_id' => 'If you selected "Vimeo". Enter Vimeo video ID here ex. 82095744',
				'youtube_id' => 'If you selected "Youtube". Enter Youtube video ID here ex. hT_nvWreIhg',
			),
			'content' => TRUE,
			'options' => array(
				'image' => 'Image',
				'vimeo' => 'Vimeo',
				'youtube' => 'Youtube',
			),
			'content' => FALSE,
		),
		'tg_youtube' => array(
			'name' => 'Youtube Video',
			'attr' => array(
				'width' => 'text',
				'height' => 'text',
				'video_id' => 'text',
			),
			'desc' => array(
				'width' => 'Enter video width in pixels',
				'height' => 'Enter video height in pixels',
				'video_id' => 'Enter Youtube video ID here ex. hT_nvWreIhg',
			),
			'content' => FALSE,
		),
		'tg_vimeo' => array(
			'name' => 'Vimeo Video',
			'attr' => array(
				'width' => 'text',
				'height' => 'text',
				'video_id' => 'text',
			),
			'desc' => array(
				'width' => 'Enter video width in pixels',
				'height' => 'Enter video height in pixels',
				'video_id' => 'Enter Vimeo video ID here ex. 82095744',
			),
			'content' => FALSE,
		),
		'tg_animate_bar' => array(
			'name' => 'Animated Progress Bar',
			'attr' => array(
				'percent' => 'text',
				'color' => 'text',
			),
			'desc' => array(
				'percent' => 'Enter number of percent value (maximum 100)',
				'color' => 'Enter progress background color code ex. #000000',
			),
			'content' => TRUE,
		),
	);

?>
<script>
function nl2br (str, is_xhtml) {   
	var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
	return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}

jQuery(document).ready(function(){ 
	jQuery('#shortcode_select').change(function() {
  		var target = jQuery(this).val();
  		jQuery('.rm_section').hide()
  		jQuery('#div_'+target).fadeIn()
	});	
	
	jQuery('.code_area').click(function() { 
		document.getElementById(jQuery(this).attr('id')).focus();
    	document.getElementById(jQuery(this).attr('id')).select();
	});
	
	jQuery('.shortcode_button').click(function() { 
		var target = jQuery(this).attr('id');
		var gen_shortcode = '';
  		gen_shortcode+= '['+target;
  		
  		if(jQuery('#'+target+'_attr_wrapper .attr').length > 0)
  		{
  			jQuery('#'+target+'_attr_wrapper .attr').each(function() {
				gen_shortcode+= ' '+jQuery(this).attr('name')+'="'+jQuery(this).val()+'"';
			});
		}
		
		gen_shortcode+= ']';
		
		if(jQuery('#'+target+'_content').length > 0)
  		{
  			gen_shortcode+= jQuery('#'+target+'_content').val()+'[/'+target+']';
  			gen_shortcode+= '\n';
  			
  			var repeat = jQuery('#'+target+'_content_repeat').val();
  			for (count=1;count<=repeat;count=count+1)
			{
				if(count<repeat)
				{
					gen_shortcode+= '['+target+']';
					gen_shortcode+= jQuery('#'+target+'_content').val()+'[/'+target+']';
					gen_shortcode+= '\n';
				}
				else
				{
					gen_shortcode+= '['+target+'_last]';
					gen_shortcode+= jQuery('#'+target+'_content').val()+'[/'+target+'_last]';
					gen_shortcode+= '\n';
				}
			}
  		}
  		jQuery('#'+target+'_code').val(gen_shortcode);
  		jQuery('#pp-insert-to-post').attr('rel', '#'+target+'_code');
  		
  		jQuery("#"+target+"-pp-insert-to-post").click(function() { 
			var current_id = jQuery(this).attr('rel');
			var current_code = jQuery('#'+target+'_code').val();
			
			tinyMCE.activeEditor.selection.setContent(nl2br(current_code));
		});
	});
});
</script>

	<div style="padding:20px 10px 10px 10px">
	<?php
		if(!empty($shortcodes))
		{
	?>
			<strong><?php _e( 'Select Shortcode', THEMEDOMAIN ); ?></strong><hr class="pp_widget_hr">
			<div class="pp_widget_description"><?php _e( 'Please select short code from list below then enter short code attributes and click "Generate Shortcode".', THEMEDOMAIN ); ?></div>
			<br/>
			<select id="shortcode_select">
				<option value=""><?php _e( '(no short code selected)', THEMEDOMAIN ); ?></option>
			
	<?php
			foreach($shortcodes as $shortcode_name => $shortcode)
			{
				$shortcode_key = $shortcode_name;
				
				if(isset($shortcodes[$shortcode_name]['name']))
				{
					$shortcode_name = $shortcodes[$shortcode_name]['name'];
				}
	?>
	
			<option value="<?php echo $shortcode_key; ?>"><?php echo $shortcode_name; ?></option>
	
	<?php
			}
	?>
			</select>
	<?php
		}
	?>
	
	<br/><br/>
	
	<?php
		if(!empty($shortcodes))
		{
			foreach($shortcodes as $shortcode_name => $shortcode)
			{
	?>
	
			<div id="div_<?php echo $shortcode_name; ?>" class="rm_section" style="display:none">
				<div style="width:47%;float:left">
			
				<div class="rm_title">
					<h3><?php echo ucfirst($shortcode_name); ?></h3>
					<div class="clearfix"></div>
				</div>
				
				<div class="rm_text" style="padding: 10px 0 20px 0">
				
				<!-- img src="<?php echo $plugin_url.'/'.$shortcode_name.'.png'; ?>" alt=""/><br/><br/><br/ -->
				
				<?php
					if(isset($shortcode['content']) && $shortcode['content'])
					{
						if(isset($shortcode['content_text']))
						{
							$content_text = $shortcode['content_text'];
						}
						else
						{
							$content_text = 'Your Content';
						}
				?>
				
				<strong><?php echo $content_text; ?>:</strong><br/><br/>
				<?php if(isset($shortcode['repeat'])) { ?>
					<input type="hidden" id="<?php echo $shortcode_name; ?>_content_repeat" value="<?php echo $shortcode['repeat']; ?>"/>
				<?php } ?>
				<textarea id="<?php echo $shortcode_name; ?>_content" style="width:100%;height:70px" rows="3" wrap="off"></textarea><br/><br/>
				
				<?php
					}
				?>
			
				<?php
					if(isset($shortcode['attr']) && !empty($shortcode['attr']))
					{
				?>
						
						<div id="<?php echo $shortcode_name; ?>_attr_wrapper">
						
				<?php
						foreach($shortcode['attr'] as $attr => $type)
						{
				?>
				
							<?php echo '<strong>'.ucfirst($attr).'</strong>: '.$shortcode['desc'][$attr]; ?><br/><br/>
							
							<?php
								switch($type)
								{
									case 'text':
							?>
							
									<input type="text" id="<?php echo $shortcode_name; ?>_text" style="width:100%" class="attr" name="<?php echo $attr; ?>"/>
							
							<?php
									break;
									
									case 'select':
							?>
							
									<select id="<?php echo $shortcode_name; ?>_select" style="width:100%" class="attr" name="<?php echo $attr; ?>">
									
										<?php
											if(isset($shortcode['options']) && !empty($shortcode['options']))
											{
												foreach($shortcode['options'] as $select_key => $option)
												{
										?>
										
													<option value="<?php echo $select_key; ?>"><?php echo $option; ?></option>
										
										<?php	
												}
											}
										?>							
									
									</select>
							
							<?php
									break;
								}
							?>
							
							<br/><br/>
				
				<?php
						} //end attr foreach
				?>
				
						</div>
				
				<?php
					}
				?>
				
				</div>
				
				</div>
				
				<div style="width:47%;float:right">
				
				<strong><?php _e( 'Shortcode', THEMEDOMAIN ); ?>:</strong><br/><br/>
				<textarea id="<?php echo $shortcode_name; ?>_code" style="width:100%;height:200px" rows="3" readonly="readonly" class="code_area" wrap="off"></textarea>
				
				<br/><br/>
				<input type="button" id="<?php echo $shortcode_name; ?>" value="<?php _e( 'Generate Shortcode', THEMEDOMAIN ); ?>" class="button shortcode_button button-primary"/>
				</div>
				
				<br style="clear:both"/>
			</div>
	
	<?php
			} //end shortcode foreach
		}
	?>
	
</div>

<?php

}

/*
	End Create Shortcode Generator Options
*/

?>