<?php 
/**
 * *Template Name: 联系我们
 */
get_header(); ?>

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
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    在线留言
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="formmalert alert alert-block alert-danger fade in">
                        <strong>提示：</strong>
                    </div>
                    <div class="formmalert alert alert-block alert-success fade in">
                        <strong>提示：</strong>留言发送成功，请耐心等待回复！ 
                    </div>
                    <form method="post" role="form" action="" id="contactform" name="contactform">
                        <div class="form-group">
                            <label for="note">留言内容</label>
                            <textarea name="note" id="note" rows="6" class="form-control"></textarea>
                        </div>
                        <button  type="submit" class="form-submit btn btn-primary">提交</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <div id="contentList" class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    我的留言
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                            <thead>
                                <tr>
                                    <th>日期</th>
                                    <th>内容</th>
                                    <th>回复</th>
                                    <th>回复时间</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    global $current_user;  
                                    $args = array(
                                      'post_type'      => 'type_usermessage',
                                      'posts_per_page' => -1,
                                      'author'         => $current_user->ID
                                    );
                                    $latest_msg = get_posts( $args );
                                    foreach ($latest_msg as $key => $v) {
                                        if($key%2 == 0){ $class="gradeA"; }
                                ?>
                                        <tr class="<?php echo $class; ?>">
                                            <td> <?php echo $v->post_date; ?></td>
                                            <td> <?php echo $v->post_content; ?> </td>
                                            <td><?php echo get_post_meta( $v->ID,'replay_content',true ); ?></td>
                                            <td><?php echo get_post_meta( $v->ID,'replay_date',true ); ?></td>
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

