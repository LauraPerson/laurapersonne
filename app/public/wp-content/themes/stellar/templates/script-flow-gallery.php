<?php header("content-type: application/x-javascript");?>
<?php
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
?>
var calScreenWidth = jQuery(window).width();
var imgFlowSize = 0.6;
if(calScreenWidth > 480)
{
imgFlowSize = 0.4;
}
else
{
imgFlowSize = 0.2;
}
<?php
if(isset($_GET['gallery_id']))
{
?>
imf.create("imageFlow", '<?php echo get_template_directory_uri(); ?>/image-flow.php?gallery_id=<?php echo $_GET['gallery_id']; ?>', 0.9, imgFlowSize, 0, 10, 1, 4);
<?php
}
else
{
?>
imf.create("imageFlow", '<?php echo get_template_directory_uri(); ?>/image-flow.php', 0.9, imgFlowSize, 0, 10, 1, 4);
<?php
}
?>