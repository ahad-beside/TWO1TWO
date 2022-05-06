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

                        <div class="page-action-buttons">
                            <a class="btn btn-sm btn-primary" href="<?= $this->createUrl('//admin/menu') ?>" title="Client List"> <i class="fa fa-list"></i> Menu List</a>
                        </div>
                    </div>
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <?= $this->renderPartial('/settings/sidebar')?>
                            </div>
                            <div class="col-md-9">
                                <div class="portlet box">
                                    <div class="portlet-body form" style="display: block;">
                                        <?php
                                        $form = $this->beginWidget('CActiveForm', array(
                                            'id' => 'menu-form',
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
                                            <?php //echo $form->errorSummary($model)?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <?php echo $form->labelEx($model, 'name', array('class' => 'col-md-3 control-label')); ?>
                                                        <div class="col-md-6">
                                                            <?php echo $form->textField($model, 'name', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control input-sm', 'placeholder' => 'Name')); ?>
                                                            <?php echo $form->error($model, 'name'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php echo $form->labelEx($model, 'total_month', array('class' => 'col-md-3 control-label')); ?>
                                                        <div class="col-md-6">
                                                            <?php echo $form->textField($model, 'total_month', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control input-sm', 'placeholder' => 'Total Month in Number')); ?>
                                                            <?php echo $form->error($model, 'total_month'); ?>
                                                        </div>
                                                    </div>

                                                    
                                                    
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-6 col-md-12">
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

<style>
    .chosen-container-single .chosen-single{height: 34px!important; line-height: 34px!important;}
    .chosen-container-single .chosen-single div b{background-position: 0px 8px!important;}
</style>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/select2/css/select2.min.css'); ?>

<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/select2/css/select2-bootstrap.min.css'); ?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/global/scripts/components-select2.min.js', CClientScript::POS_END); ?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/select2/js/select2.full.min.js', CClientScript::POS_END); ?>

<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'); ?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js', CClientScript::POS_END); ?>
