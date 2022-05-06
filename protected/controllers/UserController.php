<?php
class UserController extends Controller {

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
                'actions' => array('index', 'changePassword','changePasswordSuccess', 'personalInfo','dashboard','educationInfo','experienceInfo','appliedList','transactionHistory','complain','getDistrict','getCity','profileView','getUserCategory','profileConfirmed','profileCreate','profileUpdate','review'),
                'users' => array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('eposterDocumentUpload','eposterDocumentView','documentDelete','delImage','updateDocument'),
                'roles' => array('Speaker'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index','forgotPasswordLink','forgotPassword','forgotPasswordSuccess','checkExistenceOfUser'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
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
    public function actionDocumentDelete($id)
    {
        EposterImage::model()->findByPk($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }
    public function actionReview(){
        $model=new Review;
        if($_POST['Review']){
           $model->attributes=$_POST['Review'];
           $model->user_id=Yii::app()->user->userId;
           $model->entry_date=date('Y-m-d');
           $model->status='Pending';
           if($model->save()){
            echo 1;
           }else{
            echo 0;
           }

        }
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
            $model->speaker_id=Yii::app()->user->userId;
        
        $this->render('eposterView', array(
            'modelEposter'=>$modelEposter,
            'model'=>$model
        ));
    }
    protected function performAjaxValidationSimcha($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='job-applied-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionEposterDocumentUpload($id){
        //$this->layout='//layouts/blank';
        $this->pageTitle = 'Upload Document';
        $modelImage=new EposterImage;
        $this->performAjaxValidationSimcha($modelImage);
        $model=EposterList::model()->findByPk($id);
        if($_POST['EposterImage']){
            if($_POST['EposterImage']['document_type']=='Choose Template'){
                //EposterImage::model()->deleteAll("eposter_id=".$id." and speaker_id=".Yii::app()->user->userId);
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
                $uploadedFile1 = CUploadedFile::getInstance($modelImage, "template_bg_image");
                if ($uploadedFile1) {
                    $fileName1 = Yii::app()->easycode->genFileName($uploadedFile1->extensionName);
                    $modelImage->template_bg_image = $fileName1;
                }
                $modelImage->title=$_POST['EposterImage']['templateTitle'];
                $modelImage->sort_order = Yii::app()->easycode->getLastSortingNumber('EposterImage', 'sort_order');
                $modelImage->eposter_id = $id;
                $modelImage->date_time = date('Y-m-d H:i:s',strtotime($_POST['EposterImage']['templateDate']));
                $modelImage->speaker_id = Yii::app()->user->userId;
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
            }else{
            $this->saveProductsImage($id, $_POST['EposterImage']);
            }
            $this->redirect(array('eposterDocumentView','id'=>$id));
        }
        $this->render('eposterDocument', array('modelImage'=>$modelImage,'model'=>$model));
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
                $modelImage->speaker_id = Yii::app()->user->userId;
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

                $model->eposter_id = $productId;
                $model->title = $values['title'][$i];
                $model->date_time = date('Y-m-d H:i:s',strtotime($values['date_time'][$i]));

                $model->speaker_id = Yii::app()->user->userId;
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

    public function actionDashboard() {
        $this->pageTitle = 'Dashboard';
        $model='';
        if(isset(Yii::app()->user->role) && Yii::app()->user->role!='Speaker'){
        $data['pendingOrder']=Order::model()->count("user_id_fk=".Yii::app()->user->userId." and status='Pending'");
        $data['confirmedOrder']=Order::model()->count("user_id_fk=".Yii::app()->user->userId." and status='Confirmed'");
        $data['canceledOrder']=Order::model()->count("user_id_fk=".Yii::app()->user->userId." and status='Canceled'");
        $data['shippedOrder']=Order::model()->count("user_id_fk=".Yii::app()->user->userId." and status='Shipped'");
        }else{
        $model=new EposterList('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['EposterList']))
            $model->attributes=$_GET['EposterList'];
            $model->user_id=User::model()->findByPk(Yii::app()->user->userId)->parrent;
            $model->id=User::model()->findByPk(Yii::app()->user->userId)->event_id;
        }
        $this->render('dashboard', array('data'=>$data,'model'=>$model));
    
    }
    public function actionProfileCreate(){
        $this->pageTitle = 'New Profile';
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
    public function actionCheckExistenceOfUser(){
        if ($_POST['email']) {
            $email = Yii::app()->easycode->safeReadFrom($_POST['email']);
            if (User::model()->exists('email=:email', array(':email' => $email))) {
                echo 0;
            } else {
                echo 1;
            }
        }
    }

    public function actionProfileView(){
        $this->pageTitle='Personal Details';
        $data['personal']=Profile::model()->find("user_id=".Yii::app()->user->userId);
        $modelEdu=new Education('search');
        $modelEdu->unsetAttributes();  // clear any default values
        if(isset($_GET['Education']))
            $modelEdu->attributes=$_GET['Education'];
            $modelEdu->user_id=Yii::app()->user->userId;
        $modelExp=new Experience('search');
        $modelExp->unsetAttributes();  // clear any default values
        if(isset($_GET['Experience']))
            $modelExp->attributes=$_GET['Experience'];
            $modelExp->user_id=Yii::app()->user->userId;
        //print_r($data['personal']);
        $this->render('personalDetails',array('data'=>$data,'modelEdu'=>$modelEdu,'modelExp'=>$modelExp));
    }
 
    public function sendForgotPasswordMail($email) {
        $model = User::model()->find('email=:email',array(':email'=>$email));
        if ($model->email != '') {
            if($model->first_name=='' && $model->last_name==''){
                $name = 'User';
            }else{
                $name = $model->first_name.' '.$model->last_name;
            }
            
            $MailSettings = SiteSettings::model()->find();
            
            $mail = new YiiMailer('forgotPassword', array('name' => $name, 'email'=>md5(Yii::app()->params->md5Key.$model->email)));
            $mail->setLayout('mail');
            $mail->setFrom($MailSettings->email, $MailSettings->name);
            $mail->setSubject('Forgot Password');
            $mail->setTo($model->email);
            $mail->send();
        }
    }
    
    public function actionForgotPasswordLink(){
        if(isset($_POST['email'])){
            $data = array();
            $email = trim($_POST['email']);
            if(User::model()->exists('email=:email',array(':email'=>$email))){
                User::model()->updateAll(array('forgot_pass_code'=>md5(Yii::app()->params->md5Key.$email)),'email=:email',array(':email'=>$email));
                $this->sendForgotPasswordMail($email);
                $data['msg']='Please check your mail to get forgot password link.';
                $data['status']=1;
            }else{
                $data['msg']='Your have given wrong email address';
                $data['status']=0;
            }
            echo json_encode($data);
        }
    }

    public function actionForgotPasswordSuccess(){
        $this->pageTitle =  'Forgot Password';
        $this->render('changePasswordSuccess');
    }

    public function actionForgotPassword(){
        
        $this->pageTitle =  'Forgot Password ';
        if (isset($_POST['Password'])) {
            $post = $_POST['Password'];

            if ($post['new'] == '' or $post['re'] == '') {
                Yii::app()->user->setFlash('error', "All filed must be filled!");
                $this->redirect(array('forgotPassword','link'=> $post['forgot_pass_code']));
            }
            if ($post['new'] != $post['re']) {
                Yii::app()->user->setFlash('error', "New password and re-password not matched!");
                $this->redirect(array('forgotPassword','link'=> $post['forgot_pass_code']));
            }
            if (User::model()->exists('forgot_pass_code=:link', array(':link' => $post['forgot_pass_code']))) {
                $data = User::model()->find('forgot_pass_code=:link', array(':link' => $post['forgot_pass_code']));
                User::model()->updateByPk($data->id,array('password' => md5($post['new']),'forgot_pass_code'=>''));
                Yii::app()->user->setFlash('success', "Password changed successfully");
               // $this->sendChangePasswordMail($data->id);//chng password mail
                //$this->redirect(array('//site/login'));
                $this->redirect(array('forgotPasswordSuccess'));
            } else {
                Yii::app()->user->setFlash('error', "Invalid Request!");
                $this->redirect(array('forgotPassword','link'=> $post['forgot_pass_code']));
            }
        }
        $this->render('forgotPassword');
    }
    public function sendChangePasswordMail($id) {
        $model = User::model()->findByPk($id);
        if ($model->email != '') {
            
            if($model->first_name=='' && $model->last_name==''){
                $name = 'User';
            }else{
                $name = $model->first_name.' '.$model->last_name;
            }
            
            $MailSettings = SiteSettings::model()->find();
            
            $mail = new YiiMailer('changePassword', array('name' => $name, 'email'=>$model->email));
            $mail->setLayout('mail');
            $mail->setFrom($MailSettings->email, $MailSettings->name);
            $mail->setSubject('Change Password');
            $mail->setTo($model->email);
            $mail->send();
        }
    }
    public function actionChangePasswordSuccess(){
        $this->pageTitle =  'Change Password';
        $this->render('changePasswordSuccess');
    }

    public function actionChangePassword(){
        $this->pageTitle =  'Change Password';
        if (isset($_POST['Password'])) {
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
                //$this->sendChangePasswordMail(Yii::app()->user->userId);//chng password mail
                $this->redirect(array('changePasswordSuccess'));
                //$this->render('changePasswordSuccess');
            } else {
                Yii::app()->user->setFlash('error', "Invalid current password!");
                $this->redirect(array('changePassword'));
            }
        }
        $this->render('changePassword');
    }
}