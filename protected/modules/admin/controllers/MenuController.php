<?php

class MenuController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/main';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'update','create','delete'),
                'roles' => array('Admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
      $this->pageTitle='Menu';
        $model = new Menu('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Menu']))
            $model->attributes = $_GET['Menu'];
        $this->render('index', array(
            'model' => $model,
        ));
    }
    
    public function actionCreate() {
      $this->pageTitle='New Menu';
        $model = new Menu;
        if($_POST['Menu']){
            $model->attributes = $_POST['Menu'];
            $model->update_by = Yii::app()->user->userId;
            $model->update_time = date('Y-m-d h:i:s');
            if ($model->save()){
                Yii::app()->user->setFlash('success', "Success: Menu created successfully");
                $this->redirect(array('index'));
            }else{
                Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
            }
        }
        
        $model->sort_order = Yii::app()->easycode->getLastSortingNumber('Menu','sort_order');
        
        $this->render('_form', array('model'=>$model));
    }
    
    public function actionUpdate($id) {
      $this->pageTitle='Update Menu';
        $model = Menu::model()->findByPk($id);
        
        if($_POST['Menu']){
            $model->attributes = $_POST['Menu'];
            $model->update_by = Yii::app()->user->userId;
            $model->update_time = date('Y-m-d h:i:s');
            if ($model->save()){
                Yii::app()->user->setFlash('success', "Success: Menu updated successfully");
                $this->redirect(array('index'));
            }else{
                Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
            }
        }
        
        $this->render('_form', array('model'=>$model));
    }
    public function actionDelete($id) {
        //$this->loadModel($id)->delete();
        Menu::model()->deleteByPk($id);
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}
