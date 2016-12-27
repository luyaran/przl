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
<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/my97date/wdatepicker.js"></script>
<?php $swfloadObject = new Swfupload();$swfloadObject->show();?>
<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>

<div class="headbar clearfix">
	<div class="position"><span>商品</span><span>></span><span>商品管理</span><span>></span><span>商品编辑</span></div>
	<ul class="tab" name="menu1">
		<li id="li_1" class="selected"><a href="javascript:void(0)" hidefocus="true" onclick="select_tab('1')">商品信息</a></li>
		<li id="li_2"><a href="javascript:void(0)" hidefocus="true" onclick="select_tab('2')">描述</a></li>
		<li id="li_3"><a href="javascript:void(0)" hidefocus="true" onclick="select_tab('3')">营销选项</a></li>
	</ul>
</div>

<div class="content_box">
	<div class="content form_content">
		<form action="<?php echo IUrl::creatUrl("/goods/goods_update");?>" name="goodsForm" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="" />
			<input type='hidden' name="img" value="" />
			<input type='hidden' name="_imgList" value="" />
			<input type='hidden' name="callback" value="<?php echo IUrl::getRefRoute();?>" />

			<div id="table_box_1">
				<table class="form_table">
					<col width="150px" />
					<col />
					<tr>
						<th>商品名称：</th>
						<td>
							<input class="normal" name="name" type="text" value="" pattern="required" alt="商品名称不能为空" onblur="wordsPart()" /><label>*</label>
						</td>
					</tr>
					<tr>
						<th>关键词：</th>
						<td>
							<input type='text' class='middle' name='search_words' value='' />
							<label>每个关键词最长为15个字符，必须以","(逗号)分隔符</label>
						</td>
					</tr>
					<tr>
						<th>所属商户：</th>
						<td>
							<select class="auto" name="seller_id">
								<option value="0">商城平台自营 </option>
								<?php $query = new IQuery("seller");$query->where = "is_del = 0";$items = $query->find(); foreach($items as $key => $item){?>
								<option value="<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['true_name'])?$item['true_name']:"";?>-<?php echo isset($item['seller_name'])?$item['seller_name']:"";?></option>
								<?php }?>
							</select>
							<a href='<?php echo IUrl::creatUrl("/member/seller_edit");?>' class='orange'>请点击添加商户</a>
						</td>
					</tr>
					<tr>
						<th>所属分类：</th>
						<td>
							<div id="__categoryBox" style="margin-bottom:8px"></div>

							<!--分类数据显示-->
							<script id="categoryButtonTemplate" type="text/html">
							<ctrlArea>
							<input type="hidden" value="<%=templateData['id']%>" name="_goods_category[]" />
							<button class="btn" type="button" onclick="return confirm('确定删除此分类？') ? $(this).parent().remove() : '';">
								<span class="del"><%=templateData['name']%></span>
							</button>
							</ctrlArea>
							</script>

							<button class="btn" type="button" onclick="selectGoodsCategory('<?php echo IUrl::creatUrl("/block/goods_category/type/checkbox");?>','_goods_category[]')"><span class="add">设置分类</span></button>
							<a href='<?php echo IUrl::creatUrl("/goods/category_edit");?>' class='orange'>请点击添加分类</a>
						</td>
					</tr>
					<tr>
						<th>是否上架：</th>
						<td>
							<label class='attr'><input type="radio" name="is_del" value="0" checked> 是</label>
							<label class='attr'><input type="radio" name="is_del" value="2"> 否</label>
							<label>只有上架的商品才会在前台显示出来，客户是无法看到下架商品</label>
						</td>
					</tr>
					<tr>
						<th>是否共享：</th>
						<td>
							<label class='attr'><input type="radio" name="is_share" value="1"> 是</label>
							<label class='attr'><input type="radio" name="is_share" value="0" checked> 否</label>
							<label>共享商品，只有商城平台的商品可以被商家复制，分销</label>
						</td>
					</tr>
					<tr>
						<th>附属数据：</th>
						<td>
							<div class="con">
								<table class="border_table">
									<thead>
										<tr>
											<th>购买成功增加积分</th><th>排序</th><th>计量单位显示</th><th>购买成功增加经验值</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input class="small" name="point" type="text" pattern="int" value="0"/></td>
											<td><input class="small" name="sort" type="text" pattern="int" value="99"/></td>
											<td><input class="small" name="unit" type="text" value="千克"/></td>
											<td><input class="small" name="exp" type="text" pattern="int" value="0"/></td>
										</tr>
									</tbody>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<th>基本数据：</th>
						<td>
							<div class="con">
								<table class="border_table">
									<thead id="goodsBaseHead"></thead>

									<!--商品标题模板-->
									<script id="goodsHeadTemplate" type='text/html'>
									<tr>
										<th>商品货号</th>
										<%var isProduct = false;%>
										<%for(var item in templateData){%>
										<%isProduct = true;%>
										<th><%=templateData[item]['name']%></th>
										<%}%>
										<th>库存</th>
										<th>市场价格</th>
										<th>销售价格</th>
										<th>成本价格</th>
										<th>重量(克)</th>
										<%if(isProduct == true){%>
										<th>操作</th>
										<%}%>
									</tr>
									</script>

									<tbody id="goodsBaseBody"></tbody>

									<!--商品内容模板-->
									<script id="goodsRowTemplate" type="text/html">
									<%var i=0;%>
									<%for(var item in templateData){%>
									<%item = templateData[item]%>
									<tr class='td_c'>
										<td><input class="small" name="_goods_no[<%=i%>]" pattern="required" type="text" value="<%=item['goods_no'] ? item['goods_no'] : item['products_no']%>" /></td>
										<%var isProduct = false;%>
										<%var specArrayList = parseJSON(item['spec_array'])%>
										<%for(var result in specArrayList){%>
										<%result = specArrayList[result]%>
										<input type='hidden' name="_spec_array[<%=i%>][]" value='{"id":"<%=result.id%>","type":"<%=result.type%>","value":"<%=result.value%>","name":"<%=result.name%>"}' />
										<%isProduct = true;%>
										<td>
											<%if(result['type'] == 1){%>
												<%=result['value']%>
											<%}else{%>
												<img class="img_border" width="30px" height="30px" src="<?php echo IUrl::creatUrl("")."<%=result['value']%>";?>">
											<%}%>
										</td>
										<%}%>
										<td><input class="tiny" name="_store_nums[<%=i%>]" type="text" pattern="int" value="<%=item['store_nums']?item['store_nums']:100%>" /></td>
										<td><input class="tiny" name="_market_price[<%=i%>]" type="text" pattern="float" value="<%=item['market_price']%>" /></td>
										<td>
											<input type='hidden' name="_groupPrice[<%=i%>]" value="<%=item['groupPrice']%>" />
											<input class="tiny" name="_sell_price[<%=i%>]" type="text" pattern="float" value="<%=item['sell_price']%>" />
											<button class="btn" type="button" onclick="memberPrice(this);"><span class="add <%if(item['groupPrice']){%>orange<%}%>">会员组价格</span></button>
										</td>
										<td><input class="tiny" name="_cost_price[<%=i%>]" type="text" pattern="float" empty value="<%=item['cost_price']%>" /></td>
										<td><input class="tiny" name="_weight[<%=i%>]" type="text" pattern="float" empty value="<%=item['weight']%>" /></td>
										<%if(isProduct == true){%>
										<td><a href="javascript:void(0)" onclick="delProduct(this);"><img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_del.gif";?>" alt="删除" /></a></td>
										<%}%>
									</tr>
									<%i++;%>
									<%}%>
									</script>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<th>商品模型：</th>
						<td>
							<select class="auto" name="model_id" onchange="create_attr(this.value)">
								<option value="0">通用类型 </option>
								<?php $query = new IQuery("model");$items = $query->find(); foreach($items as $key => $item){?>
								<option value="<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['name'])?$item['name']:"";?></option>
								<?php }?>
							</select>
							<label>可以加入商品扩展属性，比如：型号，年代，款式...</label>
						</td>
					</tr>
					<tr id="properties" style="display:none">
						<th>扩展属性：</th>
						<td>
							<table class="border_table1" id="propert_table">
							<script type='text/html' id='propertiesTemplate'>
							<%for(var item in templateData){%>
							<%item = templateData[item]%>
							<%var valueItems = item['value'].split(',');%>
							<tr>
								<th><%=item["name"]%></th>
								<td>
									<%if(item['type'] == 1){%>
										<%for(var tempVal in valueItems){%>
										<%tempVal = valueItems[tempVal]%>
											<label class="attr"><input type="radio" name="attr_id_<%=item['id']%>" value="<%=tempVal%>" /><%=tempVal%></label>
										<%}%>
									<%}else if(item['type'] == 2){%>
										<%for(var tempVal in valueItems){%>
										<%tempVal = valueItems[tempVal]%>
											<label class="attr"><input type="checkbox" name="attr_id_<%=item['id']%>[]" value="<%=tempVal%>"/><%=tempVal%></label>
										<%}%>
									<%}else if(item['type'] == 3){%>
										<select class="auto" name="attr_id_<%=item['id']%>">
										<%for(var tempVal in valueItems){%>
										<%tempVal = valueItems[tempVal]%>
										<option value="<%=tempVal%>"><%=tempVal%></option>
										<%}%>
										</select>
									<%}else if(item['type'] == 4){%>
										<input type="text" name="attr_id_<%=item['id']%>" value="<%=item['value']%>" class="normal" />
									<%}%>
								</td>
							</tr>
							<%}%>
							</script>
							</table>
						</td>
					</tr>
					<tr>
						<th>规格：</th>
						<td>
							<button class="btn" type="button" onclick="selSpec()"><span class="add">添加规格</span></button>
							<label>可以生成不同组合参数的货品，比如：尺码xxl+红色+长袖 衣服</label>
						</td>
					</tr>
					<tr>
						<th>商品推荐类型：</th>
						<td>
							<label class="attr"><input name="_goods_commend[]" type="checkbox" value="1" />最新商品</label>
							<label class="attr"><input name="_goods_commend[]" type="checkbox" value="2" />特价商品</label>
							<label class="attr"><input name="_goods_commend[]" type="checkbox" value="3" />热卖商品</label>
							<label class="attr"><input name="_goods_commend[]" type="checkbox" value="4" />推荐商品</label>
						</td>
					</tr>
					<tr>
						<th>商品品牌：</th>
						<td>
							<select class="auto" name="brand_id">
								<option value="0">请选择</option>
								<?php $query = new IQuery("brand");$items = $query->find(); foreach($items as $key => $item){?>
								<option value="<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['name'])?$item['name']:"";?></option>
								<?php }?>
							</select>
						</td>
					</tr>
                    <tr>
                        <th>产品视频：</th>
                        <td>
                            <input name="video" type="file" />
                            <label>上传产品视频，分辨率3000px以下，大小不得超过<?php echo IUpload::getMaxSize();?></label>
                        </td>
                    </tr>
					<tr>
						<th>产品相册：</th>
						<td>
							<input class="middle" type="text" disabled />
							<div class="upload_btn">
								<span id="uploadButton"></span>
							</div>
							<label>可以上传多张图片，分辨率3000px以下，大小不得超过<?php echo IUpload::getMaxSize();?></label>
						</td>
					</tr>
					<tr>
						<td></td>
						<td id="divFileProgressContainer"></td>
					</tr>
					<tr>
						<td></td>
						<td id="thumbnails"></td>

						<!--图片模板-->
						<script type='text/html' id='picTemplate'>
						<span class='pic'>
							<img onclick="defaultImage(this);" style="margin:5px; opacity:1;width:100px;height:100px" src="<?php echo IUrl::creatUrl("")."<%=picRoot%>";?>" alt="<%=picRoot%>" /><br />
							<a class='orange' href='javascript:void(0)' onclick="$(this).parent().remove();">删除</a>
						</span>
						</script>
					</tr>
				</table>
			</div>

			<div id="table_box_2" cellpadding="0" cellspacing="0" style="display:none">
				<table class="form_table">
					<col width="150px" />
					<col />
					<tr>
						<th>详情采集：</th>
						<td>
							<input type='text' id='collectUrl' class='normal' />
							<button type='button' class='btn' onclick='collectAct();'><span>开始采集</span></button>
							<label>部分详细资料属于异步加载，必须在前台页面可以正常显示</label>
						</td>
					</tr>
					<tr>
						<th>产品描述：</th>
						<td><textarea id="content" name="content" style="width:700px;height:400px;"></textarea></td>
					</tr>
				</table>
			</div>

			<div id="table_box_3" cellpadding="0" cellspacing="0" style="display:none">
				<table class="form_table">
					<col width="150px" />
					<col />
					<tr>
						<th>SEO关键词：</th><td><input class="normal" name="keywords" type="text" value="" /></td>
					</tr>
					<tr>
						<th>SEO描述：</th><td><textarea name="description"></textarea></td>
					</tr>
				</table>
			</div>

			<table class="form_table">
				<col width="150px" />
				<col />
				<tr>
					<td></td>
					<td><button class="submit" type="submit" onclick="return checkForm()"><span>发布商品</span></button></td>
				</tr>
			</table>
		</form>
	</div>
</div>

<script language="javascript">
//创建表单实例
var formObj = new Form('goodsForm');

//默认货号
var defaultProductNo = '<?php echo goods_class::createGoodsNo();?>';

$(function()
{
	initProductTable();

	//存在商品信息
	<?php if(isset($form)){?>
	var goods = <?php echo JSON::encode($form);?>;

	var goodsRowHtml = template.render('goodsRowTemplate',{'templateData':[goods]});
	$('#goodsBaseBody').html(goodsRowHtml);

	formObj.init(goods);

	//模型选择
	$('[name="model_id"]').change();
	<?php }else{?>
	$('[name="_goods_no[0]"]').val(defaultProductNo);
	<?php }?>

	//存在货品信息,进行数据填充
	<?php if(isset($product)){?>
	var spec_array = <?php echo $product[0]['spec_array'];?>;
	var product    = <?php echo JSON::encode($product);?>;

	var goodsHeadHtml = template.render('goodsHeadTemplate',{'templateData':spec_array});
	$('#goodsBaseHead').html(goodsHeadHtml);

	var goodsRowHtml = template.render('goodsRowTemplate',{'templateData':product});
	$('#goodsBaseBody').html(goodsRowHtml);
	<?php }?>

	//商品促销回填
	<?php if(isset($goods_commend)){?>
	formObj.setValue('_goods_commend[]',"<?php echo join(';',$goods_commend);?>");
	<?php }?>

	//商品分类回填
	<?php if(isset($goods_category)){?>
	<?php $categoryId = join(",",$goods_category)?>
	<?php $query = new IQuery("category");$query->where = "id in ($categoryId)";$categoryData = $query->find(); foreach($categoryData as $key => $item){?><?php }?>
	createGoodsCategory(<?php echo JSON::encode($categoryData);?>);
	<?php }?>

	//商品图片的回填
	<?php if(isset($goods_photo)){?>
	var goodsPhoto = <?php echo JSON::encode($goods_photo);?>;
	for(var item in goodsPhoto)
	{
		var picHtml = template.render('picTemplate',{'picRoot':goodsPhoto[item].img});
		$('#thumbnails').append(picHtml);
	}
	<?php }?>

	//商品默认图片
	<?php if(isset($form['img']) && $form['img']){?>
	$('#thumbnails img[alt="<?php echo $form['img'];?>"]').addClass('current');
	<?php }?>

	//编辑器载入
	KindEditorObj = KindEditor.create('#content',{"filterMode":false});
});

//初始化货品表格
function initProductTable()
{
	//默认产生一条商品标题空挡
	var goodsHeadHtml = template.render('goodsHeadTemplate',{'templateData':[]});
	$('#goodsBaseHead').html(goodsHeadHtml);

	//默认产生一条商品空挡
	var goodsRowHtml = template.render('goodsRowTemplate',{'templateData':[[]]});
	$('#goodsBaseBody').html(goodsRowHtml);
}

//删除货品
function delProduct(_self)
{
	$(_self).parent().parent().remove();
	if($('#goodsBaseBody tr').length == 0)
	{
		initProductTable();
	}
}

//提交表单前的检查
function checkForm()
{
	//整理商品图片
	var goodsPhoto = [];
	$('#thumbnails img').each(function(){
		goodsPhoto.push(this.alt);
	});
	if(goodsPhoto.length > 0)
	{
		$('input[name="_imgList"]').val(goodsPhoto.join(','));
		$('input[name="img"]').val($('#thumbnails img[class="current"]').attr('alt'));
	}
	return true;
}

//tab标签切换
function select_tab(curr_tab)
{
	$("form[name='goodsForm'] > div").hide();
	$("#table_box_"+curr_tab).show();
	$("ul[name=menu1] > li").removeClass('selected');
	$('#li_'+curr_tab).addClass('selected');
}

/**
 * 会员价格
 * @param obj 按钮所处对象
 */
function memberPrice(obj)
{
	var sellPrice = $(obj).siblings('input[name^="_sell_price"]')[0].value;
	if($.isNumeric(sellPrice) == false)
	{
		alert('请先设置商品的价格再设置会员价格');
		return;
	}

	var groupPriceValue = $(obj).siblings('input[name^="_groupPrice"]');

	//用户组的价格
	art.dialog.data('groupPrice',groupPriceValue.val());

	//开启新页面
	var tempUrl = '<?php echo IUrl::creatUrl("/goods/member_price/sell_price/@sell_price@");?>';
	tempUrl = tempUrl.replace('@sell_price@',sellPrice);
	art.dialog.open(tempUrl,{
		id:'memberPriceWindow',
	    title: '此商品对于会员组价格',
	    ok:function(iframeWin, topWin)
	    {
	    	var formObject = iframeWin.document.forms['groupPriceForm'];
	    	var groupPriceObject = {};
	    	$(formObject).find('input[name^="groupPrice"]').each(function(){
	    		if(this.value != '')
	    		{
	    			//去掉前缀获取group的ID
		    		var groupId = this.name.replace('groupPrice','');

		    		//拼接json串
		    		groupPriceObject[groupId] = this.value;
	    		}
	    	});

	    	//更新会员价格值
    		var temp = [];
    		for(var gid in groupPriceObject)
    		{
    			temp.push('"'+gid+'":"'+groupPriceObject[gid]+'"');
    		}
    		groupPriceValue.val('{'+temp.join(',')+'}');
    		return true;
		}
	});
}

//添加规格
function selSpec()
{
	//货品是否已经存在
	if($('input:hidden[name^="_spec_array"]').length > 0)
	{
		alert('当前货品已经存在，无法进行规格设置。<p>如果需要重新设置规格请您手动删除当前货品</p>');
		return;
	}

	var tempUrl = '<?php echo IUrl::creatUrl("/goods/search_spec/model_id/@model_id@/goods_id/@goods_id@");?>';
	var model_id = $('[name="model_id"]').val();
	var goods_id = $('[name="id"]').val();

	tempUrl = tempUrl.replace('@model_id@',model_id);
	tempUrl = tempUrl.replace('@goods_id@',goods_id);

	art.dialog.open(tempUrl,{
		title:'设置商品的规格',
		okVal:'保存',
		ok:function(iframeWin, topWin)
		{
			//添加的规格
			var addSpecObject = $(iframeWin.document).find('[id^="vertical_"]');
			if(addSpecObject.length == 0)
			{
				initProductTable();
				return;
			}

			//开始遍历规格
			var specValueData = {};
			var specData      = {};
			addSpecObject.each(function()
			{
				$(this).find('input:hidden[name="specJson"]').each(function()
				{
					var json = $.parseJSON(this.value);
					if(!specValueData[json.id])
					{
						specData[json.id]      = {'id':json.id,'name':json.name,'type':json.type};
						specValueData[json.id] = [];
					}
					specValueData[json.id].push(json['value']);
				});
			});

			//生成货品的笛卡尔积
			var specMaxData = descartes(specValueData,specData);

			//从表单中获取默认商品数据
			var productJson = {};
			$('#goodsBaseBody tr:first').find('input[type="text"]').each(function(){
				productJson[this.name.replace(/^_(\w+)\[\d+\]/g,"$1")] = this.value;
			});

			//生成最终的货品数据
			var productList = [];
			for(var i = 0;i < specMaxData.length;i++)
			{
				var productItem = {};
				for(var index in productJson)
				{
					//自动组建货品号
					if(index == 'goods_no')
					{
						//值为空时设置默认货号
						if(productJson[index] == '')
						{
							productJson[index] = defaultProductNo;
						}

						if(productJson[index].match(/(?:\-\d*)$/) == null)
						{
							//正常货号生成
							productItem['goods_no'] = productJson[index]+'-'+(i+1);
						}
						else
						{
							//货号已经存在则替换
							productItem['goods_no'] = productJson[index].replace(/(?:\-\d*)$/,'-'+(i+1));
						}
					}
					else
					{
						productItem[index] = productJson[index];
					}
				}
				productItem['spec_array'] = specMaxData[i];
				productList.push(productItem);
			}

			//创建规格标题
			var goodsHeadHtml = template.render('goodsHeadTemplate',{'templateData':specData});
			$('#goodsBaseHead').html(goodsHeadHtml);

			//创建货品数据表格
			var goodsRowHtml = template.render('goodsRowTemplate',{'templateData':productList});
			$('#goodsBaseBody').html(goodsRowHtml);
		}
	});
}

//笛卡儿积组合
function descartes(list,specData)
{
	//parent上一级索引;count指针计数
	var point  = {};

	var result = [];
	var pIndex = null;
	var tempCount = 0;
	var temp   = [];

	//根据参数列生成指针对象
	for(var index in list)
	{
		if(typeof list[index] == 'object')
		{
			point[index] = {'parent':pIndex,'count':0}
			pIndex = index;
		}
	}

	//单维度数据结构直接返回
	if(pIndex == null)
	{
		return list;
	}

	//动态生成笛卡尔积
	while(true)
	{
		for(var index in list)
		{
			tempCount = point[index]['count'];
			temp.push({"id":specData[index].id,"type":specData[index].type,"name":specData[index].name,"value":list[index][tempCount]});
		}

		//压入结果数组
		result.push(temp);
		temp = [];

		//检查指针最大值问题
		while(true)
		{
			if(point[index]['count']+1 >= list[index].length)
			{
				point[index]['count'] = 0;
				pIndex = point[index]['parent'];
				if(pIndex == null)
				{
					return result;
				}

				//赋值parent进行再次检查
				index = pIndex;
			}
			else
			{
				point[index]['count']++;
				break;
			}
		}
	}
}

//根据模型动态生成扩展属性
function create_attr(model_id)
{
	$.getJSON("<?php echo IUrl::creatUrl("/block/attribute_init");?>",{'model_id':model_id,'random':Math.random()}, function(json)
	{
		if(json && json.length > 0)
		{
			var templateHtml = template.render('propertiesTemplate',{'templateData':json});
			$('#propert_table').html(templateHtml);
			$('#properties').show();

			//表单回填设置项
			<?php if(isset($goods_attr)){?>
			<?php $attrArray = array();?>
			<?php foreach($goods_attr as $key => $item){?>
			<?php $valArray = explode(',',$item);?>
			<?php $attrArray[] = '"attr_id_'.$key.'[]":"'.join(";",IFilter::act($valArray)).'"'?>
			<?php $attrArray[] = '"attr_id_'.$key.'":"'.join(";",IFilter::act($valArray)).'"'?>
			<?php }?>
			formObj.init({<?php echo join(',',$attrArray);?>});
			<?php }?>
		}
		else
		{
			$('#properties').hide();
		}
	});
}

/**
 * 图片上传回调,handers.js回调
 * @param picJson => {'flag','img','list','show'}
 */
function uploadPicCallback(picJson)
{
	var picHtml = template.render('picTemplate',{'picRoot':picJson.img});
	$('#thumbnails').append(picHtml);

	//默认设置第一个为默认图片
	if($('#thumbnails img[class="current"]').length == 0)
	{
		$('#thumbnails img:first').addClass('current');
	}
}

/**
 * 设置商品默认图片
 */
function defaultImage(_self)
{
	$('#thumbnails img').removeClass('current');
	$(_self).addClass('current');
}

/**
 *分解名称关键词
 */
function wordsPart()
{
	var goodsName = $('input[name="name"]').val();
	if(goodsName)
	{
		$.getJSON("<?php echo IUrl::creatUrl("/goods/goods_tags_words");?>",{"content":goodsName},function(json)
		{
			if(json.result == 'success')
			{
				$('input[name="search_words"]').val(json.data);
			}
		});
	}
}

//开始采集商品详情
function collectAct()
{
	var collectUrl  = $('#collectUrl').val();

	if(!collectUrl)
	{
		alert("请选择采集器并且填写完整的商品详情页URL网址");
		return;
	}

	$.getJSON("<?php echo IUrl::creatUrl("/goods/collect_goods_detail");?>",{"collectUrl":collectUrl},function(json)
	{
		if(json.result == 'success')
		{
			KindEditorObj.html(json.data);
			KindEditorObj.sync();
		}
		else
		{
			alert(json.msg);
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
