  <div class="row">
	<div class="col-lg-9">
	  
	  <ul class="pagination pagination-sm">
		<li><a href="#A">A</a></li> <li><a href="#B">B</a></li> <li><a href="#C">C</a></li> <li><a href="#D">D</a></li> <li><a href="#Đ">Đ</a></li> <li><a href="#E">E</a></li> <li><a href="#F">F</a></li> <li><a href="#G">G</a></li> <li><a href="#H">H</a> 
			<a href="#I">I</a></li> <li><a href="#J">J</a></li> <li><a href="#K">K</a></li> <li><a href="#L">L</a></li> <li><a href="#M">M</a></li> <li><a href="#N">N</a></li> <li><a href="#O">O</a></li> <li><a href="#p">P</a></li> <li><a href="#Q">Q</a>
			<a href="#R">R</a></li> <li><a href="#S">S</a></li> <li><a href="#T">T</a></li> <li><a href="#U">U</a></li> <li><a href="#V">V</a></li> <li><a href="#W">W</a></li> <li><a href="#X">X</a></li> <li><a href="#Y">Y</a></li> <li><a href="#Z">Z</a></li>  
	  </ul>
	  
	  <table class="table table-condensed">
		<tbody>
	<?  if($_GET[status]){ 
			$status = $_GET[status];
			$result = mysql_query("SELECT name,slug,last_update,last_chapter,m_status FROM mangas WHERE m_status = '$status' ORDER BY name DESC");
		}else if($_GET[author]){
			$author = str_replace("-", " ", $_GET[author]);
			$result = mysql_query("SELECT name,slug,last_update,last_chapter,m_status FROM mangas WHERE authors LIKE '%$author%' ORDER BY name DESC")or die(mysql_error());
		}else if($_GET[artist]){
			$artist = str_replace("-", " ", $_GET[artist]);
			$result = mysql_query("SELECT name,slug,last_update,last_chapter,m_status FROM mangas WHERE artists LIKE '%$artist%' ORDER BY name DESC")or die(mysql_error());
		}else if($_GET[fill] == 'genre'){
			$genre = $_GET[genre];
			$result = mysql_query("SELECT name,slug,last_update,last_chapter,m_status FROM mangas WHERE genres LIKE '%$genre%' ORDER BY name DESC")or die(mysql_error());
		}else{
			$result = mysql_query("SELECT name,slug,last_update,last_chapter,m_status FROM mangas ORDER BY name DESC");
		}
		$f_letter = "A";
		while($row = mysql_fetch_array($result)){
		if(mb_substr($row[name],0,1,'UTF-8') != $f_letter){ $f_letter = mb_substr($row[name],0,1,'UTF-8'); ?>
		<tr>
		  <td colspan="3"><h3><a id="<?=$f_letter?>"><?=$f_letter?></a></h3></td>
		</tr>
		<tr>
		  <th><?=$lang[Manga]?></th>
		  <th><?=$lang[Last_chapter]?></th>
		  <th></th>
		</tr>
	<?	}	?>
		<tr>
		  <td><a href="<?=$lang[manga_slug]?>-<?=$row[slug]?>.html"><?=$row['name']?></a></td>
		  <td><?=$row['last_chapter']?></td>
		  <td><?=($row[m_status] == '1' ? ago(strtotime($row['last_update'])) : status($row[tinhtrang]))?></td>
		</tr>
	<?  }   ?>
		
		</tbody>
	  </table>
	  
	</div>
	<div class="col-lg-3">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title"><?=$lang[List_by_status]?></h3>
		</div>
		<div class="list-group">
			<a href="<?=$lang[list_slug]?>.html" class="list-group-item"><?=$lang[All]?></a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[completed_slug]?>.html" class="list-group-item"><?=$lang[Completed]?></a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[on_going_slug]?>.html" class="list-group-item"><?=$lang[On_going]?></a> 
		</div>
	</div>	
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title"><?=$lang[List_by_genre]?></h3>
		</div>
		<div class="list-group">
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-action.html" class="list-group-item">Action</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-adult.html" class="list-group-item">Adult</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-anime.html" class="list-group-item">Anime</a> 
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-comedy.html" class="list-group-item">Comedy</a> 
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-comic.html" class="list-group-item">Comic</a> 
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-doujinshi.html" class="list-group-item">Doujinshi</a> 
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-drama.html" class="list-group-item">Drama</a> 
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-ecchi.html" class="list-group-item">Ecchi</a> 
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-fantasy.html" class="list-group-item">Fantasy</a> 
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-gender bender.html" class="list-group-item">Gender Bender</a> 
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-harem.html" class="list-group-item">Harem</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-historical.html" class="list-group-item">Historical</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-horror.html" class="list-group-item">Horror</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-josei.html" class="list-group-item">Josei</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-live action.html" class="list-group-item">Live action</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-manhua.html" class="list-group-item">Manhua</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-manhwa.html" class="list-group-item">Manhwa</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-martial art.html" class="list-group-item">Martial Art</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-mature.html" class="list-group-item">Mature</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-mecha.html" class="list-group-item">Mecha</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-mystery.html" class="list-group-item">Mystery</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-one shot.html" class="list-group-item">One shot</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-psychological.html" class="list-group-item">Psychological</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-romance.html" class="list-group-item">Romance</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-school life.html" class="list-group-item">School Life</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-sci-fi.html" class="list-group-item">Sci-fi</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-seinen.html" class="list-group-item">Seinen</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-shoujo.html" class="list-group-item">Shoujo</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-shoujou ai.html" class="list-group-item">Shojou Ai</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-shounen.html" class="list-group-item">Shounen</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-shounen ai.html" class="list-group-item">Shounen Ai</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-slice of life.html" class="list-group-item">Slice of Life</a> 
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-smut.html" class="list-group-item">Smut</a> 
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-sports.html" class="list-group-item">Sports</a> 
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-supernatural.html" class="list-group-item">Supernatural</a> 
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-tragedy.html" class="list-group-item">Tragedy</a>
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-adventure.html" class="list-group-item">Adventure</a> 
			<a href="<?=$lang[list_slug]?>-<?=$lang[genre_slug]?>-yaoi.html" class="list-group-item">Yaoi</a>
            </div>
		</div>	
		
		<? include 'body.sidebar.php';?>
	</div><!--/span-->
  </div>