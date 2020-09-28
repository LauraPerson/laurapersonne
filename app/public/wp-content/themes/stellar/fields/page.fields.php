<?php

/**
 * The PHP code for setup Theme page custom fields.
 *
 * @package WordPress
 */

function is_edit_page($new_edit = null){
    global $pagenow;
    //make sure we are on the backend
    if (!is_admin()) return false;


    if($new_edit == "edit")
        return in_array( $pagenow, array( 'post.php',  ) );
    elseif($new_edit == "new") //check for new post page
        return in_array( $pagenow, array( 'post-new.php' ) );
    else //check for either new or edit
        return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
}

/*
	Begin creating custom fields
*/

$theme_sidebar = array(
	'' => '',
	'Page Sidebar' => 'Page Sidebar', 
	'Contact Sidebar' => 'Contact Sidebar', 
	'Blog Sidebar' => 'Blog Sidebar',
	'Contact Sidebar' => 'Contact Sidebar',
);

$dynamic_sidebar = get_option('pp_sidebar');

if(!empty($dynamic_sidebar))
{
	foreach($dynamic_sidebar as $sidebar)
	{
		$theme_sidebar[$sidebar] = $sidebar;
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
$galleries_select['(Display Post Featured Image)'] = '';

foreach($galleries_arr as $gallery)
{
	$galleries_select[$gallery->ID] = $gallery->post_title;
}

//Get all gallery categories
function retrieve_my_gallerycat() 
{
    global $terms;
    
    $terms = get_terms('gallerycat', 'hide_empty=0&hierarchical=0&parent=0');
	$gallery_cat_select = array();
	$gallery_cat_select[''] = '';
	
	foreach($terms as $term)
	{
	    $gallery_cat_select[$term->slug] = $term->name;
	}

	return $gallery_cat_select;
}
add_action('init', 'retrieve_my_gallerycat', 9999);

$page_postmetas = 
	array (
		/*
			Begin Page custom fields
		*/
		array("section" => "Page Title", "id" => "page_logo_header", "type" => "checkbox", "title" => "Display Transparent Logo As Page Title", "description" => "Check this option if you want to display transparent logo as page title."),
		
		array("section" => "Page Tagline", "id" => "page_tagline", "type" => "textarea", "title" => "Page Tagline", "description" => "Enter page tagline. It will displays under page title (optional)"),
		
		array("section" => "Select Sidebar", "id" => "page_sidebar", "type" => "select", "title" => "Page Sidebar", "description" => "Select this page's sidebar to display", "items" => $theme_sidebar),
		
		array("section" => "Youtube Video ID", "id" => "page_youtube_id", "type" => "text", "title" => "Youtube Video ID", "description" => "If you select \"Fullscreen Youtube Video\" page template. Enter Youtube Video ID here ex. 5pEbJpjxbbU"),
		
		array("section" => "Vimeo Video ID", "id" => "page_vimeo_id", "type" => "text", "title" => "Vimeo Video ID", "description" => "If you select \"Fullscreen Vimeo Video\" page template. Enter Vimeo Video ID here ex. 58363796"),
		
		array("section" => "Content Type", "id" => "page_gallery_id", "type" => "select", "title" => "Gallery", "description" => "You can select image gallery to display on this page. <strong>(If you select Gallery as page template)</strong>", "items" => $galleries_select),
		/*
			End Page custom fields
		*/
		
	);
?>
<?php

function page_create_meta_box() {

	global $page_postmetas;
	if ( function_exists('add_meta_box') && isset($page_postmetas) && count($page_postmetas) > 0 ) {  
		add_meta_box( 'page_metabox', 'Page Options', 'page_new_meta_box', 'page', 'side', 'high' );  
	}

}  

function page_new_meta_box() {
	global $post, $page_postmetas;
	
	if(!is_edit_page('new'))
	{
		//Add gallery cats select
		$gallery_cat_select = retrieve_my_gallerycat();
		$page_postmetas[] = array("section" => "Content Type", "id" => "page_gallery_cat", "type" => "select", "title" => "Gallery Category", "description" => "You can select gallery category to display on this page. <strong>(If you select Gallery Archive as page template)</strong>", "items" => $gallery_cat_select);
	}

	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	echo '<br/>';
	
	$meta_section = '';

	foreach ( $page_postmetas as $postmeta ) {

		$meta_id = $postmeta['id'];
		$meta_title = $postmeta['title'];
		$meta_description = $postmeta['description'];
		$meta_section = $postmeta['section'];
		
		$meta_type = '';
		if(isset($postmeta['type']))
		{
			$meta_type = $postmeta['type'];
		}
		
		echo "<strong>".$meta_title."</strong><hr class='pp_widget_hr'/>";

		echo "<div class='pp_widget_description'>$meta_description</div>";

		if ($meta_type == 'checkbox') {
			$checked = get_post_meta($post->ID, $meta_id, true) == '1' ? "checked" : "";
			echo "<br style='clear:both'><input type='checkbox' name='$meta_id' id='$meta_id' class='iphone_checkboxes' value='1' $checked /><br style='clear:both'><br/><br/>";
		}
		else if ($meta_type == 'select') {
			echo "<p><select name='$meta_id' id='$meta_id'>";
			
			if(!empty($postmeta['items']))
			{
				foreach ($postmeta['items'] as $key => $item)
				{
					$page_style = get_post_meta($post->ID, $meta_id);
				
					if(isset($page_style[0]) && $key == $page_style[0])
					{
						$css_string = 'selected';
					}
					else
					{
						$css_string = '';
					}
				
					echo '<option value="'.$key.'" '.$css_string.'>'.$item.'</option>';
				}
			}
			
			echo "</select></p>";
		}
		else if ($meta_type == 'file') { 
		    echo "<p><input type='text' name='$meta_id' id='$meta_id' class='code' value='".get_post_meta($post->ID, $meta_id, true)."' style='width:89%' /><input id='".$meta_id."_button' name='".$meta_id."_button' type='button' value='Upload' class='metabox_upload_btn button' readonly='readonly' rel='".$meta_id."' style='margin:7px 0 0 5px' /></p>";
		}
		else if ($meta_type == 'textarea') {
					echo "<p><textarea name='$meta_id' id='$meta_id' class='code' style='width:100%' rows='7'>".get_post_meta($post->ID, $meta_id, true)."</textarea></p>";
				}
		else {
			echo "<p><input type='text' name='$meta_id' id='$meta_id' class='code' value='".get_post_meta($post->ID, $meta_id, true)."' style='width:99%' /></p>";
		}
		
		echo '<br/>';
	}
	
	echo '<br/>';

}

function page_save_postdata( $post_id ) {

	global $page_postmetas;
	
	//Add gallery cats select
	$gallery_cat_select = retrieve_my_gallerycat();
	$page_postmetas[] = array("section" => "Content Type", "id" => "page_gallery_cat", "type" => "select", "title" => "Gallery Category", "description" => "You can select gallery category to display on this page. <strong>(If you select Gallery Archive as page template)</strong>", "items" => $gallery_cat_select);

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( isset($_POST['myplugin_noncename']) && !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename(__FILE__) )) {
		return $post_id;
	}

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

	foreach ( $page_postmetas as $postmeta ) {
	
		if (isset($_POST[$postmeta['id']]) && $_POST[$postmeta['id']]) {
			page_update_custom_meta($post_id, $_POST[$postmeta['id']], $postmeta['id']);
		}

		if (isset($_POST[$postmeta['id']]) && $_POST[$postmeta['id']] == "") {
			delete_post_meta($post_id, $postmeta['id']);
		}
		
		if (!isset($_POST[$postmeta['id']])) {
			delete_post_meta($post_id, $postmeta['id']);
		}
	}

}

function page_update_custom_meta($postID, $newvalue, $field_name) {

	if (!get_post_meta($postID, $field_name)) {
		add_post_meta($postID, $field_name, $newvalue);
	} else {
		update_post_meta($postID, $field_name, $newvalue);
	}

}

//init

add_action('admin_menu', 'page_create_meta_box'); 
add_action('save_post', 'page_save_postdata');  

/*
	End creating custom fields
*/

?>
