<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

get_header(); 

?>

<br class="clear"/>

<?php
$current_page_id = $post->ID;
$image_id = get_post_thumbnail_id($current_page_id); 
$image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
$pp_page_bg = $image_thumb[0];

wp_enqueue_script("script-static-bg", get_stylesheet_directory_uri()."/templates/script-static-bg.php?bg_url=".$pp_page_bg, false, THEMEVERSION, true);
?>
<div class="page_control_static">
    <a id="page_maximize" href="#"></a>
</div>

<div id="page_content_wrapper" class="two">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

	    	<div class="sidebar_content full_width">
					
				<?php
				if (have_posts()) : while (have_posts()) : the_post();
				
					$small_image_url = wp_get_attachment_image_src(get_the_ID(), 'blog_f', true);
				?>
										
				<!-- Begin each blog post -->
				<div class="post_wrapper">
				
					<?php
				    	if(isset($small_image_url[0]) && !empty($small_image_url[0]))
				    	{
				    		$pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');
				    		
				    		//Get image meta data
				    		$image_title = get_the_title(get_the_ID());
				    		$image_content = get_post_field('post_content', get_the_ID());
				    ?>
				
				    <div style="position:relative">
				    	<img src="<?php echo $small_image_url[0]; ?>" alt="" class=""/>
				    	<?php if(!empty($pp_portfolio_enable_slideshow_title)) { ?>
						    <div class="gallery_a_title">
						        <h5><?php echo $image_title; ?></h5>
						        <span><?php echo $image_content; ?></span>
						    </div>
						<?php } ?>
				    </div>
				    
				    <?php
				    	}
				    ?>
				    
				</div>
				<!-- End each blog post -->
				
				<div class="fullwidth_comment_wrapper">
					<?php comments_template( '' ); ?>
				</div>
				
				<?php wp_link_pages(); ?>
				
				<?php endwhile; endif; ?>
				<br class="clear"/><br/>
			</div>
						
    	</div>
    
    </div>
    <!-- End main content -->
   
</div> 

<?php get_footer(); ?>