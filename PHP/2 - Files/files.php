<?php 
$pageTitle='Files';
mb_internal_encoding('UTF-8');

include './includes/header.php';
$path='C:\wamp\www\homework2\files'; //put your own path to the file here
$files = scandir($path);

foreach($files as $value){
    if($value!='.'&& $value!='..'){
   $path2file='files'.DIRECTORY_SEPARATOR.$value;
   echo '<a href="'.$path2file.'">'.$value.'</a>'.'  '.filesize($path.DIRECTORY_SEPARATOR.$value).' '.'bytes'.'</br>';
}
}
?>
</br>
</br>
</br>
<a href = "Form.php">Browse more files</a>
</br>
</br>
</br>
</br>
</br>
</br>

<a href = "destroy.php">Sign out</a>

        
<?php 

include './includes/footer.php';

?>
