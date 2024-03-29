<section id="product-collection" class="section30"> 
 <!-- Start Page Header -->
<div class="content-page-header" style="margin-top:61px;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb"> <a href="<?= Yii::app()->homeUrl;?>"><i class="icon-home"></i> Home</a> <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span> <span class="current"><?= $this->pageTitle;?></span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Page Header -->
<div id="content" class="product-area" style="padding:0px 0px;">
  <div class="container">
    <div class="whitebox">
      <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12">
        <?php $this->renderPartial('sidebar',array('data'=>$data)); ?>
      </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
          <div class="shop-content">
            <div class="perrow">
              <div class="row">
                <div class="col-md-12">
                  <h2>Event: <?= $model->name;?></h2>
                  <p>Date & Time: <?= date('d-m-Y',strtotime($model->expire_date))?> <?= date('h:i A',strtotime($model->expire_date))?></p>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
        <div class="login">
<div class="">
<?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'job-applied-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
                'validateOnChange' => true,
            ),
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
    ?>
<div class="form-group">
  <?php echo $form->labelEx($modelImage, 'template_type', array('class' => '')); ?>
  <div class="row">
    <?php 
    if(isset($_GET['document_type']) && $_GET['document_type']=='Upload Document'){
      $docCss="style='display:none;'";
    }else{
      $docCss="style='display:none;'";
    }
    ?>
        <div class="col-md-6" <?=$docCss?>>
          <?php echo $form->labelEx($modelImage, 'document_type', array('class' => '')); ?>
           <?php echo $form->dropDownList($modelImage, 'document_type',array('Choose Template'=>'Template'), array('class' => 'form-control')); ?> 
           <?php echo $form->error($modelImage, 'document_type'); ?>
        </div>

        <div class="col-md-3 template-checkbox">
          <label>
          <input <?php if($modelImage->template_type==1){?>checked="checked"<?php } ?> type="radio" class="templateVal" name="EposterImage[template_type]" value="1" />
          <img class="img-responsive" src="<?php echo Yii::app()->theme->baseUrl ?>/assets/images/template-1.jpg">
        </label>
        </div>
        <div class="col-md-3 template-checkbox">
          <label>
          <input <?php if($modelImage->template_type==2){?>checked="checked"<?php } ?> type="radio" class="templateVal" name="EposterImage[template_type]" value="2" />
          <img class="img-responsive" src="<?php echo Yii::app()->theme->baseUrl ?>/assets/images/template-2.jpg">
        </label>
        </div>
        <div class="col-md-3 template-checkbox">
          <label>
          <input <?php if($modelImage->template_type==3){?>checked="checked"<?php } ?> type="radio" class="templateVal" name="EposterImage[template_type]" value="3" />
          <img class="img-responsive" src="<?php echo Yii::app()->theme->baseUrl ?>/assets/images/template-3.jpg">
        </label>
        </div>
        <div class="col-md-3 template-checkbox">
          <label>
          <input <?php if($modelImage->template_type==4){?>checked="checked"<?php } ?> type="radio" class="templateVal" name="EposterImage[template_type]" value="4" />
          <img class="img-responsive" src="<?php echo Yii::app()->theme->baseUrl ?>/assets/images/template-4.jpg">
        </label>
        </div>
        
    </div>
</div>

<div class="form-group templateDocument" style="display: none;">
<div class="row">
        <div class="col-md-6">
          <?php echo $form->labelEx($modelImage, 'template_background_type', array('class' => '')); ?>
           <?php echo $form->dropDownList($modelImage, 'template_background_type',array('Background Color'=>'Background Color','Background Image'=>'Background Image'), array('class' => 'form-control','prompt'=>'Select Any')); ?>
           <?php echo $form->error($modelImage, 'template_background_type'); ?>
        </div>
        <div class="col-md-6 showBackImage" style="display: none;">
          <?php echo $form->labelEx($modelImage, 'template_bg_image', array('class' => '')); ?>
           <?php echo $form->fileField($modelImage, 'template_bg_image'); ?> 
           <?php echo $form->error($modelImage, 'template_bg_image'); ?>
        </div>
        <div class="col-md-6 showBackColor" style="display: none;">
          <?php echo $form->labelEx($modelImage, 'template1_bgcolor', array('class' => '')); ?>
           <div id="cp1" class="input-group colorpicker-component">
          <input type="text" value="<?=($modelImage->template1_bgcolor==''?'#00AABB':$modelImage->template1_bgcolor)?>" class="form-control" name="EposterImage[template1_bgcolor]" />
          <span class="input-group-addon"><i></i></span>
           <?php echo $form->error($modelImage, 'template1_bgcolor'); ?>
        </div>
    </div>
  </div>
</div>
<div class="form-group templateDocument" style="display: none;">
<div class="row">
        <div class="col-md-6">
          <?php echo $form->labelEx($modelImage, 'templateDate', array('class' => '')); ?>
           <?php 
            $this->widget('ext.YiiDateTimePicker.jqueryDateTime', array(
                'model' => $modelImage,
                'attribute' => 'templateDate',
                'options' => array(
                    'format' => 'd-m-Y H:i',
                    'timepicker' => true,
                    'closeOnDateSelect' => false,
                ), //DateTimePicker options
                'htmlOptions' => array(
                    'class' => 'st form-control input-sm',
                    'value'=>date('d-m-Y H:i',strtotime($modelImage->date_time)),
                ),
            )); 
          ?>
           <?php echo $form->error($modelImage, 'templateDate'); ?>
        </div>
        <div class="col-md-6">
          <?php echo $form->labelEx($modelImage, 'templateImage', array('class' => '')); ?>
           <?php echo $form->fileField($modelImage, 'templateImage'); ?> 
           <?php echo $form->error($modelImage, 'templateImage'); ?>
        </div>
    </div>
  </div>

<div class="form-group templateDocument" style="display: none;">
  <div class="row">
        <div class="col-md-12">
          <?php echo $form->labelEx($modelImage, 'templateTitle', array('class' => '')); ?>
           <?php echo $form->textField($modelImage, 'templateTitle', array('class' => 'form-control','value'=>$modelImage->title)); ?>
           <?php echo $form->error($modelImage, 'templateTitle'); ?>
        </div>
    </div>
</div>
<div class="form-group templateDocument" style="display: none;">
  <div class="row">
        <div class="col-md-6">

          <?php echo $form->labelEx($modelImage, 'template2_bgcolor', array('class' => '')); ?>
           <div id="cp2" class="input-group colorpicker-component">
          <input type="text" value="<?=($modelImage->template2_bgcolor==''?'#FFFFFF':$modelImage->template2_bgcolor)?>" class="form-control" name="EposterImage[template2_bgcolor]" />
          <span class="input-group-addon"><i></i></span>
           <?php echo $form->error($modelImage, 'template2_bgcolor'); ?>
        </div>
        </div>
    </div>
</div>

<div class="form-group templateDocument" style="display: none;">
  <div class="row">
        <div class="col-md-12">
          <?php echo $form->labelEx($modelImage, 'sub_title', array('class' => '')); ?>
           <?php echo $form->textField($modelImage, 'sub_title', array('class' => 'form-control')); ?>
           <?php echo $form->error($modelImage, 'sub_title'); ?>
        </div>
    </div>
</div>
<div class="form-group templateDocument" style="display: none;">
  <div class="row">
        <div class="col-md-6">

          <?php echo $form->labelEx($modelImage, 'template3_bgcolor', array('class' => '')); ?>
           <div id="cp3" class="input-group colorpicker-component">
          <input type="text" value="<?=($modelImage->template3_bgcolor==''?'#FFFFFF':$modelImage->template3_bgcolor)?>" class="form-control" name="EposterImage[template3_bgcolor]" />
          <span class="input-group-addon"><i></i></span>
           <?php echo $form->error($modelImage, 'template3_bgcolor'); ?>
        </div>
        </div>
    </div>
</div>

<div class="form-group templateDocument" style="display: none;">
  <div class="row">
        <div class="col-md-6">

          <?php echo $form->labelEx($modelImage, 'template4_bgcolor', array('class' => '')); ?>
           <div id="cp4" class="input-group colorpicker-component">
          <input type="text" value="<?=($modelImage->template4_bgcolor==''?'#FFFFFF':$modelImage->template4_bgcolor)?>" class="form-control" name="EposterImage[template4_bgcolor]" />
          <span class="input-group-addon"><i></i></span>
           <?php echo $form->error($modelImage, 'template4_bgcolor'); ?>
        </div>
        </div>
        <div class="col-md-6">

          <?php echo $form->labelEx($modelImage, 'template_box_font_color', array('class' => '')); ?>
           <div id="cp5" class="input-group colorpicker-component">
          <input type="text" value="<?=($modelImage->template_box_font_color==''?'#FFFFFF':$modelImage->template_box_font_color)?>" class="form-control" name="EposterImage[template_box_font_color]" />
          <span class="input-group-addon"><i></i></span>
           <?php echo $form->error($modelImage, 'template_box_font_color'); ?>
        </div>
        </div>
    </div>
</div>

<div class="fieldset1">
  <div class="form-group 2columns" style="display: none;">
  <div class="row">
        <div class="col-md-12">
          <?php echo $form->labelEx($modelImage, 'template1_title', array('class' => '')); ?>
           <?php echo $form->textField($modelImage, 'template1_title', array('class' => 'form-control','id'=>'')); ?>
           <?php echo $form->error($modelImage, 'template1_title'); ?>

          <?php echo $form->labelEx($modelImage, 'template1', array('class' => '')); ?>
           <?php echo $form->textArea($modelImage, 'template1', array('class' => 'form-control','id'=>'EposterImage_template1','required'=>'required')); ?>
           <?php echo $form->error($modelImage, 'template1'); ?>

           <?php echo $form->labelEx($modelImage, 'template1_video', array('class' => '')); ?>
           <?php echo $form->textField($modelImage, 'template1_video', array('class' => 'form-control','id'=>'')); ?>
           <?php echo $form->error($modelImage, 'template1_video'); ?>
        </div>
    </div>
</div>
</div>
<div class="fieldset2">
<div class="form-group 2columns" style="display: none;">
  <div class="row">
        <div class="col-md-12">
          <?php echo $form->labelEx($modelImage, 'template2_title', array('class' => '')); ?>
           <?php echo $form->textField($modelImage, 'template2_title', array('class' => 'form-control','id'=>'')); ?>
           <?php echo $form->error($modelImage, 'template1_title'); ?>
          <?php echo $form->labelEx($modelImage, 'template2', array('class' => '')); ?>
           <?php echo $form->textArea($modelImage, 'template2', array('class' => 'form-control','id'=>'editorTemplate2')); ?>
           <?php echo $form->error($modelImage, 'template2'); ?>
           <?php echo $form->labelEx($modelImage, 'template2_video', array('class' => '')); ?>
           <?php echo $form->textField($modelImage, 'template2_video', array('class' => 'form-control','id'=>'')); ?>
           <?php echo $form->error($modelImage, 'template2_video'); ?>
        </div>
    </div>
</div>
</div>
<div class="fieldset3">
<div class="form-group 3columns" style="display: none;">
  <div class="row">
        <div class="col-md-12">
          <?php echo $form->labelEx($modelImage, 'template3_title', array('class' => '')); ?>
           <?php echo $form->textField($modelImage, 'template3_title', array('class' => 'form-control','id'=>'')); ?>
          <?php echo $form->labelEx($modelImage, 'template3', array('class' => '')); ?>
           <?php echo $form->textArea($modelImage, 'template3', array('class' => 'form-control','id'=>'editorTemplate3')); ?>
           <?php echo $form->error($modelImage, 'template3'); ?>
           <?php echo $form->labelEx($modelImage, 'template3_video', array('class' => '')); ?>
           <?php echo $form->textField($modelImage, 'template3_video', array('class' => 'form-control','id'=>'')); ?>
           <?php echo $form->error($modelImage, 'template3_video'); ?>
        </div>
    </div>
</div>
</div>
<div class="fieldset4">
<div class="form-group 4columns" style="display: none;">
  <div class="row">
        <div class="col-md-12">
          <?php echo $form->labelEx($modelImage, 'template4_title', array('class' => '')); ?>
           <?php echo $form->textField($modelImage, 'template4_title', array('class' => 'form-control','id'=>'')); ?>
          <?php echo $form->labelEx($modelImage, 'template4', array('class' => '')); ?>
           <?php echo $form->textArea($modelImage, 'template4', array('class' => 'form-control','id'=>'editorTemplate4')); ?>
           <?php echo $form->error($modelImage, 'template4'); ?>
           <?php echo $form->labelEx($modelImage, 'template4_video', array('class' => '')); ?>
           <?php echo $form->textField($modelImage, 'template4_video', array('class' => 'form-control','id'=>'')); ?>
           <?php echo $form->error($modelImage, 'template4_video'); ?>
        </div>
    </div>
</div>
</div>
<div class="fieldset5">
<div class="form-group 5columns" style="display: none;">
  <div class="row">
        <div class="col-md-12">
          <?php echo $form->labelEx($modelImage, 'template5_title', array('class' => '')); ?>
           <?php echo $form->textField($modelImage, 'template5_title', array('class' => 'form-control','id'=>'')); ?>
          <?php echo $form->labelEx($modelImage, 'template5', array('class' => '')); ?>
           <?php echo $form->textArea($modelImage, 'template5', array('class' => 'form-control','id'=>'editorTemplate5')); ?>
           <?php echo $form->error($modelImage, 'template5'); ?>
           <?php echo $form->labelEx($modelImage, 'template5_video', array('class' => '')); ?>
           <?php echo $form->textField($modelImage, 'template5_video', array('class' => 'form-control','id'=>'')); ?>
           <?php echo $form->error($modelImage, 'template5_video'); ?>
        </div>
    </div>
</div>
</div>
<div class="fieldset6">
<div class="form-group 6columns" style="display: none;">
  <div class="row">
        <div class="col-md-12">
          <?php echo $form->labelEx($modelImage, 'template6_title', array('class' => '')); ?>
           <?php echo $form->textField($modelImage, 'template6_title', array('class' => 'form-control','id'=>'')); ?>
          <?php echo $form->labelEx($modelImage, 'template6', array('class' => '')); ?>
           <?php echo $form->textArea($modelImage, 'template6', array('class' => 'form-control','id'=>'editorTemplate6')); ?>
           <?php echo $form->error($modelImage, 'template6'); ?>
           <?php echo $form->labelEx($modelImage, 'template6_video', array('class' => '')); ?>
           <?php echo $form->textField($modelImage, 'template6_video', array('class' => 'form-control','id'=>'')); ?>
           <?php echo $form->error($modelImage, 'template6_video'); ?>
        </div>
    </div>
</div>
</div>
<div class="fieldset7">
<div class="form-group 7columns" style="display: none;">
  <div class="row">
        <div class="col-md-12">
          <?php echo $form->labelEx($modelImage, 'template7_title', array('class' => '')); ?>
           <?php echo $form->textField($modelImage, 'template7_title', array('class' => 'form-control','id'=>'')); ?>
          <?php echo $form->labelEx($modelImage, 'template7', array('class' => '')); ?>
           <?php echo $form->textArea($modelImage, 'template7', array('class' => 'form-control','id'=>'editorTemplate7')); ?>
           <?php echo $form->error($modelImage, 'template7'); ?>
           <?php echo $form->labelEx($modelImage, 'template7_video', array('class' => '')); ?>
           <?php echo $form->textField($modelImage, 'template7_video', array('class' => 'form-control','id'=>'')); ?>
           <?php echo $form->error($modelImage, 'template7_video'); ?>
        </div>
    </div>
</div>
</div>
<div class="form-group templateDocument" style="display: none;">
  <div class="row">
        <div class="col-md-12">
          <?php echo $form->labelEx($modelImage, 'footer_text', array('class' => '')); ?>
           <?php echo $form->textField($modelImage, 'footer_text', array('class' => 'form-control')); ?>
           <?php echo $form->error($modelImage, 'footer_text'); ?>
        </div>
    </div>
</div>

<div class="button-box">
<button type="submit" class="btn btn-success log-btn">Save</button>
<a href="<?=Yii::app()->createUrl('//user/dashboard')?>">
<button type="button" class="btn btn-danger log-btn">Cancel</button></a>
</div>
<?php $this->endWidget(); ?>
</div>
</div>
      </div>
                  </div><!--/row--> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>
<script>
          $(function () {
              $('#cp1').colorpicker();
          });
          $(function () {
              $('#cp2').colorpicker();
          });
          $(function () {
              $('#cp3').colorpicker();
          });
          $(function () {
              $('#cp4').colorpicker();
          });
          $(function () {
              $('#cp5').colorpicker();
          });
      </script>
<script> 
var roxyFileman = '<?php echo Yii::app()->request->baseUrl ?>/fileman/index.html'; 
$(function(){
   CKEDITOR.replace( 'EposterImage_template1',{filebrowserBrowseUrl:roxyFileman,
    filebrowserImageBrowseUrl:roxyFileman+'?type=image',
    removeDialogTabs: 'link:upload;image:upload'}); 
});
 </script>
<script> 
var roxyFileman = '<?php echo Yii::app()->request->baseUrl ?>/fileman/index.html'; 
$(function(){
   CKEDITOR.replace( 'editorTemplate2',{filebrowserBrowseUrl:roxyFileman,
    filebrowserImageBrowseUrl:roxyFileman+'?type=image',
    removeDialogTabs: 'link:upload;image:upload'}); 
});
 </script>
<script> 
var roxyFileman = '<?php echo Yii::app()->request->baseUrl ?>/fileman/index.html'; 
$(function(){
   CKEDITOR.replace( 'editorTemplate3',{filebrowserBrowseUrl:roxyFileman,
    filebrowserImageBrowseUrl:roxyFileman+'?type=image',
    removeDialogTabs: 'link:upload;image:upload'}); 
});
 </script>
<script> 
var roxyFileman = '<?php echo Yii::app()->request->baseUrl ?>/fileman/index.html'; 
$(function(){
   CKEDITOR.replace( 'editorTemplate4',{filebrowserBrowseUrl:roxyFileman,
    filebrowserImageBrowseUrl:roxyFileman+'?type=image',
    removeDialogTabs: 'link:upload;image:upload'}); 
});
 </script>
<script> 
var roxyFileman = '<?php echo Yii::app()->request->baseUrl ?>/fileman/index.html'; 
$(function(){
   CKEDITOR.replace( 'editorTemplate5',{filebrowserBrowseUrl:roxyFileman,
    filebrowserImageBrowseUrl:roxyFileman+'?type=image',
    removeDialogTabs: 'link:upload;image:upload'}); 
});
 </script>
<script> 
var roxyFileman = '<?php echo Yii::app()->request->baseUrl ?>/fileman/index.html'; 
$(function(){
   CKEDITOR.replace( 'editorTemplate6',{filebrowserBrowseUrl:roxyFileman,
    filebrowserImageBrowseUrl:roxyFileman+'?type=image',
    removeDialogTabs: 'link:upload;image:upload'}); 
});
 </script>
<script> 
var roxyFileman = '<?php echo Yii::app()->request->baseUrl ?>/fileman/index.html'; 
$(function(){
   CKEDITOR.replace( 'editorTemplate7',{filebrowserBrowseUrl:roxyFileman,
    filebrowserImageBrowseUrl:roxyFileman+'?type=image',
    removeDialogTabs: 'link:upload;image:upload'}); 
});
 </script>
<style>

.colorpicker-alpha{
  display: none!important;
}
.expired_date{
  color:#666;
  font-size:12px;
}
.perrow{
  width:100%;
  display:inline-block;
  background-color:#FFF;
  margin-bottom:20px;
  padding:12px;
}
.date{
  font-size:12px;
  color:#888;
}
.whitebox{
  width:100%;
  display:inline-block;
  padding:12px;
}
.shop-content a{
  color:#15C;
}
.input-group-addon {
    padding: 6px 12px!important;
    font-size: 14px;
    font-weight: 400;
    line-height: 1;
    color: #555;
    text-align: center;
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 4px;
}
</style>
<!-- End Page Header -->
</section>
<?php 
    if(isset($_GET['document_type']) && $_GET['document_type']=='Upload Document'){?>
    <script type="text/javascript">
      $(document).ready(function(){
        documentWiseDiv('Upload Document');
      });
    </script>
    <?php }else{ ?>
      <script type="text/javascript">
      $(document).ready(function(){
        documentWiseDiv('Choose Template');
      });
    </script>
  <?php } ?>
<script type="text/javascript">
    $(document).on('change','#EposterImage_document_type',function(){
        documentWiseDiv($(this).val());
    });
    $(document).on('click','.template-checkbox',function(){
      //alert($(this).find('.templateVal').val());
      templateWiseDiv($(this).find('.templateVal').val());
    });
    $(document).on('change','#EposterImage_template_type',function(){
        templateWiseDiv($(this).val());
    });
    $(document).on('change','#EposterImage_template_background_type',function(){
        templateBackgroundDiv($(this).val());
    });

    function templateBackgroundDiv(backgroundType){
        if(backgroundType=='Background Color'){
            $('.showBackColor').show();
            $('.showBackImage').hide();
        }else{
            $('.showBackImage').show();
            $('.showBackColor').hide();

        }
    }
    function documentWiseDiv(documentType){
        if(documentType=='Upload Document'){
            $('.uploadDocument').show();
            $('.templateDocument').hide();
        }else{
            $('.templateDocument').show();
            $('.uploadDocument').hide();

        }
    }
    function templateWiseDiv(templateType){
        //alert(templateType);
        if(templateType=='1'){
            $('.2columns').show();
            $('.3columns').show();
            $('.4columns').show();
            $('.5columns').show();
            $('.6columns').hide();
            $('.7columns').hide();
        }else if(templateType=='2'){
            $('.2columns').show();
            $('.3columns').show();
            $('.4columns').show();
            $('.5columns').show();
            $('.6columns').show();
            $('.7columns').hide();
        }else if(templateType=='3'){
            $('.2columns').show();
            $('.3columns').show();
            $('.4columns').show();
            $('.5columns').show();
            $('.6columns').show();
            $('.7columns').hide();
        }else if(templateType=='4'){
            $('.2columns').show();
            $('.3columns').show();
            $('.4columns').show();
            $('.5columns').show();
            $('.6columns').show();
            $('.7columns').show();
        }
    }
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
        $('.st').datetimepicker({
            format: "d-m-Y h:i"
        });
    });

    $(document).on('click','.delRow-2',function(){
        if(confirm('Are you sure to delete?'))
            $(this).parent().parent().remove();
        chkRowAddMoreButton($('.addMore-2'),$(this));
        chkRowDellMoreButton($('.delRow-2'));
    });

    $(document).ready(function(){
      templateBackgroundDiv($('#EposterImage_template_background_type').val());
      templateWiseDiv($('.templateVal:checked').val());
        chkRowAddMoreButton($('.addMore-2'),$(this));
        chkRowDellMoreButton($('.delRow-2'));
        $('.st').datetimepicker({
            format: "d-m-Y h:i"
        });

    });
    $('body').on('click', '.del-download-db', function () {
        $this = $(this);
        if (confirm('Are you sure to parmanently detele?')) {
            var dataId = $this.attr('data-id');
            if (dataId.trim() !== '') {
                $.post("<?php echo Yii::app()->createUrl('//user/delImage') ?>", {delId: dataId}, function (data) {
                    if (data == '1') {
                        $this.parent().parent().remove();
                    }
                });
            }
        }

    });
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/octicons/3.5.0/octicons.min.css" rel="stylesheet">
    <link href="<?=Yii::app()->theme->baseUrl;?>/assets/css/bootstrap-colorpicker.min.css" rel="stylesheet">

    <script src="<?=Yii::app()->theme->baseUrl;?>/assets/js/bootstrap-colorpicker.js"></script>