<?php
defined("PR") or die("NO ACCESS TO DO THINGS :)");
class GoodsModel extends Model
{
    protected $tableName = "login";     //表名

    public function select()
    {
        return $this->db->select($this->tableName);
    }
    public function makePage($offset,$size)
    {
        $where = "limit $offset,$size";
        return $this->db->select($this->tableName,$where);
    }
}