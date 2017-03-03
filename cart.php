<?php
session_start();
include_once("config.inc.php");

setlocale(LC_MONETARY,"en_US"); 

############# add products to session #########################
if(isset($_POST["sku"]))
{
    // echo ("<h2>did this</h2>");
	foreach($_POST as $key => $value){
		$new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING); //create a new product array 
	}
	
	//we need to get product name and price from database.
	$statement = $mysqli_conn->prepare("SELECT model, msrp FROM table_1 WHERE sku=? LIMIT 1");
	$statement->bind_param('s', $new_product['sku']);
	$statement->execute();
	$statement->bind_result($model, $msrp);
	

	while($statement->fetch()){ 
		$new_product["model"] = $model; //fetch product name from database
		$new_product["msrp"] = $msrp;  //fetch product price from database
		
		if(isset($_SESSION["products"])){  //if session var already exist
			if(isset($_SESSION["products"][$new_product['sku']])) //check item exist in products array
			{
				unset($_SESSION["products"][$new_product['sku']]); //unset old item
			}			
		}
		
		$_SESSION["products"][$new_product['sku']] = $new_product;	//update products with new item array	
	}
	
 	$total_items = count($_SESSION["products"]); //count total items

    //  echo($total_items);
	die(json_encode(array('items'=>$total_items))); //output json 
}

################## list products in cart ###################
if(isset($_POST["load_cart"]) && $_POST["load_cart"]==1)
{

	if(isset($_SESSION["products"]) && count($_SESSION["products"])>0){ //if we have session variable
		$cart_box = '<ul class="cart-products-loaded">';
		$total = 0;
		foreach($_SESSION["products"] as $product){ //loop though items and prepare html content
			
			//set variables to use them in HTML content below
			$product_name = $product["model"]; 
			$product_price = $product["msrp"];
			$product_code = $product["sku"];
			$product_qty = $product["product_qty"];
			
			$cart_box .=  "<li> $product_name (Qty : $product_qty ) ".sprintf("%01.2f", ($product_price * $product_qty)). " <a href=\"#\" class=\"remove-item\" data-code=\"$product_code\">&times;</a></li>";
			$subtotal = ($product_price * $product_qty);
			$total = ($total + $subtotal);
		}
		$cart_box .= "</ul>";
        $cart_box .= '<div class="cart-products-total">Total : '.$currency.sprintf("%01.2f",$total).' <u><a href="view_cart.php" title="Review Cart and Check-Out">Check-out</a></u></div>';
		die($cart_box); //exit and output content
	}else{
		die("Your Cart is empty"); //we have empty cart
	}
}

################# remove item from shopping cart ################

if(isset($_GET["remove_code"]) && isset($_SESSION["products"]))
{
	$product_code   = filter_var($_GET["remove_code"], FILTER_SANITIZE_STRING); //get the product code to remove

	if(isset($_SESSION["products"][$product_code]))
	{
		unset($_SESSION["products"][$product_code]);
	}
	
 	$total_items = count($_SESSION["products"]);
	die(json_encode(array('items'=>$total_items)));
}