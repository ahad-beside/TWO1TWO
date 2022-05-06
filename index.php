<?php
//include_once 'check-country.php';
//echo __DIR__;
// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

//frontend pagination settings
define('PAGINATION_ITEM','15');

//Custom invoice folder
define('INVOICE',__DIR__.'/invoices');
if (!file_exists(INVOICE))mkdir(INVOICE);

define('MEDIAFILE',dirname(__FILE__).'/mediaLibrary');
if (!file_exists(MEDIAFILE))mkdir(MEDIAFILE);
//Custom upload folder
define('UPLOAD',__DIR__.'/upload');
if (!file_exists(UPLOAD))mkdir(UPLOAD);

//Site image folder
define('IMAGE',__DIR__.'/images');
if (!file_exists(IMAGE))mkdir(IMAGE);

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);


Yii::createWebApplication($config)->run();