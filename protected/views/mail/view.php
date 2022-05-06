<div class="container" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; width: 100%;">

    <?php if (isset($xtraMessage) && $xtraMessage != '') { ?>
        <div role="alert" class="alert alert-info" style="text-align: center">
            <?php echo $xtraMessage ?>
        </div>
    <?php } ?>

    <div class="col-md-12" style="text-align:center; padding-bottom:8px; border-bottom:2px solid #CCC; margin-top:15px; margin-bottom:12px;">
        <div style="margin-bottom:12px;"><img src="<?php echo Yii::app()->params->SERVER_HOST . Yii::app()->request->baseUrl ?>/images/mail/wristbands-logo.png" /></div>
        <?php echo Yii::app()->params->AddressPhoneEmailWeb?>
    </div>

    <?php if ($orderStatus == 'Pending' || $orderStatus == 'Sent to courier' || $orderStatus == 'Canceled' || $orderStatus == 'Confirmed') { ?>
        <div class="col-md-12" style="padding: 20px; margin: 10px 0px; background-color: #f7f7f7;">
            <?php if ($orderStatus == 'Pending') { ?>
                <strong>Dear Customer,</strong><br/>Thanks for placing order. Your order status is pending now. We will call you and confirm your order. Please keep your phone on.<br/>Here is your order details.
            <?php } //end for Pending order?>

            <?php if ($orderStatus == 'Sent to courier') { ?>
                <strong>Dear Customer,</strong><br/>We shipped your products to courier service. Hope you will get your products by next 2 working days.<br/>Here is your order details.
            <?php } //end for Sent to courier order?>

            <?php if ($orderStatus == 'Canceled') { ?>
                <strong>Dear Customer,</strong><br/>Your order canceled. Please follow bottom Order Log. If you want to confirm your order please call us and confirm your order.<br/>Here is your order details.
            <?php } //end for Canceled order?>

            <?php if ($orderStatus == 'Confirmed') { ?>
                <?php if(date("d-m-Y",strtotime($model->confirm_date)) > date("d-m-Y")){?>
                <strong>Dear Customer,</strong><br/>Your order is confirmed. We will shipped your products to courier service in <?php echo date("d-m-Y",strtotime($model->confirm_date))?> evening. Hope you will get your products by next 2 working days.<br/>Here is your order details.
                <?php }else{?>
                <strong>Dear Customer,</strong><br/>Your order is confirmed. We will shipped your products to courier service at tonight. Hope you will get your products by next 2 working days.<br/>Here is your order details.
                <?php }?>
                
            <?php } //end for Canceled order?>
        </div>
    <?php } ?>

    <div class="col-md-12">
        <table width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
            <tr>
                <td width="50%">
                    <div style="font-size:16px; margin-bottom:12px;">To</div>
                    <b style="font-size:14px;"><?php echo $model->full_name ?></b><br />
                    <strong>Mobile</strong> :  <?php echo $model->mobile_number ?><br />
                    <?php if ($model->email_address != '') { ?>
                        <strong>Email</strong> :  <?php echo $model->email_address ?><br />
                    <?php } ?>
                    <strong>Address</strong> : <?php echo $model->full_address ?>
                </td>
                <td width="50%" align="right">
                    <table style="font-size: 12px;">
                        <tr>
                            <td align="right"><strong>Order #</strong> : </td>
                            <td align="right"><?php echo $model->order_number ?></td>
                        </tr>
                        <tr>
                            <td align="right"><strong>Order Date</strong> : </td>
                            <td align="right"><?php echo date("d-m-Y", strtotime($model->order_date)) ?></td>
                        </tr>

                        <?php if ($model->confirm_date) { ?>
                            <tr>
                                <td align="right"><strong>Confirm Date</strong> : </td>
                                <td align="right"><?php echo date("d-m-Y", strtotime($model->confirm_date)); ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </td>
            </tr>
        </table>


    </div>



    <div class="clearfix"></div>
    <div class="col-md-12">

        <?php
        $products = TempOrderProducts::model()->findAll('order_id=:order_id', array(':order_id' => $model->id));
        if (count($products) > 0) {
            $unirow = array();
            $alex = array();
            foreach ($products as $product):
                if (!in_array($product->product_id, $alex)) {
                    $alex [] = $product->product_id;
                    $unirow[$product->product_id] = array('product_id' => $product->product_id, 'product_name' => Products::model()->findByPk((int) $product->product_id)->name, 'qty' => $product->qty, 'unit_price' => $product->unit_price);
                } else {
                    $unirow[$product->product_id]['qty'] += $product->qty;
                }
            endforeach;
        }
        ?>


        <table class="table table-striped" style="border-top:1px solid #CCC; font-family:Verdana, Geneva, sans-serif; font-size:12px; margin-top:12px; width: 100%; border-collapse: collapse;" border="1" cellpadding="4">
            <thead>
                <tr>
                    <th align="left" valign="middle">#</th>
                    <th align="left" valign="middle">Product</th>
                    <th align="right" valign="middle" style="text-align:right!important">Qty</th>
                    <th align="right" valign="middle" style="text-align:right!important">Unit</th>
                    <th align="right" valign="middle" style="text-align:right!important">Price (<?php echo Yii::app()->params->currencySymbol ?>)</th>

                </tr>
            </thead>
            <tbody>
                <?php
//print_r($unirow);
                if(count($unirow)>0){
                $i = 0;
                $subtotals = 0;
                $qtytotal = 0;
                foreach ($unirow as $k => $v):
                    $i++;
                    ?>
                <tr>
                    <td align="left" valign="middle"><?php echo $i ?></td>
                    <td align="left" valign="middle"><?php echo $v['product_name'];
                    ?></td>
                    <td align="right" valign="middle"><?php echo $v['qty'] ?></td>
                    <td align="right" valign="middle"><?php echo $v['unit_price'] ?></td>
                    <td align="right" valign="middle"><?php
                            echo number_format($v['unit_price'] * $v['qty'], 2);
                            $qtytotal += $v['qty'];
                            $subtotals +=$v['unit_price'] * $v['qty'];
                            ?></td>

                </tr>
                <?php
                endforeach;
                ?>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right" valign="middle"><strong>Total</strong></td>
                    <td align="right" valign="middle"><strong><?php echo $qtytotal?></strong></td>
                    <td align="right" valign="middle">&nbsp;</td>
                    <td align="right" valign="middle"><strong><?php echo number_format($subtotals, 2) ?></strong></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="3" align="right" valign="middle"><strong>Delivery Charge</strong></td>
                    <td align="right" valign="middle"><strong><?php echo $model->delivery_charge ?></strong></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="3" align="right" valign="middle"><strong>Total</strong></td>
                    <td align="right" valign="middle"><strong><?php echo number_format($subtotals + (int) $model->delivery_charge, 2) ?></strong></td>

                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
    <div class="col-md-12" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
        <table width="100%" align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">


            <?php if ($model->shipping_method == '2') { ?>
                <tr>
                    <td>
                        <br>
                        <div style="font-size:16px; margin-bottom:12px;"><strong>Shipping Method:</strong></div>
                        Collect From Store.
                    </td>
                </tr>
            <?php } else { ?>
                <tr>
                    <td>
                        <br>
                        <div style="font-size:16px; margin-bottom:12px;"><strong>Shipping Method:</strong></div>
                        Home Delivery.
                    </td>
                </tr>
            <?php } ?>



            <tr>
                <?php if (trim($model->notes) != '') { ?>
                    <td>
                        <br>
                        <div style="font-size:16px; margin-bottom:12px;"><strong>Note</strong></div>
                        <?php echo $model->notes ?>
                    </td>
                <?php } ?>

            </tr>
        </table>

        <?php
        if ($orderStatus == 'Canceled') {
            $notes = TempOrderNotes::model()->findAll("temp_orders_fk=:fk order by id desc", array(':fk' => $model->id));
            if (count($notes) > 0) {
                echo "<h2>Order Log:</h2>";
                foreach ($notes as $note):
                    ?>
                    <div style="padding: 10px; border: solid 1px #CCC;">
                        <?php $user = Users::model()->findByPk($note->update_by) ?>
                        <span style="font-size: 14px;"><?php echo CHtml::encode($note->note) ?></span><br>
                        <i>By <?php echo $user->first_name . ' ' . $user->last_name . ', ' . date("d-m-Y h:i A", strtotime($note->update_date)) ?></i>
                    </div>
                    <div class="clear">&nbsp;</div>
                    <?php
                endforeach;
            }
        }
        ?>

    </div>
</div>
