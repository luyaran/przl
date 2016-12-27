<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>后台管理</title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/admin.css";?>" />
	<meta name="robots" content="noindex,nofollow">
	<link rel="shortcut icon" href="favicon.ico" />
	<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/jquery/jquery-1.11.3.min.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/jquery/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/artdialog/artDialog.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/iwebs/runtime/_systemjs/artdialog/skins/aero.css" />
	<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/form/form.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/autovalidate/validate.js"></script><link rel="stylesheet" type="text/css" href="/iwebs/runtime/_systemjs/autovalidate/style.css" />
	<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
	<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/common.js";?>"></script>
	<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/admin.js";?>"></script>
	<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/menu.js";?>"></script>
</head>
<body>
	<div class="container">
		<div id="header">
			<div class="logo">
				<a href="<?php echo IUrl::creatUrl("/system/default");?>"><img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/logo.gif";?>" width="303" height="43" /></a>
			</div>
			<div id="menu">
				<ul name="menu">
				</ul>
			</div>
			<p><a href="<?php echo IUrl::creatUrl("/systemadmin/logout");?>">退出管理</a> <a href="<?php echo IUrl::creatUrl("/system/admin_repwd");?>">修改密码</a> <a href="<?php echo IUrl::creatUrl("/system/default");?>">后台首页</a> <a href="<?php echo IUrl::creatUrl("");?>" target='_blank'>商城首页</a> <span>您好 <label class='bold'><?php echo isset($this->admin['admin_name'])?$this->admin['admin_name']:"";?></label>，当前身份 <label class='bold'><?php echo isset($this->admin['admin_role_name'])?$this->admin['admin_role_name']:"";?></label></span></p>
		</div>
		<div id="info_bar">
			<label class="navindex"><a href="<?php echo IUrl::creatUrl("/system/navigation");?>">快速导航管理</a></label>
			<span class="nav_sec">
			<?php $adminId = $this->admin['admin_id']?>
			<?php $query = new IQuery("quick_naviga");$query->where = "admin_id = $adminId and is_del = 0";$items = $query->find(); foreach($items as $key => $item){?>
			<a href="<?php echo isset($item['url'])?$item['url']:"";?>" class="selected"><?php echo isset($item['naviga_name'])?$item['naviga_name']:"";?></a>
			<?php }?>
			</span>
		</div>

		<div id="admin_left">
			<ul class="submenu"></ul>
			<div id="copyright"></div>
		</div>

		<div id="admin_right">
			<?php $siteConfigObj = new Config("site_config");$site_config = $siteConfigObj->getInfo();?>

<div class="headbar">
	<div class="position"><span>系统</span><span>></span><span>第三方平台</span><span>></span><span>短信平台</span></div>
</div>
<div class="content_box">
	<div class="content form_content">
		<form action="#" method="post" name='sms_conf'>
			<table class="form_table">
				<colgroup>
					<col width="150px" />
					<col />
				</colgroup>
				<tr>
					<th>说明：</th>
					<td>
						立即接入短信平台！让您的客户把握第一手商城咨询和订单动态
						<a href="http://www.aircheng.com" target="_blank" class="orange">如何使用？</a>
						<p>商城所用的短信内容模板在"/classes/smstemplate.php" 文件中，尽量用原始的短信模板，否则会导致短信发送延迟等问题</p>
						<p>如果想关闭某个短信发送环节，可以直接把相应方法的返回值设置为空</p>
					</td>
				</tr>
				<tr>
					<th>短信平台：</th>
					<td>
						<select name="sms_platform" class="normal">
							<option value="haiyan">HY短信平台</option>
							<option value="zhutong">ZT短信平台</option>
							<option value="rest">RE短信平台</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>商户ID：</th>
					<td><input type='text' class='normal' name='sms_userid' alt='' /><label>购买后分配的<用户ID></label></td>
				</tr>
				<tr>
					<th>用户名：</th>
					<td><input type='text' class='normal' name='sms_username' pattern='required' alt='' /><label>购买后分配的<用户帐号></label></td>
				</tr>
				<tr>
					<th>密码：</th>
					<td><input type='text' class='normal' name='sms_pwd' pattern='required' alt='' /><label>购买后分配的<用户账号密码></label></td>
				</tr>
				<tr>
					<th></th>
					<td>
						<button type='button' class="submit" onclick="submitConfig();"><span>保 存</span></button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<script type='text/javascript'>
jQuery(function()
{
	var formobj = new Form('sms_conf');
	formobj.init(<?php echo JSON::encode($site_config);?>);
});

//ajax提交信息
function submitConfig()
{
	var sendData = {};
	$('select,input[name^="sms_"]').each(function()
	{
		sendData[$(this).attr('name')] = $(this).val();
	});
	$.post("<?php echo IUrl::creatUrl("/system/save_conf");?>",sendData,function(content)
	{
		alert('保存成功');
	});
}
</script>
		</div>
	</div>

	<script type='text/javascript'>
		//DOM加载完毕执行
		$(function(){
			//隔行换色
			$(".list_table tr:nth-child(even)").addClass('even');
			$(".list_table tr").hover(
				function () {
					$(this).addClass("sel");
				},
				function () {
					$(this).removeClass("sel");
				}
			);

			//后台菜单创建
			<?php $menu = new Menu($this->admin);?>
			var data = <?php echo $menu->submenu();?>;
			var current = '<?php echo $menu->current;?>';
			var url='<?php echo IUrl::creatUrl("/");?>';
			initMenu(data,current,url);
		});
	</script>
</body>
</html>
