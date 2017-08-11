<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	
    <title>任务中心</title>

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
			
    <div class="main person">
        <div class="contain">
            <ol class="breadcrumb">
                <li><a href="<?php echo U('Home/index/index');?>"><i class="icon icon-home"></i> 首页</a></li>
                <li><i class="icon icon-checked"></i> 任务中心</li>
            </ol>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tool-btns">
                        <a href="<?php echo U('Index/edit');?>" class="boxer boxer-info"><i class="icon icon-edit"></i> 增加</a>
                        <button class="boxer boxer-info" onclick="finish(1,'')"><i class="icon icon-checked"></i> 完成</button>
                        <button class="boxer boxer-info" onclick="del(1,'')"><i class="icon icon-remove-circle"></i> 删除</button>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="check" ></th>
                                <th>任务</th>
                                <th>简介</th>
                                <th>承接部门</th>
                                <th>开始时间</th>
                                <th>截至时间</th>
                                <th>剩余时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['status'] == 1): ?><tr>
                                    <td><input type="checkbox" name="ids" value="<?php echo ($vo["id"]); ?>"></td>
                                    <td><a href="<?php echo U('Index/detail',array('id'=>$vo['id']));?>" class="color-info" target="_blank"><?php echo ($vo["title"]); ?></a></td>
                                    <td><?php echo ($vo["info"]); ?></td>
                                    <td><?php echo (getDepartName($vo["to_depart"])); ?></td>
                                    <td><span class="label label-badge label-info"><?php echo ($vo["create_time"]); ?></span></td>
                                    <td><span class="label label-badge label-info"><?php echo ($vo["end_time"]); ?></span></td>
                                    <td><span class="label label-badge label-info"><span class="last"><?php echo (days($vo["end_time"])); ?></span>天</span></td>
                                    <td>
                                        <a href="javascript:;" onclick="finish(2,<?php echo ($vo['id']); ?>)" class="a-icon-info" title="任务完成"><i class="icon icon-check-empty"></i></a>
                                        <a href="javascript:;" onclick="del(2,<?php echo ($vo['id']); ?>)" class="a-icon-info" title="删除任务"><i class="icon icon-remove-circle"></i></a>
                                    </td>
                                </tr>
                                <?php else: ?>
                                <tr class="success">
                                    <td><input type="checkbox" name="ids" value="<?php echo ($vo["id"]); ?>"></td>
                                    <td><a href="<?php echo U('Index/detail',array('id'=>$vo['id']));?>" class="color-info" target="_blank"><?php echo ($vo["title"]); ?></a></td>
                                    <td><?php echo ($vo["info"]); ?></td>
                                    <td><?php echo (getDepartName($vo["to_depart"])); ?></td>
                                    <td><span class="label label-badge label-info"><?php echo ($vo["create_time"]); ?></span></td>
                                    <td><span class="label label-badge label-info"><?php echo ($vo["end_time"]); ?></span></td>
                                    <td><span class="label label-badge label-info">已完成</span></td>
                                    <td>
                                        <a href="javascript:;" onclick="del(2,<?php echo ($vo['id']); ?>)" class="a-icon-info" title="删除任务"><i class="icon icon-remove-circle"></i></a>
                                    </td>
                                </tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            <tr>
                                <td colspan="8"><ul class="pager pager-loose pager-pills"><?php echo ($page); ?></ul></td>
                            </tr>
                        </tbody>
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
    $("input.check").click(function(){
        if($(this).is(':checked')){
            $('input[name="ids"]').each(function(i){  
                $(this).prop('checked',true);  
            });
        }else{
            $('input[name="ids"]').each(function(i){  
                $(this).prop('checked',false);  
            }); 
        }
    });

    $('input[name="ids"]').click(function(){
         if(!$(this).is(':checked')){
            $("input.check").prop('checked',false);
         }
    });

    $(document).ready(function(){
        var last = $("table").find(".last");
        $.each(last,function(){
            var day = parseInt($(this).text());
            if(day<1){
                $(this).parent().parent().parent().addClass("danger");
                $(this).parent().removeClass("label-info").addClass("label-danger")
            }
        })
    })
    // 删除任务 多条删除或者单条删除
    function del(tip,id=''){

        if(tip==1){
            var id = $("input[name='ids']:checked").map(function(){
                 return $(this).val();  
            }).get().join(',');
            console.log(id.length)
        }

        if(id.length != 0){
            if(!confirm("确定要删除任务吗？")){
                return false;
            }
            data = {
                'id':id
            }
        }else{
            message_e("请选择要删除的任务");
            return false;
        }

        $.ajax({
            data:data,
            url:"<?php echo U('del');?>",
            type:"post",
            dataType:"json",
            success:function(data){
                // console.log(data.ids);
                if(data.status==1){
                    message_s(data.message);

                    // 两秒后刷新当前页面
                    setTimeout(function(){location.reload()},2000);
                }else{
                    message_e(data.message);
                }
            }
        })
    }

    // 完成任务  多条或者单条均可
    function finish(tip,id=''){

        if(tip==1){
            var id = $("input[name='ids']:checked").map(function(){
                 return $(this).val();  
            }).get().join(',');
            console.log(id.length)
        }

        if(id.length == 0){
            message_e("请选择要删除的任务");
            return false;
        }
        data = {
            'id':id
        }
        $.ajax({
            data:data,
            url:"<?php echo U('finish');?>",
            type:"post",
            dataType:"json",
            success:function(data){
                // console.log(data.ids);
                if(data.status==1){
                    message_s(data.message);

                    // 两秒后刷新当前页面
                    setTimeout(function(){location.reload()},2000);
                }else{
                    message_e(data.message);
                }
            }
        })
    }
</script>

</body>
</html>