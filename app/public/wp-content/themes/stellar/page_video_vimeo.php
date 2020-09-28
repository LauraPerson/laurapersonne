<?php
/**
 * The main template file for display fullscreen vimeo video
 *
 * Template Name: Fullscreen Vimeo Video
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
$page_vimeo_id = get_post_meta($current_page_id, 'page_vimeo_id', true);

global $pp_homepage_style;
$pp_homepage_style = 'fullscreen';

get_header();
?>

<div id="full_video_bg">
	<iframe frameborder="0" src="http://player.vimeo.com/video/<?php echo $page_vimeo_id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;loop=0" webkitallowfullscreen="" allowfullscreen=""></iframe>
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