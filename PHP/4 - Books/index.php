<?php
$pageTitle ="Всички книги и автори";
include './includes/header.php';
$connection = mysqli_connect('localhost', 'user', 'qwerty', 'books');

if(!$connection){
    echo 'There is problem with the database.';
    exit;
}
mysqli_set_charset($connection, 'utf8');
?>
<a href="new_book.php"> Нова книга </a> </br>
<a href="new_author.php"> Нов автор </a>
<?php 
$sql = mysqli_query($connection,"SELECT * FROM books LEFT JOIN books_authors ON books.book_id=books_authors.book_id LEFT JOIN authors ON books_authors.author_id=authors.author_id");
if(!$sql)
{
    echo "Error.";
}
$result=array();

if(mysqli_num_rows($sql)>0){
while($row=$sql->fetch_assoc()){
    $result[$row['book_id']]['book_title']=$row['book_title'];
    $result[$row['book_id']]['authors'][]=$row['author_name'];
    }
    echo '<table ><tr><td>Книга</td> <td>Автори</td></tr>';
    foreach($result as $v) {
        echo '<tr><td>'.$v['book_title'].'</td><td>';
        $data=array();
        foreach($v['authors'] as $val){
            $data[]=$val;
        }
        echo implode(',', $data);
        echo '</td></tr>';
}
}
echo '</tr>';
include './includes/footer.php';
?>
