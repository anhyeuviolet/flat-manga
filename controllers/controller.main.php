<?
	// Declare and process
	$view = $_GET[view];
	$id = $_GET[id];
	$mid = $_GET[mid];
	$slug = $_GET[slug];
	$chapter_no = $_GET[chapter];
	$chapter_cookie = $_COOKIE[chapter_cookie];
	if($slug){
		$manga_query = mysql_query("SELECT * FROM mangas WHERE slug = '$slug'");
		$manga = mysql_fetch_array($manga_query);
	}
	if($chapter_no){
		$chapter_query = mysql_query("SELECT * FROM chapters WHERE chapter = '$chapter_no' AND manga = '$slug'");
		$chapter = mysql_fetch_array($chapter_query);
	}
	if(!isset($_COOKIE[read_type])){
		setcookie("read_type","1",time() + (10 * 365 * 24 * 60 * 60)); 
	}
	// DO with VIEW 
	if(!$view){ 
		$view = 'home'; 
		$config[title_display] .= ' - '.$lang[sub_title_home];
	}else if($view == 'manga'){ 
		$config[title_display] = "$manga[name] | $config[title_display] | iManga.Com ";
	}else if($view == 'chapter'){ 
		$chapter_id = $chapter[id];
		$page = $_GET[page];
		$touch = $_GET[touch];
		if(isset($page)){ 
			setcookie("read_type","2",time() + (10 * 365 * 24 * 60 * 60)); 
			$config[read_type] = 2;
		}else if(isset($touch)){ 
			setcookie("read_type","3",time() + (10 * 365 * 24 * 60 * 60)); 
			$config[read_type] = 3;
		}else{ 
			setcookie("read_type","1",time() + (10 * 365 * 24 * 60 * 60)); 
			$config[read_type] = 1;
		}
		$next_chap = $chapter_no+1;
		$prev_chap = $chapter_no-1;
		
		$config[title_display] = "$manga[name] $lang[chapter] $chapter[chapter] $chapter[name] | $config[title_display] | iManga.Com ";
	}else if($view == 'list'){
		$sub_title = 'Danh sách truyện';
	}
?>