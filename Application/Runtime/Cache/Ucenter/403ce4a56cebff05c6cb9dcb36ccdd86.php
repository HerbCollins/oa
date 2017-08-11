<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>登陆</title>
	<link rel="stylesheet" type="text/css" href="/oa/Public/zui/css/zui.css">
	<link rel="stylesheet" type="text/css" href="/oa/Public/css/core.css">
	<link rel="stylesheet" type="text/css" href="/oa/Public/css/login.css">
</head>
<body>
	<div class="login">
		<div class="logo breathe">
			<img src="/oa/Public/images/logo.png">
		</div>
		<div class="login-contain">
			<form action="<?php echo U();?>" method="post">
				<div class="input-group">
  					<span class="input-group-addon"><i class="icon icon-user"></i></span>
					<input type="text" class="input input-common" placeholder="请输入账号" name="name">
				</div>
				<div class="input-group">
  					<span class="input-group-addon"><i class="icon icon-lock"></i></span>
					<input type="password" class="input input-common" placeholder="请输入密码" name="password">
				</div>
				<div class="input-group">
  					<span class="input-group-addon"><i class="icon icon-lock"></i></span>
					<input type="password" class="input input-common" placeholder="请确认密码" name="password_check">
				</div>
				<div class="input-group">
  					<span class="input-group-addon"><i class="icon icon-lock"></i></span>
					<input type="text" class="input input-common" placeholder="请输入手机号" name="phone">
				</div>
				<div class="verify">
					<div class="col-xs-8">
						<div class="input-group">
		  					<span class="input-group-addon"><i class="icon icon-qrcode"></i></span>
							<input type="text" class="input input-common" placeholder="请输入验证码" name="verify">
						</div>
					</div>
					<div class="col-xs-4">
						<img src="<?php echo U('verify');?>" class="captcha_img" title="点击刷新">
					</div>
				</div>
				<div class="form-group text-center">
					<button type="submit" class="boxer boxer-info-full">注册</button>
				</div>
				<div class="clear">
					<div class="col-xs-4"><hr></div>
					<div class="col-xs-4 text-center no-account">已有账号？</div>
					<div class="col-xs-4"><hr></div>
				</div>
				<div class="form-group text-center">
					<a href="<?php echo U('login');?>" type="submit" class="boxer boxer-back-full">登陆</a>
				</div>
			</form>
			<div class="footer">
				<p>作者:<a href="" class="tip">樊格</a>、<a href="" class="tip">王庭村</a></p>
				<p>2017计算机科学与技术毕业设计</p>
			</div>
		</div>
	</div>
</body>
	<script type="text/javascript" src="/oa/Public/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/oa/Public/zui/js/zui.js"></script>
	<script type="text/javascript" src="/oa/Public/js/common.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".captcha_img").click(function(){
				changeVerify();
			});
			$("input").focus(function(){
				icon_active = $(this).prev().find(".icon");
				icon_active.addClass("icon-active");
			}).blur(function(){
				icon_active.removeClass("icon-active")
			})
			$("form").submit(function(){
				data = $(this).serialize();
				url = $(this).attr('action');
				$.ajax({
					cache:false,
					data:data,
					type:"post",
					dataType:"json",
					url:url,
					beforeSend:function(){
						$("button[type='submit']").addClass("boxer-disabled").attr("disabled","disabled");
						btns = '<i class="icon icon-spin icon-spinner-snake"></i> 注册中...';
						$("button[type='submit']").html(btns);
					},
					success:function(data){
						if(data.status == 1){
							btns = '<i class="icon icon-check-circle"></i> 注册成功，正在跳转...';
							$("button[type='submit']").html(btns);
							window.location.href = "<?php echo U('Ucenter/Member/login');?>";
						}else{
							message_e(data.message);
							$("button[type='submit']").removeClass("boxer-disabled").removeAttr("disabled");
							btns = '登陆';
							$("button[type='submit']").html(btns);
							changeVerify();
						}
					}
				})
				return false;
			})
		})
		function changeVerify(){ 
			var captcha_img = $('.captcha_img');  
			var verifyimg = captcha_img.attr("src");  
		    if(verifyimg.indexOf('?')>0){  
		        $(captcha_img).attr("src", verifyimg+'&random='+Math.random());  
		    }else{  
		        $(captcha_img).attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());  
		    }  
		}
	</script>
</html>