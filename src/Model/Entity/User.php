<?php
// Make an Entity class for User in order to handle its own speciﬁc logic.
// src/Model/Entity/User.php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class User extends Entity
{

    // Note: The entity will automatically have an attribute of the same name for each table column.
    
    // Make all fields 'mass assignable' except for primary key field "id".
    protected $_accessible=[
        '*'=> true,
        'id'=> false
    ];

    // this is a custom mutator for the 'password' column of the 'User' entity  
    // it allows the $password (from wherever) to be transformed before persisting in database
    // You can call the mutator at any time, but will be called automatically in these cases:
    // 1) $user->password = 'abs';
    // 2) $user->set('password', 'abc');
    // 3) before user entity is persisted to the database
    // Note: you get above behavior in the general with _setAbcdef() where 'abcdef' is an attribute of 
    protected function _setPassword($password)
    { 
        if (strlen($password) > 0) 
        {
            $hasher = new DefaultPasswordHasher;
            return $hasher->hash($password);
        }
    }
} // end class

?>