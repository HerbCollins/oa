<?php
namespace Depart\Controller;
use Think\Controller;
/**
* 
*/
class JobController extends Controller
{
	
	public function index(){

		// 获取职位所属部门id
		$id = I("get.id");
		if(empty($id)){
			$this->redirect('Index/index');
		}

		$list   = D("Job")->getJob($id);

		$this->assign("list",$list);
		$this->assign("did",$id);
		$this->display();
	}

	/**
	 *  增加职位
	 */
	public function add($name,$pid,$did){
		if(empty($name)){
			$this->ajaxReturn(array("status"=>0,"message"=>"名称不能为空"));
		}
		$rst = D("Job")->add($name,$pid,$did);
		if($rst){
			$this->ajaxReturn(array("status"=>1,"message"=>"添加成功"));
		}else{
			$this->ajaxReturn(array("status"=>0,"message"=>"添加失败"));
		}
	}

	/**
	 *  职位信息 --下属职位
	 */
	public function info(){
		$id = I("get.id");
		$did = I("get.did");
		if(empty($id)){
			$this->redirect('Index/index');
		}

		$list   = D("Job")->getJob($id);

		$this->assign("list",$list);
		$this->assign("did",$id);
		$this->display();
	}

	public function edit(){
		if(IS_AJAX){
			$name = I("post.name","","htmlspecialchars");

			$did  = I("post.did");
			$pid  = I("post.pid");

			$id  = I("post.id");

			$option = I("post.options");
			if($option == "add"){
				$this->add($name,$pid,$did);
			}else{
				$rst = D("Job")->edit($id,$name,$pid);
				if($rst){
					$this->ajaxReturn(array("status"=>1,"message"=>"编辑成功"));
				}else{
					$this->ajaxReturn(array("status"=>0,"message"=>"编辑失败"));
				}
			}
		}else{
			$this->redirect('index');
		}
	}

	public function delete(){
		if(IS_AJAX){
			$id = I("post.id");
			$rst = D("Job")->delete($id);
			if($rst){
				$this->ajaxReturn(array("status"=>1,"message"=>"删除成功"));
			}else{
				$this->ajaxReturn(array("status"=>0,"message"=>"删除失败"));
			}
		}else{
			$this->redirect('index');
		}
	}
}
?>