<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	
    <title>发送消息</title>

	<meta charset="utf-8" />
	<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/oa/Public/zui/css/zui.css">
	<link rel="stylesheet" type="text/css" href="/oa/Public/zui/lib/calendar/zui.calendar.css">
	<link rel="stylesheet" type="text/css" href="/oa/Public/css/core.css">
	
    <style type="text/css">
        h1{
            margin-top:0px;
        }
    </style>

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
                <li>发送消息</li>
            </ol>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="container">
                        <ul class="list-group">
                            <?php if(is_array($users)): $i = 0; $__LIST__ = $users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$u): $mod = ($i % 2 );++$i;?><li class="list-group-item" data-uid="<?php echo ($u['id']); ?>" data-name="<?php echo ($u["name"]); ?>"><a href="###" onclick="to_user(this)"><?php echo ($u["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <div class="container">
                        <form action="<?php echo U('add');?>" method="post" id="add_message" enctype="multipart/form-data">
                            <h1>
                                To:<span id="name"></span>
                            </h1>
                            <header>
                                <h1 class="text-center">
                                    <input type="text" class="input text-center" name="title" class="title" placeholder="请输入消息标题" autocomplete="off">
                                </h1>
                                <input type="hidden" name="toUser">
                            </header>
                            <section>
                                <!-- 加载编辑器的容器 -->
                                <script id="container" style="height:400px" name="content" type="text/plain"></script>
                            </section>
                            
                            <footer class="text-center">
                                <button type="submit" id="add_sub" class="boxer boxer-info">发送</button>
                            </footer>
                        </form>
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
	
    
    <!-- 配置文件 -->
    <script type="text/javascript" src="/oa/Public/zui/lib/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/oa/Public/zui/lib/ueditor/ueditor.all.js"></script> 
    <script type="text/javascript" src="/oa/Public/js/jquery.form.js"></script>

    <script type="text/javascript">
        function to_user(k){
            var li = $(k).parent();
            uid = li.data('uid');
            name = li.data('name');
            $("#name").text(name);
            $('input[name="toUser"]').val(uid);
        }

        $("input").focus(function(){
            $(this).removeClass("input-error");
        });

        var ue = UE.getEditor('container'); 
        $("#add_message").submit(function(){
            var toUser = $("#toUser").val();
            var title = $('input[name="title"]').val();
            if(toUser ==0){
                message_e('请选择接收者');
                return false;
            }
            if(title == '' || title == null){
                message_e('请输入标题');
                return false;
            }
            data = $(this).serialize();
            to_url = $(this).attr('action');
            $.ajax({
                data:data,
                url:to_url,
                type:"post",
                dataType:"json",
                success:function(data){
                    if(data.status==1){
                        message_s(data.message);
                        setTimeout(function(){
                            window.location.href=data.url;
                        },1000);
                    }else{
                        message_e(data.message);
                    }
                },
                error:function(){
                    message_e('error');
                }
            });
            return false;
        })
        
    </script>

</body>
</html>