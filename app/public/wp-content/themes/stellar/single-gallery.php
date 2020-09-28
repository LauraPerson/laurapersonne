<?php
/**
 * The main template file for display portfolio page.
 *
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
$gallery_id = $page->ID;

get_header();

//Run gallery script data
wp_enqueue_script("script-supersized-gallery", get_stylesheet_directory_uri()."/templates/script-supersized-gallery.php?gallery_id=".$gallery_id, false, THEMEVERSION, true);
?>


<div id="thumb-tray" class="load-item">
    <a id="prevslide" class="load-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow_back.png" alt=""/></a>
    <a id="nextslide" class="load-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow_forward.png" alt=""/></a>
</div>

<?php
    $pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');
    if(!empty($pp_portfolio_enable_slideshow_title))
    {
?>
    <!--Slide captions displayed here--> 
    <div id="slidecaption"></div>
<?php
    }
?>

<br class="clear"/>
</div>

<?php
//get custom slideshow logo
$pp_slideshow_logo = get_option('pp_slideshow_logo');
    			
if(!empty($pp_slideshow_logo))
{
?>
    		
<a id="slideshow_logo">
    <img src="<?php echo $pp_slideshow_logo?>" alt=""/>
</a>
<?php
}
?>


<?php
	//important to apply dynamic footer style
	$pp_homepage_style = 'fullscreen';
	
	get_footer();
?>