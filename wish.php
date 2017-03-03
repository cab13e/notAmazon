<?php
session_start();
$link = new mysqli("localhost","root", "password", "wishlist");


if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}

if(isset($_REQUEST["action"]))
	$action = $_REQUEST["action"];
else
	$action = "none";

$message = "";

if($action == "approve")
{
    $name = $_POST["name"];

        $result = $link->query("UPDATE pending SET approved_by='" . $name . "'  WHERE approved = 0");
        if(!$result)
        {
            die('Can\'t query pending because: ' . $link->error);
            echo ("<h2> Bad </h2>");
         }
        else
            echo("<h2> updated </h2>");
        $result = $link->query("UPDATE pending SET approved= 1 WHERE 'approved' = 0");
            if(!$result)
            {
                die('Can\'t query pending because: ' . $link->error);
                echo ("<h2> Bad </h2>");
             }   
}

?>
