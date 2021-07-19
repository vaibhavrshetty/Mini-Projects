<?php

require('config.php');
if(isset($_POST['submit']))
{
    
    $name =  $_POST['name'];
    $usn= $_POST['usn'];
    $sem = $_POST['sem'];
    $branch = $_POST['branch'];     
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    

    if($password==$confirm)
    {
        $sqld = "INSERT INTO student(usn,name,sem,branch,password)VALUES('$usn','$name','$sem','$branch','$password')";
        $sqlr="INSERT into sgpa(usn)VALUES('$usn')";
        
    }
    else
    {
        die("Error: Passwords do not match.");
    }

    if ($conn->query($sqld) === TRUE)
    {
        // echo "New record created successfully";
        header("location: log.php");
    } 
    else 
    {
        echo "Error: " . $sqld . "<br>" . $conn->error;
    }
    if ($conn->query($sqlr) === TRUE)
    {
        // echo "New record created successfully";
        header("location: log.php");
    } 
    else 
    {
        echo "Error: " . $sqlr . "<br>" . $conn->error;
    }

    $sqlm="SELECT cid FROM subject where sem='$sem' and branch='$branch' and elective='0'";
    $result= mysqli_query($conn,$sqlm);
    if(mysqli_num_rows($result)>0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $cid=$row['cid'];
            $sql1 = "INSERT INTO enroll(susn,ecid)VALUES('$usn','$cid')";
            $sql2 = "INSERT INTO result(rusn,rcid)VALUES('$usn','$cid')";
            if ($conn->query($sql1) === TRUE)
            {
                // echo "New record created successfully";
                header("location: log.php");
            } 
            else 
            {
                echo "Error: " . $sql1 . "<br>" . $conn->error;
            }
            if ($conn->query($sql2) === TRUE)
            {
                // echo "New record created successfully";
                header("location: log.php");
            } 
            else 
            {
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }
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
    <div class="card stu-reg">
        <h2>Student Registration</h2>
        <div class="card-body cardbody">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-2 nameform">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control" name="name" id="inputName" maxlength="25">
                    </div>
                    <div class="form-group col-md-2 usnform">
                        <label for="inputUsn">USN</label>
                        <input type="text" class="form-control" name="usn" id="inputUsn" maxlength="25">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4 sem">
                        <label for="inputSem">Sem</label>
                        <select name="sem" id="inputSem" class="form-control" >
                            <option selected>Choose...</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputBranch">Branch</label>
                        <select id="inputBranch" class="form-control" name="branch">
                            <option selected>Choose...</option>
                            <option value="Computer Science Engineering(CSE)">Computer Science Engineering(CSE)</option>
                            <option value="Information Science Engineering(ISE)">Information Science Engineering(ISE)</option>
                            <option value="Mechanical Engineering(MECH)">Mechanical Engineering(MECH)</option>
                            <option value="Civil Engineering(CV)">Civil Engineering(CV)</option>
                            <option value="Electronics and Communication Engineering(ECE)">Electronics and Communication Engineering(ECE)</option>
                            <option value="Electrical and Electronics Engineering(EEE)">Electrical and Electronics Engineering(EEE)</option>
                            <option value="Biotechnical Engineeering(BT)">Biotechnical Engineeering(BT)</option>
                        </select>
                    </div>
                    <!-- <div class="form-group col-md-6">
                        <label for="inputDate">Date of Birth</label>
                        <input type="date" class="form-control" id="inputDate" name="dob">
                    </div> -->
                </div>
                <!-- <div class="form-row">
                    

                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4">
                    </div>
                </div> -->
                <!-- <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control" id="inputPassword4" name="password">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword5">Confirm Password</label>
                        <input type="password" class="form-control" id="inputPassword5" name="confirm">
                    </div>
                </div>
                <center>
                    <button type="submit" class="btn btn-primary" name="submit">Register</button>
                </center>
                
            </form>
        </div>

    </div>
    </div> --> 
<!-- <!-- </body>  -->

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <a class="navbar-brand" href="log.php">ScoreSheet</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="tlog.php">Teacher Login</a>
        </li>

      </ul>

    </div>
  </nav>
    <div class="card-login bg-dark">
        <h2>Registration</h2>
        <div class="card-body">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control" name="name" id="inputName" maxlength="25">
                    </div>
                    <div class="form-group">
                        <label for="inputUsn">USN</label>
                        <input type="text" class="form-control" name="usn" id="inputUsn" maxlength="25">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="inputSem">Sem</label>
                        <select name="sem" id="inputSem" class="form-control" >
                            <option selected>Choose...</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputBranch">Branch</label>
                        <select id="inputBranch" class="form-control" name="branch">
                            <option selected>Choose...</option>
                            <option value="Computer Science Engineering(CSE)">Computer Science Engineering(CSE)</option>
                            <option value="Information Science Engineering(ISE)">Information Science Engineering(ISE)</option>
                            <option value="Mechanical Engineering(MECH)">Mechanical Engineering(MECH)</option>
                            <option value="Civil Engineering(CV)">Civil Engineering(CV)</option>
                            <option value="Electronics and Communication Engineering(ECE)">Electronics and Communication Engineering(ECE)</option>
                            <option value="Electrical and Electronics Engineering(EEE)">Electrical and Electronics Engineering(EEE)</option>
                            <option value="Biotechnical Engineeering(BT)">Biotechnical Engineeering(BT)</option>
                        </select>
                    </div>
                    <!-- <div class="form-group col-md-6">
                        <label for="inputDate">Date of Birth</label>
                        <input type="date" class="form-control" id="inputDate" name="dob">
                    </div> -->
                </div>
                <!-- <div class="form-row">
                    

                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4">
                    </div>
                </div> -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control" id="inputPassword4" name="password">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword5">Confirm Password</label>
                        <input type="password" class="form-control" id="inputPassword5" name="confirm">
                    </div>
                </div>
                
                    <button type="submit" class="btn " name="submit">Register</button>
                
                
            </form>
        </div>

    </div>
    </div>
</body>
</html>