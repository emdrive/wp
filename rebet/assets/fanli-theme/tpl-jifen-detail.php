<?php 
/***
* Template Name: 积分明细 
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
                    转移到积分
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="formmalert alert alert-block alert-danger fade in">
                        <strong>提示：</strong>
                    </div>
                    <div class="formmalert alert alert-block alert-success fade in">
                        <strong>提示：</strong>转移成功！ 
                    </div>
                    <form role="form" name="movejifen" action="" method="post" id="movejifen">
                        <div class="form-group">
                            <label for="tranfer_source">转移来源</label>
                            <select name="tranfer_source" id="tranfer_source" autocomplete="off" class="form-control">
                                <option value="lixi">利息</option>
                                <option value="jiangjin">奖金</option>
                                <option value="jinjijiangjin">晋级奖金</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">金额</label>
                            <input autocomplete="off" name="move_price" class="form-control" id="move_price" placeholder="请输入金额" type="text">
                        </div>
                        <div class="form-group">
                            <label for="secpsw">二级密码</label>
                            <input autocomplete="off" name="secpsw" class="form-control" id="secpsw" placeholder="请填写二级密码" type="password">
                        </div>
                        <div class="form-group">
                            <label for="note">备注</label>
                            <textarea name="note" rows="6" class="form-control"></textarea>
                        </div>
                        <button <?php userStatusActive(); ?> type="submit" class="move-submit btn btn-primary">确认转移</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    积分明细
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                            <thead>
                                <tr>
                                    <th>金额</th>
                                    <th>类型</th>
                                    <th>备注</th>
                                    <th>日期</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    global $current_user; 
                                    $args = array(
                                      'post_type'      => 'type_jinfen',
                                      'posts_per_page' => -1,
                                      'author'         => $current_user->ID
                                    );
                                    $latest_msg = get_posts( $args );
                                    foreach ($latest_msg as $key => $v) {
                                        if($key%2 == 0){ $class="gradeA"; }
                                        $tranfer_source  = get_post_meta($v->ID,'tranfer_source',true);
                                        if($tranfer_source == "lixi"){
                                            $type = '利息';   //利息
                                        }else if($tranfer_source == "jiangjin"){
                                            $type = '奖金';   //推荐奖
                                        }else{
                                            $type = '晋级奖金';   //领导奖
                                        }
                                        if(empty($v->post_content)){ $v->post_content = '无'; }
                                ?>
                                    <tr class="<?php echo $class; ?>">
                                        <td><?php echo '￥'.$v->post_title; ?></td>
                                        <td><?php echo $type; ?></td>
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


