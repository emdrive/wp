<?php 
/***
* Template Name: 开通会员 
**/
?>
<?php 
get_header(); 
global $current_user;
?>
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
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    会员开通
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
                		//echo $t;
                		$code = base64_encode($t);
                	?>
                	<p>会员推荐代码：<input class="tuijian-code" type="text" readonly="true" value="<?php echo $code; ?>" name="code" ></p>
                	<p>会员开通链接：<a target="_blank" href="<?php echo $regist_page.'?t='.$code; ?>">点击这里</a></p>
				</div>
			</section>
		</div>
	</div>
</div>
<?php endwhile; else: ?>
<?php  endif; ?>
<script type="text/javascript">
	$("input[type='text']").on("click", function () {
	   $(this).select();
	});
</script>
<?php rewind_posts(); ?>
<?php get_footer(); ?>


