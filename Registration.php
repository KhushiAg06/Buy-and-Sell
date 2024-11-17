
<?php
    if(isset($_POST['fname'])) {
        $server = "localhost";
        $username = "root";
        $password = "root@123";
    
        $con = mysqli_connect($server, $username, $password);
    
        if(!$con) {
            die("connection to this database failed due to" . mysqli_connect_error());
        }
        // echo "Success connecting to the db";
    
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $dob = $_POST['dob'];
        $email = $_POST['email'];
        $phone = $_POST['Phone'];
        $pswd = $_POST['pswd'];
        $Forgot_text = $_POST['Forgot_text'];
    
        // $sql = "INSERT INTO `Form`.`details` (`name`, `age`, `gender`, `phone`, `email`, `description`) VALUES ('$name', '$age', '$gender', '$phone', '$email', '$description');";
        // echo $sql;
        $sql = "INSERT INTO `buysell`.`User` (`fname`, `lname`, `dob`, `email`, `phone`) VALUES ('$fname', '$lname', '$dob', '$email', '$phone');";
        if ($con->query($sql) === TRUE) {
    echo "User registration successful!";
        $sql2 = "INSERT INTO `buysell`.`login` (`email`, `pswd`, `Forgot_text`) VALUES ('$email', '$pswd', '$Forgot_text');";
    
        if($con->query($sql2) == true) {
            // echo "Successfully Inserted";
        }
        else {
            echo "ERROR: $sql2 <br> $con->error";
        }

        if($con->query($sql) == true) {
            // echo "Successfully Inserted";
        }
        else {
            echo "ERROR: $sql <br> $con->error";
        }
    
        $con->close();
    }
    }

    // INSERT INTO `User` (`User_id`, `fname`, `lname`, `dob`, `email`, `phone`) VALUES ('1', 'Gaurav', 'Gandhi', '2021-10-07', 'gauravgandhi@iitg.ac.in', '8295380050');

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    
    <link rel="stylesheet" href="Home.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <center>
    <header>
        <br>
        <h1 class="font-weight-bold text-xl"><i>IITG Buy and Sell</i></h1>
        <br>

    </header>
        <form method="post" action="Registration.php">

            <br><br>
	  <label for="fname">First name:</label>
	  <input type="text" id="fname" name="fname" required pattern="[A-Za-z]{1,}" title="Must be alphabetic"><br><br>
	  <label for="lname">Last name:</label>
	  <input type="text" id="lname" name="lname" pattern="[A-Za-z.]{1,}" title="Must be alphabetic"><br><br>

      
	  <label for="dob">Date of Birth:</label>
	  <input type="date" id="dob" name="dob" min="1900-01-01"><br><br>
      
	  <label for="email">IITG Email:</label>
	  <input type="text" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="@iitg.ac.in"><br><br>
      
	  <label for="Phone">Phone no:</label>
	  <input type="text" id="Phone" name="Phone"><br><br>

	  <label for="pswd">Password:</label>
	  <input type="password" id="pswd" name="pswd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
  title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"><br><br>

	  <label for="cpswd">Confirm Password:</label>
	  <input type="password" id="cpswd" name="cpswd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
  title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"><br><br>

        <label for="Forgot_text">What is your pets name:</label>
        <input type="text" id="Forgot_text" name="Forgot_text"><br><br><br>

        <button class="btn">Submit</button>
	  <!-- <input type="submit" value="Reset"> -->
      <br><br>
      
    </form>
    Already have an account? Click <a href="login_page.html">here</a> to login.
    </center>
</body>
</html>

