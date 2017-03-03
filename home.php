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
<script type="text/javascript" src="jquery-1.11.2.min.js"></script></head>
<script>
$(document).ready(function(){
    $(".form-item").submit(function(e){
        var form_data = $(this).serialize();
        // echo ("<h2>did this</h2>");
        var button_content = $(this).find('button[type=submit]');
        button_content.html('Adding to cart');

        request = $.ajax({
            url: "cart.php",
            type: "POST",
            datatype:"json",
            data: form_data
        })
        request.done(function(data){
            // console.log("here?");
            console.log(data.items);
            $("#cart-info").html(data.items);
            // console.log(data.items);
            button_content.html('Add to Cart');
            alert("Item added!");
            if($(".shopping-cart-box").css("display") == "block"){
                $(".cart-box").trigger("click");
            }
        }).fail(function(data){
            console.log("failed");
        })
        e.preventDefault();
    });

    //open cart
    $(".cart-box").click(function(e){
        e.preventDefault();
        $(".shopping-cart-box").fadeIn();
        $("#shopping-cart-results").html('<img src="ajax-loader.gif">');
        $("#shopping-cart-results").load("cart.php", {"load_cart":"1"});
    });

    //close cart
    $(".close-shopping-cart-box").click(function(e){
        e.preventDefault();
        $(".shopping-cart-box").fadeOut();
    });

    //Remove items from cart
	$("#shopping-cart-results").on('click', 'a.remove-item', function(e) {
		e.preventDefault(); 
		var pcode = $(this).attr("data-code"); //get product code
		$(this).parent().fadeOut(); //remove item element from box
		$.getJSON( "cart_process.php", {"remove_code":pcode} , function(data){ //get Item count from Server
			$("#cart-info").html(data.items); //update Item count in cart-info
			$(".cart-box").trigger( "click" ); //trigger click on cart-box to update the items list
		});
    });
});
</script>
<body>
	<header>
		<nav id="navbar">
			<div class="two-thirds1 column" id="main">
                <h1 id="welcome">Welcome!</h1>
                <a style="text-align:left;position:relative;padding-right: 10px;" href="home.php"><button id="linker" class="button button1">Home</button></a>
                <a style="text-align:left;position:relative;padding-right: 10px;" href="drones.php"><button id="linker" class="button button2">Shop All Drones</button></a>
                <a style="text-align:left;position:relative;padding-right: 10px;" href="logout.php"><button id="linker" class="button button3">Logout</button></a>
                
				<a href="#" class="cart-box" id="cart-info" title="View Cart">
					<?php
					if(isset($_SESSION["products"])){
						echo ("Cart")S;
					}else{
						echo 0;
					}?>

				<div class="shopping-cart-box">
				<a href="#" class="close-shopping-cart-box" >Close</a>
				<h3>Your Shopping Cart</h3>
					<div id="shopping-cart-results">
					</div>
				</div>
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

