<?php
namespace Config\Controller;
use Think\Controller;

class BaseController extends Controller{
	public function _initialize(){
		if(!is_admin()){
			$this->redirect('Home/Index/index');
		}
	}
}
?>