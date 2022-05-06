<style>
    .pageerror{
        padding:20px;
        text-align: center;
    }
    .sorry{
        color: #666666;
        font-size: 29px;
        font-family: "oswaldregular",Arial,Helvetica,sans-serif !important;
        text-transform: uppercase;
        margin-top: 7px;
    }
    .pageerrormsg{
        padding: 4px;
        color: #333;
    }
</style>
<div class="container">
    <div class="col-md-12">
        <div class="contentbg pageerror">
            <div><img src="<?php echo Yii::app()->theme->baseUrl ?>/assets/images/unhappy.jpg"/></div>
            <div class="sorry">Payment process Canceled.</div>
<!--            <div class="pageerrormsg">ou can select a different billing option bellow. </div>-->
            
            <div style="padding:7px 0px;">
                    
                    <div class="btn-group" role="group" aria-label="...">
                        <!--<button type="button" class="btn btn-primary">My Account</button>-->
                        <a type="button" href="<?= $this->createUrl('//category/all')?>" class="btn btn-primary">Continue Shopping</a>
                        <!--<button type="button" class="btn btn-primary">Pay Now</button>-->
</div>
                </div>
            
        </div>
    </div>
</div>
