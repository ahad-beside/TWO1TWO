<!-- Start Page Header -->
<div class="content-page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb"> <a href="#"><i class="icon-home"></i> Home</a> <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span> <span class="current">Login / Register</span>
          <h2 class="entry-title">Account</h2>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Page Header -->
<section id="content">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="login">
<div class="login-form-container">
<div class="login-text">
<h3>Creat a new account</h3>
<p>Please Register using account detail bellow.</p>
</div>

<?php
                  $model = new User;
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'user-form',
                                        'action' => Yii::app()->createUrl('//site/registration'),
                                        'enableClientValidation' => true,
                                        'clientOptions' => array(
                                            'validateOnSubmit' => true,
                                            'afterValidate' => 'js:function(form, data, hasError) {
                                                var tms = $("input[name=\'terms_condition\']");
                                                
                if (!hasError){ 
                    str = $("#user-form").serialize() + "&ajax=user-form";
                    $.ajax({
                        type: "POST",
                        url: "' . Yii::app()->createUrl('//site/registration') . '",
                        data: str,
                        dataType: "json",
                        beforeSend : function() {
                            $("#user").attr("disabled",true);
                        },
                        success: function(data, status) {
                            if(data.authenticated)
                            {
                                $(".registration-success").show();
                                $(".registration-form").hide();
                                //alert("Account created successfully. Please check your email and verify");
                                window.location = data.redirectUrl;
                            }
                            else
                            {
                                $.each(data.param, function(key, value) {
                                    var div = "#User_"+key+"_em_";
                                    $(div).text(value);
                                    $(div).show();
                                });
                                $("#user").attr("disabled",false);
                            }
                        }
                    });
                    return false;
                }
            }',
                                        ),
                                        'htmlOptions' => array('role' => 'form')
                                    ));
 
                                    ?>
                                    <div class="form-group">
<div class="controls">
<?php echo $form->textField($model, 'first_name', array('class' => 'form-control', 'placeholder' => 'Type your full name')); ?> <?php echo $form->error($model, 'first_name'); ?>
</div>
</div>
<div class="form-group">
<div class="controls">
<?php echo $form->textField($model, 'email', array('class' => 'form-control', 'placeholder' => 'Type your email')); ?> <?php echo $form->error($model, 'email'); ?>
</div>
</div>
<div class="form-group">
<div class="controls">
<?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Type your password')); ?> <?php echo $form->error($model, 'password'); ?>
</div>
</div>
<div class="form-group">
<div class="controls">
<?php echo $form->passwordField($model, 'repeatpassword', array('class' => 'form-control', 'placeholder' => 'Re-type your password')); ?> <?php echo $form->error($model, 'repeatpassword'); ?>
</div>
</div>
<div class="button-box">
<button type="submit" class="btn btn-common log-btn">Register</button>
</div>
<?php $this->endWidget(); ?>

</div>
</div>
      </div>
    </div>
  </div>
</section>