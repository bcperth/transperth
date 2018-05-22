<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Usercount cell
 */
class MenuCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    // this cell makes the menu for every view.
    // if role is 'none' then only allowed (unsecrured) menu items are present
    // if role is 'user' then user links are present
    // if role is 'admin' the all links are present
    public function display($role)
    {
        $this->set('role',$role);    // send the role to the cell template	
    }
}
