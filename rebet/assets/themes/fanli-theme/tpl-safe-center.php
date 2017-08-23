<?php 
/***
* Template Name: 安全中心 
**/
?>
<?php get_header(); ?>
<?php 
global $current_user;
$uid = $current_user->ID;
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
<!-- page heading end-->
<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading custom-tab dark-tab">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#bankinfo" data-toggle="tab">银行信息</a>
                        </li>
                        <li class="">
                            <a href="#about2" data-toggle="tab">登录密码</a>
                        </li>
                        <li class="">
                            <a href="#profile2" data-toggle="tab">二级密码</a>
                        </li>
                    </ul>
                </header>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="bankinfo">
                            <div class="alert alert-block alert-danger fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <strong>注意：</strong>请准确添写以下银行信息，否则会造成提现失败！
                            </div>
                            <div class="formmalert alert alert-block alert-success fade in">
                                <strong>提示：</strong>保存成功！ 
                            </div>
                            <?php  
                                $bank_type = get_user_meta($uid,'bank_type',true);
                                $bankopen  = get_user_meta($uid,'bankopen',true);
                                $bankuser  = get_user_meta($uid,'bankuser',true);
                                $cardnum   = get_user_meta($uid,'cardnum',true);
                            ?>
                            <form role="form" name="bankinfoform" id="bankinfoform" action="" method="post">
                                <div class="form-group">
                                    <label for="banktype">银行类型</label>
                                    <select name="banktype" id="banktype" class="form-control m-bot15">
                                        <option <?php selected($bank_type,'boc'); ?> value="boc">中国银行</option>
                                        <option <?php selected($bank_type,'abc'); ?> value="abc">农业银行</option>
                                        <option <?php selected($bank_type,'icbc'); ?> value="icbc">工商银行</option>
                                        <option <?php selected($bank_type,'ccb'); ?> value="ccb">建设银行</option>
                                        <option <?php selected($bank_type,'cmb'); ?> value="cmb">招商银行</option>
                                        <option <?php selected($bank_type,'bcm'); ?> value="bcm">交通银行</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="bankopen">开户行</label>
                                    <input name="bankopen" value="<?php echo $bankopen; ?>" class="form-control" id="bankopen" placeholder="请准确填写开户行" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="bankuser">开户人</label>
                                    <input name="bankuser" value="<?php echo $bankuser; ?>" class="form-control" id="bankuser" placeholder="请填写开卡时填写的姓名" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="cardnum">卡号</label>
                                    <input name="cardnum" value="<?php echo $cardnum; ?>" class="form-control" id="cardnum" placeholder="请填写卡号" type="text">
                                </div>
                                <button type="submit" class="bank-submit btn btn-primary">保存</button>
                            </form>
                        </div>
                        <div class="tab-pane" id="about2">
                            <div class="formmalert alert alert-block alert-danger fade in">
                                <strong>提示：</strong>原密码错误
                            </div>
                            <div class="formmalert alert alert-block alert-success fade in">
                                <strong>提示：</strong>保存成功！
                            </div>
                            <form role="form" name="pswinfo" id="pswinfo" action="" method="post">
                                <div class="form-group">
                                    <label for="oldpsw">原始密码</label>
                                    <input name="oldpsw" class="form-control" id="oldpsw" placeholder="请输入原始密码" type="password">
                                </div>
                                <div class="form-group">
                                    <label for="newpsw">新密码</label>
                                    <input name="newpsw" class="form-control" id="newpsw" placeholder="请输入新密码" type="password">
                                </div>
                                <div class="form-group">
                                    <label for="repsw">确认新密码</label>
                                    <input name="repsw" class="form-control" id="repsw" placeholder="请确认密码" type="password">
                                </div>
                                <button type="submit" class="psw-submit btn btn-primary">保存</button>
                            </form>
                        </div>
                        <div class="tab-pane" id="profile2">
                            <div class="formmalert alert alert-block alert-danger fade in">
                                <strong>提示：</strong>原密码错误
                            </div>
                            <div class="formmalert alert alert-block alert-success fade in">
                                <strong>提示：</strong>保存成功！
                            </div>
                            <form role="form" name="secpswinfo" id="secpswinfo" action="" method="post">
                                <div class="form-group">
                                    <label for="oldsecpsw">原始二级密码</label>
                                    <input name="oldsecpsw" class="form-control" id="oldsecpsw" placeholder="请输入原始二级密码" type="password">
                                </div>
                                <div class="form-group">
                                    <label for="newsecpsw">新二级密码</label>
                                    <input name="newsecpsw" class="form-control" id="newsecpsw" placeholder="请输入新二级密码" type="password">
                                </div>
                                <div class="form-group">
                                    <label for="resecpsw">确认二级新密码</label>
                                    <input name="resecpsw" class="form-control" id="resecpsw" placeholder="请确认二级密码" type="password">
                                </div>
                                <button type="submit" class="secpsw-submit btn btn-primary">保存</button>
                            </form>
                        </div>
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


