<?php
include 'connection.php';
include 'header.php';
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

    <h2 style="text-align: center;">CART</h2>


    <div style="margin: 1%; background-color: white;" class="row">
        <div class="column02">
            <hr style="width: 98%;">
            <div class="chline1">
                <p style="margin-left: 16px;">Item</p>
                <p style="float: right;">Price</p>
                <p style="float: right;">Quantity</p>
            </div>
            <hr style="width: 98%;">

            <div id="cart_products">

            </div>

 
            
            <?php
            $t_price = 0;
            $p_price = 0;
            $cust_id = 0;
            if(!empty($_SESSION["loggedin"])){
                $cust_id = $_SESSION["id"];
            }
            if (isset($_POST['p_id']) && $_POST['p_id']!=""){
                $code = $_POST["p_id"];
                $sql = "DELETE FROM cart WHERE cus_id = $cust_id AND pro_id = $code";
                if ($conn->query($sql) === TRUE) {
                    echo "Record deleted successfully";
                  } else {
                    echo "Error deleting record: " . $conn->error;
                  }
            }

            $sql = "SELECT P.price AS tprice, C.pro_quantity FROM products P JOIN cart C ON P.pro_id = C.pro_id WHERE C.cus_id = $cust_id && C.ordered = 0";
                 $result = $conn->query($sql);
                if ($result->num_rows > 0) {
        // output data of each row
                while($row = $result->fetch_assoc()) {
                        $p_price = $row["tprice"] * $row["pro_quantity"];
                        $t_price += $p_price;
                }
            }


            if (isset($_POST["minus"])){
                $code = $_POST["mp_id"];
                $sql = "UPDATE cart SET pro_quantity = pro_quantity - 1 WHERE cus_id = $cust_id AND pro_id = $code AND pro_quantity > 1";
                if ($conn->query($sql) === TRUE) {
                        echo '<div id="NotiWindow" class="Notimodal">
                    <div class="Notimodal-content">
                      <span class="Noticlose">&times;</span>
                      <p>Quantity Decreased!</p>
                    </div>
                  </div>';
                   } else {
              echo '<div id="NotiWindow" class="Notimodal">
                    <div class="Notimodal-content">
                      <span class="Noticlose">&times;</span>
                      <p>Error: ' . $sql . '<br>' . $conn->error . '</p>
                    </div>
                  </div>';
                    }
            }

            if (isset($_POST["plus"])){
                  $code = $_POST["pp_id"];
                  $sql = "UPDATE cart SET pro_quantity = pro_quantity + 1 WHERE cus_id = $cust_id AND pro_id = $code";
                  if ($conn->query($sql) === TRUE) {
                      echo '<div id="NotiWindow" class="Notimodal">
                      <div class="Notimodal-content">
                        <span class="Noticlose">&times;</span>
                        <p>Quantity Increased!</p>
                      </div>
                    </div>';
                     } else {
                echo '<div id="NotiWindow" class="Notimodal">
                      <div class="Notimodal-content">
                        <span class="Noticlose">&times;</span>
                        <p>Error: ' . $sql . '<br>' . $conn->error . '</p>
                      </div>
                    </div>';
                      }
              }
?>
        </div>
      <script type="text/javascript">
  const xhttpr = new XMLHttpRequest();
  xhttpr.onload = function() {
    document.getElementById("cart_products").innerHTML = this.responseText;
  }
  xhttpr.open("GET", "cart_db.php");
  xhttpr.send();
</script>


        <div class="vl"></div>

        <div class="column">
            <h3>Bag Summary</h3>
            <hr style="width: 96%;">
            <div class="bagp">
                <p style="padding-left: 12px;">Subtotal: </p>
                <p style="margin-right: 9%;">PKR <?php echo $t_price; ?></p>
            </div>
            <hr style="width: 96%;">
            <div class="bagp">
                <p style="padding-left: 12px;">Grand Total: </p>
                <p style="margin-right: 9%;">PKR <?php echo $t_price; ?></p>
            </div>
            <hr style="width: 96%;">
            <button class="ptocheck" onclick="window.location.href='checkout.php';">PROCEED TO CHECKOUT</button>


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