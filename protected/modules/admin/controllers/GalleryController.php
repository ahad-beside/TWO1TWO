<?php

class GalleryController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'deleteAll', 'enable', 'disable', 'index', 'view', 'delImage', 'delete'),
                'roles' => array('Admin'),
            ),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id='')
	{
		$this->pageTitle='Upload Gallery Image';
		$model=new Gallery;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Gallery']))
		{
			for ($i = 0; $i < count($_POST['Gallery']['status']); $i++):
                    $model = new Gallery;

                $uploadedFile = CUploadedFile::getInstance($model, "image[{$i}]");
                if ($uploadedFile) {
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $model->image = $fileName;
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->albumDir . $fileName);
                    Yii::app()->easycode->deleteFile($preImage,'album');
                } 
                $model->albumId = $_POST['Gallery']['albumId'];
                $model->status = $_POST['Gallery']['status'][$i];
                $model->save();
            endfor;
		}
		$model->albumId=$id;
		$this->render('create',array(
			'model'=>$model,
			'id'=>$id,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$preImage = $model->image;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Gallery']))
		{
			$model->attributes=$_POST['Gallery'];
			$uploadedFile = CUploadedFile::getInstance($model, "image");
            if ($uploadedFile) {
                $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                $model->image = $fileName;
            }else  $model->image = $preImage;
			if($model->save()){
				if ($uploadedFile) {
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->albumDir . $fileName);
                    Yii::app()->easycode->deleteFile($preImage);
                }
				Yii::app()->user->setFlash('success', "Image Update successfully");
				$this->redirect(array('admin'));
				
			}else{
                Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	
	public function actionEnable() {
        if (Yii::app()->request->isAjaxRequest) {
            $data = array('msg' => 'error');
            if ($_POST['value']) {
                $orderIds = array();
                for ($i = 0; $i < count($_POST['value']); $i++):
                    if (Gallery::model()->exists('id=:id and status="0"', array(':id' => $_POST['value'][$i]))) {						
                        $galleryInfo = Gallery::model()->updateByPk($_POST['value'][$i], array('status' => '1'));
                        $orderIds[] = $_POST['value'][$i];
                    }
                endfor;
                $data = array('msg' => 'success', 'totalOrders' => count($orderIds));
            } else {
                $data = array('msg' => 'error');
            }
        } else {
            $data = array('msg' => 'error');
        }
        echo json_encode($data);
    }
	
	 public function actionDisable() {
        if (Yii::app()->request->isAjaxRequest) {
            $data = array('msg' => 'error');
            if ($_POST['value']) {
                $orderIds = array();
                for ($i = 0; $i < count($_POST['value']); $i++):
                    if (Gallery::model()->exists('id=:id and status="1"', array(':id' => $_POST['value'][$i]))) {
                        $galleryInfo = Gallery::model()->updateByPk($_POST['value'][$i], array('status' => '0'));
                        $orderIds[] = $_POST['value'][$i];
                    }
                endfor;
                $data = array('msg' => 'success', 'totalOrders' => count($orderIds));
            } else {
                $data = array('msg' => 'error');
            }
        } else {
            $data = array('msg' => 'error');
        }
        echo json_encode($data);
    }
	
	public function actionDeleteAll() {
        if (Yii::app()->request->isAjaxRequest) {
            $data = array('msg' => 'error');
            if ($_POST['value']) {
                $orderIds = array();
                for ($i = 0; $i < count($_POST['value']); $i++):	
						Yii::app()->easycode->deleteFile($this->loadModel($_POST['value'][$i])->image);
						if ($this->loadModel($_POST['value'][$i])->delete()) {
							
							$orderIds[] = $_POST['value'][$i];
						}
                endfor;
                $data = array('msg' => 'success', 'totalOrders' => count($orderIds));
            } else {
                $data = array('msg' => 'error');
            }
        } else {
            $data = array('msg' => 'error');
        }
        echo json_encode($data);
    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		//Yii::app()->easycode->deleteFile($this->loadModel($id)->image);
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Gallery');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($id='')
	{
		$model=new Gallery('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Gallery']))
			$model->attributes=$_GET['Gallery'];
		if($id!='')	{
			$model->albumId = $id;
			$albumName = Album::model()->findByPk($id)->name; 
		}
		$this->pageTitle=$albumName.' - Image';
		$this->render('admin',array(
			'model'=>$model,
			'id' => $id,
			'albumName' => $albumName
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Gallery the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Gallery::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Gallery $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='gallery-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
