<div class="content-page-header" style="margin-top:61px;">

  <div class="container">

    <div class="row">

      <div class="col-md-9 col-sm-9 col-xs-9">

        <div class="breadcrumb">

<a href="<?= Yii::app()->homeUrl;?>"><i class="icon-home"></i> Home</a>

<span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span>

<span class="current">212Poster</span>

</div>

 </div>
 <div class="col-md-3 col-sm-3 col-xs-3">
<?php if(isset(Yii::app()->user->roles) && Yii::app()->user->roles=='Speaker'){?>
        <a class="btn btn-success" href="<?=Yii::app()->createUrl('//user/dashboard')?>">Create 212poster</a>
<?php } ?>

</div>

 </div>

<div class="col-md-6 col-sm-6 col-xs-6">

	<?php if(!isset(Yii::app()->user->roles)){?>

<!-- <a style="float: right;color: #fff;margin-left: 10px;" href="<?//= Yii::app()->createUrl('//site/registration?role=Event')?>" class="btn btn-sm btn-success">Register Now</a> -->

<a style="float: right;color: #fff;" href="<?= Yii::app()->createUrl('//site/login')?>" class="btn btn-sm btn-info">Sign In</a>

<?php }?>
<?php /*if(Yii::app()->user->roles=='Speaker'){?>
  <a style="float: right;color: #fff;" href="<?= Yii::app()->createUrl('//user/dashboard')?>" class="btn btn-sm btn-info">Post 212Poster</a>
<?php }}*/?>

</div>

    </div>

  </div>

</div>

<!-- End Page Header -->

<div class="product-area" style="padding:50px 0px;">

  <div class="container">

    <div class="row">
<div class="col-md-12"><h4 style="font-size:14px;">Please select an event to 
view posters and abstracts</h4></div>
      <div class="col-md-4 col-sm-4 col-xs-12">

        <?php $this->renderPartial('eposter_sidebar',array('data'=>$data)); ?>

      </div>

      <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="row">
    <div class="col-md-12">
      <div id="new-slider" class="owl-carousel new-products">
        <?php foreach($data['advertisement'] as $rowAdvertisement):
        ?>
        <div class="item">
          
              <img src="<?=Yii::app()->easycode->showOriginalImage($rowAdvertisement['image'],'/advertisement/');?>" width="100%" height="210" alt="<?= $rowAdvertisement['name'];?>">
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>

  </div>

</div>



<style>

.modal {

  text-align: center;

  padding: 0!important;

}



.modal:before {

  content: '';

  display: inline-block;

  height: 100%;

  vertical-align: middle;

  margin-right: -4px;

}



.modal-dialog {

  display: inline-block;

  text-align: left;

  vertical-align: middle;

}

	.shop-content{

		width:100%;

		display:inline-block;

		background-color:#FFF;

		padding:12px;

	}

	.shop-content h2{

		font-size:25px;

	}

	.dtls{

		color:#000;

	}

</style>