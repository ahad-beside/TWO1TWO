<div class="cart-entry"> <?= Yii::app()->easycode->showImage($v['image'], 40, 30,true,true,Yii::app()->params->serviceDir) ?>
                    <div class="content"> <?= CHtml::link($v['name'],  Products::model()->makeLink($v['id'])) ?>
                      <p class="quantity">Quantity: <?= $v['qty'] ?></p>
                      <span class="price">$<?= number_format($v['productPrice']*$v['qty'],Yii::app()->params->decimalPoint) ?></span> </div>
                    <div class="button-x"> <a class="rmitem" data-id="<?= $k ?>" href="javascript:void(0);<?php //echo Yii::app()->createUrl('//cart/dell/' . $k . '?return=checkout');   ?>"><i class="fa fa-trash-o"></i></a></div>
                  </div>