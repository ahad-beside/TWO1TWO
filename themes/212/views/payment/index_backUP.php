<style>
    .payment-success{
        text-align: center;
        padding: 20px 0 0;
    }
    .payment-success i{
        color: #7ac142;
        font-size: 84px;
    }
    .paymentprocess{
        padding: 14px 0 20px;
    }
    .paypalresult{
        margin-top: 17px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        $('.visacard').click(function () {
            $('.paypalresult').hide();
            $('.visacardresult').show();
        });
         $('.paypal').click(function () {
            $('.visacardresult').hide();
            $('.paypalresult').show();
        });
        $('select[name="card_type"]').change(function(){
           $('.show_paymentcards').find('img').attr('src','<?= Yii::app()->theme->baseUrl?>/assets/images/'+$(this).find('option:selected').attr('icon'));
        });
        $('#proceed_for_payment').click(function(e){
           e.preventDefault();
           if($('input[name="radio"]').is(':checked')){
               if($('input[name="radio"]:checked').val()=='paypal'){
                   window.location = '<?= $this->createUrl('//payment/paypalSubmit')?>?id=<?= Yii::app()->easycode->safeReadFrom($_GET['id'])?>';
               }
           }
        });
    });
</script>
<div class="container">
    <div class="col-md-12">
        <div class="contentbg">
            <div class="red-title col-md-12">
                <h2>Payment Method</h2>
            </div>
            <div class="col-md-12" style="text-align: center; border-bottom: 1px solid #f2f2f2; padding-bottom: 16px;">
                <?php //echo Yii::app()->easycode->showNotification()?>
                
                <div class="payment-success">
                    <i class="fa fa-check-circle"></i>
                    <div style="font-size:16px; font-weight: bold">Order successfully placed. We will contact you shortly.</div>
                </div>
                
            </div>
            
            <div class="col-md-12 paymentprocess">
                <div class="col-md-9">
                    <div style="font-size:16px; color: #666; margin-bottom: 16px;">Please Select Your Payment Option: </div>
                    <div class="payrow">
                        <div class="row fdoxr">
                            <div class="col-sm-3">
                                <input class="visacard" type="radio" id="radio01" name="radio" value="card" />
                                <label for="radio01"><span></span><img src="<?php echo Yii::app()->theme->baseUrl ?>/assets/images/visa.png" alt="Store-Logo"/></label>
                            </div>
                            <div class="col-sm-9">
                                <strong>Credit and Debit Card</strong> (Visa / Master Card / American Express / Discover / Diners Club / JCB / Maestro / Switch) payments are the most convenient methods especially for recurring service. You have an option your card to be automatically billed every month to ensure uninterrupted service. 
                            </div>
                            
                            <div class="visacardresult col-md-12">
                                <div class="divBillingContainer">
                                    <div class="col-sm-7 row">
                                        <form class="clearfix" autocomplete="off" id="frmBillingInfo">
                                            <div class="form-group">
                                                
                                                <div class="input_column col-xs-9 col-sm-10">
                                                    <label class="ie9">Card Type</label>
                                                    <select id="PaymentMethod" name="card_type" class="form-control input-text-required isguest">
                                                            <option value="">Payment type</option>
                                                            <option selected="" icon="visa-b.png" cardtype="Visa" value="CreditCard">Visa</option>
                                                            <option icon="master-card.png" cardtype="MasterCard" value="CreditCard">MasterCard</option>
                                                            <option icon="discover.png" cardtype="Discover" value="CreditCard">Discover</option>
                                                            <option icon="americanexpress.png" cardtype="AmericanExpress" value="CreditCard">American Express</option>
                                                    </select>
                                                </div>
                                                <div class="show_paymentcards clearfix"><img id="PaymentIcon" src="<?php echo Yii::app()->theme->baseUrl ?>/assets/images/visa-b.png"></div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12"> 
                                                    <label class="ie9">Name on card</label>
                                                <input type="text" placeholder="Name on card" id="CreditCardHolderName" name="CreditCardHolderName" class="form-control input-text-required" value="">
                                                    <div class="help-block">Please use only <u>English Characters</u></div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group clearfix">
                                                <div class="col-sm-12">
                                                    <input type="text" placeholder="Credit card number" pattern="[0-9]*" id="CreditCardNumber" name="CreditCardNumber" class="form-control input-text-required" value="">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group clearfix">
                                                <div class="input_column col-xs-5">
                                                  <label class="ie9">Expiration Month</label>
                                                  <select class="form-control input-text-required" name="CreditCardExpirationMonth">
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option selected="selected" value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                  </select>
                                                </div>
                                                <div class="input_column col-xs-4">
                                                  <label class="ie9">&nbsp;</label>
                                                  <select class="form-control input-text-required" name="CreditCardExpirationYear">
                                                    <option selected="selected" value="2015">2015</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                  </select>
                                                </div>
                                                <div class="col-xs-3">
                                                  <label class="ie9" for="CreditCardSecurityCode">CVV2</label>
                                                  <input type="text" placeholder="CVV2" pattern="[0-9]*" id="CreditCardSecurityCode" name="CreditCardSecurityCode" class="form-control input-text-required">
                                                </div>
                                              </div>
                                            
                                            <div class="form-group clearfix">
                                                <div class="input_column col-xs-6">
                                                  <label class="ie9">Country</label>
                                                  <select class="form-control input-text-required" name="CreditCardExpirationMonth">
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option selected="selected" value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                  </select>
                                                </div>
                                                
                                                <div class="col-xs-6">
                                                  <label class="ie9" for="CreditCardSecurityCode">State</label>
                                                  <select class="form-control input-text-required" name="CreditCardExpirationMonth">
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option selected="selected" value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                  </select>
                                                </div>
                                              </div>
                                            
                                            <div class="form-group input_column_xs">
                                                <div class="input_column col-xs-12 col-sm-7">
                                                    <label class="ie9">City</label>
                                                    <input type="text" placeholder="City" name="CreditCardCity" class="form-control input-text-required">
                                                </div>
                                                <div class="col-xs-12 col-sm-5">
                                                    <label class="ie9" for="CreditCardPostalCode">Postal Code</label>
                                                    <input type="text" placeholder="Postal code" id="CreditCardPostalCode" name="CreditCardPostalCode" class="form-control input-text-required">
                                                </div>
                                            </div>
                                            
                                            <div class="agree">
                                                    <input type="checkbox" id="chkAgreeToTerms">
                                                    <label for="chkAgreeToTerms">I have read and agree to the <a target="_blank" href="/11/terms.php">Terms &amp; Conditions</a>.</label>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <a href="#" class="btn btn-success">Submit</a>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <?php if(trim($settings->paypal_id)!=''):?>
                        <div class="row fdoxr margintop">
                            <div class="col-sm-3">
                                <input class="paypal" type="radio" id="radio02" name="radio" value="paypal" />
                                <label for="radio02"><span></span><img src="<?php echo Yii::app()->theme->baseUrl ?>/assets/images/paypal-payment.png" alt="Store-Logo"/></label>
                            </div>
                            <div class="col-sm-9">
                                <strong>PayPal</strong> is one of the safest, most widely accepted ways to pay for your purchases on the Internet. It lets you use funds from either your bank account or credit card; and you can use it with confidence: Your transactions are protected by PayPal's sophisticated fraud prevention system. Our PayPal account is <strong><a target="_blank" title="PayPal Verified" href="https://www.paypal.com/us/verified/pal=billing%40qhoster.com">Business Verified</a></strong>.
                            </div>
                        </div>
                        <?php endif;?>
                        <div class="paypalresult" style="display:none;">
                            <div class="divBillingContainer">
                                <div>You are still able to purchase with PayPal.<br>
                                    <button class="btn btn-success btn-xs" id="proceed_for_payment">Proceed For Payment</button>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
                <div class="col-md-3 paymentmethodorderdtls">
                    <img src="<?php echo Yii::app()->theme->baseUrl ?>/assets/images/payment-secure.jpg"/>
                </div>
            </div>
            
        </div>
    </div>
</div>