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
<head></head>
<body>

    <?php
    $results = $link->query('SELECT * from table_1');

    $products_list =  '<ul class="products-wrp">';

while($row = $results->fetch_assoc()) {
$products_list .= <<<EOT
<li>
<form class="form-item">
<h3>{$row["model"]}</h3>
<h4>{$row["vendor"]}</h4>
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
	
    <input name="product_code" type="hidden" value="{$row["sku"]}">
    <button type="submit">Add to Cart</button>
</div>
</form>
</li>
EOT;

}
$products_list .= '</ul></div>';
echo $products_list;
?>
</body>
</html>