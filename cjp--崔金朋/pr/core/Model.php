<?php
defined("PR") or die("NO ACCESS TO DO THINGS :)");
class Model
{
    protected $db;             //数据库对象
    protected $tableName;     //表名

    public function __construct()
    {
        $this->db = MySql::getInstance();
    }
}