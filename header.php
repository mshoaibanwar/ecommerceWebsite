<?php
if(!isset($_SESSION))
{
    session_start();
}
$message = "";
if(isset($_POST['SignButton'])){ //check if form was submitted
 $email = $_POST["uname"]; 
 $pass = $_POST["psw"];   
 $sql = "SELECT cus_id, cus_fname, cus_email, cus_pass FROM customers";
 $result = $conn->query($sql); 
 if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        if($row["cus_email"] == $_POST["uname"])
        {
            if($row["cus_pass"] == $_POST["psw"])
            {
              $message = "Login Successful!";
              
              // Password is correct, so start a new session
                         if(!isset($_SESSION))
                         {
                            session_start();
                         }
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $row["cus_id"];
                            $_SESSION["username"] = $row["cus_fname"];
                          
               break;
            }
            else{
              $message = "Wrong Password!";
            }
        }
        else{
          $message = "Email not found!";
        }
    }
  }
}

if(isset($_POST['RegButton'])){ //check if form was submitted
         $fname = $_POST["fname"];
         $lname = $_POST["lname"];
         $email = $_POST["email"];
         $pass = $_POST["pass"];   
         $sql = "INSERT INTO customers (cus_fname, cus_lname, cus_email, cus_pass) VALUES ('$fname', '$lname', '$email', '$pass')";
         if ($conn->query($sql) === TRUE) {
                  $message =  "Account Registered successfully";
         } else {
                  $message =  "Error: " . $sql . "<br>" . $conn->error;
         }
 }
 
if($message != "")
{
echo '<div id="NotiWindow" class="Notimodal">
                          <div class="Notimodal-content">
                            <span class="Noticlose">&times;</span>
                            <p>'.$message.'</p>
                          </div>
                        </div>';
$message = "";
}


?>

<html>
<head>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/c3f1d5478b.js" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        SHESHINE
    </title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <div class="topnav" id="myTopnav" style="box-shadow: 0 0.0rem 0.2rem #ddd;">
        <button class="menubtn" style="left: 2%; display: none;" id="menubtn" onclick="openNav()"><i class="fas fa-bars"></i></button>
        <div class="logo">
            <a href="index.php" style="float: none;">SHESHINE
            </a>
        </div>
       
        <script type="text/javascript">
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("cart-quantity").innerHTML = this.responseText;
  }
  xhttp.open("GET", "cart_quantity.php");
  xhttp.send();

</script>
        
<?php
        if(!empty($_SESSION["loggedin"])){
                echo '<form style="margin-bottom: 0;" action="" method="POST"><button type="submit" name="logout" class="mtext" id="logoutbtn" onclick="">
                <i class="fa fa-sign-out" style="margin-right: 5px"></i>Logout 
            </button></form>';
        }
        if(isset($_POST['logout']))
        {
            session_destroy();
            $_SESSION["loggedin"] = false;
            $_SESSION["id"] = 0;
            $_SESSION["username"] = "";
        }
?>
        <button class="mtext" id="cartbtn" onclick="location.href='cart.php';">
            <i class="fas fa-shopping-bag"></i>
            <span id="cart-quantity"></span>
        </button>
        <button class="mtext" id="userbtn" onclick='<?php if(!empty($_SESSION["loggedin"])){}else {echo 'document.getElementById("id01").style.display="block"';}?>'>
            <i class="far fa-user" style="margin-right: 5px"></i><?php if(!empty($_SESSION["loggedin"])){echo $_SESSION["username"];}?> 
        </button>
        <button onclick="openSearch()" class="searchbtn mtext" type="submit"><i class="fas fa-search"></i></button>
    </div>

    <div id="myOverlay" class="overlay-search">
        <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
        <div class="overlay-search-content">
            <form action="" method="POST">
                <input type="text" placeholder="Search.." name="search" id="sfield">
                    <button type="submit" name="searchb"><i class="fa fa-search"></i></button>
            </form>

        </div>
    </div>

    <?php
            $que = "";
                        if(isset($_POST['searchb']))
                        {
                            $que = $_POST["search"];
                        }
            ?>
            <script>
                    function search() {
                    //    var q = document.getElementById("sfield").value;
                    var q = "<?php echo $que;?>";
                       var link = "search.php?q=";
                       window.location.href = link + q;
                    }
            </script>

    <?php
            if(isset($_POST['searchb']))
            {
               echo '<script>search();</script>';
            }
    ?>
    
    
    <!-- Script for NotiWindow-->
<script>
var modal = document.getElementById("NotiWindow");
var span = document.getElementsByClassName("Noticlose")[0]; 
function displayNoti() {
  modal.style.display = "block";
}
span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
    
    <script>
        function openSearch() {
            document.getElementById("myOverlay").style.display = "block";
        }
        function closeSearch() {
            document.getElementById("myOverlay").style.display = "none";
        }
    </script>

    <div class="navbar" id="navbar" style="margin-bottom: 8px; box-shadow: 0 0.15rem 0.2rem #ddd;">
        <div class="dropdown">
            <button class="dropbtn mtext" onclick="dropbtn()">WOMEN
          </button>
            <div class="dropdown-content" id="dropdown-content">
                <div class="header">
                    <h2>WOMEN</h2>
                </div>
                <div class="row">
                    <div class="column">
                        <h3>NEW & NOW</h3>
                        <a href="search.php?q=holiday">Holiday Outfits</a>
                        <a href="search.php?q=gift">Gifts for Her</a>
                        <a href="search.php?q=vacation">Vacation Shop</a>
                    </div>
                    <div class="column">
                        <h3>Wedding Dress</h3>
                        <a href="search.php?q=lehnga">Lehnga</a>
                        <a href="search.php?q=bridal">Bridal</a>
                        <a href="search.php?q=gharara">Gharara</a>
                    </div>
                    <div class="column">
                        <h3>Everyday</h3>
                        <a href="search.php?q=everyday">Everyday</a>
                        <a href="search.php?q=night">Night</a>
                        <a href="search.php?q=trouser">trousers</a>
                    </div>
                </div>
            </div>
        </div>

        <a href="showcase.php?cat=3" class="mtext">JEANS COUTURE</a>

        <a href="search.php?q=summer" class="mtext">SUMMER COLLECTION</a>

        <a href="search.php?q=winter" class="mtext">WINTER COLLECTION</a>

        <div class="dropdown">
            <button class="dropbtn mtext" onclick="dropbtn()">BRANDS
                  </button>
            <div class="dropdown-content" id="dropdown-content">
                <div class="header">
                    <h2>BRANDS</h2>
                </div>
                <div class="row">
                    <div class="column">
                        <h3>Sana Safinaz</h3>
                        <a href="showcase.php?prices=0&pricee=1000">Under 1000</a>
                        <a href="showcase.php?prices=0&pricee=5000">Under 5000</a>
                        <a href="showcase.php?prices=0&pricee=15000">Under 15000</a>
                    </div>
                    <div class="column">
                        <h3>Maria B</h3>
                        <a href="showcase.php?prices=0&pricee=1000">Under 1000</a>
                        <a href="showcase.php?prices=0&pricee=5000">Under 5000</a>
                        <a href="showcase.php?prices=0&pricee=15000">Under 15000</a>
                    </div>
                    <div class="column">
                        <h3>MTJ</h3>
                        <a href="showcase.php?prices=0&pricee=1000">Under 1000</a>
                        <a href="showcase.php?prices=0&pricee=5000">Under 5000</a>
                        <a href="showcase.php?prices=0&pricee=15000">Under 15000</a>
                    </div>
                </div>
            </div>
        </div>

        <a href="showcase.php?cat=5" class="mtext">JACKETS</a>

        <div class="dropdown">
            <button class="dropbtn mtext" onclick="dropbtn()">BEST SALES
          </button>
            <div class="dropdown-content" id="dropdown-content">
                <div class="header">
                    <h2>BEST OF YEAR</h2>
                </div>
                <div class="row">
                    <div class="column">
                        <h3>BUDGETED BRIDALS</h3>
                        <a href="search.php?q=bridal">Nikkah Bridals</a>
                        <a href="search.php?q=walima">Walima Bridal</a>
                        <a href="search.php?q=mehndi">Mehndi Bridal</a>
                    </div>
                    <div class="column">
                        <h3>Formals</h3>
                        <a href="search.php?q=1PC">1 PC</a>
                        <a href="search.php?q=2PC">2 PCs</a>
                        <a href="search.php?q=3PC">3 PCs</a>
                    </div>
                    <div class="column">
                        <h3>BEST SELLING</h3>
                        <a href="search.php?q=lawn">Lawn</a>
                        <a href="search.php?q=sitara">Sitara</a>
                        <a href="search.php?q=chiffon">Chiffon</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
<div id="id01" class="modal">
<div class="regcontainer" id="regcont">
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form action="" method="post">
            <h1>Create Account</h1>
            <span>Use your email for registration</span>
            <input type="text" placeholder="First Name" name="fname" required/>
            <input type="text" placeholder="Last Name" name="lname" />
            <input type="email" placeholder="Email" name="email" required/>
            <input type="password" placeholder="Password" name="pass" required/>
            <button type="submit" name="RegButton">Sign Up</button>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form action="" method="post">
            <h1>Sign in</h1>
            <span>Use your Email to Login</span>
            <input type="email" placeholder="Email" name="uname" required/>
            <input type="password" placeholder="Password" name="psw" required/>
            <a href="#">Forgot your password?</a>
            <button type="submit" name="SignButton">Sign In</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Enter your personal details and start journey with us</p>
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
    </div>
</div>
</div>
</div>
    
    <!-- Script for Login/Reg Box -->
    <script>
        // Get the modal
        var regmodal = document.getElementById('id01');
        var reg = document.getElementById('regcont');
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
          if (event.target == reg) {
          reg.style.display = "none";
          regmodal.style.display = "none";
            }
          }
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');
        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });
        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    </script>

</head>

</html>