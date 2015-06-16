<?	
	$data = array();
	$query = mysql_query("SELECT name,slug FROM mangas");
	while($row = mysql_fetch_array($query))
	{
		$ten_truyen = kodau($row[name]);
		$data[$ten_truyen] = 'manga-'.$row[slug].'.html';
	}
	$data = serialize($data);
	$data = addslashes($data);
	$string = '<? $data =  unserialize("'.$data.'"); ?>';
	
	echo $string;
	$fp = fopen("controllers/manga-index.php", "w");
	fwrite($fp, $string);
	fclose($fp);
		
?>