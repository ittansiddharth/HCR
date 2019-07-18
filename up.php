
<!doctype html><!doctype html>
<html>
<head>
    <?php
    
    if(isset($_POST['but_upload'])){
        $name = $_FILES['file']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
                $uploadOk=1;
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
				if($imageFileType != "zip")
				{
				echo "<script type='text/javascript'>alert('Sorry, Only .zip file supported');
                 window.location.href='upload.html';</script>";	
				}
				
                // Check if file already exists
                if (file_exists("uploads/sample.zip")) {
                   $output= shell_exec(" rm -r  uploads/* ");

                }

                // Check file size
                


               

                if($uploadOk ==0){


				echo "<script type='text/javascript'>alert('Constraint Violated, Image not Uploaded');
		 window.location.href='upload.html';</script>";

		         }
  
		if ($uploadOk == 1) {
			$image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
			$end_result = base64_decode($image_base64);
			$newfile=fopen("uploads/sample.zip","w") or die("unable to open");
			fwrite($newfile,$end_result);
			fclose($newfile);
				echo "<script type='text/javascript'>alert('Image Upload Successful!');
				window.location.href='unzip.php';</script>";
         
      }else {
        echo "<script type='text/javascript'>alert('Error Uploading Image!');
		window.location.href='';</script>";
      }
}
    ?>
<body>
   <!-- <form method="post" action="" enctype='multipart/form-data'>
        <input type='file' name='file' />
        <input type='submit' value='Save name' name='but_upload'>
   </form>-->

</body>
</html>
