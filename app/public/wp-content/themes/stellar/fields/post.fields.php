<?php

function post_type_galleries() {
	$labels = array(
    	'name' => _x('Galleries', 'post type general name', THEMEDOMAIN),
    	'singular_name' => _x('Gallery', 'post type singular name', THEMEDOMAIN),
    	'add_new' => _x('Add New Gallery', 'book', THEMEDOMAIN),
    	'add_new_item' => __('Add New Gallery', THEMEDOMAIN),
    	'edit_item' => __('Edit Gallery', THEMEDOMAIN),
    	'new_item' => __('New Gallery', THEMEDOMAIN),
    	'view_item' => __('View Gallery', THEMEDOMAIN),
    	'search_items' => __('Search Gallery', THEMEDOMAIN),
    	'not_found' =>  __('No Gallery found', THEMEDOMAIN),
    	'not_found_in_trash' => __('No Gallery found in Trash', THEMEDOMAIN), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title','editor', 'thumbnail', 'excerpt'),
    	'menu_icon' => get_template_directory_uri().'/functions/images/sign.png'
	); 		

	register_post_type( 'galleries', $args );
	
  	$labels = array(			  
  	  'name' => _x( 'Gallery Categories', 'taxonomy general name', THEMEDOMAIN ),
  	  'singular_name' => _x( 'Gallery Category', 'taxonomy singular name', THEMEDOMAIN ),
  	  'search_items' =>  __( 'Search Gallery Categories', THEMEDOMAIN ),
  	  'all_items' => __( 'All Gallery Categories', THEMEDOMAIN ),
  	  'parent_item' => __( 'Parent Gallery Category', THEMEDOMAIN ),
  	  'parent_item_colon' => __( 'Parent Gallery Category:', THEMEDOMAIN ),
  	  'edit_item' => __( 'Edit Gallery Category', THEMEDOMAIN ), 
  	  'update_item' => __( 'Update Gallery Category', THEMEDOMAIN ),
  	  'add_new_item' => __( 'Add New Gallery Category', THEMEDOMAIN ),
  	  'new_item_name' => __( 'New Gallery Category Name', THEMEDOMAIN ),
  	); 							  
  	
  	register_taxonomy(
		'gallerycat',
		'galleries',
		array(
			'public'=>true,
			'hierarchical' => true,
			'labels'=> $labels,
			'query_var' => 'gallerycat',
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'gallerycat', 'with_front' => false ),
		)
	);		  
} 
								  
add_action('init', 'post_type_galleries');

function post_type_portfolios() {
	$labels = array(
    	'name' => _x('Portfolios', 'post type general name', THEMEDOMAIN),
    	'singular_name' => _x('Portfolio', 'post type singular name', THEMEDOMAIN),
    	'add_new' => _x('Add New Portfolio', 'book', THEMEDOMAIN),
    	'add_new_item' => __('Add New Portfolio', THEMEDOMAIN),
    	'edit_item' => __('Edit Portfolio', THEMEDOMAIN),
    	'new_item' => __('New Portfolio', THEMEDOMAIN),
    	'view_item' => __('View Portfolio', THEMEDOMAIN),
    	'search_items' => __('Search Portfolios', THEMEDOMAIN),
    	'not_found' =>  __('No Portfolio found', THEMEDOMAIN),
    	'not_found_in_trash' => __('No Portfolio found in Trash', THEMEDOMAIN), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title','editor', 'thumbnail', 'excerpt'),
    	'menu_icon' => get_template_directory_uri().'/functions/images/sign.png'
	); 		

	register_post_type( 'portfolios', $args );
	
  	$labels = array(			  
  	  'name' => _x( 'Portfolio Categories', 'taxonomy general name', THEMEDOMAIN ),
  	  'singular_name' => _x( 'Portfolio Category', 'taxonomy singular name', THEMEDOMAIN ),
  	  'search_items' =>  __( 'Search Portfolio Categories', THEMEDOMAIN ),
  	  'all_items' => __( 'All Portfolio Categories', THEMEDOMAIN ),
  	  'parent_item' => __( 'Parent Portfolio Category', THEMEDOMAIN ),
  	  'parent_item_colon' => __( 'Parent Portfolio Category:', THEMEDOMAIN ),
  	  'edit_item' => __( 'Edit Portfolio Category', THEMEDOMAIN ), 
  	  'update_item' => __( 'Update Portfolio Category', THEMEDOMAIN ),
  	  'add_new_item' => __( 'Add New Portfolio Category', THEMEDOMAIN ),
  	  'new_item_name' => __( 'New Portfolio Category Name', THEMEDOMAIN ),
  	); 							  
  	
  	register_taxonomy(
		'portfoliosets',
		'portfolios',
		array(
			'public'=>true,
			'hierarchical' => true,
			'labels'=> $labels,
			'query_var' => 'portfoliosets',
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'portfoliosets', 'with_front' => false ),
		)
	);		  
} 
								  
add_action('init', 'post_type_portfolios');


add_filter( 'manage_posts_columns', 'rt_add_gravatar_col');
function rt_add_gravatar_col($cols) {
	$cols['thumbnail'] = __('Thumbnail', THEMEDOMAIN);
	return $cols;
}

add_action( 'manage_posts_custom_column', 'rt_get_author_gravatar');
function rt_get_author_gravatar($column_name ) {
	if ( $column_name  == 'thumbnail'  ) {
		echo get_the_post_thumbnail(get_the_ID(), array(100, 100));
	}
}

/*
	Get gallery list
*/
$args = array(
    'numberposts' => -1,
    'post_type' => array('galleries'),
);

$galleries_arr = get_posts($args);
$galleries_select = array();
$galleries_select[''] = '';

foreach($galleries_arr as $gallery)
{
	$galleries_select[$gallery->post_title] = $gallery->ID;
}

/*
	Begin creating custom fields
*/

$postmetas = 
	array (
		
		'portfolios' => array(
			array("section" => "Content Type", "id" => "portfolio_type", "type" => "select", "title" => "Portfolio Content Type", "description" => "Select content type for this portfolio item:", 
				"items" => array(
					"Image" => "Image",
					"Youtube Video" => "Youtube Video",
					"Vimeo Video" => "Vimeo Video", 
					"Self-Hosted Video" => "Self-Hosted Video",
					"Portfolio Content" => "Portfolio Content",
					"External Link" => "External Link",
				)),
				
				array("section" => "Content Type", "id" => "portfolio_video_id", "title" => "Youtube or Vimeo Video ID", "description" => "If you select Youtube Video or Vimeo Video. Enter your video ID here:"),
				array("section" => "Content Type", "id" => "portfolio_mp4_url", "type" => "file", "title" => "Video URL (.mp4 file format)", "description" => "If you select Self-Hosted. Enter your video URL (.mp4 file format):"),
				array("section" => "Content Type", "id" => "portfolio_link_url", "title" => "Link URL (for external link content type only)", "description" => "Portfolio item will link to this URL"),
		),
		
		'post' => array(
			array("section" => "Background Image", "id" => "post_ft_bg", "type" => "checkbox", "title" => "Display featured image as Background image", "description" => "Check this option if you want to display featured as background image for of this post."),
			
			array(
    		"section" => "Featured Content Type", "id" => "post_ft_type", "type" => "select", "title" => "Featured Content Type", "description" => "Select featured content type for this post. Different content type will be displayed on single post page", 
				"items" => array(
					"Image" => "Image",
					"Gallery" => "Gallery",
					"Vimeo Video" => "Vimeo Video",
					"Youtube Video" => "Youtube Video",
				)),
				
			array("section" => "Gallery", "id" => "post_ft_gallery", "type" => "select", "title" => "Gallery", "description" => "Please select a gallery (*Note enter if you select \"Gallery\" as Featured Content Type))", "items" => $galleries_select),
				
			array("section" => "Vimeo Video ID", "id" => "post_ft_vimeo", "type" => "text", "title" => "Vimeo Video ID", "description" => "Please enter Vimeo Video ID for example 73317780 (*Note enter if you select \"Vimeo Video\" as Featured Content Type)"),
			
			array("section" => "Youtube Video ID", "id" => "post_ft_youtube", "type" => "text", "title" => "Youtube Video ID", "description" => "Please enter Youtube Video ID for example 6AIdXisPqHc (*Note enter if you select \"Youtube Video\" as Featured Content Type)"),
		),
		
		'galleries' => array(
			array("section" => "Gallery Template", "id" => "gallery_template", "type" => "select", "title" => "Gallery Template", "description" => "Select gallery template for this gallery", 
				"items" => array(
					"Gallery Vertical" => "Gallery Vertical",
					"Gallery Horizontal" => "Gallery Horizontal",
					"Gallery Grid" => "Gallery Grid",
					"Gallery Masonry" => "Gallery Masonry",
					"Gallery Flow" => "Gallery Flow",
					"Gallery Fullscreen" => "Gallery Fullscreen",
					"Gallery Kenburns" => "Gallery Kenburns",
					"Gallery Grid" => "Gallery Grid",
					"Gallery Wall" => "Gallery Wall",
				)),
				
			array("section" => "Gallery Cover", "id" => "gallery_cover", "type" => "checkbox", "title" => "Display Gallery Cover", "description" => "Check this option if you want to display gallery cover for this gallery."),
			
			array("section" => "Password Protect", "id" => "gallery_password", "title" => "Password", "description" => "Enter your password for this gallery"),
			
			array("section" => "Background Audio", "id" => "gallery_audio", "type" => "file", "title" => "Gallery Background Audio", "description" => "Support file types *.mp3, *.mp4"),
		),
);

/*print '<pre>';
print_r($post_obj);
print '</pre>';*/

function create_meta_box() {

	global $postmetas;
	
	if(!isset($_GET['post_type']) OR empty($_GET['post_type']))
	{
		if(isset($_GET['post']) && !empty($_GET['post']))
		{
			$post_obj = get_post($_GET['post']);
			$_GET['post_type'] = $post_obj->post_type;
		}
		else
		{
			$_GET['post_type'] = 'post';
		}
	}
	
	if ( function_exists('add_meta_box') && isset($postmetas) && count($postmetas) > 0 ) {  
		foreach($postmetas as $key => $postmeta)
		{
			if($_GET['post_type']==$key && !empty($postmeta))
			{
				add_meta_box( 'metabox', ucfirst($key).' Options', 'new_meta_box', $key, 'side', 'high' ); 
			}
		}
	}

}  

function new_meta_box() {
	global $post, $postmetas;
	
	if(!isset($_GET['post_type']) OR empty($_GET['post_type']))
	{
		if(isset($_GET['post']) && !empty($_GET['post']))
		{
			$post_obj = get_post($_GET['post']);
			$_GET['post_type'] = $post_obj->post_type;
		}
		else
		{
			$_GET['post_type'] = 'post';
		}
	}

	echo '<input type="hidden" name="tg_custom_post_flag" id="tg_custom_post_flag" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	$meta_section = '';

	foreach ( $postmetas as $key => $postmeta ) {
	
		if($_GET['post_type'] == $key)
		{
		
			foreach ( $postmeta as $each_meta ) {
		
				$meta_id = $each_meta['id'];
				$meta_title = $each_meta['title'];
				$meta_description = $each_meta['description'];
				
				if(isset($postmeta['section']))
				{
					$meta_section = $postmeta['section'];
				}
				
				$meta_type = '';
				if(isset($each_meta['type']))
				{
					$meta_type = $each_meta['type'];
				}
				
				echo "<br/><strong>".$meta_title."</strong><hr class='pp_widget_hr'/>";
				echo "<div class='pp_widget_description'>$meta_description</div>";
				
				if ($meta_type == 'checkbox') {
					$checked = get_post_meta($post->ID, $meta_id, true) == '1' ? "checked" : "";
					echo "<br style='clear:both'><input type='checkbox' name='$meta_id' id='$meta_id' class='iphone_checkboxes' value='1' $checked /><br style='clear:both'><br/><br/>";
				}
				else if ($meta_type == 'select') {
					echo "<p><select name='$meta_id' id='$meta_id'>";
					
					if(!empty($each_meta['items']))
					{
						foreach ($each_meta['items'] as $key => $item)
						{
							echo '<option value="'.$item.'"';
							
							if($item == get_post_meta($post->ID, $meta_id, true))
							{
								echo ' selected ';
							}
							
							echo '>'.$key.'</option>';
						}
					}
					
					echo "</select></p>";
				}
				else if ($meta_type == 'file') { 
				    echo "<p><input type='text' name='$meta_id' id='$meta_id' class='' value='".get_post_meta($post->ID, $meta_id, true)."' style='width:89%' /><input id='".$meta_id."_button' name='".$meta_id."_button' type='button' value='Upload' class='metabox_upload_btn button' readonly='readonly' rel='".$meta_id."' style='margin:7px 0 0 0' /></p>";
				}
				else if ($meta_type == 'textarea') {
					echo "<p><textarea name='$meta_id' id='$meta_id' class='code' style='width:100%' rows='7'>".get_post_meta($post->ID, $meta_id, true)."</textarea></p>";
				}			
				else {
					echo "<p><input type='text' name='$meta_id' id='$meta_id' class='code' value='".get_post_meta($post->ID, $meta_id, true)."' style='width:99%' /></p>";
				}
			}
		}
	}
	
	echo '<br/>';

}

function save_postdata( $post_id ) {

	global $postmetas;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( isset($_POST['tg_custom_post_flag'])) 
	{
		// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything
	
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
	
		// Check permissions
	
		if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ) )
				return $post_id;
			} else {
			if ( !current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}
	
		// OK, we're authenticated
	
		if ( $parent_id = wp_is_post_revision($post_id) )
		{
			$post_id = $parent_id;
		}
		
		foreach ( $postmetas as $postmeta ) {
			foreach ( $postmeta as $each_meta ) {
		
				if (isset($_POST[$each_meta['id']]) && $_POST[$each_meta['id']]) {
					update_custom_meta($post_id, $_POST[$each_meta['id']], $each_meta['id']);
				}
		
				if (isset($_POST[$each_meta['id']]) && $_POST[$each_meta['id']] == "") {
					delete_post_meta($post_id, $each_meta['id']);
				}
				
				if (!isset($_POST[$each_meta['id']])) {
					delete_post_meta($post_id, $each_meta['id']);
				}
			}
		}
	}
}

function update_custom_meta($postID, $newvalue, $field_name) {

	if (!get_post_meta($postID, $field_name)) {
		add_post_meta($postID, $field_name, $newvalue);
	} else {
		update_post_meta($postID, $field_name, $newvalue);
	}

}

//init

add_action('admin_menu', 'create_meta_box'); 
add_action('save_post', 'save_postdata');  

/*
	End creating custom fields
*/

?>