<div class="existing_address">
    <div class="col-md-12 errorBillShip" style="display:none"></div>
    <div class="col-md-6" style="padding-top:12px;">
        <label for="OrderNumber">Billing Information</label>
        <input type="hidden" name="billingInfoPk" value="<?= $billing->id?>">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="User_first_name">Full Name <span class="required" style="color:red">*</span></label>
                    <input type="text" id="BillingInfo_name" name="BillingInfo[name]" class="form-control billing" maxlength="50" size="50" value="<?= $billing->name?>">
                    <div class="error error_name"></div>
                </div>
            </div>
            <div class="col-md-6">
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="required" for="BillingInfo_street_address">Street Address <span class="required">*</span></label>
                    <textarea type="text" id="BillingInfo_street_address" name="BillingInfo[street_address]" class="form-control billing" rows="2"><?= Yii::app()->easycode->br2nl($billing->street_address)?></textarea>
                    <div class="error error_street_address"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="BillingInfo_city">City <span class="required">*</span></label>
                    <input type="text" id="BillingInfo_city" name="BillingInfo[city]" class="form-control billing" maxlength="50" size="50" value="<?= $billing->city?>">
                    <div class="error error_city"></div>
                </div>
            </div>
            <div class="col-sm-6">
                                                                    <label for="exampleInputName2">State</label>
                                                                  
                                                                    <?php
                                                                    $billstateList = State::model()->findAll();
                                                                    $htmlOptions = array('class' => 'form-control');
                                                                    if (count($billstateList) > 1):
                                                                        $htmlOptions['empty'] = 'Select Any';
                                                                    endif;
                                                                    echo CHtml::dropDownList('BillingInfo[state]', $billing->state, CHtml::listData($billstateList, code, name), $htmlOptions);
                                                                    ?>
                                                                    
                                                                    <div id="State_em_" class="error"></div>
                                                                    
                                                                </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="BillingInfo_country">Country <span class="required">*</span></label>
                    <?php
                    //$countryList = Country::model()->findAll(array('order'=>'name'));
                    $countryList = Country::model()->findAllBySql("select * from country ORDER BY CASE WHEN name = 'Singapore' THEN 1 ELSE 2 END,name ASC");
                    $htmlOptions = array('class' => 'form-control billing');
                    if (count($countryList) > 1):
                        $htmlOptions['empty'] = 'Select Any';
                    endif;
                    echo CHtml::dropDownList('BillingInfo[country]', $billing->country, CHtml::listData($countryList, id, name), $htmlOptions);
                    ?>
                    <div class="error error_country"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="BillingInfo_pincode">Post Code <span class="required">*</span></label>
                    <input type="text" id="BillingInfo_pincode" name="BillingInfo[pincode]" class="form-control billing" maxlength="50" size="50" value="<?= $billing->pincode?>">
                    <div class="error error_pincode"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="BillingInfo_phone">Phone <span class="required">*</span></label>
                    <input type="text" id="BillingInfo_phone" name="BillingInfo[phone]" class="form-control billing" maxlength="50" size="50" value="<?= $billing->phone?>">
                    <div class="error error_phone"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6" style="padding-top:12px;">
        <label for="OrderNumber">Shipping Information </label>  <input type="checkbox" id="same_as_bill"> Same As Billing
        <input type="hidden" name="shippingInfoPk" value="<?= $shipping->id?>">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="ShippingInfo_name">Full Name <span class="required" style="color:red">*</span></label>
                    <input type="text" id="ShippingInfo_name" name="ShippingInfo[name]" class="form-control shipping" maxlength="50" size="50" value="<?= $shipping->name?>" data-value="<?= $shipping->name?>">
                    <div class="error error_name"></div>
                </div>
            </div>
            <div class="col-md-6">
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="required" for="ShippingInfo_street_address">Street Address <span class="required">*</span></label>
                    <textarea type="text" id="ShippingInfo_street_address" name="ShippingInfo[street_address]" class="form-control shipping" rows="2" data-value="<?= Yii::app()->easycode->br2nl($shipping->street_address)?>"><?= Yii::app()->easycode->br2nl($shipping->street_address)?></textarea>
                    <div class="error error_street_address"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="ShippingInfo_city">City <span class="required">*</span></label>
                    <input type="text" id="ShippingInfo_city" name="ShippingInfo[city]" class="form-control shipping" maxlength="50" size="50" value="<?= $shipping->city?>" data-value="<?= $shipping->city?>">
                    <div class="error error_city"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="ShippingInfo_pincode">Post Code <span class="required">*</span></label>
                    <input type="text" id="ShippingInfo_pincode" name="ShippingInfo[pincode]" class="form-control shipping" maxlength="50" size="50" value="<?= $shipping->pincode?>" data-value="<?= $shipping->pincode?>">
                    <div class="error error_pincode"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                                                        	
                                                            <label for="exampleInputName2">State</label>
                                                                    
                                                                    
                                                                   <?php
                                                                    $shipstateList = State::model()->findAll();
                                                                    $htmlOptions = array('class' => 'form-control');
                                                                    if (count($shipstateList) > 1):
                                                                        $htmlOptions['empty'] = 'Select Any';
                                                                    endif;
                                                                    echo CHtml::dropDownList('ShippingInfo[state]', $shipping->state, CHtml::listData($shipstateList, code, name), $htmlOptions);
                                                                    ?>
                                                        
                                                            
                                                        </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="ShippingInfo_country">Country <span class="required">*</span></label>
                    <?php
                    //$countryList = Country::model()->findAll(array('order'=>'name'));
                    $countryList = Country::model()->findAllBySql("select * from country ORDER BY CASE WHEN name = 'Singapore' THEN 1 ELSE 2 END,name ASC");
                    $htmlOptions = array('class' => 'form-control shipping','data-value'=>$shipping->country);
                    if (count($countryList) > 1):
                        $htmlOptions['empty'] = 'Select Any';
                    endif;
                    echo CHtml::dropDownList('ShippingInfo[country]', $shipping->country, CHtml::listData($countryList, id, name), $htmlOptions);
                    ?>
                    <div class="error error_country"></div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="ShippingInfo_phone">Phone <span class="required">*</span></label>
                    <input type="text" id="ShippingInfo_phone" name="ShippingInfo[phone]" class="form-control shipping" maxlength="50" size="50" value="<?= $shipping->phone?>" data-value="<?= $shipping->phone?>">
                    <div class="error error_phone"></div>
                </div>
            </div>
        </div>
    </div>
</div>