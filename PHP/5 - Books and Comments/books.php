<?php
$pageTitle='Книги';
mb_internal_encoding('UTF-8');
include './includes/header.php';
$connection = mysqli_connect('localhost', 'user', 'qwerty', 'books');
if(!$connection){
    echo 'There is problem with the database.';
    exit;
}
mysqli_set_charset($connection, 'utf8');
if (isset($_GET['book_id'])) {
    $book_id =(int)$_GET['book_id'];
    $q = mysqli_query($db, 'SELECT * FROM books as b LEFT JOIN 
    books_authors as ba ON b.book_id=ba.book_id LEFT JOIN authors as a
    ON a.author_id=ba.author_id WHERE b.book_id='.$book_id.'');
} else {
    header('Location: index.php');
}
$sql = mysqli_query($connection,"SELECT comment, date FROM comments ORDER BY date DESC");
if(!$sql)
{
    echo "Error.";
}
if(isset($_SESSION['logged'])&&$_SESSION['logged']==true)
{
    if($_POST){
        $error=false;
        $comment = trim($_POST['comment']);
        $comment = mysqli_real_escape_string($connection, $comment);
    if(strlen($comment)>250){
        echo "The comment must be less than 250 symbols.</br>";
        $error=true;
    }
        $sql='INSERT INTO `comments` (`comment`,`user`,`book_id`) VALUES ("'.$comment.'","'.$_SESSION['username'].'","' .$book_id. '")';
    if($error==false){
        if(mysqli_query($connection,$sql)){
        echo "Your comment has been added to the list of messages.";
        }
    }
    else if(mysqli_error($connection)){
        echo "Your comment was not submitted.</br>Reduce the comment's content to 250 symbols.</br>";
    }
  }
?>
    <form method = "POST">
        <div>Comment: <textarea name = "comment"/></textarea></div> (max 250 signs)
        <div> <input type = "submit" value = "Submit"/> </div>
    </form>
<?php
}
$result = [];
while ($row = mysqli_fetch_assoc($q)) {
    $result[$row['book_id']]['books'][$row['book_id']]=$row['book_title'];
    $result[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
}
echo '<table border="1"><tr><td>Книга</td><td>Автори</td></tr>';
foreach ($result as $row) {
    //echo '<pre>'.print_r($result, true).'</pre>';
    echo '<tr>';
    foreach($row['books'] as $key => $value){
    echo '<td><a href="index.php?book_id=' . $key . '">' . $value . '</a></td>
    <td>';}
    $ar = array();
    foreach ($row['authors'] as $key => $value) {
        $ar[] = '<a href="index.php?author_id=' . $key . '">' . $value . '</a>';
    }
    echo implode(' , ', $ar) . '</td></tr>';
}
$sql1 = mysqli_query($connection,"SELECT * FROM books as b LEFT JOIN comments as c ON 
    c.book_id='".$book_id."'WHERE c.book_id=b.book_id");
if(!$sql1)
{
    echo "Error.";
}
echo '</table>';
echo '</br>';
if(mysqli_num_rows($sql1)>0){
    echo '<table border="1"><tr> <td>Comment</td> <td>Posted on</td><td> Posted by</td></tr>';
while($row=$sql1->fetch_assoc()){
    echo '<tr><td>'.$row['comment'].'</td>
            <td>'.$row['date'].'</td>
            <td>'.$row['user'].'</td>';
    }
}
echo '</tr>';
echo'<a href="index.php">Списък</a>';
include './includes/footer.php';
?>