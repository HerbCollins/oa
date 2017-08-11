<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	
    <title>新闻管理</title>

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
			<div class="logo-zone">
	<img src="/oa/Public/images/logo.png" alt="">
</div>
<nav class="menu left-nav" data-toggle="menu">
  	<ul class="nav nav-primary">
	    <li><a href="<?php echo U('Home/index/index');?>"><i class="icon-home"></i> 首页</a></li>
	    <li class="nav-parent">
	    	<a href="javascript:;"><i class="icon icon-checked"></i> 任务管理</a>
	    	<ul class="nav">
		        <li><a href="<?php echo U('Task/index/edit');?>">发布任务</a></li>
		        <li><a href="<?php echo U('Task/index/work');?>">待完成任务</a></li>
		        <li><a href="<?php echo U('Task/index/finish');?>">已完成任务</a></li>
	      	</ul>
	    </li>
	    <li class="nav-parent">
	    	<a href="javascript:;"><i class="icon icon-edit"></i> 新闻信息</a>
	    	<ul class="nav">
		        <li><a href="<?php echo U('News/list/index');?>">新闻管理</a></li>
		        <li><a href="<?php echo U('News/index/index');?>">公司新闻</a></li>
	      	</ul>
	    </li>
	    <li>
	    	<a href="<?php echo U('Ucenter/staff/index');?>"><i class="icon icon-group"></i> 人员管理</a>
	    </li>
	    <li class="nav-parent">
	    	<a href="javascript:;"><i class="icon icon-sitemap"></i> 部门管理</a>
	    	<ul class="nav">
		        <li><a href="<?php echo U('Depart/index/index');?>">部门信息</a></li>
		        <li><a href="<?php echo U('Depart/job/index');?>">职位管理</a></li>
	      	</ul>
	    </li>
	    <li class="nav-parent">
	    	<a href="javascript:;"><i class="icon-book"></i> 物品管理</a>
	    	<ul class="nav">
		        <li><a href="<?php echo U('Things/index/index');?>">物品申请</a></li>
		        <li><a href="<?php echo U('Things/back/index');?>">物品归回</a></li>
		        <li><a href="<?php echo U('Things/apply/config');?>">申请管理</a></li>
		        <li><a href="<?php echo U('Things/index/buy');?>">采购管理</a></li>
	      	</ul>
	    </li>
	    <li class="nav-parent">
      		<a href="javascript:;"><i class="icon-qrcode"></i> 二维码生成器</a>
	      	<ul class="nav">
		        <li><a href="<?php echo U('Qrcode/index/web');?>">网址二维码</a></li>
		        <li><a href="<?php echo U('Qrcode/index/text');?>">文本二维码</a></li>
		        <li><a href="<?php echo U('Qrcode/index/card');?>">名片二维码</a></li>
	      	</ul>
	    </li>
	    <li class="ucenter">
	    	<a href="<?php echo U('Ucenter/Member/index');?>"><i class="icon icon-user"></i> 个人中心</a>
	    </li>
		<button type="button" class="boxer boxer-back-full"><i class="icon icon-bullhorn"></i> 发布公告</button>
		<button type="button" class="boxer boxer-back-full"><i class="icon icon-chat-line"></i> 发送消息</button>
  	</ul> 
</nav>
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
		   		<li><a href="javascript:;" class="top-toggle" data-status="0" data-target="chat-zone" ><i class="icon icon-chat-line"></i></a></li>
		   		<li><a href="javascript:;" class="top-toggle" data-status="0" data-target="notice-zone" ><i class="icon icon-bell"></i></a></li>
		   		<li class="nav-person">
		   			<a href="javascript:;" class="top-toggle" data-status="0" data-target="person-zone" ><img src="/oa/Public/images/user1.png"> name <i class="icon icon-chevron-down"></i></a>
		   		</li>
	      	</div>

	      	<!-- 未读消息 -->
	      	<div class="top-zone top-chat-zone panel panel-info">
	      		<div class="panel-heading">
	      			未读消息
	      		</div>
	      		<div class="panel-body">
		      		<div class="arrow">
		      			<i class="icon icon-caret-up"></i>
		      		</div>
	  				<div class="comment">
					  	<a href="###" class="avatar">
					    	<img src="/oa/Public/images/user1.png">
					  	</a>
					  	<div class="content">
						    <div class="pull-right text-muted">2 个小时前</div>
						    <div>
						    	<a href="###">
						    		<strong>Catouse</strong>
						    	</a>
						    </div>
						    <div class="text"><a href="">你到底把我家钥匙放哪里了...</a></div>
					  	</div>
					</div>
	  				<div class="comment">
					  	<a href="###" class="avatar">
					    	<img src="/oa/Public/images/user1.png">
					  	</a>
					  	<div class="content">
						    <div class="pull-right text-muted">2 个小时前</div>
						    <div>
						    	<a href="###">
						    		<strong>Catouse</strong>
						    	</a>
						    </div>
						    <div class="text"><a href="">你到底把我家钥匙放哪里了...</a></div>
					  	</div>
					</div>
	  			</div>
				<div class="panel-footer">
					<a href="#">查看全部</a>
				</div>
	      	</div>

	      	<!-- 公告消息 -->
	      	<div class="top-zone top-notice-zone panel panel-info">
	      		<div class="panel-heading">
	      			公司公告
	      		</div>
	      		<div class="panel-body">
		      		<div class="arrow">
		      			<i class="icon icon-caret-up"></i>
		      		</div>
	  				<div class="comment">
					  	<a href="###" class="avatar">
					    	<img src="/oa/Public/images/user1.png">
					  	</a>
					  	<div class="content">
						    <div class="pull-right text-muted">2 个小时前</div>
						    <div>
						    	<a href="###">
						    		<strong>Catouse</strong>
						    	</a>
						    </div>
						    <div class="text"><a href="">你到底把我家钥匙放哪里了...</a></div>
					  	</div>
					</div>
	  				<div class="comment">
					  	<a href="###" class="avatar">
					    	<img src="/oa/Public/images/user1.png">
					  	</a>
					  	<div class="content">
						    <div class="pull-right text-muted">2 个小时前</div>
						    <div>
						    	<a href="###">
						    		<strong>Catouse</strong>
						    	</a>
						    </div>
						    <div class="text"><a href="">你到底把我家钥匙放哪里了...</a></div>
					  	</div>
					</div>
	  			</div>
				<div class="panel-footer">
					<a href="#">查看全部</a>
				</div>
	      	</div>

	      	<!-- 个人信息 -->
	      	<div class="top-zone top-person-zone panel panel-info">
	      		<div class="arrow">
	      			<i class="icon icon-caret-up"></i>
	      		</div>
	      		<ul class="list-group">
	      			<a href="<?php echo U('Ucenter/Member/index');?>" class="list-group-item">个人信息</a>
	      			<a href="" class="list-group-item">修改密码</a>
	      			<a href="" class="list-group-item">退出</a>
	      		</ul>
	      	</div>
		 </div>
	</nav>
</div>
			
    <div class="main person">
        <div class="contain">
            <ol class="breadcrumb">
                <li><a href="<?php echo U('Home/index/index');?>"><i class="icon icon-home"></i> 首页</a></li>
                <li><i class="icon icon-file-word"></i> 新闻管理</li>
            </ol>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tool-btns">
                        <button class="boxer boxer-info"><i class="icon icon-edit"></i> 增加</button>
                        <button class="boxer boxer-info"><i class="icon icon-remove-circle"></i> 删除</button>
                    </div>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="check" ></th>
                                <th>新闻标题</th>
                                <th>作者</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox" name="ids" value="1"></td>
                                <td>习近平：把思想政治工作贯穿教育教学全过程</td>
                                <td>吴晶</td>
                                <td>2016-12-08 18:42</td>
                                <td>
                                    <a href="" class="a-icon-info"><i class="icon icon-edit"></i></a>
                                    <a href="" class="a-icon-info"><i class="icon icon-remove-circle"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="ids" value="1"></td>
                                <td>习近平：把思想政治工作贯穿教育教学全过程</td>
                                <td>吴晶</td>
                                <td>2016-12-08 18:42</td>
                                <td>
                                    <a href="" class="a-icon-info"><i class="icon icon-edit"></i></a>
                                    <a href="" class="a-icon-info"><i class="icon icon-remove-circle"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="ids" value="1"></td>
                                <td>习近平：把思想政治工作贯穿教育教学全过程</td>
                                <td>吴晶</td>
                                <td>2016-12-08 18:42</td>
                                <td>
                                    <a href="" class="a-icon-info"><i class="icon icon-edit"></i></a>
                                    <a href="" class="a-icon-info"><i class="icon icon-remove-circle"></i></a>
                                </td>
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

    function a(){
        var names = $("input[name='ids']:checked").map(function(){
             return $(this).val();  
        }).get().join(',');
        alert(names)
    }

    $('table.datatable').datatable({
        checkable: true, // 启用数据表格的选中功能
        selectable: {    // 设置拖拽选择的选项
            finish: function(e) {
                console.log('当前选中的行数：', e.selected.length);
            }
        }
    });
</script>

</body>
</html>