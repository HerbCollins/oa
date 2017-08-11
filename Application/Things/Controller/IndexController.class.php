<?php
namespace Things\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
    	$M = M('things_view');
    	$list = $M->select();
    	$this->assign("list",$list);
        $this->display();
    }

    public function buy(){
    	if(IS_AJAX){
    		$name = I("post.name","","htmlentities");
    		$count = I("post.count",0,"intval");  //用intval过滤，整数
    		$time  = I("post.buy_time");
    		$cost = I("post.cost",0,"");

    		$map['type']  = I("post.type");
    		$map['cost']  = I("post.cost");
    		$rst = array();
    		if(empty($name)){
    			$rst['status']=0;
    			$rst['message'] = "请输入名称！";
    			$this->ajaxReturn($rst);
    		}
    		$map['name'] = $name;

    		if($count<=0){
    			$rst['status']=0;
    			$rst['message'] = "数量请大于0";
    			$this->ajaxReturn($rst);
    		}
    		$map['count'] = $count;

    		//时间转换为 字符串时间戳
    		if(empty($time)){
    			$map['buy_time'] = time();
    		}else{
    			$map['buy_time'] = strtotime($time);
    		}

    		$D = D("ThingsBuy");
    		$gst = $D->buy($map);
    		if($gst){
    			$rst['status']=1;
    			$rst['message'] = "采购记录成功";
    		}else{
    			$rst['status']=0;
    			$rst['message'] = "采购记录出错";
    		}

    		$this->ajaxReturn($rst);
    	}else{
    		$this->display();
    	}
    }

    public function apply(){
        if(IS_AJAX){
            $num = I('post.number');
            $tid = I('post.tid');
            if($num == 0){
                $this->ajaxReturn(array('status'=>0,'message'=>'未填写申请数量'));
            }

            $uid = is_login();
            $time = date('Y-m-d H:i:s');
            $map['tid']  = $tid;
            $map['number']  = $num;
            $map['status'] = 1;
            $map['uid'] = $uid;
            $map['apply_time'] = $time;

            $rst = M('Things_apply')->add($map);
            if($rst){
                $this->ajaxReturn(array('status'=>1,'message'=>'发送申请成功，等待处理'));
            }else{
                $this->ajaxReturn(array('status'=>0,'message'=>'发送申请失败，请稍后重试'));
            }
        }else{
            $this->error('404');
        }
    }

    public function applyDeal(){
        if(IS_AJAX){
            $map['id']= I('post.id');
            $type = I('post.type');
            if($type == 1){
                $map['status'] = 2;  // 2表示批准（1表示待批准）

                // 批准成功，则将物品当前数量减去申请数量
                $v['id'] = I('post.tid');
                $number = I('post.number');
                M('things_status')->where($v)->setDec('count',$number);
            }else{
                $map['status']  =3;  // 3表示驳回（1表示待批准）
            }
            $map['deal_man'] = is_login()? is_login():0;
            $map['deal_time'] = date('Y-m-d H:i:s');
            $rst  = M('things_apply')->save($map);
            if($rst){
                $this->ajaxReturn(array('status'=>1,'message'=>'操作成功'));
            }else{
                $this->ajaxReturn(array('status'=>0,'message'=>'操作失败，请稍后重试'));
            }
        }else{
            $map['status'] = 1;
            $list = M('Things_apply')->where($map)->select();
            $this->assign('list',$list);
            $this->display();
        }
    }

    public function notBack(){
        if(IS_AJAX){
            $map['id']= I('post.id');
            $number= I('post.number');

            $map['is_back'] = 1;
            $map['back_time'] = date('Y-m-d H:i:s');
            $rst  = M('things_apply')->save($map);
            if($rst){
                // 归还成功，则将物品当前数量加上归还数量
                $v['id'] = I('post.tid');
                M('things_status')->where($v)->setInc('count',$number);
                $this->ajaxReturn(array('status'=>1,'message'=>'操作成功'));
            }else{
                $this->ajaxReturn(array('status'=>0,'message'=>'操作失败，请稍后重试'));
            }
        }else{
            $map['status'] = 2;
            $map['is_back'] = 0;
            $map['type'] = 1;
            $map['uid'] = is_login();
            $list = M('Things_apply')->where($map)->select();
            $this->assign('list',$list);
            $this->display();
        }
        
    }
}