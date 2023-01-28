<?php
$login=false;
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $server="localhost";
    $user="root";
    $password="";
    $database="users";
    $conn=mysqli_connect($server,$user,$password,$database);
    if(!$conn)
    {
        echo '<div class="alert alert-danger" role="alert">
        Failed to login!
      </div>';
    }
    else
    {
        $email=$_POST['email'];
        $pass=$_POST['password'];
        $sql="SELECT * from user where email='$email' and password='$pass'";
        $result=mysqli_query($conn,$sql);
        $count=mysqli_num_rows($result);
        if($count==1)
        {
            $login=true;
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['username']=$email;
            header("location: welcome.php");
        }
        else{
            echo '<div class="alert alert-danger" role="alert">
            Email and password do not match!
          </div>';
        }
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <?php require "partials/_navbar.php" ?>
    <div class="container">
        <h1>Login here.</h1>
        <form action="/loginsystem/login.php" method="post">
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
    
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>