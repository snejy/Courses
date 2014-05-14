<?php
$pageTitle='Messages';
mb_internal_encoding('UTF-8');
include './includes/header.php';
session_start();
$connection = mysqli_connect('localhost', 'user', 'qwerty', 'database');

if(!$connection){
    echo 'There is problem with the database.';
    exit;
}
mysqli_set_charset($connection, 'utf8');
$sql = mysqli_query($connection,"SELECT msg_title, msg_content, date, user FROM messages ORDER BY date DESC");
if(!$sql)
{
    echo "Error.";
}

echo '<table ><tr><td>Subject</td> <td>Content</td> <td>Posted on</td><td> Posted by</td></tr>';
if(mysqli_num_rows($sql)>0){
while($row=$sql->fetch_assoc()){
    echo '<tr><td>'.$row['msg_title'].'</td>
              <td>'.$row['msg_content'].'</td>
              <td>'.$row['date'].'</td>
              <td>'.$row['user'].'</td>';
    }
}
echo '</tr>';
?>

<a href="message.php">New Message</a>
</br>

<a href = "destroy.php">Sign out</a>
</br>

<?php 

include './includes/footer.php';

?>
