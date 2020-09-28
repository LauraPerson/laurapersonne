<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

/**
*	Get Current page object
**/
$page = get_page($post->ID);

/**
*	Get current page id
**/

if(!isset($current_page_id) && isset($page->ID))
{
    $current_page_id = $page->ID;
}

get_header(); 

?>

<?php
//Check if post has featured image
$post_ft_bg = get_post_meta($current_page_id, 'post_ft_bg', true);
$pp_page_bg = '';

if(!empty($post_ft_bg) && has_post_thumbnail($current_page_id, 'original'))
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
	</div>
</div>

<div id="page_content_wrapper" class="two">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

    		<div class="sidebar_content">
					
			<?php
			if (have_posts()) : while (have_posts()) : the_post();
			
				$image_thumb = '';
											
				if(has_post_thumbnail(get_the_ID(), 'large'))
				{
				    $image_id = get_post_thumbnail_id(get_the_ID());
				    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
				}
			?>
									
			<!-- Begin each blog post -->
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
				<div class="post_wrapper">
				
					<?php
					//Check if display featured content
					$pp_blog_display_ft = get_option('pp_blog_display_ft');
					$post_ft_type = '';
					
					if(!empty($pp_blog_display_ft))
					{
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
								<?php echo do_shortcode('[tg_vimeo video_id="'.$post_ft_vimeo.'" width="880" height="495"]'); ?>
								<br class="clear"/>
				    <?php
				    		break;
				    		
				    		case 'Youtube Video':
				    			$post_ft_youtube = get_post_meta(get_the_ID(), 'post_ft_youtube', true);
				    ?>
								<?php echo do_shortcode('[tg_youtube video_id="'.$post_ft_youtube.'" width="880" height="495"]'); ?>
								<br class="clear"/>
				    <?php
				    		break;
				    		
				    		case 'Gallery':
				    			$post_ft_gallery = get_post_meta(get_the_ID(), 'post_ft_gallery', true);
				    ?>
								<?php echo do_shortcode('[tg_gallery_slider gallery_id="'.$post_ft_gallery.'" width="880" height="495"]'); ?>
				    <?php
				    		break;
				    		
				    	} //End switch
				    }
				    ?>
				    
				    <?php
				    	the_content();
				    	wp_link_pages();
				    ?>
				    
				    <br/><br/>
				    <?php
					    if(has_tag())
					    {
					?>
					    <div class="post_excerpt post_tag" style="text-align:left">
					    	<i class="fa fa-tags"></i>
					    	<?php the_tags('', ', ', '<br />'); ?>
					    </div>
					<?php
					    }
					?>
					
					<?php
						//Get Social Share
						get_template_part("/templates/template-share");
					?>
					
					<?php
						$pp_blog_next_prev = get_option('pp_blog_next_prev');
						
						if($pp_blog_next_prev)
						{
						
						    //Get Previous and Next Post
						    $prev_post = get_previous_post();
						    $next_post = get_next_post();
						
						    //If has previous or next post then add line break
						    if(!empty($prev_post) OR !empty($next_post))
						    {
						    	echo '<br/><br/><br/><hr/>';
						    }
						?>
						    
						<?php
						   //Get Previous Post
						   if (!empty($prev_post)): 
						?>
							<a href="<?php echo get_permalink( $prev_post->ID ); ?>">
						     	<div class="post_previous">
						     		<div class="post_previous_content">
						     			<h6><?php echo _e( 'Previous Post', THEMEDOMAIN ); ?></h6>
						     			<h5 class="title"><?php echo $prev_post->post_title; ?></h5>
						     		</div>
						     	</div>
							</a>
						<?php endif; ?>
						
						<?php
						   //Get Next Post
						   if (!empty($next_post)): 
						?>
							<a href="<?php echo get_permalink( $next_post->ID ); ?>">
						     	<div class="post_next">
						     		<div class="post_next_content">
						     			<h6><?php echo _e( 'Next Post', THEMEDOMAIN ); ?></h6>
						     			<h5 class="title"><?php echo $next_post->post_title; ?></h5>
						     		</div>
						     	</div>
							</a>
						<?php endif; ?>
						
						<?php
						    //If has previous or next post then add line break
						    if(!empty($prev_post) OR !empty($next_post))
						    {
						    	echo '<br class="clear"/><br/>';
						    }
						
						}
						?>
    
			</div>
			<!-- End each blog post -->
			
			<?php comments_template( '' ); ?>
			
			<?php endwhile; endif; ?>
									
			</div>
			
			</div>

    		<div class="sidebar_wrapper <?php if(!empty($post_ft_bg) && has_post_thumbnail($current_page_id, 'original')) { ?>hasbg<?php } ?>">
    		
    			<div class="sidebar_top"></div>
    		
    			<div class="sidebar">
    			
    				<div class="content">
    			
    					<ul class="sidebar_widget">
    					<?php dynamic_sidebar('Single Post Sidebar'); ?>
    					</ul>
    				
    				</div>
    		
    			</div>
    			<br class="clear"/>
    	
    			<div class="sidebar_bottom"></div>
    		</div>
    
    </div>
    <!-- End main content -->
   <br class="clear"/>
</div> 

<?php get_footer(); ?>