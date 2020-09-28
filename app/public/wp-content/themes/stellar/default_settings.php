<?php
	$current_ggfont = get_option(SHORTNAME."_ggfont");
	//var_dump($current_ggfont); die;
	
	if(!isset($current_ggfont['Montserrat']))
	{
	    $current_ggfont['Montserrat'] = 'Montserrat';
	}
	
	if(!isset($current_ggfont['Alex Brush']))
	{
	    $current_ggfont['Alex Brush'] = 'Alex Brush';
	}
		
	if(!empty($current_ggfont))
	{
		update_option( SHORTNAME."_ggfont", $current_ggfont );
	}
	else
	{
		add_option( SHORTNAME."_ggfont", $current_ggfont );
	}
?>