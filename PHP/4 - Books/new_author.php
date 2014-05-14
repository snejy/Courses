<?php
$pageTitle ="Нов автор";
include './includes/header.php';
if($_POST){
        $errors=[];
        $name = trim($_POST['authorName']);
        if(mb_strlen($name)<3)
        {
            $errors[]="<p>Невалидно име</p>";
        }
        $name =mysqli_real_escape_string($database,$name);
        $q= mysqli_query($database, 'SELECT * FROM authors WHERE 
            author_name="'.$name.'"');
        if(!$q)
        {
            echo "Error.";
        }
        if(mysqli_num_rows($q)>0){
            $errors[]="Има такъв автор.";
           
        }
        if(count($errors)>0){
           foreach($errors as $value)
           {
               echo '<p>'.$value.'</p>';
           }
         }
           else
           mysqli_query($database, 'INSERT INTO authors (author_name) VALUES ("'.$name.'")');
           if(mysqli_error($database)){
               echo "Грешка.";
            }
            else {
                echo "Успешен запис.";
            }
        }
$authors=  get_authors($database);
if($authors===false){
    echo "Грешка.";
    header('Location: 404.php');
    exit;
}

?>

<a href="index.php"> Книги </a>
<form method = "POST" action="new_author.php">
    <div> Автор:  <input type="text" name ="authorName"></div>
     <div> <input type = "submit" value = "Добави"/> </div>
</form>
<table border ='1'><tr><th>Автори</th></tr>
    <?php
    foreach($authors as $row)
        echo "<tr><td>".$row['author_name']."</td></tr>";
    
    echo "</table>";
    
    ?>
<?php
include './includes/footer.php';
?>

