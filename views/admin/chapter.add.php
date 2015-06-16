<?
	if($_POST && $_GET[token] == $_SESSION[token]){
	// Variable list
		$chapter = $_POST[chapter];
		$name = addslashes($_POST[name]);
		$group = $_POST[group];
		
		// Handle the cover, url or upload?!
		if($_POST[content]){
			$content = $_POST[content];
		}else{
			$files = array();
			$fdata = $_FILES['ImageFile'];
			if(is_array($fdata['name'])){
				for($i=0;$i<count($fdata['name']);++$i){
						$files[]=array(
					'name'    =>$fdata['name'][$i],
					'type'  => $fdata['type'][$i],
					'tmp_name'=>$fdata['tmp_name'][$i],
					'error' => $fdata['error'][$i], 
					'size'  => $fdata['size'][$i]  
					);
				}
			}else $files[]=$fdata;
			$target_path = "uploads/";
			$folder = 'uploads/'.$slug;
			$folder2 = 'uploads/'.$slug.'/'.$chapter.'/';
			if ( ! is_dir($folder)) {mkdir($folder);}
			if ( ! is_dir($folder2)) {mkdir($folder2);}
			foreach ($files as $file) { 
				$target_path = $target_path . $slug .'/' . $chapter . '/' . $file['name']; 
				if(move_uploaded_file($file['tmp_name'], $target_path)) {
					$content .= $target_path;
					$target_path = "uploads/";
				} else{
					echo '<div class="alert alert-dismissable alert-danger">
							  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  <strong>Oh **!</strong> '.$lang[img_content_up_error].'
						</div>';
					$error = '1';
				}
			}
		}
	if($error <> 1){ // Found no error, go ahead!
		$query = mysql_query("INSERT INTO chapters (chapter, name, manga, trans_group, content, last_update) VALUES ('$chapter', '$name', '$slug', '$group', '$content', NOW())")or die(mysql_error());
		$query2 = mysql_query("UPDATE mangas SET last_chapter = '$chapter', last_update = NOW() WHERE slug='$slug'")or die(mysql_error());

		echo '<div class="alert alert-dismissable alert-info">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				   '.$lang[chapter_added].'
				</div>';
	}
	}
?>
<div class="well">
  <form class="bs-example form-horizontal" enctype="multipart/form-data" method="POST" action="index.php?view=admin&sub_view=chapter.add&slug=<?=$slug?>&token=<?=$_SESSION[token]?>">
	<fieldset>
	  <legend><?=$lang[Manga]?> - <?=$lang[Add_new]?></legend>
	  <div class="form-group">
		<label class="col-lg-2 control-label"><?=$lang[Chapter]?></label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="chapter" placeholder="<?=$lang[Chapter]?>">
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-lg-2 control-label"><?=$lang[Name]?></label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="name" placeholder="<?=$lang[Chapter_Name]?>">
		</div>
	  </div>
	  <div class="form-group">
		<label for="textArea" class="col-lg-2 control-label"><?=$lang[Content]?></label>
		<div class="col-lg-10">
		  <textarea class="form-control" rows="3" name="content" placeholder="http://example.com/images1.jpghttp://example.com/images2.jpghttp://example.com/images3.jpg"></textarea>
		  <?=$lang[Content_ex]?>
		  <input name="ImageFile[]" type="file" multiple="" name="content_file"/>
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-lg-2 control-label"><?=$lang[Group]?></label>
		<div class="col-lg-10">
		  <select class="form-control" name="group">
		  <? $result = mysql_query("SELECT id,name FROM groups");
			while($row = mysql_fetch_array($result)){
			echo "<option value='$row[id]'>$row[name]</option>";
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