<?php
$database=  mysqli_connect("localhost", "user", "qwerty", "books");
if(!$database){
    echo "No database";
}
mysqli_set_charset($database, 'utf-8');
function get_authors($database)
{
    $q=  mysqli_query($database, 'SELECT * FROM authors');
if(mysqli_error($database)){
               return false;
            }
            $result=[];
            while($row=mysqli_fetch_assoc($q)){
                $result[]=$row;
            }
            return $result;
}

function authorIDexists($database, $ids){
    if(!is_array($ids)){
        return false;
    }
   $q=  mysqli_query($database, 'SELECT * FROM authors WHERE author_id IN ('.implode(',',$ids).')');
   if(mysqli_error($database)){
       return false;
    }
    if(mysqli_num_rows($q)==count($ids)){
        return true;
    }
    return false;
    }
?>
