<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 */
?>
	
<?php
	/**
    *	Setup Google Analyric Code
    **/
    include (get_template_directory() . "/google-analytic.php");
?>

</div>

</div>

<?php
	$totop_class = '';
	if(!is_null($post) && has_post_thumbnail($post->ID, 'original'))
	{
		$totop_class = 'withbg';
	}
?>
<div id="toTop" class="<?php echo $totop_class; ?>">
	<i class="fa  fa-arrow-up"></i>
</div>

<?php
	/**
    *	Setup code before </body>
    **/
	$pp_before_body_code = get_option('pp_before_body_code');
	
	if(!empty($pp_before_body_code))
	{
		echo stripslashes($pp_before_body_code);
	}
?>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
