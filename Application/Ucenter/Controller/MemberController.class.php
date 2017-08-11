<?php
namespace Ucenter\Controller;
use Think\Controller;
class MemberController extends Controller {
    public function _initialize(){

    }
    public function index(){
        $map['id'] = is_login();
        $info = M('user')->where($map)->find();
        $this->assign('info',$info);
        $this->display();
    }
    public function login(){
    	if(IS_AJAX){
    		$name = I("post.name","","htmlentities");
    		$pwd  = I("post.password","","htmlentities");
    		$verify = I("post.verify","","htmlentities");

    		$arr = array();
    		if(check_code($verify) === false){
    			$arr['status'] = 0;
    			$arr['message'] = "验证码错误";
    			$this->ajaxReturn($arr);
    		}
    		if(!empty($name) && !empty($pwd)){
    			$map['name'] = $name;
    			$map['password'] = md5(md5($pwd."oa"));
    			$D = D("user");
    			$uid = $D->login($map);
    			if($uid){
	    			$arr['status'] = 1;
	    			$arr['message'] = "登陆成功！";
                    
	    			session("uid",$uid);
    			}else{
	    			$arr['status'] = 0;
	    			$arr['message'] = "账号或密码错误！";
    			}
    		}else{
    			$arr['status'] = 0;
    			$arr['message'] = "账号密码不能为空！";
    		}
    		$this->ajaxReturn($arr);
    	}else{
    		$this->display();
    	}
    }
    public function register(){
        if(IS_AJAX){
            $name = I("post.name","","htmlentities");
            $pwd  = I("post.password","","htmlentities");
            $pwd_check  = I("post.password_check","","htmlentities");
            $phone = I('post.phone','','htmlspecialchars');
            $verify = I("post.verify","","htmlentities");

            $arr = array();
            if(check_code($verify) === false){
                $arr['status'] = 0;
                $arr['message'] = "验证码错误";
                $this->ajaxReturn($arr);
            }
            if($pwd != $pwd_check){
                $arr['status'] = 0;
                $arr['message'] = "两次密码不相同";
                $this->ajaxReturn($arr);
            }
            if(!isMobile($phone)){
                $arr['status'] = 0;
                $arr['message'] = "手机号码格式不对！";
                $this->ajaxReturn($arr);
            }
            if(!empty($name) && !empty($pwd)){
                $map['name'] = $name;
                $map['password'] = md5(md5($pwd."oa"));
                $map['phone'] = $phone;
                $map['status']= 1;
                $D = D("user");
                $uid = $D->register($map);
                if($uid){
                    $arr['status'] = 1;
                    $arr['message'] = "注册成功！";
                    session("uid",$uid);
                }else{
                    $arr['status'] = 0;
                    $arr['message'] = "注册失败！";
                }
            }else{
                $arr['status'] = 0;
                $arr['message'] = "账号密码不能为空！";
            }
            $this->ajaxReturn($arr);
        }else{
            $this->display();
        }
    }
    public function verify(){  
	    $Verify = new \Think\Verify();  
	    $Verify->fontSize = 18;  
	    $Verify->length   = 4;  
	    $Verify->useNoise = false;  
	    $Verify->codeSet = '0123456789';  
	    $Verify->imageW = 130;  
	    $Verify->imageH = 50;  
	    //$Verify->expire = 600;  
	    $Verify->entry();  
	}  

    public function logout(){
        session('uid',null);
        $this->redirect('login');
    }

    public function edit(){
        if(IS_AJAX){
            $map['name'] = I('post.name');
            $map['phone'] = I('post.phone');
            $map['tel'] = I('post.tel');
            $map['birthday'] = I('post.birthday');
            $map['sex'] = I('post.sex');
            $map['addr'] = I('post.addr');
            $map['id'] = is_login();
            if(empty($map['name'])){
                $this->ajaxReturn(array('status'=>0,'message'=>'名称不能为空'));
            }
            $rst = M('user')->save($map);
            if($rst){
                $this->ajaxReturn(array('status'=>1,'message'=>'编辑成功'));
            }else{
                $this->ajaxReturn(array('status'=>0,'message'=>'编辑失败'));
            }
        }else{
            $this->redirect('index');
        }
    }

    public function changePwd(){
        if(IS_AJAX){
            $pwd = I('post.password');
            $newpwd = I('post.pwd');
            $save['password'] = md5(md5($newpwd."oa"));
            $map['password'] = md5(md5($pwd."oa"));
            $save['id'] = $map['id'] = is_login();
            $find = M('user')->where($map)->find();
            if($find){
                $rst = M('user')->save($save);
                if($rst){
                    $this->ajaxReturn(array('status'=>1,'message'=>'密码更改成功'));
                }else{
                    $this->ajaxReturn(array('status'=>0,'message'=>'密码更改失败'));
                }
            }else{
                $this->ajaxReturn(array('status'=>0,'message'=>$map));
            }
        }else{
            $this->redirect('index');
        }
    }
}