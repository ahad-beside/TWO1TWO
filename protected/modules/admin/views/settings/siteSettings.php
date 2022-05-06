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
                                            'enableAjaxValidation' => false,
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
                                                <?php echo $form->labelEx($model, 'name', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->textField($model, 'name', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('name'))); ?>
                                                    <?php echo $form->error($model, 'name'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'email', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->textField($model, 'email', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('email'))); ?>
                                                    <?php echo $form->error($model, 'email'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'phone', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->textField($model, 'phone', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('phone'))); ?>
                                                    <?php echo $form->error($model, 'phone'); ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'paypal_id', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->textField($model, 'paypal_id', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('paypal_id'))); ?>
                                                    <?php echo $form->error($model, 'paypal_id'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'paypal_mode', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->dropDownList($model, 'paypal_mode', array('Live'=>'Live','Sandbox'=>'Sandbox'), array('class' => 'form-control','prompt'=>'Select Any')); ?>
                                                    <?php echo $form->error($model, 'paypal_mode'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'address', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->textArea($model, 'address', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('address'))); ?>
                                                    <?php echo $form->error($model, 'address'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'logo', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php //echo $form->fileField($model, 'logo', array('class' => '', 'placeholder'=>Yii::t(Yii::app()->request->cookies['lang']->value, 'label_SiteSettings_logo'))); ?>

                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <span class="btn green btn-file">
                                                            <span class="fileinput-new"> Select File </span>
                                                            <span class="fileinput-exists"> Change File </span>
                                                            <input value="" name="logo" type="hidden">
                                                            <input name="SiteSettings[logo]" type="file"> 
                                                        </span>
                                                        <span class="fileinput-filename"></span> &nbsp;
                                                        <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                                    </div>
                                                    <?php echo $form->error($model, 'logo'); ?>
                                                    <?php if ($model->logo != ''): ?> 
                                                        <p><br><img src="<?php Yii::app()->easycode->showOriginalImage($model->logo, Yii::app()->params->logoDir) ?>" class="img-responsive" width="100"/></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'site_logo', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php //echo $form->fileField($model, 'logo', array('class' => '', 'placeholder'=>Yii::t(Yii::app()->request->cookies['lang']->value, 'label_SiteSettings_logo'))); ?>

                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <span class="btn green btn-file">
                                                            <span class="fileinput-new"> Select File </span>
                                                            <span class="fileinput-exists"> Change File </span>
                                                            <input value="" name="site_logo" type="hidden">
                                                            <input name="SiteSettings[site_logo]" type="file"> 
                                                        </span>
                                                        <span class="fileinput-filename"></span> &nbsp;
                                                        <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                                    </div>
                                                    <?php echo $form->error($model, 'site_logo'); ?>
                                                    <?php if ($model->site_logo != ''): ?> 
                                                        <p><br><img src="<?php Yii::app()->easycode->showOriginalImage($model->site_logo, Yii::app()->params->logoDir) ?>" class="img-responsive" width="100"/></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'login_banner', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php //echo $form->fileField($model, 'logo', array('class' => '', 'placeholder'=>Yii::t(Yii::app()->request->cookies['lang']->value, 'label_SiteSettings_logo'))); ?>

                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <span class="btn green btn-file">
                                                            <span class="fileinput-new"> Select File </span>
                                                            <span class="fileinput-exists"> Change File </span>
                                                            <input value="" name="login_banner" type="hidden">
                                                            <input name="SiteSettings[login_banner]" type="file"> 
                                                        </span>
                                                        <span class="fileinput-filename"></span> &nbsp;
                                                        <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                                    </div>
                                                    <?php echo $form->error($model, 'login_banner'); ?>
                                                    <?php if ($model->login_banner != ''): ?> 
                                                        <p><br><img src="<?php Yii::app()->easycode->showOriginalImage($model->login_banner, Yii::app()->params->logoDir) ?>" class="img-responsive" width="100"/></p>
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
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css');?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js', CClientScript::POS_END);?>




