<?php
require_once('html_setting.php');
?>
<div id="search_bar">
    <center>
            <table cellpadding="10" cellspacing="2" class="searchBox">
                <tr>
                    <td align="center">
                        <form method="get">
                            <table>
                                <tr>
                                    <td>
                                        <div align="left"> 
                                            <input type="text" name="q" value="" id="searchText" autofocus="autofocus" size="80"  maxlength="256"/>
                                            <!--<input type="text" name="query" id="query" size="80" value="" action="include/js_suggest/suggest.php" columns="4" autofocus="autofocus" autocomplete="off" delay="1500">	-->
                                        </div> 
                                    <td>
                                        <input type="submit" value="Search">
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" name="output" value="search"> 
                        </form>
                    </td>
                </tr>
            </table>
     </center>
</div>