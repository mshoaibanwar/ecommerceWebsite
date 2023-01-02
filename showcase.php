<?php
    session_start();
    include 'connection.php';
    include 'header.php';
    $cat_id = 0;
    $size = "";
    $prices = 0;
    $pricee = 0;
    if(!empty($_GET['cat']))
    {
      $cat_id = intval($_GET['cat']);
    }
    if(!empty($_GET['size']))
    {
      $size = $_GET['size'];
    }
    if(!empty($_GET['pricee']))
    {
      $prices = intval($_GET['prices']);
      $pricee = intval($_GET['pricee']);
    }
 
?>

<html>

<body>
    <!-- SIdeNav Mobile -->

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">
        <a href="showcase.php">Women</a>
        <a href="showcase.php">Jeans</a>
        <a href="showcase.php">Jackets</a>
        <a href="showcase.php">Best Sales</a>
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

    <!--Script for Login Box-->

    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>


    <div class="row">
        <div class="column">
            <h3 style="text-align:left;">BROWSE BY:</h3>
            <!-- Collapsable List Left Column -->
            <button class="collapsible" style="border-top: 1px solid black;">CATEGORY</button>
            <div class="content">
                <a class="Checkcontainer" href="showcase.php?cat=1" id="my-link">Dresses</a>
                <a class="Checkcontainer" href="showcase.php?cat=3" id="my-link">Jeans</a>
                <a class="Checkcontainer" href="showcase.php?cat=2" id="my-link">Tops</a>
                <a class="Checkcontainer" href="showcase.php?cat=5" id="my-link">Jackets</a>
                <a class="Checkcontainer" href="showcase.php?cat=6" id="my-link">Accessories</a>
            </div>
            <h3 style="text-align:left;">FILTER BY:</h3>
            <button class="collapsible" style="border-top: 1px solid black;">SIZE</button>
            <div class="content">
                <a class="Checkcontainer" href="showcase.php?size=S" id="my-link">Small</a>
                <a class="Checkcontainer" href="showcase.php?size=M" id="my-link">Medium</a>
                <a class="Checkcontainer" href="showcase.php?size=L" id="my-link">Large</a>
                <a class="Checkcontainer" href="showcase.php?size=XL" id="my-link">Extra Large</a>
            </div>
            <button class="collapsible">COLOR</button>
            <div class="content">
                <a class="Checkcontainer" href="search.php?q=blue" id="my-link">Blue</a>
                <a class="Checkcontainer" href="search.php?q=red" id="my-link">Red</a>
                <a class="Checkcontainer" href="search.php?q=green" id="my-link">Green</a>
                <a class="Checkcontainer" href="search.php?q=yellow" id="my-link">Yellow</a>
                <a class="Checkcontainer" href="search.php?q=black" id="my-link">Black</a>
                <a class="Checkcontainer" href="search.php?q=orange" id="my-link">Orange</a>
                <a class="Checkcontainer" href="search.php?q=gold" id="my-link">Gold</a>
                <a class="Checkcontainer" href="search.php?q=grey" id="my-link">Grey</a>
                <a class="Checkcontainer" href="search.php?q=white" id="my-link">White</a>
            </div>
            <button class="collapsible">PRICE</button>
            <div class="content">
                <a class="Checkcontainer" href="showcase.php?prices=0&pricee=1000" id="my-link">0-1000</a>
                <a class="Checkcontainer" href="showcase.php?prices=1001&pricee=5000" id="my-link">1001-5000</a>
                <a class="Checkcontainer" href="showcase.php?prices=5001&pricee=10000" id="my-link">5001-10000</a>
                <a class="Checkcontainer" href="showcase.php?prices=10001&pricee=50000" id="my-link">10001-50000</a>
            </div>
            <button class="collapsible">TYPE</button>
            <div class="content">
                <a class="Checkcontainer" href="showcase.php?cat=1" id="my-link">Dresses</a>
                <a class="Checkcontainer" href="search.php?q=wedding" id="my-link">Wedding</a>
                <a class="Checkcontainer" href="search.php?q=everyday" id="my-link">Everyday Wear</a>
                <a class="Checkcontainer" href="search.php?q=night" id="my-link">Night Dresses</a>
            </div>
            <button class="collapsible">STYLE</button>
            <div class="content">
                <a class="Checkcontainer" href="search.php?q=fit" id="my-link">Fit & Flare Dress</a>
                <a class="Checkcontainer" href="search.php?q=slip" id="my-link">Slip Dress</a>
                <a class="Checkcontainer" href="search.php?q=sweater" id="my-link">Sweater Dress</a>
                <a class="Checkcontainer" href="search.php?q=sweatshirt" id="my-link">Sweatshirt Dress</a>
                <a class="Checkcontainer" href="search.php?q=t-shirt" id="my-link">T-shirt Dress</a>
            </div>
            <button class="collapsible">LABELS</button>
            <div class="content">
            <a class="Checkcontainer" href="search.php?q=sana" id="my-link">Sana Safinaz</a>
            <a class="Checkcontainer" href="search.php?q=feroza" id="my-link">Feroza Sanaya</a>
            <a class="Checkcontainer" href="search.php?q=maria" id="my-link">Maria B</a>
            <a class="Checkcontainer" href="search.php?q=mayra" id="my-link">Mayra</a>
            </div>

            <!-- sCRIPT FOR COLLAPSABLE LIST-->
            <script>
                var coll = document.getElementsByClassName("collapsible");
                var i;

                for (i = 0; i < coll.length; i++) {
                    coll[i].addEventListener("click", function() {
                        this.classList.toggle("cactive");
                        var content = this.nextElementSibling;
                        if (content.style.maxHeight) {
                            content.style.maxHeight = null;
                        } else {
                            content.style.maxHeight = content.scrollHeight + "px";
                        }
                    });
                }
            </script>
        </div>
        <div style="margin-left: 4%; width: 62.67%" class="column02">

            <?php
                   $cat_name = "";
                   $sql = "SELECT cat_name FROM categories WHERE cat_id = $cat_id";
                   $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
  // output data of each row
                  while($row = $result->fetch_assoc()) {
                          $cat_name = $row["cat_name"];
                  }
                }
            ?>

            <h2 style="text-align:center;"><?php
             if($cat_id != 0)
              {
                echo $cat_name;
              }
              else if($size != "")
              {
                echo 'Size: '.$size;
              }
              else if($pricee != 0)
              {
                echo 'Price Between '.$prices.' And '.$pricee;
              }
              else
              {
                echo "All";
              }
             ?></h2>
            <div class="btn-group category-box" style="width:100%">
            <?php
                  if($cat_id != 0)
                  {
                    $sql = "SELECT pro_id, pro_name, price, pro_img FROM products WHERE cat_id = $cat_id";
                  }
                  else if($size != "")
                  {
                    $sql = "SELECT pro_id, pro_name, price, pro_img FROM products WHERE size = '$size'";
                  }
                  else if($pricee != 0)
                  {
                    $sql = "SELECT pro_id, pro_name, price, pro_img FROM products WHERE price BETWEEN $prices AND $pricee";
                  }
                  else
                  {
                    $sql = "SELECT pro_id, pro_name, price, pro_img FROM products";
                  }
                  
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
  // output data of each row
                  while($row = $result->fetch_assoc()) {
                  echo  '<form class="card" method="post" action="">
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
            <div class="center">
                <div class="pagination">
                    <a href="#">&laquo;</a>
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#">6</a>
                    <a href="#">&raquo;</a>
                </div>
            </div>

            <!-- Script for Add to Cart Button -->

            <script>
                i = 0;
                addToCartButton = document.querySelectorAll(".add-to-cart");

                document.querySelectorAll('.add-to-cart').forEach(function(addToCartButton) {
                    addToCartButton.addEventListener('click', function() {

                        if (addToCartButton.innerHTML == "Added!") {
                            addToCartButton.innerHTML = "Add to Cart";
                            document.getElementById("cart-quantity").innerHTML = i -= 1;
                        } else {
                            addToCartButton.innerHTML = "Added!";
                            document.getElementById("cart-quantity").innerHTML = i += 1;
                        }
                    });
                });
            </script>

        </div>
    </div>
    
        <!-- Script for NotiWindow-->
<script>
// Get the modal
var modal = document.getElementById("NotiWindow");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("Noticlose")[0];

// When the user clicks the button, open the modal 
function displayNoti() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

<?php require_once "footer.php"; ?>

</body>

</html>