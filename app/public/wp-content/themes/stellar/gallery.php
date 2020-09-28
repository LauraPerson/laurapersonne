<?php
/**
 * Template Name: Gallery
 * The main template file for display gallery page
 *
 * @package WordPress
*/

$page_gallery_id = get_post_meta($post->ID, 'page_gallery_id', true);
$gallery_template = get_post_meta($page_gallery_id, 'gallery_template', true);
global $page_gallery_id;

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
?>