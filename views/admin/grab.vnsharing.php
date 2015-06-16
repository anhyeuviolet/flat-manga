<?
	include 'dom.php';
	if($_POST && $_GET[token] == $_SESSION[token]){
	echo '<div class="well">';
	// Vnsharing :)
		$url = $_POST[url];
		$url_type = $_POST[url_type];
	if($url_type == '4'){
		$html = file_get_html($url);
			foreach($html->find('div[id=divImage]') as $element){
				   $img = $element->find('img');
				   foreach($img as $element) 
				   $img_full = $img_full.$element->src;
			}	   
		 $resutl = mysql_query("INSERT INTO chapters (chapter, manga, trans_group, content, last_update) VALUES ('1', '$_POST[manga]', '$_POST[trans_group]', '$img_full', NOW())",
			   $connection)or die(mysql_error());  
				echo $url.$i.'/ Hoàn tất<br/>';	
	}
	echo '</div>';
	}
	
?>

<div class="well">
  <form class="bs-example form-horizontal" method="POST" action="index.php?view=admin&sub_view=grab.vnsharing&token=<?=$_SESSION[token]?>">
	<fieldset>
	  <legend><?=$lang[Grab]?> - VNsharing</legend>
	  <div class="form-group">
		<label class="col-lg-2 control-label">Kiểu URL</label>
		<div class="col-lg-10">
		  <select class="form-control" name="url_type">
		  <option value='4'>Oneshot</option>
		  </select>
		  Hiện tại VnSharing chỉ có thể grab được one-shot (truyện một tập), những truyện khác cũng có thể grab được nhưng kiểu link rất rắc rối và có thể gây lỗi lên hệ thống nên Flat truyện không sử dụng cho vnsharing. Các bạn có thể tìm truyện tương đương tại các site khác.
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-lg-2 control-label">URL truyện</label>
		<div class="col-lg-10">
		  <input type="text" class="form-control" name="url" placeholder="http://truyen.vnsharing.net/Truyen/xxx/...">
		  Dán url của một tập <b>ONESHOT</b> mà bạn muốn grab
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