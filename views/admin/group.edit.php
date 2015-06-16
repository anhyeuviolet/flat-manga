<?
	$group_query = mysql_query("SELECT * FROM groups WHERE id = '$_GET[id]'");
	$group = mysql_fetch_array($group_query);
	if($_POST && $_GET[token] == $_SESSION[token]){
		$query = mysql_query("UPDATE groups SET name='$_POST[name]' WHERE id='$_GET[id]'")or die(mysql_error());
		echo "<script>alert('$lang[group_updated]');</script>";
		echo redirect('index.php?view=admin&sub_view=group.list');
				
	}
?>
<div class="well">
  <form class="bs-example form-horizontal" enctype="multipart/form-data" method="POST" action="index.php?view=admin&sub_view=group.edit&id=<?=$_GET[id]?>&token=<?=$_SESSION[token]?>">
	<fieldset>
	  <legend><?=$lang[Group]?> - <?=$lang[Edit]?></legend>
	  <div class="form-group">
		<label class="col-lg-2 control-label"><?=$lang[Name]?></label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="name" value="<?=$group[name]?>">
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-lg-10 col-lg-offset-2"> 
		  <button type="submit" class="btn btn-primary"><?=$lang[Submit]?></button> 
		</div>
	  </div>
	</fieldset>
  </form>
</div>