<?php
session_start();
include 'connection.php';
include 'header.php';

$cust_id = 0;
?>
<html>
<body>
    <!-- SIdeNav Mobile -->

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">
        <a href="02.html">Women</a>
        <a href="02.html">Jeans</a>
        <a href="02.html">Jackets</a>
        <a href="02.html">Best Sales</a>
    </div>
    <!-- Script for SideNav Mobile -->
    <script>
        function openNav() {

            if (document.getElementById("mySidenav").style.width == "250px") {
                document.getElementById("mySidenav").style.width = "0";
            } else {
                document.getElementById("mySidenav").style.width = "250px";
            }
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>

    <h2 style="text-align: center;">Order Placed Successfully!</h2>

    <h3 style="text-align: center;">Ordered Items: </h3>
    <div class="o_body">
    <div class="orders">
            <hr style="width: 98%;">
            <?php
            $cust_id = 0;
            if(!empty($_SESSION["loggedin"])){
                $cust_id = $_SESSION["id"];
            }
            $sql = "SELECT p.pro_id, p.pro_name, p.price, p.pro_img, c.pro_size , c.pro_quantity, o.o_id, o.o_date, o.o_status FROM products p
                LEFT JOIN cart c ON p.pro_id = c.pro_id
                LEFT JOIN orders o ON o.cus_id = c.cus_id
                WHERE o.cus_id = $cust_id && c.ordered = 1 && o.o_id = c.order_id ORDER BY o.o_id DESC";
                 $result = $conn->query($sql);
                if ($result->num_rows > 0) {
        // output data of each row
                while($row = $result->fetch_assoc()) {
        
             echo '<div class="chitem">
            <img style="width: 15%; margin-left: 10px;" src="'. $row["pro_img"] .'"></img>
            <div class="chcol2">
                <a style="text-align:left; margin-left:10px; font-size:larger;" href="product.php?'. $row["pro_id"] .'">'. $row["pro_name"] .'</a>
                <div class="chp">
                    <p>Size: '. $row["pro_size"] .' regular</p>
                    <p>PKR '. $row["price"] .'</p>
                    <p>Order Number: '. $row["o_id"] .'</p>
                    <p>Ordered On: '. $row["o_date"] .'</p>
                    <p style="color: blue;">Order Status: '. $row["o_status"] .'</p>
                </div>
            </div>
            <div class="qselector" style="display:flex; justify-content: center;  column-gap: 10px;">
            <p style="margin-top:0;">Quantity: '. $row["pro_quantity"] .'</p>
            </div>
            <div class="chprice">
                <p>PKR '. $row["price"] * $row["pro_quantity"].'</p>
            </div>
        </div>
        <hr style="width: 98%;">';
                }
            }
        ?>
    </div>
    </div>

        <!-- Script for NotiWindow-->
<script>
var modal = document.getElementById("NotiWindow");
var span = document.getElementsByClassName("Noticlose")[0]; 
function displayNoti() {
  modal.style.display = "block";
}
span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
</body>
</html>