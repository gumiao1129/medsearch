<?php
require_once('html_setting.php');
?>
<fieldset style="width:30%;"><legend><b><?php echo $lang_admin_login; ?></b></legend>
        <div id="error_message">
        <?php ($login_error_message ? (print $login_error_message) : null); ?>
        </div> 
	<form action="admin.php" method="post">
            <table>
                <tr>
                    <td><?php echo $lang_user_name; ?></td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td><?php echo $lang_password; ?></td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="hidden" name="submitted"><input type="submit" value="<?php echo $lang_login_now; ?>" id="submit"></td>
                </tr>
            </table>
	</form>
</fieldset>