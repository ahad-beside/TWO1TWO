<div class="container">
    <div class="col-md-12">
        <div class="contentbg">
            <div class="red-title col-md-12">
              <h2>Payment Of Order# <?= $orderInfo->order_number?></h2>
            </div>
<!--    <div class="clearfix">&nbsp;</div>
    <div class="col-md-12" style="text-align: center">
        <i class="fa fa-3x fa-spinner fa-spin"></i>
        <h2>Please Wait And Don't Close Your Browser</h2>
    </div>
-->
    
    <div class="clearfix">&nbsp;</div>
    
    
    
    <div class="col-md-8 paymentview" style="padding-bottom: 20px;">
        
        <div style="background-color: #f2f2f2; padding: 0px 15px 15px 15px">
            <h3>Summary of order view</h3>
            <div class="alert alert-info">Please review your order details, then click <strong>PAY NOW</strong> button for payment.</div>
            <!--<h4 class="alert alert-danger">Online Payment System Is Under Maintenence</h4>-->
            <?php $this->renderPartial('orderview',array('order'=>$orderInfo))?>
        </div>
        
    </div>
    
    <div class="col-md-4">
        
     
        <div class="shortorderv">
            Order : <span style="padding-left: 50px; font-weight: bold;"><?= $orderInfo->order_number?></span><br>
           Amount : <span style="padding-left: 33px; font-weight: bold; color: #7ac142; font-size: 30px;"><?= strtoupper($orderInfo->currency).' '?> <?= number_format($orderInfo->grand_total,2)?></span><br>
            
        </div>
           
        <button class="btn btn-success btn-lg paynow" style="width: 100%; font-size: 22px;"><i class="fa fa-money"></i> PAY NOW</button>
        
        
        
        <div style="margin-top: 12px; margin-bottom: 15px;"><img src="https://www.feee3.com/Content/images/paypal_info.png"/></div> 
        
    </div>
    <div class="clearfix">&nbsp;</div>
    
    <div class="col-md-12" style="display:block">
        <center>This form will be hidden, Now show for testing purpose</center>

        <!-- test url https://www.sandbox.paypal.com/cgi-bin/webscr -->
        <form name="theForm" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="business" value="info@uscraft.com">
  <input type="hidden" name="item_name" value="<?= $orderInfo->order_number;?>">
  <input type="hidden" name="amount" value="<?= $orderInfo->grand_total;?>">
  <input type="hidden" name="currency_code" value="<?= strtoupper($orderInfo->currency);?>">
  <input type="hidden" name="return" value="https://www.uscraft.com/demo/">
  <input type="hidden" name="cancel_return" value="https://www.uscraft.com/demo/">
  <input type="image" name="submit"
    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
    alt="PayPal - The safer, easier way to pay online">
</form>

    </div>
</div>
</div>
</div>
<?php
Yii::app()->clientScript->registerScript("paymentSubmit", "$(document).ready(function(){
    $('.paynow').click(function(){
        $('form[name=\"theForm\"]').submit();
    });
});
");
?>