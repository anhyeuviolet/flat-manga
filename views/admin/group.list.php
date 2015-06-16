<?
	if($_GET[action] == 'delete' && $_GET[token] == $_SESSION[token]){
		mysql_query("DELETE FROM groups WHERE id='$_GET[id]'")or die(mysql_error());
		echo '<div class="alert alert-dismissable alert-info">
			'.$lang[Group_delete_ex].''.$_GET[slug].'
            </div>';
	}
?>
	<table class="table table-striped table-bordered table-hover">
		<thead>
		  <tr>
			<th><?=$lang[Group]?></th>
			<th colspan="2"><?=$lang[Group]?> <?=$lang[Action]?></th>
		  </tr>
		</thead>
		<tbody>
	<?
		$result = mysql_query("SELECT id,name FROM groups ORDER BY name");
		while($row = mysql_fetch_array($result)){
	?> 
					  <tr>
						<td><?=$row[name]?></td>
						<td>
							<span class="glyphicon glyphicon-edit"></span>  
							<a href="index.php?view=admin&sub_view=group.edit&id=<?=$row[id]?>"><?=$lang[Edit]?></a>
						</td>
						<td>
							<span class="glyphicon glyphicon-remove"></span> 
								<a href="index.php?view=admin&sub_view=group.list&token=<?=$_SESSION[token]?>&id=<?=$row[id]?>&action=delete"> <?=$lang[Delete]?></a>
							</span>
						</td>
					  </tr>
	<? }  ?>
		</tbody>
	</table>