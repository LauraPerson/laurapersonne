<?php
/**
 * The Header for the template.
 *
 * @package WordPress
 */
 
if ( ! isset( $content_width ) ) $content_width = 960;

if(session_id() == '') {
	session_start();
}
global $pp_homepage_style;

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<?php
	$pp_enable_responsive = get_option('pp_enable_responsive');
	if(!empty($pp_enable_responsive))
	{
?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<?php
	}
?>

<title><?php bloginfo('name'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
if(is_single())
{
	if(has_post_thumbnail(get_the_ID(), 'blog_f'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $fb_thumb = wp_get_attachment_image_src($image_id, 'thumbnail', true);
	}

	if(isset($fb_thumb[0]) && !empty($fb_thumb[0]))
	{
		$post_content = get_post_field('post_content', $post->ID);
	?>
	<meta property="og:image" content="<?php echo $fb_thumb[0]; ?>"/>
	<meta property="og:title" content="<?php the_title(); ?>"/>
	<meta property="og:url" content="<?php echo get_permalink($post->ID); ?>"/>
	<meta property="og:description" content="<?php echo strip_tags($post_content); ?>"/>
	<?php
	}
}
?>

<?php
	/**
	*	Get favicon URL
	**/
	$pp_favicon = get_option('pp_favicon');
	
	if(!empty($pp_favicon))
	{
?>
		<link rel="shortcut icon" href="<?php echo $pp_favicon; ?>" />
<?php
	}
?> 

<?php
	/**
    *	Setup code before </head>
    **/
	$pp_before_head_code = get_option('pp_before_head_code');
	
	if(!empty($pp_before_head_code))
	{
		echo stripslashes($pp_before_head_code);
	}
?>

<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

</head>

<body <?php body_class(); ?> <?php if(isset($pp_homepage_style) && !empty($pp_homepage_style)) { echo 'data-style="'.$pp_homepage_style.'"'; } ?>>
	<?php
		//Check if disable right click
		$pp_enable_right_click = get_option('pp_enable_right_click');
		
		//Check if disable image dragging
		$pp_enable_dragging = get_option('pp_enable_dragging');
		
		//Check if use reflection in flow gallery
		$pp_flow_enable_reflection = get_option('pp_flow_enable_reflection');
		
		//Check if display menu by default
		$pp_menu_display = get_option('pp_menu_display');
	?>
	<input type="hidden" id="pp_enable_reflection" name="pp_enable_reflection" value="<?php echo $pp_flow_enable_reflection; ?>"/>
	<input type="hidden" id="pp_enable_right_click" name="pp_enable_right_click" value="<?php echo $pp_enable_right_click; ?>"/>
	<input type="hidden" id="pp_enable_dragging" name="pp_enable_dragging" value="<?php echo $pp_enable_dragging; ?>"/>
	<input type="hidden" id="pp_image_path" name="pp_image_path" value="<?php echo get_stylesheet_directory_uri(); ?>/images/"/>
	<input type="hidden" id="pp_homepage_url" name="pp_homepage_url" value="<?php echo home_url(); ?>"/>
	
	<input type="hidden" id="pp_menu_display" name="pp_menu_display" value="<?php echo $pp_menu_display; ?>"/>
	
	<?php
		//Check footer sidebar columns
		$pp_footer_style = get_option('pp_footer_style');
	?>
	<input type="hidden" id="pp_footer_style" name="pp_footer_style" value="<?php echo $pp_footer_style; ?>"/>
	
	<div id="menu_close_icon">
		<div id="menu_toggle"></div>
		<div id="menu_title"><?php _e( 'Menu', THEMEDOMAIN ); ?></div>	
	</div>
	
	<!--Begin Template Menu -->
	<div class="top_bar">
	
	<div class="top_bar_wrapper">
	
		<div id="menu_wrapper">
			
			<!-- Begin logo -->	
			<?php
			    //get custom logo
			    $pp_logo = get_option('pp_logo');
			    $pp_retina_logo = get_option('pp_retina_logo');
			    $pp_retina_logo_width = 0;
			    $pp_retina_logo_height = 0;
			    			
			    if(empty($pp_logo) && empty($pp_retina_logo))
			    {
			    	$pp_retina_logo = get_template_directory_uri().'/images/logo@2x.png';
			    	$pp_retina_logo_width = 159;
			    	$pp_retina_logo_height = 50;
			    }
			    
			    if(!empty($pp_retina_logo))
			    {
			    	if(empty($pp_retina_logo_width) && empty($pp_retina_logo_height))
			    	{
			    		//Get image width and height
			    		$pp_retina_logo_id = pp_get_image_id($pp_retina_logo);
			    		$image_logo = wp_get_attachment_image_src($pp_retina_logo_id, 'original');
			    		
			    		$pp_retina_logo = $image_logo[0];
			    		$pp_retina_logo_width = intval($image_logo[1]/2);
			    		$pp_retina_logo_height = intval($image_logo[2]/2);
			    	}
			?>		
			    <a id="custom_logo" class="logo_wrapper" href="<?php echo home_url(); ?>">
			    	<img src="<?php echo $pp_retina_logo; ?>" alt="" width="<?php echo $pp_retina_logo_width; ?>" height="<?php echo $pp_retina_logo_height; ?>"/>
			    </a>
			<?php
			    }
			    else //if not retina logo
			    {
			?>
			    <a id="custom_logo" class="logo_wrapper" href="<?php echo home_url(); ?>">
			    	<img src="<?php echo $pp_logo?>" alt=""/>
			    </a>
			<?php
			    }
			?>
			<!-- End logo -->
			
		    <!-- Begin main nav -->
		    <div id="nav_wrapper">
		    	<div class="nav_wrapper_inner">
		    		<div id="menu_border_wrapper">
		    			<?php 	
		    				if ( has_nav_menu( 'primary-menu' ) ) 
		    				{
			    			    //Get page nav
			    			    wp_nav_menu( 
			    			        	array( 
			    			        		'menu_id'			=> 'main_menu',
			    			        		'menu_class'		=> 'nav',
			    			        		'theme_location' 	=> 'primary-menu',
			    			        		'walker' => new Arrow_Walker_Nav_Menu,
			    			        	) 
			    			    ); 
			    			}
			    			else
						    {
						     		echo '<div class="notice">Please setup "Main Menu" using Wordpress Dashboard > Appearance > Menus</div>';
						    }
		    			?>
		    		</div>
		    	</div>
		    </div>
		    
		    <div class="social_wrapper">
			    <ul>
			    	<?php
			    		$pp_twitter_username = get_option('pp_twitter_username');
			    		
			    		if(!empty($pp_twitter_username))
			    		{
			    	?>
			    	<li><a title="Twitter" href="http://twitter.com/<?php echo $pp_twitter_username; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_facebook_username = get_option('pp_facebook_username');
			    		
			    		if(!empty($pp_facebook_username))
			    		{
			    	?>
			    	<li><a title="Facebook" href="http://facebook.com/<?php echo $pp_facebook_username; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_flickr_username = get_option('pp_flickr_username');
			    		
			    		if(!empty($pp_flickr_username))
			    		{
			    	?>
			    	<li><a title="Flickr" href="http://flickr.com/people/<?php echo $pp_flickr_username; ?>" target="_blank"><i class="fa fa-flickr"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_youtube_username = get_option('pp_youtube_username');
			    		
			    		if(!empty($pp_youtube_username))
			    		{
			    	?>
			    	<li><a title="Youtube" href="http://youtube.com/channel/<?php echo $pp_youtube_username; ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_vimeo_username = get_option('pp_vimeo_username');
			    		
			    		if(!empty($pp_vimeo_username))
			    		{
			    	?>
			    	<li><a title="Vimeo" href="http://vimeo.com/<?php echo $pp_vimeo_username; ?>" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_tumblr_username = get_option('pp_tumblr_username');
			    		
			    		if(!empty($pp_tumblr_username))
			    		{
			    	?>
			    	<li><a title="Tumblr" href="http://<?php echo $pp_tumblr_username; ?>.tumblr.com" target="_blank"><i class="fa fa-tumblr"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_google_username = get_option('pp_google_username');
			    		
			    		if(!empty($pp_google_username))
			    		{
			    	?>
			    	<li><a title="Google+" href="<?php echo $pp_google_username; ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_dribbble_username = get_option('pp_dribbble_username');
			    		
			    		if(!empty($pp_dribbble_username))
			    		{
			    	?>
			    	<li><a title="Dribbble" href="http://dribbble.com/<?php echo $pp_dribbble_username; ?>" target="_blank"><i class="fa fa-dribbble"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_linkedin_username = get_option('pp_linkedin_username');
			    		
			    		if(!empty($pp_linkedin_username))
			    		{
			    	?>
			    	<li><a title="Linkedin" href="<?php echo $pp_linkedin_username; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_pinterest_username = get_option('pp_pinterest_username');
			    		
			    		if(!empty($pp_pinterest_username))
			    		{
			    	?>
			    	<li><a title="Pinterest" href="http://pinterest.com/<?php echo $pp_pinterest_username; ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_instagram_username = get_option('pp_instagram_username');
			    		
			    		if(!empty($pp_instagram_username))
			    		{
			    	?>
			    	<li><a title="Instagram" href="http://instagram.com/<?php echo $pp_instagram_username; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
			    	<?php
			    		}
			    	?>
			    </ul>
			</div>
		    
		    <!-- End main nav -->
		    
			<div class="footer_bar">
				<div class="footer_bar_wrapper">
				    <?php
				        $pp_footer_text = get_option('pp_footer_text');
				        if(!empty($pp_footer_text))
				        {
				        	echo '<div id="copyright">'.htmlspecialchars_decode((stripslashes($pp_footer_text))).'</div>';
				        }
				    ?>
				</div>
			</div>

		</div> 
	</div>
	
	</div> 

	<!-- Begin template wrapper -->
	<div id="wrapper">
	 	<?php
		if (class_exists('Woocommerce')) {
		    //Check if display cart in header
		
		    global $woocommerce;
		    $cart_url = $woocommerce->cart->get_cart_url();
		    $cart_count = $woocommerce->cart->cart_contents_count;
		?>
		<div class="header_cart_wrapper">
		    <div class="cart_count"><?php echo esc_html($cart_count); ?></div>
		    <a href="<?php echo esc_url($cart_url); ?>"><i class="fa fa-shopping-cart"></i></a>
		</div>
		<?php
		}
		?>