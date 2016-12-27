<?php 
/**
 * 八維教育 高端PHP - 分页类
 *
 * @author	Bing Dev Team
 * @copyright	Copyright (c) 2015 - 2016, BeiJingBing, Inc.  (http://www.itbing.cn)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://bingphp.com 	<itbing@sina.cn>
 * @since	Version 1.0.0
 */
defined("PR") or die("NO ACCESS TO DO THINGS :)");
header("Content-type:text/html;charset=utf-8;");

class Page
{
	private $count;			// 总条数
	private $size = 10;		// 每页显示条数
	private $num;			// 总页数
	private $curr;			// 当前页
	private $offset = 3;	// 偏移量（步长）
	private $config = array(
		'last'	=> '&lt;&lt;',
		'next'	=> '&gt;&gt;',
		);
    private $url;


	public function __construct($count,$size=10)
	{
		$this->count = $count;
		$this->size = $size;
		$this->curr = isset($_GET['p']) ? $_GET['p'] : 1 ;
        $this->url = $_GET;
	}

	/**
	 * 获取分页码
	 *
	 * @author BING
	 * @return string
	 */
	public function show()
	{
		$this->num = $num = ceil($this->count / $this->size);

		// 计算左侧页码
		$leftPage =  max($this->curr - $this->offset,1);
		// 计算右侧页码
		$rightPage = min($this->curr + $this->offset,$num);
        $url = $this->httpBuild();
		// 上一页
		$lastPage = '';
		if($this->curr > 1)
		{
			$lastNum = $this->curr - 1;
			$lastPage = '<a href="?'.$url.'&p='. $lastNum .'">'.$this->config['last'].'</a> ';
		}
		// 下一页
		$nextPage = '';
		if($this->curr < $num)
		{
			$nextNum = $this->curr + 1;
			$nextPage = '<a href="?'.$url.'&p='. $nextNum .'">'.$this->config['next'].'</a> ';
		}		

		// 分页链接
		$pageLink = '';
		for($i=$leftPage; $i <= $rightPage; $i++)
		{
			$pageLink .= ' <a href="?'.$url.'&p='.$i.'">'.$i.'</a> ';
		}

		$head = '第'. $this->curr. '页/共'. $this->num .'页';
		return $head.$lastPage.$pageLink.$nextPage;
	}

	// 设置分页样式
	public function setConfig($config)
	{
		foreach ($config as $key => $value)
		{
			$this->config[$key] = $value;
		}
	}

    //处理url地址
    protected function httpBuild()
    {
        if(isset($this->url['p'])){
            unset($this->url['p']);
        }
        return http_build_query($this->url);
    }
}

// 1 2 3 4 5 6 7 8 [9] 10

//$config['last'] = '上一页';
//$config['next'] = '下一页';
//
//$p = new Page(100,10);
//$p->setConfig($config);
//
//
//$page = $p->show();
//
//echo $page;
/**
<a href="?p=1">1</a>
<a href="?p=2">2</a>
<a href="?p=3">3</a>

 */

?>