<? 
	if($_GET[out] == '1' && $_GET[token] == $_SESSION[token]){
			$_SESSION[admin] = 0;
			redirect('admin.html');
	}	
	if(!isAdmin()){ 
		echo '<form method="POST" action="#">';
		echo	'<input type="hidden" name="action" value="admin_login">';
		echo	'<div class="form-group has-success">';
        echo    '<label class="control-label" for="inputSuccess">'.$lang[Input_pw].'</label>';
        echo         '<input type="password" class="form-control" name="pw" id="inputSuccess">';
        echo    '</div>';
		echo	'<input type="submit" style="visibility: hidden;">';
		echo '</form>';
		if($_POST[pw] == $config[admin_pw]){
			$_SESSION[admin] = 1;
			redirect('admin.html');
		}
	}else{	
?>
	<div class="navbar navbar-default">
		<div class="container">
		  <div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Hi, Admin</a>
		  </div>
		  <div class="navbar-collapse collapse navbar-responsive-collapse">
			<ul class="nav navbar-nav">
			  <li class="active"><a href="admin.html"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;<?=$lang[Dashboard_home];?></a></li>
			  <li><a href="index.php?view=admin&sub_view=setting"><?=$lang[General_Settings];?></a></li>
			  <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$lang[Customize]?> <b class="caret"></b></a>
				<ul class="dropdown-menu">
				  <li><a href="index.php?view=admin&sub_view=customize.header"><?=$lang[header]?></a></li>
				  <li><a href="index.php?view=admin&sub_view=customize.home.content"><?=$lang[home_content]?></a></li>
				  <li><a href="index.php?view=admin&sub_view=customize.home.sidebar"><?=$lang[home_sidebar]?></a></li>
				  <li><a href="index.php?view=admin&sub_view=customize.footer"><?=$lang[footer]?></a></li>
				  <li class="divider"></li>
				  <li class="dropdown-header"><?=$lang[Pages]?></li>
				  <li><a href="index.php?view=admin&sub_view=customize.page.contact"><?=$lang[Contact_Us]?></a></li>
				  <li class="divider"></li>
				  <li class="dropdown-header">Widget</li>
				  <li><a href="index.php?view=admin&sub_view=customize.widget.likebox"><?=$lang[widget_likebox]?></a></li>
				</ul>
			  </li>
			  <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$lang[Manga]?> <b class="caret"></b></a>
				<ul class="dropdown-menu">
				  <li><a href="index.php?view=admin&sub_view=manga.add"><?=$lang[Add_new]?></a></li>
				  <li><a href="index.php?view=admin&sub_view=manga.list"><?=$lang[Edit_delete]?></a></li>
				  <li class="divider"></li>
				  <li class="dropdown-header"><?=$lang[Grab]?> <?=$lang[Manga]?></li>
				  <li><a href="index.php?view=admin&sub_view=grab.manga.vnsharing">(Vietnamese) VnSharing</a></li>
				  <li><a href="index.php?view=admin&sub_view=grab.manga.mangafox">(English) MangaFox</a></li>
				</ul>
			  </li>
			  <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$lang[Chapter]?> <b class="caret"></b></a>
				<ul class="dropdown-menu">
				  <li><a href="index.php?view=admin&sub_view=chapter.list"><?=$lang[Add_new]?>/<?=$lang[Edit_delete]?></a></li>
				  <li class="divider"></li>
				  <li class="dropdown-header"><?=$lang[Grab]?> <?=$lang[Chapter]?> <?=$lang[Vi]?></li>
				  <li><a href="index.php?view=admin&sub_view=grab.vnsharing">(Vietnamese) VNSharing</a></li>
				  <li><a href="index.php?view=admin&sub_view=grab.comicvn">(Vietnamese) Comicvn</a></li>
				  <li><a href="index.php?view=admin&sub_view=grab.blogtruyen">(Vietnamese) Blogtruyen</a></li>
				  <li class="dropdown-header"><?=$lang[Grab]?> <?=$lang[Chapter]?> <?=$lang[Eng]?></li>
				  <li><a href="index.php?view=admin&sub_view=grab.mangafox">(English) MangaFox</a></li>
				  <li><a href="index.php?view=admin&sub_view=grab.mangapark">(English) MangaPark</a></li>
				</ul>
			  </li>
			  <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$lang[Group]?> <b class="caret"></b></a>
				<ul class="dropdown-menu">
				  <li><a href="index.php?view=admin&sub_view=group.add"><?=$lang[Add_new]?></a></li>
				  <li><a href="index.php?view=admin&sub_view=group.list"><?=$lang[Edit_delete]?></a></li>
				</ul>
			  </li>			  
			</ul>
			<ul class="nav navbar-nav navbar-right">
			  <li><a href="index.php?view=admin&out=1&token=<?=$_SESSION[token]?>"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;<?=$lang[Log_out]?></a></li>
			</ul>
		  </div><!-- /.nav-collapse -->
		</div><!-- /.container -->
	  </div>
	  <div class="row">
		<div class="col-lg-12">
		<? include 'admin/'.$_GET[sub_view].'.php'; ?>
		</div>
	  </div>
<? } ?>