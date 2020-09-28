<?php 
header("content-type: application/x-javascript"); 
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
?>

jQuery(document).ready(function() {
	jQuery('#<?php echo $_GET['video_id']; ?>').mediaelementplayer({
	    <?php if(!isset($_GET['width'])) { ?>
	    videoWidth: jQuery(window).width(),
	    <?php } else { ?>
	    videoWidth: <?php echo $_GET['width']; ?>,
	    <?php } ?>
	    videoHeight: <?php echo $_GET['height']; ?>,
	    enableAutosize: true,
	    pauseOtherPlayers: false,
	    startVolume: 3,
	    pauseOtherPlayers: false
	});
});