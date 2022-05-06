<?php
class JobListController extends Controller {

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
                'actions' => array('index', 'view', 'umayalsolike','viewTest'),
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
        $this->redirect(array('//jobCategory/all'));
    }

    public function actionView($name){
        $model = JobList::model()->find('slug=:slug',array(':slug'=>$name));
        $this->pageTitle =  $model->name.' - '.Yii::app()->name;
        $modelApply=new JobAppliedList;
        $id = $model->id;
        if($_POST['JobAppliedList']){
            $modelApply->attributes = $_POST['JobAppliedList'];
            $uploadedFile = CUploadedFile::getInstance($modelApply, "cv_file");
            if ($uploadedFile) {
                $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                $modelApply->cv_file = $fileName;
            }

            if($modelApply->save()){
                if ($uploadedFile) {
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->cvDir . $fileName);
                }
            }
        }
        $this->render('jobDetails', array(
            'model' => $model,
            'data' => $data,
            'modelApply'=>$modelApply,
        ));
        Yii::app()->end();
    }
    

    public function loadModel($id) {
        $model = Products::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    

}
