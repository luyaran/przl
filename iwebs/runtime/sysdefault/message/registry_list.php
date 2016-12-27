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
<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/editor/kindeditor-min.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/editor/lang/zh_CN.js"></script><script type="text/javascript">window.KindEditor.options.uploadJson = "/iwebs/index.php?controller=pic&action=upload_json";window.KindEditor.options.fileManagerJson = "/iwebs/index.php?controller=pic&action=file_manager_json";</script>
<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
<div class="headbar">
	<div class="position"><span>会员</span><span>></span><span>信息处理</span><span>></span><span>邮件订阅</span></div>
	<div class="operating">
		<a href="javascript:void(0)" onclick="writeMail();"><button class="operating_btn" type="button"><span class="send">发送邮件</span></button></a>
		<a href="javascript:void(0)" onclick="selectAll('id[]')"><button class="operating_btn" type="button"><span class="sel_all">全选</span></button></a>
		<a href="javascript:void(0)" onclick="delModel({form:'notify_list',msg:'确定要删除选中的记录吗？'})"><button class="operating_btn" type="button"><span class="delete">批量删除</span></button></a>
	</div>
	<div class="field">
		<table class="list_table">
			<colgroup>
				<col width="50px" />
				<col />
			</colgroup>

			<thead>
				<tr role="head">
					<th class="t_c">选择</th>
					<th>email</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<form action="<?php echo IUrl::creatUrl("/message/registry_del");?>" method="post" name="notify_list" onsubmit="return checkboxCheck('id[]','尚未选中任何记录！')">
<div class="content" style="position:relative;">
	<table id="list_table" class="list_table">
		<colgroup>
			<col width="50px" />
			<col />
		</colgroup>

		<tbody>
			<?php $page= (isset($_GET['page'])&&(intval($_GET['page'])>0))?intval($_GET['page']):1;?>
			<?php $query = new IQuery("email_registry");$query->order = "id desc";$query->page = "$page";$items = $query->find(); foreach($items as $key => $item){?>
			<tr>
				<td class="t_c"><input class="check_ids" name="id[]" type="checkbox" value="<?php echo isset($item['id'])?$item['id']:"";?>" /></td>
				<td><?php echo isset($item['email'])?$item['email']:"";?></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</div>
<?php echo $query->getPageBar();?>
</form>

<script id="emailTemplate" type="text/html">
<div class="pop_win" style="width:100%;height:100%">
	<div class="content">
		<form name="form_filter" action="<?php echo IUrl::creatUrl("/message/registry_message_send");?>" method="post">
			<table class="form_table">
			<colgroup>
				<col width="50px" />
				<col />
			</colgroup>

			<tbody>
				<tr>
					<td class="t_r">标题：</td>
					<td><input class="middle" type="text" name="title" id="form_title" value="" /></td>
				</tr>

				<tr>
					<td valign="top" class="t_r">内容：</td>
					<td><textarea id="content" name="content" style="height:400px;width:97%"></textarea></td>
				</tr>
			</tbody>
			</table>
		</form>
	</div>
</div>
</script>

<script type="text/javascript">
function writeMail()
{
	art.dialog(
	{
		id: 'registryWin',
		width:900,
		height:550,
		title: '发送订阅邮件',
		content: template.render('emailTemplate'),
		init:function()
		{
			KindEditor.create('#content');
		},
		ok:function()
		{
			KindEditor.sync("#content");
			art.dialog({'id':'tmpTan',content:"正在发送，请稍候......" ,lock:true});
			var title = $("#form_title").val();
			var content = $("#content").val();
			var ids = getArray('id[]','checkbox');
			ids = ids.join(',');
			$.post("<?php echo IUrl::creatUrl("/message/registry_message_send");?>" , {'title':title,'content':content,'ids':ids} , function(c)
			{
				if(c == 'success')
				{
					alert("发送完毕！");
				}
				else
				{
					alert(c);
				}
				art.dialog({'id':"tmpTan"}).close();
			});
		},
		cancel:function()
		{
			KindEditor.remove('#content');
		}
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
