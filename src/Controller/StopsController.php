<?php
// Controller for the 'stops' table 
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;

class StopsController extends AppController
{

    // set pagination config here (for the pagination component)
    public $paginate = array(
        'limit' => 5,                        // no of items per page
        'order' => array('stop_id' => 'desc') // order ascending on stop_id
    );

	// when a logged in user requests a resource, this function grants/denies access
	public function isAuthorized($user) {
		// 'user' is allowed only specific actions for this controller
		if (isset($user['role']) && $user['role'] === 'user') {
			$allowedActions = ['list','about','address'];
			if(in_array($this->request->action, $allowedActions)) {
				return true;
			}
		}
			// not a 'user' so pass back to parent to do 'admin' authorization
		return parent::isAuthorized($user);
	} // end isAuthorized

	// print information about the application
	public function about()
	{
		$this->Flash->failure(__('*About is not implemented yet'));
		$this->redirect($this->referer()); // redirect to previous URL without rendering about.ctp
	}

	// Start by getting the lat lon coordinates of depart and destination addresses
	public function address()
	{
         // for now just display the address entry form (address.ctp)
	}

    // create a method to read list and paginate some stops from the stops table
	public function list() 
	{
		    //$thatVar = $thisVar; // force an error to check debug log
			$query = $this->Stops->find()          // make a query object for paginate() to execute
				   ->where(['stop_id >=' => 10000])
				   ->where(['stop_id <=' => 10300]);
			$stops=$this->paginate($query);        // execute the query creating a paginated $stops array

			// This combination of set(compact()) is ubiquitous in cakePHP
			// when sending data sets to views. compact() -a php function- works iteratively
			// "stops" is the name of the variable, and $stops is an array of variable names 
			$result = compact("stops",$stops); // makes an array called 'stops' which contains the stops array 
			$this->set($result);   // send $stops to the index view ( or view.ctp) 
    }
}
?>