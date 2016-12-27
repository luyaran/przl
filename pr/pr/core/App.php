<?php
defined("PR") or die("NO ACCESS TO DO THINGS :)");
class App
{
    //初始化框架
    static function init()
    {
        //1、定义项目的绝对路径
        self::setPath();
        //2、设置错误级别
        self::setError();
        //3、初始化配置文件
        self::setConfig();
        //4、对数据做安全验证
        self::safeFilter();
        //5、设置路由
        self::setRouter();
       //自动加载
        self::autoload();
        //6、地址转发
        self::createObject();
    }

    //1、定义项目的绝对路径
    static function setPath()
    {
        define("ROOT_PATH",dirname(dirname(__DIR__))."\\");
        define("SYSTEM_PATH",ROOT_PATH."pr\\");
        define("APP_PATH",ROOT_PATH."app\\");
        define("PUB_PATH",ROOT_PATH."pub\\");
        define("LIBRARY_PATH",SYSTEM_PATH."library\\");
        define("CORE_PATH",SYSTEM_PATH."core\\");
        define("CONTROLLER_PATH",APP_PATH."controller\\");
        define("CONFIG_PATH",APP_PATH."config\\");
        define("VIEW_PATH",APP_PATH."view\\");
        define("MODEL_PATH",APP_PATH."model\\");
    }

    //2、设置错误级别
    static function setError()
    {
        if(APP_DEBUG=="true"){
            error_reporting(E_ALL ^E_DEPRECATED);
        }else{
            ini_set("display_errors",0);
            error_reporting(0);
        }
    }

    //3、初始化配置文件
    static function setConfig()
    {
        require_once CONFIG_PATH."config.php";
        //将数据库配置读取到全局变量中
        $GLOBALS['config'] = $config;
    }

    //4、对数据做安全验证
    static function safeFilter()
    {

    }
    //自动加载
    static function autoload()
    {
        spl_autoload_register(array("App","loadCore"),true,true);
        spl_autoload_register(array("App","loadClass"));
        spl_autoload_register(array("App","loadLibrary"));
        spl_autoload_register(array("App","loadModel"));
    }

    //5.1、加载类库
    static function loadClass($class)
    {
        $classFiled = CONTROLLER_PATH.$class.".class.php";
        if(file_exists($classFiled)){
            require_once $classFiled;
        }
    }

    //加载model
    static function loadModel($class)
    {
        $classModel = MODEL_PATH.$class.".class.php";
        if(file_exists($classModel)){
            require_once $classModel;
        }
    }

    //5.2、加载第三方library
    static function loadLibrary($class)
    {
        $libraryFiled = LIBRARY_PATH.$class.".class.php";;
        if(file_exists($libraryFiled)){
            require_once $libraryFiled;
        }
    }

    //5.0、加载核心类库
    static function loadCore($class)
    {
        $coreFiled = CORE_PATH.$class.".php";
        if(file_exists($coreFiled)){
            require_once $coreFiled;
        }
    }

    //5、设置路由
    static function setRouter()
    {
        $controller = isset($_GET['c']) ? ucfirst($_GET['c']) : "Index";
        $action = isset($_GET['a']) ? $_GET['a'] : "index";
        define("CONTROLLER_NAME",$controller);;
        define("ACTION_NAME",$action);
    }

    //6、地址转发
    static function createObject()
    {
        $controllerName = CONTROLLER_NAME."Controller";
        $actionName = ACTION_NAME;
        $obj = new $controllerName;
        $obj->$actionName();
    }
}

