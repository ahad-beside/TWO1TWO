<!-- Start Page Header -->
<div class="page-header paralax_container paralaxbg" style="background-image:url(<?= Yii::app()->theme->baseUrl;?>/assets/img/page_title.jpg)">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
            <h1 style="margin-bottom:0px;">Products</h1>
            <p>Digital Signage is increasingly being used to deliver brand, product, and promo on messages.</p>
      </div>
    </div>
  </div>
</div>
    <!-- End Page Header -->

<section id="product-collection" class="section30"> 
   <!-- Start Page Header -->
        <?php 
//print_r($data);exit;
        $this->renderPartial('product_area',array('data'=>$data,'name'=>$name)); ?>
   <!-- End Page Header -->
</section>


<section class="paralax_container paralaxbg" style="background-image:url(<?= Yii::app()->theme->baseUrl;?>/assets/img/page_title.jpg); padding:100px 0px">
    <div class="container text-center">
        <h2 class="text-white">Pushing the frontier of existing Digital Signage Solutions
in USA, we challenge ourselves to bring new and
original ways of signage solutions.</h2>
    </div>
</section>