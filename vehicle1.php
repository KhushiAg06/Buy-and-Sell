<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vehicle Listings</title>
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

    .navbar {
      background-color: #007bff;
      /* Blue background for navigation */
      padding: 10px;
      /* Padding for spacing */
      color: white;
      /* White text color for navigation items */
    }

    .buyNsell {
      font-size: 24px;
      /* Larger font size for the brand name */
      font-weight: bold;
      /* Bold text for emphasis */
    }

    .content {
      margin-top: 10px;
      /* Space above content */
    }

    .items {
      list-style-type: none;
      /* Remove bullet points */
      padding: 0;
      /* Remove padding */
    }

    .items li {
      display: inline;
      /* Display items in a row */
      margin-right: 20px;
      /* Space between items */
    }

    .items li a {
      color: white;
      /* White text for links */
      text-decoration: none;
      /* Remove underline from links */
      font-weight: bold;
      /* Bold links */
    }

    .items li a:hover {
      text-decoration: underline;
      /* Underline on hover */
    }

    #display {
      display: flex;
      /* Use flexbox for layout */
      flex-wrap: wrap;
      /* Allow wrapping of cards */
      justify-content: center;
      /* Center the cards */
      margin: 20px;
      /* Space around the display area */
    }

    .card {
      background-color: white;
      /* White background for cards */
      border-radius: 8px;
      /* Rounded corners */
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      /* Subtle shadow for depth */
      margin: 10px;
      /* Margin between cards */
      padding: 15px;
      /* Padding inside cards */
      width: 300px;
      /* Fixed width for cards */
      text-align: center;
      /* Center text in cards */
    }

    img {
      width: 100%;
      /* Responsive image */
      height: auto;
      /* Maintain aspect ratio */
      border-radius: 8px;
      /* Rounded corners for images */
    }

    .carditems {
      margin-top: 10px;
      /* Space above card items */
    }

    .carditems div {
      margin: 5px 0;
      /* Space between details */
    }

    button {
      background-color: #007bff;
      /* Blue button background */
      color: white;
      /* White text color */
      padding: 10px 15px;
      /* Padding for button */
      border: none;
      /* No border */
      border-radius: 4px;
      /* Rounded corners */
      cursor: pointer;
      /* Pointer cursor on hover */
      font-size: 16px;
      /* Font size for button */
      transition: background-color 0.3s;
      /* Transition for hover effect */
    }

    button:hover {
      background-color: #0056b3;
      /* Darker blue on hover */
    }

    .dropdown {
      display: inline-block;
      /* Dropdown inline with other items */
      position: relative;
      /* Position for dropdown */
    }

    .dropbtn {
      background-color: white;
      /* White background for button */
      color: black;
      /* Black text */
      font-size: 16px;
      /* Font size */
      border: 2px solid black;
      /* Border for button */
      cursor: pointer;
      /* Pointer cursor */
      padding: 10px;
      /* Padding for button */
      border-radius: 4px;
      /* Rounded corners */
    }

    .dropbtn:hover {
      background-color: black;
      /* Change color on hover */
      color: white;
      /* Change text color */
    }

    .dropdown-content {
      display: none;
      /* Hide dropdown content */
      position: absolute;
      /* Position dropdown content */
      background-color: #f1f1f1;
      /* Background color */
      min-width: 160px;
      /* Minimum width */
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      /* Shadow effect */
      z-index: 1;
      /* Stack on top */
    }

    .dropdown-content a {
      color: black;
      /* Black text for links */
      text-decoration: none;
      /* Remove underline */
      display: block;
      /* Block display */
      padding: 10px;
      /* Padding for links */
    }

    .dropdown-content a:hover {
      background-color: #ddd;
      /* Change background on hover */
    }

    .show {
      display: block;
      /* Show dropdown */
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
        <div class="dropdown">
          <button onclick="myFunction()" class="dropbtn">- - - Select Category - - - </button>
          <div id="myDropdown" class="dropdown-content">
            <a href="electronics1.php">Electronics</a>
            <a href="furniture1.php">Furniture</a>
            <a href="stationary1.php">Stationary</a>
            <a href="others1.php">Others</a>
          </div>
        </div>
      </ul>
    </div>
  </nav>

  <div id="display">
    <?php
    $query = "SELECT * FROM `vehicle` WHERE status IS NULL";
    $result = mysqli_query($conn, $query);

    while ($data = mysqli_fetch_assoc($result)) {
    ?>
      <div class="card">
        <img src="./Upload/<?php echo $data['Image']; ?>" alt="Product Image">
        <div class="carditems">
          <div class="productName">Product Name: <?php echo $data['Product_Name']; ?></div>
          <div class="company">Company: <?php echo $data['Company']; ?></div>
          <div class="Price">Price: <?php echo $data['Price']; ?></div>
          <div class="Description">Description: <?php echo $data['Description']; ?></div>
        </div>
        <form action="Show_details.php" method="post">
          <input type="hidden" name="emailss" value="<?php echo $data['email']; ?>">
          <button type="submit" name="btn">BUY</button>
        </form>
      </div>
    <?php
    }
    ?>
  </div>

  <script>
    // Toggle dropdown visibility
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

</body>

</html>
