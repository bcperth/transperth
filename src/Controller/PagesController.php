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

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Network\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
   
     // Routes gets us here with below line in the routes.php
     //  $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'cakeconfig']);
     // $path parameter below will contain 'cakeconfig'

    // when a logged in user requests a resource, this function grants/denies access
	public function isAuthorized($user) {
		// 'user' is allowed only specific actions for this controller
        // in this case there are no actions to authorise as yet   

		// not a 'user' so pass back to parent to do 'admin' authorization
		return parent::isAuthorized($user);
    } // end isAuthorized
    
    // cakeConfig prints detailed configuration of the framework (accessible to logged-in role 'admin') 
    public function cakeconfig(){
        // we are not passing any variables so method will 
        // create a view class automatically and use the cakeconfig.ctp template.
        // via the auto render on exit callback. 
       
    }
 
    // this assumes we have several passive pages ie the same action is used to
    // display all URLs like /pages/abc (which would expect abc.ctp view template)
    // render('pages/abc') is used to draw the page
    // instead of default rendering of 'display.ctp' which does not exist 
    public function display(...$path)   // ...$path means variable number of arguements (... is T_ELLIPSIS parser token in PHP)
    {
        $count = count($path);          // counts number of arguements in the $path array. count() is a PHP function
        if (!$count) {
            echo "redirecting to base URL";
            return $this->redirect('/');  // if no arguements then route back to the base URL
        }
        // dont allow relative pathnames (I think)
        if (in_array('..', $path, true) || in_array('.', $path, true)) {  
            throw new ForbiddenException();
        }

        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
            //debug($page);
        }

        if (!empty($path[1])) {     // note sure what is a subpage
            $subpage = $path[1];
            //debug($page);
        }

        $this->set(compact('page', 'subpage'));    // pass the $page and $subpage variables to the view
        
        try {
            // controller::render instantiates a view class, hands it its data, and then view object renders the view
            // In this case 
            $urlvar = implode('/', $path);
           debug($urlvar);
            $this->render($urlvar); // implode connects $path elements into a string with supplied separator '/'. 
            //debug(implode('/', $path)); 
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }
}
