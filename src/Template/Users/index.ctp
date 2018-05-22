<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>

<!-- <div class="users index large-9 medium-8 columns content"> -->
<div class="table table-striped table-hover">
    <h3><?= __('List of Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                <th scope="col"><?= $this->Paginator->sort('password') ?></th>
                <th scope="col"><?= $this->Paginator->sort('role') ?></th>               
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
               <!-- <th scope="col">< ?= $this->Paginator->sort('created') ?></th> -->
               <!-- <th scope="col">< ?= $this->Paginator->sort('modified') ?></th> -->
                <!-- __() returns translated message (eg French) if language is French -->
                 <!-- So can be left out for English only -->
               <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->username) ?></td>
                <td><?= h($user->password) ?></td>
                <td><?= h($user->role) ?></td>
                <td><?= h($user->email) ?></td>

                <!-- <td>< ?= h($user->created) ?></td>  -->
                <!-- <td>< ?= h($user->modified) ?></td> -->
                <td class="actions">
                    <?= $this->Html->link(__('Details'), ['action' => 'view', $user->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <div  class="paginator">
        <p></p>
        <ul class="pagination">
            <?= $this->Paginator->first('<< First') ?> <!-- not shown if on page 1 -->
            <?= $this->Paginator->prev('<') ?>         <!-- shown disabled if on page 1-->
            <?= $this->Paginator->numbers() ?>         <!-- current page is set active -->
            <?= $this->Paginator->next('>') ?>         <!-- shown disabled if on last page -->
            <?= $this->Paginator->last('Last >>') ?>   <!-- not shown if on last page  -->
        </ul>
    </div>
    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
</div>
