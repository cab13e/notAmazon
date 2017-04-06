<?php
/*
--Create Database user_db and then sue the database
--Import this into phpmyadmin

CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(50) NOT NULL,
  `id` int(2) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;
*/

//$crypted = crypt ( string $str, string $salt);

/**************************
*
* Database Connections
*
***************************/
$link = new mysqli("localhost","root", "password", "user_db");


if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}
/**************************
*
* Database interactions
*
***************************/

$loggedin = false;

if(isset($_REQUEST["action"]))
	$action = $_REQUEST["action"];
else
	$action = "none";

$message = "";

if($action == "add_user")
{
	$name = $_POST["name"];
	$password = $_POST["password"];
	$email = $_POST["email"];
	
	$name = htmlentities($link->real_escape_string($name));
	$password = htmlentities($link->real_escape_string($password));
	$password = crypt($password, "encryption");
	$result = $link->query("INSERT INTO users (username, email, password) VALUES ('$name', '$email', '$password')");
	if(!$result)
		die ('Can\'t query users because: ' . $link->error);
	else
		$message = "User Added";
}
elseif ($action == "login") {
	$name = $_POST["name"];
	$password = $_POST["password"];
	
	$name = htmlentities($link->real_escape_string($name));
	$password = htmlentities($link->real_escape_string($password));
	
	$password = crypt($password, "encryption");
	$result = $link->query("SELECT username,password FROM users WHERE username='$name'");
	if(!$result)
		die ('Can\'t query users because: ' . $link->error);

	$num_rows = mysqli_num_rows($result);
	if ($num_rows > 0) 
	{
	  $row = $result->fetch_assoc();
	  if($row["password"] == $password && $row["username"] == $name)
	  {
		$_SESSION['use']=$name;
		echo('<script>window.open("home.php","_self");</script>');
	  }
	  else
		echo('<script>alert("Incorrect password");</script>');
	}
	else 
	{
		echo('<script>alert("Incorrect username");</script>');
	}
}
?>

<html>
	<head>
		<title>Welcome</title>
		<link href="StyleSheet.css" rel="stylesheet"/>
		<script>
			function validate()
			{
				var name = document.getElementById("add_name").value;
				var email = document.getElementById("email").value;
				if(name == "")
				{
					alert("Please enter a name");
					return;
				}
				if(email == "")
				{
					alert("Please enter an email");
					return;
				}
				else
				{
					var found = false;
					var found2 = false;
					for(var i=0; i<email.length; i++)
						{
							if(email[i] == "@")
								found = true;
							if(email.includes(".com"))
								found2=true;
						}
					if(!found)
						{
							alert("Please include '@' in your email!");
							return;
						}
					if(!found2)
					{
						alert("Please include '.com' in your email!");
						return;
					}
				}
			}
		function check_pass()
			{
				var pass1 = document.getElementById("pass1").value;
				var pass2 = document.getElementById("pass2").value;
				if(pass1==pass2)
				{
					document.getElementById("pass_same").innerHTML = "Match";
					document.getElementById("pass_same").style.background = "Green";
					document.getElementById("pass_same").style.color = "White";
				}
				else
				{
					document.getElementById("pass_same").innerHTML = "No Match";
					document.getElementById("pass_same").style.background = "Red";
					document.getElementById("pass_same").style.color = "White";
				}
			}
		</script>
	</head>
	<body>
		
		<!--<div class="two-thirds1 column" id="main">
			<h1 id="welcome">Welcome!</h1>
		</div> <br/>-->
		<?php
			if($loggedin)
				print '<div class="two-thirds1 column id="main""> <h1 id="welcome">Welcome!</h1></div>';
			else
				print '<div class="two-thirds1 column id="main""> <h1 id="welcome">Welcome!</h1></div>';
				?>
			<br/>
			<br/>
		
		<div class="two-thirds column" id="main">
			<legend>Add User</legend> <br/>
			<form method="post" action="login.php" name="add_user">
			Username: <input type="text" name="name" id="add_name" /> <br/>
			Email: <input type="text" name="email" id="email" /> <br/>
			Password: <input type="password" name="password" id="pass1" /> <br/>
			Password (again): <input type="password" id="pass2" onKeyUp="check_pass()"/>
			<div id="pass_same" style="display:inline;">&nbsp;</div>
			<input type="hidden" name="action" value="add_user" />
			<input type="Submit" value="Go" onClick="validate()" />
			</form>
		</div>
		<div class="two-thirds column" id="main">
			<legend>Login</legend> <br/>
			<form method="post" name="login">
				Username: <input type="text" name="name" /> <br/>
				Password: <input type="password" name="password" /> <br/>
				<input type="hidden" name="action" value="login" />
				<input type="Submit" value="Go"/>
			</form>
		</div>
		
		<br/>
		

		
	</body>
</html>