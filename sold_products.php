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
    <title>Sold Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
        }

        /* Navbar Styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: #007bff; /* Blue color */
            color: white;
        }

        .buyNsell {
            font-size: 1.5em;
            font-weight: bold;
        }

        .content ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .content ul li {
            display: inline;
        }

        .content ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.1em;
            transition: color 0.3s;
        }

        .content ul li a:hover {
            color: #f4f4f9;
        }

        /* Card Section */
        #display {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.15);
        }

        .card img {
            width: 100%;
            height: 150px; /* Reduced image height */
            object-fit: cover;
        }

        .carditems {
            padding: 15px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .productName,
        .company,
        .Price,
        .Buyer,
        .Description {
            font-size: 1em;
            color: #555;
        }

        .productName {
            font-weight: bold;
            font-size: 1.1em;
        }

        .Price {
            color: #007bff; /* Blue color for price */
            font-weight: bold;
        }

        /* Form Input Hidden */
        input[type="text"] {
            display: none;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .content ul {
                flex-direction: column;
                align-items: flex-start;
            }

            .content ul li {
                margin-bottom: 10px;
            }

            #display {
                grid-template-columns: 1fr;
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
            // Query to fetch sold products (email = user_id and status = 'Yes')
            $categories = ['vehicle', 'electronics', 'others', 'stationary', 'furniture'];
            foreach ($categories as $category) {
                $query = "SELECT * FROM $category WHERE email = '$user_id' AND status = 'Yes'";

                $result = mysqli_query($conn, $query);
                while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="card">
                        <img src="./Upload/<?php echo $data['Image']; ?>" alt="<?php echo $data['Product_Name']; ?>">
                        <div class="carditems">
                            <div class="productName">Product Name: <?php echo $data['Product_Name']; ?></div>
                            <div class="company">Company: <?php echo $data['Company']; ?></div>
                            <div class="Price">Price: <?php echo $data['Price']; ?></div>
                            <div class="Buyer">Purchased By: <?php echo $data['buyer_email']; ?></div>
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

