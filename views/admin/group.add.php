<?
	if($_POST && $_GET[token] == $_SESSION[token]){
	// Variable list 
		$_POST = addslashes2($_POST);
		$name = $_POST[name];
		
		$query = mysql_query("INSERT INTO groups (name) VALUES ('$name')")or die(mysql_error());
		echo '<div class="alert alert-dismissable alert-info">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				   '.$lang[group_added].'
				</div>';
	}
?>
<div class="well">
  <form class="bs-example form-horizontal" method="POST" action="index.php?view=admin&sub_view=group.add&token=<?=$_SESSION[token]?>">
	<fieldset>
	  <legend><?=$lang[Group]?> - <?=$lang[Add_new]?></legend>
	  <div class="form-group">
		<label class="col-lg-2 control-label"><?=$lang[Name]?></label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="name">
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