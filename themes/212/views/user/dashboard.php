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

      <?php if(isset(Yii::app()->user->roles) && Yii::app()->user->roles!='Speaker'){?>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="shop-content">
          <div class="perrow">
                <div class="row">
                <div class="col-md-12">
                  <h2>Summary</h2>
                  <hr>
    <div class="row">
      <a href="<?=Yii::app()->createUrl('//order/index',array('Order[status]'=>'Pending'))?>">
      <div class="col-md-3">
        <div class="alert alert-warning">
          <h4 class="" style="text-align: center;"><?= $data['pendingOrder'];?> </h4>
          <h4 style="text-align: center;">Pending Order </h4>
        </div>
      </div>
    </a>
    <a href="<?=Yii::app()->createUrl('//order/index',array('Order[status]'=>'Confirmed'))?>">
      <div class="col-md-3">
        <div class="alert alert-success">
          <h4 class="" style="text-align: center;"><?= $data['confirmedOrder'];?> </h4>
          <h4 style="text-align: center;">Confirmed Order </h4>
        </div>
      </div>
    </a>
    <a href="<?=Yii::app()->createUrl('//order/index',array('Order[status]'=>'Shipped'))?>">
      <div class="col-md-3">
        <div class="alert alert-info">
          <h4 class="" style="text-align: center;"><?= $data['shippedOrder'];?> </h4>
          <h4 style="text-align: center;">Shipped Order </h4>
        </div>
      </div>
    </a>
    <a href="<?=Yii::app()->createUrl('//order/index',array('Order[status]'=>'Canceled'))?>">
      <div class="col-md-3">
        <div class="alert alert-danger">
          <h4 class="" style="text-align: center;"><?= $data['canceledOrder'];?> </h4>
          <h4 style="text-align: center;">Canceled Order </h4>
        </div>
      </div>
    </a>
    </div><!--/row--> 
                </div>
                </div>
                </div>
        </div>
      </div>
      <?php } else{?>
          <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="shop-content">
          <div class="perrow">
                <div class="row">
                <div class="col-md-12">
                  <h2>Event List</h2>
                  <hr>
    <div class="row">
      <div class="col-md-12">
        <?php
                      $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'job-view-data',
                        'htmlOptions' => array('class' => 'data-grid table-responsive'),
                        'itemsCssClass' => 'table table-striped table-bordered table-hover',
                        'template' => '{items}{pager}',
                        'dataProvider' => $model->search(),
                        'columns' => array(
                                 // array(
                                 //     'class' => 'CCheckBoxColumn',
                                 //     'value' => '$data->id',
                                 //     'selectableRows' => '2',
                                 //     'id' => 'actionCheck'
                                 // ),
                          array(
                            'class' => 'IndexColumn',
                            'header' => '#',
                            'headerHtmlOptions' => array('style' => 'width:20px;'),
                          ),
                          // array(
                          // 'name'=>'user_id',
                          // 'value'=>'$data->user->first_name." ".$data->user->last_name',
                          // 'visible'=>Yii::app()->user->roles != "ePosterAdmin" ?true:false,
                          // ),

                          array(
                          'name'=>'expire_date',
                          'value'=>'date("d-m-Y",strtotime($data->expire_date))',
                          ),
                          'name',
                          array(
                            'class' => 'CButtonColumn',
                            'header' => 'Action',
                            'template' => '{upload}&nbsp;&nbsp;{view}',
                                                    //'deleteConfirmation' => false,
                            'buttons' => array(
                              'upload' => array(
                                'label' => '<span class="btn btn-xs btn-primary"><i class="fa fa-upload"></i> Upload Documents</span>',
                                  'url'=>'Yii::app()->createUrl("//user/eposterDocumentUpload/",array("id"=>$data->id))',
                                'imageUrl' => false,
                                'options' => array(
                                  'title' => 'Upload Document',
                                  //'class' => 'td-view-details',
                                 // 'data-toggle'=>'lightbox',
                                  //'data-width'=>'1000',
                                ),
                              ),
                              'view' => array(
                                'label' => '<span class="btn btn-xs btn-success"><i class="fa fa-eye"></i> View Documents</span>',
                                  'url'=>'Yii::app()->createUrl("//user/eposterDocumentView/",array("id"=>$data->id))',
                                'imageUrl' => false,
                                'options' => array(
                                  'title' => 'View',
                                  //'class' => 'td-view-details',
                                  //'data-toggle'=>'lightbox',
                                  //'data-width'=>'1000',
                                ),
                              ),
                            ),
                          ),
                        ),
                      ));
                      ?>
      </div>
    </div><!--/row--> 
                </div>
                </div>
                </div>
        </div>
      </div>
      <?php } ?>


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
<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                'doc':top.document
            });
        });
</script>