<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	
    <title>新闻管理</title>

	<meta charset="utf-8" />
	<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/oa/Public/zui/css/zui.css">
	<link rel="stylesheet" type="text/css" href="/oa/Public/zui/lib/calendar/zui.calendar.css">
	<link rel="stylesheet" type="text/css" href="/oa/Public/css/core.css">
	
<link rel="stylesheet" type="text/css" href="/oa/Public/zui/lib/datetimepicker/datetimepicker.css">
<style type="text/css">
    .cover input{
            position: absolute;
            width:80px;
            height:80px;
        }
        .cover img{
            width:80px;
            height:80px;
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
                <li><a href="<?php echo U('News/List/index');?>"><i class="icon icon-list"></i> 新闻管理</a></li>
                <li>编辑-<?php echo ($info["title"]); ?></li>
            </ol>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="container">
                        <form id="edit_news" action="<?php echo U();?>" method="post" enctype="multipart/form-data">
                            <article class="article">
                                <header>
                                    <h1 class="text-center"><input type="text" class="input text-center" name="title" class="title" placeholder="请输入新闻标题" value="<?php echo ($info["title"]); ?>"></h1>
                                    <dl class="dl-inline">
                                      <dt>来源：</dt>
                                      <dd><input type="text" class="input" name="from" placeholder="文章来源" value="<?php echo ($info["from"]); ?>" /></dd>
                                      <dt>时间：</dt>
                                      <dd><input type="text" class="form-datetime input" name="date" value="<?php echo ($info["time"]); ?>" /></dd>
                                      <dt>作者：</dt>
                                      <dd><input type="text" class="input" name="author" value="<?php echo ($info["author"]); ?>" /></dd>
                                    </dl>
                                    <section class="abstract">
                                      <p><strong>摘要：</strong><input type="text" class="input" name="abstract" placeholder="请简略填写文章内容" value="<?php echo ($info["info"]); ?>"></p>
                                    </section>
                                </header>
                                <section>
                                    <!-- 加载编辑器的容器 -->
                                    <script id="container" style="height:400px" name="content" type="text/plain"></script>
                                </section>
                                <section>
                                    <div class="cover">
                                        <dl class="dl-inline">
                                            <dt>选择封面：</dt>
                                            <dd>
                                                <input type="file" class="fade form-control path" name="path" title="上传照片" onchange="getPhoto(this)" value="">
                                                <div class="coverZone"><img class="coverIMG" src="<?php echo ($info["cover"]); ?>"></div>
                                            </dd>
                                        </dl>
                                        
                                    </div>
                                </section>
                                <footer class="text-center">
                                    <input type="hidden" name="cover" value="0" />
                                    <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
                                    <button type="submit" class="boxer boxer-info">提交</button>
                                </footer>
                            </article>
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
    <script type="text/javascript" src="/oa/Public/zui/lib/datetimepicker/datetimepicker.js"></script>
    <script type="text/javascript" src="/oa/Public/js/jquery.form.js"></script>

    <script type="text/javascript">
        $("input").focus(function(){
            $(this).removeClass("input-error");
        });
        u = UE.getEditor('container');
        u.ready(function(){
          u.setContent('<?php echo (htmlspecialchars_decode(stripslashes($info["contain"]))); ?>')
        });
        $(document).ready(function(){
            // $("#edit_news").submit(function(){
            //     data = $(this).serialize();
            //     to_url = $(this).attr('action');
            //     $("#edit_news").ajaxSubmit({
            //         data:data,
            //         url:to_url,
            //         type:"post",
            //         dataType:"json",
            //         success:function(data){
            //             if(data.status==1){
            //                 message_s(data.message);
            //                 setTimeout(function(){
            //                     window.location.href=data.url;
            //                 },1000);
            //             }else{
            //                 message_e(data.message);
            //             }
            //         }
            //     });
            //     return false;
            // })
        })
        // 选择时间和日期
        $(".form-datetime").datetimepicker(
        {
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1,
            format: "yyyy-mm-dd hh:ii"
        });
        
        function getPhoto(node){
            $("input[name='cover']").val(1);
            var imgURL = "";  
            try{  
                var file = null;  
                if(node.files && node.files[0] ){  
                    file = node.files[0];  
                }else if(node.files && node.files.item(0)) {  
                    file = node.files.item(0);  
                }  
                //Firefox 因安全性问题已无法直接通过input[file].value 获取完整的文件路径  
                try{  
                    imgURL =  file.getAsDataURL();  
                }catch(e){  
                    imgURL = window.URL.createObjectURL(file);  
                }  
            }catch(e){  
                if (node.files && node.files[0]) {  
                    var reader = new FileReader();  
                    reader.onload = function (e) {  
                        imgURL = e.target.result;  
                    };  
                    reader.readAsDataURL(node.files[0]);  
                }  
            }  
            creatImg(imgURL);  
            return imgURL;  
        }
        function creatImg(imgURL){  
            html = '<img class="coverIMG" src="'+imgURL+'">';
            $(".coverZone").html(html); 
        }
  
    </script>

</body>
</html>