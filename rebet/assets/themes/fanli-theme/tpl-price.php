<?php 
/***
* Template Name: 我要消费 
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
<?php  
global $current_user;
$uid = $current_user->ID;
$benjin_price  = get_user_meta($uid,'benjin_price',true);  if( $benjin_price == "")  { $benjin_price  = '0'; } 
?>
<!-- page heading end-->
<!--body wrapper start-->    
<div class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    消费金额
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- <div class="alert alert-block alert-warning fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <p>2K~1万利息奖励 0.7%</p><p>1.2万~2万利息奖励 1%</p><p>2.2万~3万利息奖励 1.2%</p>  
                            </div> -->
                            <div class="alert alert-danger" style="display: none;"><b>提示：</b></div>
                            <div class="alert alert-success" style="display: none;"><b>提示：消费成功！</b></div>
                            <form action="" class="form-horizontal" method="post" name="tosellform" id="tosellform">
                                <div class="form-group">
                                    <div class="col-sm-8 icheck minimal">
                                        <div class="radio">
                                            <input <?php if($benjin_price < 2000){ echo "disabled"; } ?> type="radio" value="2000"  name="p_money">    
                                            <label>2000</label>
                                        </div>
                                        <div class="radio">
                                            <input <?php if($benjin_price < 4000){ echo "disabled"; } ?> type="radio"  value="4000" name="p_money">    
                                            <label>4000</label>
                                        </div>
                                        <div class="radio">
                                            <input <?php if($benjin_price < 6000){ echo "disabled"; } ?> type="radio"  value="6000" name="p_money">    
                                            <label>6000</label>
                                        </div>
                                        <div class="radio">
                                            <input <?php if($benjin_price < 8000){ echo "disabled"; } ?> type="radio"  value="8000" name="p_money">    
                                            <label>8000</label>
                                        </div>
                                        <div class="radio">
                                            <input <?php if($benjin_price < 10000){ echo "disabled"; } ?> type="radio"  value="10000" name="p_money">    
                                            <label>10000</label>
                                        </div>
                                        <label class="col-sm-4 control-label"><span style="position: relative; left: -5px;">( 需要消耗1个消费币 )</span></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-9 icheck minimal">
                                        <div class="radio">
                                            <input type="radio" <?php if($benjin_price < 12000){ echo "disabled"; } ?> value="12000" name="p_money">    
                                            <label>12000</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" <?php if($benjin_price < 14000){ echo "disabled"; } ?> value="14000" name="p_money">    
                                            <label>14000</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" <?php if($benjin_price < 16000){ echo "disabled"; } ?> value="16000" name="p_money">    
                                            <label>16000</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" <?php if($benjin_price < 18000){ echo "disabled"; } ?> value="18000" name="p_money">    
                                            <label>18000</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" <?php if($benjin_price < 20000){ echo "disabled"; } ?> value="20000" name="p_money">    
                                            <label>20000</label>
                                        </div>
                                        <label class="col-sm-3 control-label">( 需要消耗2个消费币 )</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-9 icheck minimal">
                                        <div class="radio">
                                            <input type="radio" <?php if($benjin_price < 22000){ echo "disabled"; } ?> value="22000" name="p_money">    
                                            <label>22000</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" <?php if($benjin_price < 24000){ echo "disabled"; } ?> value="24000" name="p_money">    
                                            <label>24000</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" <?php if($benjin_price < 26000){ echo "disabled"; } ?> value="26000" name="p_money">    
                                            <label>26000</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" <?php if($benjin_price < 28000){ echo "disabled"; } ?> value="28000" name="p_money">    
                                            <label>28000</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" <?php if($benjin_price < 30000){ echo "disabled"; } ?> value="30000" name="p_money">    
                                            <label>30000</label>
                                        </div>
                                        <label class="col-sm-3 control-label">( 需要消耗3个消费币 )</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-9 icheck minimal">
                                        <div class="radio">
                                            <input type="radio" <?php if($benjin_price < 40000){ echo "disabled"; } ?> value="40000" name="p_money">    
                                            <label>40000</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" <?php if($benjin_price < 50000){ echo "disabled"; } ?> value="50000" name="p_money">    
                                            <label>50000</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" <?php if($benjin_price < 60000){ echo "disabled"; } ?> value="60000" name="p_money">    
                                            <label>60000</label>
                                        </div>
                                        <label class="col-sm-3 control-label">( 需要消耗4个消费币 )</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-9 icheck minimal">
                                        <div class="radio">
                                            <input type="radio" <?php if($benjin_price < 70000){ echo "disabled"; } ?> value="70000" name="p_money">    
                                            <label>70000</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" <?php if($benjin_price < 80000){ echo "disabled"; } ?> value="80000" name="p_money">    
                                            <label>80000</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" <?php if($benjin_price < 90000){ echo "disabled"; } ?> value="90000" name="p_money">    
                                            <label>90000</label>
                                        </div>
                                        <label class="col-sm-3 control-label">( 需要消耗5个消费币 )</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-9 icheck minimal">
                                        <div class="radio">
                                            <input type="radio" <?php if($benjin_price < 100000){ echo "disabled"; } ?> value="100000" name="p_money">    
                                            <label>100000</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" <?php if($benjin_price < 110000){ echo "disabled"; } ?> value="110000" name="p_money">    
                                            <label>110000</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" <?php if($benjin_price < 120000){ echo "disabled"; } ?> value="120000" name="p_money">    
                                            <label>120000</label>
                                        </div>
                                        <label class="col-sm-3 control-label" style="text-align:left;">&nbsp;&nbsp;&nbsp;( 需要消耗6个消费币 )</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <input class="form-control" id="secpsw" name="secpsw" placeholder="请输入二级密码" type="password">
                                    </div>
                                </div>
                                <button <?php userStatusActive(); ?> type="submit" class="tosell-submit btn btn-primary">确认消费</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
            消费记录
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
                                <th>金额</th>
                                <th>利息</th>
                                <th>消费日期</th>
                                <!-- <th>操作</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                global $current_user;  
                                $args = array(
                                  'post_type'      => 'type_sellrecord',
                                  'posts_per_page' => -1,
                                  'author'         => $current_user->ID
                                );
                                $latest_msg = get_posts( $args );
                                foreach ($latest_msg as $key => $v) {
                                    if($key%2 == 0){ $class="gradeA"; }
                                    $sell_lixi    = get_post_meta($v->ID,'sell_lixi',true); 
                                    if($sell_lixi == ""){ $sell_lixi = 0; }
                                    $sell_status  = get_post_meta($v->ID,'sell_status',true); 
                                    if($sell_status == 0){  $sell_status = "未完成"; }else{ $sell_status = "完成"; }
                            ?>
                                <tr class="<?php echo $class; ?>">
                                    <td><?php echo $sell_status; ?></td>
                                    <td><?php echo '￥'.$v->post_title; ?></td>
                                    <td><?php echo '￥'.$sell_lixi; ?></td>
                                    <td><?php echo $v->post_date; ?></td>
                                    <!-- <td><a href="#">查看</a></td> -->
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


