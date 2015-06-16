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
		$this_chapter = preg_replace('/(.*)(chap-|chapter-|chuong-)(.*)(.*|-new)/is','$3',$chapter);
		if($this_chapter > $last_chapter){ $last_chapter = $this_chapter;}
		echo 'Chapter: '.$this_chapter;
		
		$url = 'http://'.$chapter;
		$html = file_get_html(trim($url));
		$img_full = NULL;
		foreach($html->find('article[id=content]') as $element){
			   $img = $element->find('img');
			   foreach($img as $element) 
			   $img_full = $img_full.$element->src;
		}
			   // echo $img_full;
			   $resutl = mysql_query("INSERT INTO chapters (chapter, manga, trans_group, content, last_update) VALUES ('$this_chapter', '$_POST[manga]', '$_POST[trans_group]', '$img_full', NOW())",
			   $connection)or die(mysql_error());  
				echo ' - Hoàn tất<br/>';
		}
		$result_2 = mysql_query("UPDATE mangas SET last_update=NOW(), last_chapter = '$last_chapter' WHERE slug='$_POST[manga]'")or die(mysql_error());
		$html->clear(); 
		unset($html);

	echo '</div>';
	}
?>
<div class="well">
  <form class="bs-example form-horizontal" method="POST" action="index.php?view=admin&sub_view=grab.blogtruyen&action=grab_links&token=<?=$_SESSION[token]?>">
  <fieldset>
	  <legend><?=$lang[Grab]?> - blogtruyen - Bước 1: Grab links của các tập</legend>
	  <div class="form-group">
		<label class="col-lg-2 control-label">URL của bộ truyện</label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="url" placeholder="http://blogtruyen.com/truyen/are-d">
		  Dán URL của bộ truyện vào để lấy link tập trong đó!
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
		foreach($html->find('div[class=list-wrap]') as $element){
			   $link = $element->find('.title a');
			   foreach($link as $element) 
			   $img_full = $img_full.'http://blogtruyen.com'.$element->href.'<br />';
		}
		echo '<h3>Danh sách tập đây rồi, copy xuống bước 2 và chiến thôi</h3><div class="well" style="max-height: 500px; overflow-y: scroll;">'.$img_full.'</div>';
	}
?>
<div class="well">
  <form class="bs-example form-horizontal" method="POST" action="index.php?view=admin&sub_view=grab.blogtruyen&action=grab_contents&token=<?=$_SESSION[token]?>">
	<fieldset>
	  <legend><?=$lang[Grab]?> - blogtruyen - Bước 2: Grab nội dung từng tập</legend>
	  <div class="form-group">
		<label class="col-lg-2 control-label">URL truyện</label>
		<div class="col-lg-10">
		  <textarea class="form-control" rows="5" name="chapter_list" placeholder="http://blogtruyen.com/truyen/are-d/chap-1-new"></textarea>
		  Dán những tập mà bạn muốn grab vào đây, có thể lấy link từ bước 1
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-lg-2 control-label">Grab vào:</label>
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
		<label class="col-lg-2 control-label">Nhóm dịch:</label>
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
		Hãy kiểm tra cẩn thận xem đã đúng cả chưa rồi Submit, nếu sai thì sẽ phải sửa rất nhiều<br /><br />
		  <button type="submit" class="btn btn-primary"><?=$lang[Submit]?></button> 
		</div>
	  </div>
	</fieldset>
  </form>
</div>