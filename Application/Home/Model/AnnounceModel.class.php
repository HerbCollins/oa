<?php
namespace Home\Model;
use Think\Model;

class AnnounceModel extends Model{
	public function getlist(){
		$list = M('Announce')->select();
		return $list;
	}

	public function detail($id){
		$map['id'] = $id;
		$detail = M('Announce')->where($map)->find();
		return $detail;
	}

	public function addAnnounce($title,$content){
		$map['uid'] = is_login();
		$map['title'] = $title;
		$map['content'] = $content;
		$map['create_time'] = date('Y-m-d H:i:s');
		$rst = M('Announce')->add($map);
		if($rst){
			return true;
		}else{
			return false;
		}
	}
}
?>