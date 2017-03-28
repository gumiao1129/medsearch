<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * Gu Miao
 */

function mkdir_chmod777($upload_dir)
{
    try
    {
        if(!is_dir($upload_dir))
        {
            mkdir($upload_dir, 0777);
            chmod($upload_dir, 0777);
        }
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
}

?>
