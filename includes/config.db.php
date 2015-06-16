<?
			$db_host = "localhost";
			$db_user = "root";
			$db_pass = "";
			$db_name = "flat_manga";
			
			$connection = mysql_connect($db_host, $db_user, $db_pass);
			mysql_set_charset("utf8", $connection);
			mysql_select_db($db_name);
		?>