<?php
namespace Home\Model;
use Think\Model;
/**
* 
*/
class NoteModel extends Model
{
	public function delete($uid,$id){
		$M = M("Note");
		$map['uid'] = $uid;
		$map['id'] = $id;
		$rst = $M->where($map)->delete();
		if($rst){
			return true;
		}else{
			return false;
		}
	}
	
	public function add($uid,$note)
	{
		$M = M("Note");
		$map['uid'] = $uid;
		$map['note'] = $note;
		$map['time'] = date("Y-m-d H:i:s");
		$map['status'] = 1;
		$rst = $M->add($map);
		if($rst)
			return $rst;
		else
			return false;
	}

	public function deal($uid,$id){
		$M = M("Note");
		$v['uid'] = $uid;
		$v['id'] = $id;
		$map['status'] = 2;
		$rst = $M->where($v)->save($map);
		if($rst){
			return true;
		}else{
			return false;
		}
	}
}