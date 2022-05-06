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
                            
                            <a class="btn btn-sm btn-primary" href="<?= $this->createUrl('//admin/eposterList/index') ?>" title="ePoster List"> <i class="fa fa-list"></i> Event List </a>
                        </div>
                    </div>
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <?php $this->renderPartial('/eposterList/sidebar') ?>
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
                                                <?php echo $form->labelEx($model, 'description', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-9">
                                                    <?php echo $form->textArea($model, 'description', array('class' => 'form-control','id'=>'editorDes')); ?>
                                                    <?php echo $form->error($model, 'description'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo $form->labelEx($model, 'expire_date', array('class' => 'col-md-3 control-label')); ?>
                                                <div class="col-md-3">
                                                    <?php 
                                                    $this->widget('ext.YiiDateTimePicker.jqueryDateTime', array(
                                                                    'model' => $model,
                                                                    'attribute' => 'expire_date',
                                                                    'options' => array(
                                                                        'format' => 'd-m-Y H:i',
                                                                        'timepicker' => true,
                                                                        'closeOnDateSelect' => false,
                                                                    ), //DateTimePicker options
                                                                    'htmlOptions' => array(
                                                                        'class' => 'form-control input-sm',
                                                                    ),
                                                                )); 
                                                    ?>
                                                    <?php echo $form->error($model, 'expire_date'); ?>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green">Submit</button>
                                                    <a href="<?=Yii::app()->createUrl('//admin/212poster')?>"><button type="button" class="btn btn-danger">cancel</button></a>
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
<script type="text/javascript">
    function chkRowAddMoreButton(deleteButton,thisButton){
    if(deleteButton.length > 1){
        deleteButton.hide();
        deleteButton.last().show();
    }else{
        deleteButton.show();
    }
}

function chkRowDellMoreButton(deleteButton){
    if(deleteButton.length>1){
        deleteButton.show();
    }else{
        deleteButton.hide();
    }
}
    $(document).on('click','.addMore-2',function(){
        var $row = $(this).parent().parent().clone().find('input:text').val('').end();
        $row.appendTo('.multi-row-container-2');
        chkRowAddMoreButton($('.addMore-2'),$(this));
        chkRowDellMoreButton($('.delRow-2'));
    });

    $(document).on('click','.delRow-2',function(){
        if(confirm('Are you sure to delete?'))
            $(this).parent().parent().remove();
        chkRowAddMoreButton($('.addMore-2'),$(this));
        chkRowDellMoreButton($('.delRow-2'));
        calGrandTotal();
    });

    $(document).ready(function(){
        chkRowAddMoreButton($('.addMore-2'),$(this));
        chkRowDellMoreButton($('.delRow-2'));
    });
    $('body').on('click', '.del-download-db', function () {
        $this = $(this);
        if (confirm('Are you sure to detele?')) {
            var dataId = $this.attr('data-id');
            if (dataId.trim() !== '') {
                $.post("<?php echo Yii::app()->createUrl('//admin/eposterList/delImage') ?>", {delId: dataId}, function (data) {
                    if (data == '1') {
                        $this.parent().parent().remove();
                    }
                });
            }
        }

    });
</script>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/select2/css/select2.min.css'); ?>

<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/select2/css/select2-bootstrap.min.css'); ?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/global/scripts/components-select2.min.js', CClientScript::POS_END); ?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/select2/js/select2.full.min.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css');?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js', CClientScript::POS_END);?>

<script> 
var roxyFileman = '<?php echo Yii::app()->request->baseUrl ?>/fileman/index.html'; 
$(function(){
   CKEDITOR.replace( 'editorDes',{filebrowserBrowseUrl:roxyFileman,
    filebrowserImageBrowseUrl:roxyFileman+'?type=image',
    removeDialogTabs: 'link:upload;image:upload'}); 
});
 </script>
<style>
	.xdsoft_timepicker{
		/*display: none!important;*/
	}
</style>