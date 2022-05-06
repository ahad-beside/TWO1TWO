<?php
    $settings = SiteSettings::model()->find();
if(isset(Yii::app()->session['siteLogo'])){
    $siteLogo = Yii::app()->session['siteLogo'];
}else{
    if(count($settings)>0)
        Yii::app()->session['siteName'] = $settings->name;
    
    if (count($settings)>0 && $settings->logo != ''):
        Yii::app()->session['siteLogo'] = Yii::app()->request->baseUrl.'/upload'.Yii::app()->params->logoDir.$settings->logo;
        $siteLogo = Yii::app()->session['siteLogo'];
    else:
        $siteLogo = Yii::app()->request->baseUrl.Yii::app()->params->DEAFULT_LOGO;
    endif;
}
?>
        <!-- BEGIN : LOGIN PAGE 5-2 -->
        <div class="user-login-5">
            <div class="row bs-reset">
                <div class="col-md-6 login-container bs-reset">
                    <img class="login-logo login-6" src="<?= $this->adminLogo?>" style="width: 170px;" />
                    <div class="login-content">
                        <h1><?= $this->siteName;?> Admin Login</h1>
                        <p> Please enter your email address and password to login. </p>
                        <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'action' => Yii::app()->createUrl('//site/login'),
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array('class' => 'login-form', 'role' => 'form')
    ));
    ?>
                            
                            <div class="row">
                                <div class="col-xs-6"> 
                                    <?php echo $form->textField($model, 'username', array('class' => 'form-control form-control-solid placeholder-no-fix form-group', 'autocomplete' => 'on', 'placeholder' => 'Email Address')); ?>
                                </div>
                                <?php echo $form->error($model, 'username'); ?>
                                <div class="col-xs-6">
                                    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control form-control-solid placeholder-no-fix form-group', 'autocomplete' => 'on', 'placeholder' => 'Password')); ?> </div>
                            </div>
                        <?php echo $form->error($model, 'password'); ?>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="rememberme mt-checkbox mt-checkbox-outline">
                                        <?php echo $form->checkBox($model, 'rememberMe'); ?> Remember me
                                        <span></span>
                                    </label>
                                </div>
                                <div class="col-sm-8 text-right">
                                    <div class="forgot-password">
                                        <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                                    </div>
                                    <?php echo CHtml::submitButton('Login', array('class' => 'btn green pull-right')); ?>
                                </div>
                            </div>
                        <?php $this->endWidget(); ?>
                        <!-- BEGIN FORGOT PASSWORD FORM -->
                        <form role="form" id="forgotpas_form" class="forget-form">
                            <h3>Forgot Password ?</h3>
                            <p> Enter your e-mail address below to reset your password. </p>
                            <div class="form-group">
                                <input type="email" placeholder="Enter registerd email address" id="frgt_paswd_email_id" class="form-control"> </div>
                            <div class="form-actions">
                                <button type="button" id="back-btn" class="btn blue btn-outline">Back</button>
                                <button id="forgotspin" class="btn btn-success" type="button" onclick="forgotPassword();">Recover Password</button>
                            </div>
                        </form>
                        <p style="margin-top: 10px;" id="msg_forgotpass"></p>
                        <!-- END FORGOT PASSWORD FORM -->
                    </div>
                    <div class="login-footer">
                        <div class="row bs-reset">
                            <div class="col-xs-7 bs-reset">
                                <div class="login-copyright text-left">
                                    <p>Copyright &copy; <?= date('Y') ?> <?= $this->siteName;?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 bs-reset">
                    <div class="login-bg">
                    	<img style="position: absolute; margin: 0px; padding: 0px; border: medium none; width: 100%; height: 100%; max-height: none; max-width: none; z-index: -999999; left: 0px; top: 0px;" src="<?= $this->adminLoginBanner?>">
                    </div>
                </div>
            </div>
        </div>