<?php 
namespace Qrcode\Controller;
use Think\Controller;
/**
* 
*/
class BaseController extends Controller
{
	
	public function _initialize(){
		if(!is_login()){
			$this->redirect('Ucenter/Member/login');
		}
	}
}
 ?>