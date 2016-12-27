<?php return array (
  'logs' => 
  array (
    'path' => 'backup/logs/log',
    'type' => 'file',
  ),
  'DB' => 
  array (
    'type' => 'mysqli',
    'tablePre' => 'iwebshop_',
    'read' => 
    array (
      0 => 
      array (
        'host' => 'localhost:3306',
        'user' => 'root',
        'passwd' => 'root',
        'name' => 'iwebshop',
      ),
    ),
    'write' => 
    array (
      'host' => 'localhost:3306',
      'user' => 'root',
      'passwd' => 'root',
      'name' => 'iwebshop',
    ),
  ),
  'interceptor' => 
  array (
    0 => 'themeroute@onCreateController',
    1 => 'layoutroute@onCreateView',
    2 => 'hookCreateAction@onCreateAction',
    3 => 'hookFinishAction@onFinishAction',
  ),
  'langPath' => 'language',
  'viewPath' => 'views',
  'skinPath' => 'skin',
  'classes' => 'classes.*',
  'rewriteRule' => 'url',
  'theme' => 
  array (
    'pc' => 'default',
    'mobile' => 'mobile',
  ),
  'skin' => 
  array (
    'pc' => 'black',
    'mobile' => 'default',
  ),
  'timezone' => 'Etc/GMT-8',
  'upload' => 'upload',
  'dbbackup' => 'backup/database',
  'safe' => 'cookie',
  'lang' => 'zh_sc',
  'debug' => false,
  'configExt' => 
  array (
    'site_config' => 'config/site_config.php',
  ),
  'encryptKey' => '2a118e2b49d26d493c1125edc6e67da2',
  'name' => 'Fine of his life',
  'parent_id' => '0',
  'sort' => '2',
  'visibility' => '1',
  'keywords' => 'Fine of his life',
  'descript' => 'dssd',
  'title' => '你最正确的选择',
  'name9' => '崔金朋',
  'name11' => 'HANHOU',
  'name13' => '崔金朋',
  'name14' => 'HANHOU',
)?>