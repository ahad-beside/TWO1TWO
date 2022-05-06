<!-- Start Page Header -->
<div class="content-page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb"> <a href="<?= Yii::app()->homeUrl;?>"><i class="icon-home"></i> Home</a> <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span> <span class="current">Checkout</span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Page Header -->
<?php 
$session = Yii::app()->session;
$cartItems = count($session['cart']);
//print_r($session['cart']);
//unset($session['cart']);
?>
<section id="CheckoutContent">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        
       <h1 class="section-title"><?=$this->pageTitle;?></h1>    
       
       <div class="row">
                            <div class="col-md-12">
                                <?php if ($cartItems===0) {?>
                                <div style="width: 95%; border: solid 1px white; font-size: 16px; font-weight: bold; margin-left: 10px;">You have no items in cart.<br><br>
                <a class="btn btn-primary continue-shopping" href="<?= $_SERVER['HTTP_REFERER']?>">Continue Shopping?</a>&nbsp;<a class="btn btn-success btn-xm" href="<?= Yii::app()->homeUrl?>">Return to the homepage</a>
                </div>
                                <?php } else{?>
                                <table class="cart-table table wow fadeInUp animated" data-wow-duration="1s" style="visibility: visible;-webkit-animation-duration: 1s; -moz-animation-duration: 1s; animation-duration: 1s;">
                                    <thead>
                                        <tr>
                                            <th width="42" class="card_product_image">Image</th>
                                            <th width="211" class="card_product_name">Product Name</th>
                                            <!-- <th width="162" class="card_product_model">Model</th> -->
                                            <th width="146" class="card_product_quantity text-center">Quantity</th>
                                            <th width="130" class="card_product_price">Unit Price ($)</th>
                                            <th width="146" class="card_product_total">Total ($)</th>
                                            <th width="50" class="card_product_total"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $i = 1;
                                    $total = 0;
                                    foreach ($session['cart'] as $k => $v):
                                        if ($v['item_from'] == 'Product')
                                            $this->renderPartial('product-checkout', array('v' => $v, 'k' => $k, 'update' => true,'count'=>$i));
                                        else if($v['item_from'] == 'Service'){
                                            $this->renderPartial('service-checkout', array('v' => $v, 'k' => $k, 'update' => true,'count'=>$i));
                                        }
                                        $total += $v['price'];
                                        ///echo $i;
                                        
                                        $i++;
                                    endforeach;
                                    ?>
                                        

                                        <!-- <tr>
                                            <td class="" data-th="Image" colspan="4" style="border-bottom:none;">
                                            </td>
                                            
                                            
                                            
                                            <td class="card_product_price border-btm" data-th="Unit Price" style="text-align:right; background-color:#eaeaea;"><strong>Sub Total ($)</strong></td>
                                            <td class="card_product_total border-btm" data-th="Total">
                                            	$777.00
                                               
                                            </td>
                                        </tr> -->
                                        
                                        
                                        <!-- <tr>
                                            <td class="" data-th="Image" colspan="4" style="border-top:none;">
                                            </td>
                                            <td class="card_product_price border-btm" data-th="Unit Price" style="text-align:right; background-color:#eaeaea;"><strong>Shipping Cost ($)</strong></td>
                                            <td class="card_product_total border-btm" data-th="Total">
                                            	$777.00
                                               
                                            </td>
                                        </tr> -->
                                        
                                        
                                        <tr>
                                            <td class="" data-th="Image" colspan="3" style="border-top:none;">&nbsp;
                                            </td>
                                            
                                            
                                            
                                            <td class="card_product_price border-btm" data-th="Unit Price" style="text-align:right; background-color:#eaeaea;"><strong>Total Cost ($)</strong></td>
                                            <td class="card_product_total border-btm grandTotal" data-th="Total">
                                            	<?= number_format($total,Yii::app()->params->decimalPoint)?>
                                               
                                            </td>
                                            <td class="border-btm"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php } ?>


                            </div>
        </div>
                        
        
      </div>
    </div>
    
    <?php if ($cartItems!=0) {?>
    <div class="row">
    	<div class="col-md-8 col-md-offset-4">
        	<a href="<?= Yii::app()->homeUrl;?>" class="btn btn-primary">Continue</a>
            <a href="<?= Yii::app()->createUrl('//cart/order');?>" class="btn btn-success">Proceed</a>
        </div>
    </div>
    <?php } ?>
    
  </div>
</section>
 <script type="text/javascript">
                    $('body').on('click', '.rmitem-order', function () {
                        var $obj = $(this);
                        if (confirm('Are you sure to delete?') == true) {
                            $.post('<?= Yii::app()->createUrl('//cart/dell/') ?>', {id: $obj.attr('data-id')}, function (data) {
                                if (data == 1) {
                                    $obj.parent().parent().remove();
                                    updateCheckOutPrice();
                                    updateMiniCart();
                                    updateCartCountAmount();
                                }
                            });
                        } else {
                            return false;
                        }
                    });
                    
                    $('body').on('keyup', '.qtyref', function () {
                        var $obj = $(this);
                        $obj.parent().parent().find('.fa-refresh').trigger('click');
                    });
                    
                    function updatecart($this) {
                        var qty = $this.parent().parent().find('input').val();
                        var cartid = $this.parent().parent().find('input').attr('data-id');
                        $.post('<?= Yii::app()->createUrl('//cart/updateCart/') ?>', {id: cartid, qty: qty}, function (data) {
                            $this.parent().parent().parent().next().next('td').html(data);
                            updateCheckOutPrice();
                            updateMiniCart();
                            updateCartCountAmount();
                        });
                    }
                    function updateCheckOutPrice() {
                        var total = 0;
                        var count=0;
                        $('.indTotal').each(function () {
                            total = parseFloat(total) + parseFloat($(this).html().replace(',', ''));
                            count ++;
                        });
                        //alert(total);
                        $('.grandTotal').html(formatMoney(total));
                        if(count==0){
                           $('.zerodiv').css('display','none');
                           $('.zeroProduct').css('display','block');
                        }
                    }
                    updateCheckOutPrice();
                </script>


