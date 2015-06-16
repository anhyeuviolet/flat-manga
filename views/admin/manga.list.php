<?
	if($_GET[action] == 'delete' && $_GET[token] == $_SESSION[token]){
		mysql_query("DELETE FROM mangas WHERE slug='$_GET[slug]'");
		mysql_query("DELETE FROM search WHERE slug='$_GET[slug]'");
		mysql_query("DELETE FROM chapters WHERE manga='$_GET[slug]'");
		echo '<div class="alert alert-dismissable alert-info">
			'.$lang[Manga_delete_ex].''.$_GET[slug].'
            </div>';
	}
?>

<div class="alert alert-dismissable alert-warning">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<h4><?=$lang[Warning]?></h4>
	<p><?=$lang[Delte_warning]?></p>
</div>
<table class="table table-striped table-bordered table-hover">
	<thead>
	  <tr>
		<th><?=$lang[Manga]?></th>
		<th colspan="2"><?=$lang[Action]?></th>
	  </tr>
	</thead>
	<tbody>
<?
$result = mysql_query("SELECT id,name,slug,last_update,last_chapter FROM mangas");
while($row = mysql_fetch_array($result))
  {
?> 
                  <tr>
                    <td><?=$row[name]?></td>
                    <td>
						<span class="glyphicon glyphicon-edit"></span>  
						<a href="index.php?view=admin&sub_view=manga.edit&slug=<?=$row[slug]?>"><?=$lang[Edit]?></a>
					</td>
                    <td>
						<span class="text-danger"><span class="glyphicon glyphicon-remove"></span>  
							<a href="index.php?view=admin&sub_view=manga.list&token=<?=$_SESSION[token]?>&action=delete&slug=<?=$row[slug]?>"><?=$lang[Delete]?></a>
						</span>
					</td>
                  </tr>
<? 
  }
?>
	</tbody>
</table>