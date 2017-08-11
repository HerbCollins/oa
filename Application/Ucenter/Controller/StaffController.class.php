<?php
namespace Ucenter\Controller;
use Think\Controller;
class StaffController extends BaseController {
	public function index(){
        $uid = is_login();
        $D = D("User");
        if(IS_POST){
            $key = I('post.key');
            if(empty($key)){
                $list = $D->allUser();
            }else{
                $list = $D->selectUser($key);
            }
        }else{
            $list = $D->allUser();
        }
		$this->assign("staff",$list);
        $this->assign('uid',$uid);
        // 让前端显示所有部门
		$this->depart();
    	$this->display();
    }

    public function add(){  
    	$map['name'] = I("post.name","","htmlentities");
    	$map['phone'] = I("post.phone","","htmlentities");
    	$map['addr']  = I("post.addr","","htmlentities");
    	$map['tel']   = I("post.tel","","htmlentities");

        $is_has['name'] = $map['name'];
        $had = D('User')->is_has_name($is_has);

        if($had){
            $this->ajaxReturn(array("status"=>0,"message"=>"增加失败，名称已存在！"));
        }

    	$map['status'] = 1;
    	$map['password'] = md5(md5("123456oa"));
	    $rst = M("user")->add($map);
	    if($rst){
	    	$this->ajaxReturn(array("status"=>1,"message"=>"新增成功"));
	    }else{
	    	$this->ajaxReturn(array("status"=>0,"message"=>"增加失败"));
	    }

	}  
	public function disable(){
        if(IS_AJAX){
            $id = I("post.id");
            $where['id'] = array('in',$id);
            $map['status'] = 2;
            $M = M("user");
            $rst = $M->where($where)->save($map);
            if($rst)
            	$this->ajaxReturn(array("status"=>1,"message"=>"禁用成功"));
            else
            	$this->ajaxReturn(array("status"=>0,"message"=>"禁用失败"));
        }
    }

    public function able(){
    	if(IS_AJAX){
    		$ids = I("post.id");
            $where['id'] = array('in',$ids);
            $map['status'] = 1;
            $M = M("user");
            $rst = $M->where($where)->save($map);
            if($rst)
            	$this->ajaxReturn(array("status"=>1,"message"=>"启用成功"));
            else
            	$this->ajaxReturn(array("status"=>0,"message"=>"启用失败"));
    	}
    }

    public function depart(){
    	$M = M("department");
    	$list = $M->field('id,pname')->select();
    	$this->assign("depart",$list);
    }

    public function allot(){
    	if(IS_AJAX){
    		$uid = I("post.uid");
    		$pid = I("post.pid");
    		$rst = D("User")->allot($uid,$pid);
    		if($rst){
    			$this->ajaxReturn(array("status"=>1,"message"=>"已更新该员工所在部门"));
    		}else{
    			$this->ajaxReturn(array("status"=>0,"message"=>"更新部门失败"));
    		}
    	}else{
            $this->redirect('index');
        }
    }

    public function reset(){
        $id = I("post.id");
        if(empty($id)){
            $this->ajaxReturn(array("status"=>0,"message"=>"未选择任何员工"));
        }

        $D = D("User");
        $rst = $D->reset($id);
        $this->ajaxReturn(array("status"=>1,"message"=>"密码重置成功，新密码为123456"));

    }

    public function edit(){
        
        if(IS_AJAX){
            $id = I("post.id");
            $name = I("post.name","","htmlspecialchars");
            $phone = I("post.phone","","htmlspecialchars");
            $tel = I("post.tel","","htmlspecialchars");
            $addr = I("post.addr","","htmlspecialchars");
            $D = D("User");
            $rst = $D->edit($id,$name,$phone,$tel,$addr);
            if($rst){
                $this->ajaxReturn(array("status"=>1,"message"=>"编辑成功"));
            }else{
                $this->ajaxReturn(array("status"=>0,"message"=>"编辑失败"));
            }
        }else{
            $id = I("get.id");
            if(empty($id)){
                $this->redirect('index');
            }
            $D = D("User");
            $info = $D->info($id);
            $this->assign("info",$info);
            $this->assign("uid",$id);
            $this->display();
        }
    }

    public function allotJob(){
        if(IS_AJAX){
            $jid = I("post.jid");
            $uid = I("post.id");
            $pid = I("post.pid");
            $is_leader = I("post.is_leader");
            $D = D("user");
            if($is_leader == 1){
                $rst = D("Depart/Department")->chengeLeader($pid,$uid,1);

                if($rst){
                    $this->ajaxReturn(array("status"=>1,"message"=>"更新职位成功"));
                }else{
                    $this->ajaxReturn(array("status"=>0,"message"=>"更新职位失败"));
                }
            }else{
                D("Depart/Department")->chengeLeader($pid,$uid,0);
            }
            // 查看员工是否已在该部门
            if($this->checkUserJobStatus($jid,$uid)){
                $this->ajaxReturn(array("status"=>0,"message"=>"该员工已在该职位，未更新"));
            }

            // 禁用该员工的现在职位
            if($D->checkJobsOther($uid)){
                $D->UserJobDisable($uid);
            }
            
            $rst = $D->allotJob($jid,$uid,$is_leader);
            if($rst){
                $this->ajaxReturn(array("status"=>1,"message"=>"更新职位成功"));
            }else{
                $this->ajaxReturn(array("status"=>0,"message"=>"更新职位失败"));
            }

        }else{
            $uid = I("get.uid");
            if(empty($uid)){
                $this->redirect('index');
            }
            $pid = D("Depart/Department")->getDepartId($uid);
            if(!$pid){
                // 获取部门失败
                $this->redirect('index');
            }
            $list = D("Depart/Job")->getJob($pid);
            $this->assign('job',$list);
            $this->assign("uid",$uid);
            $this->assign("pid",$pid);
            $this->display();
        }
    }

    public function checkUserJobStatus($jid,$uid){
        $map['jid'] = $jid;
        $map['uid'] = $uid;
        $map['status'] = 1;
        $D = D("User");
        $rst = $D->checkUserJobStatus($map);
        if($rst){
            return true;
        }else{
            return false;
        }
    }

    public function delete(){
        if(IS_AJAX){
            $id = I('post.id');
            if(empty($id)){
                $this->redirect('index');
            }
            $user['id'] = array('in',$id);
            $depart['uid'] = array('in',$id);
            $job['uid'] = array('in',$id);

            $table_user_job = M('user_job')->where($job)->delete();
            $table_user_depart = M('user_depart')->where($depart)->delete();
            $table_user = M('user')->where($user)->delete();

            if($table_user){
                $this->ajaxReturn(array('status'=>1,'message'=>'删除成功'));
            }
        }
    }
}