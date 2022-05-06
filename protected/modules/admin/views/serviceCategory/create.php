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
                            
                            <a class="btn btn-sm btn-primary" href="<?= $this->createUrl('//admin/category') ?>" title="Category List"> <i class="fa fa-list"></i> Product Category List</a>
                        </div>

                    </div>
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <div class="row">
                         <div class="col-md-2">
                                <?php $this->renderPartial('/products/sidebar');?>
                            </div>
                            <div class="col-md-10">
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i><?= $this->pageTitle?> </div>
                                    </div>
                                    <div class="portlet-body form" style="display: block;">
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
                                            <div class="col-md-4">
                                                <?php echo $form->labelEx($model, 'name', array('class' => '')); ?>
                                                     <?php echo $form->textField($model, 'name', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($model, 'name'); ?>
                                                
                                            </div>
                                            <div class="col-md-4">
                                                <?php echo $form->labelEx($model, 'image', array('class' => '')); ?>
                                                
                                                    <?php echo $form->fileField($model, 'image', array('class' => '')); ?>
    <span class="helpTxt"><?= Yii::app()->params->bestImgSize?></span>
    <?php echo Yii::app()->easycode->showImage($model->image, 120, 100,true,true,Yii::app()->params->serviceCategoryDir);?>
                                                    <?php echo $form->error($model, 'image'); ?>
                                            
                                            </div>

                                            <div class="col-md-4">
                                                <?php echo $form->labelEx($model, 'category_banner', array('class' => '')); ?>
                                                
                                                    <?php echo $form->fileField($model, 'category_banner', array('class' => '')); ?>
    <span class="helpTxt"><?= Yii::app()->params->bestImgSizeBanner?></span>
    <?php echo Yii::app()->easycode->showImage($model->category_banner, 120, 100,true,true,Yii::app()->params->serviceCategoryDir);?>
                                                    <?php echo $form->error($model, 'category_banner'); ?>
                                            
                                            </div>
                                         </div>

                                         <div class="clearfix">&nbsp;</div>
                                         <div class="form-group">
                                             <div class="col-md-12">
                                                <?php echo $form->labelEx($model, 'description', array('class' => '')); ?>
                                                    <?php echo $form->textArea($model, 'description', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($model, 'description'); ?>
                                         </div>
                                         </div>
                                            <div class="clearfix">&nbsp;</div>
                                            <div class="form-group">
                                                
                                         <div class="col-md-12">
                                                <?php echo $form->labelEx($model, 'metatag_title', array('class' => '')); ?>
                                                    <?php echo $form->textField($model, 'metatag_title', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
                                                    <?php echo $form->error($model, 'metatag_title'); ?>
                                         </div>
                                            </div>
                                            <div class="form-group">
                                            <div class="col-md-12">
                                                <?php echo $form->labelEx($model, 'metatag_description', array('class' => '')); ?>
                                               
                                                    <?php echo $form->textArea($model, 'metatag_description', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($model, 'metatag_description'); ?>
                                            </div>
                                            </div>
                                            <div class="clearfix">&nbsp;</div>
                                            <div class="form-group">
                                            <div class="col-md-12">
                                                <?php echo $form->labelEx($model, 'metatag_keywords', array('class' => '')); ?>
                                                
                                                    <?php echo $form->textField($model, 'metatag_keywords', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
                                                    <?php echo $form->error($model, 'metatag_keywords'); ?>
                                       
                                            </div>
                                            </div>
                                            
<div class="clearfix">&nbsp;</div>
                                            <div class="form-group">
                                              <div class="col-md-4">
                                                <?php echo $form->labelEx($model, 'parent', array('class' => '')); ?>
                                              
                                                    <?php echo $form->dropDownList($model, 'parent', Category::model()->dropDown(), array('class' => 'form-control select2', 'empty' => 'Select Parent')); ?>
                                                    <?php echo $form->error($model, 'parent'); ?>
                                               
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <?php echo $form->labelEx($model, 'sort_order', array('class' => '')); ?>
                                                
                                                   <?php echo $form->textField($model, 'sort_order', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($model, 'sort_order'); ?>
                                            
                                            </div>
                                            <div class="col-md-4">
                                                <?php echo $form->labelEx($model, 'status', array('class' => '')); ?>
                                               
                                                    <?php echo $form->dropdownList($model, 'status', Yii::app()->easycode->getStatusOptions(), array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($model, 'status'); ?>
                                              </div>
                                            </div>
                
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-6 col-md-6">
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

<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'); ?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js', CClientScript::POS_END); ?>


<style>
   .xdsoft_timepicker{
    display:none!important;
   } 
</style>

