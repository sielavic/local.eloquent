<?php
namespace App\Models;



class Model
{

    // Массив для хранения данных модели
    public $data = [];

    // Метод для добавления данных в модель из массива
    public function add_data($csv_data) {
        foreach ($csv_data as $row) {
            $db = mysqli_connect('localhost', 'root', '', 'eloquent_local');

            $query = "SELECT * FROM `csv_data`";
            $result = mysqli_query($db, $query);

            $row_cnt = $result->num_rows;
            if ($row_cnt < 1440){
                $row[0] = rtrim($row[0], '/\\');

                $encod_row0 = mb_detect_encoding($row[0]);
                $encod_row1 = mb_detect_encoding($row[1]);
                $encod_row2 = mb_detect_encoding($row[2]);

                iconv($encod_row0, 'UTF-8',$row[0]);
                iconv($encod_row1, 'UTF-8',$row[1]);
                iconv($encod_row2, 'UTF-8',$row[2]);

                if ($encod_row0 == 'UTF-8' && $encod_row1 == 'UTF-8' && $encod_row2 == 'UTF-8'){
                    $query = "INSERT INTO csv_data (column1, column2, column3) VALUES ('$row[0]', '$row[1]', '$row[2]')";

                    $result = mysqli_query($db, $query)
                    or die ('Error in query to database');
                }

            }
            mysqli_close($db);

        }
    }
}

