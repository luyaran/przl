<?php 
	$myCartObj  = new Cart();
	$myCartInfo = $myCartObj->getMyCart();
	$siteConfig = new Config("site_config");
	$callback   = IReq::get('callback') ? urlencode(IFilter::act(IReq::get('callback'),'url')) : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $siteConfig->name;?></title>
	<link type="image/x-icon" href="favicon.ico" rel="icon">
	<link rel="stylesheet" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/index.css";?>" />
	<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/jquery/jquery-1.11.3.min.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/jquery/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/cookie/jquery.cookie.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/form/form.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/autovalidate/validate.js"></script><link rel="stylesheet" type="text/css" href="/iwebs/runtime/_systemjs/autovalidate/style.css" />
	<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/artdialog/artDialog.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/iwebs/runtime/_systemjs/artdialog/skins/aero.css" />
	<script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebs/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
	<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/common.js";?>"></script>
	<script type='text/javascript' src='<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/site.js";?>'></script>
	<?php $sonline = new Sonline();$sonline->show($siteConfig->phone,$siteConfig->service_online);?>
</head>
<body class="index">
<div class="container">
	<div class="header">
		<h1 class="logo"><a title="<?php echo $siteConfig->name;?>" style="background:url(<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/front/logo.gif";?>);" href="<?php echo IUrl::creatUrl("");?>"><?php echo $siteConfig->name;?></a></h1>
		<ul class="shortcut">
			<li class="first"><a href="<?php echo IUrl::creatUrl("/ucenter/index");?>">我的账户</a></li>
			<li><a href="<?php echo IUrl::creatUrl("/ucenter/order");?>">我的订单</a></li>
			<li><a href="<?php echo IUrl::creatUrl("/simple/seller");?>">申请开店</a></li>
			<li><a href="<?php echo IUrl::creatUrl("/seller/index");?>">商家管理</a></li>
			<li class='last'><a href="<?php echo IUrl::creatUrl("/site/help_list");?>">使用帮助</a></li>
		</ul>
		<p class="loginfo">
			<?php if($this->user){?>
			<?php echo $this->user['username'];?>您好，欢迎您来到<?php echo $siteConfig->name;?>购物！[<a href="<?php echo IUrl::creatUrl("/simple/logout");?>" class="reg">安全退出</a>]
			<?php }else{?>
			[<a href="<?php echo IUrl::creatUrl("/simple/login?callback=".$callback."");?>">登录</a><a class="reg" href="<?php echo IUrl::creatUrl("/simple/reg?callback=".$callback."");?>">免费注册</a>]
			<?php }?>
		</p>
	</div>
	<div class="navbar">
		<ul>
			<li><a href="<?php echo IUrl::creatUrl("/site/index");?>">首页</a></li>
			<?php foreach(Api::run('getGuideList') as $key => $item){?>
			<li><a href="<?php echo IUrl::creatUrl("".$item['link']."");?>"><?php echo isset($item['name'])?$item['name']:"";?><span> </span></a></li>
			<?php }?>
		</ul>

		<div class="mycart">
			<dl>
				<dt><a href="<?php echo IUrl::creatUrl("/simple/cart");?>">购物车<b name="mycart_count"><?php echo isset($myCartInfo['count'])?$myCartInfo['count']:"";?></b>件</a></dt>
				<dd><a href="<?php echo IUrl::creatUrl("/simple/cart");?>">去结算</a></dd>
			</dl>

			<!--购物车浮动div 开始-->
			<div class="shopping" id='div_mycart' style='display:none;'>
			</div>
			<!--购物车浮动div 结束-->

			<!--购物车模板 开始-->
			<script type='text/html' id='cartTemplete'>
			<dl class="cartlist">
				<%for(var item in goodsData){%>
				<%var data = goodsData[item]%>
				<dd id="site_cart_dd_<%=item%>">
					<div class="pic f_l"><img width="55" height="55" src="<?php echo IUrl::creatUrl("")."<%=data['img']%>";?>"></div>
					<h3 class="title f_l"><a href="<?php echo IUrl::creatUrl("/site/products/id/<%=data['goods_id']%>");?>"><%=data['name']%></a></h3>
					<div class="price f_r t_r">
						<b class="block">￥<%=data['sell_price']%> x <%=data['count']%></b>
						<input class="del" type="button" value="删除" onclick="removeCart('<?php echo IUrl::creatUrl("/simple/removeCart");?>','<%=data['id']%>','<%=data['type']%>');$('#site_cart_dd_<%=item%>').hide('slow');" />
					</div>
				</dd>
				<%}%>

				<dd class="static"><span>共<b name="mycart_count"><%=goodsCount%></b>件商品</span>金额总计：<b name="mycart_sum">￥<%=goodsSum%></b></dd>

				<%if(goodsData){%>
				<dd class="static">
					<?php if(ISafe::get('user_id')){?>
					<a class="f_l" href="javascript:void(0)" onclick="deposit_ajax('<?php echo IUrl::creatUrl("/simple/deposit_cart_set");?>');">寄存购物车>></a>
					<?php }?>
					<label class="btn_orange"><input type="button" value="去购物车结算" onclick="window.location.href='<?php echo IUrl::creatUrl("/simple/cart");?>';" /></label>
				</dd>
				<%}%>
			</dl>
			</script>
			<!--购物车模板 结束-->
		</div>
	</div>

	<div class="searchbar">
		<div class="allsort">
			<a href="javascript:void(0);">全部商品分类</a>

			<!--总的商品分类-开始-->
			<ul class="sortlist" id='div_allsort' style='display:none'>
				<?php foreach(Api::run('getCategoryListTop') as $key => $first){?>
				<li>
					<h2><a href="<?php echo IUrl::creatUrl("/site/pro_list/cat/".$first['id']."");?>"><?php echo isset($first['name'])?$first['name']:"";?></a></h2>

					<!--商品分类 浮动div 开始-->
					<div class="sublist" style='display:none'>
						<div class="items">
							<strong>选择分类</strong>
							<?php foreach(Api::run('getCategoryByParentid',array('#parent_id#',$first['id'])) as $key => $second){?>
							<dl class="category selected">
								<dt>
									<a href="<?php echo IUrl::creatUrl("/site/pro_list/cat/".$second['id']."");?>"><?php echo isset($second['name'])?$second['name']:"";?></a>
								</dt>

								<dd>
									<?php foreach(Api::run('getCategoryByParentid',array('#parent_id#',$second['id'])) as $key => $third){?>
									<a href="<?php echo IUrl::creatUrl("/site/pro_list/cat/".$third['id']."");?>"><?php echo isset($third['name'])?$third['name']:"";?></a>|
									<?php }?>
								</dd>
							</dl>
							<?php }?>
						</div>
					</div>
					<!--商品分类 浮动div 结束-->
				</li>
				<?php }?>
			</ul>
			<!--总的商品分类-结束-->
		</div>

		<div class="searchbox">
			<form method='get' action='<?php echo IUrl::creatUrl("/");?>'>
				<input type='hidden' name='controller' value='site' />
				<input type='hidden' name='action' value='search_list' />
				<input class="text" type="text" id="kobe" name='word' autocomplete="off" value="输入关键字..." />
				<input class="btn" type="submit" value="商品搜索" onclick="checkInput('word','输入关键字...');" />
			</form>

			<!--自动完成div 开始-->
			<ul class="auto_list" style='display:none'></ul>
			<!--自动完成div 开始-->

		</div>
		<div class="hotwords">热门搜索：
			<?php foreach(Api::run('getKeywordList') as $key => $item){?>
			<?php $tmpWord = urlencode($item['word']);?>
			<a href="<?php echo IUrl::creatUrl("/site/search_list/word/".$tmpWord."");?>"><?php echo isset($item['word'])?$item['word']:"";?></a>
			<?php }?>
		</div>
	</div>
	<?php echo Ad::show(1);?>

	<?php $brandId = IFilter::act(IReq::get('id'),'int')?>
<?php $brandRow=Api::run('getBrandInfo',$brandId)?>
<?php if(!$brandRow){?>
<?php IError::show(403,'品牌信息不存在')?>
<?php }?>

<div class="position"> <span>您当前的位置：</span> <a href="<?php echo IUrl::creatUrl("");?>"> 首页</a> » 商品品牌 </div>
<div class="wrapper clearfix container_2">
	<div class="sidebar f_l">
		<div class="box m_10">
			<div class="title">销售排行榜</div>
			<div class="content">
			  <ul class="ranklist" id="ranklist">


			  	<?php foreach(Api::run('getGoodsListBrandSum',array('#brandid#',$brandId),10) as $key => $item){?>
			  	<li><span><?php echo intval($key+1);?></span><a href="<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>"><img src="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/58/h/58");?>" width="58px" height="58px" /></a><a href="<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>"><?php echo isset($item['name'])?$item['name']:"";?></a><b>￥<?php echo isset($item['sell_price'])?$item['sell_price']:"";?></b></li>
			  	<?php }?>
			  </ul>
			</div>
		</div>

		<div class="box m_10">
			<div class="title">热卖商品</div>
			<div class="cont">
				<ul class="ranklist">
					<?php foreach(Api::run('getCommendHotBrand',array('#brandid#',$brandId),10) as $key => $item){?>
					<li class='current'><a href="<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>"><img src="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/58/h/58");?>" width="58" height="58" /></a><a href="<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>"><?php echo isset($item['name'])?$item['name']:"";?></a><b>￥<?php echo isset($item['sell_price'])?$item['sell_price']:"";?></b></li>
					<?php }?>
				</ul>
			</div>
		</div>

		<div class="box m_10">
			<div class="title">更多品牌</div>
			<div class="cont">
			  <ul class="textlist_2 clearfix">
			  	<?php foreach(Api::run('getBrandList',10) as $key => $item){?>
			  	<li><a href="<?php echo IUrl::creatUrl("/site/brand_zone/id/".$item['id']."");?>"><?php echo isset($item['name'])?$item['name']:"";?></a></li>
			  	<?php }?>
			  </ul>
			</div>
		</div>

	</div>

	<div class="main f_r">
		<div class="box m_10">
			<div class="title">品牌专区</div>
			<div class="cont">
				<div class="c_box">
					<dl class="clearfix">
						<dt><img src="<?php echo IUrl::creatUrl("")."";?><?php echo isset($brandRow['logo'])?$brandRow['logo']:"";?>" width="220" height="100" /></dt>
						<dd><strong><?php echo isset($brandRow['name'])?$brandRow['name']:"";?></strong></dd>
						<dd>官方站点：<?php echo isset($brandRow['url'])?$brandRow['url']:"";?></dd>
					</dl>
					<p><?php echo isset($brandRow['description'])?$brandRow['description']:"";?></p>
				</div>
			</div>
		</div>

		<div class="display_title">
			<span class="l"></span>
			<span class="r"></span>
			<span class="f_l">排序：</span>
			<ul>
				<?php foreach(search_goods::getOrderType() as $key => $item){?>
				<?php $next = search_goods::getOrderValue($key)?>
				<li class="<?php echo search_goods::isOrderCurrent($key) ? 'current':'';?>">
					<span class="l"></span><span class="r"></span>
					<a href="<?php echo search_goods::searchUrl('order',$next);?>"><?php echo isset($item)?$item:"";?><span class="<?php echo search_goods::isOrderDesc() ? 'desc':'';?>">&nbsp;</span></a>
				</li>
				<?php }?>
			</ul>
			<span class="f_l">显示方式：</span>
			<a class="show_b" href="<?php echo search_goods::searchUrl('show_type','win');?>" title='橱窗展示' alt='橱窗展示'><span class='<?php echo search_goods::getListShow(IReq::get('show_type')) == 'win' ? 'current':'';?>'></span></a>
			<a class="show_s" href="<?php echo search_goods::searchUrl('show_type','list');?>" title='列表展示' alt='列表展示'><span class='<?php echo search_goods::getListShow(IReq::get('show_type')) == 'list' ? 'current':'';?>'></span></a>
		</div>
		<?php $goodsObj = search_goods::find(array('brand_id' => $brandId));$resultData = $goodsObj->find();?>
		<?php if($resultData){?>
		<?php $listSize = search_goods::getListSize(IFilter::act(IReq::get('show_type')))?>
		<ul class="display_list clearfix m_10">
			<?php foreach($resultData as $key => $item){?>
			<li class="clearfix <?php echo search_goods::getListShow(IFilter::act(IReq::get('show_type')));?>">
				<div class="pic">
					<img src="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/".$listSize['width']."/h/".$listSize['height']."");?>" width="<?php echo isset($listSize['width'])?$listSize['width']:"";?>" height="<?php echo isset($listSize['height'])?$listSize['height']:"";?>" alt="<?php echo isset($item['name'])?$item['name']:"";?>" title="<?php echo isset($item['name'])?$item['name']:"";?>" />
				</div>
				<h3 class="title"><a title="<?php echo isset($item['name'])?$item['name']:"";?>" class="p_name" href="<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>"><?php echo isset($item['name'])?$item['name']:"";?></a><span>总销量：<?php echo isset($item['sale'])?$item['sale']:"";?><a class="blue" href="<?php echo IUrl::creatUrl("/site/comments_list/id/".$item['id']."");?>">( <?php echo isset($item['comments'])?$item['comments']:"";?>人评论 )</a></span><span class='grade'><i style='width:<?php echo Common::gradeWidth($item['grade'],$item['comments']);?>px'></i></span></h3>
				<div class="handle">
					<label class="btn_gray_m"><img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/front/ucenter/shopping.gif";?>" width="15" height="15" /><input type="button" value="加入购物车" onclick="joinCart_list(<?php echo isset($item['id'])?$item['id']:"";?>);"></label>
					<label class="btn_gray_m"><img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/front/ucenter/favorites.gif";?>" width="15" height="14" /><input type="button" value="收藏" onclick="favorite_add_ajax('<?php echo IUrl::creatUrl("/simple/favorite_add");?>','<?php echo isset($item['id'])?$item['id']:"";?>',this);"></label>
				</div>
				<div class="price">￥<?php echo isset($item['sell_price'])?$item['sell_price']:"";?><s>￥<?php echo isset($item['market_price'])?$item['market_price']:"";?></s></div>
			</li>
			<?php }?>
		</ul>
		<?php echo $goodsObj->getPageBar();?>

		<?php }else{?>
		<p class="display_list mt_10" style='margin-top:50px;margin-bottom:50px'>
			<strong class="gray f14">对不起，没有找到相关商品</strong>
		</p>
		<?php }?>
	</div>
</div>


	<div class="help m_10">
		<div class="cont clearfix">
			<?php foreach(Api::run('getHelpCategoryFoot') as $key => $helpCat){?>
			<dl>
     			<dt><a href="<?php echo IUrl::creatUrl("/site/help_list/id/".$helpCat['id']."");?>"><?php echo isset($helpCat['name'])?$helpCat['name']:"";?></a></dt>
				<?php foreach(Api::run('getHelpListByCatidAll',array('#cat_id#',$helpCat['id'])) as $key => $item){?>
					<dd><a href="<?php echo IUrl::creatUrl("/site/help/id/".$item['id']."");?>"><?php echo isset($item['name'])?$item['name']:"";?></a></dd>
				<?php }?>
      		</dl>
      		<?php }?>
		</div>
	</div>
	<?php echo IFilter::stripSlash($siteConfig->site_footer_code);?>
</div>

<script type='text/javascript'>
$(function()
{

	<?php $word = IReq::get('word') ? IFilter::act(IReq::get('word'),'text') : '输入关键字...'?>
	$('input:text[name="word"]').val("<?php echo isset($word)?$word:"";?>");

	$('input:text[name="word"]').bind({
		keyup:function(){autoComplete('<?php echo IUrl::creatUrl("/site/autoComplete");?>','<?php echo IUrl::creatUrl("/site/search_list/word/@word@");?>','<?php echo isset($siteConfig->auto_finish)?$siteConfig->auto_finish:"";?>');}
	});


	var mycartLateCall = new lateCall(200,function(){showCart('<?php echo IUrl::creatUrl("/simple/showCart");?>')});

	//购物车div层
	$('.mycart').hover(
		function(){
			mycartLateCall.start();
		},
		function(){
			mycartLateCall.stop();
			$('#div_mycart').hide('slow');
		}
	);
});

//获取地址的ip地址
getAddress();

//加载根据地域获取城市
function getAddress()
{
    //根据IP查询所在地
    var ipAddress = $.cookie('ipAddress');
    if(!ipAddress)
    {
        $.getScript('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js',function(){
            ipAddress = remote_ip_info['province'];
            $.cookie('ipAddress',ipAddress);
        });
    }
}

//[ajax]加入购物车
function joinCart_ajax(id,type)
{
	$.getJSON("<?php echo IUrl::creatUrl("/simple/joinCart");?>",{"goods_id":id,"type":type,"random":Math.random()},function(content){
		if(content.isError == false)
		{
			var count = parseInt($('[name="mycart_count"]').html()) + 1;
			$('[name="mycart_count"]').html(count);
			alert(content.message);
		}
		else
		{
			alert(content.message);
		}
	});
}

//列表页加入购物车统一接口
function joinCart_list(id)
{
	$.getJSON('<?php echo IUrl::creatUrl("/simple/getProducts");?>',{"id":id},function(content){
		if(!content)
		{
			joinCart_ajax(id,'goods');
		}
		else
		{
			var url = "<?php echo IUrl::creatUrl("/block/goods_list/goods_id/@goods_id@/type/radio/is_products/1");?>";
			url = url.replace('@goods_id@',id);
			artDialog.open(url,{
				id:'selectProduct',
				title:'选择货品到购物车',
				okVal:'加入购物车',
				ok:function(iframeWin, topWin)
				{
					var goodsList = $(iframeWin.document).find('input[name="id[]"]:checked');

					//添加选中的商品
					if(goodsList.length == 0)
					{
						alert('请选择要加入购物车的商品');
						return false;
					}
					var temp = $.parseJSON(goodsList.attr('data'));

					//执行处理回调
					joinCart_ajax(temp.product_id,'product');
					return true;
				}
			})
		}
	});
}
</script>
</body>
</html>
