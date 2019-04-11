<!DOCTYPE html>
<html lang="en" dir="ltr">
<script>
		function usernameValidate(input) {
		var regex = /[^a-z0-9]/gi;
		input.value = input.value.replace(regex,"");
	}
		function passwordValidate(input) {
		var regex = /[\\<>'"/?]+/gi;
		input.value = input.value.replace(regex, "");
	}
</script>
  <head>
	<link rel="stylesheet" href="basic.css">
    <meta charset="utf-8">
    <title>Login</title>
	<?php
		require_once('project-functions.php');
	?>
  </head>
  <body>
  <p>
	<?php
		echo makeHeader(array("left" => makeImgGrid("square.jpeg", 11, 6),
							 "center" => "<h1>Login</h1>",
							 "right" => asUL(array(hyperlink("createAccount.php",
													"Create Account",
													"menu"),
										  hyperlink("user-page.php",
										            "User Page",
													"menu"),
										  hyperlink("admin-page.php",
													"Admin Page",
													"menu")))));
	 ?>
	</p>
	<form>
		Username:<br>
		<input type="text" name="username" onkeyup="usernameValidate(this)" required>
		<br>
		Password:<br>
		<input type = "text" name="password" onkeyup="passwordValidate(this)" required>
		<br><br>
		<input type="submit" value="Submit">
	</form>
	<br>
	<span>
		<?php
			echo contentPane();
		?>
	</span>
  </body>
</html>
