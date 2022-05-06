<?php

class ServiceController extends Controller {

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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'index', 'view', 'admin', 'delImage', 'delete','delDownload'),
                'roles' => array('Admin'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('getOptionContainer'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionDelImage() {
        if (isset($_POST['delId']) && $_POST['delId'] != '') {
            $id = $_POST['delId'];
            $model = new ServiceImage;
            $info = $model->findByPk($id);
            if (count($info) > 0) {
                $model->deleteByPk($id);
                Yii::app()->easycode->deleteFile($info->image,'service');
                echo 1;
            }
        }
    }
    
    public function actionDelDownload() {
        if (isset($_POST['delId']) && $_POST['delId'] != '') {
            $id = $_POST['delId'];
            $model = new ServiceDownload;
            $info = $model->findByPk($id);
            if (count($info) > 0) {
                $model->deleteByPk($id);
                Yii::app()->easycode->deleteFile($info->image,'service');
                echo 1;
            }
        }
    }

    public function actionGetOptionContainer(){
        $optionId = $_POST['optionId'];
        $optionCount = $_POST['optionCount'];
        //$optionId = $_GET['optionId'];
        $optionType = Option::model()->findByPk((int) $optionId);
        if ($optionType->type === 'select' || $optionType->type === 'radio' || $optionType->type === 'image') {
            echo Option::model()->getOptionContainer($optionType->type, $optionType->id, $optionType->name, $optionCount);
        }
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


    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate(){
        $this->pageTitle='New Service';
        $model = new Service;
        $data['countOptionContainer'] = 0;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Service'])) {
            $model->attributes = $_POST['Service'];
            $model->update_by = Yii::app()->user->userId;
            $model->update_time = date('Y-m-d h:i:s');
            $model->slug = Yii::app()->easycode->makeSlug('Service',$model->name);
            if ($model->validate()) {
                $uploadedFile = CUploadedFile::getInstance($model, "image");
                if ($uploadedFile) {
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $model->image = $fileName;
                }
            }
            $data['selectedCategory'] = $_POST['categories'];
            //$data['selectedFilter'] = $_POST['filters'];
            //$data['selectedRelatedProducts'] = $_POST['relatedProducts'];

            if (count($_POST['categories']) < 1) {
                Yii::app()->user->setFlash('warning', "Warning: Please choose minimum one category from link tab!");
            } else {
                if ($model->save()) {
                    if($uploadedFile)
                        $uploadedFile->saveAs(UPLOAD . Yii::app()->params->serviceDir . $fileName);
                    $this->saveProductCategories($model->id, $_POST['categories']); //save product categories
                    $this->saveProductsImage($model->id, $_POST['ServiceImage']); //save product images
                    $this->saveProductsDownload($model->id, $_POST['ServiceDownload']); //save product download file
                    Yii::app()->user->setFlash('success', "Success: Service created successfully");
                    $this->redirect(array('admin'));
                } else {
                    Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
                }
            }
        }

        $model->sort_order = Yii::app()->easycode->getLastSortingNumber('Service', 'sort_order');
        $this->render('create', array(
            'model' => $model,
            'data' => $data,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $this->pageTitle='Update Service';
        $model = $this->loadModel($id);
        $data['selectedCategory'] = Service::model()->getSelectedCategory($id);
        $data['productsImage'] = ServiceImage::model()->findAll('product_id=:id', array(':id' => $id));
        $data['productsDownload'] = ServiceDownload::model()->findAll('product_id=:id', array(':id' => $id));

        /* end get selected option container */

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $preImage = $model->image;
        if (isset($_POST['Service'])) {
            $model->attributes = $_POST['Service'];
            $model->update_by = Yii::app()->user->userId;
            $model->update_time = date('Y-m-d h:i:s');
            $model->slug = Yii::app()->easycode->makeSlug('Service',$model->name);
            if ($model->validate()) {
                $uploadedFile = CUploadedFile::getInstance($model, "image");
                if ($uploadedFile) {
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $model->image = $fileName;
                    
                    Yii::app()->easycode->deleteFile($preImage);
                } else {
                    $model->image = $preImage;
                }
            }

            if (count($_POST['categories']) < 1) {
                Yii::app()->user->setFlash('warning', "Warning: Please choose minimum one category from link tab!");
            } else {
                if ($model->save()) {
                    
                    if($uploadedFile)
                        $uploadedFile->saveAs(UPLOAD . Yii::app()->params->serviceDir . $fileName);

                    $this->saveProductCategories($model->id, $_POST['categories']); //save product categories
                    $this->saveProductsImage($model->id, $_POST['ServiceImage']); //save product images
                    $this->saveProductsDownload($model->id, $_POST['ServiceDownload']); //save product download file

                    Yii::app()->user->setFlash('success', "Service updated successfully");
                    $this->redirect(array('admin'));
                } else {
                    Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
            'data' => $data,
        ));
    }

    public static function saveProductsImage($productId, $values) {
        if (count($values) > 0) {
            for ($i = 0; $i < count($values['sort_order']); $i++):
                if (isset($values['id'][$i]) && $values['id'][$i] != '') {
                    $model = ServiceImage::model()->findByPk($values['id'][$i]);
                    $preImage = $model->image;
                } else {
                    $model = new ServiceImage;
                    $preImage = '';
                }

                $uploadedFile = CUploadedFile::getInstance($model, "image[{$i}]");
                if ($uploadedFile) {
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $model->image = $fileName;
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->serviceDir . $fileName);
                    Yii::app()->easycode->deleteFile($preImage,'service');
                } else {
                    $model->image = $preImage;
                }

                $model->product_id = $productId;
                if ($values['sort_order'][$i] != '')
                    $model->sort_order = $values['sort_order'][$i];
                else
                    $model->sort_order = Yii::app()->easycode->getLastSortingNumber('ServiceImage', 'sort_order');

                $model->save();
            endfor;
        }
    }
    public static function saveProductsDownload($productId, $values) {
        if (count($values) > 0) {
            for ($i = 0; $i < count($values['sort_order']); $i++):
                if (isset($values['id'][$i]) && $values['id'][$i] != '') {
                    $model = ServiceDownload::model()->findByPk($values['id'][$i]);
                    $preImage = $model->image;
                } else {
                    $model = new ServiceDownload;
                    $preImage = '';
                }

                $uploadedFile = CUploadedFile::getInstance($model, "image[{$i}]");
                if ($uploadedFile) {
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $model->image = $fileName;
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->serviceDir . $fileName);
                    Yii::app()->easycode->deleteFile($preImage,'service');
                } else {
                    $model->image = $preImage;
                }

                $model->product_id = $productId;


                if ($values['sort_order'][$i] != '')
                    $model->sort_order = $values['sort_order'][$i];
                else
                    $model->sort_order = Yii::app()->easycode->getLastSortingNumber('ServiceDownload', 'sort_order');

                $model->save();
            endfor;
        }
    }


    public function saveProductCategories($productId, $values) {
        CategoryService::model()->deleteAll('product_id=:id', array(':id' => $productId)); //Delete Previous Product Categories
        if (count($values) > 0) {
            for ($i = 0; $i < sizeof($values); $i++):
                $model = new CategoryService;
                $model->product_id = $productId;
                $model->category_id = $values[$i];
                if ($model->save())
                    $this->saveParentsCategoryToProduct($values[$i], $productId);
            endfor;
        }
    }

    public function saveParentsCategoryToProduct($catId, $productId) {
        $getParent = ServiceCategory::model()->findByPk($catId);
        if ($getParent != Null) {
            if (!CategoryService::model()->exists('product_id=:pid and category_id=:cid', array(':pid' => $productId, ':cid' => $getParent->parent))) {
                $model = new CategoryService;
                $model->product_id = $productId;
                $model->category_id = $getParent->parent;
                if ($model->save())
                    $this->saveParentsCategoryToProduct($getParent->parent, $productId);
            }
        }
    }



    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {

        Service::model()->deleteProductImages($id);

        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        /* $dataProvider = new CActiveDataProvider('Products');
          $this->render('index', array(
          'dataProvider' => $dataProvider,
          )); */
        $this->actionAdmin();
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->pageTitle='Service List';
        $model = new Service('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Service']))
            $model->attributes = $_GET['Service'];
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Products the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Service::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Products $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'products-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
