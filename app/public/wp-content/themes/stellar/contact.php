<?php
/**
 * Template Name: Contact
 * The main template file for display contact page.
 *
 * @package WordPress
*/

/**
*	Get Current page object
**/
$current_page = get_page($post->ID);
$current_page_id = '';

if(isset($current_page->ID))
{
    $current_page_id = $current_page->ID;
}

get_header(); 
?>

<?php
    $pp_contact_display_map = get_option('pp_contact_display_map');
    
    if(!empty($pp_contact_display_map))
    {	
    	wp_enqueue_script("script-contact-map", get_template_directory_uri()."/templates/script-contact-map.php?id=map_contact", false, THEMEVERSION, true);
?>
<div id="map_contact"></div>
<?php
    }
    else if(has_post_thumbnail($current_page_id, 'original'))
	{
		$image_id = get_post_thumbnail_id($current_page_id); 
		$image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
		$pp_page_bg = $image_thumb[0];
?>
<div id="contact_page_header_bg" style="background-image:url(<?php echo $pp_page_bg; ?>);"></div>
<?php
	}
?>

<?php
$page_tagline = get_post_meta($current_page_id, 'page_tagline', true);
?>
<div id="page_caption" class="page_content">
    <div id="page_caption_wrapper">
    	<?php
	        //Check if display logo as page title
	        $page_logo_header = get_post_meta($current_page_id, 'page_logo_header', true);
	        if(empty($page_logo_header))
	        {
	    ?>
	    <h1><?php the_title(); ?></h1>
	    <?php
	        }
	        else
	        {
	        	$pp_logo_transparent = get_option('pp_logo_transparent');
		        $pp_retina_logo_transparent = get_option('pp_retina_logo_transparent');
		        $pp_retina_logo_transparent_width = 0;
		        $pp_retina_logo_transparent_height = 0;
		        
		        if(!empty($pp_retina_logo_transparent))
		        {
		    	    if(empty($pp_retina_logo_width) && empty($pp_retina_logo_height))
		    	    {
		    	        //Get image width and height
		    	        $pp_retina_logo_id = pp_get_image_id($pp_retina_logo_transparent);
		    	        $image_logo = wp_get_attachment_image_src($pp_retina_logo_id, 'original');
		    	        
		    	        $pp_retina_logo_transparent = $image_logo[0];
		    	        $pp_retina_logo_transparent_width = intval($image_logo[1]/2);
				        $pp_retina_logo_transparent_height = intval($image_logo[2]/2);
		    	    }
	    ?>
	        		<img src="<?php echo $pp_retina_logo_transparent; ?>" alt="" width="<?php echo $pp_retina_logo_transparent_width; ?>" height="<?php echo $pp_retina_logo_transparent_height; ?>"/>
		<?php 
		    	}
		    	else
		    	{
		?>
		    		<img src="<?php echo $pp_logo_transparent?>" alt=""/>
		<?php
		    	}
		    } 
		?>
    	<?php
    	if(!empty($page_tagline))
    	{
    	?>
    	<div class="page_tagline">
    		<?php echo $page_tagline; ?>
    	</div>
    	<?php
    	}
    	?>
    	
    	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		

    			<?php the_content(); ?>

    		<?php endwhile; ?>
	    	
	    	<!-- Begin main content -->
    			<?php
    				$pp_contact_form = unserialize(get_option('pp_contact_form_sort_data'));
    				wp_register_script("script-contact-form", get_template_directory_uri()."/templates/script-contact-form.php", false, THEMEVERSION, true);
					$params = array(
					  'ajaxurl' => admin_url('admin-ajax.php'),
					  'ajax_nonce' => wp_create_nonce('tgajax-post-contact-nonce'),
					);
					wp_localize_script( 'script-contact-form', 'tgAjax', $params );
					wp_enqueue_script("script-contact-form", get_template_directory_uri()."/templates/script-contact-form.php", false, THEMEVERSION, true);
    			?>
    			<br/><br/>
    			<div id="reponse_msg"><ul></ul></div>
    			
    			<form id="contact_form" method="post" action="<?php echo get_permalink($current_page->ID); ?>">
					<input type="hidden" id="action" name="action" value="pp_contact_mailer"/>
    				<?php 
			    		if(is_array($pp_contact_form) && !empty($pp_contact_form))
			    		{
			    			foreach($pp_contact_form as $form_input)
			    			{
			    				switch($form_input)
			    				{
			    					case 1:
			    	?>
			        				<input id="your_name" name="your_name" type="text" class="required_field" placeholder="<?php echo _e( 'Name', THEMEDOMAIN ); ?>*" style="width:100%"/>
			        				<br/>		
			    	<?php
			    					break;
			    					
			    					case 2:
			    	?>
			    					
			        				<input id="email" name="email" type="text" class="required_field email" placeholder="<?php echo _e( 'Email', THEMEDOMAIN ); ?>*" style="width:100%"/>
			        				<br/>			
			    	<?php
			    					break;
			    					
			    					case 3:
			    	?>
			    					
			        				<textarea id="message" name="message" rows="7" cols="10" class="required_field" placeholder="<?php echo _e( 'Message', THEMEDOMAIN ); ?>*" style="width:100%"></textarea>
			        				<br/>			
			    	<?php
			    					break;
			    					
			    					case 4:
			    	?>
			    					
			        				<input id="address" name="address" type="text" placeholder="<?php echo _e( 'Address', THEMEDOMAIN ); ?>" style="width:100%"/>
			        				<br/>		
			    	<?php
			    					break;
			    					
			    					case 5:
			    	?>
			    					
			        				<input id="phone" name="phone" type="text" placeholder="<?php echo _e( 'Phone', THEMEDOMAIN ); ?>" style="width:100%"/>
			        				<br/>		
			    	<?php
			    					break;
			    					
			    					case 6:
			    	?>
			    					
			        				<input id="mobile" name="mobile" type="text" placeholder="<?php echo _e( 'Mobile', THEMEDOMAIN ); ?>" style="width:100%"/>
			        				<br/>			
			    	<?php
			    					break;
			    					
			    					case 7:
			    	?>
			    					
			        				<input id="company" name="company" type="text" placeholder="<?php echo _e( 'Company Name', THEMEDOMAIN ); ?>" style="width:100%"/>
			        				<br/>			
			    	<?php
			    					break;
			    					
			    					case 8:
			    	?>
			    								
			        				<input id="country" name="country" type="text" placeholder="<?php echo _e( 'Country', THEMEDOMAIN ); ?>" style="width:100%"/>
			        				<br/>			
			    	<?php
			    					break;
			    				}
			    			}
			    		}
			    	?>
			    	
			    	<?php
			    		$pp_contact_enable_captcha = get_option('pp_contact_enable_captcha');
			    		
			    		if(!empty($pp_contact_enable_captcha))
			    		{
			    	?>
			    		<div id="captcha-wrap">
							<div class="captcha-box">
								<img src="<?php echo get_template_directory_uri(); ?>/get_captcha.php" alt="" id="captcha" />
							</div>
							<div class="text-box">
								<label><?php _e( 'Type the two words', THEMEDOMAIN ); ?></label>
								<input name="captcha-code" type="text" id="captcha-code">
							</div>
							<div class="captcha-action">
								<img src="<?php echo get_template_directory_uri(); ?>/images/refresh.jpg"  alt="" id="captcha-refresh" />
							</div>
						</div>
						<br class="clear"/><br/>
					<?php
					}
					?>
			    			    
			    	<p>
    					<input id="contact_submit_btn" type="submit" value="<?php echo _e( 'Send Message', THEMEDOMAIN ); ?>"/>
    				</p>
    				<br/>
    			</form>
    			
    			<div id="ajax_loading"><i class="fa fa-spinner fa-spin"></i></div>
    	<!-- End main content -->
    </div>
</div>

<!-- Begin content -->
<?php get_footer(); ?>