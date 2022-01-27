<?php

add_action('init','tz_options');

if (!function_exists('tz_options')) {
function tz_options(){
	
// VARIABLES
if( function_exists( 'wp_get_theme' ) ) {
    if( is_child_theme() ) {
        $temp_obj = wp_get_theme();
        $theme_obj = wp_get_theme( $temp_obj->get('Template') );
    } else {
        $theme_obj = wp_get_theme();
    }
    $themeversion = $theme_obj->get('Version');
    $themename = $theme_obj->get('Name');
} else { 
    $theme_data = get_theme_data(STYLESHEETPATH . '/style.css');
    $themename = $theme_data['Name'];
    $themeversion = $theme_data['Version'];
}
$shortname = "tz";

// Populate option in array for use in theme
global $tz_options;
$tz_options = get_option('tz_options');

$GLOBALS['template_path'] = TZ_DIRECTORY;

//Access the WordPress Categories via an Array
$tz_categories = array();  
$tz_categories_obj = get_categories('hide_empty=0');
foreach ($tz_categories_obj as $tz_cat) {
    $tz_categories[$tz_cat->cat_ID] = $tz_cat->cat_name;}
$categories_tmp = array_unshift($tz_categories, "Select a category:");    
       
//Access the WordPress Pages via an Array
$tz_pages = array();
$tz_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($tz_pages_obj as $tz_page) {
    $tz_pages[$tz_page->ID] = $tz_page->post_name; }
$tz_pages_tmp = array_unshift($tz_pages, "Select a page:");       

// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

// Image Links to Options
$options_image_link_to = array("image" => "The Image","post" => "The Post"); 

//Stylesheets Reader
$alt_stylesheet_path = TZ_FILEPATH . '/css/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//More Options
$uploads_arr = wp_upload_dir();
$all_uploads_path = '';
if(isset($uploads_arr['path'])) $all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('tz_uploads');
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");

// Set the Options Array
$options = array();


$options[] = array( "name" => __('General Settings','framework'),
                    "type" => "heading");
                    
$options[] = array( "name" => "",
					"message" => __('Control and configure the general setup of your theme. Upload your preferred logo, setup your feeds and insert your analytics tracking code.','framework'),
					"type" => "intro");
 
                    
$options[] = array( "name" => __('Enable Plain Text Logo','framework'),
					"desc" => __('Check this to enable a plain text logo rather than an image.','framework'),
					"id" => $shortname."_plain_logo",
					"std" => "",
					"type" => "checkbox");

$options[] = array( "name" => __('Custom Logo','framework'),
					"desc" => __('Upload a logo for your theme, or specify the image address of your online logo. (http://example.com/logo.png)','framework'),
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");
					
$options[] = array( 'name' => __('Site Tagline', 'framework'),
                    'desc' => __('Add a tagline to display on your site. If you do not want one, please leave this field blank', 'framework'),
                    'id' =>  $shortname . '_tagline',
                    'std' => '',
                    'type' => 'text');

$options[] = array( "name" => __('Custom Favicon','framework'),
					"desc" => __('Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon.','framework'),
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload");

$options[] = array( 'name' => __('Header Caption', 'framework'),
                    'desc' => __('Enter a message to display above your navigation', 'framework'),
                    'id' => $shortname . '_header_caption',
                    'std' => '',
                    'type' => 'textarea');
					
$options[] = array( "name" => __('Contact Form Email Address','framework'),
					"desc" => __('Enter the email address where you\'d like to receive emails from the contact form, or leave blank to use admin email.','framework'),
					"id" => $shortname."_email",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => __('FeedBurner URL','framework'),
					"desc" => __('Enter your full FeedBurner URL (or any other preferred feed URL) if you wish to use FeedBurner over the standard WordPress Feed e.g. http://feeds.feedburner.com/yoururlhere','framework'),
					"id" => $shortname."_feedburner",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => __('Tracking Code','framework'),
					"desc" => __('Paste your Google Analytics (or other) tracking code here. It will be inserted before the closing body tag of your theme.','framework'),
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");                                                    
					
					
					
					
$options[] = array( "name" => __('Styling Options','framework'),
					"type" => "heading");
					
					
$options[] = array( "name" => "",
					"message" => __('Configure the visual appearance of you theme. You can select the layout of pages that include a sidebar, select a custom color, or insert any custom CSS necessary. Additionally, you can set default background information for your theme.','framework'),
					"type" => "intro");
					
$url = TZ_DIRECTORY . '/admin/images/';
$options[] = array( "name" => __('Main Layout','framework'),
					"desc" => __('Select main content and sidebar alignment.','framework'),
					"id" => $shortname."_layout",
					"std" => "layout-2cr",
					"type" => "images",
					"options" => array(
						'layout-2cr' => $url . '2cr.png',
						'layout-2cl' => $url . '2cl.png')
					);

$options[] = array( "name" => __('Highlight and Link Color', 'framework'),
                    "desc" => __('Select a color to be used as the highlight color within the theme', 'framework'),
                    "id" => $shortname."_highlight_color",
                    "std" => "",
                    "type" => "color");
						
$options[] = array( "name" => __('Custom CSS','framework'),
                    "desc" => __('Quickly add some CSS to your theme by adding it to this block.','framework'),
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");
                    
$options[] = array( "name" => "",
					"message" => __('The following options allow you to set the default background behavior for each page. Each of these options can be overridden on the individual post/page/portfolio level. You are in complete control.', 'framework'),
					"type" => "intro");   

                    
$options[] = array( "name" => __('Default Background Image', 'framework'),
                    "desc" => __('Set the default background image to be used on all pages.', 'framework'),
                    "id" => $shortname."_default_bg_image",
                    "std" => "",
                    "type" => "upload");

$repeat_options = array('no-repeat' => 'No Repeat', 'repeat' => "Repeat", 'repeat-x' => 'Repeat Horizontally', 'repeat-y' => 'Repeat Vertically');  
                  
$options[] = array( "name" => __('Default Background Repeat', 'framework'),
                    "desc" => __('Select the default background repeat for the background image', 'framework'),
                    "id" => $shortname."_default_bg_repeat",
                    "std" => "",
                    "type" => "radio",
                    "options" => $repeat_options);

$position_options = array('left' => 'Left', 'right' => "Right", 'center' => 'Centered', 'full' => 'Full Screen');  

$options[] = array( "name" => __('Default Background Position', 'framework'),
                    "desc" => __('Select the default background position for the background image', 'framework'),
                    "id" => $shortname."_default_bg_position",
                    "std" => "",
                    "type" => "radio",
                    "options" => $position_options);


$options[] = array( "name" => __('Default Background Color', 'framework'),
                    "desc" => __('Select the default background color for pages.', 'framework'),
                    "id" => $shortname."_default_bg_color",
                    "std" => "",
                    "type" => "color");                    
                    

$options[] = array( "name" => __('Home Content Options','framework'),
					"type" => "heading");

$options[] = array( "name" => "",
					"message" => __('The following settings allow you to configure your home page template.','framework'),
					"type" => "intro");

$options[] = array( "name" => __('Display Recent Portfolios', 'framework'),
                    "desc" => __('Enter the number of recent portfolios to display on the home page. If you do not want to display any items, you can leave this field blank or enter 0', 'framework'),
                    "id" => $shortname . "_recent_work",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __('Enable Slider','framework'),
					"desc" => __('Check this to enable the image slider.','framework'),
					"id" => $shortname."_image_slider",
					"std" => "",
					"type" => "checkbox");

$options[] = array( "name" => __('Autoslide','framework'),
					"desc" => __('Enter in the amount of milliseconds before the next transition or leave blank to disable auto slide. 5000 = 5 seconds.','framework'),
					"id" => $shortname."_image_slider_speed",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => __('Image 1','framework'),
					"desc" => __('Upload an image to show in the slider. Dimensions: 700px x 350px.','framework'),
					"id" => $shortname."_image_1",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => __('Image 1 Description','framework'),
					"desc" => __('Enter in an optional description (accepts HTML)','framework'),
					"id" => $shortname."_image_1_desc",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => __('Image 1 Link','framework'),
					"desc" => __('Enter in the URL you wish to link to, or leave blank to disable linking for this image.','framework'),
					"id" => $shortname."_image_link_1",
					"std" => "",
					"type" => "text");	

$options[] = array( "name" => __('Image 2','framework'),
					"desc" => __('Upload an image to show in the slider. Dimensions: 700px x 350px.','framework'),
					"id" => $shortname."_image_2",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => __('Image 2 Description','framework'),
					"desc" => __('Enter in an optional description (accepts HTML)','framework'),
					"id" => $shortname."_image_2_desc",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => __('Image 2 Link','framework'),
					"desc" => __('Enter in the URL you wish to link to, or leave blank to disable linking for this image.','framework'),
					"id" => $shortname."_image_link_2",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => __('Image 3','framework'),
					"desc" => __('Upload an image to show in the slider. Dimensions: 700px x 350px.','framework'),
					"id" => $shortname."_image_3",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => __('Image 3 Description','framework'),
					"desc" => __('Enter in an optional description (accepts HTML)','framework'),
					"id" => $shortname."_image_3_desc",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => __('Image 3 Link','framework'),
					"desc" => __('Enter in the URL you wish to link to, or leave blank to disable linking for this image.','framework'),
					"id" => $shortname."_image_link_3",
					"std" => "",
					"type" => "text");	

$options[] = array( "name" => __('Image 4','framework'),
					"desc" => __('Upload an image to show in the slider. Dimensions: 700px x 350px.','framework'),
					"id" => $shortname."_image_4",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => __('Image 4 Description','framework'),
					"desc" => __('Enter in an optional description (accepts HTML)','framework'),
					"id" => $shortname."_image_4_desc",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => __('Image 4 Link','framework'),
					"desc" => __('Enter in the URL you wish to link to, or leave blank to disable linking for this image.','framework'),
					"id" => $shortname."_image_link_4",
					"std" => "",
					"type" => "text");	

$options[] = array( "name" => __('Image 5','framework'),
					"desc" => __('Upload an image to show in the slider. Dimensions: 700px x 350px.','framework'),
					"id" => $shortname."_image_5",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => __('Image 5 Description','framework'),
					"desc" => __('Enter in an optional description (accepts HTML)','framework'),
					"id" => $shortname."_image_5_desc",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => __('Image 5 Link','framework'),
					"desc" => __('Enter in the URL you wish to link to, or leave blank to disable linking for this image.','framework'),
					"id" => $shortname."_image_link_5",
					"std" => "",
					"type" => "text");



$options[] = array( "name" => __('Post Options','framework'),
					"type" => "heading");
					
$options[] = array( "name" => "",
					"message" => __('Here you can configure how you would like your posts to function.','framework'),
					"type" => "intro");
					
$options[] = array( "name" => __('Show Featured Image on Single Post Page','framework'),
					"desc" => __('Check this to show the featured image at the beginning of the post on the single post page.','framework'),
					"id" => $shortname."_post_img",
					"std" => "",
					"type" => "checkbox");
					
					
					
$options[] = array( "name" => __('Portfolio Options','framework'),
					"type" => "heading");
$options[] = array( "name" => "",
					"message" => __('Here you can configure how you would like your portfolios to function.','framework'),
					"type" => "intro");

$options[] = array( "name" => __('Show Related Portfolios','framework'),
					"desc" => __('Enter the number of related portfolios to display on individual portfolio pages. If you do not wish to display related portfolios, please enter 0.','framework'),
					"id" => $shortname."_portfolio_related",
					"std" => "",
					"type" => "text");


update_option('tz_template',$options); 					  
update_option('tz_themename',$themename);   
update_option('tz_shortname',$shortname);

    }
}