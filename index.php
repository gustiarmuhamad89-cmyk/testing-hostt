index.php
<?php
// index.php

// Contoh variabel PHP
$title = "Selamat Datang di Website Saya";
$deskripsi = "Ini adalah halaman index.php sederhana yang dibuat dengan PHP.";
$waktu = date("H:i:s");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f6fa;
            color: #2f3640;
            text-align: center;
            margin: 50px;
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            display: inline-block;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #0097e6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= $title ?></h1>
        <p><?= $deskripsi ?></p>
        <p>Waktu saat ini: <strong><?= $waktu ?></strong></p>
    </div>
</body>
</html>
