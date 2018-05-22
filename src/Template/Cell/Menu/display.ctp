<!-- src/Template/Cell/Menu/display.ctp  -->
    <?php
          if ($role == 'admin') $level = 2;
          else if ($role == 'user') $level = 1;
          else $level = 0;
    ?>
    <?php if ($level >= 0) { // not logged in
    ?> 
            <li class="nav-item">
            <?=$this->Html->link('register','Users/register', ['class'=>'nav-link']); ?>
            </li>
            <li class="nav-item">
            <?=$this->Html->link('login','Users/login', ['class'=>'nav-link']); ?>
            </li>
    <?php
          }
          if ($level >= 1){ // if logged in as user you get these extra menu items
    ?>      
            <li class="nav-item">
                    <?=$this->Html->link('logout','Users/logout', ['class'=>'nav-link']); ?>
            </li>
            <li class="nav-item">
                    <?=$this->Html->link('list-users','Users/index', ['class'=>'nav-link']); ?>
            </li>
            <li class="nav-item">
                    <?=$this->Html->link('stops-list','Stops/list', ['class'=>'nav-link']); ?>
            </li>
            <li class="nav-item">
                    <?=$this->Html->link('about','Stops/about', ['class'=>'nav-link']); ?>
            </li>
            <li class="nav-item">
                    <?=$this->Html->link('plan-journey','Stops/address', ['class'=>'nav-link']); ?>
            </li>

    <?php }   
          if ($level >=2){  // if logged in as admin you get these extra menu items
    ?>        
            <li class="nav-item">
                    <?=$this->Html->link('cakePHP','Pages/cakeconfig', ['class'=>'nav-link']); ?>
            </li> 
    <?php  } ?>
       
        