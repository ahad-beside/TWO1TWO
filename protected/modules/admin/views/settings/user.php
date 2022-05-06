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
                            
                            <a class="btn btn-sm btn-primary" href="<?= $this->createUrl('//admin/settings/createUser') ?>" title="Create User"> <i class="fa fa-plus"></i> Create User</a>
                        </div>

                    </div>
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <?= $this->renderPartial('sidebar',false,true)?>
                            </div>
                            <div class="col-md-9">
                                <div class="portlet box">
                                    <div class="portlet-body" style="display: block;">
                                        <?php
                                        $this->widget('zii.widgets.grid.CGridView', array(
                                            'id' => 'grid-view-data',
                                            'htmlOptions' => array('class' => 'data-grid table-responsive'),
                                            'itemsCssClass' => 'table table-striped table-bordered table-hover',
                                            'template' => '{items}{pager}',
                                            'dataProvider' => $model->search(),
                                            'columns' => array(
//                array(
//                    'class' => 'CCheckBoxColumn',
//                    'value' => '$data->id',
//                    'selectableRows' => '2',
//                    'id' => 'actionCheck'
//                ),
                                                array(
                                                    'class' => 'IndexColumn',
                                                    'header' => '#',
                                                    'headerHtmlOptions' => array('style' => 'width:20px;'),
                                                ),
                                                array(
                                                    'name' => 'full_name',

                                                ),
                                                'phone',
                                                array(
                                                    'name' => 'email',
                                                    'type' => 'raw',
                                                    'value' => 'CHtml::link($data->email,Yii::app()->createUrl("//admin/user/viewApplicant",array("id"=>$data->id)))',
                                                    
                                                    'filter' => Chtml::textField("User[email]", $model->email, array('class'=>'form-control')),
                                                ),
                                                array(
                                                    'name'=>'date_of_registration',
                                                    'value'=>'date("Y-m-d",strtotime($data->date_of_registration))'
                                                    ),
                                                
                                                array(
                                                  'name' => 'role',
                                                  'value' => 'Roles::model()->findByPk($data->role)->name',
                                                  ), 
                                                array(
                                                    'name' => 'email_verified',
                                                    'filter' => Chtml::dropDownList("User[email_verified]", $model->email_verified, array('0' => 'No', '1' => 'Yes'), array('empty' => 'Verificaion Status','class'=>'form-control')),
                                                    'type' => 'raw',
                                                    'value' => '($data->email_verified=="0")?"<span class=\'btn btn-xs btn-danger\'>No</span>":"<span class=\'btn btn-xs btn-success\'>Yes<span>"',
                                                ),
                                                // array(
                                                //     'name' => 'active',
                                                //     'type' => 'raw',
                                                //     'filter' => Chtml::dropDownList("User[active]", $model->active, array('0' => 'No', '1' => 'Yes'), array('empty' => 'Status')),
                                                //     'value' => '($data->active=="0")?"<span class=\'btn btn-xs btn-danger\'>No</span>":"<span class=\'btn btn-xs btn-success\'>Yes<span>"',
                                                // ),
                                                array(
                                                    'class' => 'CButtonColumn',
                                                    'header' => 'Action',
                                                    'template' => '{update}&nbsp;&nbsp;{delete}',
                                                    //'deleteConfirmation' => false,
                                                    'buttons' => array(
                                                        'update' => array(
                                                            'label' => '<span class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></span>',
                                                            'url'=>'Yii::app()->createUrl("//admin/settings/updateUser/",array("id"=>$data->id))',
                                                            'imageUrl' => false,
                                                            'options' => array('title' => 'Update'),
                                                        ),
                                                        'delete' => array(
                                                            'label' => '<span class="btn btn-xs btn-danger"><i class="fa fa-times"></i></span>',
                                                            'url'=>'Yii::app()->createUrl("//admin/settings/deleteUser/",array("id"=>$data->id))',
                                                            'imageUrl' => false,
                                                            'options' => array(
                                                                'title' => 'Delete',
                                                                //'class' => 'delConfirm',
                                                                //'data-toggle'=>'confirmation',
                                                            ),
                                                        ),
                                                    ),
                                                ),
                                            ),
                                        ));
                                        ?>
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

</script>

