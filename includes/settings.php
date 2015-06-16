<?
		$timezone = "Asia/Ho_Chi_Minh";
		date_default_timezone_set($timezone);
		$today = date("Y-m-d");
		$yester_day = date("d")-1;
		$yesterday = date("Y-m-").'-'.$yester_day;
		$config[title] = "iManga - Truyện Tranh Online" ;
		$config[title_display] = "iManga - Truyện Tranh Online" ;
		$config[admin_pw] = "MJdance";
		$config[lang] = "vi";
		$config[last_update_home] = "25";
		$config[read_type] = "$_COOKIE[read_type]";
		$config[read_type_choose] = "1";
		$config[comment_type] = "1";
		$config[comment_string] = "Truyentranhhot";
		$config[most_popular] = "10"; 
		$config[theme] = "readable";
		?>