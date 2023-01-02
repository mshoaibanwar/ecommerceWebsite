<?php
include 'connection.php';
include 'header.php';
$s_query = $_GET['q'];
$found = 0;
?>
<html>
<body>
        <h2 style="text-align: center;">Search Resuls for: <?php echo $s_query; ?></h2>
        <div class="btn-group category-box" style="width:100%">
<?php

$sql = "SELECT pro_id, pro_name, price, pro_img FROM products WHERE pro_name LIKE '%$s_query%'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
    $found = $row["pro_id"];
echo  '<form class="card searchcard" method="post" action="">
     <input type="hidden" name="p_id" value="' .$row["pro_id"]. '" />                       
  <a href="product.php?' . $row["pro_id"] . '">
      <img src="'.$row["pro_img"].'" alt="Denim Jeans">
      <h3>' . $row["pro_name"] . '</h3>
      <p class="price">PKR ' . $row["price"] .'</p>
      <span class="fa fa-star checked"></span>
      <span class="fa fa-star checked"></span>
      <span class="fa fa-star checked"></span>
      <span class="fa fa-star"></span>
      <span class="fa fa-star"></span>
  </a>
  <p><button type="submit" class="add-to-cart">Add to Cart</button></p>
  </form>';
  }    
}
if($found == 0)
{
    echo '<h3 style="margin-bottom: 17%;text-align: center; color: red;">No Results found!</h3>';
}
if (isset($_POST['p_id']) && $_POST['p_id']!=""){
$code = $_POST["p_id"];
$cust_id = $_SESSION["id"];
$in = true;
$q = "SELECT pro_id FROM cart WHERE cus_id = $cust_id";
$r = $conn->query($q);
if ($r->num_rows > 0) {
     while($ro = $r->fetch_assoc()) {
                if($ro["pro_id"] == $code)
                {
                   $in = false;        
                   $que = "UPDATE cart SET pro_quantity = pro_quantity + 1 WHERE cus_id = $cust_id AND pro_id = $code";
       if($res = mysqli_query($conn, $que)) {
        echo '<div id="NotiWindow" class="Notimodal">
        <div class="Notimodal-content">
          <span class="Noticlose">&times;</span>
          <p>Already Added! Quantity Updated.</p>
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
}
}
if($in)
{
$query = "INSERT INTO cart (cus_id, pro_id) VALUES ($cust_id, $code)";
      if($result = mysqli_query($conn, $query)) {
                echo '<div id="NotiWindow" class="Notimodal">
        <div class="Notimodal-content">
          <span class="Noticlose">&times;</span>
          <p>Added to Cart!</p>
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
} 

?>
</div>
</body>
<?php require "footer.php"; ?>
</html>

