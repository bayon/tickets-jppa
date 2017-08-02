<div class="main_content">
	<div id='signUp'  class='view_segment view_content'>
		sign up
		<div   class='sub_view_segment sub_view_content'>
			<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
				username:
				<input type="text" name="username">
				<br>
				password:
				<input type="text" name="password">
				<br>
				<input type="hidden" name="c" value ="admin_controller">
				<input type="submit" name="m" value ="register">
			</form>
		</div>
	</div>
</div>
