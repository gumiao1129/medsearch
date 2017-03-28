<?php
//session_start();
//error_reporting (0);
//include_once('classes/config.php');
//include_once('classes/sessions.php');


include_once('setting.php');     
include_once('classes/validation.php');     
include_once('models/CI_model.php'); 
include_once('classes/random_code.php'); 
include_once('classes/mkdir_chmod.php'); 
$title_index = 2;

    if(isset($_POST["submitted"]))
    {
            // get login info and check the DB
            $user_name_login	= mysql_real_escape_string($_POST['username']);
            $password_login	= mysql_real_escape_string($_POST['password']);
            $password_login	= md5($password_login);
            
            $max_username_length =12;
            $login_error_message  ='';

            //start validate all the login fields
            $loginValidation = new validation();
            //check username
            $check_username_empty = $loginValidation->checkEmpty($user_name_login);
            $check_username_valid= $loginValidation->checkValid($user_name_login);
            $check_username_length=$loginValidation->username($user_name_login, $max_username_length);

                    if($check_username_empty == 'pass')
                    {
                        if($check_username_valid == 'pass')
                        {
                            if($check_username_length == 'pass')
                            {
                                $procede = true;
                            }
                            else
                            {
                                $procede = false;
                                $login_error_message = $login_error_message.$lang_user_name.$lang_usernameShortOrLong;
                            }
                        }
                        else
                        {
                            $procede = false;
                            $login_error_message = $login_error_message.$lang_user_name.$lang_unmatch;
                        }
                    }
                    else
                    {
                        $procede = false;
                        $login_error_message = $login_error_message.$lang_user_name.$lang_fillEmpty;
                    }

                    //check password
                    $check_password_empty = $loginValidation->checkEmpty($password_login);
                    $check_password_valid= $loginValidation->checkValid($password_login);
                    if($check_password_empty == 'pass')
                    {
                        if($check_password_valid == 'pass')
                        {
                            $procede = true;
                        }
                        else
                        {
                            $procede = false;
                            $login_error_message = $login_error_message.$lang_password.$lang_unmatch;
                        }
                    }
                    else
                    {
                        $procede = false;
                        $login_error_message = $login_error_message.$lang_password.$lang_fillEmpty;
                    }


            if($procede == true && $login_error_message==null)
            {
                //Config the database and check the patient and physician 
                $model = new CI_model();
                $table = "users";
                $columns = "user_id, user_login, user_pass";
                $content = "user_login = '$user_name_login'";
                $result = $model->dbSelect($table, $columns, $content);

                if($result != null)
                {
                     if($password_login == $result['user_pass'])
                     {
                         //Go to home page
                         @session_start();
                         //@session_register('user_id');
                         $_SESSION['user_id']    = $result['user_id'];
                         header('Location: home.php');
                     }
                     else
                     {
                         $procede = false;
                         $login_error_message = $login_error_message.$lang_username_not_match_password;
                         $logo_template = "logo_template.php";
                         $content_template = "admin_login.php";
                         $footer_template = "footer_template.php";
                     }
                }
                else
                {
                         $procede = false;
                         $logo_template = "logo_template.php";
                         $content_template = "admin_login.php";
                         $footer_template = "footer_template.php";
                }
                    @mysql_close();
                   // die();
            }
            else
            {
                         $logo_template = "logo_template.php";
                         $content_template = "admin_login.php";
                         $footer_template = "footer_template.php";
            }
    
}
else
{
    //$header_template = "header_0.php";
    $logo_template = "logo_template.php";
    $content_template = "admin_login.php";
    $footer_template = "footer_template.php";
}
    include "html/admin_0.php";
    
?>
