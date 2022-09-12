<?php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $database = "ecom";
   $con = mysqli_connect($servername, $username, $password, $database);
   if (!$con) {
       die("Not Connected" . mysqli_connect_error());
   }
   $password = $user = $usererr = $passerr = "";
   $bool = false;
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailid = $_POST['user'];
    $password = $_POST['password'];
   }

  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginPage</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
 
<body>
    <div class="container mt-4" style="border:3px solid red; width: 80%;">
      <form action="LoginPage.php" method="post">
      <h1 style="text-align: center;">Login Page</h1>
      <img src="./LoginLogo.jpg" style="width:300px;margin:10px;" alt="no">
      <label class="form-label" for="userName">EmailId
      <input type="text" class="form-control" name="user" required id="userName" placeholder="Enter Registered EamilId">
      <label class="form-label" for="password">Password
      <input type="text" class="form-control" name="password" required id="password" placeholder="Enter Registered EamilId">
      <button type="submit" class="btn btn-primary mid mt-2" style="margin-left: 90px;">Login</button>
      </form>
    </div>
</body>
</html>