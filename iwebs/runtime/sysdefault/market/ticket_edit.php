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
			<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/my97date/wdatepicker.js"></script>

<div class="headbar">
	<div class="position"><span>营销</span><span>></span><span>代金券管理</span><span>></span><span><?php if(isset($this->ticketRow['id'])){?>编辑<?php }else{?>添加<?php }?>代金券</span></div>
</div>
<div class="content_box">
	<div class="content form_content">
		<form action="<?php echo IUrl::creatUrl("/market/ticket_edit_act");?>" name='ticket_edit'  method="post">
			<input type='hidden' name='id' />
			<table class="form_table">
				<col width="150px" />
				<col />
				<tr>
					<th>代金券名称：</th>
					<td>
						<input type='text' name='name' class='normal' pattern='required' alt='请填写代金券名称' />
						<label>* 请为此组代金券命名</label>
					</td>
				</tr>
				<tr>
					<th>代金券面额：</th>
					<td><input type='text' class='small' pattern='float' alt='必须填写数字' name='value' />元<label>* 请填写此组代金券所能抵销的金额</label></td>
				</tr>
				<tr>
					<th>有效时间段：</th>
					<td>
						<input type='text' name='start_time' class='Wdate' pattern='datetime' readonly=true onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" alt='请填写一个日期' /> ～
						<input type='text' name='end_time' class='Wdate' pattern='datetime' readonly=true onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" alt='请填写一个日期' />
						<label>* 此组代金券的使用时间段</label>
					</td>
				</tr>
				<tr>
					<th>兑换所需积分：</th>
					<td><input type='text' class='small' pattern='int' empty alt='必须填写数字' name='point' /><label>设置兑换此代金券所需要的积分，如果为空或0则表示此优惠券不支持积分兑换</label></td>
				</tr>
				<tr><td></td><td><button class="submit" type='submit'><span>确 定</span></button></td></tr>
			</table>
		</form>
	</div>
</div>

<script type='text/javascript'>
	//表单回填
	var formObj = new Form('ticket_edit');
	formObj.init
	({
		'id':'<?php echo isset($this->ticketRow['id'])?$this->ticketRow['id']:"";?>',
		'name':'<?php echo isset($this->ticketRow['name'])?$this->ticketRow['name']:"";?>',
		'start_time':'<?php echo isset($this->ticketRow['start_time'])?$this->ticketRow['start_time']:"";?>',
		'end_time':'<?php echo isset($this->ticketRow['end_time'])?$this->ticketRow['end_time']:"";?>',
		'value':'<?php echo isset($this->ticketRow['value'])?$this->ticketRow['value']:"";?>',
		'point':'<?php echo isset($this->ticketRow['point'])?$this->ticketRow['point']:"";?>'
	});

	//当修改操作时禁止修改金额
	if($('[name="id"]').val())
	{
		$('[name="value"]').attr('readonly',true);
		$('[name="value"]').css('background','#bbb');
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
