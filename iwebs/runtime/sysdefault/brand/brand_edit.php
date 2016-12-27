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
	<div class="position"><span>商品</span><span>></span><span>品牌管理</span><span>></span><span><?php if(isset($brand['id'])){?>编辑<?php }else{?>添加<?php }?>品牌</span></div>
</div>
<div class="content_box">
	<div class="content form_content">
		<form action="<?php echo IUrl::creatUrl("/brand/brand_save");?>" method="post" enctype='multipart/form-data'>
			<table class="form_table" cellpadding="0" cellspacing="0">
				<col width="150px" />
				<col />
				<tr>
					<th>品牌名称：</th>
					<td><input class="normal" name="name" type="text" value="<?php echo isset($brand['name'])?$brand['name']:"";?>" pattern="required" alt="品牌名称不能为空" />
						<label>*</label>
						<input name="brand_id" value="<?php echo isset($brand['id'])?$brand['id']:"";?>" type="hidden" />
					</td>
				</tr>
				<tr>
					<th>排序：</th><td><input class="normal" name="sort" type="text" value="<?php echo isset($brand['sort'])?$brand['sort']:"";?>" pattern='int' empty alt='必需为整形数值'/></td>
				</tr>
				<tr>
					<th>网址：</th><td><input class="normal" name="url" type="text" value="<?php echo isset($brand['url'])?$brand['url']:"";?>" pattern='url' empty alt='网址格式不正确，比如：http://www.jooyea.cn' /><label>完整的URL链接地址，如：http://www.jooyea.cn</label></td>
				</tr>
				<tr>
					<th>LOGO：</th><td><div><?php if(isset($brand['logo'])){?><img src="<?php echo IUrl::creatUrl("")."".$brand['logo']."";?>" height="60px"/><br /><?php }?><input type='file' class='normal' name='logo'/></div></td>
				</tr>
				<tr>
					<th>所属分类：</th>
					<td>
						<?php $query = new IQuery("brand_category");$items = $query->find(); foreach($items as $key => $item){?><?php }?>
						<?php if($items){?>
						<ul class="select">
							<?php foreach($items as $key => $item){?>
							<li><label><input type="checkbox" value="<?php echo isset($item['id'])?$item['id']:"";?>" name="category[]" <?php if(isset($brand) && stripos(','.$brand['category_ids'].',',','.$item['id'].',') !== false){?>checked="checked"<?php }?> /><?php echo isset($item['name'])?$item['name']:"";?></label></li>
							<?php }?>
						</ul>
						<?php }else{?>
						系统暂无品牌分类，<a href='<?php echo IUrl::creatUrl("/brand/category_edit");?>' class='orange'>请点击添加</a>
						<?php }?>
					</td>
				</tr>
				<tr>
					<th valign="top">描述：</th><td><textarea name="description" id="description" style="width:700px;height:400px;"><?php echo isset($brand['description'])?$brand['description']:"";?></textarea></td>
				</tr>
				<tr>
					<td></td><td><button class="submit" type="submit"><span>确 定</span></button></td>
				</tr>
			</table>
		</form>
	</div>
</div>

<script type="text/javascript">
$(function()
{
	//编辑器载入
	KindEditor.ready(function(K){
		K.create('#description');
	});
})
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
