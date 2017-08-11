<?php
namespace Message\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $send = D('Message')->sendlist();
        $get  = D('Message')->getlist();
        $this->assign('send',$send);
        $this->assign('get',$get);
        $this->display();
    }

    public function add(){
    	if(IS_POST){
    		$map['title'] = I("post.title","","htmlspecialchars");
    		$map['from_uid'] = is_login()?is_login():0;
    		$map['to_uid'] = I('post.toUser');
            $map['content']= I("post.content");
            $map['time'] = date('Y-m-d H:i:s');
            $map['is_read'] = 0;

            
            $D = D("Message");
            $rst = $D->add($map);
            if($rst){
                $link= U('index');
                $this->ajaxReturn(array("status"=>1,"message"=>"添加成功，即将跳转","url"=>$link));
            }else{
                $this->ajaxReturn(array("status"=>0,"message"=>"添加失败"));
            }
    	}else{
    		$uid = is_login();
    		$map['id'] = array('neq',$uid);
    		$users = M('user')->where($map)->select();
    		$this->assign('users',$users);
    		$this->display();
    	}
    }

    public function detail(){
		$id = I('get.id');
		if(empty($id) || $id == 0){
			$this->error('参数错误');
		}
		$map['id'] = $id;
		$detail = D('Message')->detail($id);
		$this->assign('detail',$detail);
		$this->display();
    	
    }

}