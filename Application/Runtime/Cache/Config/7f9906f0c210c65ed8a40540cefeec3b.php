<?php if (!defined('THINK_PATH')) exit();?><div class="logo-zone">
	<img src="/oa/Public/images/logo.png" alt="">
</div>
<nav class="menu left-nav" data-toggle="menu">
  	<ul class="nav nav-primary">
  		<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i; if(empty($m['path'])): ?><li class="nav-parent">
  					<a href="<?php echo U($m['path']);?>"><?php echo ($m["menu"]); ?></a>
					<ul class="nav">
		  				<?php if(is_array($m['child'])): $i = 0; $__LIST__ = $m['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U($v['path']);?>"><?php echo ($v["menu"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
		  			</ul>
				</li>
  			<?php else: ?>
				<li>
					<a href="<?php echo U($m['path']);?>"><?php echo ($m["menu"]); ?></a>
				</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
	    <li class="ucenter">
	    	<a href="<?php echo U('Ucenter/Member/index');?>"><i class="icon icon-user"></i> 个人中心</a>
	    </li>
		<a href="<?php echo U('Home/index/sendAnnounce');?>" class="boxer boxer-back-full text-center"><i class="icon icon-bullhorn"></i> 发布公告</a>
		<a href="<?php echo U('Message/index/add');?>" class="boxer boxer-back-full text-center"><i class="icon icon-comment"></i> 发送消息</a>
  	</ul> 
</nav>