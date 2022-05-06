<table width="100%" align="center" cellpadding="0" cellspacing="0" style="background-color:#CCC; font-family:'Calibri, Arial Black', Gadget, sans-serif; font-size:12px;">
   <tr>
      <td style="padding:20px 0px;">
         <table width="675" align="center" cellpadding="0" cellspacing="0">
            <?php $this->renderPartial('//mail/header1'); ?>                    
            <tr>
               <td style="background-color: #FFF;"> <img src="<?php echo Yii::app()->params->SERVER_HOST ?>/images/verify.png" /> </td>
            </tr>
            <tr>
               <td style="background-color:#FFF; padding:10px;">
                  <strong>Dear <?= $fullName?></strong>,                            
                  <p>Your Payment has been successfully completed!</p>
                  <p>We have received a payment of <?= 'Rs '.$amount?> for "<?= $examTitle;?></p>
                  <p>Your Transection ID: <?= $txnid?> and PayUMoney Transection ID: <?= $payutxnid?></p>
                  <p>Thanks.</p>
               </td>
            </tr>
            <tr>
               <td></td>
            </tr>
            <?php $this->renderPartial('//mail/footer1'); ?>                
         </table>
      </td>
   </tr>
</table>

