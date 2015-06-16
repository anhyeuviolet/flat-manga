<div class="well">
	Notice before grabbing from mangafox:<br />
	Mangafox is really hard to grab because they use page-by-page read type so grabbing 1 chapter from mangafox like 30 chapters in other one so when you grab, I highly recommend you grab one chapter at a time. Or try other available site to grab if you feel it not convenient.
</div>
<?
	include 'dom.php';
	if($_POST && $_GET[token] == $_SESSION[token] && $_GET[action] == 'grab_contents'){
	echo '<div class="well">';
	// blogtruyen
		$chapter_list = $_POST[chapter_list];
		$chapters = explode("http://", $chapter_list);
		array_shift($chapters);
		$last_chapter = 0;

		foreach($chapters as $chapter){
		$this_chapter = preg_replace('/(.*)(c)(.*)(\/)(.*)/is','$3','http://'.$chapter);
		if($this_chapter > $last_chapter){ $last_chapter = $this_chapter;}
		echo 'Chapter: '.$this_chapter.' grabbing<br />';
		
		$html = file_get_html(trim('http://'.$chapter));
		$img_full = NULL;
		$page_count = trim(preg_replace('/(.*)(of )(.*)(<\/div>)/is','$3',$html->find('div[class=l]',0)));
		$source_url = preg_replace('/(.*)\/(.*)(\.html)/is','$1','http://'.$chapter);
		for($i = 1; $i <= $page_count; $i++){
			$html = file_get_html(trim($source_url.'/'.$i.'.html'));
			$img = $html->find('img[id=image]');
			foreach($img as $element) 
			$img_full = $img_full.$element->src;
			$html->clear(); 
			unset($html);
		}
			   
		$resutl = mysql_query("INSERT INTO chapters (chapter, manga, trans_group, content, last_update) VALUES ('$this_chapter', '$_POST[manga]', '$_POST[trans_group]', '$img_full', NOW())")or die(mysql_error());  
		echo $this_chapter.' - Done<br/>';
			
		}
		$result_2 = mysql_query("UPDATE mangas SET last_update=NOW(), last_chapter = '$last_chapter' WHERE slug='$_POST[manga]'")or die(mysql_error());
		
	echo '</div>';
	}
?>
<div class="well">
  <form class="bs-example form-horizontal" method="POST" action="index.php?view=admin&sub_view=grab.mangafox&action=grab_links&token=<?=$_SESSION[token]?>">
  <fieldset>
	  <legend><?=$lang[Grab]?> - MangaFox - Step 1: Grab the chapters's links</legend>
	  <div class="form-group">
		<label class="col-lg-2 control-label">URL to the Manga Series</label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="url" placeholder="http://mangafox.me/manga/the_chronicle_of_seven/">
		  Paste the manga series you want to grab into the input field above to grabs all the chapters link
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
<?
	if($_POST && $_GET[token] == $_SESSION[token] && $_GET[action] == 'grab_links'){
		$url = $_POST[url];
		$html = file_get_html($url);
		foreach($html->find('ul[class=chlist]') as $element){
			   $link = $element->find('a[class=tips]');
			   foreach($link as $element) 
			   $img_full = $img_full.$element->href.'<br />';
		}
		echo '<h3>Manga\'s chapter come out, now copy the chapter links that you want to grab then use it for step 2</h3><div class="well" style="max-height: 500px; overflow-y: scroll;">'.$img_full.'</div>';
	}
?>
<div class="well">
  <form class="bs-example form-horizontal" method="POST" action="index.php?view=admin&sub_view=grab.mangafox&action=grab_contents&token=<?=$_SESSION[token]?>">
	<fieldset>
	  <legend><?=$lang[Grab]?> - Mangafox - Step 2: Grab the chapter content</legend>
	  <div class="form-group">
		<label class="col-lg-2 control-label">Chapters list</label>
		<div class="col-lg-10">
		  <textarea class="form-control" rows="5" name="chapter_list" placeholder="http://mangafox.me/manga/the_chronicle_of_seven/v01/c005/1.html"></textarea>
		  Paste the chapter's link you want to grab into the box above, don't use any separator like comma or space
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-lg-2 control-label">Manga to add:</label>
		<div class="col-lg-10">
		  <select class="form-control" name="manga">
		  <? $result = mysql_query("SELECT slug,name FROM mangas ORDER BY name")or die(mysql_error());
			 while($row = mysql_fetch_array($result)){
			 echo "<option value='$row[slug]'>$row[name]</option>";
		  } ?>
		  </select>
		</div>
	  </div>	  
	  <div class="form-group">
		<label class="col-lg-2 control-label">Translator group:</label>
		<div class="col-lg-10">
		  <select class="form-control" name="trans_group">
		  <? $result = mysql_query("SELECT id,name FROM groups ORDER BY name")or die(mysql_error());
			 while($row = mysql_fetch_array($result)){
			 echo "<option value='$row[id]'>$row[name]</option>";
		  } ?>
		  </select>
		</div>
	  </div>	  
	  <div class="form-group">
		<div class="col-lg-10 col-lg-offset-2"> 
		Check and make sure anything good then submit. You cannot undo but delete alot chapters.<br /><br />
		  <button type="submit" class="btn btn-primary"><?=$lang[Submit]?></button> 
		</div>
	  </div>
	</fieldset>
  </form>
</div>