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

    <meta charset="utf-8">
    <title>Login</title>
	<?php
		require_once('project-functions.php');
	?>
  </head>
  <body>
	<form>
		Username:<br>
		<input type="text" name="username" onkeyup="usernameValidate(this)" required>
		<br>
		Password:<br>
		<input type = "text" name="password" onkeyup="passwordValidate(this)" required>
		<br><br>
		<input type="submit" value="Submit">
	</form>
    Login page stub
    <br/>
    <a href="createAccount.php">Create Account</a>
    <br/>
    <a href="user-page.php">User page (after successful form submission)</a>
    <br/>
    <a href="admin-page.php">admin page (after successful form submission with administrative credentials)</a>
    <br/>
	<span>
		<?php
			echo contentPane();
		?>
	</span>
  </body>
</html>
