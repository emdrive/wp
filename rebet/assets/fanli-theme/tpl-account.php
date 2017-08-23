<?php 
/***
* Template Name: 个人资料 
**/
?>
<?php get_header(); ?>
<?php 
global $current_user;
if (have_posts()) : while (have_posts()) : the_post(); ?>	
<!-- page heading start-->
<div class="page-heading">
    <h3><?php the_title(); ?></h3>
    <ul class="breadcrumb">
        <li>
            <a href="#">控制面板</a>
        </li>
        <li class="active"><?php the_title(); ?></li>
    </ul>
</div>
<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    我的资料
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <?php  
                        $uid = $current_user->ID;
                        $phone = get_user_meta($uid,'phone',true); if($phone == ''){ $phone = '暂无'; }

                        $user_level = get_user_meta($uid,'wp_user_level',true); 
                        if($user_level == 0){ 
                            $user_level = '普通会员'; 
                        }else if( $user_level == 1 ){
                            $user_level = '银牌理财师';
                        }else if( $user_level == 2 ){
                            $user_level = '金牌理财师';
                        }else if( $user_level == 3 ){
                            $user_level = '钻石理财师';
                        }

                        $user_level_1 = get_user_meta($uid,'level_1',true);
                        $user_level_2 = get_user_meta($uid,'level_2',true); 
                        $user_level_3 = get_user_meta($uid,'level_3',true); 
                        $user_level_4 = get_user_meta($uid,'level_4',true); 

                        $user = get_user_by( 'id', $uid );
                        $userStatus = $user->user_status; 
                        $username   = $user->user_login;
                        $registtime = $user->user_registered;
                        $user_recommend = get_user_meta($uid,'tuijian',true);
                        $tjuser         = get_user_by( 'id', $user_recommend );
                        $tuiijanname    = $tjuser->user_login;
                        if(empty($tuiijanname)){ $tuiijanname = '暂无'; }
                    ?>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>用户状态</td>
                                <td>
                                    <?php  
                                        if($userStatus == 0 && $tuiijanname != "暂无"){
                                    ?>
                                        <span class="label label-danger label-mini">未激活</span>
                                    <?php }else{ ?>
                                        <span class="label label-success label-mini">正常</span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>用户名</td>
                                <td><?php echo $username; ?></td>
                            </tr>
                            <tr>
                                <td>手机号</td>
                                <td><?php echo $phone; ?></td>
                            </tr>
                            <tr>
                                <td>一级直推</td>
                                <td>
                                <?php
                                    if($user_level_1 != 0){
                                        echo sizeof(explode(',',$user_level_1)).' 人'; 
                                    }else{
                                        echo '0 人';
                                    }    
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td>二级直推</td>
                                <td>
                                <?php
                                    if($user_level_2 != 0){
                                        echo sizeof(explode(',',$user_level_2)).' 人'; 
                                    }else{
                                        echo '0 人';
                                    }    
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td>三级直推</td>
                                <td>
                                <?php
                                    if($user_level_3 != 0){
                                        echo sizeof(explode(',',$user_level_3)).' 人'; 
                                    }else{
                                        echo '0 人';
                                    }    
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td>四级直推</td>
                                <td>
                                <?php
                                    if($user_level_4 != 0){
                                        echo sizeof(explode(',',$user_level_4)).' 人'; 
                                    }else{
                                        echo '0 人';
                                    }    
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td>理财师等级</td>
                                <td><?php echo $user_level; ?></td>
                            </tr>
                            <tr>
                                <td>推荐人</td>
                                <td><?php echo $tuiijanname; ?></td>
                            </tr>
                            <tr>
                                <td>注册日期</td>
                                <td><?php echo $registtime; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>
<!--body wrapper end-->
<!--body wrapper end-->
<?php endwhile; else: ?>
<?php  endif; ?>
<?php rewind_posts(); ?>
<?php get_footer(); ?>


