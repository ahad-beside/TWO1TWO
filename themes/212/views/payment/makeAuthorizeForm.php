<div class="whitebox" style="text-align:left; padding:10px; min-height: 555px;">
<div class="steptitle" style="margin-top:0px; margin-bottom:0px;">
	<div>Payment</div>
</div>
<div class="note" style="font-size: 13px; padding-left: 4px; text-transform: none; font-family: arial; padding-top: 4px;">Fields with <span class="required">*</span> are required.</div>
<div class="col-md-9 col-md-offset-4 card_payment_design">
<form method="post" action="<?php echo $this->createUrl('creditCard')?>" class="inner-form">
    <div class="col-md-5 myaccount-maincontent" style="margin-top: 16px;">
        <?= Yii::app()->easycode->showNotification() ?>
        <input type="hidden" name="source" value="<?= $_GET['source']?>">
        
        <div style="text-align:center; margin-bottom:14px; padding-bottom:7px; border-bottom:1px dashed #ccc;"><img src="<?php echo Yii::app()->theme->baseUrl ?>/assets/images/card_visa_payment.jpg" /></div>
        
        <div class="form-group">
        	<h2 style="margin:0px; padding:0px; color:#46545c; font-size:18px;">Payment Amount</h2>
           <div class="card_amount"><?php echo Yii::app()->params->usdCurrency.$model->grand_total?></div>
        </div>
        
        <div class="form-group">
            <label class="" for="User_first_name">Card Number<span class="required">*</span></label>
            <input type="text" class="form-control" name="card_number">
        </div>
        
        <div class="form-group">
        
        <div class="row">
        	<div class="col-md-4">
            <label class="" for="User_first_name">Expiry Date<span class="required">*</span></label>
            <select class="form-control" name="year">
              <option value="">Year</option>
              <?php for($i=date('Y');$i<=2050;$i++){?>
              <option><?= $i;?></option>
             <?php }?>
            </select>
            </div>
            
            <div class="col-md-4">
            <label class="" for="User_first_name">&nbsp;</label>
            	<select class="form-control" name="month">
                  <option value="">Month</option>
                  <option>01</option>
                  <option>02</option>
                  <option>03</option>
                  <option>05</option>
                  <option>06</option>
                  <option>07</option>
                  <option>08</option>
                  <option>09</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                </select>
            </div>
            
            <div class="col-md-4">
            <label class="" for="User_first_name">Cvv<span class="required">*</span></label>
            <input type="text" class="form-control" name="cvv">
            </div>
            
        </div>
        	
        </div>
        
        <div class="form-group">
        	<input style="width:100%" type="submit" value="Payment" name="yt0" class="btn btn-success btn-primary">
        </div>
        
    </div>
</form>
</div>
</div>


<style>

.input-append, .input-prepend {
    display: inline-block;
    font-size: 0;
    margin-bottom: 10px;
    vertical-align: middle;
    white-space: nowrap;
}
.input-append .add-on, .input-prepend .add-on {
    background-color: #eeeeee;
    border: 1px solid #ccc;
    display: inline-block;
    font-size: 14px;
    font-weight: normal;
    height: 20px;
    line-height: 20px;
    min-width: 16px;
    padding: 4px 5px;
    text-align: center;
    text-shadow: 0 1px 0 #ffffff;
    width: auto;
}
	.card_payment_design input{
	}
	.card_amount{
		font-size:24px;
		color:#333;
	}
</style>
