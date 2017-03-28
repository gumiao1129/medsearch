<?php
session_start();
//error_reporting (0);
//include_once('classes/config.php');
//include_once('classes/sessions.php');


include_once('setting.php');     
include_once('classes/validation.php');     
include_once('models/CI_model.php'); 
include_once('classes/random_code.php'); 
include_once('classes/mkdir_chmod.php'); 
$title_index =1;
//ini_set('register_globals', 'On'); 
//$ip=$_SERVER['REMOTE_ADDR'];
//echo "<b>IP Address= $ip</b>";

if(isset($_GET["output"])&&isset($_GET["q"]))
{
    $header_template = "header_0.php";
    $logo_template = "logo_template.php";
    
    $output = $_GET["output"];
    $query = trim($_GET["q"]);
    if($output = "search" && !empty($query))
    {
       // $search_bar_template = "search_bar_template.php";
      //  $content_template = null;
        
        if (get_magic_quotes_gpc()) 
        {
            $query = stripslashes($query);
        } 
        
        
    }
    else
    {
        
    }
}
else
{
    $header_template = "header_0.php";
    $logo_template = "logo_template.php";
    $search_bar_template = "search_bar_template.php";
    $content_template = null;
    
    
}

$footer_template = "footer_template.php";

include "html/main_0.php";


?>
