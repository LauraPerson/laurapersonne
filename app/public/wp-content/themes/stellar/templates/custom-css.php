<?php header("Content-Type: text/css");
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
?>
<?php
	$pp_advance_combine_css = get_option('pp_advance_combine_css');

	if(!empty($pp_advance_combine_css))
	{
		//Function for compressing the CSS as tightly as possible
		function compress($buffer) {
		    //Remove CSS comments
		    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
		    //Remove tabs, spaces, newlines, etc.
		    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
		    return $buffer;
		}
	
		//This GZIPs the CSS for transmission to the user
		//making file size smaller and transfer rate quicker
		ob_start("ob_gzhandler");
		ob_start("compress");
	}

	//Hack animation CSS for Safari
	$current_browser = getBrowser();
	
	//If enable animation
	$pp_animation = get_option('pp_animation');
	if(!empty($pp_animation))
	{
?>
.fadeIn, .mansory_img, #photo_wall_wrapper .wall_entry .wall_thumbnail, #ajax_portfolio_content, #menu_close_icon, #blog_grid_wrapper .post.type-post, #page_content_wrapper .inner .sidebar_content:not(.full_width), #page_content_wrapper .inner .sidebar_wrapper { opacity: 1 !important; visibility: visible !important; }
<?php
	}
	//If IE later than IE 10
	if(isset($current_browser['name']) && $current_browser['name'] == 'Internet Explorer' && intval($current_browser['version']) < 10)
	{
?>
.fadeIn, .mansory_img, #photo_wall_wrapper .wall_entry .wall_thumbnail, #ajax_portfolio_content, #menu_close_icon, #blog_grid_wrapper .post.type-post, #page_content_wrapper .inner .sidebar_content:not(.full_width), #page_content_wrapper .inner .sidebar_wrapper { opacity: 1 !important; visibility: visible !important; }
#menu_close_icon, #menu_close_icon:after { position: fixed; z-index: 99999; }
#page_content_wrapper { z-index: 9; position: relative; }
.backstretch { opacity: 1; background: #000; }
.isotope-item { z-index: 2 !important; }
.isotope-hidden.isotope-item { pointer-events: none; display: none; z-index: 1 !important; }
body.loading #page_content_wrapper, body.loading .page_content_wrapper, #page_content_wrapper.slideDown, .page_content_wrapper.slideDown, body.loading #photo_wall_wrapper, body.loading .grid_cover_wrapper .mask, body.loading #supersized, body.loading #kenburns, body.loading #imageFlow, body.loading #ajax_portfolio_wrapper, body.loading .vertical_center_wrapper, body.loading #page_caption, body.loading .backstretch
{
	opacity: 0; visibility: hidden;
}
.top_bar
{
	left: -250px;
}
body.js_nav .top_bar
{
	left: 0;
}
<?php
	}
?>

<?php
	//If IE later than IE 11
	if(isset($current_browser['name']) && $current_browser['name'] == 'Internet Explorer' && intval($current_browser['version']) < 11)
	{
?>
.wall_thumbnail .mask .mask_frame .mask_image_content.hascycle
{
	position: absolute;
}
.wall_thumbnail .mask .mask_frame .mask_image_content, .wall_thumbnail .mask .mask_frame .mask_image_content .mask_image_content_frame
{
	display: block !important;
}

.wall_thumbnail .mask .mask_frame .mask_image_content .mask_image_content_frame
{
	margin-top: 40%;
}
.page_control_static
{
	display: none;
}
<?php
	}
?>

<?php
	//If IE later than IE 10
	if(isset($current_browser['name']) && $current_browser['name'] == 'Internet Explorer' && intval($current_browser['version']) < 10)
	{
?>
.wall_thumbnail .mask .mask_frame .mask_image_content .mask_image_content_frame
{
	opacity: 1;
	visibility: visible;
}
<?php
	}
?>

<?php
if(isset($current_browser['name']) && $current_browser['name'] == 'Internet Explorer')
{
?>
#page_caption, #page_header_bg, #kenburns, #supersized li, .grid_cover_wrapper, #full_video_bg
{
	transition: all 500ms ease;
}
body.js_nav #page_caption, body.js_nav #page_header_bg, body.js_nav #kenburns, body.js_nav #supersized li, body.js_nav .grid_cover_wrapper, body.js_nav #full_video_bg
{
	-ms-transform: translate(250px, 0px);
}
<?php
}
?>

<?php
if(empty($pp_animation))
{
	for($i=1;$i<=50;$i++)
	{
?>
.animated<?php echo $i; ?>
{
	-webkit-animation-delay: <?php echo $i/10; ?>s;
	-moz-animation-delay: <?php echo $i/10; ?>s;
	animation-delay: <?php echo $i/10; ?>s;
}
<?php
	}
}
?>

<?php
$pp_logo_margin_bottom = get_option('pp_logo_margin_bottom');

if(!empty($pp_logo_margin_bottom))
{
?>
.logo_wrapper { margin-bottom: <?php echo $pp_logo_margin_bottom; ?>px; }		
<?php
}
?>

<?php
$pp_menu_margin_top = get_option('pp_menu_margin_top');

if(!empty($pp_menu_margin_top))
{
?>
#menu_wrapper .nav ul, #menu_wrapper div .nav { margin-top: <?php echo $pp_menu_margin_top; ?>px; }		
<?php
}
?>

<?php
$pp_menu_font = get_option('pp_menu_font');

if(!empty($pp_menu_font))
{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { font-family: '<?php echo urldecode($pp_menu_font); ?>' !important; }		
<?php
}
?>

<?php
$pp_menu_font_size = get_option('pp_menu_font_size');

if(!empty($pp_menu_font_size))
{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { font-size: <?php echo $pp_menu_font_size; ?>px; }		
<?php
}
?>

<?php
$pp_submenu_font_size = get_option('pp_submenu_font_size');

if(!empty($pp_submenu_font_size))
{
?>
#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a { font-size: <?php echo $pp_submenu_font_size; ?>px; }		
<?php
}
?>

<?php
	$pp_menu_upper = get_option('pp_menu_upper');

	if(empty($pp_menu_upper))
	{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { text-transform: none; }		
<?php
	}

	$pp_submenu_upper = get_option('pp_submenu_upper');

	if(empty($pp_submenu_upper))
	{
?>
#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a { text-transform: none; }		
<?php
	}
?>

<?php
	$pp_menu_close_bg_color = get_option('pp_menu_close_bg_color');
	
	if(!empty($pp_menu_close_bg_color))
	{
		$ori_pp_menu_close_bg_color = $pp_menu_close_bg_color;
		$pp_menu_close_bg_color = HexToRGB($pp_menu_close_bg_color);
		
		$pp_menu_close_bg_opacity = get_option('pp_menu_close_bg_opacity');
		$pp_menu_close_bg_opacity = $pp_menu_close_bg_opacity/100;
?>
#menu_close_icon
{
	background: <?php echo $ori_pp_menu_close_bg_color; ?>;
	background: rgb(<?php echo $pp_menu_close_bg_color['r']; ?>, <?php echo $pp_menu_close_bg_color['g']; ?>, <?php echo $pp_menu_close_bg_color['b']; ?>, <?php echo $pp_menu_close_bg_opacity; ?>);
	background: rgba(<?php echo $pp_menu_close_bg_color['r']; ?>, <?php echo $pp_menu_close_bg_color['g']; ?>, <?php echo $pp_menu_close_bg_color['b']; ?>, <?php echo $pp_menu_close_bg_opacity; ?>);
}
<?php
}
?>

<?php
$pp_menu_close_font_color = get_option('pp_menu_close_font_color');

if(!empty($pp_menu_close_font_color))
{
?>
#menu_toggle, #menu_toggle:after, #menu_toggle:before { background: <?php echo $pp_menu_close_font_color; ?>; }
#menu_close_icon { color: <?php echo $pp_menu_close_font_color; ?>; }
<?php
}
?>

<?php
$pp_menu_close_hover_bg_color = get_option('pp_menu_close_hover_bg_color');

if(!empty($pp_menu_close_hover_bg_color))
{
?>
#menu_close_icon:hover, body[data-style=fullscreen] #menu_close_icon:hover, body[data-style=flow] #menu_close_icon:hover, body[data-style=password] #menu_close_icon:hover, body[data-style=wall] #menu_close_icon:hover, body[data-style=horizontal] #menu_close_icon:hover { background: <?php echo $pp_menu_close_hover_bg_color; ?>; }
#menu_close_icon:hover { color: <?php echo $pp_menu_close_hover_bg_color; ?>; }
<?php
}
?>

<?php
$pp_menu_close_hover_font_color = get_option('pp_menu_close_hover_font_color');

if(!empty($pp_menu_close_hover_font_color))
{
?>
#menu_close_icon:hover #menu_toggle, #menu_close_icon:hover #menu_toggle:before, #menu_close_icon:hover #menu_toggle:after { background: <?php echo $pp_menu_close_hover_font_color; ?> !important; }
body.js_nav #menu_close_icon:hover #menu_toggle
{
	background: transparent !important;
}
<?php
}
?>

<?php
$pp_menu_font_color = get_option('pp_menu_font_color');

if(!empty($pp_menu_font_color))
{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { color: <?php echo $pp_menu_font_color; ?>; }
@media only screen and (max-width: 767px) {
	#menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-item ul li a, #menu_wrapper div .nav li ul li.current-menu-item a, #menu_wrapper .nav ul li ul li a, #menu_wrapper .nav ul li.current-menu-item ul li a, #menu_wrapper .nav ul li ul li.current-menu-item a, #menu_wrapper div .nav li.current-menu-parent ul li a, #menu_wrapper div .nav li ul li.current-menu-parent a { color: <?php echo $pp_menu_font_color; ?> !important; }
}
body.js_nav #menu_close_icon:hover #menu_toggle:before, body.js_nav #menu_close_icon:hover #menu_toggle:after 
{
	background: <?php echo $pp_menu_font_color; ?> !important;
}
<?php
}
?>

<?php
$pp_menu_hover_font_color = get_option('pp_menu_hover_font_color');

if(!empty($pp_menu_hover_font_color))
{
?>
#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li a.hover, #menu_wrapper div .nav li a:hover { color: <?php echo $pp_menu_hover_font_color; ?>; }		
<?php
}
?>

<?php
$pp_menu_active_font_color = get_option('pp_menu_active_font_color');

if(!empty($pp_menu_active_font_color))
{
?>
#menu_wrapper div .nav li.current-menu-item > a, #menu_wrapper div .nav li.current-menu-parent > a, #menu_wrapper div .nav li.current-menu-ancestor > a, #menu_wrapper div .nav li ul li.current-menu-ancestor a, #menu_close_icon:after { color: <?php echo $pp_menu_active_font_color; ?> !important; }		
<?php
}
?>

<?php
$pp_menu_bg_color = get_option('pp_menu_bg_color');

if(!empty($pp_menu_bg_color))
{
?>
.top_bar { background: <?php echo $pp_menu_bg_color; ?>; }
#menu_close_icon:after { border-color: transparent transparent transparent <?php echo $pp_menu_bg_color; ?>; }	
body.js_nav #menu_close_icon:hover #menu_title { color: <?php echo $pp_menu_bg_color; ?>; }
@media only screen and (max-width: 767px) {
	#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul { background: <?php echo $pp_menu_bg_color; ?> !important; }
}
<?php
}
?>

<?php
$pp_submenu_font_color = get_option('pp_submenu_font_color');

if(!empty($pp_submenu_font_color))
{
?>
#menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-item ul li a, #menu_wrapper div .nav li ul li.current-menu-item a, #menu_wrapper .nav ul li ul li a, #menu_wrapper .nav ul li.current-menu-item ul li a, #menu_wrapper .nav ul li ul li.current-menu-item a, #menu_wrapper div .nav li.current-menu-parent ul li a, #menu_wrapper div .nav li ul li.current-menu-parent a { color: <?php echo $pp_submenu_font_color; ?>; }		
<?php
}
?>

<?php
$pp_submenu_hover_font_color = get_option('pp_submenu_hover_font_color');

if(!empty($pp_submenu_hover_font_color))
{
?>
#menu_wrapper .nav ul li ul li a:hover, #menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-item ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover { color: <?php echo $pp_submenu_hover_font_color; ?>; }		
<?php
}
?>

<?php
$pp_social_icon_color = get_option('pp_social_icon_color');

if(!empty($pp_social_icon_color))
{
?>
.social_wrapper ul li i { color: <?php echo $pp_social_icon_color; ?>; }
<?php
}
?>

<?php
$pp_social_icon_bg_color = get_option('pp_social_icon_bg_color');

if(!empty($pp_social_icon_bg_color))
{
?>
.social_wrapper ul li i { background: <?php echo $pp_social_icon_bg_color; ?>; }
<?php
}
?>

<?php
$pp_social_icon_size = get_option('pp_social_icon_size');

if(!empty($pp_social_icon_size))
{
?>
.social_wrapper ul li i { font-size: <?php echo $pp_social_icon_size; ?>px; width: <?php echo 24+($pp_social_icon_size)-12; ?>px; height: <?php echo 24+($pp_social_icon_size)-12; ?>px; }
<?php
}
?>

<?php
$pp_footer_font = get_option('pp_footer_font');

if(!empty($pp_footer_font))
{
?>
#copyright { font-family: '<?php echo urldecode($pp_footer_font); ?>' !important; }		
<?php
}
?>

<?php
$pp_footer_font_size = get_option('pp_footer_font_size');

if(!empty($pp_footer_font_size))
{
?>
#copyright { font-size: <?php echo $pp_footer_font_size; ?>px; }		
<?php
}
?>

<?php
	$pp_footer_font_italic = get_option('pp_footer_font_italic');

	if(empty($pp_footer_font_italic))
	{
?>
#copyright { font-style: normal; }		
<?php
	}
?>

<?php
$pp_footer_font_color = get_option('pp_footer_font_color');

if(!empty($pp_footer_font_color))
{
?>
#copyright { color: <?php echo $pp_footer_font_color; ?>; }
<?php
}
?>

<?php
$pp_footer_link_color = get_option('pp_footer_link_color');

if(!empty($pp_footer_link_color))
{
?>
#copyright a, #copyright a:active { color: <?php echo $pp_footer_link_color; ?>; }
<?php
}
?>

<?php
$pp_footer_hover_link_color = get_option('pp_footer_hover_link_color');

if(!empty($pp_footer_hover_link_color))
{
?>
#copyright a:hover { color: <?php echo $pp_footer_hover_link_color; ?>; }
<?php
}
?>

<?php
	$pp_sidebar_font_color = get_option('pp_sidebar_font_color');
	
	if(!empty($pp_sidebar_font_color))
	{
?>
#page_content_wrapper .inner .sidebar_wrapper .sidebar .content { color:<?php echo $pp_sidebar_font_color; ?>; }
<?php
	}
?>

<?php
	$pp_sidebar_link_color = get_option('pp_sidebar_link_color');
	
	if(!empty($pp_sidebar_link_color))
	{
?>
#page_content_wrapper .inner .sidebar_wrapper a, #post_more_close i.fa { color:<?php echo $pp_sidebar_link_color; ?>; }
<?php
	}
?>

<?php
	$pp_sidebar_hover_link_color = get_option('pp_sidebar_hover_link_color');
	
	if(!empty($pp_sidebar_hover_link_color))
	{
?>
#page_content_wrapper .inner .sidebar_wrapper a:hover, #page_content_wrapper .inner .sidebar_wrapper a:active { color:<?php echo $pp_sidebar_hover_link_color; ?>; }
<?php
	}
?>

<?php
	$pp_sidebar_title_color = get_option('pp_sidebar_title_color');
	
	if(!empty($pp_sidebar_title_color))
	{
?>
#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle { color:<?php echo $pp_sidebar_title_color; ?>; }
<?php
	}
?>

<?php
	$pp_sidebar_title_font_size = get_option('pp_sidebar_title_font_size');
	
	if(!empty($pp_sidebar_title_font_size))
	{
?>
#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle { font-size:<?php echo $pp_sidebar_title_font_size; ?>px; }
<?php
	}
?>

<?php
	$pp_sidebar_title_upper = get_option('pp_sidebar_title_upper');

	if(!empty($pp_sidebar_title_upper))
	{
?>
#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle { text-transform: uppercase; }		
<?php
	}
?>

<?php
	$pp_sidebar_title_font = get_option('pp_sidebar_title_font');
	
	if(!empty($pp_sidebar_title_font))
	{
?>
#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle { font-family: '<?php echo urldecode($pp_sidebar_title_font); ?>'; }		
<?php
	}
?>

<?php
	$pp_header_font = get_option('pp_header_font');
	
	if(!empty($pp_header_font))
	{
?>
	h1, h2, h3, h4, h5, h6, h7, #page_caption h1 { font-family: '<?php echo urldecode($pp_header_font); ?>'; }		
<?php
	}
?>

<?php
	$pp_h1_weight = get_option('pp_h1_weight');
	
	if(!empty($pp_h1_weight))
	{
?>
	h1, h2, h3, h4, h5, h6, h7 { font-weight: <?php echo $pp_h1_weight; ?>; }		
<?php
	}
?>

<?php
	$pp_h1_size = get_option('pp_h1_size');
	
	if(!empty($pp_h1_size))
	{
?>
h1 { font-size:<?php echo $pp_h1_size; ?>px; }
<?php
	}
?>

<?php
	$pp_h2_size = get_option('pp_h2_size');
	
	if(!empty($pp_h2_size))
	{
?>
h2 { font-size:<?php echo $pp_h2_size; ?>px; }
<?php
	}
?>

<?php
	$pp_h3_size = get_option('pp_h3_size');
	
	if(!empty($pp_h3_size))
	{
?>
h3 { font-size:<?php echo $pp_h3_size; ?>px; }
<?php
	}
?>

<?php
	$pp_h4_size = get_option('pp_h4_size');
	
	if(!empty($pp_h4_size))
	{
?>
h4 { font-size:<?php echo $pp_h4_size; ?>px; }
<?php
	}
?>

<?php
	$pp_h5_size = get_option('pp_h5_size');
	
	if(!empty($pp_h5_size))
	{
?>
h5 { font-size:<?php echo $pp_h5_size; ?>px; }
<?php
	}
?>

<?php
	$pp_h6_size = get_option('pp_h6_size');
	
	if(!empty($pp_h6_size))
	{
?>
h6 { font-size:<?php echo $pp_h6_size; ?>px; }
<?php
	}
?>

<?php
	$pp_body_font = get_option('pp_body_font');
	
	if(!empty($pp_body_font))
	{
?>
	body, .fancybox-title-outside-wrap { font-family: '<?php echo urldecode($pp_body_font); ?>'; }		
<?php
	}
?>

<?php
	$pp_body_font_size = get_option('pp_body_font_size');
	
	if(!empty($pp_body_font_size))
	{
?>
body { font-size:<?php echo $pp_body_font_size; ?>px; }
<?php
	}
?>

<?php
	$pp_page_title_font_size = get_option('pp_page_title_font_size');
	
	if(!empty($pp_page_title_font_size))
	{
?>
#page_caption h1 { font-size:<?php echo $pp_page_title_font_size; ?>px; line-height:<?php echo $pp_page_title_font_size+10; ?>px; 
<?php
		if($pp_page_title_font_size < 24)
		{
?>
			letter-spacing: 0px;
<?php
		}
?>
}
<?php
	}
?>

<?php
	$pp_page_title_upper = get_option('pp_page_title_upper');

	if(!empty($pp_page_title_upper))
	{
?>
#page_caption h1 { text-transform: uppercase; }		
<?php
	}
?>

<?php
    $pp_body_bg_color = get_option('pp_body_bg_color');

    if(!empty($pp_body_bg_color))
    {
?>
body, #page_content_wrapper.gallery
{
    background: <?php echo $pp_body_bg_color; ?> !important;
}
<?php
    }
?>

<?php
    $pp_content_bg_color = get_option('pp_content_bg_color');

    if(!empty($pp_content_bg_color))
    {
?>
#page_content_wrapper, .page_content_wrapper, #page_content_wrapper .inner .sidebar_content, body[data-style=blog_grid] .post.type-post, body.page-template-galleries-php .gallery.type-gallery, body[data-style=blog_grid] .post.type-post
{
    background: <?php echo $pp_content_bg_color; ?>;
}
<?php
    }
?>

<?php
$pp_page_title_bgoverlay_opacity = get_option('pp_page_title_bgoverlay_opacity');

if(is_numeric($pp_page_title_bgoverlay_opacity))
{
?>
#page_caption { background: rgba(0, 0, 0, <?php echo $pp_page_title_bgoverlay_opacity/100; ?>); }
<?php
}
?>

<?php
$pp_page_title_font_color = get_option('pp_page_title_font_color');

if(!empty($pp_page_title_font_color))
{
?>
#page_caption h1, .page_tagline, .page_tagline .post_detail, .continue_reading { color: <?php echo $pp_page_title_font_color; ?>; }
#page_caption #social_share_wrapper ul li i { color: <?php echo $pp_page_title_font_color; ?>; }
<?php
//Calculate background color for horizontal page title line
$pp_social_border_color = HexToRGB($pp_page_title_font_color);
?>
#page_caption #social_share_wrapper
{
	border-color: rgb(<?php echo $pp_social_border_color['r']; ?>, <?php echo $pp_social_border_color['g']; ?>, <?php echo $pp_social_border_color['b']; ?>, 0.2);
	border-color: rgba(<?php echo $pp_social_border_color['r']; ?>, <?php echo $pp_social_border_color['g']; ?>, <?php echo $pp_social_border_color['b']; ?>, 0.2);
}
<?php
}
?>

<?php
$pp_font_color = get_option('pp_font_color');

if(!empty($pp_font_color))
{
?>
body, .pagination a { color: <?php echo $pp_font_color; ?>; }
<?php
}
?>

<?php
	$pp_link_color = get_option('pp_link_color');
	
	if(!empty($pp_link_color))
	{
?>
a, .post_date { color:<?php echo $pp_link_color; ?>; }
<?php
	}
?>

<?php
	$pp_hover_link_color = get_option('pp_hover_link_color');
	
	if(!empty($pp_hover_link_color))
	{
?>
a:hover, a:active { color:<?php echo $pp_hover_link_color; ?>; }
<?php
	}
?>

<?php
$pp_h1_font_color = get_option('pp_h1_font_color');
if(!empty($pp_h1_font_color))
{
?>
h1, h2, h3, h4, h5, pre, code, tt, blockquote, .post_header h5 a, .post_header h3 a, .post_header.grid h6 a, #imageFlow .title h6, .post_header.fullwidth h4 a, .post_header h5 a
{
	color: <?php echo $pp_h1_font_color; ?>;
}
<?php
}
?>

<?php
	$pp_hr_color = get_option('pp_hr_color');

	if(!empty($pp_hr_color))
	{
	
?>
hr, .post_wrapper, h1.product_title
{
	border-color: <?php echo $pp_hr_color; ?>;
}
<?php
	}
?>

<?php
	$pp_input_bg_color = get_option('pp_input_bg_color');

	if(!empty($pp_input_bg_color))
	{
	
?>
input[type=text], input[type=password], input[type=email], input[type=url], textarea
{
	background: <?php echo $pp_input_bg_color; ?>;
}
<?php
	}
?>

<?php
	$pp_input_font_color = get_option('pp_input_font_color');

	if(!empty($pp_input_font_color))
	{
	
?>
input[type=text], input[type=password], input[type=email], input[type=url], textarea
{
	color: <?php echo $pp_input_font_color; ?>;
}
<?php
	}
?>

<?php
	$pp_input_border_color = get_option('pp_input_border_color');

	if(!empty($pp_input_border_color))
	{
	
?>
input[type=text], input[type=password], input[type=email], input[type=url], textarea
{
	border-color: <?php echo $pp_input_border_color; ?>;
}
<?php
	}
?>

<?php
	$pp_input_focus_border_color = get_option('pp_input_focus_border_color');

	if(!empty($pp_input_border_color))
	{
	
?>
input[type=text]:focus, input[type=password]:focus, input[type=email]:focus, input[type=url]:focus, textarea:focus
{
	border-color: <?php echo $pp_input_focus_border_color; ?>;
}
<?php
	}
?>

<?php
	$pp_button_bg_color = get_option('pp_button_bg_color');
	
	if(!empty($pp_button_bg_color))
	{
?>
input[type=submit], input[type=button], a.button, .button, .woocommerce button.button.alt, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button { 
	background: <?php echo $pp_button_bg_color; ?>;
	background-color: <?php echo $pp_button_bg_color; ?>;
}
.pagination span, .pagination a:hover
{
	background: <?php echo $pp_button_bg_color; ?> !important;
	border-color: <?php echo $pp_button_bg_color; ?>;
}
<?php
	}
	
?>

<?php
	$pp_button_font_color = get_option('pp_button_font_color');
	
	if(!empty($pp_button_font_color))
	{
?>
input[type=submit], input[type=button], a.button, .button { 
	color: <?php echo $pp_button_font_color; ?>;
}
.widget_tag_cloud div a:hover, .meta-tags a:hover, #footer .widget_tag_cloud div a:hover, #footer .meta-tags a:hover, .tag_cloud a:hover, .woocommerce-page ul.products li.product a.add_to_cart_button.loading, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button, .woocommerce .widget_shopping_cart .widget_shopping_cart_content a.button, .woocommerce table.cart td.actions .button.alt.checkout-button, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order, .woocommerce table.cart td.actions .button.alt {
	color: <?php echo $pp_button_font_color; ?> !important;
}
<?php
	}
	
?>

<?php
	$pp_button_border_color = get_option('pp_button_border_color');
	
	if(!empty($pp_button_border_color))
	{
?>
input[type=submit], input[type=button], a.button, .button, .woocommerce button.button.alt, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button { 
	border: 1px solid <?php echo $pp_button_border_color; ?>;
}
<?php
	}	
?>

<?php
	$pp_full_image_title = get_option('pp_full_image_title');
	
	if(empty($pp_full_image_title))
	{
?>
#slidecaption { 
	display: none;
}
<?php
	}	
?>

<?php
$pp_portfolio_hover_bg_color = get_option('pp_portfolio_hover_bg_color');

if(!empty($pp_portfolio_hover_bg_color))
{
?>
.mansory_thumbnail .mask, .wall_thumbnail .mask .mask_frame .mask_image_content.hascycle, .post.type-post .mask { background-color: <?php echo $pp_portfolio_hover_bg_color; ?>; }
<?php
}

//Calculate background color for fullscreen content
$ori_pp_portfolio_hover_bg_color = $pp_portfolio_hover_bg_color;
$pp_portfolio_hover_bg_color = HexToRGB($pp_portfolio_hover_bg_color);
$pp_portfolio_hover_opacity_color = get_option('pp_portfolio_hover_opacity_color');
$pp_portfolio_hover_opacity_color = $pp_portfolio_hover_opacity_color/100;
?>
.mansory_thumbnail .mask, .wall_thumbnail .mask .mask_frame .mask_image_content.hascycle, .post.type-post .mask
{
	background: <?php echo $ori_pp_portfolio_hover_bg_color; ?>;
	background: rgb(<?php echo $pp_portfolio_hover_bg_color['r']; ?>, <?php echo $pp_portfolio_hover_bg_color['g']; ?>, <?php echo $pp_portfolio_hover_bg_color['b']; ?>, <?php echo $pp_portfolio_hover_opacity_color; ?>);
	background: rgba(<?php echo $pp_portfolio_hover_bg_color['r']; ?>, <?php echo $pp_portfolio_hover_bg_color['g']; ?>, <?php echo $pp_portfolio_hover_bg_color['b']; ?>, <?php echo $pp_portfolio_hover_opacity_color; ?>);
}

<?php
	$pp_portfolio_hover_font_color = get_option('pp_portfolio_hover_font_color');
	
	if(!empty($pp_portfolio_hover_font_color))
	{
?>
.mansory_thumbnail .mask .mask_frame .mask_image_content h6, .mansory_thumbnail .mask .mask_frame .mask_image_content span, .wall_thumbnail h6, .wall_thumbnail .mask .mask_frame .mask_image_content span, .wall_thumbnail .mask .mask_frame .mask_image_content span:not(:empty) { 
	color: <?php echo $pp_portfolio_hover_font_color; ?>;
}

.wall_thumbnail .mask .mask_frame .mask_image_content span:not(:empty)
{
	border-color: <?php echo $pp_portfolio_hover_font_color; ?>;
}
<?php
	}	
?>

<?php
	$pp_gallery_cover_bg_color = get_option('pp_gallery_cover_bg_color');
	
	if(!empty($pp_gallery_cover_bg_color))
	{
?>
.grid_cover_wrapper .mask { 
	background: <?php echo $pp_gallery_cover_bg_color; ?>;
}
<?php
	}

	$ori_pp_gallery_cover_bg_color = $pp_gallery_cover_bg_color;
	$pp_gallery_cover_bg_color = HexToRGB($pp_gallery_cover_bg_color);
	$pp_gallery_cover_opacity_color = get_option('pp_gallery_cover_opacity_color');
	$pp_gallery_cover_opacity_color = $pp_gallery_cover_opacity_color/100;
?>
.grid_cover_wrapper .mask
{
	background: <?php echo $ori_pp_gallery_cover_bg_color; ?>;
	background: rgb(<?php echo $pp_gallery_cover_bg_color['r']; ?>, <?php echo $pp_gallery_cover_bg_color['g']; ?>, <?php echo $pp_gallery_cover_bg_color['b']; ?>, <?php echo $pp_gallery_cover_opacity_color; ?>);
	background: rgba(<?php echo $pp_gallery_cover_bg_color['r']; ?>, <?php echo $pp_gallery_cover_bg_color['g']; ?>, <?php echo $pp_gallery_cover_bg_color['b']; ?>, <?php echo $pp_gallery_cover_opacity_color; ?>);
}

<?php
	$pp_gallery_cover_title_font = get_option('pp_gallery_cover_title_font');
	
	if(!empty($pp_gallery_cover_title_font))
	{
?>
.grid_cover_wrapper .frame .gallery_content h1 { font-family: '<?php echo urldecode($pp_gallery_cover_title_font); ?>'; }		
<?php
	}
?>

<?php
	$pp_gallery_cover_title_font_size = get_option('pp_gallery_cover_title_font_size');
	
	if(!empty($pp_gallery_cover_title_font_size))
	{
?>
.grid_cover_wrapper .frame .gallery_content h1 { 
	font-size: <?php echo $pp_gallery_cover_title_font_size; ?>px;
	line-height: <?php echo $pp_gallery_cover_title_font_size+10; ?>px;
	<?php
		if($pp_gallery_cover_title_font_size<80)
		{
	?>
		letter-spacing: 0px;
	<?php
		}
	?>
}
<?php
	}	
?>

<?php
	$pp_gallery_cover_title_font_color = get_option('pp_gallery_cover_title_font_color');
	
	if(!empty($pp_gallery_cover_title_font_color))
	{
?>
.grid_cover_wrapper .frame .gallery_content h1 { color: <?php echo $pp_gallery_cover_title_font_color; ?>; }		
<?php
	}
?>

<?php
	$pp_gallery_cover_desc_font_size = get_option('pp_gallery_cover_desc_font_size');
	
	if(!empty($pp_gallery_cover_desc_font_size))
	{
?>
.grid_cover_wrapper .frame .gallery_content .gallery_desc { font-size: <?php echo $pp_gallery_cover_desc_font_size; ?>px; }		
<?php
	}
?>

<?php
	$pp_gallery_cover_desc_upper = get_option('pp_gallery_cover_desc_upper');

	if(empty($pp_gallery_cover_desc_upper))
	{
?>
.grid_cover_wrapper .frame .gallery_content .gallery_desc { text-transform: none; }		
<?php
	}
?>

<?php
	$pp_gallery_cover_desc_letter_space = get_option('pp_gallery_cover_desc_letter_space');
	if(empty($pp_gallery_cover_desc_letter_space))
	{
		$pp_gallery_cover_desc_letter_space = 0;
	}
?>
.grid_cover_wrapper .frame .gallery_content .gallery_desc { letter-spacing: <?php echo $pp_gallery_cover_desc_letter_space; ?>px; }

<?php
	$pp_gallery_cover_button_font_color = get_option('pp_gallery_cover_button_font_color');
	
	if(!empty($pp_gallery_cover_button_font_color))
	{
?>
.view_gallery, .view_gallery_full { color: <?php echo $pp_gallery_cover_button_font_color; ?>; }		
<?php
	}
?>

<?php
	$pp_gallery_cover_button_border_color = get_option('pp_gallery_cover_button_border_color');
	
	if(!empty($pp_gallery_cover_button_border_color))
	{
?>
.view_gallery, .view_gallery_full { border-color: <?php echo $pp_gallery_cover_button_border_color; ?>; }		
<?php
	}
?>

<?php
	$pp_filterable_font_color = get_option('pp_filterable_font_color');
	
	if(!empty($pp_filterable_font_color))
	{
?>
.filter li a, #portfolio_wall_filters li a { color: <?php echo $pp_filterable_font_color; ?>; }		
<?php
	}
?>

<?php
	$pp_filterable_active_color = get_option('pp_filterable_active_color');
	
	if(!empty($pp_filterable_active_color))
	{
?>
.filter li a:hover, .filter li a.active, #portfolio_wall_filters li a.active,  #portfolio_wall_filters li a:hover { color: <?php echo $pp_filterable_active_color; ?>; }		
<?php
	}
?>

<?php
	$pp_filterable_active_border_color = get_option('pp_filterable_active_border_color');
	
	if(!empty($pp_filterable_active_border_color))
	{
?>
.filter li a:hover, .filter li a.active, #portfolio_wall_filters li a.active,  #portfolio_wall_filters li a:hover { border-color: <?php echo $pp_filterable_active_border_color; ?>; }		
<?php
	}
?>

<?php
	$pp_full_title_font_color = get_option('pp_full_title_font_color');
	
	if(!empty($pp_full_title_font_color))
	{
?>
#gallery_caption h2, #gallery_caption .gallery_desc, .page_control_static #page_maximize:after, a#prevslide:before, a#nextslide:before, #gallery_caption a, #gallery_caption a:hover, #gallery_caption a:active { color: <?php echo $pp_full_title_font_color; ?> !important; }		
<?php
	}
?>

<?php
	$pp_image_desc_font = get_option('pp_image_desc_font');
	
	if(!empty($pp_image_desc_font))
	{
?>
.wall_thumbnail .mask .mask_frame .mask_image_content span, .mansory_thumbnail .mask .mask_frame .mask_image_content span, #gallery_caption .gallery_desc, #imageFlow .legend, #imageFlow .legend a, #imageFlow .legend a:hover, #imageFlow .legend a:active { font-family: '<?php echo urldecode($pp_image_desc_font); ?>'; }		
<?php
	}
?>

<?php
	$pp_shop_price_font_color = get_option('pp_shop_price_font_color');
	
	if(!empty($pp_shop_price_font_color))
	{
?>
.woocommerce ul.products li.product .price ins, .woocommerce-page ul.products li.product .price ins, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, p.price ins span.amount, p.price span.amount, .woocommerce #content div.product p.price, .woocommerce #content div.product span.price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-page #content div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page div.product span.price { 
	color: <?php echo $pp_shop_price_font_color; ?>;
}
<?php
	}	
?>

<?php
if(THEMEDEMO)
{
?>
@media only screen and (min-width: 768px) and (max-width: 960px) {
	img.thumbnail_gallery
	{
		max-width: 212px !important;
		height: auto;
	}
}
<?php
}
?>

<?php
/**
*	Get custom CSS
**/
$pp_custom_css = get_option('pp_custom_css');


if(!empty($pp_custom_css))
{
    echo stripslashes($pp_custom_css);
}
?>

<?php
if(!empty($pp_advance_combine_css))
{
	ob_end_flush();
	ob_end_flush();
}
?>