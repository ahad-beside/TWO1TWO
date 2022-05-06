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
            <div class="col-md-9 col-sm-9 col-xs-12">
              <div class="shop-content">
                <div class="perrow">
                  <div class="row">
                    <div class="col-md-12">
                      <h2>Event: <?= $modelEposter->name;?></h2>
                      <p>Date & Time: <?= date('d-m-Y',strtotime($modelEposter->expire_date))?> <?= date('h:i A',strtotime($modelEposter->expire_date))?></p>
                      <hr>
                      <div class="row">
                        <div class="col-md-12">
                            <div class="login">
                                <div class="">
                                    <?php
                                            $this->widget('zii.widgets.grid.CGridView', array(
                                                'id' => 'job-view-data',
                                                'htmlOptions' => array('class' => 'data-grid table-responsive'),
                                                'itemsCssClass' => 'table table-striped table-bordered table-hover table-responsive',
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
                                                    array(
                                                    'name'=>'date_time',
                                                    'header'=>'Date',
                                                    'value'=>'date("d-m-Y",strtotime($data->date_time))',
                                                    ),
                                                    array(
                                                    'name'=>'date_time',
                                                    'header'=>'Time',
                                                    'value'=>'date("h:i A",strtotime($data->date_time))',
                                                    ),
                                                    'title',
                                                    // 'document_type',
                                                    array(
                                                      'name'=>'document_type',
                                                      'value'=>'($data->document_type=="Upload Document"?"Document":"Template")',
                                                    ),
                                                    array(
                                                    'header'=>'Document',
                                                    'name'=>'image',
                                                    'value'=>'EposterImage::model()->getDocument($data->id)',
                                                    'type'=>'raw',
                                                    ),
                                                    
                                                    array(
                                                        'class' => 'CButtonColumn',
                                                        'header' => 'Action',
                                                        'template' => '{update} &nbsp;&nbsp;{delete}',
                                                    //'deleteConfirmation' => false,
                                                        'buttons' => array(
                                                            'update' => array(
                                                                'label' => '<span class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></span>',
                                                            //'url'=>'Yii::app()->createUrl("//user/updateDocument/",array("id"=>$data->id))',
                                                                'url'=>'EposterImage::model()->getDocumentButtonVisible($data->id)',
                                                                'imageUrl' => false,
                                                                'options' => array('title' => 'Update'),
                                                                //'visible'=>'EposterImage::model()->getDocumentButtonVisible($data->id)',
                                                            ),
                                                            'delete' => array(
                                                                'label' => '<span class="btn btn-xs btn-danger"><i class="fa fa-times"></i></span>',
                                                            'url'=>'Yii::app()->createUrl("//user/documentDelete/",array("id"=>$data->id))',
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