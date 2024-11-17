<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="Home.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      /* Consistent font across the page */
      background-color: #f8f9fa;
      /* Light background for better readability */
      margin: 0;
      /* Remove default margin */
      padding: 0;
      /* Remove default padding */
    }

    nav {
      background-color: #007bff;
      /* Blue background for navigation */
      padding: 10px;
      /* Padding for spacing */
    }

    .navbar .buyNsell {
      color: white;
      /* White text color for brand name */
      font-size: 24px;
      /* Larger font size */
      font-weight: bold;
      /* Bold text for emphasis */
    }

    .content .items {
      list-style-type: none;
      /* Remove bullet points */
      padding: 0;
      /* Remove padding */
    }

    .content .items li {
      display: inline;
      /* Display items in a row */
      margin-right: 20px;
      /* Space between items */
    }

    .content .items li a {
      color: white;
      /* White text for links */
      text-decoration: none;
      /* Remove underline from links */
    }

    .content .items li a:hover {
      text-decoration: underline;
      /* Underline on hover for links */
    }

    .drop {
      display: inline-block;
      /* Inline block for dropdown */
    }

    .dropbtn {
      background-color: #3498DB;
      /* Button background color */
      color: white;
      /* Button text color */
      font-size: 16px;
      /* Font size for button */
      border: none;
      /* No border */
      cursor: pointer;
      /* Pointer cursor on hover */
      width: 200px;
      /* Fixed width for dropdown button */
      height: 50px;
      /* Fixed height for dropdown button */
      border: 2px solid black;
      /* Border for button */
      font-weight: bold;
      /* Bold text for button */
      margin-left: 20px;
      /* Space to the left */
    }

    .dropbtn:hover {
      background-color: black;
      /* Change background color on hover */
      color: white;
      /* Change text color on hover */
      border: 2px solid white;
      /* Change border color on hover */
    }

    .dropdown-content {
      display: none;
      /* Hidden by default */
      background-color: #f1f1f1;
      /* Background for dropdown */
      min-width: 160px;
      /* Minimum width for dropdown */
      overflow: auto;
      /* Allow scrolling */
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      /* Shadow for dropdown */
      z-index: 1;
      /* Stack order */
    }

    .dropdown-content a {
      color: black;
      /* Text color for links in dropdown */
      text-decoration: none;
      /* No underline */
      display: block;
      /* Display as block */
      padding: 12px 16px;
      /* Padding for links */
    }

    .dropdown-content a:hover {
      background-color: #ddd;
      /* Change background color on hover */
    }

    .show {
      display: block;
      /* Show dropdown */
    }

    #display {
      display: flex;
      /* Flexbox layout for display */
      flex-wrap: wrap;
      /* Wrap items if needed */
      justify-content: center;
      /* Center items */
      margin: 20px;
      /* Margin around the display */
    }

    .card {
      background-color: white;
      /* White background for cards */
      border: 1px solid #ccc;
      /* Border for cards */
      border-radius: 8px;
      /* Rounded corners for cards */
      padding: 20px;
      /* Padding inside cards */
      margin: 10px;
      /* Margin around cards */
      width: 220px;
      /* Fixed width for cards */
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      /* Shadow for cards */
      transition: transform 0.2s;
      /* Smooth scaling on hover */
    }

    .card:hover {
      transform: scale(1.05);
      /* Scale up on hover */
    }

    img {
      width: 200px;
      /* Fixed width for images */
      height: 200px;
      /* Fixed height for images */
      padding: 10px;
      /* Padding around images */
      border-radius: 4px;
      /* Rounded corners for images */
    }

    .carditems {
      display: flex;
      /* Flexbox for card items */
      flex-direction: column;
      /* Column layout for card items */
      padding: 10px;
      /* Padding inside card items */
      font-size: 16px;
      /* Font size for text */
      font-weight: bold;
      /* Bold text for emphasis */
    }

    button[name="btn"] {
      background-color: #28a745;
      /* Green background for button */
      color: white;
      /* White text color */
      padding: 10px;
      /* Padding for button */
      border: none;
      /* No border */
      border-radius: 4px;
      /* Rounded corners */
      cursor: pointer;
      /* Pointer cursor on hover */
      margin-top: 10px;
      /* Space above button */
    }

    button[name="btn"]:hover {
      background-color: #218838;
      /* Darker green on hover */
    }
  </style>
</head>

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
              <a href="vehicle1.php">Vehicle</a>
              <a href="others1.php">Others</a>
            </div>
          </div>
        </div>
        <script>
          function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
          }

          window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
              var dropdowns = document.getElementsByClassName("dropdown-content");
              var i;
              for (i = 0; i < dropdowns.length; i++) {
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
    $query = "SELECT * FROM `stationary` WHERE status IS NULL";
    $result = mysqli_query($conn, $query);

    while ($data = mysqli_fetch_assoc($result)) {
    ?>
      <div class="card">
        <img src="./Upload/<?php echo $data['Image']; ?>" alt="<?php echo $data['Product_Name']; ?>">
        <div class="carditems">
          <div class="productName">Product Name: <?php echo $data['Product_Name']; ?></div>
          <div class="Price">Price: <?php echo $data['Price']; ?></div>
          <div class="Description">Description: <?php echo $data['Description']; ?></div>
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
