<?php
    function mydata($name){
        $name = strtolower($name);

        require('dbconnection.php');

        $sql = "select * from users where lower(username) = '$name';";
        $results = $conn->query($sql);

        // echo "Pseudo-JSON<br>";

        // while($row = $results->fetch_assoc()){
        //     echo "{";
        //     echo '"username"' . ":\"" . $row['username'] . "\",";
        //     echo '"password"' . ":\"" . $row['password'] . "\",";
        //     echo '"location"' . ":\"" . $row['location'];
        //     echo '"}';
        //     echo "<br>";
        // }

        // $results->data_seek(0);
        // echo "<br>Real JSON<br>";

        // while($row = $results->fetch_assoc()){
        //     echo json_encode($row);
        //     echo "<br>";
        // }

        
        $row = $results->fetch_assoc();
        return json_encode($row);
    }
    
    //echo mydata("potatohead");
?>