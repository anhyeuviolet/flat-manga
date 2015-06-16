<?
	if($_GET[action] == 'delete' && $_GET[token] == $_SESSION[token]){
		mysql_query("DELETE FROM chapters WHERE manga='$_GET[slug]' AND chapter='$_GET[chapter]'")or die(mysql_error());
		echo '<div class="alert alert-dismissable alert-info">
			'.$lang[Chapter_delete_ex].''.$_GET[slug].'
            </div>';
	}
?>
	<? if(!$slug){ ?>
			<table class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
					<th><?=$lang[Manga]?></th>
					<th colspan="2"><?=$lang[Manga]?> <?=$lang[Action]?></th>
				  </tr>
				</thead>
				<tbody>
			<?
				$result = mysql_query("SELECT id,name,slug FROM mangas");
				while($row = mysql_fetch_array($result)){
			?> 
							  <tr>
								<td><?=$row[name]?></td>
								<td>
									<span class="glyphicon glyphicon-edit"></span>  
									<a href="index.php?view=admin&sub_view=chapter.add&slug=<?=$row[slug]?>"><?=$lang[Add_new]?> <?=$lang[Chapter]?></a>
								</td>
								<td>
									<span class="glyphicon glyphicon-align-justify"></span> 
										<a href="index.php?view=admin&sub_view=chapter.list&token=<?=$_SESSION[token]?>&slug=<?=$row[slug]?>"> <?=$lang[Chapter_List]?></a>
									</span>
								</td>
							  </tr>
			<? }  ?>
				</tbody>
			</table>
	<? }else{ ?>
			<table class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
					<th><?=$lang[Chapter]?></th>
					<th colspan="2"><?=$lang[Chapter]?> <?=$lang[Action]?></th>
				  </tr>
				</thead>
				<tbody>
			<?
				$result = mysql_query("SELECT id,name,chapter,manga FROM chapters WHERE manga='$slug' ORDER BY chapter");
				while($row = mysql_fetch_array($result)){
			?> 
							  <tr>
								<td><?=$lang[Chapter]?> - <?=$row[chapter]?> - <?=$row[name]?></td>
								<td>
									<span class="glyphicon glyphicon-edit"></span>  
									<a href="index.php?view=admin&sub_view=chapter.edit&slug=<?=$slug?>&chapter=<?=$row[chapter]?>"><?=$lang[Edit]?> <?=$lang[Chapter]?></a>
								</td>
								<td>
									<span class="glyphicon glyphicon-remove"></span> 
										<a href="index.php?view=admin&sub_view=chapter.list&token=<?=$_SESSION[token]?>&slug=<?=$row[manga]?>&chapter=<?=$row[chapter]?>&action=delete"> <?=$lang[Chapter]?> <?=$lang[Delete]?></a>
									</span>
								</td>
							  </tr>
			<? }  ?>
				</tbody>
			</table>
	<? } ?>