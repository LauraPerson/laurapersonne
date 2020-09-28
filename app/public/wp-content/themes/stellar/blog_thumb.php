<?php
/**
 * Template Name: Blog Thumbnails
 * The main template file for display blog page.
 *
 * @package WordPress
*/

/**
*	Get Current page object
**/
if(!is_null($post))
{
	$page = get_page($post->ID);
}

$current_page_id = '';

/**
*	Get current page id
**/

if(!is_null($post) && isset($page->ID))
{
    $current_page_id = $page->ID;
}

get_header(); 
?>

<?php
if(!is_home() && !is_archive() && !is_category() && !is_search() && !is_tag())
{
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
}
else
{
	if(is_archive() && !is_category() && !is_tag())
	{
		$pp_bg_archives = get_option('pp_bg_archives');
		
		if(!empty($pp_bg_archives))
		{
			$pp_page_bg = $pp_bg_archives;
		?>
		<div id="page_header_bg" style="background-image:url(<?php echo $pp_page_bg; ?>);"></div>
		<?php
		}
	}
	elseif(is_category())
	{
		$pp_bg_categories = get_option('pp_bg_categories');
		
		if(!empty($pp_bg_categories))
		{
			$pp_page_bg = $pp_bg_categories;
		?>
		<div id="page_header_bg" style="background-image:url(<?php echo $pp_page_bg; ?>);"></div>
		<?php
		}
	}
	elseif(is_search())
	{
		$pp_bg_search = get_option('pp_bg_search');
		
		if(!empty($pp_bg_search))
		{
			$pp_page_bg = $pp_bg_search;
		?>
		<div id="page_header_bg" style="background-image:url(<?php echo $pp_page_bg; ?>);"></div>
		<?php
		}
	}
	elseif(is_tag())
	{
		$pp_bg_tags = get_option('pp_bg_tags');
		
		if(!empty($pp_bg_tags))
		{
			$pp_page_bg = $pp_bg_tags;
		?>
		<div id="page_header_bg" style="background-image:url(<?php echo $pp_page_bg; ?>);"></div>
		<?php
		}
	}
}
?>

<!-- Begin content -->

<?php
	$page_title = get_the_title();
	$page_tagline = get_post_meta($current_page_id, 'page_tagline', true);

	if(is_tag())
	{
		$page_title = single_cat_title( '', false );
		$page_tagline = __( 'Posts tagged ', THEMEDOMAIN ).single_cat_title( '', false );

	}
	elseif(is_search())
	{
		$page_title = get_search_query();
		$page_tagline = __( 'Search Results for ', THEMEDOMAIN ).get_search_query();
	}
	elseif(is_category())
	{
		$page_title = single_cat_title( '', false );
		$page_tagline = __( 'Posts category ', THEMEDOMAIN ).single_cat_title( '', false );
	}
	elseif(is_archive())
	{
		if ( is_day() ) : 
			$page_title = get_the_date(); 
	    elseif ( is_month() ) : 
	    	$page_title = get_the_date('F Y'); 
	    elseif ( is_year() ) : 
	    	$page_title = get_the_date('Y'); 
	    else :
	    	$page_title = __( 'Blog Archives', THEMEDOMAIN); 
	    endif; 
	    
	    $page_tagline = __( 'Posts archives ', THEMEDOMAIN );
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

<div id="page_content_wrapper" class="two">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    		
    		<div class="sidebar_content full_width">
					
			<?php
			//Get current page number
			if(is_front_page())
			{
				$paged = (get_query_var('page')) ? get_query_var('page') : 1;
			}
			else
			{
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			}
			
			if(!is_archive() && !is_category() && !is_search() && !is_tag())
			{
			    $query_string ="post_type=post&paged=$paged";
			    query_posts($query_string);
			}
			
			if (have_posts()) : while (have_posts()) : the_post();
			
				$image_thumb = '';
											
				if(has_post_thumbnail(get_the_ID(), 'gallery_c'))
				{
				    $image_id = get_post_thumbnail_id(get_the_ID());
				    $image_thumb = wp_get_attachment_image_src($image_id, 'gallery_c', true);
				}
			?>
			
			<!-- Begin each blog post -->
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
				<div class="post_wrapper thumbnails">
				
					<?php
						if(!empty($image_thumb))
						{
						    $small_image_url = wp_get_attachment_image_src($image_id, 'gallery_c', true);
				    ?>
				    
						<div class="post_img thumbnails">
						    <a href="<?php the_permalink(); ?>">
						    	<img src="<?php echo $small_image_url[0]; ?>" alt="" class=""/>
						    </a>
						</div>
				    
				    <?php
				    	}
				    ?>
					
					<div class="post_header thumbnails">
				    	<h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
				    	<div class="post_detail">
				    		<?php
						        //Get Post's Categories
						        $post_categories = wp_get_post_categories($post->ID);
						        if(!empty($post_categories))
						        {
						    ?>
						    <?php echo _e( 'In', THEMEDOMAIN ); ?>&nbsp;
						    <?php
						        	foreach($post_categories as $c)
						        	{
						        		$cat = get_category( $c );
						    ?>
						        	<a class="uppercase" href="<?php echo get_category_link($cat->term_id); ?>"><?php echo $cat->name; ?></a>&nbsp;
						    <?php
						        	}
						        }
						    ?>
						    <?php echo _e( 'on', THEMEDOMAIN ); ?>&nbsp;<span class="uppercase"><?php echo get_the_time(THEMEDATEFORMAT); ?></span>&nbsp;
						    <?php
						    	$author_ID = get_the_author_meta('ID');
						    	$author_name = get_the_author();
						    	$author_url = get_author_posts_url($author_ID);
						    	
						    	if(!empty($author_name))
						    	{
						    ?>
						    	<?php echo _e( 'by', THEMEDOMAIN ); ?>&nbsp;<a class="uppercase" href="<?php echo $author_url; ?>"><?php echo $author_name; ?></a>&nbsp;
						    <?php
						    	}
						    ?>
						    <?php echo _e( 'has', THEMEDOMAIN ); ?>&nbsp;<a class="uppercase" href="<?php comments_link(); ?>"><?php comments_number(__('No Comment', THEMEDOMAIN), __('1 Comment', THEMEDOMAIN), __('% Comments', THEMEDOMAIN)); ?></a>
						</div>
						
						<br class="clear"/>
						
						<p><?php echo pp_substr(strip_shortcodes(get_the_excerpt()), 130); ?></p>
				    		
				    </div>
				    
				</div>
			
			</div>
			<!-- End each blog post -->
			
			<br class="clear"/>
			
			<?php endwhile; else: ?>
			
				<div class="search_form_wrapper">
	    			<h3><?php _e( 'New Search', THEMEDOMAIN ); ?></h3>
	    			<?php _e( "Oops, The Content Could Not Be Found. Please try a new search.", THEMEDOMAIN ); ?><br/><br/>
	    			
	    			<form class="searchform" role="search" method="get" action="<?php echo home_url(); ?>">
						<input style="width:96%" type="text" class="field searchform-s" name="s" value="<?php the_search_query(); ?>" title="<?php _e( 'Type and hit enter', THEMEDOMAIN ); ?>"><br/><br/>
						<input type="submit" value="<?php _e( 'Search', THEMEDOMAIN ); ?>"/>
					</form>
    			</div>	
			
			<?php endif; ?>

	    	<?php
				if (function_exists("wpapi_pagination")) 
				{
				    wpapi_pagination($wp_query->max_num_pages);
				}
				else
				{
				?>
				    <div class="pagination"><p><?php posts_nav_link(' '); ?></p></div>
				<?php
				}
			?>
    	
	    </div>
	    <!-- End main content -->
	
	</div>

</div>  

<?php get_footer(); ?>