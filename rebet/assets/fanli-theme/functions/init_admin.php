<?php
global $wpdb;
/**
 * Create admin Page to list unsubscribed emails.
 */
 // Hook for adding admin menus
 add_action('admin_menu', 'wpdocs_unsub_add_pages');
 
 // action function for above hook
 
/**
 * Adds a new top-level page to the administration menu.
 */
function wpdocs_unsub_add_pages() {
     add_menu_page(
        __( '数据管理', 'textdomain' ),
        __( '数据管理','textdomain' ),
        'manage_options',
        'kepress-data-import',
        'kepress_datacheck_page_callback',
        ''
    );

    add_menu_page(
        __( '激活币/消费币充值aa', 'textdomain' ),
        __( '激活币/消费币充值aa','textdomain' ),
        'manage_options',//'edit_posts',
        'kepress-data-pay',
        'kepress_pay_page_callback',
        ''
    );
}
 
/**
 * Disply callback for the Unsub page.
 */
 function kepress_datacheck_page_callback() {
 	global $wpdb,$wp_query;
 	$pageaction  = $_GET['page'];
    $table_data  = $wpdb->prefix."data";
    $db          = $_REQUEST['db'];
    $action      = $_REQUEST['action'];
    $pid         = $_REQUEST['post'];
    $search_code = $_REQUEST['search_code'];
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $actual_link = add_query_arg( array('db' => $db),$actual_link);
    $pagehtml    = "";
    $where       = '';
    $order       = '';
    $empty       = '<tr class="no-items ui-sortable-handle"><td class="colspanchange" colspan="10" align="center">未找到数据</td></tr>';
    //通过搜索编码进行查询
    if(!empty($search_code) ){
    	$where .= ' AND account = "'.$search_code.'"';
    }
    delete_action($action,$table_data,$pid,'ID');
    $query  = "SELECT * FROM ".$table_data." WHERE 1=1 ".$where."";
    $total_query       = "SELECT COUNT(1) FROM (${query}) AS combined_table";
    $total             = $wpdb->get_var( $total_query );
    $items_per_page    = 20;
    $page              = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
    $offset            = ( $page * $items_per_page ) - $items_per_page;
    $result            = $wpdb->get_results( $query ." ".$order. " LIMIT ${offset}, ${items_per_page}" );
    $totalPage         = ceil($total / $items_per_page);
    //$actual_link = add_query_arg( array('db' => $db),$actual_link);
    if($totalPage > 1){
        $pagehtml     =  ''.paginate_links( array(
            'base' => add_query_arg( 
            	array(
        			'cpage' => '%#%',
					'search_code' => $search_code,
					'years' => $years,
					'months' => $months
				) 
            ),
            'format' => '',
            'prev_text' => __('&laquo;'),
            'next_text' => __('&raquo;'),
            'total' => $totalPage,
            'current' => $page
        )).'';
    }
    
 	$html  = '';
    $html .= '<div class="wrap">
				<h1 class="wp-heading-inline">数据管理</h1>
				<input type="hidden" id="loading" value="'.get_bloginfo("template_directory").'/images/ajax-loader.gif" />
				<hr class="wp-header-end">';
	$html .= '<form enctype="multipart/form-data" id="import-filter" method="post" action="'.get_bloginfo('home').'/admin/admin.php?page='.$pageaction.'">';


	$html .= '<div id="select_db">
			    <input autocomplete="off" type="file" id="dataimport" name="dataimport">
				<input id="import-submit" class="button" value="开始导入" type="button">
				</div>';				

	$html .= '  <div class="tablenav top">
					<div class="alignleft actions bulkactions" style="display:block;">
						<select name="action" class="select-action" id="bulk-action-selector-top">
							<option value="-1">批量操作</option>
							<option value="delete">删除</option>
						</select>
						<input id="doaction" class="button action" value="应用" type="submit">
					</div>
					<div class="alignleft actions">
						<input id="post-search-input" placeholder="请输入交易帐号" name="search_code" value="'.$search_code.'" type="search">
						<input id="search-submit" class="button" value="搜索用户" type="submit">
						<input id="doempty" rel="clear" class="button doaction" value="清空数据" type="button">
					</div>

					<br class="clear">
				</div>
				<table class="wp-list-table widefat fixed striped posts">';

		$html .= ' 
		<thead>
			<tr>
				<td id="cb" class="manage-column column-cb check-column">
				<input id="cb-select-all-1" type="checkbox"></td>
				<th scope="col" class="manage-column column-title column-primary">姓名</th>
				<th scope="col" class="manage-column column-date">交易账号</th>
				<th scope="col" class="manage-column column-date">代码</th>
				<th scope="col" class="manage-column column-date">单价</th>
				<th scope="col" class="manage-column column-ssid">数量</th>
				<th scope="col" class="manage-column column-date">认购金额</th>
				<th scope="col" class="manage-column column-date">拍单币</th>
				<th scope="col" class="manage-column column-date">推荐人</th>
				<th scope="col" class="manage-column column-date">推荐人帐号</th>
			</tr>
		</thead>';

		$html .= ' <tbody id="the-list">';
				if($result){
					foreach ($result as $n => $d) {
						$html .='<tr id="post-'.$d->name.'" class="iedit author-self level-0 post-51 type-type_data status-draft hentry">
							<th scope="row" class="check-column">
								<input id="cb-select-'.$d->ID.'" name="post[]" value="'.$d->ID.'" type="checkbox">
							</th>
							<td class="column-title has-row-actions column-primary">'.$d->name.'</td>
							<td class="date column-date">'.$d->account.'</td>
							<td class="date column-date">'.$d->code.'</td>
							<td class="date column-date">'.$d->unit_price.'</td>
							<td class="ssid column-ssid">'.$d->quantity.'</td>
							<td class="ssid column-ssid">'.$d->price.'</td>
							<td class="ssid column-ssid">'.$d->unit.'</td>
							<td class="ssid column-ssid">'.$d->recommend.'</td>
							<td class="ssid column-ssid">'.$d->recommend_account.'</td>
						</tr>';
					}
				}else{
					$html .= $empty;
				}
		$html .= ' </tbody>';		

			
	$html .= '</table>';
	$html .= '<div class="tablenav bottom">';
	$html .= '<div class="tablenav-pages">
				<span class="pagination-links">'.$pagehtml.'</span>
			 </div>';
	$html .= '</div>';
	$html .= '</form></div>';
	echo $html;	
 }

//删除数据
 function delete_action($action,$db,$pid = array(),$field = ''){
 	global $wpdb;
 	if( $action == 'delete' && $pid ){
    	foreach ($pid as $k => $pid_list) {
    		$wpdb->delete( $db, array( $field => $pid_list ) );
    	}
    }
 }

 //清空数据
function clear_data_func(){
 	global $wpdb;
    $table_data = $wpdb->prefix."data";
    $sql = "TRUNCATE ".$table_data."";
 	if($wpdb->query($sql)){
	    echo 1;
	} else {
	    echo 2;
	}
 	die();
}
add_action('wp_ajax_clear_data_func', 'clear_data_func');

//插入数据
function import_data_action(){
 	global $wpdb;
 	$upload_dir = wp_upload_dir();
 	$uploadedfile = $_FILES['dataimport'];
	$filetype = wp_check_filetype($uploadedfile['name']);
	if( $filetype['ext'] != 'xls' && $filetype['ext'] != 'xlsx' ){
		echo '格式有误,请上传( xls 或 xlsx ) 的文件'; exit;
	}
	if($filetype['ext'] == 'xls'){ $format = "Excel5"; }else{ $format = "Excel2007"; }
	$newname = date('YmdHis',time()).'.'.$filetype['ext'];
 	if($_FILES){
    	if ( ! function_exists( 'wp_handle_upload' ) ) {
		   require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}
		$upload_overrides = array( 'test_form' => false );
		$movefile = wp_handle_upload( $uploadedfile, $upload_overrides,'data' );
		if ( $movefile && ! isset( $movefile['error'] ) ) {
			$fileurl = $movefile['url'];
			$filearg = explode("/",$fileurl);
			$filearg = array_reverse($filearg);
			//$filename = $upload_dir['baseurl'].'/data/'.$filearg[0];
			$filename    = $upload_dir['basedir'].'/data/'.$filearg[0];
			$filenewname = $upload_dir['basedir'].'/data/'.$newname;
			rename(iconv('UTF-8','GBK',$filename), iconv('UTF-8','GBK',$filenewname)); //重命名文件主要针对导入的时候对中文不识别（编码问题）
			$objReader = PHPExcel_IOFactory::createReader($format);
			$objPHPExcel = $objReader->load($filenewname);
			$sheet = $objPHPExcel->getSheet(0); 
			$highestRow = $sheet->getHighestRow(); // 取得总行数 
			$highestColumn = $sheet->getHighestColumn(); // 取得总列数
		    $column = array('A','B','C','D','E','F','G','H','I','J');
		    for( $j = 2; $j <= $highestRow; $j++ ){
		    	for ($i = 0; $i < sizeof($column); $i++) { 
		    		$col = $column[$i];
		    		$collist = $col.''.$j;
		    		$list[$i] = $objPHPExcel->getActiveSheet()->getCell($collist)->getValue();
		    	}
				$name              = trim($list[1]);
				$account           = trim($list[2]);
				$code              = trim($list[3]);
				$unit_price        = trim($list[4]);
				$quantity          = trim($list[5]);
				$price             = trim($list[6]);
				$unit              = trim($list[7]);
				$recommend         = trim($list[8]);
				$recommend_account = trim($list[9]);
				//$wpdb->show_errors();
				$wpdb->query( $wpdb->prepare( 
					"
						INSERT INTO wp_data
						( ID, name, account, code, unit_price, quantity, price, unit, recommend, recommend_account )
						VALUES ( %d, %s, %s, %s, %s, %s, %s, %s, %s, %s )
					", 
				        array(
						null, 
						$name,
						$account,
						$code,
						$unit_price,
						$quantity, 
						$price,
						$unit,
						$recommend,
						$recommend_account
					) 
				));
			}
			echo 1;
			//p($wpdb->queries);
			//p($wpdb->print_error());
			//$data_arg = array_values($list);
		} else {
		    echo $movefile['error'];
		}
    }
 	die();
}
add_action('wp_ajax_import_data_action', 'import_data_action');



//激活币消费币充值
function kepress_pay_page_callback(){
echo '<div class="wrap">';
	echo '<h1>激活币/消费币充值</h1>';
	echo "
	<link rel='stylesheet' href='".get_bloginfo('url')."/template/functions/needed/acf/advanced-custom-fields/css/input.css' type='text/css' media='all' />
	<style>
	.acf-button {
	    background: #2ea2cc none repeat scroll 0 0;
	    border: 1px solid #0074a2;
	    border-radius: 3px;
	    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.25) inset;
	    box-sizing: border-box;
	    color: #fff;
	    cursor: pointer;
	    display: inline-block;
	    font-size: 13px;
	    font-weight: normal;
	    height: 28px;
	    line-height: 26px;
	    padding: 0 11px 1px;
	    position: relative;
	    text-align: center;
	    text-decoration: none;
	}
	</style>
	";
	echo '
		<form id="post" method="post" name="post">
			<div class="metabox-holder has-right-sidebar" id="poststuff">
				<!-- Main -->
				<div id="post-body">
					<div id="">
						<div id="normal-sortables" class="meta-box-sortables">
							<div id="acf_111" class="postbox  acf_postbox default">
								<div class="inside">
									<div id="acf-username" class="field field_type-text" >
										<p class="label"><label for="acf-field-username">用户名</label></p>
										<div class="acf-input-wrap">
											<input id="acf-field-username" class="text" name="" value="" placeholder="" type="text">
										</div>
									</div>
									<div id="acf-type" class="field field_type-radio ">
										<p class="label"><label for="acf-field-type">类型</label></p>
										<ul class="acf-radio-list radio horizontal">
											<li>
												<label><input name="pay_type" value="xiaofei" type="radio">消费币</label>
												<label><input name="pay_type" value="jihuo" type="radio">激活币</label>
											</li>
										</ul>
									</div>
									<div id="acf-number" class="field field_type-text" >
										<p class="label">
											<label for="acf-field-number">数量</label>
										</p>
										<div class="acf-input-wrap">
											<input class="text" name="pay_number" value="" type="text">
										</div>
									</div>
									<div id="acf-note" class="field field_type-textarea">
										<p class="label"><label for="acf-field-note">备注</label></p>
										<textarea class="textarea" name="pay_note" rows="3"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="" id="side-info-column">
						<input class="acf-button" value="确定充值" type="submit">
					</div>
				</div>
			</div>
		</form>';
echo '</div>';
}


add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
 
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;

	wp_add_dashboard_widget('system_info_widget', '当天信息统计', 'system_dashboard_info');
	wp_add_dashboard_widget('system_user_widget', '基本信息统计', 'system_dashboard_user');
	wp_add_dashboard_widget('system_tj_widget', '推荐奖信息统计', 'system_dashboard_tj');
	wp_add_dashboard_widget('system_ld_widget', '领导奖信息统计', 'system_dashboard_ld');
}

function system_dashboard_info() {
	global $wpdb;
	$today = getdate();
	//p($today);
	$args = array(
		'role'  => 'subscriber',
		'date_query' => array( 
	        array(
				'year'  => $today['year'],
				'month' => $today['mon'],
				'day'   => $today['mday'],
			)
	    )
	);
	$user_list  = get_users($args);
	foreach ($user_list as $key => $u) {
		if($u->user_status == 1){
			$uids[] = $u->ID;
		}
	}
	$active_user_count = count($uids);
	$user_count        = count($user_list);
	if(!$user_list){ $user_count = 0; }
	if(!$uids){ $active_user_count = 0; }

	// $tixian_arg = array(
	// 	'post_type'  => 'type_tixian',
	// 	'date_query' => array( 
	//         array(
	// 			'year'  => $today['year'],
	// 			'month' => $today['mon'],
	// 			'day'   => $today['mday'],
	// 		)
	//     )
	// );
	// $post_list  = get_posts($tixian_arg);



	echo '<div class="sys_info_list">';
		echo '<ul>';
			echo 
			'
				<li>今日注册人数：'.$user_count.' 人</li>
				<li>今日激活人数：'.$active_user_count.' 人</li>
				<li>今日提现人数：'.$latest_msg_count.' 人</li>
				<li>今日提现金额：0 元</li>
				<li>今日充值人数：0 人</li>
				<li>今日充值金额：0 元</li>
			';
		echo '</ul>';		
	echo '</div>';
}

function system_dashboard_user() {
	$args = array(
		'role'  => 'subscriber',
	);
	$user_list = get_users($args);
	foreach ($user_list as $key => $u) {
		if($u->user_status == 1){
			$uids[] = $u->ID;
			$args = array(
              'post_type'      => 'type_tixian',
              'posts_per_page' => -1,
              'author'         => $u->ID
            );
            $latest_msg = get_posts( $args );
		}
	}
	$active_user_count = count($uids);
	$latest_msg_count  = count($latest_msg);
	$user_count        = count($user_list);
	if(!$user_list){ $user_count = 0; }
	if(!$uids){ $active_user_count = 0; }
	echo '<div class="sys_info_list">';
		echo '<ul>';
			echo 
			'
				<li>总注册人数：'.$user_count.' 人</li>
				<li>总激活人数：'.$active_user_count.' 人</li>
				<li>总提现人数：'.$latest_msg_count.' 人</li>
				<li>总提现金额：0 人</li>
				<li>总充值人数：0 人</li>
				<li>总充值金额：0 人</li>
			';
		echo '</ul>';		
	echo '</div>';
}

function system_dashboard_tj() {
	$args = array(
		'role'  => 'subscriber',
	);
	$user_list = get_users($args);
	foreach ($user_list as $key => $u) {
			$user_level_1 = get_user_meta($u->ID,'level_1',true);
			if($user_level_1 != 0){
				$user_level_1 = sizeof(explode(',',$user_level_1));
				$level_1     += $user_level_1;
			}

			$user_level_2 = get_user_meta($u->ID,'level_2',true);
			if($user_level_2 != 0){
				$user_level_2 = sizeof(explode(',',$user_level_2));
				$level_2     += $user_level_2;
			}

			$user_level_3 = get_user_meta($u->ID,'level_3',true);
			if($user_level_3 != 0){
				$user_level_3 = sizeof(explode(',',$user_level_3));
				$level_3     += $user_level_3;
			}

			$user_level_4 = get_user_meta($u->ID,'level_4',true);
			if($user_level_4 != 0){
				$user_level_4 = sizeof(explode(',',$user_level_4));
				$level_4     += $user_level_4;
			}
	}
	//p($level_1);
	echo '<div class="sys_info_list">';
		echo '<ul>';
			echo 
			'
				<li>一级直推人数：'.($level_1).' 人</li>
				<li>二级直推人数：'.($level_2).' 人</li>
				<li>三级直推人数：'.($level_3).' 人</li>
				<li>四级直推人数：'.($level_4).' 人</li>
			';
		echo '</ul>';		
	echo '</div>';
}

function system_dashboard_ld() {
	$args = array(
		'role'  => 'subscriber',
	);
	$user_list = get_users($args);
	foreach ($user_list as $key => $u) {
		if($u->user_status == 1){
			$uids[] = $u->ID;
			$user_level = get_user_meta($u->ID,'wp_user_level',true); 
			if($user_level == 0){
				$member_normal[] =  $user_level;
			}
			if($user_level == 1){
				$member_silver[] =  $user_level;
			}
			if($user_level == 2){
				$member_gold[] =  $user_level;
			}
			if($user_level == 3){
				$member_diamond[] =  $user_level;
			}
		}
	}
	$member_normal    = count($member_normal);
	$member_silver    = count($member_silver);
	$member_gold      = count($member_gold);
	$member_diamond   = count($member_diamond);
	echo '<div class="sys_info_list">';
		echo '<ul>';
			echo 
			'
				<li>&nbsp;&nbsp;&nbsp;普通会员：'.$member_normal.' 人</li>
				<li>银牌理财师：'.$member_silver.' 人</li>
				<li>金牌理财师：'.$member_gold.' 人</li>
				<li>钻石理财师：'.$member_diamond.' 人</li>
			';
		echo '</ul>';		
	echo '</div>';
}

//管理员回复
function func_replay_action(){

	$value = $_REQUEST['value'];
	$pid   = $_REQUEST['pid'];
	$datetime = date('Y-m-d H:i:s',time());
	if(!empty($pid)){
		add_post_meta( $pid,'replay_content',$value,true ) or update_post_meta( $pid,'replay_content',$value );
		add_post_meta( $pid,'replay_date',$datetime,true ) or update_post_meta( $pid,'replay_date',$datetime );
		echo 1;
	}
	die();
}
add_action("wp_ajax_func_replay_action", "func_replay_action");

//提现-----管理员回复
function func_replay_tixian_action(){

	$value = $_REQUEST['value'];
	$pid   = $_REQUEST['pid'];
	$datetime = date('Y-m-d H:i:s',time());
	if(!empty($pid)){
		add_post_meta( $pid,'tixian_replay',$value,true ) or update_post_meta( $pid,'tixian_replay',$value );
		add_post_meta( $pid,'replay_date',$datetime,true ) or update_post_meta( $pid,'replay_date',$datetime );
		echo 1;
	}
	die();
}
add_action("wp_ajax_func_replay_tixian_action", "func_replay_tixian_action");

//充值审核
function func_reason_action(){

	$pid   = $_REQUEST['pid'];
	$sid   = $_REQUEST['sid'];

	$datetime = date('Y-m-d H:i:s',time());
	if(!empty($pid)){
		if($sid == 0){
			update_post_meta( $pid,'pay_status',1 );
			add_post_meta( $pid,'pay_apply_time',$datetime,true ) or update_post_meta( $pid,'pay_apply_time',$datetime );
			echo 1;
		}else{
			update_post_meta( $pid,'pay_status',0 );
			add_post_meta( $pid,'pay_apply_time',$datetime,true ) or update_post_meta( $pid,'pay_apply_time',$datetime );
			echo 2;
		}
	}
	die();
}
add_action("wp_ajax_func_reason_action", "func_reason_action");

function func_replay_reason_action(){
	$value = $_REQUEST['value'];
	$pid   = $_REQUEST['pid'];
	$datetime = date('Y-m-d H:i:s',time());
	if(!empty($pid)){
		add_post_meta( $pid,'reason_content',$value,true ) or update_post_meta( $pid,'reason_content',$value );
		add_post_meta( $pid,'reason_date',$datetime,true ) or update_post_meta( $pid,'reason_date',$datetime );
		echo 1;
	}
	die();
}
add_action("wp_ajax_func_replay_reason_action", "func_replay_reason_action");