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
                            
                            
                            <a class="btn btn-sm btn-primary" href="<?= $this->createUrl('//admin/products') ?>" title="Product List"> <i class="fa fa-list"></i> Product List</a>
                        </div>
                    </div>
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <?= $this->renderPartial('sidebar',false,true)?>
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
                                                <div class="col-md-12">
                                                     <table class="table table-bordered table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <th><?= $data['productOption']->getAttributeLabel('name')?></th>
                                                            <th><?= $data['productOption']->getAttributeLabel('sort_description')?></th>
                                                            <th><?= $data['productOption']->getAttributeLabel('image')?></th>
                                                            <th><?= $data['productOption']->getAttributeLabel('price')?></th>
                                                            <th style="display: none;"><?= $data['productOption']->getAttributeLabel('sort_order')?></th>
                                                            <th>&nbsp;</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="multi-row-container-2">
                  <?php
                        if (count($data['productsOptionData']) > 0) {
                            foreach ($data['productsOptionData'] as $preOption):
                                ?>
                                <tr class="multi-row-2">
                                                            <td>
                                                               <?php echo $form->textField($data['productOption'], 'name[]',array('class'=>'form-control','value'=>$preOption->name)); ?>
                                                            </td>
                                                            <td>
                                                               <?php echo $form->textArea($data['productOption'], 'sort_description[]',array('class'=>'form-control','value'=>$preOption->sort_description)); ?>
                                                            </td>
                                                            <td>
                                                               <?php echo $form->fileField($data['productOption'], 'image[]'); ?>
                                                               <?php echo Yii::app()->easycode->showImage($preOption->image, 120, 100,true,true,Yii::app()->params->productDir); ?><input type="hidden" name="ProductOption[id][]" value="<?php echo $preOption->id ?>">
                                                            </td>
                                                            
                                                            <td>
                                                               <?php echo $form->textField($data['productOption'], 'price[]',array('class'=>'form-control','value'=>$preOption->price)); ?>
                                                            </td>
                                                            <td style="display: none;">
                                                               <?php echo $form->textField($data['productOption'], 'sort_order[]',array('class'=>'form-control','value'=>$preOption->sort_order)); ?>
                                                            </td>
                                                            
                                                            <td class="text-left">
                                        <button data-original-title="Remove" type="button" data-toggle="tooltip" data-id="<?php echo $preOption->id ?>" title="Remove" class="btn btn-danger del-image-db"><i class="fa fa-minus-circle"></i></button>
                                    </td>
                                                        </tr>
                            <?php endforeach;}?>
                                                        <tr class="multi-row-2">
                                                            <td>
                                                               <?php echo $form->textField($data['productOption'], 'name[]',array('class'=>'form-control')); ?>
                                                            </td>
                                                            <td>
                                                               <?php echo $form->textArea($data['productOption'], 'sort_description[]',array('class'=>'form-control')); ?>
                                                            </td>
                                                            <td>
                                                               <?php echo $form->fileField($data['productOption'], 'image[]'); ?>
                                                            </td>
                                                            
                                                            <td>
                                                               <?php echo $form->textField($data['productOption'], 'price[]',array('class'=>'form-control')); ?>
                                                            </td>
                                                            <td style="display: none;">
                                                               <?php echo $form->textField($data['productOption'], 'sort_order[]',array('class'=>'form-control')); ?>
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
    $('body').on('click', '.del-image-db', function () {
        $this = $(this);
        if (confirm('Are you sure to detele?')) {
            var dataId = $this.attr('data-id');
            if (dataId.trim() !== '') {
                $.post("<?php echo Yii::app()->createUrl('//admin/products/delOption') ?>", {delId: dataId}, function (data) {
                    if (data == '1') {
                        $this.parent().parent().remove();
                    }
                });
            }
        }

    });
</script>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css');?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js', CClientScript::POS_END);?>




