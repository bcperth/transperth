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
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

//$this->layout = false;    // dont use the standard layout
?>
<body>

<div class="row">
    <div class="col-sm-12 bg-danger text-white">
        <div>
            <h2>CakePHP &nbsp&nbspVersion  <?= Configure::version() ?>&nbsp&nbsp&nbsp(Red Velvet)</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div id="url-rewriting-warning" class="alert url-rewriting">
            <ul class="list-group">
                <li class="list-group-item">
                    <!-- NOTE: This message comes up if home.ccs is not loaded. -->
                    URL rewriting is not properly configured on your server.<br />
                    1) <a target="_blank" href="https://book.cakephp.org/3.0/en/installation.html#url-rewriting">Help me configure it</a><br />
                    2) <a target="_blank" href="https://book.cakephp.org/3.0/en/development/configuration.html#general-configuration">I don't / can't use URL rewriting</a>
                </li>
            </ul>
        </div>
        <!-- This checks if the security salt has been changed, and if not prints a message-->
        <?php Debugger::checkSecurityKeys(); ?> 
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <h4>Environment</h4>
        <ul class="list-group">
        <?php if (version_compare(PHP_VERSION, '5.6.0', '>=')) : ?>
            <li class="list-group-item allgood">Your version of PHP is 5.6.0 or higher (detected <?= PHP_VERSION ?>).</li>
        <?php else : ?>
            <li class="list-group-item problem">Your version of PHP is too low. You need PHP 5.6.0 or higher to use CakePHP (detected <?= PHP_VERSION ?>).</li>
        <?php endif; ?>

        <?php if (extension_loaded('mbstring')) : ?>
            <li class="list-group-item allgood">Your version of PHP has the mbstring extension loaded.</li>
        <?php else : ?>
            <li class="list-group-item problem">Your version of PHP does NOT have the mbstring extension loaded.</li>;
        <?php endif; ?>

        <?php if (extension_loaded('openssl')) : ?>
            <li class="list-group-item allgood">Your version of PHP has the openssl extension loaded.</li>
        <?php elseif (extension_loaded('mcrypt')) : ?>
            <li class="list-group-item allgood">Your version of PHP has the mcrypt extension loaded.</li>
        <?php else : ?>
            <li class="list-group-item problem">Your version of PHP does NOT have the openssl or mcrypt extension loaded.</li>
        <?php endif; ?>

        <?php if (extension_loaded('intl')) : ?>
            <li class="list-group-item allgood">Your version of PHP has the intl extension loaded.</li>
        <?php else : ?>
            <li class="list-group-item problem">Your version of PHP does NOT have the intl extension loaded.</li>
        <?php endif; ?>
        </ul>
    </div>
    <div class="col-sm-6">
        <h4>Filesystem</h4>
        <ul class="list-group">
        <?php if (is_writable(TMP)) : ?>
            <li class="list-group-item allgood">Your tmp directory is writable.</li>
        <?php else : ?>
            <li class="list-group-item problem">Your tmp directory is NOT writable.</li>
        <?php endif; ?>

        <?php if (is_writable(LOGS)) : ?>
            <li class="list-group-item allgood">Your logs directory is writable.</li>
        <?php else : ?>
            <li class="list-group-item problem">Your logs directory is NOT writable.</li>
        <?php endif; ?>

        <?php $settings = Cache::getConfig('_cake_core_'); ?>
        <?php if (!empty($settings)) : ?>
            <li class="list-group-item allgood">The <em><?= $settings['className'] ?>Engine</em> is being used for core caching. To change the config edit config/app.php</li>
        <?php else : ?>
            <li class="list-group-item problem">Your cache is NOT working. Please check the settings in config/app.php</li>
        <?php endif; ?>
        </ul>
    </div>
    <hr>
</div>

<div class="row">
    <div class="col-sm-6">
        <h4>Database</h4>
        <?php
        try {
            $connection = ConnectionManager::get('default');
            $connected = $connection->connect();
        } catch (Exception $connectionError) {
            $connected = false;
            $errorMsg = $connectionError->getMessage();
            if (method_exists($connectionError, 'getAttributes')) :
                $attributes = $connectionError->getAttributes();
                if (isset($errorMsg['message'])) :
                    $errorMsg .= '<br />' . $attributes['message'];
                endif;
            endif;
        }
        ?>
        <ul class="list-group">
        <?php if ($connected) : ?>
            <li class="list-group-item allgood">CakePHP is able to connect to the database.</li>
        <?php else : ?>
            <li class="list-group-item problem">CakePHP is NOT able to connect to the database.<br /><?= $errorMsg ?></li>
        <?php endif; ?>
        </ul>
    </div>
    <div class="col-sm-6">
        <h4>DebugKit</h4>
        <ul class="list-group">
        <?php if (Plugin::loaded('DebugKit')) : ?>
            <li class="list-group-item allgood">DebugKit is loaded.</li>
        <?php else : ?>
            <li class="list-group-item problem">DebugKit is NOT loaded. You need to either install pdo_sqlite, or define the "debug_kit" connection name.</li>
        <?php endif; ?>
        </ul>
    </div>
    <hr>
</div>

</body>
</html>
