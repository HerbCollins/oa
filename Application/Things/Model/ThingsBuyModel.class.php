<?php 
namespace Things\Model;
use Think\Model;
class ThingsBuyModel extends Model {
	protected $trueTableName = "oa_things_buy";

	public function buy($map){
		$vo['name'] = $map['name'];
		$up['count'] = $map['count'];

		$map['deal_uid'] = 1;                  //增加的代码
		$rst = M("things_buy")->add($map);     //增加的代码

		$id = M("things_status")->where($vo)->field('id,count')->find();
		if($id['id'] > 0){
			$id['count'] +=$map['count'];
			$update = M("things_status")->save($id);
		}else{
			$up['name'] = $map['name'];
			$up['deal_uid'] = 1;

			$up['id'] = $rst;     //增加的代码

			$update = M("things_status")->add($up);
		}

		// 删除了两行代码

		if($rst && $update){
			return true;
		}else{
			return false;
		}
	}

	public function getThingsName($id){
		$map['id'] = $id;
		$rst = M('things_buy')->where($map)->field('name')->find();
		return $rst['name'];
	}
}
?>