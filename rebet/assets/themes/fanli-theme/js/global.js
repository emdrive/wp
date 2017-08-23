
// global variables

if( 'undefined' != typeof of ) {
	var baseurl = of.baseurl;
	var ajaxurl = of.ajaxurl;
	var tplurl  = of.tplurl;
}

// jQuery JS (compatible) begin

;(function($) {

$(document).ready( function() {

	$("#contactform").validate({
        rules: {
            note:{ 
                required: true
            }
        },
         messages: {
            note:{ 
                required: "请输入留言内容"
            }
        },
        errorElement : 'span',
        errorLabelContainer: '.alert-danger',
        submitHandler:function(form){
           $('#contactform').ajaxSubmit(options); 
        }
    });

    var options = {
        beforeSubmit:  showRequest,
        success:       showResponse,
        url:       ajaxurl,
        data:{
        'action': 'func_contact_action'
    	}
    };
    // pre-submit callback 
    function showRequest(formData, jqForm, options) {
        $('.form-submit').html('正在执行中....').attr('disabled',true);
        return true; 
    } 
    // post-submit callback 
    function showResponse(responseText, statusText, xhr, $form)  { 
    	$('.alert-success').fadeIn();
        if(responseText == 1){
        	$('#note').val('');
        	setTimeout(function(){
        		$('.alert-success').fadeOut();
        		 window.location.reload();
        	},1500);
        }
        $('.form-submit').html('提交').attr('disabled',false);
        return false;
    }

    //银行信息
	$("#bankinfoform").validate({
        rules: {
            banktype:{ 
                required: true
            },
            bankopen:{ 
                required: true
            },
            bankuser:{ 
                required: true
            },
            cardnum:{ 
                required: true
            } 
        },
         messages: {
            banktype:{ 
                required: ""
            },
            bankopen:{ 
                required: ""
            },
            bankuser:{ 
                required: ""
            },
            cardnum:{ 
                required: ""
            }
        },
        submitHandler:function(form){
           $('#bankinfoform').ajaxSubmit(options2); 
        }
    });

    var options2 = {
        beforeSubmit:  bankRequest,
        success:       bankResponse,
        url:       ajaxurl,
        data:{
        'action': 'func_change_bank_action'
    	}
    };
    // pre-submit callback 
    function bankRequest(formData, jqForm, options) {
        $('.bank-submit').html('正在执行中....').attr('disabled',true);
        return true; 
    } 
    // post-submit callback 
    function bankResponse(responseText, statusText, xhr, $form)  { 
        if(responseText == 1){
        	$('.alert-success').fadeIn();
        	setTimeout(function(){
        		$('.alert-success').fadeOut();
        	},1500);
        }
        $('.bank-submit').html('提交').attr('disabled',false);
        return false;
    }

    //密码更换
    $("#pswinfo").validate({
        rules: {
            oldpsw:{ 
                required: true
            },
            newpsw:{ 
                required: true
            },
            repsw:{ 
                required: true,
                equalTo: "#newpsw"
            }
        },
         messages: {
            oldpsw:{ 
                required: ""
            },
            newpsw:{ 
                required: ""
            },
            repsw:{ 
                required: "",
                equalTo: ""
            }
        },
        submitHandler:function(form){
           $('#pswinfo').ajaxSubmit(options3); 
        }
    });

    var options3 = {
        beforeSubmit:  pswRequest,
        success:       pswResponse,
        url:       ajaxurl,
        data:{
        'action': 'func_change_psw_action'
    	}
    };
    // pre-submit callback 
    function pswRequest(formData, jqForm, options) {
        $('.psw-submit').html('正在执行中....').attr('disabled',true);
        return true; 
    } 
    // post-submit callback 
    function pswResponse(responseText, statusText, xhr, $form){ 
        if(responseText == 1){
        	$('.alert-success').fadeIn();
        	setTimeout(function(){
        		$('.alert-success').fadeOut();
        		window.location.reload();
        	},1500);
        }else{
        	$('.alert-danger').fadeIn();
        	setTimeout(function(){
        		$('.alert-danger').fadeOut();
        	},1500);
        }
        $('.psw-submit').html('提交').attr('disabled',false);
        return false;
    }

    //二级密码更换
    $("#secpswinfo").validate({
        rules: {
            oldsecpsw:{ 
                required: true
            },
            newsecpsw:{ 
                required: true
            },
            resecpsw:{ 
                required: true,
                equalTo: "#newsecpsw"
            }
        },
         messages: {
            oldsecpsw:{ 
                required: ""
            },
            newsecpsw:{ 
                required: ""
            },
            resecpsw:{ 
                required: "",
                equalTo: ""
            }
        },
        submitHandler:function(form){
           $('#secpswinfo').ajaxSubmit(options4); 
        }
    });

    var options4 = {
        beforeSubmit:  secpswRequest,
        success:       secpswResponse,
        url:       ajaxurl,
        data:{
        'action': 'func_change_secpsw_action'
    	}
    };
    // pre-submit callback 
    function secpswRequest(formData, jqForm, options) {
        $('.secpsw-submit').html('正在执行中....').attr('disabled',true);
        return true; 
    } 
    // post-submit callback 
    function secpswResponse(responseText, statusText, xhr, $form)  { 
    	if(responseText == 1){
        	$('.alert-success').fadeIn();
        	setTimeout(function(){
        		$('.alert-success').fadeOut();
        		window.location.reload();
        	},1500);
        }else{
        	$('.alert-danger').fadeIn();
        	setTimeout(function(){
        		$('.alert-danger').fadeOut();
        	},1500);
        }
        $('.secpsw-submit').html('提交').attr('disabled',false);
        return false;
    }    

    //我要消费
    $("#tosellform").validate({
        rules: {
            p_money:{ 
                required: true
            },
            secpsw:{ 
                required: true
            }
        },
         messages: {
            p_money:{ 
                required: "请选择消费区间"
            },
            secpsw:{ 
                required: "请输入二级密码"
            }
        },
        errorElement : 'div',
        errorLabelContainer: '.alert-danger',
        submitHandler:function(form){
           $('#tosellform').ajaxSubmit(options5); 
        }
    });

    var options5 = {
        beforeSubmit:  tosellRequest,
        success:       tosellResponse,
        url:       ajaxurl,
        data:{
        'action': 'func_tosell_action'
        }
    };
    // pre-submit callback 
    function tosellRequest(formData, jqForm, options) {
        $('.tosell-submit').html('正在执行中....').attr('disabled',true);
        return true; 
    } 
    // post-submit callback 
    function tosellResponse(responseText, statusText, xhr, $form)  {
        //$('.tosell-submit').html('确认消费').attr('disabled',false);
        //alert(responseText); return false;

        if(responseText == 1){
            $('.alert-success').fadeIn();
            window.location.reload();
            setTimeout(function(){
                $('.alert-success').fadeOut();
            },1500);
        }else{
            $('.alert-danger').html(responseText).fadeIn();
            setTimeout(function(){
                $('.alert-danger').fadeOut();
            },1500);
        }
        $('.tosell-submit').html('确认消费').attr('disabled',false);
        return false;
    }

    //转账消费

    $("#account_tranfer").validate({
        rules: {
            username:{ 
                required: true,
                remote:{
                    url: ajaxurl,
                    data: {
                        action:'checkUsername2',
                        username: function(){
                            return $("#username").val();
                        }
                    }
                }
            },
            price_type:{ 
                required: true
            },
            number:{ 
                required: true,
                number:true
            }
        },
         messages: {
            username:{ 
                required: "请输入会员名",
                remote:"该会员不存在"
            },
            price_type:{ 
                required: "请选择类型"
            },
            number:{ 
                required: "请输入数量",
                number:"必须是数字"
            }
        },
        errorElement : 'div',
        errorLabelContainer: '.alert-danger',
        submitHandler:function(form){
           $('#account_tranfer').ajaxSubmit(options6); 
        }
    });

    var options6 = {
        beforeSubmit:  tranferRequest,
        success:       tranferResponse,
        url:       ajaxurl,
        data:{
        'action': 'func_tranfer_action'
        }
    };
    // pre-submit callback 
    function tranferRequest(formData, jqForm, options) {
        $('.tranfer-submit').html('正在执行中....').attr('disabled',true);
        return true; 
    } 
    // post-submit callback 
    function tranferResponse(responseText, statusText, xhr, $form)  {
        //$('.tranfer-submit').html('确认转账').attr('disabled',false);
        //alert(responseText); return false;
        if(responseText == 1){
            $('.alert-success').fadeIn();
            window.location.reload();
            setTimeout(function(){
                $('.alert-success').fadeOut();
            },1500);
        }else{
            $('.alert-danger').html(responseText).fadeIn();
            setTimeout(function(){
                $('.alert-danger').fadeOut();
            },1500);
        }
        $('.tranfer-submit').html('确认转账').attr('disabled',false);
        return false;
    }

    //转移积分
    $("#movejifen").validate({
        rules: {
            move_price:{ 
                required: true,
                number:true
            },
            secpsw:{ 
                required: true,
                number:true
            }
        },
         messages: {
            move_price:{ 
                required: "请输入金额",
                number:"金额必须是数字"
            },
            secpsw:{ 
                required: "请输入二级密码"
            }
        },
        errorElement : 'div',
        errorLabelContainer: '.alert-danger',
        submitHandler:function(form){
           $('#movejifen').ajaxSubmit(options7); 
        }
    });

    var options7 = {
        beforeSubmit:  moveRequest,
        success:       moveResponse,
        url:       ajaxurl,
        data:{
        'action': 'func_movejifen_action'
        }
    };
    // pre-submit callback 
    function moveRequest(formData, jqForm, options) {
        $('.move-submit').html('正在执行中....').attr('disabled',true);
        return true; 
    } 
    // post-submit callback 
    function moveResponse(responseText, statusText, xhr, $form)  {
        if(responseText == 1){
            $('.alert-success').fadeIn();
            window.location.reload();
            setTimeout(function(){
                $('.alert-success').fadeOut();
            },1500);
        }else{
            $('.alert-danger').html(responseText).fadeIn();
            setTimeout(function(){
                $('.alert-danger').fadeOut();
            },1500);
        }
        $('.move-submit').html('确认转移').attr('disabled',false);
        return false;
    }     


    //提现处理
    $("#tixianform").validate({
        rules: {
            tixian_price:{ 
                required: true,
                number:true
            },
            secpsw:{ 
                required: true
            },
            phonecode:{ 
                required: true,
                remote:{
                    url: ajaxurl,
                    data: {
                        action:'checkMessageCode_Tx',
                        phonecode: function() {
                            return $( "#phonecode" ).val();
                        }
                    }
                }
            }
        },
         messages: {
            tixian_price:{ 
                required: "请输入金额",
                number:"金额必须是数字"
            },
            secpsw:{ 
                required: "请输入二级密码"
            },
            phonecode:{ 
                required: "请输入短信验证码",
                remote:"短信验证码不正确"
            }
        },
        errorElement : 'div',
        errorLabelContainer: '.alert-danger',
        submitHandler:function(form){
           $('#tixianform').ajaxSubmit(options8); 
        }
    });

    var options8 = {
        beforeSubmit:  txRequest,
        success:       txResponse,
        url:       ajaxurl,
        resetForm: true,
        data:{
        'action': 'func_tixian_action'
        }
    };
    // pre-submit callback 
    function txRequest(formData, jqForm, options) {
        $('.tixian-submit').html('正在执行中....').attr('disabled',true);
        return true; 
    } 
    // post-submit callback 
    function txResponse(responseText, statusText, xhr, $form)  {
        var d = responseText.split('|');
        if(d[0] == 1){
            $('.alert-success').html(d[1]).fadeIn();
            setTimeout(function(){
                $('.alert-success').fadeOut();
                window.location.reload();
            },3000);
        }else{
            $('.alert-danger').html(d[1]).fadeIn();
            setTimeout(function(){
                $('.alert-danger').fadeOut();
            },2000);
        }
        $('.tixian-submit').html('保存').attr('disabled',false);
        return false;
    }     


    //充值处理
    $("#pay_form").validate({
        rules: {
            price:{ 
                required: true,
                number:true,
                max:30000,
                min:2000
            },
            note:{ 
                required: true
            }
        },
         messages: {
            price:{ 
                required: "请输入金额",
                number:"金额必须是数字",
                max:"最高充值3万元",
                min:"最低充值金额2千元"
            },
            note:{ 
                required: "请输入备注"
            }
        },
        errorElement : 'div',
        errorLabelContainer: '.alert-danger',
        submitHandler:function(form){
           $('#pay_form').ajaxSubmit(options9); 
        }
    });

    var options9 = {
        beforeSubmit:  payRequest,
        success:       payResponse,
        url:       ajaxurl,
        data:{
        'action': 'func_pay_action'
        }
    };
    // pre-submit callback 
    function payRequest(formData, jqForm, options) {
        $('.pay-submit').html('正在执行中....').attr('disabled',true);
        return true; 
    } 
    // post-submit callback 
    function payResponse(responseText, statusText, xhr, $form)  {
        //$('.pay-submit').html('确认充值').attr('disabled',false);
        //alert(responseText); return false;
        if(responseText == 1){
            $('.alert-success').fadeIn();
            window.location.reload();
            setTimeout(function(){
                $('.alert-success').fadeOut();
            },1500);
        }else{
            $('.alert-danger').html(responseText).fadeIn();
            setTimeout(function(){
                $('.alert-danger').fadeOut();
            },1500);
        }
        $('.pay-submit').html('确认充值').attr('disabled',false);
        return false;
    }     

    //modal action
	$("div[id^='myModal']").each(function(){
	  
	  var currentModal = $(this);
	  
	  //click next
	  currentModal.find('.btn-next').click(function(){
	    currentModal.modal('hide');
	    currentModal.closest("div[id^='myModal']").nextAll("div[id^='myModal']").first().modal('show'); 
	  });
	  
	  //click prev
	  currentModal.find('.btn-prev').click(function(){
	    currentModal.modal('hide');
	    currentModal.closest("div[id^='myModal']").prevAll("div[id^='myModal']").first().modal('show'); 
	  });

	});


});

$(window).load( function() {

} );

})(jQuery);

