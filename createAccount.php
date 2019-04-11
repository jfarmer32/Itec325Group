<?php
	require_once('project-functions.php');
?>
<html>
  <head>
	<link rel="stylesheet" href="basic.css">
    <meta charset="utf-8">
    <title>Create Account</title>
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
  </head>
  <body>
  <p>
	<?php
		echo makeHeader(array("left" => makeImgGrid("square.jpeg", 11, 6),
							 "center" => "<h1>Create Account</h1>",
							 "right" => asUL(array(hyperlink("index.php",
													"Home",
													"menu"),
										  hyperlink("login.php",
										            "Login",
													"menu")))));
	 ?>
	</p>
	<form>
	<div style="width:60%; height:auto; margin:auto; color:white">
		Username:<br>
		<input type="text" name="username" onkeyup="usernameValidate(this)" required>
		<br>
		Password:<br>
		<input type = "text" name="password" onkeyup="passwordValidate(this)" required>
		<br>
		Confirm Password:<br>
		<input type = "text" name="cPassword" onkeyup="passwordValidate(this)" required>
		<br><br>
		<input type="submit" value="Submit">
	</div>
	</form>
	<br>
	<span>
		<?php
			echo contentPane();
		?>
	</span>
  </body>
</html>
