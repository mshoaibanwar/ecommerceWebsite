<?php
include "connection.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        html,
        body,
        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: "Raleway", sans-serif
        }
    </style>
</head>

<body class="w3-light-grey">

    <!-- Top container -->
    <div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
        <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
        <span class="w3-bar-item w3-right">SheShine Admin</span>
    </div>

    <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
        <div class="w3-container w3-row">
            <div class="w3-col s4">
                <img src="https://w3schools.com/w3images/avatar2.png" class="w3-circle w3-margin-right" style="width:46px">
            </div>
            <div class="w3-col s8 w3-bar">
                <span>Welcome, <strong>Admin</strong></span><br>
                <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
                <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
                <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
            </div>
        </div>
        <hr>
        <div class="w3-container">
            <h5>Dashboard</h5>
        </div>
        <div class="w3-bar-block" id="menu">
            <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
            <a href="#" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-diamond fa-fw"></i>  Overview</a>
            <a href="#categories" class="w3-bar-item w3-button w3-padding "><i class="fa fa-list-alt fa-fw"></i>  Categories</a>
            <a href="#products" class="w3-bar-item w3-button w3-padding"><i class="fa fa-folder-o fa-fw"></i>  Products</a>
            <a href="#users" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Users</a>
            <a href="#orders" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullhorn fa-fw"></i>  Orders</a>
        </div>

            <script>
                // Add active class to the current button (highlight it)
                var header = document.getElementById("menu");
                var btns = header.getElementsByClassName("w3-button");
                for (var i = 0; i < btns.length; i++) {
                btns[i].addEventListener("click", function() {
                var current = document.getElementsByClassName("w3-blue");
                current[0].className = current[0].className.replace(" w3-blue", "");
                this.className += " w3-blue";
                });
                }
            </script>
    </nav>


    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

    <!-- !PAGE CONTENT! -->
    <div class="w3-main" style="margin-left:300px;margin-top:43px;">

        <!-- Header -->
        <header class="w3-container" style="padding-top:22px">
            <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
        </header>

        <?php
        $cats = 0;
        $pros = 0;
        $orders = 0;
        $users = 0;
                $sql11="SELECT COUNT(cat_id) AS cats FROM categories";
                $result11 = mysqli_query($conn,$sql11);
                if($result11->num_rows > 0) {
                    while($row = mysqli_fetch_array($result11)) {
                        $cats = $row['cats'];
                    }
                }
                

                $sql22="SELECT COUNT(pro_id) AS proid FROM products";
                $result22 = mysqli_query($conn,$sql22);
                while($row22 = mysqli_fetch_array($result22)) {
                        $pros = $row22['proid'];
                }

                $sql33="SELECT COUNT(o_id) AS orderr FROM orders";
                $result33 = mysqli_query($conn,$sql33);
                while($row33 = mysqli_fetch_array($result33)) {
                        $orders = $row33['orderr'];
                }

                $sql44="SELECT COUNT(cus_id) AS custs FROM customers";
                $result44 = mysqli_query($conn,$sql44);
                while($row44 = mysqli_fetch_array($result44)) {
                        $users = $row44['custs'];
                }
        ?>

        <div id="Overview">
            <div class="w3-row-padding w3-margin-bottom">
                <div class="w3-quarter">
                    <div class="w3-container w3-red w3-padding-16">
                        <div class="w3-left"><i class="fa fa-list-alt w3-xxxlarge"></i></div>
                        <div class="w3-right">
                            <h3><?php echo $cats; ?></h3>
                        </div>
                        <div class="w3-clear"></div>
                        <h4>Categories</h4>
                    </div>
                </div>
                <div class="w3-quarter">
                    <div class="w3-container w3-blue w3-padding-16">
                        <div class="w3-left"><i class="fa fa-folder-o w3-xxxlarge"></i></div>
                        <div class="w3-right">
                            <h3><?php echo $pros; ?></h3>
                        </div>
                        <div class="w3-clear"></div>
                        <h4>Products</h4>
                    </div>
                </div>
                <div class="w3-quarter">
                    <div class="w3-container w3-teal w3-padding-16">
                        <div class="w3-left"><i class="fa fa-bullhorn w3-xxxlarge"></i></div>
                        <div class="w3-right">
                            <h3><?php echo $orders; ?></h3>
                        </div>
                        <div class="w3-clear"></div>
                        <h4>Orders</h4>
                    </div>
                </div>
                <div class="w3-quarter">
                    <div class="w3-container w3-orange w3-text-white w3-padding-16">
                        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
                        <div class="w3-right">
                            <h3><?php echo $users; ?></h3>
                        </div>
                        <div class="w3-clear"></div>
                        <h4>Users</h4>
                    </div>
                </div>
            </div>
            <hr id="categories">
        </div>

        <div style="margin:10%;">
        <h2 style="text-align:center;">Categories</h2>
            <div id="cate_view"></div>
            <div id="add_cate" class="add_cat" style="margin-top:5%;">
                <form method="post" action="">
                    <div class="row">
                        <div class="col-25">
                            <label for="fname">Category</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="cat_name" name="cat_name" placeholder="Catergory Name....">
                        </div>
                    </div>

                    <div class="row">
                        <button type="submit" name="AddCat">Add</button>
                    </div>
                </form>

                <?php

if(isset($_POST["AddCat"])){ //check if form was submitted
    $catname = $_POST["cat_name"];
    $in = true;
    $sql = "SELECT cat_name, MAX(cat_id) AS c_id FROM categories";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result)) {
            $cat_id = $row["c_id"] + 1;
            if($row["cat_name"] == $catname)
            {
                   $in = false;
                   echo "Already Inserted!";
            }
    }
    if($in == true)
    {
        $sql = "INSERT INTO categories (cat_id, cat_name) VALUES ($cat_id, '$catname')";
        if ($conn->query($sql) === TRUE) {
                 echo "Data Inserted Successfully!";
        } else {
                 echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

if(isset($_POST["deletecat"])){ //check if form was submitted
    $cat_idd = $_POST["c_id"];    
    $sql = "DELETE FROM categories WHERE cat_id = $cat_idd";
    if ($conn->query($sql) === TRUE) {
        echo "Record Deleted Successfully!";
    } else {
        echo  "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>
</div>
</div>
<hr id="products">
<div style="margin:10%;">
<h2 style="text-align:center;">Products</h2>
<div id="pro_view"></div>

<form action="" method="POST" enctype="multipart/form-data">
                    <div class="chrow">
                        <div class="col-50">
                            <h3>Product Form</h3>
                            <label for="pname">Product Name</label>
                            <input type="text" id="pname" name="proname" placeholder="Dress Name" required>
                            <label for="details">Details</label>
                            <input type="text" id="details" name="details" placeholder="Description of Product" required>
                            <label for="price"> Price</label>
                            <input type="number" id="price" name="price" placeholder="0000" required>
                            <label for="sizes">Size</label>
                            <select style="width: 100% !important; margin: 0!important" name="sizes" id="sizes">
                                <option value="S" selected>Small</option>
                                <option value="M">Medium</option>
                                <option value="L">Large</option>
                                <option value="XL">Extra Large</option>
                            </select>
                            <label for="cat">Category</label>
                            <select style="width: 100% !important; margin: 0!important" name="category" id="category">
                            <?php
                                        $sql="SELECT * FROM categories ORDER BY cat_id ASC";
                                        $result = mysqli_query($conn,$sql);
                                        while($row = mysqli_fetch_array($result)) {
                                          echo '<option value="'.$row["cat_id"].'" selected>'.$row["cat_name"].'</option>';
                                        }
                            ?>
                            </select>
                            <label for="quant"> Quantity</label>
                            <input type="number" id="quant" name="quant" placeholder="5" required>

                            <label for="pic1">Photo 1</label>
                            <input type="file" id="pic1up" name="pic1up" required>
                            <label for="pic2">Photo 2</label>
                            <input type="file" id="pic2" name="pic2" required>
                            <label for="pic3">Photo 3</label>
                            <input type="file" id="pic3" name="pic3" required>
                        </div>

                    </div>
                    <input type="submit" name="add_item" value="Add Item" class="chbtn">
                </form>
         </div>

<?php

    // picture Upload
    $target_dir = "img/";

if(isset($_POST["add_item"])){ //check if form was submitted
    $target_file = $target_dir . basename($_FILES["pic1up"]["name"]);
    if (move_uploaded_file($_FILES["pic1up"]["tmp_name"], $target_file)) {
       // echo "The file ".$target_dir. htmlspecialchars( basename( $_FILES["pic1up"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
      $imgloc1 = $target_dir. htmlspecialchars( basename( $_FILES["pic1up"]["name"]));

      $target_file1 = $target_dir . basename($_FILES["pic2"]["name"]);
      if (move_uploaded_file($_FILES["pic2"]["tmp_name"], $target_file1)) {
         // echo "The file ".$target_dir. htmlspecialchars( basename( $_FILES["pic2"]["name"])). " has been uploaded.";
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
        $imgloc2 = $target_dir. htmlspecialchars( basename( $_FILES["pic2"]["name"]));

        $target_file2 = $target_dir . basename($_FILES["pic3"]["name"]);
        if (move_uploaded_file($_FILES["pic3"]["tmp_name"], $target_file2)) {
           // echo "The file ".$target_dir. htmlspecialchars( basename( $_FILES["pic3"]["name"])). " has been uploaded.";
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
          $imgloc3 = $target_dir. htmlspecialchars( basename( $_FILES["pic3"]["name"]));


    $pro_name = $_POST['proname'];
    $pro_details = $_POST['details'];
    $pro_price = $_POST['price'];
    $pro_size = $_POST['sizes'];
    $pro_cat = $_POST['category'];
    $pro_quant = $_POST['quant'];
    $pro_img1 = $_POST['pic1'];
    $pro_img2 = $_POST['pic2'];
    $pro_img3 = $_POST['pic3'];
    $sql = "INSERT INTO products VALUES(default, $pro_cat, '$pro_name', '$imgloc1', '$imgloc2', '$imgloc3', $pro_price, '$pro_size', '$pro_details', $pro_quant)";
    if ($conn->query($sql) === TRUE) {
        echo "Product Added Successfully!";
    } else {
        echo  "Error: " . $sql . "<br>" . $conn->error;
    }
}

if(isset($_POST["deletepro"])){ //check if form was submitted
    $pro_idd = $_POST["p_id"];    
    $sql = "DELETE FROM products WHERE pro_id = $pro_idd";
    if ($conn->query($sql) === TRUE) {
        echo "Product Deleted Successfully!";
    } else {
        echo  "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


<hr id="users">
<div style="margin:10%;">
<h2 style="text-align:center;">Users</h2>
<div id="user_view"></div>
<?php
if(isset($_POST["deletecus"])){ //check if form was submitted
    $cus_idd = $_POST["cu_id"];    
    $sql = "DELETE FROM customers WHERE cus_id = $cus_idd";
    if ($conn->query($sql) === TRUE) {
        echo "User Deleted Successfully!";
    } else {
        echo  "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
</div>

<hr id="orders">
<div style="margin:10%;">
<h2 style="text-align:center;">Orders</h2>
<div id="order_view"></div>
<?php
if(isset($_POST["deleteorder"])){ //check if form was submitted
    $order_idd = $_POST["ord_id"];    
    $sql = "DELETE FROM orders WHERE o_id = $order_idd";
    if ($conn->query($sql) === TRUE) {
        echo "Order Deleted Successfully!";
    } else {
        echo  "Error: " . $sql . "<br>" . $conn->error;
    }
    $sqlcart = "DELETE FROM cart WHERE order_id = $order_idd && ordered = 1";
    if ($conn->query($sqlcart) === TRUE) {
    } else {
        echo  "Error: " . $sql . "<br>" . $conn->error;
    }
}
if(isset($_POST["updateorder"])){ //check if form was submitted
    $order_idd = $_POST["ord_id"]; 
    $sql = "UPDATE orders SET o_status = 'Delivered' WHERE o_id = $order_idd";
    if ($conn->query($sql) === TRUE) {
        echo "Status Updated Successfully!";
    } else {
        echo  "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
</div>

<script>
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("order_view").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "getorders.php", true);
                xmlhttp.send();
</script>

<script>
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("user_view").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "getusers.php", true);
                xmlhttp.send();
</script>

<script>
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("pro_view").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "getpro.php", true);
                xmlhttp.send();
</script>

<script>
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("cate_view").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "getcat.php", true);
                xmlhttp.send();
</script>
        
        <!-- Footer -->
        <footer class="w3-container w3-padding-16 w3-light-grey">
            <h4>FOOTER</h4>
            <p>Powered by <a href="index.php" target="_blank">SheShine</a></p>
        </footer>

        <!-- End page content -->
    </div>

    <script>
        // Get the Sidebar
        var mySidebar = document.getElementById("mySidebar");

        // Get the DIV with overlay effect
        var overlayBg = document.getElementById("myOverlay");

        // Toggle between showing and hiding the sidebar, and add overlay effect
        function w3_open() {
            if (mySidebar.style.display === 'block') {
                mySidebar.style.display = 'none';
                overlayBg.style.display = "none";
            } else {
                mySidebar.style.display = 'block';
                overlayBg.style.display = "block";
            }
        }

        // Close the sidebar with the close button
        function w3_close() {
            mySidebar.style.display = "none";
            overlayBg.style.display = "none";
        }
    </script>

</body>

</html>