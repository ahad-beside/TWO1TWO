<div class="container nopadding">
  <div class="row">
    <div class="col-md-12">
    <h1 class="section-title">Related Products</h1>
      <div id="new-products" class="owl-carousel new-products">
        <?php foreach($data['relatedProduct'] as  $rowRelated):
            $url = Products::model()->makeLink($rowRelated['id']);
            ?>
        <div class="item">
          <div class="shop-product">
            <div class="product-box"> <a href="#"><img src="<?=Yii::app()->easycode->showOriginalImage($rowRelated['image'],'/product/');?>" width="210" height="263" alt="<?= $rowRelated['name'];?>"></a>
              <div class="cart-overlay"> </div>
              <span class="sticker new"><strong>NEW</strong></span>
              <div class="actions">
                <div class="add-to-links"> <!-- <a href="#" class="btn-cart"><i class="icon-basket"></i></a> <a href="#" class="btn-wish"><i class="icon-heart"></i></a>  --><a href="<?= $url;?>" class="btn-quickview md-trigger" data-modal="modal-3"><i class="icon-eye"></i></a> </div>
              </div>
            </div>
            <div class="product-info">
              <h4 class="product-title text-center"><a href="<?= $url;?>"><?= $rowRelated['name'];?></a></h4>
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


<style>
	.sticker{
		display:none;
	}
</style>