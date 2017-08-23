<?php
date_default_timezone_set('Asia/Shanghai'); //'Asia/Shanghai'
session_start();
/*
*
* -Custom Function
* 
*/

//用户列表更改
add_filter('manage_users_columns', 'pippin_add_user_id_column');

function pippin_add_user_id_column($columns) {
    $columns['user_name']     = '姓名';
    $columns['user_phone']     = '手机号';
    $columns['user_recommend'] = '推荐人';
    //$columns['recommend_code'] = '推荐码';
    $columns['user_status']    = '状态';
    $columns['user_level']     = '详情';
    $columns['user_date'] = '注册日期';
    unset($columns['name']);
    unset($columns['posts']);
    unset($columns['email']);
    return $columns;
}
 
add_action('manage_users_custom_column',  'pippin_show_user_id_column_content', 10, 3);

function pippin_show_user_id_column_content($value, $column_name, $user_id) {
    $user = get_userdata( $user_id );
	if ( 'user_phone' == $column_name ){

		$phone = get_user_meta($user_id,'phone',true);

		if(empty($phone)){ $phone = '暂无'; }
		return ''.$phone.'';

	}else if('user_level' == $column_name){
		$uid = $user->ID;
		$user_level = get_user_meta($uid,'wp_user_level',true); 
        if($user_level == 0){ 
            $user_level = '普通会员'; 
        }else if( $user_level == 1 ){
            $user_level = '银牌理财师';
        }else if( $user_level == 2 ){
            $user_level = '金牌理财师';
        }else if( $user_level == 3 ){
            $user_level = '钻石理财师';
        }
        $user_level1 = get_user_meta($uid,'level_1',true);
        if($user_level1 != 0){
            $user_level_1 = sizeof(explode(',',$user_level1)).' 人'; 
        }else{
            $user_level_1 = '0 人';
        } 
        $user_level_2 = get_user_meta($uid,'level_2',true); 
        if($user_level_2 != 0){
            $user_level_2 = sizeof(explode(',',$user_level_2)).' 人'; 
        }else{
            $user_level_2 = '0 人';
        } 
        $user_level_3 = get_user_meta($uid,'level_3',true); 
        if($user_level_3 != 0){
            $user_level_3 = sizeof(explode(',',$user_level_3)).' 人'; 
        }else{
            $user_level_3 = '0 人';
        } 
        $user_level_4 = get_user_meta($uid,'level_4',true);
        if($user_level_4 != 0){
            $user_level_4 = sizeof(explode(',',$user_level_4)).' 人'; 
        }else{
            $user_level_4 = '0 人';
        } 
        $benjin_price  = get_user_meta($uid,'benjin_price',true);  if( $benjin_price == "")  { $benjin_price  = '0'; } //本金
		$lixi_price    = get_user_meta($uid,'lixi_price',true);    if( $lixi_price == "")    { $lixi_price    = '0'; } //利息
		$tuijian_price = get_user_meta($uid,'tuijian_price',true); if( $tuijian_price == "") { $tuijian_price = '0'; } //推荐奖
		$lingdao_price = get_user_meta($uid,'lingdao_price',true); if( $lingdao_price == "") { $lingdao_price = '0'; } //领导奖
		$jifen_price   = get_user_meta($uid,'jifen_price',true);   if( $jifen_price == "")   { $jifen_price   = '0'; } //积分
		$xiaofeibi     = get_user_meta($uid,'xiaofeibi',true);     if( $xiaofeibi == "")     { $xiaofeibi     = '0'; } //消费币
		$jihuobi       = get_user_meta($uid,'jihuobi',true);       if( $jihuobi == "")       { $jihuobi       = '0'; } //激活币
		$first_sell    = get_user_meta($uid,'first_sell',true);    if( $first_sell == "")    { $first_sell    = '0'; } //首次消费

		$t            = '';
        $tuijian_list = get_user_meta( $uid,'tuijian_list',true );
        if(empty($t) && !empty( $tuijian_list )){
            $new_list = explode('_', $tuijian_list);
            if( sizeof($new_list) >= 4){
                array_shift($new_list);
                $tuijian_list = implode('_',$new_list);        
            }
            $t .= $tuijian_list.'_';
        }
        $t.= $uid;
        $code = base64_encode($t);
		$t = '查看';
		$html = '
		<style type="text/css" media="screen">
			#TB_ajaxContent { width:96.5% !important; }
		</style>
		<div id="reason-content-'.$user_id.'" style="display:none;">
			<h3>推荐码：'.$code.'</h3>
			<h3>等级：'.$user_level.'</h3>
			<ul class="user_list">
				<li>一级直推人数：'.$user_level_1.'</li>
				<li>二级直推人数：'.$user_level_2.'</li>
				<li>三级直推人数：'.$user_level_3.'</li>
				<li>四级直推人数：'.$user_level_4.'</li>
			</ul>
			<ul class="user_list">
				<li>本金：    ￥'.$benjin_price.  '</li>
				<li>利息：    ￥'.$lixi_price.    '</li>
				<li>积分：    ￥'.$jifen_price.   '</li>
				<li>推荐奖：  ￥'.$tuijian_price. '</li>
				<li>领导奖：  ￥'.$lingdao_price. '</li>
				<li>消费币：  ￥'.$xiaofeibi.     '</li>
				<li>激活币：  ￥'.$jihuobi.       '</li>
				<li>首次消费：￥'.$first_sell.    '</li>
			</ul>
		</div>';
		return $html.'<a title="详情" href="#TB_inline?width=50&height=500&inlineId=reason-content-'.$user_id.'" class="thickbox">'.$t.'</a>';

	}else if('user_recommend' == $column_name){

		$user_recommend = get_user_meta($user_id,'tuijian',true);
		$user = get_user_by( 'id', $user_recommend );
		$username = $user->user_login;
		if(empty($username)){ $username = '暂无'; }
		return ''.$username.'';

	}else if('user_status' == $column_name){
		$user_recommend = get_user_meta($user_id,'tuijian',true);
		$user = get_user_by( 'id', $user_recommend );
		$username = $user->user_login;

		$user = get_user_by( 'id', $user_id );
		$user_status = '<span style="color:#00ff00;">正常</span>';
		if( $user->user_status == 0 ) { $user_status = '未激活'; }

		return ''.$user_status.'';

	}else if('user_date' == $column_name){

		$user_date = $user->user_registered;
		if(empty($user_date)){ $user_date = '暂无'; }

		return ''.$user_date.'';
	}else if('user_name' == $column_name){

		$display_name = $user->display_name;
		if(empty($display_name)){ $display_name = '暂无'; }

		return ''.$display_name.'';
	}else if('recommend_code' == $column_name){
		$t            = '';
        $tuijian_list = get_user_meta( $user->ID,'tuijian_list',true );
        if(empty($t) && !empty( $tuijian_list )){
            $new_list = explode('_', $tuijian_list);
            if( sizeof($new_list) >= 4){
                array_shift($new_list);
                $tuijian_list = implode('_',$new_list);        
            }
            $t .= $tuijian_list.'_';
        }
        $t.= $user->ID;
        $code = base64_encode($t);

		if(empty($code)){ $code = '暂无'; }

		return ''.$code.'';
	}
    return $value;
}

//用户登录
function func_login_action(){
	$name = $_REQUEST['username'];
	$psw  = $_REQUEST['psw'];
	$user = get_user_by('login',$name);
	$role = $user->roles;
	if($role[0] == "subscriber"){
		$username = $user->user_login;
	}
    //$username = $name;
    $password = esc_attr($psw);
    $remember = empty($remember) ? "true" : "false";

    $login_data = array();
    $login_data['user_login'] = $username;
    $login_data['user_password'] = $password;
    $login_data['remember'] = 'true';
    $user_verify = wp_signon($login_data, false);
    if (is_wp_error($user_verify)) {
        echo 0;
    } else {
        $userID = $user_verify->ID;
        wp_set_current_user( $userID, $username );
		wp_set_auth_cookie( $userID );
        echo 1;
    }
	die();
}
add_action("wp_ajax_nopriv_func_login_action", "func_login_action"); 
add_action("wp_ajax_func_login_action", "func_login_action");
//用户登录检测

function checkLogin(){
	$login_page = get_field('login_page','options');
	if ( !is_user_logged_in() ) {
		echo '<script> window.location.href = "'.$login_page.'"; </script>';
	}else{
		$current_user = wp_get_current_user();
	}
}
function checkLoginJump(){
	$login_page = get_field('login_page','options');
	if(!is_page_template( "tpl-login.php" ) && !is_page_template( "tpl-regist.php" )){
		if ( !is_user_logged_in() ) {
			echo '<script> window.location.href = "'.$login_page.'"; </script>';
		}else{
			echo '<script> window.location.href = "'.get_bloginfo('home').'"; </script>';
		}
	}
}

//后台登录权限
function xarold_no_admin_access(){ 
	if(is_user_logged_in()){
		if(( !current_user_can('customer_service') && 
				!current_user_can('custom_editor') && !current_user_can('administrator') ) 
				&& !wp_doing_ajax() ){
				wp_redirect(home_url());
			die();
		}
	}
}
add_action( 'admin_init', 'xarold_no_admin_access', 10 );

//Check Captcha
function checkValue(){
	$inputcaptcha = $_REQUEST['captcha'];
	if($_SESSION['secretword'] == $inputcaptcha){
		echo 'true';
	}else{
		echo 'false';
	}
	die();
}
add_action("wp_ajax_nopriv_checkValue", "checkValue"); // not login
add_action("wp_ajax_checkValue", "checkValue"); // not login

//检查推荐人是否存在
function checkTuijian(){
	global $wpdb;
	$tuijian1 = $_REQUEST['tuijian'];
	$tuijian2 = base64_decode($tuijian1);
	$new_list = explode('_', $tuijian2);
	array_shift($new_list);
	$id = $new_list[0];
	if(empty($id)){
		$id = $tuijian2;
	}
	$user = get_user_by( 'id', $id );
	$name = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM wp_data WHERE recommend_account = %s", $user->user_login) );
	if($user && !empty($name)){
		echo 'true';
	}else{
		echo 'false';
	}
	die();
}
add_action("wp_ajax_nopriv_checkTuijian", "checkTuijian"); // not login
add_action("wp_ajax_checkTuijian", "checkTuijian"); // not login

//检测用户是否存在
function checkUsername(){
	global $wpdb;
	$username = $_REQUEST['username'];
	$name = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM wp_data WHERE account = %s", $username) );
	$user = username_exists( $username );
	if(!$user && !empty($name)){
		echo 'true';
	}else{
		echo 'false';
	}
	die();
}
add_action("wp_ajax_nopriv_checkUsername", "checkUsername"); // not login
add_action("wp_ajax_checkUsername", "checkUsername"); // not login

//检测用户存在
function checkUsername2(){
	$username = $_REQUEST['username'];
	$user = username_exists( $username );
	if($user){
		echo 'true';
	}else{
		echo 'false';
	}
	die();
}
add_action("wp_ajax_nopriv_checkUsername2", "checkUsername2"); // not login
add_action("wp_ajax_checkUsername2", "checkUsername2"); // not login

//检测短信验证码
function checkMessageCode(){
	$checkcode = $_REQUEST['checkcode'];
	if($_SESSION['yzmcode'] == $checkcode ){
		echo 'true';
	}else{
		echo 'false';
	}
	die();
}
add_action("wp_ajax_nopriv_checkMessageCode", "checkMessageCode"); // not login
add_action("wp_ajax_checkMessageCode", "checkMessageCode"); // not login
//提现检测短信验证码
function checkMessageCode_Tx(){
	$phonecode = $_REQUEST['phonecode'];
	if($_SESSION['send_yzmcode'] == $phonecode ){
		echo 'true';
	}else{
		echo 'false';
	}
	die();
}
add_action("wp_ajax_nopriv_checkMessageCode_Tx", "checkMessageCode_Tx"); // not login
add_action("wp_ajax_checkMessageCode_Tx", "checkMessageCode_Tx"); // not login
//提现验证码获取
function send_msgcode(){
	global $current_user;
	$uid = $current_user->ID;
	$phone = get_user_meta($uid,'phone',true);
	$code = rand(100000, 999999);
	$_SESSION['send_yzmcode'] = $code;
	if(empty($phone) || $phone == ""){
		echo '您的手机号有误'; exit;
	}else{
		include TEMPLATEPATH.'/functions/alidayu/TopSdk.php';
		$c            = new TopClient;
		$c->appkey    = '23562448';
		$c->secretKey = '996e60f3664c74f84a461804176ad49d';
		$req          = new AlibabaAliqinFcSmsNumSendRequest;
		$req->setExtend("123");
		$req->setSmsType("normal");
		$req->setSmsFreeSignName("师联时代");
		$req->setSmsParam("{number:'".$code."'}");
		$req->setRecNum($phone);
		$req->setSmsTemplateCode("SMS_33485576");
		$resp = $c->execute($req);
		$error_code = $resp->code;
		$sub_msg    = $resp->sub_msg;
		$sub_code   = $resp->sub_code;
		if ($sub_code == 'isv.MOBILE_NUMBER_ILLEGAL') {
			$msg = '格式有误或发送失败!';
		} else {
			$msg = '格式有误或发送失败!';
		}
		if ($resp->result['err_code'] == 0 && !$error_code) {
			echo 1;
		} else {
			echo $msg;
		}
	}
	die();
}
add_action("wp_ajax_nopriv_send_msgcode", "send_msgcode"); // not login
add_action("wp_ajax_send_msgcode", "send_msgcode"); // not login
function creat_code() {
	
	// 先验证手机号是否已经注册
	$phonenum = $_REQUEST['value'];
	$code = rand(100000, 999999);
	$_SESSION['yzmcode'] = $code;
	//echo $code.'==========='; exit;
	//$msgdata ="您好，您正在师联注册账户，您的验证码是" . $code ;
	if(empty($phonenum) || $phonenum == ""){
		echo '请输入手机号'; exit;
	}else{
		include TEMPLATEPATH.'/functions/alidayu/TopSdk.php';
		$c            = new TopClient;
		$c->appkey    = '23562448';
		$c->secretKey = '996e60f3664c74f84a461804176ad49d';
		$req          = new AlibabaAliqinFcSmsNumSendRequest;
		$req->setExtend("123");
		$req->setSmsType("normal");
		$req->setSmsFreeSignName("师联时代");
		$req->setSmsParam("{number:'".$code."'}");
		$req->setRecNum($phonenum);
		$req->setSmsTemplateCode("SMS_33485576");
		$resp = $c->execute($req);
		$error_code = $resp->code;
		$sub_msg    = $resp->sub_msg;
		$sub_code   = $resp->sub_code;
		if ($sub_code == 'isv.MOBILE_NUMBER_ILLEGAL') {
			$msg = '格式有误或发送失败!';
		} else {
			$msg = '格式有误或发送失败!';
		}
		if ($resp->result['err_code'] == 0 && !$error_code) {
			echo 1;
		} else {
			echo $msg;
		}
	}

	die();
}
add_action("wp_ajax_nopriv_creat_code", "creat_code");
add_action("wp_ajax_creat_code", "creat_code");



// 用户注册 Function 
function func_regist_action(){
	global $table_prefix, $wpdb, $post;
	$table_name  = $wpdb->prefix."users";
	$tuijian     = $_REQUEST['tuijian'];
	$username    = $_REQUEST['username'];
	$phone       = $_REQUEST['phone'];
	$psw         = $_REQUEST['psw'];
	$name = $wpdb->get_var( $wpdb->prepare( "SELECT name FROM wp_data WHERE account = %s", $username) );
	if ( !username_exists($username) ){
		$userid = wp_insert_user( 
			array(
				'user_login'    => $username,
				'display_name'  => $name,
				'nickname'      => $name,
				'user_pass'     => $psw,
				'role'          => 'subscriber', //contributor
				'user_email'    => $phone.'@kissneck.com'
			)
		);
		if(!empty( $userid )){
			add_user_meta( $userid, 'phone',   $phone, true );
			if(!empty($tuijian)){
				$tuijian_de  = base64_decode($tuijian);
				$tuijian_arg = array_reverse(explode('_',$tuijian_de));
				$size_tj     = sizeof($tuijian_arg);
				$user   = get_user_by( 'id', $tuijian_arg[0] );
				$rename = $wpdb->get_var( $wpdb->prepare( "SELECT recommend FROM wp_data WHERE recommend_account = %s", $user->user_login) );
				add_user_meta( $userid, 'tuijian', $tuijian_arg[0], true );
				add_user_meta( $userid, 'tuijian_name',  $rename, true );
				add_user_meta( $userid, 'tuijian_list', $tuijian_de, true );
				if($size_tj >= 1){

					$level_1 = get_user_meta($tuijian_arg[0],'level_1',true );
					if( $level_1 == "" ){
						add_user_meta( $tuijian_arg[0], 'level_1', $userid, true );
					}else{
						if( $level_1 != 0 ) { $userid_1 = $level_1.','.$userid; }else{ $userid_1 = $userid; }
						update_user_meta( $tuijian_arg[0], 'level_1', $userid_1 );
					}
				}
				
				if($size_tj >= 2){

					$level_2 = get_user_meta($tuijian_arg[1],'level_2',true );
					if( $level_2 == "" ){
						add_user_meta( $tuijian_arg[1], 'level_2', $userid, true );
					}else{
						if( $level_2 != 0 ) { $userid_2 = $level_2.','.$userid; }else{ $userid_2 = $userid; }
						update_user_meta( $tuijian_arg[1], 'level_2', $userid_2 );
					}
				}
				
				if($size_tj >= 3){
					$level_3 = get_user_meta($tuijian_arg[2],'level_3',true );
					if( $level_3 == "" ){
						add_user_meta( $tuijian_arg[2], 'level_3', $userid, true );
					}else{
						if( $level_3 != 0 ) { $userid_3 = $level_3.','.$userid; }else{ $userid_3 = $userid; }
						update_user_meta( $tuijian_arg[2], 'level_3', $userid_3 );
					}
				}
				
				if($size_tj == 4){
					$level_4 = get_user_meta($tuijian_arg[3],'level_4',true );
					if( $level_4 == "" ){
						add_user_meta( $tuijian_arg[3], 'level_4', $userid, true );
					}else{
						if( $level_4 != 0 ) { $userid_4 = $level_4.','.$userid; }else{ $userid_4 = $userid; }
						update_user_meta( $tuijian_arg[3], 'level_4', $userid_4 );
					}
				}
			}
			add_user_meta( $userid, 'level_1', '0', true );
			add_user_meta( $userid, 'level_2', '0', true );
			add_user_meta( $userid, 'level_3', '0', true );
			add_user_meta( $userid, 'level_4', '0', true );

			//属性
			add_user_meta( $userid, 'benjin_price', '0', true );
			add_user_meta( $userid, 'lixi_price', '0', true );
			add_user_meta( $userid, 'tuijian_price', '0', true );
			add_user_meta( $userid, 'lingdao_price', '0', true );
			add_user_meta( $userid, 'jifen_price', '0', true );
			add_user_meta( $userid, 'xiaofeibi', '0', true );
			add_user_meta( $userid, 'jihuobi', '0', true );
			add_user_meta( $userid, 'first_sell', '0', true );
			add_user_meta( $userid, 'first_sell_time', '0', true );
			add_user_meta( $userid, 'round_time', '0', true );
			//wp_set_current_user( $userid, $username );
			//wp_set_auth_cookie( $userid );
			echo '1|'.$userid;
			exit;
		}else{
			echo '2|'.$userid;
		}
	}else{
		echo "2|用户名已存在."; 	
	}

	die();
}
add_action("wp_ajax_nopriv_func_regist_action", "func_regist_action"); // not login
add_action("wp_ajax_func_regist_action", "func_regist_action"); // not login


//联系我们
function func_contact_action(){
	global $current_user;
	$note = $_REQUEST['note'];
	$username = $current_user->user_login;
	$userid   = $current_user->ID;
	$post_array = array(
		'post_title'     => '用户：'.$username.'留言',
		'post_status'    => 'publish',
		'post_type'      => 'type_usermessage',
		'post_content'   => $note,
		'post_author'    => $userid
	);
	$pid = wp_insert_post( $post_array );
	if($pid){
		echo 1;
	}
	die();
}

add_action("wp_ajax_nopriv_func_contact_action", "func_contact_action"); // not login
add_action("wp_ajax_func_contact_action", "func_contact_action"); // not login


//定制用户反馈列表
add_filter( 'manage_edit-type_usermessage_columns', 'my_edit_type_usermessage_columns' ) ;

function my_edit_type_usermessage_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( '留言用户' ),
		'content' => __( '内容' ),
		'replay'  => __( '回复' ),
		'date'    => __( 'Date' ),
		'ssid'    => __( 'ID' )
	);

	return $columns;
}

add_action( 'manage_type_usermessage_posts_custom_column', 'my_manage_type_usermessage_columns', 10, 2 );

function my_manage_type_usermessage_columns( $column, $post_id ) {
	global $post;
	$postinfo = get_post($post_id);
	switch( $column ) {
		case 'contact' :
				echo $postinfo->post_title;
			break;
		case 'content' :
				$post_content2 = $postinfo->post_content;
				if ( !empty( $post_content2 ) ) {
					echo '<div id="my-content-'.$post_id.'" style="display:none;">'.wpautop($post_content2).'</div>';
					echo '<a title="留言内容" href="#TB_inline?width=400&height=250&inlineId=my-content-'.$post_id.'" class="thickbox">查看</a>';
				}else {
					_e( '暂无' );
				}
			break;
		case 'replay' :
				$replay_content = get_post_meta($post_id,'replay_content',true);
				if(!empty($replay_content)){ $t = '已回复'; }else{ $t = '回复'; }
				echo '
				<style type="text/css" media="screen">
					#TB_ajaxContent { width:96.5% !important; }
				</style>
				<div id="replay-content-'.$post_id.'" style="display:none;">
						<form action="" name="replayForm" method="post" accept-charset="utf-8">
							<textarea style="width:100%;"  rows="10" id="replay_content'.$post_id.'"  name="replay_content">'.$replay_content.'</textarea>
							<input type="hidden" name="pid" id="pid" value="'.$post_id.'">
							<input rel="'.$post_id.'" type="submit" class="button replay-submit" name="replay-submit" value="提交">
						</form>
				</div>';
				echo '<a title="输入回复内容" href="#TB_inline?width=50&height=250&inlineId=replay-content-'.$post_id.'" class="thickbox">'.$t.'</a>';
			break;
		default :
			break;
	}
}

//定制消费记录
add_filter( 'manage_edit-type_sellrecord_columns', 'my_edit_type_sellrecord_columns' ) ;

function my_edit_type_sellrecord_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( '金额(￥)' ),
		'lixi' => __( '利息' ),
		'username' => __( '用户' ),
		'status' => __( '状态' ),
		'date' => __( '消费日期' ),
		'ssid' => __( 'ID' )
	);

	return $columns;
}

add_action( 'manage_type_sellrecord_posts_custom_column', 'my_manage_type_sellrecord_columns', 10, 2 );

function my_manage_type_sellrecord_columns( $column, $post_id ) {
	global $post;
	$postinfo = get_post($post_id);
	switch( $column ) {
		case 'price' :
				echo '￥'.$postinfo->post_title;
			break;
		case 'date2' :
				echo $postinfo->post_date;
			break;
		case 'lixi' :
				$sell_lixi    = get_post_meta($post_id,'sell_lixi',true); 
                if($sell_lixi == ""){ $sell_lixi = 0; }
                echo '￥'.$sell_lixi;
			break;
		case 'username' :
				$user = get_user_by('id',$postinfo->post_author);
				echo $user->user_login;
			break;		
		case 'status' :
            $sell_status  = get_post_meta($post_id,'sell_status',true); 
            if($sell_status == 0){  $sell_status = "未完成"; }else{ $sell_status = "完成"; }
            echo $sell_status;
		break;
		default :
			break;
	}
}

//定制利息明细
add_filter( 'manage_edit-type_lixidetail_columns', 'my_edit_type_lixidetail_columns' ) ;

function my_edit_type_lixidetail_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( '金额(￥)' ),
		'note' => __( '备注' ),
		'username' => __( '用户' ),
		'date' => __( '日期' ),
		'ssid' => __( 'ID' )
	);

	return $columns;
}

add_action( 'manage_type_lixidetail_posts_custom_column', 'my_manage_type_lixidetail_columns', 10, 2 );

function my_manage_type_lixidetail_columns( $column, $post_id ) {
	global $post;
	$postinfo = get_post($post_id);
	switch( $column ) {
		case 'price' :
				echo '￥'.$postinfo->post_title;
			break;
		case 'date2' :
				echo $postinfo->post_date;
			break;
		case 'note' :
				echo $postinfo->post_content;
			break;
		case 'username' :
				$user = get_user_by('id',$postinfo->post_author);
				echo $user->user_login;
			break;	
		default :
			break;
	}
}

//定制转账记录
add_filter( 'manage_edit-type_tranfer_columns', 'my_edit_type_tranfer_columns' ) ;

function my_edit_type_tranfer_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( '接受人' ),
		'tto' => __( '发起人' ),
		'number' => __( '数量' ),
		'type' => __( '类型' ),
		'note' => __( '备注' ),
		'date' => __( '日期' ),
		'ssid' => __( 'ID' )
	);

	return $columns;
}

add_action( 'manage_type_tranfer_posts_custom_column', 'my_manage_type_tranfer_columns', 10, 2 );

function my_manage_type_tranfer_columns( $column, $post_id ) {
	global $post;
	//$post_type_obj = get_post_type_object( "type_tranfer" );
	//p($post_type_obj->cap->delete_posts);
	$postinfo = get_post($post_id);
	switch( $column ) {
		case 'gget' :
				echo $postinfo->post_title;
			break;
		case 'number' :
				$to_number  = get_post_meta($post_id,'to_number',true);
				echo $to_number;
			break;
		case 'type' :
				$price_type  = get_post_meta($post_id,'price_type',true);
				if($price_type == "jihuobi"){ $type = '激活币转账'; }else{ $type = "消费币转账"; }
				echo $type;
			break;	
		case 'note' :
				$content = $postinfo->post_content;
				if(empty($content)){ $content = '无'; }
				echo $content;
			break;
		case 'tto' :
				$user = get_user_by('id',$postinfo->post_author);
				echo $user->user_login;
			break;	
		default :
			break;
	}
}

//积分转移记录
add_filter( 'manage_edit-type_jinfen_columns', 'my_edit_type_jinfen_columns' ) ;

function my_edit_type_jinfen_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( '金额(￥)' ),
		'type' => __( '类型' ),
		'note' => __( '备注' ),
		'author'  => __( '用户' ),
		'date' => __( '日期' ),
		'ssid' => __( 'ID' )
	);

	return $columns;
}

add_action( 'manage_type_jinfen_posts_custom_column', 'my_manage_type_jinfen_columns', 10, 2 );

function my_manage_type_jinfen_columns( $column, $post_id ) {
	global $post;
	$postinfo = get_post($post_id);
	switch( $column ) {
		case 'price' :
				echo '￥'.$postinfo->post_title;
			break;
		case 'type' :
				$tranfer_source  = get_post_meta($post_id,'tranfer_source',true);
				if($tranfer_source == "lixi"){
                    $type = '利息';   //利息
                }else if($tranfer_source == "jiangjin"){
                    $type = '奖金';   //推荐奖
                }else{
                    $type = '晋级奖金';   //领导奖
                }
				echo $type;
			break;	
		case 'note' :
				$content = $postinfo->post_content;
				if(empty($content)){ $content = '无'; }
				echo $content;
			break;
		default :
			break;
	}
}

//本金充值管理
add_filter( 'manage_edit-type_benjin_columns', 'my_edit_type_benjin_columns' ) ;

function my_edit_type_benjin_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( '金额(￥)' ),
		'author'  => __( '用户' ),
		'note' => __( '备注' ),
		'status' => __( '状态' ),
		//'reason' => __( '原因' ),
		'action' => __( '操作' ),
		'date' => __( '日期' ),
		'ssid' => __( 'ID' )
	);

	return $columns;
}

add_action( 'manage_type_benjin_posts_custom_column', 'my_manage_type_benjin_columns', 10, 2 );

function my_manage_type_benjin_columns( $column, $post_id ) {
	global $post;
	$postinfo = get_post($post_id);
	switch( $column ) {
		case 'title' :
				echo '￥'.$postinfo->post_title;
			break;
		case 'status' :
				$pay_status  = get_post_meta($post_id,'pay_status',true);
				$reason_content  = get_post_meta($post_id,'reason_content',true);
				if($pay_status == "1"){
					$status = '<span style="color:#ff0000;">通过</span>';
                }else if(!empty($reason_content)){
                    $status = '未通过'; 
                }else{
                	$status = '审核中'; 
                }
                echo '<span class="paystatus'.$post_id.'">'.$status.'</span>';
			break;	
		case 'note' :
				$content = $postinfo->post_content;
				if(empty($content)){ $content = '无'; }
				echo $content;
			break;
		case 'reason' :
				$reason_content  = get_post_meta($post_id,'reason_content',true);
				$t = '查看/填写';
				echo '
				<style type="text/css" media="screen">
					#TB_ajaxContent { width:96.5% !important; }
				</style>
				<div id="reason-content-'.$post_id.'" style="display:none;">
					<form action="" name="reasonForm" method="post" accept-charset="utf-8">
						<textarea style="width:100%;"  rows="10" id="reason_content'.$post_id.'"  name="reason_content">'.$reason_content.'</textarea>
						<input type="hidden" name="pid" id="pid" value="'.$post_id.'">
						<input rel="'.$post_id.'" type="submit" class="button reason-submit" name="reason-submit" value="提交">
					</form>
				</div>';
				echo '<a title="未通过原因" href="#TB_inline?width=50&height=250&inlineId=reason-content-'.$post_id.'" class="thickbox">'.$t.'</a>';
			break;
		case 'action' :
			$pay_status  = get_post_meta($post_id,'pay_status',true);
			if(empty($pay_status)){ $pay_status = 0; }  
			if($pay_status != 1){ $text = "通过"; }else{ $text = "不通过"; }
			echo '<button rel="'.$post_id.'" data="'.$pay_status.'" class="reason-btn btn btn'.$post_id.' green">'.$text.'</button>';
			break;		
		default :
			break;
	}
}

//奖金管理
add_filter( 'manage_edit-type_jiangjin_columns', 'my_edit_type_jiangjin_columns' ) ;

function my_edit_type_jiangjin_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( '奖金(￥)' ),
		'username' => __( '用户' ),
		'tuijian' => __( '推荐人' ),
		'note' => __( '备注' ),
		'date' => __( '日期' ),
		'ssid' => __( 'ID' )
	);

	return $columns;
}

add_action( 'manage_type_jiangjin_posts_custom_column', 'my_manage_type_jiangjin_columns', 10, 2 );

function my_manage_type_jiangjin_columns( $column, $post_id ) {
	global $post;
	$postinfo = get_post($post_id);
	switch( $column ) {
		case 'price' :
				echo '￥'.$postinfo->post_title;
			break;
		case 'date2' :
				echo $postinfo->post_date;
			break;
		case 'note' :
                echo $postinfo->post_content;
			break;
		case 'username' :
				$user = get_user_by('id',$postinfo->post_author);
				echo $user->user_login;
			break;		
		case 'status' :
            $sell_status  = get_post_meta($post_id,'sell_status',true); 
            if($sell_status == 0){  $sell_status = "未完成"; }else{ $sell_status = "完成"; }
            echo $sell_status;
		break;
		default :
			break;
	}
}

//晋级管理

add_filter( 'manage_edit-type_jinji_columns', 'my_edit_type_jinji_columns' ) ;

function my_edit_type_jinji_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( '金额(￥)' ),
		'status' => __( '备注' ),
		'date' => __( '日期' ),
		'ssid' => __( 'ID' )
	);

	return $columns;
}

add_action( 'manage_type_jinji_posts_custom_column', 'my_manage_type_jinji_columns', 10, 2 );

function my_manage_type_jinji_columns( $column, $post_id ) {
	global $post;
	$postinfo = get_post($post_id);
	switch( $column ) {
		case 'price' :
				echo '￥'.$postinfo->post_title;
			break;
		case 'date2' :
				echo $postinfo->post_date;
			break;
		case 'lixi' :
				$sell_lixi    = get_post_meta($post_id,'sell_lixi',true); 
                if($sell_lixi == ""){ $sell_lixi = 0; }
                echo '￥'.$sell_lixi;
			break;
		case 'username' :
				$user = get_user_by('id',$postinfo->post_author);
				echo $user->user_login;
			break;		
		case 'status' :
            $sell_status  = get_post_meta($post_id,'sell_status',true); 
            if($sell_status == 0){  $sell_status = "未完成"; }else{ $sell_status = "完成"; }
            echo $sell_status;
		break;
		default :
			break;
	}
}

//提现管理
add_filter( 'manage_edit-type_tixian_columns', 'my_edit_type_tixian_columns' ) ;

function my_edit_type_tixian_columns( $columns ) {

	$columns = array(
		'cb'       => '<input type="checkbox" />',
		'price'    => __( '提现金额' ),
		'fact_price'     => __( '实际金额' ),
		'jifen'    => __( '积分金额' ),
		'total'    => __( '剩余金额' ),
		'type'     => __( '类型' ),
		'note'     => __( '备注' ),
		'replay'   => __( '回复' ),
		'status'   => __( '状态' ),
		'action'   => __( '操作' ),
		'author' => __( '用户' ),
		'date'     => __( '日期' ),
		//'ssid'     => __( 'ID' )
	);

	return $columns;
}

add_action( 'manage_type_tixian_posts_custom_column', 'my_manage_type_tixian_columns', 10, 2 );

function my_manage_type_tixian_columns( $column, $post_id ) {
	global $post;
	$postinfo = get_post($post_id);
	switch( $column ) {
		case 'price' :
				echo '￥'.$postinfo->post_title;
			break;

		case 'total' :
				$new_price    = get_post_meta($post_id,'new_price',true); 
                if($new_price == ""){ $new_price = 0; }
				echo '￥'.$new_price;
			break;
		case 'type' :
				$tixian_type    = get_post_meta($post_id,'tixian_type',true); 
                if($tixian_type == "benjin_price"){ $tixian_type = "本金"; }else{ $tixian_type = "利息"; }
                echo $tixian_type;
			break;
		case 'jifen' :
				$tixian_jifen    = get_post_meta($post_id,'tixian_jifen',true); 
                if($tixian_jifen == ""){ $tixian_jifen = 0; }
                echo '￥'.$tixian_jifen;
			break;
		case 'fact_price' :
				$fact_price    = get_post_meta($post_id,'fact_price',true); 
                if($fact_price == ""){ $fact_price = 0; }
                echo '￥'.$fact_price;
			break;
		case 'note' :
				$post_content2 = $postinfo->post_content;
				if ( !empty( $post_content2 ) ) {
					echo '<div id="my-content-'.$post_id.'" style="display:none;">'.wpautop($post_content2).'</div>';
					echo '<a title="留言内容" href="#TB_inline?width=400&height=250&inlineId=my-content-'.$post_id.'" class="thickbox">查看</a>';
				}else {
					_e( '暂无' );
				}
                //echo $postinfo->post_content;
			break;	
		case 'replay' :
				$tixian_replay    = get_post_meta($post_id,'tixian_replay',true); 
				if(!empty($tixian_replay)){ $t = '已回复'; }else{ $t = '回复'; }
				echo '
				<style type="text/css" media="screen">
					#TB_ajaxContent { width:96.5% !important; }
				</style>
				<div id="tixian-content-'.$post_id.'" style="display:none;">
					<form action="" name="replayForm" method="post" accept-charset="utf-8">
						<textarea style="width:100%;"  rows="10" id="tixian_replay'.$post_id.'"  name="tixian_replay">'.$tixian_replay.'</textarea>
						<input type="hidden" name="pid" id="pid" value="'.$post_id.'">
						<input rel="'.$post_id.'" type="submit" class="button replay-tixian" name="replay-tixian" value="提交">
					</form>
				</div>';
				echo '<a title="输入回复内容" href="#TB_inline?width=50&height=250&inlineId=tixian-content-'.$post_id.'" class="thickbox">'.$t.'</a>';
			break;		
		case 'status' :
            $tixian_status  = get_post_meta($post_id,'tixian_status',true); 
            if($tixian_status == 0){  $tixian_status = "审核中"; }else{ $tixian_status = "通过"; }
            echo '<span class="txstatus'.$post_id.'">'.$tixian_status.'</span>';
            //echo $tixian_status;
		break;
		case 'action' :
			$tixian_status  = get_post_meta($post_id,'tixian_status',true);
			if(empty($tixian_status)){ $tixian_status = 0; }  
			if($tixian_status != 1){ $text = "通过"; }else{ $text = "不通过"; }
			echo '<button rel="'.$post_id.'" data="'.$tixian_status.'" class="tx-reason-btn btn btn'.$post_id.' green">'.$text.'</button>';
			break;	
		default :
			break;
	}
}

//二级密码存储
function func_secpsw_action(){
	$value  = $_REQUEST;
	$secpsw = sha1(md5($value['secpsw']));
	if(!empty($value['uid'])){
		add_user_meta( $value['uid'],'second_password',$secpsw,true ) or update_user_meta( $value['uid'],'second_password',$secpsw );
		add_user_meta( $value['uid'],'second_password_user',$value['secpsw'],true) or update_user_meta( $value['uid'],'second_password_user',$value['secpsw']);
		echo '1';
	}else{
		echo '2';
	}
	//p($value);
	die();
}
add_action("wp_ajax_func_secpsw_action", "func_secpsw_action");
add_action("wp_ajax_nopriv_func_secpsw_action", "func_secpsw_action");

//银行信息更换
function func_change_bank_action(){
	global $current_user;
	$uid = $current_user->ID;
	$banktype  = $_REQUEST['banktype'];
	$bankopen  = $_REQUEST['bankopen'];
	$bankuser  = $_REQUEST['bankuser'];
	$cardnum   = $_REQUEST['cardnum'];

	add_user_meta( $uid,'bank_type',$banktype,true ) or update_user_meta( $uid,'bank_type',$banktype );
	add_user_meta( $uid,'bankopen',$bankopen,true ) or update_user_meta( $uid,'bankopen',$bankopen );
	add_user_meta( $uid,'bankuser',$bankuser,true ) or update_user_meta( $uid,'bankuser',$bankuser );
	add_user_meta( $uid,'cardnum',$cardnum,true ) or update_user_meta( $uid,'cardnum',$cardnum );

	echo '1';
	die();

}
add_action("wp_ajax_func_change_bank_action", "func_change_bank_action");

//密码更换
function func_change_psw_action(){
	global $current_user;
	$uid = $current_user->ID;
	$username = $current_user->user_login;
	$oldpsw  = $_REQUEST['oldpsw'];
	$newpsw  = $_REQUEST['newpsw'];
	$repsw   = $_REQUEST['repsw'];
	$status = wp_authenticate( $username, $oldpsw );
	if($status->ID){
		$user_id  = $uid;
		$password = $newpsw;
		wp_set_password( $password, $user_id );
		echo '1';
	}else{
		echo 'bad';
	}
	
	die();
}
add_action("wp_ajax_func_change_psw_action", "func_change_psw_action");



//二级密码更换
function func_change_secpsw_action(){
	global $current_user;
	$uid = $current_user->ID;
	$username = $current_user->user_login;
	$oldsecpsw   = $_REQUEST['oldsecpsw'];
	$oldsecpsw   = sha1(md5($oldsecpsw));

	$newsecpsw   = $_REQUEST['newsecpsw'];
	$resecpsw    = $_REQUEST['resecpsw'];
	$second_password      = get_user_meta($uid,'second_password',true);
	if(empty($second_password) || $second_password == $oldsecpsw){
		$nsecpsw = sha1(md5($newsecpsw));
		add_user_meta( $uid,'second_password',$nsecpsw,true ) or update_user_meta( $uid,'second_password',$nsecpsw );
		add_user_meta( $uid,'second_password_user',$newsecpsw,true ) or update_user_meta( $uid,'second_password_user',$newsecpsw );
		echo '1';
	}else{
		echo 'bad';
	}
	die();
}
add_action("wp_ajax_func_change_secpsw_action", "func_change_secpsw_action");

//添加用户触发此方法
add_action( 'user_register', 'myplugin_registration_save', 10, 1 );

function myplugin_registration_save( $user_id ) {
	global $current_user,$wpdb;
	$table_name = $wpdb->prefix."users";
	$gg = get_field('second_password_user','user_'.$user_id);
	$active_user = get_field('active_user','user_'.$user_id);
	$gg = get_field('second_password_user','user_'.$user_id);
	if( !empty($gg) ){
		$secpsw  = sha1(md5($gg));
		update_user_meta( $user_id,'second_password',$secpsw );
	}
	$wpdb->query("UPDATE $table_name SET user_status = $active_user WHERE ID =".$user_id);
    //echo 'fffff';
    //exit;
}

//更新用户出发此方法
add_action( 'profile_update', 'my_profile_update', 10, 2 );

function my_profile_update( $user_id, $old_user_data ) {
	global $current_user,$wpdb;
	$table_name = $wpdb->prefix."users";
	$gg = get_field('second_password_user','user_'.$user_id);
	$active_user = get_field('active_user','user_'.$user_id);
	$gg = get_field('second_password_user','user_'.$user_id);
	if( !empty($gg) ){
		$secpsw  = sha1(md5($gg));
		update_user_meta( $user_id,'second_password',$secpsw );
	}
	$wpdb->query("UPDATE $table_name SET user_status = $active_user WHERE ID =".$user_id);
}

//我要消费
function func_tosell_action(){
	global $current_user;
	$uid = $current_user->ID;
	$username = $current_user->user_login;
	$userdate = $current_user->user_registered;
	$time = strtotime($userdate); 
	$month1  = date("Y-m-d", strtotime("+1 month", $time));
	$month2  = date("Y-m-d", strtotime("+2 month", $time));
	$month3  = date("Y-m-d", strtotime("+3 month", $time));
	$current_date  = date("Y-m-d",time());
	$price_limit   = get_field('price_limit','options');
	$day_lixi      = get_field('day_lixi','options');   //用户利息
	$benjin_kouchu = get_field('benjin_kouchu','options'); //本金消费是按照月份扣除的百分比
	
	$benjin_percent_one = $benjin_kouchu[0]['benjin_month_one'];
	$benjin_percent_two = $benjin_kouchu[0]['benjin_month_two'];
	$benjin_percent_thr = $benjin_kouchu[0]['benjin_month_three'];

	if($current_date <= $month1 ){
		$benjin_percent = $benjin_percent_one*0.01;
	}else if($current_date > $month1 && $current_date <= $month2){
		$benjin_percent = $benjin_percent_two*0.01;
	}else if($current_date > $month2 && $current_date <= $month3){
		$benjin_percent = $benjin_percent_thr*0.01;
	}else{
		$benjin_percent = $benjin_percent_thr*0.01;
	}

	$second_password   = get_user_meta($uid,'second_password',true);
	$benjin_price      = get_user_meta($uid,'benjin_price',true);   //本金
	$p_money       = $_POST['p_money'];
	if( $p_money > $benjin_price ){
		echo '本金 ( ￥'.$benjin_price.' ) 余额不足，请先进行充值！'; exit;
	}
	if( $p_money >= 2000 && $p_money <= 10000 ){
		$xfb = 1;
	}else if( $p_money >= 12000  &&  $p_money <= 20000 ){
		$xfb = 2;
	}else if( $p_money >= 22000  &&  $p_money <= 30000 ){
		$xfb = 3;
	}else if( $p_money >= 40000  &&  $p_money <= 60000 ){
		$xfb = 4;
	}else if( $p_money >= 70000  &&  $p_money <= 90000 ){
		$xfb = 5;
	}else if( $p_money >= 100000 &&  $p_money <= 120000 ){
		$xfb = 6;
	}

	$benjin_price  = ( $benjin_price-$p_money );
	$lixi_price    = get_user_meta($uid,'lixi_price',true);     //利息
	$xiaofeibi     = get_user_meta($uid,'xiaofeibi',true);     //消费币
	$first_sell    = get_user_meta($uid,'first_sell',true);    //首次消费
	$round_time    = get_user_meta($uid,'round_time',true);    //每轮截至时间
	$get_lixi      = $p_money*($day_lixi/100);
	$curren_lixi   = ( $get_lixi+$lixi_price );
	$currentprice  = sprintf( "%.2f", $benjin_price*$benjin_percent ); 
	$curren_benj   = ( $benjin_price-$currentprice );
	$current_xfb   = ( $xiaofeibi-$xfb );
	$secpsw  = sha1(md5($_POST['secpsw']));
	if( $second_password == $secpsw ){
		$post_array = array(
			'post_title'     => $p_money,
			'post_status'    => 'publish',
			'post_type'      => 'type_sellrecord',
			'post_content'   => '',
			'post_author'    => $uid
		);
		$pid = wp_insert_post( $post_array );
		if($pid){
			$sell_time = time();
			add_post_meta( $pid,'sell_status',1,true ) or update_post_meta( $pid,'sell_status',1 );
			add_post_meta( $pid,'sell_lixi',$get_lixi,true ) or update_post_meta( $pid,'sell_lixi',$get_lixi );
			update_user_meta( $uid,'benjin_price',$curren_benj );
			update_user_meta( $uid,'lixi_price',$curren_lixi );
			if($first_sell == 0 || $first_sell == ""){

				$round_time = strtotime("+".$price_limit." days", $sell_time);
				update_user_meta( $uid,'first_sell',$p_money );
				add_user_meta( $uid,'first_sell_time',$sell_time,true ) or update_user_meta( $uid,'first_sell_time',$sell_time );
				$round_time_1 = strtotime("+".$price_limit." days", $sell_time);
				add_user_meta($uid,'round_time',$round_time_1,true) or update_user_meta($uid,'round_time',$round_time_1);
				add_user_meta($uid,'round_status',0,true); 

			}
			if( !empty($round_time) && date('Y-m-d',$round_time) < date('Y-m-d',time()) ){

				$round_time_x = strtotime("+".$price_limit." days", $sell_time);
				update_user_meta($uid,'round_time',$round_time_x);
				update_user_meta($uid,'round_status',0); 

			}
			update_user_meta( $uid,'xiaofeibi',$current_xfb );
			$lixi_array = array(
				'post_title'     => $get_lixi,
				'post_status'    => 'publish',
				'post_type'      => 'type_lixidetail',
				'post_content'   => '消费 ￥'.$p_money.' 获得 '.$day_lixi.'% 的利息',
				'post_author'    => $uid
			);
			wp_insert_post( $lixi_array );
			echo '1';
		}
	}else{
		echo '<b>提示：</b> 二级密码有误，请重新输入';
	}
die();
}
add_action("wp_ajax_func_tosell_action", "func_tosell_action");

//会员转账
function func_tranfer_action(){
	global $current_user,$wpdb;
	$table_name = $wpdb->prefix."users";
	$uid        = $current_user->ID;
	$username   = $_POST['username'];
	$price_type = $_POST['price_type'];
	$number     = $_POST['number'];
	$note       = $_POST['note'];
	$user       = get_user_by('login',$username);
	if($uid != $user->ID){
		$xiaofeibi    = get_user_meta($uid,'xiaofeibi',true);   
		$jihuobi      = get_user_meta($uid,'jihuobi',true);

		$toxiaofeibi  = get_user_meta($user->ID,'xiaofeibi',true);
		$tojihuobi    = get_user_meta($user->ID,'jihuobi',true);
		if($price_type == "xiaofeibi"){
			if( $number > $xiaofeibi ){
				echo '消费币不足'; exit;
			}else{
				$newtoxiaofeibi = ( $toxiaofeibi+$number );
				update_user_meta( $user->ID,'xiaofeibi',$newtoxiaofeibi );
				update_user_meta( $uid,'xiaofeibi',($xiaofeibi-$number) );
			}
		}else{ 
			if( $number > $jihuobi ){
				echo '激活币不足'; exit;
			}else{
				$active_xiaofeibi = get_field('active_xiaofeibi','options');
				$newtojihuobi = ( $tojihuobi+$number );
				if( $newtojihuobi >= $active_xiaofeibi ){
					$wpdb->query("UPDATE $table_name SET user_status = 1 WHERE ID =".$user->ID);
				}
				update_user_meta( $user->ID,'jihuobi',$newtojihuobi );
				update_user_meta( $uid,'jihuobi',($jihuobi-$number) );
			}
		}

		$tranfer_array = array(
			'post_title'     => $username,
			'post_status'    => 'publish',
			'post_type'      => 'type_tranfer',
			'post_content'   => $note,
			'post_author'    => $uid
		);
		$pid = wp_insert_post( $tranfer_array );
		if($pid){
			add_post_meta( $pid,'to_number',$number,true ) or update_post_meta( $pid,'to_number',$number );
			add_post_meta( $pid,'price_type',$price_type,true ) or update_post_meta( $pid,'price_type',$price_type );
		}
		echo '1';
	}else{
		echo '不能为自己转账';
	}
	//p($_POST);
	die();
}
add_action("wp_ajax_func_tranfer_action", "func_tranfer_action");


//积分转移
function func_movejifen_action(){
	global $current_user,$wpdb;
	$uid               = $current_user->ID;
	$tranfer_source    = $_POST['tranfer_source'];
	$move_price        = $_POST['move_price'];
	$secpsw            = $_POST['secpsw'];
	$note              = $_POST['note'];
	$second_password   = get_user_meta($uid,'second_password',true);
	$secpsw  = sha1(md5($secpsw));
	if( $second_password == $secpsw ){
		if($tranfer_source == "lixi"){
			$lixi_price = get_user_meta($uid,'lixi_price',true);   //利息
			if( $move_price > $lixi_price ){
				echo '利息 ( ￥'.$lixi_price.' ) 余额不足！'; exit;
			}else{ $new_price = ($lixi_price-$move_price); $new_key = 'lixi_price'; }
		}else if($tranfer_source == "jiangjin"){
			$tuijian_price = get_user_meta($uid,'tuijian_price',true);   //推荐奖
			if( $move_price > $tuijian_price ){
				echo '奖金 ( ￥'.$tuijian_price.' ) 余额不足！'; exit;
			}else{  $new_price = ($tuijian_price-$move_price); $new_key = 'tuijian_price'; }
		}else{
			$lingdao_price = get_user_meta($uid,'lingdao_price',true);   //领导奖
			if( $move_price > $lingdao_price ){
				echo '晋级奖金 ( ￥'.$lingdao_price.' ) 余额不足！'; exit;
			}else{ $new_price = ($lingdao_price-$move_price); $new_key = 'lingdao_price'; }
		}
		$move_array = array(
			'post_title'     => $move_price,
			'post_status'    => 'publish',
			'post_type'      => 'type_jinfen',
			'post_content'   => $note,
			'post_author'    => $uid
		);
		$pid = wp_insert_post( $move_array );
		if($pid){
			update_user_meta($uid,$new_key,$new_price);
			$jifen_price   = get_user_meta($uid,'jifen_price',true);
			update_user_meta( $uid,'jifen_price',($jifen_price+$move_price) );
			add_post_meta( $pid,'tranfer_source',$tranfer_source,true ) or update_post_meta( $pid,'tranfer_source',$tranfer_source );
			echo 1;
		}
	}else{
		echo '<b>提示：</b> 二级密码有误，请重新输入'; exit;
	}
	die();
}
add_action("wp_ajax_func_movejifen_action", "func_movejifen_action");

//提现操作
function func_tixian_action(){
	global $current_user,$wpdb;
	$uid               = $current_user->ID;
	$tixian_type       = $_POST['tixian_type'];
	$tixian_price      = $_POST['tixian_price'];
	$secpsw            = $_POST['secpsw'];
	$phonecode         = $_POST['phonecode'];
	$note              = $_POST['note'];
	$tixian_price_juan = get_field('tixian_price_juan','options');
	if( $tixian_price_juan > $tixian_price ){
		echo '2|失败，提现金额低于今日最低额度'; exit;
	}
	$t_num   = floor($tixian_price/$tixian_price_juan);
	$t_price = $t_num*$tixian_price_juan; 
	$l_price = $tixian_price - $t_price;
	$second_password   = get_user_meta($uid,'second_password',true);
	$secpsw  = sha1(md5($secpsw));
	if( $second_password == $secpsw ){
		$lixi_tixian        = get_field('lixi_tixian','options');
        $benjin_tixian_bili = get_field('benjin_tixian_bili','options');
		$tixian_arg = array(
			'post_title'     => $t_price,
			'post_status'    => 'publish',
			'post_type'      => 'type_tixian',
			'post_content'   => $ooo,
			'post_author'    => $uid
		);
		if($tixian_type == "lixi"){
			$lixi_price = get_user_meta($uid,'lixi_price',true);   //利息
			if( $tixian_price > $lixi_price ){
				echo '2|提现金额超出，您只有利息 ( ￥'.$lixi_price.' )！'; exit;
			}else{ 
				$new_price  = ($lixi_price-$t_price); 
				$new_txp_jf = ($lixi_tixian[0]['jifen_package']*$t_price*0.01);
				$new_txp    = ($lixi_tixian[0]['cash']*$t_price*0.01);
				$new_price  = $lixi_price-$t_price;
				$new_key    = 'lixi_price'; 
			}
		}else{
			$benjin_price = get_user_meta($uid,'benjin_price',true);   //领导奖
			if( $tixian_price > $benjin_price ){
				echo '2|提现金额超出，您只有本金 ( ￥'.$benjin_price.' )！'; exit;
			}else{ 
				$new_key    = 'benjin_price';
				$new_txp_jf = '0';
				$new_txp    = ($benjin_tixian_bili*$t_price*0.01);
				$new_price  = $benjin_price-$t_price;
			}
		}

		$tid = wp_insert_post( $tixian_arg );
		//$tid = 1;
		if($tid){
			add_post_meta( $tid,'tixian_type',$new_key,true );
			add_post_meta( $tid,'fact_price',$new_txp,true );
			add_post_meta( $tid,'tixian_jifen',$new_txp_jf,true );
			add_post_meta( $tid,'new_price',$new_price,true );
			add_post_meta( $tid,'tixian_status',0,true );
			add_post_meta( $tid,'tixian_replay',"",true );
			if( $t_num  ){
				if( $l_price == 0 ){
					echo '1|提现成功！您可以提现金额为：￥'.$t_price;
				}else{
					add_post_meta( $tid,'backprice',$l_price,true );
					echo '1|您可以提现金额为：'.$t_price.' 元，剩余的 '.$l_price.' 元 将会返还到您的账户中！';
				}
			}
		}
	}else{
		echo '2|<b>提示：</b> 二级密码有误，请重新输入'; exit;
	}
	die();
}
add_action("wp_ajax_func_tixian_action", "func_tixian_action");


//获取用户状态
function get_user_info_status(){
	global $wpdb,$current_user;
	$uid          = $current_user->ID;
	$userStatus   = $current_user->user_status;
	if( $userStatus != 1 ){
		return 2;
	}else{ return 1; }
}

//用户每轮逻辑计算
function user_round_times_func(){
	global $wpdb,$current_user;
	$uid          = $current_user->ID;
	$userStatus   = $current_user->user_status; 
	$username     = $current_user->user_login;
	$registtime   = $current_user->user_registered;
	$user_level_1 = get_user_meta($uid,'level_1',true);
	$user_level_2 = get_user_meta($uid,'level_2',true); 
	$user_level_3 = get_user_meta($uid,'level_3',true);
	$user_level_4 = get_user_meta($uid,'level_4',true);
	$benjin_price = get_user_meta($uid,'benjin_price',true);
	$price_limit  = get_field('price_limit','options');
	$first_sell         = get_user_meta($uid,'first_sell',true);
	$first_sell_time    = get_user_meta($uid,'first_sell_time',true);
	if( $userStatus == 1 && !empty($first_sell) && !empty($first_sell_time) ){

		$days        = strtotime("+".$price_limit." days", $first_sell_time);
		$now         = strtotime(date('Y-m-d',time()));
		$left_days   = round(($days-$now)/3600/24) ; //剩余天数

		if($left_days < 0 ){
		    $round_time   = get_user_meta($uid,'round_time',true);
		    $round_status = get_user_meta($uid,'round_status',true);
		    $round_days   = round(($round_time-$now)/3600/24) ; //剩余天数
		    if( !empty($round_time) && date('Y-m-d',time()) > date('Y-m-d',$round_time) && $round_status == 0 ){
		    	if( $user_level_1 != '0' ){
		    		get_tuijian_calculate($user_level_1,'one_level');
		    	}
		    	if( $user_level_2 != '0' ){
		    		get_tuijian_calculate($user_level_2,'two_level');
		    	}
		    	if( $user_level_3 != '0' ){
		    		get_tuijian_calculate($user_level_3,'thr_level');
		    	}
		    	if( $user_level_4 != '0' ){
		    		get_tuijian_calculate($user_level_4,'for_level');
		    	}
		    	update_user_meta($uid,'round_status',1);
		    }
		    return $round_days;
		}else{
			return $left_days;
		}
		
	}else{
		//return '-1';
	}
}

//推荐奖计算
function get_tuijian_calculate($level,$field){
	global $current_user;
	$uid           = $current_user->ID;
	$benjin_price  = get_user_meta($uid,'benjin_price',true);
	$tuijian_price = get_user_meta($uid,'tuijian_price',true);
	$level_one     = explode(',',$level);
	foreach($level_one as $l => $level_one_id){
		$first_sell_one  = get_user_meta($level_one_id,'first_sell',true);
		$level_one_user  = get_user_by('id',$level_one_id);
		if( ( $first_sell_one != 0 || !empty($first_sell_one) ) && $level_one_user->user_status == 1 ){
			$one_ids[] = $level_one_id;
		}
	}
	$c_oneIDs = count( $one_ids);

	if($field == "one_level"){
		$current_level_count_one = get_user_meta($uid,'current_level_count_one',true);
		if(!empty($current_level_count_one)){
			$current_count = $current_level_count_one;
		}
	}else if($field == "two_level"){

		$current_level_count_two = get_user_meta($uid,'current_level_count_two',true);
		if(!empty($current_level_count_two)){
			$current_count = $current_level_count_two;
		}
	}else if($field == "thr_level"){

		$current_level_count_thr = get_user_meta($uid,'current_level_count_thr',true);
		if(!empty($current_level_count_thr)){
			$current_count = $current_level_count_thr;	
		}
	}else if($field == "for_level"){

		$current_level_count_for = get_user_meta($uid,'current_level_count_for',true);
		if(!empty($current_level_count_for)){
			$current_count = $current_level_count_for;
		}
	}
	$level = get_field($field,'options');
	$price = $benjin_price*$level[0][$field.'_jiangjin']*0.01;
	$price = sprintf("%.2f", $price); 
	if(empty($current_count)){ $get_count_level = $c_oneIDs; }else{ $get_count_level = ($c_oneIDs-$current_count); }
	if( $get_count_level < $level[0][$field.'_p_num'] ){
		$note = "未达到".$level[0][$field.'_p_num']."人以上奖金不可提现";
		$tuijian_status_price = 0;
	}else{
		$note = "奖金可提现";
		$tuijian_status_price = 1;
	}

	$level_arg = array(
		'post_title'     => $price,
		'post_status'    => 'publish',
		'post_type'      => 'type_jiangjin',
		'post_content'   => $note,
		'post_author'    => $uid
	);
	$level_id = wp_insert_post( $level_arg );
	if($level_id){
		if($tuijian_status_price == 1){
			update_user_meta($uid,'tuijian_price',($price+$tuijian_price));
		}
		if($field == "one_level"){

			add_post_meta( $level_id,'user_level',1,true ) or update_post_meta( $level_id,'user_level',1);
			add_user_meta( $uid,'current_level_count_one',$c_oneIDs,true ) or update_user_meta( $uid,'current_level_count_one',$c_oneIDs);

		}else if($field == "two_level"){

			add_post_meta( $level_id,'user_level',2,true ) or update_post_meta( $level_id,'user_level',2 );
			add_user_meta( $uid,'current_level_count_two',$c_oneIDs,true ) or update_user_meta( $uid,'current_level_count_two',$c_oneIDs);

		}else if($field == "thr_level"){

			add_post_meta( $level_id,'user_level',3,true ) or update_post_meta( $level_id,'user_level',3 );
			add_user_meta( $uid,'current_level_count_thr',$c_oneIDs,true ) or update_user_meta( $uid,'current_level_count_thr',$c_oneIDs);

		}else if($field == "for_level"){

			add_post_meta( $level_id,'user_level',4,true ) or update_post_meta( $level_id,'user_level',4 );
			add_user_meta( $uid,'current_level_count_for',$c_oneIDs,true ) or update_user_meta( $uid,'current_level_count_for',$c_oneIDs);

		}
	}
}

//领导奖计算
function get_jinji_calculate($field){
	global $current_user;
	$uid             = $current_user->ID;
	$userStatus      = $current_user->user_status;
	$first_sell      = get_user_meta($uid,'first_sell',true);
	$first_sell_time = get_user_meta($uid,'first_sell_time',true);

	$lingdao_price = get_user_meta($uid,'lingdao_price',true);
	$benjin_price  = get_user_meta($uid,'benjin_price',true);
	if( $userStatus == 1 && !empty($first_sell) && !empty($first_sell_time) ){

		$days        = strtotime("+".$price_limit." days", $first_sell_time);
		$now         = strtotime(date('Y-m-d',time()));
		$left_days   = round(($days-$now)/3600/24) ; //剩余天数

		if($left_days < 0 ){
			$round_time   = get_user_meta($uid,'round_time',true);
		    $round_status = get_user_meta($uid,'round_status',true);
		    $month_days   = strtotime("+1 month", $first_sell_time);
		    //echo '==='.date('Y-m-d',$month_days);
		    if( !empty($round_time) && date('Y-m-d',time()) > date('Y-m-d',$month_days) && $round_status == 0 ){
				$fields        = explode('_',$field);
				$field_name    = $fields[0];
				$team_ids      = '';
				$level1        = get_user_meta($uid,'level_1',true);
				if( $level1 != '0' ){
					$level_one = explode(',',$level1);
					foreach($level_one as $l => $level_one_id){
						$first_sell_one  = get_user_meta($level_one_id,'first_sell',true);
						$level_one_user  = get_user_by('id',$level_one_id);
						if( ( $first_sell_one != 0 || !empty($first_sell_one) ) && $level_one_user->user_status == 1 ){
							$one_ids[] = $level_one_id;
							$team_ids .= $level_one_id.',';
						}
					}
					$c_oneIDs = count($one_ids);
				}
				$level2 = get_user_meta($uid,'level_2',true);
				if( $level2 != '0' ){
					$team_ids .= $level2.',';
					//$level_two = explode(',',$level2);
					//$c_twoIDs  = count($level_two);
				}
				$level3 = get_user_meta($uid,'level_3',true);
				if( $level3 != '0' ){
					$team_ids .= $level3.',';
					//$level_thr = explode(',',$level3);
					//$c_thrIDs  = count($level_thr);
				}
				$level4 = get_user_meta($uid,'level_4',true);
				if( $level4 != '0' ){
					$team_ids .= $level4.',';
					//$level_for = explode(',',$level4);
					//$c_forIDs  = count($level_for);
				}
				$total_teams = substr($team_ids,'0','-1');
				$teams_arg   = explode(',',$total_teams);
				$total_teams = count($teams_arg);
				$level       = get_field($field,'options');
				$price            = $level[0][$field_name.'_jiangjin']*0.01;
				$zhitui_team_num  = $level[0][$field_name.'_zhitui_people_num'];
				$get_team_num     = $level[0][$field_name.'_team_num'];
				$team_prices = "";
				$args = array(
			      'post_type'      => 'type_jinji',
			      'posts_per_page' => -1,
			      'author__in'     => array($level1)
			    );
			    $zhitui_team_num = 1;
			    $get_team_num = 1;
			    $latest_level = get_posts( $args );
				if( $c_oneIDs >= $zhitui_team_num && $total_teams >= $get_team_num ){
					foreach ($teams_arg as $t => $team_id) {
						$team_price = get_user_meta($team_id,'benjin_price',true);
						$team_prices += $team_price;
					}
					$jiangli   = ( $team_prices+$benjin_price )*$price*0.01;
					$jiangli   = sprintf("%.2f", $jiangli); 
					$level_arg = array(
						'post_title'     => $jiangli,
						'post_status'    => 'publish',
						'post_type'      => 'type_jinji',
						'post_content'   => '',
						'post_author'    => $uid
					);

					if($field == "gold_planner"){
				        foreach ($latest_level as $key => $g) {
				        	$silver_level = get_post_meta($g->ID,'wp_user_level',true);
				        	if($silver_level == 1){
				        		$silver_count[] = $silver_level;
				        	}
				        }
				        if(count($silver_count) >= 2){
				        	$topid = wp_insert_post( $level_arg );
				        	if($topid){
								update_user_meta($uid,'lingdao_price',($jiangli+$lingdao_price));
								$note = "升级为金牌理财师";
								add_post_meta( $topid,'note',$note,true ) or update_post_meta( $topid,'note',$note );
								add_post_meta( $topid,'wp_user_level',2,true ) or update_post_meta( $topid,'wp_user_level',2 );
							}
						}
					}else if($field == "diamond_planner"){
				        foreach ($latest_level as $key => $g) {
				        	$diamond_level = get_post_meta($g->ID,'wp_user_level',true);
				        	if($diamond_level == 2){
				        		$diamond_count[] = $diamond_level;
				        	}
				        }
					    if(count($diamond_count) >= 3){
							$topid = wp_insert_post( $level_arg );
				        	if($topid){
								update_user_meta($uid,'lingdao_price',($jiangli+$lingdao_price));
								$note = "升级为钻石理财师";
								add_post_meta( $topid,'note',$note,true ) or update_post_meta( $topid,'note',$note );
								add_post_meta( $topid,'wp_user_level',3,true ) or update_post_meta( $topid,'wp_user_level',3 );
							}
						}
					}else{
						$topid = wp_insert_post( $level_arg );
			        	if($topid){
							update_user_meta($uid,'lingdao_price',($jiangli+$lingdao_price));
							$note = "升级为银牌理财师";
							add_post_meta( $topid,'note',$note,true ) or update_post_meta( $topid,'note',$note );
							add_post_meta( $topid,'wp_user_level',1,true ) or update_post_meta( $topid,'wp_user_level',1);
						}
					}
				}
			}	
		}	
	}
}



//我要充值计算
function func_pay_action(){
	global $current_user;
	$uid   = $current_user->ID;
	$price = $_POST['price'];
	$note  = $_POST['note'];
	$pay_arg = array(
		'post_title'     => $price,
		'post_status'    => 'publish',
		'post_type'      => 'type_benjin',
		'post_content'   => $note,
		'post_author'    => $uid
	);
	$payID = wp_insert_post( $pay_arg );
	if($payID){
		add_post_meta( $topid,'pay_status',0,true ) or update_post_meta( $topid,'pay_status',0 );
		echo '1';
	}else{
		echo '充值失败';
	}
	die();
}
add_action("wp_ajax_func_pay_action", "func_pay_action");


//检测用户是否激活
function userStatusActive(){
	global $current_user,$post;
	$uid          = $current_user->ID;
	$userStatus   = $current_user->user_status;
	$current_date = date('H:i',time());
	$min_date     = "15:05";
	$max_date     = "23:55";
	if( !is_page_template( "tpl-tixian-detail.php" ) ){
		if( $userStatus == 1 ){
			echo $disabled = '';
		}else{
			echo $disabled = 'disabled="true"';
		}
	}else{
		if($current_date > $min_date && $current_date < $max_date && $userStatus == 1 ){
			echo $disabled = '';
		}else{
			echo $disabled = 'disabled="true"';
		}
	}
	
}