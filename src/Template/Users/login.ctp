<!-- user views -"login" --> 
<!-- src/Template/Users/login.ctp -->

<div class = 'row'>
    <div class="col-sm-3">
        <p></p>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <?=$this->Form->create() ?>
                <fieldset>
                    <legend><?=__('Enter username and password') ?></legend>
                    <?=$this->Form->control('username',['class'=>'form-control']) ?>
                    <?=$this->Form->control('password',['class'=>'form-control']) ?>
                </fieldset>
            <?php echo "<br>"; ?>
            <?php $form = $this->Form->button(__('Login'),['class'=>'btn btn-primary']);
            //debug($form);
            echo $form;
            ?>
            <?="&nbsp;&nbsp"?>
            <?=$this->Html->link('register','Users/register',['style'=>'color:red; font-size: 12px']); ?>
            <?="&nbsp;&nbsp"?>
            <?=$this->Html->link('forgot-password','Users/forgot-password',['style'=>'color:red;font-size: 12px']); ?>
            <?=$this->Flash->render() ?>
            <?=$this->Form->end() ?>
        </div>
    </div>
    <div class="col-sm-3">
        <p></p>
    </div>    
</div>
