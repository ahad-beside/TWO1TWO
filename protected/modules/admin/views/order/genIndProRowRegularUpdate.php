<?php $rand = time().rand(1,999)?>
<tr class="productRow">
    <td>
        <?= $data->products->name ?><br>
        <?php if($data->special_instruction!=''){
            echo '<br><strong>Notes:</strong> '.$data->special_instruction;
            echo '<input type="hidden" name=productNotes[] value="'.$data->special_instruction.'">';
        }?>
        <input type="hidden" class="productType_added" name="productType_added[]" value="<?= $data->products_id_fk?>">
    </td>
    
    <td>
            <input type="hidden" class="productSize_added" name="productSize_added[]" value="0">
            <input type="hidden" class="product_added" name="product_added[]" value="0">
    </td>
    <td class="productrow_<?= $rand?>">
        <input type="hidden" value="<?= $rand?>" name="artwork_rand[]">
    </td>
    <td>
        <input type="text" class="productQty_added" name="productQty_added[]" value="<?= $data->qty ?>" size="5" style="text-align: right">
    </td>
    <td align="right">
        <input type="text" class="productUnitPrice_added" name="productUnitPrice_added[]" value="<?= number_format($data->price/$data->qty,2,'.','') ?>" size="4" style="text-align: right">
    </td>
    <td align="right">
        <input type="text" class="productTotalPrice_added" name="productTotalPrice_added[]" value="<?= $data->price ?>" size="6" style="text-align: right">
    </td>
    <td style="text-align: center"><button type="button" class="btn btn-xs btn-danger" onclick="rmrow('<?= $data->products->name ?>', $(this));" title="Click to remove"><i class="fa fa-times"></i></button></td>
</tr>