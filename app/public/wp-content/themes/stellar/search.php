<?php
/**
 * The main template file for display search page.
 *
 * @package WordPress
*/

$pp_blog_search_layout = get_option('pp_blog_search_layout');
	
switch($pp_blog_search_layout)
{
    case 'page_sidebar':
    	get_template_part("blog");
    break;
    
	case 'fullwidth':
	default:
	    get_template_part("blog_f");
	break;
	
	case 'thumb':
		get_template_part("blog_thumb");
	break;
}
?>