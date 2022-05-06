<?php if(count($data['featuredProduct'])>0):
?>
<div class="container">
  <h1 class="section-title">Our Products</h1>
  <hr class="lines">
  <div class="row">
    <div class="col-md-12">
      <div id="new-products" class="owl-carousel new-products">
        <?php foreach($data['featuredProduct'] as $rowFeatured):
            $url = Products::model()->makeLink($rowFeatured['id']);
        ?>
        <div class="item">
          <div class="shop-product">
            <div class="product-box"> <a href="<?= $url;?>">
              <img src="<?=Yii::app()->easycode->showOriginalImage($rowFeatured['image'],'/product/');?>" width="210" height="263" alt="<?= $rowFeatured['name'];?>"></a>
              <div class="cart-overlay"> </div>
              <span class="sticker new"><strong>NEW</strong></span>
              <div class="actions">
                <div class="add-to-links"> <!-- <a href="#" class="btn-cart"><i class="icon-basket"></i></a> <a href="#" class="btn-wish"><i class="icon-heart"></i></a> --> <a href="<?= $url;?>" class="btn-quickview md-trigger" data-modal="modal-3"><i class="icon-eye"></i></a> </div>
              </div>
            </div>
            <div class="product-info">
              <h4 class="product-title text-center"><a href="<?= $url;?>"><?= $rowFeatured['name'];?></a></h4>
              <div class="align-items text-center">
               	<a href="<?= $url;?>" class="btn btn-common">Shop Now</a>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
</div>

<?php endif;?>
<style>
	.sticker{
		display:none;
	}
</style>