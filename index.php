<?php
session_start();
//DEV ONLY  error_reporting(E_ALL);
  error_reporting(0);
//main includes
	// config, constants, ajax_config
include_once('includes/main.php');
if(isset($_POST['c']) && isset($_POST['m']) && $_POST['data_only']==true){

	$_data = $_POST;
	${'controller'} = $_POST['c'];
	${'m'} = $_POST['m'];
	$c = new $controller();
	$res = call_user_func( array( $c, $m ),$_data );

	return($res);
}
?>
	<head>
		<title>jppa Tickets</title>
		<!-- CULL THESE OUT -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title id="title">&nbsp;</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
 		<link rel="apple-touch-icon" href="./apple-touch-icon.png">
		<script src='./js/jquery-1.11.2.min.js'></script>
		<!-- =====================   -->
		<link rel='stylesheet' type='text/css' href='./css/style.css'>
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/bootstrap-theme.min.css">
		<style>
			body {
				padding-top: 50px;
				padding-bottom: 20px;
			}
		</style>

		<link rel="stylesheet" href="./css/main.css">
		<link href="./css/animate.css" rel="stylesheet">
		<script>
			window.jQuery || document.write('<script src="./js/vendor/jquery-1.11.2.min.js"><\/script>')
		</script>
		<script src='./js/ajax.js'></script>
		<script src='./js/jquery-ui.js'></script>
		<script src='./js/config.js'></script>
		<script src='./js/paginator.js'></script>
		<script src="./js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
		<!--
			TRY NOT TO LOAD FILES TWICE.... -->
			<script src="./js/fastclick.js"></script>
		<script src="./js/hammer.js"></script>
		<script>
			 var current_page = localStorage.getItem('current_page');
		</script>
<?php

if(isset($_POST['c']) && isset($_POST['m'])){

	$_data = $_POST;
	${'controller'} = $_POST['c'];
	${'m'} = $_POST['m'];
	$c = new $controller();
	$res = call_user_func( array( $c, $m ),$_data );

	echo($res);
}else if(isset($_GET['c']) && isset($_GET['m'])){
	$_data = $_GET;
	echo("<script>var controller = '".$_GET['c']."' ;</script>");
	//check for admin

	${'controller'} = $_GET['c'];
	${'m'} = $_GET['m'];
	$c = new $controller();

	if(isset($_GET['id'])){
		$res = call_user_func_array( array( $c, $m ),array($_GET['id']) );//,$_data
		echo($res);
	}else{
		$res = call_user_func( array( $c, $m ),$_data);
	}
	echo($res);
}else{
	/*echo("<script>var controller = 'main_controller' ;</script>");
	echo('REQUEST IS NOT SET');
	echo($_SERVER['QUERY_STRING']);
	parse_str($_SERVER['QUERY_STRING']);
	echo($controller);

	build_view('main/main.home.view.php');
	*/
	?>
</head>
<body>
	 <div class="navbar  navbar-default   navbar-fixed-top" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<a href="#"  class="navbar-brand animated fadeIn" id="brand_name"></a>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav pull-right">
					<li id="home" class=" nav-item ">
						<a href="?pg=home.html&title=home ">Home</a>
					</li>

		             <li>
                   <!-- glyphicon-log-in -->

                   <?php if($_SESSION['authorized'] == 1)
                   { ?>
                      	<a href="<?=BASE_URL;?>index.php?c=admin_controller&m=login"><span class="glyphicon glyphicon-user"></span> Admin</a>
                  <?php }else{ ?>
                      	<a href="<?=BASE_URL;?>index.php?c=admin_controller&m=login"><span class="glyphicon glyphicon-log-in"></span> Login</a>
                  <?php } ?>



		             </li>


				</ul>
			</div>
		</div>
		<!-- LOGO_IMG:
			If used with a nav bar, it should be place inside the nav bar.
			If using logo, and no nav bar, put your navigation on each individual page.
		-->
		<div id="LOGO_IMG">&nbsp;   </div>


		<div id="page_content"></div>
		<div id="page_modal"></div>


		<footer >

		</footer>

		<!-- BACKGROUND IMAGES -->
		<div id="BG_IMG">
			&nbsp;
		</div>
		<div id="BG_IMG_LEFT">
			&nbsp;
		</div>
		<div id="BG_IMG_RIGHT">
			&nbsp;
		</div>
		<div id="BG_IMG_TOP">
			&nbsp;
		</div>
<!-- end of BACKGROUND IMAGES -->


	<?php
}
?>
		 <!--  ALREADY LOADED ONCE IN index.html !!!!! MAY NEED TWEAKING -->

		 <script src="js/vendor/bootstrap.min.js"></script>
		<script src="js/main.js"></script>
		<script src="js/hammer.js"></script>
		<script src="js/jquery.panelSnap.js"></script>
		<script src="js/helper.js"></script>
		<link rel='stylesheet' type='text/css' href='js/table-lite/table-lite-rwd.css'>
		<script type="text/javascript" src="js/table-lite/jquery.paginate.js"></script>
		<script type="text/javascript" src="js/table-lite/table-lite.js"></script>



		<script>
			$(document).ready(function() {
				var brand_name = JS_CONFIG.BRAND_NAME;
				var title = "page title";
				var pg = "home.html";
				var modal = "blank.html";
				if (JS_CONFIG.getQueryValueByKey('pg') != "") {
					pg = JS_CONFIG.getQueryValueByKey('pg');
				};
				if (JS_CONFIG.getQueryValueByKey('title') != "") {
					title = JS_CONFIG.getQueryValueByKey('title');
				};
				if (JS_CONFIG.getQueryValueByKey('modal') != "") {
					modal = JS_CONFIG.getQueryValueByKey('modal');
				};
				$("#title").html(title);
				$("#brand_name").html(brand_name);
				$("#page_content").load("views/" + pg);
				$("#page_modal").load("views/" + modal);
				$('#BG_IMG').addClass('gradient6');//be sure to remove unwanted classes before applying a new one.
				$(".nav-item").bind("click", function(){
				    page_id = $(this).attr('id');
				    localStorage.setItem('current_page',page_id);
				});
				$("#"+current_page).addClass('active');
			});
			$(function() {
				FastClick.attach(document.body);
			});
		</script>

		<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
		<script>
			( function(b, o, i, l, e, r) {
					b.GoogleAnalyticsObject = l;
					b[l] || (b[l] = function() {
						(b[l].q = b[l].q || []).push(arguments)
					});
					b[l].l = +new Date;
					e = o.createElement(i);
					r = o.getElementsByTagName(i)[0];
					e.src = '//www.google-analytics.com/analytics.js';
					r.parentNode.insertBefore(e, r)
				}(window, document, 'script', 'ga'));
			ga('create', 'UA-XXXXX-X', 'auto');
			ga('send', 'pageview');
		</script>

<script>
	MBP.hideUrlBarOnLoad();
</script>
	</body>
</html>
