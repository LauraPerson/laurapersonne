<?php
/*
	Begin creating admin options
*/

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array(
	0		=> "Choose a category"
);
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}

$pages = get_pages(array('parent' => -1));
$wp_pages = array(
	0		=> "Choose a page"
);
foreach ($pages as $page_list ) {
       $wp_pages[$page_list->ID] = $page_list->post_title;
}

$galleries = get_posts(array('parent' => -1, 'post_type' => 'gallery', 'numberposts' => -1));
$wp_galleries = array(
	0		=> "Choose a gallery"
);
foreach ($galleries as $gallery_list ) {
       $wp_galleries[$gallery_list->ID] = $gallery_list->post_title;
}

$api_url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

$options = array (
 
//Begin admin header
array( 
		"name" => THEMENAME." Options",
		"type" => "title"
),
//End admin header
 

//Begin first tab "General"
array( 
		"name" => "General",
		"type" => "section",
		"icon" => "gear.png",
)
,

array( "type" => "open"),

array( "name" => "<h2>Website Identity</h2>Custom Favicon",
	"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
	"id" => SHORTNAME."_favicon",
	"type" => "image",
	"std" => "",
),
array( "name" => "<h2>Global Image Settings</h2>Disable right click (for image protection)",
	"desc" => "Check this option to disable right click on website for image protection",
	"id" => SHORTNAME."_enable_right_click",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Disable image dragging (for image protection)",
	"desc" => "Check this option to disable dragging on website for image protection",
	"id" => SHORTNAME."_enable_dragging",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Google Maps Setting</h2>API Key",
	"desc" => "Enter Google Maps API Key <a href=\"https://themegoods.ticksy.com/article/7785/\" target=\"_blank\">How to get API Key</a>",
	"id" => SHORTNAME."_googlemap_api_key",
	"type" => "text",
	"std" => ""
),
array( "name" => "<h2>Advanced Settings</h2>Tracking Code",
	"desc" => "Paste your Google Analytics code (or other) tracking code here. This code will be added into the footer of theme",
	"id" => SHORTNAME."_ga_code",
	"type" => "textarea",
	"std" => ""
),
array( "name" => "Before &lt;/head&gt;",
	"desc" => "This code will be added before &lt;/head&gt; tag",
	"id" => SHORTNAME."_before_head_code",
	"type" => "textarea",
	"std" => ""
),
array( "name" => "Before &lt;/body&gt;",
	"desc" => "This code will be added before &lt;/body&gt; tag",
	"id" => SHORTNAME."_before_body_code",
	"type" => "textarea",
	"std" => ""
),
array( "name" => "<h2>Responsive Layout Settings</h2>Enable responsive layout",
	"desc" => "Check this option to activate responsive layout for mobile devices",
	"id" => SHORTNAME."_enable_responsive",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Animation Settings</h2>Disable loading animation",
	"desc" => "Check this option to disable loading animation",
	"id" => SHORTNAME."_animation",
	"type" => "iphone_checkboxes",
	"std" => 1
),
	
array( "type" => "close"),
//End first tab "General"


//Begin first tab "Menu"
array( 
		"name" => "Menu",
		"type" => "section",
		"icon" => "layout_sidebar.png",
),

array( "type" => "open"),

array( "name" => "<h2>Logo Settings</h2>Logo",
	"desc" => "Image logo which shows above of main menu",
	"id" => SHORTNAME."_logo",
	"type" => "image",
	"std" => "",
),
array( "name" => "Retina Logo",
	"desc" => "Retina Ready Image logo. It should be 2x size of normal logo",
	"id" => SHORTNAME."_retina_logo",
	"type" => "image",
	"std" => "",
),
array( "name" => "Transparent Logo",
	"desc" => "Image logo for transparent menu option",
	"id" => SHORTNAME."_logo_transparent",
	"type" => "image",
	"std" => "",
),
array( "name" => "Transparent Retina Logo",
	"desc" => "Retina Ready Image logo for transparent menu option. It should be 2x size of normal logo",
	"id" => SHORTNAME."_retina_logo_transparent",
	"type" => "image",
	"std" => "",
),
array( "name" => "Logo Margin Bottom (in px)",
	"desc" => "Select logo margin bottom value",
	"id" => SHORTNAME."_logo_margin_bottom",
	"type" => "jslider",
	"size" => "40px",
	"std" => "0",
	"from" => 0,
	"to" => 100,
	"step" => 1,
),

array( "name" => "<h2>Menu Settings</h2>Menu Margin Top (in px)",
	"desc" => "Select logo margin bottom value",
	"id" => SHORTNAME."_menu_margin_top",
	"type" => "jslider",
	"size" => "40px",
	"std" => "40",
	"from" => 0,
	"to" => 100,
	"step" => 1,
),

array( "name" => "Menu Font Family",
	"desc" => "Select font style main menu",
	"id" => SHORTNAME."_menu_font",
	"type" => "font",
	"std" => ''
),

array( "name" => "Menu font Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_menu_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "14",
	"from" => 11,
	"to" => 24,
	"step" => 1,
),

/*array( "name" => "Make Menu display by default",
	"desc" => "Check this option to make main menu display automatically when page loaded",
	"id" => SHORTNAME."_menu_display",
	"type" => "iphone_checkboxes",
	"std" => 1
),*/

array( "name" => "Make Menu font uppercase",
	"desc" => "",
	"id" => SHORTNAME."_menu_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Sub Menu font Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_submenu_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "11",
	"from" => 10,
	"to" => 24,
	"step" => 1,
),

array( "name" => "Make Sub Menu font uppercase",
	"desc" => "",
	"id" => SHORTNAME."_submenu_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Menu Closed State Settings</h2>Menu Background Color",
	"desc" => "Select color for menu background when it's in closed state",
	"id" => SHORTNAME."_menu_close_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Menu Background Opacity",
	"desc" => "Select opacity value for menu background when it's in closed state",
	"id" => SHORTNAME."_menu_close_bg_opacity",
	"type" => "jslider",
	"size" => "40px",
	"std" => "70",
	"from" => 10,
	"to" => 100,
	"step" => 5,
),

array( "name" => "Menu Font Color",
	"desc" => "Select color for menu font when it's in closed state",
	"id" => SHORTNAME."_menu_close_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Menu Hover Background Color",
	"desc" => "Select color for menu background hover when it's in closed state",
	"id" => SHORTNAME."_menu_close_hover_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Menu Hover Font Color",
	"desc" => "Select color for menu font hover when it's in closed state",
	"id" => SHORTNAME."_menu_close_hover_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "<h2>Menu Open State Settings</h2>Menu Background Color",
	"desc" => "Select color for menu background",
	"id" => SHORTNAME."_menu_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Menu Font Color",
	"desc" => "Select color for menu font",
	"id" => SHORTNAME."_menu_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#999999"
),

array( "name" => "Menu Hover Font Color",
	"desc" => "Select color for menu font in hover state",
	"id" => SHORTNAME."_menu_hover_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Menu Active Font Color",
	"desc" => "Select color for menu font in active state",
	"id" => SHORTNAME."_menu_active_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Sub Menu Font Color",
	"desc" => "Select color for submenu font",
	"id" => SHORTNAME."_submenu_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#999999"
),

array( "name" => "Sub Menu Hover Font Color",
	"desc" => "Select color for menu font in hover state",
	"id" => SHORTNAME."_submenu_hover_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "<h2>Social Icons Settings</h2>Social Icons Color",
	"desc" => "Select color for social icons",
	"id" => SHORTNAME."_social_icon_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Social Icons Background Color",
	"desc" => "Select background color for social icons",
	"id" => SHORTNAME."_social_icon_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Social Icons Size (in px)",
	"desc" => "Select icon size for social icons",
	"id" => SHORTNAME."_social_icon_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "12",
	"from" => 1,
	"to" => 60,
	"step" => 1,
),

array( "name" => "<h2>Footer Settings</h2>Footer text",
	"desc" => "Enter footer text ex. copyright description",
	"id" => SHORTNAME."_footer_text",
	"type" => "textarea",
	"std" => ""
),

array( "name" => "Footer Font Family",
	"desc" => "Select font style footer",
	"id" => SHORTNAME."_footer_font",
	"type" => "font",
	"std" => ''
),

array( "name" => "Footer font Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_footer_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "14",
	"from" => 10,
	"to" => 24,
	"step" => 1,
),

array( "name" => "Make Footer font italic",
	"desc" => "",
	"id" => SHORTNAME."_footer_font_italic",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Footer Font Color",
	"desc" => "Select color for the font in footer",
	"id" => SHORTNAME."_footer_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#999999"
),

array( "name" => "Footer Link Color",
	"desc" => "Select color for the link in footer",
	"id" => SHORTNAME."_footer_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Footer Hover Link Color",
	"desc" => "Select color for the hover font in footer",
	"id" => SHORTNAME."_footer_hover_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),
	
array( "type" => "close"),
//End first tab "Menu"


//Begin second tab "Sidebar"
array( 	"name" => "Sidebar",
		"type" => "section",
		"icon" => "text_padding_right.png",	
),
array( "type" => "open"),

array( "name" => "<h2>Custom Sidebar Settings</h2>Add a new sidebar",
	"desc" => "Enter sidebar name",
	"id" => SHORTNAME."_sidebar0",
	"type" => "text",
	"std" => "",
),
array( "name" => "<h2>Sidebar Font Settings</h2>Widget Title font size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_sidebar_title_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "16",
	"from" => 13,
	"to" => 40,
	"step" => 1,
),
array( "name" => "Make Widget Title font uppercase",
	"desc" => "",
	"id" => SHORTNAME."_sidebar_title_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Widget Title Font",
	"desc" => "Select global font family for all sidebar widget's title",
	"id" => SHORTNAME."_sidebar_title_font",
	"type" => "font",
	"std" => ""
),
array( "name" => "<h2>Sidebar Content Colors Settings</h2>Sidebar Font Color",
	"desc" => "Select color for the font in sidebar",
	"id" => SHORTNAME."_sidebar_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#444444"
),

array( "name" => "Sidebar Link Color",
	"desc" => "Select color for the link in sidebar",
	"id" => SHORTNAME."_sidebar_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Sidebar Hover Link Color",
	"desc" => "Select color for the hover font in sidebar",
	"id" => SHORTNAME."_sidebar_hover_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Sidebar Title Font Color",
	"desc" => "Select color for the widget title in sidebar",
	"id" => SHORTNAME."_sidebar_title_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "type" => "close"),
//End second tab "Sidebar"


//Begin first tab "Background"
array( 
		"name" => "Background",
		"type" => "section",
		"icon" => "paintcan.png",
),

array( "type" => "open"),

array( "name" => "<h2>Body Background Settings</h2>Body Background Color",
	"desc" => "Select background color for body of page",
	"id" => SHORTNAME."_body_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "<h2>Content Background Settings</h2>Main Content Background Color",
	"desc" => "Select background color for main content area",
	"id" => SHORTNAME."_content_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "<h2>404, Archives, Categories, Search and Tags Background Settings</h2>404 Error Page Background Image",
	"desc" => "Select background image for 404 not found page",
	"id" => SHORTNAME."_bg_404",
	"type" => "image",
	"std" => "",
),

array( "name" => "Archives Page Background Image",
	"desc" => "Select background image for archives page",
	"id" => SHORTNAME."_bg_archives",
	"type" => "image",
	"std" => "",
),

array( "name" => "Categories Page Background Image",
	"desc" => "Select background image for categories page",
	"id" => SHORTNAME."_bg_categories",
	"type" => "image",
	"std" => "",
),

array( "name" => "Search Page Background Image",
	"desc" => "Select background image for search page",
	"id" => SHORTNAME."_bg_search",
	"type" => "image",
	"std" => "",
),

array( "name" => "Tags Page Background Image",
	"desc" => "Select background image for tags page",
	"id" => SHORTNAME."_bg_tags",
	"type" => "image",
	"std" => "",
),
	
array( "type" => "close"),
//End first tab "Background"


//Begin first tab "Typography"
array( 
		"name" => "Typography",
		"type" => "section",
		"icon" => "text_dropcaps.png",
)
,

array( "type" => "open"),

array( "name" => "<h2>Google Web Fonts Settings</h2>You can add additional Google Web Font.",
	"desc" => "Enter font name ex. Courgette <a href=\"http://www.google.com/webfonts\">Checkout Google Web Font Directory</a>",
	"id" => SHORTNAME."_ggfont0",
	"type" => "text",
	"std" => "",
),

array( "name" => "<h2>Header Font Settings</h2>Header Font",
	"desc" => "Select font style your header",
	"id" => SHORTNAME."_header_font",
	"type" => "font",
	"std" => ''
),
array( "name" => "H1 Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_h1_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "40",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H2 Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_h2_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "32",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H3 Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_h3_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "26",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H4 Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_h4_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "24",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H5 Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_h5_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "22",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H6 Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_h6_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "18",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "Header Font weight",
	"desc" => "",
	"id" => SHORTNAME."_h1_weight",
	"type" => "jslider",
	"size" => "40px",
	"std" => "600",
	"from" => 100,
	"to" => 900,
	"step" => 100,
),
array( "name" => "<h2>Body Font Settings</h2>Main Content Font",
	"desc" => "Select font style your main content",
	"id" => SHORTNAME."_body_font",
	"type" => "font",
	"std" => ''
),
array( "name" => "Main Content Font Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_body_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "16",
	"from" => 11,
	"to" => 20,
	"step" => 1,
),
array( "name" => "<h2>Page Title Font Settings</h2>Page Title font Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_page_title_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "92",
	"from" => 14,
	"to" => 100,
	"step" => 1,
),
array( "name" => "Make Page Title font uppercase",
	"desc" => "",
	"id" => SHORTNAME."_page_title_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),
	
array( "type" => "close"),
//End first tab "Typography"


//Begin first tab "Styling"
array( 
		"name" => "Styling",
		"type" => "section",
		"icon" => "palette.png",
)
,

array( "type" => "open"),

array( "name" => "<h2>Page Title Settings</h2>Page Title Background Overlay Opacity",
	"desc" => "Select opacity value for page title background overlay",
	"id" => SHORTNAME."_page_title_bgoverlay_opacity",
	"type" => "jslider",
	"size" => "40px",
	"std" => "50",
	"from" => 0,
	"to" => 100,
	"step" => 5,
),

array( "name" => "Page Title Font Color",
	"desc" => "Select color for the page title",
	"id" => SHORTNAME."_page_title_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "<h2>Page Content Colors Settings</h2>Font Color",
	"desc" => "Select color for the font",
	"id" => SHORTNAME."_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Page Content Link Color",
	"desc" => "Select color for the link",
	"id" => SHORTNAME."_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#0da29d"
),

array( "name" => "Page Content Hover Link Color",
	"desc" => "Select color for the hover background color",
	"id" => SHORTNAME."_hover_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "H1, H2, H3, H4, H5, H6 Color",
	"desc" => "Select color for the H1, H2, H3, H4, H5, H6",
	"id" => SHORTNAME."_h1_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Horizontal Line Color",
	"desc" => "Select color for the hr tag",
	"id" => SHORTNAME."_hr_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "<h2>Input Elements and Button Colors Settings</h2>Input and Textarea Background Color",
	"desc" => "Select color for input and textarea background",
	"id" => SHORTNAME."_input_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Input and Textarea Font Color",
	"desc" => "Select font color for input and textarea",
	"id" => SHORTNAME."_input_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#444444"
),

array( "name" => "Input and Textarea Border Color",
	"desc" => "Select border color for input and textarea",
	"id" => SHORTNAME."_input_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#cccccc"
),

array( "name" => "Input and Textarea On Focus State Color",
	"desc" => "Select color for input and textarea in focused state",
	"id" => SHORTNAME."_input_focus_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Button Background Color",
	"desc" => "Select color for the button background",
	"id" => SHORTNAME."_button_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Button Font Color",
	"desc" => "Select color for the button font",
	"id" => SHORTNAME."_button_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Button Border Color",
	"desc" => "Select color for the button border",
	"id" => SHORTNAME."_button_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "type" => "close"),
//End first tab "Styling"


//Begin second tab "Gallery-Portfolio"
array( 	"name" => "Gallery-Portfolio",
		"type" => "section",
		"icon" => "folder-open-image.png",
),
array( "type" => "open"),

array( "name" => "<h2>Global Gallery Settings</h2>Gallery Images Sorting",
	"desc" => "Select how you want to sort gallery images",
	"id" => SHORTNAME."_gallery_sort",
	"type" => "select",
	"options" => array(
		'drag' => 'By Drag&drop',
		'post_date' => 'By Newest',
		'post_date_old' => 'By Oldest',
		'rand' => 'By Random',
		'title' => 'By Title',
	),
	"std" => ""
),

array( "name" => "Display image caption in lightbox",
	"desc" => "Check if you want to display image title and description under the image in lightbox mode",
	"id" => SHORTNAME."_image_lightbox_title",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Fullscreen Image Caption Font Color",
	"desc" => "Select font color for fullscreen templates image caption",
	"id" => SHORTNAME."_full_title_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "<h2>Full Screen Slideshow Settings</h2>Enable autoplay fullscreen slideshow",
	"desc" => "Check this option to let fullscreen slideshow starts playing automatically",
	"id" => SHORTNAME."_full_autoplay",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Slideshow timer",
	"desc" => "Enter number of seconds for Full Screen Slideshow timer",
	"id" => SHORTNAME."_full_slideshow_timer",
	"type" => "jslider",
	"size" => "40px",
	"std" => "5",
	"from" => 1,
	"to" => 20,
	"step" => 1,
),
array( "name" => "Slideshow Transition Effect",
	"desc" => "Select transition type for contents in Full Screen slideshow",
	"id" => SHORTNAME."_full_slideshow_trans",
	"type" => "select",
	"options" => array(
		1 => 'Fade',
		2 => 'Slide Top',
		3 => 'Slide Right',
		4 => 'Slide Bottom',
		5 => 'Slide Left',
		6 => 'Carousel Right',
		7 => 'Carousel Left',
	),
	"std" => "Fade"
),
array( "name" => "Slideshow Transition Timer",
	"desc" => "Enter number of seconds for transition between each image",
	"id" => SHORTNAME."_full_slideshow_trans_speed",
	"type" => "jslider",
	"size" => "40px",
	"std" => "400",
	"from" => 100,
	"to" => 10000,
	"step" => 100,
),
array( "name" => "Enable slideshow images cover screen resolution",
	"desc" => "Check this option if you want to make fullscreen slideshow image display cover user screen size",
	"id" => SHORTNAME."_full_fit_image",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Enable slideshow image caption",
	"desc" => "Check this option if you want to display fullscreen slideshow image caption",
	"id" => SHORTNAME."_full_image_title",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Kenburns Slideshow Settings</h2>Kenburns Slideshow timer",
	"desc" => "Enter number of seconds for Kenburns Slideshow timer",
	"id" => SHORTNAME."_kenburns_timer",
	"type" => "jslider",
	"size" => "40px",
	"std" => "5",
	"from" => 1,
	"to" => 20,
	"step" => 1,
),
array( "name" => "Kenburns Zoom Level",
	"desc" => "Select zoom level for Kenburns slideshow",
	"id" => SHORTNAME."_kenburns_zoom",
	"type" => "jslider",
	"size" => "40px",
	"std" => "2",
	"from" => 1,
	"to" => 10,
	"step" => 1,
),
array( "name" => "Fade Transition Timer",
	"desc" => "Enter number of seconds for transition between each image",
	"id" => SHORTNAME."_kenburns_trans",
	"type" => "jslider",
	"size" => "40px",
	"std" => "1000",
	"from" => 100,
	"to" => 10000,
	"step" => 100,
),
array( "name" => "<h2>Image Flow Slideshow Settings</h2>Enable image reflection",
	"desc" => "Check this option if you want to display mirror reflection effect in flow gallery",
	"id" => SHORTNAME."_flow_enable_reflection",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Enable image caption",
	"desc" => "Check this option if you want to display image flow image caption",
	"id" => SHORTNAME."_flow_enable_slideshow_title",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Gallery Cover Settings</h2>Gallery Cover Background Color",
	"desc" => "Select background color for gallery cover",
	"id" => SHORTNAME."_gallery_cover_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Gallery Cover Background Opacity",
	"desc" => "Select opacity value for gallery cover background",
	"id" => SHORTNAME."_gallery_cover_opacity_color",
	"type" => "jslider",
	"size" => "40px",
	"std" => "70",
	"from" => 10,
	"to" => 100,
	"step" => 5,
),

array( "name" => "Gallery Cover Title Font",
	"desc" => "Select font style for gallery cover title",
	"id" => SHORTNAME."_gallery_cover_title_font",
	"type" => "font",
	"std" => ''
),
array( "name" => "Gallery Cover Title Font Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_gallery_cover_title_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "92",
	"from" => 14,
	"to" => 120,
	"step" => 1,
),

array( "name" => "Gallery Cover Title Font Color",
	"desc" => "Select font color for gallery cover title",
	"id" => SHORTNAME."_gallery_cover_title_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Gallery Cover Description Font Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_gallery_cover_desc_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "13",
	"from" => 11,
	"to" => 30,
	"step" => 1,
),

array( "name" => "Gallery Cover Description Letter Spacing (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_gallery_cover_desc_letter_space",
	"type" => "jslider",
	"size" => "40px",
	"std" => "3",
	"from" => 0,
	"to" => 10,
	"step" => 1,
),

array( "name" => "Make Gallery Cover Description font uppercase",
	"desc" => "",
	"id" => SHORTNAME."_gallery_cover_desc_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Gallery Cover Button Font Color",
	"desc" => "Select font color for gallery cover button",
	"id" => SHORTNAME."_gallery_cover_button_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Gallery Cover Button Border Color",
	"desc" => "Select border color for gallery cover button",
	"id" => SHORTNAME."_gallery_cover_button_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "<h2>Gallery & Portfolio Item Colors Settings</h2>Hover Background Color",
	"desc" => "Select color for gallery & portfolio item background in hover state",
	"id" => SHORTNAME."_portfolio_hover_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Hover Background Opacity",
	"desc" => "Select opacity value for gallery & portfolio item background in hover state",
	"id" => SHORTNAME."_portfolio_hover_opacity_color",
	"type" => "jslider",
	"size" => "40px",
	"std" => "50",
	"from" => 10,
	"to" => 100,
	"step" => 5,
),

array( "name" => "Portfolios Hover Font Color",
	"desc" => "Select font color for the portfolio item in hover state",
	"id" => SHORTNAME."_portfolio_hover_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "<h2>Filterable Portfolio Settings</h2>Filterable options sorting",
	"desc" => "Select how you want to sort filterable sets",
	"id" => SHORTNAME."_portfolio_set_sort",
	"type" => "select",
	"options" => array(
		'name' => 'By Name',
		'slug' => 'By Slug',
		'id' => 'By ID',
		'count' => 'By Number of Portfolios',
	),
	"std" => 'name'
),
array( "name" => "Filterable Bar Font Color",
	"desc" => "Select color for the filterable text",
	"id" => SHORTNAME."_filterable_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),
array( "name" => "Filterable Bar Active State Font Color",
	"desc" => "Select active state color for the filterable text",
	"id" => SHORTNAME."_filterable_active_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),
array( "name" => "Filterable Bar Active State Border Color",
	"desc" => "Select active state border color for the filterable text",
	"id" => SHORTNAME."_filterable_active_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "<h2>Portfolio Category Settings</h2>Portfolio Category Layout",
	"desc" => "Select page template for displaying portfolio category contents",
	"id" => SHORTNAME."_portfolio_archives_layout",
	"type" => "select",
	"options" => array(
		'grid' => 'Grid',
		'masonry' => 'Masonry',
		'vertical' => 'Vertical',
	),
	"std" => 1
),

array( "type" => "close"),
//End second tab "Gallery"


//Begin second tab "Shop"
array( 	"name" => "Shop",
		"type" => "section",
		"icon" => "store.png",
),
array( "type" => "open"),

array( "name" => "Shop Main Page Layout",
	"desc" => "Select page layout for displaying shop\'s products page",
	"id" => SHORTNAME."_shop_layout",
	"type" => "select",
	"options" => array(
		'fullwidth' => 'Fullwidth',
		'sidebar' => 'With Sidebar',
	),
	"std" => ""
),

array( "name" => "Products Page Show At Most",
	"desc" => "Select number of product items you want to display per page",
	"id" => SHORTNAME."_shop_items",
	"type" => "jslider",
	"size" => "40px",
	"std" => "8",
	"from" => 1,
	"to" => 50,
	"step" => 1,
),

array( "name" => "Product Price Font Color",
	"desc" => "Select color for product price",
	"id" => SHORTNAME."_shop_price_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#0da29d"
),

array( "name" => "Display Related Products",
	"desc" => "Check this option to display related products on single product page",
	"id" => SHORTNAME."_shop_related_products",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "type" => "close"),
//End second tab "Shop"


array( 	"name" => "Blog",
		"type" => "section",
		"icon" => "book-open-bookmark.png",
),
array( "type" => "open"),

array( "name" => "<h2>Archives, Categories, Tags and Search Page Settings</h2>Archives Page Layout",
	"desc" => "Select blog layout for archives page",
	"id" => SHORTNAME."_blog_archives_layout",
	"type" => "select",
	"options" => array(
		'page_sidebar' => 'With Sidebar',
		'fullwidth' => 'Fullwidth',
		'grid' => 'Grid',
		'thumb' => 'Thumbnail',
	),
	"std" => 'page_sidebar'
),

array( "name" => "Categories Page Layout",
	"desc" => "Select blog layout for categories page",
	"id" => SHORTNAME."_blog_categories_layout",
	"type" => "select",
	"options" => array(
		'page_sidebar' => 'With Sidebar',
		'fullwidth' => 'Fullwidth',
		'grid' => 'Grid',
		'thumb' => 'Thumbnail',
	),
	"std" => 'page_sidebar'
),

array( "name" => "Search Page Layout",
	"desc" => "Select blog layout for search page",
	"id" => SHORTNAME."_blog_search_layout",
	"type" => "select",
	"options" => array(
		'page_sidebar' => 'With Sidebar',
		'fullwidth' => 'Fullwidth',
		'thumb' => 'Thumbnail',
	),
	"std" => 'page_sidebar'
),

array( "name" => "Tags Page Layout",
	"desc" => "Select blog layout for tags page",
	"id" => SHORTNAME."_blog_tags_layout",
	"type" => "select",
	"options" => array(
		'page_sidebar' => 'With Sidebar',
		'fullwidth' => 'Fullwidth',
		'grid' => 'Grid',
		'thumb' => 'Thumbnail',
	),
	"std" => 'page_sidebar'
),

array( "name" => "<h2>Single Post Page Settings</h2>Single Post Page Layout",
	"desc" => "Select blog layout for single post page",
	"id" => SHORTNAME."_blog_single_layout",
	"type" => "select",
	"options" => array(
		'page_sidebar' => 'With Sidebar',
		'fullwidth' => 'Fullwidth',
	),
	"std" => 1
),

array( "name" => "Display post's featured content on single post page",
	"desc" => "Check this option to display post's featured content on single post page",
	"id" => SHORTNAME."_blog_display_ft",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Show next and previous posts on single post page",
	"desc" => "Check this option to display next and previous posts in single post page",
	"id" => SHORTNAME."_blog_next_prev",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Blog Page Settings</h2>Display full blog post content on blog page",
	"desc" => "Check this option to display full post content on blog pages",
	"id" => SHORTNAME."_blog_display_full",
	"type" => "iphone_checkboxes",
	"std" => 1
),


array( "type" => "close"),


//Begin fourth tab "Contact"
array( 	"name" => "Contact",
		"type" => "section",
		"icon" => "mail-receive.png",
),
array( "type" => "open"),
	

array( "name" => "Your email address",
	"desc" => "Enter which email address will be sent from contact form",
	"id" => SHORTNAME."_contact_email",
	"type" => "text",
	"std" => ""

),
array( "name" => "Select and sort contents on your contact page. Use fields you want to show on your contact form",
	"sort_title" => "Contact Form Manager",
	"desc" => "",
	"id" => SHORTNAME."_contact_form",
	"type" => "sortable",
	"options" => array(
		0 => 'Empty field',
		1 => 'Name',
		2 => 'Email',
		3 => 'Message',
		4 => 'Address',
		5 => 'Phone',
		6 => 'Mobile',
		7 => 'Company Name',
		8 => 'Country',
	),
	"options_disable" => array(1, 2, 3),
	"std" => ''
),
array( "name" => "<h2>Map Setting</h2>Show map in contact page",
	"desc" => "If you enable this option. It will display map as background on contact page",
	"id" => SHORTNAME."_contact_display_map",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Address Latitude",
	"desc" => "<a href=\"http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/\">Find here</a>",
	"id" => SHORTNAME."_contact_lat",
	"type" => "text",
	"std" => ""
),
array( "name" => "Address Longtitude",
	"desc" => "<a href=\"http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/\">Find here</a>",
	"id" => SHORTNAME."_contact_long",
	"type" => "text",
	"std" => ""
),
array( "name" => "Map Zoom level",
	"desc" => "",
	"id" => SHORTNAME."_contact_map_zoom",
	"type" => "jslider",
	"size" => "40px",
	"std" => "12",
	"from" => 1,
	"to" => 18,
	"step" => 1,
),
array( "name" => "Map Info box content",
	"desc" => "Enter text to display in map info box",
	"id" => SHORTNAME."_contact_info_box",
	"type" => "text",
	"std" => ""
),
array( "name" => "<h2>Captcha Settings</h2>Enable/disable Captcha",
	"desc" => "",
	"id" => SHORTNAME."_contact_enable_captcha",
	"type" => "iphone_checkboxes",
	"std" => 1
),

//End fourth tab "Contact"


//Begin fifth tab "Social Profiles"
array( "type" => "close"),
array( 	"name" => "Social-Profiles",
		"type" => "section",
		"icon" => "social.png",
),
array( "type" => "open"),

array( "name" => "<h2>Social Sharing Settings</h2>Enable sharing for all pages and posts",
	"desc" => "Check this option to display social sharing option for all pages and post",
	"id" => SHORTNAME."_sharing",
	"type" => "iphone_checkboxes",
	"std" => 1
),
	
array( "name" => "<h2>Accounts Settings</h2>Facebook Profile ID",
	"desc" => "",
	"id" => SHORTNAME."_facebook_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Twitter Username",
	"desc" => "",
	"id" => SHORTNAME."_twitter_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Google Plus URL",
	"desc" => "",
	"id" => SHORTNAME."_google_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Flickr Username",
	"desc" => "",
	"id" => SHORTNAME."_flickr_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Youtube Username",
	"desc" => "",
	"id" => SHORTNAME."_youtube_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Vimeo Username",
	"desc" => "",
	"id" => SHORTNAME."_vimeo_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Tumblr Username",
	"desc" => "",
	"id" => SHORTNAME."_tumblr_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Dribbble Username",
	"desc" => "",
	"id" => SHORTNAME."_dribbble_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Linkedin URL",
	"desc" => "",
	"id" => SHORTNAME."_linkedin_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Pinterest Username",
	"desc" => "",
	"id" => SHORTNAME."_pinterest_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Instagram Username",
	"desc" => "",
	"id" => SHORTNAME."_instagram_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "<h2>Twitter API Settings</h2>Twitter Consumer Key <a href=\"http://support.themegoods.com/?knowledgebase=fix-twitter-widget\">See instructions</a>",
	"desc" => "",
	"id" => SHORTNAME."_twitter_consumer_key",
	"type" => "text",
	"std" => ""
),
array( "name" => "Twitter Consumer Secret",
	"desc" => "",
	"id" => SHORTNAME."_twitter_consumer_secret",
	"type" => "text",
	"std" => ""
),
array( "name" => "Twitter Consumer Token",
	"desc" => "",
	"id" => SHORTNAME."_twitter_consumer_token",
	"type" => "text",
	"std" => ""
),
array( "name" => "Twitter Consumer Token Secret",
	"desc" => "",
	"id" => SHORTNAME."_twitter_consumer_token_secret",
	"type" => "text",
	"std" => ""
),

//End fifth tab "Social Profiles"
array( "type" => "close"),


//Begin second tab "Script"
array( "name" => "Script",
	"type" => "section",
	"icon" => "css.png",
),

array( "type" => "open"),

array( "name" => "<h2>CSS Settings</h2>Custom CSS",
	"desc" => "You can add your custom CSS here",
	"id" => SHORTNAME."_custom_css",
	"type" => "textarea",
	"std" => ""
),
array( "name" => "<h2>CSS and Javascript Optimisation Settings</h2>Combine and compress theme's CSS files",
	"desc" => "Combine and compress all CSS files to one. Help reduce page load time",
	"id" => SHORTNAME."_advance_combine_css",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Combine and compress theme's javascript files",
	"desc" => "Combine and compress all javascript files to one. Help reduce page load time",
	"id" => SHORTNAME."_advance_combine_js",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Clear Cache",
	"desc" => "Try to clear cache when you enable javascript and CSS compression and theme went wrong",
	"id" => SHORTNAME."_advance_clear_cache",
	"type" => "html",
	"html" => '<a id="'.SHORTNAME.'_advance_clear_cache" href="'.$api_url.'" class="button">Click here to start clearing cache files</a>',
),

array( "type" => "close"),

//Begin second tab "Backup"
array( "name" => "Backup",
	"type" => "section",
	"icon" => "drive_disk.png",
),

array( "type" => "open"),

array( "name" => "<h2>Import Settings</h2>",
	"desc" => "Choose theme export file (.json) from your computer and click \"Import\" button",
	"id" => SHORTNAME."_import_current",
	"type" => "html",
	"html" => '<input type="file" id="'.SHORTNAME.'_import_current" name="'.SHORTNAME.'_import_current"/><input type="submit" id="'.SHORTNAME.'_import_current_button" class="button" value="Import"/>',
),

array( "name" => "<h2>Export Settings</h2>",
	"desc" => "You can click below button to save current backup into .json file so you can import it back any time using restore form below.",
	"id" => SHORTNAME."_export_current",
	"type" => "html",
	"html" => '<input type="submit" id="'.SHORTNAME.'_export_current_button" class="button" value="Export Current Theme Settings"/><input type="hidden" id="'.SHORTNAME.'_export_current" name="'.SHORTNAME.'_export_current" value="0"/>',
),
 
array( "type" => "close"),
 
);
?>