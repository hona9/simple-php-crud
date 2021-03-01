<?php 

    session_start();

    $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

    $id=0;
    $username = '';
    $email = '';
    $address = '';
    $contact = '';
    $update = false;
        
    if(isset($_POST['add'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];

        if (empty($username)) {
            header("Location: index.php?error=User Name is required");
            $_SESSION['message'] = "User Name is required";
            exit();
        }else if(empty($email)){
            header("Location: index.php?error=Email is required");
            $_SESSION['message'] = "Email is required";
            exit();
        }
        else if(empty($address)){
            header("Location: index.php?error=Address is required");
            $_SESSION['message'] = "Address is required";
            exit();
        }
    
        else if(empty($contact)){
            header("Location: index.php?error=Contact Number is required");
            $_SESSION['message'] = "Contact Number is required";
            exit();
        }
        else{
            $mysqli->query("INSERT INTO data (username, email, address, contact) values('$username', '$email', '$address', '$contact')") or die($mysqli-> error);
        
            $_SESSION['message'] = "Saved";
    
            header('location: index.php');
        }
    }

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());
        
        $_SESSION['message'] = "User deleted!";

        header('location: index.php');
    }

    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;
        $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);

            $row = $result->fetch_array();
            $username = $row['username'];
            $email = $row['email'];
            $address = $row['address'];
            $contact = $row['contact'];
        
    }
    
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];

        if (empty($username)) {
            header("Location: index.php?error=User Name is required");
            $_SESSION['message'] = "User Name is required";
            exit();
        }else if(empty($email)){
            header("Location: index.php?error=Email is required");
            $_SESSION['message'] = "Email is required";
            exit();
        }
        else if(empty($address)){
            header("Location: index.php?error=Address is required");
            $_SESSION['message'] = "Address is required";
            exit();
        }
    
        else if(empty($contact)){
            header("Location: index.php?error=Contact Number is required");
            $_SESSION['message'] = "Contact Number is required";
            exit();
        }
        else{

            $mysqli->query("UPDATE data SET username='$username', email='$email', address='$address', contact='$contact' WHERE id=$id") or 
            die($mysqli->error); 

            $_SESSION['message'] = "User Updated";

            header('location: index.php');
        
        }
    }

?>