<?
	$manga_query = mysql_query("SELECT * FROM mangas WHERE slug = '$slug'");
	$manga = mysql_fetch_array($manga_query);
	if($_POST && $_GET[token] == $_SESSION[token]){
	// Variable list 
		$_POST = addslashes2($_POST);
		$name = $_POST[name];
		$slug_new = LamDepURL($name);
		$other_name = $_POST[other_name];
		$authors = $_POST[authors];
		$artists = $_POST[artists];
		$released = $_POST[released];
		$genres = $_POST[genres];
		$description = $_POST[description];
		$m_status = $_POST[m_status];
		
		// Handle the cover, url or upload?!
		if($_POST[cover_url] != NULL){
			$cover = $_POST[cover_url];
		}else{
			if(!isset($_FILES['cover_file']) || !is_uploaded_file($_FILES['cover_file']['tmp_name'])){
				die('Có lỗi khi tải ảnh!'); // output error when above checks fail.
			}
			$target_path = "uploads/";
			$target_path = $target_path . md5(rand().time()).'_'. basename( $_FILES['cover_file']['name']); 
			if(move_uploaded_file($_FILES['cover_file']['tmp_name'], $target_path)) {
				$cover = $target_path;
			} else{
				echo '<div class="alert alert-dismissable alert-danger">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Oh **!</strong> '.$lang[cover_up_error].'
					</div>';
				$error = '1';
			}
		}
	if($error <> 1){ // Found no error, go ahead!
		if($manga[slug] != $slug_new){ //If change the manga name, also update the name in chapter
		$query = mysql_query("UPDATE chapters SET manga='$slug_new' WHERE manga='$manga[slug]'");
		}
		$query = mysql_query("UPDATE mangas SET name='$name', slug='$slug_new', other_name='$other_name', authors='$authors', artists='$artists', released='$released', genres='$genres', description='$description', m_status='$m_status', cover='$cover', last_update=NOW() WHERE slug='$manga[slug]'")or die(mysql_error());	
		$query = mysql_query("UPDATE search SET name='$name', slug='$slug_new' WHERE slug='$manga[slug]'")or die(mysql_error());	
		echo "<script>alert('$lang[manga_updated]');</script>";
		echo redirect('index.php?view=admin&sub_view=manga.list', 5);
	}
	}
?>
<div class="well">
  <form class="bs-example form-horizontal" enctype="multipart/form-data" method="POST" action="index.php?view=admin&sub_view=manga.edit&token=<?=$_SESSION[token]?>&slug=<?=$slug?>">
	<fieldset>
	  <legend><?=$lang[Manga]?> - <?=$lang[Add_new]?></legend>
	  <div class="form-group">
		<label class="col-lg-2 control-label"><?=$lang[Name]?></label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="name" value="<?=$manga[name]?>" placeholder="<?=$lang[Series_Name]?>">
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-lg-2 control-label"><?=$lang[Other_name]?></label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="other_name" value="<?=$manga[other_name]?>" placeholder="<?=$lang[Other_name_ex]?>">
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-lg-2 control-label"><?=$lang[Authors]?></label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="authors" value="<?=$manga[authors]?>" placeholder="<?=$lang[Authors_ex]?>">
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-lg-2 control-label"><?=$lang[Artists]?></label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="artists" value="<?=$manga[artists]?>" placeholder="<?=$lang[Artists_ex]?>">
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-lg-2 control-label"><?=$lang[Released]?></label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" value="<?=$manga[released]?>" name="released">
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-lg-2 control-label"><?=$lang[Genres]?></label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="genres" value="<?=$manga[genres]?>" placeholder="<?=$lang[Genres_ex]?>">
		</div>
	  </div>
	  <div class="form-group">
		<label for="textArea" class="col-lg-2 control-label"><?=$lang[Description]?></label>
		<div class="col-lg-10">
		  <textarea class="form-control" rows="3" name="description"><?=$manga[description]?></textarea>
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-lg-2 control-label"><?=$lang[Status]?></label>
		<div class="col-lg-10">
		  <div class="radio">
			<label>
			  <input type="radio" name="m_status" id="optionsRadios1" value="1" <?=($manga[m_status] == '1' ? 'checked' : '')?>>
			  <?=$lang[Completed]?>
			</label>
		  </div>
		  <div class="radio">
			<label>
			  <input type="radio" name="m_status" id="optionsRadios2" value="2" <?=($manga[m_status] == '2' ? 'checked' : '')?>>
			  <?=$lang[On_going]?>
			</label>
		  </div>
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-lg-2 control-label"><?=$lang[Cover]?></label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="cover_url" value="<?=$manga[cover]?>" placeholder="<?=$lang[Cover_ex]?>">
		  <h3><?=$lang['or']?></h3>
		  <input type="file" class="form-control" name="cover_file">
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