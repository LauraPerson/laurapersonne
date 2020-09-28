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
$pp_homepage_style = 'horizontal';
get_header();

wp_enqueue_script("jquery.mousewheel", get_template_directory_uri()."/js/jquery.mousewheel.min.js", false, THEMEVERSION, true);
wp_enqueue_script("horizontal_gallery", get_template_directory_uri()."/js/horizontal_gallery.js", false, THEMEVERSION, true);
?>

<?php
    //Get Gallery Cover
    get_template_part("/templates/template-cover");
?>

<?php
    //Get Social Share
    get_template_part("/templates/template-share");
?>

<div class="page_control_static">
    <a id="page_maximize" href="#"></a>
</div>

<!-- Begin content -->
<div id="horizontal_gallery">
<table id="horizontal_gallery_wrapper" cellspacing="30">
<tbody><tr>
<?php
    foreach($all_photo_arr as $photo_id)
	{
	    $small_image_url = '';
	    $hyperlink_url = get_permalink($photo_id);
	    $thumb_image_url = '';
	    
	    if(!empty($photo_id))
	    {
	    	$image_url = wp_get_attachment_image_src($photo_id, 'original', true);
	    }
	    
	    //Get image meta data
	    $image_caption = get_post_field('post_excerpt', $photo_id);
	    $image_alt = get_post_meta($photo_id, '_wp_attachment_image_alt', true);
?>

<td>
    <?php 
    	if(isset($image_url[0]) && !empty($image_url[0]))
    	{
    		$pp_image_lightbox_title = get_option('pp_image_lightbox_title');
    ?>
    	<div class="gallery_image_wrapper">
	    	<img src="<?php echo $image_url[0]; ?>" alt="<?php echo esc_attr($image_alt); ?>" class="horizontal_gallery_img"/>
	    	<?php
	    		if(!empty($pp_image_lightbox_title) && !empty($image_caption)) 
	    		{
	    	?>
	    	<div class="image_caption"><?php echo $image_caption;?></div>
	    	<?php
	    		}
	    	?>
    	</div>
    <?php
    	}		
    ?>

</td>

<?php
    }
?>
</tr></tbody>
</table>
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
	get_footer();
?>