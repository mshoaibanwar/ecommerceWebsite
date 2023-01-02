<?php
session_start();
include 'connection.php';
include 'header.php';
$cust_id = 0;
 $source_url = $_SERVER['QUERY_STRING'];
 if(!empty($_SESSION["loggedin"])){
        $cust_id = $_SESSION["id"];
 }

$name = "";
$img = "";
$img1 = "";
$img2 = "";
$price = 0;

  $sql = "SELECT pro_name, pro_img, pro_img1, pro_img2, price FROM products WHERE pro_id = $source_url";
  $result = $conn->query($sql); 
 if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
          $name = $row["pro_name"];
          $img = $row["pro_img"];
          $img1 = $row["pro_img1"];
          $img2 = $row["pro_img2"];
          $price = $row["price"];
        
    }
  }

  if(isset($_POST['AddToCartBT'])){ //check if form was submitted
    $size = $_POST['sizes'];
    $query = "INSERT INTO cart (cus_id, pro_id, pro_size) VALUES ($cust_id, $source_url, '$size')";
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


    <div style="margin: 0 5%;" class="row">
        <div style="width: 50%; margin: 1% 5%;" class="column02">

            <div style="width: 80%;" class="slideshow-container">

                <div class="mySlides fade">
                    <div class="numbertext">1 / 3</div>
                    <img src="<?php echo $img ?>" style="width:100%; border-radius: 2%;">
                    <!-- <div class="text">Caption Text</div> -->
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">2 / 3</div>
                    <img src="<?php echo $img1 ?>" style="width:100%; border-radius: 2%;">
                    <!-- <div class="text">Caption Two</div> -->
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">3 / 3</div>
                    <img src="<?php echo $img2 ?>" style="width:100%; border-radius: 2%;">
                    <!-- <div class="text">Caption Three</div> -->
                </div>

                <a class="pprev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="pnext" onclick="plusSlides(1)">&#10095;</a>


                <div class="pdotclass" style="text-align:center">
                    <span class="pdot" onclick="currentSlide(1)"></span>
                    <span class="pdot" onclick="currentSlide(2)"></span>
                    <span class="pdot" onclick="currentSlide(3)"></span>
                </div>
            </div>


            <br>



            <script>
                var slideIndex = 1;
                showSlides(slideIndex);

                function plusSlides(n) {
                    showSlides(slideIndex += n);
                }

                function currentSlide(n) {
                    showSlides(slideIndex = n);
                }

                function showSlides(n) {
                    var i;
                    var slides = document.getElementsByClassName("mySlides");
                    var dots = document.getElementsByClassName("pdot");
                    if (n > slides.length) {
                        slideIndex = 1
                    }
                    if (n < 1) {
                        slideIndex = slides.length
                    }
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                    }
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex - 1].style.display = "block";
                    dots[slideIndex - 1].className += " active";
                }
            </script>



        </div>

        <div class="column">
            <h2 class="prot" style="text-align:left; padding-top: 0px;"><?php echo $name ?></h2>
            <p style="font-weight: 700;" class="prot">PKR <?php echo $price ?></p>
            <label class="prot" for="sizes">Choose Size:</label>
            <form method="post" action="">
            <select class="prot" name="sizes" id="sizes">
                <option value="S" selected>Small</option>
                <option value="M">Medium</option>
                <option value="L">Large</option>
                <option value="XL">Extra Large</option>
            </select>
            <button type="submit" class="AddToCart" name="AddToCartBT">Add to Cart</button>
            </form>
            <div class="ProductRatings">
                <span class="heading" style="margin-left: 12px;">User Rating</span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
            </div>
            <p style="padding-left: 12px;">4.1 average based on 254 reviews.</p>
            <hr style="border:3px solid #f1f1f1">

            <div class="row">
                <div class="side">
                    <div>5 star</div>
                </div>
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-5"></div>
                    </div>
                </div>
                <div class="side rright">
                    <div>150</div>
                </div>
                <div class="side">
                    <div>4 star</div>
                </div>
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-4"></div>
                    </div>
                </div>
                <div class="side rright">
                    <div>63</div>
                </div>
                <div class="side">
                    <div>3 star</div>
                </div>
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-3"></div>
                    </div>
                </div>
                <div class="side rright">
                    <div>15</div>
                </div>
                <div class="side">
                    <div>2 star</div>
                </div>
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-2"></div>
                    </div>
                </div>
                <div class="side rright">
                    <div>6</div>
                </div>
                <div class="side">
                    <div>1 star</div>
                </div>
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-1"></div>
                    </div>
                </div>
                <div class="side rright">
                    <div>20</div>
                </div>
            </div>

            <p style="padding-left: 12px; margin-top: 60px;">Get 20% off your first purchase + Free Shipping and Returns with the Credit Card.</p><a style="background-color: whitesmoke; width: 92%; margin-left: 12px;" href="#">Apply Now!</a>

        </div>
    </div>

    < <h2 style="text-align: center;">RELATED PRODUCTS</h2>



        <!--Product Slideshow-->
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
            </form>';
            }    
          }
    ?>                
    </div>
</div>

<div class="productmySlides">
              <div class="products">
                <?php
          $sql1 = "SELECT pro_id, pro_name, price, pro_img FROM products WHERE pro_id > 5 Limit 5";
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
            </form>';    
            }  
          } 
    ?>            

</div>
</div>

            <a class="prev " onclick="pplusSlides(-1) ">❮</a>
            <a class="next " onclick="pplusSlides(1) ">❯</a>

        </div>

        <div class="dot-container ">
            <span class="dot " onclick="pcurrentSlide(1) "></span>
            <span class="dot " onclick="pcurrentSlide(2) "></span>
        </div>

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