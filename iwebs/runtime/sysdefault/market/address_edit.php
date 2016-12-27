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

<div class="headbar">
    <div class="position"><span>营销</span><span>></span><span>邮件营销管理</span><span>></span><span><?php if(isset($this->ticketRow['id'])){?>编辑<?php }else{?>添加<?php }?>邮件营销</span></div>
</div>

<div class="content_box">
    <div class="content form_content">
        <form action="<?php echo IUrl::creatUrl("/market/address_upd");?>" name="goodsForm" method="post">


            <div id="table_box_2" cellpadding="0" cellspacing="0" >
                <table class="form_table">
                    <col width="150px" />
                    <col />
                    <tr>
                        <th>邮件营销名称：</th>
                        <td>
                            <input type='text' name="name" id='collectUrl' class='normal' />

                        </td>
                    </tr>
                    <tr>
                        <th>邮件营销内容：</th>
                        <td><textarea id="content" name="content" style="width:700px;height:400px;"></textarea></td>
                    </tr>
                    <tr><td></td><td><input type="submit" value="确定"/></td></tr>
                </table>
            </div>


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
