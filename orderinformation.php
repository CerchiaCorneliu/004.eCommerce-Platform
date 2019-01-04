<?php
    session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Cart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }    
        
        $(document).ready(function(){
            $("#dropbtn1").click(function(){
                $("#dropdown-content1").show();
            });
            $(".dropdown").mouseleave(function(){
                $("#dropdown-content1").hide();
            });
        });
        
        $(document).ready(function(){
            $("#dropbtn2").click(function(){
                $("#dropdown-content2").show();
            });
            $(".dropdown").mouseleave(function(){
                $("#dropdown-content2").hide();
            });
        });
        
        $(document).ready(function(){
            $("#dropbtn3").click(function(){
                $("#dropdown-content3").show();
            });
            $(".dropdown").mouseleave(function(){
                $("#dropdown-content3").hide();
            });
        });
        
        $(document).ready(function(){
            $("#dropbtn4").click(function(){
                $("#dropdown-content4").show();
            });
            $(".dropdown").mouseleave(function(){
                $("#dropdown-content4").hide();
            });
        });
        
        $(document).ready(function(){
            $("#dropbtn5").click(function(){
                $("#dropdown-content5").show();
            });
            $(".dropdown").mouseleave(function(){
                $("#dropdown-content5").hide();
            });
        });
    </script>
</head>
<body>
	<header>
		<div class="container">
            <div id="imagelogo">
			    <?php 
                    if(isset($_SESSION['id'])) {
                        echo'<a href="home.php"><img src="img/mymarket1.png" alt="MyMarket"></a>'; 
                    }
                    if(!isset($_SESSION['id'])) {
                        echo'<a href="home.php"><img src="img/mymarket1.png" alt="MyMarket"></a>'; 
                    }
                ?>
            </div>
			<div id="main-menu">
				<ul>     
                    <?php 
                        if(isset($_SESSION['id'])) {
                        echo'<li><a href="home.php">Home</a></li>
                            <li><a href="myaccount.php">My Account</a></li>
                            <li><a href="mycart.php">My Cart</a></li>
                            <li><a class="actual" href="orderinformation.php">Order Info</a></li>
                            <li><a href="signin.php">Sign out, '.$_SESSION['lastname'].'</a></li>';
                        }
                        if(!isset($_SESSION['id'])) {
                        echo'<li><a href="home.php">Home</a></li>
                            <li><a href="signup.php">Sign up</a></li>
                            <li><a href="signin.php">Sign in</a></li>';
                        }
                    ?>
				</ul>
				<form>
					<input type="text" name="Search" placeholder="Search here...">
					<button type="submit"><i class="fa fa-search"></i></button>
				</form>
			</div>
		</div>
	</header>

	<section>
		<div class="container">
			<div id="shoppingcart">
                <h1>Order Information</h1>
                <p style = "text-align: center; font-size: 15px;">Your order has been requested. It will be processed in 5-6 working days.</p>

                <?php 
                    // Prepare variabiles for db connection
                    $serverName = "localhost";
                    $userName = "root";
                    $password = "";
                    $dbName = "authentication";

                    // Create connection
                    $conn = new mysqli($serverName,$userName,$password,$dbName);

                    // Check connection
                    if($conn->connect_error) {
                        die("Connection failed".$conn->connect_error);
                    }
                    
                    $query = mysqli_query($conn,'SELECT * FROM cart WHERE user_id='.$_SESSION['id']);
                ?>

                <table>
                    <tr>
                        <th>Shipping Address</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Amount</th>
                    </tr>
                    <?php
                        $total = 0;
                        while($row = mysqli_fetch_array($query)) { 
                            $amount = ($row['price'] * $row['quantity']);
                            $total += $amount;
                            echo "<tr>
                                    <td>".$row['user_id']."</td>
                                    <td>".$row['product_name']."</td>
                                    <td>"."$".$row['price']."</td>
                                    <td>".$row['quantity']."</td>
                                    <td>"."$".$amount."</td>
                                </tr>";    
                        }
                        mysqli_close($conn);

                        echo "<tr><td colspan='6'>"."Total: "."$".$total."</td></tr>";

                        echo "<tr id='ordertotal'>
                                    <td colspan='6'><button><a href='includes/deletefromcart.inc.php?user_id=".$_SESSION['id']."'>Cancel Order</a></button>
                                </tr>";
       
                    ?>    
                </table>
                <button id="ContinueShopping"><a href="home.php">Continue shopping</a></button>
            </div>
        </div>		
	</section>

    <div id="contact">
        <div class="container">
            <div class="column col-4">
                <div class="wrap">
                    <img id="logo" src="img/mymarket1.png" alt="MyMarket">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <p><a href=""><i class="fa fa-map-marker"></i>0123 Main Road, NY 123456</a></p>
                    <p><a href=""><i class="fa fa-phone"></i>(000) 1234-5678</a></p>
                    <p><a href=""><i class="fa fa-envelope"></i>info@mymarket.com</a></p>
                </div>
            </div>

            <div class="column col-4">
                <div class="wrap">
                    <h1>information</h1>
                    <p><a href="">Our Story</a></p>
                    <p><a href="">Privacy &amp; Policy</a></p>
                    <p><a href="">Terms &amp; Conditions</a></p>
                    <p><a href="">Shipping &amp; Delivery</a></p>
                    <p><a href="">Careers</a></p>
                    <p><a href="">FAQs</a></p>
                </div>
            </div>

            <div class="column col-4">
                <div class="wrap">
                    <h1>our social</h1>
                    <p><a href=""><i class="fa fa-google-plus"></i>Google+</a></p>
                    <p><a href=""><i class="fa fa-facebook"></i>Facebook</a></p>
                    <p><a href=""><i class="fa fa-twitter"></i>Twitter</a></p>
                    <p><a href=""><i class="fa fa-rss"></i>RSS</a></p>
                    <p><a href=""><i class="fa fa-youtube-play"></i>Youtube</a></p>
                </div>
            </div>

            <div class="column col-4">
                <div class="wrap">
                    <h1>opening time</h1>
                    <p>Monday-Friday: 08:30 am - 09.30 pm</p>
                    <p>Sat - Sun 09:00 am - 10:00 pm</p>
                    <h1>payment option</h1>
                    <img class="card" src="img/mastercard.png">
                    <img class="card" src="img/visa1.png">
                    <img class="card" src="img/paypal1.png">
                </div>
            </div>
        </div>
    </div>		

	<footer>
        <div class="container">
            <ul>
                <li><a href="">Sitemap</a></li>
                <li><a href="">Search</a></li>
                <li><a href="">Advance</a></li>
                <li><a href="">Contact Us</a></li>
            </ul>
		    <p>&copy;2018 MyMarket | All Rights Reserved</p>
        </div>
	</footer>
</body>
</html>
