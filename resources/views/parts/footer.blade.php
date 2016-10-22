<div id="footer">
	{{ getConfig('web_copyright') }}
</div>
<a id="scrollUp"></a>
<link rel="stylesheet" href="{{ asset('css/fancybox.css') }}" rel="stylesheet" />
<script type="text/javascript" src="{{ asset('js/jquery.fancybox-1.3.1.pack.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.masonry.min.js') }}"></script>
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

		  var $container = $('.picture_wall');
		  $container.imagesLoaded(function(){
			  $container.masonry({
				  itemSelector: '.picture_wall_list',
				  columnWidth: 5 //每两列之间的间隙为5像素
			  });
		  });

		  $("a[rel=group]").fancybox({
			  'transitionIn'	: 'elastic',
			  'transitionOut'	: 'elastic',
			  'titlePosition' : 'inside'
		  });
	  });
  </script>