<?php
/**
 *   新闻管理 
 *   index  新闻管理界面
 *   edit   新闻编辑
 *   del    新闻删除
 */
namespace News\Controller;
use Think\Controller;
class ListController extends Controller {
    public function index(){
    	$news = M('News'); // 实例化User对象
        $count= $news->count();// 查询满足要求的总记录数

        $Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $news->limit($Page->firstRow.','.$Page->listRows)->order('time DESC')->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
       	$this->display();
    }
    
	public function add(){
    	if(IS_POST){
    		$map['title'] = I("post.title","","htmlspecialchars");
            $map['from']  = I("post.from","","htmlspecialchars");
            $map['time']  = I("post.date");
            $map['author']= I("post.author","","htmlspecialchars");
            $map['info'] = I("post.abstract","","htmlspecialchars");
            $map['contain']= I("post.content");
            $map['cover'] = $this->upload();
            $D = D("News");
            $rst = $D->add($map);
            if($rst){
                $link= U('index');
                echo '<script> alert("添加成功，即将跳转"); window.location.href="'.$link.'" </script>';
                // 
                // $this->ajaxReturn(array("status"=>1,"message"=>"添加成功，即将跳转","url"=>$link));
            }else{
                $link= U('index');
                echo '<script> alert("添加失败，即将跳转"); history.go(-1); </script>';
            }
    	}else{
    		$this->display();
    	}
    }
    /**
     *  编辑
     */
    public function edit(){
    	if(IS_POST){
    		$map['title'] = I("post.title","","htmlspecialchars");
            $map['from']  = I("post.from","","htmlspecialchars");
            $map['time']  = I("post.date");
            $map['author']= I("post.author","","htmlspecialchars");
            $map['info'] = I("post.abstract","","htmlspecialchars");
            $map['contain']= I("post.content");
            $path = I("post.path");
            $cover = I("post.cover");
            if($cover == 1){
            	$map['cover'] = $this->upload();
            }
            $map['id'] = I("post.id");
            $D = D("News");
            $rst = $D->edit($map);
            $link= U('index');
            if($rst){
                echo '<script>alert("编辑成功");window.location.href="'.$link.'";</script>';
            }else{
                echo '<script>alert("编辑失败"); history.go(-1);</script>';
            }
    	}else{
    		$id = I("get.id");
    		if(empty($id)){
    			$this->redirect('index');
    		}
    		$D = D("News");
    		$info = $D->showOne($id);
    		// 如果查询到数据 ，则递交到前端，否则返回到 管理页面
    		if($info){
    			$this->assign("info",$info);
    		}else{
    			$this->redirect('index');
    		}

    		$this->display();
    	}
    }

	/**
	 * 删除
	 */
    public function del(){
    	if(IS_AJAX){
    		$id = I("post.id");
    		if(empty($id)){
    			$this->ajaxReturn(array("status"=>0,"message"=>"未选中任何新闻"));
    		}
    		$M = M("News");
    		$map['id'] = array("in",$id);
    		$rst = $M->where($map)->delete();
    		if($rst){
    			$this->ajaxReturn(array("status"=>1,"message"=>"删除成功"));
    		}else{
    			$this->ajaxReturn(array("status"=>0,"message"=>"删除失败"));
    		}
    	}else{
    		$this->redirect('index');
    	}
    }
    public function upload(){
        $config = array(
            'maxSize'    =>    3145728,
            'rootPath'   =>    './Uploads/',
            'savePath'   =>    '',
            'saveName'   =>    'time',
            'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
            'autoSub'    =>    true,
            'subName'    =>    array('date','Ymd'),
        );
        $upload = new \Think\Upload($config,'Local');// 实例化上传类
        // 上传文件 
        $info   =   $upload->uploadOne($_FILES['path']);
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功 获取上传文件信息
             return __ROOT__.'/Uploads/'.$info['savepath'].$info['savename'];
        }
    }
}