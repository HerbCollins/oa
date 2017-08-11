<?php
namespace Common\Widget;
use Think\Controller;
class MenuWidget extends Controller{
	public function menu(){
		$m = D('Common/Menu')->menu();
		$uid = is_login();
		
		$this->assign('menu',$m);
		$this->assign('uid',$uid);
		$this->display(T('Application://Common@Public/leftNav'));
	}
}
?>