<div class="">
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
           
        <a href="<?= Yii::app()->createUrl('//payment/paypalSubmit/', array('source' => base64_encode(CJSON::encode(array('id' => $orderInfo->id))))) ?>"><button class="btn btn-success btn-lg" style="width: 100%; font-size: 22px;"><i class="fa fa-money"></i> PAY NOW</button></a>
        
        
        
        <div style="margin-top: 12px; margin-bottom: 15px;"><img src="<?= Yii::app()->params->SITE_URL ?>/images/paypal_secure.jpg"></div> 
        
    </div>
</div>
</div>
</div>