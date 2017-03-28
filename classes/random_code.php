<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of random_code
 *
 * @author TechStudent
 */
class random_code {
   private $_characters;
   
   public function __construct($characters)
   {
       $this->_characters = $characters;
   }
   function generateCode() {
      /* list all possible characters, similar looking characters and vowels have been removed */
      $possible = 'BCDFGHJKMNPQRSTVWXYZ23456789bcdfghjkmnpqrstvwxyz';
      $code = '';
      $i = 0;
      while ($i < $this->_characters) {
         $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
         $i++;
      }
      return $code;
   }
}

?>
