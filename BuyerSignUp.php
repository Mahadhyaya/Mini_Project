<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ecom";
    $con = mysqli_connect($servername, $username, $password, $database);
    if (!$con) {
        die("Not Connected" . mysqli_connect_error());
    }
    $boos = $name = $emailid = $password = $mobile = $repeat = $street = $city = $zip = $error = $nameerr = $emailerr = $mobileerr = $passerr = $repasserr = $streeterr = $cityerr = $ziperr = "";
    $bool = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $emailid = $_POST['email'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];
    $repeat = $_POST['repeat'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    
    $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";

    if (!preg_match("/^[a-z A-Z]*$/", $name)) {
        $nameerr = $error = "Please Enter Valid Name";
        $bool = true;
    } 
    if (!preg_match("/^[0-9]*/", $mobile) || strlen($mobile) < 10 || strlen($mobile) > 10) {
        $mobileerr = $error = "Please Enter valid 10 digit number";
        $bool = true;
    } 
    if (!preg_match($pattern, $emailid)) {
        $emailerr = $error = "Please Provide valid email address";
        $bool = true;
    } 

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    
    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        $passerr = $error = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
        $bool = true;
    }

    if ($password != $repeat) {
         $repasserr = $error = "Password length mismatch";
         $bool = true;
    } 
    if (!preg_match("/^[a-zA-Z0-9]*$/", $street)) {
        $streeterr = $error = "Please provide correct Street Address";
        $bool = true;
    } 
    if(!preg_match("/^[a-zA-Z]*$/", $city)) {
        $cityerr = $error = "Please provide correct City Address";
        $bool = true;
    }
    if (!preg_match("/^[0-9]*$/", $zip) || strlen($zip) < 6) {
        $ziperr = $error = "Please provide valid Zip Code";
        $bool = true;
    } 
    if (!$bool) {
    $sql = "INSERT into `buyer` (`emailid`, `bname`, `password`, `confirm_password`, `mobileno`, `zipcode`, `city`, `street`) VALUES ('$emailid', '$name', '$password', '$repeat', '$mobile', '$zip', '$city', '$street')";
        
    if ($con->query($sql)) {
            $boos = true;
            header("Location:LoginPage.php");
    } 
    }
    }
    $con->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>BuyerRegistration Page</title>
</head>
<body style="overflow: hidden; background-color: rgb(242, 212, 212);background-image:url('./images/backg.webp');z-index:-800; background-size: cover; background-blend-mode: screen;">
    <form action="BuyerSignUp.php" method="post">
        <div class="container">    
            <div class="mb-3" style="margin-top:70px; border: 5px solid black;">
                <h1 style="text-align: center;">Buyer Registration Form</h1>
                <div class="form-row">
                    <label class="form-label" for="names">Name</label>
                    <input type="text" style="width:90%;margin-left:20px;" class="form-control" placeholder="Your Name" name="name" id="names" required>
                    <label style="color:red;"><?php echo $nameerr ?></label><br>
                </div>
                <div class="form-row">
                    <label class="form-label" for="emailid">Email Address</label>
                    <input type="email" style="width:90%;margin-left:20px;" class="form-control" placeholder="email@example.com" required name="email" id="emailid">
                    <label style="color:red;"><?php echo $emailerr ?></label><br>
                </div>
                <div class="form-row">
                    <label class="form-label" for="mid">Mobile Number</label>
                    <input type="tel" style="width:90%;margin-left:20px;" class="form-control" max="10" placeholder="Enter mobilenumber" required name="mobile" id="mid">
                    <label style="color:red;"><?php echo $mobileerr ?></label><br>
                </div>
                <div class="form-row">
                    <label class="form-label" for="passwords">Enter Password</label>
                    <input type="password" required  name="password" placeholder="#$s*223*ewki" id="passwords">
                    <label style="color:red;"><?php echo $passerr ?></label><br>
                </div>
                <div class="form-row mt-2">
                    <label class="form-label mt-2" for="repeats">Confirm Password</label>
                    <input type="password" required placeholder="Re-enter password" name="repeat" id="repeats">
                    <label style="color:red;"><?php echo $repasserr ?></label><br>
                </div>
                <div class="form-row mt-2">
                        <label class="form-label mt-2" style="margin-left:18px;"for="streets">Street Address</labe>
                        <input type="text" name="street" id="streets">
                        <label style="color:red;"><?php echo $streeterr ?></label><br>
                </div>
                <div class="form-row mt-2">
                        <label for="citys" class="form-label mt-2">City</labe>
                        <input type="text" required name="city" id="citys">
                        <label style="color:red;"><?php echo $cityerr ?></label><br>
                </div>
                <div class="col-12">
                    <label for="zips" class="form-label mt-2">Zip Code</label>
                    <input type="text" required name="zip" class="mt-4" id="zips">
                    <label style="color:red;"><?php echo $ziperr ?></label><br>
                </div>    
                <button type="submit" class="btn mb-2 btn-primary mid">Register</button>
                <h6 style="text-align:center;color:Green;" class="alert alert-danger">
                
                    <?php 
                        if($boos) {
                            echo "Buyer Registration Successful";
                        }
                    ?>
                </h6>
            </div>
        </div>
    </form>
    
    <script>
        if ( window.history.replaceState ) {
          window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>