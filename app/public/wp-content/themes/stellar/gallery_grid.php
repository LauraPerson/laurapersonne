<?php
/**
 * The main template file for display portfolio page.
 *
 * @package WordPress
 */

/**
*	Get Current page object
**/

global $page_gallery_id;

if(!is_page())
{
	$page = get_page($post->ID);
	$current_page_id = '';
	
	if(isset($page->ID))
	{
	    $current_page_id = $page->ID;
	}
	
	//Check if gallery template
	if(!empty($page_gallery_id))
	{
		$current_page_id = $page_gallery_id;
	}
	
	//Get gallery images
	$all_photo_arr = get_post_meta($current_page_id, 'wpsimplegallery_gallery', true);
}
else
{
	$current_page_id = $post->ID;
	
	//Get gallery images
	$all_photo_arr = get_post_meta($page_gallery_id, 'wpsimplegallery_gallery', true);
}

//Check if password protected
$gallery_password = get_post_meta($current_page_id, 'gallery_password', true);
if(!empty($gallery_password))
{
	session_start();
	
	if(!isset($_SESSION['gallery_page_'.$current_page_id]) OR empty($_SESSION['gallery_page_'.$current_page_id]))
	{
		get_template_part("/templates/template-password");
		exit;
	}
}

//Get global gallery sorting
$all_photo_arr = pp_resort_gallery_img($all_photo_arr);


global $pp_homepage_style;
$pp_homepage_style = 'blog_grid';
get_header(); 

?>

<?php
if(has_post_thumbnail($current_page_id, 'original'))
{
	$image_id = get_post_thumbnail_id($current_page_id); 
	$image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
	$pp_page_bg = $image_thumb[0];
?>
<div id="page_header_bg" style="background-image:url(<?php echo $pp_page_bg; ?>);"></div>
<?php
}
?>

<?php
    //Get Gallery Cover
    get_template_part("/templates/template-cover");
?>

<div id="page_caption">
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
    	if(!empty($post->post_content))
    	{
    	?>
    	<div class="page_tagline">
    		<?php echo $post->post_content; ?>
    	</div>
    	<?php
    	}
    	?>
    </div>
    
    <?php
	    //Get Social Share
	    get_template_part("/templates/template-share");
	?>
</div>

<!-- Begin content -->
<div id="page_content_wrapper" class="two nopadding gallery">
    
    <div class="inner">

    	<div class="inner_wrapper">
		
			<div id="blog_grid_wrapper">
	    	
	    	<?php
	    		foreach($all_photo_arr as $photo_id)
	    		{
	    			$small_image_url = '';
	    			$hyperlink_url = get_permalink($photo_id);
	    			$thumb_image_url = '';
	    			
	    			if(!empty($photo_id))
	    			{
	    				$image_url = wp_get_attachment_image_src($photo_id, 'original', true);
	    			    $small_image_url = wp_get_attachment_image_src($photo_id, 'gallery_c', true);
	    			}
	    			
	    			$thumb_image_url = $small_image_url[0];
	    			$thumb_width = $small_image_url[1];
	    			$thumb_height = $small_image_url[2];
	    			
	    			//Get image meta data
	    			$image_caption = get_post_field('post_excerpt', $photo_id);
	    			$image_alt = get_post_meta($photo_id, '_wp_attachment_image_alt', true);
	    	?>
	    	<div class="mansory_entry type-post post gallery">
	    		<?php 
	    			if(!empty($thumb_image_url))
	    			{
	    				$pp_image_lightbox_title = get_option('pp_image_lightbox_title');
	    		?>		
	    				<a <?php if(!empty($pp_image_lightbox_title)) { ?>title="<?php if(!empty($image_caption)) { ?><?php echo $image_caption; ?><?php } ?>"<?php } ?> class="fancy-gallery" href="<?php echo $image_url[0]; ?>">
	    					<img src="<?php echo $thumb_image_url; ?>" alt="<?php echo esc_attr($image_alt); ?>" class="portfolio_img"/>
	    					
			    			<div class="mask">
			    				<div class="mask_frame">
			    					<div class="mask_image_content">
			    						<div class="mask_image_content_frame">
							    			<i class="fa fa-plus-square-o"></i>
			    						</div>
			    					</div>
			    				</div>
			    			</div>
	    				</a>
	    		<?php
	    			}		
	    		?>			
	    	
	    	</div>
	    	
	    	<?php
	    		}
	    	?>
	    </div>
	    	
	</div>
	    
</div>

<?php
$gallery_audio = get_post_meta($current_page_id, 'gallery_audio', true);

if(!empty($gallery_audio))
{
?>
<div class="gallery_audio">
	<?php echo do_shortcode('[pp_audio width="30" height="30" src="'.$gallery_audio.'"]'); ?>
</div>
<?php
}
?>

<?php get_footer(); ?>