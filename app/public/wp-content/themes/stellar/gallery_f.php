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

//important to apply dynamic header & footer style
global $pp_homepage_style;
$pp_homepage_style = 'fullscreen';

get_header();

//Run gallery script data
wp_enqueue_style("supersized", get_template_directory_uri()."/css/supersized.css", false, THEMEVERSION, "all");
wp_enqueue_style("supersized.shutter", get_template_directory_uri()."/css/supersized.shutter.css", false, THEMEVERSION, "all");

wp_enqueue_script("supersized", get_template_directory_uri()."/js/supersized.3.2.7.min.js", false, THEMEVERSION, true);
wp_enqueue_script("supersized.shutter", get_template_directory_uri()."/js/supersized.shutter.min.js", false, THEMEVERSION, true);

wp_enqueue_script("script-supersized-gallery", get_template_directory_uri()."/templates/script-supersized-gallery.php?gallery_id=".$current_page_id, false, THEMEVERSION, true);
?>

<!--Arrow Navigation-->
<a id="prevslide" class="load-item"></a>
<a id="nextslide" class="load-item"></a>

<div id="controls-wrapper" class="load-item">
	<div id="controls">
	    <?php
	        $pp_full_image_title = get_option('pp_full_image_title');
	        if(!empty($pp_full_image_title))
	        {
	    ?>
	        <!--Slide captions displayed here--> 
	        <div id="slidecaption"></div>
	    <?php
	        }
	    ?>
	</div>
</div>

<?php
    //Get Gallery Cover
    get_template_part("/templates/template-cover");
?>

<div class="page_control_static">
    <a id="page_maximize" href="#"></a>
</div>

<?php
    //Get Social Share
    get_template_part("/templates/template-share");
?>

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

<?php	
	get_footer();
?>