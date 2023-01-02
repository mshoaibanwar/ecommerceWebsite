<?php
include 'connection.php';
include 'header.php';
?>
<html>
<script src="https://kit.fontawesome.com/c3f1d5478b.js" crossorigin="anonymous"></script>
<body>
    <!-- SIdeNav Mobile -->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">
        <a href="showcase.php?cat=">Dresses</a>
        <a href="showcase.php?cat=">Jeans</a>
        <a href="showcase.php?cat=">Jackets</a>
        <a href="showcase.php?cat=">Tops</a>
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

    

    <!-- Slideshow container -->
    <div class="slideshow-container">

        <!-- Full-width images with number -->
        <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <a href="showcase.php?cat="><img src="cover/cov (1).jpg"></a>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <a href="showcase.php?cat="><img src="cover/cov (2).jpg"></a>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <a href="showcase.php?cat="> <img src="cover/cov (3).jpg"></a>
        </div>

    </div>
    <br>

    <!-- The dots/circles -->
    <div class="dotclass" style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>

    <!--Script for SlideShow-->
    <script>
        var slideIndex = 0;
        showSlides();

        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            setTimeout(showSlides, 4000); // Change image every 4 seconds
        }
    </script>


    <!--Product Slideshow-->

    <h2 id="pproductscont" style="text-align:center;">POPULAR PRODUCTS</h2>
    <div class="productslideshow-container">

        <div class="productmySlides">
            <div class="products">

            <?php
                  $sql = "SELECT pro_id, pro_name, price, pro_img FROM products WHERE pro_id < 6";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
  // output data of each row
                  while($row = $result->fetch_assoc()) {

                  echo  '<form class="card" method="post" action="">
                       <input type="hidden" name="p_id" value="' .$row["pro_id"]. '" />                       
                    <a href="product.php?' . $row["pro_id"] . '">
                        <div class="picontainer">
                            <img src="'.$row["pro_img"].'" alt="Red Kurta" class="pimage">
                            <div class="poverlay">' . $row["pro_name"] . ' | ' . $row["price"] .'</div>
                            <div class="proid" style="display:none">' . $row["pro_id"] . '</div>
                        </div>
                    </a>
                    <button type="submit" class="add-to-cart">Add to Cart</button>
                    </form>';
                    }    
                  }
            ?>                
            </div>
        </div>
        
        <div class="productmySlides">
                      <div class="products">
                        <?php
                  $sql1 = "SELECT pro_id, pro_name, price, pro_img FROM products WHERE pro_id > 5 LIMIT 5";
                  $result1 = $conn->query($sql1);
                  if ($result1->num_rows > 0) {
  // output data of each row
                  while($row = $result1->fetch_assoc()) {

                  echo  '<form class="card" method="post" action="">
                       <input type="hidden" name="p_id" value="' .$row["pro_id"]. '" />                       
                    <a href="product.php?' . $row["pro_id"] . '">
                        <div class="picontainer">
                            <img src="'.$row["pro_img"].'" alt="Red Kurta" class="pimage">
                            <div class="poverlay">' . $row["pro_name"] . ' | ' . $row["price"] .'</div>
                            <div class="proid" style="display:none">' . $row["pro_id"] . '</div>
                        </div>
                    </a>
                    <button type="submizt" class="add-to-cart">Add to Cart</button>
                    </form>';    
                    }  
                  } 
            ?>            

        </div>
        </div>

        <a class="prev " onclick="pplusSlides(-1) ">❮</a>
        <a class="next " onclick="pplusSlides(1) ">❯</a>

    </div>
    
    <?php
                  $cust_id = 0;
                  if(!empty($_SESSION["loggedin"])){
                    $cust_id = $_SESSION["id"];
                  }
                  if (isset($_POST['p_id']) && $_POST['p_id']!="" && $cust_id!=0){
                  $code = $_POST["p_id"];
                  $in = true;
                  
                  $q = "SELECT pro_id, ordered FROM cart WHERE cus_id = $cust_id";
                  $r = $conn->query($q);
                  if ($r->num_rows > 0) {
                       while($ro = $r->fetch_assoc()) {
                                  if($ro["pro_id"] == $code && $ro["ordered"] == 0)
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
                else
                {
                        if($cust_id==0 && isset($_POST['p_id']))
                        {
                        
                        echo '<div id="NotiWindow" class="Notimodal">
                          <div class="Notimodal-content">
                            <span class="Noticlose">&times;</span>
                            <p>Not Logged In!</p>
                          </div>
                        </div>';
                        
                        }
                }
    ?>
    
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

    <div class="dot-container ">
        <span class="dot " onclick="pcurrentSlide(1) "></span>
        <span class="dot " onclick="pcurrentSlide(2) "></span>
    </div>

    <!--Script for Products SLideshow-->

    <script>
        var pslideIndex = 1;
        pshowSlides(pslideIndex);

        function pplusSlides(n) {
            pshowSlides(pslideIndex += n);
        }

        function pcurrentSlide(n) {
            pshowSlides(pslideIndex = n);
        }

        function pshowSlides(n) {
            var i;
            var slides = document.getElementsByClassName("productmySlides ");
            var dots = document.getElementsByClassName("dot ");
            if (n > slides.length) {
                pslideIndex = 1
            }
            if (n < 1) {
                pslideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none ";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active ", " ");
            }
            slides[pslideIndex - 1].style.display = "block ";
            dots[pslideIndex - 1].className += " active ";
        }
    </script>

    <!--Shop By Category Section-->

    <h2 style="text-align:center;">SHOP BY CATEGORY</h2>
    <div class="category-group">
        <a href="showcase.php?cat=3"><img src="Jeans.png" style="width:100%">
            <h4>JEANS</h4>
        </a>
        <a href="showcase.php?cat=2"><img src="Tops.png" style="width:100%">
            <h4>TOPS</h4>
        </a>
        <a href="showcase.php?cat=1"><img src="Dresses.png" style="width:100%">
            <h4>DRESSES</h4>
        </a>
        <a href="showcase.php?cat=5"><img src="Jackets.png" style="width:100%">
            <h4>JACKETS</h4>
        </a>
        <a href="showcase.php?cat=4"><img src="Pants.png" style="width:100%">
            <h4>PANTS</h4>
        </a>
        <a href="showcase.php?cat=6"><img src="Accessories.png" style="width:100%">
            <h4>ACCESSORIES</h4>
        </a>
    </div>

<?php require_once "footer.php"; ?>

</body>

</html>