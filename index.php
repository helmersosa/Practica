<?php
    session_start();

    require 'database.php';

    if (isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if (count($results) > 0) {
        $user = $results;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Bienvenido</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="assest/style.css">
    </head>
    <body>
        <?php require 'partials/header.php' ?>

        <?php if(!empty($user)): ?>
        <br> Bienvenido. <?= $user['email']; ?>
        <br>Usted a ingresado a su cuenta con exito.
        <a href="logout.php">
            Cerrar sesión
        </a>
        <?php else: ?>
        <h1>Favor de Iniciar sesión o Registrarse</h1>

        <a href="login.php">Iniciar sesión</a> o
        <a href="signup.php">Registrarse</a>
        <?php endif; ?>
    </body>
</html>