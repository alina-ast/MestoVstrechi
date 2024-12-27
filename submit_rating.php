<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $rating = intval($_POST['rating']);
    $comment = htmlspecialchars($_POST['comment']);

    // Путь к файлу для хранения оценок
    $filePath = 'ratings.txt';

    // Формируем строку для записи
    $data = "Оценка: $rating, Комментарий: $comment\n";

    // Записываем данные в текстовый файл
    if (file_put_contents($filePath, $data, FILE_APPEND | LOCK_EX) !== false) {
        echo "<script>alert('Спасибо за вашу оценку!'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Не удалось сохранить вашу оценку. Попробуйте снова.'); window.location.href='index.html';</script>";
    }
    exit();
}
?>

<?php
$filePath = 'ratings.txt';
if (file_exists($filePath)) {
    $ratings = [];
    $file = fopen($filePath, 'r');
    
    while (($line = fgets($file)) !== false) {
        preg_match('/Оценка: (d)/', $line, $matches);
        if (isset($matches[1])) {
            $ratings[] = intval($matches[1]);
        }
    }
    
    fclose($file);
    
    if (count($ratings) > 0) {
        $averageRating = array_sum($ratings) / count($ratings);
        echo "<h3>Средняя оценка: " . round($averageRating, 2) . "</h3>";
    } else {
        echo "<h3>Нет оценок.</h3>";
    }
} else {
    echo "<h3>Нет оценок.</h3>";
}

