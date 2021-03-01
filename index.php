<!DOCTYPE html>
<html>
<head>
	<title>crud</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div>
<?php require_once 'process.php' ?>
<?php 
    if(isset($_SESSION['message'])):
?>
<div style="color:red">
<?php 
    echo $_SESSION['message'];
    unset($_SESSION['message']);
?>
</div>
<?php endif; ?>
<?php
    $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
    
    function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
?>
    <form action="process.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="break">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username ?>" placeholder="Username"><br>
        </div>
        <div class="break">
            <label>Email</label>
            <input type="text" name="email" value="<?php echo $email ?>" placeholder="Email"><br>
        </div>
        <div class="break">
            <label>Address</label>
            <input type="text" name="address" value="<?php echo $address ?>" placeholder="Address"><br>
        </div>
        <div class="break">
            <label>Contact No.</label>
            <input type="number" name="contact" value="<?php echo $contact ?>" placeholder="Contact"><br>
        </div>
    
    
    
    <?php 
    if($update == true):
    ?>
        <button class="button" type = "submit" name="update">Update</button>
    <?php else: ?>
        <button class="button" type = "submit" name="add">Add</button>
        <?php endif ?>
    </form>
    </div>
    <div>

        <table class="users">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Contact No.</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['contact']; ?></td>
                
                <td>
                    <a href="index.php?edit=<?php echo $row['id']; ?>">Edit</a>

                    <a href="process.php?delete=<?php echo $row['id']; ?>">Delete</a>

                </td>
            </tr>
        <?php endwhile; ?>
        </table>

    </div>
     
</body>
</html>