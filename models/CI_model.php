<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CI_model
 *
 * @author Gu Miao
 */

class CI_model {
    
    protected $_dbh;
    
    //config data for databse
//    protected $_host       = 'meddgocom.ipagemysql.com';
//    protected $_dbname     = 'medplatform';
//    protected $_dbusername       = 'meddgo_nlrt_2012';
//    protected $_dbpassword = 'Gcx94f23_nlrt';
    
    protected $_host       = 'localhost';
    protected $_dbname     = 'medSearchEngine';
    protected $_dbusername       = 'root';
    protected $_dbpassword = ''; 

    public function __construct() 
    {
      try
      {
          $this->_dbh = new PDO("mysql:host=$this->_host;dbname=$this->_dbname", $this->_dbusername, $this->_dbpassword);
          $this->_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
          $this->_dbh->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
          //$this->_dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      } 
      catch (PDOException $e)
      {
          echo $e->getMessage();
      }
    }
    
    public function dbInsert($table, $attributes, $content)
    {
        try
        {
            echo "INSERT INTO $table ($attributes) VALUES ($content)<br>";
            $statement =  $this->_dbh->prepare("INSERT INTO $table ($attributes) VALUES ($content)");
            $statement->execute();
        }
        catch (PDOException $e)
        {
          echo $e->getMessage();
        }
    }
    
    public function dbInsert_non_duplicate($table, $attributes, $content, $conditional)
    {
        try
        {
            $statement =  $this->_dbh->prepare("INSERT INTO $table ($attributes) VALUES ($content) ON DUPLICATE KEY UPDATE $conditional");
            $statement->execute();
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    
    public function dbSelect($table, $attributes, $otherReq)
    {
        try
        {
            if($otherReq==null)
            {
                $statement =  $this->_dbh->prepare("SELECT $attributes FROM $table");
                $statement->execute();    
            }
            else
            {
                $statement =  $this->_dbh->prepare("SELECT $attributes FROM $table WHERE $otherReq");
                $statement->execute();
            }    
            $row = $statement->fetch();
            return $row;
        }
        catch (PDOException $e)
        {
          echo $e->getMessage();
        }
    }
    
    public function dbUpdate($table, $updateContent)
    {
        try
        {
             $statement =  $this->_dbh->prepare("UPDATE $table SET $updateContent");
             $statement->execute();  
        }
        catch(PDOException $e)
        {
           echo $e->getMessage();
        }
    }
    
    public function dbDelete($table, $deleteContent)
    {
        try
        {
            $statement =  $this->_dbh->prepare("DELETE FROM $table WHERE $deleteContent");
             $statement->execute();  
        }
        catch(PDOException $e)
        {
           echo $e->getMessage();
        }
    }
    
    public function last_insert_id()
    {
        return $this->_dbh->lastInsertId();
    }
    

}

?>
