<?php
// sq 10
// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
//sq 14
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
// sq 11
// uncomment to view default php error messages + unconflicted
//defined('YII_ENABLE_ERROR_HANDLER') or define('YII_ENABLE_ERROR_HANDLER',false);
//tst 1 2 3 4 5 6 7
// test squash  3
//sq 12
require_once($yii);
Yii::createWebApplication($config)->run();
//sq 13