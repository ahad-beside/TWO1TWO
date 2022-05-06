<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel {

    public $username;
    public $password;
    public $rememberMe;
    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('username, password', 'required'),
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
            // password needs to be authenticated
            array('password', 'authenticate'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'username'=>'Email',
            'rememberMe' => 'Remember me next time',
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params) {
        if (!$this->hasErrors()) {

            $user = User::model()->find("email=:username OR username=:username", array('username' => $this->username));
            if(count($user)<1){
                $this->addError('password', 'This email address is not registered. <a class="btn btn-primary btn-xs" href="'.Yii::app()->createUrl('//site/registration', array('user'=>  base64_encode($this->username))).'">Register Now</a>');
            }
            else if ($user->email_verified != 1) {
                $this->addError('password', 'Please verify your email address. <a class="btn btn-primary btn-xs" href="'.Yii::app()->createUrl('//site/resendEmailVerification', array('user'=>  base64_encode($user->email))).'">Resend Verification</a>');
            } else if ($user->active != 1) {
                $this->addError('password', 'Your are not active user, contact with us');
            } else {
                $this->_identity = new UserIdentity($this->username, $this->password);
                if (!$this->_identity->authenticate())
                    $this->addError('password', 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login() {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else
            return false;
    }
    
    
    

}
