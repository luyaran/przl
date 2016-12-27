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
	<div class="position"><span>会员</span><span>></span><span>信息处理</span><span>></span><span>到货通知</span></div>
	<div class="operating">
		<a href="javascript:void(0)" onclick="sendMail()"><button class="operating_btn" type="button"><span class="send">发送通知</span></button></a>
		<a href="javascript:void(0)" onclick="selectAll('check[]')"><button class="operating_btn" type="button"><span class="sel_all">全选</span></button></a>
		<a href="javascript:void(0)" onclick="delModel({form:'notify_list',msg:'确定要删除选中的记录吗？'})"><button class="operating_btn" type="button"><span class="delete">批量删除</span></button></a>
	</div>
	<div class="field">
		<table class="list_table">
			<colgroup>
				<col width="40px" />
				<col />
				<col width="100px" />
				<col width="100px" />
				<col width="150px" />
				<col width="130px" />
				<col width="130px" />
				<col width="100px" />
			</colgroup>

			<thead>
				<tr>
					<th class="t_c">选择</th>
					<th>缺货商品名称</th>
					<th>库存</th>
					<th>用户名</th>
					<th>email</th>
					<th>登记时间</th>
					<th>通知时间</th>
					<th>通知状态</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<form action="<?php echo IUrl::creatUrl("/message/notify_del");?>" method="post" name="notify_list" onsubmit="return checkboxCheck('check[]','尚未选中任何记录！')">
<div class="content" style="position:relative;">
	<table id="list_table" class="list_table">
		<colgroup>
			<col width="40px" />
			<col />
			<col width="100px" />
			<col width="100px" />
			<col width="150px" />
			<col width="130px" />
			<col width="130px" />
			<col width="100px" />
		</colgroup>
		<tbody>
			<?php $page= (isset($_GET['page'])&&(intval($_GET['page'])>0))?intval($_GET['page']):1;?>
			<?php $query = new IQuery("notify_registry as notify");$query->join = "left join goods as goods on notify.goods_id = goods.id left join user as u on notify.user_id = u.id";$query->fields = "notify.*,u.username,goods.name as goods_name,goods.store_nums";$query->page = "$page";$items = $query->find(); foreach($items as $key => $item){?>
			<tr>
				<td class="t_c"><input class="check_ids" name="check[]" type="checkbox" value="<?php echo isset($item['id'])?$item['id']:"";?>" /></td>
				<td><a href="<?php echo IUrl::creatUrl("/goods/goods_edit/gid/".$item['goods_id']."");?>"><?php echo isset($item['goods_name'])?$item['goods_name']:"";?></a></td>
				<td><?php echo isset($item['store_nums'])?$item['store_nums']:"";?></td>
				<td><a href="<?php echo IUrl::creatUrl("/member/member_edit/uid/".$item['user_id']."");?>"><?php echo isset($item['username'])?$item['username']:"";?></a></td>
				<td><?php echo isset($item['email'])?$item['email']:"";?></td>
				<td><?php echo isset($item['register_time'])?$item['register_time']:"";?></td>
				<td><?php echo isset($item['notify_time'])?$item['notify_time']:"";?></td>
				<td><?php if($item['notify_status']==1){?>已通知<?php }else{?>未通知<?php }?></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</div>

<?php echo $query->getPageBar();?>
</form>

<script type='text/javascript'>
function sendMail()
{
	var ids = getArray('check[]','checkbox')
	if(ids.length>0)
	{
		loadding('正在发送邮件，请稍候......');
		$.getJSON('<?php echo IUrl::creatUrl("/message/notify_send");?>',{notifyid:ids},function(c)
		{
			unloadding();
			if(c.isError == false)
			{
				art.dialog({
					content: '总共发送邮件：'+c.count+'条<br />成功发送：'+c.succeed+'条<br />发送失败：'+c.failed+'条',
					icon: 'alert',
					lock: true,
					ok: function()
					{
						location.reload();
						return true;
					}
				});
			}
			else
			{
				alert(c.message);
			}
		});
	}
	else
	{
		alert("您尚未选中任何记录！");
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
