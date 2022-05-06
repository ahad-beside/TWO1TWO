<?php
class SiteController extends Controller {
    public $layout = '//layouts/main';
    /**
     * Declares class-based actions.
    **/
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
                ),
            );
    }
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError(){
        $this->pageTitle = 'Error!!!';
        $this->layout = '//layouts/blank';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }
    public function actionIndex(){
        $this->pageTitle='Home -'.Yii::app()->name;
        $data['featuredProduct']=Products::model()->getFeaturedProducts();
        $data['slider']=Slideshow::model()->findAll("position='Home Slider' and status=1");
        $data['homeWelcome']=Page::model()->find("id=3");
        $data['homeFeature']=Page::model()->find("id=4");
        $data['homeIndustry']=Page::model()->find("id=5");
        $data['homemap']=Page::model()->find("id=8");
        $this->render('index',array(
            'data'=>$data
        ));
    }

    public function actionAlbum(){
        
        $this->layout = '//layouts/cart';
        $this->pageTitle='Gallery -'.Yii::app()->name;
        
        $data['album']=Album::model()->findAll("status=1");
        $this->render('album',array(
            'data'=>$data
        ));
    }
    public function actionGallery($id){
        $this->layout = '//layouts/cart';
    $this->pageTitle="Gallery";
        $data['gallery']=Gallery::model()->findAll("albumId=$id and status=1");
        $data['album']=Album::model()->find("id=$id")->name;
        $this->renderPartial('gallery',array(
            'data'=>$data,
        ));     
    }

    public function actionVerifySuccess() {
        $this->layout = '//layouts/login';
        $this->pageTitle = 'Verification Successful';
        $this->render('verifysuccess', array());
    }

    public function actionVerifyError() {
        $this->pageTitle = 'Verification Error';
        $this->render('verifyerror', array());
    }

    public function actionContactUs() {
        $this->layout='//layouts/login';
        $data['msg']='';
        $model = new ContactForm;
        $data['contactAddress']= Page::model()->find("id=6")->description;
        if (isset($_POST['ContactForm'])){
            //print_r($_POST['ContactForm']);exit;
            $model->attributes = $_POST['ContactForm'];
            $mail = new YiiMailer('withHtml', array('data' => $_POST['ContactForm']));
        $mail->setLayout('mail');
        
        $mail->setFrom($_POST['ContactForm']['email'], $_POST['ContactForm']['name']);
        $mail->setSubject($_POST['ContactForm']['subject']);
        $mail->setTo($this->adminMail);
        //$mail->setTo('anup@coder71.com');
        if($mail->send()){
            $data['msg']='Your message successfuly send. Authority will contact with you soon.';
        }else{
            $data['msg']='Sorry!!!';
        }
        }
        $this->render('contact', array('model' => $model,'data'=>$data));
    }
    
    /**
     * Displays the login page
     */
    public function actionLogin() {
        //echo Yii::app()->user->returnUrl;
        $this->pageTitle = 'Sign In with us - ' . Yii::app()->name;
//echo $_POST['ajax'];exit();
        $this->layout = '//layouts/login';
        if (Yii::app()->user->returnUrl == Yii::app()->request->baseUrl . '/admin/' || Yii::app()->user->returnUrl == Yii::app()->request->baseUrl . '/admin') {
            Yii::app()->theme = 'admin';
            $this->layout = '//layouts/login';
        }

        if ($_REQUEST['referalUrl'] && $_REQUEST['referalUrl'] != '')
            $referalUrl = $_REQUEST['referalUrl'];

        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            $errors = CActiveForm::validate($model);
            if ($errors != '[]') {
                echo $errors;
                Yii::app()->end();
            }
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            if ($_REQUEST['referalUrl'] && $_REQUEST['referalUrl'] != '')
            $referalUrl = $_REQUEST['referalUrl'];
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
                    echo CJSON::encode(array(
                        'authenticated' => true,
                        'redirectUrl' => Yii::app()->user->returnUrl,
                        "param" => "Any additional param"
                    ));
                    Yii::app()->end();
                }
                //echo Yii::app()->user->roles;exit;
                if ($_REQUEST['referalUrl'] && $_REQUEST['referalUrl'] != ''){
                    $this->redirect($_REQUEST['referalUrl']);
                }else{
                if(isset(Yii::app()->user->roles) && Yii::app()->user->roles=='Admin')
                    $this->redirect(Yii::app()->request->baseUrl . '/admin');
                elseif(isset(Yii::app()->user->roles) && Yii::app()->user->roles=='ePosterAdmin')
                    $this->redirect(Yii::app()->request->baseUrl . '/admin/212poster');
                elseif(isset(Yii::app()->user->roles) && Yii::app()->user->roles=='Speaker')
                    $this->redirect(Yii::app()->request->baseUrl . '/user/dashboard');
                else
                    $this->redirect(Yii::app()->user->returnUrl);
            }
            }
        }
        // display the login form
        $this->render('login', array('model' => $model,'referalUrl'=>$referalUrl));
        //$this->render('login_form', array('model' => $model));
    }
    public function actionUserLogin($id='') {
        //echo $id;
        $this->layout='//layouts/blank';
        
        $this->pageTitle = 'Login / Registration';
        $model = new LoginForm;
        $modelReg = new User;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            $errors = CActiveForm::validate($model);
            if ($errors != '[]') {
                echo $errors;
                Yii::app()->end();
            }
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            if(isset($_POST['id']) && $_POST['id']!='')
                $redirectUrl=Yii::app()->createUrl('//examInfo/view/'.$_POST['id']);
            else
                $redirectUrl=Yii::app()->user->returnUrl;
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
                    echo CJSON::encode(array(
                        'authenticated' => true,
                        'redirectUrl' => $redirectUrl,
                        "param" => "Any additional param"
                        ));
                    Yii::app()->end();
                }
                $this->redirect($redirectUrl);
            }
        }
        
        //$this->redirect(array('index'));
        $this->render('login',array('model'=>$model,'modelReg'=>$modelReg,'id'=>$id));
    }

    public function actionResendEmailVerification() {
        $this->pageTitle='Resend Verification';
        $this->layout = '//layouts/blank';
        $email = base64_decode(Yii::app()->easycode->safeReadFrom($_GET['user']));
        $model = User::model()->find('email=:mail', array(':mail' => $email));
        if (count($model) > 0):
            //User::model()->updateAll(array('email_verified' => 1), 'email=:email', array(':email' => $email));
            User::model()->sendResendVerificationMail($model->id);
        $this->render('resendEmailVerification', array('userName' => $model->first_name));
        else:
            throw new CHttpException(505, 'You are trying to inject something. We tracked your IP address.');
        endif;
    }
    
    public function actionRegistrationSuccessMailView(){
        $this->render('//mail/new_user_registration',array('code'=>'123'));
    }

    public function actionRegistration() {
        $this->layout='//layouts/login';
        $this->pageTitle = 'Registration - ' . Yii::app()->name;
        $model = new User;
        $modelForm=new LoginForm;
        $this->performAjaxValidation($model);
        if(isset($_POST['User'])){
        $model->attributes = $_POST['User'];
        $model->email = strtolower(trim($_POST['User']['email']));
        $model->username = strtolower(trim($_POST['User']['email']));
        $model->role =$_POST['userRole'];
        $model->password = Yii::app()->easycode->genPass(trim($_POST['User']['password']));
        $model->repeatpassword = Yii::app()->easycode->genPass(trim($_POST['User']['repeatpassword']));
        $model->verification_code = md5(Yii::app()->params->md5Key . $_POST['User']['email']);
        if($_POST['userRole']==4){
            $model->active=0;
        }
        // validate user input and redirect to the previous page if valid
        if ($model->validate()) {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
                echo CJSON::encode(array(
                    'authenticated' => true,
                    'redirectUrl' => Yii::app()->createUrl('//site/registrationSuccess',array('user'=>$model->email)),
                    "param" => "Any additional param"
                    ));
            }
            if ($model->save()) {
                $model->sendRegistrationSuccessMail($model->id);
                $this->redirect(array('//site/registrationSuccess','user'=>$model->email));
                Yii::app()->end();
            }
        } else {
                //print_r($model->getErrors()) ;exit();
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
                echo CJSON::encode(array(
                    'authenticated' => false,
                    'redirectUrl' => Yii::app()->user->returnUrl,
                    "param" => $model->getErrors(),
                    ));
                Yii::app()->end();
            }
        }
        }

        if (isset($_GET['user']) && $_GET['user'] != '')
            $model->email = base64_decode(Yii::app()->easycode->safeReadFrom($_GET['user']));

        $this->render('register', array('model' => $model));
        //$this->redirect(array('index'));
        // display the login form
        //$this->render('index', array('user' => $model));
    }

    public function actionRegistrationSuccess(){
        $this->layout='//layouts/login';
        $this->pageTitle='Registration';
        $this->render('registrationSuccess');
    }
    public function actionEmailverification() {
        //echo 'good';exit();
        if (isset($_GET['verification_code']) && $_GET['verification_code'] != '') {
            $code = Yii::app()->easycode->safeReadFrom($_GET['verification_code']);
            $data = User::model()->find('verification_code=:code', array(':code' => $code));
            if (count($data)>0) {
                if($data->email_verified=='1'){
                    Yii::app()->user->setFlash('success', "You are already verified");
                    $this->redirect(array('site/verifysuccess','role'=>$data->role));
                }
                
                $update = Yii::app()->db->createCommand()->update('user', array('email_verified' => 1), 'verification_code=:code1', array(':code1' => $code));                
                if ($update) {
                    User::model()->sendVerificationSuccessMail($data->id);
                    Yii::app()->user->setFlash('success', "You have successfully verified your acount");
                    $this->redirect(array('site/verifysuccess','role'=>$data->role));
                } else {
                    Yii::app()->user->setFlash('error', "Opps!!! Verification failed.");
                    $this->redirect(array('site/verifyerror'));
                }
            }else{
                Yii::app()->user->setFlash('error', "Incorrect Verification Number");
                $this->redirect(array('site/verifyerror'));
            }
        }
    }
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
    public function actionAdminLogout() {
        Yii::app()->user->logout();
        $this->redirect(array('//site/login'));
    }
}
