<?php 
	function is_login(){
		$uid = session('uid');
		if($uid > 0){
			return $uid;
		}else{
			return false;
		}
	}


	// 判断是不是超级管理员
	function is_admin(){
		$uid = is_login();
		if($uid == 1){
			return true;
		}else{
			return false;
		}
	}


	// 查询是不是领导
	function is_leader($uid){
		return D('Depart/Department')->is_leader($uid);
	}

	function check_code($code, $id = ""){  
	    $verify = new \Think\Verify();  
	    return $verify->check($code, $id);  
	} 

	function diffBetweenTwoDays ($day1, $day2)
	{
	  	$second1 = strtotime($day1);
	  	$second2 = strtotime($day2);
	    
	  	if ($second1 < $second2) {
	    	$tmp = $second2;
	    	$second2 = $second1;
	    	$second1 = $tmp;
	  	}
	  	return ($second1 - $second2) / 86400;
	}

	function days($day){
		$second1 = strtotime($day);
	  	$second2 = time();
	    
	  	if ($second1 < $second2) {
	    	$tmp = $second2;
	    	$second2 = $second1;
	    	$second1 = $tmp;
		  	$hour = intval(($second1 - $second2) / 3600);
		  	$d = intval($hour/24);
		  	return $d+1;
	  	}else{
	  		$hour = intval(($second1 - $second2) / 3600);
		  	$d = intval($hour/24);
		  	return $d;
	  	}
	}


	/**
	 *   通过 id 获取用户名称
	 */
	function getUserName($uid){
		if(empty($uid)){
			return "-";
		}
		$name = D("Ucenter/User")->getUserName($uid);
		if($name){
			return $name;
		}else{
			return "-";
		}
	}

	function sendMail($from,$pwd,$username,$to, $title, $content) {
        Vendor("PHPMailer.PHPMailerAutoload");
        $mail = new PHPMailer();
        $mail->IsSMTP(); // 启用SMTP
        $mail->Host='smtp.163.com'; //smtp服务器的名称（这里以QQ邮箱为例）
        $mail->SMTPAuth = TRUE; //启用smtp认证
        $mail->Username = $from; //你的邮箱名
        $mail->Password = $pwd ; //邮箱密码
        $mail->From = $from; //发件人地址（也就是你的邮箱地址）
        $mail->FromName = $username; //发件人姓名
        $mail->AddAddress($to,'尊敬的客户');
        $mail->WordWrap = 50; //设置每行字符长度
        $mail->IsHTML(TRUE); // 是否HTML格式邮件
        $mail->CharSet='utf-8'; //设置邮件编码
        $mail->Subject =$title; //邮件主题
        $mail->Body = $content; //邮件内容
        $mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
        if($mail->Send()){
            return true;
        }else{
            return false;
        }
    }
	
	/**
	 * 通过用户id获取用户邮箱地址
	 */
	function getUserEmail($uid){
		if(empty($uid)){
			return false;
		}
		$email = D("Ucenter/User")->getUserEmail($uid);
		if($email){
			return $email;
		}else{
			return "-";
		}
	}

	/**
	 *   通过 用户id 获取部门名称
	 */
	function getUserDepart($uid){
		if(empty($uid)){
			return "-";
		}
		$name = D("Ucenter/User")->getUserDepart($uid);
		if($name){
			return $name;
		}else{
			return "-";
		}
	}
	/**
	 *   通过 用户id 获取部门名称
	 */
	function getUserDepartId($uid){
		if(empty($uid)){
			return false;
		}
		$name = D("Ucenter/User")->getUserDepartId($uid);
		if($name){
			return $name;
		}else{
			return false;
		}
	}
	/**
	 *   通过 用户id 获取职务名称
	 */
	function getUserJob($uid){
		if(empty($uid)){
			return "-";
		}
		$name = D("Ucenter/User")->getUserJob($uid);
		if($name){
			return $name;
		}else{
			return "-";
		}
	}

	/**
	 *  获取 部门名称
	 */
	function getDepartName($id){
		if(empty($id)){
			return "-";
		}
		$name = D("Depart/Department")->getDepartName($id);
		if($name){
			return $name;
		}else{
			return "-";
		}
	}

	/**
	 * 获取职位名称
	 */
	function getJobName($id){
		
		if($id == 0){
			return "顶级部门";
		}
		if(empty($id)){
			return "-";
		}
		$name = D("Depart/Job")->getJobName($id);
		if($name){
			return $name;
		}else{
			return "-";
		}
	}

	function qrcode($data, $level, $size){
		import("Org.Util.phpqrcode");
    	$object = new \Org\Util\QRcode();

	  	$path = 'Uploads/Qrcode';
	  	$name = date('Ymd').'-'.time().".png";
	  	$filename = $path."/".$name;
	  	$object->png($data, $filename, $level, $size); 
	  	$getPath = __ROOT__."/".$filename;
	  	return $getPath;
	}

	function get_things_name($id){
		return D('Things/ThingsBuy')->getThingsName($id);
	}

/**
* 验证手机号是否正确
* @author honfei
* @param number $mobile
*/
function isMobile($mobile) {
    if (!is_numeric($mobile)) {
        return false;
    }
    return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
}
?>