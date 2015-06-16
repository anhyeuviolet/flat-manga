<? 
	include 'dom.php';
?>
<?
	if($_GET[action] == 'search_index' && $_GET[token] == $_SESSION[token]){
		include 'controllers/get.php';
		echo '<div class="alert alert-dismissable alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Well done!</strong> Searching index were updated.
            </div>';
	}
	if($_GET[action] == 'update_statics' && $_GET[token] == $_SESSION[token]){
		include 'controllers/statics.php';
		echo '<div class="alert alert-dismissable alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Well done!</strong> Statics were updated.
            </div>';
	}
?>
<div class="panel panel-primary">
  <div class="panel-heading">Welcome to flat mangas!</div>
  <div class="panel-body">
	You flat manga version: <b><?=$config[version]?></b> 
  </div>
</div>
<div class="row">
	<div class="col-lg-4">	
	<h3><?=$lang[To_do_list]?></h3>
	<div class="list-group">
		<a href="index.php?view=admin&sub_view=main&action=search_index&token=<?=$_SESSION[token]?>" class="list-group-item">
		  <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-search"></span> Update searching index</h4>
		  <p class="list-group-item-text">Update the searching index so user can search much faster, do this once after you add a new manga series.</p>
		</a>
		<a href="index.php?view=admin&sub_view=main&action=update_statics&token=<?=$_SESSION[token]?>" class="list-group-item">
		  <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-sort"></span> Update Statistics</h4>
		  <p class="list-group-item-text">Update the number of chapters, number of mangas, the views count.</p>
		</a>
	  </div>
	</div>
	<div class="col-lg-4">
	<h3><?=$lang[Manga]?></h3>
		  <ul class="list-group">
			  <li class="list-group-item active"><?=$lang[Manage_manga]?></li>
			  <li class="list-group-item"><a href="index.php?view=admin&sub_view=manga.add"><?=$lang[Add_new]?></a></li>
			  <li class="list-group-item"><a href="index.php?view=admin&sub_view=manga.list"><?=$lang[Edit_delete]?></a></li>
			  <li class="list-group-item active"><?=$lang[Grab]?></li>
			  <li class="list-group-item"><a href="index.php?view=admin&sub_view=grab.manga.vnsharing">(Vietnamese) VnSharing</a></li>
			  <li class="list-group-item"><a href="index.php?view=admin&sub_view=grab.manga.mangafox">(English) MangaFox</a></li>
		  </ul>	  
	</div>
	<div class="col-lg-4">
	<h3><?=$lang[Chapter]?></h3>
		  <ul class="list-group">
		      <li class="list-group-item active"><?=$lang[Manage_chapter]?></li>
			  <li class="list-group-item"><a href="index.php?view=admin&sub_view=chapter.list"><?=$lang[Add_new]?>/<?=$lang[Edit_delete]?></a></li>
			  <li class="list-group-item"><a href="#"><?=$lang[Grab]?> <?=$lang[Chapter]?></a></li>
		      <li class="list-group-item active"><?=$lang[Grab]?> <?=$lang[Chapter]?> <?=$lang[Vi]?></li>
			  <li class="list-group-item"><a href="index.php?view=admin&sub_view=grab.vnsharing">(Vietnamese) VNSharing</a></li>
			  <li class="list-group-item"><a href="index.php?view=admin&sub_view=grab.comicvn">(Vietnamese) Comicvn</a></li>
			  <li class="list-group-item"><a href="index.php?view=admin&sub_view=grab.blogtruyen">(Vietnamese) Blogtruyen</a></li>
			  <li class="list-group-item active"><?=$lang[Grab]?> <?=$lang[Chapter]?> <?=$lang[Eng]?></li>
			  <li class="list-group-item"><a href="index.php?view=admin&sub_view=grab.mangafox">(English) MangaFox</a></li>
			  <li class="list-group-item"><a href="index.php?view=admin&sub_view=grab.mangapark">(English) MangaPark</a></li>
		  </ul>	  
	</div>
</div>