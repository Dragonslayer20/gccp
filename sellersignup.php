<?php
 $showalert = false;
 $showerror = false ;
if($_SERVER['REQUEST_METHOD']=="POST"){
    require "dbconnect.php";
    $username = $_POST['username'];
    $email  = $_POST['email'];
    $phoneno = $_POST['phoneno'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $service = $_POST['service'];
    $location = $_POST['location'];
    $sql1 = "SELECT * from `internship`.`studentsignup` where username= '$username' and email='$email' ";
    $result1 = mysqli_query($conn , $sql1) or die(mysqli_error($sql1));
    $num = mysqli_num_rows($result1);
    if($num == 0){
        if($password == $cpassword && $username != "" && $email!="")
        {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql =" INSERT into `internship`.`studentsignup` VALUES('null','$username','$email','$phoneno','$hash','$cpassword','$service',' $location')";
            $result = mysqli_query($conn , $sql)  or die( mysqli_error($conn));

            $table = $username.'student';
            $sql ="CREATE TABLE `internship`.`$table`(
               buyers varchar(255),
               dates varchar(255),
               title varchar(255)
           )";
           $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

            header("location:studentlogin.php");
        }
        else{
            $showalert = true;
        }
    }
    else{
        $showerror = true ;
    }

 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
    <style>
       
         .table1 {
            margin: 5%;
            padding: 4%;
            margin-right: 31%;
            margin-left: 28%;
            border-radius: 33px;
            box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
        }
        .btn{
            width:100px;
            border-radius: 33px;
        }
    </style>
</head>
<body>
<?php require "student/nav.php";?>
<script> <?php if($showerror){
        echo 'alert("Username or email is already exist");';
        } 
        if($showalert){
            echo 'alert("keep your password and confirm password same");';
        } ?>
</script>
    <div class="middle">
        <div class="table1">
        <form action="studentsignup.php" method="post">
                <h2><b>Register as a Professionals</b></h2>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input placeholder="username" name="username" type="varchar" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Email</label>
                        <input  name="email" type="varchar" class="form-control" id="exampleInputPassword1" placeholder="email">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Phone no.</label>
                        <input maxlength="10" minlength="10" type="int" name="phoneno" placeholder="phone no." class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input placeholder="password" name="password" type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">confirm Password</label>
                        <input placeholder="confirm password"name="cpassword" type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Service</label>
                        <input placeholder="Service" name="service" type="varchar" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Location</label>
                        <input placeholder="Location" name="location" type="varchar" class="form-control" id="exampleInputPassword1">
                    </div>

                <center><button type="submit" class="btn btn-success" >Submit</button></center> 
            </form>
                    
        </div>
       <div class="footer" style="position:center;">
           <center> <h2> <strong style="color: red;"> < </strong> <strong style="color: blue;"> > </strong> </h2> </center>  
            <center><h3><strong>GDSC MCET</strong></h3></center>
        </div>
    </div>
</body>
</html>