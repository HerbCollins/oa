<?php
namespace Depart\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$D = D("Department");
    	$list = $D->allDepart();

    	$users = D("Ucenter/User")->allUser();
    	$this->assign("user",$users);
    	$this->assign("list",$list);
        $this->display();
    }

    /**
     *  编辑 部门名称
     */
    public function edit(){
    	if(IS_AJAX){
    		$id = I("post.id");
    		$pname = I("post.pname","","htmlspecialchars");
    		if(empty($id) || empty($pname)){
    			$this->ajaxReturn(array("status"=>0,"message"=>"数据传输错误"));
    		}

    		$rst = D("Department")->edit($id,$pname);
    		if($rst){
    			$this->ajaxReturn(array("status"=>1,"message"=>"编辑成功"));
    		}else{
    			$this->ajaxReturn(array("status"=>0,"message"=>"编辑失败"));
    		}
    	}else{
    		$this->redirect("index");
    	}
    }

    /**
     *  添加部门
     */
    public function add(){
    	if(IS_AJAX){
    		$pid = I("post.pid");
    		$leader = I("post.leader");
    		$pname = I("post.pname","","htmlspecialchars");
    		if(empty($pname)){
    			$this->ajaxReturn(array("status"=>0,"message"=>"部门名称不能为空"));
    		}

    		$id = D("Department")->add($pname,$pid,$leader);
            $rst = D("Ucenter/User")->allot($leader,$pid);
    		if($id){
    			$this->ajaxReturn(array("status"=>1,"message"=>"添加成功","id"=>$id));
    		}else{
    			$this->ajaxReturn(array("status"=>0,"message"=>"添加失败"));
    		}
    	}else{
            $this->redirect('index');
        }
    }

    /**
     *  删除
     */
    public function delete(){
    	if(IS_AJAX){
            $id = I("post.id");
            if(empty($id)){
                $this->ajaxReturn(array("status"=>0,"message"=>"数据错误"));
            }
            $rst = D("Department")->delete($id);
            if($rst){
                $this->ajaxReturn(array("status"=>1,"message"=>"删除成功"));
            }else{
                $this->ajaxReturn(array("status"=>0,"message"=>"删除失败"));
            }
    		
    	}
    }

    /**
     *  查看部门信息详情
     */
    public function info(){
        $id = I("get.id");
        if(empty($id)){
            $this->redirect('index');
        }
        $D =  D("Department");
        $name = $D->check($id);
        if(!$name){
            $this->redirect('index');
        }
        $list = $D->getDepartList($id);
        $users = D("Ucenter/User")->allUser();

        $this->assign("pname",$name);
        $this->assign("user",$users);
        $this->assign("list",$list);
        $this->assign("pid",$id);
        $this->display();
    }

    /**
     *  部门成员信息
     */
    public function users(){
        $id = I("get.id");
        if(empty($id)){
            $this->redirect('index');
        }
        $D =  D("Department");
        $name = $D->check($id);
        if(!$name){
            $this->redirect('index');
        }
        $list = $D->getUsersList($id);
        $users = D("Ucenter/User")->allUser();

        $this->assign("pname",$name);
        $this->assign("user",$users);
        $this->assign("list",$list);
        $this->assign("pid",$id);
        $this->display();
    }
}