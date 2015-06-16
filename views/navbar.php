<div class="navbar navbar-inverse navbar-fixed-top navbar-responsive-collapse">
  <div class="container">
	<div class="navbar-header">
	  <a href="index.html" class="navbar-brand"><?=$config[title]?></a>
	  <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	</div>
	<div class="navbar-collapse collapse" id="navbar-main">
	  <ul class="nav navbar-nav">
		<li class="active"><a href="<?=$lang[list_slug]?>.html"><span class="glyphicon glyphicon-align-justify"></span>&nbsp;&nbsp;<?=$lang[Manga_List]?></a></li>
		<li><a href="contact.html"><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;<?=$lang[Contact_Us]?></a></li>
		<? if(isAdmin()){?><li><a href="admin.html"><span class="glyphicon glyphicon-cutlery"></span>&nbsp;&nbsp;<?=$lang[Admin_CP]?></a></li><?}?>
	  </ul>

	  <ul class="nav navbar-nav navbar-right">
	  	  <div id="search">
<?php
$val='';
if(isset($_POST['submit']))
{
if(!empty($_POST['name']))
{
$val=$_POST['name'];
}
else
{
$val='';
}
}
?>
<form >
Search : <input type="text" name="name" id="name" autocomplete="off"
value="<?php echo $val;?>">
</form>

<div id="display"></div>
</div>

	  </ul>

	</div>
  </div>
</div>