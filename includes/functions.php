<?
	function status($status){
		$status = str_replace("1","Đang tiến hành",$status);
		$status = str_replace("2","Hoàn tất",$status);
		$status = str_replace("3","Tạm ngưng",$status);
		return $status;
	}
	function addslashes2($input){
		if ( is_array( $input ) ){
			return array_map( __FUNCTION__, $input );
		}else{
			return addslashes( $input );
		}
	}  
	function trans_group($trans_group){
		$result = mysql_query("SELECT name FROM groups WHERE id = '$trans_group' LIMIT 1");
		$row = mysql_fetch_array($result);
		return $row[name];
	}
	function kodau($str) {
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);
		//$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
	return $str;
	}
	function linkkodau($str) {
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);
		$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
		return $str;
	}
	function isAdmin(){
	global $_SESSION;
		if($_SESSION[admin] == 1){ return true; }else{ return false;}
	}
	function redirect($url,$delay = ""){
		if($delay != NULL) { echo '<script> setTimeout(\'window.location.href="'.$url.'"\', '.$delay.');</script>'; 
		}else{ echo '<script> window.location.href="'.$url.'"; </script>';  }
	}
	function utf8_substr($str,$from,$len){
	return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
                       '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
                       '$1',$str);
	}
	function curPageURL() {
	 $pageURL = 'http';
	 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
	}	
	function ago($time)
	{	
	   global $lang;
	   $periods = array("$lang[second]", "$lang[minute]", "$lang[hour]", "$lang[day]", "$lang[week]", "$lang[month]", "$lang[year]", "$lang[decade]");
	   $lengths = array("60","60","24","7","4.35","12","10");

	   $now = time();
	   $difference     = $now - $time;
	   $tense         = "$lang[ago]";

	   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
		   $difference /= $lengths[$j];
	   }

	   $difference = round($difference);

	   if($difference != 1) {
		   $periods[$j].= $lang[ago_period];
	   }

	   return "$difference $periods[$j] $tense ";
	}
	function split_authors($str){
	global $lang;
		$str = trim($str);
		$tag = explode(",", $str);
		foreach ($tag as &$value) {    
			$tag_out .= '<a href=\''.$lang[author_slug].'-'. str_replace(' ', '-', str_replace('&*#39;','',$value)).'.html\'>'.$value.'</a>, ';
		}
		return mb_substr($tag_out, 0, -2); 
	}
	function split_artists($str){
	global $lang;
		$str = trim($str);
		$tag = explode(",", $str);
		foreach ($tag as &$value) {    
			$tag_out .= '<a href=\''.$lang[artist_slug].'-'. str_replace(' ', '-', str_replace('&*#39;','',$value)).'.html\'>'.$value.'</a>, ';
		}
		return mb_substr($tag_out, 0, -2); 
	}
	function split_genres($str){
	global $lang;
		$str = trim($str);
		$tag = explode(",", $str);
		foreach ($tag as &$value) {    
			$tag_out .= '<a href=\''.$lang[list_slug].'-'.$lang[genre_slug].'-'. str_replace(' ', '-', str_replace('&*#39;','',$value)).'.html\'>'.$value.'</a>, ';
		}
		return mb_substr($tag_out, 0, -2); 
	}	
	function gen_url($slug,$chapter,$type = NULL){
	global $config;
	global $lang;
	global $_COOKIE;
	if($type == NULL){
		$type = $config[read_type];
	}
		// type = [1,2,3] = [webtoon,pbp,pbpt]
		if($type == '1'){
			$url = "$lang[read_slug]-$slug-$lang[chapter_slug]-$chapter.html";
		}else if($type == '2'){
			$url = "$lang[read_slug]-$slug-$lang[chapter_slug]-$chapter-$lang[page_slug]-1.html";
		}else{
			$url = "$lang[read_slug]-$slug-$lang[chapter_slug]-$chapter-touch.html";
		}
	return $url;	
	}
	function page_select($imgs){
		global $page;
		global $slug;
		global $chapter;
		global $lang;
		$next_page = $page+1;
		$pre_page = $page-1;
		$count_imgs = count($imgs);
			echo ($page <> '1' ? "<a href='$lang[read_slug]-$slug-$lang[chapter_slug]-$chapter[chapter]-$lang[page_slug]-$pre_page.html' class='label label-info'>$lang[Previous_page]</a>&nbsp;&nbsp;" : '');
			echo 'Page: <select onchange="window.location=this.value;">';
			for($i = 1; $i < count($imgs); $i++){
				if($page == $i){
					echo "<option value=\"$lang[read_slug]-$slug-$lang[chapter_slug]-$chapter[chapter]-$lang[page_slug]-$i.html\" selected>$i</option>";
				}else{
					echo "<option value=\"$lang[read_slug]-$slug-$lang[chapter_slug]-$chapter[chapter]-$lang[page_slug]-$i.html\">$i</option>";
				}
			}
			echo "<option value=\"$lang[read_slug]-$slug-$lang[chapter_slug]-$chapter[chapter]-$lang[page_slug]-$count_imgs.html\">$lang[Comment]</option>"; 
			echo '</select>';
			echo ($page < count($imgs)-1 ? "&nbsp;&nbsp;<a href='$lang[read_slug]-$slug-$lang[chapter_slug]-$chapter[chapter]-$lang[page_slug]-$next_page.html' class='label label-info'>$lang[Next_page]</a>" : ($page == count($imgs)-1 ? "&nbsp;&nbsp;<a href='$lang[read_slug]-$slug-$lang[chapter_slug]-$chapter[chapter]-$lang[page_slug]-$next_page.html' class='label label-danger'>$lang[Comment]</a>" : ''));
			echo '<br /><br />';
	}
	function chapter_select(){
		global $chapter;
		global $slug;
		global $lang;
		echo '<select class="form-control col-lg-8" onchange="window.location=this.value;">';
		$result = mysql_query("SELECT chapter FROM chapters WHERE manga='$slug' ORDER BY chapter DESC");
		while($row = mysql_fetch_array($result)){ 
			$url = gen_url($slug,$row[chapter]);
			echo "<option value='$url'".($chapter[chapter] == $row[chapter] ? 'selected' : '').">$lang[Chapter] $row[chapter]&nbsp;&nbsp;</option>";
		}
		echo '</select>';
	}
	function check_chapter($slug,$chapter){
		$pre_chap_info = mysql_query("SELECT id,chapter FROM chapters WHERE chapter = '$chapter' AND manga = '$slug'");
		$pre_chap = mysql_fetch_array($pre_chap_info);
		$pre_chap_num = mysql_num_rows($pre_chap_info);
		if($pre_chap_num > 0){ return true; }else{ return false; }
		
	}
	if(!function_exists("LamDepURL")){

    function LamDepURL($str)
    {
        $coDau=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ"
        ,"ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ","ì","í","ị","ỉ","ĩ",
            "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
        ,"ờ","ớ","ợ","ở","ỡ",
            "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
            "ỳ","ý","ỵ","ỷ","ỹ",
            "đ",
            "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
        ,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
            "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
            "Ì","Í","Ị","Ỉ","Ĩ",
            "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
        ,"Ờ","Ớ","Ợ","Ở","Ỡ",
            "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
            "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
            "Đ","ê","ù","à");
        $khongDau=array("a","a","a","a","a","a","a","a","a","a","a"
        ,"a","a","a","a","a","a",
            "e","e","e","e","e","e","e","e","e","e","e",
            "i","i","i","i","i",
            "o","o","o","o","o","o","o","o","o","o","o","o"
        ,"o","o","o","o","o",
            "u","u","u","u","u","u","u","u","u","u","u",
            "y","y","y","y","y",
            "d",
            "A","A","A","A","A","A","A","A","A","A","A","A"
        ,"A","A","A","A","A",
            "E","E","E","E","E","E","E","E","E","E","E",
            "I","I","I","I","I",
            "O","O","O","O","O","O","O","O","O","O","O","O"
        ,"O","O","O","O","O",
            "U","U","U","U","U","U","U","U","U","U","U",
            "Y","Y","Y","Y","Y",
            "D","e","u","a");
        $str = str_replace($coDau,$khongDau,$str);
		$str = str_replace(' ', '-', $str); // Replaces all spaces with hyphens.
		$str = preg_replace('/[^A-Za-z0-9\-]/', '', $str); // Removes special chars.
		$str = mb_strtolower($str, 'UTF-8'); //Lowercase
		return preg_replace('/-+/', '-', $str); // Replaces multiple hyphens with single one.
    }
} 
/* 
function clean($kytu) {
   $kytu = str_replace(' ', '-', $kytu); // Replaces all spaces with hyphens.
   $kytu = preg_replace('/[^A-Za-z0-9\-]/', '', $kytu); // Removes special chars.

   return preg_replace('/-+/', '-', $kytu); // Replaces multiple hyphens with single one.
}
*/
?>