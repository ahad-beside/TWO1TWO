<div class="row open_page">
    <?php $this->renderPartial('menuItems')?>
    <div class="col-md-12 custom-page-header">
        <div class="col-md-6"><h2>Orders</h2></div>
        <div class="col-md-6 action-button">
            <?php
            /* echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('products/create'), array('class' => 'btn btn-default btn-circle', 'title' => 'New Product'));
              echo CHtml::link('<i class="fa fa-list"></i>', $this->createUrl('products/admin'), array('class' => 'btn btn-default btn-circle', 'title' => 'All Products')); */
            ?>
        </div>
    </div>

    <div class="col-md-12"><?php echo Yii::app()->easycode->showNotification(); ?></div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Manage Orders</div>
            <div class="panel-body">
                <?php
                //$status='Delivered';
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'order-grid',
                    'htmlOptions' => array('class' => 'table-responsive'),
                    'itemsCssClass' => 'table table-hover table-striped custom-data-table',
                    'dataProvider' => $model->search('','Delivered'),
                    'filter' => $model,
                    'columns' => array(
                        array(
                            'class' => 'CCheckBoxColumn',
                            'value' => '$data->id',
                            'selectableRows' => '2',
                            'id' => 'actionCheck'
                        ),
                        array(
                            'class' => 'IndexColumn',
                            'header' => 'Sl',
                            'headerHtmlOptions' => array('style' => 'width:20px;'),
                        ),
                        //'order_number',
                        array(
                            'name'=>'order_number',
                            'value' => 'Chtml::link($data->order_number,Yii::app()->createUrl("//order/view/$data->id"),array("target"=>"_blank"))',
                            'type'=>'raw',
                        ),
                        array(
                            'name' => 'order_date',
                            'value' => '($data->order_date!="")?date("d-m-y",strtotime($data->order_date)):""',
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
                                )
                            ), true),
                        ),
                        array(
                            'name' => 'grand_total',
                            'type' => 'raw',
                            'htmlOptions' => array('class' => 'right-align'),
                            'filterHtmlOptions' => array('class' => 'right-align'),
                            'headerHtmlOptions' => array('class' => 'right-align'),
                        ),
                        'status',
                        /*array(
                            'name' => 'status',
                            'type' => 'raw',
                            'filter' => CHtml::dropDownList("Order[status]", $model->status, array('Pending'=>'Pending','Shipped'=>'Shipped','Delivered'=>'Delivered'), array('empty' => 'All')),
                            'htmlOptions' => array('class' => 'center-align'),
                        ),
                        
                          'description',
                          'metatag_title',
                          'metatag_description',
                          'metatag_keywords',
                          'image',

                          'sku',


                          'minimum_quantity',
                          'substract_stock',
                          'outofstock_status',
                          'seo_keyword',
                          'manufacturer',

                          'sort_order',
                          'update_by',
                          'update_time',
                         */
                        /*array(
                            'class' => 'CButtonColumn',
                            'template' => '{update}',
                        ),*/
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-data-table tbody tr td{vertical-align: middle}
    .right-align{text-align: right}
    center-align{text-align: center}
</style>