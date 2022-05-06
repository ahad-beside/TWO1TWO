<?php
class SettingsController extends Controller {
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
                'actions' => array('index','service','createService','updateService','deleteService','location','createLocation','updateLocation','deleteLocation','preLocation','createPreLocation','updatePreLocation','deletePreLocation','company','createCompany','updateCompany','deleteCompany','area','createArea','updateArea','deleteArea','driver','createDriver','updateDriver','deleteDriver','user','createUser','updateUser','deleteUser','carInfo','createcarInfo','updatecarInfo','deletecarInfo','getDriverInfo','searchHistory','deleteHistory','review','pending','confirmed','canceled','getOrderCount','reviewConfirmed','reviewCanceled'),
                'roles' => array('Admin'),
            ),
           
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    public function actionGetOrderCount() {
    if(isset(Yii::app()->user->roles) && Yii::app()->user->roles=='ePosterAdmin')
      $condi=" and user_id=".Yii::app()->user->userId;
    else
      $condi='';
        $pendingCount = Review::model()->findAll("status='Pending'".$condi);
        $totalPending = count($pendingCount);

        $confirmCount = Review::model()->findAll("status='Confirmed'".$condi);
        $totalConfirm = count($confirmCount);

        $cancelCount = Review::model()->findAll("status='Canceled'".$condi);
        $totalCancel = count($cancelCount);

        echo CJSON::encode(array('pending' => $totalPending, 'confirmed' => $totalConfirm,'canceled' => $totalCancel));
        Yii::app()->end();
    }
    public function actionPending(){
        if (Yii::app()->request->isAjaxRequest) {
            $data = array('msg' => 'error');
            if ($_POST['value']) {
                if (is_array($_POST['value'])) {
                    $totalOrders = array();
                    for ($i = 0; $i < sizeof($_POST['value']); $i++):
                            //update order status
                            Review::model()->updateByPk($_POST['value'][$i], array('status' => 'Pending'));
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
                            Review::model()->updateByPk($_POST['value'][$i], array('status' => 'Confirmed'));
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
                            Review::model()->updateByPk($_POST['value'][$i], array('status' => 'Canceled'));
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

    public function actionIndex() {
        $this->pageTitle = 'Settings';
        if (SiteSettings::model()->exists()) {
            $model = SiteSettings::model()->find();
            $preData = SiteSettings::model()->find();
        } else
            $model = new SiteSettings;

        if (isset($_POST['SiteSettings'])) {
            $model->attributes = $_POST['SiteSettings'];
            $model->entry_by = Yii::app()->user->userId;
            $model->entry_time = date('Y-m-d H:i:s');
            $model->update_by = Yii::app()->user->userId;
            $model->update_time = date('Y-m-d H:i:s');

            $uploadedFile = CUploadedFile::getInstance($model, "logo");
            if ($uploadedFile) {
                $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                $model->logo = $fileName;
            } else {
                $model->logo = $preData->logo;
            }

            $uploadedSiteLogo = CUploadedFile::getInstance($model, "site_logo");
            if ($uploadedSiteLogo) {
                $fileNameSiteLogo = Yii::app()->easycode->genFileName($uploadedSiteLogo->extensionName);
                $model->site_logo = $fileNameSiteLogo;
            } else {
                $model->site_logo = $preData->site_logo;
            }

            $uploadedLoginBanner= CUploadedFile::getInstance($model, "login_banner");
            if ($uploadedLoginBanner) {
                $fileNameLoginBanner = Yii::app()->easycode->genFileName($uploadedLoginBanner->extensionName);
                $model->login_banner= $fileNameLoginBanner;
            } else {
                $model->login_banner= $preData->login_banner;          }

            if ($model->save()) {
                if ($uploadedFile) {
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->logoDir . $fileName);
                    Yii::app()->session['siteLogo'] = Yii::app()->request->baseUrl . '/upload' . Yii::app()->params->logoDir . $fileName;
                    //delete pre logo
                    Yii::app()->easycode->deleteFile($preData->logo, Yii::app()->params->logoDir);
                }
                if ($uploadedSiteLogo) {
                    $uploadedSiteLogo->saveAs(UPLOAD . Yii::app()->params->logoDir . $fileNameSiteLogo);
                    //Yii::app()->session['siteLogo'] = Yii::app()->request->baseUrl . '/upload' . Yii::app()->params->logoDir . $fileNameSiteLogo;
                    //delete pre logo
                    Yii::app()->easycode->deleteFile($preData->site_logo, Yii::app()->params->logoDir);
                }
                if ($uploadedLoginBanner) {
                    $uploadedLoginBanner->saveAs(UPLOAD . Yii::app()->params->logoDir . $fileNameLoginBanner);
                    //Yii::app()->session['siteLogo'] = Yii::app()->request->baseUrl . '/upload' . Yii::app()->params->logoDir . $fileNameLoginBanner;
                    //delete pre logo
                    Yii::app()->easycode->deleteFile($preData->login_banner, Yii::app()->params->logoDir);
                }

                Yii::app()->session['siteName'] = $model->name;

                if ($model->isNewRecord)
                    Yii::app()->user->setFlash('success', $this->pageTitle . 'created successfully');
                else
                    Yii::app()->user->setFlash('success', $this->pageTitle . 'updated successfully');
                $this->redirect(array('index'));
            } else {
                Yii::app()->user->setFlash('warning','warning');
            }
        }

        $this->render('siteSettings', array(
            'model' => $model,
        ));
    }

  //User section start
  public function actionUser()
  {
    $this->pageTitle = 'User Information';
    $model=new User('search');
    $model->unsetAttributes();  // clear any default values
    if(isset($_GET['User']))
      $model->attributes=$_GET['User'];

    $this->render('user',array(
      'model'=>$model,
    ));
  }
  public function actionReview()
  {
    $this->pageTitle = 'Customer Review';
    $model=new Review('search');
    $model->unsetAttributes();  // clear any default values
    if(isset($_GET['Review']))
      $model->attributes=$_GET['Review'];
    $model->status='Pending';

    $this->render('review',array(
      'model'=>$model,
    ));
  }
  public function actionReviewConfirmed()
  {
    $this->pageTitle = 'Customer Review';
    $model=new Review('search');
    $model->unsetAttributes();  // clear any default values
    if(isset($_GET['Review']))
      $model->attributes=$_GET['Review'];
    $model->status='Confirmed';

    $this->render('review',array(
      'model'=>$model,
    ));
  }
  public function actionReviewCanceled()
  {
    $this->pageTitle = 'Customer Review';
    $model=new Review('search');
    $model->unsetAttributes();  // clear any default values
    if(isset($_GET['Review']))
      $model->attributes=$_GET['Review'];
    $model->status='Canceled';

    $this->render('review',array(
      'model'=>$model,
    ));
  }
  public function actionCreateUser()
  {
    $this->pageTitle = 'New User';
    $model=new User;
    $data['driver']=Driver::model()->findAll("id!=0 order by first_name asc");
    // Uncomment the following line if AJAX validation is needed
    $this->performAjaxValidation($model);

    if(isset($_POST['User']))
    {
      $model->attributes=$_POST['User'];
        $model->email = strtolower(trim($_POST['User']['email']));
        $model->password = Yii::app()->easycode->genPass(trim($_POST['User']['password']));
        $model->repeatpassword = Yii::app()->easycode->genPass(trim($_POST['User']['repeatpassword']));
        $model->active = 1;
        $model->menu_access = CJSON::encode($_POST['User']['menu_access']);
        $model->email_verified = 1;
        $uploadedFile = CUploadedFile::getInstance($model, "image");
            if ($uploadedFile) {
                $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                $model->image = $fileName;
            }
      if($model->save()){
        if ($uploadedFile) {
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->userDir . $fileName);
                }
        Yii::app()->user->setFlash('success', $this->pageTitle .' created successfully');
        $this->redirect(array('user'));
      }
      
    }

    $this->render('createUser',array(
      'model'=>$model,
      'data'=>$data,
    ));
  }
  public function actionUpdateUser($id)
  {
    $this->pageTitle = 'Update User';
    $model=User::model()->findByPk($id);
    $preData=User::model()->findByPk($id);

    // Uncomment the following line if AJAX validation is needed
    $this->performAjaxValidation($model);

    if(isset($_POST['User']))
    {
      $model->attributes=$_POST['User'];
      $uploadedFile = CUploadedFile::getInstance($model, "image");
            if ($uploadedFile){
                $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                $model->image = $fileName;
            }else{
              $model->image = $preData->image;
      }
      if($_POST['User']['role']=='3'){
        $model->driver_id=$_POST['User']['driver_id'];
      }else{
        $model->driver_id=0;
      }
      if($_POST['User']['password']!=''){
      $model->password = Yii::app()->easycode->genPass(trim($_POST['User']['password']));
        $model->repeatpassword = Yii::app()->easycode->genPass(trim($_POST['User']['repeatpassword']));
      }
      $model->menu_access = CJSON::encode($_POST['User']['menu_access']);
      if($model->save()){
        if ($uploadedFile) {
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->userDir . $fileName);
                }
      Yii::app()->user->setFlash('success', $this->pageTitle .' updated successfully');
        $this->redirect(array('user'));
      }else{
        Yii::app()->user->setFlash('warning', 'warning');
      }
    }

    $this->render('createUser',array(
      'model'=>$model,
    ));
  }
  public function actionDeleteUser($id)
  {
    User::model()->findByPk($id)->delete();

    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
    if(!isset($_GET['ajax']))
      $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
  }
  //User section end
  protected function performAjaxValidation($model){ 
    if(isset($_POST['ajax']) && $_POST['ajax']==='settings-form') {
    echo CActiveForm::validate($model); Yii::app()->end(); 
    }
  }
}
