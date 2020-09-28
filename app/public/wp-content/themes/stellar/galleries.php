<?php
/**
 * The main template file for display gallery archives
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

global $page_gallery_cat;

if(empty($page_gallery_cat) && is_tax())
{
	//Get title
	$obj_term = get_term_by('slug', $term, 'gallerycat');
	$custom_title = $obj_term->name;
	
	//Get description
	$page_tagline = $obj_term->description;
	
	//Get featured header background
	$term_meta = get_option( "taxonomy_term_$obj_term->term_id" );
	$pp_page_bg = $term_meta['gallerycat_ft_img'];
}
else
{
	//Get title
	$custom_title = get_the_title();
	
	//Get description
	$page_tagline = get_post_meta($current_page_id, 'page_tagline', true);
	
	//Get featured header background
	$pp_page_bg = '';
	if(has_post_thumbnail($current_page_id, 'original'))
	{
		$image_id = get_post_thumbnail_id($current_page_id); 
		$image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
		$pp_page_bg = $image_thumb[0];
	}
}

global $pp_homepage_style;
$pp_homepage_style = 'blog_grid';

get_header();

wp_enqueue_script("jquery.cycle2.min", get_template_directory_uri()."/js/jquery.cycle2.min.js", false, THEMEVERSION, true);
wp_enqueue_script("custom_cycle", get_template_directory_uri()."/js/custom_cycle.js", false, THEMEVERSION, true);
?>

<?php
if(!empty($pp_page_bg))
{
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

<div id="page_caption">
    <div id="page_caption_wrapper">
    	<?php
    		//Check if display logo as page title
    		$page_logo_header = get_post_meta($current_page_id, 'page_logo_header', true);
    		if(empty($page_logo_header))
    		{
    	?>
    	<h1><?php echo $custom_title; ?></h1>
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
    </div>
    
    <?php
	    //Get Social Share
	    get_template_part("/templates/template-share");
	?>
</div>

<!-- Begin content -->
<div id="page_content_wrapper" class="two nopadding gallery">
    
    <div class="inner">

    	<div class="inner_wrapper">
		
			<div id="blog_grid_wrapper">
			<?php
				//Get galleries
				global $wp_query;
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$pp_portfolio_items_page = -1;
				
				$query_string = 'paged='.$paged.'&orderby=menu_order&order=ASC&post_type=galleries&posts_per_page=-1&suppress_filters=0';
				
				if(!empty($page_gallery_cat))
				{
				    $query_string .= '&gallerycat='.$page_gallery_cat;
				}
				else
				{
				    $query_string .= '&gallerycat='.$term;
				}
				
				query_posts($query_string);
			
				$key = 0;
			    if (have_posts()) : while (have_posts()) : the_post();
				    $image_url = '';
				    $gallery_ID = get_the_ID();
				    		
				    if(has_post_thumbnail($gallery_ID, 'original'))
				    {
				        $image_id = get_post_thumbnail_id($gallery_ID);
				        $small_image_url = wp_get_attachment_image_src($image_id, 'gallery_c', true);
				    }
				    
				    $permalink_url = get_permalink($gallery_ID);
			?>
			
			<div class="wall_entry type-post post gallery masonry element">
			    <?php 
			    	if(!empty($small_image_url[0]))
					{
						//Get gallery images
						$all_photo_arr = get_post_meta($gallery_ID, 'wpsimplegallery_gallery', true);
						
						//Get only 5 recent photos
						$all_photo_arr = array_slice($all_photo_arr, 0, 5);
			    ?>
			    <div class="wall_thumbnail">
			    	<a href="<?php echo $permalink_url; ?>">
			    		<img src="<?php echo $small_image_url[0]; ?>" alt="" class="portfolio_img static"/>
			            <div class="mask">
						    <div class="mask_frame">
						    	<?php
							    	if(!empty($all_photo_arr))
							    	{
							    ?>
							    <ul class="gallery_img_slides">
							    <?php
							    	foreach($all_photo_arr as $photo)
							    	{
							    		$slide_image_url = wp_get_attachment_image_src($photo, 'gallery_c', true);
							    ?>
							    <li><img src="<?php echo $slide_image_url[0]; ?>" alt="" class="static"/></li>
							    <?php
							    	}
							    ?>
							    </ul>
							    <?php
							    	}
							    ?>
						    
						    	<div class="mask_image_content hascycle">
						    		<div class="mask_image_content_frame">
						    			<h6><?php echo get_the_title(); ?></h6>
						                <span><?php echo strip_tags(pp_get_the_excerpt($gallery_ID)); ?></span>
						    		</div>
						    	</div>
						    </div>
						</div>
					</a>
			    </div>
			    <?php
			    	}
			    ?>
			
			</div>
			
			<?php
			    $key++;
			    endwhile; endif;	
			?>
			</div>

		</div>

	</div>

<?php	
	get_footer();
?>