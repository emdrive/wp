<?php
/*
Template Name: 登录模版
*/
?>	
<!DOCTYPE html>
<!--[if lt IE 7 ]><html dir="ltr" lang="en" class="no-js ie ie6 lte7 lte8 lte9"><![endif]-->
<!--[if IE 7 ]>   <html dir="ltr" lang="en" class="no-js ie ie7 lte7 lte8 lte9"><![endif]-->
<!--[if IE 8 ]>   <html dir="ltr" lang="en" class="no-js ie ie8 lte8 lte9"><![endif]-->
<!--[if IE 9 ]>   <html dir="ltr" lang="en" class="no-js ie ie9 lte9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>>
<head>

	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />

	<?php include ( get_stylesheet_directory() . '/functions/needed/seo.php' ); ?>
	
	<!-- Only for responsive layout -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="format-detection" content="telephone=no" />

	<?php wp_head(); ?>
	<!--common-->
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="<?php echo get_bloginfo('template_url'); ?>/js/html5shiv.js"></script>
	<script src="<?php echo get_bloginfo('template_url'); ?>/js/respond.min.js"></script>
	<![endif]-->

</head>
<?php checkLoginJump(); ?>
<body class="login-body">
<div class="container">
	<?php  
		$regist_page = get_field('regist_page','options');
	?>
    <form method="post" class="form-signin" id="loginForm" action="" >
        <div class="form-signin-heading text-center">
            <!-- <img src="<?php echo get_bloginfo('template_url'); ?>/images/login-logo.png" alt=""/> -->
            <h3 style="text-align:center; color:#000;">雅各文化产权交易平台</h3>
            <h4 style="color: #000;">系统登录</h4>
        </div>
        <div class="login-wrap">
        	<div class="alert alert-danger" style="display: none;"><b>提示：</b></div>
            <div class="alert alert-success" style="display: none;"><b>提示：</b></div>
            <input autocomplete="off" type="text" class="form-control" name="username" placeholder="用户名" autofocus>
            <input autocomplete="off" type="password" class="form-control" name="psw" placeholder="密码">

            <button class="btn btn-lg btn-login btn-block" type="submit">
                <i class="fa fa-check"></i>
                <i class="fa fa-cog fa-spin fa-1x fa-fw" style="display: none;"></i>
            </button>

            <div class="registration">
                还没有账户? 点击 <a class="" href="<?php echo $regist_page; ?>">这里</a> 注册
            </div>
<!--             <label class="checkbox">
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> 忘记密码 ?</a>
                </span>
            </label> -->
        </div>
    </form>
    <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">忘记密码 ?</h4>
                    </div>
                    <div class="modal-body">
                        <p>请输入手机号</p>
                        <input type="text" name="phone" placeholder="手机号" autocomplete="off" class="form-control placeholder-no-fix">
                    </div>
                    <div class="modal-footer">
                        <!-- <button class="btn btn-primary" type="button">确认</button> -->
                        <button type="button" class="btn btn-default btn-next">下一步</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->

        <!-- Modal -->
		<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">输入新密码</h4>
		      </div>
		      <div class="modal-body">
		      		<input type="text" name="code" placeholder="验证码"   autocomplete="off" class="m-bot15 form-control placeholder-no-fix">
		        	<input type="text" name="newpsw" placeholder="新密码"   autocomplete="off" class="m-bot15 form-control placeholder-no-fix">
		        	<input type="text" name="newrepsw" placeholder="确认密码" autocomplete="off" class="m-bot15 form-control placeholder-no-fix">
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default btn-prev">上一步</button>
		        <button type="button" class="btn btn-default btn-next">确认</button>
		      </div>
		    </div>
		  </div>
		</div>

</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#loginForm").validate({
            rules: {
                username:{ 
                    required: true
                },
                psw:{ 
                    required: true
                }
            },
             messages: {
                username:{ 
                    required: "请输入用户名"
                },
                psw:{ 
                    required: "请输入密码"
                }
            },
            errorElement : 'div',
            errorLabelContainer: '.alert-danger',
            submitHandler:function(form){
               $('#loginForm').ajaxSubmit(options); 
            }
        });

        var options = {
            beforeSubmit:  showRequest,
            success:       showResponse,
            url:       ajaxurl,
            data:{
            'action': 'func_login_action'
        	}
        };
        // pre-submit callback 
        function showRequest(formData, jqForm, options) {
        	//alert(ajaxurl); return false;
            $('.fa-check').hide();
            $('.fa-spin').fadeIn('fast');
            $('.btn-login').attr('disabled',true);
            return true; 
        } 
        // post-submit callback 
        function showResponse(responseText, statusText, xhr, $form)  { 
            if(responseText == 1){
                $('.alert-success').show().html('<b>提示：<b/>成功登陆，跳转中....');
                window.location.href = '<?php echo get_bloginfo('home'); ?>';
            }else{
                $('.btn-login').attr('disabled',false);
                $('.alert-danger').show().html('<b>提示：<b/>账号或密码不正确.');
                setTimeout(function(){
                    $('.fa-spin').hide(); 
                    $('.fa-check').fadeIn('slow');
                    $('.alert-danger').fadeOut().html('<b>提示：<b/>'); 
                },500)
            }
            return false;
        }
    })
</script>
<?php wp_footer(); ?>
</body>
</html>