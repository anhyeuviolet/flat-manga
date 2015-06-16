<?
	$manga = mysql_query("SELECT id FROM mangas");
	$mangas = mysql_num_rows($manga);

	$chapter = mysql_query("SELECT id FROM chapters");
	$chapters = mysql_num_rows($chapter);
	
	$view = mysql_query("SELECT views FROM mangas");
	while($row = mysql_fetch_array($view)){
	  $views += $row['views'];
	}

	$result = mysql_query("UPDATE count SET mangas='$mangas', chapters='$chapters', views='$views' WHERE id=1")or die(mysql_error());
?>