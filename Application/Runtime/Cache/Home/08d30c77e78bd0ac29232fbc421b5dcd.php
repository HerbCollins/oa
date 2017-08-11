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
			
	<div class="main index">
		<div class="contain">
			<ol class="breadcrumb">
			  	<li><i class="icon icon-home"></i> 首页</li>
			</ol>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
					<div class="panel">
						<div class="panel-heading">
							工作便签
						</div>
						<div class="panel-body">
							<div class="list">
							  <!-- 列表项组 -->
							  <section class="items">
							  <?php if(is_array($note)): $i = 0; $__LIST__ = $note;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="item">
							    	<div class="todo-check pull-left" data-toggle="0">
                                        <input type="checkbox" value="<?php echo ($vo["id"]); ?>" onclick="deal(<?php echo ($vo['id']); ?>,this)" id="todo-check_<?php echo ($vo["id"]); ?>">
                                        <label for="todo-check_<?php echo ($vo["id"]); ?>"></label>
                                    </div>
                                    <?php if($vo['status'] == 1): ?><p class="todo-title" title="<?php echo ($vo["note"]); ?>"><?php echo ($vo["note"]); ?></p>
                                    <?php else: ?>
                                    	<p class="todo-title line-through"><?php echo ($vo["note"]); ?></p><?php endif; ?>
                                    <div class="todo-actionlist pull-right clearfix">
                                    	<span class="label label-info"><?php echo ($vo["time"]); ?></span>
                                    	<a href="javascript:;" onclick="del(<?php echo ($vo['id']); ?>,this)" class="todo-remove"><i class="icon icon-times"></i></a>
                            		</div>
							    </div><?php endforeach; endif; else: echo "" ;endif; ?>
							  </section>
							  <!-- 列表底部 -->
							</div>
						</div>
						<div class="panel-footer panel-entry">
						    <form role="form" action="<?php echo U('noteAdd');?>" method="post" class="form-inline">
                                <div class="form-group todo-entry">
                                    <input type="text" placeholder="输入便签" name="note" class="ipt" style="width: 100%">
                                </div>
                                <button class="box pull-right" type="submit"><i class="icon icon-plus"></i></button>
                            </form>
						</div>
					</div>
					<div class="panel">
						<div class="panel-heading">
							待完成任务
						</div>
						<div class="panel-body">
							<ul class="list-group">
							  	<li class="list-group-item">
							    	<a href="#">项目</a>
							  	</li>
							  	<li class="list-group-item">
							  		<a href="#">待办</a>
							  	</li>
							  	<li class="list-group-item"><a href="#">需求</a></li>
							  	<li class="list-group-item"><a href="#">任务</a></li>
							  	<li class="list-group-item"><a href="#">Bug</a></li>
							  	<li class="list-group-item"><a href="">用例</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
					<!-- news -->
					<div class="panel">
						<div class="panel-heading">最新新闻</div>
						<div class="panel-body">
							<div class="items">
								<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="item">
								    <div class="item-heading">
								      	<h4><a href="<?php echo U('News/index/detail',array('id'=>$vo['id']));?>" class="color-info"><?php echo ($vo["title"]); ?></a></h4>
								    </div>
								    <div class="item-content">
		                                <div class="media pull-left"><img src="<?php echo ($vo['cover']); ?>" alt=""></div>
								      	<div class="text"><?php echo ($vo["info"]); ?></div>
								    </div>
								    <div class="item-footer">
								      	<span class="label label-badge label-info">来自：<?php echo ($vo["from"]); ?></span>
								      	<span class="label label-badge label-info">作者：<?php echo ($vo["author"]); ?></span>
								      	<span class="label label-badge label-info">时间：<?php echo ($vo["time"]); ?></span>
								    </div>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
						</div>
					</div>
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
    function deal(id,obj){
    	data = {
    		'id':id
    	};
    	$.ajax({
    		url:"<?php echo U('noteFinish');?>",
    		data:data,
    		type:"post",
    		dataType:"json",
    		success:function(data){
    			if(data.status == 1){
    				message_s("完成");
        			$(obj).parent().next().addClass("line-through");
    			}
    		}
    	})

    }
    $(".form-inline").submit(function(){
    	var note = $("input[name='note']").val();
    	if(note == "" || note == null){
    		return false;
    	}
    	data = {
    		'note':note
    	}
    	$.ajax({
    		url:"<?php echo U('noteAdd');?>",
    		data:data,
    		type:"post",
    		dataType:"json",
    		success:function(data){
    			if(data.status==1){
    				message_s(data.message);
    				var html = '<div class="item">'+
							    	'<div class="todo-check pull-left" data-toggle="0">'+
                                        '<input type="checkbox" value="'+data.id+'" id="todo-check_'+data.id+'">'+
                                        '<label for="todo-check_'+data.id+'"></label>'+
                                    '</div>'+
                                    '<p class="todo-title">'+note+'</p>'+
                                    '<div class="todo-actionlist pull-right clearfix">'+
                                    	'<a href="javascript:;" onclick="del('+data.id+',this)" class="todo-remove"><i class="icon icon-times"></i></a>'+
                            		'</div>'+
							    '</div>';
					$(".items").append(html);
    			}
    		}
    	})
    	return false;
    })
    function del(id,k){
    	data = {
    		'id':id
    	}
    	$.ajax({
    		data:data,
    		type:"post",
    		url:"<?php echo U('noteDel');?>",
    		dataType:"json",
    		success:function(data){
    			$(k).parent().parent().fadeOut(1000)
    		}
    	})
    }
</script>

</body>
</html>