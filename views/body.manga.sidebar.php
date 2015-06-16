<div class="panel panel-primary">
  <div class="panel-heading">
	<h3 class="panel-title">Like and share</h3>
  </div>
  <div class="panel-body"><div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=468770583220176";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<div class="fb-like" data-href="<?= curPageURL() ?>" data-width="450" data-layout="button_count" data-show-faces="false" data-send="true"></div>
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
	<g:plusone></g:plusone>
  </div>
</div>
