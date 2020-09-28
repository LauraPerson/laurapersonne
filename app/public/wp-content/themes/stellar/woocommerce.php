<?php
/**
 * The main template file for display page.
 *
 * @package WordPress
*/

/**
*	Get current page id
**/
$current_page_id = get_option( 'woocommerce_shop_page_id' );

get_header();

//Get Shop Sidebar
$page_sidebar = '';

//Get Shop Sidebar Display Settting
$pp_shop_layout = get_option('pp_shop_layout');
if($pp_shop_layout == 'sidebar')
{
	$page_sidebar = 'Shop Sidebar';
}
?>

<?php
if(!is_category())
{
    $page_title = get_the_title($current_page_id);
}
else
{
    $page_title = get_the_title();
}
?>

<?php
if(has_post_thumbnail($current_page_id, 'original'))
{
	$image_id = get_post_thumbnail_id($current_page_id); 
	$image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
	$pp_page_bg = $image_thumb[0];
?>
<div id="page_header_bg" style="background-image:url(<?php echo $pp_page_bg; ?>);"></div>
<?php
}
else
{
?>
<div id="page_header_bg"></div>
<?php
}
?>

<?php
$page_tagline = get_post_meta($current_page_id, 'page_tagline', true);
?>
<div id="page_caption">
    <div id="page_caption_wrapper">
    	<?php
	        //Check if display logo as page title
	        $page_logo_header = get_post_meta($current_page_id, 'page_logo_header', true);
	        if(empty($page_logo_header))
	        {
	    ?>
	    <h1><?php echo $page_title; ?></h1>
	    <?php
	        }
	        else
	        {
	        	$pp_logo_transparent = get_option('pp_logo_transparent');
		        $pp_retina_logo_transparent = get_option('pp_retina_logo_transparent');
		        $pp_retina_logo_transparent_width = 0;
		        $pp_retina_logo_transparent_height = 0;
		        
		        if(!empty($pp_retina_logo_transparent))
		        {
		    	    if(empty($pp_retina_logo_width) && empty($pp_retina_logo_height))
		    	    {
		    	        //Get image width and height
		    	        $pp_retina_logo_id = pp_get_image_id($pp_retina_logo_transparent);
		    	        $image_logo = wp_get_attachment_image_src($pp_retina_logo_id, 'original');
		    	        
		    	        $pp_retina_logo_transparent = $image_logo[0];
		    	        $pp_retina_logo_transparent_width = intval($image_logo[1]/2);
				        $pp_retina_logo_transparent_height = intval($image_logo[2]/2);
		    	    }
	    ?>
	        		<img src="<?php echo $pp_retina_logo_transparent; ?>" alt="" width="<?php echo $pp_retina_logo_transparent_width; ?>" height="<?php echo $pp_retina_logo_transparent_height; ?>"/>
		<?php 
		    	}
		    	else
		    	{
		?>
		    		<img src="<?php echo $pp_logo_transparent?>" alt=""/>
		<?php
		    	}
		    } 
		?>
    	<?php
    	if(!empty($page_tagline))
    	{
    	?>
    	<div class="page_tagline">
    		<?php echo $page_tagline; ?>
    	</div>
    	<?php
    	}
    	?>
    	
    	<?php
		    //Get Social Share
		    get_template_part("/templates/template-share");
		?>
    </div>
</div>

<!-- Begin content -->
<div id="page_content_wrapper" class="two">
    <div class="inner ">
    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    		<div class="sidebar_content <?php if(empty($page_sidebar)) { ?>full_width<?php } ?>">
				
				<?php woocommerce_content();  ?>
				
    		</div>
    		<?php 
    		if(!empty($page_sidebar)) { ?>
    		<div class="sidebar_wrapper">
	            <div class="sidebar">
	            
	            	<div class="content">
						<ul class="sidebar_widget">
		    	    	<?php dynamic_sidebar($page_sidebar); ?>
		    	    	</ul>
	            	</div>
	        
	            </div>
            <br class="clear"/>
        
            <div class="sidebar_bottom"></div>
			</div>
			<br class="clear"/><br/>
    		<?php } ?>
    	</div>
    	<!-- End main content -->
    </div>
</div>

<!-- End content -->
<?php get_footer(); ?>