<?php
/**
 * The main template file for display single post portfolio.
 *
 * @package WordPress
*/

get_header(); 

?>

<?php

/**
*	Get current page id
**/

$current_page_id = $post->ID;
$portfolio_gallery_id = get_post_meta($current_page_id, 'portfolio_gallery_id', true);

if(has_post_thumbnail($current_page_id, 'original'))
{
    $image_id = get_post_thumbnail_id($current_page_id); 
    $image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
    $pp_page_bg = $image_thumb[0];
?>
<div id="page_header_bg" style="background-image:url(<?php echo $pp_page_bg; ?>);"></div>
<?php
}
?>

<div id="page_caption">

    <div id="page_caption_wrapper">
    	<h1><?php the_title(); ?></h1>
		<div class="page_tagline">
		    <?php echo get_the_excerpt(); ?>
		</div>
    </div>
    
    <?php
	    //Get Social Share
	    get_template_part("/templates/template-share");
	?>
	
	<?php	
	if(TRUE)
	{
	?>
	<div class="portfolio_post_wrapper">
	<?php
	    //Get Previous and Next Post
	    $prev_post = get_previous_post();
	    $next_post = get_next_post();
	?>
	    
	<?php
	   //Get Previous Post
	   if (!empty($prev_post)): 
	   	$prev_image_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($prev_post->ID), 'thumbnail', true);
	   	if(isset($prev_image_thumb[0]))
	   	{
	   	    $image_file_name = basename($prev_image_thumb[0]);
	   	}
	?>
	   	<div class="portfolio_post_previous">
	   		<a class="portfolio_prev <?php if(isset($prev_image_thumb[0]) && $image_file_name!='default.png') { ?>portfolio_prev_next_link<?php } ?>" <?php if(isset($prev_image_thumb[0]) && $image_file_name!='default.png') { ?>data-img="<?php echo $prev_image_thumb[0]; ?>"<?php } ?> href="<?php echo get_permalink( $prev_post->ID ); ?>">
	     		<?php echo _e( 'Back', THEMEDOMAIN ); ?>
	     	</a>
	    </div>
	<?php endif; ?>
	
	<?php
	   //Get Next Post
	   if (!empty($next_post)): 
	   $next_image_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($next_post->ID), 'thumbnail', true);
	   if(isset($next_image_thumb[0]))
	   {
	       $image_file_name = basename($next_image_thumb[0]);
	   }
	?>
	   <div class="portfolio_post_next">
	   		<a class="portfolio_next <?php if(isset($next_image_thumb[0]) && $image_file_name!='default.png') { ?>portfolio_prev_next_link<?php } ?>" <?php if(isset($next_image_thumb[0]) && $image_file_name!='default.png') { ?>data-img="<?php echo $next_image_thumb[0]; ?>"<?php } ?> href="<?php echo get_permalink( $next_post->ID ); ?>">
	     		<?php echo _e( 'Next', THEMEDOMAIN ); ?>
	     	</a>
	    </div>
	<?php endif; ?>
	
	<?php
	    //If has previous or next post then add line break
	    if(!empty($prev_post) OR !empty($next_post))
	    {
	    	echo '<br class="clear"/><br/>';
	    }
	?>
	</div>
	<?php
	}
	?>
</div>

<div id="page_content_wrapper" class="two">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

	    	<div class="sidebar_content full_width">
		    	<?php
					if (have_posts())
					{ 
						while (have_posts()) : the_post();
		
						the_content();
		    		    
		    		    endwhile; 
		    		}
		    	?>
    		</div>
    
    </div>
    <!-- End main content -->
   
</div> 

<?php get_footer(); ?>