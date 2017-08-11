<?php
namespace Common\Model;
use Think\Model;
class MenuModel extends Model{
	public function menu(){
		$uid = is_login();
		if($uid == 1){
			$getFirstMenu['upid'] = 0;
			$first = M('Menu')->where($getFirstMenu)->order('sort ASC')->select();
			$getSecondMenu['upid'] = array('gt','0');
			$second = M('Menu')->where($getSecondMenu)->select();
		}else{
			$map['depart'] = getUserDepartId($uid);
			$auth = M('authority')->where($map)->field('menu')->select();
			$menu = array();
			foreach ($auth as $a) {
				$menu[] = $a['menu'];
			}

			$getFirstMenu['id'] = array('in',$menu);
			$getFirstMenu['upid'] = 0;
			$first = M('Menu')->where($getFirstMenu)->order('sort ASC')->select();

			$getSecondMenu['id'] = array('in',$menu);
			$getSecondMenu['upid'] = array('gt','0');
			$second = M('Menu')->where($getSecondMenu)->select();
			if(count($first) == 0){
				return $second;
			}
		}

		$arr = array();
		$k = 0;
		foreach ($first as $s=>$i) {
			$arr[$k] = $i;
			$j = 0;
			foreach ($second as $vo) {
				if($vo['upid'] == $i['id']){
					$arr[$k]['child'][$j] = $vo;
				}
				$j++;
			}
			$k++;
		}

		return $arr;
	}
}
?>