<h4><?=$lang[Most_popular_manga]?></h4>
<div id="carousel-example-generic" class="carousel slide">
  <!-- Indicators -->
  <ol class="carousel-indicators">
  <?  $result = mysql_query("SELECT name,slug,last_chapter,cover FROM mangas ORDER BY views DESC LIMIT $config[most_popular]")or die(mysql_error());
	  $index = 0;
	  while($row = mysql_fetch_array($result)){ ?>
		<li data-target="#carousel-example-generic" data-slide-to="<?=$index?>" <?=($index == 0 ? 'class="active"' : '')?>></li>
  <?  $index += 1;} ?>	
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner thumbnail">
  <?  $result = mysql_query("SELECT name,slug,last_chapter,cover FROM mangas ORDER BY views DESC LIMIT $config[most_popular]")or die(mysql_error());
	  $index = 0;
	  while($row = mysql_fetch_array($result)){ ?>
	<div class="item <?=($index == 0 ? 'active' : '')?>">
      <a href='<?=$lang[manga_slug]?>-<?=$row[slug]?>.html'><img src="<?=$row[cover]?>" alt="<?=$row[name]?>" width="100%"></a>
      <div class="carousel-caption">
        <span><h4 style="background-color: rgba(0, 0, 0, 0.4); display:inline-block"><?=$row[name]?></h4></span>
      </div>
    </div>
  <?  $index += 1;} ?>	
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
    <span class="icon-prev"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
    <span class="icon-next"></span>
  </a>
</div><br /><br />