<?php

class SlideshowController extends Controller {

    public $layout = '//layouts/main';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('createImageSlide', 'updateImageSlide', 'adminImageSlide', 'createVideoSlide', 'updateVideoSlide', 'adminVideoSlide', 'deleteAll', 'enable', 'disable','delSlideshowItem', 'index', 'view', 'admin', 'delImage', 'delete','createHomeSlide', 'updateHomeSlide', 'adminHomeSlide',  'createDonorSlide', 'updateDonorSlide', 'adminDonorSlide'),
                'roles' => array('Admin'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('deleteAll'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        //$this->render('index');
        $this->actionAdminHomeSlide();
    }
    
    public function actionDelSlideshowItem() {
        if (isset($_POST['id']) && $_POST['id'] != '') {
            $id = $_POST['id'];
            $model = new SlideshowItems;
            $info = $model->findByPk($id);
            if (count($info) > 0) {
                $model->deleteByPk($id);
                Yii::app()->easycode->deleteFile($info->image);
                echo 1;
            }
        }
    }
    public function actionAdminHomeSlide(){     
    // HOME ADMIN
        $this->pageTitle='Photo Gallery';
        $model = new Slideshow('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Slideshow']))
            $model->attributes = $_GET['Slideshow'];

        $this->render('adminHomeSlide', array(
            'model' => $model,
        ));
    }
	
	 public function actionAdminImageSlide(){          //IMAGE GALLERY ADMIN
        $model = new Slideshow('searchimage');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Slideshow']))
            $model->attributes = $_GET['Slideshow'];
			$type = 'image';
        $this->render('adminImageSlide', array(
            'model' => $model,
			'type' => $type,
        ));
    }
    
	 public function actionAdminVideoSlide(){          //Video GALLERY ADMIN
        $model = new Slideshow('searchimage');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Slideshow']))
            $model->attributes = $_GET['Slideshow'];

        $type = 'video';
		$this->render('adminVideoSlide', array(
            'model' => $model,
			'type' => $type,
        ));
    }
	
	 public function actionAdminDonorSlide(){          //Video GALLERY ADMIN
        $model = new Slideshow('searchimage');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Slideshow']))
            $model->attributes = $_GET['Slideshow'];

        $type = 'donor';
		$this->render('adminDonorSlide', array(
            'model' => $model,
			'type' => $type,
        ));
    }
    

    public function actionCreateImageSlide() {   // IMAGE CREATE
        $model = new Slideshow;

        if (isset($_POST['Slideshow'])) {
            $model->attributes = $_POST['Slideshow'];
            $model->update_by = Yii::app()->user->userId;
            $model->update_time = date("Y-m-d H:i:s");
			$model->type = 'image';
			 $uploadedFile = CUploadedFile::getInstance($model, "image");
                              
                if ($uploadedFile){
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $model->image = $fileName;
                    $uploadedFile->saveAs(UPLOAD . '/' . $fileName);
                }
            if ($model->save()) {
                Yii::app()->user->setFlash('success', "Image created successfully");
                $this->redirect(array('adminImageSlide'));
            } else {
                Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
            }
        }

        $this->render('createImageSlide', array(
            'model' => $model,
            'modelItems' => $modelItems,
        ));
    }
	
	 public function actionCreateVideoSlide() {     //VIDEO CREATE
        $model = new Slideshow;

        if (isset($_POST['Slideshow'])) {
            $model->attributes = $_POST['Slideshow'];
            $model->update_by = Yii::app()->user->userId;
            $model->update_time = date("Y-m-d H:i:s");
			$model->type = 'video';
			
            if ($model->save()) {
                Yii::app()->user->setFlash('success', "Video created successfully");
                $this->redirect(array('adminVideoSlide'));
            } else {
                Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
            }
        }

        $this->render('createVideoSlide', array(
            'model' => $model,
            'modelItems' => $modelItems,
        ));
    }
	
	 public function actionCreateDonorSlide() {     //VIDEO CREATE
        $model = new Slideshow;

        if (isset($_POST['Slideshow'])) {
            $model->attributes = $_POST['Slideshow'];
            $model->update_by = Yii::app()->user->userId;
            $model->update_time = date("Y-m-d H:i:s");
			$model->type = 'donor';
			
			 $uploadedFile = CUploadedFile::getInstance($model, "image");
                              
                if ($uploadedFile){
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $model->image = $fileName;
                    $uploadedFile->saveAs(UPLOAD . '/' . $fileName);
                }
			
            if ($model->save()) {
                Yii::app()->user->setFlash('success', "AEPO Donor created successfully");
                $this->redirect(array('adminDonorSlide'));
            } else {
                Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
            }
        }

        $this->render('createDonorSlide', array(
            'model' => $model,
            'modelItems' => $modelItems,
        ));
    }
    
    public function actionCreateHomeSlide(){   // HOME SLIDER CREATE
        $this->pageTitle='Create Slider';
        $model = new Slideshow;
            if (isset($_POST['Slideshow'])) {
            $model->attributes = $_POST['Slideshow'];
			 // if ($model->validate()) {
                $uploadedFile = CUploadedFile::getInstance($model, "image");
                              
                if ($uploadedFile){
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $model->image = $fileName;
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->sliderDir . $fileName);
                }
            //}
            if ($model->save()) {
               
                Yii::app()->user->setFlash('success', "Home Slideshow created successfully");
                $this->redirect(array('adminHomeSlide'));
            } else {
                Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
            }
        }
		$count = Slideshow::model()->count();
			
	    $model->sort_order = $count+1; 

        $this->render('createHomeSlide', array(
            'model' => $model,
        ));
    }
    
    public function actionUpdateImageSlide($id) {   //UPDATE IMAGE
        $model = Slideshow::model()->findByPk($id);
		$preImage = $model->image;

        if (isset($_POST['Slideshow'])) {
            $model->attributes = $_POST['Slideshow'];
            $model->update_by = Yii::app()->user->userId;
            $model->update_time = date("Y-m-d H:i:s");
			
			$uploadedFile = CUploadedFile::getInstance($model, "image");
            if ($uploadedFile) {
                $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                $model->image = $fileName;
            }else  $model->image = $preImage;
			
            if ($model->save()) {
				
				  if ($uploadedFile) {
                    $uploadedFile->saveAs(UPLOAD . '/' . $fileName);
                    Yii::app()->easycode->deleteFile($preImage);
                }
				
                Yii::app()->user->setFlash('success', "Slideshow updated successfully");
                $this->redirect(array('adminImageSlide'));
            } else {
                Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
            }
        }

        $this->render('updateImageSlide', array(
            'model' => $model,
            'modelItems' => $modelItems,
        ));
    }
	
	  public function actionUpdateVideoSlide($id) {    //UPDATE VIDEO
        $model = Slideshow::model()->findByPk($id);

        if (isset($_POST['Slideshow'])) {
            $model->attributes = $_POST['Slideshow'];
            $model->update_by = Yii::app()->user->userId;
            $model->update_time = date("Y-m-d H:i:s");
			
		
            if ($model->save()) {

                Yii::app()->user->setFlash('success', "Video updated successfully");
                $this->redirect(array('adminVideoSlide'));
            } else {
                Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
            }
        }

        $this->render('updateVideoSlide', array(
            'model' => $model,
        ));
    }
    
	 public function actionUpdateDonorSlide($id) {    //UPDATE VIDEO
        $model = Slideshow::model()->findByPk($id);
		$preImage = $model->image;
        if (isset($_POST['Slideshow'])) {
            $model->attributes = $_POST['Slideshow'];
            $model->update_by = Yii::app()->user->userId;
            $model->update_time = date("Y-m-d H:i:s");
			$uploadedFile = CUploadedFile::getInstance($model, "image");
            if ($uploadedFile) {
                $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                $model->image = $fileName;
            }else  $model->image = $preImage;
			
            if ($model->save()) {
				
				  if ($uploadedFile) {
                    $uploadedFile->saveAs(UPLOAD . '/' . $fileName);
                    Yii::app()->easycode->deleteFile($preImage);
                }
                Yii::app()->user->setFlash('success', "AEPO Donor updated successfully");
                $this->redirect(array('adminDonorSlide'));
            } else {
                Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
            }
        }

        $this->render('updateDonorSlide', array(
            'model' => $model,
        ));
    }
    public function actionUpdateHomeSlide($id) {   //UPDATE HOME
        $this->pageTitle='Update Gallery & Banner';
        $model = Slideshow::model()->findByPk($id);
		$preImage = $model->image;

        if (isset($_POST['Slideshow'])) {
            $model->attributes = $_POST['Slideshow'];
            $uploadedFile = CUploadedFile::getInstance($model, "image");
            if ($uploadedFile) {
                $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                $model->image = $fileName;
            }else  $model->image = $preImage;
            if ($model->save()) {
				 if ($uploadedFile) {
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->sliderDir . $fileName);
                    Yii::app()->easycode->deleteFile($preImage);
                }

                Yii::app()->user->setFlash('success', "Slideshow updated successfully");
                $this->redirect(array('adminHomeSlide'));
            } else {
                Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
            }
        }

        $this->render('createHomeSlide', array(
            'model' => $model,
            'modelItems' => $modelItems,
        ));
    }


	
	 public function actionEnable() {
        if (Yii::app()->request->isAjaxRequest) {
            $data = array('msg' => 'error');
            if ($_POST['value']) {
                $orderIds = array();
                for ($i = 0; $i < count($_POST['value']); $i++):
                    if (Slideshow::model()->exists('id=:id and status="0"', array(':id' => $_POST['value'][$i]))) {
                        $slideInfo = Slideshow::model()->updateByPk($_POST['value'][$i], array('status' => '1'));
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
                    if (Slideshow::model()->exists('id=:id and status="1"', array(':id' => $_POST['value'][$i]))) {
                        $slideInfo = Slideshow::model()->updateByPk($_POST['value'][$i], array('status' => '0'));
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
	
	  public function actionDelete($id) {
	 
		 Yii::app()->easycode->deleteFile($this->loadModel($id)->image);
        
		$this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

	
	 public function loadModel($id) {
        $model = Slideshow::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested slideshow does not exist.');
        return $model;
    }
	
	


}
