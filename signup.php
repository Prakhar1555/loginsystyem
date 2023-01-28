<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];
    if($pass==$cpass)
    {
        $server="localhost";
        $user="root";
        $password="";
        $database="users";
        $conn=mysqli_connect($server,$user,$password,$database);
        if(!$conn)
        {
            echo '<div class="alert alert-danger" role="alert">
            Connection failed!
          </div>';
        }
        else{
            $sql="Select * from user where email='$email'";
            $result=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($result);
            if($count==0)
            {
                $sql="INSERT INTO `user` (`email`, `password`, `timestap`) VALUES ('$email', '$pass', 'current_timestamp(6).000000')";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo '<div class="alert alert-danger" role="alert">
                    Sign in failed!
                  </div>';
                }
                else{
                    echo '<div class="alert alert-success" role="alert">
                    Successfully signed in!
                  </div>';
                }
            }
            else{
                echo '<div class="alert alert-danger" role="alert">
                Username already exists!
              </div>';
            }
        }
        
    }
    else{
        echo '<div class="alert alert-danger" role="alert">
        Passwords do not match!
      </div>';
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <?php require "partials/_navbar.php" ?>
    <div class="container">
        <h1>Signup here.</h1>
        <form action="/loginsystem/signup.php" method="post">
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
    
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="mb-3">
    <label for="cpassword" class="form-label">Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>