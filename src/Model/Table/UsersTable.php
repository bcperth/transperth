<?php
// Create our UsersTable class, responsible for ﬁnding, saving and validating any user data:
// src/Model/Table/UsersTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
class UsersTable extends Table
{
    // initialize() is called after the constructor
    public function initialize(array $config)  
    {
        // This adds theh timestamp behavior
        // The default action is to respond to model.beforeSave events (presumably)
        // ie before saving it looks for created and modified fields and fills then with now() as appropriate.
        $this->addBehavior('Timestamp');  
        // Note: cake timezone is UTC by default
        // You can set/change the timezone for the database in \config\app.php (2 places needed)
        // You can set/change the cakePHP timezone for time objects/helpers in \config\bootstrap.php
    }

    // this validation is called when a new 'entity' is created
    // while data is being marshalled (from wherever) into the new entity object
    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('username','A username is required')
            ->notEmpty('password','A password is required')
            ->notEmpty('role','A role is required')
            ->add('role','inList', [
                'rule'=>['inList', ['admin','traveller']],
                'message'=>'Please enter a valid role'
            ]);
    }
}
?>
