<?php

// Remove default widgets
function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_activity']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	remove_meta_box( 'dashboard_activity', 'dashboard', 'side' );
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );



// Remove Admin Menu
function remove_menus () {
	global $menu;
	$restricted = array( __('Posts'), __('Links'), __('Comments'), __('Tools') );
	end ($menu);
	while ( prev($menu) ) {
		$value = explode( ' ',$menu[key($menu)][0] );
		if( in_array( $value[0] != NULL ? $value[0] : '', $restricted ) ) { unset( $menu[key($menu)] ); }
	}
}
//add_action('admin_menu', 'remove_menus');

// Hide Welcome Panel
function hide_welcome_panel() {
	$user_id = get_current_user_id();
	if ( 1 == get_user_meta( $user_id, 'show_welcome_panel', true ) )
		update_user_meta( $user_id, 'show_welcome_panel', 0 );
}
add_action( 'load-index.php', 'hide_welcome_panel' );

// Remove Sub Menu
function remove_submenu() {
	remove_submenu_page( 'options-general.php', 'options-privacy.php' );  // main-menu-slug, sub-menu-sug
	remove_submenu_page( 'themes.php', 'widgets.php' );
}
//add_action('admin_init','remove_submenu');

function as_remove_menus () {
		global $submenu;
        unset($submenu['themes.php'][6]); // Customize
}
//add_action('admin_menu', 'as_remove_menus');
//
function remove_menus_2(){
  
  //remove_menu_page( 'index.php' );                  //Dashboard
  remove_menu_page( 'edit.php' );                   //Posts
  remove_menu_page( 'upload.php' );                 //Media
  remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page( 'edit-comments.php' );          //Comments
  remove_menu_page( 'themes.php' );                 //Appearance
  remove_menu_page( 'plugins.php' );                //Plugins
  //remove_menu_page( 'users.php' );                  //Users
  remove_menu_page( 'tools.php' );                  //Tools
  remove_menu_page( 'options-general.php' );        //Settings
  
}
add_action( 'admin_menu', 'remove_menus_2' );


//  Remove Post Edit Page Blocks
function customize_meta_boxes() {
	//remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
    //remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
	// remove_meta_box('categorydiv','post','normal');
	// remove_meta_box('tagsdiv-post_tag','post','normal');
	// remove_meta_box('slugdiv','post','normal');
	remove_meta_box('postimagediv','post','normal');
	remove_meta_box('postexcerpt','post','normal');
	remove_meta_box('formatdiv','post','normal');
	remove_meta_box('trackbacksdiv','post','normal');
	remove_meta_box('postcustom','post','normal');
	// remove_meta_box('commentstatusdiv','post','normal');
	// remove_meta_box('commentsdiv','post','normal');
	remove_meta_box('authordiv','post','normal');
	// remove_meta_box('revisionsdiv','post','normal');

	// remove_meta_box('slugdiv','page','normal');
	remove_meta_box('postimagediv','page','normal');
	remove_meta_box('postexcerpt','page','normal');
	remove_meta_box('formatdiv','page','normal');
	remove_meta_box('trackbacksdiv','page','normal');
	remove_meta_box('postcustom','page','normal');
	remove_meta_box('commentstatusdiv','page','normal');
	remove_meta_box('commentsdiv','page','normal');
	remove_meta_box('authordiv','page','normal');
	remove_meta_box('revisionsdiv','page','normal');
}
add_action('admin_init','customize_meta_boxes');

// Remove Items from the Post and Page Columns
function custom_post_columns($defaults) {
	unset($defaults['comments']);
	unset($defaults['tags']);
	return $defaults;
}
function custom_pages_columns($defaults) {
	unset($defaults['comments']);
	return $defaults;
}
add_filter('manage_posts_columns', 'custom_post_columns');
add_filter('manage_pages_columns', 'custom_pages_columns');

// add post type class to body admin
function sld_admin_body_class( $classes ) {
	global $wpdb, $post;
	$post_type = get_post_type( $post->ID );
	if ( is_admin() ) {
		$classes .= 'type-' . $post_type;
	}
	return $classes;
}
add_filter( 'admin_body_class', 'sld_admin_body_class' );

// Make large size be selected by default in media upload window
function make_full_size_be_selected_by_default(){
	update_option('image_default_size', 'full');
}
add_action( 'after_setup_theme', 'make_full_size_be_selected_by_default' ); 

// Clear Header
function clear_header() {
	global $current_user;
   $user_roles = $current_user->roles;
   $user_role = array_shift($user_roles);
   if($user_role == "customer_service" || $user_role == "custom_editor"){ 
   	echo '<style type="text/css" media="screen"> #toplevel_page_acf-options,#acf-active_user{ display:none; } </style>';
   }
   if( $user_role == "customer_service" ){ 
   	echo '<style type="text/css" media="screen"> .bulkactions{ display:none; } </style>';
   }
	echo '
	<style type="text/css" media="screen">
		#dashboard_activity,
		#wp-admin-bar-wp-logo,
		#wp-admin-bar-comments,
		#wp-admin-bar-new-content,
		#wp-admin-bar-updates,
		#contextual-help-link-wrap{
			display: none;
		}
		#wpfooter { display:none; }
	</style>';
}
/*
.type-post .inline-edit-categories,.type-post .inline-edit-tags,.type-post .inline-edit-tags,
		.type-post .inline-edit-col-right input[type=checkbox],
		.type-post .inline-edit-col-right .checkbox-title,
		.type-post .inline-edit-col-left .inline-edit-group
		{ display: none; }
		#posts-filter .tablenav select[name=cat]{
			display:none;
		}
*/
add_action( 'admin_head', 'clear_header' );

// Custom css
function custom_css() {
//.bulkactions,
	echo '
	<style type="text/css" media="screen">
		 
		 #postimagediv,#your-profile h3,#toplevel_page_kepress-data-pay,#toplevel_page_wp-hide,#menu-dashboard ul{
			display: none;
		 }
		 .users-php .bulkactions { display:block; }
		  #toplevel_page_edit-post_type-acf{
			display: none;
		 } 
		 /*li.menu-icon-settings ul li:last-child { display:none; }*/
	</style>';
}
add_action( 'admin_head', 'custom_css' );

// Custom javascript
function of_javascript(){
	echo 
	'<script type="text/javascript">
		jQuery(document).ready( function() {
			jQuery("table.wp-list-table a.row-title").contents().unwrap();
		} )
	</script>';
}
add_action('admin_head', 'of_javascript');

add_filter( 'all_plugins', 'hide_plugins');
function hide_plugins($plugins){
		// unset( $plugins['advanced-custom-fields/acf.php'] );
		// unset( $plugins['acf-repeater/acf-repeater.php'] );
		// unset( $plugins['acf-options-page/acf-options-page.php'] );
	unset( $plugins['admin-menu-editor-pro/menu-editor.php'] );
	return $plugins;
}

add_filter( 'post_row_actions', 'remove_row_actions', 10, 1 );
function remove_row_actions( $actions ){
    if( get_post_type() === 'type_usermessage' || get_post_type() == 'type_sellrecord' || get_post_type() == 'type_lixidetail'
    	|| get_post_type() == 'type_jinfen' || get_post_type() == 'type_tranfer' 
     ):
        unset( $actions['view'] );
    	unset( $actions['edit'] );
    	unset( $actions['inline hide-if-no-js'] );
    	//unset( $actions['trash'] );
    // elseif(get_post_type() === 'type_member' || get_post_type() === 'type_artist'):
    // 	unset( $actions['view'] );
    // 	unset( $actions['edit'] );
    // 	unset( $actions['inline hide-if-no-js'] );
    // 	unset( $actions['trash'] );
    // elseif(get_post_type() === 'type_work'):
    // 	unset( $actions['view'] );
    // 	unset( $actions['edit'] );
    // 	unset( $actions['inline hide-if-no-js'] );
    // 	unset( $actions['trash'] );
    elseif(get_post_type() === 'type_benjin'):
    	unset( $actions['view'] );
    	unset( $actions['edit'] );
    	unset( $actions['inline hide-if-no-js'] );
    	//unset( $actions['trash'] );
    endif;
    return $actions;
}

function my_custom_bulk_actions($actions){
        unset( $actions['edit'] );
        unset( $actions['trash'] );
        return $actions;
}
//add_filter('bulk_actions-edit-type_member','my_custom_bulk_actions');
//add_filter('bulk_actions-edit-type_artist','my_custom_bulk_actions');
//
//
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

function remove_personal_options(){
    echo '<script type="text/javascript">jQuery(document).ready(function($) {
  
$(\'form#your-profile > h2:first\').remove(); // remove the "Personal Options" title
  
$(\'form#your-profile tr.user-rich-editing-wrap\').remove(); // remove the "Visual Editor" field
  
$(\'form#your-profile tr.user-admin-color-wrap\').remove(); // remove the "Admin Color Scheme" field
  
$(\'form#your-profile tr.user-comment-shortcuts-wrap\').remove(); // remove the "Keyboard Shortcuts" field
  
$(\'form#your-profile tr.user-admin-bar-front-wrap\').remove(); // remove the "Toolbar" field
  
$(\'form#your-profile tr.user-language-wrap\').remove(); // remove the "Language" field
  
$(\'form#your-profile tr.user-first-name-wrap\').remove(); // remove the "First Name" field
  
$(\'form#your-profile tr.user-last-name-wrap\').remove(); // remove the "Last Name" field
  
//$(\'form#your-profile tr.user-nickname-wrap\').remove(); // remove the "nickname" field

//$(\'form#your-profile tr.user-email-wrap\').remove(); // remove the "email" field

$(\'form#your-profile tr.user-sessions-wrap\').remove(); // remove the "session" field
  
$(\'table.form-table tr.user-display-name-wrap\').remove(); // remove the “Display name publicly as” field
  
$(\'table.form-table tr.user-url-wrap\').remove();// remove the "Website" field in the "Contact Info" section
  
$(\'form#your-profile > h2\').remove();
  
$(\'form#your-profile tr.user-description-wrap\').remove(); // remove the "Biographical Info" field
  
$(\'form#your-profile tr.user-profile-picture\').remove(); // remove the "Profile Picture" field
  
});</script>';
  
}
  
add_action('admin_head','remove_personal_options');
