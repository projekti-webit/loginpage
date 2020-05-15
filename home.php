<?php
    
	include("header.php");
    include("top_menu.php");
    include("menu.php");

    if(isset($_POST["change_pass"])) {
        ndrysho_fjalekalim();
    }


    function gjenero_infopersonale(){
        require("admin_db/lidhje_db.php");

        $query = " SELECT * FROM perdoruesit where user_id = '".$_SESSION["user_id"]."' ";

        $tedhena = mysqli_query($db_connect, $query);

        if ($tedhena) {
            while ($row = mysqli_fetch_array($tedhena)) { 
                echo '
                    <label><b>Username: @'.$row['username'].'</label><br>
                    <label><b>Emri: '.$row['emri'].'</label><br>
                    <label><b>Mbiemri: ' .$row['mbiemri'].'</label><br>
                    <label><b>Kontakt: ' .$row['email'].'</label><br>
                   
                           
                ';
            } 
           
        } else {
            echo '
                <div class="alert alert-danger">
                    <center><strong>Nuk u gjet asnje informacion!!</strong></center>
                </div>
               
            ';   
        }
    }

    function ndrysho_fjalekalim(){
        
$message = kontrollo_fjalekalim();
    if($message !== "OK")  {
            $_SESSION["message"] = $message;
            return false;
        }
        
         require("admin_db/lidhje_db.php");
          $password_ri = md5($_POST['password']);
          $query_password_update = " 
          UPDATE perdoruesit SET password = '$password_ri' WHERE user_id = '".$_SESSION["user_id"]."'
          ";

         // $qtest = " 
         // UPDATE perdoruesit SET password = '$password_ri' WHERE user_id = '".$_SESSION["user_id"]."'
         // ";
         // echo $qtest;
         // exit();
    //update password in database
    $rezultati = mysqli_query($db_connect, $query_password_update);  

    if ($rezultati) {
        return true;
    } else {
        return false;
    }
}
    function kontrollo_fjalekalim(){
         require("admin_db/lidhje_db.php");

        $dbpassword = " SELECT password FROM perdoruesit where user_id = '".$_SESSION["user_id"]."' limit 1";
        // $qtest = " SELECT password FROM perdoruesit where user_id = '".$_SESSION["user_id"]."' limit 1";
        

        $pergjigje = mysqli_fetch_assoc(mysqli_query($db_connect, $dbpassword));
        

        if($pergjigje){
      if(isset($_POST["submit"])) {
    if (empty($_POST) == false) {
    $kerkohet = array('current_password', 'password', 'password_again');
    foreach($_POST as $key=>$value) {
        if (empty($value) && in_array($key, $kerkohet) == true) {
            return  'Plotesoni te gjitha fushat'; //kontrollon nqs jane plotesuar te gjitha
            break 1;
        }
    }
      if (trim($_POST['password']) != trim($_POST['password_again'])) {
            return  'Fjalekalimet nuk perputhen';
        } 

    if (md5($_POST['current_password']) == $pergjigje["password"]) {
            return "OK"; //if equal to current password
      
    } else {
       return  'Fjalekalimi aktual nuk eshte i sakte';   //else append error
    }
}
}
}
}
//if (isset($_GET['success']) && empty($_GET['success'])) {
 //   echo 'Fjalekalimi u ndryshua';
//} else {

    //if (empty($_POST) == false) {
       // ndrysho_fjalekalim();
        
    //}
//}//}

function ndrysho(){
    require("admin_db/lidhje_db.php");
 if(isset($_POST["submit"])) {
    $result = mysqli_query($db_connect, "SELECT * from perdoruesit WHERE user_id='" . $_SESSION["user_id"] . "'");
    $row = mysqli_fetch_array($result);
    if (md5($_POST["current_password"]) == $row["password"] && $_POST["current_password"] == $_POST["password_again"] ) {
        mysqli_query($db_connect, "UPDATE perdoruesit set password='" . $_POST["password"] . "' WHERE user_id='" . $_SESSION["user_id"] . "'");
        echo "Password Changed";
    } else
        echo "Current Password is not correct";
    }
}



?>
   



<!--/. ktu fillon permbajtja e faqes kryesore me titullin e faqes  -->
<div id="page-wrapper" >
	<div class="header"> 
		<h3 class="page-header">
			Jeni ne faqen kryesore
		</h3>
	</div>
    <hr style="height: 1px; background-color: #ccc; border: none;" >
	
	<!--/. main content per cdo faqe fillon ketu  -->
	<div id="page-inner">
		<div class="row">
			<div class="col-md-5 col-sm-5">
                <div class="panel panel-success">
                	<div class="panel-heading">
                        Informacione Personale
                    </div>
                    <div class="panel-body">
                    	<?php gjenero_infopersonale(); ?>
                         <button name="upload_foto" id="upload_foto" class="btn btn-primary">Ngarko foto profili</button>
                    </div>
                </div>
        	</div>
        	<div class="col-md-7 col-sm-7">
                <div class="panel panel-primary">
                	<div class="panel-heading">
                        Personalizime
                    </div>
                    <div class="panel-body">
                    	<ul class="nav nav-pills">
                            <li class=""><a href="#login_history" data-toggle="tab">Historiku</a>
                            </li>
                            <li class=""><a href="#ndrysho_passwd" data-toggle="tab">Siguria</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade" id="login_history">
                                <p> ktu do vendoset kur ka hyre per here te fundit ne sistem</p>
                            </div>
                            <div class="tab-pane fade" id="ndrysho_passwd">
                                    
                                    <?php if(isset($_SESSION["message"])) 
                                        {
                                        echo $_SESSION["message"];
                                        unset($_SESSION["message"]);
                                        }
                                         ?> 
                                <form action="home.php" method="post">
                                <ul>
                                <li>      
                                Fjalekalimi aktual*:<br>
                                <input type="password" name="current_password">
                                </li>
                                <li>
                                Fjalekalimi i ri*:<br>
                                <input type="password" name="password">

                                </li>
                                <li>
                                 Konfirmo fjalekalimin e ri*:<br>
                                <input type="password" name="password_again">
                                </li>
                                 <input type="hidden" name="change_pass" value="1">
                                <li>
                                <input type="submit" name="submit" id="submit"/>
                                </li>
                                </ul>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
        	</div>
    	</div>

<?php 
include("footer.php");
?>