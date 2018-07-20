<?php
  $currentDir = getcwd();
  $uploadDirectory = "/restaurantsLogo/";
  $errors = []; //all errors will be stored here ;
  $fileExtensions = ['jpeg','jpg','png'];
  
  $fileName = $_FILES['resPic']['name'];
  $fileSize = $_FILES['resPic']['size'];
  $fileTmpName  = $_FILES['resPic']['tmp_name'];
  $fileType = $_FILES['resPic']['type'];
  $fileExtension = strtolower(end(explode('.',$fileName)));
  $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 


  if (isset($_POST['submit'])) {

    if (! in_array($fileExtension,$fileExtensions)) {
        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }

    if ($fileSize > 2000000) {
        $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
    }

    if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
            echo "The file " . basename($fileName) . " has been uploaded  <br> ";
        } else {
            echo "An error occurred somewhere. Try again or contact the admin";
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "These are the errors" . "\n";
        }
    }
}


  $resName = $resPic  = $resLoc = $resOwner = $resDet = " ";
  $resNameDet   = fopen('myfile.txt','w') or die("Unable to open file!") ;
  function serverReq ($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);  
return $data;
}
if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
    // $resPic = serverReq($_POST['resPic']);
    $resName = serverReq($_POST['resName']);
    $resLoc = serverReq($_POST['resLoc']);
    $resOwner = serverReq($_POST['resOwner']);
    $resDet = serverReq($_POST['resDet']);
}
if ( $_SERVER["REQUEST_METHOD"] == 'POST' ) {
if ( $resName == '' ) { 
echo 'Restaurant Name is needed ';
}
else {
    echo "  Your Restaurants Name is  $resName";
    fwrite ($resNameDet,$resName);
} 
if ( $resLoc == "" ){
    echo ' <br> Restaurant Location is needed ';
}
else{
    echo "<br> Your Restaurants Address  is  $resLoc";
    fwrite ( $resNameDet , $resLoc);
}
if ( $resOwner == '' ){
    echo'<br> Restaurant Owners is needed ';
}
else{
    echo "<br> The Name of the restaurant owner is $resOwner";
    fwrite ($resNameDet, $resOwner);
}
if ( $resDet == "" ) {
    echo ' <br> Restaurants Details is needed ';
}
else{
echo "<br> Details of the restaurant all here  $resDet";
fwrite ($resNameDet,$resDet);
}
}
?> 
