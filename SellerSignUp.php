<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ecom";
    $con = mysqli_connect($servername, $username, $password, $database);
    if (!$con) {
        die("Not Connected" . mysqli_connect_error());
    }
    $paid = $payerr = $boos = $name = $emailid = $password = $mobile = $repeat = $street = $city = $zip = $error = $nameerr = $emailerr = $mobileerr = $passerr = $repasserr = $streeterr = $cityerr = $ziperr = "";
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
        // echo "Please Enter Valid Name";
        $nameerr = $error = "Please Enter Valid Name";
        $bool = true;
        // echo $nameerr;
    } if (!preg_match("/^[0-9]*/", $mobile) || strlen($mobile) < 10 || strlen($mobile) > 10) {
        // echo "Please Enter valid 10 digit number";
        $mobileerr = $error = "Please Enter valid 10 digit number";
        $bool = true;
    } 
    if (!preg_match($pattern, $emailid)) {
        // echo "Please Provide valid email address";
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

    // if (!preg_match("/^[a-zA-Z0-9#@!$%^&*()_-+=\/'{}|]*$/", $password) ) {
    //     // echo "Enter Correct Password";
    //    $passerr = $error = "Please Enter Strong Password";
    //    $bool = true;
    // } 
    // if (strlen($password) < 8) {
    //     // echo "Enter Password of more than 8 character";
    //     $passerr = $error = "Enter Password of more than 8 character";
    //     $bool = true;
    // }
    if ($password != $repeat) {
        //  echo "Password length mismatch" ;
         $repasserr = $error = "Password length mismatch";
         $bool = true;
    } 
    if (!preg_match("/^[a-zA-Z0-9]*$/", $street)) {
        // echo "Please provide correct Street Address";
        $streeterr = $error = "Please provide correct Street Address";
        $bool = true;
    } 
    if(!preg_match("/^[a-zA-Z]*$/", $city)) {
        // echo "Please provide correct City Address";
        $cityerr = $error = "Please provide correct City Address";
        $bool = true;
    }
    if (!preg_match("/^[0-9]*$/", $zip) || strlen($zip) < 6) {
        // echo "Please provide valid Zip Code";
        $ziperr = $error = "Please provide valid Zip Code";
        $bool = true;
    } 
    if (!$bool) {
    
        $sql = "INSERT INTO `seller` (`emailid`, `sname`, `mobileno`, `city`, `zipcode`, `street`, `password`, `confirm_password`, `paid`) VALUES ('$emailid', '$name', '$mobile', '$city',  '$zip', '$street', '$password', '$repeat' , '$paid')";
    // $sql = "INSERT into `buyer` (`emailid`, `bname`, `password`, `confirm_password`, `mobileno`, `zipcode`, `city`, `street`) VALUES ('$emailid', '$name', '$password', '$repeat', '$mobile', '$zip', '$city', '$street')";    
    if ($con->query($sql)) {
            // echo "Succ";
            $boos = true;
            // header("Location: signup.php");
            header("Location: Pay.php");
        } else {
            // echo "fia;";
            // echo $con . " " . $con->error;
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
    <title>Registration Page</title>
</head>
<body style="background-color: rgb(242, 212, 212);">
    
    <form action="SellerSignUp.php" method="post">
        <!-- <img src="./backg.webp" alt="img"> -->
        <div class="container">    
        <div class="mb-3" style="margin-top:70px; border: 5px solid black;">
            <h1 style="text-align: center;">Seller Registration Form</h1>
            <label class="form-label" for="names">Name</label>
            <input type="text" style="width:90%;margin-left:20px;" class="form-control" placeholder="Your Name" name="name" id="names" required>

            <label style="color:red;"><?php echo $nameerr ?></label><br>
            <label class="form-label" for="emailid">Email Address</label>
            <input type="email" style="width:90%;margin-left:20px;" class="form-control" placeholder="email@example.com" required name="email" id="emailid">
            <label class="form-label" for="mid">Mobile Number</label>
            <input type="tel" style="width:90%;margin-left:20px;" class="form-control" max="10" placeholder="Enter mobilenumber" required name="mobile" id="mid">
            <label style="color:red;"><?php echo $mobileerr ?></label><br>
            <div class="row">
                <div class="col-6">
                <label class="form-label mt-4 mr-4" for="passwords">Enter Password</label>
                <input type="password" required  name="password" placeholder="#$s*223*ewki" id="passwords">
                <label style="color:red;"><?php echo $passerr ?></label><br>
                </div>
                <div class="col-6">
                <label class="form-label mt-4" for="repeats">Confirm Password</label>
                <input type="password" required placeholder="Re-enter password" name="repeat" id="repeats">
                <label style="color:red;"><?php echo $repasserr ?></label><br>
                </div>
                <div class="col-6">
                    <labe class="form-label mt-6" style="margin-left:18px;"for="streets">Street Address</labe>
                    <input type="text" name="street" class="mt-4" id="streets">
                    <label style="color:red;"><?php echo $streeterr ?></label><br>
                </div>
                <div class="col-6">
                    <labe for="citys" class="form-label mt-6">City</labe>
                    <input type="text" required name="city" class="mt-4" id="citys">
                    <label style="color:red;"><?php echo $cityerr ?></label><br>
                </div>
                <div>
                    <div class="col-12" style="text-align: center;">
                        <labe for="zips" class="form-label mt-6">Zip Code</labe>
                        <input type="text" required name="zip" class="mt-4" id="zips">
                        <label style="color:red;"><?php echo $ziperr ?></label><br>
                    </div>
                </div>
            </div>
        <button type="submit" class="btn mt-4 btn-primary mid">PAY</button>
        <h6 style="text-align:center;color:Green;" class="alert alert-danger">
         <?php 
         if($boos) {
            echo "Seller Registration Successful";
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