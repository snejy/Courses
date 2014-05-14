<?php
$pageTitle='Register';
mb_internal_encoding('UTF-8');
include './includes/header.php';
session_start();
$connection = mysqli_connect('localhost', 'user', 'qwerty', 'database');

if(!$connection){
    echo 'There is problem with the database.';
    exit;
}
mysqli_set_charset($connection, 'utf8');

if($_SESSION['isLogged']==true)
{
   header('Location: index.php');
   exit;
}
else
    {
    if($_POST){
        $error=false;
        $name = trim($_POST['user']);
        $name =mysqli_real_escape_string($connection,$name);
        $passw1=trim($_POST['pass1']);
        $passw1=mysqli_real_escape_string($connection,$passw1);
        $passw2=trim($_POST['pass2']);
        $passw2=mysqli_real_escape_string($connection,$passw2);
        $sql1 = mysqli_query($connection,"SELECT username, password FROM users");
        if(strlen($name)<5){
            echo "The username must be more than 5 symbols.</br>";
            $error=true;
            }
        if(strlen($passw1)<5){
            echo "The password must be more than 5 symbols.</br>";
            $error=true;
            }
        if($passw1!=$passw2){
            echo "The password was not repeated correctly.</br>";
            $error=true;
        }
        if(mysqli_num_rows($sql1)>0){
        while($row=$sql1->fetch_assoc()){
            if($name==$row['username'])
            {
                echo "User with the same username already exists.</br>";
                $error=true;
            }
            }
        }
        if($error==false){
             $sql='INSERT INTO `users` (`username`, `password`) VALUES ("'.$name.'" , "'.$passw1.'")';
             if(mysqli_query($connection,$sql)){
                 echo "You have been successfully registered.";
                 
             } 
            
            header('Location: index.php');
            exit;
        }
        
  
}
?>
    <form method = "POST">
        <div>Username: <input type = "text" name = "user"/></div>(min 5 characters)
        <div>Password:  <input type="password" name = "pass1"/></div>(min 5 characters)
        <div>Repeat Password:  <input type="password" name = "pass2"/></div>
        <div> <input type = "submit" value = "Sign up"/> </div>
    </form>
<a href = "index.php">Back</a>
 <?php 
}
include './includes/footer.php';

?>