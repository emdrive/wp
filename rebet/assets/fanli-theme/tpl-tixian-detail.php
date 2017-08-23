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
                <div class="panel-body">
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
                                <!-- <option value="奖金">奖金</option>
                                <option value="晋级奖金">晋级奖金</option> -->
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
                                    <th>总金额</th>
                                    <th>实际金额</th>
                                    <th>扣除积分金额</th>
                                    <th>手续费</th>
                                    <th>类型</th>
                                    <th>备注</th>
                                    <th>回复</th>
                                    <th>日期</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="gradeA">
                                    <td>Trident</td>
                                    <td>InternetExplorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>Win 95+</td>
                                    <td>Win 95+</td>
                                    <td>Trident</td>
                                    <td>InternetExplorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>Win 95+</td>
                                </tr>
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


