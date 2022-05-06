<tr>
                                            <td class="card_product_image" data-th="Image"><?php echo Yii::app()->easycode->showImage($v['image'], 80, 80,true,true,Yii::app()->params->serviceDir);?></td>
                                            <td class="card_product_name" data-th="Product Name"><a href="<?= Service::model()->makeLink($v['id']);?>"><?= $v['name']?></a></td>
                                            <!-- <td class="card_product_model" data-th="Model">Pro 1</td> -->
                                            <td class="card_product_quantity" data-th="Quantity">
                                            	<div class="count-input space-bottom">
                                                    <a class="incr-btn decrease" data-action="decrease" href="#">–</a>
                                                    <input class="quantity qtyref" type="text" name="quantity" value="<?= $v['qty'] ?>" data-id="<?= $k ?>"/>
                                                    <a class="incr-btn increase" data-action="increase" href="#">&plus;</a>
                                                    <span style="float: left; margin-top: 2px; display: none">
            <i class="fa fa-refresh" onclick="updatecart($(this))" style="cursor: pointer"></i>
        </span>
                                                </div>
                                            </td>
                                            <td class="card_product_price" data-th="Unit Price"><?= number_format($v['productPrice'],Yii::app()->params->decimalPoint);?></td>
                                            <td class="card_product_total indTotal" data-th="Total">
                                            <?= number_format($v['price'],Yii::app()->params->decimalPoint);?>
                                            <?php if($v['subscriptionId']!=''){
                                                // $invoiceDate='2018-01-01';
                                                // echo date('Y-m-d', strtotime($invoiceDate."+5 days"));
                                                $subscriptionDetails=Subscription::model()->findByPk($v['subscriptionId']);
                                                echo '<br>'.$subscriptionDetails->name.' Subscription<br>$'.number_format($v['price']/$subscriptionDetails->total_month,2).'/month';
                                                ?>

                                            <?php } ?>
                                            <!--  <a href="#" style="float:right"><i class="icon-trash icon-large"></i> </a> -->
                                                
                                            </td>
                                            <td><a class="icon-trash icon-large rmitem-order" data-id="<?= $k ?>" href="javascript:void(0);<?php //echo Yii::app()->createUrl('//cart/dell/'.$k.'?return=order');  ?>"></a></td>
                                            
                                        </tr>
                                        <script>
                                            $(document).on('click','.decrease',function(){
                                                $('.fa-refresh').trigger('click');
                                            });
                                            $(document).on('click','.increase',function(){
                                                $('.fa-refresh').trigger('click');
                                            });
                                        </script>