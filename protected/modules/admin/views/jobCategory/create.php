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
                            
                            <a class="btn btn-sm btn-primary" href="<?= $this->createUrl('//admin/jobCategory/index') ?>" title="Category List"> <i class="fa fa-list"></i> Category List </a>
                        </div>
                    </div>
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <?php $this->renderPartial('/jobList/sidebar') ?>
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
                                                    <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('name'))); ?>
                                                    <?php echo $form->error($model, 'name'); ?>
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'status', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-3">
                                                    <?php echo $form->dropDownList($model, 'status', array('1' => 'Enable', '0' => 'Disable'), array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($model, 'status'); ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'sort_order', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-3">
                                                    <?php echo $form->textField($model, 'sort_order', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('sort_order'))); ?>
                                                    <?php echo $form->error($model, 'sort_order'); ?>
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
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/select2/css/select2.min.css'); ?>

<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/select2/css/select2-bootstrap.min.css'); ?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/global/scripts/components-select2.min.js', CClientScript::POS_END); ?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/select2/js/select2.full.min.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css');?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js', CClientScript::POS_END);?>