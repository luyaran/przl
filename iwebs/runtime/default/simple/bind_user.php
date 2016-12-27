<?php 
	$siteConfig = new Config("site_config");
	$callback   = IReq::get('callback') ? urlencode(IFilter::act(IReq::get('callback'),'url')) : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $siteConfig->name;?></title>
	<link type="image/x-icon" href="favicon.ico" rel="icon">
	<link rel="stylesheet" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/index.css";?>" />
	<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/jquery/jquery-1.11.3.min.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/jquery/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/autovalidate/validate.js"></script><link rel="stylesheet" type="text/css" href="/iwebs/runtime/_systemjs/autovalidate/style.css" />
	<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/form/form.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/artdialog/artDialog.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/iwebs/runtime/_systemjs/artdialog/skins/aero.css" />
	<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/common.js";?>"></script>
	<script type='text/javascript' src='<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/site.js";?>'></script>
</head>
<body class="second" >
	<div class="brand_list container_2">
		<div class="header">
			<h1 class="logo"><a title="<?php echo $siteConfig->name;?>" style="background:url(<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/front/logo.gif";?>);" href="<?php echo IUrl::creatUrl("");?>"><?php echo $siteConfig->name;?></a></h1>
			<ul class="shortcut">
				<li class="first"><a href="<?php echo IUrl::creatUrl("/ucenter/index");?>">我的账户</a></li>
				<li><a href="<?php echo IUrl::creatUrl("/ucenter/order");?>">我的订单</a></li>
				<li><a href="<?php echo IUrl::creatUrl("/simple/seller");?>">申请开店</a></li>
				<li><a href="<?php echo IUrl::creatUrl("/seller/index");?>">商家管理</a></li>
		   		<li class='last'><a href="<?php echo IUrl::creatUrl("/site/help_list");?>">使用帮助</a></li>
			</ul>

			<p class="loginfo">
			<?php if($this->user){?>
			<?php echo isset($this->user['username'])?$this->user['username']:"";?>您好，欢迎您来到<?php echo $siteConfig->name;?>购物！[<a href="<?php echo IUrl::creatUrl("/simple/logout");?>" class="reg">安全退出</a>]
			<?php }else{?>
			[<a href="<?php echo IUrl::creatUrl("/simple/login?callback=".$callback."");?>">登录</a><a class="reg" href="<?php echo IUrl::creatUrl("/simple/reg?callback=".$callback."");?>">免费注册</a>]
			<?php }?>
			</p>
		</div>
	    <div class="wrapper clearfix">
	<div class="wrap_box">
		<?php $type = IReq::get('bind_type')?>
		<?php if($type == 'exists'){?>
		<h3 class="notice">绑定已有<?php echo $siteConfig->name;?>账号</h3>
		<p class="tips">您可以直接把第三方登录的用户信息与您的<?php echo $siteConfig->name;?>账号绑定在一起</p>
		<div class="box">
			<form action='<?php echo IUrl::creatUrl("/simple/bind_exists_user");?>' method='post'>
				<table class="form_table f_l">
					<col width="300px" />
					<col />
					<?php if($this->message != ''){?>
					<tr><th></th><td><div class="prompt"><img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/front/error_s.gif";?>" width="16" height="15" /><?php echo isset($this->message)?$this->message:"";?></div></td></tr>
					<?php }?>

					<tr><th class="t_r">用户名/邮箱：</th><td><input class="gray" type="text" name='login_info' value='<?php echo isset($this->login_info)?$this->login_info:"";?>' pattern="required" alt="请输入正确的用户名或者邮箱地址" /></td></tr>
					<tr><th class="t_r">密码：</th><td><input class="gray" name='password' type="password" pattern="^\S{4,20}$" alt="请输入正确的密码4-20个字符" /></td></tr>
					<tr><th></th><td><label class="btn_orange"><input type="submit" value='绑定' /></label> &nbsp; <label class="btn_orange"><input type='button' value='没有<?php echo $siteConfig->name;?>账号' onclick="window.location.href='<?php echo IUrl::creatUrl("/simple/bind_user");?>';" /></label></td></tr>
				</table>
			</form>
		</div>
		<?php }else{?>
		<h3 class="notice">完善基本的<?php echo $siteConfig->name;?>账号信息</h3>
		<p class="tips">完善了基本信息后，您可以直接把第三方登录的用户信息与您的<?php echo $siteConfig->name;?>账号绑定在一起</p>
		<div class="box">
			<form action='<?php echo IUrl::creatUrl("/simple/bind_nexists_user");?>' method='post'>
				<table class="form_table">
					<col width="300px" />
					<col />
					<?php if($this->message != ''){?>
					<tr><th></th><td><div class="prompt"><img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/front/error_s.gif";?>" width="16" height="15" /><?php echo isset($this->message)?$this->message:"";?></div></td></tr>
					<?php }?>

					<tr><th class="t_r">用户名：</th><td><input class="gray" name='username' value="<?php echo isset($this->oauth_username) ? $this->oauth_username : ISafe::get('oauth_username');?>" type="text" pattern="required" alt="请输入正确的用户名" /></td></tr>
					<tr><th class="t_r">邮箱：</th><td><input class="gray" name='email' type="text" pattern="email" value="<?php echo isset($this->email)?$this->email:"";?>" alt="请输入正确邮箱地址" /></td></tr>
					<tr><th></th><td><label class="btn_orange"><input type="submit" value='绑定' /></label> &nbsp; <label class="btn_orange"><input type='button' value='我有<?php echo $siteConfig->name;?>账号' onclick="window.location.href='<?php echo IUrl::creatUrl("/simple/bind_user/bind_type/exists");?>';" /></label></td></tr>
				</table>
			</form>
		</div>
		<?php }?>
	</div>
</div>

<script text="text/javascript">
	jQuery()
	{
		$(".form_table input").focus(function(){$(this).addClass('current');}).blur(function(){$(this).removeClass('current');})
	}
</script>

		<?php echo IFilter::stripSlash($siteConfig->site_footer_code);?>
	</div>
</body>
</html>
