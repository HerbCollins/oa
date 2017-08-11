<?php
namespace Message\Model;
use Think\Model;
class MessageModel extends Model{
	public function getlist(){
		$map['to_uid'] = is_login();
		return M('message')->where($map)->select();
	}

	public function sendlist(){
		$map['from_uid'] = is_login();
		return M('message')->where($map)->select();
	}

	public function detail($id){
		$map['id'] = $id;
		$uid = is_login();
		$info = M('Message')->where($map)->find();
		if($info['to_uid'] == $uid && $info['is_read'] == 0){
			$map['is_read'] = 1;
			M('Message')->save($map);
		}
		return $info;
	}

}
?>