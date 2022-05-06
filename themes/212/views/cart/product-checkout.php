<tr>
                                            <td class="card_product_image" data-th="Image"><?php echo Yii::app()->easycode->showImage($v['image'], 80, 80,true,true,Yii::app()->params->productDir);?></td>
                                            <td class="card_product_name" data-th="Product Name"><a href="<?= Products::model()->makeLink($v['id']);?>"><?= $v['name']?></a>
                                                <?php
                                                $d = CJSON::decode($v['productOption']);
                                                if (count($d) > 0):
                                                    echo '<br>';
                                                    for($i=0;$i<count($d);$i++):
                                                        $chkOpPrice = ProductOption::model()->find('id=:id', array(':id' => $d[$i]));
                                                        echo $chkOpPrice->name . ' ( +'.number_format($chkOpPrice->price, Yii::app()->params->decimalPoint) . ')' . '<br>';
                                                    endfor;
                                                endif;
                                                ?>
                                            </td>
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