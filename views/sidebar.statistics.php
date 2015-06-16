<div class="panel panel-primary">
  <div class="panel-heading">
	<h3 class="panel-title"><?=$lang[Statistics]?></h3>
  </div>
  <div>
	<?  $result = mysql_query("SELECT * FROM count LIMIT 1")or die(mysql_error());
		while($row = mysql_fetch_array($result)){ ?>
		  <ul class="list-group">
                <li class="list-group-item">
                  <span class="badge badge-success"><?=$row[mangas]?></span>
                  <?=$lang[Mangas]?>
                </li>
                <li class="list-group-item">
                  <span class="badge badge-danger"><?=$row[chapters]?></span>
                  <?=$lang[Chapters]?>
                </li>
                <li class="list-group-item">
                  <span class="badge badge-info"><?=$row[views]?></span>
                  <?=$lang[Views]?>
                </li>
              </ul>
	<? } ?>
  </div>
</div>
