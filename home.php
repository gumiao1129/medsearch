<?php
session_start();
include_once('setting.php');     
include_once('classes/validation.php');     
include_once('models/CI_model.php'); 
include_once('classes/random_code.php'); 
include_once('classes/mkdir_chmod.php'); 
include_once('classes/sessions.php');    
include_once('admin/sites.php');
 
    $title_index = 3;
    
    $logo_template = "logo_template.php";
    $header_template = "admin_header.php";
    
    if(isset($_GET['p']))
    {
        switch ($_GET['p']):
            case 1:
            {
                if(isset($_GET['s']))
                {
                    switch ($_GET['s']):
                        case 1;
                        {
                            $db_specitily = new CI_model_TBS();
                            $table =  'specialty'; $attributes = '*'; $otherReq = null;
                            $specitily_list = $db_specitily->TBS_select($table, $attributes, $otherReq);
                            
                            $content_template_1 = 'add_site_form.php';
                            break;
                        }
                        case 2;
                        {
                            $content_template_1 = 'index_site_form.php';
                            break;
                        }                      
                        case 3;
                        {
                            $site_results = new sites(null,null, null, null, null);
                            $results = $site_results->list_all_sites();
                            $content_template_1 = 'index_all_form.php';
                            break;
                        }                       
                        default;
                        {
                            $site_results = new sites(null,null, null, null, null);
                            $results = $site_results->list_all_sites();
                            
                            $content_template_1 = 'sites_home.php';
                            break;
                        }
                    endswitch;
                    $content_template = "sites_manu.php";
                }
                else
                {     
                    $site_results = new sites(null,null, null, null, null);
                    $results = $site_results->list_all_sites();
                            
                    $content_template_1 = 'sites_home.php';
                    $content_template = "sites_manu.php";
                }
            }
            case 2:    
            {
                
                break;
            }
            case 3:
            {
                
                break;
            }
            case 4:
            {
                
                break;
            }
            case 5:
            {
             
                break;
            }
            default;
            {
                $content_template = "admin_home.php";
                break;
            }
        endswitch;
    }
    else 
    {
        $content_template = "admin_home.php";
    }
    
    
    
    $footer_template = "footer_template.php";
    
    include "html/admin_0.php";

?>
