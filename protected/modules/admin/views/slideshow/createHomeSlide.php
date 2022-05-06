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
                            
                            
                            <?= CHtml::link('<i class="fa fa-bars"></i> Slider', $this->createUrl('//admin/slideshow/index/'),array('class'=>'btn btn-sm btn-primary')) ?>
                        </div>
                    </div>
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <?= $this->renderPartial('/settings/sidebar',false,true)?>
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
                                        //echo $form->hiddenField($model, 'position', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('position'),'value'=>$_GET['imagePosition']));
                                        ?>
                                        <div class="form-body">
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'title', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->textField($model, 'title', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('title'))); ?>
                                                    <?php echo $form->error($model, 'title'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'button_label', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->textField($model, 'button_label', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('button_label'))); ?>
                                                    <?php echo $form->error($model, 'button_label'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'link', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->textField($model, 'link', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('link'))); ?>
                                                    <?php echo $form->error($model, 'link'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'image', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
              <?php echo $form->fileField($model, 'image'); ?>
              <?php echo $form->error($model, 'image'); ?>
              <img style="width: 120px;height: 100px;" src="<?php echo Yii::app()->easycode->showOriginalImage($model->image,'/slider/'); ?>">
              <span style="color: red;">Note: Please select high quality image</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'position', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-3">
                                                    <?php echo $form->dropDownList($model, 'position', array('Home Slider' => 'Home Slider', 'Other Slider' => 'Other Slider'), array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($model, 'position'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'sort_order', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-3">
                                                    <?php echo $form->textField($model, 'sort_order', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control')); ?>
                                                    <?php echo $form->error($model, 'sort_order'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'status', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-3">
                                                    <?php echo $form->dropDownList($model, 'status', array('1' => 'Enable', '0' => 'Disable'), array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($model, 'status'); ?>
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




