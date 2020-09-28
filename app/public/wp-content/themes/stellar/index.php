<?php
/**
 * The main template file for index (latest posts)
 *
 * @package WordPress
*/

get_header(); 
?>
<div id="page_header_bg"></div>

<div id="page_caption">
	<div id="page_caption_wrapper">
		<h1><?php _e( 'The Blog', THEMEDOMAIN ); ?></h1>
		<div class="page_tagline">
			<?php echo get_bloginfo('description'); ?>
		</div>
	</div>
</div>

<!-- Begin content -->
<div id="page_content_wrapper" class="two">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    		
    		<div class="sidebar_content full_width">
					
			<?php
			if (have_posts()) : while (have_posts()) : the_post();
			
				$image_thumb = '';
											
				if(has_post_thumbnail(get_the_ID(), 'blog_f'))
				{
				    $image_id = get_post_thumbnail_id(get_the_ID());
				    $image_thumb = wp_get_attachment_image_src($image_id, 'blog_f', true);
				}
			?>
			
			<!-- Begin each blog post -->
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
				<div class="post_wrapper fullwidth">
				
					<div class="post_header fullwidth">
				    	<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
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
				    </div>
				    <br class="clear"/>
				
					<?php
						//Get post featured content
						$post_ft_type = get_post_meta(get_the_ID(), 'post_ft_type', true);
						
						switch($post_ft_type)
						{
							case 'Image':
							default:
						    	if(!empty($image_thumb))
						    	{
						    		$small_image_url = wp_get_attachment_image_src($image_id, 'blog_f', true);
				    ?>
				    
							    <br class="clear"/>
							    <div class="post_img">
							    	<a href="<?php the_permalink(); ?>">
							    		<img src="<?php echo $small_image_url[0]; ?>" alt="" class=""/>
							    	</a>
							    </div>
							    <br class="clear"/>
				    
				    <?php
				    			}
				    		break;
				    		
				    		case 'Vimeo Video':
				    			$post_ft_vimeo = get_post_meta(get_the_ID(), 'post_ft_vimeo', true);
				    ?>
				    			<br class="clear"/>
								<?php echo do_shortcode('[tg_vimeo video_id="'.$post_ft_vimeo.'" width="880" height="495"]'); ?>
							    <br class="clear"/>
				    <?php
				    		break;
				    		
				    		case 'Youtube Video':
				    			$post_ft_youtube = get_post_meta(get_the_ID(), 'post_ft_youtube', true);
				    ?>
				    			<br class="clear"/>
								<?php echo do_shortcode('[tg_youtube video_id="'.$post_ft_youtube.'" width="880" height="495"]'); ?>
							    <br class="clear"/>
				    <?php
				    		break;
				    		
				    		case 'Gallery':
				    			$post_ft_gallery = get_post_meta(get_the_ID(), 'post_ft_gallery', true);
				    ?>
				    			<br class="clear"/>
								<?php echo do_shortcode('[tg_gallery_slider gallery_id="'.$post_ft_gallery.'" width="880" height="495"]'); ?>
				    <?php
				    		break;
				    		
				    	} //End switch
				    ?>
				    
				    <?php
				    	$pp_blog_display_full = get_option('pp_blog_display_full');
				    	
				    	if(!empty($pp_blog_display_full))
				    	{
				    		the_content();
				    	}
				    	else
				    	{
				    ?>
				    		<p><?php echo pp_substr(strip_shortcodes(get_the_excerpt()), 250); ?></p>
							<br/>
				    		<a class="continue_reading" href="<?php the_permalink(); ?>"><?php echo _e( 'Continue Reading', THEMEDOMAIN ); ?>&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></a>
				    
				    <?php
				    	}
				    ?>
				    
				    <?php
				    	global $blog_list_template;
				    	$blog_list_template = TRUE;
				    	
				    	global $share_page_url;
				    	$share_page_url = get_permalink();
				    
						//Get Social Share
						get_template_part("/templates/template-share");
					?>
					<br class="clear"/>
				    
				</div>
			
			</div>
			<!-- End each blog post -->
			
			<?php endwhile; endif; ?>

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

<?php get_footer(); ?>