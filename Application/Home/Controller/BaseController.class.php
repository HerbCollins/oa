<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
    public function _initialize(){

    	// 登陆判断，如果没有登陆，则直接跳转到登陆界面
    	if(is_login()){
    		$uid = is_login();
    	}else{
    		$this->redirect('Ucenter/Member/login');
    	}
    }

}