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
        <?php $this->renderPartial('/user/sidebar',array('data'=>$data)); ?>
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
      <?php
                                        $this->widget('zii.widgets.grid.CGridView', array(
                                            'id' => 'invoice-grid',
                            'htmlOptions' => array('class' => 'data-grid table-responsive'),'itemsCssClass' => 'table table-striped table-bordered table-hover','template' => '{items}{pager}',
                            'dataProvider' => $model->searchUserInvoice(),
                            //'summaryCssClass' => 'gridview-summary',
                            //'filter' => $model,
                            //'filterCssClass' => 'filter-inputs',
                                            'columns' => array(
                                              // array(
                                              //      'class' => 'CCheckBoxColumn',
                                              //      'value' => '$data->id',
                                              //      'selectableRows' => '2',
                                              //      'id' => 'actionCheck',
                                              //       'headerHtmlOptions' => array('style' => 'width:20px;'),
                                              //  ),
                                                array(
                                                    'class' => 'IndexColumn',
                                                    'header' => '#',
                                                    'headerHtmlOptions' => array('style' => 'width:20px;'),
                                                ),
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
                    'value' => 'Chtml::link($data->invoice_number, Yii::app()->createUrl("//orderInvoice/view/$data->id"),array("class"=>"link"))',
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
      <div>
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