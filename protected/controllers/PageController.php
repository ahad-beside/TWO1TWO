<?php
class PageController extends Controller {

    public $layout = '//layouts/login';
    public $defaultAction = 'view';
    
    public function actionView($id){
	//$this->layout = '//layouts/main';
        $model = Page::model()->findByPk($id);
        $this->pageTitle = $model->title;
        $this->render('view',array('model'=>$model));
    }
}
