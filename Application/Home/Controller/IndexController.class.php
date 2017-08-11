<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){

    	$uid = session("uid")?session("uid"):0;
    	// 便签显示
    	$note = M('Note');
    	$map['uid']  = $uid;
        $note_list = $note->where($map)->select();
        $this->assign("note",$note_list);

    	// 新闻显示
    	$news = M('News'); // 实例化User对象
        $list = $news->limit(5)->order('time DESC')->select();
        $this->assign('list',$list);// 赋值数据集

    	$this->display();
    }

    public function noteDel(){
    	$uid = session("uid")?session("uid"):0;
    	if(!$uid){
    		$this->ajaxReturn(array("status"=>0,"message"=>"登录失效"));
    	}
    	$note = D("Note");
    	$id = I("post.id");
    	if(empty($id)){
    		$this->ajaxReturn(array("status"=>0,"message"=>"传输错误"));
    	}
    	$rst = $note->delete($uid,$id);
    	if($rst){
    		$this->ajaxReturn(array("status"=>1,"message"=>"已删除"));
    	}else{
    		$this->ajaxReturn(array("status"=>0,"message"=>"删除失败"));
    	}
    }

    public function noteFinish(){
    	$uid = session("uid")?session("uid"):0;
    	if(!$uid){
    		$this->ajaxReturn(array("status"=>0,"message"=>"登录失效"));
    	}
    	$note = D("Note");
    	$id = I("post.id");
    	if(empty($id)){
    		$this->ajaxReturn(array("status"=>0,"message"=>"传输错误"));
    	}
    	$rst = $note->deal($uid,$id);
    	if($rst){
    		$this->ajaxReturn(array("status"=>1,"message"=>"完成"));
    	}else{
    		$this->ajaxReturn(array("status"=>0,"message"=>"设置完成失败"));
    	}
    }

    public function noteAdd(){

    	if(IS_AJAX){
	    	$uid = session("uid")?session("uid"):0;
	    	if(!$uid){
	    		$this->ajaxReturn(array("status"=>0,"message"=>"登录失效"));
	    	}
    		$note = I("post.note","","htmlspecialchars");
    		$D = D("Note");
    		if(!empty($note)){
    			$rst = $D->add($uid,$note);
    			if($rst){
    				$this->ajaxReturn(array("status"=>1,"message"=>"添加成功","id"=>$rst));
    			}else{
    				$this->ajaxReturn(array("status"=>0,"message"=>"添加失败"));
    			}
    		}else{
    			$this->ajaxReturn(array("status"=>0,"messsage"=>"内容为空"));
    		}
    	}else{
    		$this->error("不可访问");
    	}
    }



public function sendAnnounce(){
    if(IS_AJAX){
        $title = I('post.title','','htmlspecialchars');
        $content = I('post.content','','htmlspecialchars');
        if(empty($title) || empty($content)){
            $this->ajaxReturn(array('status'=>0,'message'=>"请填写内容"));
        }

        $rst = D('Announce')->addAnnounce($title,$content);
        if($rst){
            $this->ajaxReturn(array('status'=>1,'message'=>"发布成功",'url'=>U('announce')));
        }else{
            $this->ajaxReturn(array('status'=>0,'message'=>"发布失败"));
        }
    }else{
        $this->display();
    }
}

public function announce(){
    $list = D('Announce')->getlist();
    $this->assign('list',$list);
    $this->display();
}

public function announceDetail(){
    if(IS_AJAX){
        $id = I('post.id');
        if(empty($id)){
            $this->ajaxReturn(array('status'=>0,'message'=>'参数错误'));
        }
        $detail = D('Announce')->detail($id);
        if(!is_array($detail)){
            $this->ajaxReturn(array('status'=>0,'message'=>'此公告不存在'));
        }else{
            $this->ajaxReturn(array('status'=>1,'info'=>$detail));
        } 
    }else{
        $this->redirect('index');
    }
}
}