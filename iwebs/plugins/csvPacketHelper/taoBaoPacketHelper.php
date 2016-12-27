<?php
/**
 * @brief the TaoBao data packet dispose
 * @data 2013-8-30 15:32:44
 * @author nswe
 */
class taoBaoPacketHelper extends packetHelper
{
	//csv separator
	protected $separator = "	";

	/**
	 * override abstract function
	 * @return array
	 */
	public function getDataTitle()
	{
		return array('宝贝名称','宝贝价格','宝贝数量','宝贝描述','新图片','宝贝属性','销售属性组合','销售属性别名','物流重量','宝贝类目');
	}
	/**
	 * override abstruact function
	 * @return array
	 */
	public function getTitleCallback()
	{
		return array(
			'新图片' => 'newImageCallback',
		);
	}
	/**
	 * column callback function
	 * @param string $content data content
	 * @return string
	 */
	protected function newImageCallback($content)
	{
		$record    = array();
		$imageName = '';
		$source    = '';
		$target    = '';
		$content   = explode(';',trim($content,'"'));

		if(!$content)
		{
			return '';
		}

		$return  = array();
		foreach($content as $key => $val)
		{
			if($val)
			{
				$imageName = current(explode(':',$val));

				if(in_array($imageName,$record))
				{
					continue;
				}
				$record[] = $imageName;

				if(stripos($imageName,'http://') === 0)
				{
					$imageMd5 = md5($imageName);
					file_put_contents($this->sourceImagePath .'/'. $imageMd5.'.tbi',file_get_contents($imageName));
					$imageName = $imageMd5;
				}
				$source = $this->sourceImagePath .'/'. $imageName.'.tbi';
				$target = $this->targetImagePath .'/'. $imageName.'.jpg';
				$return[] = array($source => $target);
			}
		}
		return $return;
	}
}
/**
 * @brief taobao title to iwebshop cols mapping
 * @date 2013-9-7 12:22:11
 * @author nswe
 */
class taoBaoTitleToColsMapping
{
	/**
	 * taobao title to iwebshop cols mapping
	 */
	public static $mapping = array(
		'name'       => '宝贝名称',
		'sell_price' => '宝贝价格',
		'store_nums' => '宝贝数量',
		'content'    => '宝贝描述',
		'img'        => '新图片'
	);
}