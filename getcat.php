<?php
include 'connection.php';

$sql="SELECT * FROM categories ORDER BY cat_id ASC";
$result = mysqli_query($conn,$sql);

echo "<table>
<tr>
<th>ID</th>
<th>Category Name</th>
<th>Function</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['cat_id'] . "</td>";
  echo "<td>" . $row['cat_name'] . "</td>";
  echo "<td> <form method='post' action=''><input type='hidden' name='c_id' value='". $row["cat_id"] ."' /> <button type='submit' name='deletecat'> Delete </button> </form></td>";
  echo "</tr>";
}
echo "</table>";

    
mysqli_close($conn);
?>