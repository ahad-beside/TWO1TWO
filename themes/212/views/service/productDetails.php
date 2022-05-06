<!-- Start Page Header -->
<div class="page-header paralax_container paralaxbg" style="background-image:url(<?=Yii::app()->theme->baseUrl;?>/assets/img/page_title.jpg)">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
          <h1 style="margin-bottom:0px;"><?= $model->name?></h1>
            <p>
              <div class="breadcrumb">
<a href="<?= Yii::app()->homeUrl;?>"><i class="icon-home"></i> Home</a>
<span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span>
<span class="current">Service Details</span>
</div>
            </p>
      </div>
    </div>
  </div>
</div>
<!-- End Page Header --> 
<?php
  if(isset(Yii::app()->user->roles) && Yii::app()->user->roles=='Reseller')
    $price=$model->reseller_price;
  else
    $price=$model->price;
?>
<!-- products detial start -->
<section id="product-collection" class="section20">
  <div class="container">
    <div class="row">
      <div class="white-bg">
        <div class="col-md-4 col-sm-6 col-xs-12 nopadding">
          <div class="product-details-image">
            <div class="slider-for slider text-center">
              <div> <img src="<?=Yii::app()->easycode->showOriginalImage($model->image,'/product/');?>" alt=""> </div>
              <?php foreach($data['images'] as $rowBigImage):?>
              <div> <img src="<?=Yii::app()->easycode->showOriginalImage($rowBigImage->image,'/product/');?>" alt=""> </div>
            <?php endforeach;?>
            </div>
            <ul id="productthumbnail" class="slider slider-nav">
              <li> <img src="<?=Yii::app()->easycode->showOriginalImage($model->image,'/product/');?>" width="100" height="100" alt=""> </li>
              <?php foreach($data['images'] as $rowSlideImage):?>
              <li> <img src="<?=Yii::app()->easycode->showOriginalImage($rowSlideImage->image,'/product/');?>" width="100" height="100" alt=""> </li>
              <?php endforeach;?>
            </ul>
          </div>
        </div>
        <form action="#" method="post" id="addtocart">
          <input type="hidden" name="item_from" value="Service"/>
          <input type="hidden" name="product-id" value="<?php echo $model->id ?>"/>
           <input type="hidden" data-price="<?= $price;?>" class="servicePrice" name="product-price" value="<?php echo $price ?>"/>
        <div class="col-md-8 col-sm-6 col-xs-12">
          <div class="info-panel">
            <h1 class="product-title"><?= $model->name;?></h1>
            <div class="ratting float-right">
              <?php if($data['totalRating']->rating_point>0){?>
                  <?php $avgRating= number_format($data['totalRating']->rating_point/count($data['allReview']),0)?>
                  <?php }?>
              <div class="product-star"> <?php if($data['totalRating']->rating_point>0){?><img style="width: 100px;" src="<?= Yii::app()->request->baseUrl;?>/upload/star<?= $avgRating?>.png" alt=""><?php } ?> <span>(<a class="reviewClick" href="#showReview"><?= $avgRating;?> Customer Review)</a></span> </div>
            </div>
            <div class="price-ratting">
              <div class="price float-left"> $<?= $price;?> </div>
              <input type="hidden" data-rule="quantity" value="1" name="productQty">
              <input type="hidden" class="sebscriptionMonth" data-rule="subscriptionMonth" value="1" name="subscriptionMonth">
              <div style="float:left;"> 
                <?php if($model->subscription=='Yes'){?>
                <select name="subscription" class="form-control selectSubscription">
                  <option value="">Select Subscription</option>
                  <?php if(count($data['subscription'])>0){
                    foreach($data['subscription'] as $rowSubscription):
                    ?>
                  <option value="<?=$rowSubscription->id?>"><?=$rowSubscription->name?></option>
                  <?php endforeach;} ?>
                  option
                </select>
                <span class="errorMessage"> </span>
<?php } ?>
              </div>

              <div class="price float-left subscriptionPrice" style="margin-left: 10px;">  </div>
              <div class="clearfix">
                &nbsp;
              </div>
              <div style="float:left;"> 
<button type="button" class="btn btn-red font-bold" id="addtocartbutton">Buy Now </button>
              </div>
            </div>
            <div class="short-desc">
              <h5 class="sub-title"><?= $model->getAttributeLabel('quick_view');?></h5>
              <p><?= $model->quick_view;?></p>
            </div>
          </div>
        </div>
        </form>
        
          <div class="single-pro-tab">
                  <div class="single-pro-tab-menu">
                    <ul class="">
                      <?php if($model->description!=''){?>
                      <li class="active"><a href="#description" data-toggle="tab"><?= $model->getAttributeLabel('description');?></a></li>
                      <?php } ?>
                      <?php if($model->specification!=''){?>
                      <li><a href="#specification" data-toggle="tab"><?= $model->getAttributeLabel('specification');?></a></li>
                      <?php } ?>
                      <?php if($model->feature!=''){?>
                      <li><a href="#features" data-toggle="tab"><?= $model->getAttributeLabel('feature');?></a></li>
                      <?php } ?>
                      <?php if($model->benifits!=''){?>
                      <li><a href="#benifits" data-toggle="tab"><?= $model->getAttributeLabel('benifits');?></a></li>
                      <?php } ?>
                      <?php if(count($data['download'])>0){?>
                      <li><a href="#download" data-toggle="tab"><?= $model->getAttributeLabel('download');?></a></li>
                      <?php }?>
                      <li><a class="triggerRivew" href="#reviews" data-toggle="tab">Reviews</a></li>
                    </ul>
                  </div>
                  <div class="tab-content">
                    <div class="tab-pane active" id="description">
                      <div class="pro-tab-info pro-description">
                        <?= $model->description;?>
                      </div>
                    </div>
                    <div class="tab-pane" id="specification">
                      <div class="pro-tab-info pro-information">
                        <?= $model->specification;?>
                      </div>
                    </div>
                    <div class="tab-pane" id="features">
                      <div class="pro-tab-info pro-information">
                        <?= $model->feature;?>
                      </div>
                    </div>

                    <div class="tab-pane" id="benifits">
                      <div class="pro-tab-info pro-information">
                        <?= $model->benifits;?>
                      </div>
                    </div>
                    <?php if(count($data['download'])>0){?>
                    <div class="tab-pane" id="download">
                      <div class="pro-tab-info pro-information">
                        <h3 class="small-title">Download</h3>
                        <?php foreach($data['download'] as $rowDownload):?>
                        <p><a target="_blank" href="<?=Yii::app()->easycode->showOriginalImage($rowDownload->image,'/product/');?>">Click Here</a></p>
                      <?php endforeach;?>
                      </div>
                    </div>
                    <?php }?>
                    <div class="tab-pane" id="reviews">
                      <div class="pro-tab-info pro-reviews">
                        <div class="customer-review">
                          <section>
  <div class="deal">
    <div class="row">
      <div class="col-md-12 page-service-details">
        <div class="service-what-our-passengers-say section">

        <h3 id="reviews">What Our Customer Say</h3>
          <div class="supplier-details" style="margin-bottom: 20px;">
            <div itemprop="aggregateRating">
              <div class="wrapper">
                <div class="reviews-header"> <span style="padding:0px" class="average-rating">
                  <?php if($data['totalRating']->rating_point>0){?>
                  <?=$avgRating= number_format($data['totalRating']->rating_point/count($data['allReview']),2)?>
                  <?php } else{?>
                  0.00
                  <?php } ?>
                </span>
                  <span class="supplier-rating">
                                                      </span> <span style="margin:0px;" class="supplier-reviews"><span itemprop="reviewCount">From <?= count($data['allReview']);?></span> reviewers</span> </div>
              </div>
            </div>
          </div>
          <div id="writeReviewFrom" class="col-md-6" style="background-color:#eee;font-size:14px;display: none;">
          <h3>Write your review</h3>
          <hr style="margin:0px!important;">
          <?php if(isset(Yii::app()->user->userId)){?>
       <div class="leave-review">
        <div class="alert alert-success submitSuccess" style="display: none;">
          Your review successfully submit and waiting for approval.
        </div>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'review-form',
            'action'=>$this->createUrl('#'),
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
                'validateOnChange' => true,
            ),
            'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
        ));
        echo $form->hiddenField($modelReview, 'review_type', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','value' => 'Service'));
        echo $form->hiddenField($modelReview, 'product_id', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','value' => $model->id));
        ?>
        <?php /*?>
        <div class="form-group">
        <div class="col-md-6">
          <?php echo $form->labelEx($modelReview, 'name', array('class' => 'control-label')); ?>
                    <?php echo $form->textField($modelReview, 'name', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control', 'placeholder' => $modelReview->getAttributeLabel('name'))); ?>
                      <?php echo $form->error($modelReview, 'name'); ?>
                  
        </div>

        <div class="col-md-6">
          <?php echo $form->labelEx($modelReview, 'email', array('class' => 'control-label')); ?>
                    <?php echo $form->textField($modelReview, 'email', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control', 'placeholder' => $modelReview->getAttributeLabel('email'))); ?>
                        <?php echo $form->error($modelReview, 'email'); ?>
                  </div>
        </div>
        <?php */?>
        <div class="form-group">
        <div class="col-md-12">
          <?php echo $form->labelEx($modelReview, 'details', array('class' => 'control-label')); ?>
                     <?php echo $form->textArea($modelReview, 'details', array('class' => 'form-control', 'placeholder' => $modelReview->getAttributeLabel('details'))); ?>
                      <?php echo $form->error($modelReview, 'details'); ?>
                  </div>
                   </div>
                   <div class="form-group">
        <div class="col-md-6">
          <?php echo $form->labelEx($modelReview, 'rating_point', array('class' => 'control-label')); ?><br>
          <?php echo $form->dropDownList($modelReview, 'rating_point',array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'), array('class' => 'form-control')); ?>
                     <div class="rating">
                                  <!-- <input type="radio" id="star5" name="Review[rating_point]" value="5" />
                                  <label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                  <input type="radio" id="star4" name="Review[rating_point]" value="4" />
                                  <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                  <input type="radio" id="star3" name="Review[rating_point]" value="3" />
                                  <label class = "full" for="star3" title="Meh - 3 stars"></label>
                                  <input type="radio" id="star2" name="Review[rating_point]" value="2" />
                                  <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                  <input type="radio" id="star1" name="Review[rating_point]" value="1" />
                                  <label class = "full" for="star1" title="Sucks big time - 1 star"></label> -->
                                  <?php echo $form->error($modelReview, 'rating_point'); ?>
                                </div>
                  </div>
                   </div>
                   <div class="form-group">
                                                <div class="col-md-3">
                                                    <button style="margin-top: 0px;" type="button" class="btn btn-success reviewSubmit">Submit</button>
                                                </div>
                                        </div>
        <?php $this->endWidget(); ?>
                        </div>
                        <?php } else{?>
                      <div class="alert alert-warning">
                        Please <a href="<?= Yii::app()->createUrl('//site/login?referalUrl='.$data['actual_link'].'&')?>">Login</a> to write Review
                      </div>
                        <?php } ?>
              </div>
          <section class="review-tabs" style="margin-bottom: 20px; width:100%; display:inline-block;">
            <ul class="navtabs" role="tablist">
              <li role="presentation">
                <p class="action-all-reviews" aria-controls="all-reviews" role="tab" data-toggle="tab">All reviews <span>(<?=count($data['allReview'])?>)</span></p>
              </li>
              
              <li role="" style="float: right;">
                <a id="writeReview" href="javascript:;" style="margin-top: -5px" class="btn btn-success btn-xs"><strong><i class="fa fa-edit"></i> Write Review</strong></a>
              </li>
            </ul>
          </section>
          <div class="section-reviews tab-content">
            <div role="tabpanel" class="content-all-reviews tab-pane fade in active" id="all-reviews">
              
              <?php 
              if(count($data['allReview'])>0){
              $i=0;
              foreach($data['allReview'] as $rowReview):
                $i++;
                ?>
              <div class="row group <?php if($i<11){?>active<?php } ?>">
                <div class="col-xs-12">
                <span class="reviewer" style="font-size: 26px!important;"><span itemprop="author"><?= $rowReview->user->first_name.' '.$rowReview->user->last_name;?> </span> </span> <img style="margin-top: -10px; width: 100px;" src="<?= Yii::app()->request->baseUrl;?>/upload/star<?= $rowReview->rating_point?>.png" alt=""> </div>
                <div class="col-xs-12">
                  <p class="review-content" itemprop="reviewBody">
                    <span class="comment-visible more"><?= $rowReview->details;?></span>
                </p>
                </div>
              </div>
              <?php endforeach;}?>
                                      
              <div class="readmore-buttons row" style="margin-top: 8px;" id="showReview">
                <p><button id="load-more" class="btn btn-success">Load More</button></p>
                
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
                      </div>
                    </div>
                  </div>
          </div>
        
      </div>  
    </div>
  </div>
  <?php if(count($data['relatedProduct'])>0){?>
  <div class="related_product">
    <?php $this->renderPartial('related_products',array('data'=>$data)); ?>
  </div>
  <?php } ?>
  
</section>
<!-- product detials end --> 
<script>
  $('.reviewClick').click(function(){
    $('.triggerRivew').trigger('click');
  });
  $(document).on('click','.reviewSubmit',function(){
    var fromData=$('#review-form').serialize();
    $.post("<?= Yii::app()->createUrl('//user/review')?>",fromData,function(data){
      if(data==1){
        $('.submitSuccess').show();
        $('#Review_details').val('');
      }else{
        $('.submitSuccess').hide();
      }
    });
  });
</script>
<style>
.morecontent span {
    display: none;
}
.morelink {
    display: block;
    font-weight: bold;
}
.service-what-our-passengers-say h3 {
    margin-bottom: 15px;
}
.page-service-details .reviews-header .average-rating {
    background-color: #65c816;
    border-radius: 4px;
    color: #fff;
    display: inline-block;
    font-size: 20px;
    height: 32px;
  line-height:30px;
    margin-right: 20px;
    padding: 2px 12px;
    text-align: center;
    vertical-align: middle;
    width: 52px;
}
.page-service-details .reviews-header .supplier-rating {
    display: inline-block;
    vertical-align: middle;
}
fieldset, label { margin: 0; padding: 0; }


/****** Style Star Rating Widget *****/

.rating { 
  border: none;
  float: left;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 5px;
  font-size: 1.25em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before { 
  content: "\f089";
  position: absolute;
}

.rating > label { 
  color: #ddd; 
 float: right; 
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 

.page-service-details .reviews-header .supplier-reviews {
    color: #333;
    display: inline-block;
    font-family: "Open Sans",sans-serif;
    font-size: 16px;
    margin-left: 25px;
    margin-top: 7px;
}
.page-service-details ul.navtabs {
    list-style-type: none;
    padding-bottom: 0;
    padding-left: 0;
}
.page-service-details ul.navtabs li:first-child {
    margin-right: 15px;
    padding-right: 18px;
}
.page-service-details ul.navtabs li {
    display: inline-block;
    height: 16px;
}
.page-service-details ul.navtabs li p {
    color: #333;
    display: block;
    font-weight: 600;
    margin-top: -2px;
    text-decoration: none;
}


.page-service-details .col-left {
  padding-right: 0;
  padding-left: 0
}
.page-service-details .col-right {
  padding-left: 20px;
  padding-right: 0
}
.page-service-details h1 {
  margin-top: 0;
  margin-bottom: 12px
}
.page-service-details h3 {
  margin-bottom: 15px
}
.page-service-details .section {
  margin-bottom: 40px
}
.page-service-details .section:last-child {
  margin-bottom: 0
}
.page-service-details .popover {
  max-width: 320px!important;
  width: 320px!important
}
.page-service-details .popover .popover-title {
  font-size: 14px;
  line-height: normal
}
.page-service-details .service-map {
  height: 400px;
  border: 1px solid #e3e3e3;
  margin-bottom: 15px;
  -webkit-transform: none!important
}
.page-service-details .service-photo {
  width: 642px;
  height: 382px;
  position: relative;
  overflow: hidden;
  border: 1px solid #e3e3e3;
  text-align: center
}
.page-service-details .service-photo ul {
  margin: 0;
  padding: 0
}
.page-service-details .service-photo li {
  background: #fff
}
.page-service-details .service-photo a {
  position: absolute;
  z-index: 10;
  color: #fff;
  font-size: 30px;
  text-decoration: none;
  background: rgba(33,40,46,.8);
  display: block;
  top: 40%;
  padding: 4% 3%
}
.page-service-details .service-photo a.control-prev {
  left: 0;
  border-top-right-radius: 4px;
  border-bottom-right-radius: 4px
}
.page-service-details .service-photo a.control-next {
  right: 0;
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px
}
.page-service-details .service-photo .image-count {
  position: absolute;
  width: 100%;
  top: 350px;
  font-size: 20px;
  color: #fff;
  text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
  z-index: 10;
  margin: 0
}
.page-service-details .service-highlights ul {
  padding-left: 0;
  list-style: inside
}
.page-service-details .btn-scroll-to-book, .page-service-details .btn-show-all-reviews {
  font-size: 12px
}
.page-service-details .service-book {
  border: 1px solid #e3e3e3;
  text-align: center;
  vertical-align: middle;
  margin-bottom: 10px
}
.page-service-details .service-book .block-link {
  line-height: 94px
}
.page-service-details .service-book .block-link a {
  text-decoration: none
}
.page-service-details .service-book .block-fare {
  border-top: 1px solid #e3e3e3;
  height: 72px;
  vertical-align: middle;
  background: #f4f4f4;
  padding-top: 3px
}
.page-service-details .service-book .block-fare label {
  font-size: 16px;
  font-weight: bold;
  padding-top: 28px;
  text-align: right;
  margin-bottom: 0;
  color: #333
}
.page-service-details .service-book .block-fare span {
  font-size: 42px;
  font-weight: bold;
  text-align: left;
  padding-left: 0;
  color: #333
}
.page-service-details .service-book .block-fare span small {
  font-size: 12px
}
.page-service-details .service-book .block-fare p {
  font-size: 12px;
  color: #666
}
.page-service-details .service-book .block-inclusives {
  border-top: 1px solid #e3e3e3;
  text-align: left
}
.page-service-details .service-book .block-inclusives i {
  margin-left: 12px;
  margin-right: 12px;
  vertical-align: middle
}
.page-service-details .service-book .block-inclusives span {
  display: inline-block;
  font-size: 13px;
  color: #777;
  width: 90px;
  vertical-align: middle;
  line-height: 14px;
  padding: 15px 0
}
.page-service-details .service-what-you-get {
  border: 1px solid #e3e3e3;
  padding: 15px;
  margin-bottom: 10px
}
.page-service-details .service-what-you-get h3 {
  margin-top: 0
}
.page-service-details .service-what-you-get ul {
  list-style: none;
  padding-left: 25px;
  list-style-position: inside;
  font-size: 14px
}
.page-service-details .service-what-you-get ul li {
  font-style: italic;
  margin-bottom: 5px
}
.page-service-details .service-what-you-get ul li i {
  vertical-align: middle
}
.page-service-details .service-summary {
  border: 1px solid #e3e3e3
}
.page-service-details .service-summary h3 {
  border-bottom: 1px solid #e3e3e3;
  font-size: 18px;
  margin-bottom: 0;
  margin-top: 0;
  padding: 10px 15px;
  line-height: 28px
}
.page-service-details .service-summary h4 {
  color: #666;
  font-size: 16px;
  font-weight: normal;
  margin-bottom: 20px;
  margin-top: 0;
  text-transform: uppercase
}
.page-service-details .service-summary label {
  font-weight: normal;
  font-size: 12px;
  margin-bottom: 0;
  padding-right: 0
}
.page-service-details .service-summary .value {
  font-size: 12px
}
.page-service-details .service-summary .block {
  padding: 15px
}
.page-service-details .service-summary .block .row {
  margin-bottom: 15px
}
.page-service-details .service-summary .block .row:last-child {
  margin-bottom: 0
}
.page-service-details .service-summary .block:nth-child(2n+1) {
  background: #f4f4f4
}
.page-service-details .supplier-details strong {
  font-size: 14px;
  color: #333
}
.page-service-details .supplier-details img {
  border: 1px solid #ccc;
  height: 85px;
  width: 85px;
  vertical-align: middle
}
.page-service-details .supplier-details .value {
  display: table;
  height: 85px
}
.page-service-details .supplier-details .value .wrapper {
  display: table-cell;
  vertical-align: middle
}
.page-service-details .supplier-details .supplier-reviews {
  vertical-align: top;
  color: #666
}
.page-service-details .supplier-details label {
  font-weight: normal
}
.page-service-details .service-what-our-passengers-say .supplier-details {
  font-size: 12px
}
.page-service-details .reviewer {
  color: #666;
  font-size: 12px;
  line-height: 20px
}
.page-service-details .review-content {
  border-bottom: 1px solid #eee;
  padding-top: 5px;
  padding-bottom: 8px;
  margin-bottom: 8px;
  color: #333;
  font-size: 14px
}
.page-service-details .reviews-header .average-rating {
  width: 52px;
  height: 32px;
  font-size: 20px;
  color: #fff;
  font-family: 'Open Sans', sans-serif;
  display: inline-block;
  background-color: #65c816;
  text-align: center;
  padding: 2px 12px;
  border-radius: 4px;
  margin-right: 20px;
  vertical-align: middle
}
.page-service-details .reviews-header .supplier-rating {
  display: inline-block;
  vertical-align: middle
}
.page-service-details .reviews-header .supplier-reviews {
  font-family: 'Open Sans', sans-serif;
  font-size: 16px;
  color: #333!important;
  display: inline-block;
  margin-top: 7px;
  margin-left: 25px
}
.page-service-details .review-content {
  padding-bottom: 20px;
  margin-bottom: 20px
}
.page-service-details .review-content .read-more {
  display: block;
  margin-top: 10px;
  font-size: 12px
}
.page-service-details .review-content .read-more a {
  text-decoration: none;
  border-bottom: 1px dotted #666
}
.page-service-details ul.navtabs {
  list-style-type: none;
  padding-left: 0;
  padding-bottom: 0
}
.page-service-details ul.navtabs li {
  display: inline-block;
  height: 16px
}
.page-service-details ul.navtabs li:first-child {
  margin-right: 15px;
  padding-right: 18px
}
.page-service-details ul.navtabs li p {
  text-decoration: none;
  color: #333;
  display: block;
  margin-top: -2px;
  font-weight: 600
}
.page-service-details ul.navtabs li p span {
  color: #666;
  font-weight: 400
}
.page-service-details .tab-content .tab-pane {
  position: relative;
  padding-top: 30px;
  border-top: 1px solid #65c816
}
.page-service-details .tab-content .tab-pane:last-child:after, .page-service-details .tab-content .tab-pane:last-child:before, .page-service-details .tab-content .tab-pane:first-child:after, .page-service-details .tab-content .tab-pane:first-child:before {
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none
}
.page-service-details .tab-content .tab-pane:last-child:after, .page-service-details .tab-content .tab-pane:last-child:before {
  bottom: 100%;
  left: 31%
}
.page-service-details .tab-content .tab-pane:first-child:after, .page-service-details .tab-content .tab-pane:first-child:before {
  bottom: 100%;
  left: 10%
}
.page-service-details .tab-content .tab-pane:last-child:after, .page-service-details .tab-content .tab-pane:first-child:after {
  border-color: rgba(255,255,255,0);
  border-bottom-color: #fff;
  border-width: 6px;
  margin-left: -6px
}
.page-service-details .tab-content .tab-pane:last-child:before, .page-service-details .tab-content .tab-pane:first-child:before {
  border-color: rgba(101,200,22,0);
  border-bottom-color: #65c816;
  border-width: 7px;
  margin-left: -7px
}
.page-service-details .tab-content a.btn-show-more-reviews {
  text-decoration: none;
  border-bottom: 1px dotted #666;
  font-size: 12px
}
.page-service-details .tab-content .ellipsis.hide {
  display: none
}
.page-service-details .customer-review {
  display: inline-block;
  background-color: #65c816;
  color: #fff;
  border-radius: 2px;
  padding: 0;
  margin-left: 10px;
  font-size: 12px;
  width: 20px;
  text-align: center
}
.page-service-details .comment-extended {
  display: none
}
.page-service-details .comment-extended.inline {
  display: inline!important
}
.page-service-details .navtabs .disabled {
  pointer-events: none;
  cursor: default
}


.page-service-details .tab-content{
  padding:0px!important;
  border:none!important;
}

.group {
    display: none;
}

.group.active {
    display: block;
}

#load-more.disable {
    color: #AAA;
    text-decoration: none;
    cursor: default;
}

/****** end *****/

#exTab1 .tab-content {
  color : black;
  border:none;
  background-color: #fff;
  padding : 20px 2px 5px;
  border-top:3px solid #ddd;
  margin-top:-3px;
}

#exTab1 .nav-pills > li > a {
  border-radius: 0;
  font-weight:bold!important;
}
#exTab1 .nav-pills > li.active > a {
  border-bottom:3px solid transparent;
}
#exTab1 .nav-pills > li.active > a {
  background:none;
  border-bottom:3px solid #169a5a;
  color:#169a5a!important;
  font-weight:bold!important;
}
/* change border radius for the tab , apply corners on top*/
</style>
<script>
  $( "#writeReview" ).click(function() {     
   $('#writeReviewFrom').toggle();
});
  $('.divHide').click(function(){
    $('#writeReviewFrom').hide();
  });
</script>

