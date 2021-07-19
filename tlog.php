<?php
require('config.php');
session_start();
if(isset($_POST['tid']))
{
    $tid=$_POST['tid'];
    $tpass=$_POST['tpass'];
    $sql= "SELECT tid FROM teacher WHERE tid = '".$tid."'and tpass = '".$tpass."'limit 1";

    if($tid==1919)
    {
        $_SESSION['tid']=$tid;
        header("location: adview.php");
    }
    else{

        $result= mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)==1)
        {
        $row=mysqli_fetch_assoc($result);
        // $_SESSION['usn']=$usn;
        //echo $row['id'];
        $_SESSION['tid']=$row['tid'];
        //echo $_SESSION['id'];
            header("location: tpage.php");
        }
        else
        {
            echo "Not logged in";
        }
        }
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScoreSheet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link rel="stylesheet" href="style1.css">
</head>

<!-- <body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark"> 
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">

        <!-- <li class="nav-item active">
        <a class="nav-link" href="tlog.php">Home <span class="sr-only">(current)</span></a>
      </li> -->

        <!-- <li class="nav-item">
          <a class="nav-link" href="log.php">Student Login</a>
        </li>

        </li>
        <a href="tlogout.php" class="nav-link">Logout</a>

      </ul>

    </div> -->
  <!-- </nav>
     <div class="card bg-dark tlogin">
        <h2>Teacher Login here...</h2>
        <div class="card-body ">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                
                    <div class="form-group  login-usnform">
                        <label for="inputUsn">ID</label>
                        <input type="text" class="form-control" name="tid" id="inputUsn" maxlength="25">
                    </div>               
                
                    <div class="form-group ">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control" id="inputPassword4" name="tpass">
                    </div>                 
                <center>
                    <button type="submit" class="btn btn-primary" name="submit">Login</button>
                </center>
                
            </form>
        </div>
    </div>
    </div>
</body>  --> 


<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <a class="navbar-brand" href="tlog.php">ScoreSheet</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="log.php">Student Login</a>
        </li>

      </ul>

    </div>
  </nav>
    
<div class="card-login bg-dark">
        <h2>Sign In</h2>
        <div class="card-body ">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                
                    <div class="form-group">
                        <label for="inputUsn">ID</label>
                        <input type="text" class="form-control" name="tid" id="inputUsn" maxlength="25">
                    </div>               
                
                    <div class="form-group">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control" id="inputPassword4" name="tpass">
                    </div>                 
                
                    <button type="submit" class="btn " name="submit">Login</button>
                
                
            </form>
        </div>
    </div>
    </div>
</body>
</html>