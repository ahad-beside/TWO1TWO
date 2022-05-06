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
                            
                            
                            <?= CHtml::link('<i class="fa fa-bars"></i> Album List', $this->createUrl('//admin/album/index/'),array('class'=>'btn btn-sm btn-primary')) ?>
                        </div>
                    </div>
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <?= $this->renderPartial('/album/sidebar',false,true)?>
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
                                            'id' => 'gallery-form',
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
                                                <div class="col-md-4">
                                                    <?php echo $form->labelEx($model, 'albumId', array('class' => '')); ?>
                                                    <?php echo $form->dropDownList($model, 'albumId', CHtml::listData(Album::model()->findAll(), id, name), array('empty'=>'Select any', 'class' => 'form-control')); ?>
                                                    <?php echo $form->error($model, 'albumId'); ?>                                                
                                                </div>
                                                <div class="col-md-3" style="margin-top:25px">

                                                            <a class="btn btn-sm green" data-toggle="modal" href="#responsive" title="Add new Client"><i class="fa fa-plus"></i></a>
                                                        </div>

                                                <div class="col-md-4">
                                                   
                                                </div>
                                            </div>

                                            <div class="clearfix">&nbsp;</div>

                                            <div class="form-group">
                                                <div class="col-md-12">
                                                     <table class="table table-bordered table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <th><?= $model->getAttributeLabel('image')?></th>
                                                            <th><?= $model->getAttributeLabel('status')?></th>
                                                            <th>&nbsp;</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="multi-row-container-2">
                                                        <tr class="multi-row-2">
                                                            <td>
                                                               <?php echo $form->fileField($model, 'image[]'); ?>
                                                            </td>
                                                            <td>
                                                                 <?php echo $form->dropDownList($model, 'status[]', array('1' => 'Enable', '0' => 'Disable'), array('class' => 'form-control')); ?>
                                                            </td>
                                                            
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-info addMore-2" title="Add more"><i class="fa fa-plus"></i></button>
                                                                <button type="button" class="btn btn-sm btn-danger delRow-2" title="Delete"><i class="fa fa-times"></i></button>
                                                            </td>
                                                        </tr>
                                                       
                                                    </tbody>
                                                </table>
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-9">
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
<div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true" data-target="#Gallery_albumId">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">New Album</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
                    <?php
                    $albumModel = new Album;
                    $this->renderPartial('/album/albumCreateAjax', array(
                        'model' => $albumModel
                    ))
                    ?>
                </div>
            </div>
        </div>
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
</script>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css');?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js', CClientScript::POS_END);?>




