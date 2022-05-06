<?php $this->renderPartial('//mail/header1'); ?>  
<!-- module 2 -->
               <table data-module="module-2" data-thumb="thumbnails/02.png" width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                     <td data-bgcolor="bg-module" bgcolor="#eaeced">
                        <table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                           <tr>
                              <td class="img-flex"><img src="<?php echo Yii::app()->params->SERVER_HOST ?>/upload/logo/<?= $this->adminLoginBannerName;?>" style="vertical-align:top;" width="600" height="306" alt="" /></td>
                           </tr>
                           <tr>
                              <td data-bgcolor="bg-block" class="holder" style="padding:58px 60px 52px;" bgcolor="#f9f9f9">
                                 <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                       <td data-color="title" data-size="size title" data-min="25" data-max="45" data-link-color="link title color" data-link-style="text-decoration:none; color:#292c34;" class="title" align="center" style="font:35px/38px Arial, Helvetica, sans-serif; color:#292c34; padding:0 0 24px;">
                                          Dear <?= $model->first_name.' '.$model->last_name?>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                          Your are successfully registered with us. But your account is not active. Please click below link to verify your email address and activate your account.
                                       </td>
                                    </tr>

                        <tr>
                          <td style="padding:0 0 20px;">
                            <table style="margin:0 auto;" width="232" cellspacing="0" cellpadding="0" align="center">
                              <tbody><tr>
                                <td data-bgcolor="bg-button" data-size="size button" data-min="10" data-max="20" class="btn" style="font:bold 16px/18px Arial, Helvetica, sans-serif; color:#f9f9f9; text-transform:uppercase; mso-padding-alt:22px 10px; border-radius:3px;" bgcolor="#7bb84f" align="center">
                                  <a target="_blank" style="text-decoration:none; color:#f9f9f9; display:block; padding:22px 10px;" href="<?php echo Yii::app()->params->SITE_URL.Yii::app()->createUrl('//site/emailverification/',array('verification_code'=>$code))?>">Verify</a>
                                </td>
                              </tr>
                            </tbody></table>
                          </td>
                        </tr>
                                 </table>
                              </td>
                           </tr>
                           <tr><td height="28"></td></tr>
                        </table>
                     </td>
                  </tr>
               </table>

<?php $this->renderPartial('//mail/footer1'); ?>  