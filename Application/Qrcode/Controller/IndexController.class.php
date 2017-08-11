<?php
namespace Qrcode\Controller;
use Think\Controller;
class IndexController extends BaseController {
	public function index(){
		$this->display();
	}
	
    public function qrcode(){
    	if(IS_AJAX){
    		$data = I("post.data");
    		if(empty($data)){
		  		$this->ajaxReturn(array("status"=>0,"message"=>"内容不能为空"));
    		}
    		$level = I("post.level");
    		$size = I("post.size");
    		import("Org.Util.phpqrcode");
	    	$object = new \Org\Util\QRcode();

		  	$path = 'Uploads/Qrcode';
		  	$name = date('Ymd').'-'.time().".png";
		  	$filename = $path."/".$name;
		  	$object->png($data, $filename, $level, $size); 
		  	$getPath = __ROOT__."/".$filename;
		  	if($getPath){
		  		$this->ajaxReturn(array("status"=>1,"message"=>"二维码生成成功","path"=>$getPath));
		  	}else{
		  		$this->ajaxReturn(array("status"=>0,"message"=>"二维码生成失败"));
		  	}
		  }else{
		  	$this->redirect('index');
		  }
    	
    }
}