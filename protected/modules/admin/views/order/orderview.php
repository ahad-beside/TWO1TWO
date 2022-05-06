<style>
    .ordertbl table{width:100%!important; text-align: center;}
</style>
<div class=""><div class="col-md-12"><?php echo Yii::app()->easycode->showNotification(); ?></div></div>
<div class="container" style="margin: 30px auto;">
<div class="row open_page hi">
    
    <!---Action button-->
    <?php 
    $urlR=Yii::app()->request->urlReferrer;
    $slice=explode('/', $urlR);
    $findme='dueList.html';
    $pos=strpos($urlR, $findme);
    if(isset($pos) && $pos!=''){
    ?>
    <a href="<?= Yii::app()->createUrl('//admin/order/dueList');?>"><button style='padding-top:4px;padding-bottom:4px' type="button" class="btn btn-warning"><i class="fa fa-reply"></i> Back</button></a>
    <?php }else{?>
    <a href="<?= Order::model()->getBackToListUrl($order->status);?>"><button style='padding-top:4px;padding-bottom:4px' type="button" class="btn btn-warning"><i class="fa fa-reply"></i> Back</button></a>
    <?php }?>
    <?php
    if ($this->action->id != 'print') {
        if ($order->status != 'Shipped')
            $this->renderPartial('_' . $order->status . 'ActionButtons', array('type' => 'button', 'order' => $order), false, true);
        ?>
        
        <a target="_blank" href="<?php echo Yii::app()->createUrl('//admin/order/print/' . $order->id) ?>"><button style='padding-top:4px;padding-bottom:4px' type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</button></a>
        
                <?php if ($order->status != 'Delivered'){?>
                <a href="<?php echo Yii::app()->createUrl('//admin/order/update/' . $order->id) ?>"><button style='padding-top:4px;padding-bottom:4px' type="button" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</button></a>
                <?php } ?>
        <hr>
    <?php } ?>
    <!---Action button-->

    <script>
        function sendInvoice($this) {
            if (confirm('Are your sure to send invoice to customer?')) {
                $('.sload').html('<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait...');
                $.post($this.attr('data-url'), {}, function (data) {
                    if (data == '1') {
                        alert('Invoice sent successfully.');
                        $('.sload').html('<i class="fa fa-envelope"></i> Send Invoice');
                    } else {
                        alert('Invoice not sent.');
                        $('.sload').html('<i class="fa fa-envelope"></i> Send Invoice');
                    }
                });
            }
        }
        function downloadInvoice($this) {
            $('.dload').html('<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait...');
            $.post($this.attr('data-url'), {}, function (data) {
                if (data !== '') {
                    $('.dload').html('<i class="fa fa-download"></i> Download Invoice');
                } else {
                    $('.dload').html('<i class="fa fa-download"></i> Download Invoice');
                }
            });
        }
    </script>
    <?php $storeSetting = SiteSettings::model()->find(); ?>
    <div class="row custom-page-header myprint">
        <div class="col-md-4">
            <a class="navbar-brand" href="<?php echo Yii::app()->createUrl('//admin/') ?>"><img src="<?php echo $this->adminLogo;?>" height="40"/></a>
            <div style="clear:both;margin-left: 15px;">
                <strong>Email:</strong> <?php echo $storeSetting->email; ?><br>
                <strong>Web:</strong> <a href=""></a>
            </div>
        </div>
        <style>
            .ststusStyle{
                /*border:1px solid #ccc;*/
                text-align: center;
                padding: 10px 0px!important; 
                background-color: #31B0D5; 
                color: #fff;
            }
            .paymentStatusDue{
               /*border:1px solid #ccc;*/
               text-align: center;
               padding: 10px 0px!important; 
               background-color: #C9302C;
               color: #fff;
            }
            .paymentStatusPaid{
               /*border:1px solid #ccc;*/
               text-align: center;
               padding: 10px 0px!important;
               background-color: #449D44; 
               color: #fff;
            }
        </style>
        <div class="col-md-4">
            <div class="col-md-4">
                <h2 class="ststusStyle"><?php echo $order->status; ?></h2>
            </div>
            <div class="col-md-4">
                <h2 class="<?php if($order->payment_status=='Paid'){?>paymentStatusPaid<?php }elseif($order->payment_status=='Due'){?>paymentStatusDue<?php }else{?>paymentStatusDue<?php }?>"><?php if($order->payment_status==''){echo "N/A";}else{echo $order->payment_status;}?></h2>
            </div>
        </div>
        <div class="col-md-4 action-button" style="text-align: right">
            <div class="ordertbl"><?php echo Order::model()->getBarCode($order->order_number, '250px', 13) ?></div>
            <div style="text-align:center;">
                <strong>Date:</strong> <?php if ($order->status=='Pending' || $order->status=='Canceled'){
                    
                    echo date('d-m-Y', strtotime($order->order_date)); 
                }else{
                    echo date('d-m-Y', strtotime($order->confirmed_date));
                }
                ?><br>
                <!--<strong>Order Status:</strong> <?php //echo $order->status; ?>-->
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 billinform" style="border: solid #ccc 1px;margin-left: 0px; margin-bottom: 10px; float: left; padding: 10px;">
        <span style="font-size:20px;font-weight: bold;">Billing Information</span><br>
<?php $billingInfo = CJSON::decode($order->billing_info) ?>
        <strong>Name : </strong><?= $billingInfo['name'] ?><br>
        <strong>Address : </strong><?= $billingInfo['street_address'] ?><br>
        <strong>City : </strong><?= $billingInfo['city'] ?><br>
        <strong>State : </strong><?= State::model()->getStateOriginalName($billingInfo['state']); ?><br>
        <strong>Post Code : </strong><?= $billingInfo['pincode'] ?><br>
        <strong>Country : </strong><?= Country::model()->findByPk($billingInfo['country'])->name ?><br>
        <strong>Phone : </strong><?= $billingInfo['phone'] ?><br>
        <strong>Email : </strong><?= $order->userIdFk->email ?><br>
    </div>  
    <div class="col-md-4" style="border: solid #ccc 1px;margin-right: 0px; margin-bottom: 10px; float: right; padding: 10px;">
        <span style="font-size:20px;font-weight: bold;">Shipping Information</span><br>
<?php $shippingInfo = CJSON::decode($order->delivery_info) ?>
        <strong>Name : </strong><?= $shippingInfo['name'] ?><br>
        <strong>Address : </strong><?= $shippingInfo['street_address'] ?><br>
        <strong>City : </strong><?= $shippingInfo['city'] ?><br>
        <strong>State : </strong><?= State::model()->getStateOriginalName($shippingInfo['state']); ?><br>
        <strong>Post Code : </strong><?= $shippingInfo['pincode'] ?><br>
        <strong>Country : </strong><?= Country::model()->findByPk($shippingInfo['country'])->name ?><br>
        <strong>Phone : </strong><?= $shippingInfo['phone'] ?><br>
    </div> 
</div>
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">Product Info</div>
        <div class="panel-body verticalTop">
            <table class="table checkout-table gu12" style="margin-bottom:0px;">
                <thead>
                    <tr>
                        <th width="70">Image</th>
                        <th class="name">Product Name</th>
                        <th class="price" width="160" style="text-align: right;">Qty.</th>
                        <th class="price" style="text-align: right;">Price</th>
                        <th class="price" width="130" style="text-align: right;">Total</th>
                        <th style="width: 1%">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                        $regular = OrderProducts::model()->findAll("order_id_fk=" . $order->id);
                        if (count($regular) > 0) {
                            foreach ($regular as $regularOrder):
                                 if($regularOrder->item_from=='Product')
                                $productInfo = Products::model()->find("id=" . $regularOrder->products_id_fk);
                            else
                                $productInfo = Service::model()->find("id=" . $regularOrder->products_id_fk);
                                ?>
                            <tr>
                                <td class="image"><?php echo Yii::app()->easycode->showImage($productInfo->image, 80, 80,true,true,Yii::app()->params->productDir) ?></td>
                                <td>
                                    <?php echo '<span style="font-weight:bold">'.$productInfo->name.'</span><br>SKU: '.$productInfo->sku; ?>       
                                    <?php
                                                $d = CJSON::decode($regularOrder->options);
                                                if (count($d) > 0):
                                                    echo '<br>';
                                                    for($i=0;$i<count($d);$i++):
                                                        $chkOpPrice = ProductOption::model()->find('id=:id', array(':id' => $d[$i]));
                                                        echo $chkOpPrice->name . ' ( +'.number_format($chkOpPrice->price, Yii::app()->params->decimalPoint) . ')' . '<br>';
                                                    endfor;
                                                endif;
                                                ?>  
                                </td>
                                <td class="price" style="text-align: right;"><?php echo $regularOrder->qty; ?></td>
                                <td class="price" style="text-align: right;"><?php echo $regularOrder->price; ?></td>
                                <td class="price indTotal" style="text-align: right;"><?php echo number_format($regularOrder->total, Yii::app()->params->decimalPoint) ?></td>
                            </tr>      
                            <?php
                        endforeach;
                    }
                    ?><tr>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th align="right" style="text-align:right;" colspan="4" class="price">Total:</th>
                        <th style="text-align: right;" class="price grandTotal"><?= Yii::app()->params->currencySymbol . number_format($order->total, Yii::app()->params->decimalPoint) ?></th>
                    </tr>
                    <?php if ($order->vat > 0): ?>
                        <tr>
                            <th align="right" style="text-align:right;" colspan="4" class="price">GST:</th>
                            <th style="text-align: right;" class="price grandTotal"><?= Yii::app()->params->currencySymbol . number_format($order->vat, Yii::app()->params->decimalPoint) ?></th>
                        </tr>
                    <?php endif; ?>
                    <?php if ($order->tax > 0): ?>
                        <tr>
                            <th align="right" style="text-align:right;" colspan="4" class="price">TAX:</th>
                            <th style="text-align: right;" class="price grandTotal"><?= Yii::app()->params->currencySymbol . number_format($order->tax, Yii::app()->params->decimalPoint) ?></th>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <th align="right" style="text-align:right;" colspan="4" class="price">Shipping Cost:</th>
                        <th style="text-align: right;" class="price grandTotal"><?= Yii::app()->params->currencySymbol . number_format($order->delivery_charge, Yii::app()->params->decimalPoint) ?></th>
                    </tr>
                    <tr>
                        <th align="right" style="text-align:right;" colspan="4" class="price">Grand Total:</th>
                        <th style="text-align: right;" class="price grandTotal"><?= Yii::app()->params->currencySymbol . number_format($order->grand_total, Yii::app()->params->decimalPoint) ?></th>
                    </tr>                                            
                </tfoot>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php
            $orderPaymentHistory = OrderPaymentHistory::model()->findAll('order_id_fk=:id', array(':id' => $order->id));
            $this->renderPartial('paymentHistory', array('payment' => $orderPaymentHistory));
            ?>
        </div>
        <div class="col-md-6">
            <?php
            $orderProcesingHistory = OrderProccessingHistory::model()->findAll('order_id_fk=:id order by update_time desc', array(':id' => $order->id));
            $this->renderPartial('processingHistory', array('process' => $orderProcesingHistory));
            ?>
        </div>
    </div>
    
    
    
</div>
</div>
</div>
<style>
    .custom-data-table tbody tr td{vertical-align: middle}
    .right-align{text-align: right}
    center-align{text-align: center}
</style>


<script type="text/javascript">
    $('#saveManualPayment').click(function (e) {
        e.preventDefault();

        $('#saveManualPayment').attr('disabled', 'disabled');
        $('#manualPaymentLoading').show();

        var paymentForm = $('#manualPaymentModal');
        var refno = paymentForm.find('#refno').val().trim();
        var method = paymentForm.find('#method').val().trim();
        if (refno == '' || method == '') {
            paymentForm.find('.alert').show();
            paymentForm.find('.alert').find('strong').html('All field is mendatory');
            $('#saveManualPayment').removeAttr('disabled');
            $('#manualPaymentLoading').hide();
        } else {
            $.post('<?= $this->createUrl('//payment/manualSubmit') ?>', {refno: refno, method: method, orderid: '<?= $order->id ?>', amount: '<?= $order->grand_total ?>', orderStatus: '<?= $order->status ?>'}, function (data) {
                //alert(data);
                if (data == 'Not Eligible') {
                    showAlert("success", "This order not eligible for confirm");
                } else if (data == 'Saved') {
                    showAlert("success", "Payment saved successfully.");
                    $('.manualPaymentButton').hide();
                    paymentForm.modal('hide');
                    //location.reload();
                    //window.location = '<?//= Yii::app()->createUrl('//admin/order/confirmedList') ?>';
                    window.location = '<?= Yii::app()->createUrl('//admin/order/orderView/'.$order->id) ?>';
                } else {
                    showAlert("danger", "Payment not saved");
                }
                $('#saveManualPayment').removeAttr('disabled');
                $('#manualPaymentLoading').hide();
            });
        }
    });
</script>
<!-- manual payment form -->