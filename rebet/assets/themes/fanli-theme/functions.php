<?php

include TEMPLATEPATH.'/functions/needed/dashboard.php';
include TEMPLATEPATH.'/functions/needed/menu.php';

include TEMPLATEPATH.'/functions/needed/general.php';
include TEMPLATEPATH.'/functions/needed/login.php';
include TEMPLATEPATH.'/functions/needed/useful.php';
include TEMPLATEPATH.'/functions/needed/showid.php';
include TEMPLATEPATH.'/functions/needed/seo_fields.php';
include TEMPLATEPATH.'/functions/needed/acf/advanced-custom-fields/acf.php';
include TEMPLATEPATH.'/functions/needed/acf/acf-repeater/repeater.php';
include TEMPLATEPATH.'/functions/needed/acf/acf-options-page/acf-options-page.php';
include TEMPLATEPATH.'/functions/needed/acf/acf-accordion/acf-accordion.php';
include TEMPLATEPATH.'/functions/init.php';
include TEMPLATEPATH.'/functions/init_admin.php';
include TEMPLATEPATH.'/functions/post_type.php';

include TEMPLATEPATH.'/ext/phpexcel/PHPExcel.php';
include TEMPLATEPATH.'/ext/phpexcel/PHPExcel/IOFactory.php';

// include TEMPLATEPATH.'/functions/taxonomy.php';
// include TEMPLATEPATH.'/functions/tax_meta.php';
// include TEMPLATEPATH.'/functions/widget.php';
// include TEMPLATEPATH.'/functions/pagenavi.php';
// include TEMPLATEPATH.'/functions/excerpt.php';

// include TEMPLATEPATH.'/functions/comments.php';
// include TEMPLATEPATH.'/functions/breadcrumbs.php';
// include TEMPLATEPATH.'/functions/needed/disable-updates.php';

// Activate post-thumbnails functionality and set the size
if ( function_exists( 'add_theme_support' ) ) {
	// add_theme_support( 'post-thumbnails' );
	//add_image_size( 'sample-large', 936, 240, true );
	//add_image_size( 'sample-small', 278, 78, false );
}

// add_action('wp_loaded','google_ob_start');
// function google_ob_start() {
// 	ob_start('google_cdn_replace');
// }
	
// function google_cdn_replace($html) {
// 	return str_replace('fonts.googleapis.com', 'fonts.useso.com', $html);
// 	return str_replace('ajax.googleapis.com', 'ajax.useso.com', $html);
// 	return str_replace('//ajax.googleapis.com', '//ajax.useso.com', $html);		
// }
// disable admin bar
add_filter('show_admin_bar', '__return_false');
// Get JS and CSS for Frontend
function my_enqueue_scripts_frontpage() {
	wp_enqueue_style( 'global',               get_stylesheet_uri() );
	wp_enqueue_style( 'datatable-demo',       get_stylesheet_directory_uri() . '/js/advanced-datatable/css/demo_page.css' );
	wp_enqueue_style( 'datatable-table',      get_stylesheet_directory_uri() . '/js/advanced-datatable/css/demo_table.css' );
	wp_enqueue_style( 'datatable-DT',         get_stylesheet_directory_uri() . '/js/data-tables/DT_bootstrap.css' );
	wp_enqueue_style( 'global-style',         get_stylesheet_directory_uri() . '/css/style.css' );
	wp_enqueue_style( 'global-responsive',    get_stylesheet_directory_uri() . '/css/style-responsive.css' );

	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery',              get_stylesheet_directory_uri() . '/js/jquery-1.10.2.min.js' );
	wp_enqueue_script( 'global-custom',       get_stylesheet_directory_uri() . '/js/jquery-ui-1.9.2.custom.min.js', array(), false, true );
	wp_enqueue_script( 'migrate',             get_stylesheet_directory_uri() . '/js/jquery-migrate-1.2.1.min.js', array(), false, true );
	wp_enqueue_script( 'bootstrap',           get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array(), false, true );
	wp_enqueue_script( 'modernizr',           get_stylesheet_directory_uri() . '/js/modernizr.min.js', array(), false, true );
	wp_enqueue_script( 'nicescroll',          get_stylesheet_directory_uri() . '/js/jquery.nicescroll.js', array(), false, true );

	wp_enqueue_script( 'dataTables',          get_stylesheet_directory_uri() . '/js/advanced-datatable/js/jquery.dataTables.js', array(), false, true );
	wp_enqueue_script( 'DT_bootstrap',        get_stylesheet_directory_uri() . '/js/data-tables/DT_bootstrap.js', array(), false, true );
	wp_enqueue_script( 'dynamic_table',       get_stylesheet_directory_uri() . '/js/dynamic_table_init.js', array(), false, true );

	wp_enqueue_script( 'validate',            get_stylesheet_directory_uri() . '/js/jquery.validate.min.js', array(), false, true );
	wp_enqueue_script( 'jqueryform',          get_stylesheet_directory_uri() . '/js/jquery.form.min.js', array(), false, true );
	wp_enqueue_script( 'global-scripts',      get_stylesheet_directory_uri() . '/js/scripts.js', array(), false, true );
	wp_enqueue_script( 'global',              get_stylesheet_directory_uri() . '/js/global.js', array(), false, true );

	global $wp_query;
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

	$params = array(
		'baseurl' => home_url(),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'tplurl'  => get_stylesheet_directory_uri(),
		'request_uri' => $_SERVER['REQUEST_URI'],
		'request_uri_host' => ( ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on' ) ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'],
	);
	wp_localize_script( 'global-common', 'of', $params );
	wp_localize_script( 'global', 'of', $params );

}
function my_enqueue_scripts_dashboard() {

	add_thickbox();
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'confirm-js',          get_stylesheet_directory_uri() . '/js/jquery-confirm.js', array(), false, true );
	wp_enqueue_script( 'global-form',         get_stylesheet_directory_uri() . '/js/jquery.form.min.js', array(), false, true );
	wp_enqueue_script( 'global-common',       get_stylesheet_directory_uri() . '/js/global-admin.js', array(), false, true );
	wp_enqueue_style( 'confirm-css',          get_stylesheet_directory_uri() . '/css/jquery-confirm.css' );
	wp_enqueue_style( 'common-admin-css',     get_stylesheet_directory_uri() . '/css/admin.css' );

//	$params = array(
//		'baseurl' => home_url(),
//		'ajaxurl' => admin_url( 'admin-ajax.php' ),
//		'tplurl'  => get_stylesheet_directory_uri(),
//	);
//	wp_localize_script( 'global-common', 'of', $params );

}
add_action( 'wp_enqueue_scripts', 'my_enqueue_scripts_frontpage' );
add_action( 'admin_enqueue_scripts', 'my_enqueue_scripts_dashboard' );

// Add Theme Menu
if ( STYLESHEETPATH == TEMPLATEPATH ) {
	define('OF_FILEPATH', TEMPLATEPATH);
	define('OF_DIRECTORY', get_stylesheet_directory_uri());
} else {
	define('OF_FILEPATH', STYLESHEETPATH);
	define('OF_DIRECTORY', get_stylesheet_directory_uri());
}
//require_once (OF_FILEPATH . '/admin/admin-functions.php'); // Custom functions and plugins
//require_once (OF_FILEPATH . '/admin/admin-interface.php'); // Admin Interfaces (options,framework, seo)
require_once (OF_FILEPATH . '/admin/theme-options.php'  ); // Options panel settings and custom settings
//require_once (OF_FILEPATH . '/admin/theme-functions.php'); // Theme actions based on options settings

function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	$mimes['xls'] = 'application/vnd.ms-excel';
	$mimes['xlsx'] = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
	return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function p($arr){
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}

if( function_exists('acf_add_options_sub_page') )
{
    acf_add_options_sub_page(array(
        'title' => '网站设置',
        'slug' => 'acf-options',
        'parent' => 'acf-options',
        'capability' => 'manage_options'
    ));

    acf_add_options_sub_page(array(
        'title' => '交易设置',
        'slug' => 'ssss',
        'parent' => 'acf-options',
        'capability' => 'manage_options'
    ));

    // acf_add_options_sub_page(array(
    //     'title' => '充值设置',
    //     'slug' => 'ddd',
    //     'parent' => 'acf-options',
    //     'capability' => 'manage_options'
    // ));
}

function wps_change_role_name() {
global $wp_roles;
if ( ! isset( $wp_roles ) )
$wp_roles = new WP_Roles();
//p($wp_roles);

$wp_roles->roles['administrator']['name'] = '超级管理员';
$wp_roles->role_names['administrator'] = '超级管理员';

$wp_roles->roles['subscriber']['name'] = '会员';
$wp_roles->role_names['subscriber'] = '会员';

}
add_action('init', 'wps_change_role_name');

//remove_role('subscriber');
// remove_role('editor');
// remove_role('author');
// remove_role('contributor');
// 
// 
function wp_codex_search_form() {
    global $wp_admin_bar, $wpdb;

    if ( !is_admin_bar_showing() )
        return;
    /* Add the main siteadmin menu item */
 //    $wp_admin_bar->add_menu( 
	// 	array( 
 //    		'id' => 'site_address', 
 //    		'title' => __( '作者官网', 'textdomain' ), 
 //    		'href' => 'http://wwww.kissneck.com',
 //    		'meta' => array( 
 //    			'target' => '_blank' 
 //    		)
 //    	)	
	// );

	$wp_admin_bar->add_menu( 
		array( 
    		'id' => 'pay_data', 
    		'title' => __( '激活币/消费币充值', 'textdomain' ), 
    		'href' => get_bloginfo("url").'/admin/admin.php?page=kepress-data-pay'
    	)	
	);

	// $wp_admin_bar->add_menu( 
	// 	array( 
 //    		'id' => 'pay_activedata_list', 
 //    		'title' => __( '充值记录', 'textdomain' ), 
 //    		'href' => get_bloginfo("url").'/admin/admin.php?page=kepress-data-pay'
 //    	)	
	// );

}
add_action( 'admin_bar_menu', 'wp_codex_search_form', 1000 );

// foreach( array( 'page') as $hook ){
//     add_filter( "views_edit-$hook", 'modified_views_so_15799171' );
// }

// function modified_views_so_15799171( $views ) 
// {
//     $views['all'] = str_replace( 'All ', 'Tutti ', $views['all'] );

//     if( isset( $views['publish'] ) )
//         $views['publish'] = str_replace( '已发布', '好', $views['publish'] );

//     if( isset( $views['future'] ) )
//         $views['future'] = str_replace( 'Scheduled ', 'Future ', $views['future'] );

//     if( isset( $views['draft'] ) )
//         $views['draft'] = str_replace( 'Drafts ', 'In progress ', $views['draft'] );

//     if( isset( $views['trash'] ) )
//         $views['trash'] = str_replace( 'Trash ', 'Dustbin ', $views['trash'] );

//     return $views;
// }
// 
// $result = add_role(
//     'custom_editor',
//     __( '编辑' ),
//     array(
//         'read'         => true,  // true allows this capability
//         'edit_posts'   => true,
//         'delete_posts' => false, // Use false to explicitly deny
//     )
// );
// 权限分配

add_action('admin_init','psp_add_role_caps',999);
function psp_add_role_caps() {
	//customer_service/custom_editor/administrator
	$roles = array('custom_editor');
	foreach($roles as $the_role) { 
		$role = get_role($the_role);
		//$role->add_cap( 'manage_options' );
		// $role->add_cap( 'list_users' );
		// $role->add_cap( 'edit_users' );
		// $role->add_cap( 'delete_users' );
		

		// $role->add_cap( 'read' );
		// $role->add_cap( 'read_type_usermessage');
		// $role->add_cap( 'read_private_type_usermessages' );
		// $role->add_cap( 'edit_type_usermessage' );
		// $role->add_cap( 'edit_type_usermessages' );
		// $role->add_cap( 'edit_others_type_usermessages' );
		// $role->add_cap( 'edit_published_type_usermessages' );
		// $role->add_cap( 'publish_type_usermessages' );
		// $role->add_cap( 'delete_others_type_usermessages' );
		// $role->add_cap( 'delete_private_type_usermessages' );
		// $role->add_cap( 'delete_published_type_usermessages' );
		// $role->add_cap( 'delete_type_usermessages' );

		// $role->add_cap( 'read' );
		// $role->add_cap( 'read_type_sellrecord');
		// $role->add_cap( 'read_private_type_sellrecords' );
		// $role->add_cap( 'edit_type_sellrecord' );
		// $role->add_cap( 'edit_type_sellrecords' );
		// $role->add_cap( 'edit_others_type_sellrecords' );
		// $role->add_cap( 'edit_published_type_sellrecords' );
		// $role->add_cap( 'publish_type_sellrecords' );
		// $role->add_cap( 'delete_others_type_sellrecords' );
		// $role->add_cap( 'delete_private_type_sellrecords' );
		// $role->add_cap( 'delete_published_type_sellrecords' );
		// $role->add_cap( 'delete_type_sellrecords' );

		// $role->add_cap( 'read' );
		// $role->add_cap( 'read_type_lixidetail');
		// $role->add_cap( 'read_private_type_lixidetails' );
		// $role->add_cap( 'edit_type_lixidetail' );
		// $role->add_cap( 'edit_type_lixidetails' );
		// $role->add_cap( 'edit_others_type_lixidetails' );
		// $role->add_cap( 'edit_published_type_lixidetails' );
		// $role->add_cap( 'publish_type_lixidetails' );
		// $role->add_cap( 'delete_others_type_lixidetails' );
		// $role->add_cap( 'delete_private_type_lixidetails' );
		// $role->add_cap( 'delete_published_type_lixidetails' );
		// $role->add_cap( 'delete_type_lixidetails' );

		// $role->add_cap( 'read' );
		// $role->add_cap( 'read_type_jiangjin');
		// $role->add_cap( 'read_private_type_jiangjins' );
		// $role->add_cap( 'edit_type_jiangjin' );
		// $role->add_cap( 'edit_type_jiangjins' );
		// $role->add_cap( 'edit_others_type_jiangjins' );
		// $role->add_cap( 'edit_published_type_jiangjins' );
		// $role->add_cap( 'publish_type_jiangjins' );
		// $role->add_cap( 'delete_others_type_jiangjins' );
		// $role->add_cap( 'delete_private_type_jiangjins' );
		// $role->add_cap( 'delete_published_type_jiangjins' );
		// $role->add_cap( 'delete_type_jiangjins' );

		// $role->add_cap( 'read' );
		// $role->add_cap( 'read_type_jinji');
		// $role->add_cap( 'read_private_type_jinjis' );
		// $role->add_cap( 'edit_type_jinji' );
		// $role->add_cap( 'edit_type_jinjis' );
		// $role->add_cap( 'edit_others_type_jinjis' );
		// $role->add_cap( 'edit_published_type_jinjis' );
		// $role->add_cap( 'publish_type_jinjis' );
		// $role->add_cap( 'delete_others_type_jinjis' );
		// $role->add_cap( 'delete_private_type_jinjis' );
		// $role->add_cap( 'delete_published_type_jinjis' );
		// $role->add_cap( 'delete_type_jinjis' );

		// $role->add_cap( 'read' );
		// $role->add_cap( 'read_type_jinfen');
		// $role->add_cap( 'read_private_type_jinfens' );
		// $role->add_cap( 'edit_type_jinfen' );
		// $role->add_cap( 'edit_type_jinfens' );
		// $role->add_cap( 'edit_others_type_jinfens' );
		// $role->add_cap( 'edit_published_type_jinfens' );
		// $role->add_cap( 'publish_type_jinfens' );
		// $role->add_cap( 'delete_others_type_jinfens' );
		// $role->add_cap( 'delete_private_type_jinfens' );
		// $role->add_cap( 'delete_published_type_jinfens' );
		// $role->add_cap( 'delete_type_jinfens' );

		// $role->add_cap( 'read' );
		// $role->add_cap( 'read_type_tranfer');
		// $role->add_cap( 'read_private_type_tranfers' );
		// $role->add_cap( 'edit_type_tranfer' );
		// $role->add_cap( 'edit_type_tranfers' );
		// $role->add_cap( 'edit_others_type_tranfers' );
		// $role->add_cap( 'edit_published_type_tranfers' );
		// $role->add_cap( 'publish_type_tranfers' );
		// $role->add_cap( 'delete_others_type_tranfers' );
		// $role->add_cap( 'delete_private_type_tranfers' );
		// $role->add_cap( 'delete_published_type_tranfers' );
		// $role->add_cap( 'delete_type_tranfers' );

		// $role->add_cap( 'read' );
		// $role->add_cap( 'read_type_benjin');
		// $role->add_cap( 'read_private_type_benjins' );
		// $role->add_cap( 'edit_type_benjin' );
		// $role->add_cap( 'edit_type_benjins' );
		// $role->add_cap( 'edit_others_type_benjins' );
		// $role->add_cap( 'edit_published_type_benjins' );
		// $role->add_cap( 'edit_posts' );
		// $role->add_cap( 'publish_type_benjins' );
		// $role->add_cap( 'delete_others_type_benjins' );
		// $role->add_cap( 'delete_private_type_benjins' );
		// $role->add_cap( 'delete_published_type_benjins' );
		// $role->add_cap( 'delete_type_benjins' );

		// $role->add_cap( 'read' );
		// $role->add_cap( 'read_type_tixian');
		// $role->add_cap( 'read_private_type_tixians' );
		// $role->add_cap( 'edit_type_tixian' );
		// $role->add_cap( 'edit_type_tixians' );
		// $role->add_cap( 'edit_others_type_tixians' );
		// $role->add_cap( 'edit_published_type_tixians' );
		// $role->add_cap( 'publish_type_tixians' );
		// $role->add_cap( 'delete_others_type_tixians' );
		// $role->add_cap( 'delete_private_type_tixians' );
		// $role->add_cap( 'delete_published_type_tixians' );
		// $role->add_cap( 'delete_type_tixians' );



		//删除
		// $role->remove_cap( 'read' );
		// $role->remove_cap( 'read_type_sellrecord');
		// $role->remove_cap( 'read_private_type_sellrecords' );
		// $role->remove_cap( 'edit_type_sellrecord' );
		// $role->remove_cap( 'edit_type_sellrecords' );
		// $role->remove_cap( 'edit_others_type_sellrecords' );
		// $role->remove_cap( 'edit_published_type_sellrecords' );
		// $role->remove_cap( 'publish_type_sellrecords' );
		// $role->remove_cap( 'delete_others_type_sellrecords' );
		// $role->remove_cap( 'delete_private_type_sellrecords' );
		// $role->remove_cap( 'delete_published_type_sellrecords' );

		// $role->remove_cap( 'read' );
		// $role->remove_cap( 'read_type_lixidetail');
		// $role->remove_cap( 'read_private_type_lixidetails' );
		// $role->remove_cap( 'edit_type_lixidetail' );
		// $role->remove_cap( 'edit_type_lixidetails' );
		// $role->remove_cap( 'edit_others_type_lixidetails' );
		// $role->remove_cap( 'edit_published_type_lixidetails' );
		// $role->remove_cap( 'publish_type_lixidetails' );
		// $role->remove_cap( 'delete_others_type_lixidetails' );
		// $role->remove_cap( 'delete_private_type_lixidetails' );
		// $role->remove_cap( 'delete_published_type_lixidetails' );

		// $role->remove_cap( 'read' );
		// $role->remove_cap( 'read_type_jiangjin');
		// $role->remove_cap( 'read_private_type_jiangjins' );
		// $role->remove_cap( 'edit_type_jiangjin' );
		// $role->remove_cap( 'edit_type_jiangjins' );
		// $role->remove_cap( 'edit_others_type_jiangjins' );
		// $role->remove_cap( 'edit_published_type_jiangjins' );
		// $role->remove_cap( 'publish_type_jiangjins' );
		// $role->remove_cap( 'delete_others_type_jiangjins' );
		// $role->remove_cap( 'delete_private_type_jiangjins' );
		// $role->remove_cap( 'delete_published_type_jiangjins' );

		// $role->remove_cap( 'read' );
		// $role->remove_cap( 'read_type_jinji');
		// $role->remove_cap( 'read_private_type_jinjis' );
		// $role->remove_cap( 'edit_type_jinji' );
		// $role->remove_cap( 'edit_type_jinjis' );
		// $role->remove_cap( 'edit_others_type_jinjis' );
		// $role->remove_cap( 'edit_published_type_jinjis' );
		// $role->remove_cap( 'publish_type_jinjis' );
		// $role->remove_cap( 'delete_others_type_jinjis' );
		// $role->remove_cap( 'delete_private_type_jinjis' );
		// $role->remove_cap( 'delete_published_type_jinjis' );

		// $role->remove_cap( 'read' );
		// $role->remove_cap( 'read_type_jinfen');
		// $role->remove_cap( 'read_private_type_jinfens' );
		// $role->remove_cap( 'edit_type_jinfen' );
		// $role->remove_cap( 'edit_type_jinfens' );
		// $role->remove_cap( 'edit_others_type_jinfens' );
		// $role->remove_cap( 'edit_published_type_jinfens' );
		// $role->remove_cap( 'publish_type_jinfens' );
		// $role->remove_cap( 'delete_others_type_jinfens' );
		// $role->remove_cap( 'delete_private_type_jinfens' );
		// $role->remove_cap( 'delete_published_type_jinfens' );

		// $role->remove_cap( 'read' );
		// $role->remove_cap( 'read_type_tranfer');
		// $role->remove_cap( 'read_private_type_tranfers' );
		// $role->remove_cap( 'edit_type_tranfer' );
		// $role->remove_cap( 'edit_type_tranfers' );
		// $role->remove_cap( 'edit_others_type_tranfers' );
		// $role->remove_cap( 'edit_published_type_tranfers' );
		// $role->remove_cap( 'publish_type_tranfers' );
		// $role->remove_cap( 'delete_others_type_tranfers' );
		// $role->remove_cap( 'delete_private_type_tranfers' );
		// $role->remove_cap( 'delete_published_type_tranfers' );

		// $role->remove_cap( 'read' );
		// $role->remove_cap( 'read_type_benjin');
		// $role->remove_cap( 'read_private_type_benjins' );
		// $role->remove_cap( 'edit_type_benjin' );
		// $role->remove_cap( 'edit_type_benjins' );
		// $role->remove_cap( 'edit_others_type_benjins' );
		// $role->remove_cap( 'edit_published_type_benjins' );
		// $role->remove_cap( 'edit_posts' );
		// $role->remove_cap( 'publish_type_benjins' );
		// $role->remove_cap( 'delete_others_type_benjins' );
		// $role->remove_cap( 'delete_private_type_benjins' );
		// $role->remove_cap( 'delete_published_type_benjins' );

		// $role->remove_cap( 'read' );
		// $role->remove_cap( 'read_type_tixian');
		// $role->remove_cap( 'read_private_type_tixians' );
		// $role->remove_cap( 'edit_type_tixian' );
		// $role->remove_cap( 'edit_type_tixians' );
		// $role->remove_cap( 'edit_others_type_tixians' );
		// $role->remove_cap( 'edit_published_type_tixians' );
		// $role->remove_cap( 'publish_type_tixians' );
		// $role->remove_cap( 'delete_others_type_tixians' );
		// $role->remove_cap( 'delete_private_type_tixians' );
		// $role->remove_cap( 'delete_published_type_tixians' );
	}
}


// remove_role( 'customer_service' );
function rc_my_welcome_panel() { ?>
	<script type="text/javascript">
		jQuery(document).ready( function($) {
			$('div.welcome-panel-content').hide();
		});
	</script>
	<div class="custom-welcome-panel-content">
		<h3><?php _e( '欢迎可待平台交易系统' ); ?></h3>
			<p class="about-description">独立后台程序！使用起来更加方便和快捷！</p>

		<div class="welcome-panel-column">
			<h4><?php _e( 'Next Steps' ); ?></h4>
			<ul>
				<?php if ( 'page' == get_option( 'show_on_front' ) && ! get_option( 'page_for_posts' ) ) : ?>
				<li><?php printf( '<a href="%s" class="welcome-icon welcome-edit-page">' . __( 'Edit your front page' ) . '</a>', get_edit_post_link( get_option( 'page_on_front' ) ) ); ?></li>
				<li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add additional pages' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
				<?php elseif ( 'page' == get_option( 'show_on_front' ) ) : ?>
				<li><?php printf( '<a href="%s" class="welcome-icon welcome-edit-page">' . __( 'Edit your front page' ) . '</a>', get_edit_post_link( get_option( 'page_on_front' ) ) ); ?></li>
				<li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add additional pages' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
				<li><?php printf( '<a href="%s" class="welcome-icon welcome-write-blog">' . __( 'Add a blog post' ) . '</a>', admin_url( 'post-new.php' ) ); ?></li>
				<?php else : ?>
				<li><?php printf( '<a href="%s" class="welcome-icon welcome-write-blog">' . __( 'Write your first blog post' ) . '</a>', admin_url( 'post-new.php' ) ); ?></li>
				<li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add an About page' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
				<?php endif; ?>
				<li><?php printf( '<a href="%s" class="welcome-icon welcome-view-site">' . __( 'View your site' ) . '</a>', home_url( '/' ) ); ?></li>
			</ul>
		</div>
		<div class="welcome-panel-column welcome-panel-last">
			<h4><?php _e( 'More Actions' ); ?></h4>
			<ul>
				<li><?php printf( '<div class="welcome-icon welcome-widgets-menus">' . __( 'Manage <a href="%1$s">widgets</a> or <a href="%2$s">menus</a>' ) . '</div>', admin_url( 'widgets.php' ), admin_url( 'nav-menus.php' ) ); ?></li>
				<li><?php printf( '<a href="%s" class="welcome-icon welcome-comments">' . __( 'Turn comments on or off' ) . '</a>', admin_url( 'options-discussion.php' ) ); ?></li>
				<li><?php printf( '<a href="%s" class="welcome-icon welcome-learn-more">' . __( 'Learn more about getting started' ) . '</a>', __( 'http://codex.wordpress.org/First_Steps_With_WordPress' ) ); ?></li>
			</ul>
		</div>
		<div class="">
			<h4><?php _e( 'More Actions' ); ?></h4>
			<ul>
				<li><?php printf( '<div class="welcome-icon welcome-widgets-menus">' . __( 'Manage <a href="%1$s">widgets</a> or <a href="%2$s">menus</a>' ) . '</div>', admin_url( 'widgets.php' ), admin_url( 'nav-menus.php' ) ); ?></li>
				<li><?php printf( '<a href="%s" class="welcome-icon welcome-comments">' . __( 'Turn comments on or off' ) . '</a>', admin_url( 'options-discussion.php' ) ); ?></li>
				<li><?php printf( '<a href="%s" class="welcome-icon welcome-learn-more">' . __( 'Learn more about getting started' ) . '</a>', __( 'http://codex.wordpress.org/First_Steps_With_WordPress' ) ); ?></li>
			</ul>
		</div>
	</div>
<?php
}
add_action( 'welcome_panel', 'rc_my_welcome_panel' );

function creat_database_table(){
	global $wpdb;
	$charset_collate    = $wpdb->get_charset_collate();
	$table  = 'wp_data';
	$sql = "CREATE TABLE IF NOT EXISTS `".$table."` (
			  `ID` int(10) NOT NULL AUTO_INCREMENT,
			  `name` varchar(20) NOT NULL DEFAULT '0',
			  `account` int(20) NOT NULL DEFAULT '0',
			  `code` int(20) NOT NULL DEFAULT '0',
			  `unit_price` int(20) NOT NULL DEFAULT '0',
			  `quantity` int(20) NOT NULL DEFAULT '0',
			  `price` int(20) NOT NULL DEFAULT '0',
			  `unit` int(20) NOT NULL DEFAULT '0',
			  `recommend` varchar(20) NOT NULL DEFAULT '0',
			  `recommend_account` int(20) NOT NULL DEFAULT '0',
			  PRIMARY KEY (`ID`)
			) $charset_collate";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
//creat_database_table();