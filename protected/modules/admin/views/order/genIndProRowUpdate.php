<?php $rand = time() . rand(1, 999) ?>

<?php
/* get frontend order information for update */
if ($orderInfo->made_by == 'Self') {
    $msgLabel = ($data->msg_style=='Wrap Arround')?'Message: ':'Front Message: ';
    $bckMsg = ($data->back_msg=='')?'':'Back Message: '.$data->back_msg."\n";
    $insideMsg = ($data->inside_msg=='')?'':'Inside Message: '.$data->inside_msg."]n";
    
    $dec = CJSON::decode($data->decoration);
    $decoration='';
    if(count($dec)>0):
        foreach($dec as $k=>$d):
            if($k=='front_font_text')
                $decoration .= (($data->msg_style=='Wrap Arround')?'Font: ':'Front Font: ').$d.', ';
            if($k=='front_color_text')
                $decoration .= (($data->msg_style=='Wrap Arround')?'Font Color: ':'Front Font Color: ').$d."\n";
            if($data->msg_style!='Wrap Arround' && $k=='back_font_text')
                $decoration .= 'Back Font: '.$d.', ';
            if($data->msg_style!='Wrap Arround' && $k=='back_color_text')
                $decoration .= 'Back Font Color: '.$d."\n";
            
            if($k=='fsclipart' && $d!='')
                $decoration .= 'Front Start Clipart: '.$d."\n";
            if($k=='feclipart' && $d!='')
                $decoration .= 'Front End Clipart: '.$d."\n";
            
            if($k=='bsclipart' && $d!='')
                $decoration .= 'Back Start Clipart: '.$d."\n";
            if($k=='beclipart' && $d!='')
                $decoration .= 'Back End Clipart: '.$d."\n";
            
            if($k=='bands'){
                $bands = CJSON::decode($d);
                $cadata='';
                if(is_array($bands)){
                    for($z=0;$z<count($bands['qty']);$z++):
                        if($bands['qty'][$z]>0){
                        $cadata .= $bands['color'][$z].'('.$bands['qty'][$z].'), ';
                        }
                    endfor;
                }else{
                    foreach($bands as $band):
                    	$cq = CJSON::decode($band);
                    	$cadata .= $cq['shortcode'].':'.$cq['colortype'].'-'.$cq['colorname'].'('.$cq['qty'].'), ';
                    endforeach;
                }
                if($cadata!='')
                $decoration .= 'Color & Qty:'."\n".rtrim($cadata,', ')."\n";
            }
        endforeach;
    endif;
    if($decoration!='')
        $decoration = "\n".'Decoration: '."\n".$decoration;
    
    $additional = CJSON::decode($data->additional);
    $additionalInfo ='';
    if(count($additional)>0):
        foreach($additional as $add):
            $additionalInfo .= CustomAddOptions::model()->findByPk($add)->name.', ';
        endforeach;
    endif;
    if($additionalInfo!='')
        $additionalInfo = "\n".'Additional: '."\n".rtrim($additionalInfo,', ');
    
    $selfInfo = 'Message Style:'. $data->msg_style ."\n". $msgLabel . $data->front_msg ."\n". $bckMsg . $insideMsg . $decoration . $additionalInfo;

$data->special_instruction = $selfInfo."\nInstruction: ".$data->special_instruction;
}
/* //get frontend order information for update */
?>

<tr class="productRow">
    <td>
        <?= $data->productTypeId->name ?><br>
        <?php
            echo '<br><strong>Notes:</strong><br>';
            //echo '<div class="sphtml">'.$data->special_instruction.'</div>';
            echo '<textarea cols="50" rows="5" name=productNotes[]>' . preg_replace('/<br(\s+)?\/?>/i', "\n", $data->special_instruction) . '</textarea>';
        ?>
        <input type="hidden" class="productType_added" name="productType_added[]" value="<?= $data->product_type ?>">
    </td>

    <td>
<?php if ($data->productTypeId->product_fk == 1 || $data->productTypeId->product_fk == 2 || $data->productTypeId->product_fk == 4): ?>
            <?= $data->productSizeId->name ?>
            <input type="hidden" class="productSize_added" name="productSize_added[]" value="<?= $data->product_size ?>">
            <input type="hidden" class="product_added" name="product_added[]" value="<?= $data->productTypeId->product_fk ?>">
        <?php else: ?>
            <input type="hidden" class="productSize_added" name="productSize_added[]" value="0">
            <input type="hidden" class="product_added" name="product_added[]" value="<?= $data->productTypeId->product_fk ?>">
<?php endif; ?>
    </td>
    <td class="productrow_<?= $rand ?>">
        <input type="hidden" name="artwork_rand[]" value="<?= $rand ?>">
        <?php
        $getArtworks = OrderArtwork::model()->findAll('order_id_fk=:ofk and order_product=:op', array(':ofk' => $data->order_id, ':op' => $data->id));
        if (count($getArtworks) > 0):
            ?>
            <?php
            foreach ($getArtworks as $artwork):
                if ($artwork->artwork != ''):
                    ?>
                    <span class="artwork-box">
                        <a href="<?= Yii::app()->baseUrl ?>/images/custom/<?= $artwork->artwork ?>" target="_blank"><?= $artwork->artwork ?></a>
                        <input type="hidden" value="<?= $artwork->artwork ?>" class="artwork_added" name="artwork_added[<?= $rand ?>][]">
                        <input type="hidden" value="<?= $data->product_type ?>" class="artwork_added" name="artwork_product[<?= $rand ?>][]">
                        <input type="hidden" value="<?= $data->productTypeId->product_fk ?>" class="artwork_added" name="artwork_pro[<?= $rand ?>][]">
                        <button type="button" class="btn btn-xs del-single-artwork" data-file="<?= $artwork->artwork ?>" title="Delete Artwork"><i class="fa fa-times"></i></button>
                    </span>
        <?php endif;
    endforeach;
endif;
?>

        <a href="<?= $this->createUrl('artworkUploadSingle', array('td' => $rand, 'pro' => $data->productTypeId->product_fk, 'product' => $data->product_type, 'productName' => $data->productTypeId->name, 'productSize' => $data->productSizeId->name)) ?>" class="btn btn-sm upload-artwork-row" title="Upload Artwork"><i class="fa fa-upload"></i></a>

    </td>
    <td>
        <input type="text" class="productQty_added" name="productQty_added[]" value="<?= $data->qty ?>" size="5" style="text-align: right">
    </td>
    <td align="right">
        <input type="text" class="productUnitPrice_added" name="productUnitPrice_added[]" value="<?= number_format($data->price / $data->qty, 2, '.', '') ?>" size="4" style="text-align: right">
    </td>
    <td align="right">
        <input type="text" class="productTotalPrice_added" name="productTotalPrice_added[]" value="<?= $data->price ?>" size="6" style="text-align: right">
    </td>
    <td style="text-align: center"><button type="button" class="btn btn-xs btn-danger" onclick="rmrow('<?= $data->productTypeId->name ?>', $(this));" title="Click to remove"><i class="fa fa-times"></i></button></td>
</tr>