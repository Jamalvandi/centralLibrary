<?php
    include 'Config/Connection.php';
    $name = $password = $rPassword = ""; 
    $errors =  array('name'=>'', 'password'=>'' , 'rPassword'=>'');
    if (isset($_POST['submit'])) {
        // validate 
        if (empty($_POST['hName'])) {
            $errors['name'] = 'Please enter a name';
        }else {
            if (preg_match('/^[a-z][A-Z][0-9]$/', $_POST['hName'])) {
                $errors['name'] = 'Enter a valid name ';
            }
        }
        if (empty($_POST['hPassword'])) {
            $errors['password'] = 'Please enter a password';
        }else {
            if (preg_match('/^[a-z][A-Z][0-9]$/', $_POST['hPassword'])) {
                $errors['hpassword'] = 'Enter a valid password ';
            }
        }
        if (empty($_POST['rPassword'])) {
            $errors['rPassword'] = 'Please enter a password';
        }else {
            if ($_POST['hPassword'] != $_POST['rPassword']) {
                $errors['rPassword'] = 'Passwords are not the same';
            }
        }
        if (!array_filter($errors)) {
            $name = mysqli_real_escape_string($conn, $_POST['hName']);
            $password = mysqli_real_escape_string($conn, $_POST['hPassword']);
            $sql = "INSERT INTO users (name , password) VALUES ('$name', '$password')";
            if (mysqli_query($conn,$sql)) {
                header("Location: index.php");
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
    <title>Sign up</title>
</head>
<body>
<?php include 'Templates/header_sign.php';?>
<center>
    <h1>Sign up into library</h1>
    <form action="sign_up.php" method="POST" class="white">
        <input type="text"  name="hName">
        <label for="hName">Name</label>
        <div class="red-text"><?php echo $errors['name']; ?></div>
        <input type="password" name="hPassword">
        <label for="hpassword">Password</label>
        <div class="red-text"><?php echo $errors['password']; ?></div>
        <input type="password" name="rPassword">
        <label for="rPassword">Re enter password</label>
        <div class="red-text"><?php echo $errors['rPassword']; ?></div>
        <br><br>
        <input type="submit" value="Open the Library" name="submit" class="center btn brand z-deth-0" >
    </form>
</center>
<?php include 'Templates/footer.php';?> 
</body>
</html>