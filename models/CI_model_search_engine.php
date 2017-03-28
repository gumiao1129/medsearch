<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CI_model_search_engine
 *
 * @author Gu Miao
 */
include_once('models/CI_model.php'); 
class CI_model_search_engine extends CI_model{
     public function search_engine($search_keys, $search_table1, $search_table_left_join, $search_table_left_join_id_field, $search_field_array, $id_field, $session_id, $search_table_session_id_field)
     {
         
         //trim whitespace from the stored variable
        $trimmed = trim($search_keys);
        //separate key-phrases into keywords
        $trimmed_array = explode(" ",$trimmed);
        
        $search_fields = implode(",",$search_field_array);
               
        // Build SQL Query for each keyword entered
        foreach ($trimmed_array as $trimm){
            // EDIT HERE and specify your table and field names for the SQL query
            // MySQL "MATCH" is used for full-text searching. Please visit mysql for details.
            /*
         $query = "SELECT * , MATCH ($search_fields) AGAINST ('".$trimm."') AS score FROM $search_table WHERE MATCH ($search_fields) AGAINST ('+".$trimm."') ORDER BY score DESC";
            echo $query;
            $statement =  $this->_dbh->prepare($query);
            $statement->execute(); 

            $row_num_links_main = $statement->fetchAll();
             * //old search query
             * echo $query = "SELECT $search_table1.*, $search_table_left_join.*
                            FROM 
                            $search_table1
                            LEFT JOIN
                            $search_table_left_join
                            ON
                            $search_table1.$id_field = $search_table_left_join.$search_table_left_join_id_field
                            AND
                            $search_table_left_join.$search_table_session_id_field=$session_id
                            WHERE (($tryit) AND ($search_table_left_join.status=1)) GROUP By $search_table1.$id_field ORDER BY $search_table1.$id_field DESC";

             * 
            */
            //If MATCH query doesn't return any results due to how it works do a search using LIKE
           // if($row_num_links_main < 1){
               $tryit = implode(" LIKE '%$trimm%' OR ",$search_field_array);
                $tryit = $tryit." LIKE '%$trimm%'";
                 $query = "SELECT $search_table1.*, $search_table_left_join.*
                            FROM 
                            $search_table1
                            LEFT JOIN
                            $search_table_left_join
                            ON
                            $search_table1.$id_field = $search_table_left_join.$search_table_left_join_id_field
                            AND
                            $search_table_left_join.$search_table_session_id_field=$session_id
                            WHERE (($tryit)) GROUP By $search_table1.$id_field ORDER BY $search_table1.$id_field DESC";
            $statement =  $this->_dbh->prepare($query);
            $statement->execute(); 
            $row = $statement->fetchAll();
            return $row;
        } 
     }
     
     public function search_engine_without_itself($search_keys, $search_table1, $search_table_left_join, $search_table_left_join_id_field, $search_field_array, $id_field, $session_id, $search_table_session_id_field)
     {
         
         //trim whitespace from the stored variable
        $trimmed = trim($search_keys);
        //separate key-phrases into keywords
        $trimmed_array = explode(" ",$trimmed);
        
        $search_fields = implode(",",$search_field_array);
               
        // Build SQL Query for each keyword entered
        foreach ($trimmed_array as $trimm){
            // EDIT HERE and specify your table and field names for the SQL query
            // MySQL "MATCH" is used for full-text searching. Please visit mysql for details.
            /*
         $query = "SELECT * , MATCH ($search_fields) AGAINST ('".$trimm."') AS score FROM $search_table WHERE MATCH ($search_fields) AGAINST ('+".$trimm."') ORDER BY score DESC";
            echo $query;
            $statement =  $this->_dbh->prepare($query);
            $statement->execute(); 

            $row_num_links_main = $statement->fetchAll();
            */
            //If MATCH query doesn't return any results due to how it works do a search using LIKE
           // if($row_num_links_main < 1){
               $tryit = implode(" LIKE '%$trimm%' OR ",$search_field_array);
                $tryit = $tryit." LIKE '%$trimm%'";
                $query = "SELECT $search_table1.*, $search_table_left_join.*
                            FROM 
                            $search_table1
                            LEFT JOIN
                            $search_table_left_join
                            ON
                            ($search_table_left_join.$search_table_session_id_field=$session_id
                            OR
                            $search_table_left_join.$search_table_left_join_id_field=$session_id)
                            AND
                            ($search_table1.$id_field = $search_table_left_join.$search_table_session_id_field
                            OR
                            $search_table1.$id_field = $search_table_left_join.$search_table_left_join_id_field)                          
                            WHERE ($tryit)
                            AND
                            $search_table1.$id_field != $session_id
                            AND 
                            ($search_table_left_join.status=1)
                            GROUP By $search_table1.$id_field ORDER BY $search_table1.$id_field DESC";
            $statement =  $this->_dbh->prepare($query);
            $statement->execute(); 
            $row = $statement->fetchAll();
            return $row;
        } 
     }
     
     public function search_widget_same_cate($search_table1, $search_table_left_join, $search_table_left_join_id_field, $id_field, $session_id, $search_table_session_id_field)
     {
              $query = "SELECT $search_table1.*, $search_table_left_join.*
                            FROM 
                            $search_table1
                            LEFT JOIN
                            $search_table_left_join
                            ON
                            ($search_table_left_join.$search_table_session_id_field=$session_id 
                            OR       
                            $search_table_left_join.$search_table_left_join_id_field=$session_id)
                            AND
                            ($search_table1.$id_field = $search_table_left_join.$search_table_session_id_field 
                            OR
                            $search_table1.$id_field = $search_table_left_join.$search_table_left_join_id_field)
                            WHERE
                            ($search_table_left_join.$search_table_session_id_field=$session_id
                            OR
                            $search_table_left_join.$search_table_left_join_id_field=$session_id)
                            AND
                            $search_table1.$id_field != $session_id
                            AND
                            $search_table_left_join.status = 0    
                            GROUP By $search_table1.$id_field ORDER BY $search_table1.$id_field DESC LIMIT 3";
            $statement =  $this->_dbh->prepare($query);
            $statement->execute(); 
            $row = $statement->fetchAll();
            return $row;
        } 
     
     public function search_widget_diff_cate($search_table1, $search_table_left_join, $search_table_left_join_id_field, $id_field, $session_id, $search_table_session_id_field)
     {
                  $query = "SELECT $search_table1.*, $search_table_left_join.*
                            FROM 
                            $search_table1
                            LEFT JOIN
                            $search_table_left_join
                            ON
                            $search_table_left_join.$search_table_session_id_field=$session_id        
                            AND
                            $search_table1.$id_field = $search_table_left_join.$search_table_left_join_id_field                          
                            WHERE
                            $search_table_left_join.$search_table_session_id_field=$session_id
                            AND
                            $search_table_left_join.status = 0   
                            GROUP By $search_table1.$id_field ORDER BY $search_table1.$id_field DESC LIMIT 3";
            $statement =  $this->_dbh->prepare($query);
            $statement->execute(); 
            $row = $statement->fetchAll();
            return $row;
        } 

     
        
     public function search_edited_same_cate($search_table1, $search_table_left_join, $search_table_left_join_id_field, $id_field, $session_id, $search_table_session_id_field)
     {
               $query = "SELECT $search_table1.*, $search_table_left_join.*
                            FROM 
                            $search_table1
                            LEFT JOIN
                            $search_table_left_join
                            ON
                            ($search_table_left_join.$search_table_session_id_field=$session_id 
                            OR       
                            $search_table_left_join.$search_table_left_join_id_field=$session_id)
                            AND
                            ($search_table1.$id_field = $search_table_left_join.$search_table_session_id_field 
                            OR
                            $search_table1.$id_field = $search_table_left_join.$search_table_left_join_id_field)
                            WHERE
                            ($search_table_left_join.$search_table_session_id_field=$session_id
                            OR
                            $search_table_left_join.$search_table_left_join_id_field=$session_id)
                            AND
                            $search_table1.$id_field != $session_id
                            AND
                            $search_table_left_join.status = 1    
                            GROUP By $search_table1.$id_field ORDER BY $search_table1.$id_field DESC";
            $statement =  $this->_dbh->prepare($query);
            $statement->execute(); 
            $row = $statement->fetchAll();
            return $row;
     } 
     
     public function search_edited_diff_cate($search_table1, $search_table_left_join, $search_table_left_join_id_field, $id_field, $session_id, $search_table_session_id_field)
     {
                  $query = "SELECT $search_table1.*, $search_table_left_join.*
                            FROM 
                            $search_table1
                            LEFT JOIN
                            $search_table_left_join
                            ON
                            $search_table_left_join.$search_table_session_id_field=$session_id        
                            AND
                            $search_table1.$id_field = $search_table_left_join.$search_table_left_join_id_field                          
                            WHERE
                            $search_table_left_join.$search_table_session_id_field=$session_id
                            AND
                            $search_table_left_join.status = 1   
                            GROUP By $search_table1.$id_field ORDER BY $search_table1.$id_field DESC";
            $statement =  $this->_dbh->prepare($query);
            $statement->execute(); 
            $row = $statement->fetchAll();
            return $row;
     } 


     public function search_same_cate($search_table1, $search_table_left_join, $search_table_left_join_id_field, $id_field, $session_id, $search_table_session_id_field, $other)
     {
               $query = "SELECT $search_table1.*, $search_table_left_join.*
                            FROM 
                            $search_table1
                            LEFT JOIN
                            $search_table_left_join
                            ON
                            ($search_table_left_join.$search_table_session_id_field=$session_id 
                            OR       
                            $search_table_left_join.$search_table_left_join_id_field=$session_id)
                            AND
                            ($search_table1.$id_field = $search_table_left_join.$search_table_session_id_field 
                            OR
                            $search_table1.$id_field = $search_table_left_join.$search_table_left_join_id_field)
                            WHERE
                            ($search_table_left_join.$search_table_session_id_field=$session_id
                            OR
                            $search_table_left_join.$search_table_left_join_id_field=$session_id)
                            AND
                            $search_table1.$id_field != $session_id
                            $other
                            GROUP By $search_table1.$id_field ORDER BY $search_table1.$id_field DESC";
            $statement =  $this->_dbh->prepare($query);
            $statement->execute(); 
            $row = $statement->fetchAll();
            return $row;
        } 
     
     public function search_diff_cate($search_table1, $search_table_left_join, $search_table_left_join_id_field, $id_field, $session_id, $search_table_session_id_field, $other)
     {
            $query = "SELECT $search_table1.*, $search_table_left_join.*
                            FROM 
                            $search_table1
                            LEFT JOIN
                            $search_table_left_join
                            ON
                            $search_table_left_join.$search_table_session_id_field=$session_id        
                            AND
                            $search_table1.$id_field = $search_table_left_join.$search_table_left_join_id_field                          
                            WHERE
                            $search_table_left_join.$search_table_session_id_field=$session_id
                            $other
                            GROUP By $search_table1.$id_field ORDER BY physician_patient_relationships.status DESC";

            $statement =  $this->_dbh->prepare($query);
            $statement->execute(); 
            $row = $statement->fetchAll();
            return $row;
        } 

      
     public function search_recommendation_list($search_table1, $search_table2, $search_table3, $st_category_id, $search_table_left_join_id_field, $id_field, $session_id, $search_table_session_id_field, $other)
     {
             echo $query = "SELECT $search_table1.*, $search_table2.*
                            FROM 
                            $search_table1
                            JOIN
                            $search_table2
                            LEFT JOIN
                            $search_table3
                            ON
                            $search_table2.$search_table_session_id_field=$session_id        
                            AND
                            $search_table1.$id_field = $search_table2.$search_table_left_join_id_field  
                            AND
                            !($search_table3.physician_id = $search_table2.physician_id_one
                            AND
                            $search_table3.patient_id = $search_table2.patient_id_one
                            AND
                            $search_table3.st_category_id = $st_category_id
                            )
                            WHERE
                            $search_table2.$search_table_session_id_field=$session_id
                            AND
                            $search_table1.$id_field = $search_table2.$search_table_left_join_id_field 
                            AND
                            !($search_table3.physician_id = $search_table2.physician_id_one
                            AND
                            $search_table3.patient_id = $search_table2.patient_id_one
                            AND
                            $search_table3.st_category_id = $st_category_id
                            )
                            $other
                            GROUP By $search_table1.$id_field ORDER BY physician_patient_relationships.status DESC";

            $statement =  $this->_dbh->prepare($query);
            $statement->execute(); 
            $row = $statement->fetchAll();
            return $row;
        } 
        
     public function search_messages_from_doctors($to_id, $to_id_cate, $limited, $limit_msg)
     {          
          $query = "SELECT * FROM 
                message_recipient 
            JOIN 
                private_messages 
            JOIN
                physician
            ON 
                (message_recipient.message_id=private_messages.message_id)
            AND
                (private_messages.from_id=physician.physician_id)
            AND
                (private_messages.from_id_cate='physician')
            WHERE 
                message_recipient.to_id = $to_id
            AND
                message_recipient.to_id_cate = '$to_id_cate'
            AND
                private_messages.from_id_cate = 'physician'
            $limit_msg
            GROUP BY 
                private_messages.message_id
            ORDER BY 
                message_recipient.id DESC $limited"; 
 
            $statement =  $this->_dbh->prepare($query);
            $statement->execute(); 
            $row = $statement->fetchAll();
            return $row;
      } 
      
     public function search_messages_from_patients($to_id, $to_id_cate, $limited, $limit_msg)
     {          
            $query = "SELECT * FROM 
                message_recipient 
            JOIN 
                private_messages 
            JOIN
                patient
            ON 
                (message_recipient.message_id=private_messages.message_id)
            AND
                (private_messages.from_id=patient.patient_id)
            AND
                (private_messages.from_id_cate='patient')
            WHERE 
                message_recipient.to_id = $to_id
            AND
                message_recipient.to_id_cate = '$to_id_cate'
             $limit_msg
            GROUP BY 
                private_messages.message_id
            ORDER BY 
                message_recipient.id DESC $limited"; 
   
            $statement =  $this->_dbh->prepare($query);
            $statement->execute(); 
            $row = $statement->fetchAll();
            return $row;
      } 
      
     public function search_messages($to_id, $to_id_cate, $limited, $limit_msg)
     {
         $query = "SELECT 
                        patient.firstname, patient.lastname, patient.thumbnail_pic_name, private_messages.subject, private_messages.message, private_messages.create_date_time, message_recipient.message_id, message_recipient.id, message_recipient.to_id, message_recipient.to_id_cate, message_recipient.opened 
                   FROM 
                        message_recipient JOIN private_messages JOIN patient ON ( (message_recipient.message_id=private_messages.message_id) AND (private_messages.from_id=patient.patient_id) AND (private_messages.from_id_cate='patient') ) 
                   WHERE 
                        message_recipient.to_id = $to_id
                   AND
                        message_recipient.to_id_cate = '$to_id_cate'
                        $limit_msg
                   UNION ALL
                        SELECT physician.firstname, physician.lastname, physician.thumbnail_pic_name, private_messages.subject, private_messages.message, private_messages.create_date_time, message_recipient.message_id, message_recipient.id, message_recipient.to_id, message_recipient.to_id_cate, message_recipient.opened 
                   FROM 
                        message_recipient JOIN private_messages JOIN physician ON ( (message_recipient.message_id=private_messages.message_id) AND (private_messages.from_id=physician.physician_id) AND (private_messages.from_id_cate='physician') ) 
                   WHERE 
                        message_recipient.to_id = $to_id
                   AND
                        message_recipient.to_id_cate = '$to_id_cate'
                        $limit_msg
                  GROUP BY 
                    id 
                  ORDER BY 
                    id DESC $limited";

            $statement =  $this->_dbh->prepare($query);
            $statement->execute(); 
            $row = $statement->fetchAll();
            return $row;
      } 
      
     public function sent_messages($to_id, $to_id_cate, $limited, $limit_msg)
     {
                    $query = "SELECT *
                    FROM
                    ((SELECT message_recipient.message_id, message_recipient.id, firstname, lastname, subject, message, create_date_time, thumbnail_pic_name, opened, replayed  
                    FROM message_recipient JOIN private_messages JOIN patient 
                    ON (message_recipient.message_id=private_messages.message_id)
                    AND                
                    (message_recipient.to_id=patient.patient_id)
                    AND
                    (message_recipient.to_id_cate='patient')
                    WHERE ( private_messages.from_id = $to_id $limit_msg
                    AND 
                    private_messages.from_id_cate = '$to_id_cate') )

                    union ALL

                    (SELECT message_recipient.message_id, message_recipient.id, firstname, lastname, subject, message, create_date_time, thumbnail_pic_name,opened, replayed
                    FROM message_recipient JOIN private_messages JOIN physician 
                    ON (message_recipient.message_id=private_messages.message_id)
                    AND                
                    (message_recipient.to_id=physician.physician_id)
                    AND
                    (message_recipient.to_id_cate='physician')
                    WHERE ( private_messages.from_id = $to_id $limit_msg
                    AND 
                    private_messages.from_id_cate = '$to_id_cate'))
                    ) a 
                    GROUP BY
                    a.message_id
                    ORDER BY
                    a.id
                    DESC $limited"; 

            $statement =  $this->_dbh->prepare($query);
            $statement->execute(); 
            $row = $statement->fetchAll();
            return $row;
      } 

     public function sent_signal_message($message_id)
     {
          $query = "SELECT *
                    FROM
                    ((SELECT message_recipient.message_id, message_recipient.id, firstname, lastname, subject, message, create_date_time, thumbnail_pic_name, to_id, to_id_cate,opened, replayed  
                    FROM message_recipient JOIN private_messages JOIN patient 
                    ON (message_recipient.message_id=private_messages.message_id)
                    AND                
                    (message_recipient.to_id=patient.patient_id)
                    AND
                    (message_recipient.to_id_cate='patient')
                    WHERE ( message_recipient.message_id = $message_id))

                    union ALL

                    (SELECT message_recipient.message_id, message_recipient.id, firstname, lastname, subject, message, create_date_time, thumbnail_pic_name,to_id, to_id_cate,opened, replayed
                    FROM message_recipient JOIN private_messages JOIN physician 
                    ON (message_recipient.message_id=private_messages.message_id)
                    AND                
                    (message_recipient.to_id=physician.physician_id)
                    AND
                    (message_recipient.to_id_cate='physician')
                    WHERE ( message_recipient.message_id  = $message_id))
                    ) a 
                    ORDER BY
                    a.id
                    DESC"; 
            
            $statement =  $this->_dbh->prepare($query);
            $statement->execute(); 
            $row = $statement->fetchAll();
            return $row;
      }
      
     public function search_messages_member($search_table1, $from_field, $from_id)
     {
            $query = "SELECT *
                      FROM 
                      $search_table1
                      WHERE
                      $from_field = $from_id";
            
            $statement =  $this->_dbh->prepare($query);
            $statement->execute(); 
            $row = $statement->fetchAll();
            return $row;
      }
}

?>
