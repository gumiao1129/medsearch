<?php
require_once('html_setting.php');
?>
  <div id="header">
      <!--Begin MDlike logo-->
       <a href="index.php"><img id="header_loggedin_logo" src="[var.base_url]/lib/img/meddgo_logo.png" /></a>
      <!--End MDlike logo--->
      <div class="top_menu">
        <p>
          <a href="home.php"><?php echo $lang_home; ?></a>
          &nbsp;|&nbsp;
          <a href="home.php?p=1"><?php echo $lang_sites; ?></a>
          &nbsp;|&nbsp;
          <a href="home.php?p=2"><?php echo $lang_categories; ?></a>
          &nbsp;|&nbsp;
          <a href="home.php?p=4"><?php echo $lang_settings; ?></a>
          &nbsp;|&nbsp;
          <a href="home.php?p=5"><?php echo $lang_statistics; ?></a>
          &nbsp;|&nbsp;
          <a href="home.php?p=6"><?php echo $lang_layout; ?></a>
        </p>
      </div>
  </div>