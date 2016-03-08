<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
	<title>{{trans('pages.name')}}</title>

	<link rel="shortcut icon" href="/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="/css/loader.css"/>
	<link rel="stylesheet" type="text/css" href="/css/slider.css"/>
	<link rel="stylesheet" type="text/css" href="/css/testimonials.css"/>
	<link rel="stylesheet" type="text/css" href="/css/page-nav.css"/>
	<link rel="stylesheet" type="text/css" href="/css/galleries.css"/>
	<link rel="stylesheet" type="text/css" href="/css/images.css"/>
	<link rel="stylesheet" type="text/css" href="/css/portfolio.css"/>
	<link rel="stylesheet" type="text/css" href="/css/alert-boxes.css"/>
	<link rel="stylesheet" type="text/css" href="/css/animations.css"/>
	<link rel="stylesheet" type="text/css" href="/3dParty/colorbox/colorbox.css"/>
	<link rel="stylesheet" type="text/css" href="/3dParty/rs-plugin/css/pi.settings.css"/>
	<link rel="stylesheet" type="text/css" href="/css/boxes.css"/>
	<link rel="stylesheet" type="text/css" href="/css/pricing-tables.css"/>

	<script type="text/javascript" src="/js/instafeed.min.js"></script>



	<!--Fonts-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;subset=latin,cyrillic'
		  rel='stylesheet' type='text/css'>

	<!--Fonts with Icons-->
	<link rel="stylesheet" href="/3dParty/fontello/css/fontello.css"/>

	<!--[if lte IE 8]>
	<script src="/scripts/respond.min.js"></script>
	<![endif]-->

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '318129194920279',
      xfbml      : true,
      version    : 'v2.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>




<!--[if lte IE 6]>
<link rel="stylesheet" href="../ie6.css" type="text/css" media="screen" charset="utf-8" />
<![endif]-->





</head>

<?
		Session::put('google', false);
?>


<body>

@yield('content')

<div id="pi-all">



<!-- Copyright area -->
<div class="pi-section-w pi-section-header-w pi-section-dark pi-border-top-light pi-border-bottom-strong-base pi-section-header-lg-w">
	<div class="pi-section pi-section-header pi-section-header-lg pi-center-text-2xs pi-clearfix">

		<!-- Social icons -->
		<div class="pi-header-block pi-pull-right pi-hidden-2xs">
			<ul class="pi-social-icons-simple pi-small clearFix">
				<li><a href="http://www.facebook.com/virasorovirtual" class="pi-social-icon-facebook"><i class="icon-facebook"></i></a></li>
				<li><a href="http://www.twitter.com/virasorovirtual" class="pi-social-icon-twitter"><i class="icon-twitter"></i></a></li>
				<li><a href="http://instagram.com/virasorovvirtual" class="pi-social-icon-instagram"><i class="icon-instagram"></i></a></li>
				<li><a href="https://www.youtube.com/channel/UC67T0JQjkpXiMrITmPQufAA" class="pi-social-icon-tumblr"><i class="icon-youtube-play"></i></a></li>
				<li><a href="https://plus.google.com/100582678678073940290/about" class="pi-social-icon-gplus"><i class="icon-gplus"></i></a></li>
				<li><a href="/rss" class="pi-social-icon-rss"><i class="icon-rss"></i></a></li>
			</ul>
		</div>
		<!-- End social icons -->

		<!-- Footer logo -->
		<div class="pi-header-block pi-header-block-logo pi-header-block-bordered"><a href="/"><img src="/img/logo-base.png" alt=""></a></div>
		<!-- End footer logo -->

		<!-- Text -->
		<span class="pi-header-block pi-header-block-txt pi-hidden-xs">&copy; 2014. &laquo;<a href="http://www.codexcontrol.com">Codex S.A.</a>&raquo;.
			Todos los derechos reservados.
		</span>
		<!-- End text -->

	</div>
</div>

<!-- End copyright area -->
<!-- End footer -->

</div>


<script src="/3dParty/jquery.meerkat.1.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="http://api.html5media.info/1.1.6/html5media.min.js"></script>
<script src="/3dParty/jquery-1.11.0.min.js"></script>
<script src="/scripts/pi.helpers.js"></script>
<script src="/scripts/pi.boundManager.js"></script>
<script src="/scripts/pi.imagesLoader.js"></script>
<script src="/scripts/pi.columnFix.js"></script>
<script src="/scripts/pi.init.caption.js"></script>
<script src="/3dParty/FitVids.js/jquery.fitvids.js"></script>
<script src="/scripts/pi.init.fitvids.js"></script>
<script src="/scripts/pi.slider.js"></script>
<script src="/scripts/pi.init.slider.js"></script>
<script src="/3dParty/isotope/isotope.js"></script>
<script src="/scripts/pi.init.isotope.js"></script>
<script src="/scripts/pi.init.social.js"></script>
<script src="/scripts/pi.ddMenu.js"></script>
<script src="/scripts/pi.init.removeLastElMargin.js"></script>
<script src="/scripts/pi.fixedHeader.js"></script>
<script src="/scripts/pi.mobileMenu.js"></script>
<script src="/scripts/pi.init.submitFormFooter.js"></script>
<script src="/scripts/pi.detectTransition.js"></script>
<script src="/scripts/pi.alert.js"></script>
<script src="/scripts/pi.init.formsBlurClasses.js"></script>
<script src="/scripts/pi.init.placeholder.js"></script>
<script src="/3dParty/colorbox/jquery.colorbox-min.js"></script>
<script src="/scripts/pi.init.colorbox.js"></script>
<script src="/3dParty/jquery.easing.1.3.js"></script>
<script src="/3dParty/jquery.scrollTo.min.js"></script>
<script src="/scripts/pi.init.jqueryScrollTo.js"></script>
<script src="/scripts/pi.scrollTopArrow.js"></script>
<script src="/3dParty/tweetie/tweetie.min.js"></script>
<script src="/scripts/pi.init.tweetie.js"></script>


<script src="/scripts/pi.parallax.js"></script>
<script src="/scripts/pi.init.parallax.js"></script>
<script src="/3dParty/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script src="/3dParty/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="/scripts/pi.init.revolutionSlider.js"></script>



		<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-137439-1', 'auto');
		ga('send', 'pageview');

		</script>



</body>
</html>
