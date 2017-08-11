<?php
/**
 *  任务管理中心
 */

namespace Task\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$task = M('Task'); // 实例化User对象
        $count= $task->count();// 查询满足要求的总记录数

        $Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $task->limit($Page->firstRow.','.$Page->listRows)->order('create_time DESC')->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }


    public function detail(){
    	$id = I("get.id");
    	if(empty($id)){
    		$this->redirect('index');
    	}
    	$D = D("Task");
    	$info = $D->detail($id);
    	$this->assign("task",$info);
    	$this->display();
    }

    public function edit(){
    	if(IS_AJAX){
    		$title = I("post.title","","htmlspecialchars");
    		$info  = I("post.info","","htmlspecialchars");
    		$contain = I("post.contain","","htmlspecialchars");
    		$create_time = I("post.create_time")?I("post.create_time"):date("Y-m-d H:i:s");
    		$end_time = I("post.end_time")?I("post.end_time"):strtotime("+1 week", $create_time);
    		$status = 1;
    		$to_depart = I("post.to_depart");
    		if(empty($title)){
    			$this->ajaxReturn(array("status"=>0,"message"=>"标题不能为空"));
    		}
    		if(empty($contain)){
    			$this->ajaxReturn(array("status"=>0,"message"=>"内容不能为空"));
    		}
    		$D = D("Task");
    		$rst = $D->add($title,$info,$contain,$create_time,$end_time,$status,$to_depart);
    		if($rst){
    			$this->ajaxReturn(array("status"=>1,"message"=>"发布成功"));
    		}else{
    			$this->ajaxReturn(array("status"=>0,"message"=>"发布失败"));
    		}
    	}else{
    		$depart = D("Depart/department")->allDepart();
    		$this->assign("depart",$depart);
    		$this->display();
    	}
    }

    public function del(){
    	if(IS_AJAX){
    		$id = I("post.id");
    		if(empty($id)){
    			$this->redirect('index');
    		}
    		$D = D("Task");
    		$rst = $D->del($id);
    		if($rst){
    			$message = "成功删除".$rst."条任务";
    			$this->ajaxReturn(array("status"=>1,"message"=>$message));
    		}else{
    			$this->ajaxReturn(array("status"=>0,"message"=>"删除失败"));
    		}
    	}else{
    		$this->redirect('index');
    	}
    }

    public function finish(){
    	if(IS_AJAX){
    		$id = I("post.id");
    		if(empty($id)){
    			$this->redirect('index');
    		}
    		$D = D("Task");
    		$rst = $D->finish($id);
    		if($rst){
    			$message = "完成".$rst."条任务";
    			$this->ajaxReturn(array("status"=>1,"message"=>$message));
    		}else{
    			$this->ajaxReturn(array("status"=>0,"message"=>"完成失败"));
    		}
    	}else{
    		$this->redirect('index');
    	}
    }

    public function not_deal(){
        $task = M('Task'); // 实例化User对象
        $count= $task->count();// 查询满足要求的总记录数

        $Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性

        $map['status'] = 1;
        $list = $task->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('create_time DESC')->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display('index');
    }

    public function dealed(){
        $task = M('Task'); // 实例化User对象
        $count= $task->count();// 查询满足要求的总记录数

        $Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性

        $map['status'] = 2;
        $list = $task->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('create_time DESC')->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display('index');
    }
}