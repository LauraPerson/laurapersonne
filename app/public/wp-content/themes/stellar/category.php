<?php
/**
 * The main template file for display category page.
 *
 * @package WordPress
*/

$pp_blog_categories_layout = get_option('pp_blog_categories_layout');
	
switch($pp_blog_categories_layout)
{
    case 'page_sidebar':
    default:
    	get_template_part("blog");
    break;
    
    case 'fullwidth':
	    get_template_part("blog_f");
	break;
	
	case 'grid':
		get_template_part("blog_g");
	break;
	
	case 'thumb':
		get_template_part("blog_thumb");
	break;
}
?>