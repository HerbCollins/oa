<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	
	<title>OA</title>

	<meta charset="utf-8" />
	<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/oa/Public/zui/css/zui.css">
	<link rel="stylesheet" type="text/css" href="/oa/Public/zui/lib/calendar/zui.calendar.css">
	<link rel="stylesheet" type="text/css" href="/oa/Public/css/core.css">
	

	<script type="text/javascript" src="/oa/Public/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/oa/Public/zui/js/zui.js"></script>
	<script type="text/javascript" src="/oa/Public/zui/lib/calendar/zui.calendar.js"></script>
	<script type="text/javascript" src="/oa/Public/js/common.js"></script>
</head>
<body>
	<div class="body-main">
		<div class="left-nav">
			<?php echo W('Common/Menu/menu');?>
		</div>
		<div class="right-main">
			<div class="header">
	<nav class="navbar" role="navigation">
		 <div class="container-fluid">
		    <!-- 导航头部 -->
		    <div class="toggle">
			    <!-- 移动设备上的导航切换按钮 -->
			    <button type="button" class="left-toggle" data-toggle="collapse" data-target=".navbar-top">
			        <i class="icon icon-bars"></i>
			    </button>
		    </div>
		    <!-- 导航项目 -->
		   	<div class="right-nav">
		   		<li><a href="<?php echo U('Message/Index/index');?>" title="消息列表" ><i class="icon icon-chat-line"></i></a></li>
		   		<li><a href="<?php echo U('Home/Index/announce');?>" title="公司公告" ><i class="icon icon-bell"></i></a></li>
		   		<li class="nav-person">
		   			<a href="javascript:;" class="top-toggle" data-status="0" data-target="person-zone" >  <?php echo (getUserName(session('uid'))); ?> <i class="icon icon-chevron-down"></i></a>
		   		</li>
	      	</div>

	      	<!-- 个人信息 -->
	      	<div class="top-zone top-person-zone panel panel-info">
	      		<div class="arrow">
	      			<i class="icon icon-caret-up"></i>
	      		</div>
	      		<ul class="list-group">
	      			<a href="<?php echo U('Ucenter/Member/index');?>" class="list-group-item">个人信息</a>
	      			<a href="" class="list-group-item">修改密码</a>
	      			<a href="<?php echo U('Ucenter/Member/logout');?>" class="list-group-item">退出</a>
	      		</ul>
	      	</div>
		 </div>
	</nav>
</div>
			
	<div class="main person index">
		<div class="contain">
			<ol class="breadcrumb">
			  	<li><a href="<?php echo U('Home/index/index');?>"><i class="icon icon-home"></i> 首页</a></li>
			  	<li><a href="<?php echo U('index');?>"><i class="icon icon-sitemap"></i> 部门信息</a></li>
			  	<li><?php echo ($pname); ?></li>
			</ol>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="tool-btns">
						<button type="button" class="boxer boxer-info" onclick="delAll()"><i class="icon icon-remove-sign"></i> 删除</button>
					</div>
						<table class="table table-striped text-center" id="depart">
							<tr>
								<td>
									<input type="checkbox" class="check">
								</td>
								<td>
									姓名
								</td>
								<td>
									职务
								</td>
								<td>
									操作
								</td>
							</tr>
							<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr data-pid="<?php echo ($vo['id']); ?>">
									<td><input type="checkbox" name="ids" value="<?php echo ($vo["uid"]); ?>"></td>
									<td><b><?php echo (getUserName($vo["uid"])); ?></b></td>
									<td><b><?php echo (getUserJob($vo["uid"])); ?></b></td>
									<td>
										<a href="javascript:;" onclick="del(this,<?php echo ($vo['id']); ?>)"><span class="label label-badge label-danger"><i class="icon icon-remove-sign"></i> 删除</span></a>
									</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</table>
					</div>
				</div>
		</div>
	</div> 

			<div class="footer">
				<p class="pull-left">作者：<a href="" class="tip">樊格</a>、<a href="" class="tip">王庭村</a></p>
				<p class="pull-right">本网站为华东交通大学信息工程学院计算机科学与技术2013-1班毕业设计课题</p>
			</div>
		</div>
	</div>
	
<script type="text/javascript">
	function edit(k){
		$(".modal-title").text("编辑部门名称")
		var name = $(k).parent().prev().prev();
		var depart = name.text();
		var pid = $(k).parent().parent().data("pid");

		$("input[name='pid']").val(pid);
		$(".edit_depart").val(depart);
		$(".edit_depart").attr("data-name",depart);
		$('#edit_depart').modal('show');
	};

	$("#yes_add").click(function(){
		var depart = $("input[name='add_depart']").val();
		var leader = $("#leader").val();
		var leader_name = $("#leader").find("option:selected").text();
		var pid = $("#pid").val();
		if(depart == null || depart == ""){
			message_e("名称不能为空");
			return false;
		}
		data = {
			'pname':depart,
			'leader':leader,
			'pid':pid
		}
		$.ajax({
			data:data,
			url:"<?php echo U('add');?>",
			type:"post",
			dataType:"json",
			success:function(data){
				if(data.status == 1){
					$('#add_depart').modal('hide');
					message_s(data.message);
					// 延时两秒刷新
					setTimeout(function(){location.reload();},2000);
				}else{
					message_e(data.message);
				}
				

			}
		})
		
	});

	// 模态框中的确认
	$("#yes_edit").click(function(){
		var edit = $(this);
		var o_name = $(".edit_depart").data("name");
		var get_name = $(".edit_depart").val();
		if(get_name == o_name){
			$('#edit_depart').modal('hide');
			message_e("未做修改");
			return false;
		}else if(get_name == "" || get_name == null){
			message_e("请填写部门名称");
			return false;
		}
		var pid = $("#edit_pid").val();
		data ={
			'id':pid,
			'pname':get_name
		}
		
		urls = "<?php echo U('edit');?>";
		$.ajax({
			data:data,
			url:urls,
			type:"post",
			dataType:"json",
			beforeSend:function(){
				edit.html('<i class="icon icon-spin icon-spinner-snake"></i> 正在更新');
				edit.addClass("boxer-disabled").attr("disabled","disabled");
			},
			success:function(data){
				if(data.status == 1){
					edit.html('确定');
					edit.removeClass("boxer-disabled").removeAttr("disabled");
					message_s("编辑成功");
					$("#edit_depart").modal('hide');
					setTimeout(function(){location.reload();},2000);
				}else{
					message_e("编辑失败");
				}
			}

		})
	})

	function del(obj,id){
		if(!confirm("确定删除？")){
			return false;
		}
		if(id==""||id==null){
			message_e("数据错误");
			return false;
		}
		data = {'id':id};
		$.ajax({
			data:data,
			url:"<?php echo U('delete');?>",
			type:"post",
			dataType:"json",
			success:function(data){
				if(data.status == 1){
					message_s(data.message);
					$(obj).parent().parent().fadeOut(1000);
				}else{
					message_e(data.message);
				}
			}
		})

	}
	function delAll(){
		var id = $("input[name='ids']:checked").map(function(){
             return $(this).val();  
        }).get().join(',');
        if(id == "" || id == null){
        	message_e("请选择需要禁用的用户");
        	return false;
        }

        data ={
        	'id':id
        }
        $.ajax({
			data:data,
			url:"<?php echo U('delete');?>",
			type:"post",
			dataType:"json",
			success:function(data){
				if(data.status == 1){
					message_s(data.message);
					setTimeout(function(){location.reload();},2000);
				}else{
					message_e(data.message);
				}
			}
		})
	}
</script>

</body>
</html>