<?php
$pageTitle ="Нова книга";
include './includes/header.php';

if($_POST){
        $errors=[];
        $name = trim($_POST['bookName']);
        $authors=$_POST['authors'];
        $name =mysqli_real_escape_string($database,$name);
        if(mb_strlen($name)<2)
        {
            $errors[]="<p>Невалидно име</p>";
        }
        if(!is_array($authors) && count($authors)==0)
        {
            $errors[]="<p>Невалидни автори</p>";
        }
        
        if(!authorIDexists($database, $authors)){
            $errors[]='<p> Невалидни Автори</p>';
        }
        $q= mysqli_query($database, 'SELECT * FROM books WHERE book_title="'.$name.'"');
        if(!$q)
        {
            echo "Error.";
        }
        if(mysqli_num_rows($q)>0){
            $errors[]="Има такава книга.";
           
        }
        
        if(count($errors)>0){
           foreach($errors as $value)
           {
               echo '<p>'.$value.'</p>';
           }
         }
         else{
             mysqli_query($database, 'INSERT INTO books (book_title) VALUES ("'.$name.'")');
             if(mysqli_error($database)){
                 echo 'Error.';
                 exit;
             }
             $id=  mysqli_insert_id($database);
             foreach($authors as $authorid){
                 mysqli_query($database, 'INSERT INTO books_authors (book_id, author_id) VALUES ('.$id.','.$authorid.')');
                 if(mysqli_error($database))
                 {
                     echo 'Error';
                     exit;
                 }
             }
         }  echo "Книгата е добавена";
        $name =mysqli_real_escape_string($database,$name);
}
$authors=get_authors($database);
if($authors===false){
    echo "Грешка";
    header('Location: 404.php');
    exit;
}
?>
<a href="index.php"> Книги </a>
<form method = "POST" action="new_book.php">
    <div> Книга:  <input type="text" name ="bookName"></div>
    <div> Автори<select name="authors[]" multiple='multiple'>
<?php

           foreach($authors as $row){
        echo "<option value='".$row['author_id']."'>".$row['author_name']."</option>";
    }
    
?>
            </select> </div>
    <div> <input type = "submit" value = "Добави"/> </div>
</form>
<?php
include './includes/footer.php';
?>