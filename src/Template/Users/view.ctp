<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<h3><?= __('User ID: ').h($user->id) ?></h3>
<table class="table table-striped table-hover">
    <tr>
        <th scope="row"><?= __('Id') ?></th>
        <td><?= $this->Number->format($user->id) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Username') ?></th>
        <td><?= h($user->username) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Password') ?></th>
        <td><?= h($user->password) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Email') ?></th>
        <td><?= h($user->email) ?></td>
    </tr>
    <tr>
    <th scope="row"><?= __('Role') ?></th>
        <td><?= h($user->role) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Created') ?></th>
        <td><?= h($user->created) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Modified') ?></th>
        <td><?= h($user->modified) ?></td>
    </tr>
</table>

