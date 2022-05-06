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
        $('select[name="card_type"]').change(function () {
            $('.show_paymentcards').find('img').attr('src', '<?= Yii::app()->theme->baseUrl ?>/assets/images/' + $(this).find('option:selected').attr('icon'));
        });
        $('#proceed_for_payment').click(function (e) {
            e.preventDefault();
            if ($('input[name="radio"]').is(':checked')) {
                if ($('input[name="radio"]:checked').val() == 'paypal') {
                    window.location = '<?= $this->createUrl('//payment/paypalSubmit') ?>?id=<?= Yii::app()->easycode->safeReadFrom($_GET['id']) ?>';
                                    }
                                }
                            });
                            $('.payMethod').change(function(){
                            //var url
                            if($(this).val()=='Paypal'){
                                var url='<?= Yii::app()->createUrl('//payment/paypal/', array('source' => base64_encode(CJSON::encode(array('id' => $order->id, 'order_number' => $order->order_number, 'grand_total' => $order->grand_total))))) ?>';
                            }else if($(this).val()=='OCBC'){
                                var url='<?= Yii::app()->createUrl('//payment/ocbc/', array('source' => base64_encode(CJSON::encode(array('id' => $order->id, 'order_number' => $order->order_number, 'grand_total' => $order->grand_total))))) ?>';
                            }else{
                                var url='';
                            }
                            $('.payNowLink').attr('href',url);
                            });
                            $('.payNowLink').click(function(){
                            if($('.payNowLink').attr('href')!==''){
                                return true;
                            }else{
                                alert('Please Select Payment Method First');
                                return false;
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
                    <div style="font-size:30px; text-transform: uppercase; font-weight: bold">Success</div>
                    <div style="font-size:17px;">Order placed successfully. Now your order is Pending. To pay online please follow below link.</div>
<!--                    <div><a href="<?//= Yii::app()->createUrl('//payment/ocbc/', array('source' => base64_encode(CJSON::encode(array('id' => $order->id, 'order_number' => $order->order_number, 'grand_total' => $order->grand_total))))) ?>"><img src="<?//= Yii::app()->params->SITE_URL ?>/images/payment-ocbc.jpg"></a></div>-->
                    <div><img src="<?= Yii::app()->params->SITE_URL ?>/images/paymentMethod.jpg"></div>
                    
                    <div style="margin: 10px auto; width: 35%;">
                    <div class="custom-select">
                    <select name="payMethod" class="payMethod payment-own minimal">
                        <option value="">Select Payment Method</option>
                        <option value="Paypal">Paypal</option>
                        <option value="OCBC">OCBC Bank</option>
                    </select>
                    </div>
                        <div class="paynow-button"><a class="payNowLink" href=""><img alt="wristband-paynow" src="<?= Yii::app()->params->SITE_URL ?>/images/paynow.jpg"></a></div>
                    
                    <div class="clear-all"> </div>
                    
                    </div>
<!--                    <div><a href="<?//= Yii::app()->createUrl('//payment/paypal/', array('source' => base64_encode(CJSON::encode(array('id' => $order->id, 'order_number' => $order->order_number, 'grand_total' => $order->grand_total))))) ?>"><img src="http://businessdayonline.com/wp-content/uploads/2014/06/paypal.png"></a></div>-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Google Code for Coversion For SG Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 958400534;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "3Y59COKf0mIQlpCAyQM";
var google_remarketing_only = false;
/* ]]> */



</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"> </script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/958400534/?label=3Y59COKf0mIQlpCAyQM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<style>
    
    .custom-select {
       float: left; 
        
    }
        .payment-own option {
              font-size: 18px;  
          }
    
        .payment-own {  
          /* styling */
          color: #396e0f;
        background-color: white;
        border: thin solid #7ac142;
        border-radius: 4px;
        display: inline-block;
        font-size: 18px;
        line-height: 1.5em;
        padding:8px 70px 10px 10px;
        
        /* reset */

        margin: 0;      
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-appearance: none;
        -moz-appearance: none;

        }
    
    
     .custom-select select.minimal {
        background-image:
          linear-gradient(45deg, transparent 50%, gray 50%),
          linear-gradient(135deg, gray 50%, transparent 50%),
          linear-gradient(to right, #ccc, #ccc);
        background-position:
          calc(100% - 20px) calc(1em + 2px),
          calc(100% - 15px) calc(1em + 2px),
          calc(100% - 2.5em) 0.5em;
        background-size:
          5px 5px,
          5px 5px,
          1px 1.5em;
        background-repeat: no-repeat;
     }
     
     .paynow-button {
       float: left;
       margin-left: 20px;
         
     }
    </style>