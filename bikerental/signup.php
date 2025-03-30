<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    <title>Gallery Cafe</title>
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
                   <form action="signup.php" method="post">
                   <header>Create account</header>
                   <div class="input-field">
                        <input type="text" class="input" id="uname" name="uname" required="" autocomplete="off">
                        <label for="uname">Username</label> 
                    </div> 
                   <div class="input-field">
                        <input type="email" class="input" id="email" name="email" required="" autocomplete="off">
                        <label for="email">Email</label> 
                    </div> 
                   <div class="input-field">
                        <input type="password" class="input" id="pass"  name="pass" required="">
                        <label for="pass">Password</label>
                    </div> 
                   <div class="input-field">
                        
                        <input type="submit" class="submit" name="submit" value="Sign Up">
                   </div> 
                   </form>
                   <div class="signin">
                    <span>Already have an account? <a href="login.php">Log in here</a></span>
                   </div>
                </div>  
            </div>
        </div>
    </div>
</div>
<?php
require_once("dbconfig.php");

// to save data 
if(isset($_POST['submit'])){
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Check if username already exists
    $sql = "SELECT * FROM user WHERE uname='$uname'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        echo "<script>alert('Username already exists');
        window.location.href='signup.php'</script>";
    } else {
        // Check if email already exists
        $sql = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            echo "<script>alert('Email already exists');
            window.location.href='signup.php'</script>";
        } else {
            // Hash the password
            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

            // SQL query
            $sql = "INSERT INTO user (uname, email, pword) VALUES ('$uname', '$email', '$hashed_pass')";

            if(mysqli_query($conn, $sql)){
                echo "<script>alert('Account Created Successfully');
                window.location.href='login.php'</script>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
    mysqli_close($conn);
}
?>

</body>
</html>