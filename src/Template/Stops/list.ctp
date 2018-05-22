<!-- File: src/Template/Stops/listStops.ctp -->
<!-- <div class="users index large-9 medium-8 columns content"> -->

<div class="table table-striped table-hover">
    <h1>Stops Table</h1>
    <table>
        <!-- Print headers as links to sort functions -->
	    <tr>
            <th scope="col"><?= $this->Paginator->sort('stop_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('stop_name') ?></th>               
            <th scope="col"><?= $this->Paginator->sort('stop_lat') ?></th>
            <th scope="col"><?= $this->Paginator->sort('stop_lon') ?></th>
        </tr>
        <!-- Iterate through our $stops query object, printing out stops info -->
        <?php foreach ($stops as $stop): ?>
            <tr>
                <td> <?=$stop->stop_id ?> </td>
                <td> <?=$stop->stop_name ?> </td>
                <td> <?=$stop->stop_lat ?> </td>
                <td> <?=$stop->stop_lon ?> </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Construct the navigation controls using paginator helper-->
    <div class="paginator">
        <p></p>
        <!-- style="width:800px" -->
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers(['last' => 2,'first' => 2]) ?> <!-- always shows first 2 and last 2 -->
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>