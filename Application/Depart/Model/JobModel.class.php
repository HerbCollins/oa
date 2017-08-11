<?php
namespace Depart\Model;
use Think\Model;
/**
* 
*/
class JobModel extends Model
{
	
	public function add($name,$pid,$did){
		$map['name'] = $name;
		$map['did']  = $did;
		$map['pid']  = $pid;
		$M = M("Job");
		$rst = $M->add($map);
		if($rst){
			return true;
		}else{
			return false;
		}
	}


	public function edit($id,$name,$pid){
		$map['id'] = $id;
		$map['name']  = $name;
		$map['pid']  = $pid;
		$M = M("Job");
		$rst = $M->save($map);
		if($rst){
			return true;
		}else{
			return false;
		}
	}

	public function delete($id){
		$map['id'] = array('in',$id);
		$M = M("Job");
		$rst = $M->where($map)->delete();
		if($rst){
			return true;
		}else{
			return false;
		}
	}
	public function allJob(){
		$M = M("Job");
		$map['pid'] = 0;
		$list = $M->where($map)->select();
		return $list;
	}

	// 通过部门id查询下属职位
	public function getJob($id){
		$map['did'] = $id;
		$list = M("Job")->where($map)->select();
		if($list){
			return $list;
		}else{
			return false;
		}
	}
	
	/**
	 *  获取职位名称
	 */
	public function getJobName($id){
		$map['id'] = $id;
		$list = M("Job")->where($map)->field('name')->find();
		if($list){
			return $list['name'];
		}else{
			return false;
		}
	}
}
?>