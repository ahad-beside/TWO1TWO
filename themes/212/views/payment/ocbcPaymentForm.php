<div class="container">
    <div class="col-md-12">
        <div class="contentbg">
            <div class="col-md-12" style="display: none">
                <div class="form">
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
                    <td align="center" colspan="3"><br> <input type="submit" value="Submit" id="submit_to_paypal">
                    </td> 
                </tr>
            </table> 
        </form>
                </div>

            </div>
            
            <div class="col-md-12" style="text-align: center">
                <h1>Please Wait...</h1>
                <h3>Don't close browser</h3>
                <h1><i class="fa fa-spin fa-cogs"></i></h1>
            </div>
            
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#submit_to_paypal').trigger('click');
    });
</script>