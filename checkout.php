<?php
session_start();
include 'connection.php';
include 'header.php';

$cust_id = 0;
$proid = 0;
$proname = "";
$proprice = 0;

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

    <h2 style="text-align: center;">CHECKOUT</h2>

    <div style="margin: 2%;" class="chrow">
        <div class="col-75">
            <div class="chcontainer">
                <form action="" method="POST">
                    <div class="chrow">
                        <div class="col-50">
                            <h3>Shipping Address</h3>
                            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                            <input type="text" id="fname" name="firstname" placeholder="Wali Muhammad" required>
                            <label for="email"><i class="fa fa-envelope"></i> Email</label>
                            <input type="text" id="email" name="email" placeholder="wali@example.com" required>
                            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                            <input type="text" id="adr" name="address" placeholder="G11 Markaz, ISB" required>
                            <label for="city"><i class="fa fa-institution"></i> City</label>
                            <input type="text" id="city" name="city" placeholder="Islamabad" required>
                            <div class="chrow">
                                <div class="col-50">
                                    <label for="state">State</label>
                                    <input type="text" id="state" name="state" placeholder="Islamabad" required>
                                </div>
                                <div class="col-50">
                                    <label for="zip">Zip</label>
                                    <input type="text" id="zip" name="zip" placeholder="44000" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-50">
                            <h3>Payment</h3>
                            <label for="fname">Accepted Cards</label>
                            <div class="icon-container">
                                <i class="fa fa-cc-visa" style="color:navy;"></i>
                                <i class="fa fa-cc-amex" style="color:blue;"></i>
                                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                <i class="fa fa-cc-discover" style="color:orange;"></i>
                            </div>
                            <label for="cname">Name on Card</label>
                            <input type="text" id="cname" name="cardname" placeholder="Wali Muhammad">
                            <label for="ccnum">Credit card number</label>
                            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                            <label for="expmonth">Exp Month</label>
                            <input type="text" id="expmonth" name="expmonth" placeholder="September">
                            <div class="chrow">
                                <div class="col-50">
                                    <label for="expyear">Exp Year</label>
                                    <input type="text" id="expyear" name="expyear" placeholder="2024">
                                </div>
                                <div class="col-50">
                                    <label for="cvv">CVV</label>
                                    <input type="text" id="cvv" name="cvv" placeholder="352">
                                </div>
                            </div>
                        </div>

                    </div>
                    <input type="submit" name="place_order" value="Place Order" class="chbtn">
                </form>
            </div>
        </div>

        <?php
                $cust_id = 0;
                $existed = false;
                $placed = false;
                if(!empty($_SESSION["loggedin"])){
                    $cust_id = $_SESSION["id"];
                }
                if(isset($_POST["place_order"]))
                {
                    $ful_name = $_POST["firstname"];
                    $e_mail = $_POST["email"];
                    $add = $_POST["address"];
                    $cit = $_POST["city"];
                    $sta = $_POST["state"];
                    $zi = $_POST["zip"];

                    $sqladd = "SELECT cus_id FROM address WHERE cus_id = $cust_id";
                    $result = $conn->query($sqladd);
                        if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            if($cust_id == $row["cus_id"])
                            {
                                    $existed = true;
                            }
                        }
                    }
                    if($existed)
                    {
                        $sql = "UPDATE address SET cus_id = $cust_id, f_name = '$ful_name', e_mail = '$e_mail', s_address = '$add', city = '$cit', state = '$sta', zip = '$zi' WHERE cus_id = $cust_id";
                        if ($conn->query($sql) === TRUE) {
                            $placed = true;
                         } else {
                            $placed = false;
                            echo "Error: " . $sql . "<br>" . $conn->error;
                         }
                    }
                    else{

                        $sql = "INSERT INTO address VALUES ($cust_id, '$ful_name', '$e_mail', '$add', '$cit', '$sta', '$zi')";
                        if ($conn->query($sql) === TRUE) {
                            $placed = true;
                    } else {
                        $placed = false;
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    }   

                    $dt=date("Y-m-d");
                    $sql1 = "INSERT INTO orders VALUES (default, $cust_id, '$dt')";
                    if ($conn->query($sql1) === TRUE) {
                        $placed = true;
                    } else {
                        $placed = false;
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    $max_oid = 0;
                    $oql = "SELECT MAX(o_id) as maxid FROM orders";
                     $result = $conn->query($oql);
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if($row["maxid"] > 0)
                        {
                            $max_oid = $row["maxid"];
                        }
                    }
                    }
                    $sql2 = "UPDATE cart SET ordered = 1, order_id = $max_oid WHERE cus_id = $cust_id && ordered = 0";
                    if ($conn->query($sql2) === TRUE) {
                        $placed = true;
                    } else {
                        $placed = false;
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    if($placed == true)
                    {
                        function open_window(){
                            echo '<script>window.location="order.php";</script>';
                         }
                         // test:
                         open_window();
                        echo '<div id="NotiWindow" class="Notimodal">
                        <div class="Notimodal-content">
                        <span class="Noticlose">&times;</span>
                        <p>Order Placed Successfuly!</p>
                        </div>
                        </div>';
                    }
            }
        ?>

        <div class="col-25">
            <div class="chcontainer">
            <h4>Cart <span class="checkprice" style="color:black"><i class="fa fa-shopping-cart"></i> <b></b></span></h4>                        
                <?php
                            $t_price = 0;
                            $p_price = 0;
                            if(!empty($_SESSION["loggedin"])){
                                $cust_id = $_SESSION["id"];
                            }
                            if($cust_id != 0)
                            {
                                            $sql = "SELECT p.pro_id, p.pro_name, p.price, c.pro_quantity FROM products p
                                            LEFT JOIN cart c ON p.pro_id = c.pro_id
                                            LEFT JOIN customers s ON s.cus_id = c.cus_id
                                            WHERE s.cus_id = $cust_id && c.ordered = 0";
                                             $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                    while($row = $result->fetch_assoc()) {
                                                        $p_price = $row["price"] * $row["pro_quantity"];
                                                        $t_price += $p_price;
                                                       echo '<p><a href="product.php?'. $row["pro_id"] .'">'. $row["pro_name"] .'</a> <span class="checkprice">PKR '. $p_price .'</span></p>';
                                                    }
                                            }
                            }
                ?>
                
                <hr>
                <p>Total <span class="price" style="color:black"><b>PKR <?php echo $t_price; ?></b></span></p>
            </div>
        </div>
    </div>

    <?php require_once "footer.php"; ?>

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