<?php
$pageTitle='Sign up form';
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
    if($_POST){
        $error=false;
        $subject=trim($_POST['sub']);
        $subject = mysqli_real_escape_string($connection, $subject);
        $message = trim($_POST['msg']);
        $message = mysqli_real_escape_string($connection, $message);
    if(strlen($subject)>50){
        echo "The subject must be less than 50 symbols.</br>";
        $error=true;
    }
    if(strlen($message)>250){
        echo "The message must be less than 250 symbols.</br>";
        $error=true;
    }
        $sql='INSERT INTO `messages` (`msg_title`, `msg_content`,`user`) VALUES ("'.$subject.'" , "'.$message.'","'.$_SESSION['username'].'")';
        
   if($error==false){
       if(mysqli_query($connection,$sql)){
       echo "Your message has been added to the list of messages.";
       header('Location: messages.php');
       }
   }
   else if(mysqli_error($connection)){
       echo "Your message was not submitted.</br>Reduce the Subject to 50 symbols and the message's content to 250 symbols.</br>";
       
   }
  }
}
else 
    header('Location: index.php');
?>
    <form method = "POST">
        <div>Subject: <input type = "text" name = "sub"/></div> (max 50 signs)
        <div>Message: <textarea name = "msg"/></textarea></div> (max 250 signs)
        <div> <input type = "submit" value = "Submit"/> </div>
    </form>

    <a href = "destroy.php">Sign out</a>
<?php 
    
include './includes/footer.php';

?>