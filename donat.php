<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']); // В реальной ситуации лучше хэшировать пароль

    // Формируем строку для записи
    $data = "Имя пользователя: $username, Пароль: $password\n";

    // Путь к файлу
    $filePath = 'userdata.txt';

    // Записываем данные в текстовый файл
    if (file_put_contents($filePath, $data, FILE_APPEND | LOCK_EX) !== false) {
        // Если запись успешна, перенаправляем на страницу успеха с сообщением
        echo "<script>alert('Регистрация прошла успешно'); window.location.href='index.html';</script>";
    } else {
        // Если произошла ошибка, показываем сообщение
        echo "<script>alert('Не удалось сохранить данные. Попробуйте снова.'); window.location.href='index.html';</script>";
    }
    exit();
}
