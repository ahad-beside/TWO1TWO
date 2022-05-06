<?php $storeSetting = StoreSettings::model()->find(); ?>

<table width="100%" align="center" cellpadding="0" cellspacing="0" style="font-family:'Calibri, Arial Black', Gadget, sans-serif; font-size:12px;">
    <tr>
        <td style="padding:20px 0px;">
            <table width="675" align="center" cellpadding="0" cellspacing="0">

                <tr>
                    <td>
                        
                        <table width="900" align="center" style="font-size:12px; font-weight:normal;">
        	<tr>
            	<td width="35%" valign="top">
                	<div class="col-md-4">
                        <a class="navbar-brand" href="<?php echo Yii::app()->createUrl('//admin/') ?>"><img src="<?php echo Yii::app()->request->baseUrl ?>/images/logo.png" style="width:180px;"/></a>
                        <div style="clear:both;margin-left: 15px;">
                            <div style="font-size: 14px;"><?= Yii::app()->params->companyName?></div>
                            <strong>Registration No. :</strong> <?php echo '201523845H'; ?><br>
                            <strong>Address :</strong>  <?= Yii::app()->params->phone?><br>
                            <strong>Phone:</strong> <?php echo '+6562916922'; ?><br>
                            <strong>Email:</strong> <?php echo $storeSetting->email; ?><br>
                            <strong>Web:</strong> <a href="<?= Yii::app()->params->weblink?>"><?= Yii::app()->params->web?></a>
                        </div>
                    </div>
                </td>
            	<td width="17%" style="text-align:right;<?php if($order->payment_status=='Paid'){?>color: green;<?php }elseif($order->payment_status=='Due'){?>color: red;<?php }?> font-size: 18px"><div style="background-color: #000; color: #fff; font-weight: bold; font-size: 16px; padding: 8px;"><div style="padding: 8px 12px; width: 120px;">&nbsp; INVOICE &nbsp;</div></div></td>
        <td width="17%" style="text-align:left;<?php if($order->payment_status=='Paid'){?>color: green;<?php }elseif($order->payment_status=='Due'){?>color: red;<?php }?> font-size: 18px">
                	
                     
                    <div style="<?php if($order->payment_status=='Paid'){?>background-color: green;<?php }elseif($order->payment_status=='Due'){?>background-color: red;<?php }?> color: #fff; font-weight: bold; text-transform:uppercase; font-size: 16px; padding: 8px;"><div style="padding: 8px 12px; width: 120px;">&nbsp; <?php if($order->payment_status==''){echo "N/A";}else{echo $order->payment_status;}?> &nbsp;</div></div>
                   
                </td>
                <td width="30%" valign="top">
                	<div class="col-md-4 action-button" style="text-align: right">
            <?php echo Order::model()->getBarCode($order->order_number, '250px', 13) ?>
            <div class="clearfix">&nbsp;</div>
            <strong>Order Date:</strong> <?php echo date('Y-m-d', strtotime($order->order_date)); ?><br>
            <strong>Order Status:</strong> <?php echo $order->status; ?><br>
            <?php if($order->payment_status=='Paid'){
                $payment = OrderPaymentHistory::model()->findAll('order_id_fk=:id', array(':id' => $order->id));
            ?>
            <?php if(count($payment)>0){
                foreach($payment as $info):?>
            <strong>Payment Method:</strong> <?= $info->gateway?><br>
            <strong>Tracking Number:</strong> <?php
                                    $additional = CJSON::decode($info->others);
                                    if(is_array($additional)){
                                    foreach($additional as $k=>$addinfo):
                                        if($k=='Reference Number')
                                            echo $addinfo.'<br>';
                                        if($k=='TRANSACTION_ID')
                                            echo $addinfo.'<br>';
                                        if($k=='txn_id')
                                            echo $addinfo.'<br>';
                                    endforeach;
                                    }
                                    ?>
            <?php  endforeach;
            }
            ?>
            <?php } ?>
            
        </div>
                </td>
            </tr>
        </table>
                    </td>
                </tr>
                
                <tr>
                    <td style="background-color:#FFF; padding:10px;">
                        <table style="width:100%; font-family: calibri, arial;" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="80%" valign="top">
                                    <strong style="font-size:16px;">Billing Information</strong><br>
                                    <?php $billingInfo = CJSON::decode($order->billing_info) ?>
                                    <strong>Name : </strong><?= $billingInfo['name'] ?><br>
                                    <strong>Address : </strong><?= $billingInfo['street_address'] ?><br>
                                    <strong>City : </strong><?= $billingInfo['city'] ?><br>
                                    <strong>State : </strong><?= State::model()->getStateName($billingInfo['state'])->name ?><br>
                                    <strong>Country : </strong><?= Country::model()->findByPk($billingInfo['country'])->name ?><br>
                                    <strong>Post Code : </strong><?= $billingInfo['pincode'] ?><br>
                                    <strong>Phone : </strong><?= $billingInfo['phone'] ?><br>
                                </td>
                                <td width="20%" valign="top">
                                    <span style="font-size:16px;">Shipping Information</span><br>
                                    <?php $shippingInfo = CJSON::decode($order->delivery_info) ?>
                                    <strong>Name : </strong><?= $shippingInfo['name'] ?><br>
                                    <strong>Address : </strong><?= $shippingInfo['street_address'] ?><br>
                                    <strong>City : </strong><?= $shippingInfo['city'] ?><br>
                                    <strong>State : </strong><?= State::model()->getStateName($shippingInfo['state'])->name ?><br>
                                    <strong>Country : </strong><?= Country::model()->findByPk($shippingInfo['country'])->name ?><br>
                                    <strong>Post Code : </strong><?= $shippingInfo['pincode'] ?><br>
                                    <strong>Phone : </strong><?= $shippingInfo['phone'] ?><br>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td style="background-color:#f2f2f2; font-size:14px; color:#333; padding:5px;" colspan="2">
                                    Product Info
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table width="100%" cellpadding="5" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="70" style="border-bottom:2px solid #ddd; vertical-align: bottom; text-align: left; font-size: 15px;">Image</th>
                                                <th class="name" style="border-bottom:2px solid #ddd; vertical-align: bottom; text-align: left; font-size: 15px;">Product Name</th>
                                                <th class="price" style="text-align: right; border-bottom:2px solid #ddd; vertical-align: bottom; font-size: 15px;">Price</th>
                                                <th class="price" width="160" style="text-align: right; border-bottom:2px solid #ddd; vertical-align: bottom; font-size: 15px;">Qty.</th>
                                                <th class="price" width="130" style="text-align: right; border-bottom:2px solid #ddd; vertical-align: bottom; font-size: 15px;">Total</th>
                                                <th style="width: 1%; border-bottom:2px solid #ddd; vertical-align: bottom;">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $custom = OrderCustomProduct::model()->findAll("order_id=" . $order->id);
                                            if (count($custom) > 0) {
                                                foreach ($custom as $customOrder):
                                                    $customType = CustomProductType::model()->find("id=" . $customOrder->product_type);
                                                    $customSize = CustomProductSize::model()->find("id=" . $customOrder->product_size);
                                                    ?>
                                                    <tr>
                                                        <td valign="top" class="image" style="text-align: left; padding: 3px;"><img width="80" height="80" src="<?php
                                                            if ($customOrder->msg_style == 'lanyards') {
                                                                //echo Yii::app()->params->SERVER_HOST . 'images/custom/' . $customOrder->front_image;
                                                                echo Yii::app()->params->SERVER_HOST . Yii::app()->easycode->showImage($customType->image, 80, 80, false);
                                                            } else {
                                                                echo Yii::app()->params->SERVER_HOST . Yii::app()->easycode->showImage($customType->image, 80, 80, false);
                                                            }
                                                            ?>"/></td>
                                                        <td style="text-align: left; padding: 3px;">
                                                            <?php if($customOrder->msg_style == 'vinyl'){
                                                                echo '<span style="font-weight:bold">'.$customType->name . ' / ' . $customOrder->vinyl_option.'</span>';
                                                            }else{
                                                               echo '<span style="font-weight:bold">'.$customType->name . ' / ' . $customSize->name.'</span>';  
                                                            } ?><br><br>
                                                            <?php if ($customOrder->msg_style != 'lanyards' && $customOrder->msg_style != 'tyvek' && $customOrder->msg_style != 'vinyl'  and $customOrder->msg_style != 'koozies')
                                                                { ?>
                                                                <strong>Band Type:</strong> <?php echo $customOrder->msg_style; ?><br>
                                                            <?php } ?>
                                                            <?php if ($customOrder->msg_style == 'Wrap Arround'): ?>
                                                                <strong>Massege:</strong> <?php echo $customOrder->front_msg; ?><br>
                                                            <?php else: ?>
                                                                <?php if ($customOrder->msg_style == 'lanyards') { ?>
                                                                    <strong>Massege:</strong> <?php echo $customOrder->front_msg; ?><br>
                                                                <?php } if ($customOrder->msg_style == 'tyvek') { ?>
                                                                    <strong>Massege:</strong> <?php echo $customOrder->front_msg; ?><br>
                                                                <?php } if ($customOrder->msg_style == 'vinyl') { ?>    
                                                                    <strong>Massege:</strong> <?php echo $customOrder->front_msg; ?><br>
                                                                <?php } else { ?>
                                                                    <strong>Front Massege:</strong> <?php echo $customOrder->front_msg; ?><br>
                                                                    <strong>Back Massege:</strong> <?php echo $customOrder->back_msg; ?><br>
                                                                <?php }endif; ?>

                                                            <?php if ($customOrder->inside_msg != ''): ?>
                                                                <strong>Inside Massege:</strong> <?php echo $customOrder->inside_msg; ?><br>
                                                            <?php endif; ?>

                                                            <?php $d = CJSON::decode($customOrder->decoration); ?>

                                                            <?php
                                                            if(isset($d['clipart']) and $d['design']=='design_lab')
                                                            {
                                                                $cliparts=CJSON::decode($d['clipart']);
                                                                $fcliparts='';
                                                                $bcliparts='';
                                                                foreach ($cliparts as $clipart)
                                                                {
                                                                    if($clipart['view']=='front')
                                                                    {
                                                                       $fcliparts.=' <img src="' . $clipart['src'] . '" width="32"/>'; 
                                                                    }
                                                                    else if($clipart['view']=='back')
                                                                    {
                                                                       $bcliparts.='<img src="' . $clipart['src'] . '" width="32"/>';  
                                                                    }
                                                                }
                                                                if($fcliparts)
                                                                echo '<br><strong>Front Cliparts:</strong> '.$fcliparts;
                                                                if($bcliparts)
                                                                echo '<br><strong>Back Cliparts:</strong> '.$bcliparts;
                                                            }
                                                            if ($customOrder->msg_style == 'koozies' and $d['design']=='design_lab')
                                                            {
                                                                echo ' <strong>Front Font:</strong> ' . $d['front_font'];
                                                                echo ' <strong>Front Text Color:</strong> ' . $d['front_color'];
                                                                echo ' <br><strong>Back Font:</strong> ' . $d['back_font'];
                                                                echo ' <strong>Back Text Color:</strong> ' . $d['back_color'];
                                                            }
                                                            else
                                                            {
                                                                if ($d['front_font_text'] != '')
                                                                    echo ' <strong>Front Font:</strong> ' . $d['front_font_text'];
                                                                if ($customOrder->msg_style != 'tyvek' && $customOrder->msg_style != 'vinyl') {
                                                                    if ($d['front_color_text'] != '')
                                                                        echo ' <strong>Front Text Color:</strong> ' . $d['front_color_text'];
                                                                }

                                                                if ($d['back_font_text'] != '')
                                                                    echo ' <br><strong>Back Font:</strong> ' . $d['back_font_text'];
                                                                if ($d['back_color_text'] != '')
                                                                    echo ' <strong>Back Text Color:</strong> ' . $d['back_color_text'];
                                                            }
                                                            if (isset($d['fsclipart']) && $d['fsclipart'] != '') {
                                                                $clipart = Yii::app()->params->SITE_URL . '/' . OrderCustomProduct::model()->getClipArtUrl($d['fsclipart']);
                                                                $showClip = explode('@#@', $clipart);
                                                                $showImg = Yii::app()->params->SITE_URL . '/' . $showClip[1];
                                                                echo '<br><strong>Front Start Clipart:</strong> <a href="' . $showClip[0] . '"><img src="' . $showImg . '" width="32"/></a>';
                                                            }

                                                            if (isset($d['feclipart']) && $d['feclipart'] != '') {
                                                                $clipart = Yii::app()->params->SITE_URL . '/' . OrderCustomProduct::model()->getClipArtUrl($d['feclipart']);
                                                                $showClip = explode('@#@', $clipart);
                                                                $showImg = Yii::app()->params->SITE_URL . '/' . $showClip[1];
                                                                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Front End Clipart:</strong> <a target="_blank" href="' . $showClip[0] . '"><img src="' . $showImg . '" width="32"/></a>';
                                                            }

                                                            if (isset($d['bsclipart']) && $d['bsclipart'] != '') {
                                                                $clipart = Yii::app()->params->SITE_URL . '/' . OrderCustomProduct::model()->getClipArtUrl($d['bsclipart']);
                                                                $showClip = explode('@#@', $clipart);
                                                                $showImg = Yii::app()->params->SITE_URL . '/' . $showClip[1];
                                                                echo '<br><strong>Back Start Clipart:</strong> <a href="' . $showClip[0] . '"><img src="' . $showImg . '" width="32"/></a>';
                                                            }

                                                            if (isset($d['beclipart']) && $d['beclipart'] != '') {
                                                                $clipart = Yii::app()->params->SITE_URL . '/' . OrderCustomProduct::model()->getClipArtUrl($d['beclipart']);
                                                                $showClip = explode('@#@', $clipart);
                                                                $showImg = Yii::app()->params->SITE_URL . '/' . $showClip[1];
                                                                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Back End Clipart:</strong> <a href="' . $showClip[0] . '"><img src="' . $showImg . '" width="32"/></a>';
                                                            }
                                                            ?>
                                                            <?php
                                                            $bands = CJSON::decode($d['bands']);
                                                            if (count($bands) > 0) {
                                                                echo '<br><br><strong>Color & Quantity:</strong><br>';
                                                                if ($customOrder->msg_style != 'tyvek' && $customOrder->msg_style != 'vinyl') {
                                                                    foreach ($bands as $val):
                                                                        $opt = CJSON::decode($val);
                                                                        echo (($opt['shortcode'] == '') ? '' : $opt['shortcode'] . ' : ') . $opt['qty'] . ' ' . str_replace('_', ' ', $opt['colortype']) . ' | ' . $opt['colorname'] . '<br>';
                                                                    endforeach;
                                                                }else {
                                                                    for ($i = 0; $i < sizeof($bands['qty']); $i++):
                                                                        if ($bands['qty'][$i] != 0)
                                                                            echo $bands['qty'][$i] . ' pcs. ' . ' | ' . $bands['color'][$i] . '<br>';
                                                                    endfor;
                                                                }
                                                            }
                                                            if ($customOrder->additional != '') {
                                                                $additional = CJSON::decode($customOrder->additional);
                                                                if (count($additional) > 0) {
                                                                    //print_r($additional);
                                                                    echo '<strong>Additional Option:</strong><br>';
                                                                    foreach ($additional as $addval):
                                                                        $addInfo = CustomAddOptions::model()->findByPk($addval);
                                                                        if ($addInfo->add_logic == 1)
                                                                            $logic = 'each';
                                                                        else
                                                                            $logic = '';
                                                                        echo $addInfo->name . ' (+' . $addInfo->price . ') ' . $logic . '<br>';
                                                                    endforeach;
                                                                }
                                                            }

                                                            if ($customOrder->mixing_price != '' && $customOrder->mixing_price != '0') {
                                                                echo '<strong>Size Mixing Price:</strong> ' . Yii::app()->params->currencySymbol . $customOrder->mixing_price . '<br>';
                                                            }

                                                            if ($customOrder->color_price != '' && $customOrder->color_price != '0') {
                                                                echo '<strong>Color Price:</strong> ' . Yii::app()->params->currencySymbol . $customOrder->color_price . '<br>';
                                                            }

                                                            if ($customOrder->second_ink_price != '' && $customOrder->second_ink_price != '0') {
                                                                echo '<strong>Second Inkfilled Price:</strong> ' . Yii::app()->params->currencySymbol . $customOrder->second_ink_price . ' each<br>';
                                                            }

                                                            if ($customOrder->insidemsg_price != '' && $customOrder->insidemsg_price != '0') {
                                                                echo '<strong>Inside Massege :</strong> ' . Yii::app()->params->currencySymbol . $customOrder->insidemsg_price . '<br>';
                                                            }

                                                            if ($customOrder->production_time != '') {
                                                                if ($customOrder->production_charge != '0.00') {
                                                                    $productionCharge = ' (+' . Yii::app()->params->currencySymbol . number_format($customOrder->production_charge, 2) . ')';
                                                                } else {
                                                                    $productionCharge = '';
                                                                }
                                                                $productionInfo = CustomProductionShipping::model()->findByPk($customOrder->production_time);
                                                                echo '<strong>Production:</strong> ' . $productionInfo->name . $productionCharge . '<br>';
                                                            }
                                                            if ($customOrder->shipping_time != '') {
                                                                if ($customOrder->shipping_charge != '0.00') {
                                                                    $shippingCharge = ' (+' . Yii::app()->params->currencySymbol . number_format($customOrder->shipping_charge, 2) . ')';
                                                                } else {
                                                                    $shippingCharge = '';
                                                                }
                                                                $shippingInfo = CustomProductionShipping::model()->findByPk($customOrder->shipping_time);
                                                                echo '<strong>Shipping:</strong> ' . $shippingInfo->name . $shippingCharge;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td valign="top" class="price" style="text-align: right;"><?php echo number_format($customOrder->price / $customOrder->qty, Yii::app()->params->decimalPoint) ?></td>
                                                        <td valign="top" class="price" style="text-align: right;">
                                                            <?php echo $customOrder->qty; ?>

                                                            <?php /* if($update){?>
                                                              <input class="form-control qtyref" type="text" value="<?= $v['qty'] ?>" data-id="<?= $k ?>" style="width: 70px;">
                                                              <i class="fa fa-refresh" onclick="updatecart($(this))" style="cursor: pointer"></i>
                                                              <a class="btn-sm rmitem-order" data-id="<?= $k ?>" href="#"><i class="fa fa-trash-o"></i></a>
                                                              <?php }else{
                                                              echo $v['qty'];
                                                              } */ ?>
                                                        </td>
                                                        

                                                        <td valign="top" class="price indTotal" style="text-align: right; padding: 3px;"><?php echo number_format($customOrder->price, Yii::app()->params->decimalPoint) ?></td>
                                                    </tr>
                                                    <?php if(trim($customOrder->special_instruction)!=''):?>
                                                    <tr>
                                                        <td colspan="5">Note: <?= $customOrder->special_instruction?></td>
                                                    </tr>
                                                    <?php endif;?>
                                                    
                                                    <tr>
                                                        <td colspan="5" style="border-top:1px solid #ddd;">&nbsp;</td>
                                                    </tr>
                                                    
                                                        <?php
                                                    endforeach;
                                                }
                                                ?>
                                                <?php
                                                $regular = OrderProducts::model()->findAll("order_id_fk=" . $order->id);
                                                if (count($regular) > 0) {
                                                    foreach ($regular as $regularOrder):
                                                        $productInfo = Products::model()->find("id=" . $regularOrder->products_id_fk);
                                                        ?>
                                                    <tr>
                                                        <td class="image" style=" border-bottom: 1px solid #ddd; padding: 3px;"><img src="<?php echo Yii::app()->params->SERVER_HOST . Yii::app()->easycode->showImage($productInfo->image, 80, 80, false) ?>"/></td>
                                                        <td style=" border-bottom: 1px solid #ddd; padding: 3px;">
                                                            <?php echo '<span style="font-weight:bold">' . $productInfo->name . '</span><br>SKU: ' . $productInfo->sku; ?>       
                                                            <?php
                                                            $d = CJSON::decode($regularOrder->options);
                                                            if (count($d) > 0):
                                                                echo '<br><br><strong>Options:</strong><br>';
                                                                foreach ($d as $k2 => $option):
                                                                    echo $k2 . ' : ' . $option['name'] . ' (' . $option['price_prefix'] . number_format($option['price'], Yii::app()->params->decimalPoint) . ')' . '<br>';
                                                                endforeach;
                                                            endif;
                                                            ?>  
                                                        </td>
                                                        <td class="price" style="text-align: right; border-bottom: 1px solid #ddd; padding: 3px;"><?php echo $regularOrder->price; ?></td>
                                                        <td class="price" style="text-align: right; border-bottom: 1px solid #ddd; padding: 3px;"><?php echo $regularOrder->qty; ?></td>
                                                        <td class="price indTotal" style="text-align: right; border-bottom: 1px solid #ddd; padding: 3px;"><?php echo number_format($regularOrder->total, Yii::app()->params->decimalPoint) ?></td>
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
                                                <th style="text-align: right;" class="price grandTotal"><?php //Yii::app()->currency->getSymbol().' ' . number_format($order->total, Yii::app()->params->decimalPoint) ?><?= strtoupper($order->currency).' ' . number_format($order->total, Yii::app()->params->decimalPoint) ?></th>
                                            </tr>
                                            <tr>
                                                <th align="right" style="text-align:right; border-top:1px solid #ddd;" colspan="4" class="price">GST:</th>
                                                <th style="text-align: right; border-top:1px solid #ddd;" class="price grandTotal"><?= strtoupper($order->currency).' ' . number_format($order->vat, Yii::app()->params->decimalPoint) ?></th>
                                            </tr>
                                            <tr>
                                                <th align="right" style="text-align:right; border-top:1px solid #ddd;" colspan="4" class="price">TAX:</th>
                                                <th style="text-align: right; border-top:1px solid #ddd;" class="price grandTotal"><?= strtoupper($order->currency).' ' . number_format($order->tax, Yii::app()->params->decimalPoint) ?></th>
                                            </tr>
                                            <tr>
                                                <th align="right" style="text-align:right; border-top:1px solid #ddd;" colspan="4" class="price">Shipping Cost:</th>
                                                <th style="text-align: right; border-top:1px solid #ddd;" class="price grandTotal"><?= strtoupper($order->currency).' ' . number_format($order->delivery_charge, Yii::app()->params->decimalPoint) ?></th>
                                            </tr>
                                            <tr>
                                                <th align="right" style="text-align:right; border-top:1px solid #ddd;" colspan="4" class="price">Grand Total:</th>
                                                <th style="text-align: right; border-top:1px solid #ddd;" class="price grandTotal"><?= strtoupper($order->currency).' ' . number_format($order->grand_total, Yii::app()->params->decimalPoint) ?></th>
                                            </tr>                                            
                                        </tfoot>
                                    </table>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>