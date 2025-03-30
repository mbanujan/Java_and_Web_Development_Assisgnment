<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    <title></title>
</head>
<body>
  <div class="wrapper">
    <div class="container main">
        <div class="row">
            <div class="col-md-6 side-image">
                       
                <!-------------      image     ------------->
                
                <img src="images/logo.png" alt="">
                
                
            </div>

            <div class="col-md-6 right">
                
                <div class="input-box">
                   <form action="login.php" method="post">
                   <header>Welcome to  Revup Rental</header>
                   <div class="input-field">
                        <input type="text" class="input" id="uname" name="uname" required="" autocomplete="off">
                        <label for="uname">Username</label> 
                    </div> 
                   <div class="input-field">
                        <input type="password" class="input" id="pass1"  name="pass1" required="">
                        <label for="pass">Password</label>
                    </div> 
                   <div class="input-field">
                        
                        <input type="submit" class="submit" name="submit" value="Log in">
                   </div> 
                   </form>
                   <div class="signin">
                    <span>Create New account? <a href="signup.php">Sign Up here</a></span>
                   </div>
                </div>  
            </div>
        </div>
    </div>
</div>
<?php
require_once("dbconfig.php");
session_start(); // Start the session

if (isset($_POST['submit'])) {
    $unamel = $_POST['uname'];
    $pass = $_POST['pass1'];

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT pword FROM user WHERE uname=?");
    $stmt->bind_param("s", $unamel);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($hashed_pass);
        $stmt->fetch();

        // Verify the password
        if (password_verify($pass, $hashed_pass)) {
            $_SESSION['username'] = $unamel; // Set the session variable

            // Redirect to second.html upon successful login
            header('Location: index2.html');
            exit();
        } else {
            echo "<script>alert('Incorrect username or password');</script>";
        }
    } else {
        echo "<script>alert('Incorrect username or password');</script>";
    }

    $stmt->close();
    mysqli_close($conn);
}
?>



</body>
</html>