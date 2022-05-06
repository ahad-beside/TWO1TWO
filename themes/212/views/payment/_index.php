<style>
    .payment-success{
        text-align: center;
        padding: 20px 0 0;
    }
    .payment-success i{
        color: #7ac142;
        font-size: 84px;
    }
    .paymentprocess{
        padding: 14px 0 20px;
    }
    .paypalresult{
        margin-top: 17px;
    }
</style>

<div class="container">
    <div class="col-md-12">
        <div class="contentbg">
            <div class="red-title col-md-12">
                <h2>Payment Method</h2>
            </div>
            <div class="col-md-12" style="text-align: center; border-bottom: 1px solid #f2f2f2; padding-bottom: 16px;">
                <?php //echo Yii::app()->easycode->showNotification()?>
                
                <div class="payment-success">
                    <i class="fa fa-check-circle"></i>
                    <div style="font-size:16px; font-weight: bold">Order successfully placed. We will contact you shortly.</div>
                </div>
                
            </div>
            <!--
            <div class="col-md-12 paymentprocess">
                <div class="col-md-9">
                    <div style="font-size:16px; color: #666; margin-bottom: 16px;">Please Select Your Payment Option: </div>
                    
                    <div class="col-md-3">
                        <a href="<?=$this->createUrl('//payment/ocbc/'.$_GET['id'])?>">Pay With OCBC</a>
                    </div>
                    
                    
                </div>
                <div class="col-md-3 paymentmethodorderdtls">
                    <img src="<?php echo Yii::app()->theme->baseUrl ?>/assets/images/payment-secure.jpg"/>
                </div>
            </div>
            -->
        </div>
    </div>
</div>