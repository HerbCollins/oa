<?php 
namespace Ucenter\Model;
use Think\Model;
class UserModel extends Model {
	public function allUser(){
		$M = M("User");
		$list = $M->select();
		return $list;
	}
	public function is_has_name($map){
		$M = M("User");
		$is_has = $M->where($map)->field('id,name')->find();
		if($is_has['id'] > 0){
			return true;
		}else{
			return false;
		}
	}
	public function selectUser($key){
		$M = M("User");
		$key = '%'.$key.'%';
		$map['name'] = array('like',$key);

		$list = $M->where($map)->select();
		return $list;
	}
	public function add($map){
		$vo['name'] = $map['name'];
		$up['count'] = $map['count'];
		$id = M("things_status")->where($vo)->field('id,count')->find();
		if($id['id']){
			$id['count'] +=$map['count'];
			$update = M("things_status")->save($id);
		}else{
			$up['name'] = $map['name'];
			$up['deal_uid'] = 1;
			$update = M("things_status")->add($up);
		}
		$map['deal_uid'] = 1;
		$rst = M("things_buy")->data($map)->add();
		if($rst && $update){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * 登陆
	 *
	 */
	public function login($map){
		$M = M("user");
		$rst = $M->where($map)->find();
		if($rst){
			return $rst['id'];
		}else{
			return false;
		}
	}

	/**
	 * 注册
	 *
	 */
	public function register($map){
		$M = M("user");
		$rst = $M->add($map);
		if($rst){
			return $rst['id'];
		}else{
			return false;
		}
	}
	// 重置密码
	public function reset($id){
		$map['id'] = array("in",$id);
		$map['password'] = md5(md5("123456oa"));
		$M = M("User");
		$rst = $M->save($map);
		if($rst){
			return $rst;
		}else{
			return false;
		}
	}


	// 查询 员工信息
	public function info($id){
		$map['id'] = $id;
		$M = M("User");
		$info = $M->where($map)->find();
		if($info){
			return $info;
		}else{
			return false;
		}
	}

	// 编辑员工信息
	public function edit($id,$name,$phone,$tel,$addr){
		$map['id'] = $id;
		$map['name'] = $name;
		$map['phone'] = $phone;
		$map['tel'] = $tel;
		$map['addr'] = $addr;
		$M = M("User");
		$rst = $M->save($map);
		if($rst){
			return true;
		}else{
			return false;
		}
	}

	// 获取用户姓名
	public function getUserName($uid){
		$map['id'] = $uid;
		$rst = M("User")->where($map)->field("name")->find();
		if($rst){
			return $rst['name'];
		}else{
			return false;
		}
	}
	public function getUserEmail($uid){
		$map['id'] = $uid;
		$rst = M("User")->where($map)->field("email")->find();
		if($rst){
			return $rst['email'];
		}else{
			return false;
		}
	}
	// 获取用户部门名称
	public function getUserDepart($uid){
		$map['uid'] = $uid;
		$map['status'] = 1;
		$rst = M("User_depart")->where($map)->field("pid")->find();
		if($rst){
			$vo['id'] = $rst['pid'];
			$name = M('Department')->where($vo)->field('pname')->find();
			return $name['pname'];
		}else{
			return false;
		}
	}

	// 获取用户部门id
	public function getUserDepartId($uid){
		$map['uid'] = $uid;
		$map['status'] = 1;
		$rst = M("User_depart")->where($map)->field("pid")->find();
		if($rst){
			$vo['id'] = $rst['pid'];
			$name = M('Department')->where($vo)->field('id')->find();
			return $name['id'];
		}else{
			return false;
		}
	}

	// 获取用户 职务名称
	public function getUserJob($uid){
		$leader['leader'] = $uid;
		$depart_leader = M("Department")->where($leader)->field("pname")->find();
		if($depart_leader){
			return $depart_leader['pname'].'主管';
		}else{
			$map['uid'] = $uid;
			$map['status'] = 1;
			$rst = M("User_job")->where($map)->field("jid")->find();
			if($rst){
				$vo['id'] = $rst['jid'];
				$name = M('Job')->where($vo)->field('name')->find();
				return $name['name'];
			}else{
				return false;
			}
		}
		
	}
	/**
	 *   分配部门
	 *
	 */
	public function allot($uid,$pid){
		$now['uid'] = $uid;
		$now['pid'] = $pid;
		$now['status'] = 1;
		$M = M("User_depart");
		$rst1 = $M->where($now)->find();
		if(is_array($rst1)){
			return false;
		}else{
    		// 如果在其他部门 则停用
    		$stop['uid'] = $uid;
    		$stop['status'] = 1;
    		$rst2 = $M->where($stop)->field('uid,pid')->find();

    		if($rst2){
    			$rst2['status'] = 2;
    			$M->save($rst2);
    		}

            // 如果数据库中有该员工和该部门，则启用
            $start['uid'] = $uid;
            $start['pid'] = $pid;

            $rst3 = $M->where($start)->find();
            if($rst3){
                $rst = $M->save($now);
            }else{
                $rst = $M->add($now);
            }
            
    		if($rst){
    			return true;
    		}else{
    			return false;
    		}
        }
	}

	public function checkUserJobStatus($map){
		$M = M("user_job");
		$rst = $M->where($map)->find();
		if($rst){
			return true;
		}else{
			return false;
		}
	}

	public function UserJobDisable($uid){
		$M = M("User_job");
		$map['uid'] = $uid;
		$data['status'] = 2;
		$rst = $M->where($map)->save($data);
		if($rst){
			return true;
		}else{
			return false;
		}
	}

	public function allotJob($jid,$uid,$is_leader){
		$M = M("User_job");
		$map['uid'] = $uid;
		$map['jid'] = $jid;
		$map['stime'] = date("Y-m-d");
		$map['is_leader'] = $is_leader;
		$map['status'] = 1;
		$rst = $M->add($map);
		if($rst){
			return true;
		}else{
			return false;
		}
	}

	public function checkJobsOther($uid){
		$M = M("User_job");
		$map['uid'] = $uid;
		$map['status'] = 1;
		$rst = $M->where($map)->find();
		if($rst){
			return true;
		}else{
			return false;
		}
	}
	
}
?>