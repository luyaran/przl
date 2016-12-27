<?php
defined("PR") or die("NO ACCESS TO DO THINGS :)");
class UserModel extends Model
{
    protected $tableName = "makes";     //表名
    public function adds($data)
    {
        return $this->db->add($this->tableName,$data);
    }
    public function select()
    {
        return $this->db->select($this->tableName);
    }
}