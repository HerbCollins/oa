<?php
namespace News\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $news = M('News'); // 实例化User对象
        $count= $news->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,8);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $news->limit($Page->firstRow.','.$Page->listRows)->order('time DESC')->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    public function detail(){
        $id = I("get.id");
        if(empty($id)){
            $this->redirect("index");
        }
        $info = D("News")->NewsInfo($id);
        $this->assign("info",$info);
    	$this->display();
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