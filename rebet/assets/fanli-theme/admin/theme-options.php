<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){
	
// VARIABLES
$themename = get_theme_data(STYLESHEETPATH . '/style.css');
$themename = $themename['Name'];
$shortname = "of";

// Populate OptionsFramework option in array for use in theme
global $of_options;
$of_options = get_option('of_options');

$GLOBALS['template_path'] = OF_DIRECTORY;

//Access the WordPress Categories via an Array
$of_categories = array();  
$of_categories_obj = get_categories('hide_empty=0');
foreach ($of_categories_obj as $of_cat) {
    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
$categories_tmp = array_unshift($of_categories, "Select a category:");  
// Return Cat slug
// $cat_name = options('of_news', 0); $cat_id = get_cat_ID( $cat_name )
       
//Access the WordPress Pages via an Array
$of_pages = array();
$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($of_pages_obj as $of_page) {
    $of_pages[$of_page->ID] = $of_page->post_name; }
$of_pages_tmp = array_unshift($of_pages, "Select a page:");      
// Return Page slug
// $page_name = options('of_news', 0); $page_id = get_ID_by_page_slug( $page_slug )  // get_ID_by_page_slug is a custom function

//Stylesheets Reader
$alt_stylesheet_path = OF_FILEPATH . '/styles/';
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
$all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('of_uploads');

//// Custom Select
//$options_image_link_to = array("image" => "The Image","post" => "The Post"); 
//
//// Test data
//$test_array = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
//
//// Multicheck Array
//$multicheck_array = array("one" => "French Toast", "two" => "Pancake", "three" => "Omelette", "four" => "Crepe", "five" => "Waffle");
//
//// Multicheck Defaults
//$multicheck_defaults = array("one" => "1","five" => "1");

// Set the Options Array
$options = array();

// General && Never Delete
$options[] = array( 'name' => '常规设置',
                    'type' => 'heading');

$options[] = array( 'name' => 'Logo',
					'desc' => '上传网站Logo图片',
					'id' => $shortname.'_logo',
					//'std' => OF_DIRECTORY . '/images/favicon.ico',
					'std'  => '',
					'type' => 'upload',
					'trans' => '0');
					
$options[] = array( 'name' => 'Favicon',
					'desc' => '上传一个大小为 16px x 16px ico 图片 用来替换目前网站的 favicon.',
					'id' => $shortname.'_custom_favicon',
					//'std' => OF_DIRECTORY . '/images/favicon.ico',
					'std'  => '',
					'type' => 'upload',
					'trans' => '0'); 

$options[] = array( 'name' => '启用SEO设置',
					'id' => $shortname.'_is_seo',
					'std'  => 'true',
					'type' => 'checkbox',
					'desc' => '启用',
					'trans' => '0'); 

$options[] = array( 'name' => '追踪代码',
					'desc' => '使用您的 Google Analytics (或者其他) 监测代码.',
					'id' => $shortname.'_google_analytics',
					'std' => '',
					'type' => 'textarea',
					'trans' => '0');

//// Hide
//$options[] = array( "name" => "Hidden",
//					"type" => "heading");
//					
//$options[] = array( "name" => "Check to Show a Hidden Text Input",
//					"desc" => "Click here and see what happens.",
//					"id" => "example_showhidden",
//					"class" => "un_hidden",
//					"type" => "checkbox");
//	
//$options[] = array( "name" => "Hidden Text Input",
//					"desc" => "This option is hidden unless activated by a checkbox click.",
//					"id" => "example_text_hidden",
//					"std" => "Hello",
//					"class" => "hidden",
//					"type" => "text");
//
//
//// Other Options
//$options[] = array( "name" => "Others",
//					"type" => "heading"); 
//
//$options[] = array( "name" => "Select Copyright Info Page for Footer",
//					"desc" => "Creat a copyright info page, and select it.",
//					"id" => $shortname."_copyright",
//					"std" => "",
//					"type" => "select",
//					"options" => $of_pages);
//
//$options[] = array( "name" => "Colorpicker",
//					"desc" => "",
//					"id" => "example_colorpicker",
//					"std" => "",
//					"type" => "color");
//
//$options[] = array( "name" => "Typography",
//					"desc" => "Example typography.",
//					"id" => "example_typography",
//					"std" => array('size' => '12px','face' => 'verdana','style' => 'bold italic','color' => '#123456'),
//					"type" => "typography");	
//
//$options[] = array( "name" => "Input Select Small",
//					"desc" => "Small Select Box.",
//					"id" => "example_select",
//					"std" => "three",
//					"type" => "select",
//					"class" => "mini", //mini, tiny, small
//					"options" => $test_array);	
//
//$options[] = array( "name" => "Input Radio (one)",
//					"desc" => "Radio select with default options 'one'.",
//					"id" => "example_radio",
//					"std" => "one",
//					"type" => "radio",
//					"options" => $test_array);
//
//$options[] = array( "name" => "Example Info",
//						"desc" => "This is just some example information you can put in the panel.",
//						"type" => "info");
//
//$options[] = array( "name" => "Input Checkbox",
//					"desc" => "Example checkbox, defaults to true.",
//					"id" => "example_checkbox",
//					"std" => "1",
//					"type" => "checkbox");
//
//$options[] = array( "name" => "Multicheck",
//				"desc" => "Multicheck description.",
//				"id" => "example_multicheck",
//				"std" => $multicheck_defaults, // These items get checked by default
//				"type" => "multicheck",
//				"options" => $multicheck_array);
//
// SEO && Never Delete
$options[] = array( "name" => "SEO设置",
					"type" => "heading"); 

$options[] = array( "name" => "首页描述",
					"desc" => "添加一个描述内容",
					"id" => $shortname."_global_dec",
					"std" => "",
					"type" => "textarea");	

$options[] = array( "name" => "首页关键字",
					"desc" => "添加网站关键字",
					"id" => $shortname."_global_keywords",
					"std" => "",
					"type" => "textarea");	

$options[] = array( "name" => "标题",
					"desc" => "添加首页标题",
					"id" => $shortname."_global_title",
					"std" => "",
					"type" => "text");	

$options[] = array( "name" => "子页面标题后缀",
					"desc" => "您的子页面显示方式: '页面标题 - 后缀'.",
					"id" => $shortname."_title_suffix",
					"std" => "",
					"type" => "text");	

// Translate Options (qTranslate Plugin)
if(function_exists('qtrans_getAvailableLanguages'))
{
	$availableLanguages = qtrans_getAvailableLanguages('enabled_languages');
	if(is_array($options))
		foreach( $options as $_key => $_val )
		{
			$t_key = $_key;
			$t_val = $_val;

			if($_val['type'] == "heading" || isset($_val['trans']))
			{
				$new_options[] = $t_val;
			}
			else
			{
				foreach( $availableLanguages as $lang_key )
				{
					$_val['name'] = $t_val['name']." (".$lang_key.")";
					$_val['id'] = $t_val['id']."_".$lang_key;
					$new_options[] = $_val;
				}
			}			
		}
	
	$options = $new_options;
}

// Get the Value 
function options($name, $echo=1)
{
	$value = get_option($name);
	if(function_exists('qtrans_getLanguage'))
	{
		$lang = qtrans_getLanguage();
		$t = get_option($name.'_'.$lang);
		if(!empty($t))
		{
			$value = $t;
		}
	}
	if( $echo )
	{
		echo stripslashes($value);
	}
	else
	{
		return stripslashes($value);
	}
}

update_option('of_template',$options); 					  
update_option('of_themename',$themename);   
update_option('of_shortname',$shortname);

}
}
?>
