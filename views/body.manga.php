
  <div class="row">
	<div class="col-lg-3 col-sm-4" style="top: -80px">
		<img class="thumbnail" width="100%" src="<?=$manga[cover]?>">
		<br />
		<? include 'body.manga.sidebar.php';?>
	</div>
	<div class="col-lg-9 col-sm-8">
	  <div class="page-header">
		  <h1 id="tables"><?=mb_strtoupper($manga[name], 'utf-8')?> <?=($manga[released] != NULL ? "($manga[released])" : '')?></h1>
		  <h4><?=$manga[other_name]?></h4>
	  </div>
	  <table class="table table-striped table-bordered table-hover">
		<tbody>
			<tr>
				<td><?=$lang[Authors]?></td>
				<td><?=$lang[Artists]?></td>
				<td><?=$lang[Genres]?></td>
			</tr>
			<tr>
				<td><?=split_authors($manga[authors])?></td>
				<td><?=split_artists($manga[artists])?></td>
				<td><?=split_genres($manga[genres])?></td>
			</tr>
		</tbody>
	  </table>	
	  <h3><?=$lang[Description]?></h3>
	  <p><?=$manga[description]?></p>
	  <h3><?=$lang[Chapters]?></h3>
	  <table class="table table-hover">
		<tbody>
	  <? $result = mysql_query("SELECT chapter, last_update, name FROM chapters WHERE manga = '$slug' ORDER BY chapter DESC")or die(mysql_error());
			while($row = mysql_fetch_array($result))
			  {   
	  ?>	
			<tr>
				<td><a href='<?=gen_url($slug,$row[chapter])?>'><b><?=$manga[name]?> <?=$row[chapter]?></b> - <?=$row[name]?></a></td>
				<td><?=date( 'd-m-Y',strtotime($row[last_update]))?></td>
			</tr>
	  <? } ?>		
		</tbody>
	  </table>
	</div>
  </div>