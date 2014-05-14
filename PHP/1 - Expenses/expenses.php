<?php
mb_internal_encoding('UTF-8');
$pageTitle = 'Списък';
include './includes/header.php';

function summary($expense=0,$sum=0)
{
    $sum += $expense;
    return $sum;
}

if($_POST)
{
    $selectedGroup =(int)$_POST['filter'];
    if(!array_key_exists($selectedGroup, $types)){
        echo '<p>Групата не е валидна.</p>';
        $error = true;
    }
}
?>
    <a href = "form.php">Добави разход</a>
        <form method = "POST"><select name = "filter">
        <?php
            foreach($types as $key => $value){
                echo '<option value="'.$key.'">'.$value.'</option>';
            }
            ?>
            </select>
            <input type = "submit" value = "Филтрирай"/>
        </form>
        <table border = "1">
        <tr>
            <td>Дата</td>
            <td>Име</td>
            <td>Цена</td>
            <td>Вид</td>
        </tr>

        <?php
        $expenses=0;
        $result = file('data.txt');
        if(file_exists('data.txt')){
            $result =  file('data.txt');
            foreach ($result as $value) {
                $columns = explode('!', $value);
                if($_POST and $selectedGroup!=0)
                {
                    if($selectedGroup!=$columns[3])
                        continue;
                }
            echo '<tr>
                <td>'.$columns[0].'</td>
                <td>'.$columns[1].'</td>
                <td>'.$columns[2].'</td>
                <td>'.$types[trim($columns[3])].'</td>
                </tr>';
                $expenses=summary($columns[2],$expenses);

            }
}
        echo '<tr> 	<td>'.'-------'.'</td>
                <td>'.'-------------'.'</td>
                <td>'.$expenses.'</td>
                <td>'.'--------'.'</td>
                </tr>';
        ?>
    </table>
<?php 

include './includes/footer.php';

?>