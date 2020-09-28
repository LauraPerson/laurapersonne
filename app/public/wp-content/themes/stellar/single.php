<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

/**
*	Get current page id
**/

$current_page_id = $post->ID;

if($post->post_type=='attachment')
{
	get_template_part("single-attachment");
	exit;
}

if($post_type == 'galleries')
{
	//Get gallery template
	$gallery_template = get_post_meta($current_page_id, 'gallery_template', true);
	switch($gallery_template)
	{	
		case 'Gallery Vertical':
			get_template_part("gallery_vertical");
		break;
		
		case 'Gallery Horizontal':
			get_template_part("gallery_horizontal");
		break;
		
		case 'Gallery Masonry':
			get_template_part("gallery_masonry");
		break;
		
		case 'Gallery Fullscreen':
		default:
			get_template_part("gallery_f");
		break;
		
		case 'Gallery Flow':
			get_template_part("gallery_flow");
		break;
		
		case 'Gallery Kenburns':
			get_template_part("gallery_kenburns");
		break;
		
		case 'Gallery Grid':
			get_template_part("gallery_grid");
		break;
		
		case 'Gallery Wall':
			get_template_part("gallery_wall");
		break;
	}

	exit;
}
elseif($post_type == 'portfolios')
{
	get_template_part("single-portfolio");
	exit;
}
else
{
	$pp_blog_single_layout = get_option('pp_blog_single_layout');
	
	if($pp_blog_single_layout=='page_sidebar')
	{
		get_template_part("single-post-r");
		exit;
	}
	else
	{
		get_template_part("single-post-f");
		exit;
	}
}
?>