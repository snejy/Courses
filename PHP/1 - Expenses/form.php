<?php
mb_internal_encoding('UTF-8');
$pageTitle = 'Форма';
include './includes/header.php';

if($_POST){
    $name = trim($_POST['name']);
    $name = str_replace('!', '', $name);
    $cost = trim($_POST['cost']);
    $cost = str_replace('!', '', $cost);
    $selectedGroup = (int)$_POST['type'];
    $error = false;
    if(mb_strlen($name) < 3){
        echo '<p>Името е не е валидно.</p>';
        $error = true;
    }
    if($cost <= 0){
        echo '<p>Цената не е валидна.</p>';
        $error = true;
    }

    if(!array_key_exists($selectedGroup, $types)){
        echo '<p>Групата не е валидна.</p>';
        $error = true;
    }

    if(!$error){
        $today = date("d.m.Y");
        $result = $today.'!'.$name.'!'.$cost.'!'.$selectedGroup."\n";
        if(file_put_contents('data.txt', $result,FILE_APPEND))
        {
            echo 'Записът е успешен.';
        }
    }

}
?>
    <a href = "expenses.php">Обратно към списъка</a>
    <form method = "POST">
        <div>Име: <input type = "text" name = "name"/></div>
        <div>Цена:  <input type = "text" name = "cost"/></div>
        <div>
        <select name = "type">
        <?php
            for($i=1;$i<count($types);$i++){
                echo '<option value="'.$i.'">'.$types[$i].'</option>';
            }
        ?>
        </select>
        </div>
        <div> <input type = "submit" value = "Добави"/> </div>
    </form>
<?php 

include './includes/footer.php';

?>