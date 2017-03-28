<?php
session_start();
include_once('setting.php');       
include_once('classes/sessions.php');    
include_once('admin/spider.php');
include_once('admin/spider_extends.php');

print_r($_POST);
if(isset($_POST['url']) && isset($_POST['maxlevel']) &&
($_POST['url'] != null && $_POST['maxlevel'] != null))
{
    $url = $_POST['url']; 
    $maxlevel = $_POST['maxlevel']; 
    $soption = $_POST['soption']; 
    ($_POST['reindex']!=null) ? ($reindex = $_POST['reindex']) : ($reindex == null);
    ($_POST['domaincb']!=null) ? ($domaincb = $_POST['domaincb']) : ($domaincb == null);
    ($_POST['in']!=null) ? ($include = $_POST['in']) : ($include == null);
    ($_POST['out']!=null) ? ($exclude = $_POST['out']) : ($exclude == null);
    
    $indexdate = date("Y-m-d H:i:s", time());
    
    $spider = new spider($url, $reindex, $maxlevel, $soption, $include, $exclude, $domaincb);
    $spider->index_site();
    
    //header("Location: ./home.php?p=1");
}
else if(isset($_POST['all_index']) && $_POST['all_index'] == md5('true'))
{
    $index_all = new spider_index_all();
    $index_all->index_all();
}

?>
