<div id="footer">
	{{ getConfig('web_copyright') }}
</div>
<a id="scrollUp"></a>
<script type="text/javascript">
	jQuery(function($){
		$(window).scroll(function(){
			var scrollt = document.documentElement.scrollTop + document.body.scrollTop;
			if(scrollt >200){
				$("#scrollUp").fadeIn(400);
			}else{
				$("#scrollUp").stop().fadeOut(400);
			}
		});
		$("#scrollUp").click(function(){
			$("html,body").animate({scrollTop:"0px"},200);
		});
		$(document).pjax('a', 'body');
		$(document).on("pjax:timeout", function(event){
			event.preventDefault()
		});
		$(document).on('pjax:start', function() {
			NProgress.start();
		});
		$(document).on('pjax:end', function() {
			NProgress.done();
		});
	  });
  </script>