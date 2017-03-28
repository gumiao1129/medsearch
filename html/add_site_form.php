<?php
require_once('html_setting.php');
?>
<div class="site_form">
    <center>
        <table>
            <form action=site_adapter.php method=post>
                <input type=hidden name=f value=1>
                    <input type=hidden name=af value=2>
                    <tr><td><b><?php echo $lang_url;?></b></td><td align ="right"></td><td><input type=text name=url size=60 value ="http://"></td></tr>
                    <tr><td><b><?php echo $lang_title;?></b></td><td></td><td> <input type=text name=title size=60></td></tr>
                    <tr><td><b><?php echo $lang_short_des;?></b></td><td></td><td><textarea name=short_desc cols=45 rows=3 wrap="virtual"></textarea></td></tr>
                    <tr><td><b><?php echo $lang_Specialty;?></b></td><td></td><td>
                            <select name=specialty_list >
                                <option value="-1"><?php echo $lang_select_specialty;?></option>
                                <?php
                                if(isset($specitily_list) && $specitily_list != null)
                                {
                                    foreach($specitily_list as $row)
                                    {
                                        print "<option value=\"$row[specialty_id]\">$row[specialty]</option>";
                                    }
                                }
                                ?>
                            </select>
                    </td></tr>
                    <tr><td></td><td></td><td><input type=submit id="submit" value=Add></td></tr>
            </form>
        </table>
    </center>
</div>