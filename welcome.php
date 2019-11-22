<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_GET['logout'])){
        $logout = $_GET['logout'];

        if($logout === 'true'){
            $_SESSION['username'] = null;
        }
    }

    // check session variable to see if we are still logged in
    if($_SESSION['username'] != null){
        // if we are logged in...
        echo "Hello " . $_SESSION['username'];
        echo "<br />";
        echo "You are still logged in";
        echo "<br />";
    } else {
        // if we are not logged in send status code 302
        // back to browser to redirect to login page
        header("Location: boringLogin.php");
    }
?>

<!-- W3Schools code - https://www.w3schools.com/php/php_file_upload.asp -->
<?php
    if(isset($_POST["submit"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if(!file_exists($target_dir)){
            mkdir($target_dir);
        }

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file) && 
                !isset($_POST['overwrite'])) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && 
                $imageFileType != "png" && 
                $imageFileType != "jpeg" && 
                $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
?>


<!DOCTYPE html>
<html>
<body>
    <br />
    <a href="welcome.php?logout=true">Log me out</a>

    <form action="" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <br>
        <input type="checkbox" name="overwrite" value="replace_file">Replace File
        <input type="submit" value="Upload Image" name="submit">
    </form>

</body>
</html>