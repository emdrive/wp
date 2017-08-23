<?php 
/***
* Template Name: 提现记录 
**/
?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
<!-- page heading start-->
<div class="page-heading">
    <h3><?php the_title(); ?></h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo get_bloginfo('home'); ?>">控制面板</a>
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
                    我要提现
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                </header>
                <?php  
                $tixian_price_juan = get_field('tixian_price_juan','options');
                //echo floor(900/$tixian_price_juan);
                ?>
                <div class="panel-body">
                    <div class="alert alert-block alert-warning fade in">
                    <strong>提示：今天最低提现额度为（<?php echo $tixian_price_juan; ?> 元），<span style="color:#ff0000;">提现时间为每天 15:05~23:55</span> 
                    </strong>
                    </div>
                    <div class="formmalert alert alert-block alert-danger fade in">
                        <strong>提示：</strong>
                    </div>
                    <div class="formmalert alert alert-block alert-success fade in">
                        <strong>提示：</strong>提现成功！ 
                    </div>
                    <?php  
                        $lixi_tixian        = get_field('lixi_tixian','options');
                        $benjin_tixian_bili = get_field('benjin_tixian_bili','options');
                    ?>
                    <form role="form" name="tixianform" id="tixianform" method="post" action="">
                        <div class="form-group">
                            <label for="bankopen">提现来源</label>
                            <select name="tixian_type" autocomplete="off" class="form-control">
                                <option value="lixi">利息</option>
<!--                                 <option value="tuijian">奖金</option>
                                <option value="lingdao">晋级奖金</option> -->
                                <option value="benjin">本金</option>
                            </select>
                            <span class="help-block">本金提现后，您的层级关系会被清除，不再享受任何层级奖励。</span>
                        </div>
                        <div class="form-group">
                            <label for="price">金额</label>
                            <input name="tixian_price" class="form-control" id="tixian_price" placeholder="请输入金额" type="text">
                            <span class="help-block">本金提现会有 <?php echo $benjin_tixian_bili; ?>% 的手续费,利息提现会有 <?php echo $lixi_tixian[0]['jifen_package']; ?>% 转入积分</span>
                        </div>
                        <div class="form-group">
                            <label for="secpsw">二级密码</label>
                            <input name="secpsw" class="form-control" id="secpsw" placeholder="请填写二级密码" type="password">
                        </div>
<!--                         <div class="form-group">
                            <label for="phonecode">手机验证码</label>
                            <div class="input-group m-bot15">
                                <span class="input-group-btn">
                                    <button class="btn btn-default msgcode" type="button">免费获取验证码</button>
                                </span>
                                <input name="phonecode" id="phonecode" class="form-control" value="" type="text">
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label for="note">备注</label>
                            <textarea name="note" rows="6" class="form-control"></textarea>
                        </div>
                        <button <?php userStatusActive(); ?> type="submit" class="tixian-submit btn btn-primary">保存</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    提现明细
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
                                    <th>可提现金额</th>
                                    <th>实际金额</th>
                                    <th>积分金额</th>
                                    <th>手续费</th>
                                    <th>类型</th>
                                    <th>备注</th>
                                    <th>回复</th>
                                    <th>日期</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    global $current_user;  
                                    $args = array(
                                      'post_type'      => 'type_tixian',
                                      'orderby'        => 'date',
                                      'order'          => 'desc',
                                      'posts_per_page' => -1,
                                      'author'         => $current_user->ID
                                    );
                                    $latest_msg = get_posts( $args );
                                    foreach ($latest_msg as $key => $v) {
                                        if($key%2 == 0){ $class="gradeA"; }
                                        $tixian_status  = get_post_meta($v->ID,'tixian_status',true); 
                                        if($tixian_status == 0){  $tixian_status = "审核中"; }else{ $tixian_status = "通过"; }
                                        $new_price    = get_post_meta($v->ID,'new_price',true); 
                                        if($new_price == ""){ $new_price = 0; }
                                        $tixian_type    = get_post_meta($v->ID,'tixian_type',true); 
                                        if($tixian_type == "benjin_price"){ $tixian_type = "本金"; $sx = "15%"; }
                                        else{ $tixian_type = "利息";  $sx = "0%"; }
                                        $tixian_replay    = get_post_meta($v->ID,'tixian_replay',true); 
                                        if(!empty($tixian_replay)){ $t = $tixian_replay; }else{ $t = '暂无'; }
                                        $tixian_jifen    = get_post_meta($v->ID,'tixian_jifen',true); 
                                        if($tixian_jifen == ""){ $tixian_jifen = 0; }
                                        $fact_price    = get_post_meta($v->ID,'fact_price',true); 
                                        if($fact_price == ""){ $fact_price = 0; }
                                ?>
                                <tr class="<?php echo $class; ?>">
                                    <td><?php echo $tixian_status; ?></td>
                                    <td><?php echo '￥'.$v->post_title; ?></td>
                                    <td><?php echo '￥'.$fact_price; ?></td>
                                    <td><?php echo '￥'.$tixian_jifen; ?></td>
                                    <td><?php echo $sx; ?></td>
                                    <td><?php echo $tixian_type; ?></td>
                                    <td><?php echo $v->post_content; ?></td>
                                    <td><?php echo $t; ?></td>
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
<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal3" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">提示</h4>
            </div>
            <div class="modal-body">验证码已发送到您手机，请注意查收！</div>
        </div>
    </div>
</div>
<!-- modal -->
<script type="text/javascript">
    var countdown = 60;
    function sendtime(obj){
        if (countdown == 0){
          $(obj).attr("disabled",false);
          $(obj).attr("mark","1");
          $(obj).html("获取验证码");
          countdown = 60;
          return;
        } else {

          $(obj).attr("disabled", true);
          $(obj).attr("mark","0");
          $(obj).html("重新发送(" + countdown + ")");
          countdown--;
        }
        setTimeout(function() { sendtime(obj) },1000);
    }
    $(document).ready(function () {
        $('.msgcode').click(function(){
            $.ajax({
                url: of.ajaxurl,
                data: {
                    'action':"send_msgcode"
                },
                beforeSend:function(XMLHttpRequest){
                    return true;
                },
                success:function(data) {
                    if(data == 1){
                        $('#myModal3').modal('show');
                        sendtime('.msgcode');
                        setTimeout(function() { $('#myModal3').modal('hide'); },2000); 
                    }else{
                        alert(data);
                    }
                    return false;
                },
                complete:function(XMLHttpRequest, textStatus){
                },
                error: function(errorThrown){}
            });
        });
    })
</script>
<!--body wrapper end-->
<?php endwhile; else: ?>
<?php  endif; ?>
<?php rewind_posts(); ?>
<?php get_footer(); ?>


