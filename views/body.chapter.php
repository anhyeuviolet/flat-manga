<script>
    function FloatTopDiv()
    {
        startLX = ((document.body.clientWidth -MainContentW)/2)-LeftBannerW-LeftAdjust , startLY = TopAdjust+80;
        startRX = ((document.body.clientWidth -MainContentW)/2)+MainContentW+RightAdjust , startRY = TopAdjust+80;
        var d = document;
        function ml(id)
        {
            var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
            el.sP=function(x,y){this.style.left=x + 'px';this.style.top=y + 'px';};
            el.x = startRX;
            el.y = startRY;
            return el;
        }
        function m2(id)
        {
            var e2=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
            e2.sP=function(x,y){this.style.left=x + 'px';this.style.top=y + 'px';};
            e2.x = startLX;
            e2.y = startLY;
            return e2;
        }
        window.stayTopLeft=function()
        {
            if (document.documentElement && document.documentElement.scrollTop)
                var pY =  document.documentElement;
            else if (document.body)
                var pY =  document.body;
            if (document.body.scrollTop > 30){startLY = 3;startRY = 3;} else {startLY = TopAdjust;startRY = TopAdjust;};
            ftlObj.y += (pY+startRY-ftlObj.y)/16;
            ftlObj.sP(ftlObj.x, ftlObj.y);
            ftlObj2.y += (pY+startLY-ftlObj2.y)/16;
            ftlObj2.sP(ftlObj2.x, ftlObj2.y);
            setTimeout("stayTopLeft()", 1);
        }
        ftlObj = ml("divAdRight");
        //stayTopLeft();
        ftlObj2 = m2("divAdLeft");
        stayTopLeft();
    }
    function ShowAdDiv()
    {
        var objAdDivRight = document.getElementById("divAdRight");
        var objAdDivLeft = document.getElementById("divAdLeft");
        if (document.body.clientWidth < 1000)
        {
            objAdDivRight.style.display = "none";
            objAdDivLeft.style.display = "none";
        }
        else
        {
            objAdDivRight.style.display = "block";
            objAdDivLeft.style.display = "block";
            FloatTopDiv();
        }
    }
</script>
<script>
document.write("<script type='text/javascript' language='javascript'>MainContentW = 1000;LeftBannerW = 125;RightBannerW = 125;LeftAdjust = 5;RightAdjust = 5;TopAdjust = 10;ShowAdDiv();window.onresize=ShowAdDiv;;<\/script>");
</script>
 
</div>
<? 
if($chapter_cookie[$chapter_id] != '1'){
	mysql_query("UPDATE mangas SET views = views + 1 WHERE slug = '".$slug."'");
	mysql_query("UPDATE chapters SET views = views + 1 WHERE id = '".$chapter_id."'");
	setcookie("chapter_cookie[$chapter_id]", "1");
}
 ?>
<!-- Done view plus --> 
<? if($config[read_type] == '1'){ ?>
	<!-- WEBTOON -->
	<div class="chapter-content">
		<?
			$img = explode("http://", $chapter[content]);
			$imgs = count($img);
			$img_type = '1';
			if($imgs == '1'){ 
				$img = explode("uploads", $chapter[content]);
				$imgs = count($img);
				$img_type = '2';
			}	
			for($i = 1; $i < $imgs; $i++){
				echo "<img src='".($img_type == '1' ? 'http://' : 'uploads/').$img[$i]."' class='chapter-img'></br></br></br>";
			}
			include 'comment_box.php';
		?>
	</div>	
	<!-- END WEBTOON -->
<? }else if($config[read_type] == '2'){ ?>
	<!-- PAGE BY PAGE -->
	<div class="chapter-content">
		<?
			$img = explode("http://", $chapter[content]);
			$imgs = count($img);
			$img_type = '1';
			if($imgs == '1'){ 
				$img = explode("uploads", $chapter[content]);
				$imgs = count($img);
				$img_type = '2';
			}	
			page_select($img);
			$next_page = $page+1;
			if($next_page > $imgs){
				// Comment box :)
				include 'comment_box.php';
			}else{
				echo "<a href='$lang[read_slug]-$slug-$lang[chapter_slug]-$chapter[chapter]-$lang[page_slug]-$next_page.html'><img src='".($img_type == '1' ? 'http://' : 'uploads/').$img[$page]."' class='chapter-img'></a>";
			}
			echo '<br /><br />';
			page_select($img);
		?>
	</div>	
	<!-- END PAGE BY PAGE -->
<? }else if($config[read_type] == '3'){ ?>
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<?
				$img = explode("http://", $chapter[content]);
				$imgs = count($img);
				$img_type = '1';
				if($imgs == '1'){ 
					$img = explode("uploads", $chapter[content]);
					$imgs = count($img);
					$img_type = '2';
				}	
				for($i = 1; $i < $imgs; $i++){
					echo '<div class="swiper-slide white-slide">';
					echo "<img src='".($img_type == '1' ? 'http://' : 'uploads/').$img[$i]."' class='chapter-img chapter-img-touch'></br></br></br>";
					echo '</div>';
				}
				echo '<div class="swiper-slide white-slide">';
				include 'comment_box.php';
				echo '</div>';
			?>
		</div>
    <div class="chapter-pagination"></div>
	</div>
	<script>
	  var mySwiper = new Swiper('.swiper-container',{
		pagination: '.chapter-pagination',
		onTouchEnd: function(swiper){
						document.body.scrollTop = document.documentElement.scrollTop = 0;
					},
		paginationClickable: true,
		keyboardControl: true,
		onSlideClick: function(next_slide){
			mySwiper.swipeNext()
		},
	  })
	</script>	
<? } ?>
<div>