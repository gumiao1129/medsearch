<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CI_model_join
 *
 * @author Gu Miao
 */
include_once('models/CI_model.php'); 
class CI_model_TBS extends CI_model{
    
    public function TBS_select($table, $attributes, $otherReq)
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
                //echo "SELECT $attributes FROM $table WHERE $otherReq";
                $statement =  $this->_dbh->prepare("SELECT $attributes FROM $table WHERE $otherReq");
                $statement->execute();
            }    
            $row = $statement->fetchAll();
            return $row;
        }
        catch (PDOException $e)
        {
          echo $e->getMessage();
        }
    }
    
    public function TBS_Insert($table, $attributes, $content)
    {
        try
        {
            echo "INSERT INTO $table ($attributes) VALUES $content<br>";
            $statement =  $this->_dbh->prepare("INSERT INTO $table ($attributes) VALUES $content");
            $statement->execute();
        }
        catch (PDOException $e)
        {
          echo $e->getMessage();
        }
    }
}

?>
