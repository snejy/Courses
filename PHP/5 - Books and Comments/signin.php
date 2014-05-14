<?php
$pageTitle='Регистрация';
mb_internal_encoding('UTF-8');
include './includes/header.php';
$connection = mysqli_connect('localhost', 'user', 'qwerty', 'books');

if(!$connection){
    echo 'There is problem with the database.';
    exit;
}
mysqli_set_charset($connection, 'utf8');
if(isset($_SESSION['logged'])==true)
{
    header('Location: index.php');
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
                $_SESSION['logged']=true;
                $_SESSION['username']=$name;
                header('Location: index.php');
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
</br>
<a href="index.php">Списък</a>
<?php 
include './includes/footer.php';
?>