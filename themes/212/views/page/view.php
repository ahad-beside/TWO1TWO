<div class="content-page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb"> <a href="<?= Yii::app()->homeUrl;?>"><i class="icon-home"></i> Home</a> <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span> <span class="current"><?php echo $model->title?></span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Page Header -->

<section id="content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1><?php //echo $model->title?></h1>
      <?php echo $model->description?>
      </div>
    </div>
  </div>
</section>