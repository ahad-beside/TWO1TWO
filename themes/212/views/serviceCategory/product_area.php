<div class="product-area">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-12">
        <?php $this->renderPartial('product_sidebar',array('id'=>$id)); ?>
      </div>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="shop-content">
          <?php if(count($data['products'])>0){
            ?>
            <div class="home_page_masonary row" id="homemansory">
              <?php foreach($data['products'] as $rowProduct):
              $url = Service::model()->makeLink($rowProduct['id']);
              ?>
              <div class="item" data-order="1">
                <div class="shop-product">
                  <div class="product-box"> <a href="#"><img class="img-responsive" src="<?=Yii::app()->easycode->showOriginalImage($rowProduct['image'],'/product/');?>"></a>
                    <div class="cart-overlay"> </div>
                    <span class="sticker new" style="display:none;"><strong>NEW</strong></span>
                    <div class="actions">
                      <div class="add-to-links"> <!-- <a href="#" class="btn-cart"><i class="icon-basket"></i></a> <a href="#" class="btn-wish"><i class="icon-heart"></i></a> --> <a href="<?= $url;?>" class="btn-quickview md-trigger" data-modal="modal-3"><i class="icon-eye"></i></a> </div>
                    </div>
                  </div>
                  <div class="product-info text-left">
                    <h4 class="product-title"><a href="<?= $url;?>"><?=$rowProduct['name'];?></a></h4>
                    <div class="align-items">
                    	<?=$rowProduct['quick_view'];?>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach;?>
            </div>
            <?php } else{?>
            <div class="alert alert-warning">
              No Product found under this Category.
            </div>
            <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>