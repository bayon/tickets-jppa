<?php
?>

<div id="template_view_1" class="container-fluid animated fadeIn kioview"    >

	<div class="row top-row">
		<div class="col-md-12  ">

			

		 
				 
					 
					<div   class="col-md-4  ">
					    <h3>Login Page</h3>
						<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
							username:
							<input type="text" name="username">
							<br>
							password:
							<input type="text" name="password">
							<br>
							<input type="hidden" name="c" value ="admin_controller">
							<input type="submit" name="m" value ="verify">
						</form>
					</div>
					 
				 
			 

		</div>
	</div>
	 
</div>
<!-- BACKGROUND IMAGES -->
<div id="BG_IMG">
	&nbsp;
	<!-- <img src="img/sky.jpg"> -->
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
<script>
	( function() {
			$('#BG_IMG').addClass('gradient6');
			//be sure to remove unwanted classes before applying a new one.
		}()); 
</script>

<!-- ////////////////////////////   -->

