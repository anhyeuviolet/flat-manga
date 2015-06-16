<div class="well">
	Mangapark grabbing notice:
	<br />Hello guys, there is a problem with some manga in mangapark that when you grab the chapters's link, there will be an error say that "Allowed memory size of.." or "Call to a member function find()", The cause is your memory limit cannot handle a large size of page (I downloaded one page from mangapark and it's about 3mb 0_0).
	<br />
	Solution (try more than one if it doesn't help):<br />
	1. If you have root access of your server, open php.ini and change this line "memory_limit = " to another bigger value.<br />
	2. Open .htaccess file and add this at the end <code>php_value memory_limit 100M</code> (100M or 64M, I think 64 is enough)<br />
	3. Open includes/config.php. Add this line some where <code>ini_set('memory_limit', '100M');</code> (Before ?&gt; tag) <br />
	4. Contact the hosting's technical for help so they can increase the memory for you.<br />
	5. Try another grab tool
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
		$this_chapter = trim(preg_replace('/(.*)(c)(.*)(\/)(.*)/is','$3','http://'.$chapter));
		if($this_chapter > $last_chapter){ $last_chapter = $this_chapter;}
		$this_chapter = preg_replace('/[^0-9_ -]/s', '', $this_chapter);
		echo 'Chapter: '.$this_chapter;
		
		$url = 'http://'.$chapter;
		$html = file_get_html(trim($url));
		$img_full = NULL;
		foreach($html->find('a[class=img-link]') as $element){
			   $img = $element->find('img');
			   foreach($img as $element) 
			   $img_full = $img_full.$element->src;
		}
		$html->clear();
		unset($html);
			   // echo $img_full;
			   $resutl = mysql_query("INSERT INTO chapters (chapter, manga, trans_group, content, last_update) VALUES ('$this_chapter', '$_POST[manga]', '$_POST[trans_group]', '$img_full', NOW())",
			   $connection)or die(mysql_error());  
				echo ' - Complete<br/>';
				
		}
			
		$result_2 = mysql_query("UPDATE mangas SET last_update=NOW(), last_chapter = '$last_chapter' WHERE slug='$_POST[manga]'")or die(mysql_error());
		
	echo '</div>';
	}
?>
<div class="well">
  <form class="bs-example form-horizontal" method="POST" action="index.php?view=admin&sub_view=grab.mangapark&action=grab_links&token=<?=$_SESSION[token]?>">
  <fieldset>
	  <legend><?=$lang[Grab]?> - MangaPark - Step 1: Grab the chapters's links</legend>
	  <div class="form-group">
		<label class="col-lg-2 control-label">URL to the Manga Series</label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="url" placeholder="http://www.mangapark.com/manga/Beelzebub">
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
		foreach($html->find('div[class=list]') as $element){
			   $link = $element->find('a');
			   foreach($link as $final_link){ 
				if(preg_match("/\/all/i", $final_link) && (!preg_match("/\/v[0-9]/i", $final_link))){
					$img_full = $img_full.'http://www.mangapark.com'.$final_link->href.'<br />';
				}
			   }
				if($img_full != NULL){ break; }
		}			
		$html->clear(); 
		unset($html);
		
		echo '<h3>Manga\'s chapter come out, now copy the chapter links that you want to grab then use it for step 2</h3><div class="well" style="max-height: 500px; overflow-y: scroll;">'.$img_full.'</div>';
	}
?>
<div class="well">
  <form class="bs-example form-horizontal" method="POST" action="index.php?view=admin&sub_view=grab.mangapark&action=grab_contents&token=<?=$_SESSION[token]?>">
	<fieldset>
	  <legend><?=$lang[Grab]?> - MangaPark - Step 2: Grab the chapter content</legend>
	  <div class="form-group">
		<label class="col-lg-2 control-label">Chapters list</label>
		<div class="col-lg-10">
		  <textarea class="form-control" rows="5" name="chapter_list" placeholder="http://www.mangapark.com/manga/197X/c13/1"></textarea>
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