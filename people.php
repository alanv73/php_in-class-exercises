<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if($_SESSION['username'] != null){
        require('dbconnection.php');

        $sql = "select * from users;";
        $results = $conn->query($sql);

        
?>

<table>
    <thead>
        <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Location</th>
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