



<?php


  if(isset($_POST['email'])) {
    $server = "localhost";
    $username = "root";
    $password = "root@123";
    $db = "buysell";

    $conn = new mysqli($server, $username, $password, $db);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $email = $_POST['email'];
    $pswd = $_POST['pswd'];
    $Forgot_text = $_POST['Forgot_text'];
    
    
    
    
    // SQL QUERY
    $query = "SELECT * FROM `login`;";
    
    // FETCHING DATA FROM DATABASE
    $result = $conn->query($query);
    
    
    if ($result->num_rows > 0) 
    {
        // OUTPUT DATA OF EACH ROW
        while($row = $result->fetch_assoc())
        {
            if($row["email"] == $email and $row["pswd"] == $pswd) {
                echo "Password matched";
                session_start();
                $_SESSION['User_id'] = $email;
              header("Location: index.php");
              exit();
            }

        }
        echo "<script type='text/javascript'>alert('Incorrect Password');location='login_page.html';</script>";
    
    } 
    else {
        echo "<script type='text/javascript'>alert('Incorrect Password');location='login_page.html';</script>";

    }




    $conn->close();
}

?> 
