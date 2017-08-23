<?php

// Define New Post Type
add_action( 'init', 'create_post_type' );
function create_post_type() {

	register_post_type( 'type_usermessage', array(
		'labels' => array(
			'name' => __( '用户反馈' ),
			'singular_name' => __( '用户反馈' ),
			'add_new_item' => __( '添加用户反馈' ),
			'add_new'     => __( '添加用户反馈' ),
			'edit_item' => __( '编辑用户反馈' ),
			'new_item' => __( '显示用户反馈' ),
			'view_item' => __( '显示用户反馈' ),
			'search_items' => __( '搜索用户反馈' ),
			'parent_item_colon' => __( '父级用户反馈' ),
			'not_found' => __( 'Not Found' ),
		),
		'capability_type' => array('type_usermessage','type_usermessages'),
		'capabilities' => array(
	    	'create_posts' => 'do_not_allow', // false < WP 4.5, credit @Ewout
	 	),
		'map_meta_cap' => true, // Set to `false`, if users are not allowed to edit/delete existing posts
		'menu_position' => 2,
		'menu_icon' =>'dashicons-groups', 
		'public'  => false,
		'show_ui' => true,
		'has_archive' => true,
		'hierarchical' => false, // Whether the post type is hierarchical. Allows Parent to be specified
		'rewrite' => array( 'slug' => 'user-message' ),
		'supports' => array( 'title' )
	) );

	register_post_type( 'type_sellrecord', array(
		'labels' => array(
			'name' => __( '消费管理' ),
			'singular_name' => __( '消费管理' ),
			'add_new_item' => __( '添加消费管理' ),
			'add_new'     => __( '添加消费管理' ),
			'edit_item' => __( '编辑消费管理' ),
			'new_item' => __( '显示消费管理' ),
			'view_item' => __( '显示消费管理' ),
			'search_items' => __( '搜索消费金额' ),
			'parent_item_colon' => __( '父级消费管理' ),
			'not_found' => __( 'Not Found' ),
		),
		'capability_type' => array('type_sellrecord','type_sellrecords'),
		'capabilities' => array(
		   	'create_posts' => 'do_not_allow', // false < WP 4.5, credit @Ewout
		),
		'map_meta_cap' => true, // Set to `false`, if users are not allowed to edit/delete existing posts
		'menu_position' => 3,
		'menu_icon' =>'dashicons-cart', 
		'public'  => false,
		'show_ui' => true,
		'has_archive' => true,
		'hierarchical' => false, // Whether the post type is hierarchical. Allows Parent to be specified
		'rewrite' => array( 'slug' => 'sell-record' ),
		'supports' => array( 'title' )
	) );


	register_post_type( 'type_lixidetail', array(
		'labels' => array(
			'name' => __( '利息管理' ),
			'singular_name' => __( '利息管理' ),
			'add_new_item' => __( '添加利息管理' ),
			'add_new'     => __( '添加利息管理' ),
			'edit_item' => __( '编辑利息管理' ),
			'new_item' => __( '显示利息管理' ),
			'view_item' => __( '显示利息管理' ),
			'search_items' => __( '搜索利息金额' ),
			'parent_item_colon' => __( '父级利息管理' ),
			'not_found' => __( 'Not Found' ),
		),
		'capability_type' => array('type_lixidetail','type_lixidetails'),
		  	'capabilities' => array(
		    	'create_posts' => 'do_not_allow', // false < WP 4.5, credit @Ewout
		),
		'map_meta_cap' => true, // Set to `false`, if users are not allowed to edit/delete existing posts
		'menu_position' => 3,
		'menu_icon' => 'dashicons-media-spreadsheet',
		'public'  => false,
		'show_ui' => true,
		'has_archive' => true,
		'hierarchical' => false, // Whether the post type is hierarchical. Allows Parent to be specified
		'rewrite' => array( 'slug' => 'show-lixi' ),
		'supports' => array( 'title' )
	) );


	register_post_type( 'type_jiangjin', array(
		'labels' => array(
			'name' => __( '奖金管理' ),
			'singular_name' => __( '奖金管理' ),
			'add_new_item' => __( '添加奖金管理' ),
			'add_new'     => __( '添加奖金管理' ),
			'edit_item' => __( '编辑奖金管理' ),
			'new_item' => __( '显示奖金管理' ),
			'view_item' => __( '显示奖金管理' ),
			'search_item' => __( '搜索奖金管理' ),
			'parent_item_colon' => __( '父级奖金管理' ),
			'not_found' => __( 'Not Found' ),
		),
		'capability_type' => array('type_jiangjin','type_jiangjins'),
		  	'capabilities' => array(
		    	'create_posts' => 'do_not_allow', // false < WP 4.5, credit @Ewout
		),
		'map_meta_cap' => true, // Set to `false`, if users are not allowed to edit/delete existing posts
		'menu_position' => 3,
		'menu_icon' => 'dashicons-welcome-write-blog',
		'public'  => false,
		'show_ui' => true,
		'has_archive' => true,
		'hierarchical' => false, // Whether the post type is hierarchical. Allows Parent to be specified
		'rewrite' => array( 'slug' => 'show-jiangjin' ),
		'supports' => array( 'title' )
	) );


	register_post_type( 'type_jinji', array(
		'labels' => array(
			'name' => __( '晋级管理' ),
			'singular_name' => __( '晋级管理' ),
			'add_new_item' => __( '添加晋级管理' ),
			'add_new'     => __( '添加晋级管理' ),
			'edit_item' => __( '编辑晋级管理' ),
			'new_item' => __( '显示晋级管理' ),
			'view_item' => __( '显示晋级管理' ),
			'search_item' => __( '搜索晋级管理' ),
			'parent_item_colon' => __( '父级晋级管理' ),
			'not_found' => __( 'Not Found' ),
		),
		'capability_type' => array('type_jinji','type_jinjis'),
		  	'capabilities' => array(
		    	'create_posts' => 'do_not_allow', // false < WP 4.5, credit @Ewout
		),
		'map_meta_cap' => true, // Set to `false`, if users are not allowed to edit/delete existing posts
		'menu_position' => 3,
		'menu_icon' => 'dashicons-welcome-write-blog',
		'public'  => false,
		'show_ui' => true,
		'has_archive' => true,
		'hierarchical' => false, // Whether the post type is hierarchical. Allows Parent to be specified
		'rewrite' => array( 'slug' => 'show-jinji' ),
		'supports' => array( 'title' )
	) );

	register_post_type( 'type_jinfen', array(
		'labels' => array(
			'name' => __( '积分管理' ),
			'singular_name' => __( '积分管理' ),
			'add_new_item' => __( '添加积分管理' ),
			'add_new'     => __( '添加积分管理' ),
			'edit_item' => __( '编辑积分管理' ),
			'new_item' => __( '显示积分管理' ),
			'view_item' => __( '显示积分管理' ),
			'search_items' => __( '搜索积分金额' ),
			'parent_item_colon' => __( '父级积分管理' ),
			'not_found' => __( 'Not Found' ),
		),
		'capability_type' => array('type_jinfen','type_jinfens'),
		  	'capabilities' => array(
		    	'create_posts' => 'do_not_allow', // false < WP 4.5, credit @Ewout
		),
		'map_meta_cap' => true, // Set to `false`, if users are not allowed to edit/delete existing posts
		'menu_position' => 3,
		'menu_icon' => 'dashicons-welcome-write-blog',
		'public'  => false,
		'show_ui' => true,
		'has_archive' => true,
		'hierarchical' => false, // Whether the post type is hierarchical. Allows Parent to be specified
		'rewrite' => array( 'slug' => 'show-jifen' ),
		'supports' => array( 'title' )
	) );

	register_post_type( 'type_tranfer', array(
		'labels' => array(
			'name' => __( '转账管理' ),
			'singular_name' => __( '转账管理' ),
			'add_new_item' => __( '添加转账管理' ),
			'add_new'     => __( '添加转账管理' ),
			'edit_item' => __( '编辑转账管理' ),
			'new_item' => __( '显示转账管理' ),
			'view_item' => __( '显示转账管理' ),
			'search_items' => __( '搜索转账金额' ),
			'parent_item_colon' => __( '父级转账管理' ),
			'not_found' => __( 'Not Found' ),
		),
		'capability_type' => array('type_tranfer','type_tranfers'),
		'capabilities' => array(
	    	'create_posts'       => 'do_not_allow' // false < WP 4.5, credit @Ewout
		),
		'map_meta_cap' => true, // Set to `false`, if users are not allowed to edit/delete existing posts
		'menu_position' => 3,
		'menu_icon' => 'dashicons-welcome-write-blog',
		'public'  => false,
		'show_ui' => true,
		'has_archive' => true,
		'hierarchical' => false, // Whether the post type is hierarchical. Allows Parent to be specified
		'rewrite' => array( 'slug' => 'show-tranfer' ),
		'supports' => array( 'title' )
	) );

	register_post_type( 'type_benjin', array(
		'labels' => array(
			'name' => __( '本金管理' ),
			'singular_name' => __( '本金管理' ),
			'add_new_item' => __( '添加本金管理' ),
			'add_new'     => __( '添加本金管理' ),
			'edit_item' => __( '编辑本金管理' ),
			'new_item' => __( '显示本金管理' ),
			'view_item' => __( '显示本金管理' ),
			'search_items' => __( '搜索金额' ),
			'parent_item_colon' => __( '父级本金管理' ),
			'not_found' => __( 'Not Found' ),
		),
		'capability_type' => array('type_benjin','type_benjins'),
		'capabilities' => array(
			'create_posts' => 'do_not_allow', // false < WP 4.5, credit @Ewout
		),
		'map_meta_cap' => true, // Set to `false`, if users are not allowed to edit/delete existing posts
		'menu_position' => 3,
		'menu_icon' => 'dashicons-welcome-write-blog',
		'public'  => false,
		'show_ui' => true,
		'has_archive' => true,
		'hierarchical' => false, // Whether the post type is hierarchical. Allows Parent to be specified
		'rewrite' => array( 'slug' => 'show-benjin' ),
		'supports' => array( 'title' )
	) );

	register_post_type( 'type_tixian', array(
		'labels' => array(
			'name' => __( '提现管理' ),
			'singular_name' => __( '提现管理' ),
			'add_new_item' => __( '添加提现管理' ),
			'add_new'     => __( '添加提现管理' ),
			'edit_item' => __( '编辑提现管理' ),
			'new_item' => __( '显示提现管理' ),
			'view_item' => __( '显示提现管理' ),
			'search_item' => __( '搜索提现管理' ),
			'parent_item_colon' => __( '父级提现管理' ),
			'not_found' => __( 'Not Found' ),
		),
		'capability_type' => array('type_tixian','type_tixians'),
		'capabilities' => array(
			'create_posts' => 'do_not_allow',
		),
		'map_meta_cap' => true, // Set to `false`, if users are not allowed to edit/delete existing posts
		'menu_position' => 3,
		'menu_icon' => 'dashicons-welcome-write-blog',
		'public'  => false,
		'show_ui' => true,
		'has_archive' => true,
		'hierarchical' => false, // Whether the post type is hierarchical. Allows Parent to be specified
		'rewrite' => array( 'slug' => 'show-tixian' ),
		'supports' => array( 'title' )
	) );

}


//    5 - below Posts
//    10 - below Media
//    15 - below Links
//    20 - below Pages
//    25 - below comments
//    60 - below first separator
//    65 - below Plugins
//    70 - below Users
//    75 - below Tools
//    80 - below Settings
//    100 - below second separator 
//

//////supports

//    'title'
//    'editor' (content)
//    'author'
//    'thumbnail' (featured image, current theme must also support post-thumbnails)
//    'excerpt'
//    'trackbacks'
//    'custom-fields'
//    'comments' (also will see comment count balloon on edit screen)
//    'revisions' (will store revisions)
//    'page-attributes' (menu order, hierarchical must be true to show Parent option)
//    'post-formats' add post formats, see Post Formats 

