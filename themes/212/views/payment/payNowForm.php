<style>
.order_title {
	color: #979b96;
	font-size: 27px;
	font-style: italic;
	font-weight: 600;
	text-align: left;
}
.paymentview .orderSuccess {
    background-color: #666;
    text-align: center;
    margin: 15px 0px;
        margin-top: 15px;
    padding: 12px;
        padding-top: 12px;
    color: #FFF;
    font-size: 17px;
}
.new_tbl_ad_info {
    padding: 0px;
    width: 100%;
    display: inline-block;
    min-height: 246px;
}
.order_product_info {
    margin-top: 20px;
	margin-bottom:30px;
}
.checkmark__circle {
  stroke-dasharray: 166;
  stroke-dashoffset: 166;
  stroke-width: 2;
  stroke-miterlimit: 10;
  stroke: #7ac142;
  fill: none;
  animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}
.checkmark {
  width: 56px;
  height: 56px;
  border-radius: 50%;
  display: block;
  stroke-width: 2;
  stroke: #fff;
  stroke-miterlimit: 10;
  margin: 5% auto;
  box-shadow: inset 0px 0px 0px #7ac142;
  animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
}
.checkmark__check {
  transform-origin: 50% 50%;
  stroke-dasharray: 48;
  stroke-dashoffset: 48;
  animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
}
@keyframes stroke {
  100% {
    stroke-dashoffset: 0;
  }
}
@keyframes scale {
  0%, 100% {
    transform: none;
  }
  50% {
    transform: scale3d(1.1, 1.1, 1);
  }
}
@keyframes fill {
  100% {
    box-shadow: inset 0px 0px 0px 30px #7ac142;
  }
}
.equal > div[class*="col-"] {
    display: flex;
    flex-direction: column;
}
.order_amont {
    background-color: #343434;
    color: #fff;
    padding: 12px;
}
.order_amont table tr td {
    padding: 5px;
    font-size: 18px;
}
.order_amont table tr {
    border-bottom: 1px solid #666;
}
.order_amont table tr:last-child {
    border: none;
}
.checkout_siderbar {
    background-color: #f2f2f2;
    padding: 0px !important;
}
.payment_paypal {
    width: 100%;
    display: inline-block;
    background-color: #f1f1f1;
    padding: 12px;
    text-align: left;
}
.payNowLink {
    color: #FFF;
    font-weight: 600;
    font-size: 30px;
}
.payment_pay_btn {
    background-color: #0C0;
    padding: 15px;
}
.payment_pay_btn:hover{
	background-color:#333;
}
.payNowLink i {
    color: #fff;
    padding-right: 8px;
}
.payNowLink:hover{
	color:#fff;
	text-decoration:none;
}
</style>
<div class="container order_success" style="margin-top:115px">
	<div class="col-md-12">
        <div class="whitebox" style="margin-bottom:30px; width:100%; display:inline-block;">
            <div class="paynowbox equal">
           
    <div class="col-md-9 paymentview">
        
          <div class="order_title">
              Payment Of Invoice# <span><?= $invoice->invoice_number?></span>
           </div>
          
            <div>Summary of Invoice view</div>
            
            <div class="loader">
          	<svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
  <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
  <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
</svg>
		  	</div>
            
            <div class="orderSuccess" style="background:none; color:#333; margin-top:0px; padding-top:0px;"><strong style="font-size:22px; color:#00cc00">Your order is successfully placed.</strong><br /> Please review your order details, then select <strong>Payment Method</strong> and click <strong>PAY NOW</strong> button for payment.</div>
            <?php $this->renderPartial('orderview',array('order'=>$order,'invoice'=>$invoice))?>
       
    </div>
    <div class="col-md-3 checkout_siderbar">
        
        <div class="order_amont" style="margin-bottom: 20px;">
        
          <table class="">
              <tr>
                  <td>Invoice</td>
                    <td>:</td>
                    <td><?= $invoice->invoice_number?></span></td>
                </tr>
                <tr>
                  <td>Amount</td>
                    <td>:</td>
                    <td><span class="total_pay"><?= strtoupper($order->currency)?><?= number_format($invoice->invoice_amount,2)?></span></td>
                </tr>
                
            </table>
        </div>
       <div class="payment_paypal">
          <span style="font-size: 11px">**The website uses 256 bit encryption where any data transferring from and to the website is fully secured.</span>
            <div class="wristinput paypal_type radio-success" style="margin-top: 30px;">
    <input id="paypal" class="payMethod" type="radio" value="Paypal" name="productType">
     <label for="paypal"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/paypal_pay.png"/></label>
</div>
    <p class="check-details-para">The most easiest and faster way to make payment. To chose this option , it will take you to PayPal diretly.</p>
            
       </div>

       <div class="payment_paypal" style="display:none;">
          
            <div class="wristinput paypal_type radio-success">
    <input id="credit" class="payMethod" type="radio" value="Credit Card" name="productType">
     <label for="credit"><!-- <img src="<?php //echo Yii::app()->theme->baseUrl?>/assets/images/authorize_pay.png"/> --><img src="<?php echo Yii::app()->theme->baseUrl ?>/assets/images/card_visa_payment.jpg" /></label>
</div>
    <p class="check-details-para">Pay through your Credit/Debit Card .</p>
            
       </div>
       
       

<!--Payment form start-->
<div class="whitebox paymentFromShow" style="text-align:left; padding:10px;margin-top: 10px; display:none; overflow:inherit;">
       <!-- <div class="steptitle" style="margin-top:0px; margin-bottom:0px;">
  <div>Payment</div>
</div> -->
       <form method="post" action="<?php echo $this->createAbsoluteUrl('//payment/creditCard')?>" class="inner-form" id="submitAuthorize">
    <div class="col-md-12 myaccount-maincontent" style="margin-top: 16px;">
        <?php $source=base64_encode(CJSON::encode(array('id' => $order->id)));
         ?>
        <input type="hidden" name="source" value="<?= $source?>">
        
        <!-- <div style="text-align:center; margin-bottom:14px; padding-bottom:7px; border-bottom:1px dashed #ccc;"><img src="<?php //echo Yii::app()->theme->baseUrl ?>/assets/images/card_visa_payment.jpg" /></div>
         -->
         <?php $billingInfo = CJSON::decode($order->billing_info); ?>
         <div class="form-group">
            <label class="" for="User_first_name">Card Holder Name<span class="required">*</span></label>
            <input id="cardHolderName" type="text" class="form-control" name="card_holder_name" required="required" value="<?= $billingInfo['name'] ?>" style="background-color: yellow;">
            <span>*Same as written on your card</span>
        </div>
        <div class="form-group">
            <label class="" for="User_first_name">Card Number<span class="required">*</span></label>
            <input id="card_number" type="text" class="form-control" name="card_number" required="required">
        </div>
        
        <div class="form-group">
        
        <div class="row">

            
            <div class="col-md-6">
            <label class="" for="User_first_name">Expiry Date<span class="required">*</span></label>
              <select class="form-control" name="month" required="required">
                  <option value="">Month</option>
                  <option>01</option>
                  <option>02</option>
                  <option>03</option>
                  <option>04</option>
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
          <div class="col-md-6">
            <label class="" for="User_first_name">&nbsp;</label>
            <select class="form-control" name="year" required="required">
              <option value="">Year</option>
              <?php for($i=date('Y');$i<=2050;$i++){?>
              <option><?= $i;?></option>
             <?php }?>
            </select>
            </div>
            
        </div>
          
        </div>
        <div class="row">
          <div class="col-md-6">
            <label class="" for="User_first_name">CVV<span class="required">*</span> </label>
            <input id="cvv" type="text" class="form-control" name="cvv" required="required">
            </div>
            
            <div class="col-md-6" style="padding-top:30px;">
              <a href="#" style="color:#F00;" data-placement="bottom" data-toggle="tooltip" data-original-title="3 Digit Number back of your card">What is CVV?</a>
            </div>
            
        </div>
        
    </div>
    <input type="submit" name="" value="submit" id="submitCreditCard" style="display: none;">
</form>
</div>
<!--Payment form end-->
       
       
<!--       <div class="think_pay">
          
            <div class="wristinput paypal_type new_radio">
            
            
            
     <label class="css-label radGroup2 radio-inline radio" for="productType180">        
            <input id="productType180" class="css-checkbox payMethod" type="radio" value="think" name="productType">

     <span style="font-weight:bold;">I will think later  </span> </label>
     
     


</div>
    <p class="check-details-para">If you can not find any suitable payment method as above then you can chose it. To chose this option , it's NOT mean that we PROCESSED your order. We will contact with you for farther details about payment. 
The order date will be counted after we get the payment. So Production time/ Shipping time subject to change. You also can contact with us 
<?//= Yii::app()->params->phone?> or <?//= Yii::app()->params->email?></p>
            
       </div>-->
        
        <div class="pay_btm">
        <a href="" class="payNowLink">
        <div class="payment_pay_btn">
          <span class="paynow"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> PAY NOW</span>
        </div>
        
         </a> 
       </div>
          
        
        
    </div>
    
    </div>
</div>
</div>
</div>
<script>
    $(document).ready(function(){
      $('#cardHolderName').keyup(function(){
        $(this).css('background-color','#fff');
      });
        var url='';
        $('.payNowLink').attr('href',url);
        $('.payMethod').click(function(){
                            if($(this).val()=='Paypal'){
                                var url='<?= Yii::app()->createUrl('//payment/paypalSubmit/', array('source' => base64_encode(CJSON::encode(array('id' => $order->id,'invoiceid' => $invoice->id))))) ?>';
                                $('.paymentFromShow').hide();
                            }else if($(this).val()=='Credit Card'){
                                // var url='<?//= Yii::app()->createUrl('//payment/creditCardForm/', array('source' => base64_encode(CJSON::encode(array('id' => $order->id, 'order_number' => $order->order_number, 'grand_total' => $order->grand_total))))) ?>';
                                $('.paymentFromShow').show();
                                var url='creditCard';

                            }
                            else if($(this).val()=='think'){
                                var url='<?= Yii::app()->createUrl('//user/myorders') ?>';
                            }else{
                                var url='';
                            }
                            $('.payNowLink').attr('href',url);
                            });
                            $('.payNowLink').click(function(e){
                              //e.preventDefault();
                            if($('.payNowLink').attr('href')!==''){
                              if($('.payNowLink').attr('href')=='creditCard'){
                                if(confirm('Are you sure to make payment? It will deduct your payment from your Credit Card.')){

                              //alert($('.payNowLink').attr('href'));
                                //$('#submitAuthorize').submit();
                                $('#submitCreditCard').trigger('click');
                                
                                return false;
                              }else{
                                return false;
                              }
                              }
                              else{
                                  //alert(url);
                                return true;
                              }
                            

                            }else{
                                alert('Please Select Payment Method First');
                                return false;
                            }
                            });
        $('#card_number').keyup(function(){
        var str = $(this).val();
        var newval = str.replace(/[^0-9]+/ig, '');
        $(this).val(newval);
        });

        $('#cvv').keyup(function(){
        var str = $(this).val();
        var newval = str.replace(/[^0-9]+/ig, '');
        $(this).val(newval);
        });
    });
    </script>

<?php
//Yii::app()->clientScript->registerScript("paymentSubmit", "$(document).ready(function(){
//    $('.paynow').click(function(){
//        $('form[name=\"theForm\"]').submit();
//    });
//});
//");
?>
<style>
    
    .custom-select {
       float: left; 
        
    }
        .payment-own option {
              font-size: 18px;  
          }
    
        .payment-own {  
          /* styling */
          color: #396e0f;
        background-color: white;
        border: thin solid #7ac142;
        border-radius: 4px;
        display: inline-block;
        font-size: 18px;
        line-height: 1.5em;
        padding:8px 70px 10px 10px;
        
        /* reset */

        margin: 0;      
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-appearance: none;
        -moz-appearance: none;

        }
     .custom-select select.minimal {
        background-image:
          linear-gradient(45deg, transparent 50%, gray 50%),
          linear-gradient(135deg, gray 50%, transparent 50%),
          linear-gradient(to right, #ccc, #ccc);
        background-position:
          calc(100% - 20px) calc(1em + 2px),
          calc(100% - 15px) calc(1em + 2px),
          calc(100% - 2.5em) 0.5em;
        background-size:
          5px 5px,
          5px 5px,
          1px 1.5em;
        background-repeat: no-repeat;
     }
     
     .paynow-button {
       float: left;
       margin-left: 20px;
         
     }
     
     .shortodertop {
      padding:10px;
      background: #f2f2f2;
    text-align:left;         
     }
     
     .payment-checkown {
         margin-top: 30px;  
     }
     
        
     .check-details-para {
       padding-right:7px;
       padding-bottom: 10px;
       font-size:14px;
         
     }
     
  
    </style>