<?php
/**
 * The main template file for display fullscreen youtube video
 *
 * Template Name: Fullscreen Youtube Video
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

//Get content gallery
$page_youtube_id = get_post_meta($current_page_id, 'page_youtube_id', true);

global $pp_homepage_style;
$pp_homepage_style = 'fullscreen';

get_header();

?>

<div id="full_video_bg">
	<iframe src="//www.youtube.com/embed/<?php echo $page_youtube_id; ?>?autoplay=1&hd=1&rel=0&showinfo=0&wmode=opaque&autohide=1" frameborder="0" allowfullscreen></iframe>
</div>

<?php
//Setup Google Analyric Code
get_template_part ("google-analytic");
?>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>