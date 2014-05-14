<?php
$pageTitle ='Form';
mb_internal_encoding('UTF-8');
include './includes/header.php';

if($_POST){
    $empty = false;
    $name = trim($_POST['filename']);
    if(str_word_count($name) <= 0){
        $empty = true;
        echo 'Please enter a name of the file.</br>';
    }
    if(count($_FILES) > 0){
        if(file_exists("files") && file_exists("files".DIRECTORY_SEPARATOR.$name) && !$empty){
            echo "File with the same name exists.</br>";
        }
        else
        if(move_uploaded_file($_FILES['toUpload']['tmp_name'],"files".DIRECTORY_SEPARATOR.$name)){
             echo 'File is successfully uploaded !</br>';
        }
    }
}
?>
    <a href = "files.php">List with files</a>
    <form method = "POST" enctype = "multipart/form-data">
        <div>Name:  <input type = "text" name = "filename"/></div>
        <div>File:  <input type = "file" name = "toUpload"/></div>
        <div> <input type = "submit" value = "Upload this file"/> </div>
    </form>
<?php 

include './includes/footer.php';

?>