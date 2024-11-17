<?php
// Make a delete record button
if (isset($_POST['deleteButton'])) {
    $server = "localhost";
    $username = "root";
    $password = "root@123";
    $db = "buysell";

    $conn = new mysqli($server, $username, $password, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    session_start();

    // Set user email
    $email = $_SESSION['User_id'];
    $Product_Name = $_POST['Product_Name'];
    $Product_category = $_POST['Category'];
    
    // SQL QUERY
    $query = "DELETE FROM `$Product_category` WHERE `email` = '$email' AND `Product_Name` = '$Product_Name'"; 

    // Execute the query and check for errors
    if ($conn->query($query) === TRUE) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();

    header("Location: index.php");
    exit();
}
?>

