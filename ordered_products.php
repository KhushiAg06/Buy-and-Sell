<?php
session_start();
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordered Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #343a40;
            color: white;
            padding: 15px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 20px;
            padding-right: 20px;
        }

        .buyNsell {
            font-size: 24px;
            font-weight: bold;
        }

        .content .items {
            list-style: none;
            padding: 0;
            display: flex;
            gap: 15px;
        }

        .content .items li {
            display: inline;
        }

        .content .items a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 5px 10px;
            transition: background-color 0.3s ease;
        }

        .content .items a:hover {
            background-color: #007bff;
            border-radius: 5px;
        }

        section {
            margin: 30px;
        }

        #display {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 0;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            text-align: center;
            padding: 10px;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        .carditems {
            padding: 10px;
        }

        .productName,
        .company,
        .Price,
        .Description {
            font-size: 14px;
            margin: 10px 0;
            color: #555;
        }

        .Price {
            font-weight: bold;
            color: #28a745;
        }

        .Description {
            color: #6c757d;
        }

        @media (max-width: 768px) {
            .content .items {
                flex-direction: column;
                align-items: center;
            }

            .navbar {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="buyNsell">
            IITG Buy and Sell
        </div>
        <div class="content">
            <ul class="items">
                <li><a href="index.php">Home</a></li>
                <li><a href="sold_products.php?view=sold">Sold Products</a></li>
                <li><a href="ordered_products.php?view=ordered">Ordered Products</a></li>
                <li><a href="connect.html">Contact Us</a></li>
            </ul>
        </div>
    </nav>

    <section>
        <div id="display">
            <?php
            // Query to fetch ordered products (buyer_email = user_id and status = 'Yes')
            $categories = ['vehicle', 'electronics', 'others', 'stationary', 'furniture'];
            foreach ($categories as $category) {
                $query = "SELECT * FROM $category WHERE buyer_email = '$user_id' AND status = 'Yes'";

                $result = mysqli_query($conn, $query);
                while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="card">
                        <img src="./Upload/<?php echo $data['Image']; ?>" alt="<?php echo $data['Product_Name']; ?>">
                        <div class="carditems">
                            <div class="productName">Product Name: <?php echo $data['Product_Name']; ?></div>
                            <div class="company">Company: <?php echo $data['Company']; ?></div>
                            <div class="Price">Price: ₹<?php echo $data['Price']; ?></div>
                            <div class="Description">Description: <?php echo $data['Description']; ?></div>
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

