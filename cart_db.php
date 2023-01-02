<?php 
session_start();
include 'connection.php';
            $cust_id = 0;
            if(!empty($_SESSION["loggedin"])){
                $cust_id = $_SESSION["id"];
            }
            if($cust_id != 0)
            {
                $sql = "SELECT p.pro_id, p.pro_name, p.price, p.pro_img, c.pro_quantity, c.pro_size FROM products p
                LEFT JOIN cart c ON p.pro_id = c.pro_id
                LEFT JOIN customers s ON s.cus_id = c.cus_id
                WHERE s.cus_id = $cust_id && c.ordered = 0";
                 $result = $conn->query($sql);
                if ($result->num_rows > 0) {
        // output data of each row
                while($row = $result->fetch_assoc()) {
        
             echo '<div class="chitem">
            <img style="width: 20%; margin-left: 10px;" src="'. $row["pro_img"] .'"></img>
            <div class="chcol2">
                <a style="text-align:left; margin-left:10px; font-size:larger;" href="product.php?'. $row["pro_id"] .'">'. $row["pro_name"] .'</a>
                <div class="chp">
                    <p>Size: '. $row["pro_size"] .' regular</p>
                    <p>Color: Pitch Black</p>
                    <p>PKR '. $row["price"] .'</p>
                </div>
            </div>
            <div class="qselector" style="display:flex; justify-content: center;  column-gap: 10px;">
            <form method="POST" action="">
                        <input type="hidden" name="mp_id" value="'. $row["pro_id"] .'" />
                        <button type="submit" name="minus">-</button>
            </form>
            <p style="margin-top:0;">'. $row["pro_quantity"] .'</p>
            <form method="POST" action="">
                        <input type="hidden" name="pp_id" value="'. $row["pro_id"] .'" />
                        <button type="submit" name="plus">+</button>
            </form>
            </div>
            <div class="chprice">
                <p>PKR '. $row["price"] * $row["pro_quantity"].'</p>
                <form method="POST" action="">
                    <input type="hidden" name="p_id" value="'. $row["pro_id"] .'" />
                    <button type="submit" class="remove_item">Remove</button>
                </form>
            </div>
        </div>
        <hr style="width: 98%;">';
        
        if (isset($_POST['p_id']) && $_POST['p_id']!=""){
            $code = $_POST["p_id"];
            $cust_id = $_SESSION["id"];

            $sql = "DELETE FROM cart WHERE cus_id = $cust_id AND pro_id = $code";
            if ($conn->query($sql) === TRUE) {
                echo "Record deleted successfully";
              } else {
                echo "Error deleting record: " . $conn->error;
              }
        }

      }
      }
    }
?>