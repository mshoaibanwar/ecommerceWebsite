<?php
include 'connection.php';

$cus_name = "";
$cus_id = 0;
$order_id = 0;
$sql="SELECT * FROM orders ORDER BY o_id DESC";
$result = mysqli_query($conn,$sql);

echo "<table>
<tr>
<th>Order ID</th>
<th>Order Date</th>
<th>Ordered By</th>
<th>Ordered Products</th>
<th>Order Status</th>
<th>Function</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    $cus_id = $row['cus_id'];
    $order_id = $row['o_id'];
    $sqlname="SELECT cus_fname, cus_lname FROM customers WHERE cus_id = $cus_id";
    $resultname = mysqli_query($conn,$sqlname);
    while($r = mysqli_fetch_array($resultname)) {
        $cus_name = $r['cus_fname'] . " " . $r['cus_lname'];
    }

  echo "<tr>";
  echo "<td>" . $row['o_id'] . "</td>";
  echo "<td>" . $row['o_date'] . "</td>";
  echo "<td>" . $cus_name . "</td>";
  echo "<td>";
    $sqlpro="SELECT pro_id, pro_name FROM products WHERE pro_id IN (SELECT pro_id FROM cart WHERE cus_id = $cus_id && ordered = 1 && order_id = $order_id)";
    $resulpro = mysqli_query($conn,$sqlpro);
    while($p = mysqli_fetch_array($resulpro)) {
        echo $p["pro_id"] . " | <a href = 'product.php?" . $p["pro_id"] ."'>" . $p["pro_name"] ."</a><br>";
    }
  echo "</td>";
  echo "<td>" . $row["o_status"] ."</td>";
  echo "<td> <form method='post' action=''><input type='hidden' name='ord_id' value='". $row["o_id"] ."' /> <button type='submit' name='deleteorder'> Delete </button>
  <button type='submit' name='updateorder'> Set Delivered </button> </form></td>";
  echo "</tr>";
}
echo "</table>";

    
mysqli_close($conn);
?>