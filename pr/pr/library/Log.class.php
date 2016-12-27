<?php 
/**
 * 八維教育 高端PHP - 日志类
 *
 * @author	Bing Dev Team
 * @copyright	Copyright (c) 2015 - 2016, BeiJingBing, Inc.  (http://www.itbing.cn)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://bingphp.com 	<itbing@sina.cn>
 * @since	Version 1.0.0
 */

/**
 * 1.已当前日期为文件名 如：2016-9-3.log
 */
defined("PR") or die("NO ACCESS TO DO THINGS :)");
class Log
{
	protected static $path = './app/runtime/log/';

	/**
	 * 写日志
	 *
	 * @author BING
	 * @return void
	 */
	public static function write($content)
	{
		$logName = date('Y-m-d') . '.log';
		$content = '[' . date('Ymd H:i:s') . ']' . $content . "\r\n";

		$saveLog = self::$path . $logName;
		// file_put_contents($saveLog, $content, FILE_APPEND);
		
		$handle = fopen($saveLog, 'a+');
		fwrite($handle, $content);
		fclose($handle);
	}
}


?>