<?php
$page = get_page($post->ID);
?>

<!-- Begin cover image -->
<?php
if(!is_page())
{
	$gallery_cover = get_post_meta($page->ID, 'gallery_cover', true);
}
else
{
	$page_gallery_id = get_post_meta($page->ID, 'page_gallery_id', true);
	$gallery_cover = get_post_meta($page_gallery_id, 'gallery_cover', true);
}

if(!empty($gallery_cover))
{
?>
<div class="grid_cover_wrapper">
	<div class="mask">
		<div class="frame">
			<div class="gallery_content">
				<h1>
					<?php 
						if(!is_page() && !is_front_page())
						{
							the_title(); 
						}
						else
						{
							echo get_the_title($page_gallery_id);
						}
					?>
				</h1>
				<div class="gallery_desc">
					<?php 
						if(!is_page() && !is_front_page())
						{
							echo pp_get_the_excerpt($page->ID);
						}
						else
						{
							echo pp_get_the_excerpt($page_gallery_id);
						}
					?>
				</div>
				<br class="clear"/>
				<a href="#" class="view_gallery_full"><?php _e( 'enter', THEMEDOMAIN ); ?></a>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
<!-- End cover image -->