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
<div id="content" class="product-area" style="padding:50px 0px;">
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
                  <h2><?= $this->pageTitle;?></h2>
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
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
    ?>

<table class="table table-bordered table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <th><?= $modelImage->getAttributeLabel('title')?></th>
                                                            <th><?= $modelImage->getAttributeLabel('image')?></th>
                                                            <th><?= $modelImage->getAttributeLabel('sort_order')?></th>
                                                            <th>&nbsp;</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="multi-row-container-2">


                                                        <?php
                        if (count($model->eposterDoc) > 0) {
                            foreach ($model->eposterDoc as $preImage):
                                ?>
                                <tr>
                                    <td class="text-right">
                                        <input type="text" name="EposterImage[title][]" class="form-control" value="<?php echo $preImage->title ?>">
                                    </td>
                                    <td>
                                        <?php echo $form->fileField($modelImage, 'image[]'); ?>
                                        <a target="_blank" href="<?= Yii::app()->easycode->showOriginalImage($preImage->image,Yii::app()->params->ePosterDir)?>"><button type="button" class="btn btn-success btn-xs"><?= $preImage->title?></button></a>
                                        <input type="hidden" name="EposterImage[id][]" class="form-control" value="<?php echo $preImage->id ?>">
                                    </td>
                                    <td> <input type="text" name="EposterImage[sort_order][]" class="form-control" value="<?php echo $preImage->sort_order ?>"></td>
                                    <td>
                                    <button type="button" class="btn btn-xs btn-info addMore-2" title="Add more"><i class="fa fa-plus"></i></button>
                                    <button type="button" data-id="<?php echo $preImage->id ?>" class="btn btn-xs btn-danger  del-download-db" title="Delete"><i class="fa fa-times"></i></button>
                                </td>
                                </tr>
                                <?php
                            endforeach;
                        }
                        ?>

                                                        <tr class="multi-row-2">
                                                            <td>
                                                                <?php echo $form->textField($modelImage, 'title[]', array('class' => 'form-control', 'placeholder' => $modelImage->getAttributeLabel('title'))); ?>
                                                            </td>
                                                            <td>
                                                               <?php echo $form->fileField($modelImage, 'image[]'); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $form->textField($modelImage, 'sort_order[]', array('class' => 'form-control', 'placeholder' => $modelImage->getAttributeLabel('sort_order'))); ?>
                                                            </td>
                                                            
                                                            <td>
                                                                <button type="button" class="btn btn-xs btn-info addMore-2" title="Add more"><i class="fa fa-plus"></i></button>
                                                                <button type="button" class="btn btn-xs btn-danger delRow-2" title="Delete"><i class="fa fa-times"></i></button>
                                                            </td>
                                                        </tr>
                                                       
                                                    </tbody>
                                                </table>

<div class="button-box">
<button type="submit" class="btn btn-success log-btn">Save</button>
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

<style>
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
</style>
<!-- End Page Header -->
</section>

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