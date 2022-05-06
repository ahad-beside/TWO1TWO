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
                    </div>
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i><?= $this->pageTitle?> </div>
                                        </div>
                                        <div class="portlet-body" style="display: block;">
                                            <div class="row"><div class="col-md-12"><?php echo Yii::app()->easycode->showNotification(); ?></div>
                                        </div>
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
                                        if($model->isNewRecord){
                                          $newModel=$userModel;
                                      }else{
                                          $newModel=$model;
                                      }
                                      ?>
                                      <div class="form-body row">
                                        <div class="col-md-12">

                                         <div class="form-group">
                                          <div class="row">
                                              <div class="col-md-6">
                                                <?php echo $form->labelEx($newModel, 'first_name', array('class' => '')); ?>
                                                <?php echo $form->textField($newModel, 'first_name', array('class' => 'form-control', 'placeholder' => 'Type your first name')); ?> 
                                                <?php echo $form->error($newModel, 'first_name'); ?>
                                            </div>
                                            <div class="col-md-6">
                                              <?php echo $form->labelEx($newModel, 'last_name', array('class' => '')); ?>
                                              <?php echo $form->textField($newModel, 'last_name', array('class' => 'form-control', 'placeholder' => 'Type your Last name')); ?> 
                                              <?php echo $form->error($newModel, 'last_name'); ?>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="row">
                                          <div class="col-md-6">
                                            <?php echo $form->labelEx($model, 'birth_date', array('class' => '')); ?>
                                            <?php 
                                            $this->widget('ext.YiiDateTimePicker.jqueryDateTime', 
                                              array( 'model' => $model, 'attribute' => 'birth_date', 'options' => array( 'format' => 'd-m-Y', 'timepicker' => true, 'closeOnDateSelect' => true, ), 
                                               'htmlOptions' => array( 'class' => 'form-control input-sm'), 
                                           ));
                                           ?> 
                                           <?php echo $form->error($model, 'birth_date'); ?>
                                       </div>
                                       <div class="col-md-6">
                                          <?php echo $form->labelEx($model, 'gender', array('class' => '')); ?>
                                          <?php echo $form->dropDownList($model, 'gender',array('Male'=>'Male','Female'=>'Female'), array('class' => 'form-control', 'prompt' => 'Select Any')); ?> 
                                          <?php echo $form->error($model, 'gender'); ?>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                <div class="controls">
                                 <?php echo $form->labelEx($model, 'address1', array('class' => '')); ?>
                                 <!--  <input name="JobAppliedList[cv_file]" type="file">  -->
                                 <?php echo $form->textArea($model, 'address1', array('class' => 'form-control', 'prompt' => 'Select Any')); ?> 
                                 <?php echo $form->error($model, 'address1'); ?>
                             </div>
                         </div>
                         <div class="form-group">
                          <div class="row">
                              <div class="col-md-6">
                                <?php echo $form->labelEx($model, 'phone', array('class' => '')); ?>
                                <?php echo $form->textField($model, 'phone', array('class' => 'form-control', 'placeholder' => 'Type your phone')); ?> 
                                <?php echo $form->error($model, 'phone'); ?>
                            </div>
                            <div class="col-md-6">
                                <?php echo $form->labelEx($model, 'country', array('class' => '')); ?>
                              <?php echo $form->dropDownList($model, 'country',CHtml::listData(Country::model()->findAll(),'id','name'), array('class' => 'form-control', 'prompt' => 'Select Any')); ?>
                                <?php echo $form->error($model, 'country'); ?>
                            </div>
                           
                      </div>
                  </div>
                  <div class="form-group">
                                <div class="controls">
                                  <?php echo $form->labelEx($model, 'photo', array('class' => '')); ?>
                              <?php echo $form->fileField($model, 'photo', array('class' =>'')); ?> 
                              <?php echo $form->error($model, 'photo'); ?>
                              <?php echo Yii::app()->easycode->showImage($model->photo,100,80,true,true,Yii::app()->params->userDir); ?> 
                             </div>
                         </div>

                          
                  <div class="button-box">
                    <button type="submit" class="btn btn-success log-btn">Save</button>
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
</div>
</div>