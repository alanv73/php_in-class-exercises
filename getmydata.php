<?php
    require('data.php');

    $user_info = mydata("potatohead");
    echo $user_info;
    echo "<br>";

    $user_array = json_decode($user_info, true); // true for assoc array
    $user_object = json_decode($user_info, false); // false (or not specified) for object

    echo "<br>";
    echo "array username: " . $user_array["username"]; // assoc array
    echo "<br>";
    echo "object password: " . $user_object->password; // object
?>