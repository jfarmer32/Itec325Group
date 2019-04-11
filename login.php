<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
	<link rel="stylesheet" href="basic.css">
    <meta charset="utf-8">
    <title>Login</title>
	<?php
		require_once('project-functions.php');
	?>
  </head>
  <body>
	<form>
		Username:<br>
		<input type="text" name="username">
		<br>
		Password:<br>
		<input type = "text" name="password">
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
