<?php
require_once('html_setting.php');
?>
<div class ="site_form">
        <table>
		<form action="spider_adapter.php" method="post">
		<tr><td><b>Address:</b></td><td> <input type="text" name="url" size="48" value="http://"></td></tr>
		<tr><td><b>Indexing options:</b></td><td>
		<input type="radio" name="soption" value="full" > Full<br/>
		<input type="radio" name="soption" value="level" checked>To depth: <input type="text" name="maxlevel" size="2" value="2"><br/>
		<input type="checkbox" name="reindex" value="1" > Reindex<br/>
		</td></tr>
		<tr><td></td><td><input type="checkbox" name="domaincb" value="1" > Spider can leave domain<br/></td></tr>
		<tr><td><b>URL must include:</b></td><td><textarea name=in cols=35 rows=2 wrap="virtual"></textarea></td></tr>
		<tr><td><b>URL must not include:</b></td><td><textarea name=out cols=35 rows=2 wrap="virtual"></textarea></td></tr>	
		<tr><td></td><td><input type="submit" id="submit" value="Start indexing"></td></tr>
		</form>
        </table>
</div>