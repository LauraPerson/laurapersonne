<?php

/**
*	Setup Page side bar
**/
if ( function_exists('register_sidebar') )
    register_sidebar(array('id' => 'sidebar-1', 'name' => 'Page Sidebar', 'description' => 'The default sidebar for every pages'));

if ( function_exists('register_sidebar') )
    register_sidebar(array('id' => 'sidebar-2', 'name' => 'Blog Sidebar', 'description' => 'The default sidebar for blog page templates'));

if ( function_exists('register_sidebar') )
    register_sidebar(array('id' => 'sidebar-3', 'name' => 'Single Post Sidebar', 'description' => 'The default sidebar for single post page'));
    
if ( function_exists('register_sidebar') )
    register_sidebar(array('id' => 'sidebar-4', 'name' => 'Single Image Page Sidebar', 'description' => 'The default sidebar for single attachment (image) page'));
    
if ( function_exists('register_sidebar') )
    register_sidebar(array('id' => 'sidebar-5', 'name' => 'Archives Sidebar', 'description' => 'The default sidebar for archive page'));
    
if ( function_exists('register_sidebar') )
    register_sidebar(array('id' => 'sidebar-6', 'name' => 'Category Sidebar', 'description' => 'The default sidebar for post category page'));
    
if ( function_exists('register_sidebar') )
    register_sidebar(array('id' => 'sidebar-7', 'name' => 'Search Sidebar', 'description' => 'The default sidebar for search result page'));
    
if ( function_exists('register_sidebar') )
    register_sidebar(array('id' => 'sidebar-8', 'name' => 'Tag Sidebar', 'description' => 'The default sidebar for tag post page'));
    
if ( function_exists('register_sidebar') )
    register_sidebar(array('id' => 'sidebar-9', 'name' => 'Shop Sidebar', 'description' => 'The default sidebar for shop page'));


//Register dynamic sidebar
$dynamic_sidebar = get_option('pp_sidebar');

if(!empty($dynamic_sidebar))
{
	foreach($dynamic_sidebar as $sidebar)
	{
		if ( function_exists('register_sidebar') )
	    register_sidebar(array('id' => sanitize_title($sidebar), 'name' => $sidebar));
	}
}

?>