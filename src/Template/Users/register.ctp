<!-- src/Template/Users/register.ctp -->

<div class = 'row'>
    <div class="col-sm-3">
        <p></p>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <?=$this->Form->create($user) ?>
                <fieldset>
                    <legend><?=__('Register New User') ?></legend>
                    <?=$this->Form->control('username',['class'=>'form-control']) ?>
                    <?=$this->Form->control('password',['class'=>'form-control']) ?>
                    <?=$this->Form->control('email',   ['class'=>'form-control']) ?>
                </fieldset>
                <?php echo "<br>"; ?>
                <?=$this->Form->button(__('Register'),['class'=>'btn btn-primary']); ?>
            <?=$this->Form->end() ?>
        </div>
    <div class="col-sm-3">
        <p></p>
    </div>    
</div>