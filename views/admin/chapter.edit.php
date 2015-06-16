<?
	$chapter_query = mysql_query("SELECT * FROM chapters WHERE chapter = '$chapter_no' AND manga = '$slug'");
	$chapter = mysql_fetch_array($chapter_query);
	if($_POST && $_GET[token] == $_SESSION[token]){
	// Variable list
		$chapter_number = $_POST[chapter];
		$name = $_POST[name];
		$group = $_POST[group];
		$content = $_POST[content];
		
		$query = mysql_query("UPDATE chapters SET chapter='$chapter_number', name='$name', trans_group='$group', content='$content' WHERE chapter='$chapter_no' AND manga='$manga[slug]'")or die(mysql_error());
		echo "<script>alert('$lang[chapter_updated]');</script>";
		echo redirect('index.php?view=admin&sub_view=chapter.list&slug='.$slug, 5);
				
	}
?>
<div class="well">
  <form class="bs-example form-horizontal" enctype="multipart/form-data" method="POST" action="index.php?view=admin&sub_view=chapter.edit&slug=<?=$slug?>&chapter=<?=$chapter_no?>&token=<?=$_SESSION[token]?>">
	<fieldset>
	  <legend><?=$lang[Manga]?> - <?=$lang[Edit]?></legend>
	  <div class="form-group">
		<label class="col-lg-2 control-label"><?=$lang[Chapter]?></label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="chapter" value="<?=$chapter[chapter]?>" placeholder="<?=$lang[Chapter]?>">
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-lg-2 control-label"><?=$lang[Name]?></label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="name" value="<?=$chapter[name]?>" placeholder="<?=$lang[Chapter_Name]?>">
		</div>
	  </div>
	  <div class="form-group">
		<label for="textArea" class="col-lg-2 control-label"><?=$lang[Content]?></label>
		<div class="col-lg-10">
		  <textarea class="form-control" rows="3" name="content" placeholder="http://example.com/images1.jpghttp://example.com/images2.jpghttp://example.com/images3.jpg"><?=$chapter[content]?></textarea>
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-lg-2 control-label"><?=$lang[Group]?></label>
		<div class="col-lg-10">
		  <select class="form-control" name="group">
		  <? $result = mysql_query("SELECT id,name FROM groups");
			while($row = mysql_fetch_array($result)){
			echo "<option value='$row[id]' ".($row[id] == $chapter[trans_group] ? 'selected' : '').">$row[name]</option>";
			} ?>
		  </select>
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