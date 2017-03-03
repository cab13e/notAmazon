<?php
session_start();
$link = new mysqli("localhost","root", "", "quadcopters");
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
                <a style="text-align:left;position:relative;padding-right: 10px;" href="cart.php"><button id="linker" class="button button1">View cart</button></a>
                <a style="text-align:left;position:relative;padding-right: 10px;" href="drones.php"><button id="linker" class="button button2">Shop All Drones</button></a>
                <a style="text-align:left;position:relative;padding-right: 10px;" href="logout.php"><button id="linker" class="button button3">Logout</button></a>
             
			</div> <br/>
		</nav>
	</header>

	<div class="two-thirds1 column" id="main" style="background-color: steelblue">
		<h1>New additions to the store!</h1>
			<?php 
				$result = $link->query('SELECT * from table_1 where model = "Mavic"'); //"Mavic"
				$row = $result->fetch_assoc();
				echo ('<header><strong><h4>' . $row["model"] . '</h4></strong>');
				echo ('<div><img src = "' . $row["image"] . '"></div>');
				echo ('<div style="margin-top: 20px">Price: $' .  $row["msrp"] . '</div>');
				echo ('</header>');
			?>
	</div>

</body>
</html>

