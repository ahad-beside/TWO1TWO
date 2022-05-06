<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => '212 Communication',
    //'theme' => 'jalil',
	'theme' => '212',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.extensions.easyPaypal.*',
        'application.models.*',
        'application.components.*',
        'ext.YiiMailer.YiiMailer',
    ),
    'controllerMap' => array(
        'barcodegenerator' => array(
            'class' => 'ext.barcodegenerator.BarcodeGeneratorController',
        ),
    ),
    'modules' => array(
        'mobile'=>array(
            'defaultController' => 'site',
            ),
        'admin' => array(
            'modules' => array('payment', 'custom'),
            'defaultController' => 'dashboard',
        ),
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array($_SERVER['REMOTE_ADDR']),
        ),
    ),
    // application components
    'components' => array(
        'yexcel' => array(
            'class' => 'ext.yexcel.Yexcel'
        ),
        'session' => array(
            'autoStart' => true,
        ),
        'mobileDetect' => array(
            'class' => 'ext.MobileDetect.MobileDetect'
        ),
        //Get currency settings
        'currency' => array('class'=>'CurrencySetting'),
        
        //YiimageThumb
        'thumb' => array(
            'class' => 'YiimageThumb'
        ),
        'ePdf' => array(
            'class' => 'ext.yii-pdf.EYiiPdf',
            'params' => array(
                'mpdf' => array(
                    'librarySourcePath' => 'application.vendors.mpdf.*',
                    'constants' => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class' => 'mpdf', // the literal class filename to be loaded from the vendors folder
                    'defaultParams' => array(// More info: http://mpdf1.com/manual/index.php?tid=184
                        'mode' => '', //  This parameter specifies the mode of the new document.
                        'format' => 'A4', // format A4, A5, ...
                        'default_font_size' => 12, // Sets the default document font size in points (pt)
                        'default_font' => 'Arial, Helvetica, sans-serif', // Sets the default font-family for the new document.
                        'mgl' => 5, // margin_left. Sets the page margins for the new document.
                        'mgr' => 5, // margin_right
                        'mgt' => 6, // margin_top
                        'mgb' => 6, // margin_bottom
                        'mgh' => 9, // margin_header
                        'mgf' => 9, // margin_footer
                        'orientation' => 'P', // landscape or portrait orientation
                    )
                ),
                'HTML2PDF' => array(
                    'librarySourcePath' => 'application.vendors.html2pdf.*',
                    'classFile' => 'html2pdf.class.php', // For adding to Yii::$classMap
                    'defaultParams' => array(// More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                        'orientation' => 'P', // landscape or portrait orientation
                        'format' => 'A4', // format A4, A5, ...
                        'language' => 'en', // language: fr, en, it ...
                        'unicode' => true, // TRUE means clustering the input text IS unicode (default = true)
                        'encoding' => 'UTF-8', // charset encoding; Default is UTF-8
                        'marges' => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                    )
                )
            ),
        ),
        //Uploader Components
        'uploader' => array('class' => 'Uploader'),
        //EasyCode Components
        'easycode' => array('class' => 'EasyCode'),
        'text2img' => array('class' => 'Text2Img'),
        'mobileDetect' => array(
            'class' => 'ext.MobileDetect.MobileDetect'
        ),
        'clientScript' => array(
            'scriptMap' => array(
                'jquery.js' => false,
                'jquery.min.js' => false,
            ),
        /* 'packages' => array(
          'jquery' => array(
          'baseUrl' => 'js/',
          'js' => array('jquery-1.11.0.js'),
          'coreScriptPosition' => CClientScript::POS_HEAD
          ),
          ), */
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'EWebUser',
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'caseSensitive' => true,
            'urlSuffix' => '.html',
            'rules' => array(
                '212poster'=>'eposterList',
                'admin/212poster'=>'admin/eposterList',
                'admin/212poster/create'=>'admin/eposterList/create',
                'admin/212poster/update'=>'admin/eposterList/update',
                '<controller:\w+>/<id:\d+>' => array('<controller>/view'),
                //'<controller:\w+>/<id:\d+>' => array('<controller>/view'),
                //'<controller:\w+>/<action:\w+>/<id:\d+>' => array('<controller>/<action>'),
                //'<controller:\w+>/<action:\w+>' => array('<controller>/<action>'),
                'products/<action:\w+>/<name>' => 'products/<action>',
                'products/<action:\w+>' => 'products/<action>',
                'products/<name>' => 'products/view',
                'service/<action:\w+>/<name>' => 'service/<action>',
                'service/<action:\w+>' => 'service/<action>',
                'service/<name>' => 'service/view',
                'category/<action:\w+>/<name>' => 'category/<action>',
                'category/<action:\w+>' => 'category/<action>',
                'category/<name>' => 'category/view',
                'serviceCategory/<action:\w+>/<name>' => 'serviceCategory/<action>',
                'serviceCategory/<action:\w+>' => 'serviceCategory/<action>',
                'serviceCategory/<name>' => 'serviceCategory/view',

                'jobList/<action:\w+>/<name>' => 'jobList/<action>',
                'jobList/<action:\w+>' => 'jobList/<action>',
                'jobList/<name>' => 'jobList/view',
                
                'jobCategory/<action:\w+>/<name>' => 'jobCategory/<action>',
                'jobCategory/<action:\w+>' => 'jobCategory/<action>',
                'jobCategory/<name>' => 'jobCategory/view',

                'eposterList/<action:\w+>/<name>' => 'eposterList/<action>',
                'eposterList/<action:\w+>' => 'eposterList/<action>',
                'eposterList/<name>' => 'eposterList/view',
                
                'eposterCategory/<action:\w+>/<name>' => 'eposterCategory/<action>',
                'eposterCategory/<action:\w+>' => 'eposterCategory/<action>',
                'eposterCategory/<name>' => 'eposterCategory/view',

                'page/<action:\w>' => 'page/<action>',
                'page/<name>' => 'page/view',
                'cart/<action:\w+>/<id:\d+>' => 'cart/<action>',
                'cart/<action:\w+>' => 'cart/<action>',
                'cart/<name>' => 'cart/view',
                'site/<action:\w+>' => 'site/<action>',
                'site/<name>' => 'site/view',
                'user/<action:\w+>' => 'user/<action>',
                'user/<name>' => 'user/view',
                '<module:\w+>/<controller:\w+>/<id:\d+>' => array('<module>/<controller>/view'),
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => array('<module>/<controller>/<action>'),
                '<module:\w+>/<controller:\w+>/<action:\w+>' => array('<module>/<controller>/<action>'),
            //'<controller:\w+>/<id:\d+>' => '<controller>/view',
            //'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
            //'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            //'<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
            ),
        ),
        /* 'db' => array(
          'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
          ), */
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=two1two',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        //'enableParamLogging' => true,
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages

            /* array(
              'class'=>'CWebLogRoute',
              ), */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'SERVER_HOST' => 'http://localhost/arold/212/',
        'SITE_URL' => 'http://localhost',
        'companyLogo' => '/images/logo.png',
        'decimalPoint'=>2,
        'md5Key' => 2441139,
        'logoDir' => '/logo/',
        'albumDir' => '/album/',
        'categoryDir' => '/category/',
        'serviceCategoryDir' => '/serviceCategory/',
        'userDir' => '/user/',
        'productDir' => '/product/',
        'serviceDir' => '/product/',
        'sliderDir' => '/slider/',
        'cvDir'=>'/cv/',
        'ePosterDir'=>'/ePoster/',
        'usdCurrency'=>'$',
        'currencySymbol'=>'$',
        'advertisementDir'=>'/advertisement/',
        'bestImgSize'=>'(1000px X 800px) or same ratio is recommended for image',
        'bestImgSizeBanner'=>'(1000px X 800px) or same ratio is recommended for image',
    ),
    
);


