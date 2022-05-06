<?php

class AlbumController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('createImageSlide', 'updateImageSlide', 'adminImageSlide', 'deleteAll', 'enable', 'disable','delSlideshowItem', 'index', 'view', 'admin', 'delImage', 'delete','albumCreateAjax'),
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
	public function actionAlbumCreateAjax() {
        $this->pageTitle = 'New Album';
        $model = new Album;
        if (isset($_POST['Album'])) {
            $model->attributes = $_POST['Album'];
            $uploadedFile = CUploadedFile::getInstance($model, "image");
                              
                if ($uploadedFile){
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $model->image = $fileName;
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->albumDir . $fileName);
                }
            if ($model->save()) {
                echo CJSON::encode(array('id' => $model->id, 'name' => $model->name, 'option' => '<option value="' . $model->id . '">' . $model->name . '</option>'));
                return;
            } else {
                echo CJSON::encode(array('id' => 0, 'error' => $model->getErrors()));
                return;
            }
        }

        $this->render('albumCreateAjax', array(
            'model' => $model,
        ));
    }
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
	public function actionCreate()
	{
		$this->pageTitle='New Album';
		$model=new Album;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Album']))
		{
			$model->attributes=$_POST['Album'];
			$uploadedFile = CUploadedFile::getInstance($model, "image");
                              
                if ($uploadedFile){
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $model->image = $fileName;
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->albumDir . $fileName);
                }
			if($model->save()){
				Yii::app()->user->setFlash('success', "Album created successfully");
				$this->redirect(array('admin'));
			}else{
                Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->pageTitle='Update Album';
		$model=$this->loadModel($id);
		$preImage = $model->image;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Album']))
		{
			$model->attributes=$_POST['Album'];
			$uploadedFile = CUploadedFile::getInstance($model, "image");
            if ($uploadedFile) {
                $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                $model->image = $fileName;
            }else  $model->image = $preImage;
			
			if($model->save()){
				if ($uploadedFile) {
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->albumDir . $fileName);
                    Yii::app()->easycode->deleteFile($preImage,'/album/');
                }
				Yii::app()->user->setFlash('success', "Album Update successfully");
				$this->redirect(array('admin'));
				
			}else{
                Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
            }
		}
		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionEnable() {
        if (Yii::app()->request->isAjaxRequest) {
            $data = array('msg' => 'error');
            if ($_POST['value']) {
                $orderIds = array();
                for ($i = 0; $i < count($_POST['value']); $i++):
                    if (Album::model()->exists('id=:id and status="0"', array(':id' => $_POST['value'][$i]))) {						
                        $albumInfo = Album::model()->updateByPk($_POST['value'][$i], array('status' => '1'));
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
	
	public function actionDisable(){
        if (Yii::app()->request->isAjaxRequest) {
            $data = array('msg' => 'error');
            if ($_POST['value']) {
                $orderIds = array();
                for ($i = 0; $i < count($_POST['value']); $i++):
                    if (Album::model()->exists('id=:id and status="1"', array(':id' => $_POST['value'][$i]))) {
                        $albumInfo = Album::model()->updateByPk($_POST['value'][$i], array('status' => '0'));
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
					if (Album::model()->exists('id=:id and status="1"', array(':id' => $_POST['value'][$i]))) {
					
						//start image delete under album
						$imageGallery = Gallery::model()->findAll('albumId=:albumId', array(':albumId'=>$_POST['value'][$i]));
						foreach($imageGallery as $image):
							Yii::app()->easycode->deleteFile($image->image,'/album/');
						    Gallery::model()->deleteByPk($image->id);
						endforeach;
						//end image delete under album
					
						Yii::app()->easycode->deleteFile($this->loadModel($_POST['value'][$i])->image,'/album/');
						if ($this->loadModel($_POST['value'][$i])->delete()) {
							
							$orderIds[] = $_POST['value'][$i];
						}
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
	
	//start image delete under album
	$imageGallery = Gallery::model()->findAll('albumId=:albumId', array(':albumId'=>$id));
	foreach($imageGallery as $image):
	   Yii::app()->easycode->deleteFile($image->image,'/album/');
	   Gallery::model()->deleteByPk($image->id);
	endforeach;
	//end image delete under album
						
		Yii::app()->easycode->deleteFile($this->loadModel($id)->image,'/album/');
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
		/* $dataProvider=new CActiveDataProvider('Album');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		)); */
		$this->actionAdmin();
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->pageTitle='Album';
		$model=new Album('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Album']))
			$model->attributes=$_GET['Album'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Album the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Album::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Album $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='album-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
