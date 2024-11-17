<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<style>
  .dropbtn {
    background-color: #3498DB;
    color: white;
    font-size: 16px;
    border: none;
    cursor: pointer;
    width: 200px;
    /* Set button width */
    height: 50px;
    /* Set button height */
    font-weight: bolder;
    /* Make button text bold */
    border: 2px solid black;
    /* Added border */
    transition: background-color 0.3s ease;
    /* Smooth transition for hover */
  }

  .dropbtn:hover,
  .dropbtn:focus {
    background-color: #2980B9;
    /* Darker blue on hover */
  }

  .dropdown {
    display: inline-block;
  }

  .dropdown-content {
    display: none;
    background-color: #f1f1f1;
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
  }

  .dropdown-content a {
    color: black;
    text-decoration: none;
    display: block;
    padding: 10px;
    /* Added padding for links */
  }

  .dropdown a:hover {
    background-color: #ddd;
    /* Background color change on hover */
  }

  .show {
    display: block;
  }

  img {
    width: 200px;
    height: 200px;
    padding: 20px;
  }

  .card {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    margin: 10px;
  }

  .carditems {
    display: flex;
    flex-direction: column;
    padding: 30px;
    font-size: bolder;
    font-weight: bolder;
  }

  #display {
    align-items: center;
    justify-content: center;
  }

  /* Buy button styling */
  button[name="btn"] {
    background-color: #ff4757;
    /* Button color */
    color: white;
    /* Button text color */
    border: none;
    /* Remove border */
    border-radius: 5px;
    /* Rounded corners */
    padding: 10px 15px;
    /* Button padding */
    cursor: pointer;
    /* Pointer cursor */
    transition: background-color 0.3s ease;
    /* Smooth transition for hover */
  }

  button[name="btn"]:hover {
    background-color: #e84118;
    /* Darker red on hover */
  }
</style>

<link rel="stylesheet" href="Home.css">

<body>

  <?php
  $server = "localhost";
  $username = "root";
  $password = "root@123";
  $db = "buysell";

  $conn = new mysqli($server, $username, $password, $db);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  ?>

  <nav class="navbar">
    <div class="buyNsell">
      IITG Buy and Sell
    </div>

    <div class="content">
      <ul class="items">
        <li class="sell">
          <a class="nav-link" href="dropdown.html">Sell</a>
        </li>
        <li class="sell">
          <a class="nav-link" href="myProduct.php">My Product</a>
        </li>
        <li class="contactus">
          <a class="nav-link" href="connect.html">Contact us</a>
        </li>
        <div class="drop">
          <h2></h2>
          <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn">- - - Select Category - - - </button>
            <div id="myDropdown" class="dropdown-content">
              <a href="electronics1.php">Electronics</a>
              <a href="furniture1.php">Furniture</a>
              <a href="stationary1.php">Stationary</a>
              <a href="vehicle1.php">Vehicle</a>
            </div>
          </div>
        </div>
        <script>
          /* When the user clicks on the button,
                toggle between hiding and showing the dropdown content */
          function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
          }

          // Close the dropdown if the user clicks outside of it
          window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
              var dropdowns = document.getElementsByClassName("dropdown-content");
              for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                  openDropdown.classList.remove('show');
                }
              }
            }
          }
        </script>
      </ul>
    </div>
  </nav>

  <div id="display">
    <?php
    $query = "SELECT * FROM `others` WHERE status IS NULL";
    $result = mysqli_query($conn, $query);

    while ($data = mysqli_fetch_assoc($result)) {
    ?>
      <div class="card">
        <img src="./Upload/<?php echo $data['Image']; ?>">
        <div class="carditems">
          <div class="productName">Product Name : <?php echo $data['Product_Name']; ?></div>
          <div class="Price">Price : <?php echo $data['Price']; ?></div>
          <div class="Desciption">Description : <?php echo $data['Description']; ?></div>
        </div>
        <form action="Show_details.php" method="post">
          <input type="hidden" name="emailss" value="<?php echo $data['email']; ?>">
          <button name="btn">BUY</button>
        </form>
      </div>
    <?php
    }
    ?>
  </div>

</body>

</html>
