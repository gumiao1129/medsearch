<?php
include_once('admin/spider.php'); 
class spider_index_all extends spider{
    
    public function __construct() 
    {  
        parent::__construct(null, null, null, null, null, null, null); 
    } 

    public function index_all() 
    {
        $table = "sites"; $attributes = "url, spider_depth, required, disallowed, can_leave_domain"; $otherReq = null;
        $result = $this->_db_obj->TBS_select($table, $attributes, $otherReq);

            foreach($result as $row) {
                    $this->_url = $row[0];
                    $this->_maxlevel = $row[1];
                    $this->_url_inc = $row[2];
                    $this->_url_not_inc = $row[3];
                    $this->_can_leave_domain = $row[4];
                    if ($this->_can_leave_domain=='') {
                            $this->_can_leave_domain = 0;
                    }
                    if ($this->_maxlevel == -1) {
                            $this->_soption = 'full';
                    } else {
                            $this->_soption = 'level';
                    }
                            $this->_reindex = 1;
                            
                            $this->index_site();
                    }
            }			

    
    
}

?>
