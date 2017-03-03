<?php
session_start();
include("config.inc.php");
?>


<html>
<head>
<title> Home </title>
<link href="StyleSheet.css" rel="stylesheet" type="text/css"/>
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
						echo ("Cart");
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
$results = $mysqli_conn->query('SELECT * from table_1 where model = "Mavic"');

$products_list =  '<ul class="products-wrp">';

while($row = $results->fetch_assoc()) {
$products_list .= <<<EOT
<li>
<form class="form-item" style="color:black">
<h3>{$row["model"]}</h3>
<h4>{$row["vendor"]}</h4>
<p>
    <strong>Size: </strong> {$row["size"]} mm
    <strong>Weight: </strong>  {$row["weight"]} grams
    <strong>Flight time: </strong>  {$row["flight_time"]} minutes
    <strong>Range: </strong>  {$row["distance"]} km
    <strong>Speed: </strong>  {$row["speed"]} km/h
    <strong>Gimbal: </strong>  {$row["gimbal"]}
    <strong>Video: </strong>  {$row["video"]}
    <strong>Camera: </strong>  {$row["camera"]}
    <strong>Additional features: </strong>  {$row["features"]}
</p>
<p>Customer Reviews: </br>
{$row["reviews"]}
</p>
<div><img src="{$row["image"]}"></div>
<div>Price : {$row["msrp"]}<div>
<div class="item-box">
	<div>
    Qty :
    <select name="product_qty">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    </select>
	</div>
	
    <input name="sku" type="hidden" value="{$row["sku"]}">
    <button type="submit">Add to Cart</button>
    <button type="submit" action="wish" id="wishlist">Add to Wishlist</button>
    </br>
    <form action="addReview" name="addReview"> 
        Review: <input type="text" name="review">
        <input type="hidden" name="action" value="addReview" />
        <input type="Submit">
    </form>
</div>
</form>
</li>
EOT;

}
$products_list .= '</ul></div>';
echo $products_list;
?>
	</div>

</body>
</html>

