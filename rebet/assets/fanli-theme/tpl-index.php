<?php
/*
Template Name: 控制面板
*/
?>
<?php get_header(); ?>
 
<?php
global $current_user;
$uid = $current_user->ID;
$phone = get_user_meta($uid,'phone',true); if($phone == ''){ $phone = '暂无'; }

$user_level = get_user_meta($uid,'wp_user_level',true); 
if($user_level == 0){ 
    $user_level = '普通会员'; 
}else if( $user_level == 1 ){
    $user_level = '银牌理财师';
}else if( $user_level == 2 ){
    $user_level = '金牌理财师';
}else if( $user_level >= 3 ){
    $user_level = '钻石理财师';
}

$user_level_1 = get_user_meta($uid,'level_1',true);
$user_level_2 = get_user_meta($uid,'level_2',true); 
$user_level_3 = get_user_meta($uid,'level_3',true); 
$user_level_4 = get_user_meta($uid,'level_4',true); 

$user = get_user_by( 'id', $uid );
$userStatus  = $user->user_status; 
$username    = $user->user_login;
$registtime  = $user->user_registered;

$get_status = user_round_times_func();

$user_recommend = get_user_meta($uid,'tuijian',true);
$tjuser         = get_user_by( 'id', $user_recommend );
$tuiijanname    = $tjuser->user_login;
if(empty($tuiijanname)){ $tuiijanname = '暂无'; }

$benjin_price  = get_user_meta($uid,'benjin_price',true);  if( $benjin_price == "")  { $benjin_price  = '0'; } //本金
$lixi_price    = get_user_meta($uid,'lixi_price',true);    if( $lixi_price == "")    { $lixi_price    = '0'; } //利息
$tuijian_price = get_user_meta($uid,'tuijian_price',true); if( $tuijian_price == "") { $tuijian_price = '0'; } //推荐奖
$lingdao_price = get_user_meta($uid,'lingdao_price',true); if( $lingdao_price == "") { $lingdao_price = '0'; } //领导奖
$jifen_price   = get_user_meta($uid,'jifen_price',true);   if( $jifen_price == "")   { $jifen_price   = '0'; } //积分
$xiaofeibi     = get_user_meta($uid,'xiaofeibi',true);     if( $xiaofeibi == "")     { $xiaofeibi     = '0'; } //消费币
$jihuobi       = get_user_meta($uid,'jihuobi',true);       if( $jihuobi == "")       { $jihuobi       = '0'; } //激活币
$first_sell    = get_user_meta($uid,'first_sell',true);    if( $first_sell == "")    { $first_sell    = '0'; } //首次消费
?>    
<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-block alert-danger fade in">
                <button type="button" class="close close-sm" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
                <strong>网站公告：</strong>平台本着公平公正的原则，为大家创造一个稳定的盈利平台，请大家遵守平台规则 
            </div>
            <?php
                //echo get_user_info_status();
                if( get_user_info_status() == 2 ){
                    $statusinfo = "您的账户还未激活，部分功能将无法使用！";
                }else{
                    $left_days = $get_status;
                    if($left_days < 0){
                        $statusinfo = "请即时充值消费，享受更多优惠！";
                    }else{
                        $statusinfo = "您距离这一轮结束还有&nbsp;".$left_days."&nbsp;天";
                    }
                    
                }
            ?>
            <div class="alert alert-block alert-danger fade in">
                <button type="button" class="close close-sm" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
                <strong>提示：</strong><?php echo $statusinfo; ?>
            </div>
        </div>
    </div>
    <div class="row states-info">
        <div class="col-md-3">
            <div class="panel red-bg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <span class="state-title">用户名：</span>
                            <h4><?php echo $username; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel blue-bg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <span class="state-title">理财师等级：</span>
                            <h4><?php echo $user_level; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel yellow-bg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <span class="state-title">用户状态：</span>
                            <h4><?php  if($userStatus == 0 && $tuiijanname != "暂无"){ ?>未激活<?php }else{ ?>正常<?php } ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel green-bg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <span class="state-title">注册日期：</span>
                            <h4><?php echo $registtime; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                我的推广
                <span class="tools pull-right">
                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                 </span>
                </header>
                <div class="panel-body">
                    <?php  
                        $login_page   = get_field('login_page','options');
                        $regist_page  = get_field('regist_page','options');
                        $t            = '';
                        $tuijian_list = get_user_meta( $current_user->ID,'tuijian_list',true );
                        if(empty($t) && !empty( $tuijian_list )){
                            $new_list = explode('_', $tuijian_list);
                            if( sizeof($new_list) >= 4){
                                array_shift($new_list);
                                $tuijian_list = implode('_',$new_list);        
                            }
                            $t .= $tuijian_list.'_';
                        }
                        $t.= $current_user->ID;
                        $code = base64_encode($t);
                        $tuiUrl = $regist_page.'?t='.$code;
                    ?>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td>推广链接</td>
                            <td><a target="_blank" href="<?php echo $regist_page.'?t='.$code; ?>"><?php echo $regist_page.'?t='.$code; ?></a></td>
                        </tr>
                        <tr>
                            <td>推广二维码</td>
                            <?php  
                                include TEMPLATEPATH.'/ext/phpqrcode/phpqrcode.php';
                                $value = $tuiUrl; //二维码内容     
                                $errorCorrectionLevel = 'L'; //容错级别     
                                $matrixPointSize = 6; //生成图片大小  
                                // 生成二维码图片     
                                QRcode::png($value, 'qrcode.png', $errorCorrectionLevel, $matrixPointSize, 2);  
                                // 输出二维码图片  
                                
                            ?>
                            <td><?php echo '<img src="qrcode.png">';  ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                我的钱包
                <span class="tools pull-right">
                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                 </span>
                </header>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>本金 ( 初始金 )</td>
                            <td><span>￥</span><?php echo $benjin_price; ?></td>
                            <td><a role="button" href="<?php echo get_permalink(16); ?>" class="btn btn-danger btn-sm">充值</a>&nbsp;<a role="button" href="<?php echo get_permalink(30); ?>" class="btn btn-warning btn-sm">提现</a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>利息 ( 受益金 )</td>
                            <td><span>￥</span><?php echo $lixi_price; ?></td>
                            <td><a role="button" href="<?php echo get_permalink(30); ?>" class="btn btn-warning btn-sm">提现</a></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>推荐奖 ( 奖金受益 )</td>
                            <td><span>￥</span><?php echo $tuijian_price; ?></td>
                            <td><a role="button" href="<?php echo get_permalink(30); ?>" class="btn btn-warning btn-sm">提现</a></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>领导奖 ( 晋级受益 )</td>
                            <td><span>￥</span><?php echo $lingdao_price; ?></td>
                            <td><a role="button" href="<?php echo get_permalink(30); ?>" class="btn btn-warning btn-sm">提现</a></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>积分受益</td>
                            <td><span>￥</span><?php echo $jifen_price; ?> </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>消费币</td>
                            <td><?php echo $xiaofeibi; ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>激活币</td>
                            <td><?php echo $jihuobi; ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>首次消费</td>
                            <td><span>￥</span><?php echo $first_sell; ?></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <!-- <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                消费记录
                <span class="tools pull-right">
                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                 </span>
                </header>
                <div class="panel-body">
                    <table class="table  table-hover general-table">
                        <thead>
                            <tr>
                                <th>状态</th>
                                <th>金额</th>
                                <th>利息</th>
                                <th>消费日期</th>
                                <th>结束日期</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>完成</td>
                                <td>30.00</td>
                                <td>200.00</td>
                                <td>2017-3-15</td>
                                <td>2017-3-15</td>
                                <td><a href="#">查看</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div> -->
</div>
<style type="text/css" media="screen">
    .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{
        vertical-align: middle;
    }
</style>
<!--body wrapper end-->
<?php get_footer(); ?>