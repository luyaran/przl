<?php
defined("PR") or die("NO ACCESS TO DO THINGS :)");
class Controller
{
    protected $db;     //数据库对象
    protected $data = null;   //存储数据

    public function __construct()
    {
        require_once LIBRARY_PATH."Function.class.php";
        $this->db = MySql::getInstance();
    }

    //装载模板变量
    public function assign($name,$value)
    {
        $this->data[$name] = $value;
    }

    //装载模板
    public function display($value='')
    {
        if(isset($this->data)){
            extract($this->data);
        }
        $value = empty($value) ? ACTION_NAME.".html" : $value;
        require VIEW_PATH.$value;
    }

    //页面重定向
    public function render($controller,$action)
    {
        header("location: http://localhost/pr/index.php?c=$controller&a=$action");
    }
}