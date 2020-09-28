<?php
/**
 * Template Name: Gallery Archive
 * The main template file for display gallery page
 *
 * @package WordPress
*/

$page_gallery_cat = get_post_meta($post->ID, 'page_gallery_cat', true);
global $page_gallery_cat;

get_template_part("galleries");

exit;
?>