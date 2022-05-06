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
                            <a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="javascript:$('.grid-search-portlet').toggle('slow')" title="Search"> <i class="fa fa-search"></i> Search</a>
                            
                           <!-- <a class="btn btn-sm btn-primary" href="<?//= $this->createUrl('//admin/products/create') ?>" title="New Category"> <i class="fa fa-plus"></i> New Product</a> -->
                        </div>
                    </div>
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <div class="row">
                        <!-- <div class="col-md-2">
                                <?php //$this->renderPartial('sidebar');?>
                            </div> -->
                            <?php $this->renderPartial('menuItems',array('status'=>$data['status'])) ?>
                            <div class="col-md-12">
                                 
                            <?php $this->renderPartial('_search', array('model'=>$model))?>
                                <div class="portlet box">

                                    <div class="portlet-body" style="display: block;">
                                        <?php if(isset($data['status']) && $data['status']!='Shipped'){?>
                                            <?php $this->renderPartial('_'.$data['status'].'ActionButtons');?>
                                            <?php } ?>
                                        <?php
                                        $this->widget('zii.widgets.grid.CGridView', array(
                                            'id' => 'order-grid',
                            'htmlOptions' => array('class' => 'data-grid table-responsive'),'itemsCssClass' => 'table table-striped table-bordered table-hover','template' => '{items}{pager}',
                            'dataProvider' => $model->search($data['status'], $mixedCond = array(),$paymentStatus),
                            //'summaryCssClass' => 'gridview-summary',
                            //'filter' => $model,
                            //'filterCssClass' => 'filter-inputs',
                                            'columns' => array(
                                              array(
                                                   'class' => 'CCheckBoxColumn',
                                                   'value' => '$data->id',
                                                   'selectableRows' => '2',
                                                   'id' => 'actionCheck',
                                                    'headerHtmlOptions' => array('style' => 'width:20px;'),
                                               ),
                                                array(
                                                    'class' => 'IndexColumn',
                                                    'header' => '#',
                                                    'headerHtmlOptions' => array('style' => 'width:20px;'),
                                                ),
                                                 array(
                                    'name' => 'order_date',
                                    'value' => '($data->order_date!="")?date("d-m-Y",strtotime($data->order_date)):""',
                                    'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'model' => $model,
                                        'attribute' => 'order_date',
                                        'language' => 'en',
                                        'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
                                        'htmlOptions' => array(
                                            'id' => 'datepicker_for_order_date',
                                            'size' => '10',
                                        ),
                                        'defaultOptions' => array(// (#3)
                                            'showOn' => 'focus',
                                            'dateFormat' => 'dd-mm-yy',
                                            'showOtherMonths' => true,
                                            'selectOtherMonths' => true,
                                            'changeMonth' => true,
                                            'changeYear' => true,
                                            'showButtonPanel' => true,
                                        ),), true),
                                    'headerHtmlOptions' => array(
                                        'class' => 'cols-sm'
                                    ),
                                    'visible' => $model->enableCol($data['status'], array('Pending')),
                                ),
                                array(
                                    'name' => 'confirmed_date',
                                    'value' => '($data->confirmed_date!="0000-00-00 00:00:00")?date("d-m-Y",strtotime($data->confirmed_date)):""',
                                    'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'model' => $model,
                                        'attribute' => 'confirmed_date',
                                        'language' => 'en',
                                        'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
                                        'htmlOptions' => array(
                                            'id' => 'datepicker_for_confirmed_date',
                                            'size' => '10',
                                        ),
                                        'defaultOptions' => array(// (#3)
                                            'showOn' => 'focus',
                                            'dateFormat' => 'dd-mm-yy',
                                            'showOtherMonths' => true,
                                            'selectOtherMonths' => true,
                                            'changeMonth' => true,
                                            'changeYear' => true,
                                            'showButtonPanel' => true,
                                        ),), true),
                                    'headerHtmlOptions' => array(
                                        'class' => 'cols-sm'
                                    ),
                                    'visible' => $model->enableCol($data['status'], array('Confirmed','Production','Received','Shipped','Canceled')),
                                ),
                                 array(
                                    'name' => 'confirmed_date',
                                    'value' => '($data->confirmed_date!="0000-00-00 00:00:00")?date("d-m-Y",strtotime($data->confirmed_date)):""',
                                    'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'model' => $model,
                                        'attribute' => 'confirmed_date',
                                        'language' => 'en',
                                        'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
                                        'htmlOptions' => array(
                                            'id' => 'datepicker_for_confirmed_date',
                                            'size' => '10',
                                        ),
                                        'defaultOptions' => array(// (#3)
                                            'showOn' => 'focus',
                                            'dateFormat' => 'dd-mm-yy',
                                            'showOtherMonths' => true,
                                            'selectOtherMonths' => true,
                                            'changeMonth' => true,
                                            'changeYear' => true,
                                            'showButtonPanel' => true,
                                        ),), true),
                                    'headerHtmlOptions' => array(
                                        'class' => 'cols-sm'
                                    ),
                                    'visible' => $model->enableColStatus($data['paymentStatus'], array('Due')),
                                ),
                                array(
                                    'name'=>'shipped_date',
                                    'value' => '($data->shipped_date!="0000-00-00 00:00:00")?date("d-m-Y",strtotime($data->shipped_date)):""',
                                    'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'model' => $model,
                                        'attribute' => 'shipped_date',
                                        'language' => 'en',
                                        'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
                                        'htmlOptions' => array(
                                            'id' => 'datepicker_for_shipped_date',
                                            'size' => '10',
                                        ),
                                        'defaultOptions' => array(// (#3)
                                            'showOn' => 'focus',
                                            'dateFormat' => 'dd-mm-yy',
                                            'showOtherMonths' => true,
                                            'selectOtherMonths' => true,
                                            'changeMonth' => true,
                                            'changeYear' => true,
                                            'showButtonPanel' => true,
                                        ),), true),
                                    'headerHtmlOptions' => array(
                                        'class' => 'cols-md'
                                    ),
                                   'visible' => $model->enableCol($data['status'], array('Shipped')),
                                ),
                                array(
                                    'name'=>'canceled_date',
                                    'value' => '($data->canceled_date!="0000-00-00 00:00:00")?date("d-m-Y",strtotime($data->canceled_date)):""',
                                    'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'model' => $model,
                                        'attribute' => 'canceled_date',
                                        'language' => 'en',
                                        'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
                                        'htmlOptions' => array(
                                            'id' => 'datepicker_for_canceled_date',
                                            'size' => '10',
                                        ),
                                        'defaultOptions' => array(// (#3)
                                            'showOn' => 'focus',
                                            'dateFormat' => 'dd-mm-yy',
                                            'showOtherMonths' => true,
                                            'selectOtherMonths' => true,
                                            'changeMonth' => true,
                                            'changeYear' => true,
                                            'showButtonPanel' => true,
                                        ),), true),
                                    'headerHtmlOptions' => array(
                                        'class' => 'cols-md'
                                    ),
                                   'visible' => $model->enableCol($data['status'], array('Canceled')),
                                ),
                                array(
                                    'name' => 'order_number',
                                    'value' => 'Chtml::link($data->order_number,Yii::app()->createUrl("//admin/order/orderView/$data->id"),array("target"=>""))',
                                    'type' => 'raw',
                                    'headerHtmlOptions' => array(
                                        'class' => 'cols-md'
                                    ),
                                ),
                                array(
                                    'name' => 'name',
                                    'value' => '$data->userIdFk->first_name." ".$data->userIdFk->last_name',
                                    'header' => 'Name',
                                    'headerHtmlOptions' => array(
                                        'class' => 'cols-md'
                                    ),
                                ),
                                array(
                                    'name' => 'user_id_fk',
                                    'value' => '$data->userIdFk->email',
                                    'header' => 'Email',
                                    'headerHtmlOptions' => array(
                                        'class' => 'cols-lg'
                                    ),
                                ),
                                array(
                                    'name' => 'grand_total',
                                    'value'=>'number_format($data->grand_total,Yii::app()->params->decimalPoint)',
                                    'htmlOptions' => array('class' => 'right-align'),
                                    'filterHtmlOptions' => array('class' => 'right-align'),
                                    'headerHtmlOptions' => array('class' => 'cols-sm right-align'),
                                ),
                                // array(
                                //   'name' => 'payment_status',
                                //   'type'=>'raw',
                                //   //'value' => 'Order::model()->paymentStatus($data->id)',
                                //   'value' => 'Order::model()->paymentStatusHtml($data)',
                                //   'headerHtmlOptions' => array('class' => 'cols-md'),
                                //     'filter'=>CHtml::dropdownlist("Order[payment_status]",$model->payment_status,array("Paid"=>"Paid","Due"=>"Due"),array("class"=>'form-control','empty'=>'All')),
                                // ),
                           array(
                              'name' => 'status',
                              'type' => 'raw',
                              'filter' => CHtml::dropDownList("Order[status]", $model->status, array('Confirmed'=>'Confirmed','Production'=>'Production','Received'=>'Received','Shipped'=>'Shipped'),array("class"=>'form-control','empty'=>'All')),
                               'headerHtmlOptions' => array('class' => 'cols-md'),
                               'visible' => $model->enableColStatus($data['paymentStatus'], array('Due')),
                              ),
                                                array(
                                                    'class' => 'CButtonColumn',
                                                    'header' => 'Action',
                                                    'visible'=> true,
                                                    //'visible'=>($_GET['BookingInfo']['status']=="Pending")?true:false,
                                                    'template' => '{update}&nbsp;&nbsp;{view}',
                                                    //'deleteConfirmation' => false,
                                                    'buttons' => array(
                                                        'update' => array(
                                                            'label' => '<span class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></span>',
                                                            //'url'=>'Yii::app()->createUrl("//admin/settings/deleteCompany/",array("id"=>$data->id))',
                                                            'imageUrl' => false,
                                                            'options' => array(
                                                                'title' => 'Update',
                                                                //'class' => 'delConfirm',
                                                                //'data-toggle'=>'confirmation',
                                                            ),
                                                        ),
                                                        'view' => array(
                                                            'label' => '<span class="btn btn-xs btn-info"><i class="fa fa-eye"></i> Invoice</span>',
                                                            'url'=>'Yii::app()->createUrl("//admin/orderInvoice/index/",array("id"=>$data->id))',
                                                            'imageUrl' => false,
                                                            'options' => array(
                                                                'title' => 'View Invoice',
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


<style>
    .checknotify {
    background-color: orange;
    border-radius: 3px;
    color: #000;
    font-size: 12px;
    font-weight: bold;
    padding: 2px 4px;
}
</style>