<?php
include 'connection.php';

$sql="SELECT * FROM customers ORDER BY cus_id ASC";
$result = mysqli_query($conn,$sql);

echo "<table>
<tr>
<th>ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
<th>Function</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['cus_id'] . "</td>";
  echo "<td>" . $row['cus_fname'] . "</td>";
  echo "<td>" . $row['cus_lname'] . "</td>";
  echo "<td>" . $row['cus_email'] . "</td>";
  echo "<td> <form method='post' action=''><input type='hidden' name='cu_id' value='". $row["cus_id"] ."' /> <button type='submit' name='deletecus'> Delete </button> </form></td>";
  echo "</tr>";
}
echo "</table>";

    
mysqli_close($conn);
?>