<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Flat manga - Installation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Huy không">

    <!-- Le styles -->
    <link href="assets/css/flat.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 450px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
		width: 100%;
      }

    </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
	<? if($_POST){ 
		$connect = mysql_connect($_POST[db_host], $_POST[db_user], $_POST[db_pw]);
		if (!$connect) {
			die('Could not connect: ' . mysql_error());
		}
		echo 'Connected successfully<br />';
		$db_selected = mysql_select_db($_POST[db_name], $connect);
		if (!$db_selected) {
			die ('Can\'t use database '.$_POST[db_name].' : ' . mysql_error());
		}
		echo 'Connected to database '.$_POST[db_name].'<br />';
		$query = mysql_query("CREATE TABLE `chapters` (
		  `id` int(11) NOT NULL auto_increment,
		  `chapter` float NOT NULL,
		  `name` varchar(150) NOT NULL,
		  `manga` varchar(100) NOT NULL,
		  `trans_group` int(11) NOT NULL,
		  `views` int(11) NOT NULL,
		  `last_update` datetime NOT NULL,
		  `content` text NOT NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
		$query2 = mysql_query("CREATE TABLE `count` (
		  `id` int(1) NOT NULL auto_increment,
		  `mangas` int(10) NOT NULL,
		  `chapters` int(10) NOT NULL,
		  `views` int(10) NOT NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;");
		$query3 = mysql_query("INSERT INTO `count` VALUES (1, 0, 0, 0);");
		$query4 = mysql_query("CREATE TABLE `groups` (
		  `id` int(11) NOT NULL auto_increment,
		  `name` varchar(250) NOT NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;");
		$query5 = mysql_query("INSERT INTO `groups` VALUES (1, 'Updating')");
		$query6 = mysql_query("CREATE TABLE `mangas` (
		  `id` int(11) NOT NULL auto_increment,
		  `name` varchar(250) NOT NULL,
		  `slug` varchar(150) NOT NULL,
		  `authors` varchar(250) NOT NULL,
		  `artists` varchar(150) NOT NULL,
		  `released` int(4) NOT NULL,
		  `other_name` varchar(250) NOT NULL,
		  `genres` varchar(250) NOT NULL,
		  `description` text NOT NULL,
		  `m_status` tinyint(1) NOT NULL,
		  `views` int(11) NOT NULL default '0',
		  `cover` varchar(250) NOT NULL,
		  `last_update` datetime NOT NULL,
		  `last_chapter` int(11) NOT NULL default '0',
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
		echo 'Database successfull created <br />';
		$content = '<?
			$db_host = "'.$_POST[db_host].'";
			$db_user = "'.$_POST[db_user].'";
			$db_pass = "'.$_POST[db_pw].'";
			$db_name = "'.$_POST[db_name].'";
			
			$connection = mysql_connect($db_host, $db_user, $db_pass);
			mysql_set_charset("utf8", $connection);
			mysql_select_db($db_name);
		?>';
		$fp = fopen("includes/config.db.php", "w");
		fwrite($fp, $content);
		fclose($fp);
		echo 'Database config successfull updated <br />';
		echo 'Congratulation! Flat manga was installed successful!<br />';
		echo 'Please delete file <b>install.php</b> then go to your dashboard to change the site\'s config with admin password is <b>12345</b><br /><br />';
		echo '<a href="admin.html">Go to dashboard</a>';
	?>
		
	
	<? }else { ?>
      <form class="form-signin" method="POST" action="install.php">
        <h2 class="form-signin-heading">Insert database information</h2>
        <input type="text" class="input-block-level" placeholder="Database host" name="db_host">
        <input type="text" class="input-block-level" placeholder="Database username" name="db_user">
        <input type="password" class="input-block-level" placeholder="Database user's password" name="db_pw">
        <input type="text" class="input-block-level" placeholder="Database name" name="db_name">
        <button class="btn btn-large btn-primary" type="submit">Begin installing</button>
      </form>
	<? } ?>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>

  </body>
</html>
