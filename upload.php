<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "Foto - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "Skedari nuk eshte nje foto.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Fotoja eshte ruajtur me pare";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "File i zgjedhur eshte shume i madh";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sigurohuni qe fotoja te jete ne formatin JPG, JPEG, PNG ose GIF ";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Fotoja nuk eshte ruajtur";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "Fotoja ". basename( $_FILES["fileToUpload"]["name"]). " u ngarkua";
    $image=$_FILES["file"]["name"];
     /* Displaying Image*/
      $img="uploads/".$image;
    echo '<img src= "'.$img.'">';
       echo '<img src = "'.$img.'".$file.'.png'; 
  } else {
    echo "Dicka nuk shkon ne ngarkimin e fotos";
  }
}
?>