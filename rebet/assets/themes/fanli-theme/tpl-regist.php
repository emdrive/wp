<?php
/*
Template Name: 注册模版
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
    $action = $_GET['action'];
    if($action == ""){
    ?>
        <form method="post" class="form-signin" id="regForm" action="" style="max-width: 500px;">
            <div class="form-signin-heading text-center">
                <!-- <img src="<?php echo get_bloginfo('template_url'); ?>/images/login-logo.png" alt=""/> -->
                <h2 style="text-align:center; color:#000;">雅各文化产权交易平台</h2>
                <h3 style="color: #000;">会员注册</h3>
            </div>
    		<?php  
        		$login_page  = get_field('login_page','options');
    			$t = $_GET['t'];
    		?>
            <div class="login-wrap">
            	<div class="alert alert-danger" style="display: none;"><b>提示：</b></div>
                <div class="alert alert-success" style="display: none;"><b>提示：</b></div>
                <input type="text" autofocus="" name="tuijian" id="tuijian" value="<?php echo $t; ?>" placeholder="推荐人" class="form-control">
                <input type="text" autofocus="" name="username" id="username" placeholder="用户名" class="form-control">
                <input type="text" autofocus="" name="phone" id="phonenumber" placeholder="手机号" class="form-control">
                <div class="input-group m-bot15">
                    <span class="input-group-btn">
                        <button class="btn btn-default send-code" type="button">获取验证码</button>
                    </span>
                    <input name="checkcode" id="checkcode" style="margin-bottom: 0px; padding: 7px; border: 1px solid #e0e0e0;" class="form-control" type="text">
                </div>

                <input type="password" name="psw" id="psw" placeholder="输入密码" class="form-control">
                <input type="password" name="repsw" placeholder="确认密码" class="form-control">
                <div class="clearfix form-group captcha" id="captchainfo">
                    <div class="captcha-input col-lg-7 col-sm-7">
                        <input autocomplete="off" type="text" name="captcha" id="captcha" class="form-control" placeholder="验证码">
                    </div>
                    <label class="control-label col-lg-5 col-sm-5" for="captcha">
                        <img onclick="javascript:reCaptcha();" class="imgcaptcha" src="<?php bloginfo('template_url'); ?>/ext/captcha/captcha.php" alt="captcha" />
                    </label>
                </div>
                <label class="">
    	            <input type="checkbox" name="agreed" value="1" >
    	            <span style="position: relative; top: -1px; left:5px;">同意
    	            <a data-toggle="modal" href="#myModal">注册协议</a>
    	            </span>
                </label>
                <button type="submit" class="btn btn-lg btn-login btn-block">
                    <i class="fa fa-check"></i>
                    <i class="fa fa-cog fa-spin fa-1x fa-fw" style="display: none;"></i>
                </button>

                <div class="registration">
                    已有账户？
                    <a href="<?php echo $login_page; ?>" class="">
                        登录
                    </a>
                </div>

            </div>
            <!-- Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">注册协议</h4>
                            </div>
                            <div class="modal-body">
                                <div class="dialog-body" style="height: 510px; overflow: auto;">
                                    <p class="MsoNormal">尊敬的客户：</p>
                                    <p class="MsoNormal">
                                        （
                                        <span lang="EN-US">1</span>
                                        ）用户点击润玲珑注册页面的同意按钮，视为用户与润玲珑已达成《用户协议》（以下称“本协议”）。
                                    </p>
                                    <p class="MsoNormal">
                                        （
                                        <span lang="EN-US">2</span>
                                        ）润玲珑及用户均已认真阅读本《用户协议》中全部条款及法律声明的内容，对本协议已知晓、理解并接受，同意将其作为确定双方权利义务的依据。本协议内容包括本协议正文以及已经发布的或将来可能发布的各类规则、声明、说明。所有规则、声明、说明为协议不可分割的一部分，与协议正文具有同等法律效力。
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">&nbsp;</span>
                                    </p>
                                    <p class="MsoNormal">一、用户注册</p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">1.1</span>
                                        注册资格
                                    </p>
                                    <p class="MsoNormal">
                                        用户承诺：用户具有完全民事权利能力和行为能力，或虽不具有完全民事权利能力和行为能力，但点击同意，本平台即视为经其法定代理人同意并由其法定代理人代理注册及应用润玲珑服务。
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">1.2</span>
                                        注册目的
                                    </p>
                                    <p class="MsoNormal">用户承诺：用户进行用户注册并非出于违反法律法规或破坏润玲珑商城秩序的目的。</p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">&nbsp;</span>
                                    </p>
                                    <p class="MsoNormal">二、用户服务</p>
                                    <p class="MsoNormal">用户承诺遵守下列润玲珑服务规则：</p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">2.1.</span>
                                        用户应当遵守法律法规、规章、规范性文件及政策要求的规定，保证账户中所有资金和积分来源的合法性，不得在润玲珑或利用润玲珑服务从事非法或其他损害润玲珑的活动，如发送或接收任何违法、违规、违反公序良俗、侵犯他人权益的信息，发送或接收传销材料或存在其他危害的信息或言论，未经润玲珑授权使用或伪造润玲珑电子邮件题头信息等。
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">2.2.</span>
                                        用户应当遵守法律法规应当妥善使用和保管其润玲珑账号及密码、和其注册时绑定的手机号码、以及手机接收的手机验证码的安全。用户对使用其润玲珑账号和密码、手机验证码进行的任何操作和后果承担全部责任。当用户发现润玲珑账号、密码、验证码被未经其授权的第三方使用，或存在其他账号安全问题时，应立即有效通知润玲珑，要求暂停该账号的服务。润玲珑有权在合理时间内对用户的该等请求采取行动，但润玲珑代采取行动前用户已经遭受的损失不承担任何责任。用户在未经润玲珑同意的情况下不得将润玲珑账号以赠与、借用、租用、转让或其他方式处分给他人。
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">2.3.</span>
                                        用户应当遵守润玲珑不时发布和更新的用户协议以及其他服务条款和操作规则。
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">&nbsp;</span>
                                    </p>
                                    <p class="MsoNormal">三、协议的变更和终止</p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">3.1</span>
                                        协议的变更
                                    </p>
                                    <p class="MsoNormal">
                                        润玲珑有权随时对本协议内容或润玲珑发布的其他服务条款及操作规则的内容进行变更，变更时将在润玲珑站内发布公告，变更自公告发布之时生效，如用户继续使用润玲珑提供的服务即视为用户同意该等内容变更，如用户不同意变更后的内容则用户有权注销润玲珑账户、停止使用润玲珑服务。
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">3.2</span>
                                        协议的终止
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">3.2.1</span>
                                        润玲珑有权依据本协议约定注销用户的润玲珑账号，本协议于账号注销之日终止。
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">3.2.2</span>
                                        润玲珑有权依据本协议约定终止全部润玲珑服务，本协议于润玲珑全部服务终止之日终止。
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">3.2.3</span>
                                        本协议终止后，用户无权要求润玲珑继续向其提供任何服务或履行任何其他义务，包括但不限于要求润玲珑为用户保留或向用户披露其原润玲珑账号中的任何信息，转发任何其未曾阅读或发送过的信息等。
                                        <a name="_GoBack"></a>
                                    </p>
                                    <p class="MsoNormal">四、隐私权政策</p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">4.1.</span>
                                        适用范围
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">4.1.1.</span>
                                        在用户注册润玲珑账号时，用户根据润玲珑要求提供的个人注册信息，包括但不限于身份证信息；
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">4.1.2.</span>
                                        在用户使用润玲珑服务时，或访问润玲珑网页时，润玲珑自动接收并记录的用户浏览器上的服务器数值，包括但不限于
                                        <span lang="EN-US">IP</span>
                                        地址等数据及用户要求取用的网页记录；
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">4.1.3.</span>
                                        润玲珑通过合法途径取得的其他用户个人信息。
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">4.2.</span>
                                        信息使用
                                    </p>
                                    <p class="MsoNormal">润玲珑不会向任何人出售或出借用户的个人信息，除非事先得到用户的许可。</p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">&nbsp;</span>
                                    </p>
                                    <p class="MsoNormal">五、风险提示</p>
                                    <p class="MsoNormal">风险包括但不限于：</p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">1.</span>
                                        宏观经济及政策风险
                                    </p>
                                    <p class="MsoNormal">因国家法律法规和相关政策、宏观经济形势、政策变化和调整等原因，可能引起润玲珑相关规则的修改及变化；</p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">2.</span>
                                        自身风险
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">2.1</span>
                                        账号密码泄露风险：由于用户自身原因或使用的计算机被病毒侵入、黑客攻击等导致的密码泄露、账号泄露或身份被冒用，导致无法正确下达指令、恶意虚假拍单或拍单失败、延迟、错误等风险
                                        <span lang="EN-US">;</span>
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">2.2</span>
                                        操作不当风险：由于自身操作失误，出现商品种类、拍单类型、价格、数量等输入错误而产生的风险
                                        <span lang="EN-US">,</span>
                                        客户端使用后未及时退出，他人进行恶意操作而造成的风险
                                        <span lang="EN-US">;</span>
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">2.3</span>
                                        软硬件系统风险：用户的电脑设备及软件系统与润玲珑提供的客户端不相匹配，导致无法下达指令或失败、延迟等
                                        <span lang="EN-US">;</span>
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">2.4</span>
                                        网络故障风险：用户发布指令时，由于网络传输的原因，用户的电脑界面已经显示拍单成功，而平台主机未接到其提交指令，从而存在用户不能转让或受让的风险；用户电脑界面对其指令显示未成功，于是用户再次提交指令，而平台收到用户两次提交的指令，并已按其提交的指令进行，由此给用户带来重复拍单的风险。
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">3.</span>
                                        其他风险
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">3.1</span>
                                        技术风险：由于电子通讯技术和电脑技术存在着被网络黑客和计算机病毒攻击的可能，同时通讯技术、电脑技术和相关软件具有存在缺陷的可能
                                        <span lang="EN-US">;</span>
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">3.2</span>
                                        数据传输风险：由于指令是通过互联网进行输送，因互联网故障等原因使指令出现中断、中止、延迟等情况，导致无法成交、无法全部成交或延迟成交的风险
                                        <span lang="EN-US">;</span>
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">3.3</span>
                                        不可抗力因素导致的其他风险：诸如地震、台风、火灾、水灾、战争、瘟疫、社会动乱等不可抗力因素可能导致系统的瘫痪；
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">3.4</span>
                                        平台无法控制和不可预测的系统故障、设备故障、通讯故障、电力故障等。
                                    </p>
                                    <p class="MsoNormal">上述风险可能会导致用户损失。在拍单过程中，用户应确保已对各种可能遇到的风险有客观理性的认识。</p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">&nbsp;</span>
                                    </p>
                                    <p class="MsoNormal">六、违约责任</p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">6.1</span>
                                        润玲珑或用户违反本协议的约定即构成违约，违约方应当向守约方承担违约责任。
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">6.2</span>
                                        如因用户提供的信息不真实、不完整或不准确给润玲珑造成损失的，润玲珑有权要求用户进行损失的赔偿。
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">6.3</span>
                                        如因用户违反法律法规规定或本协议约定，在润玲珑或利用润玲珑服务从事非法活动的，润玲珑有权立即终止继续对其提供润玲珑服务，注销其账号，并要求其赔偿由此给润玲珑造成的损失。
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">6.4</span>
                                        如用户以技术手段干扰润玲珑的运行或干扰其他用户对润玲珑使用的，润玲珑有权立即注销其账号，并有权要求其赔偿由此给润玲珑造成的损失。
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">6.5</span>
                                        如用户以虚构事实等方式恶意诋毁润玲珑的商誉，润玲珑有权要求用户向润玲珑公开道歉，赔偿其给润玲珑造成的损失，并有权终止对其提供润玲珑服务。
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">&nbsp;</span>
                                    </p>
                                    <p class="MsoNormal">七、争议解决</p>
                                    <p class="MsoNormal">
                                        用户与润玲珑因本协议的履行发生争议的应通过友好协商解决，协商解决不成的，任一方有权将争议提交仲裁委员会依据该会仲裁规则进行仲裁。
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">&nbsp;</span>
                                    </p>
                                    <p class="MsoNormal">八、生效和解释</p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">8.1</span>
                                        本协议于用户点击润玲珑注册页面的同意并完成注册程序时生效，对润玲珑和用户均具有约束力。
                                    </p>
                                    <p class="MsoNormal">
                                        <span lang="EN-US">8.2</span>
                                        本协议的最终解释权归润玲珑所有。
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- modal -->
        </form>
    <?php }else{ ?>
        <form method="post" class="form-signin" id="regForm2" action="" style="max-width: 500px;">
            <div class="form-signin-heading text-center">
                <h3 style="color: #000;">二级密码设置</h3>
            </div>
            <div class="login-wrap">
                <div class="alert alert-danger alert-danger-2" style="display: none;"><b>提示：</b></div>
                <div class="alert alert-success alert-success-2" style="display: none;"><b>提示：</b></div>
                <input type="password" name="secpsw" id="secpsw" placeholder="输入二级密码" class="form-control">
                <input type="password" name="resecpsw" placeholder="请确认二级密码" class="form-control">
                <input type="hidden"   name="uid" value="<?php echo $action; ?>" class="form-control">
                <button type="submit" class="btn btn-lg btn-login btn-block">
                    <i class="fa fa-check"></i>
                    <i class="fa fa-cog fa-spin fa-1x fa-fw" style="display: none;"></i>
                </button>
                <div class="registration">
                    已有账户？
                    <a href="<?php echo get_field('login_page','options'); ?>" class="">
                        登录
                    </a>
                </div>
            </div>        
        </form>
    <?php } ?>
</div>
<script type="text/javascript">
	var countdown = 15;
	function settime(obj){
	    if (countdown == 0){
	      $(obj).attr("disabled",false);
	      $(obj).attr("mark","1");
	      $(obj).html("获取验证码");
	      countdown = 15;
	      return;
	    } else {

	      $(obj).attr("disabled", true);
	      $(obj).attr("mark","0");
	      $(obj).html("重新发送(" + countdown + ")");
	      countdown--;
	    }
	    setTimeout(function() { settime(obj) },1000);
	}
    $(document).ready(function () {
		$.validator.addMethod("loginRegex", function(value, element) {
	        return this.optional(element) || /^[a-z0-9\-]+$/i.test(value);
	    }, "Username must contain only letters, numbers, or dashes.");
        $("#regForm").validate({
            rules: {
                tuijian:{ 
                    //required: true,
                    remote:{
                        url: ajaxurl,
                        data: {
                            action:'checkTuijian',
                            tuijian: function() {
                                return $( "#tuijian" ).val();
                            }
                        }
                    }
                },
                username:{ 
                    required: true,
                    loginRegex:true,
                    remote:{
                        url: ajaxurl,
                        data: {
                            action:'checkUsername',
                            username: function() {
                                return $( "#username" ).val();
                            }
                        }
                    }
                },
                phone:{ 
                    required: true
                },
                checkcode:{
                	required: true,
                    remote:{
                        url: ajaxurl,
                        data: {
                            action:'checkMessageCode',
                            checkcode: function() {
                                return $( "#checkcode" ).val();
                            }
                        }
                    }
                },
                psw:{ 
                    required: true,
                },
                repsw:{ 
                    required: true,
                    equalTo: "#psw"
                },
                captcha:{
                    required: true,
                    remote:{
                        url: ajaxurl,
                        data: {
                        	action:'checkValue',
                            captcha: function() {
                                return $( "#captcha" ).val();
                            }
                        }
                    }
                },
                agreed:{ 
                    required: true
                }
            },
             messages: {
             	tuijian:{ 
                    //required: "请输入推荐码",
                    remote:"推荐码不存在"
                },
                username:{ 
                    required: "请输入用户名",
                    loginRegex: "只能输入字母和数字",
                    remote:"用户名有误"
                },
                phone:{ 
                    required: "请输入手机号"
                },
                checkcode:{ 
                    required: "短信验证码有误",
                    remote:"短信验证码不正确"
                },
                psw:{ 
                    required: "请输入密码"
                },
                repsw:{ 
                    required: "请确认密码",
                    equalTo: "密码不匹配"
                },
                captcha:{
                    required: "请输入验证码",
                    remote:"验证码错误"
                },
                agreed:{ 
                    required: "您需同意协议才可继续"
                }
            },
            errorElement : 'div',
            errorLabelContainer: '.alert-danger',
            submitHandler:function(form){
               $('#regForm').ajaxSubmit(options); 
            }
        });

        var options = { 
            beforeSubmit:  showRequest,
            success:       showResponse,
            url:       ajaxurl,
            data:{
            'action': 'func_regist_action'
        	} 
        };
        // pre-submit callback 
        function showRequest(formData, jqForm, options) { 
            $('.fa-check').hide();
            $('.fa-spin').fadeIn('fast');
            $('.btn-login').attr('disabled',true);
            return true; 
        } 
        // post-submit callback 
        function showResponse(responseText, statusText, xhr, $form)  { 
            var arg = responseText.split('|');
            if(arg[0] == 1){
                $('.alert-success').show().html('<b>提示：<b/>注册成功，跳转中....');
                window.location.href = '<?php echo get_field('regist_page','options'); ?>?action='+arg[1];
            }else{
                $('.btn-login').attr('disabled',false);
                $('.alert-danger').show().html('<b>提示：<b/>用户创建失败.');
                setTimeout(function(){
                    $('.fa-spin').hide(); 
                    $('.fa-check').fadeIn('slow');
                    $('.alert-danger').fadeOut().html('<b>提示：<b/>'); 
                },500)
            }
            return false;
        }


        //二级密码设置
        $("#regForm2").validate({
            rules: {
                secpsw:{ 
                    required: true,
                },
                resecpsw:{ 
                    required: true,
                    equalTo: "#secpsw"
                }
            },
             messages: {

                secpsw:{
                    required: "请输入二级密码"
                },
                resecpsw:{ 
                    required: "请确认二级密码",
                    equalTo: "二级密码不匹配"
                }
            },
            errorElement : 'div',
            errorLabelContainer: '.alert-danger-2',
            submitHandler:function(form){
               $('#regForm2').ajaxSubmit(options2); 
            }
        });

        var options2 = { 
            beforeSubmit:  showRequest2,
            success:       showResponse2,
            url:       ajaxurl,
            data:{
            'action': 'func_secpsw_action'
            } 
        };
        // pre-submit callback 
        function showRequest2(formData, jqForm, options) { 
            $('.fa-check').hide();
            $('.fa-spin').fadeIn('fast');
            $('.btn-login').attr('disabled',true);
            return true; 
        } 
        // post-submit callback 
        function showResponse2(responseText, statusText, xhr, $form)  { 
            //alert(responseText); return false;
            if(responseText == 1){
                $('.alert-success').show().html('<b>提示：<b/>添加成功，跳转中....');
                window.location.href = '<?php echo get_field('login_page','options'); ?>';
            }else{
                $('.btn-login').attr('disabled',false);
                $('.alert-danger').show().html('<b>提示：<b/>添加失败.');
                setTimeout(function(){
                    $('.fa-spin').hide(); 
                    $('.fa-check').fadeIn('slow');
                    $('.alert-danger').fadeOut().html('<b>提示：<b/>'); 
                },500)
            }
            return false;
        }

        $('.send-code').click(function(){
            $.ajax({
                url: of.ajaxurl,
                data: {
                    'action':"creat_code",
                    'value' : $('#phonenumber').val()
                },
                beforeSend:function(XMLHttpRequest){
                    
                   return true;
                },
                success:function(data) {
                    if(data == 1){
                        settime('.send-code');
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
    function reCaptcha(){
        var captchaurl = "<?php echo get_bloginfo('template_url'); ?>/ext/captcha/captcha.php?"+Math.random();
        $(".imgcaptcha").attr("src",captchaurl);
        $("#captcha").focus(); 
    }
</script>
<?php wp_footer(); ?>
</body>
</html>
