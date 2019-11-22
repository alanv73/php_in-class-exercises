<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }



    if($_SESSION['username'] != null){
        require('dbconnection.php');

        if(isset($_POST['usertodelete'])){
            $usertodelete = $_POST['usertodelete'];
            $sql = "delete from users where username = '$usertodelete'";
            $conn->query($sql);
        }

        $sql = "select * from users;";
        $results = $conn->query($sql);

        
?>
<table border="1px;">
    <thead>
        <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            if($results->num_rows > 0){
                while($row = $results->fetch_assoc()){
        ?>
                    <tr>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="usertodelete" value="<?php echo $row['username']; ?>">
                                <input type="submit" value="X">
                            </form>
                        </td>
                    </tr>
        <?php
                }
            }
        ?>
    </tbody>
</table>
<?php
    } else {
        echo "You Must Log In Before You Continue";
        // if we are not logged in send status code 302
        // back to browser to redirect to login page
        // header("Location: boringLogin.php");
    }
?>