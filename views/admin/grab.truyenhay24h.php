<?
	include 'dom.php';
	if($_POST && $_GET[token] == $_SESSION[token]){
	echo '<div class="well">';
	// Truyen hay 24h :)
		$url = $_POST[url];
		$url = preg_replace('/(.*)(Chuong-)(.*)(.html)/is','$1$2',$url);
		$result_2 = mysql_query("UPDATE mangas SET last_update=NOW(), last_chapter = '$_POST[to]' WHERE slug='$_POST[manga]'")or die(mysql_error());

		for($i = $_POST[from]; $i <= $_POST[to]; $i++){
		// Create DOM from URL or file
		$html = file_get_html($url.$i.'.html');
		echo $url.$i.'.html';
		// Find all images 
		$img_full = NULL;
		foreach($html->find('div[class=content_chap]') as $element){
			   $img = $element->find('img');
			   foreach($img as $element) 
			   $img_full = $img_full.$element->src;
		}
			   // echo $img_full;
			   $resutl = mysql_query("INSERT INTO chapters (chapter, manga, trans_group, content, last_update) VALUES ('$i', '$_POST[manga]', '$_POST[trans_group]', '$img_full', NOW())",
			   $connection)or die(mysql_error());  
				echo $url.$i.'.html Hoàn tất<br/>';
		}
	echo '</div>';
	}
	
?>

<div class="well">
  <form class="bs-example form-horizontal" method="POST" action="index.php?view=admin&sub_view=grab.truyenhay24h&token=<?=$_SESSION[token]?>">
	<fieldset>
	  <legend><?=$lang[Grab]?> - Truyenhay24h.com</legend>
	  <div class="form-group">
		<label class="col-lg-2 control-label">URL truyện</label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="url" placeholder="http://truyenhay24h.com/Doc-truyen/m1385/120/Chuong-58.html">
		  Dán url của một tập bất kì trong bộ truyện bạn muốn grab
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
		<label class="col-lg-2 control-label">Grab từ tập:</label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="from" placeholder="1">
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-lg-2 control-label">Đến tập</label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="to" placeholder="x">
		  Chọn khoảng tập muốn grab (ví dụ từ tập 1 đến tập 100), nếu xảy ra lỗi khi grab, hãy thử với khoảng tập ngắn hơn
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