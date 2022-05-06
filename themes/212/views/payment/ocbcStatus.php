<?php /*<div class="row">
    <div class="clearfix">&nbsp;</div>
    
    <?php if($data['status']=='success'):?>
    <div class="col-md-12" style="text-align: center">
        <h2>Thanks For Your Payment</h2>
        <h4>Payment successfully completed By OCBC for order# <?= $data['request']['MERCHANT_TRANID']?> Amount <?= strtoupper($data['currency']).' '.number_format($data['paymentData']->amount,2)?></h4>
        
        <a class="btn btn-primary" href="<?= $this->createUrl('//user/myorders')?>">Back To Order</a>
    </div>
    <?php endif;?>
</div>
<div class="clearfix">&nbsp;</div>
*/ ?>
<div class="container">
    <div class="col-md-12">
        <div class="loginareabg">
            <?php if($data['status']=='success'):?>
            <div class="col-md-12" style="text-align: center;">
                <h1 style="font-size: 22px;">Thanks For Your Payment</h1>
                <div class="successcheckmark"><i class="fa fa-check-circle"></i></div>
  
  <p>Payment successfully completed By OCBC for order# <?= $data['request']['MERCHANT_TRANID']?> Amount <?= strtoupper($data['currency']).' '.number_format($data['paymentData']->amount,2)?></p>
            </div>
            <div class="col-md-12" style="margin-bottom: 12px;">
                <div style="text-align: center;"><a href="<?= $this->createUrl('//user/myorders')?>" class="btn btn-success">Back To Order List</a></div>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>
<div class="clearfix">&nbsp;</div>