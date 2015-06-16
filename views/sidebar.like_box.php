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