<?php
session_start();
include 'connection.php';
$logged = false;
if(!empty($_SESSION["loggedin"])){
        $cust_id = $_SESSION["id"];
        $logged = $_SESSION["loggedin"];
}

if($logged == true)
{
        $q = "SELECT COUNT(*) AS quant FROM cart WHERE cus_id = $cust_id && ordered = 0;";
        $r = $conn->query($q);
        while($i = $r->fetch_assoc()) {
                $j = $i['quant'];
                echo $j;
        }
        $_SESSION["qauntity"] = $j;
}
?>