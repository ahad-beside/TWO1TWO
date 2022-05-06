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
                                            <h3 class="form-section">Menu Information</h3>
                                            <?php //echo $form->errorSummary($model)?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?php echo $form->labelEx($model, 'name', array('class' => 'col-md-3 control-label')); ?>
                                                        <div class="col-md-9">
                                                            <?php echo $form->textField($model, 'name', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control input-sm', 'placeholder' => 'Name')); ?>
                                                            <?php echo $form->error($model, 'name'); ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                         <?php echo $form->labelEx($model, 'position', array('class' => 'col-md-3 control-label')); ?>
                                                        <div class="col-md-9">
                                                           
                    <?php echo $form->dropDownList($model, 'position', CHtml::listData(Position::model()->findAll(), name, name), array('class' => 'form-control input-sm select2','empty'=>'Choose One')); ?>
                    <?php echo $form->error($model, 'position'); ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                           <?php echo $form->labelEx($model, 'type', array('class' => 'col-md-3 control-label')); ?>
                                                        <div class="col-md-9">
                    <?php echo $form->dropDownList($model, 'type', array('category' => 'Category','page' => 'Page','custom' => 'Custom'), array('class' => 'form-control select2', 'onChange' => 'showParticular($(this).val());')); ?>
                    <?php echo $form->error($model, 'type'); ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group category_box">
                                                        <label for="category" class="col-md-3 control-label">Category</label>
                                                        <div class="col-md-9">
                    <?php echo CHtml::dropDownList('category', $model->additional_id, Category::model()->dropDown(), array('class' => 'form-control chosen-select')); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group page_box" style="display: none;">
                                                           <label class="col-md-3 control-label" for="page">Page</label>
                                                        <div class="col-md-9">
                    <?php echo CHtml::dropDownList('page', $model->additional_id, Page::model()->dropDown(), array('class' => 'form-control chosen-select')); ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group custom_box" style="display: none;">
                                                           <label class="col-md-3 control-label" for="page">Custom</label>
                                                        <div class="col-md-9">
                    <?php echo CHtml::textField('custom', $model->additional_id, array('class' => 'form-control')); ?>
                                                        </div>
                                                    </div>
                                                    <?php echo $form->hiddenField($model, 'additional_id', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'additional_id'); ?>
                                                    <div class="form-group">
                                                        <?php echo $form->labelEx($model, 'sort_order', array('class' => 'col-md-3 control-label')); ?>
                                                        <div class="col-md-9">
                                                            <?php echo $form->textField($model, 'sort_order', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'sort_order'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php echo $form->labelEx($model, 'status', array('class' => 'col-md-3 control-label')); ?>
                                                        <div class="col-md-9">
                                                            <?php echo $form->dropDownList($model, 'status', array('1'=>'Enable','0'=>'Disable'), array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'status'); ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <?php echo $form->labelEx($model, 'parent', array('class' => 'col-md-3 control-label')); ?>
                                                        <div class="col-md-9">
                                                           <?php echo $form->dropDownList($model, 'parent', Menu::model()->dropDown(), array('class' => 'form-control input-sm select2','empty'=>'Choose One')); ?>
                                                            <?php echo $form->error($model, 'parent'); ?>
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
<script>
	function showParticular(val) {
        if (val == 'page') {
            $('.page_box').show();
            $('#page_chosen').css('width', '100%');
            $('.category_box').hide();
            $('.custom_box').hide();
            setAdditionalVal($('.page_box').find('select option:first').val());
        } else if(val == 'category'){
            $('.page_box').hide();
            $('.custom_box').hide();
            $('.category_box').show();
            $('#category_chosen').css('width', '100%');
            setAdditionalVal($('.category_box').find('select option:first').val());
        }else{
            $('.custom_box').show();
            $('.category_box').hide();
            $('.page_box').hide();
            setAdditionalVal($('.page_box').find('input[type="text"]').val());
        }
    }
    
    $('#category').change(function () {
        setAdditionalVal($(this).val());
    });
    $('#page').change(function () {
        setAdditionalVal($(this).val());
    });
    
    $('#custom').change(function () {
        setAdditionalVal($(this).val());
    });

    function setAdditionalVal(val) {
        $('#Menu_additional_id').val(val);
    }
    
    <?php 
    if($model->isNewRecord){?>
    $(document).ready(function () {
        setAdditionalVal($('.category_box').find('select option:first').val());
    });
    <?php }else{?>
    $(document).ready(function () {
        $('#Menu_type').trigger('change');
        $('#Menu_additional_id').val($('#custom').val());
    });
    <?php }?>
</script>

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
