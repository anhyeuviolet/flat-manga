<?
	ob_start();
	session_start();
	include 'includes/config.php';
	include 'controllers/controller.main.php'; 
	if(!isset($_POST)){
		$_SESSION[token] = md5(rand(time (), true)) ;
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
  <head>
    <title><?=$config[title_display]?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
	<link rel="icon" href="/favicon.png" type="image/vnd.microsoft.icon" />
    <link rel="shortcut icon" href="/favicon.png" type="image/vnd.microsoft.icon" />
    <link rel="stylesheet" href="assets/css/<?=$config[theme]?>.css" media="screen">
	<link rel="stylesheet" type="text/css" media="screen" href="assets/css/custom.css" />
    <link rel="stylesheet" href="assets/css/base.css" media="screen">
	<?=($view == 'chapter' ? '<link rel="stylesheet" href="assets/css/chapter.css" media="screen">' : '')?> 
    <link rel="stylesheet" href="assets/css/idangerous.swiper.css" media="screen">

    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/idangerous.swiper-2.1.min.js"></script>
	<script type="text/javascript" src="assets/js/ajax-search-suggest.js"></script>
	<script src="assets/js/jquery.form.js"></script>
		
	<? if($view != 'chapter'){?>
	<link rel="stylesheet" href="assets/css/idangerous.swiper.css">
	<link rel="stylesheet" href="assets/css/idangerous.swiper.scrollbar.css">
	<link rel="stylesheet" href="assets/css/idangerous.swiper.3dflow.css">
	<script src="assets/js/idangerous.swiper.3dflow-2.0.js"></script>
	<style>
		.swiper-container {
			padding:30px 0;
			width: 100%;
		}
		.swiper-slide {
			width:auto;
			height:350px;	
			background-size:cover;
			background-repeat:no-repeat;
			background-position:center;
			border-radius:5px;
			border-bottom:1px solid #555;
		  -webkit-box-reflect: below 1px -webkit-linear-gradient(bottom, rgba(0,0,0,0.5) 0px, rgba(0,0,0,0) 20px);
			
		}
		.swiper-slide a {
			position:absolute;
			left:0;
			bottom:0;
			width:100%;
			height:100%;
			z-index:1
		}
	</style>
	<?}?>
<script type="text/javascript">
function fill(Value)
{
$('#name').val(Value);
$('#display').hide();
}

$(document).ready(function(){
$("#name").keyup(function() {
var name = $('#name').val();
if(name=="")
{
$("#display").html("");
}
else
{
$.ajax({
type: "POST",
url: "includes/search.php",
data: "name="+ name ,
success: function(html){
$("#display").html(html).show();
}
});
}
});
});
</script>
  </head>
  <body>
  
	<? ($view == 'chapter' ? '' : include 'views/header.php') ?>
	
	<? ($view == 'chapter' ? include 'views/navbar.manga.php' : include 'views/navbar.php') ?>

    <div class="container">

      <? include 'views/body.'.$view.'.php'; ?>


      <? ($view == 'chapter' ? '' : include 'views/footer.php') ?>
    

    </div>
	<div id="fb-root"></div>
	<script src="http://connect.facebook.net/vi_VN/all.js"></script>
	<script>
	  FB.init({appId: '391157441015774', status: true,
	           cookie: true, xfbml: true});
	  FB.Event.subscribe('auth.login', function(response) {
	    window.location.reload();
	  });
	window.fbAsyncInit = function() {
	    FB.Event.subscribe('edge.create', function(href, widget) {
	    	$('#cil_like').empty();
	   	document.cookie="ztruyen_fb_like=1; expires=0; path=/";
	
	    });
	    FB.Event.subscribe('edge.remove', function(href, widget) {
		document.cookie="ztruyen_fb_like=-1; expires=0; path=/";
	    });
	};
	</script>
  </body>
</html>