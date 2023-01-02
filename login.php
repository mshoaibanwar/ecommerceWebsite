<?php
 $conn = new mysqli("fdb32.awardspace.net", "3990962_ocs", "shoaib123", "3990962_ocs");
 $email = $_POST["uname"]; 
 $pass = $_POST["psw"]; 
 $sql = "SELECT cus_email, cus_pass FROM customers";
 $result = $conn->query($sql); 
 if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        if($row["cus_email"] == $_POST["uname"])
        {
            if($row["cus_pass"] == $_POST["psw"])
            {
               echo "Login Successful!";
               break;
            }
            else{
                echo "Wrong Password!";
            }
        }
        else{
            echo "Wrong Email!";
        }
    }
  }
?>