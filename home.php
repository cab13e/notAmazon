<?php
session_start();
$link = new mysqli("localhost","root", "password", "quadcopters");
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
				<a style="text-align:left;position:relative;padding-right: 10px;" href="drones.php"><h3 id="linker">Shop all drones</h3></a>
				<a style="text-align:right;position:relative;" class="pull-right" href="logout.php"><h3 id="linker">Logout<h3></a> <br/>
			</div> <br/>
		</nav>
	</header>

	<div>
		<h1>New additions to the store!</h1>
			<?php 
				$result = $link->query('SELECT * from table_1 where model = "Mavic"');
				$row = $result->fetch_assoc();
				echo ('<header><h4>' . $row["model"] . '</h4>');
				echo ('<div><img src = "' . $row["image"] . '"></div>');
				echo ('<div>Price: $' .  $row["msrp"] . '</div>');
				echo ('</header>');
			?>
	</div>

</body>
</html>

