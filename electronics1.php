<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IITG Buy and Sell</title>
  <link rel="stylesheet" href="Home.css">
  <style>
    /* General Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Body */
    body {
      background-color: #f2f2f2;
      /* Light background */
      font-family: Arial, sans-serif;
      color: #333;
      /* Dark text */
    }

    /* Navbar */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #3498DB;
      /* Navbar color */
      padding: 1rem 2rem;
      color: #fff;
    }

    .navbar .buyNsell {
      font-size: 1.8rem;
      font-weight: bold;
    }

    .navbar .items {
      list-style: none;
      display: flex;
    }

    .navbar .items li {
      margin-left: 2rem;
    }

    .navbar .items li a {
      color: #fff;
      /* Link color */
      text-decoration: none;
      font-size: 1rem;
      transition: color 0.3s ease;
    }

    .navbar .items li a:hover {
      color: #ffcc00;
      /* Hover color */
    }

    /* Dropdown Button */
    .dropbtn {
      background-color: #fff;
      /* Button background */
      color: #3498DB;
      /* Button text */
      font-size: 16px;
      border: 2px solid #3498DB;
      /* Button border */
      cursor: pointer;
      padding: 10px;
      border-radius: 5px;
      /* Rounded corners */
      transition: background-color 0.3s, color 0.3s;
      /* Transition effects */
    }

    .dropbtn:hover,
    .dropbtn:focus {
      background-color: #2980B9;
      /* Hover background */
      color: white;
      /* Hover text color */
    }

    /* Dropdown Content */
    .dropdown {
      display: inline-block;
      position: relative;
      /* Position for dropdown */
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    .dropdown-content a {
      color: black;
      text-decoration: none;
      display: block;
      padding: 12px 16px;
      /* Padding for dropdown items */
    }

    .dropdown-content a:hover {
      background-color: #ddd;
      /* Hover effect for dropdown items */
    }

    .show {
      display: block;
    }

    /* Show class for dropdown */

    /* Card Styles */
    #display {
      display: flex;
      flex-wrap: wrap;
      /* Wrap cards on smaller screens */
      justify-content: center;
      /* Center cards */
      margin: 20px;
    }

    .card {
      background-color: white;
      /* Card background */
      border: 1px solid #ddd;
      /* Card border */
      border-radius: 10px;
      /* Rounded corners */
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      /* Shadow for cards */
      margin: 15px;
      /* Margin between cards */
      overflow: hidden;
      /* Prevent overflow */
      width: 300px;
      /* Fixed width for cards */
      transition: transform 0.3s;
      /* Transition for hover */
    }

    .card:hover {
      transform: scale(1.05);
      /* Scale effect on hover */
    }

    .card img {
      width: 100%;
      /* Full width for images */
      height: auto;
      /* Auto height */
    }

    .carditems {
      padding: 15px;
      /* Padding inside cards */
    }

    .carditems div {
      margin-bottom: 10px;
      /* Space between items */
    }

    /* Button */
    button {
      background-color: #3498DB;
      /* Button color */
      color: white;
      /* Button text color */
      padding: 10px;
      border: none;
      /* Remove border */
      border-radius: 5px;
      /* Rounded corners */
      cursor: pointer;
      /* Pointer cursor */
      transition: background-color 0.3s;
      /* Transition effect */
    }

    button:hover {
      background-color: #2980B9;
      /* Darker blue on hover */
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
    <div class="buyNsell">IITG Buy and Sell</div>
    <div class="content">
      <ul class="items">
        <li class="sell"><a class="nav-link" href="dropdown.html">Sell</a></li>
        <li class="sell"><a class="nav-link" href="myProduct.php">My Product</a></li>
        <li class="contactus"><a class="nav-link" href="/Project/connect.html">Contact us</a></li>
        <li class="dropdown">
          <button onclick="myFunction()" class="dropbtn">- - - Select Category - - - </button>
          <div id="myDropdown" class="dropdown-content">
            <a href="vehicle1.php">Vehicles</a>
            <a href="furniture1.php">Furniture</a>
            <a href="stationary1.php">Stationary</a>
            <a href="others1.php">Others</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  <script>
    /* Toggle dropdown */
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

  <div id="display">
    <?php
    $query = "SELECT * FROM `electronics` WHERE status IS NULL";
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
          <button name="btn">BUY</button>
        </form>
      </div>
    <?php
    }
    ?>
  </div>

</body>

</html>
