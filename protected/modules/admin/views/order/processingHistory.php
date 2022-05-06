<div class="panel panel-info">
    <div class="panel-heading"><strong>Order Processing History</strong></div>
    <div class="panel-body">
        <table style="margin-bottom:0px;" class="table checkout-table gu12">
            <thead>
                <tr>
                    <th>Status</th>
                    <th class="price">Date & Time</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($process) > 0): foreach ($process as $info): ?>
                        <tr>
                            <td><?= $info->status ?></td>
                            <td class="price"><?= date("d-m-Y", strtotime($info->update_time)) ?></td>
                        </tr>
                    <?php endforeach;
                else: ?>

                    <tr>
                        <td colspan="2">No data found</td>
                    </tr>
<?php endif; ?>
            </tbody>
        </table>
    </div>
</div>