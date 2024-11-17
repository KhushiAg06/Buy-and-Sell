<?php
session_start(); // Start the session to access session variables

// Check if the form is submitted with the required data
if (isset($_POST['product_id']) && isset($_POST['table_name']) && isset($_POST['buyer_email'])) {
    // Get the form data
    $product_id = $_POST['product_id']; // Product ID
    $table_name = $_POST['table_name']; // Table name (e.g., electronics, vehicle)
    $buyer_email = $_POST['buyer_email']; // Email of the buyer

    // Database credentials
    $server = "localhost";
    $username = "root";
    $password = "root@123";
    $db = "buysell";

    // Create connection
    $conn = new mysqli($server, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL query to update the status and the buyer's email
    $query = "UPDATE `$table_name` 
              SET status = 'Yes', buyer_email = ? 
              WHERE Product_ID = ? AND status IS NULL"; // Only update if status is NULL (not sold)

    // Prepare the statement
    if ($stmt = $conn->prepare($query)) {
        // Bind the parameters (buyer_email is a string, product_id is an integer)
        $stmt->bind_param("si", $buyer_email, $product_id);

        // Execute the query
        if ($stmt->execute()) {
            // Success message
            echo "Product purchase successful!<br>";

            // Query to fetch the seller's details from the users table
            // Assuming the seller's details are in a 'users' table, linked by 'user_id' (or similar)
            // If the seller's information is in the same table as the product, modify this accordingly.
            $seller_query = "SELECT u.email, u.fname, u.lname, u.phone
                             FROM User u
                             JOIN `$table_name` p ON u.email=p.email
                             WHERE p.Product_Id = ?";
            
            // Prepare the seller query
            if ($stmt_seller = $conn->prepare($seller_query)) {
                // Bind the product_id (assuming it's an integer)
                $stmt_seller->bind_param("i", $product_id);

                // Execute the seller query
                if ($stmt_seller->execute()) {
                    // Bind the result to variables
                    $stmt_seller->bind_result($seller_email, $seller_fname, $seller_lname, $seller_phone);
                    
                    // Fetch the result
                    if ($stmt_seller->fetch()) {
                        // Display seller details
                        echo "<br>Seller Details:<br>";
                        echo "Email: " . htmlspecialchars($seller_email) . "<br>";
                        echo "Name: " . htmlspecialchars($seller_fname) . " " . htmlspecialchars($seller_lname) . "<br>";
                        echo "Phone: " . htmlspecialchars($seller_phone) . "<br>";
                    } else {
                        echo "Seller details not found.";
                    }
                } else {
                    echo "Error fetching seller details: " . $conn->error;
                }

                // Close the seller statement
                $stmt_seller->close();
            } else {
                echo "Error preparing seller query: " . $conn->error;
            }

            // You could add more confirmation or redirection here
            echo "<br><a href='index.php'>Go back to homepage</a>";

        } else {
            echo "Error updating the product: " . $conn->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Error preparing the query: " . $conn->error;
    }

    // Close the connection
    $conn->close();
} else {
    echo "Invalid request.";
}
?>

