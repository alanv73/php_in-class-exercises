<?php
    $cookie_name = "user";
    $cookie_value = "Alan Van Art";
    setcookie($cookie_name, $cookie_value, time() + (20), "/"); // 86400 = 1 day
?>
<html>
<body>

<?php
if(count($_COOKIE) > 0) {
    echo "Cookies are enabled. <br>";
} else {
    echo "Cookies are disabled. <br>";
}
?>

<?php
echo "Today is " . date("Y/m/d") . "<br>";
echo "Today is " . date("Y.m.d") . "<br>";
echo "Today is " . date("Y-m-d") . "<br>";
echo "Today is " . date("l") . "<br>";
echo "Today is the " . date("jS") . " day of the month.<br>";
echo "There have been " . date("z") . " days this calendar year.<br>";
echo "The time is " . date("h:i:sa") . "<br>";
date_default_timezone_set("America/New_York");
echo "The time is " . date("h:i:sa") . "<br>";

$d1=strtotime("March 16");
$d2=ceil(($d1-time())/60/60/24);
echo "There are " . $d2 ." days until 16th of March." . "<br>";
echo "Formatted for MySQL DATETIME field the date/time is: " . date('Y-m-d H:i:s') . "<br>";
?>

<?php

    if(!isset($_COOKIE[$cookie_name])) {
        echo "Cookie named '" . $cookie_name . "' is not set!";
    } else {
        echo "Cookie '" . $cookie_name . "' is set!<br>";
        echo "Value is: " . $_COOKIE[$cookie_name];
    }
?>

</body>
</html>