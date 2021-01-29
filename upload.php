<?php
$target_dir = "./";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
   	$uploadOk = 1;
     echo "<script>alert('File has been uploaded successfully')</script>";
     header("refresh:1;url=index.php" );
    
}

// Check if file already exists
if (file_exists($target_file)) {
 echo "<script>alert('Sorry, File already exist')</script>";
     header("refresh:1;url=index.php" );
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType!="doc" && $imageFileType !="docx" && $imageFileType != "ppt" && $imageFileType != "pptx" && $imageFileType!="docs" && $imageFileType!="doc" && $imageFileType!="xlsx" && $imageFileType!="pub" && $imageFileType!="xls" && $imageFileType!="pdf") {
	 $uploadOk = 0;
  echo "<script> alert('Sorry, file you are trying to upload is not allowed')</script>";
 header("refresh:1;url=index.php");
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "<script> alert('The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.') </script>";
    header("refresh:1;url=index.php" );
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>