<?php 
/**
 * 八維教育 高端PHP - MySQL数据库操作类
 *
 * @author	Bing Dev Team
 * @copyright	Copyright (c) 2015 - 2016, BeiJingBing, Inc.  (http://www.itbing.cn)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://bingphp.com 	<itbing@sina.cn>
 * @since	Version 1.0.0
 */
defined("PR") or die("NO ACCESS TO DO THINGS :)");
class MySql implements DB
{
	private static $inst = null;		// Mysql对象

	protected $host = '';
	protected $port = '';
	protected $user = '';
	protected $pwd  = '';
	protected $dbName = '';
	protected $conn = NULL;		// 数据的连接资源


	private function __construct()
	{
		// 引入配置文件
        $this->host = $GLOBALS['config']['db_host'];
        $this->port = $GLOBALS['config']['db_port'];
        $this->user = $GLOBALS['config']['db_user'];
        $this->pwd 	= $GLOBALS['config']['db_pwd'];
        $this->dbName = $GLOBALS['config']['db_name'];
		$this->conn = mysql_connect($this->host.':'.$this->port,$this->user,$this->pwd) or die('LINK fail');

		mysql_select_db($this->dbName);
		$sql = "set names utf8";
		mysql_query($sql);
	}

	/**
	 * 获取MySql对象
	 *
	 * @author BING
	 * @return object
	 */
	static public function getInstance()
	{
		if(self::$inst instanceof self)
		{
			return self::$inst;
		}
		else
		{
			return self::$inst = new self;
		}
	}


	private function __clone()
	{

	}


	/**
	 * 添加数据 (单行)
	 *
	 * @param 	string 	$table
	 * @param 	array 	$data
	 * @param 	int/bool 成功返回自增ID否则返回bool
	 */
	public function add($table,$data)
	{

		$sql = "INSERT INTO $table (";
		
		$strKey = implode(array_keys($data), ',');
		$sql .= $strKey .") VALUES (";

		$strVal = "'" .implode(array_values($data), "','") ."'";
		$sql .= $strVal .")";
		$boole = $this->query($sql);
		if($boole)
		{
			return mysql_insert_id();
		}
		else
		{
			return false;
		}

	}


	/**
	 * 删除数据
	 *
	 * @param 	string 	$table
	 * @param 	string 	$where
	 * @param 	int/bool 成功返回受影响行数否则返回bool
	 */
	public function delete($table,$where)
	{
		$sql = "DELETE FROM $table WHERE $where";
		return $this->query($sql);

	}

	/**
	 * 修改数据
	 *
	 * @param 	string 	$table
	 * @param 	string 	$where
	 * @param 	array 	$data
	 * @param 	int/bool 成功返回受影响行数否则返回bool
	 */
	public function save($table,$data,$where)
	{

		//$sql = "UPDATE admin SET user='55',sex=1 WHERE uid='14'" ;
		$sql = "UPDATE $table SET ";
		foreach ($data as $key => $value)
		{
			$sql .= $key ."='". $value. "',";
		}
		$sql = substr($sql,0, -1) ." WHERE ".$where;

		$result = $this->query($sql);
		if($result)
		{
			return mysql_affected_rows();
		}
		else
		{
			return false;
		}
	}

	/**
	 * 查询数据 (单行)
	 *
	 * @param 	string 	$table
	 * @param 	string 	$where
	 * @param 	array
	 */
	public function find($table,$where=1)
	{
		$sql = "SELECT * FROM $table WHERE $where Limit 1";
		$result = $this->query($sql);
		$row = mysql_fetch_assoc($result);
		return $row;
	}

	/**
	 * 查询数据集 (所有行)
	 *
	 * @param 	string 	$table
	 * @param 	string 	$where
	 * @param 	array
	 */
	public function select($table,$where="")
	{
        if(empty($where)){
            $sql = "select * from $table";
        }else{
            $sql = "select * from $table where 1 ".$where;
        }

		$result = $this->query($sql);
		$list = [];
		while ($row = mysql_fetch_assoc($result))
		{
			$list[] = $row;
		}
		return $list;
	}

	/**
	 * 读取字段值
	 *
	 * @param 	string 	$table
	 * @param 	string 	$where
	 * @param 	string
	 */
	public function getField($table,$column,$where=1)
	{

	}

	/**
	 * 执行SQL语句
	 *
	 * @author BING
	 * @param  string $sql SQL语句
	 * @return res/boolen     
	 */
	public function query($sql)
	{
        // 写入日志
        Log::write($sql);

		return mysql_query($sql);
	}
}
?>