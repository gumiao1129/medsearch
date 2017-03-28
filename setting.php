<?php

define( 'ABSPATH', dirname(__FILE__) . '/');
define( 'ABSCONFIG', dirname(__FILE__) . '/classes/html_config/');

if(isset($language))
{
    $pre_lang_index = "en";
}
else
{
    $pre_lang_index = "en";
}

include_once('lang/'.$pre_lang_index.'.php');

error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );

?>
