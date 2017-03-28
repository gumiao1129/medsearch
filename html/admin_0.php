<?php
require_once('html_setting.php');
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo $dir; ?>" lang="<?php echo $lang; ?>">
        <head>

                <meta http-equiv="Content-Type" content="<?php echo $content; ?>" charset="<?php echo $charset; ?>" />

                <title><?php echo $page_title[$title_index]; ?></title>

                <meta name="Description" content="<?php echo $description; ?>"/>
                <meta name="Keywords" content="<?php echo $keywords; ?>"/>

                <link href="<?php echo $base_url; ?>/lib/css/main.css" rel="stylesheet" type="text/css" media="all">
                <link href="<?php echo $base_url; ?>/lib/css/inettuts.css" rel="stylesheet" type="text/css" media="all">
                <!--[if lte IE 6]>
              <link rel="stylesheet" href="<?php echo $base_url; ?>/lib/css/ie6.css" type="text/css">
                <![endif]-->

                <!--[if IE 7]>
              <link rel="stylesheet" href="<?php echo $base_url; ?>/lib/css/ie7.css" type="text/css">
                <![endif]-->

                <!--[if IE 8]>
              <link rel="stylesheet" href="<?php echo $base_url; ?>/lib/css/ie8.css" type="text/css">
                <![endif]-->
        </head>
	<body>          
	<center>
	    <!--Begin Header-->
            <?php ($header_template ? include($header_template) : null);?>
            <!--End Header-->

            

	    <!--Begin Content-->
            <?php ($content_template ? include($content_template) : null);?>
            <?php ($content_template_1 ? include($content_template_1) : null);?>
            <?php ($content_template_2 ? include($content_template_2) : null);?>
            <!--End Content-->
	
            <!--Begin Footer-->
            <?php ($footer_template ? include($footer_template) : null);?>
            <!--End Footer-->
	</center>
	</body>
</html>


