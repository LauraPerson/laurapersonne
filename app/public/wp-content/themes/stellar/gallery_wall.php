<?php
/**
 * The main template file for display portfolio page.
 *
 * @package WordPress
 */

/**
*	Get Current page object
**/
$page = get_page($post->ID);
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

//Check if gallery template
global $page_gallery_id;
if(!empty($page_gallery_id))
{
	$current_page_id = $page_gallery_id;
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

//Get gallery images
$all_photo_arr = get_post_meta($current_page_id, 'wpsimplegallery_gallery', true);

//Get global gallery sorting
$all_photo_arr = pp_resort_gallery_img($all_photo_arr);

global $pp_homepage_style;
$pp_homepage_style = 'wall';
get_header();
?>

<?php
    //Get Gallery Cover
    get_template_part("/templates/template-cover");
?>

<?php
    //Get Social Share
    get_template_part("/templates/template-share");
?>

<!-- Begin content -->
<div id="photo_wall_wrapper">
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

<div class="wall_entry masonry">
    <?php 
    	if(!empty($thumb_image_url))
    	{
    		$pp_image_lightbox_title = get_option('pp_image_lightbox_title');
    ?>		
    	<div class="wall_thumbnail">
    		<img src="<?php echo $thumb_image_url; ?>" alt="<?php echo esc_attr($image_alt); ?>" class="portfolio_img"/>
	    				
	    	<a <?php if(!empty($pp_image_lightbox_title)) { ?>title="<?php if(!empty($image_caption)) { ?><?php echo $image_caption; ?><?php } ?>"<?php } ?> class="fancy-gallery" href="<?php echo $image_url[0]; ?>">
			    <div class="mask"></div>
	    	</a>
    	</div>
    <?php
    	}		
    ?>

</div>

<?php
    }
?>
</div>

<?php
$page_audio = get_post_meta($current_page_id, 'page_audio', true);

if(!empty($page_audio))
{
?>
<div class="page_audio">
	<?php echo do_shortcode('[audio width="30" height="30" src="'.$page_audio.'"]'); ?>
</div>
<?php
}
?>

<?php
	//important to apply dynamic footer style
	global $pp_homepage_style;
	$pp_homepage_style = 'wall';
	
	get_footer();
?>