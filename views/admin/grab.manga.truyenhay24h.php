<? include 'dom2.php'; ?>
<div class="well">
	Chú ý khi grab link từ vnsharing:<br />
	Hiện này vnsharing không thể grab được tình trạng truyện (hoàn tất,..), giới thiệu truyện và không có năm phát hành. Do đó bạn có thể nhập thêm hoặc để trống.
</div>
<? if($_POST && $_GET[action] == 'grab_manga'){ 
	$url = $_POST[url];
	$manga = grab_vnsharing($url);
	$slug_new = LamDepURL($name);
	$manga = addslashes2($manga);
	$description = addslashes($_POST[description]);
	$query = mysql_query("INSERT INTO mangas (name, slug, other_name, authors, artists, released, genres, description, m_status, cover, last_update) VALUES ('$manga[name]', '$slug', '$manga[other_name]', '$manga[authors]', '$manga[artists]', '$_POST[released]', '$manga[genres]', '$description', '$_POST[m_status]', '$manga[cover]', NOW())")or die(mysql_error());
	echo '<script>alert("'.$lang[manga_added].'");</script>';
	redirect('index.php?view=admin&sub_view=manga.list');
	}
?>

<div class="well">
  <form class="bs-example form-horizontal" method="POST" action="index.php?view=admin&sub_view=grab.manga.vnsharing&action=grab_manga&token=<?=$_SESSION[token]?>">
  <fieldset>
	  <legend><?=$lang[Grab]?> - <?=$lang[Manga]?> from Vnsharing</legend>
	  <div class="form-group">
		<label class="col-lg-2 control-label">URL đến bộ truyện</label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="url" placeholder="http://truyen.vnsharing.net/Truyen/Beelzebub?id=204">
		</div>
	  </div>	
	  <div class="form-group">
		<label class="col-lg-2 control-label">Năm phát hành</label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="released" value="2013">
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
		<label for="textArea" class="col-lg-2 control-label"><?=$lang[Description]?></label>
		<div class="col-lg-10">
		  <textarea class="form-control" rows="3" name="description"></textarea>
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