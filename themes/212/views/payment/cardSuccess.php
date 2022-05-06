<style>
    .paypal-success{
        text-align: center;
    }
    .p-success i{
        color: #7ac142;
        font-size: 103px;
    }
    .processed{
        color:green;
        font-size: 24px;
    }
</style>

<div class="container">
    <div class="col-md-12">
        <div class="contentbg" style="padding: 20px 12px;">
            <div class="paypal-success">
                <div class="p-success"><i class="fa fa-check-circle"></i></div>
                <div class="processed">Your Payment was successfully processed!</div>
                <div>You have just paid <?= Yii::app()->params->companyName?> $4.99 for invoice xxx as of July 16,2015, 12:12.</div>
                <div>Your transaction ID is xxxxxx . Please keep it for your records.</div>
                <div>Iteam Processing time: 10days</div>
                <div>Please contact the supplier for more information</div>
                <div style="padding:7px 0px;">
                    
                    <div class="btn-group" role="group" aria-label="...">
  <button type="button" class="btn btn-primary">Back to Order Details</button>
  <button type="button" class="btn btn-primary">Go to Order List</button>
  <button type="button" class="btn btn-primary">Continue Shopping</button>
</div>
                    
                </div>
            </div>
        </div>
    </div>
</div>