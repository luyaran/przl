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
			<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/editor/kindeditor-min.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/editor/lang/zh_CN.js"></script><script type="text/javascript">window.KindEditor.options.uploadJson = "/iwebs/index.php?controller=pic&action=upload_json";window.KindEditor.options.fileManagerJson = "/iwebs/index.php?controller=pic&action=file_manager_json";</script>
<div class="headbar">
	<div class="position"><span>会员</span><span>></span><span>用户组管理</span><span>></span><span><?php if(isset($group['group_id'])){?>修改<?php }else{?>添加<?php }?>用户组</span></div>
</div>
<div class="content_box">
	<div class="content form_content">
		<form action="<?php echo IUrl::creatUrl("/member/group_save");?>" method="post">
			<input type="hidden" name="group_id" value="<?php echo isset($group['group_id'])?$group['group_id']:"";?>" />
			<table class="form_table">
				<col width="150px" />
				<col />
				<tr>
					<th>用户组：</th><td><input class="normal" name="group_name" type="text" value="<?php echo isset($group['group_name'])?$group['group_name']:"";?>" pattern="required" alt="名称不能为空" /><label>* 用户组名称</label></td>
				</tr>
				<tr>
					<th>折扣率：</th><td><input class="normal" name="discount" type="text" value="<?php echo isset($group['discount'])?$group['discount']:"";?>" pattern="float" alt="格式不正确（请输入数字，允许包含小数）" />%<label>折扣率，例如：如果输入90，表示该会员组可以以商品原价的90%购买（允许包含小数）。</label></td>
				</tr>
				<tr>
					<th>最小经验：</th><td><input class="small" name="minexp" onblur="check_exp();" type="text" value="<?php echo isset($group['minexp'])?$group['minexp']:"";?>" pattern="int" alt="请填写一个整数值" /><label>进入此会员组的经验值下限</label></td>
				</tr>
				<tr>
					<th>最大经验：</th>
					<td>
						<input class="small" name="maxexp" onblur="check_exp();" type="text" value="<?php echo isset($group['maxexp'])?$group['maxexp']:"";?>" pattern="int" alt="请填写一个整数值" />
						<label>进入此会员组的经验值上限</label>
					</td>
				</tr>
				<tr>
					<td></td><td><button class="submit" type="submit"><span>确 定</span></button></td>
				</tr>
			</table>
		</form>
	</div>
</div>

<script type='text/javascript'>
	//检查经验输入
	function check_exp()
	{
		var minexp = parseInt($('[name="minexp"]').val());
		var maxexp = parseInt($('[name="maxexp"]').val());

		if(maxexp <= minexp)
		{
			alert('最大经验值必须比最小经验值大');
			$('[name="minexp"]').removeClass('valid-text');
			$('[name="maxexp"]').removeClass('valid-text');
			$('[name="minexp"]').addClass('invalid-text');
			$('[name="maxexp"]').addClass('invalid-text');
			return false;
		}
		else
		{
			$('[name="minexp"]').removeClass('invalid-text');
			$('[name="maxexp"]').removeClass('invalid-text');
		}
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
