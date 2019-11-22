<?php

    function make_folder($name_of_folder){
        $success = false;

        if(!file_exists($name_of_folder)){
            $success = mkdir($name_of_folder);
        }

        return $success;
    }

    function delete_folder($name_of_folder){
        $success = false;

        if(file_exists($name_of_folder)){
            $success = rmdir($name_of_folder);

            if(!$success){
                $errors = exec("rm -r $name_of_folder");
                $errors === "" ? $success = true : $success = false;
            }
        }

        return $success;
    }

    if(isset($_GET["dirName"])){

        $dir_name = filter_var($_GET["dirName"], FILTER_SANITIZE_STRING);
        $my_action = $_GET["myAction"];

        if($my_action == "create"){

            // create action selected
            if(make_folder($dir_name)){
                echo "Directory $dir_name Successfully Created";
            } else {
                echo "Directory $dir_name Could Not Be Created";
            }

        } else { 

            // delete action selected
            if(delete_folder($dir_name)){
                echo "Directory $dir_name Successfully Deleted";
            } else {
                echo "Directory $dir_name Could Not Be Deleted";
            }
            
        }
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Functions</title>
</head>
<body>
    <form action="" method="get">
        <input type="text" name="dirName" placeholder="Enter a folder name to create" size="40"><br>
        <input type="radio" name="myAction" value="create" checked>Create<br>
        <input type="radio" name="myAction" value="delete">Delete<br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>