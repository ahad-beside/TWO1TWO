<div class="container">
	<div style="width:100%; display:inline-block; margin:100px 0; padding-top:100px;">
    <div class="col-md-12">
    <div class="whitebox">
        <div class="contentbg">
            <div class="col-md-12" style="display: none">
                <div class="form">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'action' => PAYPAL_URL,
                        'id' => 'orderForm',
                        'htmlOptions' => array()
                    ));
                    // paypal fields
                    echo CHtml::hiddenField('cmd', '_xclick');
                    echo CHtml::hiddenField('currency_code', 'USD'); // enter currency
                    echo CHtml::hiddenField('business', PAYPAL_EMAIL);

// set up path to successful order
                    echo CHtml::hiddenField('return', Yii::app()->getRequest()->getBaseUrl(true) . '/payment/paypalSuccess');
// set up url to cancel order
                    echo CHtml::hiddenField('cancel_return', Yii::app()->getRequest()->getBaseUrl(true) . '/payment/canceled');
// set up path to paypal IPN listener
                    echo CHtml::hiddenField('notify_url', Yii::app()->getRequest()->getBaseUrl(true) . '/payment/paypalNotify');

                    echo CHtml::hiddenField('item_name', $invoice->invoice_number); // product title goes here
                    echo CHtml::hiddenField('amount', number_format($invoice->invoice_amount,Yii::app()->params->decimalPoint), array('id' => 'paypalPrice'));
                   
                    echo CHtml::hiddenField('custom', $invoice->id, array('id' => 'paypalOrderId')); // here we will set order id after we create the order via ajax
                    echo CHtml::hiddenField('charset', 'utf-8');
                    // order fields
                    echo CHtml::submitButton('Submit',array('id'=>'submit_to_paypal'));
                    ?>

                    <?php $this->endWidget(); ?>
                </div>

            </div>
            <div class="col-md-12" style="text-align: center">
                <h1>Please Wait...</h1>
                <h3>Don't close browser</h3>
                <h1><i class="fa fa-spin fa-cogs"></i></h1>
            </div>
            
        </div>
        </div>
    </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#submit_to_paypal').trigger('click');
    });
</script>