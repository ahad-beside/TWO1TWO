<div class="row">
    <div class="clearfix">&nbsp;</div>
    <div class="col-md-12" style="text-align: center">
        <h2><?= $request['RESPONSE_DESC'] ?></h2>
    </div>

    <?php if ($request['TRANSACTION_ID'] != ''): ?>
        <div class="clearfix">&nbsp;</div>
        <div class="col-md-12" style="text-align: center">
            <i class="fa fa-3x fa-spinner fa-spin"></i>
            <h2>Please Wait And Don't Close Your Browser</h2>
            <a href="<?= Yii::app()->homeUrl ?>" class="btn btn-primary">Back To Order</a>
        </div>

        <div class="clearfix">&nbsp;</div>
        <div class="clearfix">&nbsp;</div>
        <div class="clearfix">&nbsp;</div>
        <div class="clearfix">&nbsp;</div>

        <div class="col-md-12" style="display: none">
            <center>This will be hidden, Now show for testing purpose</center>
            <!-- testing url for void and query https://testepayment.ocbc.com/BPG/admin/payment/PaymentInterfaceSimulator.jsp -->
            <?php /*
              <form name="voidForm" action="https://epayment.ocbc.com/BPG/admin/payment/PaymentInterface.jsp" method="post" >
              <center> <h3>Merchant API Testing Form For Void Request</h3></center>
              <table border="0" width="70%" align="center" >
              <tr>
              <td width="35%">MERCHANT_ACC_NO</td> <td width="3%">:</td>
              <td ><input name="MERCHANT_ACC_NO" type="text" value="<?= $data['merchantId'] ?>" size="50"></td>
              </tr>
              <tr>
              <td>AMOUNT</td> <td>:</td>
              <td> <input name="AMOUNT" type="text" value="<?= $data['orderInfo']->grand_total ?>" size="50" > </td>
              </tr>
              <tr>
              <td>TRANSACTION_TYPE</td> <td>:</td>
              <td><input name="TRANSACTION_TYPE" type="text" value="6" size="50"></td>
              </tr>
              <tr>
              <td>TRANSACTION_ID</td> <td>:</td>
              <td><input name="TRANSACTION_ID" type="text" value="<?= $request['TRANSACTION_ID'] ?>" size="50"></td>
              </tr>
              <tr>
              <td>MERCHANT_TRANID</td> <td>:</td>
              <td> <input name="MERCHANT_TRANID" type="text" value="<?= $data['orderInfo']->order_number ?>" size="50"></td>
              </tr>
              <tr>
              <td>RESPONSE_TYPE</td> <td>:</td>
              <td> <input name="RESPONSE_TYPE" type="text" value="HTTP" size="50"></td>
              </tr>
              <tr>
              <td>RETURN_URL</td> <td>:</td>
              <td> <input name="RETURN_URL" type="text" value="<?= Yii::app()->createAbsoluteUrl('//payment/ocbcNotify') ?>" size="50" ></td>
              </tr>
              <tr>
              <td>CUSTOMER_ID</td> <td>:</td>
              <td> <input name="CUSTOMER_ID" type="text" value="<?= $data['orderInfo']->user_id_fk . 'SFH' . $data['orderInfo']->id . 'SFH' . $data['currency'] ?>" size="50" ></td>
              </tr>
              <tr>
              <td>TXN_SIGNATURE</td> <td>:</td>
              <td> <input name="TXN_SIGNATURE" type="text" value="<?= md5($data['merchantPassword'] . $data['merchantId'] . $data['orderInfo']->order_number . $data['orderInfo']->grand_total) ?>" size="50" ></td>
              </tr>
              <tr>
              <td align="center" colspan="3"><br> <input type="submit" value="Submit" ></td>
              </tr>
              </table>
              </form>
             * 
             */
            ?>


            <form name="queryForm" action="https://epayment.ocbc.com/BPG/admin/payment/PaymentInterface.jsp" method="post" >
                <center> <h3>Merchant API Testing Form For Query Request</h3></center>
                <table border="0" width="70%" align="center" >
                    <tr>
                        <td width="35%">MERCHANT_ACC_NO</td> <td width="3%">:</td>
                        <td ><input name="MERCHANT_ACC_NO" type="text" value="<?= $data['merchantId'] ?>" size="50"></td>
                    </tr>
                    <tr>
                        <td>AMOUNT</td> <td>:</td>
                        <td> <input name="AMOUNT" type="text" value="<?= $data['orderInfo']->grand_total ?>" size="50" > </td>
                    </tr>
                    <tr>
                        <td>TRANSACTION_TYPE</td> <td>:</td>
                        <td><input name="TRANSACTION_TYPE" type="text" value="1" size="50"></td>
                    </tr>

                    <tr>
                        <td>MERCHANT_TRANID</td> <td>:</td>
                        <td> <input name="MERCHANT_TRANID" type="text" value="<?= $data['orderInfo']->order_number ?>" size="50"></td>
                    </tr>
                    <tr>
                        <td>RESPONSE_TYPE</td> <td>:</td>
                        <td> <input name="RESPONSE_TYPE" type="text" value="HTTP" size="50"></td>
                    </tr>
                    <tr>
                        <td>RETURN_URL</td> <td>:</td>
                        <td> <input name="RETURN_URL" type="text" value="<?= Yii::app()->createAbsoluteUrl('//payment/ocbcNotify') ?>" size="50" ></td>
                    </tr>
                    <tr>
                        <td>CUSTOMER_ID</td> <td>:</td>
                        <td> <input name="CUSTOMER_ID" type="text" value="<?= $data['orderInfo']->user_id_fk . 'SFH' . $data['orderInfo']->id . 'SFH' . $data['currency'] ?>" size="50" ></td>
                    </tr>
                    <tr>
                        <td>TXN_SIGNATURE</td> <td>:</td>
                        <td> <input name="TXN_SIGNATURE" type="text" value="<?= md5($data['merchantPassword'] . $data['merchantId'] . $data['orderInfo']->order_number . $data['orderInfo']->grand_total) ?>" size="50" ></td>
                    </tr>
                    <tr>
                        <td align="center" colspan="3"><br> <input type="submit" value="Submit" ></td>
                    </tr>
                </table>
            </form>

        </div>
    </div>
    <?php
    if ($request['RESPONSE_DESC'] == 'APPROVED OR COMPLETED') {
        Yii::app()->clientScript->registerScript("paymentReturn", "$(document).ready(function(){
            $('form[name=\"queryForm\"]').submit();
        });
");
    }
    ?>
<?php /*
    <!--
    <div class="row">
        <div class="clearfix">&nbsp;</div>
        <div class="col-md-12" style="text-align: center">
            <h2>Transaction Completed</h2>
            <h3>Payment Description From OCBC: <?= $request['RESPONSE_DESC'] ?></h3>
        </div>

        <div class="clearfix">&nbsp;</div>
        <div class="col-md-12" style="text-align: center">
            <i class="fa fa-3x fa-spinner fa-spin"></i>
            <h2>Please Wait And Don't Close Your Browser</h2>
        </div>

        <div class="clearfix">&nbsp;</div>
        <div class="clearfix">&nbsp;</div>
        <div class="clearfix">&nbsp;</div>
        <div class="clearfix">&nbsp;</div>

        <div class="col-md-12">
            <center>This form will be hidden, Now show for testing purpose</center>
            <form name="theForm" action="https://testepayment.ocbc.com/BPG/admin/payment/PaymentWindowSimulator.jsp" method="post" >
                <center> <h3>Merchant API Testing Form For Query Request</h3></center> 
                <table border="0" width="70%" align="center" >
                    <tr>
                        <td width="35%">MERCHANT_ACC_NO</td> <td width="3%">:</td>
                        <td ><input name="MERCHANT_ACC_NO" type="text" value="<?= $data['merchantId'] ?>" size="50"></td>
                    </tr> 
                    <tr>
                        <td>AMOUNT</td> <td>:</td>
                        <td> <input name="AMOUNT" type="text" value="<?= $data['orderInfo']->grand_total ?>" size="50" > </td> 
                    </tr>
                    <tr>
                        <td>TRANSACTION_TYPE</td> <td>:</td>
                        <td><input name="TRANSACTION_TYPE" type="text" value="1" size="50"></td>
                    </tr> 
                    <tr>
                        <td>MERCHANT_TRANID</td> <td>:</td>
                        <td> <input name="MERCHANT_TRANID" type="text" value="<?= $data['orderInfo']->order_number ?>" size="50"></td>
                    </tr> 
                    <tr>
                        <td>RESPONSE_TYPE</td> <td>:</td>
                        <td> <input name="RESPONSE_TYPE" type="text" value="HTML" size="50"></td>
                    </tr> 
                    <tr>
                        <td>RETURN_URL</td> <td>:</td>
                        <td> <input name="RETURN_URL" type="text" value="<?= Yii::app()->createAbsoluteUrl('//payment/ocbcNotify') ?>" size="50" ></td> 
                    </tr>
                    <tr>
                        <td>TXN_SIGNATURE</td> <td>:</td>
                        <td> <input name="TXN_SIGNATURE" type="text" value="<?= md5($data['merchantPassword'] . $data['merchantId'] . $data['orderInfo']->order_number . $data['orderInfo']->grand_total) ?>" size="50" ></td> 
                    </tr>
                    <tr>
                        <td align="center" colspan="3"><br> <input type="submit" value="Submit" ></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    -->
 * 
 */?>
<?php else: ?>
    <div class="col-md-12" style="text-align: center">
        <h2>Unauthorized Access</h2>
        <a href="<?= Yii::app()->homeUrl ?>" class="btn btn-primary">Back</a>
    </div>
    <div class="clearfix">&nbsp;</div>
<?php endif; ?>
