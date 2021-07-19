<?php
// echo 'hello';
require('config.php');
session_start();
if(!isset($_SESSION['tid']))
{
    header("location: tlog.php");
}
if(isset($_POST['submit']))
{
    //echo 'hii';
    $tname =  $_POST['tname'];
    $tid= $_POST['tid'];
    
    $branch = $_POST['branch'];
        
    $tpass = $_POST['tpass'];
    $confirm = $_POST['confirmtpass'];
    // ,sem,branch,dob,password
    // ,'$sem','$branch','$dob','$password'

 if($tpass==$confirm)
 {
    $sql = "INSERT INTO teacher(tid,tname,branch,tpass)VALUES('$tid','$tname','$branch','$tpass')";
 }
 else{
    die("Error: Passwords do not match.");
 }

if ($conn->query($sql) === TRUE)
 {
   
   header("location: adview.php");
  } 
  else 
  {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

if(isset($_POST['add']))
{
    
    $cname =  $_POST['cname'];
    $cid= $_POST['cid'];
    $sem=$_POST['sem'];
    $elective=$_POST['elective'];
    $branch = $_POST['branch'];
        
    


    $sql2 = "INSERT INTO subject(cid,cname,sem,branch,elective)VALUES('$cid','$cname','$sem','$branch','$elective')";
 

if ($conn->query($sql2) === TRUE)
 {
   // echo "New record created successfully";
   header("location: adview.php");
  } 
  else 
  {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
  }
}


if(isset($_POST['enroll']))
{
    
    
    $cid= $_POST['cid'];
    $tid=$_POST['tid'];
    
        
    


    $sql3 = "UPDATE enroll SET etid='$tid' WHERE ecid='$cid'";
 

    if ($conn->query($sql3) === TRUE)
    {
    // echo "New record created successfully";
    header("location: adview.php");
    } 
    else 
    {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
}



if(isset($_POST['update']))
{
    $sql3 ="UPDATE student set sem=sem+1";
    $conn->query($sql3) === TRUE;
}
if(isset($_POST['search']))
{
    $usn1=$_POST['searchusn'];
    $_SESSION['usn']=$usn1;
    header("location: search.php");
    

    
}
if(isset($_POST['updatecgpa']))
{
    $usn=$_POST['usn'];
    $sem=$_POST['sem'];
    $sgpa=$_POST['sgpa'];

    if($sem==1)
    {
        $sqlup="UPDATE sgpa set sgpa1='$sgpa' where usn='$usn'";
    }
    else if($sem==2)
    {
        $sqlup="UPDATE sgpa set sgpa2='$sgpa' where usn='$usn'";
    }
    else if($sem==3)
    {
        $sqlup="UPDATE sgpa set sgpa3='$sgpa' where usn='$usn'";
    }
    else if($sem==4)
    {
        $sqlup="UPDATE sgpa set sgpa4='$sgpa' where usn='$usn'";
    }
    else if($sem==5)
    {
        $sqlup="UPDATE sgpa set sgpa5='$sgpa' where usn='$usn'";
    }
    else if($sem==6)
    {
        $sqlup="UPDATE sgpa set sgpa6='$sgpa' where usn='$usn'";
    }
    else if($sem==7)
    {
        $sqlup="UPDATE sgpa set sgpa7='$sgpa' where usn='$usn'";
    }
    else if($sem==8)
    {
        $sqlup="UPDATE sgpa set sgpa8='$sgpa' where usn='$usn'";
    }
    if ($conn->query($sqlup) === TRUE)
    {
    // echo "New record created successfully";
    header("location: adview.php");
    } 
    else 
    {
        echo "Error: " . $sqlup . "<br>" . $conn->error;
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

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- navbar  -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <a class="navbar-brand" href="tlogout.php">ScoreSheet</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

      <!-- <li class="nav-item active">
        <a class="nav-link" href="tlog.php">Home <span class="sr-only">(current)</span></a>
      </li> -->

      <li class="nav-item">
        <a class="nav-link" href="#register">Register-Lecturer</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#subjects">Add-Subject</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#enroll">Enroll-Lecturer</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#addsgpa">Update-SGPA</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tlogout.php">Logout</a>
      </li>
      &nbsp &nbsp &nbsp 

      <li class="nav-item">
        <form class="form-inline " action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input class="form-control " type="search" name="searchusn" placeholder="Search by USN" aria-label="Search">
        <button class="btn btn-outline-success " name="search" type="submit" >Search</button>
        
        </form>
      </li>
      
      
    </ul>
    
  </div>
</nav>

    <!-- update sem -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        
            <button type="submit" class="btn-update bg-dark" name="update">Update Sem</button>
        
    </form>

    <div class="acontainer">

    
    <!-- register teacher -->

    
        <div class="card-login1 bg-dark" id="register">
            <h2>Register Lecturer</h2>
            <div class="card-body cardbody">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-row">
                        <div class="form-group ">
                            <label for="inputName">Teacher Name</label>
                            <input type="text" class="form-control" name="tname" id="inputName" maxlength="25">
                        </div>
                        &nbsp &nbsp &nbsp &nbsp
                        <div class="form-group ">
                            <label for="inputId">Teacher ID</label>
                            <input type="text" class="form-control" name="tid" id="inputUsn" maxlength="25">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="inputBranch">Branch</label>
                        <select id="inputBranch" class="form-control" name="branch">
                            <option selected>Choose...</option>
                            <option value="Computer Science Engineering(CSE)">Computer Science Engineering(CSE)</option>
                            <option value="Information Science Engineering(ISE)">Information Science Engineering(ISE)
                            </option>
                            <option value="Mechanical Engineering(MECH)">Mechanical Engineering(MECH)</option>
                            <option value="Civil Engineering(CV)">Civil Engineering(CV)</option>
                            <option value="Electronics and Communication Engineering(ECE)">Electronics and Communication
                                Engineering(ECE)</option>
                            <option value="Electrical and Electronics Engineering(EEE)">Electrical and Electronics
                                Engineering(EEE)</option>
                            <option value="Biotechnical Engineeering(BT)">Biotechnical Engineeering(BT)</option>
                        </select>
                    </div>
            
            <div class="form-row">
                <div class="form-group ">
                    <label for="inputPassword4"> Password</label>
                    <input type="password" class="form-control pass" id="inputPassword4" name="tpass">
                </div>
                &nbsp &nbsp &nbsp &nbsp
                <div class="form-group ">
                    <label for="inputPassword5">Confirm Password</label>
                    <input type="password" class="form-control cpass" id="inputPassword5" name="confirmtpass">
                </div>
            </div>
            
            
                <button type="submit" class="btn " name="submit">Register</button>
                </div>
            
            </form>
        </div>
        </div>
        </div>
    


    <!-- add subjects -->
    <!-- <section> -->
        <div class="card-login2 bg-dark" id="subjects">
            <h2>Add Subject </h2>
            <div class="card-body cardbody">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-row">
                        <div class="form-group">
                            <label for="inputCid">Course Code</label>
                            <input type="text" class="form-control" name="cid" id="inputCid" maxlength="25">
                        </div>
                        &nbsp &nbsp &nbsp &nbsp
                        <div class="form-group ">
                            <label for="inputCname">Course Name</label>
                            <input type="text" class="form-control" name="cname" id="inputCname" maxlength="25">
                        </div>
                </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="inputSem">Sem</label>
                                <select name="sem" id="inputSem" class="form-control">
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
                            &nbsp &nbsp &nbsp &nbsp
                            <div class="form-group ">
                                <label for="inputSem">Elective/Core</label>
                                <select name="elective" id="inputElective" class="form-control">
                                    <option selected>Choose...</option>
                                    <option value="0">Core</option>
                                    <option value="1">Elective</option>                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group ">
                                <label for="inputBranch">Branch</label>
                                <select id="inputBranch" class="form-control" name="branch">
                                    <option selected>Choose...</option>
                                    <option value="Computer Science Engineering(CSE)">Computer Science Engineering(CSE)
                                    </option>
                                    <option value="Information Science Engineering(ISE)">Information Science
                                        Engineering(ISE)</option>
                                    <option value="Mechanical Engineering(MECH)">Mechanical Engineering(MECH)</option>
                                    <option value="Civil Engineering(CV)">Civil Engineering(CV)</option>
                                    <option value="Electronics and Communication Engineering(ECE)">Electronics and
                                        Communication
                                        Engineering(ECE)</option>
                                    <option value="Electrical and Electronics Engineering(EEE)">Electrical and
                                        Electronics Engineering(EEE)
                                    </option>
                                    <option value="Biotechnical Engineeering(BT)">Biotechnical Engineeering(BT)</option>
                                </select>
                            </div>
                        
                            <button type="submit" class="btn " name="add">Add</button>
                       
                </form>
                
            </div>
        </div>
        
    <!-- </section> -->

    <!-- enroll lecturer -->
    <!-- <section> -->
        <div class="card-login3 bg-dark" id="enroll">
            <h2>Enroll Lecturer</h2>
            <div class="card-body cardbody">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-row">
                        <div class="form-group ">
                            <label for="inputTid">Teacher ID</label>
                            <input type="text" class="form-control" name="tid" id="inputCname" maxlength="25">
                        </div>
                        &nbsp &nbsp &nbsp &nbsp
                        <div class="form-group ">
                            <label for="inputCid">Course Code</label>
                            <input type="text" class="form-control" name="cid" id="inputCid" maxlength="25">
                        </div>                      
                </div>
                        

                       
                            <button type="submit" class="btn " name="enroll">Enroll</button>
                        
                </form>
                
            </div>
        </div>
        
    <!-- </section> -->

    <!-- add sgpa  -->
    <!-- <section> -->
        <div class="card-login4 bg-dark" id="addsgpa">
            <h2>Update SGPA</h2>
            <div class="card-body cardbody">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-row">
                        <div class="form-group ">
                            <label for="inputUsn">Usn</label>
                            <input type="text" class="form-control" name="usn" id="inputUsn" maxlength="25">
                        </div>
                        &nbsp &nbsp &nbsp &nbsp
                        <div class="form-group ">
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
                    &nbsp &nbsp &nbsp &nbsp
                        <div class="form-group ">
                            <label for="inputSgpa">SGPA</label>
                            <input type="number" step="0.01" class="form-control" id="inputSgpa" name="sgpa">
                        </div>                       
                        </div>    
                       
                            <button type="submit" class="btn " name="updatecgpa">Update</button>
                        
                </form>
                
            </div>
        </div>
        
    <!-- </section> -->

    
    
    </div>
    


   



</body>

</html>