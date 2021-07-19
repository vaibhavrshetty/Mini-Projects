<?php
// echo 'hello';
require('config.php');
session_start();
if(!isset($_SESSION['tid']))
{
    header("location: tlog.php");
}
$tid=$_SESSION['tid'];
if(isset($_POST['add']))
{
  //echo 'hii';
  $rusn =  $_POST['susn'];
  $rcid= $_POST['ecid'];  
  $exam=$_POST['exam'];
  $marks=$_POST['marks'];
  
  
  if($exam=="MSE-1")
  {
    $sql = "UPDATE result SET mse1='$marks' WHERE rusn='$rusn' and rcid='$rcid'";
  }
  else if($exam=="MSE-2")
  {
    $sql = "UPDATE result SET mse2='$marks' WHERE rusn='$rusn' and rcid='$rcid'";
  }
  else if($exam=="SEE")
  {
    $sql = "UPDATE result SET see='$marks' WHERE rusn='$rusn' and rcid='$rcid'";
    
  }       

  if ($conn->query($sql) === TRUE)
  {
    // echo "New record created successfully";
    header("location: tpage.php");
  } 
  else 
  {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  if($exam=="SEE")
    {
      $sqlm= "SELECT mse1,mse2 FROM result WHERE rusn='$rusn' and rcid='$rcid'";
      $result= mysqli_query($conn,$sqlm);
      if(mysqli_num_rows($result)==1)
      {
        $row=mysqli_fetch_assoc($result);
        // $_SESSION['usn']=$usn;
        //echo $row['id'];
        $mse1=$row['mse1'];
        $mse2=$row['mse2'];
        $total=$mse1+$mse2+$marks;
      }     
      $sql2 = "UPDATE result SET total='$total' WHERE rusn='$rusn' and rcid='$rcid'";

      if ($conn->query($sql2) === TRUE)
      {
        // echo "New record created successfully";
        header("location: tpage.php");
      } 
      else 
      {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
      }

      $sqln= "SELECT total FROM result WHERE rusn='$rusn' and rcid='$rcid'";
      $resultn= mysqli_query($conn,$sqln);
      if(mysqli_num_rows($resultn)==1)
      {
        $rown=mysqli_fetch_assoc($resultn);
        // $_SESSION['usn']=$usn;
        //echo $row['id'];
        $tot=$rown['total'];
        if($tot>90)
        {
          $grade='S';
        }
        else if($tot<=90 and $tot>80)
        {
          $grade='A';
        }
        else if($tot<=80 and $tot>70)
        {
          $grade='B';
        }
        else if($tot<=70 and $tot>60)
        {
          $grade='C';
        }
        else if($tot<=60 and $tot>50)
        {
          $grade='D';
        }
        else if($tot<=50 and $tot>=35)
        {
          $grade='E';
        }
        else if($tot<35)
        {
          $grade='F';
        }
        $sql3 = "UPDATE result SET grade='$grade' WHERE rusn='$rusn' and rcid='$rcid'";        
      } 
      if ($conn->query($sql3) === TRUE)
      {
        // echo "New record created successfully";
        header("location: tpage.php");
      } 
      else 
      {
        echo "Error: " . $sql3 . "<br>" . $conn->error;
      }
    }
  }  

      $sqlv="SELECT DISTINCT usn,name,S.sem,rcid as cid,cname,mse1,mse2,see,total,grade from result R,student S,subject C where R.rusn=S.usn and R.rcid=C.cid and rcid in (SELECT ecid from enroll where etid='$tid' ) "; 
      $resultv= mysqli_query($conn,$sqlv);

      // $sqlq="SELECT susn,ecid from enroll where etid='$_SESSION['tid']'";
      // $resultq= mysqli_query($conn,$sqln);
      // while($rowq=mysqli_fetch_assoc($resultq))
      // {
      //   $usn=$rowq['susn'];
      //   $cid=$rowq['ecid'];
      //   $sqlv="SELECT DISTINCT usn,name,S.sem,rcid,cname,mse1,mse2,see,total,grade from result R,student S,subject C where R.rusn=S.usn and R.rcid=C.cid and rcid in (SELECT ecid from enroll where etid='$_SESSION['tid']')"; 
      //   $resultv= mysqli_query($conn,$sqlv);
      // }
        
    
        
// SELECT DISTINCT usn,name,sem,rcid,mse1,mse2,see,total,grade from result R,student S where R.rusn=S.usn and rcid='CS601';
    



      // $sql4= "SELECT R.grade FROM student ST,result R,subject S WHERE ST.usn=R.rusn and ST.sem=S.sem and R.rcid=S.cid and R.rusn='$usn'";
      // $result4= mysqli_query($conn,$sql4);
      // function grademark($gd)
      // {
      //   $point=0;
      //   if($gd=='S')
      //   {
      //       $point=10;
      //   }
      //   else if ($gd=='A')
      //   {
      //       $point=9;
      //   }
      //   else if ($gd=='B')
      //   {
      //       $point=8;
      //   }
      //   else if ($gd=='C')
      //   {
      //       $point=7;
      //   }
      //   else if ($gd=='D')
      //   {
      //       $point=6;
      //   }
      //   else if ($gd=='E')
      //   {
      //       $point=5;
      //   }
      //   else if ($gd=='F')
      //   {
      //       $point=0;
      //   }
      //   return $point;
      // }
      // $n=0;
      // $grdpt=0;
      // while($row4=mysqli_fetch_assoc($result4))
      // {
      //   $gra=$row4['grade'];
      //   $grdpt=$grdpt+grademark($gra);
      //   $n++;
      // }
      // $sgpa=$grdpt/$n;

      // $sql5="SELECT cgpa FROM student where usn='$usn'";
      // $result5= mysqli_query($conn,$sql5);
      // $row5=mysqli_fetch_assoc($result5);
      // $cgpa=$row5['cgpa'];
      
      // $cgpa=($cgpa+$sgpa)/2;
      // $sql4 = "UPDATE student SET cgpa='$cgpa' WHERE usn='$usn' ";
      // if ($conn->query($sql4) === TRUE)
      // {
      //   // echo "New record created successfully";
      //   header("location: tpage.php");
      // } 
      // else 
      // {
      //   echo "Error: " . $sql4 . "<br>" . $conn->error;
      // }

     
    

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

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <a class="navbar-brand" href="tlogout.php">ScoreSheet</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="tlogout.php">Logout</a>
        </li>

      </ul>

    </div>
  </nav>
        <div class="tcontainer">
        <div class="card-login bg-dark">
    <div class="card-body">
    <h2>Add marks</h2>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="form-group  login-usnform">
          <label for="inputUsn">USN</label>
          <input type="text" class="form-control" name="susn" id="inputUsn" maxlength="25">
        </div>

        <div class="form-group ">
          <label for="inputCourse">Enter Course no</label>
          <input type="text" class="form-control" id="inputCourse" name="ecid">
        </div>

        <div class="form-group  sem">
          <label for="inputSem">Exam</label>
          <select name="exam" id="inputExam" class="form-control select">
            <option selected>Choose...</option>
            <option value="MSE-1">MSE-1</option>
            <option value="MSE-2">MSE-2</option>
            <option value="SEE">SEE</option>
          </select>
        </div>

        <div class="form-group ">
          <label for="inputMarks">Enter Marks</label>
          <input type="number" step="0.01" class="form-control" id="inputMarks" name="marks">
        </div>
    
    
      <button type="submit" class="btn " name="add">Add</button>
    
    </form>
    </div>
  </div>

        
  <div class="card-sdet">
    <!-- <div class="card-body"> -->
    <table class="table bg-dark">
        <thead>
          <tr>
            <th scope="col">USN</th>
            <th scope="col">Name</th>
            <th scope="col">Sem</th>
            <th scope="col">Course No.</th>
            <th scope="col">Course Name</th>
            <th scope="col">MSE-1</th>
            <th scope="col">MSE-2</th>
            <th scope="col">SEE</th>
            <th scope="col">Total</th>
            <th scope="col">Grade</th>

            <!-- <th scope="col">Active</th> -->
          </tr>
        </thead>
        <tbody>
          <?php if(mysqli_num_rows($resultv)){
              while($row= mysqli_fetch_assoc($resultv))
              {?>
          <tr>
            <td>
              <?php echo $row['usn']; ?>
            </td>
            <td>
              <?php echo $row['name']; ?>
            </td>
            <td>
              <?php echo $row['sem']; ?>
            </td>

            <td>
              <?php echo $row['cid']; ?>
            </td>
            <td>
              <?php echo $row['cname']; ?>
            </td>
            <td>
              <?php echo $row['mse1']; ?>
            </td>
            <td>
              <?php echo $row['mse2']; ?>
            </td>
            <td>
              <?php echo $row['see']; ?>
            </td>
            <td>
              <?php echo $row['total']; ?>
            </td>
            <td>
              <?php echo $row['grade']; ?>
            </td>

          </tr>
          <?php } }
              else
              {
                  echo "No records found";
              }                        
              ?>

              
        </tbody>
            </table>
    <!-- </div> -->
  </div>

  
  
  </div>
  
  <!-- <script type="text/javascript">
    var nav=document.getElementById('nav');
    window.onscroll=function()
    {
      if(window.pageYOffset>100){
        nav.style.position="fixed";
        nav.style.top=0;
        }else{
          box.style.position="absolute";
          box.style.top=100;
        }
      }
    
                

  </script> -->







</body>

</html>