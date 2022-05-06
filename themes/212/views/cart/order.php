<!-- Start Page Header -->
<div class="content-page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb"> <a href="<?= Yii::app()->homeUrl;?>"><i class="icon-home"></i> Home</a> <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span> <span class="current">Checkout</span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Page Header -->
<?php 
$session = Yii::app()->session;
$cartItems = count($session['cart']);
//print_r($session['cart']);
//unset($session['cart']);
?>

<div class="container">
	<div class="whitebox">
    <div class="">

        <?php echo Yii::app()->easycode->showNotification() ?>

        <?php if (count($session['cart']) < 1): ?>
            <div class="col-md-12">
                <div style="font-size: 200px; color: red"><i class="fa fa-shopping-cart"></i></div>
                <div style="font-size: 30px;">Sorry your shopping cart is empty. Minimum one product required for make order.<br> <a href="<?= $this->createUrl('//category/all') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Click here to add Products</a> </div>
            </div>
        <?php else: ?>

            <div class="col-md-12">
                <div class="order">

                    <h1 class="section-title" style="text-align:left;">Place Order</h1>

                    <ul class="accordion-step checkoutstep f1-steps">
                        <div class="f1-progress">
                            <div class="f1-progress-line green_value" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
                        </div>
                        <li data-step="step-1" class="f1-step item login-item <?= (Yii::app()->user->isGuest) ? 'enable' : 'disable' ?>">
                            <div class="heading f1-step-icon" style="padding-top:0px;" data-pos-val='25'>
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <p>Checkout Options</p>
                        </li>
                        <li data-step="step-2" class="f1-step item account_billing <?= (Yii::app()->user->isGuest) ? 'disable' : 'enable' ?>">
                            <div class="heading f1-step-icon" data-btn-click="free">
                                <i class="fa fa-map-marker" style="font-size:25px;"></i>
                            </div>
                            <p>Account Billing & Shipping Details </p>
                        </li>
                        <li data-step="step-3" class="f1-step item shipping_method <?= (Yii::app()->user->isGuest) ? 'disable' : 'enable' ?>">
                            <div class="heading f1-step-icon" data-btn-click="chkBillingShipping" style="padding-top:0px; padding-right:2px;">
                                <i class="fa fa-truck"></i>
                            </div>

                            <p>Shipping Method</p>

                        </li>
                        <li data-step="step-4" class="f1-step item confirm_order <?= (Yii::app()->user->isGuest) ? 'disable' : 'enable' ?>">
                            <div class="heading f1-step-icon" data-button-click="chkShippingMethod">
                                <i class="fa fa-eye"></i>
                            </div>
                            <p>Review Order</p>
                        </li>
                    </ul>


                    <div class="accordion checkoutstep">
                        <div class="item login-item <?= (Yii::app()->user->isGuest) ? 'enable' : 'disable' ?>">
                            <div class="heading step-1" style="display: none"> 1. Checkout Options </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-6 wristrdo newcustomer">
                                        <h3>New Customer <span>Check One Option:</span></h3>
                                        
                                        <div class="error"></div>

                                        <div class="radio radio-success" style="padding-bottom:10px;">
                                            
                                            <input type="radio" id="register-acc" class="new-customer css-checkbox" name="new_customer" value="Register">
                                           <label for="register-acc" class="css-label radGroup1 radio-inline radio"> <span>Register Account</span></label>
                                        </div>

                                        <div class="radio radio-success">
                                        
                                            <input type="radio" class="new-customer css-checkbox" id="guest-acc" name="new_customer" value="Guest">
                                            <label for="guest-acc" class="css-label radGroup1 radio-inline radio">Guest Checkout</label>
                                        </div>

                                        <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>

                                        <button class="btn btn-success new-cust-continue" id="sign-up" type="button">Continue</button>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <h3>Existing Customer <span class="note">Fields with <span class="required">*</span> are required.</span></h3>
                                         <!-- Ajax login form -->
                                        <div class="form">
                                            <?php
                                            $form = $this->beginWidget('CActiveForm', array(
                                                'id' => 'login-form',
                                                'enableClientValidation' => true,
                                                'clientOptions' => array(
                                                    'validateOnSubmit' => true,
                                                    'afterValidate' => 'js:function(form, data, hasError) {
                                                if (!hasError){ 
                                                    str = $("#login-form").serialize() + "&ajax=login-form";

                                                    $.ajax({
                                                        type: "POST",
                                                        url: "' . Yii::app()->createUrl('site/login') . '",
                                                        data: str,
                                                        dataType: "json",
                                                        beforeSend : function() {
                                                            $("#login").attr("disabled",true);
                                                        },
                                                        success: function(data, status) {
                                                            if(data.authenticated)
                                                            {
                                                                window.location = data.redirectUrl;
                                                            }
                                                            else
                                                            {
                                                                $.each(data, function(key, value) {
                                                                    var div = "#"+key+"_em_";
                                                                    $(div).html(value);
                                                                    $(div).show();
                                                                });
                                                                $("#login").attr("disabled",false);
                                                            }
                                                        },
                                                    });
                                                    return false;
                                                }
                                            }',
                                                ),
                                            ));
                                            ?>

                                            <p class="note">Fields with <span class="required">*</span> are required.</p>

                                            <div class="form-group">
                                                <?php echo $form->labelEx($data['login'], 'username', array('class' => 'control-label')); ?>
                                                <?php echo $form->textField($data['login'], 'username', array('class' => 'form-control', 'placeholder' => 'Type your mail')); ?>
                                                <?php echo $form->error($data['login'], 'username'); ?>
                                            </div>

                                            <div class="form-group">
                                                <?php echo $form->labelEx($data['login'], 'password', array('class' => 'control-label')); ?>
                                                <?php echo $form->passwordField($data['login'], 'password', array('class' => 'form-control', 'placeholder' => 'Type your password')); ?>
                                                <?php echo $form->error($data['login'], 'password'); ?>
                                            </div>

                                            <div class="form-group">
                                                <?php echo CHtml::submitButton('Continue', array('id' => 'login', 'class' => 'btn btn-success')); ?>
                                            </div>

                                            <?php $this->endWidget(); ?>
                                        </div>
                                        <!-- Ajax login form -->

                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'order-form',
                            'enableAjaxValidation' => false,
                            'htmlOptions' => array('class' => 'inner-form'),
                        ));
                        ?>
                        <div class="item account_billing <?= (Yii::app()->user->isGuest) ? 'disable' : 'enable' ?>">
                            <div class="heading step-2" data-btn-click="free" style="display: none">2: Account Billing & Shipping Details </div>
                            <div class="content ordertitle">
                                <div class="row">
                                    <div class="col-md-12">

                                        <input type="hidden" name="user_type" value="<?= (!Yii::app()->user->isGuest) ? 'Registered' : '' ?>">


                                        <div class="col-md-6">
                                            <div class="row">
                                                <?php if (Yii::app()->user->isGuest): ?>
                                                    <div class="new-user" id="for-new-registration">
                                                        <h2>Account Information</h2>
                                                        <div class="wristrdo">
                                                            <div class="form-group">
                                                                <label for="exampleInputName2">Full Name</label>
                                                                <input type="text" placeholder="Type your Full Name" class="form-control" name="register_first_name">
                                                                <div id="first_name_em_" class="error"></div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputName2">E-mail</label>
                                                                <input type="text" placeholder="Type your email address" class="form-control" name="register_email_address">
                                                                <div id="register_email_address_em_" class="error"></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputName2">Password</label>
                                                                <input type="password" placeholder="Type your password" class="form-control" name="password">
                                                                <div id="password_em_" class="error"></div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputName2">Re-password</label>
                                                                <input type="password" placeholder="Type your Re-password" class="form-control" name="repassword">
                                                                <div id="repassword_em_" class="error"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="row billing_divided">
                                                <div class="wristrdo">
                                                
                                                    <div style="margin-top:5px;" class="existingaddress-billing">
                                                        <input type="hidden" name="address_id_billing" value="<?= $data['billingInfo']->id ?>">
                                                        <div class="billing_title">
                                                            <h2>Billing Information</h2>
                                                            <div class="form-group">
                                                                <label for="exampleInputName2">Name</label>
                                                                <input type="text" placeholder="Name" class="form-control" name="BillingInfo[name]" value="<?= $data['billingInfo']->name ?>">
                                                                <div id="name_em_" class="error"></div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputName2">Address</label>
                                                                <textarea placeholder="Address" class="form-control" name="BillingInfo[street_address]" rows="2"><?= Yii::app()->easycode->br2nl($data['billingInfo']->street_address) ?></textarea>
                                                                <div id="street_address_em_" class="error"></div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <label for="exampleInputName2">City</label>
                                                                    <input type="text" placeholder="Type your city" class="form-control" name="BillingInfo[city]" value="<?= $data['billingInfo']->city ?>">
                                                                    <div id="city_em_" class="error"></div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="exampleInputName2">Post Code</label>
                                                                    <input type="text" placeholder="Post Code" class="form-control" name="BillingInfo[pincode]" value="<?= $data['billingInfo']->pincode ?>">
                                                                    <div id="pincode_em_" class="error"></div>
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                
                                                                
                                                                
                                                                <div class="col-sm-6">
                                                                    <label for="exampleInputName2">State</label>
                                                                  
                                                                    <?php
                                                                    $billstateList = State::model()->findAll();
                                                                    $htmlOptions = array('class' => 'form-control');
                                                                    if (count($billstateList) > 1):
                                                                        $htmlOptions['empty'] = 'Select Any';
                                                                    endif;
                                                                    echo CHtml::dropDownList('BillingInfo[state]', $data['billingInfo']->state, CHtml::listData($billstateList, code, name), $htmlOptions);
                                                                    ?>
                                                                    
                                                                    <div id="State_em_" class="error"></div>
                                                                    
                                                                </div>
                                                                
                                                                
                                                                <div class="col-sm-6">
                                                                    <label for="exampleInputName2">Country</label>
                                                                    <?php
                                                                    $countryList = Country::model()->findAll();
                                                                    $htmlOptions = array('class' => 'form-control');
                                                                    if (count($countryList) > 1):
                                                                        $htmlOptions['empty'] = 'Select Any';
                                                                    endif;
                                                                    echo CHtml::dropDownList('BillingInfo[country]', $data['billingInfo']->country, CHtml::listData($countryList, id, name), $htmlOptions);
                                                                    ?>
                                                                    <div id="country_em_" class="error"></div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <label for="exampleInputName2">Phone</label>
                                                                    <input type="text" placeholder="Phone" class="form-control" name="BillingInfo[phone]" value="<?= $data['billingInfo']->phone ?>">
                                                                    <div id="phone_em_" class="error"></div>
                                                                </div> 
                                                               <div class="col-sm-6">
                                                                    <?php if (Yii::app()->user->isGuest): ?>
                                                                <div class="form-group guest-user">
                                                                    <label for="exampleInputName2">Email</label>
                                                                    <input type="text" placeholder="Type your email" class="form-control" name="guest_email_address">
                                                                    <div id="guest_email_address_em_" class="error"></div>
                                                                </div>
                                                            <?php endif; ?>
                                                                </div>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <div class="newadd-delivery shipping_divided">
                                                    <h2>Shipping Information</h2>
                                                    <!--<div class="orgcheck" style="margin-top:0px;">
                                                        <input type="checkbox" name="same_as_billing" id="chksm" class="css-checkbox filtercheck">
                                                        <label for="chksm" class="css-label radGroup1 radGroup1" style="padding-top:1px;">Same as billing address</label>
                                                    </div>-->
                                                    
                                                    
					<div class="checkbox checkbox-success orgcheck">
                        <input id="sameaddress" class="styled" name="same_as_billing" type="checkbox">
                        <label for="sameaddress">
                            Same as billing address
                        </label>
                    </div>
                                                    
                                                    
                                                    
                                                    
                                                    <input type="hidden" name="address_id_delivery" value="<?= $data['shippingInfo']->id ?>">

                                                    <div class="form-group">
                                                        <label for="exampleInputName2">Name</label>
                                                        <input type="text" placeholder="Name" class="form-control" name="ShippingInfo[name]" value="<?= $data['shippingInfo']->name ?>">
                                                        <div id="shipping_name_em_" class="error"></div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputName2">Address</label>
                                                        <textarea class="form-control" placeholder="Address" name="ShippingInfo[street_address]" rows="2"><?= Yii::app()->easycode->br2nl($data['shippingInfo']->street_address) ?></textarea>
                                                        <div id="shipping_street_address_em_" class="error"></div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label for="exampleInputName2">City</label>
                                                            <input type="text" placeholder="Type your city" class="form-control" name="ShippingInfo[city]" value="<?= $data['shippingInfo']->city ?>">
                                                            <div id="shipping_city_em_" class="error"></div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="exampleInputName2">Post Code</label>
                                                            <input type="text" placeholder="Post Code" class="form-control" name="ShippingInfo[pincode]" value="<?= $data['shippingInfo']->pincode ?>">
                                                            <div id="shipping_pincode_em_" class="error"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        
                                                        <div class="col-sm-6">
                                                            
                                                            <label for="exampleInputName2">State</label>
                                                                    
                                                                    
                                                                   <?php
                                                                    $shipstateList = State::model()->findAll();
                                                                    $htmlOptions = array('class' => 'form-control');
                                                                    if (count($shipstateList) > 1):
                                                                        $htmlOptions['empty'] = 'Select Any';
                                                                    endif;
                                                                    echo CHtml::dropDownList('ShippingInfo[state]', $data['shippingInfo']->state, CHtml::listData($shipstateList, code, name), $htmlOptions);
                                                                    ?>
                                                        
                                                            
                                                        </div>
                                                        
                                                        <div class="col-sm-6">
                                                            <label for="exampleInputName2">Country</label>
                                                            <?php
                                                            $countryList = Country::model()->findAll();
                                                            $htmlOptions = array('class' => 'form-control');
                                                            if (count($countryList) > 1):
                                                                $htmlOptions['empty'] = 'Select Any';
                                                            endif;
                                                            echo CHtml::dropDownList('ShippingInfo[country]', $data['shippingInfo']->country, CHtml::listData($countryList, id, name), $htmlOptions)
                                                            ?>
                                                            <div id="shipping_country_em_" class="error"></div>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    
                                                    <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <label for="exampleInputName2">Phone</label>
                                                            <input type="text" placeholder="Phone" class="form-control" name="ShippingInfo[phone]" value="<?= $data['shippingInfo']->phone ?>">
                                                            <div id="shipping_phone_em_" class="error"></div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="cart_order_submit_button"><button type="button" id="sign-up" class="btn btn-success chkBillingShipping">Continue</button></div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="item shipping_method <?= (Yii::app()->user->isGuest) ? 'disable' : 'enable' ?>">
                            <div class="heading step-3" data-btn-click="chkBillingShipping" style="display: none">3. Shipping Method</div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="error"></div>
                                        <div style="display:block">
                                           <?php if (count($data['shippingMethod']) > 0): ?>
                                            <p>Please select the preferred shipping method to use on this order.</p>

                                            <?php
                                            $x = 0;
                                            foreach ($data['shippingMethod'] as $sm): $x++;
                                                ?>
                                                <div class="radio wristrdo radio-success">
                                                    
                                                    <input value="<?= $sm->price ?>" type="radio" name="shipping_method" id="radio-dm-<?= $x ?>" class="css-checkbox" <?php
                                                    if (count($data['shippingMethod']) == 1) {
                                                        echo 'checked="checked"';
                                                    }
                                                    ?>>
                                                   <label for="radio-dm-<?= $x ?>" class="css-label radGroup1 radio-inline radio">  <?= $sm->name ?> (<?= $sm->price ?>)</label>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <p>No shipping method available for this time.</p>
                                        <?php endif; ?> 
                                        </div>
                                        
                                        <div class="col-md-12 cart_order_submit_button"><button type="button" id="sign-up" class="btn btn-success chkShippingMethod">Continue</button></div>
                                    </div>
                                </div>   
                            </div>
                        </div>

                        <div class="item confirm_order <?= (Yii::app()->user->isGuest) ? 'disable' : 'enable' ?>">
                            <div class="heading step-4" data-button-click="chkShippingMethod" style="display: none">4. Review Order</div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                        $cartItems = count($session['cart']);
                                        if ($cartItems == 0) {
                                            ?>
                                            <div style="width: 100%; border: solid 1px white; font-size: 16px; font-weight: bold;">You have no items in cart.</div>
                                            <?php
                                        } else {
                                            ?>

                                            <table class="checkout-table gu12 table" data-wow-duration="1s" style="visibility: visible;-webkit-animation-duration: 1s; -moz-animation-duration: 1s; animation-duration: 1s;">
                                    <thead>
                                        <tr>
                                            <th width="42" class="card_product_image">Image</th>
                                            <th width="211" class="card_product_name">Product Name</th>
                                            <!-- <th width="162" class="card_product_model">Model</th> -->
                                            <th width="146" class="card_product_quantity text-center">Quantity</th>
                                            <th width="130" class="card_product_price">Unit Price ($)</th>
                                            <th width="146" class="card_product_total">Total ($)</th>
                                            <th width="50" class="card_product_total"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $i = 1;
                                    $total = 0;
                                    foreach ($session['cart'] as $k => $v):
                                        if ($v['item_from'] == 'Product')
                                            $this->renderPartial('product-checkout', array('v' => $v, 'k' => $k, 'update' => true,'count'=>$i));
                                        else if($v['item_from'] == 'Service'){
                                            $this->renderPartial('service-checkout', array('v' => $v, 'k' => $k, 'update' => true,'count'=>$i));
                                        }
                                        $total += $v['price'];
                                        ///echo $i;
                                        
                                        $i++;
                                    endforeach;
                                    ?>
                                        

                                        <!-- <tr>
                                            <td class="" data-th="Image" colspan="4" style="border-bottom:none;">
                                            </td>
                                            
                                            
                                            
                                            <td class="card_product_price border-btm" data-th="Unit Price" style="text-align:right; background-color:#eaeaea;"><strong>Sub Total ($)</strong></td>
                                            <td class="card_product_total border-btm" data-th="Total">
                                                $777.00
                                               
                                            </td>
                                        </tr> -->
                                        
                                        
                                        <!-- <tr>
                                            <td class="" data-th="Image" colspan="4" style="border-top:none;">
                                            </td>
                                            <td class="card_product_price border-btm" data-th="Unit Price" style="text-align:right; background-color:#eaeaea;"><strong>Shipping Cost ($)</strong></td>
                                            <td class="card_product_total border-btm" data-th="Total">
                                                $777.00
                                               
                                            </td>
                                        </tr> -->
                                        
                                        
                                        <tr>
                                            <td class="" data-th="Image" colspan="3" style="border-top:none;">&nbsp;
                                            </td>
                                            
                                            
                                            
                                            <td class="card_product_price border-btm" data-th="Unit Price" style="text-align:right; background-color:#eaeaea;"><strong>Total Cost ($)</strong></td>
                                            <td class="card_product_total border-btm grandTotal" data-th="Total">
                                                <?= number_format($total,Yii::app()->params->decimalPoint)?>
                                               
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-12 cart_order_submit_button">
                                        <input type="submit" class="btn btn-success btn-lg" value="Place Order">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $this->endWidget();
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
</div>

<script>
    $('button[data-loading-text]')
            .on('click', function () {
                var btn = $(this)
                btn.button('loading')
                setTimeout(function () {
                    btn.button('reset')
                }, 3000)
            });

$(document).ready(function () {
<?php if (Yii::app()->user->isGuest): ?>
            ocAccordion($('.checkoutstep').find('.login-item').find('.heading'));
<?php else: ?>

            //By Default open billing info when login
            var billing = $('.checkoutstep').find('.account_billing').find('.heading');
            ocAccordion(billing);
<?php endif; ?>

        /* function for open and close accordion*/
        function ocAccordion(billing) {
            if (billing.parent().hasClass('enable')) {
                var a = billing.closest('.item');
                var b = $(a).hasClass('open');
                var c = $(a).closest('.accordion').find('.open');

                if (b != true) {
                    $(c).find('.content').slideUp(200);
                    $(c).removeClass('open');
                }

                $(a).toggleClass('open');
                $(a).find('.content').slideToggle(200);
            }
        }
        
        $('.accordion-step .item').click(function(){
            $('.accordion-step .item').removeClass('actives');
            $('.accordion-step .item').removeClass('open');
            if($(this).hasClass('actives')){
                
            }else{
                $(this).addClass('actives');
                $('.'+$(this).attr('data-step')).trigger('click');
            }
        });

        /*When one accordion is verified*/
        $('.accordion .item .heading').click(function () {
            var billing = $(this);

            if (billing.attr('data-btn-click') == 'free') {
                $('.accordion-step .item').removeClass('open');  //jalil add
                if (billing.parent().hasClass('verified')) {
                    ocAccordion(billing);
                }
            } else {
                $('.' + billing.attr('data-btn-click')).trigger('click');
            }



        });

        /* 1st Step check */
        $('input[name="new_customer"]').click(function () {
            var newcust = $('input[name="new_customer"]:checked').val();
            if (newcust == 'Register') {
                $('.new-user').show();
                $('.guest-user').hide();
            } else {
                $('.new-user').hide();
                $('.guest-user').show();
            }
            $('input[name="user_type"]').val(newcust);
        });

        $('.new-cust-continue').click(function (e) {
            var newcust = $('input[name="new_customer"]:checked').val();
            if (typeof newcust != 'undefined') {
                $('.checkoutstep').find('.login-item').addClass('verified');
                $('.checkoutstep').find('.account_billing').removeClass('disable');
                $('.checkoutstep').find('.account_billing').addClass('enable');
                ocAccordion($('.checkoutstep').find('.account_billing').find('.heading'));

                //alert($('select[name="address_id_billing"]:selected').val());
            } else {
                $('.newcustomer').find('.error').html('Please choose a option');
            }
        });
        /* 1st Step check */

        /*2nd Step Check billing address*/

        /* check mail address after typing */
        $('input[name="register_email_address"]').keyup(function () {
            var mail = $(this);
            if (mail.val().trim() != '') {
                $.post('<?= $this->createUrl('//cart/checkExistenceOfUser'); ?>', {email: mail.val().trim()}, function (data) {
                    if (data == '0') {
                        $('#register_email_address_em_').html('Sorry this email already resigtered with us, Try another');
                        $('#register_email_address_em_').show();
                    } else {
                        $('#register_email_address_em_').hide();
                    }
                });
            }
        });

        /* chk password after typing */
        $('input[name="repassword"]').keyup(function () {
            var pass = $('input[name="password"]').val().trim();
            var repass = $('input[name="repassword"]').val().trim();

            if (pass != repass) {
                $('#repassword_em_').html('Re-Password must be same as password');
                $('#repassword_em_').show();
            }
            if (repass == '') {
                $('#repassword_em_').html('Re-Password can\'t be blank');
                $('#repassword_em_').show();
            }

        });


        function chkRegisterGuestBillingArea() {
            var newcust = $('input[name="new_customer"]:checked').val();
            var mnchk = 1;
<?php if (Yii::app()->user->isGuest) { ?>
                if (newcust == 'Register') {
                    /*chk register email pass check*/
                    var firstname = $('input[name="register_first_name"]').val().trim();

                    var email = $('input[name="register_email_address"]').val().trim();
                    var pass = $('input[name="password"]').val().trim();
                    var repass = $('input[name="repassword"]').val().trim();

                    if (!isValidEmailAddress(email)) {
                        mnchk = mnchk + 1;
                        $('#register_email_address_em_').html('Invalid email address');
                        $('#register_email_address_em_').show();
                    }

                    if (firstname == '') {
                        mnchk = mnchk + 1;
                        $('#first_name_em_').html('First name can\'t be blank');
                        $('#first_name_em_').show();
                    }



                    if (pass == '') {
                        mnchk = mnchk + 1;
                        $('#password_em_').html('Password can\'t be blank');
                        $('#password_em_').show();
                    }

                    if (repass == '') {
                        mnchk = mnchk + 1;
                        $('#repassword_em_').html('Re-Password can\'t be blank');
                        $('#repassword_em_').show();
                    }

                    if (pass != repass) {
                        mnchk = mnchk + 1;
                        $('#repassword_em_').html('Re-Password must be same as password');
                        $('#repassword_em_').show();
                    }

                    return mnchk;

                } else {
                    var email = $('input[name="guest_email_address"]').val().trim();
                    if (!isValidEmailAddress(email)) {
                        mnchk = mnchk + 1;
                        $('#guest_email_address_em_').html('Invalid email address');
                        $('#guest_email_address_em_').show();
                    }
                    return mnchk;
                }
<?php } else { ?>

                return mnchk;

<?php } ?>
        }

        $('.chkBillingShipping').click(function (e) {
            //alert(0);
            e.preventDefault();
            var mnchk = chkRegisterGuestBillingArea();
            var b_name = $('input[name="BillingInfo[name]"]').val().trim();
            var b_street_address = $('textarea[name="BillingInfo[street_address]"]').val().trim();
            var b_city = $('input[name="BillingInfo[city]"]').val();
            var b_state= $('select[name="BillingInfo[state]"]').val();
            var b_country = $('select[name="BillingInfo[country]"]').val();
            var b_pincode = $('input[name="BillingInfo[pincode]"]').val().trim();
            var b_phone = $('input[name="BillingInfo[phone]"]').val().trim();

            var s_name = $('input[name="ShippingInfo[name]"]').val().trim();
            var s_street_address = $('textarea[name="ShippingInfo[street_address]"]').val().trim();
            var s_city = $('input[name="ShippingInfo[city]"]').val();
            var s_state = $('select[name="ShippingInfo[state]"]').val();
            var s_country = $('select[name="ShippingInfo[country]"]').val();
            var s_pincode = $('input[name="ShippingInfo[pincode]"]').val().trim();
            var s_phone = $('input[name="ShippingInfo[phone]"]').val().trim();;
            //alert(s_productWeight);
            addLoading('.accordion');
            $('.account_billing').find('.error').hide();
            //for billing
            $.post('<?= $this->createUrl('//cart/chkBillingInput'); ?>', {name: b_name, street_address: b_street_address, city: b_city,state: b_state, country: b_country, pincode: b_pincode, phone: b_phone}, function (data) {
                data = JSON.parse(data);
                if (!data.validate) {
                    mnchk = parseInt(mnchk) + 1;
                    $.each(data.errors, function (key, value) {
                        var div = "#" + key + "_em_";
                        $(div).text(value);
                        $(div).show();
                    });
                }

                //for shipping
                $('.delivery_details').find('.error').hide();
                $.post('<?= $this->createUrl('//cart/chkShippingInput'); ?>', {name: s_name, street_address: s_street_address, city: s_city,state: s_state, country: s_country, pincode: s_pincode, phone: s_phone}, function (data) {
                    //alert(s_productTypeShipping);
                    //shipping new section start
                    //shipping new section end
                    data = JSON.parse(data);
                    if (!data.validate) {
                        mnchk = parseInt(mnchk) + 1;
                        $.each(data.errors, function (key, value) {
                            var div = "#shipping_" + key + "_em_";
                            $(div).text(value);
                            $(div).show();
                        });
                    }

<?php if (Yii::app()->user->isGuest): ?>
                        //chk email for new register
                        var newcust = $('input[name="new_customer"]:checked').val();
                        var email = $('input[name="register_email_address"]').val().trim();
                        if (newcust == 'Register') {
                            $.post('<?= $this->createUrl('//cart/checkExistenceOfUser'); ?>', {email: email}, function (data) {
                                if (data == '0') {
                                    $('#register_email_address_em_').html('Sorry this email already resigtered with us, Try another');
                                    $('#register_email_address_em_').show();
                                    mnchk = parseInt(mnchk) + 1;
                                }

                                if (mnchk == 1) {
                                    $('.checkoutstep').find('.account_billing').addClass('verified');
                                    $('.checkoutstep').find('.shipping_method').addClass('enable');
                                    $('.checkoutstep').find('.shipping_method').removeClass('disable');
                                    ocAccordion($('.checkoutstep').find('.shipping_method').find('.heading'));
                                }
                                chkRegisterGuestBillingArea();
                                removeLoading('.accordion');
                            });
                        } else {
                            if (mnchk == 1) {
                                $('.checkoutstep').find('.account_billing').addClass('verified');
                                $('.checkoutstep').find('.shipping_method').addClass('enable');
                                $('.checkoutstep').find('.shipping_method').removeClass('disable');
                                ocAccordion($('.checkoutstep').find('.shipping_method').find('.heading'));
                            }
                            chkRegisterGuestBillingArea();
                            removeLoading('.accordion');
                        }
<?php else: ?>
                        if (mnchk == 1) {
                            $('.checkoutstep').find('.account_billing').addClass('verified');
                            $('.checkoutstep').find('.shipping_method').addClass('enable');
                            $('.checkoutstep').find('.shipping_method').removeClass('disable');
                            ocAccordion($('.checkoutstep').find('.shipping_method').find('.heading'));
                        }
                        chkRegisterGuestBillingArea();
                        removeLoading('.accordion');
<?php endif; ?>

                });

            });

        });

        /* 3rd Step Check shipping address*/

        /* Same as billing */
        $('input[name="same_as_billing"]').click(function () {
            if ($(this).is(':checked')) {
                $('input[name="ShippingInfo[name]"]').val($('input[name="BillingInfo[name]"]').val());
                $('textarea[name="ShippingInfo[street_address]"]').val($('textarea[name="BillingInfo[street_address]"]').val());
                $('input[name="ShippingInfo[city]"]').val($('input[name="BillingInfo[city]"]').val());
                $('input[name="ShippingInfo[pincode]"]').val($('input[name="BillingInfo[pincode]"]').val());
                $('select[name="ShippingInfo[country]"]').val($('select[name="BillingInfo[country]"]').val());
                $('select[name="ShippingInfo[state]"]').val($('select[name="BillingInfo[state]"]').val());
                $('input[name="ShippingInfo[phone]"]').val($('input[name="BillingInfo[phone]"]').val());
            } else {
                $('input[name="ShippingInfo[name]"]').val('');
                $('textarea[name="ShippingInfo[street_address]"]').val('');
                $('input[name="ShippingInfo[city]"]').val('');
                $('input[name="ShippingInfo[pincode]"]').val('');
                $('select[name="ShippingInfo[country]"]').val('');
                $('select[name="ShippingInfo[state]"]').val('');
                $('input[name="ShippingInfo[phone]"]').val('');
            }
        });

        $('.existingaddress-billing').find('input,textarea').keyup(function () {
            if ($('input[name="same_as_billing"]').is(':checked')) {
                $('input[name="same_as_billing"]').trigger('click');
                $('input[name="same_as_billing"]').trigger('click');
            }
        });
        $('.existingaddress-billing').find('select').change(function () {
            if ($('input[name="same_as_billing"]').is(':checked')) {
                $('input[name="same_as_billing"]').trigger('click');
                $('input[name="same_as_billing"]').trigger('click');
            }
        });

        /* 4rth Step Check shippig method */
        $('.chkShippingMethod').click(function (e) {
            e.preventDefault();
            var method = $('input[name="shipping_method"]:checked').val();
            
            if (typeof method != 'undefined') {
//alert(s_productTypeShipping);
                /* Shipping method add to session */
                $.get('<?= $this->createUrl('//cart/addShippingMethodToSession') ?>', {method: method}, function (data) {
                    //alert(data);
                    if (data == 1) {
                        updateCheckOutPrice();
                        $('.checkoutstep').find('.shipping_method').addClass('verified');
                        $('.checkoutstep').find('.confirm_order').addClass('enable');
                        $('.checkoutstep').find('.confirm_order').removeClass('disable');
                        ocAccordion($('.checkoutstep').find('.confirm_order').find('.heading'));
                    }
                });
                /* Shipping method add to session */
            } else {
                $('.shipping_method').find('.error').html('Please choose a option');
            }
        });
    });
</script>

<script>
    $('body').on('click', '.rmitem-order', function () {
        var $obj = $(this);
        if (confirm('Are you sure to delete?') == true) {
            $.post('<?= Yii::app()->createUrl('//cart/dell/') ?>', {id: $obj.attr('data-id')}, function (data) {
                if (data == 1) {
                    $obj.parent().parent().remove();
                    updateCheckOutPrice();
                    updateMiniCart();
                    updateCartCountAmount();
                }
            });
        } else {
            return false;
        }
    });
    $('body').on('keyup', '.qtyref', function () {
        var $obj = $(this);
        $obj.parent().parent().find('.fa-refresh').trigger('click');
    });
    function updatecart($this) {
        var qty = $this.parent().parent().find('input').val();
        var cartid = $this.parent().parent().find('input').attr('data-id');
        //alert(qty+'-'+cartid);
        $.post('<?= Yii::app()->createUrl('//cart/updateCart/') ?>', {id: cartid, qty: qty}, function (data) {
            $this.parent().parent().parent().next().next('td').html(data);
            updateCheckOutPrice();
            updateMiniCart();
            updateCartCountAmount();
        });
    }
    function updateCheckOutPrice() {
                        var total = 0;
                        var count=0;
                        $('.indTotal').each(function () {
                            total = parseFloat(total) + parseFloat($(this).html().replace(',', ''));
                            count ++;
                        });
                        //alert(total);
                        $('.grandTotal').html(formatMoney(total));
                        if(count==0){
                           $('.zerodiv').css('display','none');
                           $('.zeroProduct').css('display','block');
                        }
                    }
    $(document).ready(function () {
        updateCheckOutPrice();
    });

</script>


