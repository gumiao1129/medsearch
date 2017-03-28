<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of config
 *
 * @author Gu, Miao
 */
class config {
    
    private $_loginIn = false;
    private $_user_id;
    
    public function __construct($userId) {
        $this->_user_id = $userId;
    }
    

    public function loginCheck()
    {
        if( isset ($this->_user_id) && $this->_user_id != null)
        {
            $this->_loginIn = true;
        }
        else
        {
            $this->_loginIn = false;
        }  
        return $this->_loginIn;
    }
    
}

?>
