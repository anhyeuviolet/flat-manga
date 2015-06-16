<? include 'dom2.php'; ?>
<div class="well">
	Notice when grab manga from mangafox:<br />
	The grab manga section right now can not grab manga status and other name but you can manually submit it. Sorry for this inconvenient.
</div>
<? if($_POST && $_GET[action] == 'grab_manga'){ 
	$url = $_POST[url];
	$manga = grab_mangafox($url);
	$slug_new = LamDepURL($name);
	$manga = addslashes2($manga);
	$query = mysql_query("INSERT INTO mangas (name, slug, other_name, authors, artists, released, genres, description, m_status, cover, last_update) VALUES ('$manga[name]', '$slug', '$_POST[other_name]', '$manga[authors]', '$manga[artists]', '$manga[released]', '$manga[genres]', '$manga[description]', '$_POST[m_status]', '$manga[cover]', NOW())")or die(mysql_error());
	echo '<script>alert("'.$lang[manga_added].'");</script>';
	redirect('index.php?view=admin&sub_view=manga.list');
	}
?>

<div class="well">
  <form class="bs-example form-horizontal" method="POST" action="index.php?view=admin&sub_view=grab.manga.mangafox&action=grab_manga&token=<?=$_SESSION[token]?>">
  <fieldset>
	  <legend><?=$lang[Grab]?> - <?=$lang[Manga]?> from Mangafox</legend>
	  <div class="form-group">
		<label class="col-lg-2 control-label">URL to the Manga Series</label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="url" placeholder="http://www.mangapark.com/manga/Beelzebub">
		</div>
	  </div>	  
	  <div class="form-group">
		<label class="col-lg-2 control-label"><?=$lang[Other_name]?></label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="other_name">
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-lg-2 control-label"><?=$lang[Status]?></label>
		<div class="col-lg-10">
		  <div class="radio">
			<label>
			  <input type="radio" name="m_status" id="optionsRadios1" value="1">
			  <?=$lang[Completed]?>
			</label>
		  </div>
		  <div class="radio">
			<label>
			  <input type="radio" name="m_status" id="optionsRadios2" value="2" checked="">
			  <?=$lang[On_going]?>
			</label>
		  </div>
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