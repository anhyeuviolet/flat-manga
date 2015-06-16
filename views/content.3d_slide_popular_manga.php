<h1><?=$config[most_popular]?> most popular mangas</h1>
<div class="swiper-container">
		<div class="swiper-wrapper">	
		<?	$result = mysql_query("SELECT name,slug,cover FROM mangas ORDER BY views DESC LIMIT $config[most_popular] ");
			while($row = mysql_fetch_array($result)){ ?>
			<div class="swiper-slide" style="background-image:url(<?=$row[cover]?>)">
				<a href="<?=$lang[manga_slug]?>-<?=$row[slug]?>.html" target="_blank" title="<?=$row[name]?>"></a>
			</div>';
		<?}?>	
		</div>
	</div>
	<script>
	var mySwiper = new Swiper('.swiper-container',{
		slidesPerView:3,
		loop:true,
		mousewheelControl: true,
		//Enable 3D Flow
		tdFlow: {
			rotate : 30,
			stretch :10,
			depth: 250,
			modifier : 1,
			shadows:true
		}
	})
	</script>