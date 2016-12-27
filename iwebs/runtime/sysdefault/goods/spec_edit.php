<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>规格修改</title>
<link rel="stylesheet" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/admin.css";?>" />
<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/jquery/jquery-1.11.3.min.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/jquery/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/artdialog/artDialog.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/iwebs/runtime/_systemjs/artdialog/skins/aero.css" />
<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/form/form.js"></script>
<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/autovalidate/validate.js"></script><link rel="stylesheet" type="text/css" href="/iwebs/runtime/_systemjs/autovalidate/style.css" />
<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/admin.js";?>"></script>
</head>
<body style="width:600px;min-height:400px;">
<div class="pop_win">
	<form action='<?php echo IUrl::creatUrl("/goods/spec_update");?>' method='post' id='specForm' name='specForm'>
		<table class="form_table" style="width:95%">
			<colgroup>
				<col width="120px" />
				<col />
			</colgroup>

			<input type="hidden" name="seller_id" value="<?php echo isset($seller_id)?$seller_id:"";?>" />
			<input type="hidden" name="id" value="<?php echo isset($id)?$id:"";?>" />
			<tr>
				<td style='text-align:right'>规格名称：</td>
				<td><input class="normal" name="name" value="<?php echo isset($name)?$name:"";?>" type="text" pattern="required" alt="名字不能为空" /><label>* 规格名称（必填）</label></td>
			</tr>
			<tr>
				<td style='text-align:right'>显示类型：</td>
				<td><label class="attr"><input name="type" type="radio" value="1" <?php if($type==1 || $type==null){?>checked=checked<?php }?> /> 文字</label><label class="attr"><input name="type" type="radio" value="2" <?php if($type==2){?>checked=checked<?php }?> /> 图片</label></td>
			</tr>
			<tr>
				<td style='text-align:right'>显示备注：</td>
				<td><input class="normal" type="text" name="note" value="<?php echo isset($note)?$note:"";?>" /></td>
			</tr>
			<tr>
				<td></td>
				<td><button type="button" class="btn" id="specAddButton"><span class="add">添 加</span></button></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<table class='border_table' cellpadding="0" cellspacing="0" width='100%'>
						<thead>
							<tr>
								<th><?php if($type==2){?>规格图片<?php }else{?>规格值<?php }?></th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody id='spec_box'>
							<?php $specValue=$value?JSON::decode($value):array()?>
							<?php foreach($specValue as $key => $item){?>
							<tr class='td_c'>
								<td>
									<?php if($type==1){?>
									<input type="text" class="normal" name="value[]" value="<?php echo isset($item)?$item:"";?>" pattern="required" />
									<?php }?>

									<?php if($type==2){?>
									<div class="imgbox"><img class="img_border" src='<?php echo IUrl::creatUrl("")."".$item."";?>' width='50px' height='50px' /></div>
									<input type="hidden" name="value[]" value="<?php echo isset($item)?$item:"";?>" /><button type="button" class="btn"><span>选择图片</span></button>
									<?php }?>
								</td>
								<td>
									<img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_asc.gif";?>" alt="向上" />
									<img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_desc.gif";?>" alt="向下" />
									<img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_del.gif";?>" alt="删除" />
								</td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</td>
			</tr>
		</table>
	</form>
</div>
<script type='text/javascript'>
	//规格图片上传回调函数
	function updatePic(indexValue,srcValue)
	{
		$('#spec_box tr:eq('+indexValue+') td:eq(0) .imgbox').html('<img src="<?php echo IUrl::creatUrl("")."";?>'+srcValue+'" class="img_border" width="50px" height="50px"  />');
		$('#spec_box tr:eq('+indexValue+') td:eq(0) :hidden').val(srcValue);
		art.dialog({id:'uploadIframe'}).close();
	}

	//规格图片html
	function getPicHtml(dataValue)
	{
		var srcHtml = '';
		if(dataValue)
			var srcHtml = '<img src="<?php echo IUrl::creatUrl("")."";?>'+dataValue+'" class="img_border" width="50px" height="50px" />';

		return '<div class="imgbox">'+srcHtml+'</div><input type="hidden" name="value[]" value="'+(dataValue?dataValue:"")+'" /><button type="button" class="btn"><span>选择图片</span></button>'
	}

	//规格值html
	function getValHtml(dataValue)
	{
		if(dataValue == undefined)
			dataValue = '';
		return '<input class="normal" type="text" name="value[]" value="'+(dataValue?dataValue:"")+'" pattern="required" alt="填写规格值" />';
	}

	//上传按钮html
	function getUploadButtonHtml(obj)
	{
		var specIndex = obj.parent().parent().index();
		var tempUrl = '<?php echo IUrl::creatUrl("/block/pic/specIndex/@specIndex@");?>';
		tempUrl     = tempUrl.replace('@specIndex@',specIndex);
		art.dialog.open(tempUrl,
		{
			'id':"uploadIframe",
			'title':'选择图片上传的方式',
			'ok':function(iframeWin, topWin)
			{
		    	iframeWin.document.forms[0].submit();
		    	return false;
			}
		});
	}

	//根据显示类型返回格式
	function getTr(indexValue)
	{
		var typeValue = $(':radio:checked').val();

		//规格图片格式
		var specInputHtml = getValHtml();
		if(typeValue==2)
			var specInputHtml = getPicHtml();

		//数据
		var specRow = '<tr class="td_c"><td>'+specInputHtml+'</td>'
		+'<td><img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_asc.gif";?>" alt="向上" />'
		+'<img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_desc.gif";?>" alt="向下" />'
		+'<img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_del.gif";?>" alt="删除" />'
		+'</td></tr>';

		return specRow;
	}

	//预定义
	<?php if($id!=null){?>
	$('#spec_box tr').each(
		function(i)
		{
			initButton(i);
		}
	);
	<?php }?>

	//展示规格类型(点击绑定)
	$(':radio').click(
		function()
		{
			//获取规格类型
			var typeValue = $(this).val();
			if(typeValue==1)
				$('.border_table thead th:eq(0)').text('规格值');
			else
				$('.border_table thead th:eq(0)').text('规格图片');

			$('#spec_box tr').each(
				function(i)
				{
					//获取文字数据并进行缓存
					var specVal = $('#spec_box tr:eq('+i+') input:text').val();
					if(specVal != $('#spec_box tr:eq('+i+')').data('specVal'))
					{
						$('#spec_box tr:eq('+i+')').data('specVal',specVal);
					}

					//获取图片数据并进行缓存
					var specPic = $('#spec_box tr:eq('+i+') input:hidden').val();
					if(specPic != $('#spec_box tr:eq('+i+')').data('specPic'))
					{
						$('#spec_box tr:eq('+i+')').data('specPic',specPic);
					}

					//文字方式切换
					if(typeValue==1)
					{
						var specVal = $('#spec_box tr:eq('+i+')').data('specVal');
						$(this).children('td:first').html(getValHtml(specVal));
					}

					//图片方式切换
					else
					{
						var specPic = $('#spec_box tr:eq('+i+')').data('specPic');
						$(this).children('td:first').html(getPicHtml(specPic));
					}
					//重新绑定按钮
					initButton(i);
				}
			);
		}
	)

	//添加规格按钮(点击绑定)
	$('#specAddButton').click(
		function()
		{
			var specSize = $('#spec_box tr').size();
			var specRow = getTr(specSize);
			$('#spec_box').append(specRow);
			initButton(specSize);
		}
	)

	//按钮(点击绑定)
	function initButton(indexValue)
	{
		//上传图片按钮
		$('#spec_box tr:eq('+indexValue+') td button').click(
			function()
			{
				getUploadButtonHtml($(this));
			}
		);

		//功能操作按钮
		$('#spec_box tr:eq('+indexValue+') .operator').each(
			function(i)
			{
				switch(i)
				{
					//向上排序
					case 0:
					$(this).click(
						function()
						{
							var insertIndex = $(this).parent().parent().prev().index();
							if(insertIndex >= 0)
							{
								$('#spec_box tr:eq('+insertIndex+')').before($(this).parent().parent());
							}
						}
					)
					break;

					//向下排序
					case 1:
					$(this).click(
						function()
						{
							var insertIndex = $(this).parent().parent().next().index();
							$('#spec_box tr:eq('+insertIndex+')').after($(this).parent().parent());
						}
					)
					break;

					//删除排序
					case 2:
					$(this).click(
						function()
						{
							var obj = $(this);
							art.dialog.confirm('确定要删除么？',function(){obj.parent().parent().remove()});
						}
					)
					break;
				}
			}
		)
	}
</script>