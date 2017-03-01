<?php
session_start();
$link = new mysqli("localhost","root", "password", "stories");
if ($link->connect_errno) 
{
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}
?>


<html>
<head>
<title> Home </title>
<link href="StyleSheet.css" rel="stylesheet"/>
</head>
<body>
	<header>
		
		<nav id="navbar">
			<div class="two-thirds1 column" id="main">
				<h1 id="welcome">Welcome!</h1>
				<a style="text-align:left;position:relative;padding-right: 10px;" href="cart.php"><h3 id="linker">View cart</h3></a>
				<a style="text-align:right;position:relative;" class="pull-right" href="logout.php"><h3 id="linker">Logout<h3></a> <br/>
			</div> <br/>
		</nav>
	</header>

	<div>
		
	</div>

	
	
</body>
</html>

