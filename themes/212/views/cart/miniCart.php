<!-- start order summary -->
<?php
$session = $data['session'];
$cartItems = count($session['cart']);
if ($cartItems == 0) {
    ?>
    <div style="width: 100%; font-size: 16px; font-weight: bold;">You have no items in cart.</div>
    <?php
} else {
    ?>

           <?php
            $i = 1;
            $total = 0;
            asort($session['cart']);
            //print_r($session['cart']);
            foreach ($session['cart'] as $k => $v):
                if($v['item_from']=='Product')
                    $this->renderPartial ('product-miniCart',array('v'=>$v,'k'=>$k));
                else if($v['item_from']=='Service')
                    $this->renderPartial ('service-miniCart',array('v'=>$v,'k'=>$k));
                $total += $v['price'];
            endforeach;
            ?>

                  <div class="summary">
                    <div class="subtotal">Sub Total</div>
                    <div class="price-s">$<?php echo number_format($total, Yii::app()->params->decimalPoint) ?></div>
                  </div>

                  <div class="cart-buttons"> <a href="<?= Yii::app()->createUrl('//cart/checkout')?>" class="btn btn-border-2">View Cart</a> <a href="<?= Yii::app()->createUrl('//cart/checkout')?>" class="btn btn-common">Checkout</a>
                    <div class="clear"></div>
                  </div> 
<?php } ?>
<!-- end order summary -->
