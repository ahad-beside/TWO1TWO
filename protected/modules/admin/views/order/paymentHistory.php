<div class="panel panel-info">
    <div class="panel-heading"><strong>Order Payment Information</strong></div>
        <div class="panel-body">
            <table style="margin-bottom:0px;" class="table checkout-table gu12">
                <thead>
                    <tr>
                        <th>Method</th>
                        <th style="text-align: right;" class="price">Amount</th>
                        <th class="price">Payment Time</th>
                        <th class="price">Additional Information</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($payment)>0): foreach($payment as $info):?>
                             <tr>
                                <td><?= $info->gateway?></td>
                                <td style="text-align: right;" class="price"><?= number_format($info->amount,2)?></td>
                                <td class="price"><?= date("d-m-Y H:i:s",strtotime($info->update_time))?></td>
                                <td class="price">
                                    <?php
                                    $additional = CJSON::decode($info->others);
                                    if(is_array($additional)){
                                    foreach($additional as $k=>$addinfo):
                                        if($k=='Reference Number')
                                            echo '<strong>'.$k.':</strong> '.$addinfo.'<br>';
                                        if($k=='TRANSACTION_ID')
                                            echo '<strong>Transaction Id:</strong> '.$addinfo.'<br>';
                                        if($k=='RESPONSE_DESC')
                                            echo '<strong>OCBC Response:</strong> '.$addinfo.'<br>';
                                        if($k=='txn_id')
                                            echo '<strong>Transaction Id:</strong> '.$addinfo.'<br>';
                                    endforeach;
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php  endforeach; else:?>
                            <tr>
                                <td colspan="4">No data found</td>
                            </tr>
                        <?php endif;?>
                </tbody>
            </table>
        </div>
</div>