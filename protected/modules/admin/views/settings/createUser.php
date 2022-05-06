<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <!-- BEGIN PAGE HEAD-->
                <div class="page-head">
                    <div class="container">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1><?= $this->pageTitle ?></h1>
                        </div>
                        <!-- END PAGE TITLE -->
                        <div class="page-action-buttons"><!-- 
                            <a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="javascript:$('.grid-search-portlet').toggle('slow')" title="Search"> <i class="fa fa-search"></i> Search</a> -->
                            
                            <a class="btn btn-sm btn-primary" href="<?= $this->createUrl('//admin/settings/user') ?>" title="User List"> <i class="fa fa-list"></i> User List</a>
                        </div>

                    </div>
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <?= $this->renderPartial('sidebar',false,true)?>
                            </div>
                            <div class="col-md-9">
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i><?= $this->pageTitle?> </div>
                                    </div>
                                    <div class="portlet-body" style="display: block;">
                                        <?php
                                        $form = $this->beginWidget('CActiveForm', array(
                                            'id' => 'settings-form',
                                            //'action'=>$this->createUrl('//settings#genarel'),
                                            'enableAjaxValidation' => true,
                                            'enableClientValidation' => true,
                                            'clientOptions' => array(
                                                'validateOnSubmit' => true,
                                                'validateOnChange' => true,
                                            ),
                                            'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
                                        ));
                                        ?>
                                        <div class="form-body">
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'role', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->dropDownList($model, 'role', CHtml::listData(Roles::model()->findAll(),'id','name'),array('class' => 'form-control', 'prompt' => 'Select Any')); ?>
                                                    <?php echo $form->error($model, 'role'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group driverShow" <?php if(isset($model->role) && $model->role==3){?><?php } else{?> style="display: none;"<?php } ?>>
                                                <?php echo $form->labelEx($model, 'driver_id', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->dropDownList($model, 'driver_id', CHtml::listData(Driver::model()->findAll("id!=0 order by first_name asc"),'id','first_name'),array('class' => 'form-control', 'prompt' => 'Select Any')); ?>
                                                    <?php echo $form->error($model, 'driver_id'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'full_name', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->textField($model, 'full_name', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($model, 'full_name'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'email', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('email'))); ?>
                                                    <?php echo $form->error($model, 'email'); ?>
                                                </div>
                                            </div>
                                            <?php if($model->isNewRecord){?>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'username', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('username'))); ?>
                                                    <?php echo $form->error($model, 'username'); ?>
                                                </div>
                                            </div>

                                            <?php }?>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'password', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('password'))); ?>
                                                    <?php echo $form->error($model, 'password'); ?>
                                                    <?php if(!$model->isNewRecord):?>
                                                                <em>(Note: Keep password blank for unchanged.)</em>
                                                            <?php endif;?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'repeatpassword', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->passwordField($model, 'repeatpassword', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('repeatpassword'))); ?>
                                                    <?php echo $form->error($model, 'repeatpassword'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'phone', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->textField($model, 'phone', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('phone'))); ?>
                                                    <?php echo $form->error($model, 'phone'); ?>
                                                </div>
                                            </div>
                                            <?php if($model->isNewRecord){?>
                                            <div class="form-group">
                                             <?php echo $form->labelEx($model, 'menu_access', array('class' => 'col-md-3 control-label')); ?>
                                            <div style="padding-left: 15px!important;" class="mt-checkbox-inline col-md-9">
                                                <label class="mt-checkbox">
                                                    <input id="inlineCheckbox1" value="Booking Info" type="checkbox" name="User[menu_access][]"> Booking Info
                                                    <span></span>
                                                </label>
                                                <label class="mt-checkbox">
                                                    <input id="inlineCheckbox1" value="Schedule" type="checkbox" name="User[menu_access][]"> Schedule
                                                    <span></span>
                                                </label>
                                                <label class="mt-checkbox">
                                                    <input id="inlineCheckbox1" value="Service Price" type="checkbox" name="User[menu_access][]"> Service Price
                                                    <span></span>
                                                </label>
                                                <label class="mt-checkbox">
                                                    <input id="inlineCheckbox1" value="Review" type="checkbox" name="User[menu_access][]"> Review
                                                    <span></span>
                                                </label>
                                            </div>
                                          </div>
                                          <?php }else{?>
                                          <div class="form-group">
                                             <?php echo $form->labelEx($model, 'menu_access', array('class' => 'col-md-3 control-label'));
                                             if(!empty($model->menu_access)) 
                                                $menuAccess= CJSON::decode($model->menu_access);
                                            else
                                                $menuAccess=array();
                                             ?>
                                            <div style="padding-left: 15px!important;" class="mt-checkbox-inline col-md-9">
                                                <label class="mt-checkbox">
                                                    <input<?php if(in_array('Booking Info', $menuAccess)){?> checked='checked'<?php } ?> id="inlineCheckbox1" value="Booking Info" type="checkbox" name="User[menu_access][]"> Booking Info
                                                    <span></span>
                                                </label>
                                                <label class="mt-checkbox">
                                                    <input<?php if(in_array('Schedule', $menuAccess)){?> checked='checked'<?php } ?> id="inlineCheckbox1" value="Schedule" type="checkbox" name="User[menu_access][]"> Schedule
                                                    <span></span>
                                                </label>
                                                <label class="mt-checkbox">
                                                    <input<?php if(in_array('Service Price', $menuAccess)){?> checked='checked'<?php } ?> id="inlineCheckbox1" value="Service Price" type="checkbox" name="User[menu_access][]"> Service Price
                                                    <span></span>
                                                </label>
                                                <label class="mt-checkbox">
                                                    <input<?php if(in_array('Review', $menuAccess)){?> checked='checked'<?php } ?> id="inlineCheckbox1" value="Review" type="checkbox" name="User[menu_access][]"> Review
                                                    <span></span>
                                                </label>
                                            </div>
                                          </div>
                                          <?php } ?>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'image', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php //echo $form->fileField($model, 'logo', array('class' => '', 'placeholder'=>Yii::t(Yii::app()->request->cookies['lang']->value, 'label_SiteSettings_logo'))); ?>

                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <span class="btn green btn-file">
                                                            <span class="fileinput-new"> Select File </span>
                                                            <span class="fileinput-exists"> Change File </span>
                                                            <input value="" name="image" type="hidden">
                                                            <input name="User[image]" type="file"> 
                                                        </span>
                                                        <span class="fileinput-filename"></span> &nbsp;
                                                        <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                                    </div>
                                                    <?php echo $form->error($model, 'image'); ?>
                                                    <?php if ($model->image != ''): ?> 
                                                        <p><br><img src="<?php Yii::app()->easycode->showOriginalImage($model->image, Yii::app()->params->userDir) ?>" class="img-responsive" width="100"/></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $this->endWidget(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PAGE CONTENT BODY -->
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->

        </div>
        <!-- END CONTAINER -->
    </div>
</div>
<script>
    $(document).on('change','#User_role',function(){
        var role=$(this).val();
        if(role=='3'){
            $('.driverShow').show();
        }
        else{
            $('.driverShow').hide();
            $('#User_full_name').val('');
            $('#User_email').val('');
            $('#User_phone').val('');
            $('#User_driver_id').val('');
        }
    });
    $(document).on('change','#User_driver_id',function(){
        var driverId=$(this).val();
        $.post('<?=Yii::app()->createUrl('//admin/settings/getDriverInfo')?>',{driverId:driverId},function(data){
            data = JSON.parse(data);
        $('#User_full_name').val(data.fullName);
        $('#User_email').val(data.email);
        $('#User_phone').val(data.mobile);
        });

    });
</script>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css');?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js', CClientScript::POS_END);?>