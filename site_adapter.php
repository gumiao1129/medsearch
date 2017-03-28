<?php
session_start();
include_once('setting.php');       
include_once('classes/sessions.php');    
include_once('admin/sites.php');

if(isset($_POST['url']) && isset($_POST['title']) && isset($_POST['short_desc']) && isset($_POST['specialty_list']) && 
($_POST['url'] != null && $_POST['title'] != null && $_POST['short_desc'] != null && $_POST['specialty_list'] != null))
{
    $url = $_POST['url']; $title = $_POST['title']; $short_desc = $_POST['short_desc']; $specialty_id = $_POST['specialty_list']; $site_id= null;
    $site = new sites($url, $title, $short_desc, $specialty_id, $site_id);
    $site->add_site();
    
    header("Location: ./home.php?p=1");
}
else
{
    echo "bad";
}


?>
