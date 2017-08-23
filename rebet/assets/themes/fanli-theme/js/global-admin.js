
// global variables

if( 'undefined' != typeof of ) {
    var baseurl = of.baseurl;
    var ajaxurl = of.ajaxurl;
    var tplurl  = of.tplurl;
}

// jQuery JS (compatible) begin

;(function($) {
$(document).ready(function($) {
    var loading  = $('#loading').val();

    $('#import-filter #doaction').click(function(){
        var v = $('.select-action').val();
        if(v == 'delete'){
            var r = confirm("确定要删除吗？");
            if(r){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    })
        //导入，清空操作
    $('.doaction').click(function(){
        var $this    = $(this).attr('rel');
        if( $this == 'clear' ){
            if(confirm("确定要清空数据库吗？")){
                $.ajax({
                    url: ajaxurl,
                    type:'POST',
                    data: "action=clear_data_func", 
                    beforeSend:function(XMLHttpRequest){
                        $.alert({
                            title: '提示：',
                            content: '请勿进行任何操作，正在处理中&nbsp;<img src="'+loading+'">',
                        });
                        return true;
                    },
                    success: function(data){
                        if(data == 1){
                            alertinfo("清空完成！正在重新加载....",true,1500);
                            window.location.reload();
                        }else{
                            alertinfo("清空失败！",true,1500);
                        }
                    }
                });
            }else{
                return false;
            }
        }else{ return false; }
    })

    $('#import-submit').click(function(){
        var v  = $('#dataimport').val();
        if( !v ){
            alertinfo('请插入数据！',true,500);
            return false;
        }
        $('#import-filter').ajaxSubmit(options);
        return false;
    })
    var options = { 
        beforeSubmit:  showRequest,
        success:       showResponse,
        url:       ajaxurl,
        data:{
            'action': 'import_data_action'
        }     
    };
    // pre-submit callback 
    function showRequest(formData, jqForm, options) { 
        alertinfo('请勿进行任何操作，正在导入中&nbsp;&nbsp;<img src="'+loading+'">',false);
        return true; 
    } 
    // post-submit callback 
    function showResponse(responseText, statusText, xhr, $form){
        //alert(responseText);
      //return false;
      if(responseText == 1){
        alertinfo("导入成功，准备刷新页面！",true,1500);
        window.location.reload();
      }else{
        //alert(responseText);
        alertinfo(responseText,true,3000);
      }
      return false;
    }

    function alertinfo( msg,hide,time){
    	var vtime;
    	if( time == null ){ vtime = 1000; }  
        $.alert({
            title: '提示：',
            content: msg
        });
    	if( hide ) { setTimeout( function(){ $('.jconfirm').hide(); },vtime ); }
    }

    $('.replay-submit').click(function() {
        var v              = $(this).attr('rel');
        var replay_content = $('#replay_content'+v+'').val();
        var pid            = v;
        if(replay_content == '' || replay_content == null ){
            alertinfo('回复内容不能为空！',true,2000); 
            $('#replay_content').focus();
        }else{
            $.ajax({
                url: ajaxurl,
                data: {
                    'action':'func_replay_action',
                    'value' : replay_content,
                    'pid'   : pid
                },
                beforeSend:function(XMLHttpRequest){
                    $('.replay-submit').html('正在执行中....').attr('disabled',true);
                },
                success:function(data) {
                    if( data == 1 ){
                        alertinfo('回复成功！',true,2000); 
                    }
                    $('.replay-submit').html('提交').attr('disabled',false);
                },
                complete:function(XMLHttpRequest, textStatus){}
            });
        }
        return false;

    });

    //提现回复
    $('.replay-tixian').click(function() {
        var v             = $(this).attr('rel');
        var tixian_replay = $('#tixian_replay'+v+'').val();
        var pid           = v;
        if(tixian_replay == '' || tixian_replay == null ){
            alertinfo('回复内容不能为空！',true,2000); 
            $('#tixian_replay').focus();
        }else{
            $.ajax({
                url: ajaxurl,
                data: {
                    'action':'func_replay_tixian_action',
                    'value' : tixian_replay,
                    'pid'   : pid
                },
                beforeSend:function(XMLHttpRequest){
                    $('.replay-tixian').html('正在执行中....').attr('disabled',true);
                },
                success:function(data) {
                    if( data == 1 ){
                        alertinfo('回复成功！',true,2000); 
                    }
                    $('.replay-tixian').html('提交').attr('disabled',false);
                },
                complete:function(XMLHttpRequest, textStatus){}
            });
        }
        return false;
    });

    $('.reason-submit').click(function() {
        var v              = $(this).attr('rel');
        var reason_content = $('#reason_content'+v+'').val();
        var pid            = v;
        if(reason_content == '' || reason_content == null ){
            alertinfo('内容不能为空！',true,2000); 
            $('#reason_content').focus();
        }else{
            $.ajax({
                url: ajaxurl,
                data: {
                    'action':'func_replay_reason_action',
                    'value' : reason_content,
                    'pid'   : pid
                },
                beforeSend:function(XMLHttpRequest){
                    $('.reason-submit').html('正在执行中....').attr('disabled',true);
                },
                success:function(data) {
                    if( data == 1 ){
                        alertinfo('添加成功！',true,2000); 
                    }
                    $('.reason-submit').html('提交').attr('disabled',false);
                },
                complete:function(XMLHttpRequest, textStatus){}
            });
        }
        return false;

    });

    $('.reason-btn').click(function() {
        var v = $(this).attr('rel');
        var d = $(this).attr('data');
        $.ajax({
            url: ajaxurl,
            data: {
                'action':'func_reason_action',
                'pid'   : v,
                'sid'   : d
            },
            beforeSend:function(XMLHttpRequest){
                //alert(d);
                if(d == 1){
                    $('.btn'+v+'').attr('data','0');
                }else{ $('.btn'+v+'').attr('data','1'); }
                $('.btn'+v+'').html('处理中').attr('disabled',true);
                return true;
            },
            success:function(data) {
                if( data == 1 ){
                    $('.btn'+v+'').html('不通过').attr('disabled',false);
                    $('.paystatus'+v+'').html('通过');
                }else{
                    $('.btn'+v+'').html('通过').attr('disabled',false);
                    $('.paystatus'+v+'').html('未通过');
                }
            },
            complete:function(XMLHttpRequest, textStatus){}
        });
        return false;

    });

    $('.tx-reason-btn').click(function() {
        var v = $(this).attr('rel');
        var d = $(this).attr('data');
        $.ajax({
            url: ajaxurl,
            data: {
                'action':'func_tx_reason_action',
                'pid'   : v,
                'sid'   : d
            },
            beforeSend:function(XMLHttpRequest){
                //alert(d);
                if(d == 1){
                    $('.btn'+v+'').attr('data','0');
                }else{ $('.btn'+v+'').attr('data','1'); }
                $('.btn'+v+'').html('处理中').attr('disabled',true);
                return true;
            },
            success:function(data) {
                if( data == 1 ){
                    $('.btn'+v+'').html('不通过').attr('disabled',false);
                    $('.txstatus'+v+'').html('通过');
                }else{
                    $('.btn'+v+'').html('通过').attr('disabled',false);
                    $('.txstatus'+v+'').html('未通过');
                }
            },
            complete:function(XMLHttpRequest, textStatus){}
        });
        return false;

    });

    //充值
    $('.pay-submit').click(function(){
        var v  = $('.pay_number').val();
        if(isNaN(v)){
          alertinfo('必须是数字',true,1000); return false;
        }
        $.ajax({
            url: ajaxurl,
            data: {
                'action': 'action_pay_data_func',
                'pay_type':  $('input[name=pay_type]:checked').val(),
                'username':  $('.username').val(),
                'pay_number':$('.pay_number').val(),
                'pay_note':  $('.pay_note').val(),
            },
            beforeSend:function(XMLHttpRequest){
                alertinfo('处理中...',false);
                return true;
            },
            success:function(data) {
                if(data == 1){
                    alertinfo('充值成功',true,1500);
                }else{
                    alertinfo(data,true,1500);
                }
            },
            complete:function(XMLHttpRequest, textStatus){}
        })
        return false;
    })
});
})(jQuery);

