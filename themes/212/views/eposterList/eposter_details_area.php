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

         <?php if(isset($data['posterDetails']) && $data['posterDetails']!=''){?>

        <div class="shop-content">

          <h1><?= $data['posterDetails']->name?></h1>

          <p><i>Date & Time: <?= date('d-m-Y',strtotime($data['posterDetails']->expire_date))?> <?= date('h:i A',strtotime($data['posterDetails']->expire_date))?></i></p><br>

          <?= $data['posterDetails']->description?>

          <hr>
          <div class='input-group' style="float: right;margin-bottom: 10px;">  
            <input class='form-control' style='background-color:#efefef;height: 40px!important;width: 250px;' type='text' id='attributeSearchInput' onkeyup='attributeSearchFunction()' placeholder='Search by speaker name'> 
          </div>

          <table class="table table-hover table-responsive" style="margin-top: 10px;">

            <thead>

              <tr>

                <th>Session Name</th>

                <th>Speaker</th>

                <th>&nbsp;</th>

                <th>Date</th>

                <th>Time</th>

                <th>&nbsp;</th>

              </tr>

            </thead>

            <tbody id='attributeSearchUL'>
              <?php foreach($data['posterDetails']->eposterDoc as $rowDoc):?>
              <tr>
                <td><?= $rowDoc->title?></td>
                <td>
                  <img class="img-responsive" style="width: 60px;height: 60px;" src="<?= Yii::app()->easycode->showOriginalImage(Profile::model()->find("user_id=".$rowDoc->speaker_id)->photo,'/user/');?>">
                  </td>
                  <td>
                  <span><?= User::model()->findByPk($rowDoc->speaker_id)->first_name.' '.User::model()->findByPk($rowDoc->speaker_id)->last_name;?></span></td>
                <td><?= date('d F Y',strtotime($rowDoc->date_time))?></td>
                <td><?= date('h:i A',strtotime($rowDoc->date_time))?></td>
                <?php if($rowDoc->document_type=='Choose Template'){?>
                <td><a target="_blank" href="<?= Yii::app()->createUrl('//eposterList/details',array('id'=>$rowDoc->id))?>"><button type="button" class="btn btn-warning btn-sm">View</button></a></td>
                <?php }else{?>
                <td><a target="_blank" href="<?= Yii::app()->easycode->showOriginalImage($rowDoc->image,Yii::app()->params->ePosterDir)?>"><button type="button" class="btn btn-warning btn-sm">View</button></a></td>
                <?php } ?>
              </tr>
            <?php endforeach;?>
            </tbody>

          </table>

      </div>

      <?php } ?>

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

<script>
function attributeSearchFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("attributeSearchInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("attributeSearchUL");
    li = ul.getElementsByTagName("tr");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("span")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";

        }
    }
}
</script>