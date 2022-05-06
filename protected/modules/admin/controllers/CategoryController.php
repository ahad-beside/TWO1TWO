<?php

class CategoryController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/main';
    
    public $imageFolder = 'imageCategory';

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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'create', 'update', 'admin','makeLink','delete'),
                'roles' => array('Admin'),
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
    
    public function actionMakeLink(){
            echo Category::model()->makeLink($_GET['id']);
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }
    
    public function saveCategoryToStore($data,$category,$action){
        if($action=='update')
                $model = CategoryToStore::model()->deleteAll('category_id=:id',array(':id'=>$category));
        if(count($data)>0){
        foreach($data as $val):
            $model = new CategoryToStore;
            $model->category_id = $category;
            $model->store_id = $val;
            $model->save();
        endforeach;
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
      $this->pageTitle='New Product Category';
        $model = new Category;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Category'])) {
            $model->attributes = $_POST['Category'];
            $model->update_by = Yii::app()->user->userId;
            $model->update_time = date('Y-m-d h:i:s');
            $model->slug = Yii::app()->easycode->makeSlug('Category',$model->name);
            if ($model->validate()){
                $uploadedFile = CUploadedFile::getInstance($model, "image");
                if ($uploadedFile) {
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $model->image = $fileName;
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->categoryDir . $fileName);
                }
            }
            if ($model->validate()){
                $uploadedFileBanner = CUploadedFile::getInstance($model, "category_banner");
                if ($uploadedFileBanner) {
                    $fileNameBanner = Yii::app()->easycode->genFileName($uploadedFileBanner->extensionName);
                    $model->category_banner = $fileNameBanner;
                    $uploadedFileBanner->saveAs(UPLOAD . Yii::app()->params->categoryDir . $fileNameBanner);
                }
            }
            if ($model->save()){
                Yii::app()->user->setFlash('success', "Success: Category created successfully");
                $this->redirect(array('admin'));
            }else{
                Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
            }
        }

        $model->sort_order = Yii::app()->easycode->getLastSortingNumber('Category','sort_order');

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
      $this->pageTitle='Update Product Category';
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $preImage = $model->image;
        $preBanner = $model->category_banner;
        if (isset($_POST['Category'])) {
            $model->attributes = $_POST['Category'];
            $model->update_by = Yii::app()->user->userId;
            $model->update_time = date('Y-m-d h:i:s');
            $model->slug = Yii::app()->easycode->makeSlug('Category',$model->name);
            if ($model->validate()) {
                $uploadedFile = CUploadedFile::getInstance($model, "image");
                if ($uploadedFile) {
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $model->image = $fileName;
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->categoryDir . $fileName);
                    Yii::app()->easycode->deleteFile($preImage,'category');
                }else{
                    $model->image = $preImage;
                }
            }
            if ($model->validate()) {
                $uploadedFileBanner = CUploadedFile::getInstance($model, "category_banner");
                if ($uploadedFileBanner) {
                    $fileNameBanner = Yii::app()->easycode->genFileName($uploadedFileBanner->extensionName);
                    $model->category_banner = $fileNameBanner;
                    $uploadedFileBanner->saveAs(UPLOAD . Yii::app()->params->categoryDir . $fileNameBanner);
                    Yii::app()->easycode->deleteFile($preBanner,'category');
                }else{
                    $model->category_banner = $preBanner;
                }
            }
            if ($model->save()){
                Yii::app()->user->setFlash('success', "Category updated successfully");
                $this->redirect(array('admin'));
            }else{
                Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        //$this->loadModel($id)->delete();
Category::model()->deleteByPk($id);
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        /* $dataProvider=new CActiveDataProvider('Category');
          $this->render('index',array(
          'dataProvider'=>$dataProvider,
          )); */
        $this->actionAdmin();
    }
    /**
     * Manages all models.
     */
    public function actionAdmin() {
      $this->pageTitle='Product Category List';
        $model = new Category('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Category']))
            $model->attributes = $_GET['Category'];
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Category the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Category::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Category $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'category-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
