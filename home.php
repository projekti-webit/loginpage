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


function dergo_email(){
    if(isset($_POST["dergo_mail"])){
        $to =  trim($_POST["to"]);
        $subject = trim($_POST["subject"]);
        $message = trim($_POST["message"]);
        $from = trim($_POST["from"]);
        $headers = "From: $from";
    
    mail($to, $subject, $message,$headers );
    echo "U dergua me sukses!";
}

//require 'class/class.phpmailer.php';
 // $mail = new PHPMailer;
  //$mail->IsSMTP();        //Sets Mailer to send message using SMTP
  //$mail->Host = 'smtpout.secureserver.net';  //Sets the SMTP hosts
  //$mail->Port = '80';        //Sets the default SMTP server port
  //$mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
  //$mail->Username = 'user';     //Sets SMTP username
  //$mail->Password = 'pass';     //Sets SMTP password
 // $mail->SMTPSecure = '';       //Sets connection prefix. Options are "", "ssl" or "tls"
 // $mail->From = $_POST["email"];     //Sets the From email address for the message
 // $mail->FromName = $_POST["name"];    //Sets the From name of the message
 // $mail->AddAddress('info@find2rent.com', 'Name');//Adds a "To" address
 // $mail->AddCC($_POST["email"], $_POST["name"]); //Adds a "Cc" address
 // $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
 // $mail->IsHTML(true);       //Sets message type to HTML    
  //$mail->Subject = $_POST["subject"];    //Sets the Subject of the message
  //$mail->Body = $_POST["message"];    //An HTML or plain text message body
  //if($mail->Send())        //Send an Email. Return true on success or false on error
  //{
  // $error = '<label class="text-success">Thank you for contacting us</label>';
  //}

}

?>
   



<!--/. ktu fillon permbajtja e faqes kryesore me titullin e faqes "   -->
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
                         <button name="upload_foto" id="upload_foto" class="btn btn-primary" data-toggle="modal"  data-target="#foto_upload">Ngarko foto profili</button>
                         <!--/. <img src="echo 'uploads/'.$image; " alt="foto profili">   -->
                         
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
                            <li class=""><a href="#send_mail" data-toggle="tab">Komunikim</a>
                            </li>
                            <li class=""><a href="#ndrysho_passwd" data-toggle="tab">Siguria</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade" id="send_mail">
                                <p> dergo email</p>

                                 <form action="home.php" method="post">
                                     <?php dergo_email();
                                         ?> 
                                
                                    <div class="form-group">
                                     
                                Per*:<br>
                                <input type="text" class="form-control" placeholder = "email-i i marresit" name="to" required="required" autocomplete="off">
                                
                                     </div>
                                     <div class="form-group">
                                
                                Subjekti *:<br>
                                <input type="text" class="form-control" placeholder = "subjekti" name="subject"  required="required" autocomplete="off">

                                
                                     </div>
                                     <div class="form-group">
                                
                                 Mesazhi *:<br>
                                <input type="text" class="form-control" placeholder = "permbajtja e email" name="message"  required="required" autocomplete="off">
                                
                                
                                 Dergon *:<br>
                                <input type="text" class="form-control" placeholder = "email-i juaj" name="from"  required="required" autocomplete="off">
                                
                            </div>
                                 <input type="hidden" name="hidden" value="1">
                                
                                <input type="submit"  class="btn btn-primary" name="dergo_mail" id="dergo_mail" value = "Dergo"/>
                                
                                </form>

                            </div>
                            <div class="tab-pane fade" id="ndrysho_passwd">
                                    
                                    <?php if(isset($_SESSION["message"])) 
                                        {
                                        echo $_SESSION["message"];
                                        unset($_SESSION["message"]);
                                        }
                                         ?> 
                                <form action="home.php" method="post">
                                    
                                <ol>
                                    <div class="form-group">
                                <li>      
                                Fjalekalimi aktual *:<br>
                                <input type="password" class="form-control" name="current_password">
                                </li>
                                     </div>
                                     <div class="form-group">
                                <li>
                                Fjalekalimi i ri *:<br>
                                <input type="password" class="form-control" name="password">

                                </li>
                                     </div>
                                     <div class="form-group">
                                <li>
                                 Konfirmo fjalekalimin e ri *:<br>
                                <input type="password" class="form-control" name="password_again">
                                </li>
                            </div>
                                 <input type="hidden" name="change_pass" value="1">
                                <li>
                                <input type="submit"  class="btn btn-primary" name="submit" id="submit"/>
                                </li>
                                </ol>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
        	</div>
    	</div>

<div class="modal fade" id="foto_upload" tabindex="-1" role="dialog" aria-labelledby="modal_Label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
          <form action="upload.php" method="post" enctype="multipart/form-data">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="modal_Label"> Zgjidhni nje foto per postim:</h4>
              </div>
            
              <div class="modal-body">
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="Posto">
                <input type="hidden" class="form-control" id="idDelete" name="id_del" />
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Anullo</button>
                  

              </div>
          </form>
        </div>
    </div>
</div>
  
        

<?php 
include("footer.php");
?>