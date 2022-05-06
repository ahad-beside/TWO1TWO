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
        
        
        
        <div style="margin-top: 12px; margin-bottom: 15px;"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/ocbc-payment.jpg"/></div> 
        
    </div>
    <div class="clearfix">&nbsp;</div>
    
    <div class="col-md-12" style="display:none">
        <center>This form will be hidden, Now show for testing purpose</center>

        <!-- test url https://testepayment.ocbc.com/BPG/admin/payment/PaymentWindowSimulator.jsp -->
        <form name="theForm" action="https://epayment.ocbc.com/BPG/admin/payment/PaymentWindow.jsp" method="post" >
            <center> <h2>Payment Method Testing</h2> <h3>Merchant API Testing Form For Sales Request (Payment Window)</h3> </center> 
            <table border="0" width="70%" align="center" >
                <tr>
                    <td width="35%">MERCHANT_ACC_NO</td> <td width="3%">:</td>
                    <td width="62%"> <input name="MERCHANT_ACC_NO" type="text" value="<?= $ocbcInfo[$orderInfo->currency.'Merchant']?>" size="50"></td>
                </tr> 
                <tr>
                    <td>AMOUNT</td> <td>:</td>
                    <td> <input name="AMOUNT" type="text" value="<?= $orderInfo->grand_total?>" size="50" > </td> </tr>
                <tr>
                    <td>TRANSACTION_TYPE</td> <td>:</td>
                    <td> <input name="TRANSACTION_TYPE" type="text" value="2" size="50"> </td>
                </tr> 
                <tr>
                    <td>MERCHANT_TRANID</td> <td>:</td>
                    <td> <input name="MERCHANT_TRANID" type="text" value="<?= $orderInfo->order_number?>" size="50"> </td>
                </tr> 
                <tr>
                    <td>RESPONSE_TYPE</td> <td>:</td>
                    <td> <input name="RESPONSE_TYPE" type="text" value="HTTP" size="50"></td> </tr>
                <tr>
                    <td>RETURN_URL</td> <td>:</td>
                    <td> <input name="RETURN_URL" type="text" value="<?= Yii::app()->createAbsoluteUrl('//payment/ocbcReturn')?>" size="50" ></td>
                </tr> 
                <tr>
                    <td>TXN_DESC</td> <td>:</td>
                    <td> <input name="TXN_DESC" type="text" value="Payment <?= number_format($orderInfo->grand_total,2,'.','')?> for <?= $orderInfo->order_number?>" size="50">
                    </td> 
                </tr>
                <tr>
                    <td>CUSTOMER_ID</td> <td>:</td>
                    <td> <input name="CUSTOMER_ID" type="text" value="<?= $orderInfo->user_id_fk.'SFH'.$orderInfo->id.'SFH'.$orderInfo->currency?>" size="50" ></td>
                </tr>
                <?php
                $billing = CJSON::decode($orderInfo->billing_info);
                $shipping = CJSON::decode($orderInfo->delivery_info);
                ?>
                <tr>
                    <td>FR_HIGHRISK_EMAIL</td> <td>:</td>
                    <td> <input name="FR_HIGHRISK_EMAIL" type="text" value="<?= $orderInfo->userIdFk->email?>" size="50" > </td>
                </tr> 
                <tr>
                    <td>FR_HIGHRISK_COUNTRY</td> <td>:</td>
                    <td> <input name="FR_HIGHRISK_COUNTRY" type="text" value="<?= Country::model()->findByPk($billing['country'])->name?>" size="50" >
                    </td> 
                </tr> 
                <tr>
                    <td>FR_BILLING_ADDRESS</td> <td>:</td>
                    <td> <input name="FR_BILLING_ADDRESS" type="text" value="<?= Yii::app()->easycode->safeReadFrom($billing['street_address']);?>" size="50" >
                    </td> 
                </tr> 
                <tr>
                    <td>FR_SHIPPING_ADDRESS</td> <td>:</td>
                    <td><input name="FR_SHIPPING_ADDRESS" type="text" value="<?= Yii::app()->easycode->safeReadFrom($shipping['street_address']);?>" size="50" ></td>
                </tr>
                <tr>
                
                    <td>FR_CUSTOMER_IP</td> <td>:</td>
                    <td> <input name="FR_CUSTOMER_IP" type="text" value="<?php $httpReq = new CHttpRequest; echo $httpReq->getUserHostAddress()?>" size="50" ></td>
                </tr> 
                <tr>
                    <td>TXN_SIGNATURE</td> <td>:</td>
                    <td> <input name="TXN_SIGNATURE" type="text" value="<?= md5($ocbcInfo[$orderInfo->currency.'Password'].$ocbcInfo[$orderInfo->currency.'Merchant'].$orderInfo->order_number.$orderInfo->grand_total)?>" size="50" ></td> </tr>
                <tr>
                    <td align="center" colspan="3"><br> <input type="submit" value="Submit" >
                    </td> 
                </tr>
            </table> 
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