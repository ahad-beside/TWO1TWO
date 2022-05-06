<?php Yii::app()->params->currencySymbol = strtoupper($order->currency).' ';?>
<table width="100%" align="center" cellpadding="0" cellspacing="0" style="background-color:#CCC; font-family:'Calibri, Arial Black', Gadget, sans-serif; font-size:12px;">
    <tr>
        <td style="padding:20px 0px;">
            <table width="675" align="center" cellpadding="0" cellspacing="0">
                <?php $this->renderPartial('//mail/header1'); ?>


                <tr>
                    <td style="background-color:#FFF; font-size: 13px; padding:10px; text-align: left;">
                        <br>
                        <p>Dear <strong>Administrator</strong>,</p><br>
                        <p><strong><?= $user->first_name ?></strong> paid <strong><?= Yii::app()->params->currencySymbol?> <?= number_format($order->grand_total, 2) ?></strong> against invoice#<strong><?= $order->order_number ?></strong> in <?= date('d-m-Y')?> </p>

                    </td>
                </tr>

                <tr>
                    <td style="background-color:#FFF; font-size: 13px; padding:10px;">

                        <p><strong>Payment Details:</strong></p>

                        <p>
                            Order: <?= $order->order_number ?><br>
                            Total: <?= Yii::app()->params->currencySymbol?> <?= number_format($order->grand_total, 2) ?><br>
                            Status: <strong>Paid</strong><br>
                        </p>


                        Regards,<br>
                        Wristbands House Pte. Ltd.<br><br>

                        <p style=" padding: 10px 0px;">
                            <a style="background-color:#71a42e; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.25) inset, 0 2px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 2px rgba(0, 0, 0, 0.15); font-size: 21px; color: #FFF; padding: 10px; text-decoration: none;" target="_blank" href="<?= Yii::app()->createAbsoluteUrl('//admin/order/orderView/' . $order->id) ?>">View Order Details</a> </p><br>

                    </td>
                </tr>
                <?php $this->renderPartial('//mail/footer1'); ?>
            </table>
        </td>
    </tr>
</table>
