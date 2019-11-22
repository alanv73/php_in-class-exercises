<?php
    // if (isset($_POST["submit"])){
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $log_text = filter_var($_POST['filetext'], 
                                    FILTER_SANITIZE_STRING, 
                                    FILTER_FLAG_NO_ENCODE_QUOTES);
        $text = date('Y-m-d H:i:s') . ' | ' . $log_text;

        $log_file = fopen("mylog.txt", "a+");
        $bytes = fwrite($log_file, $text . "\n");
        echo "$bytes bytes written<br>";
        fclose($log_file);
        $_POST['filetext'] = null;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Files</title>
</head>
<body>
    <form action="" method="post">
        <textarea type="text" name="filetext" cols="50" rows="5" placeholder="type text to be added to log"></textarea><br>
        <input type="submit" name="submit" value="Send To Log">
    </form>
    <hr>
    <?php
        $log_file = fopen("mylog.txt", "r");

        $the_text = html_entity_decode(fread($log_file, filesize("mylog.txt")), ENT_QUOTES);
        $text_sanitized = htmlspecialchars($the_text);
        $text_with_breaks = nl2br($text_sanitized);
        
        echo $text_with_breaks;

        // echo nl2br(htmlentities(fread($log_file, filesize("mylog.txt"))));
        // echo nl2br(htmlspecialchars(fread($log_file, filesize("mylog.txt"))));
        
        fclose($log_file);
    ?>
</body>
</html>