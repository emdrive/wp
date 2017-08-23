<!DOCTYPE html>
<!--[if lt IE 7 ]><html dir="ltr" lang="en" class="no-js ie ie6 lte7 lte8 lte9"><![endif]-->
<!--[if IE 7 ]>   <html dir="ltr" lang="en" class="no-js ie ie7 lte7 lte8 lte9"><![endif]-->
<!--[if IE 8 ]>   <html dir="ltr" lang="en" class="no-js ie ie8 lte8 lte9"><![endif]-->
<!--[if IE 9 ]>   <html dir="ltr" lang="en" class="no-js ie ie9 lte9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>>
<head>

	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />

	<?php include ( get_stylesheet_directory() . '/functions/needed/seo.php' ); ?>
	
	<!-- Only for responsive layout -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="format-detection" content="telephone=no" />

	<?php wp_head(); ?>
	<!--common-->
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="<?php echo get_bloginfo('template_url'); ?>/js/html5shiv.js"></script>
	<script src="<?php echo get_bloginfo('template_url'); ?>/js/respond.min.js"></script>
	<![endif]-->

</head>
<body class="sticky-header">
<?php $login_page = get_field('login_page','options'); checkLogin(); ?>
<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="index.html"><img src="<?php echo get_bloginfo('template_url'); ?>/images/logo.png" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="index.html"><img src="<?php echo get_bloginfo('template_url'); ?>/images/logo_icon.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!-- visible to small devices only -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <!-- <img alt="" src="<?php echo get_bloginfo('template_url'); ?>/images/photos/user-avatar.png" class="media-object"> -->
                    <div class="media-body">
                        <h4><a href="#">可待用户</a></h4>
                        <span>用户描述</span>
                    </div>
                </div>

                <h5 class="left-nav-title">用户信息</h5>
                <ul class="nav nav-pills nav-stacked custom-nav">
                  <li><a href="#"><i class="fa fa-user"></i> <span>个人资料</span></a></li>
                  <li><a href="#"><i class="fa fa-cog"></i> <span>安全中心</span></a></li>
                  <li><a href="#"><i class="fa fa-sign-out"></i> <span>退出</span></a></li>
                </ul>
            </div>
            <?php of_menu( 'main-menu', 'nav nav-pills nav-stacked custom-nav', 'main_menu_id', 2 ); ?>
            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav" style="margin-top: 0px">
                <li><a href="<?php echo wp_logout_url( $login_page ); ?>"><i class="fa fa-sign-in"></i> <span>系统登出</span></a></li>
            </ul>
            <!--sidebar nav end-->
        </div>
    </div>
    <!-- left side end-->
<!-- main content start-->
    <div class="main-content" >
    	<!-- header section start-->
        <div class="header-section">

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--toggle button end-->

            <!--notification menu start -->
            <div class="menu-right">
                <ul class="notification-menu">
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <!-- <img src="images/photos/user-avatar.png" alt="" /> -->雅各文化产权交易平台
                        </a>
                    </li>
                </ul>
            </div>
            <!--notification menu end -->
        </div>
        <!-- header section end-->
<?php
    if(is_user_logged_in()){  

        //echo '=====';
        
        get_jinji_calculate('silver_planner');  //银牌统计
        get_jinji_calculate('gold_planner');    //金牌统计
        get_jinji_calculate('diamond_planner'); //钻石统计
    }
?>
