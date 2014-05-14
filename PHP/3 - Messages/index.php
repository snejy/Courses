<?php
$pageTitle='Sign in form';
mb_internal_encoding('UTF-8');
include './includes/header.php';
$connection = mysqli_connect('localhost', 'user', 'qwerty', 'database');
session_start();

if(!$connection){
    echo 'There is problem with the database.';
    exit;
}
mysqli_set_charset($connection, 'utf8');
if($_SESSION['isLogged']==true)
{
    header('Location: messages.php');
}
$sql = mysqli_query($connection,"SELECT username, password FROM users");
if(!$sql)
{
    echo "Error.";
}

else
    {
    if($_POST){
        $name = trim($_POST['user']);
        $passw=trim($_POST['pass']);
        $_SESSION['username'] = $name;
        while($row=$sql->fetch_assoc()){
            if($name==$row['username']&&$passw==$row['password'])
            {
                $_SESSION['isLogged']=true;
                header('Location: messages.php');
                exit;
            }
        }
        echo "Wrong username or password.";
    }
  }
?>
    <form method = "POST">
        <div>Username: <input type = "text" name = "user"/></div>
        <div>Password:  <input type="password" name = "pass"/></div>
        <div> <input type = "submit" value = "Sign in"/> </div>
    </form>
</br>
</br>
</br>
</br>

<a href="register.php">You can sign up here.</a>
<?php 
  
include './includes/footer.php';

?>