<?php
// Подключаем модель
use App\Models\Model;

require_once 'app/models/model.php';


?>
<?php
// Функция для парсинга CSV файла и получения массива данных
function parse_csv($file_path) {
$csv_data = [];

if (($handle = fopen($file_path, "r")) !== FALSE) {
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
$csv_data[] = $data;
}
fclose($handle);
}

return $csv_data;
}?>

<?php
// Подключаем модель
require_once 'app/models/model.php';

// Если форма отправлена
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['csv_file'])) {
    // Получаем путь к загруженному файлу
    $file_path = $_FILES['csv_file']['tmp_name'];

    // Парсим CSV файл и получаем массив данных
    $csv_data = parse_csv($file_path);

    // Создаем экземпляр модели
    $model = new Model();

    // Добавляем данные в модель
    $model->add_data($csv_data);

    // Редирект на страницу со списком данных
    header('Location: list.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload CSV File</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
    <label for="csv_file">Выберете CSV файл:</label>
    <input type="file" name="csv_file" id="csv_file" accept=".csv">
    <button type="submit">Загрузить</button>
</form>
</body>
</html>