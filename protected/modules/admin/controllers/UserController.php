<?php
class UserController extends Controller {

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
    public function accessRules(){

        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'admin', 'delete', 'sentVerificationLink', 'block', 'unLock', 'update', 'create', 'changePassword', 'createCustomer', 'userProfile', 'updateUserProfile','updateCustomer', 'createBillingInfo', 'createShippingInfo', 'getUserCount','approved','active','inActive'),
                //'actions' => array('changePassword','index','admin'),
                'roles' => array('Admin'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('changePassword','profileCreate','profileUpdate'),
                //'actions' => array('changePassword','index','admin'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionProfileCreate(){
        $this->pageTitle = 'Update Profile';
        $model=new Profile;
        $userModel=User::model()->findByPk(Yii::app()->user->userId);
        if($_POST['Profile']){
            $model->attributes=$_POST['Profile'];
            $model->user_id = Yii::app()->user->userId;
            $model->birth_date = date('Y-m-d',strtotime($_POST['Profile']['birth_date']));
            $model->first_name = $_POST['User']['first_name'];
            $model->last_name = $_POST['User']['last_name'];
            $uploadedFile = CUploadedFile::getInstance($model, "photo");
                if ($uploadedFile) {
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $model->photo = $fileName;
                }
            if($model->save()){
                User::model()->updateByPk(Yii::app()->user->userId,array('first_name'=>$_POST['User']['first_name'],'last_name'=>$_POST['User']['last_name']));
                if($uploadedFile)
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->userDir . $fileName);
                Yii::app()->user->setFlash('success', "Profile Updated successfully");
                $this->redirect(array('profileUpdate','id'=>$model->id));
            }else{
                print_r($model->getErrors());exit;
            }
        }
        $this->render('profile', array('model'=>$model,'userModel'=>$userModel));
    }

    public function actionProfileUpdate($id) {
        $this->pageTitle = 'Update Profile';
        $model=Profile::model()->findByPk($id);
        $preData=Profile::model()->findByPk($id);
        //$userModel=User::model()->findByPk(Yii::app()->user->userId);
        if($_POST['Profile']){
            $model->attributes=$_POST['Profile'];
            $model->user_id = Yii::app()->user->userId;
            $model->birth_date = date('Y-m-d',strtotime($_POST['Profile']['birth_date']));
            $uploadedFile = CUploadedFile::getInstance($model, "photo");
                if ($uploadedFile) {
                    $fileName = Yii::app()->easycode->genFileName($uploadedFile->extensionName);
                    $model->photo = $fileName;
                }else{
                    $model->photo = $preData->photo;
                }
            if($model->save()){
                User::model()->updateByPk(Yii::app()->user->userId,array('first_name'=>$_POST['Profile']['first_name'],'last_name'=>$_POST['Profile']['last_name']));
                if($uploadedFile){
                    $uploadedFile->saveAs(UPLOAD . Yii::app()->params->userDir . $fileName);
                    Yii::app()->easycode->deleteFile($preData->photo,'user');
                }
                Yii::app()->user->setFlash('success', "Profile Updated successfully");
                $this->redirect(array('profileUpdate','id'=>$model->id));
            }else{
                //print_r($model->getErrors());exit;
            }
        }
        $this->render('profile', array('model'=>$model,'userModel'=>$userModel));
    }

    public function actionChangePassword(){
        $this->pageTitle='Change Password';
        if ($_POST['Password']) {
            $post = $_POST['Password'];
            if ($post['current'] == '' or $post['new'] == '' or $post['re'] == '') {

                Yii::app()->user->setFlash('error', "All filed must be filled!");

                $this->redirect(array('changePassword'));
            }
            if ($post['new'] != $post['re']) {

                Yii::app()->user->setFlash('error', "New password and re-password not matched!");

                $this->redirect(array('changePassword'));
            }
            if (User::model()->exists('id=:id and password=:pass', array(':id' => Yii::app()->user->userId, ':pass' => md5($post['current'])))) {

                User::model()->updateByPk(Yii::app()->user->userId, array('password' => md5($post['new'])));

                Yii::app()->user->setFlash('success', "Password changed successfully");

                //$this->sendChangePasswordMail(Yii::app()->user->userId); //chng password mail

                $this->redirect(array('//admin/user/changePassword'));
            } else {

                Yii::app()->user->setFlash('error', "Invalid current password!");

                $this->redirect(array('changePassword'));
            }
        }
        $this->render('changePassword');
    }

    public function actionUnLock() {

        if (Yii::app()->request->isAjaxRequest) {

            $data = array('msg' => 'error');

            if ($_POST['value']) {

                $orderIds = array();

                for ($i = 0; $i < count($_POST['value']); $i++):

                    if (Profile::model()->exists('user_id=:id', array(':id' => $_POST['value'][$i]))) {

                        $userInfo = Profile::model()->updateAll(array('profile_lock' => 'No'),"user_id=".$_POST['value'][$i]);

                        $orderIds[] = $_POST['value'][$i];
                    }

                endfor;

                $data = 'success';
            } else {

                $data = 'error';
            }
        } else {

            $data = 'error';
        }

        echo $data;
    }

    public function actionBlock() {

        if (Yii::app()->request->isAjaxRequest) {

            $data = array('msg' => 'error');

            if ($_POST['value']) {

                $orderIds = array();

                for ($i = 0; $i < count($_POST['value']); $i++):

                    if (User::model()->exists('id=:id and active="1"', array(':id' => $_POST['value'][$i]))) {

                        $userInfo = User::model()->updateByPk($_POST['value'][$i], array('active' => '0'));

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

    public function ReSendVerificationMail($id) {

        $model = User::model()->findByPk($id);

        $mail = new YiiMailer('new_user_registration', array('code' => $model->verification_code));

        $mail->setLayout('mail');

        $mail->setFrom(Yii::app()->params->adminEmail, Yii::app()->params->adminName);

        $mail->setSubject('Re:Email Verification - ' . Yii::app()->params->adminName);

        $mail->setTo($model->email);

        $mail->send();
    }

    public function actionSentVerificationLink() {

        if (Yii::app()->request->isAjaxRequest) {

            $data = array('msg' => 'error');

            if ($_POST['value']) {

                $orderIds = array();

                for ($i = 0; $i < count($_POST['value']); $i++):

                    if (User::model()->exists('id=:id and email_verified="0"', array(':id' => $_POST['value'][$i]))) {

                        $this->ReSendVerificationMail($_POST['value'][$i]);

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

     * Displays a particular model.

     * @param integer $id the ID of the model to be displayed

     */
    public function actionView($id) {

        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionUserProfile($id) {

        try {
            $data['userInfo'] = Profile::model()->find('user_id='.$id);
            $this->render('viewApplicant', array(
                'data' => $data,
            ));
        } catch (Exception $e) {

            throw new CHttpException(404, $e->getMessage());
        }
    }
    public function actionUpdateUserProfile($id) {

        try {
            $data['userInfo'] = Profile::model()->find('user_id='.$id);
            $this->render('viewApplicant', array(
                'data' => $data,
            ));
        } catch (Exception $e) {

            throw new CHttpException(404, $e->getMessage());
        }
    }

    public function actionCreateCustomer() {

        $model = new User;



        if (isset($_POST['User'])) {

            $model->attributes = $_POST['User'];



            if (trim($_POST['User']['password']) == '' && trim($_POST['User']['repeatpassword']) == '') {

                $model->password = $model->password;

                $model->repeatpassword = $model->repeatpassword;
            }



            if (trim($_POST['User']['password']) != '')
                $model->password = Yii::app()->easycode->genPass(trim($_POST['User']['password']));



            if (trim($_POST['User']['repeatpassword']) != '')
                $model->repeatpassword = Yii::app()->easycode->genPass(trim($_POST['User']['repeatpassword']));



            $model->role = 2; //2 is customer role id

            $model->verification_code = Null;

            $model->email_verified = 1;



            if (Yii::app()->request->isAjaxRequest) {

                if ($model->save()) {

                    $res = array('res' => 'success', 'id' => $model->id, 'value' => $model->first_name . ' ' . $model->last_name . ' - ' . $model->email);

                    echo CJSON::encode($res);
                } else {

                    $res = array('res' => 'failed', 'errors' => $model->getErrors());

                    echo CJSON::encode($res);
                }

                Yii::app()->end();
            } else {

                if ($model->save()) {

                    Yii::app()->user->setFlash('success', "Customer created successfully");

                    $this->redirect(array('admin'));
                } else {

                    Yii::app()->user->setFlash('error', "Customer not saved");

                    $model->password = $_POST['User']['password'];

                    $model->repeatpassword = $_POST['User']['repeatpassword'];
                }
            }
        }



        //$model->password = '';



        $this->render('createCustomer', array(
            'model' => $model,
            'data' => $data,
        ));
    }
    public function actionActive(){
        if (Yii::app()->request->isAjaxRequest) {
            $data = array('msg' => 'error');
            if ($_POST['value']) {
                if (is_array($_POST['value'])){
                    $totalOrders = array();
                    for ($i = 0; $i < sizeof($_POST['value']); $i++):
                            //update order status
                            User::model()->updateByPk($_POST['value'][$i], array('active' => 1));
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
    public function actionInActive(){
        if (Yii::app()->request->isAjaxRequest) {
            $data = array('msg' => 'error');
            if ($_POST['value']) {
                if (is_array($_POST['value'])){
                    $totalOrders = array();
                    for ($i = 0; $i < sizeof($_POST['value']); $i++):
                            //update order status
                            User::model()->updateByPk($_POST['value'][$i], array('active' => 0));
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
    public function actionApproved(){
        if (Yii::app()->request->isAjaxRequest) {
            if ($_POST['value']) {
                    if (User::model()->exists('id=:id', array(':id' => $_POST['value']))) {
                        User::model()->updateByPk($_POST['value'], array('active' => 1));
                    }
                echo "success";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    }

    public function actionUpdateCustomer($id) {

        $model = User::model()->findByPk($id);

        $preData = User::model()->findByPk($id);



        if (isset($_POST['User'])) {

            $model->attributes = $_POST['User'];



            if (trim($_POST['User']['password']) == '' && trim($_POST['User']['repeatpassword']) == '') {

                $model->password = $preData->password;

                $model->repeatpassword = $preData->repeatpassword;
            } else {

                $model->password = Yii::app()->easycode->genPass(trim($_POST['User']['password']));

                $model->repeatpassword = Yii::app()->easycode->genPass(trim($_POST['User']['repeatpassword']));
            }

            if ($preData->role == 1)
                $model->role = $preData->role;
            else
                $model->role = 2; //2 is customer role id

            $model->verification_code = Null;

            $model->email_verified = 1;

            if ($model->save()) {

                Yii::app()->user->setFlash('success', "Customer updated successfully");

                $this->redirect(array('admin'));
            } else {

                Yii::app()->user->setFlash('error', "Customer not updated");

                $model->password = $_POST['User']['password'];

                $model->repeatpassword = $_POST['User']['repeatpassword'];
            }
        }



        if (!$_POST)
            $model->password = '';



        $this->render('updateCustomer', array(
            'model' => $model,
            'data' => $data,
        ));
    }

    /**

     * Creates a new model.

     * If creation is successful, the browser will be redirected to the 'view' page.

     */
    public function actionCreate() {

        $model = new User;
        $data['category']=Category::model()->findAll();
        // collect user input data
        if (isset($_POST['User'])) {
            if(sizeof($_POST['cat_id'])>0){}
            for($i=0;$i<=sizeof($_POST['cat_id']);$i++){
                if($_POST['cat_id'][$i]!=''){
                  $catId.= $_POST['cat_id'][$i].',';
                }
            }
            $catId= implode(',', $_POST['cat_id']);
        }else{
           $catId='';
        }
            $model->attributes = $_POST['User'];
            $model->email = strtolower(trim($_POST['User']['email']));
            $model->email_verified = 1;
            $model->prefered_cat=rtrim($catId,',');
            $model->password = Yii::app()->easycode->genPass(trim($_POST['User']['password']));
            $model->verification_code = md5(Yii::app()->params->md5Key . $_POST['User']['email']);
            // validate user input and redirect to the previous page if valid
            if ($model->validate()) {
                
                if ($model->save()) {
                    Yii::app()->user->setFlash('success', "Author Created successfully");
                $this->redirect(array('index','User[role]'=>'3','User[active]'=>'1'));
                }
            } 
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
        $this->pageTitle='Update User';
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
        $this->redirect(array('admin','User[role]'=>$model->role,'User[active]'=>$model->active));
      }
      
    }
        $model->password='';
        $model->repeatpassword='';
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

        $this->loadModel($id)->delete();



        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**

     * Lists all models.

     */
    public function actionIndex() {

        /* $dataProvider=new CActiveDataProvider('User');

          $this->render('index',array(

          'dataProvider'=>$dataProvider,

          )); */

        $this->actionAdmin();
    }

    /**

     * Manages all models.

     */
    public function actionAdmin() {
        $this->pageTitle='User List';
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];
        if (isset($_GET['User']['role']) && $_GET['User']['role']!=''){
            $model->role=$_GET['User']['role'];
        }else{
            $model->role=3;
        }
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionGetUserCount() {
        $resellerCount = User::model()->findAll("role=2");
        $totalReseller = count($resellerCount);
        
        $customerCount = User::model()->findAll("role=3");
        $totalCustomer = count($customerCount);

        $activeEventCount = User::model()->findAll("role=4 and active=1");
        $totalActiveEventCount = count($activeEventCount);

        $inActiveEventCount = User::model()->findAll("role=4 and active=0");
        $totalInActiveEventCount = count($inActiveEventCount);

//        $rejectCount = Post::model()->findAll("status=2");
//        $totalRejected = count($rejectCount);
//
//        $allCount = Post::model()->findAll();
//        $totalAll = count($allCount);

        echo CJSON::encode(array('reseller' => $totalReseller,'customer' => $totalCustomer , 'activeEvent' => $totalActiveEventCount, 'inActiveEvent' => $totalInActiveEventCount));
        Yii::app()->end();
    }

    /**

     * Returns the data model based on the primary key given in the GET variable.

     * If the data model is not found, an HTTP exception will be raised.

     * @param integer $id the ID of the model to be loaded

     * @return User the loaded model

     * @throws CHttpException

     */
    public function loadModel($id) {

        $model = User::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        return $model;
    }

    /**

     * Performs the AJAX validation.

     * @param User $model the model to be validated

     */
    protected function performAjaxValidation($model) {

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {

            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }

}
