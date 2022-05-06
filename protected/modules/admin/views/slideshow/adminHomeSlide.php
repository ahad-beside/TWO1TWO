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
                           <!-- <a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="javascript:$('.grid-search-portlet').toggle('slow')" title="Search"> <i class="fa fa-search"></i> Search</a> -->
                            <?= CHtml::link('<i class="fa fa-plus"></i> Create', $this->createUrl('//admin/slideshow/createHomeSlide/'),array('class'=>'btn btn-sm btn-primary')) ?>
                        </div>

                    </div>
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <?= $this->renderPartial('/settings/sidebar',false,true)?>
                            </div>
                            <div class="col-md-10">
                            <?php //$this->renderPartial('_search', array('model' => $model)) ?>
                                <div class="portlet box">
                                    <div class="portlet-body" style="display: block;">
                                        <?php
                                        $this->widget('zii.widgets.grid.CGridView', array(
                                            'id' => 'exam-view-data',
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
                                                
                        // array(
                        //     'header'=>'Slide',
                        //     'type'=>'raw',
                        //     'value'=>'Yii::app()->easycode->showOriginalImage($data->image,40,40,true,true,Yii::app()->params->sliderDir)',
                        // ),
                        array ( 
                        'name'=>'title',
                        'value'=>'$data->title',
                        'filter'=>false,
                       ),
                      array ( 
                        'name'=>'link',
                        'value'=>'$data->link',
                        'filter'=>false,
                       ),
                       array ( 
                        'name'=>'sort_order',
                        'value'=>'$data->sort_order',
                        'filter'=>false,
                       ),                      array(
                                                    'class' => 'CButtonColumn',
                                                    'header' => 'Action',
                                                    'template' => '{update}&nbsp;&nbsp;{delete}',
                                                    //'deleteConfirmation' => false,
                                                    'buttons' => array(
                                                        'update' => array(
                                                            'label' => '<span class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></span>',
                                                            'url'=>'Yii::app()->createUrl("//admin/slideshow/updateHomeSlide/",array("id"=>$data->id))',
                                                            'imageUrl' => false,
                                                            'options' => array('title' => 'Update'),
                                                        ),
                                                        'delete' => array(
                                                            'label' => '<span class="btn btn-xs btn-danger"><i class="fa fa-times"></i></span>',
                                                            //'url'=>'Yii::app()->createUrl("//admin/settings/deleteCity/",array("id"=>$data->id))',
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






