<?php 
/**
 * 八维教育 高端PHP
 * @Author: BING
 * @Email: itbing@sina.cn
 */
defined("PR") or die("NO ACCESS TO DO THINGS :)");
interface DB
{

	/**
	 * 添加数据 (单行)
	 *
	 * @param 	string 	$table
	 * @param 	array 	$data
	 * @param 	int/bool 成功返回自增ID否则返回bool
	 */
	public function add($table,$data);


	/**
	 * 删除数据
	 *
	 * @param 	string 	$table
	 * @param 	string 	$where
	 * @param 	int/bool 成功返回受影响行数否则返回bool
	 */
	public function delete($table,$where);

	/**
	 * 修改数据
	 *
	 * @param 	string 	$table
	 * @param 	string 	$where
	 * @param 	array 	$data
	 * @param 	int/bool 成功返回受影响行数否则返回bool
	 */
	public function save($table,$data,$where);

	/**
	 * 查询数据 (单行)
	 *
	 * @param 	string 	$table
	 * @param 	string 	$where
	 * @param 	array
	 */
	public function find($table,$where=1);

	/**
	 * 查询数据集 (所有行)
	 *
	 * @param 	string 	$table
	 * @param 	string 	$where
	 * @param 	array
	 */
	public function select($table,$where=1);

	/**
	 * 读取字段值
	 *
	 * @param 	string 	$table
	 * @param 	string 	$where
	 * @param 	string
	 */
	public function getField($table,$column,$where=1);
	
}

