<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="Home.css">
  <style>
    #hide {
      display: none;
    }

    .card button {
      margin: 10px;
      background-color: green !important;
      color: white;
    }

    /* Button and Dropdown styles */
    .dropbtn {
      background-color: #3498DB;
      color: white;
      font-size: 16px;
      border: none;
      cursor: pointer;
      width: 200px;
      height: 50px;
      font-weight: bolder;
      border: 2px solid black;
    }

    .dropbtn:hover {
      background-color: black;
      color: white;
      border: 2px solid white;
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
    }

    .dropdown a:hover {
      background-color: #ddd;
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
      font-weight: bolder;
    }

    #display {
      align-items: center;
      justify-content: center;
    }
  </style>
</head>

<body>
  <?php
  session_start(); // Start the session on this page


// You can now access the User_id stored in the session
  $user_id = $_SESSION['User_id'];

  $server = "localhost";
  $username = "root";
  $password = "root@123";
  $db = "buysell";

  // Create connection
  $conn = new mysqli($server, $username, $password, $db);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Function to display products
  // Function to display products
function displayProducts($conn, $table)
{
    // Query to get products where status is NULL (unsold) or 'No' based on your requirement
    $query = "SELECT * FROM `$table` WHERE status IS NULL"; // Use 'status IS NULL' for unsold items
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "Error in query: " . mysqli_error($conn) . "<br>";
        return; // Stop further processing if the query fails
    }

    // Loop through the result set and display products
    while ($data = mysqli_fetch_assoc($result)) {
        echo '<div class="card">';
        echo '<img src="./Upload/' . $data['Image'] . '" alt="' . htmlspecialchars($data['Product_Name']) . '">';
        echo '<div class="carditems">';
        echo '<div class="productName">Product Name: ' . htmlspecialchars($data['Product_Name']) . '</div>';
        echo '<div class="Price">Price: ' . htmlspecialchars($data['Price']) . '</div>';
        echo '<div class="Description">Description: ' . htmlspecialchars($data['Description']) . '</div>';
        echo '</div>';

        // Form to handle purchase
        echo '<form action="Show_details.php" method="post">';
        echo '<input type="hidden" name="product_id" value="' . $data['Product_Id'] . '">';
        echo '<input type="hidden" name="table_name" value="' . htmlspecialchars($table) . '">';
        echo '<input type="hidden" name="buyer_email" value="' . $_SESSION['User_id'] . '">';
        echo '<button name="btn">BUY</button>';
        echo '</form>';

        echo '</div>'; // Close the card div
    }
}

  ?>

  <header>
    <nav class="navbar">
      <div class="buyNsell">IITG Buy and Sell</div>
      <div class="content">
        <ul class="items">
          <li class="sell"><a class="nav-link" href="dropdown.html">Sell</a></li>
          <li class="sell"><a class="nav-link" href="myProduct.php">My Product</a></li>
          <li class="contactus"><a class="nav-link" href="connect.html">Contact us</a></li>
          <div class="drop">
            <div class="dropdown">
              <button onclick="myFunction()" class="dropbtn">- - - Select Category - - - </button>
              <div id="myDropdown" class="dropdown-content">
                <a href="electronics1.php">Electronics</a>
                <a href="vehicle1.php">Vehicle</a>
                <a href="furniture1.php">Furniture</a>
                <a href="stationary1.php">Stationary</a>
                <a href="others1.php">Others</a>
              </div>
            </div>
          </div>
        </ul>
      </div>
    </nav>
  </header>

  <main>
    <section>
      <div id="display">
        <?php
        // Display products from all categories
        displayProducts($conn, 'electronics');
        displayProducts($conn, 'vehicle');
        displayProducts($conn, 'furniture');
        displayProducts($conn, 'stationary');
        displayProducts($conn, 'others');

        // Close the connection
        $conn->close();
        ?>
      </div>
    </section>
  </main>

  <script>
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }

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

