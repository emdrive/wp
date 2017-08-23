<?php 
/***
* Template Name: 消费转账 
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
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    激活币/消费币转账
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="alert alert-block alert-warning fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>提示：</strong>用户激活至少需要激活币 <?php echo get_field('active_xiaofeibi','options'); ?> 个
                    </div>
                    <div class="formmalert alert alert-block alert-danger fade in">
                        <strong>提示：</strong>
                    </div>
                    <div class="formmalert alert alert-block alert-success fade in">
                        <strong>提示：</strong>转账成功！ 
                    </div>
                    <form role="form" name="account_tranfer" id="account_tranfer" action="" method="post">
                        <div class="form-group">
                            <label for="price">接收人</label>
                            <input name="username" class="form-control" value="" id="username" placeholder="请填写会员号" type="text">
                        </div>
                        <div class="form-group">
                            <label for="price_type">类型</label>
                            <div class="radio">
                                <input type="radio" value="xiaofeibi" name="price_type">    
                                <label>消费币</label>
                            </div>
                            <div class="radio">
                                <input type="radio" value="jihuobi" name="price_type">    
                                <label>激活币</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="number">数量</label>
                            <input name="number" class="form-control" id="number" placeholder="请填写数量" type="text">
                        </div>
                        <div class="form-group">
                            <label for="note">备注</label>
                            <textarea name="note" id="note" rows="6" class="form-control"></textarea>
                        </div>
                        <button <?php userStatusActive(); ?> type="submit" class="btn tranfer-submit btn-primary">确认转账</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <a role="button" href="<?php echo get_permalink($post->ID); ?>" class="btn btn-<?php if(empty($_GET['type'])){ echo 'default'; }else{ echo 'primary'; } ?>">消费币记录</a>
                <a role="button" href="<?php echo get_permalink($post->ID); ?>?type=2" class="btn btn-<?php if($_GET['type']==2){ echo 'default'; }else{ echo 'primary'; } ?>">激活币记录</a>
            </div>
        </div>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    <?php  
                        if($_GET['type'] == 2){ echo "激活币记录"; }else{ echo "消费币记录"; }
                    ?>
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                            <thead>
                                <tr>
                                    <th>发起人</th>
                                    <th>接收人</th>
                                    <th>数量</th>
                                    <th>备注</th>
                                    <th>日期</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    global $current_user; 
                                    if($_GET['type'] == 2){
                                        $type = 'jihuobi';
                                    }else{
                                        $type = 'xiaofeibi';
                                    } 
                                    $args = array(
                                      'post_type'      => 'type_tranfer',
                                      'posts_per_page' => -1,
                                      'meta_key'       => 'price_type',
                                      'meta_value'     => $type,
                                      'author'         => $current_user->ID
                                    );
                                    $latest_msg = get_posts( $args );
                                    foreach ($latest_msg as $key => $v) {
                                        if($key%2 == 0){ $class="gradeA"; }
                                        $to_number  = get_post_meta($v->ID,'to_number',true);
                                        $price_type  = get_post_meta($v->ID,'price_type',true);
                                        if(empty($v->post_content)){ $v->post_content = '无'; }
                                        $user  = get_user_by('id',$v->post_author);
                                ?>
                                        <tr class="<?php echo $class; ?>">
                                            <td><?php echo $user->user_login; ?></td>
                                            <td><?php echo $v->post_title; ?></td>
                                            <td><?php echo $to_number; ?></td>
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


