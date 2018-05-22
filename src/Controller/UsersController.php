<?php
//Let’s also create our UsersController. The following content corresponds to parts of a basic baked UsersController
//class using the code generation utilities bundled with CakePHP:
// src/Controller/UsersController.php

namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        // Allow some views without authorisation
        $this->Auth->allow(['login','register','forgotPassword']);
    }
 
    // when a logged in user requests a resource, this function grants/denies access
    public function isAuthorized($user) {
           // 'user' is allowed only specific actions for this controller
        if (isset($user['role']) && $user['role'] === 'user') {
            $allowedActions = ['index','logout'];
            if(in_array($this->request->action, $allowedActions)) {
                return true;
            }
        }
        // not a 'user' so pass back to parent to do 'admin' authorization
        return parent::isAuthorized($user);
    } // end isAuthorized

    // set pagination config here - (for the pagination controller)
    public $paginate = array(
        'conditions' => array('id !=' => '4'),
        'limit' => 3,
        'order' => array('id' => 'desc')
    );

    // This is the entry point to display all users
    public function index()
    {
        // paginate() executes the query and produces a paginated dataset
        $users = $this->paginate($this->Users); 
        $this->set('users',$users);
    }

    // This is the entry point to display one user
    public function view($id)
    {
        $user=$this->Users->get($id);
        $this->set(compact('user'));
    }

    // This is the entry point for a user to login
    public function login()
    {
        // arriving here for the first time - the logon.ctp form is automatically displayed
        // however if we arrive here via the submit action on the form then perform authentication
        if ($this->request->is('post')) {
            $user=$this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                //$this->Flash->success('You are now logged in.');
                // The auth component is configured in AppController where to go next ...
                return $this->redirect($this->Auth->redirectUrl());
            }
            // if we reached here then the name/email/password did not match
            $this->Flash->set(__('*Username or password is invalid*') , ['params' => ['class'=>'text-danger']]);
            // auth component will reroute back to login from here (if not configured otherwise)
        }
    }    

    // This actions logs out the currently logged in user
    public function logout()
    {   // This will only be available if user logged in
        // $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());      // by default redirects login
    }

    // This actions sends an email with a new password to a known users email address
    public function forgotPassword()
    {   // This will only be available from the login screen
        $this->Flash->set(__('*forgot-password is not implemented yet') , ['params' => ['class'=>'text-danger']]);
        $this->redirect('/users/login'); // automatically disables auto-render (ie does not look for forgotPassword.ctp)
    }

    // This is the entry point to register a new user
    public function register()
    {
        
        $user=$this->Users->newEntity();           // create a new ORM entity  
        if ($this->request->is('post')) {          // check if this is a form submit

            // copy the name,password and email from the form to the $user entity
            $user=$this->Users->patchEntity($user,$this->request->getData());
            $user->role = "user";                  // make it 'user' role by default

            // save the entity in the database
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));             
                return $this->redirect(['action'=>'login']);    // redirect to login
            }
            $this->Flash->error(__('Unable to add the user.')); // not saved so message
        }
        // its not a form submit so just display the blank registration form
        $this->set('user',$user); // set() passes entity 'user' in variable $user to the 'view' object
        // now automatically render Templates\Users\register.ctp.
    }
} // end class definition

?>