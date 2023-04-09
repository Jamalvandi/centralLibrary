<?php
    include 'Config/Connection.php';

    $name = $password = "";
    $admin = "Admin";
    $adminP = "Admin82";
    $errors =  array('name'=>'', 'password'=>'');

    // Button
    if (isset($_POST['submit'])) {
        if (empty($_POST['hName'])) {
            $errors['name'] = 'Please enter a name';
        }else {
            $name = mysqli_real_escape_string($conn, $_POST['hName']);
        }
        if (empty($_POST['hPassword'])) {
            $errors['password'] = 'Please enter a password';
            
        }else {
            $password = mysqli_real_escape_string($conn, $_POST['hPassword']);
        }
        if (!array_filter($errors)) {
            if ($name == $admin && $password == $adminP) {
                header("location: admin.php");
            }
            else {
                $sql = "SELECT password FROM users WHERE name = '$name'";
                $result = mysqli_query($conn, $sql);
                $fetch = mysqli_fetch_array($result);
                if ($fetch['password'] == $password){
                    header("location: user.php");
                }else {
                    $errors['password'] = "Name and password not match";
                }
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centeral Library</title>
</head>
<body>
    <?php include 'Templates/header.php';?>
    <center>
    <h1>Welcome to centeral library</h1>
    <form action="index.php" method="POST" class="white">
        <input type="text"  name="hName" value="<?php echo htmlspecialchars($users['name'])?>">
        <label for="hName">Name</label>
        <div class="red-text"><?php echo $errors['name']; ?></div>
        <input type="password" name="hPassword">
        <label for="hPassword">Password</label>
        <div class="red-text"><?php echo $errors['password']; ?></div>
        <br><br>
        <input type="submit" value="Open the Library" name="submit" class="center btn brand z-deth-0" >
    </form>
</center>
    <?php include 'Templates/footer.php';?>
</body>
</html>