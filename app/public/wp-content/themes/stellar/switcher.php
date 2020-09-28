<?php
session_start();
$pp_url = 'http://localhost';
//$pp_url = 'http://themes.themegoods.com/keres_wp/';

if(isset($_GET['pp_skin']))
{
	$_SESSION['pp_skin'] = $_GET['pp_skin'];
}

if(isset($_GET['reset']))
{
	session_destroy();
}

header( 'Location: '.$pp_url ) ;
?>