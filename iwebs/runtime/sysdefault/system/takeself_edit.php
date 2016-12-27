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
			<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
<script type='text/javascript' src='<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/artTemplate/area_select.js";?>'></script>

<div class="headbar">
	<div class="position"><span>系统</span><span>></span><span>自提点管理</span><span>></span><span>自提点管理编辑</span></div>
</div>
<div class="content_box">
	<div class="content form_content">
		<form action='<?php echo IUrl::creatUrl("/system/takeself_update");?>' method='post' name='takeself'>
			<input type='hidden' name='id' value=""/>
			<table class="form_table">
				<col width="150px" />
				<col />
				<tr>
					<th>名称：</th>
					<td>
						<input type='text' class='normal' name='name' value='<?php echo isset($this->takeselfRow['name'])?$this->takeselfRow['name']:"";?>' pattern='required' alt="填写名称" />
						<label>*自提点名称（必填）</label>
					</td>
				</tr>
				<tr>
					<th>地区：</th>
					<td>
						<select name="province" child="city,area" onchange="areaChangeCallback(this);" class="auto"></select>
						<select name="city" child="area" parent="province" onchange="areaChangeCallback(this);" class="auto"></select>
						<select name="area" parent="city" class="auto"></select>
					</td>
				</tr>
				<tr>
					<th>地址：</th>
					<td>
						<input type='text' class='normal' name='address' value='<?php echo isset($this->takeselfRow['address'])?$this->takeselfRow['address']:"";?>' pattern='required' alt="填写名称" />
						<label>*具体地址（必填）</label>
					</td>
				</tr>
				<tr>
					<th>固定电话：</th>
					<td>
						<input type='text' class='normal' name='phone' value='<?php echo isset($this->takeselfRow['phone'])?$this->takeselfRow['phone']:"";?>' pattern='required' alt="填写名称" />
						<label>*自提点固定电话（必填）</label>
					</td>
				</tr>
				<tr>
					<th>手机：</th>
					<td>
						<input type='text' class='normal' name='mobile' value='<?php echo isset($this->takeselfRow['mobile'])?$this->takeselfRow['mobile']:"";?>' pattern='required' alt="填写名称" />
						<label>*自提点负责人手机（必填）</label>
					</td>
				</tr>
				<tr>
					<th>排序：</th>
					<td>
						<input type='text' class='normal' name='sort' value='<?php echo isset($this->takeselfRow['sort'])?$this->takeselfRow['sort']:"";?>' pattern='' alt="填写名称" />
						<label>数据排序,数字越小越靠前</label>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<button class='submit' type='submit'><span>确 定</span></button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<script type='text/javascript'>
	//DOM加载完毕
	$(function(){
		//初始化地域联动
		template.compile("areaTemplate",areaTemplate);

		//修改模式
		<?php if(isset($this->takeselfRow)){?>
			var formObj = new Form('takeself');
			formObj.init(<?php echo JSON::encode($this->takeselfRow);?>);

			//城市设置
			<?php if(isset($this->takeselfRow['area'])){?>
				createAreaSelect('province',0,"<?php echo isset($this->takeselfRow['province'])?$this->takeselfRow['province']:"";?>");
				createAreaSelect('city',"<?php echo isset($this->takeselfRow['province'])?$this->takeselfRow['province']:"";?>","<?php echo isset($this->takeselfRow['city'])?$this->takeselfRow['city']:"";?>");
				createAreaSelect('area',"<?php echo isset($this->takeselfRow['city'])?$this->takeselfRow['city']:"";?>","<?php echo isset($this->takeselfRow['area'])?$this->takeselfRow['area']:"";?>");
			<?php }else{?>
				createAreaSelect('province',0,"");
			<?php }?>
		<?php }else{?>
			createAreaSelect('province',0,'');
		<?php }?>
	});

	/**
	 * 生成地域js联动下拉框
	 * @param name
	 * @param parent_id
	 * @param select_id
	 */
	function createAreaSelect(name,parent_id,select_id)
	{
		//生成地区
		$.getJSON("<?php echo IUrl::creatUrl("/block/area_child");?>",{"aid":parent_id,"random":Math.random()},function(json)
		{
			$('[name="'+name+'"]').html(template.render('areaTemplate',{"select_id":select_id,"data":json}));
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
