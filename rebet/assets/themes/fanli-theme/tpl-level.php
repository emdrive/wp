<?php 
/***
* Template Name: 推荐谱系 
**/
?>
<?php get_header(); ?>
<?php 
if (have_posts()) : while (have_posts()) : the_post(); 
global $current_user;
$uid = $current_user->ID;
$user_level_1 = get_user_meta($uid,'level_1',true);
$user_level_2 = get_user_meta($uid,'level_2',true); 
$user_level_3 = get_user_meta($uid,'level_3',true); 
$user_level_4 = get_user_meta($uid,'level_4',true);
?>	
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
<!-- page heading end-->
<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    谱系列表
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                            <thead>
                                <tr>
                                    <th>状态</th>
                                    <th>用户名</th>
                                    <th>手机号</th>
                                    <th>理财师等级</th>
                                    <th>一级直推人数</th>
                                    <th>团段人数</th>
                                    <th>首次消费</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="gradeX">
                                    <td><span class="label label-success label-mini">正常</span></td>
                                    <td>InternetExplorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>Trident</td>
                                    <td>InternetExplorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>InternetExplorer 4.0</td>
                                </tr>
                                <tr class="gradeX">
                                    <td>--<span class="label label-success label-mini">正常</span></td>
                                    <td>InternetExplorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>Trident</td>
                                    <td>InternetExplorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>InternetExplorer 4.0</td>
                                </tr>
                                <tr class="gradeX">
                                    <td>-<span class="label label-success label-mini">正常</span></td>
                                    <td>InternetExplorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>Trident</td>
                                    <td>InternetExplorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>InternetExplorer 4.0</td>
                                </tr>
                                <tr class="gradeX">
                                    <td>---<span class="label label-success label-mini">正常</span></td>
                                    <td>InternetExplorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>Trident</td>
                                    <td>InternetExplorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>InternetExplorer 4.0</td>
                                </tr>
                                <tr class="gradeX">
                                    <td><span class="label label-success label-mini">正常</span></td>
                                    <td>InternetExplorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>Trident</td>
                                    <td>InternetExplorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>InternetExplorer 4.0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!--body wrapper end-->
<?php endwhile; else: ?>
<?php  endif; ?>
<?php rewind_posts(); ?>
<?php get_footer(); ?>


