<?php
class EposterListController extends Controller
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
                'actions' => array('create', 'update', 'index', 'view', 'admin', 'delete','delImage','confirmedList','canceledList','getOrderCount','pending','confirmed','canceled','speakerList','createSpeaker','updateSpeaker','deleteSpeaker','eposterDocumentView','documentDelete'),
                'roles' => array('Admin'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'index', 'view', 'admin', 'delete','delImage','confirmedList','canceledList','getOrderCount','speakerList','createSpeaker','updateSpeaker','deleteSpeaker','eposterDocumentView','documentDelete','eposterDocumentUpload','updateDocument'),
                'roles' => array('ePosterAdmin'),
            ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    public function actionUpdateDocument($id){
        //$this->layout='//layouts/blank';
        $this->pageTitle = 'Update Document';
        $modelImage=EposterImage::model()->findByPk($id);
        $preImage=$modelImage->image;
        $preImage1=$modelImage->template_bg_image;
        $model=EposterList::model()->findByPk($modelImage->eposter_id);
        $this->performAjaxValidationSimcha($modelImage);
        if($_POST['EposterImage']){
                $modelImage->attributes = $_POST['EposterImage'];
                $modelImage->title=$_POST['EposterImage']['templateTitle'];
                $uploadedFile = CUploadedFile::getInstance($modelImage, "templateImage");
                if ($uploadedFile){
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $modelImage->image = $fileName;
                }else{
                    $modelImage->image = $preImage;
                }

                $uploadedFile1 = CUploadedFile::getInstance($modelImage, "template_bg_image");
                if ($uploadedFile1){
                    $fileName1 = Yii::app()->easycode->genFileName($uploadedFile1->extensionName);
                    $modelImage->template_bg_image = $fileName1;
                }else{
                    $modelImage->template_bg_image = $preImage1;
                }
                $modelImage->sort_order = Yii::app()->easycode->getLastSortingNumber('EposterImage', 'sort_order');
                //$modelImage->eposter_id = $id;
                $modelImage->date_time = date('Y-m-d H:i:s',strtotime($_POST['EposterImage']['templateDate']));
                //$modelImage->speaker_id = Yii::app()->user->userId;
                if($modelImage->save()){
                    if ($uploadedFile) {
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->ePosterDir . $fileName);
                    }

                    if ($uploadedFile1) {
                    $uploadedFile1->saveAs(UPLOAD . Yii::app()->params->ePosterDir . $fileName1);
                    }
                }
                else{
                    print_r($modelImage->getErrors());exit;
                }
            $this->redirect(array('eposterDocumentView','id'=>$modelImage->eposter_id));
        }
        $this->render('eposterDocumentUpdate', array('modelImage'=>$modelImage,'model'=>$model));
    }
	protected function performAjaxValidationSimcha($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='job-applied-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
	public function actionEposterDocumentUpload(){
        //$this->layout='//layouts/blank';
        $this->pageTitle = 'Upload Document';
        $modelImage=new EposterImage;
        $this->performAjaxValidationSimcha($modelImage);
        //$model=EposterList::model()->findByPk($id);
        if($_POST['EposterImage']){
            if($_POST['EposterImage']['document_type']=='Choose Template'){
                //print_r($_POST['EposterImage']);exit;
                $modelImage=new EposterImage;
                $modelImage->attributes = $_POST['EposterImage'];
                $uploadedFile = CUploadedFile::getInstance($modelImage, "templateImage");
                if ($uploadedFile) {
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $modelImage->image = $fileName;
                }else{
                    $modelImage->image = 'N/A';
                }
                $modelImage->title=$_POST['EposterImage']['templateTitle'];
                $modelImage->sort_order = Yii::app()->easycode->getLastSortingNumber('EposterImage', 'sort_order');
                //$modelImage->eposter_id = $id;
                $modelImage->date_time = date('Y-m-d H:i:s',strtotime($_POST['EposterImage']['templateDate']));
                //$modelImage->speaker_id = Yii::app()->user->userId;
                if($modelImage->save()){
                    if ($uploadedFile) {
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->ePosterDir . $fileName);
                    }
                }
                else{
                    print_r($modelImage->getErrors());exit;
                }
            }else{
            $this->saveProductsImage($id, $_POST['EposterImage']);
            }
            $this->redirect(array('eposterDocumentView','id'=>$_POST['EposterImage']['eposter_id']));
        }
        $this->render('eposterDocument', array('modelImage'=>$modelImage,'model'=>$model));
    }

	 public function actionDocumentDelete($id)
    {
        EposterImage::model()->findByPk($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }
	public function actionEposterDocumentView($id){
        //$this->layout='//layouts/blank';
        $this->pageTitle = '212poster Details';
        $modelEposter=EposterList::model()->findByPk($id);
        $model=new EposterImage('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['EposterImage']))
            $model->attributes=$_GET['EposterImage'];
            $model->eposter_id=$id;
            //$model->speaker_id=Yii::app()->user->userId;
        
        $this->render('eposterView', array(
            'modelEposter'=>$modelEposter,
            'model'=>$model
        ));
    }
	public function actionSpeakerList() {
        $this->pageTitle='Speaker List';
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];
        $model->role=5;
        $this->render('speakerList', array(
            'model' => $model,
        ));
    }

    public function actionCreateSpeaker() {
        $this->pageTitle='New Speaker';
        $model = new User;
        if(isset($_POST['User']))
    {
      $model->attributes=$_POST['User'];
        $model->email = strtolower(trim($_POST['User']['email']));
        $model->password = Yii::app()->easycode->genPass('212poster');
        $model->repeatpassword = Yii::app()->easycode->genPass('212poster');
        $model->active = 1;
        $model->email_verified = 1;
        $model->role = 5;
        $model->username = strtolower(trim($_POST['User']['email']));
        $model->parrent = Yii::app()->user->userId;
      if($model->save()){
      	User::model()->sendSpeakerMail($model->id);
        Yii::app()->user->setFlash('success', $this->pageTitle .' created successfully');
        $this->redirect(array('speakerList'));
      }
      
    }
        $this->render('createSpeaker', array(
            'model' => $model,
        ));
    }

    
    public function actionUpdateSpeaker($id) {
        $this->pageTitle='Update Speaker';
        $model = User::model()->findByPk($id);
        $this->performAjaxValidation($model);
        $prePass=$model->password;
        if(isset($_POST['User']))
    {
      $model->attributes=$_POST['User'];
        if(isset($_POST['User']['repeatpassword']) && $_POST['User']['repeatpassword']!=''){
        $model->password = Yii::app()->easycode->genPass(trim($_POST['User']['password']));
        $model->repeatpassword = Yii::app()->easycode->genPass(trim($_POST['User']['repeatpassword']));
    	}else{
        $model->password = $prePass;
        $model->repeatpassword = $prePass;
        }
      if($model->save()){
        Yii::app()->user->setFlash('success', $this->pageTitle .' created successfully');
        $this->redirect(array('speakerList'));
      }
      
    }
        $model->password='';
        $model->repeatpassword='';
        $this->render('createSpeaker', array(
            'model' => $model,
        ));
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

	public function actionPending(){
        if (Yii::app()->request->isAjaxRequest) {
            $data = array('msg' => 'error');
            if ($_POST['value']) {
                if (is_array($_POST['value'])) {
                    $totalOrders = array();
                    for ($i = 0; $i < sizeof($_POST['value']); $i++):
                            //update order status
                            EposterList::model()->updateByPk($_POST['value'][$i], array('status' => 0));
                            $totalOrders[] = $_POST['value'][$i];
                            //mail disabled
                    endfor;
                    $data = array('msg' => 'success', 'totalOrders' => count($totalOrders));
                }
            } else {

                $data = array('msg' => 'error');
            }

            echo json_encode($data);

            Yii::app()->end();
        }
    }

    public function actionConfirmed(){
        if (Yii::app()->request->isAjaxRequest) {
            $data = array('msg' => 'error');
            if ($_POST['value']) {
                if (is_array($_POST['value'])) {
                    $totalOrders = array();
                    for ($i = 0; $i < sizeof($_POST['value']); $i++):
                            //update order status
                            EposterList::model()->updateByPk($_POST['value'][$i], array('status' => 1));
                            $totalOrders[] = $_POST['value'][$i];
                            //mail disabled
                    endfor;
                    $data = array('msg' => 'success', 'totalOrders' => count($totalOrders));
                }
            } else {

                $data = array('msg' => 'error');
            }
            echo json_encode($data);
            Yii::app()->end();
        }
    }

    public function actionCanceled(){
        if (Yii::app()->request->isAjaxRequest) {
            $data = array('msg' => 'error');
            if ($_POST['value']) {
                if (is_array($_POST['value'])) {
                    $totalOrders = array();
                    for ($i = 0; $i < sizeof($_POST['value']); $i++):
                            //update order status
                            EposterList::model()->updateByPk($_POST['value'][$i], array('status' => 2));
                            $totalOrders[] = $_POST['value'][$i];
                            //mail disabled
                    endfor;
                    $data = array('msg' => 'success', 'totalOrders' => count($totalOrders));
                }
            } else {

                $data = array('msg' => 'error');
            }
            echo json_encode($data);
            Yii::app()->end();
        }
    }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->pageTitle='New Event';
		$model=new EposterList;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EposterList']))
		{
			$model->attributes=$_POST['EposterList'];
			$model->slug = Yii::app()->easycode->makeSlug('EposterList',$model->name);
			$model->expire_date=date('Y-m-d H:i:s',strtotime($_POST['EposterList']['expire_date']));
			$model->entry_by=Yii::app()->user->userId;
			$model->status=1;
			$model->user_id=Yii::app()->user->userId;
			if($model->save()){
				Yii::app()->user->setFlash('success', "Success: 212Poster created successfully");
				$this->redirect(array('index'));
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
		$this->pageTitle='Update Event';
		$model=$this->loadModel($id);
		$modelImage=new EposterImage;
		$predata=EposterList::model()->findByPk($id);
		$data['users']=User::model()->findAll("role=4");
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EposterList']))
		{
			$model->attributes=$_POST['EposterList'];
			$model->slug = Yii::app()->easycode->makeSlug('EposterList',$model->name);
			$model->expire_date=date('Y-m-d H:i:s',strtotime($_POST['EposterList']['expire_date']));
			$uploadedFile = CUploadedFile::getInstance($model, "image");
			if ($uploadedFile) {
                $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                $model->image = $fileName;
               $uploadedFile->saveAs(UPLOAD . Yii::app()->params->ePosterDir . $fileName);
             }else{
             	$model->image = $predata->image;
             }
			if($model->save()){
				$this->saveProductsImage($model->id, $_POST['EposterImage']);
				Yii::app()->user->setFlash('success', "Success: Eposter updated successfully");
				$this->redirect(array('index'));
			}else{
				Yii::app()->user->setFlash('warning', "Warning: Please check the form carefully for errors!");
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'modelImage'=>$modelImage,
			'data'=>$data,
		));
	}
	public function actionDelImage() {
        if (isset($_POST['delId']) && $_POST['delId'] != '') {
            $id = $_POST['delId'];
            $model = new EposterImage;
            $info = $model->findByPk($id);
            if (count($info) > 0) {
                $model->deleteByPk($id);
                Yii::app()->easycode->deleteFile($info->image,'ePoster');
                echo 1;
            }
        }
    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public static function saveProductsImage($productId, $values) {
        if (count($values) > 0) {
            for ($i = 0; $i < count($values['sort_order']); $i++):
                if (isset($values['id'][$i]) && $values['id'][$i] != '') {
                    $model = EposterImage::model()->findByPk($values['id'][$i]);
                    $preImage = $model->image;
                } else {
                    $model = new EposterImage;
                    $preImage = '';
                }

                $uploadedFile = CUploadedFile::getInstance($model, "image[{$i}]");
                if ($uploadedFile) {
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $model->image = $fileName;
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->ePosterDir . $fileName);
                    Yii::app()->easycode->deleteFile($preImage,'ePoster');
                } else {
                    $model->image = $preImage;
                }

                $model->eposter_id = $values['eposter_id'];
                $model->title = $values['title'][$i];
                $model->date_time = date('Y-m-d H:i:s',strtotime($values['date_time'][$i]));

                $model->speaker_id = $values['speaker_id'];
                $model->document_type = 'Upload Document';

                if ($values['sort_order'][$i] != '')
                    $model->sort_order = $values['sort_order'][$i];
                else
                    $model->sort_order = Yii::app()->easycode->getLastSortingNumber('EposterImage', 'sort_order');

                $model->save();
                //print_r($model->getErrors());exit;
            endfor;
        }
    }
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	public function actionDeleteSpeaker($id)
	{
		User::model()->findByPk($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->actionAdmin();
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->pageTitle='Event List';
		$model=new EposterList('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EposterList']))
			$model->attributes=$_GET['EposterList'];
		if(isset(Yii::app()->user->roles) && Yii::app()->user->roles=='ePosterAdmin')
			$model->user_id=Yii::app()->user->userId;
		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function actionGetOrderCount() {
		if(isset(Yii::app()->user->roles) && Yii::app()->user->roles=='ePosterAdmin')
			$condi=" and user_id=".Yii::app()->user->userId;
		else
			$condi='';
        $pendingCount = EposterList::model()->findAll("status=0".$condi);
        $totalPending = count($pendingCount);

        $confirmCount = EposterList::model()->findAll("status=1".$condi);
        $totalConfirm = count($confirmCount);

        $cancelCount = EposterList::model()->findAll("status=2".$condi);
        $totalCancel = count($cancelCount);

        echo CJSON::encode(array('pending' => $totalPending, 'confirmed' => $totalConfirm,'canceled' => $totalCancel));
        Yii::app()->end();
    }

	public function actionConfirmedList()
	{
		$this->pageTitle='212Poster List';
		$model=new EposterList('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EposterList']))
			$model->attributes=$_GET['EposterList'];
		if(isset(Yii::app()->user->roles) && Yii::app()->user->roles=='ePosterAdmin')
			$model->user_id=Yii::app()->user->userId;

		$model->status=1;
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionCanceledList()
	{
		$this->pageTitle='212Poster List';
		$model=new EposterList('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EposterList']))
			$model->attributes=$_GET['EposterList'];
		if(isset(Yii::app()->user->roles) && Yii::app()->user->roles=='ePosterAdmin')
			$model->user_id=Yii::app()->user->userId;

		$model->status=2;
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return JobList the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EposterList::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param JobList $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
