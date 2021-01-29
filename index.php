<?php
$localIP = '10.0.0.58'; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>File Management</title>
	<link rel="stylesheet" type="text/css" href="https://psbc-file-management.herokuapp.com/dist/css/bootstrap.css" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
  <a class="navbar-brand" href="#"><img src="https://psbc-file-management.herokuapp.com/img/psbc.png" width="70" height="70" class="float-left mr-4" /><h2 class="p-3">PSBC Document Management System</h2></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
    	<li class="nav-item mr-3">
    	<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  New Folder
</button></li>
<li class="nav-item">
    	<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#uploadFile">
  Upload File
</button></li>
    </ul>
  </div>
</nav>
<!--modal-->
<div class="modal" tabindex="-1" role="dialog" id="exampleModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Folder</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form method="post">
		<input type="text" class="form-control" name="folderName" />
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Create</button>
        	</form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--modal-->
<div class="modal" tabindex="-1" role="dialog" id="uploadFile">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Choose File to Upload</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form  action="upload.php" method="post" enctype="multipart/form-data">
  <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Upload</button>
        	</form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="container">
			<div class="row">
<?php
echo "<div class='col-12'>";
echo "<h2><a href='https://psbc-file-management.herokuapp.com/'><img src='https://psbc-file-management.herokuapp.com/img/home.png' width='100' height='100' /></a></h2>";
echo "<h3>Current Folder:".basename(__DIR__)."</h3></div>";
$dir = "./";

// Sort in ascending order - this is default
$a = scandir($dir);

// Sort in descending order
$folder = scandir($dir,1);
if(isset($_POST['folderName'])){
	mkdir($_POST['folderName']);
	copy('./index.php', $_POST['folderName'].'/index.php');
	copy('./upload.php', $_POST['folderName'].'/upload.php');
	echo '<script> alert("'.$_POST['folderName'].' Folder Created")</script>';
	header("refresh:0.5;url=index.php" );
}
$count =0;
foreach ($folder as $filename) {
	# code...

	if($filename!="dist" && $filename!=".." && $filename!="." && $filename!="img" &&  substr($filename, -4)!=".php" && substr($filename,-8)!="psbc.png"){
		$count++;
		?>
			<div class="col-sm-6 col-md-3 col-lg-3 ">
				<?php
				if(substr($filename, -5)==".xlsx"){
						echo '<div class="m-3 text-center p-3"><a href="'.$filename.'"><img src="https://psbc-file-management.herokuapp.com/excel.png" width="100" height="100" /> <br /><h4 class="text-dark">'.substr($filename,0,20).'</h4></a></div>';
				}
				else if(substr($filename, -5)==".docx"){
						echo '<div class="m-3 text-center p-3"><a href="'.$filename.'"><img src="https://psbc-file-management.herokuapp.com/" width="100" height="100" /> <br /><h4 class="text-dark">'.substr($filename,0,20).'</h4></a></div>';
				}
				else if(substr($filename, -4)==".pub"){
						echo '<div class="m-3 text-center p-3"><a href="'.$filename.'"><img src="https://psbc-file-management.herokuapp.com/pub.png" width="100" height="100" /> <br /><h4 class="text-dark">'.substr($filename,0,20).'</h4></a></div>';
				}
				else if(substr($filename, -4)==".pdf"){
						echo '<div class="m-3 text-center p-3"><a href="'.$filename.'"><img src="https://psbc-file-management.herokuapp.com/img/pdf.png" width="100" height="100" /> <br /><h4 class="text-dark">'.substr($filename,0,20).'</h4></a></div>';
				}
				else if(substr($filename, -5)==".pptx"){
						echo '<div class="m-3 text-center p-3"><a href="'.$filename.'"><img src="https://psbc-file-management.herokuapp.com/img/powerpoint.png" width="100" height="100" /> <br /><h4 class="text-dark">'.substr($filename,0,20).'</h4></a></div>';
				}
				else if(substr($filename, -4)==".png" || substr($filename, -4)==".jpg" || substr($filename, -4)==".gif"){
						echo '<div class="m-3 text-center p-3"><a href="'.$filename.'"><img src="'.$filename.'" width="100" height="100" /> <br /><h4 class="text-dark">'.substr($filename,0,20).'</h4></a></div>';
				}
				else{
				echo '<div class="m-3 text-center p-3"><a href="'.$filename.'"><img src="https://psbc-file-management.herokuapp.com/img/folder-icon.png" width="100" height="100" /> <br /><h4 class="text-dark">'.substr($filename,0,20).'</h4></a></div>';
					}
				?>
				</div>
			<?php

	}
}
if($count==0){
			echo "<h3 class='mt-4 text-center col-sm-12'>This Folder is currently Empty</h3>";	
}
?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
		</div>
		</div>

</body>
</html>

