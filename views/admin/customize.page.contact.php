<?
	$filename = "views/body.contact.php";
	$handle = fopen($filename, "rb");
	$content_old = fread($handle, filesize($filename));
	// 	$content_old = addslashes($content_old);
	$content_old = preg_replace("/<\?include \'/", '!inclu:', $content_old);
	$content_old = preg_replace("/\.php\'\; \?>/", ':ed!', $content_old);
	fclose($handle);

	if($_POST && $_GET[token] == $_SESSION[token]){
	$content = $_POST[content];
	$content = preg_replace("/(!inclu:)/", '<\?include \'', $content);
	$content = preg_replace("/(:ed!)/", '.php\'; \?>', $content);
	$content = stripslashes($content);
	$string = ''.$content.'';
	$fp = fopen("views/body.contact.php", "w");
	fwrite($fp, $string);
	fclose($fp);
	redirect('index.php?view=admin&sub_view=customize.page.contact');
	
	}
?>
<div class="col-lg-12">
	<div class="well">
	  <form class="bs-example form-horizontal" method="POST" action="index.php?view=admin&sub_view=customize.page.contact&token=<?=$_SESSION[token]?>">
		<fieldset>
		  <legend><?=$lang[Customize];?> <?=$lang[Body]?></legend>
		  <div class="form-group">
			<label for="textArea" class="col-lg-2 control-label">Content</label>
			<div class="col-lg-8">
			  <textarea class="form-control" rows="8" id="textArea" name="content"><?=$content_old?></textarea>
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
  </div>
  
  	<script language="JavaScript"> 
	function addTo(string){
				document.getElementById('textArea').value += string;
			}
	</script>