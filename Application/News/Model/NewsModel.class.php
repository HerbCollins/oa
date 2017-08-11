<?php 
namespace News\Model;
use Think\Model;
class NewsModel extends Model {
	public function NewsInfo($id){
		$info = M("news")->where(array("id"=>$id))->find();
		return $info;
	}
	public function add($map){
		$rst = M("news")->add($map);
		if($rst){
			return true;
		}else{
			return false;
		}
	}

	function showOne($id){
		$map['id'] = $id;
		$M = M("News");
		$info = $M->where($map)->find();
		if($info){
			return $info;
		}else{
			return false;
		}
	}

	public function edit($map){
		$M = M('News');
		$rst = $M->save($map);
		if($rst){
			return true;
		}else{
			return false;
		}
	}
}
?>