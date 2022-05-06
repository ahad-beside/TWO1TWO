<?php
class EposterListController extends Controller {

    public $layout = '//layouts/login';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'umayalsolike','viewTest','details'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('rating','addToWishList','delFromWishList'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function actionIndex(){
        $this->pageTitle = 'All 212Poster';
        $data['model'] = EposterList::model()->findAll("id!=0 order by expire_date asc");
        $data['advertisement']=Advertisement::model()->findAll("position='212 Poster'");
        //print_r($data['model']);exit;
        $this->render('eposterDetailsNew', array(
            'data' => $data,
        ));
    }

    public function actionView($name){
        $data['model'] = EposterList::model()->findAll("id!=0 order by expire_date asc");
        $data['posterDetails'] = EposterList::model()->find('slug=:slug',array(':slug'=>urlencode($name)));
        $data['name']=$name;
        $this->pageTitle =  $data['posterDetails']->name.' - '.Yii::app()->name;
        $this->render('eposterDetails', array(
            'data' => $data,
        ));
        Yii::app()->end();
    }
    public function actionDetails($id){
        $this->layout='//layouts/blank';
        $this->pageTitle =  'Details Document';
        $data['posterDetails'] = EposterImage::model()->findByPk(intval($id));
        $this->render('eposterDocumentDetails', array(
            'data' => $data,
        ));
        Yii::app()->end();
    }
    

    public function loadModel($id) {
        $model = EposterList::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    

}
