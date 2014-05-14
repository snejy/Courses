<?php

mb_internal_encoding('UTF-8');
include './includes/header.php';
session_start();
$username='user';
$password='qwerty';

if($_SESSION['isLogged']==true)
{
    header('Location: files.php');
}

else
    {
    if($_POST){
        $name = trim($_POST['user']);
        $passw=trim($_POST['pass']);
        if($name==$username && $passw==$password){
            $_SESSION['isLogged']=true;
            header('Location: index.php');
            exit;
        }
    else if($name!=$username){
        echo 'Invalid username.';
    }
    else if($passw!=$password){
        echo 'Invalid password.';
    }
}
?>
    <form method = "POST">
        <div>Username: <input type = "text" name = "user"/></div>
        <div>Password:  <input type="password" name = "pass"/></div>
        <div> <input type = "submit" value = "Sign in"/> </div>
    </form>
 <?php 
    }
include './includes/footer.php';

?>