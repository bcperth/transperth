<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
// this layout wraps all views.
// It loads some css files for style
// Its also make a top menu 
// We want this menu to be configurable - depending on the view
$cakeDescription = 'Transperth: ';
?>
<!DOCTYPE html>
<html>
<head>
    <!-- sppecify charset for browser (default of ->charset() is utf-8) -->
    <?= $this->Html->charset() ?> <!-- outputs <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
        <?= $this->fetch('title') ?>    <!-- where is title block defined? -->
    </title>
    <?= $this->Html->meta('icon') ?>    <!-- not sure what this does?????????? -->

    <!-- next 3 are needed for boostrap - replacing base.css and cake.css -->
    <!-- 
        Note on Html->script() and Html->css() - also same for Html->meta()
        These generate and output the specified <script> tags for js files and <link> tages for css
        However, if block is set to true as in $this->Html->css('bootstrap.css',['block' => true])
        then the output instead goes to a block named 'css' or 'script', which can then be printed out
        anywhere using  $this->fetch('css') or $this->fetch('script').
    -->
    <?= $this->Html->css('home.css') ?>
    <?= $this->Html->css('bootstrap.css') ?>     <!-- boostrap classes -->
    <?= $this->Html->css('brendan.css') ?>       <!-- some local over-rides of home.css -->
    <?= $this->Html->script('jquery.js') ?>      <!-- jquery as used by bootstrap -->
    <?= $this->Html->script('popper.js') ?>      <!-- popper is needed by bootstrap -->
    <?= $this->Html->script('bootstrap.js') ?>   <!-- boostrap javascript -->

    <!-- This area is for any scripts that the view may need -->
    <?= $this->fetch('scriptBlock') ?>

    <!-- < ?= $this->Html->css('base.css') ?> -->
    <!-- < ?= $this->Html->css('cake.css') ?> -->

    <!-- Note: to add a boostrap theme, put the XthemeX.css here-->
    <!-- The XthemeX.css will override some or all of the bootsrap classes-->

   <!-- These 2 are not ACTIVE since the ['block' => true] is not set in the HTML helpers above.-->
   <?= $this->fetch('meta') ?> 
   <?= $this->fetch('css') ?>
   <?= $this->fetch('script') ?>

   <!-- Load the Roboto font-->
   <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">

</head>

<body>
    <!-- We have replaced the top nav bar with a boostrap version  -->
     <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <?= $this->Html->image('favicon.ico', ['alt' => 'CakePHP']) ?> 
        <a class="navbar-brand" href="#">Transperth</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" style="">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                  <!-- each view needs to fill this in according to available menu options -->
                  <?php 
                        if (isset($loggedUser['role']))
                            $cell=$this->cell('Menu',[$loggedUser['role']]);
                        else  
                            $cell=$this->cell('Menu',['none']);   
                        echo $cell; 
                  ?>
                  <li class="nav-item">
                      <?php if(is_array($loggedUser)) echo "User: ".$loggedUser['username'];
                        else echo 'Logged Out'; ?> 
                  </li>
            </ul>    
        </div>
    </nav>

    <?= $this->Flash->render() ?>  <!-- Display error messages if any -->

    <!-- make a container for the main content -->
    <main role ="main" class="container-fluid" style="border-style: solid;" >
        <!-- This area is for the content of the page (xxx.ctp) being displayed -->
        <?= $this->fetch('content') ?>
    </main>
    <!-- make a container for the footer content if needed-->
    <footer>

    </footer>
</body>
</html>
