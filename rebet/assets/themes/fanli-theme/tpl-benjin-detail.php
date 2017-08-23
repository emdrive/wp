<?php 
/***
* Template Name: 本金记录 
**/
?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
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
        <div class="col-sm-6">
            <section class="panel">
                <header class="panel-heading">本金充值</header>
                <div class="panel-body">
                    <div class="formmalert alert alert-block alert-danger fade in">
                        <strong>提示：</strong>
                    </div>
                    <div class="formmalert alert alert-block alert-success fade in">
                        <strong>提示：</strong>充值成功！ 
                    </div>
                    <form role="form" id="pay_form" action="" method="post" name="pay_form">
                        <div class="form-group">
                            <label for="price">充值金额</label>
                            <input name="price" class="form-control" id="price" placeholder="请填写充值金额" type="text">
                        </div>
<!--                         <div class="form-group">
                            <label for="exampleInputFile">上传凭证</label>
                            <input id="exampleInputFile" type="file">
                            <p class="help-block">请上传您的充值凭证</p>
                        </div> -->
                        <div class="form-group">
                            <label for="note">备注</label>
                            <textarea name="note" rows="6" class="form-control"></textarea>
                        </div>
                        <button <?php userStatusActive(); ?> type="submit" class="pay-submit btn btn-primary">确认充值</button>
                    </form>
                </div>
            </section>
        </div>
        <div class="col-sm-6">
            <section class="panel" style="padding-bottom: 172px;">
                <header class="panel-heading">
                    相关信息
                </header>
                <div class="panel-body" style="padding-bottom: 25px;">
                    <div class="well">
                        <address>
                            支持第三方充值的有贝宝
                        </address>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    本金记录
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
                                    <!-- <th>类型</th> -->
                                    <th>金额</th>
                                    <!-- <th>凭证</th> -->
                                    <th>备注</th>
                                    <th>日期</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    global $current_user;  
                                    $args = array(
                                      'post_type'      => 'type_benjin',
                                      'posts_per_page' => -1,
                                      'author'         => $current_user->ID
                                    );
                                    $latest_msg = get_posts( $args );
                                    foreach ($latest_msg as $key => $v) {
                                        if($key%2 == 0){ $class="gradeA"; }
                                        $pay_status  = get_post_meta($v->ID,'pay_status',true); 
                                        if($pay_status == 0){  $pay_status = "审核中"; }else{ $pay_status = "通过"; }
                                ?>
                                    <tr class="<?php echo $class; ?>">
                                        <td><?php echo $pay_status; ?></td>
                                        <td><?php echo $v->post_title; ?></td>
                                        <td><?php echo $v->post_content; ?></td>
                                        <td><?php echo $v->post_date; ?></td>
                                    </tr>
                                <?php } ?>
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


