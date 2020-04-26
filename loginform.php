<?php
$servername ="localhost";
$username="root";
$password="";
$dbname="multiuser";

$conn =mysqli_connect($servername,$username,$password,$dbname);


if(isset($_POST['LOGIN'])){
    $user=$_POST['username'];
    $password=$_POST['password'];
    $usertype=$_POST['utype'];
    
    $query = "SELECT * FROM `multiuser` WHERE username='".$user."' AND password ='".$password."' and usertype = '".$usertype."'";
    
    
    $result= mysqli_query($conn,$query);
    $numrow = mysqli_num_rows($result);
    
    if($numrow==1){
       $row=mysqli_fetch_array($result);
           
            if($row['usertype']=="admin"){
                header('location: admin.php');
            }
        if($row['usertype']=="doktor"){
            header('location: doktor.php');
        }
        if($row['usertype']=="pacient"){
            header('location: pacient.php');
        }
    }
        
}

?>



<html>
<head>
 <title> Login Form</title>
 
 <link rel="stylesheet" a href="Css3/style.css">
 <link rel="stylesheet" a href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
img {
  border-radius: 50%;
}
        input[type=submit]{
            border-radius: 12px;
            background-color: #1E90FF;
            color: white;
        }
        
</style>
</head>
<body>
 <div class="container">
 <img src="https://i.pinimg.com/564x/d3/28/64/d32864ef49da3f23c9fd57109dc876e4.jpg" />
 <form method="POST" action="loginform.php" >
     <div>
  <input type="radio" name="utype" value="doktor"> DOKTOR
  <input type="radio" name="utype" value="pacient"> PACIENT
  <input type="radio" name="utype" value="admin"> ADMIN
     </div>
 <div class="form-input">
     <i class="fa fa-user icon"></i>
 <input type="text" name="username" placeholder="Enter the User Name"/> 
 </div>
 <div class="form-input">
     <i class="fa fa-key icon"></i>
 <input type="password" name="password" placeholder="password"/>
 </div>
    
 <input type="submit" name="LOGIN" value="LOGIN" class="btn-login" />
     </form>
 </div>
</body>
</html>