<?php
// Подключаем модель
use App\Models\Model;

require_once 'app/models/model.php';

// Создаем экземпляр модели
$model = new Model();

$db = mysqli_connect('localhost', 'root', '', 'eloquent_local');

//Формируем запрос
$query = "SELECT * FROM `csv_data`";
$result = mysqli_query($db, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data List</title>
</head>
<body>
<h1>Data List</h1>
<table>
    <thead>
    <tr>
        <th>column1</th>
        <th>column2</th>
        <th>column3</th>
    </tr>
    </thead>
    <tbody>

 <tr>
   <?php while($row = mysqli_fetch_array($result)){?>
            <td><?php echo $row["column1"]; ?></td>
            <td><?php echo $row["column2"]; ?></td>
            <td><?php echo $row["column3"]; ?></td>
        </tr>
  <?php  } ?>
    </tbody>
</table>
</body>
</html>