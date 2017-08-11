<?php
namespace Config\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
    	$list = D('Menu')->menuList();
    	$this->assign('list',$list);
        $this->display();
    }


public function save(){
	if(IS_AJAX){
		$depart = I('post.depart');
		$menu = I('post.menu');
		if(empty($depart)){
			$this->ajaxReturn(array('status'=>1,'message'=>'没有配置'));
		}
		$map['menu'] = $menu;
		$me = M('authority')->where($map)->select();
		if($me){
			M('authority')->where($map)->delete();
		}
		$i = 0;
		foreach ($depart as $d) {
			$arr[$i]['depart'] = $d;
			$arr[$i]['menu'] = $menu;
			$i++;
		}
		$rst = M('authority')->addAll($arr);
		if($rst){
			$this->ajaxReturn(array('status'=>1,'message'=>'权限配置成功'));
		}else{
			$this->ajaxReturn(array('status'=>0,'message'=>$arr));
		}
	}
}

public function model(){
	if(IS_AJAX){
		$id = I('post.id');
    	$depart = M('department')->select();

    	$map['menu'] = $id;
    	$auth = M('authority')->where($map)->field('depart')->select();
    	foreach ($auth as $k) {
    		$a[] = $k['depart'];
    	}
    	$list = '';
    	$flog = false;
    	foreach ($depart as $d) {
    		$department = $d['id'];
    		if(in_array($department,$a)){
    			$list .= '<input type="checkbox" name="depart[]" value="'.$department.'" checked="true">'.$d['pname'];
    		}else{
    			$list .= '<input type="checkbox" name="depart[]" value="'.$department.'">'.$d['pname'];
    		}
    	}

    	$this->ajaxReturn(array('status'=>1,'list'=>$list));
	}
}
}