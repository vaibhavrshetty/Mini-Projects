<?php
require('config.php');
session_start();
if(!isset($_SESSION['usn']))
{
    header("location: log.php");
}
$usn=$_SESSION['usn'];
$sql= "SELECT S.cid,S.cname,R.mse1,R.mse2,R.see,R.total,R.grade FROM result R,subject S WHERE R.rcid=S.cid and R.rusn='$usn'";
$result= mysqli_query($conn,$sql);

$sql2="SELECT name,sem,branch FROM student where usn='$usn'";
$result2= mysqli_query($conn,$sql2);

$sql3= "SELECT R.grade FROM student ST,result R,subject S WHERE ST.usn=R.rusn and ST.sem=S.sem and R.rcid=S.cid and R.rusn='$usn'";
$result3= mysqli_query($conn,$sql3);
 function grademark($gd)
 {
     $point=0;
    if($gd=='S')
    {
        $point=10;
    }
    else if ($gd=='A')
    {
        $point=9;
    }
    else if ($gd=='B')
    {
        $point=8;
    }
    else if ($gd=='C')
    {
        $point=7;
    }
    else if ($gd=='D')
    {
        $point=6;
    }
    else if ($gd=='E')
    {
        $point=5;
    }
    else if ($gd=='F')
    {
        $point=0;
    }
    return $point;
 }
 $n=0;
 $grdpt=0;
 while($row1=mysqli_fetch_assoc($result3))
    {
        $gra=$row1['grade'];
        $grdpt+=grademark($gra);
        $n++;
    }
    $sgpa=$grdpt/$n;

    $sqls="SELECT sem FROM student where usn='$usn'";
    $results= mysqli_query($conn,$sqls);
    $rows=mysqli_fetch_assoc($results);
    $sem=$rows['sem'];
    if($sem==1)
    {
    $sqli="UPDATE sgpa set sgpa1='$sgpa' where usn='$usn'";
    
    }
    else if($sem==2)
    {
    $sqli="UPDATE sgpa set sgpa2='$sgpa' where usn='$usn'";
    
    }
    else if($sem==3)
    {
    $sqli="UPDATE sgpa set sgpa3='$sgpa' where usn='$usn'";
    
    }
    else if($sem==4)
    {
    $sqli="UPDATE sgpa set sgpa4='$sgpa' where usn='$usn'";
    
    }
    else if($sem==5)
    {
    $sqli="UPDATE sgpa set sgpa5='$sgpa' where usn='$usn'";
    
    }
    else if($sem==6)
    {
    $sqli="UPDATE sgpa set sgpa6='$sgpa' where usn='$usn'";
    
    }
    else if($sem==7)
    {
    $sqli="UPDATE sgpa set sgpa7='$sgpa' where usn='$usn'";
    
    }
    else if($sem==8)
    {
    $sqli="UPDATE sgpa set sgpa8='$sgpa' where usn='$usn'";
    
    }
    $conn->query($sqli);


    $sqlup="SELECT sgpa1,sgpa2,sgpa3,sgpa4,sgpa5,sgpa6,sgpa7,sgpa8 from sgpa where usn='$usn'";
    $resultup= mysqli_query($conn,$sqlup);
    $rowup=mysqli_fetch_assoc($resultup);
    if($sem==1)
    {
        $cgpa=$rowup['sgpa1'];
    }
    else if($sem==2)
    {
        $cgpa=($rowup['sgpa1']+$rowup['sgpa2'])/2;
    }
    else if ($sem==3)
    {
        $cgpa=($rowup['sgpa1']+$rowup['sgpa2']+$rowup['sgpa3'])/3;
    }
    else if ($sem==4)
    {
        $cgpa=($rowup['sgpa1']+$rowup['sgpa2']+$rowup['sgpa3']+$rowup['sgpa4'])/4;
    }
    else if ($sem==5)
    {
        $cgpa=($rowup['sgpa1']+$rowup['sgpa2']+$rowup['sgpa3']+$rowup['sgpa4']+$rowup['sgpa5'])/5;
    }
    else if ($sem==6)
    {
        $cgpa=($rowup['sgpa1']+$rowup['sgpa2']+$rowup['sgpa3']+$rowup['sgpa4']+$rowup['sgpa5']+$rowup['sgpa6'])/6;
    }
    else if ($sem==7)
    {
        $cgpa=($rowup['sgpa1']+$rowup['sgpa2']+$rowup['sgpa3']+$rowup['sgpa4']+$rowup['sgpa5']+$rowup['sgpa6']+$rowup['sgpa7'])/7;
    }
    else if ($sem==8)
    {
        $cgpa=($rowup['sgpa1']+$rowup['sgpa2']+$rowup['sgpa3']+$rowup['sgpa4']+$rowup['sgpa5']+$rowup['sgpa6']+$rowup['sgpa7']+$rowup['sgpa8'])/8;
    }
    
    $sqlq="UPDATE sgpa set cgpa='$cgpa' where usn='$usn'";
    $conn->query($sqlq);   
    


    $sqlc="SELECT cgpa FROM sgpa where usn='$usn'";
    $resultc= mysqli_query($conn,$sqlc);
    




 



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
    <a class="navbar-brand" href="logout.php">ScoreSheet</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>

      </ul>

    </div>
  </nav>

    


<div class="container-1 ">
    <p class="header"> <u>RESULTS</u></p>
          <?php if(mysqli_num_rows($result2)){
              if($row1=mysqli_fetch_assoc($result2)){?>
              
              
              <div class="container">
                <div class="contitem1">
                    <b>USN : </b><?php echo $usn ?>  
                </div>
                <div class="contitem1">
                    <b>Name : </b><?php echo $row1['name']; ?>
                </div>
                <div class="contitem1">
                    <b>Branch : </b><?php echo $row1['branch']; ?>
                </div>
                <div class="contitem1">
                    <b>Sem : </b><?php echo $row1['sem']; ?>
              </div>
             </div>
          
          
          <?php }}
          else
          {
            echo "No records found";
          } ?>   
          

          

          
      <!-- </div>
      <div class="contitem2">
      <b>SGPA : </b><?php echo $sgpa ?> 
        </div> -->
    <div class="card welcome">       
        
        <!-- <div class="card-body tablecard"> -->

            <table class="table bg-dark table">
                <thead>
                    <tr>
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
                    <?php if(mysqli_num_rows($result)){
                        while($row= mysqli_fetch_assoc($result))
                        {?>
                    <tr>
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
    <div class="result">
            <div class="res">
                <b>SGPA : </b><?php echo $sgpa ?>
            </div>
        
            <?php if(mysqli_num_rows($resultc)){
              if($rowc=mysqli_fetch_assoc($resultc)){?>
              
              <div class="res">
              <b>CGPA : </b><?php echo $rowc['cgpa']; ?> 
              </div>
          <?php }}
          else
          {
            echo "No records found";
          } ?>   
    </div>


        </div>

    

</body>

</html>