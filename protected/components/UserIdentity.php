<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;
    public $username;
    public $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $user = User::model()->find("(email=:username or username=:username) and active='1' and email_verified='1'", array('username' => $this->username));

        //$salt = substr('0e70678cbf6a213cf5224ad9e882fbcb02fb73f7', 0, 10);
        //$salt = substr($user->password, 0, 10);
        //$db_password = $salt . substr(sha1($salt . $this->password), 0, -10);

        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if ($user->password !== md5($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->_id = $user->id;
            $this->setState('userId', $user->id);
            $this->setState('userName', $user->username);
            $this->setState('userEmail', $user->email);
            $this->setState('userFirstname', $user->first_name);
            $this->setState('userLastname', $user->last_name);
            $this->setState('roles', User::model()->getRoleName($user->role, 'name')); //get user role
            $this->setState('roleId', User::model()->getRoleName($user->role, 'id')); //get user role
            $_SESSION['is_admin_logged']=true;
            $_SESSION['fileroles']=User::model()->getRoleName($user->role, 'name');
            if($_SESSION['fileroles']=='Speaker'){
                if (!file_exists(MEDIAFILE  . "/speaker".$user->id)){
                            mkdir(MEDIAFILE  . "/speaker".$user->id);
                }
                $_SESSION['folderName']="/speaker".$user->id;
            }elseif($_SESSION['fileroles']=='ePosterAdmin'){
                if (!file_exists(MEDIAFILE  . "/eManager".$user->id)){
                            mkdir(MEDIAFILE  . "/eManager".$user->id);
                }
                $_SESSION['folderName']="/eManager".$user->id;
            }
            $this->errorCode = self::ERROR_NONE;
            
            
        }
        return !$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }

}
