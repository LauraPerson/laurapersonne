<?php
/**
 * Template Name: Background Image Page
 * The main template file for display page.
 *
 * @package WordPress
*/

/**
*	Get Current page object
**/
$page = get_page($post->ID);

/**
*	Get current page id
**/

if(!isset($current_page_id) && isset($page->ID))
{
    $current_page_id = $page->ID;
}
global $pp_homepage_style;
$pp_homepage_style = 'fullscreen';

get_header(); 
?>

<?php
if(has_post_thumbnail($current_page_id, 'original'))
{
	$image_id = get_post_thumbnail_id($current_page_id); 
	$image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
	$pp_page_bg = $image_thumb[0];
        
    wp_enqueue_script("jquery.backstretch", get_stylesheet_directory_uri()."/js/jquery.backstretch.js", false, THEMEVERSION, true);
    wp_enqueue_script("script-static-bg", get_stylesheet_directory_uri()."/templates/script-static-bg.php?bg_url=".$pp_page_bg, false, THEMEVERSION, true);
}
?>

<?php get_footer(); ?>