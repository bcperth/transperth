<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        // components are classes derived from the basic component class
        // $components array has a list of loaded componnts
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Paginator');
  
        // Load the authorisation component and configure it
        $this->loadComponent('Auth', [
            'authorize' => 'Controller',
            'flash' => ['element' => 'failure'],    // use 'failure' element instead of default ('error')  
            'authenticate' => [
                'Form' => [
                    'fields' => [    // authenticate on these fields (These are default anyhow)
                        'username' => 'username',    // username and password on left are the default authenticate field names
                        'password' => 'password'     // the user entity field names are also username and password
                        // but they can be assigned to other user fields - ie  'username' => 'email' will authenticate on email address
                    ]
                ]
            ],
            'loginAction' => [                  // The URL to the controller action where authentication will occur
                'controller' => 'Users',        // (these are default anyhow)
                'action' => 'login'
            ],
            'loginRedirect' => '/stops/list',  // the URL to go to after a successful login
             // If unauthorized, return them to page they were just on
             // However, a non-logged in attempt to reach an 'admin' authorised page, now redirects to
             // the login. Then a login attempt with 'user' role sticks in a loop!
             // Need to solve this - perhaps add a reachable page to the menu - eg Home Page,  
            'unauthorizedRedirect' => $this->referer()
        ]);

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    } // end initialize()

    /* This is called after the controller action code but BEFORE any view is rendered */
    function beforeRender(Event $event)
    {
        // make the loggedin user data avaiable to all views
        $loggedUser = $this->Auth->user();
        if ($loggedUser != null)
              $this->set('loggedUser',$loggedUser);
        else  $this->set('loggedUser','notLoggedIn'); 
        $debugState = Configure::read('debug');
        $this->set('debugState',$debugState);   
    }
    
    // This is the authorize function used by the "auth" component
    // this is called by auth when a logged-in user requests a resource.
    // Controller specific versions of isAuthorized() overide this method
    // but call parent::isAuthorized()
    // This way admin users can be authorized once here - and access to controller specific
    // actions is delegated to each controller (BC 2 May, 2018)
    public function isAuthorized($user) {

        // Admin allowed anywhere
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
        // if we reach here then we deny authorisation
        // either role is not 'admin' or 'user', or derived controller has not implemented isAuthorized()  
        return false;
    } // end isAuthorized

} // class AppController
