<?php
include_once ('models/CI_model_TBS.php');

class sites {
    //put your code here
    private $_url;
    private $_title;
    private $_short_desc;
    private $_specialty_id;
    private $_site_id;
    private $_db_obj;
    
    public function __construct($url, $title, $short_desc, $specialty_id, $site_id)
    {
        $this->_url = mysql_real_escape_string($url);
        $this->_title = mysql_real_escape_string($title);
        $this->_short_desc = mysql_real_escape_string($short_desc);
        $this->_specialty_id = mysql_real_escape_string($specialty_id);
        $this->_site_id = mysql_real_escape_string($site_id);
        $this->_db_obj = new CI_model_TBS();
    }
    
    public function add_site()
    {
        $url = $this->_url;
        $title = $this->_title;
        $short_desc = $this->_short_desc;
        $specialty_id = $this->_specialty_id;
        $db_obj = $this->_db_obj;
        
        $componentUrl = parse_url($url);
        (($compurl['path']=='') ? ($url=$url."/"): null);
        
        $table = "sites"; $attributes = "site_id"; $otherReq = "url='$url'";
        $result = $db_obj->dbSelect($table, $attributes, $otherReq);
        
        if($result == null)
        {
            $table = "sites"; $attributes = "url, title, short_desc, specialty_id"; $content = "'$url', '$title', '$short_desc', '$specialty_id'";
            $db_obj->dbInsert($table, $attributes, $content);
        }
    }
    
    private function delete_site($site_id)
    {
        
    }
    
    private function edit_site($site_id)
    {
        
    }
    
    public function list_all_sites()
    {
        $db_obj = $this->_db_obj;
        
        $table = "sites, specialty"; $attributes = "*"; $otherReq = 'sites.specialty_id = specialty.specialty_id';
        $site_results =  $db_obj->TBS_select($table, $attributes, $otherReq);
        return $site_results;
    }
    
    
    
}

?>
