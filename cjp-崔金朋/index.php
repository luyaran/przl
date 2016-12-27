<?php
// 应用入口文件
//设置全局编码格式
header("content-type:text/html;charset=utf-8");
//设置项目入口令牌
define("PR","LUYARAN");
//框架开发模式
define("APP_DEBUG",true);
//加载框架初始化文件
require "./pr/core/App.php";
//初始化项目
App::init();




