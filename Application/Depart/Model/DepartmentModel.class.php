<?php 
namespace Depart\Model;
use Think\Model;
/**
* 
*/
class DepartmentModel extends Model
{
	/**
	 *  查询所有部门
	 */
	public function allDepart(){
		$M = M("Department");
		$map['pid'] = 0;
		$list = $M->where($map)->select();
		return $list;
	}

	/**
	 *  增加部门
	 */
	public function add($pname,$pid,$leader){
		$map['pname'] = $pname;
		$map['pid'] = $pid;
		$map['leader'] = $leader;
		$M = M("Department");
		$rst = $M->add($map);
		if($rst){
			return $rst;
		}else{
			return false;
		}
	}

	/**
	 *  编辑部门
	 */
	public function edit($id,$name){
		$M = M("Department");
		$map['id'] = $id;
		$map['pname'] = $name;
		$rst = $M->save($map);
		if($rst){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * 	删除部门
	 */
	public function delete($id){
		// 先删除下级
		$vo['pid'] = array('in',$id);
		$del_pid = M("Department")->where($vo)->delete();
		// 删除部门
		$map['id'] = array('in',$id);
		$del_id = M("Department")->where($map)->delete();
		return true;
	}

	/**
	 *   查询 id 正确性
	 */
	public function check($id){
		$map['id'] = $id;
		$rst = M("Department")->where($map)->field('pname')->find();
		if($rst){
			return $rst['pname'];
		}else{
			return false;
		}
	}

	/**
	 *   部门 下属部门
	 */
	public function getDepartList($id){
		$map['pid'] = $id;
		$M = M("Department");
		$list = $M->where($map)->select();
		if($list){
			return $list;
		}else{
			return false;
		}
	}

	/**
	 *   部门 成员信息
	 */
	public function getUsersList($id){
		$map['pid'] = $id;
		$map['status'] = 1;
		$M = M("User_depart");
		$list = $M->where($map)->select();
		if($list){
			return $list;
		}else{
			return false;
		}
	}

	/**
	 *  获取 部门名称
	 */
	public function getDepartName($id){
		$map['id'] = $id;
		$M = M("Department");
		$v = $M->where($map)->field('pname')->find();
		if($v){
			return $v['pname'];
		}else{
			return false;
		}
	}
	
	public function getDepartId($uid){
		$map['uid'] = $uid;
		$map['status'] = 1;
		$M = M("User_depart");
		$v = $M->where($map)->field('pid')->find();
		if($v){
			return $v['pid'];
		}else{
			return false;
		}
	}

	public function chengeLeader($pid,$uid,$is_leader){
		if($is_leader == 1){
			$map['id'] = $pid;
			$vo['leader'] = $map['leader'] = $uid;
			$M = M("Department");
			$find = $M->where($vo)->field('id')->select();
			$i = 1;
			foreach ($find as $value) {
				if($i = strlen($find))
					$ids .= $value['id'];
				else{
					$ids .= $value['id'].",";
				}
				$i++;
			}
			$update['id'] = array('in',$ids);
			if(strlen($ids)>0){
				$update['leader'] = 0;
				$M->save($update);
			}
			$rst = $M->save($map);
			if($rst){
				return true;
			}else{
				return false;
			}
		}else{
			$vo['leader']  = $uid;
			$M = M("Department");
			$find = $M->where($vo)->field('id')->select();
			$i = 1;
			foreach ($find as $value) {
				if($i = strlen($find))
					$ids .= $value['id'];
				else{
					$ids .= $value['id'].",";
				}
				$i++;
			}
			$update['id'] = array('in',$ids);
			if(strlen($ids)>0){
				$update['leader'] = 0;
				$rst = $M->save($update);
				if($rst){
					return true;
				}else{
					return false;
				}
			}else{
				return true;
			}
			
		}
		
	}


	public function is_leader($uid){
		$d = M('Department')->where(array('leader'=>$uid))->field('id')->find();
		if($d['id'] > 0){
			return $d['id'];
		}else{
			return false;
		}
	}
}
 ?>