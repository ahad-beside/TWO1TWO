<?php
/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $active
 * @property string $email
 * @property string $full_name
 * @property string $last_name
 * @property integer $phone
 */
class User extends CActiveRecord {

    public $repeatpassword;
    public $fullname;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email, first_name, role', 'required'),
            array('email', 'email'),
            //array('email', 'unique', 'className' => 'User', 'attributeName' => 'email', 'enableClientValidation' => true, 'on' => 'insert,update'),

            array('email', 'unique', 'className' => 'User', 'attributeName' => 'email', 'enableClientValidation' => true, 'on' => 'insert,update'),
            array('password, username,repeatpassword', 'required', 'on' => 'insert'),
            array('repeatpassword', 'compare', 'compareAttribute' => 'password', 'on' => 'insert,update'),
            array('active, role', 'numerical', 'integerOnly' => true),
            array('username', 'length', 'max' => 40),
            array('password', 'length', 'max' => 255),
            array('email', 'length', 'max' => 50),
            array('username', 'unique'),
            array('phone,email_verified, verification_code, forgot_pass_code,date_of_registration,image,added_by,last_name,event_id', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, username, password,event_id, active, email, first_name.last_name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations(){
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'roles' => array(self::BELONGS_TO, 'Roles', 'role'),
            'event' => array(self::BELONGS_TO, 'EposterList', 'event_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'repeatpassword' => 'Repeat Password',
            'password' => 'Password',
            'active' => 'Approved',
            'email' => 'Email',
            'phone' => 'Mobile Number',
            'event_id'=>'Event',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        //$criteria->compare('id', $this->id);
        //$criteria->compare('username', $this->username, true);
        //$criteria->compare('password', $this->password, true);
        $criteria->compare('active', $this->active);
        $criteria->compare('email_verified', $this->email_verified);
        $criteria->compare('event_id', $this->event_id);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        //$criteria->compare('phone', $this->phone);
        $criteria->compare('role', $this->role);
        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>100,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getRoleName($id, $outpulCol) {
        $output = Roles::model()->findByPk((int) $id)->$outpulCol;
        return $output;
    }

    public function getUserName($id) {
        $data = self::model()->findByPk($id);
        return $data->first_name.' '.$data->last_name;
    }
    public function getUserInfo($id) {
        return $data = self::model()->findByPk($id);
    }

    public static function showLoginStatus() {
        if (Yii::app()->user->isGuest) {
            return 'guest-user';
        } else {
            return 'logged-user';
        }
    }
    public static function dropDown() {
        $data = array();
        $user = self::model()->findAll('role=3');
        foreach ($user as $name) {
                $data[$name->id] = $name->full_name;
        }
        return $data;
    }
    public function sendRegistrationSuccessMail($id) {
        $MailSettings = SiteSettings::model()->find();
        
        $model = self::model()->findByPk($id);
        $mail = new YiiMailer('new_user_registration', array('code' => $model->verification_code,'firstName'=>$model->first_name,'model'=>$model));
        $mail->setLayout('mail');
        
        $mail->setFrom($MailSettings->email, $MailSettings->name);
        //$mail->setFrom('info@99handicraft.com', 'Iam99');
        $mail->setSubject('New registration - '.$MailSettings->name);
        $mail->setTo($model->email);
        $mail->send();
    }
    
    public function sendVerificationSuccessMail($id) {
        $MailSettings = SiteSettings::model()->find();
        
        $model = self::model()->findByPk($id);
        $mail = new YiiMailer('verification_success', array('code' => $model->verification_code));
        $mail->setLayout('mail');
        
        $mail->setFrom($MailSettings->email, $MailSettings->name);
        //$mail->setFrom('info@99handicraft.com', 'Iam99');
        $mail->setSubject('Email Verification Completed');
        $mail->setTo($model->email);
        $mail->send();
    }

    public function sendSpeakerMail($id) {
        $MailSettings = SiteSettings::model()->find();
        
        $model = self::model()->findByPk($id);
        $mail = new YiiMailer('speaker_mail', array('model' => $model));
        $mail->setLayout('mail');
        
        $mail->setFrom($MailSettings->email, $MailSettings->name);
        $mail->setSubject('Account Login Information');
        $mail->setTo($model->email);
        $mail->send();
    }
    
    public function sendResendVerificationMail($id) {
        $MailSettings = SiteSettings::model()->find();
        
        $model = self::model()->findByPk($id);
        $mail = new YiiMailer('new_user_registration', array('code' => $model->verification_code,'model'=>$model));
        $mail->setLayout('mail');
        
        $mail->setFrom($MailSettings->email, $MailSettings->name);
        //$mail->setFrom('info@99handicraft.com', 'Iam99');
        $mail->setSubject('Resend Email Verification');
        $mail->setTo($model->email);
        $mail->send();
    }

    public function emailVerifiedSign($val){
        return ($val==1)?" <i class='fa fa-check-circle-o'></i> ":"";
    }
    
    public function customerListAsArray(){
        $allCust = User::model()->findAll('active=1 order by full_name');
        $customer = array();
        foreach($allCust as $cust):
            $customer[$cust->id] = $cust->full_name.' '.$cust->last_name .' - '. $cust->email;
        endforeach;
        return $customer;
    }
    
}
