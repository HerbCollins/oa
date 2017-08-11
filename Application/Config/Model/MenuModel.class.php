<?php
namespace Config\Model;
use Think\Model;
class MenuModel extends Model{
	public function menuList(){
		$map['upid'] = 0;
		$list = M('Menu')->where($map)->order('sort ASC')->select();
		return $list;
	}
}
?>