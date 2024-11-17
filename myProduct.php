<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Products</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <style>
    /* Styling for hide, card, and buttons */
    #hide {
      display: none;
    }

    img {
      width: 200px;  /* Adjusted width for smaller image boxes */
      height: auto;  /* Maintain aspect ratio */
      padding: 10px;  /* Reduced padding around the image */
    }

    .card {
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: center;
      margin: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      padding: 10px;
    }

    button {
      margin: 10px;
      background-color: #ff4757;
      color: white;
      border: none;
      border-radius: 5px;
      padding: 10px 15px;
      cursor: pointer;
    }

    .carditems {
      display: flex;
      flex-direction: column;
      padding: 30px;
      font-size: 1.1em;
      font-weight: bold;
    }

    #display {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: center;
    }

    /* Navbar Styling */
    .navbar {
      background-color: #333;
      overflow: hidden;
    }

    .navbar .buyNsell {
      font-size: 24px;
      color: white;
      padding: 14px;
    }

    .navbar .content ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
    }

    .navbar .content ul li {
      display: inline;
      margin-right: 20px;
    }

    .navbar .content ul li a {
      color: white;
      padding: 14px 20px;
      text-decoration: none;
    }

    .navbar .content ul li a:hover {
      background-color: #ddd;
      color: black;
    }
  </style>
</head>

<body>
  <?php
  session_start();
  // Start the session on this page
  $user_id = $_SESSION['User_id'];

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
        <li><a href="index.php">Home</a></li>
        <li><a href="sold_products.php">Sold Products</a></li>
        <li><a href="ordered_products.php">Ordered Products</a></li>
        <li><a href="connect.html">Contact Us</a></li>
      </ul>
    </div>
  </nav>

  <section>
    <div id="display">
      <?php
      // Check if the user has clicked on 'sold products' or 'ordered products'
      $view = isset($_GET['view']) ? $_GET['view'] : 'all'; // Default view is 'all' (original products)

      // Query based on the selected view
      if ($view == 'sold') {
        $query = "SELECT * FROM vehicle WHERE email = '$user_id' AND status = 'Yes'";
      } elseif ($view == 'ordered') {
        $query = "SELECT * FROM vehicle WHERE buyer_email = '$user_id' AND status = 'Yes'";
      } else { // Default view: All user products
        $query = "SELECT * FROM vehicle WHERE email = '$user_id' and status is null";
      }

      // Display products for the 'vehicle' category
      $result = mysqli_query($conn, $query);
      while ($data = mysqli_fetch_assoc($result)) {
        ?>
        <div class="card">
          <img src="./Upload/<?php echo $data['Image']; ?>" alt="<?php echo $data['Product_Name']; ?>">
          <div class="carditems">
            <div class="productName">Product Name: <?php echo $data['Product_Name']; ?></div>
            <div class="company">Company: <?php echo $data['Company']; ?></div>
            <div class="Price">Price: <?php echo $data['Price']; ?></div>
            <div class="Description">Description: <?php echo $data['Description']; ?></div>
            <form action="delete_record.php" method="post">
              <button name="deleteButton">Delete</button>
              <input type="text" id="hide" name="Product_Name" value="<?php echo $data['Product_Name']; ?>">
              <input type="text" id="hide" name="Category" value="vehicle">
            </form>
          </div>
        </div>
      <?php
      }
      ?>

      <!-- Repeat similar queries for other categories (electronics, others, stationary, furniture) -->
      <?php
      $categories = ['electronics', 'others', 'stationary', 'furniture'];
      foreach ($categories as $category) {
        if ($view == 'sold') {
          $query = "SELECT * FROM $category WHERE email = '$user_id' AND status = 'Yes'";
        } elseif ($view == 'ordered') {
          $query = "SELECT * FROM $category WHERE buyer_email = '$user_id' AND status = 'Yes'";
        } else {
          $query = "SELECT * FROM $category WHERE email = '$user_id' and status is null";
        }

        $result = mysqli_query($conn, $query);
        while ($data = mysqli_fetch_assoc($result)) {
          ?>
          <div class="card">
            <img src="./Upload/<?php echo $data['Image']; ?>" alt="<?php echo $data['Product_Name']; ?>">
            <div class="carditems">
              <div class="productName">Product Name: <?php echo $data['Product_Name']; ?></div>
              <div class="company">Company: <?php echo $data['Company']; ?></div>
              <div class="Price">Price: <?php echo $data['Price']; ?></div>
              <div class="Description">Description: <?php echo $data['Description']; ?></div>
              <form action="delete_record.php" method="post">
                <button name="deleteButton">Delete</button>
                <input type="text" id="hide" name="Product_Name" value="<?php echo $data['Product_Name']; ?>">
                <input type="text" id="hide" name="Category" value="<?php echo $category; ?>">
              </form>
            </div>
          </div>
        <?php
        }
      }
      ?>
    </div>
  </section>

</body>

</html>

