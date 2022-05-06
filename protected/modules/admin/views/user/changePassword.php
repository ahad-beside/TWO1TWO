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
                                        <div class="row"><div class="col-md-12"><?php echo Yii::app()->easycode->showNotification(); ?></div></div>
                                        <?php
                                        if (isset($_GET['result']) && $_GET['result'] == 'success')
                                            echo '<div class="row"><div class="col-md-12 text-center">' . CHtml::link('Close', $this->createUrl('//site'), array('class' => 'btn btn-primary','id'=>'f-close')) . '</div></div>';
                                        else{?>
                                            <form method="post" action="<?php echo $this->createUrl('changePassword')?>" class="inner-form form-horizontal">
                                                <div class="form-body row">
                                                <div class="col-md-12">
                                                    
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label"><?= Yii::t(Yii::app()->request->cookies['lang']->value, 'Current Password') ?></label>
                                                        <div class="col-md-4">
                                                            <input type="password" name="Password[current]" class="form-control">
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label"><?= Yii::t(Yii::app()->request->cookies['lang']->value, 'New Password') ?></label>
                                                        <div class="col-md-4">
                                                            <input type="password" name="Password[new]" class="form-control">
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label"><?= Yii::t(Yii::app()->request->cookies['lang']->value, 'Re-Type New Password') ?></label>
                                                        <div class="col-md-4">
                                                            <input type="password" name="Password[re]" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-actions row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" class="btn green"><?= Yii::t(Yii::app()->request->cookies['lang']->value, 'Change Password') ?></button>
                                                    </div>
                                                </div>
                                                </form>
                                      <?php  }?>
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