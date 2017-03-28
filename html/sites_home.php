<?php
require_once('html_setting.php');
?>

<div class ="site_form">
    <table cellspacing ="0" cellpadding="0" class="darkgrey"><tr><td>
                <table cellpadding="3" cellspacing="1">
			<tr class="grey"><td align="center"><b><?php echo $lang_title_2;?></b></td><td align="center"><b><?php echo $lang_site_link;?></b></td><td align="center"><b><?php echo $lang_last_indexed;?></b></td><td align="center"><b><?php echo $lang_short_des_2;?></b></td><td align="center"><b><?php echo $lang_Specialty_2;?></b></td><td align="center"><b><?php echo $lang_option;?></b></td></tr>
                        <?php
                        if(isset($results) && $results != null)
                        {
                            foreach($results as $row)
                            {
                                print "<tr class=\"white\"><td align=\"left\">$row[title]</td><td align=\"left\"><a href=$row[url]>$row[url]</a></td><td>$row[indexdate]</td><td>$row[short_desc]</td><td>$row[specialty]</td><td><a href=admin.php?f=20&site_id=4 id=\"small_button\">Options</a></td></tr>\n";
                                
                            }
                        }
                        ?>
                        
                      
                </table>
            </td></tr>
    </table>
</div>
<br/>
<br/>	
<center><?php echo $lang_currently_in_db." "; (isset($results) ? (print sizeof($results)) : (print 0)); echo ' '.$lang_sites.', 80 '.$lang_links.' and 9023 '.$lang_keywords;?><br/><br/></center>