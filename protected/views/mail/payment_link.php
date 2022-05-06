<?php Yii::app()->params->currencySymbol = strtoupper($order->currency).' ';?>
<table width="100%" align="center" cellpadding="0" cellspacing="0" style="background-color:#CCC; font-family:'Calibri, Arial Black', Gadget, sans-serif; font-size:12px;">
    <tr>
        <td style="padding:20px 0px;">
            <table width="675" align="center" cellpadding="0" cellspacing="0">
                <?php $this->renderPartial('//mail/header1'); ?>

                
                <tr>
                     <td style="background-color:#FFF; font-size: 13px; padding:10px; text-align: left;">
                         <br>
                         <p>Dear <strong><?= $user->first_name?></strong>,</p><br>
                         <p>This is a reminder that invoice <?= $order->order_number?>, which was generated on <?= date('d/m/Y',strtotime($order->order_date))?>.</p>
                         
                         <p>Payment method is: <strong>OCBC</strong></p>
                         
                     </td>
                </tr>
                
                <tr>
                    <td style="background-color:#FFF; font-size: 13px; padding:10px;">
                        
                        <p><strong>Payment Details:</strong></p>

                        <p>
                            Order: <?= $order->order_number?><br>
                            Total: <strong><?= Yii::app()->params->currencySymbol?> <?= number_format($order->grand_total,2)?></strong><br>
                            Status: <strong><?= $order->payment_status?></strong><br>
                        </p>
                        
                        <p>Please click the below button to view invoice and pay online.</p>
                        
<p style=" padding: 10px 0px;"><a style="background-color:#71a42e; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.25) inset, 0 2px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 2px rgba(0, 0, 0, 0.15); font-size: 21px; color: #FFF; padding: 10px; text-decoration: none;" target="_blank" href="<?= Yii::app()->createAbsoluteUrl('//payment/ocbc/',array('source'=>base64_encode(CJSON::encode(array('id'=>$order->id,'order_number'=>$order->order_number,'grand_total'=>$order->grand_total)))))?>">Click Here</a> </p>

If you have any questions about this invoice or your service with us, we are always happy to help.  For assistance, please contact with us.<br><br><br>

Regards,<br>
Wristbands House Pte. Ltd.
                            
                    </td>
                </tr>
                <?php $this->renderPartial('//mail/footer1'); ?>
            </table>
        </td>
    </tr>
</table>
