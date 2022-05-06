
<div class="page-wrapper-row full-height full-width">
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
                                <?php $this->renderPartial('sidebar');?>
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
            'id' => 'products-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
    ?>
<div class="page-wrapper-row full-height">
	<div class="form-body">
    	<div class="">
    <div class="">
        <div id="exTab2" class=""> 
        
<ul class="nav nav-tabs">
            <li class="active">
        <a href="#1" data-toggle="tab">General</a>
            </li>
            <li><a href="#2" data-toggle="tab">Image</a>
            </li>
            <li><a href="#4" data-toggle="tab">Download</a>
            </li>
            <li><a href="#3" data-toggle="tab">SEO</a>
            </li>
        </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="1">
          <div class="row">

                                        <div class="">
            <!--end row--><div class="form-group">
                                            <div class="col-md-12">
                                                <?php echo $form->labelEx($model, 'name', array('class' => '')); ?>
                                                     <?php echo $form->textField($model, 'name', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($model, 'name'); ?>
                                                
                                            </div>
                                            </div>
                                         <div class="clearfix">&nbsp;</div>
                                         <div class="form-group">
                                             <div class="col-md-12">
                                                <?php echo CHtml::label('Categories', 'categories'); ?>
                                                   <?php echo CHtml::dropDownList('categories[]', $data['selectedCategory'], Category::model()->dropDown(), array('class' => 'form-control select2', 'multiple' => 'multiple', 'empty' => 'Select Any')); ?>
                                                    <?php echo $form->error($model, 'Categories'); ?>
                                         </div>
                                         </div>
                                            <div class="clearfix">&nbsp;</div>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <?php echo $form->labelEx($model, 'model', array('class' => '')); ?>
                                                
                                                    <?php echo $form->textField($model, 'model', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($model, 'model'); ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?php echo $form->labelEx($model, 'sku', array('class' => '')); ?>
                                                     <?php echo $form->textField($model, 'sku', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($model, 'sku'); ?>
                                                
                                            </div>

                                            <div class="col-md-4">
                                                <?php echo $form->labelEx($model, 'quantity', array('class' => '')); ?>
                                                     <?php echo $form->textField($model, 'quantity', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($model, 'quantity'); ?>
                                                
                                            </div>
                                         </div>
                                         <div class="clearfix">&nbsp;</div>

                                         <div class="form-group">
                                              <div class="col-md-3">
                                                <?php echo $form->labelEx($model, 'price', array('class' => '')); ?>
                                              
                                                    <?php echo $form->textField($model, 'price', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($model, 'price'); ?>
                                               
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <?php echo $form->labelEx($model, 'reseller_price', array('class' => '')); ?>
                                                
                                                   <?php echo $form->textField($model, 'reseller_price', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($model, 'reseller_price'); ?>
                                            
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <?php echo $form->labelEx($model, 'featured'); ?>
                        <?php echo $form->dropDownList($model, 'featured', array('0' => 'No','1' => 'Yes'), array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'featured'); ?>
                                            
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <?php echo $form->labelEx($model, 'image', array('class' => '')); ?>
                                                
                                                    <?php echo $form->fileField($model, 'image', array('class' => '')); ?>
    <span class="helpTxt"><?= Yii::app()->params->bestImgSizeBanner?></span>
    <img style="width: 120px;height: 100px;" src="<?php echo Yii::app()->easycode->showOriginalImage($model->image,'/product/'); ?>">
                                                    <?php echo $form->error($model, 'image'); ?>
                                            
                                            </div>
                                            </div>
                                         <div class="clearfix">&nbsp;</div>
                                         <div class="form-group">
                                             <div class="col-md-12">
                                                <?php echo $form->labelEx($model, 'quick_view', array('class' => '')); ?>
                                                    <?php echo $form->textArea($model, 'quick_view', array('class' => 'form-control')); ?>
                                                    <?php echo $form->error($model, 'quick_view'); ?>
                                         </div>
                                         </div>
                                         <div class="clearfix">&nbsp;</div>
                                         <div class="form-group">
                                             <div class="col-md-12">
                                                <?php echo $form->labelEx($model, 'description', array('class' => '')); ?>
                                                    <?php echo $form->textArea($model, 'description', array('class' => 'form-control','id'=>'editorDes')); ?>
                                                    <?php echo $form->error($model, 'description'); ?>
                                         </div>
                                         </div>
                                         <div class="clearfix">&nbsp;</div>
                                         <div class="form-group">
                                             <div class="col-md-12">
                                                <?php echo $form->labelEx($model, 'specification', array('class' => '')); ?>
                                                    <?php echo $form->textArea($model, 'specification', array('class' => 'form-control','id'=>'editorSpe')); ?>
                                                    <?php echo $form->error($model, 'specification'); ?>
                                         </div>
                                         </div>
                                         <div class="clearfix">&nbsp;</div>
                                         <div class="form-group">
                                             <div class="col-md-12">
                                                <?php echo $form->labelEx($model, 'feature', array('class' => '')); ?>
                                                    <?php echo $form->textArea($model, 'feature', array('class' => 'form-control','id'=>'editorFea')); ?>
                                                    <?php echo $form->error($model, 'feature'); ?>
                                         </div>
                                         </div>
                                         <div class="clearfix">&nbsp;</div>
                                         <div class="form-group">
                                             <div class="col-md-12">
                                                <?php echo $form->labelEx($model, 'benifits', array('class' => '')); ?>
                                                    <?php echo $form->textArea($model, 'benifits', array('class' => 'form-control','id'=>'editorBen','row'=>6)); ?>
                                                    <?php echo $form->error($model, 'benifits'); ?>
                                         </div>
                                         </div>
                                             
                                        </div>
                                        </div>
</div>
<div class="tab-pane" id="2">
                <!-- Education Information-->
          <div class="col-md-12">
            <!--end row-->
            <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Sort Order</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody id="imageItemBox">
                        <?php
                        if (count($data['productsImage']) > 0) {
                            foreach ($data['productsImage'] as $preImage):
                                ?>
                                <tr>
                                    <td>
                                        <input type="file" name="ProductsImage[image][]">
                                        <img style="width: 120px;height: 100px;" src="<?php echo Yii::app()->easycode->showOriginalImage($preImage->image,'/product/'); ?>"><input type="hidden" name="ProductsImage[id][]" value="<?php echo $preImage->id ?>">
                                    </td>
                                    <td class="text-right">
                                        <input type="text" name="ProductsImage[sort_order][]" class="form-control" value="<?php echo $preImage->sort_order ?>">
                                    </td>
                                    <td class="text-left">
                                        <button data-original-title="Remove" type="button" data-toggle="tooltip" data-id="<?php echo $preImage->id ?>" title="Remove" class="btn btn-danger del-image-db"><i class="fa fa-minus-circle"></i></button>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        }
                        ?>
                        <tr>
                            <td>
                                <input type="file" name="ProductsImage[image][]">
                               
                            </td>
                            <td class="text-right">
                                <input type="text" name="ProductsImage[sort_order][]" class="form-control">
                            </td>
                            <td class="text-left">
                                <button data-original-title="Remove" type="button" data-toggle="tooltip" onclick="$(this).parent().parent().remove();" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td class="text-left">
                                <button data-original-title="Add More Image" type="button" onclick="addImageRow('#imageItemBox');" data-toggle="tooltip" title="" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="4">
                <!-- Education Information-->
          <div class="col-md-12">
            <!--end row-->
            <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>File</th>
                            <th>Sort Order</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody id="downloadItemBox">
                        <?php
                        if (count($data['productsDownload']) > 0) {
                            foreach ($data['productsDownload'] as $preImage):
                                ?>
                                <tr>
                                    <td>
                                        <input type="file" name="ProductsDownload[image][]">
                                        <img style="width: 120px;height: 100px;" src="<?php echo Yii::app()->easycode->showOriginalImage($preImage->image,'/product/'); ?>"><input type="hidden" name="ProductsDownload[id][]" value="<?php echo $preImage->id ?>">
                                    </td>
                                    <td class="text-right">
                                        <input type="text" name="ProductsDownload[sort_order][]" class="form-control" value="<?php echo $preImage->sort_order ?>">
                                    </td>
                                    <td class="text-left">
                                        <button data-original-title="Remove" type="button" data-toggle="tooltip" data-id="<?php echo $preImage->id ?>" title="Remove" class="btn btn-danger del-download-db"><i class="fa fa-minus-circle"></i></button>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        }
                        ?>
                        <tr>
                            <td>
                                <input type="file" name="ProductsDownload[image][]">
                               
                            </td>
                            <td class="text-right">
                                <input type="text" name="ProductsDownload[sort_order][]" class="form-control">
                            </td>
                            <td class="text-left">
                                <button data-original-title="Remove" type="button" data-toggle="tooltip" onclick="$(this).parent().parent().remove();" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td class="text-left">
                                <button data-original-title="Add More File" type="button" onclick="addDownloadRow('#downloadItemBox');" data-toggle="tooltip" title="" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
<div class="tab-pane" id="3">
                <!-- Education Information-->
          <div class="col-md-12">
            <!--end row-->
            <div class="tabbable-line tabbable-custom-profile">
                <div class="portlet-body">
                   <div class="col-md-12">
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'metatag_title'); ?>
                        <?php echo $form->textField($model, 'metatag_title', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'metatag_title'); ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'metatag_description'); ?>
                        <?php echo $form->textField($model, 'metatag_description', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'metatag_description'); ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'metatag_keywords'); ?>
                        <?php echo $form->textField($model, 'metatag_keywords', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'metatag_keywords'); ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'seo_keyword'); ?>
                        <?php echo $form->textField($model, 'seo_keyword', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'seo_keyword'); ?>
                    </div>
                </div> 
                </div>
            </div>
            

        </div>
            <!-- Education Information-->
                </div>
            <!-- Education Information-->
                </div>

        
            </div>
  </div>
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
<!-- For Image -->
<script>
    function addImageRow(idtoappend) {
        var row = '<tr><td><input type="file" name="ProductsImage[image][]"></td><td class="text-right"><input type="text" class="form-control" name="ProductsImage[sort_order][]"></td><td class="text-left"><button class="btn btn-danger" title="Remove" onclick="$(this).parent().parent().remove();" data-toggle="tooltip" type="button" data-original-title="Remove"><i class="fa fa-minus-circle"></i></button></td></tr>';
        $(idtoappend).append(row);
    }

    $('body').on('click', '.del-image-db', function () {
        $this = $(this);
        if (confirm('Are you sure to detele?')) {
            var dataId = $this.attr('data-id');
            if (dataId.trim() !== '') {
                $.post("<?php echo Yii::app()->createUrl('//admin/products/delImage') ?>", {delId: dataId}, function (data) {
                    if (data == '1') {
                        $this.parent().parent().remove();
                    }
                });
            }
        }

    });


    function addDownloadRow(idtoappend) {
        var row = '<tr><td><input type="file" name="ProductsDownload[image][]"></td><td class="text-right"><input type="text" class="form-control" name="ProductsDownload[sort_order][]"></td><td class="text-left"><button class="btn btn-danger" title="Remove" onclick="$(this).parent().parent().remove();" data-toggle="tooltip" type="button" data-original-title="Remove"><i class="fa fa-minus-circle"></i></button></td></tr>';
        $(idtoappend).append(row);
    }

    $('body').on('click', '.del-download-db', function () {
        $this = $(this);
        if (confirm('Are you sure to detele?')) {
            var dataId = $this.attr('data-id');
            if (dataId.trim() !== '') {
                $.post("<?php echo Yii::app()->createUrl('//admin/products/delDownload') ?>", {delId: dataId}, function (data) {
                    if (data == '1') {
                        $this.parent().parent().remove();
                    }
                });
            }
        }

    });
</script>
<!-- End For Image -->
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

<script> 
var roxyFileman = '<?php echo Yii::app()->request->baseUrl ?>/fileman/index.html'; 
$(function(){
   CKEDITOR.replace( 'editorDes',{filebrowserBrowseUrl:roxyFileman,
                                filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                                removeDialogTabs: 'link:upload;image:upload'}); 
});
var roxyFileman = '<?php echo Yii::app()->request->baseUrl ?>/fileman/index.html'; 
$(function(){
   CKEDITOR.replace( 'editorSpe',{filebrowserBrowseUrl:roxyFileman,
                                filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                                removeDialogTabs: 'link:upload;image:upload'}); 
});
var roxyFileman = '<?php echo Yii::app()->request->baseUrl ?>/fileman/index.html'; 
$(function(){
   CKEDITOR.replace( 'editorFea',{filebrowserBrowseUrl:roxyFileman,
                                filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                                removeDialogTabs: 'link:upload;image:upload'}); 
});
var roxyFileman = '<?php echo Yii::app()->request->baseUrl ?>/fileman/index.html'; 
$(function(){
   CKEDITOR.replace( 'editorBen',{filebrowserBrowseUrl:roxyFileman,
                                filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                                removeDialogTabs: 'link:upload;image:upload'}); 
});
 </script>
