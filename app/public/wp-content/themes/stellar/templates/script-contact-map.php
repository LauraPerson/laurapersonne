<?php header("content-type: application/x-javascript");
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
?>
<?php
if(isset($_GET['id']) && !empty($_GET['id']))
{
    $pp_contact_lat = get_option('pp_contact_lat');
    $pp_contact_long = get_option('pp_contact_long');
    $pp_contact_map_zoom = get_option('pp_contact_map_zoom');
    
    $pp_contact_info_box = get_option('pp_contact_info_box');
    $has_pp_contact_info_box = 'false';
    
    if(!empty($pp_contact_info_box))
    {
        $has_pp_contact_info_box = 'true';
    }
?>
jQuery(document).ready(function() {
	jQuery("#<?php echo $_GET['id']; ?>").gMap({ zoom: <?php echo $pp_contact_map_zoom; ?>, markers: [ { latitude: '<?php echo $pp_contact_lat; ?>', longitude: '<?php echo $pp_contact_long; ?>',popup: <?php echo $has_pp_contact_info_box; ?>, html: '<h4><?php echo $pp_contact_info_box; ?></h4>' } ], mapTypeControl: true, zoomControl: true, scrollwheel: false });
});
<?php
}
?>