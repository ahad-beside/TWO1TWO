<?php $rand = time().rand(1,999)?>
<tr class="productRow">
    <td>
        <?= $data['productTypeLabel'] ?><br>
        <?php
            echo '<br><strong>Notes:</strong><br>';
            echo '<textarea cols="50" rows="5" name=productNotes[]>' . preg_replace('#<br\s*/?>#i', "\n", $data['notes']) . '</textarea>';
        ?>
        <input type="hidden" class="productType_added" name="productType_added[]" value="<?= $data['productType'] ?>">
    </td>
    
    <td>
        <?php if ($data['product'] == 0 || $data['product'] == 3): ?>
        <?= $data['productSizeLabel'] ?>
            <input type="hidden" class="productSize_added" name="productSize_added[]" value="<?= $data['productSize'] ?>">
            <input type="hidden" class="product_added" name="product_added[]" value="<?= $data['product'] ?>">
        <?php else: ?>
            <?= $data['productSizeLabel'] ?>
            <input type="hidden" class="productSize_added" name="productSize_added[]" value="<?= $data['productSize'] ?>">
            <input type="hidden" class="product_added" name="product_added[]" value="<?= $data['product'] ?>">
        <?php endif; ?>
    </td>
    <td class="productrow_<?= $rand?>">
        <input type="hidden" name="artwork_rand[]" value="<?= $rand?>">
        <?php  
        $getArtworks = CJSON::decode($data['artworks']);
        if (count($getArtworks) > 0): ?>
            <?php
            for($i=0;$i < count($getArtworks); $i++):
                if($getArtworks[$i]['file']!=''):
                ?>
                <span class="artwork-box">
                    <a href="<?= Yii::app()->baseUrl ?>/images/custom/tmp/<?= $getArtworks[$i]['file'] ?>" target="_blank"><?= $getArtworks[$i]['file'] ?></a>
                    <input type="hidden" value="<?= $getArtworks[$i]['file'] ?>" class="artwork_added" name="artwork_added[<?= $rand?>][]">
                    <input type="hidden" value="<?= $getArtworks[$i]['product'] ?>" class="artwork_added" name="artwork_product[<?= $rand?>][]">
                    <input type="hidden" value="<?= $getArtworks[$i]['pro'] ?>" class="artwork_added" name="artwork_pro[<?= $rand?>][]">
                    <button type="button" class="btn btn-xs del-single-artwork" data-file="<?= $getArtworks[$i]['file'] ?>" title="Delete Artwork"><i class="fa fa-times"></i></button>
                </span>
            <?php endif; endfor;
        endif; ?>
                <?php if($data['product'] != 0):?>
        <a href="<?= $this->createUrl('artworkUploadSingle',array('td'=>$rand,'pro'=>$data['product'],'product'=>$data['productType'],'productName'=>$data['productTypeLabel'],'productSize'=>$data['productSizeLabel']))?>" class="btn btn-sm upload-artwork-row" title="Upload Artwork"><i class="fa fa-upload"></i></a>
                <?php endif;?>
    </td>
    <td>
        <input type="text" class="productQty_added" name="productQty_added[]" value="<?= $data['qty'] ?>" size="5" style="text-align: right">
    </td>
    <td align="right">      
        <input type="text" class="productUnitPrice_added" name="productUnitPrice_added[]" value="<?= $data['unitPrice'] ?>" size="4" style="text-align: right">
    </td>
    <td align="right">
        <input type="text" class="productTotalPrice_added" name="productTotalPrice_added[]" value="<?= $data['totalPrice'] ?>" size="6" style="text-align: right">
    </td>
    <td style="text-align: center"><button class="btn btn-xs btn-danger" onclick="rmrow('<?= $data['productTypeLabel'] ?>', $(this));" title="Click to remove"><i class="fa fa-times"></i></button></td>
</tr>