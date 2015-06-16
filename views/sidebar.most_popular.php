<h4><?=$lang[Most_popular_manga]?></h4>
<div class="list-group">
<?  $result = mysql_query("SELECT name,slug,last_chapter,cover FROM mangas ORDER BY views DESC LIMIT $config[most_popular]")or die(mysql_error());
	while($row = mysql_fetch_array($result)){
	echo "<a href='$lang[manga_slug]-$row[slug].html' class='list-group-item'>";
	echo "<h4 class='list-group-item-heading'>$row[name]</h4>";
	echo "<p class='list-group-item-text'>$lang[Last_chapter]: $row[last_chapter]</p>";
	echo "</a>";
	}
?>	
</div><br />