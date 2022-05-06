<?php //Yii::app()->params->currencySymbol = strtoupper($order->currency).' ';?>
<style>
.billinginf{
	padding-right:20px;
}
.shippinf{
}
.shippinf table tr td{
	padding:4px 8px;
}
.ownbilling table tr td{
	padding:4px 8px;
}
.order_view_title table thead tr th{
	background-color:#243066;
	color:#FFF;
}
.new_tbl_ad_info{
	padding:0px;
	width:100%;
	display:inline-block;
	min-height:246px;
}
.new_tbl_ad_info table{
	margin-bottom:0px;
}
</style>
<div class="row">
    <div class="col-md-12">
            <div class="">
            	<div class="col-md-12">
                <div class="ocbcpaymentview row">
                    <div class="col-md-5">
                    <div class="billinginf ownbilling new_tbl_ad_info">
                    <div style="font-size:20px;font-weight: bold; margin-bottom:0px; padding:2px 12px; background-color:#243066; color:#FFF;">Billing Information</div>
                    <div>
                    <?php $billingInfo = CJSON::decode($order->billing_info); ?>
                    <table class="table">
                    	<tr>
                        	<td style="width:20%"><strong>Name</strong></td>
                            <td style="width:5%">:</td>
                            <td><?= $billingInfo['name'] ?></td>
                        </tr>
                        
                        <tr>
                        	<td><strong>Address</strong></td>
                            <td>:</td>
                            <td><?= $billingInfo['street_address'] ?></td>
                        </tr>
                        
                        
                        <tr>
                        	<td><strong>City</strong></td>
                            <td>:</td>
                            <td><?= $billingInfo['city'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>State</strong></td>
                            <td>:</td>
                            <td><?= State::model()->find("code='".$billingInfo['state']."'")->name; ?></td>
                        </tr>
                        
                        
                        <tr>
                        	<td><strong>Post Code</strong></td>
                            <td>:</td>
                            <td><?= $billingInfo['pincode'] ?></td>
                        </tr>
                        
                        <tr>
                            <td><strong>Country</strong></td>
                            <td>:</td>
                            <td><?= Country::model()->findByPk($billingInfo['country'])->name ?></td>
                        </tr>
                        
                        
                        <tr>
                        	<td><strong>Phone</strong></td>
                            <td>:</td>
                            <td><?= $billingInfo['phone'] ?></td>
                        </tr>
                        
                        
                        <tr>
                        	<td><strong>Email</strong></td>
                            <td>:</td>
                            <td><?= $order->userIdFk->email ?></td>
                        </tr>
                        
                    </table>
                    </div>
                </div>   
                    
                </div> 
                <div class="col-md-2">&nbsp;</div>
                <div class="col-md-5" style="margin-bottom:0px; border:none;">
                	<div class="shippinf new_tbl_ad_info">
                    <div style="font-size:20px;font-weight: bold; margin-bottom:0px; padding:2px 12px; background-color:#243066; color:#FFF;">Shipping Information</div>
                    <div>
					<?php $shippingInfo = CJSON::decode($order->delivery_info) ?>
                    <table class="table">
                    	<tr>
                        	<td style="width:20%"><strong>Name</strong></td>
                            <td style="width:5%">:</td>
                            <td><?= $shippingInfo['name'] ?></td>
                        </tr>
                        
                        <tr>
                        	<td style="width:20%"><strong>Address</strong></td>
                            <td style="width:5%">:</td>
                            <td><?= $shippingInfo['street_address'] ?></td>
                        </tr>
                        
                        <tr>
                        	<td style="width:20%"><strong>City</strong></td>
                            <td style="width:5%">:</td>
                            <td><?= $shippingInfo['city'] ?></td>
                        </tr>
                        
                        <tr>
                            <td><strong>State</strong></td>
                            <td>:</td>
                           <td><?= State::model()->find("code='".$shippingInfo['state']."'")->name; ?></td>
                        </tr>
                        
                        <tr>
                        	<td style="width:20%"><strong>Post Code</strong></td>
                            <td style="width:5%">:</td>
                            <td><?= $shippingInfo['pincode'] ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%"><strong>Country</strong></td>
                            <td style="width:5%">:</td>
                            <td><?= Country::model()->findByPk($shippingInfo['country'])->name ?></td>
                        </tr>
                        <tr>
                        	<td style="width:20%"><strong>Phone</strong></td>
                            <td style="width:5%">:</td>
                            <td><?= $shippingInfo['phone'] ?></td>
                        </tr>
                    </table>
                    </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
            <div class="col-md-12 order_product_info">
                <div class="">
                    <div class="" style="font-size: 22px; padding: 4px 0px;">Product Info</div>
                    <div class="panel-body order_view_title" style="padding:0px;">
                        <table class="table checkout-table gu12" style="margin-bottom:0px; border:none;">
                            <thead>
                                <tr>
                                    <th width="70">Image</th>
                                    <th class="name">Product Name</th>
                                    <th class="price" width="160" style="text-align: right;">Qty.</th>
                                    <!-- <th class="price" style="text-align: right;">Price</th> -->
                                    <th class="price" width="130" style="text-align: right;">Total</th>

                                </tr>
                            </thead>
                            <tbody>
                                    <?php
                                    //$regular = OrderProducts::model()->findAll("order_id_fk=" . $order->id);
                                    $regular = CJSON::decode($invoice->product_info);
                                    //echo count($regular);exit;
                                    if (count($regular) > 0) {
                                        foreach ($regular as $k=>$regularOrder):
                                            $regularInvoiceOrder=OrderProducts::model()->findByPk($regularOrder['id']);
                                            if($regularInvoiceOrder->item_from=='Product')
                                                $productInfo = Products::model()->find("id=" . $regularInvoiceOrder->products_id_fk);
                                            else
                                                $productInfo = Service::model()->find("id=" . $regularInvoiceOrder->products_id_fk);
                                            ?>
                                        <tr>
                                            <td class="image" style="border-bottom:1px solid #ddd; border-left:1px solid #ddd;"><?php echo Yii::app()->easycode->showImage($productInfo->image, 80, 80,true,true,Yii::app()->params->productDir) ?></td>
                                            <td style="border-bottom:1px solid #ddd;">
                                               <?php echo '<span style="font-weight:bold">'.$productInfo->name.'</span><br>SKU: '.$productInfo->sku.'<br>'; ?>       
                                                <?php
                                                $d = CJSON::decode($regularInvoiceOrder->options);
                                                if (count($d) > 0):
                                                    for($i=0;$i<count($d);$i++):
                                                        $chkOpPrice = ProductOption::model()->find('id=:id', array(':id' => $d[$i]));
                                                        echo $chkOpPrice->name . ' ( +'.number_format($chkOpPrice->price, Yii::app()->params->decimalPoint) . ')' . '<br>';
                                                    endfor;
                                                    
                                                endif;
                                                ?>  
                                            </td>
                                            <td class="price" style="text-align: right; border-bottom:1px solid #ddd;"><?php echo $regularInvoiceOrder->qty; ?></td>
                                            <!-- <td class="price" style="text-align: right;"><?php //echo $$regularOrder['price']; ?></td> -->
                                            
                                            <td class="price indTotal" style="text-align: right;"><?php echo number_format($regularOrder['price'], Yii::app()->params->decimalPoint) ?></td>
                                        </tr>      
                                        <?php
                                    endforeach;
                                }
                                ?><tr>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                	<th align="right" style="text-align:right; border:none;" colspan="2" class="price">&nbsp;</th>
                                    <th align="right" style="text-align:right; border-left:1px solid #ddd; border-right:1px solid #ddd;" class="price">Total:</th>
                                    <th style="text-align: right; border-left:1px solid #ddd; border-right:1px solid #ddd;" class="price grandTotal"><?= Yii::app()->params->usdCurrency . number_format($invoice->invoice_amount, Yii::app()->params->decimalPoint) ?></th>
                                </tr>
                                <?php if ($order->vat > 0): ?>
                                    <tr>
                                    	<th align="right" style="text-align:right; border:none;" colspan="2" class="price">&nbsp;</th>
                                        <th align="right" style="text-align:right;" class="price">GST:</th>
                                        <th style="text-align: right;" class="price grandTotal"><?= Yii::app()->params->usdCurrency.number_format($order->vat, Yii::app()->params->decimalPoint) ?></th>
                                    </tr>
                                <?php endif; ?>
                                <?php if ($order->tax > 0): ?>
                                    <tr>
                                    	<th align="right" style="text-align:right; border:none;" colspan="2" class="price">&nbsp;</th>
                                        <th align="right" style="text-align:right;" class="price;  border-left:1px solid #ddd; border-right:1px solid #ddd;">TAX:</th>
                                        <th style="text-align: right;  border-left:1px solid #ddd; border-right:1px solid #ddd;" class="price grandTotal"><?= Yii::app()->params->usdCurrency.number_format($order->tax, Yii::app()->params->decimalPoint) ?></th>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                	<th align="right" style="text-align:right; border:none;" colspan="2" class="price">&nbsp;</th>
                                    <th align="right" style="text-align:right; border-left:1px solid #ddd; border-right:1px solid #ddd;" class="price">Shipping Cost:</th>
                                    <th style="text-align: right; border-right:1px solid #ddd;" class="price grandTotal"><?= Yii::app()->params->usdCurrency.number_format($order->delivery_charge, Yii::app()->params->decimalPoint) ?></th>
                                </tr>
                                <tr>
                                	<th align="right" style="text-align:right; border:none;" colspan="2" class="price">&nbsp;</th>
                                    <th align="right" style="text-align:right; font-size:24px;  border-left:1px solid #ddd; border-right:1px solid #ddd; border-bottom:1px solid #ddd;" class="price">Grand Total:</th>
                                    <th style="text-align: right; font-size:24px; border-bottom:1px solid #ddd; border-right:1px solid #ddd;" class="price grandTotal"><?= Yii::app()->params->usdCurrency.number_format($invoice->invoice_amount, Yii::app()->params->decimalPoint) ?></th>
                                </tr> 
                                <?php if (count($custom) > 0) { ?>
                                                                    <!--<tr>
                                        <th align="left" style="text-align:left;" colspan="5" class="price"><a target="_blank" href="<?php //echo Yii::app()->createUrl('//order/showArtwork/' . $order->id)  ?>"><span type="button" class="btn btn-success">View All Artwork</button></a></th>
                                    </tr>-->
                                <?php } ?>						
                            </tfoot>
                        </table>
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