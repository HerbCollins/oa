<?php 
namespace Task\Model;
use Think\Model;
/**
* 
*/
class TaskModel extends Model
{
	public function add($title,$info = "",$contain,$create_time,$end_time,$status,$to_depart){
		$map['title'] = $title;
		$map['info'] = $info;
		$map['contain'] = $contain;
		$map['create_time'] = $create_time;
		$map['end_time'] = $end_time;
		$map['status'] = $status;
		$map['to_depart'] = $to_depart;
		$M = M("Task");
		$rst = $M->add($map);
		if($rst){
			return true;
		}else{
			return false;
		}
	}

	public function detail($id){
		$map['id'] = $id;
		$info = M("Task")->where($map)->find();
		return $info;
	}
	public function del($id){
		$map['id'] = array("in",$id);
		$M = M("Task");
		$rst = $M->where($map)->delete();
		return $rst;
	}


	public function finish($id){
		$map['id'] = array("in",$id);
		$map['status'] = 2;
		$M = M("Task");
		$rst = $M->save($map);
		return $rst;
	}
}
 ?>