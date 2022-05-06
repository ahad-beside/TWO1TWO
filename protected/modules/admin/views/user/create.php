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
                            
                            <a class="btn btn-sm btn-primary" href="<?= $this->createUrl('//admin/eposterList/speakerList') ?>" title="Speaker List"> <i class="fa fa-list"></i> Speaker List </a>
                        </div>
                    </div>
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <?php $this->renderPartial('sidebar') ?>
                            </div>
                            <div class="col-md-10">
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-plus-circle"></i><?= $this->pageTitle?> </div>
                                    </div>
                                    <div class="portlet-body" style="display: block;">
                                        <?php
                                        $form = $this->beginWidget('CActiveForm', array(
                                            'id' => 'user-form',
                                            //'action'=>$this->createUrl('//settings#genarel'),
                                            'enableAjaxValidation' => false,
                                            'enableClientValidation' => true,
                                            'clientOptions' => array(
                                                'validateOnSubmit' => true,
                                                'validateOnChange' => false,
                                            ),
                                            'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
                                        ));
                                        ?>
                                        <div class="form-body">
                                            
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'first_name', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->textField($model, 'first_name',  array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('first_name'))); ?>
                                                    <?php echo $form->error($model, 'first_name'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'last_name', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->textField($model, 'last_name',  array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('last_name'))); ?>
                                                    <?php echo $form->error($model, 'last_name'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'email', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->textField($model, 'email',  array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('email'))); ?>
                                                    <?php echo $form->error($model, 'email'); ?>
                                                </div>
                                            </div>
                                            <?php if(!$model->isNewRecord){?>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'password', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->passwordField($model, 'password',  array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('password'))); ?>
                                                    <?php echo $form->error($model, 'password'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'repeatpassword', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->passwordField($model, 'repeatpassword',  array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('repeatpassword'))); ?>
                                                    <?php echo $form->error($model, 'repeatpassword'); ?>
                                                    <span style="color: green;">Note: Please leave blank Password and Repeat Password field if you don't want to change password </span>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green"><?php if($model->isNewRecord){?>Create & Send Login Information
                                                        <?php } else{?>
                                                        Update
                                                        <?php } ?>
                                                    </button>
                                                   <a href="<?= Yii::app()->createUrl('//admin/eposterList/speakerList')?>"><button type="button" class="btn btn-danger">Cancel
                                                    </button></a>
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
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/select2/css/select2.min.css'); ?>

<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/select2/css/select2-bootstrap.min.css'); ?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/global/scripts/components-select2.min.js', CClientScript::POS_END); ?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/select2/js/select2.full.min.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css');?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js', CClientScript::POS_END);?>

<style>
    .xdsoft_timepicker{
        display: none!important;
    }
</style>