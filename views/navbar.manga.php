<div class="navbar navbar-inverse navbar-responsive-collapse">
  <div class="container">
	<div class="navbar-header">
	  <a href="manga-<?=$slug?>.html" class="navbar-brand"><?=$manga[name]?></a>
	  <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	</div>
	<div class="navbar-collapse collapse" id="navbar-main">
	  <ul class="nav navbar-nav">
		<li class="active"><a href="index.html"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;<?=$lang[Back_to_home]?></a></li>
		<? if($config[read_type_choose] == '1'){ ?>
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$lang[Reading_type]?>&nbsp;&nbsp;<b class="caret"></b></a>
			<ul class="dropdown-menu">
			  <li><a href="<?=gen_url($slug,$chapter[chapter],'1')?>"><?=$lang[Webtoon]?></a></li>
			  <li><a href="<?=gen_url($slug,$chapter[chapter],'2')?>"><?=$lang[Page_by_page]?></a></li>
			  <li><a href="<?=gen_url($slug,$chapter[chapter],'3')?>"><?=$lang[Page_by_page_touch]?></a></li>
			</ul>
		</li>
		<? } ?>
	  </ul>

	  <ul class="nav navbar-nav navbar-right-1">
		<li>
			<?=(check_chapter($slug,$prev_chap) ? "<a href='".gen_url($slug,$prev_chap)."'><span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;$lang[Previous_chapter]</a>" : '')?>
		</li>
		<li>
			<form class="navbar-form">
				<? chapter_select(); ?>
			</form>
		</li>
		<li>
			<?=(check_chapter($slug,$next_chap) ? "<a href='".gen_url($slug,$next_chap)."'>$lang[Next_chapter]&nbsp;&nbsp;<span class='glyphicon glyphicon-chevron-right'></span></a>" : '')?>
		</li>
	  </ul>

	</div>
  </div>
</div>