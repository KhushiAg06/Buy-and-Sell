<?php

    session_start();
    $email = $_SESSION['User_id'];

if(isset($_POST['Product_Name'])) {
    $server = "localhost";
    $username = "root";
    $password = "root@123";

    $con = mysqli_connect($server, $username, $password);

    if(!$con) {
        die("connection to this database failed due to" . mysqli_connect_error());
    }

    $Product_Name = $_POST['Product_Name'];
    $Company = $_POST['Company'];
    $Model = $_POST['Model'];
    $Description = $_POST['Description'];
    $Purchase_Date = $_POST['Purchase_Date'];
    $Price = $_POST['Price'];
    $Image = $_FILES['Image'];
    $fileName = $_FILES['Image']['name'];
    $fileTmpName = $_FILES['Image']['tmp_name'];
    $fileError = $_FILES['Image']['error'];

    $folder = 'Upload/'.$fileName;

    $sql = "INSERT INTO `buysell`.`electronics` (`email`, `Product_Name`, `Company`,`Model`, `Description`, `Purchase_Date`, `Price`, `Image`) VALUES ('$email', '$Product_Name','$Company', '$Model', '$Description', '$Purchase_Date', '$Price', '$fileName');";


    if($con->query($sql) == true) {
        if (move_uploaded_file($fileTmpName, "Upload/$fileName")) {
            echo "<h3>  Image uploaded successfully!</h3>";
        } else {
            echo "<h3>  Failed to upload image!</h3>";
        }
    }
    else {
        echo "ERROR: $sql <br> $con->error";
    }
    
    
    $con->close();
    header("Location: index.php");
    exit();
}

?> 
