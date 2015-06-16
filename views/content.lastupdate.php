<div class="page-header">
  <h1 id="tables"><?=$config[last_update_home]?> <?=$lang[last_manga_updated]?></h1>
</div>
<table class="table table-striped table-bordered table-hover">
	<thead>
	  <tr>
		<th><?=$lang[Manga]?></th>
		<th><?=$lang[Last_chapter]?></th>
		<th><?=$lang[Time_update]?></th>
	  </tr>
	</thead>
	<tbody>
<?
$result = mysql_query("SELECT name,slug,last_update,last_chapter FROM mangas ORDER BY last_update DESC LIMIT $config[last_update_home]");
while($row = mysql_fetch_array($result))
  {
?> 
                  <tr>
                    <td><a href="<?=$lang[manga_slug]?>-<?=$row[slug]?>.html"><?=$row[name]?></td>
                    <td><a href="doc-<?=$row[slug]?>-chuong-<?=$row[last_chapter]?>.html">Chương <?=$row[last_chapter]?></a></td>
                    <td><?=date( 'd-m-Y',strtotime($row[last_update]))?></td>
                  </tr>
<? 
  }
?>
	</tbody>
</table>