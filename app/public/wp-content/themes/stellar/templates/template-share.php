<?php
	global $blog_list_template;

	$post_type = get_post_type();
	
	global $page_gallery_id;
	if(!empty($page_gallery_id))
	{
		$post_type = 'galleries';
	}
	
	global $share_page_url;
	if(empty($share_page_url))
	{
		$share_page_url = get_permalink();
	}
	
	$show_share = FALSE;
	
	$pp_sharing = get_option('pp_sharing');
	if(!empty($pp_sharing))
	{
	    $show_share = TRUE;
	}
    
    if($show_share && !is_null($post))
    {
    	$pin_thumb = wp_get_attachment_image_src($post->ID, 'gallery_4', true);
    	if(!isset($pin_thumb[0]))
    	{
	    	$pin_thumb[0] = '';
    	}
?>
<div <?php if(is_bool($blog_list_template) && $blog_list_template) { ?>class="social_share_wrapper"<?php } else { ?>id="social_share_wrapper"<?php } ?>>
	<ul>
		<li><a title="<?php _e( 'Share On Facebook', THEMEDOMAIN ); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($share_page_url); ?>"><i class="fa fa-facebook marginright"></i></a></li>
		<li><a title="<?php _e( 'Share On Twitter', THEMEDOMAIN ); ?>" target="_blank" href="https://twitter.com/intent/tweet?original_referer=<?php echo $share_page_url; ?>&amp;url=<?php echo $share_page_url; ?>"><i class="fa fa-twitter marginright"></i></a></li>
		<li><a title="<?php _e( 'Share On Pinterest', THEMEDOMAIN ); ?>" target="_blank" href="http://www.pinterest.com/pin/create/button/?url=<?php echo urlencode($share_page_url); ?>&amp;media=<?php echo urlencode($pin_thumb[0]); ?>"><i class="fa fa-pinterest marginright"></i></a></li>
		<li><a title="<?php _e( 'Share On Google+', THEMEDOMAIN ); ?>" target="_blank" href="https://plus.google.com/share?url=<?php echo $share_page_url; ?>"><i class="fa fa-google-plus marginright"></i></a></li>
	</ul>
</div>
<?php
    }
?>