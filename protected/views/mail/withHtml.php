<?php $this->renderPartial('//mail/header1'); ?>  
<!-- module 2 -->
               <table data-module="module-2" data-thumb="thumbnails/02.png" width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                     <td data-bgcolor="bg-module" bgcolor="#eaeced">
                        <table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                           <tr>
                              <td data-bgcolor="bg-block" class="holder" style="padding:58px 60px 52px;" bgcolor="#f9f9f9">
                                 <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                       <td data-color="title" data-size="size title" data-min="25" data-max="45" data-link-color="link title color" data-link-style="text-decoration:none; color:#292c34;" class="title" align="center" style="font:35px/38px Arial, Helvetica, sans-serif; color:#292c34; padding:0 0 24px;">
                                          Dear Admin
                                       </td>
                                    </tr>
                                    <tr>
                                       <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                         <p>You have a email form <?= $data['name'];?>.</p>
                                         <p><?= $data['body'];?></p>
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