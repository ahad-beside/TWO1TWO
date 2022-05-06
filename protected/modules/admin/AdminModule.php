<?php
class AdminModule extends CWebModule {

    public function init() {
        if(isset(Yii::app()->user->roles)){
        if(!Yii::app()->user->isGuest and Yii::app()->user->roles!='Admin' and Yii::app()->user->roles!='ePosterAdmin')
            throw new CHttpException(400, 'Bad Request, ');
        }
        
        Yii::app()->theme = 'admin';
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'admin.models.*',
            'admin.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            
            //CHttpRequest::redirect(Yii::app()->homeUrl);
            // this method is called before any module controller action is performed
            // you may place customized code here
            define('PAGINATION_ITEM', 50);
            
            return true;
        } else
            return false;
    }

}
