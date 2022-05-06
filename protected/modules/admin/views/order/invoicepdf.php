<?php $storeSetting = StoreSettings::model()->find(); ?>

<?php Yii::app()->params->currencySymbol = strtoupper($order->currency) . ' '; ?>

<table width="100%" align="center" cellpadding="0" cellspacing="0" style="font-size: 12px; font-family: Courier;">
    <tr>
        <td>
            <table width="720" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="background-color:#fff;">
                        <table width="100%" cellpadding="0" cellspacing="0" style="font-family: Courier; font-size: 12px;">
                            <tr>
                                <td width="450">


                                    <div><img src="<?= Yii::app()->params->weblink?>/images/newsletterimages/logo.png" width="260"/></div>
                                    <div style="font-family: Courier; font-size: 16px;"><?= Yii::app()->params->companyName?></div>
                                    <div style="clear:both; font-family: Courier; font-size: 12px;"> 
                            <strong>Address :</strong>  <?= Yii::app()->params->address?><br>
                            <strong>Phone:</strong> <?php echo '1-323-386-8968'; ?><br>
                            <strong>Email:</strong> <?php echo $storeSetting->email; ?><br>
                            <strong>Web:</strong> <a href="<?= Yii::app()->params->weblink?>"><?= Yii::app()->params->web?></a>
                                    </div>


                                </td>
                                <td width="250" style="text-align: center; font-family: Courier; font-size: 12px;">
                                    <?php echo Order::model()->getBarCode($order->order_number, '250px', '13', '40px') ?>
                                    Date:<?php echo date('Y-m-d', strtotime($order->order_date)); ?><br>
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
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="background-color:#FFF;">
                        <table style="width:100%; font-family: Courier; font-size: 11px;" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="width: 100%">
                                    <table style="width: 100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="width: 300">&nbsp;</td>
                                            <td style="width: 120">
                                                <div style="background-color: #000; color: #fff; font-weight: bold; font-size: 16px; padding: 8px;"><div style="padding: 8px 12px; width: 180px;">&nbsp; INVOICE &nbsp;</div></div>
                                                
                                            </td>
                                            <td><div style="<?php if($order->payment_status=='Paid'){?>background-color: green;<?php }elseif($order->payment_status=='Due'){?>background-color: red;<?php }?> margin-top: 5px; color: #fff; font-weight: bold; font-size: 16px; padding: 8px;"><div style="padding: 8px 12px; width: 180px;">&nbsp; <?php if($order->payment_status==''){echo "N/A";}else{echo $order->payment_status;}?> &nbsp;</div></div></td>
                                           
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="float: left; line-height: 14px;">
                                                    <span style="font-size:16px;">Billing Information</span><br>
                                                    <?php $billingInfo = CJSON::decode($order->billing_info) ?>
                                                    <?= $billingInfo['name'] ?><br>
                                                    <strong>Address : </strong><?= $billingInfo['street_address'] ?><br>
                                                    <strong>City : </strong><?= $billingInfo['city'] ?><br>
                                                    <strong>State : </strong><?= State::model()->getStateOriginalName($billingInfo['state']) ?><br>
                                                    <strong>Post Code : </strong><?= $billingInfo['pincode'] ?><br>
                                                    <strong>Country : </strong><?= Country::model()->findByPk($billingInfo['country'])->name ?><br>
                                                    <strong>Phone : </strong><?= $billingInfo['phone'] ?><br>
                                                    <strong>Email : </strong><?= $order->userIdFk->email ?><br>
                                                </div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div style="float: right; line-height: 14px;">
                                                    <span style="font-size:16px;">Shipping Information</span><br>
                                                    <?php $shippingInfo = CJSON::decode($order->delivery_info) ?>
                                                    <?= $shippingInfo['name'] ?><br>
                                                    <strong>Address : </strong><?= $shippingInfo['street_address'] ?><br>
                                                    <strong>City : </strong><?= $shippingInfo['city'] ?><br>
                                                    <strong>State : </strong><?= State::model()->getStateOriginalName($shippingInfo['state']) ?><br>
                                                    <strong>Post Code : </strong><?= $shippingInfo['pincode'] ?><br>
                                                    
                                                    <strong>Country : </strong><?= Country::model()->findByPk($shippingInfo['country'])->name ?><br>
                                                    <strong>Phone : </strong><?= $shippingInfo['phone'] ?><br>
                                                </div> 
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td style="text-align:left; font-size: 15px; background-color: #f2f2f2; color: #333; padding: 4px; font-family: Courier">
                                    Product Info
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" cellpadding="5" cellspacing="0" style="font-family: Courier;">
                                        <thead>
                                            <tr style="background-color: #CCC;">
                                                <th width="70" style="vertical-align: bottom; text-align: left; font-size: 15px; padding: 3px;">Image</th>
                                                <th class="name" style="vertical-align: bottom; text-align: left; font-size: 15px; padding: 3px;">Product Name</th> 
                                                <th class="price" style="text-align: right; vertical-align: bottom; font-size: 15px; padding: 3px;">Price</th>
                                                <th class="price" width="160" style="text-align: right; vertical-align: bottom; font-size: 15px; padding: 3px;">Qty.</th>
                                                

                                                <th class="price" width="130" style="text-align: right; vertical-align: bottom; font-size: 15px; padding: 3px;">Total</th>
                                                <th style="width: 1%; vertical-align: bottom;">&nbsp;</th>
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
                                                                <?php } if ($customOrder->msg_style == 'tyvek' && $customOrder->msg_style != 'vinyl') { ?>
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
                                                        <td class="price" style="text-align: right; border-bottom: 1px solid #ddd; padding: 3px;"><?php echo $regularOrder->qty; ?></td>
                                                        <td class="price" style="text-align: right; border-bottom: 1px solid #ddd; padding: 3px;"><?php echo $regularOrder->price; ?></td>
                                                        
                                                        
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
                                                <td colspan="3"></td>
                                                <td align="right" style="text-align:right;" class="price">Total:</td>
                                                <td style="text-align: right;" class="price grandTotal"><?= Yii::app()->params->currencySymbol . number_format($order->total, Yii::app()->params->decimalPoint) ?></td>
                                            </tr>
                                            <?php if ($order->vat > 0): ?>
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td align="right" style="text-align:right; border-top:1px solid #ddd;" class="price">GST:</td>
                                                    <td style="text-align: right; border-top:1px solid #ddd;" class="price grandTotal"><?= Yii::app()->params->currencySymbol . number_format($order->vat, Yii::app()->params->decimalPoint) ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($order->tax > 0): ?>
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td align="right" style="text-align:right; border-top:1px solid #ddd;" class="price">TAX:</td>
                                                    <td style="text-align: right; border-top:1px solid #ddd;" font-size: 15px; class="price grandTotal"><?= Yii::app()->params->currencySymbol . number_format($order->tax, Yii::app()->params->decimalPoint) ?></td>
                                                </tr>
                                            <?php endif; ?>

                                            <tr>
                                                <td colspan="3"></td>
                                                <td align="right" style="text-align:right; border-top:1px solid #ddd;" class="price">Shipping Cost:</td>
                                                <td style="text-align: right; border-top:1px solid #ddd;" font-size: 15px; class="price grandTotal"><?= Yii::app()->params->currencySymbol . number_format($order->delivery_charge, Yii::app()->params->decimalPoint) ?></td>
                                            </tr>

                                            <tr>
                                                <td colspan="3"></td>
                                                <td align="right" style="text-align:right; border-top:1px solid #ddd;" class="price">Grand Total:</td>
                                                <td style="text-align: right; border-top:1px solid #ddd; padding: 4px; font-size: 15px;" class="price grandTotal"><?= Yii::app()->params->currencySymbol . number_format($order->grand_total, Yii::app()->params->decimalPoint) ?></td>
                                            </tr>                                            
                                        </tfoot>
                                    </table>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>
                
                <?php if(trim($order->order_note)!=''):?>
                <tr>
                    <td style="padding: 5px;">
                        Note: <?= $order->order_note?>
                    </td>
                </tr>
                <?php endif;?>


            <!--                <tr>
                    <td style="background-color: #264a5f; text-align: center; padding: 10px 0px; color: #FFF; font-family: Courier; font-size: 12px;">www.uscraft.com</td>
                </tr>-->

            </table>
        </td>
    </tr>

</table>

<div style="font-family: Courier; font-size: 10px; width: 100%; text-align: center; margin-top: 10px;">This is computer generated official invoice</div>
