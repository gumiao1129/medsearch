<?php

/**
 * Description of validation
 *
 * @author Gu Miao
 */

class validation {
    private $_name;
    private $_email_address;
    private $_confirm_email;
    private $_gender;
    private $_city;
    private $_province;
    private $_username;
    private $_password;
    private $_confirm_password;
    private $_country;
    private $_zip_code;
    
    public function checkEmpty($value)
    {
        if(empty($value)||($value == "-1"))
        {
           return 'empty'; 
        }
        else
        {
           return 'pass';
        }
    }
    public function checkValid($val)
    {
        if(!preg_match("#^[-A-Za-z0-9' ]*$#",$val))
        {
           return 'unmatch';
        }
        else
        {
           return 'pass';
        }
    }
    
    public function email($email)
    {
        if (!preg_match("/^[A-Z0-9._%-]+@[A-Z0-9][A-Z0-9.-]{0,61}[A-Z0-9]\.[A-Z]{2,6}$/i", $email))
        {
            return 'unmtachEmail';
        }
        else
        {
            return 'pass';
        }
    }
    
    public function username($username, $max_len_username)
    {
        if(strlen($username)>4&&strlen($username)<(int)$max_len_username)
        {
            return 'pass';
          
        }
        else
        {
           return "shortOrLong";
        }
    }
}

?>
