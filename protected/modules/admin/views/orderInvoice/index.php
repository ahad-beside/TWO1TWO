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
                            <?php //$this->renderPartial('menuItems',array('status'=>$data['status'])) ?>
                            <div class="col-md-12">
                                 
                            <?php //$this->renderPartial('_search', array('model'=>$model))?>
                                <div class="portlet box">

                                    <div class="portlet-body" style="display: block;">
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
                                                // array(
                                                //     'class' => 'IndexColumn',
                                                //     'header' => '#',
                                                //     'headerHtmlOptions' => array('style' => 'width:20px;'),
                                                // ),
                                                 array(
                    'name' => 'invoice_date',
                    'value' => '($data->invoice_date!="")?date("d-m-Y",strtotime($data->invoice_date)):""',
                    'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'invoice_date',
                        'language' => 'en',
                        'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
                        'htmlOptions' => array(
                            'id' => 'datepicker_for_order_date',
                            'size' => '10',
                            'class' => 'form-control',
                        ),
                        'defaultOptions' => array(// (#3)
                            'showOn' => 'focus',
                            'dateFormat' => 'dd-mm-yy',
                            'showOtherMonths' => true,
                            'selectOtherMonths' => true,
                            'changeMonth' => true,
                            'changeYear' => true,
                            'showButtonPanel' => true,
                        )
                            ), true),
                ),
                array(
                    'name' => 'invoice_number',
                    'value' => 'Chtml::link($data->invoice_number, Yii::app()->createUrl("//admin/orderInvoice/view/$data->id"),array("class"=>"link"))',
                    'type' => 'raw',
                    'filter' => CHtml::textField("Order[invoice_number]", $model->invoice_number, array('class' => 'form-control')),
                ),
                array(
                    'name' => 'invoice_amount',
                    'value' => 'strtoupper(number_format($data->invoice_amount,Yii::app()->params->decimalPoint))',
                    'filter' => CHtml::textField("Order[invoice_amount]", $model->invoice_amount, array('class' => 'form-control')),
                    'headerHtmlOptions' => array('style' => 'text-align:right'),
                    'htmlOptions' => array('style' => 'text-align:right'),
                ),
                array(
                    'name' => 'payment_status',
                    'filter' => CHtml::dropDownList("Order[payment_status]", $model->payment_status, array('Pending' => 'Pending', 'Shipped' => 'Shipped', 'Delivered' => 'Delivered'), array('empty' => 'All', 'class' => 'form-control')),
                ),
                array(
                    'name' => 'payment_status',
                    'value' => 'OrderInvoice::model()->paymentStatusHtml($data)',
                    'headerHtmlOptions' => array('class' => 'cols-sm'),
                    'type' => 'raw',
                    'filter' => CHtml::dropdownlist("OrderInvoice[payment_status]", $model->payment_status, array("Paid" => "Paid", "Due" => "Due"), array("class" => 'form-control', 'empty' => 'All')),
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