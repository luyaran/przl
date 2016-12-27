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
	<div class="position"><span>营销</span><span>></span><span>营销活动管理</span><span>></span><span><?php if(isset($this->promotionRow['id'])){?>编辑<?php }else{?>添加<?php }?>秒杀</span></div>
</div>
<div class="content_box">
	<div class="content form_content">
		<form action="<?php echo IUrl::creatUrl("/market/pro_speed_edit_act");?>"  method="post" name='pro_edit'>
			<input type='hidden' name='id' />
			<table class="form_table">
				<col width="150px" />
				<col />
				<tr>
					<th>秒杀名称：</th>
					<td><input type='text' class='normal' name='name' pattern='required' alt='秒杀名称' /><label>* 秒杀名称</label></td>
				</tr>
				<tr>
					<th>秒杀时间：</th>
					<td>
						<input type='text' name='start_time' class='Wdate' pattern='datetime' readonly=true onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" alt='请填写一个日期' /> ～
						<input type='text' name='end_time' class='Wdate' pattern='datetime' readonly=true onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" alt='请填写一个日期' />
						<label>* 此秒杀时间段</label>
					</td>
				</tr>
				<tr>
					<th>是否开启：</th>
					<td>
						<label class='attr'><input type='radio' name='is_close' value='0' />是</label>
						<label class='attr'><input type='radio' name='is_close' value='1' checked=checked />否</label>
					</td>
				</tr>
				<tr>
					<th>允许参与人群：</th>
					<td>
						<ul class='attr_list clearfix'>
							<li><label class='attr'><input type='checkbox' name='group_all' value='all' onchange='select_all();' />全部</label></li>
							<?php $query = new IQuery("user_group");$items = $query->find(); foreach($items as $key => $item){?>
							<li><label class='attr'><input type='checkbox' <?php if(in_array($item['id'],explode(',',$this->promotionRow['user_group']))){?>checked=checked<?php }?> name='user_group[]' value='<?php echo isset($item['id'])?$item['id']:"";?>' /><?php echo isset($item['group_name'])?$item['group_name']:"";?></label></li>
							<?php }?>
						</ul>
						<label>* 此秒杀允许参加的用户组</label>
					</td>
				</tr>

				<tr>
					<th>设置秒杀商品：</th>
					<td>
						<table class='border_table' style='width:65%'>
							<col width="100px" />
							<col width="200px" />
							<col />
							<input type='hidden' name='condition' />
							<thead>
								<tr>
									<th>图片</th>
									<th>名称</th>
									<th>原价格</th>
									<th>秒杀价格</th>
								</tr>
							</thead>
							<tbody>
								<tr id='speed_goods' class='td_c'></tr>
								<tr>
									<td colspan='4'>
										<button type='button' onclick="searchGoods('<?php echo IUrl::creatUrl("/block/search_goods/type/radio");?>',searchGoodsCallback);" class='btn'><span>选择商品</span></button>
										<label>* 设置要秒杀的商品，仅能设置一种商品</label>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<th>介绍：</th>
					<td><textarea class='textarea' name='intro'><?php echo isset($this->promotionRow['intro'])?$this->promotionRow['intro']:"";?></textarea></td>
				</tr>
				<tr><td></td><td><button class="submit" type='submit'><span>确 定</span></button></td></tr>
			</table>
		</form>
	</div>
</div>

<script type='text/javascript'>
	//输入筛选商品的条件
	function searchGoodsCallback(goodsList)
	{
		goodsList.each(function()
		{
			var temp = $.parseJSON($(this).attr('data'));
			var content = {
				"data":
				{
					"id":temp.goods_id,
					"name":temp.name,
					"img":temp.img,
					"sell_price":temp.sell_price
				}
			};
			relationCallBack(content);
		});
	}

	//关联商品回调处理函数
	function relationCallBack(content)
	{
		if(content)
		{
			$('[name="condition"]').val(content['data']['id']);
			var imgUrl = "<?php echo IUrl::creatUrl("")."@url@";?>";
			imgUrl     = imgUrl.replace("@url@",content['data']['img']);

			var html =   '<td><img src="'+imgUrl+'" title="'+content['data']['name']+'" style="max-width:140px;" /></td>'
						+'<td>'+content['data']['name']+'</td>'
						+'<td>'+content['data']['sell_price']+'</td>'
						+'<td><input text="text" class="small" name="award_value" pattern="float" alt="请填写一个数字" />元 </td>';

			$('#speed_goods').html(html);
		}
	}

	//选择参与人群
	function select_all()
	{
		var is_checked = $('[name="group_all"]').attr('checked');
		if(is_checked ==  true)
		{
			var checkedVal  = true;
			var disabledVal = true;
		}
		else
		{
			var checkedVal  = false;
			var disabledVal = false;
		}

		$('input:checkbox[name="user_group[]"]').each(
			function(i)
			{
				$(this).attr('checked',checkedVal);
				$(this).attr('disabled',disabledVal);
			}
		);
	}

	//预定义商品绑定
	relationCallBack(<?php echo isset($this->promotionRow['goodsRow'])?$this->promotionRow['goodsRow']:"";?>);

	//表单回填
	var formObj = new Form('pro_edit');
	formObj.init
	({
		'id':'<?php echo isset($this->promotionRow['id'])?$this->promotionRow['id']:"";?>',
		'name':'<?php echo isset($this->promotionRow['name'])?$this->promotionRow['name']:"";?>',
		'start_time':'<?php echo isset($this->promotionRow['start_time'])?$this->promotionRow['start_time']:"";?>',
		'end_time':'<?php echo isset($this->promotionRow['end_time'])?$this->promotionRow['end_time']:"";?>',
		'group_all':"<?php echo isset($this->promotionRow['user_group'])?$this->promotionRow['user_group']:"";?>",
		'is_close':'<?php echo isset($this->promotionRow['is_close'])?$this->promotionRow['is_close']:"";?>',
		'condition':'<?php echo isset($this->promotionRow['condition'])?$this->promotionRow['condition']:"";?>',
		'award_value':'<?php echo isset($this->promotionRow['award_value'])?$this->promotionRow['award_value']:"";?>'
	});
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
